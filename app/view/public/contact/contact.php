
<?php
// Vérifiez si $data existe avant d'essayer d'y accéder
if(isset($data) && is_array($data)) {
    echo '<div class="alert alert-success">
            <strong>Merci pour votre message!</strong> ' . ($data['message']  ?? ''). '
          </div>';
}
?>

  <!-- Hero Section -->
    <section class="contact-hero">
        <h1>Contactez-nous</h1>
        <p>Une question sur nos véhicules ? Besoin d'informations pour votre réservation ? Notre équipe est à votre écoute.</p>
    </section>

    <div class="contact-container">
        <!-- Message de succès -->
        <?php if(isset($data) && is_array($data) && isset($data['success'])): ?>
        <div class="alert">
            <strong>✨ Merci pour votre message!</strong><br>
            Nous vous recontacterons dans les plus brefs délais.
        </div>
        <?php endif; ?>

        <!-- Formulaire -->
        <form method="post" action="" class="contact-form">
            <div class="form-row">
                <div class="form-group">
                    <label for="name">Nom complet</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        id="name" 
                        name="name" 
                        value="<?= $data['name'] ?? ''; ?>"
                        placeholder="Votre nom"
                        required
                    >
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input 
                        type="email" 
                        class="form-control" 
                        id="email" 
                        name="email" 
                        value="<?= $data['email'] ?? ''; ?>"
                        placeholder="votre@email.com"
                        required
                    >
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="phone">Téléphone</label>
                    <input 
                        type="tel" 
                        class="form-control" 
                        id="phone" 
                        name="phone" 
                        value="<?= $data['phone'] ?? ''; ?>"
                        placeholder="06 12 34 56 78"
                    >
                </div>
                
                <div class="form-group">
                    <label for="subject">Sujet</label>
                    <select class="form-control" id="subject" name="subject">
                        <option value="">Choisir un sujet</option>
                        <option value="reservation" <?= (isset($data['subject']) && $data['subject'] === 'reservation') ? 'selected' : ''; ?>>Réservation</option>
                        <option value="information" <?= (isset($data['subject']) && $data['subject'] === 'information') ? 'selected' : ''; ?>>Demande d'information</option>
                        <option value="probleme" <?= (isset($data['subject']) && $data['subject'] === 'probleme') ? 'selected' : ''; ?>>Problème technique</option>
                        <option value="autre" <?= (isset($data['subject']) && $data['subject'] === 'autre') ? 'selected' : ''; ?>>Autre</option>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label for="message">Message</label>
                <textarea 
                    class="form-control" 
                    id="message" 
                    name="message" 
                    rows="5"
                    placeholder="Décrivez votre demande en détail..."
                    required
                ><?= $data['message'] ?? ''; ?></textarea>
            </div>
            
            <button type="submit" class="btn-submit">
                Envoyer le message
            </button>
        </form>

        <!-- Informations de contact -->
        <div class="contact-info">
            <div class="info-card">
                <h3>📍 Adresse</h3>
                <p>123 Avenue des Champs-Élysées<br>75008 Paris, France</p>
            </div>
            
            <div class="info-card">
                <h3>📞 Téléphone</h3>
                <p>+33 1 23 45 67 89<br>Lun-Sam: 9h-19h</p>
            </div>
            
            <div class="info-card">
                <h3>✉️ Email</h3>
                <p>contact@hsk-locations.fr<br>Réponse sous 24h</p>
            </div>
        </div>
    </div>