<!-- Hero Section Success -->
<section class="contact-hero" style="background: linear-gradient(135deg, #28a745, #34ce57);">
    <h1>✅ Message envoyé avec succès !</h1>
    <p>Merci pour votre message, nous vous recontacterons très rapidement.</p>
</section>

<div class="contact-container">
    <!-- Confirmation détaillée -->
    <div style="background: linear-gradient(145deg, #d4edda, #c3e6cb); border: 1px solid #c3e6cb; border-radius: 20px; padding: 40px; text-align: center; margin-bottom: 40px; position: relative; overflow: hidden;">
        
        <!-- Animation de confettis -->
        <div class="confetti" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; pointer-events: none;">
            <div class="confetti-piece" style="position: absolute; width: 10px; height: 10px; background: #28a745; animation: confetti-fall 3s linear infinite;"></div>
            <div class="confetti-piece" style="position: absolute; width: 8px; height: 8px; background: #ffc107; animation: confetti-fall 3s linear infinite 0.5s;"></div>
            <div class="confetti-piece" style="position: absolute; width: 6px; height: 6px; background: #007bff; animation: confetti-fall 3s linear infinite 1s;"></div>
        </div>

        <div style="position: relative; z-index: 2;">
            <div style="font-size: 4rem; margin-bottom: 20px; animation: bounce 1s ease-in-out;">🎉</div>
            
            <h2 style="color: #155724; font-size: 2rem; margin-bottom: 15px;">Parfait !</h2>
            
            <p style="color: #155724; font-size: 1.1rem; margin-bottom: 25px; max-width: 600px; margin-left: auto; margin-right: auto;">
                Votre message a été transmis à notre équipe. Nous nous engageons à vous répondre dans les plus brefs délais.
            </p>

            <?php if (isset($data['message_id'])): ?>
                <div style="background: rgba(21, 87, 36, 0.1); padding: 15px; border-radius: 10px; margin: 20px 0; display: inline-block;">
                    <strong style="color: #155724;">Numéro de référence :</strong> 
                    <code style="background: #155724; color: white; padding: 4px 8px; border-radius: 4px; font-weight: bold;">
                        #<?= str_pad($data['message_id'], 6, '0', STR_PAD_LEFT) ?>
                    </code>
                </div>
            <?php endif; ?>

            <div style="margin-top: 30px;">
                <h3 style="color: #155724; margin-bottom: 15px;">⏰ Que se passe-t-il maintenant ?</h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; max-width: 800px; margin: 0 auto;">
                    
                    <div style="background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                        <div style="font-size: 2rem; margin-bottom: 10px;">📧</div>
                        <h4 style="color: #155724; margin-bottom: 8px;">1. Confirmation email</h4>
                        <p style="color: #6c757d; font-size: 0.9rem;">Vous recevrez un email de confirmation sous quelques minutes</p>
                    </div>
                    
                    <div style="background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                        <div style="font-size: 2rem; margin-bottom: 10px;">👥</div>
                        <h4 style="color: #155724; margin-bottom: 8px;">2. Traitement</h4>
                        <p style="color: #6c757d; font-size: 0.9rem;">Notre équipe examine votre demande dans les 2 heures</p>
                    </div>
                    
                    <div style="background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                        <div style="font-size: 2rem; margin-bottom: 10px;">📞</div>
                        <h4 style="color: #155724; margin-bottom: 8px;">3. Réponse</h4>
                        <p style="color: #6c757d; font-size: 0.9rem;">Nous vous recontactons sous 24h maximum</p>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Actions rapides -->
    <div style="text-align: center; margin-bottom: 40px;">
        <h3 style="color: var(--primary-dark); margin-bottom: 20px;">En attendant notre réponse...</h3>
        
        <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
            <a href="/catalog" style="background: linear-gradient(135deg, var(--primary-dark), #e2c462); color: white; padding: 15px 30px; border-radius: 25px; text-decoration: none; font-weight: 600; transition: all 0.3s ease; box-shadow: 0 8px 25px rgba(197, 160, 39, 0.3);">
                🚗 Découvrir nos véhicules
            </a>
            
            <a href="/" style="background: rgba(255,255,255,0.1); color: var(--text-light); padding: 15px 30px; border-radius: 25px; text-decoration: none; font-weight: 600; transition: all 0.3s ease; backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2);">
                🏠 Retour à l'accueil
            </a>
            
            <a href="/contact" style="background: transparent; color: var(--primary-dark); padding: 15px 30px; border-radius: 25px; text-decoration: none; font-weight: 600; transition: all 0.3s ease; border: 2px solid var(--primary-dark);">
                📝 Nouveau message
            </a>
        </div>
    </div>

    <!-- Contact d'urgence -->
    <div style="background: linear-gradient(145deg, #1a1a1a, #0f0f0f); border-radius: 15px; padding: 30px; text-align: center; border: 1px solid rgba(197, 160, 39, 0.2);">
        <h3 style="color: var(--primary-dark); margin-bottom: 15px;">🚨 Besoin urgent ?</h3>
        <p style="color: #cacaca; margin-bottom: 20px;">
            Pour les demandes urgentes, n'hésitez pas à nous appeler directement
        </p>
        <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
            <a href="tel:+33123456789" style="background: #28a745; color: white; padding: 12px 20px; border-radius: 20px; text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 8px;">
                📞 +33 1 23 45 67 89
            </a>
            <a href="mailto:contact@hsk-locations.fr" style="background: #007bff; color: white; padding: 12px 20px; border-radius: 20px; text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 8px;">
                ✉️ contact@hsk-locations.fr
            </a>
        </div>
    </div>
</div>

<!-- CSS pour les animations -->
<style>
    @keyframes bounce {
        0%, 20%, 60%, 100% {
            transform: translateY(0);
        }
        40% {
            transform: translateY(-30px);
        }
        80% {
            transform: translateY(-15px);
        }
    }
    
    @keyframes confetti-fall {
        0% {
            transform: translateY(-100vh) rotate(0deg);
            opacity: 1;
        }
        100% {
            transform: translateY(100vh) rotate(720deg);
            opacity: 0;
        }
    }
    
    .confetti-piece:nth-child(1) {
        left: 10%;
        animation-delay: 0s;
    }
    
    .confetti-piece:nth-child(2) {
        left: 30%;
        animation-delay: 0.5s;
    }
    
    .confetti-piece:nth-child(3) {
        left: 50%;
        animation-delay: 1s;
    }
    
    .confetti-piece:nth-child(4) {
        left: 70%;
        animation-delay: 1.5s;
    }
    
    .confetti-piece:nth-child(5) {
        left: 90%;
        animation-delay: 2s;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .contact-hero h1 {
            font-size: 2rem;
        }
        
        .contact-container > div:first-child {
            padding: 25px;
        }
        
        .contact-container div[style*="display: flex"] {
            flex-direction: column;
            align-items: center;
        }
    }
</style>

<!-- JavaScript pour redirection automatique (optionnel) -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Confettis supplémentaires dynamiques
    function createConfetti() {
        const colors = ['#28a745', '#ffc107', '#007bff', '#dc3545', '#6f42c1'];
        const confettiContainer = document.querySelector('.confetti');
        
        for (let i = 0; i < 15; i++) {
            const confetti = document.createElement('div');
            confetti.style.cssText = `
                position: absolute;
                width: ${Math.random() * 8 + 4}px;
                height: ${Math.random() * 8 + 4}px;
                background: ${colors[Math.floor(Math.random() * colors.length)]};
                left: ${Math.random() * 100}%;
                top: -10px;
                border-radius: 50%;
                animation: confetti-fall ${Math.random() * 2 + 2}s linear infinite;
                animation-delay: ${Math.random() * 3}s;
            `;
            confettiContainer.appendChild(confetti);
        }
        
        // Nettoyer après 5 secondes
        setTimeout(() => {
            confettiContainer.innerHTML = '';
        }, 5000);
    }
    
    // Lancer les confettis
    createConfetti();
    
    // Optionnel : Redirection automatique après 30 secondes
    // setTimeout(() => {
    //     if (confirm('Souhaitez-vous retourner à l\'accueil ?')) {
    //         window.location.href = '/';
    //     }
    // }, 30000);
    
    console.log('🎉 Message de succès affiché avec animations');
});
</script>