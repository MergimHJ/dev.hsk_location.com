<!-- Hero Section ÉPIQUE avec animation et parallax -->
<section class="hero-epic" style="height: 100vh; position: relative; overflow: hidden; display: flex; align-items: center; justify-content: center;">
    <!-- Background video ou image animée -->
    <div class="hero-bg" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 50%, #c5a027 100%); background-size: 400% 400%; animation: gradientShift 8s ease infinite;"></div>
    
    <!-- Particules flottantes -->
    <div class="particles" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none;">
        <div class="particle" style="position: absolute; width: 4px; height: 4px; background: #c5a027; border-radius: 50%; animation: float 6s ease-in-out infinite; top: 20%; left: 10%;"></div>
        <div class="particle" style="position: absolute; width: 3px; height: 3px; background: #e2c462; border-radius: 50%; animation: float 8s ease-in-out infinite; top: 60%; left: 80%; animation-delay: 2s;"></div>
        <div class="particle" style="position: absolute; width: 5px; height: 5px; background: #f5cc48; border-radius: 50%; animation: float 7s ease-in-out infinite; top: 40%; left: 60%; animation-delay: 4s;"></div>
    </div>
    
    <!-- Contenu hero -->
    <div style="position: relative; z-index: 10; text-align: center; max-width: 1000px; padding: 0 20px;">
        <div style="opacity: 0; transform: translateY(50px); animation: heroFadeIn 1.5s ease forwards;">
            <h1 style="font-size: 4.5rem; font-weight: 900; color: white; margin-bottom: 20px; text-shadow: 0 4px 20px rgba(0,0,0,0.5); line-height: 1.1;">
                L'EXCEPTION
                <span style="background: linear-gradient(135deg, #c5a027, #e2c462); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; display: block; font-size: 5rem; margin-top: 10px;">
                    À PORTÉE DE MAIN
                </span>
            </h1>
            
            <p style="font-size: 1.4rem; color: rgba(255,255,255,0.9); margin-bottom: 40px; max-width: 700px; margin-left: auto; margin-right: auto; opacity: 0; animation: heroFadeIn 1.5s ease forwards 0.5s;">
                Ferrari, Lamborghini, Porsche... Vivez l'émotion pure avec notre collection exclusive de supercars. 
                <strong style="color: #c5a027;">Votre rêve vous attend.</strong>
            </p>
            
            <!-- Stats impressionnantes -->
            <div style="display: flex; gap: 40px; justify-content: center; margin: 40px 0; flex-wrap: wrap; opacity: 0; animation: heroFadeIn 1.5s ease forwards 1s;">
                <div style="text-align: center;">
                    <div style="font-size: 3rem; font-weight: 900; color: #c5a027; margin-bottom: 5px;" data-count="<?= $data['stats']['total_cars'] ?? 27 ?>">0</div>
                    <div style="color: rgba(255,255,255,0.8); font-weight: 500;">Supercars</div>
                </div>
                <div style="text-align: center;">
                    <div style="font-size: 3rem; font-weight: 900; color: #c5a027; margin-bottom: 5px;" data-count="15">0</div>
                    <div style="color: rgba(255,255,255,0.8); font-weight: 500;">Marques Premium</div>
                </div>
                <div style="text-align: center;">
                    <div style="font-size: 3rem; font-weight: 900; color: #c5a027; margin-bottom: 5px;" data-count="24">0</div>
                    <div style="color: rgba(255,255,255,0.8); font-weight: 500;">Heures Support</div>
                </div>
            </div>
            
            <!-- CTA Buttons -->
            <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap; opacity: 0; animation: heroFadeIn 1.5s ease forwards 1.5s;">
                <a href="/catalog" style="background: linear-gradient(135deg, #c5a027, #e2c462); color: white; padding: 18px 40px; border-radius: 50px; text-decoration: none; font-weight: 700; font-size: 1.1rem; box-shadow: 0 10px 30px rgba(197,160,39,0.4); transition: all 0.3s ease; text-transform: uppercase; letter-spacing: 1px;">
                    🏎️ Découvrir la Flotte
                </a>
                <a href="/contact" style="background: rgba(255,255,255,0.1); color: white; padding: 18px 40px; border-radius: 50px; text-decoration: none; font-weight: 600; font-size: 1.1rem; backdrop-filter: blur(10px); border: 2px solid rgba(255,255,255,0.3); transition: all 0.3s ease;">
                    💬 Réserver Maintenant
                </a>
            </div>
        </div>
    </div>
    
    <!-- Scroll indicator -->
    <div style="position: absolute; bottom: 30px; left: 50%; transform: translateX(-50%); color: white; opacity: 0.7; animation: bounce 2s infinite;">
        <div style="text-align: center;">
            <div style="margin-bottom: 10px; font-size: 0.9rem;">Découvrez plus</div>
            <div style="font-size: 1.5rem;">⬇️</div>
        </div>
    </div>
</section>

<!-- Section marques prestigieuses -->
<section style="background: #f8f9fa; padding: 80px 20px; text-align: center;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <h2 style="font-size: 2.5rem; color: #1a1a1a; margin-bottom: 20px; font-weight: 700;">Les Marques les Plus Prestigieuses</h2>
        <p style="font-size: 1.2rem; color: #666; margin-bottom: 50px;">Nous collaborons avec les constructeurs les plus exclusifs au monde</p>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 30px; align-items: center;">
            <div style="padding: 20px; transition: transform 0.3s ease; cursor: pointer;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                <div style="font-size: 2rem; font-weight: 900; color: #c5a027;">FERRARI</div>
            </div>
            <div style="padding: 20px; transition: transform 0.3s ease; cursor: pointer;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                <div style="font-size: 2rem; font-weight: 900; color: #c5a027;">LAMBORGHINI</div>
            </div>
            <div style="padding: 20px; transition: transform 0.3s ease; cursor: pointer;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                <div style="font-size: 2rem; font-weight: 900; color: #c5a027;">PORSCHE</div>
            </div>
            <div style="padding: 20px; transition: transform 0.3s ease; cursor: pointer;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                <div style="font-size: 2rem; font-weight: 900; color: #c5a027;">MCLAREN</div>
            </div>
            <div style="padding: 20px; transition: transform 0.3s ease; cursor: pointer;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                <div style="font-size: 2rem; font-weight: 900; color: #c5a027;">BENTLEY</div>
            </div>
        </div>
    </div>
</section>

<!-- Section véhicules star avec layout dynamique -->
<section style="background: linear-gradient(135deg, #0a0a0a, #1a1a1a); padding: 100px 20px; position: relative; overflow: hidden;">
    <!-- Background pattern -->
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: radial-gradient(circle at 25% 25%, rgba(197,160,39,0.1) 0%, transparent 50%), radial-gradient(circle at 75% 75%, rgba(197,160,39,0.05) 0%, transparent 50%); pointer-events: none;"></div>
    
    <div style="max-width: 1400px; margin: 0 auto; position: relative; z-index: 2;">
        <div style="text-align: center; margin-bottom: 60px;">
            <h2 style="font-size: 3.5rem; color: white; margin-bottom: 20px; font-weight: 900;">
                Nos <span style="color: #c5a027;">Supercars</span> d'Exception
            </h2>
            <p style="font-size: 1.3rem; color: rgba(255,255,255,0.8); max-width: 600px; margin: 0 auto;">
                Chaque véhicule est méticuleusement sélectionné pour vous offrir l'expérience ultime
            </p>
        </div>

        <!-- Grille véhicules avec effet wow -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 30px;">
            <?php foreach ($data['cars'] as $index => $car): ?>
                <article class="supercar-card" style="background: linear-gradient(145deg, #1a1a1a, #0f0f0f); border-radius: 20px; overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,0.3); transition: all 0.5s ease; position: relative; border: 1px solid rgba(197,160,39,0.2); opacity: 0; transform: translateY(50px); animation: cardReveal 0.8s ease forwards; animation-delay: <?= $index * 0.2 ?>s;">
                    
                    <!-- Badge premium -->
                    <div style="position: absolute; top: 20px; right: 20px; z-index: 3;">
                        <span style="background: linear-gradient(135deg, #c5a027, #e2c462); color: white; padding: 8px 16px; border-radius: 20px; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; box-shadow: 0 4px 15px rgba(197,160,39,0.4);">
                            Premium
                        </span>
                    </div>
                    
                    <!-- Image avec overlay -->
                    <div style="position: relative; height: 250px; overflow: hidden;">
                        <img src="/assets/cars/<?= $car['slug'] ?>/<?= $car['image'] ?>" alt="<?= htmlspecialchars($car['title']) ?>" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;">
                        <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(transparent 60%, rgba(0,0,0,0.8)); pointer-events: none;"></div>
                        
                        <!-- Titre sur image -->
                        <div style="position: absolute; bottom: 20px; left: 20px; right: 20px;">
                            <h3 style="color: white; font-size: 1.5rem; font-weight: 700; margin-bottom: 5px; text-shadow: 0 2px 10px rgba(0,0,0,0.7);">
                                <?= htmlspecialchars($car['title']) ?>
                            </h3>
                            <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                                <?php if (!empty($car['year'])): ?>
                                    <span style="background: rgba(197,160,39,0.9); color: white; padding: 4px 8px; border-radius: 10px; font-size: 0.7rem; font-weight: 600;">
                                        <?= $car['year'] ?>
                                    </span>
                                <?php endif; ?>
                                <?php if (!empty($car['horsepower'])): ?>
                                    <span style="background: rgba(255,255,255,0.2); color: white; padding: 4px 8px; border-radius: 10px; font-size: 0.7rem; font-weight: 600; backdrop-filter: blur(5px);">
                                        <?= $car['horsepower'] ?> ch
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Contenu carte -->
                    <div style="padding: 25px;">
                        <p style="color: rgba(255,255,255,0.8); margin-bottom: 20px; line-height: 1.6;">
                            <?= htmlspecialchars(substr($car['description'], 0, 100)) ?>...
                        </p>
                        
                        <!-- Prix et CTA -->
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div>
                                <div style="font-size: 1.8rem; font-weight: 900; color: #c5a027; margin-bottom: 5px;">
                                    €<?= number_format($car['price'] ?? 500) ?><span style="font-size: 0.9rem; color: rgba(255,255,255,0.6);">/jour</span>
                                </div>
                                <div style="font-size: 0.9rem; color: rgba(255,255,255,0.5);">
                                    Caution: €<?= number_format($car['deposit'] ?? 2000) ?>
                                </div>
                            </div>
                            <a href="/catalog/item/<?= $car['slug'] ?>" style="background: linear-gradient(135deg, #df422d, #c13219); color: white; padding: 12px 20px; border-radius: 25px; text-decoration: none; font-weight: 600; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(223,66,45,0.3);">
                                Découvrir
                            </a>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
        
        <!-- CTA vers le catalog -->
        <div style="text-align: center; margin-top: 60px;">
            <a href="/catalog" style="background: linear-gradient(135deg, #c5a027, #e2c462); color: white; padding: 20px 50px; border-radius: 50px; text-decoration: none; font-weight: 700; font-size: 1.2rem; box-shadow: 0 15px 40px rgba(197,160,39,0.4); transition: all 0.3s ease; display: inline-block;">
                Voir Toute la Collection →
            </a>
        </div>
    </div>
</section>

<!-- Section expérience client -->
<section style="background: linear-gradient(135deg, #c5a027, #e2c462); padding: 100px 20px; text-align: center; position: relative; overflow: hidden;">
    <!-- Pattern background -->
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(255,255,255,0.05) 10px, rgba(255,255,255,0.05) 20px); pointer-events: none;"></div>
    
    <div style="max-width: 1200px; margin: 0 auto; position: relative; z-index: 2;">
        <h2 style="font-size: 3rem; color: white; margin-bottom: 20px; font-weight: 900; text-shadow: 0 4px 20px rgba(0,0,0,0.3);">
            L'Excellence à Chaque Instant
        </h2>
        <p style="font-size: 1.3rem; color: rgba(255,255,255,0.9); margin-bottom: 60px; max-width: 700px; margin-left: auto; margin-right: auto;">
            Notre service premium vous accompagne de la réservation au retour du véhicule
        </p>
        
        <!-- Services grid -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 40px; margin-bottom: 60px;">
            <div style="background: rgba(255,255,255,0.1); padding: 40px 30px; border-radius: 20px; backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2);">
                <div style="font-size: 3rem; margin-bottom: 20px;">🏆</div>
                <h3 style="color: white; font-size: 1.4rem; margin-bottom: 15px; font-weight: 700;">Service Concierge</h3>
                <p style="color: rgba(255,255,255,0.8); line-height: 1.6;">Livraison et récupération à domicile ou sur votre lieu de choix</p>
            </div>
            
            <div style="background: rgba(255,255,255,0.1); padding: 40px 30px; border-radius: 20px; backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2);">
                <div style="font-size: 3rem; margin-bottom: 20px;">⚡</div>
                <h3 style="color: white; font-size: 1.4rem; margin-bottom: 15px; font-weight: 700;">Réservation Express</h3>
                <p style="color: rgba(255,255,255,0.8); line-height: 1.6;">Confirmation instantanée et prise en charge immédiate</p>
            </div>
            
            <div style="background: rgba(255,255,255,0.1); padding: 40px 30px; border-radius: 20px; backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2);">
                <div style="font-size: 3rem; margin-bottom: 20px;">🛡️</div>
                <h3 style="color: white; font-size: 1.4rem; margin-bottom: 15px; font-weight: 700;">Assurance Premium</h3>
                <p style="color: rgba(255,255,255,0.8); line-height: 1.6;">Couverture complète pour une sérénité absolue</p>
            </div>
        </div>
        
        <!-- Témoignages -->
        <div style="background: rgba(255,255,255,0.1); padding: 40px; border-radius: 20px; backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2);">
            <h3 style="color: white; font-size: 1.8rem; margin-bottom: 30px; font-weight: 700;">Ils Nous Font Confiance</h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px;">
                <div style="text-align: center;">
                    <div style="font-size: 1.1rem; color: rgba(255,255,255,0.9); margin-bottom: 15px; font-style: italic;">
                        "Une expérience absolument magique ! Service impeccable."
                    </div>
                    <div style="color: rgba(255,255,255,0.7); font-weight: 600;">
                        ⭐⭐⭐⭐⭐ - Alexandre M.
                    </div>
                </div>
                <div style="text-align: center;">
                    <div style="font-size: 1.1rem; color: rgba(255,255,255,0.9); margin-bottom: 15px; font-style: italic;">
                        "La Ferrari de mes rêves pour mon mariage. Parfait !"
                    </div>
                    <div style="color: rgba(255,255,255,0.7); font-weight: 600;">
                        ⭐⭐⭐⭐⭐ - Sophie L.
                    </div>
                </div>
                <div style="text-align: center;">
                    <div style="font-size: 1.1rem; color: rgba(255,255,255,0.9); margin-bottom: 15px; font-style: italic;">
                        "Professionnalisme et passion. Je recommande vivement !"
                    </div>
                    <div style="color: rgba(255,255,255,0.7); font-weight: 600;">
                        ⭐⭐⭐⭐⭐ - Thomas R.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action Final -->
<section style="background: linear-gradient(135deg, #0a0a0a, #1a1a1a); padding: 100px 20px; text-align: center; position: relative;">
    <div style="max-width: 800px; margin: 0 auto;">
        <h2 style="font-size: 3.5rem; color: white; margin-bottom: 30px; font-weight: 900;">
            Prêt pour l'<span style="color: #c5a027;">Aventure</span> ?
        </h2>
        <p style="font-size: 1.4rem; color: rgba(255,255,255,0.8); margin-bottom: 50px;">
            Votre supercar vous attend. Une simple réservation suffit pour transformer votre journée en légende.
        </p>
        
        <div style="display: flex; gap: 25px; justify-content: center; flex-wrap: wrap;">
            <a href="/catalog" style="background: linear-gradient(135deg, #c5a027, #e2c462); color: white; padding: 20px 40px; border-radius: 50px; text-decoration: none; font-weight: 700; font-size: 1.2rem; box-shadow: 0 15px 40px rgba(197,160,39,0.4); transition: all 0.3s ease;">
                🏎️ Choisir ma Supercar
            </a>
            <a href="/contact" style="background: rgba(255,255,255,0.1); color: white; padding: 20px 40px; border-radius: 50px; text-decoration: none; font-weight: 600; font-size: 1.2rem; backdrop-filter: blur(10px); border: 2px solid rgba(255,255,255,0.3); transition: all 0.3s ease;">
                💬 Parler à un Expert
            </a>
        </div>
        
        <div style="margin-top: 40px; color: rgba(255,255,255,0.6); font-size: 1rem;">
            📞 <a href="tel:+33123456789" style="color: #c5a027; text-decoration: none;">+33 1 23 45 67 89</a> • 
            ✉️ <a href="mailto:contact@hsk-locations.fr" style="color: #c5a027; text-decoration: none;">contact@hsk-locations.fr</a>
        </div>
    </div>
</section>

<!-- CSS Animations -->
<style>
@keyframes gradientShift {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

@keyframes heroFadeIn {
    from {
        opacity: 0;
        transform: translateY(50px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes float {
    0%, 100% { transform: translateY(0) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(180deg); }
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% { transform: translateX(-50%) translateY(0); }
    40% { transform: translateX(-50%) translateY(-10px); }
    60% { transform: translateX(-50%) translateY(-5px); }
}

@keyframes cardReveal {
    from {
        opacity: 0;
        transform: translateY(50px) scale(0.95);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

/* Hover effects */
.supercar-card:hover {
    transform: translateY(-10px) scale(1.02) !important;
    box-shadow: 0 30px 80px rgba(197,160,39,0.3) !important;
}

.supercar-card:hover img {
    transform: scale(1.1) !important;
}

/* Boutons hover */
a[href="/catalog"]:hover,
a[href="/contact"]:hover {
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 20px 50px rgba(197,160,39,0.5);
}

/* Responsive */
@media (max-width: 768px) {
    .hero-epic h1 {
        font-size: 2.5rem !important;
    }
    
    .hero-epic h1 span {
        font-size: 3rem !important;
    }
    
    .hero-epic p {
        font-size: 1.1rem !important;
    }
    
    .hero-epic > div > div:nth-child(3) {
        flex-direction: column !important;
        gap: 20px !important;
    }
    
    .hero-epic > div > div:nth-child(3) > div {
        font-size: 2rem !important;
    }
}
</style>

<!-- JavaScript pour animations et effets -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('🚗 HSK Home - Version ÉPIQUE chargée !');
    
    // Animation compteurs
    function animateCounters() {
        const counters = document.querySelectorAll('[data-count]');
        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-count'));
            const duration = 2000;
            const step = target / (duration / 16);
            let current = 0;
            
            const timer = setInterval(() => {
                current += step;
                if (current >= target) {
                    counter.textContent = target;
                    clearInterval(timer);
                } else {
                    counter.textContent = Math.floor(current);
                }
            }, 16);
        });
    }
    
    // Lancer les compteurs après 1.5s
    setTimeout(animateCounters, 1500);
    
    // Parallax sur le scroll
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const parallax = document.querySelector('.hero-bg');
        const particles = document.querySelectorAll('.particle');
        
        if (parallax) {
            parallax.style.transform = `translateY(${scrolled * 0.5}px)`;
        }
        
        particles.forEach((particle, index) => {
            particle.style.transform = `translateY(${scrolled * (0.2 + index * 0.1)}px)`;
        });
    });
    
    // Effet de typing sur le titre (optionnel)
    const heroTitle = document.querySelector('.hero-epic h1');
    if (heroTitle) {
        const text = heroTitle.innerHTML;
        heroTitle.innerHTML = '';
        let i = 0;
        
        setTimeout(() => {
            const typeInterval = setInterval(() => {
                heroTitle.innerHTML = text.substring(0, i);
                i++;
                if (i > text.length) {
                    clearInterval(typeInterval);
                }
            }, 50);
        }, 500);
    }
    
    // Animation des cartes au scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });