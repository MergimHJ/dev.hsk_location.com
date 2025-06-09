<?php

function contact()
{
    // Afficher le formulaire de contact
    render('contact/contact.php', []);
}

function send()
{
    require_once '../app/config/db.php';
    
    // Vérification que c'est bien un POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: /contact');
        exit;
    }
    
    $errors = [];
    $data = [];
    
    // Validation et nettoyage des données
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');
    
    // Validation du nom
    if (empty($name)) {
        $errors['name'] = 'Le nom est obligatoire';
    } elseif (strlen($name) < 2) {
        $errors['name'] = 'Le nom doit faire au moins 2 caractères';
    } elseif (strlen($name) > 100) {
        $errors['name'] = 'Le nom ne peut pas dépasser 100 caractères';
    }
    
    // Validation de l'email
    if (empty($email)) {
        $errors['email'] = 'L\'email est obligatoire';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Format d\'email invalide';
    } elseif (strlen($email) > 255) {
        $errors['email'] = 'L\'email ne peut pas dépasser 255 caractères';
    }
    
    // Validation du téléphone (optionnel)
    if (!empty($phone)) {
        // Nettoyage du numéro de téléphone
        $phone = preg_replace('/[^0-9+\-\s\.]/', '', $phone);
        if (strlen($phone) > 20) {
            $errors['phone'] = 'Le numéro de téléphone est trop long';
        }
    }
    
    // Validation du sujet
    $validSubjects = ['reservation', 'information', 'probleme', 'autre'];
    if (empty($subject)) {
        $errors['subject'] = 'Le sujet est obligatoire';
    } elseif (!in_array($subject, $validSubjects)) {
        $errors['subject'] = 'Sujet invalide';
    }
    
    // Validation du message
    if (empty($message)) {
        $errors['message'] = 'Le message est obligatoire';
    } elseif (strlen($message) < 10) {
        $errors['message'] = 'Le message doit faire au moins 10 caractères';
    } elseif (strlen($message) > 5000) {
        $errors['message'] = 'Le message ne peut pas dépasser 5000 caractères';
    }
    
    // Protection anti-spam basique
    if (!empty($_POST['honeypot'])) {
        // Champ honeypot rempli = probablement un bot
        header('Location: /contact');
        exit;
    }
    
    // Si il y a des erreurs, retourner au formulaire avec les erreurs
    if (!empty($errors)) {
        $data = [
            'errors' => $errors,
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'subject' => $subject,
            'message' => $message,
            'head_title' => 'Erreur de validation - Contact'
        ];
        render('contact/contact.php', $data);
        return;
    }
    
    try {
        $pdo = db();
        
        // Préparer et exécuter l'insertion
        $stmt = $pdo->prepare("
            INSERT INTO contact_messages (
                name, email, phone, subject, message, ip_address, user_agent, status
            ) VALUES (
                :name, :email, :phone, :subject, :message, :ip_address, :user_agent, 'new'
            )
        ");
        
        $result = $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':phone' => $phone ?: null,
            ':subject' => $subject,
            ':message' => $message,
            ':ip_address' => $_SERVER['REMOTE_ADDR'] ?? '',
            ':user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? ''
        ]);
        
        if ($result) {
            $messageId = $pdo->lastInsertId();
            
            // Optionnel : Envoyer un email de notification
            // $this->sendNotificationEmail($messageId, $name, $email, $subject, $message);
            
            // Redirection vers la page de succès
            render('contact/success.php', [
                'success' => true,
                'message_id' => $messageId,
                'head_title' => 'Message envoyé avec succès'
            ]);
            
        } else {
            throw new Exception('Erreur lors de l\'enregistrement');
        }
        
    } catch (PDOException $e) {
        error_log("Erreur contact DB: " . $e->getMessage());
        
        $data = [
            'error' => 'Une erreur technique est survenue. Veuillez réessayer plus tard.',
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'subject' => $subject,
            'message' => $message,
            'head_title' => 'Erreur technique - Contact'
        ];
        render('contact/contact.php', $data);
        
    } catch (Exception $e) {
        error_log("Erreur contact: " . $e->getMessage());
        
        $data = [
            'error' => 'Une erreur est survenue lors de l\'envoi. Veuillez réessayer.',
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'subject' => $subject,
            'message' => $message,
            'head_title' => 'Erreur d\'envoi - Contact'
        ];
        render('contact/contact.php', $data);
    }
}

// Fonction optionnelle pour envoyer une notification par email
function sendNotificationEmail($messageId, $name, $email, $subject, $message)
{
    // Ici vous pouvez ajouter l'envoi d'email avec PHPMailer ou mail()
    // Exemple basique :
    /*
    $to = 'admin@hsk-locations.fr';
    $emailSubject = 'Nouveau message de contact - HSK Locations';
    $emailBody = "
        Nouveau message de contact reçu :
        
        ID: $messageId
        Nom: $name
        Email: $email
        Sujet: $subject
        Message: $message
        
        Connectez-vous à l'admin pour répondre.
    ";
    
    mail($to, $emailSubject, $emailBody, "From: noreply@hsk-locations.fr");
    */
}