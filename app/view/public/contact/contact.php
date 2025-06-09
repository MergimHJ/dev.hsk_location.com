<!-- Hero Section -->
<section class="contact-hero">
    <h1>Contactez-nous</h1>
    <p>Une question sur nos véhicules ? Besoin d'informations pour votre réservation ? Notre équipe est à votre écoute.</p>
</section>

<div class="contact-container">
    <!-- Messages d'erreur généraux -->
    <?php if (isset($data['error'])): ?>
        <div class="alert alert-error" style="background: linear-gradient(135deg, #dc3545, #c82333); color: white; padding: 20px; border-radius: 12px; margin-bottom: 30px; box-shadow: 0 8px 25px rgba(220, 53, 69, 0.3); border-left: 4px solid #fff; animation: slideIn 0.5s ease-out;">
            <strong>❌ Erreur :</strong> <?= htmlspecialchars($data['error']) ?>
        </div>
    <?php endif; ?>

    <!-- Formulaire -->
    <form method="post" action="/contact/send" class="contact-form" novalidate>
        <!-- Champ honeypot anti-spam (caché) -->
        <input type="text" name="honeypot" style="display: none;" tabindex="-1" autocomplete="off">
        
        <div class="form-row">
            <div class="form-group">
                <label for="name">Nom complet *</label>
                <input 
                    type="text" 
                    class="form-control <?= isset($data['errors']['name']) ? 'error' : '' ?>" 
                    id="name" 
                    name="name" 
                    value="<?= htmlspecialchars($data['name'] ?? '') ?>"
                    placeholder="Votre nom"
                    required
                    maxlength="100"
                    autocomplete="name"
                    aria-describedby="<?= isset($data['errors']['name']) ? 'name-error' : '' ?>"
                >
                <?php if (isset($data['errors']['name'])): ?>
                    <div id="name-error" class="error-message" style="color: #dc3545; font-size: 0.85rem; margin-top: 5px;">
                        <?= htmlspecialchars($data['errors']['name']) ?>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <label for="email">Email *</label>
                <input 
                    type="email" 
                    class="form-control <?= isset($data['errors']['email']) ? 'error' : '' ?>" 
                    id="email" 
                    name="email" 
                    value="<?= htmlspecialchars($data['email'] ?? '') ?>"
                    placeholder="votre@email.com"
                    required
                    maxlength="255"
                    autocomplete="email"
                    aria-describedby="<?= isset($data['errors']['email']) ? 'email-error' : '' ?>"
                >
                <?php if (isset($data['errors']['email'])): ?>
                    <div id="email-error" class="error-message" style="color: #dc3545; font-size: 0.85rem; margin-top: 5px;">
                        <?= htmlspecialchars($data['errors']['email']) ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="phone">Téléphone</label>
                <input 
                    type="tel" 
                    class="form-control <?= isset($data['errors']['phone']) ? 'error' : '' ?>" 
                    id="phone" 
                    name="phone" 
                    value="<?= htmlspecialchars($data['phone'] ?? '') ?>"
                    placeholder="06 12 34 56 78"
                    maxlength="20"
                    autocomplete="tel"
                    aria-describedby="<?= isset($data['errors']['phone']) ? 'phone-error' : '' ?>"
                >
                <?php if (isset($data['errors']['phone'])): ?>
                    <div id="phone-error" class="error-message" style="color: #dc3545; font-size: 0.85rem; margin-top: 5px;">
                        <?= htmlspecialchars($data['errors']['phone']) ?>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <label for="subject">Sujet *</label>
                <select 
                    class="form-control <?= isset($data['errors']['subject']) ? 'error' : '' ?>" 
                    id="subject" 
                    name="subject" 
                    required
                    aria-describedby="<?= isset($data['errors']['subject']) ? 'subject-error' : '' ?>"
                >
                    <option value="">Choisir un sujet</option>
                    <option value="reservation" <?= (isset($data['subject']) && $data['subject'] === 'reservation') ? 'selected' : '' ?>>
                        🚗 Réservation
                    </option>
                    <option value="information" <?= (isset($data['subject']) && $data['subject'] === 'information') ? 'selected' : '' ?>>
                        ℹ️ Demande d'information
                    </option>
                    <option value="probleme" <?= (isset($data['subject']) && $data['subject'] === 'probleme') ? 'selected' : '' ?>>
                        ⚠️ Problème technique
                    </option>
                    <option value="autre" <?= (isset($data['subject']) && $data['subject'] === 'autre') ? 'selected' : '' ?>>
                        💬 Autre
                    </option>
                </select>
                <?php if (isset($data['errors']['subject'])): ?>
                    <div id="subject-error" class="error-message" style="color: #dc3545; font-size: 0.85rem; margin-top: 5px;">
                        <?= htmlspecialchars($data['errors']['subject']) ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="form-group">
            <label for="message">Message *</label>
            <textarea 
                class="form-control <?= isset($data['errors']['message']) ? 'error' : '' ?>" 
                id="message" 
                name="message" 
                rows="5"
                placeholder="Décrivez votre demande en détail... (minimum 10 caractères)"
                required
                minlength="10"
                maxlength="5000"
                aria-describedby="message-help <?= isset($data['errors']['message']) ? 'message-error' : '' ?>"
            ><?= htmlspecialchars($data['message'] ?? '') ?></textarea>
            <div id="message-help" style="font-size: 0.8rem; color: #666; margin-top: 5px;">
                <span id="char-count">0</span>/5000 caractères
            </div>
            <?php if (isset($data['errors']['message'])): ?>
                <div id="message-error" class="error-message" style="color: #dc3545; font-size: 0.85rem; margin-top: 5px;">
                    <?= htmlspecialchars($data['errors']['message']) ?>
                </div>
            <?php endif; ?>
        </div>
        
        <button type="submit" class="btn-submit" id="submit-btn">
            <span class="btn-text">Envoyer le message</span>
            <span class="btn-loading" style="display: none;">
                <span class="spinner"></span> Envoi en cours...
            </span>
        </button>
        
        <p style="font-size: 0.85rem; color: #666; margin-top: 15px; text-align: center;">
            * Champs obligatoires. Vos données sont protégées et ne seront utilisées que pour vous répondre.
        </p>
    </form>

    <!-- Informations de contact -->
    <div class="contact-info">
        <div class="info-card">
            <h3>📍 Adresse</h3>
            <p>123 Avenue des Champs-Élysées<br>75008 Paris, France</p>
        </div>
        
        <div class="info-card">
            <h3>📞 Téléphone</h3>
            <p><a href="tel:+33123456789" style="color: inherit; text-decoration: none;">+33 1 23 45 67 89</a><br>Lun-Sam: 9h-19h</p>
        </div>
        
        <div class="info-card">
            <h3>✉️ Email</h3>
            <p><a href="mailto:contact@hsk-locations.fr" style="color: inherit; text-decoration: none;">contact@hsk-locations.fr</a><br>Réponse sous 24h</p>
        </div>
    </div>
</div>

<!-- CSS pour les erreurs et améliorations -->
<style>
    .form-control.error {
        border-color: #dc3545 !important;
        box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1) !important;
    }
    
    .error-message {
        animation: slideDown 0.3s ease-out;
    }
    
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .spinner {
        display: inline-block;
        width: 16px;
        height: 16px;
        border: 2px solid rgba(255,255,255,0.3);
        border-radius: 50%;
        border-top-color: white;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
    
    #char-count {
        font-weight: 600;
    }
    
    .contact-form {
        position: relative;
    }
    
    .contact-form.submitting {
        pointer-events: none;
        opacity: 0.7;
    }
</style>

<!-- JavaScript pour les améliorations -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.contact-form');
    const messageTextarea = document.getElementById('message');
    const charCount = document.getElementById('char-count');
    const submitBtn = document.getElementById('submit-btn');
    const btnText = submitBtn.querySelector('.btn-text');
    const btnLoading = submitBtn.querySelector('.btn-loading');
    
    // Compteur de caractères
    function updateCharCount() {
        const count = messageTextarea.value.length;
        charCount.textContent = count;
        
        if (count > 4800) {
            charCount.style.color = '#dc3545';
        } else if (count > 4500) {
            charCount.style.color = '#ffc107';
        } else {
            charCount.style.color = '#666';
        }
    }
    
    messageTextarea.addEventListener('input', updateCharCount);
    updateCharCount(); // Initial count
    
    // Validation en temps réel
    const inputs = form.querySelectorAll('input, textarea, select');
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            validateField(this);
        });
        
        input.addEventListener('input', function() {
            // Supprimer les messages d'erreur lors de la frappe
            const errorDiv = this.parentNode.querySelector('.error-message');
            if (errorDiv && this.value.length > 0) {
                this.classList.remove('error');
            }
        });
    });
    
    function validateField(field) {
        const value = field.value.trim();
        let isValid = true;
        
        switch(field.name) {
            case 'name':
                isValid = value.length >= 2;
                break;
            case 'email':
                isValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
                break;
            case 'message':
                isValid = value.length >= 10;
                break;
            case 'subject':
                isValid = value !== '';
                break;
        }
        
        if (isValid) {
            field.classList.remove('error');
        }
    }
    
    // Gestion de la soumission
    form.addEventListener('submit', function(e) {
        // Animation de chargement
        form.classList.add('submitting');
        btnText.style.display = 'none';
        btnLoading.style.display = 'inline-flex';
        submitBtn.disabled = true;
    });
    
    // Auto-resize du textarea
    messageTextarea.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = this.scrollHeight + 'px';
    });
    
    console.log('🎯 Contact form enhanced with validation and UX improvements');
});
</script>