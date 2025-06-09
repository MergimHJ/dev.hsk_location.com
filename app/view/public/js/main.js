// HSK Locations - JavaScript subtil et élégant
// À ajouter dans un fichier js/main.js ou en bas de votre template

document.addEventListener('DOMContentLoaded', function() {
    console.log('🚗 HSK Locations chargé');

    // 1. Smooth scroll pour les liens de navigation
    function initSmoothScroll() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    }

    // 2. Animation des cartes au scroll (fade in)
    function initScrollAnimations() {
        const cards = document.querySelectorAll('.card');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '0';
                    entry.target.style.transform = 'translateY(20px)';
                    entry.target.style.transition = 'all 0.6s ease';
                    
                    setTimeout(() => {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }, 100);
                    
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        cards.forEach(card => {
            observer.observe(card);
        });
    }

    // 3. Navbar qui change de style au scroll
    function initNavbarScroll() {
        const navbar = document.querySelector('.navbar');
        let lastScrollY = window.scrollY;

        window.addEventListener('scroll', () => {
            const currentScrollY = window.scrollY;
            
            if (currentScrollY > 100) {
                navbar.style.background = 'rgba(197, 160, 39, 0.95)';
                navbar.style.backdropFilter = 'blur(10px)';
                navbar.style.boxShadow = '0 2px 20px rgba(0,0,0,0.1)';
            } else {
                navbar.style.background = '';
                navbar.style.backdropFilter = '';
                navbar.style.boxShadow = '';
            }
            
            lastScrollY = currentScrollY;
        });
    }

    // 4. Amélioration des hovers sur les cartes
    function initCardHovers() {
        document.querySelectorAll('.card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-8px)';
                this.style.boxShadow = '0 15px 35px rgba(197, 160, 39, 0.2)';
                this.style.transition = 'all 0.3s ease';
                
                const img = this.querySelector('img');
                if (img) {
                    img.style.transform = 'scale(1.05)';
                    img.style.transition = 'transform 0.3s ease';
                }
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = '';
                
                const img = this.querySelector('img');
                if (img) {
                    img.style.transform = 'scale(1)';
                }
            });
        });
    }

    // 5. Bouton "retour en haut" simple
    function initScrollToTop() {
        // Créer le bouton
        const scrollBtn = document.createElement('button');
        scrollBtn.innerHTML = '↑';
        scrollBtn.style.cssText = `
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background: var(--primary-dark);
            color: white;
            border: none;
            border-radius: 50%;
            font-size: 1.2rem;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 1000;
            box-shadow: 0 4px 15px rgba(197, 160, 39, 0.3);
        `;

        document.body.appendChild(scrollBtn);

        // Afficher/masquer selon le scroll
        window.addEventListener('scroll', () => {
            if (window.scrollY > 400) {
                scrollBtn.style.opacity = '1';
                scrollBtn.style.visibility = 'visible';
            } else {
                scrollBtn.style.opacity = '0';
                scrollBtn.style.visibility = 'hidden';
            }
        });

        // Action du bouton
        scrollBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Hover effect
        scrollBtn.addEventListener('mouseenter', () => {
            scrollBtn.style.transform = 'translateY(-3px)';
            scrollBtn.style.boxShadow = '0 8px 25px rgba(197, 160, 39, 0.4)';
        });

        scrollBtn.addEventListener('mouseleave', () => {
            scrollBtn.style.transform = 'translateY(0)';
            scrollBtn.style.boxShadow = '0 4px 15px rgba(197, 160, 39, 0.3)';
        });
    }

    // 6. Loading simple pour les images
    function initLazyLoading() {
        const images = document.querySelectorAll('img');
        
        images.forEach(img => {
            img.addEventListener('load', function() {
                this.style.opacity = '0';
                this.style.transition = 'opacity 0.3s ease';
                setTimeout(() => {
                    this.style.opacity = '1';
                }, 50);
            });
        });
    }

    // 7. Amélioration du formulaire de contact (si présent)
    function initContactForm() {
        const contactForm = document.querySelector('form[action*="contact"], form[method*="post"]');
        
        if (contactForm) {
            const inputs = contactForm.querySelectorAll('input, textarea, select');
            
            inputs.forEach(input => {
                // Focus effect
                input.addEventListener('focus', function() {
                    this.style.borderColor = 'var(--primary-dark)';
                    this.style.boxShadow = '0 0 0 3px rgba(197, 160, 39, 0.1)';
                });

                input.addEventListener('blur', function() {
                    this.style.borderColor = '';
                    this.style.boxShadow = '';
                });

                // Validation simple
                input.addEventListener('input', function() {
                    if (this.checkValidity()) {
                        this.style.borderColor = '#28a745';
                    } else if (this.value.length > 0) {
                        this.style.borderColor = '#dc3545';
                    }
                });
            });
        }
    }

    // 8. Petite animation sur le logo HSK
    function initLogoAnimation() {
        const logo = document.querySelector('.logo-text');
        
        if (logo) {
            logo.addEventListener('click', function() {
                this.style.transform = 'scale(1.1) rotate(5deg)';
                this.style.transition = 'transform 0.2s ease';
                
                setTimeout(() => {
                    this.style.transform = 'scale(1) rotate(0deg)';
                }, 200);
            });
        }
    }

    // 9. Préchargement des images au hover
    function initImagePreloading() {
        document.querySelectorAll('.card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                const img = this.querySelector('img');
                if (img && img.dataset.hover) {
                    const hoverImg = new Image();
                    hoverImg.src = img.dataset.hover;
                }
            });
        });
    }

    // 10. Gestion des erreurs d'images
    function initImageErrorHandling() {
        document.querySelectorAll('img').forEach(img => {
            img.addEventListener('error', function() {
                this.style.background = 'linear-gradient(45deg, #f0f0f0, #e0e0e0)';
                this.style.display = 'flex';
                this.style.alignItems = 'center';
                this.style.justifyContent = 'center';
                this.innerHTML = '<span style="color: #999;">Image non disponible</span>';
            });
        });
    }

    // Initialiser toutes les fonctions
    initSmoothScroll();
    initScrollAnimations();
    initNavbarScroll();
    initCardHovers();
    initScrollToTop();
    initLazyLoading();
    initContactForm();
    initLogoAnimation();
    initImagePreloading();
    initImageErrorHandling();

    console.log('✅ Toutes les améliorations JS chargées');
});

