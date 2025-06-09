<!-- Hero Section avec statistiques -->
<section class="catalog-hero" style="background: linear-gradient(135deg, var(--primary-dark), #e2c462); padding: 80px 40px; text-align: center; position: relative; overflow: hidden;">
    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(45deg, transparent 25%, rgba(255,255,255,0.1) 50%, transparent 75%);"></div>
    <div style="position: relative; z-index: 2;">
        <h1 style="font-size: 3.5rem; color: white; margin-bottom: 20px; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">Notre Flotte Premium</h1>
        <p style="font-size: 1.3rem; color: white; opacity: 0.9; max-width: 800px; margin: 0 auto 40px;">
            Découvrez notre collection exclusive de <?= $data['stats']['total_cars'] ?? 0 ?> véhicules d'exception, 
            de <?= isset($data['stats']['min_price']) ? '€' . number_format($data['stats']['min_price']) : '€500' ?> 
            à <?= isset($data['stats']['max_price']) ? '€' . number_format($data['stats']['max_price']) : '€3000' ?> par jour.
        </p>
        
        <!-- Statistiques en ligne -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 20px; max-width: 600px; margin: 0 auto;">
            <div style="background: rgba(255,255,255,0.2); padding: 20px; border-radius: 15px; backdrop-filter: blur(10px);">
                <div style="font-size: 2rem; font-weight: 700; color: white;"><?= $data['stats']['total_cars'] ?? 0 ?></div>
                <div style="color: white; opacity: 0.9; font-size: 0.9rem;">Véhicules</div>
            </div>
            <div style="background: rgba(255,255,255,0.2); padding: 20px; border-radius: 15px; backdrop-filter: blur(10px);">
                <div style="font-size: 2rem; font-weight: 700; color: white;"><?= $data['stats']['brands'] ?? 0 ?></div>
                <div style="color: white; opacity: 0.9; font-size: 0.9rem;">Marques</div>
            </div>
            <div style="background: rgba(255,255,255,0.2); padding: 20px; border-radius: 15px; backdrop-filter: blur(10px);">
                <div style="font-size: 2rem; font-weight: 700; color: white;">24h</div>
                <div style="color: white; opacity: 0.9; font-size: 0.9rem;">Support</div>
            </div>
        </div>
    </div>
</section>

<!-- Filtres avancés -->
<section style="background: white; padding: 30px 40px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h3 style="color: var(--primary-dark); margin: 0;">Filtrer les véhicules</h3>
            <div id="results-count" style="color: #666; font-weight: 500;">
                <?= count($data['cars']) ?> véhicule(s) trouvé(s)
            </div>
        </div>
        
        <!-- Première ligne de filtres -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; align-items: end; margin-bottom: 20px;">
            <!-- Recherche par nom -->
            <div>
                <label style="display: block; margin-bottom: 5px; font-weight: 500; color: #333;">🔍 Rechercher</label>
                <input type="text" id="search-input" placeholder="Nom du véhicule..." style="width: 100%; padding: 10px; border: 2px solid #ddd; border-radius: 8px; transition: border-color 0.3s ease;">
            </div>
            
            <!-- Filtre carburant -->
            <div>
                <label style="display: block; margin-bottom: 5px; font-weight: 500; color: #333;">⛽ Carburant</label>
                <select id="fuel-filter" style="width: 100%; padding: 10px; border: 2px solid #ddd; border-radius: 8px;">
                    <option value="">Tous les carburants</option>
                    <?php foreach ($data['fuelTypes'] as $fuel): ?>
                        <option value="<?= strtolower($fuel) ?>"><?= ucfirst($fuel) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <!-- Filtre prix -->
            <div>
                <label style="display: block; margin-bottom: 5px; font-weight: 500; color: #333;">💰 Budget</label>
                <select id="price-filter" style="width: 100%; padding: 10px; border: 2px solid #ddd; border-radius: 8px;">
                    <option value="">Tous les prix</option>
                    <?php foreach ($data['priceRanges'] as $range): ?>
                        <option value="<?= $range['min'] ?>-<?= $range['max'] ?>"><?= $range['label'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <!-- Deuxième ligne de filtres -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; align-items: end;">
            <!-- Filtre catégorie -->
            <div>
                <label style="display: block; margin-bottom: 5px; font-weight: 500; color: #333;">🏷️ Catégorie</label>
                <select id="category-filter" style="width: 100%; padding: 10px; border: 2px solid #ddd; border-radius: 8px;">
                    <option value="">Toutes les catégories</option>
                    <?php foreach ($data['categories'] as $category): ?>
                        <option value="<?= $category['id'] ?>"><?= ucfirst($category['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Filtre thème -->
            <div>
                <label style="display: block; margin-bottom: 5px; font-weight: 500; color: #333;">🎯 Thème</label>
                <select id="theme-filter" style="width: 100%; padding: 10px; border: 2px solid #ddd; border-radius: 8px;">
                    <option value="">Tous les thèmes</option>
                    <?php foreach ($data['themes'] as $theme): ?>
                        <option value="<?= $theme['id'] ?>"><?= ucfirst($theme['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <!-- Tri -->
            <div>
                <label style="display: block; margin-bottom: 5px; font-weight: 500; color: #333;">📊 Trier par</label>
                <select id="sort-filter" style="width: 100%; padding: 10px; border: 2px solid #ddd; border-radius: 8px;">
                    <option value="default">Par défaut</option>
                    <option value="price-asc">Prix croissant</option>
                    <option value="price-desc">Prix décroissant</option>
                    <option value="name-asc">Nom A-Z</option>
                    <option value="year-desc">Plus récent</option>
                </select>
            </div>
            
            <!-- Reset -->
            <div>
                <button id="reset-filters" style="background: #6c757d; color: white; border: none; padding: 12px 20px; border-radius: 8px; cursor: pointer; transition: all 0.3s ease; width: 100%;">
                    🔄 Réinitialiser
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Section des véhicules -->
<section class="catalog" id="vehicles-grid">
    <?php if (!empty($data['cars'])): ?>
        <?php foreach ($data['cars'] as $car): ?>
            <article class="card" 
                     data-car-name="<?= strtolower($car['title']) ?>" 
                     data-fuel="<?= strtolower($car['fuel_type']) ?>" 
                     data-price="<?= $car['price'] ?>"
                     data-year="<?= $car['year'] ?>"
                     data-category="<?= $car['category_tag_id'] ?>"
                     data-theme="<?= $car['theme_tag_id'] ?>"
                     style="position: relative; opacity: 0; transform: translateY(30px); transition: all 0.6s ease;">

                
                <!-- Badge "Nouveau" -->
                <?php if (isset($car['created_at']) && (time() - strtotime($car['created_at'])) < 604800): ?>
                    <div style="position: absolute; top: 15px; left: 15px; z-index: 2;">
                        <span style="background: linear-gradient(135deg, #ff6b35, #f7931e); color: white; padding: 6px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 600; box-shadow: 0 2px 8px rgba(255, 107, 53, 0.3); animation: pulse 2s infinite;">
                            ✨ NOUVEAU
                        </span>
                    </div>
                <?php endif; ?>

                <!-- Badges catégorie et thème -->
                <div style="position: absolute; top: 15px; right: 15px; z-index: 2; display: flex; flex-direction: column; gap: 5px;">
                    <?php if (!empty($car['category_name'])): ?>
                        <span style="background: rgba(197, 160, 39, 0.9); color: white; padding: 4px 8px; border-radius: 12px; font-size: 0.7rem; font-weight: 600; backdrop-filter: blur(5px);">
                            <?= htmlspecialchars($car['category_name']) ?>
                        </span>
                    <?php endif; ?>
                    <?php if (!empty($car['theme_name'])): ?>
                        <span style="background: rgba(79, 172, 254, 0.9); color: white; padding: 4px 8px; border-radius: 12px; font-size: 0.7rem; font-weight: 600; backdrop-filter: blur(5px);">
                            <?= htmlspecialchars($car['theme_name']) ?>
                        </span>
                    <?php endif; ?>
                </div>
                
                <h2 class="car-title"><?= htmlspecialchars($car['title']) ?></h2>
                <img src="/assets/cars/<?= $car['slug'] ?>/<?= $car['image'] ?>" alt="<?= htmlspecialchars($car['title']) ?>" loading="lazy">
                
                <!-- Specs rapides améliorées -->
                <div class="car-specs" style="display: flex; gap: 8px; margin: 15px 0; flex-wrap: wrap; justify-content: center;">
                    <?php if (!empty($car['year'])): ?>
                        <span class="spec-badge" style="background: #f0f0f0; padding: 4px 10px; border-radius: 12px; font-size: 0.75rem; color: #666; transition: all 0.3s ease; cursor: pointer;" title="Année">
                            📅 <?= $car['year'] ?>
                        </span>
                    <?php endif; ?>
                    <?php if (!empty($car['fuel_type'])): ?>
                        <span class="spec-badge" style="background: #f0f0f0; padding: 4px 10px; border-radius: 12px; font-size: 0.75rem; color: #666; transition: all 0.3s ease; cursor: pointer;" title="Carburant">
                            ⛽ <?= ucfirst($car['fuel_type']) ?>
                        </span>
                    <?php endif; ?>
                    <?php if (!empty($car['seats'])): ?>
                        <span class="spec-badge" style="background: #f0f0f0; padding: 4px 10px; border-radius: 12px; font-size: 0.75rem; color: #666; transition: all 0.3s ease; cursor: pointer;" title="Places">
                            👥 <?= $car['seats'] ?> places
                        </span>
                    <?php endif; ?>
                    <?php if (!empty($car['horsepower'])): ?>
                        <span class="spec-badge" style="background: #f0f0f0; padding: 4px 10px; border-radius: 12px; font-size: 0.75rem; color: #666; transition: all 0.3s ease; cursor: pointer;" title="Puissance">
                            ⚡ <?= $car['horsepower'] ?> ch
                        </span>
                    <?php endif; ?>
                </div>
                
                <p class="car-description"><?= htmlspecialchars(substr($car['description'], 0, 120)) . (strlen($car['description']) > 120 ? '...' : '') ?></p>
                
                <!-- Prix amélioré -->
                <div style="margin: 20px 0; text-align: center;">
                    <?php if (!empty($car['price'])): ?>
                        <div style="font-size: 1.4rem; font-weight: 700; color: #28a745; margin-bottom: 8px;">
                            €<?= number_format($car['price']) ?><span style="font-size: 0.8rem; color: #666;">/jour</span>
                        </div>
                    <?php endif; ?>
                    <div style="font-size: 0.9rem; color: #dc3545;">
                        Caution: €<?= number_format($car['deposit']) ?>
                    </div>
                </div>
                
                <a href="/catalog/item/<?= $car['slug'] ?>" onclick="trackView('<?= $car['slug'] ?>')">
                    Découvrir ce véhicule
                </a>
            </article>
        <?php endforeach; ?>
    <?php else: ?>
        <div id="no-results" style="grid-column: 1 / -1; text-align: center; padding: 80px 40px; background: white; border-radius: 15px; margin: 40px;">
            <div style="font-size: 4rem; margin-bottom: 20px; opacity: 0.3;">🚗</div>
            <h3 style="color: var(--primary-dark); margin-bottom: 15px; font-size: 1.8rem;">Aucun véhicule trouvé</h3>
            <p style="color: #666; margin-bottom: 25px; font-size: 1.1rem;">Modifiez vos critères de recherche ou contactez-nous pour plus d'options.</p>
            <a href="/contact" style="background: var(--primary-dark); color: white; padding: 15px 30px; border-radius: 25px; text-decoration: none; font-weight: 600; display: inline-block; transition: all 0.3s ease;">
                Nous contacter
            </a>
        </div>
    <?php endif; ?>
</section>

<!-- Call to action -->
<section style="background: linear-gradient(135deg, var(--primary-light), #1a1a1a); padding: 60px 40px; text-align: center; margin: 40px 20px; border-radius: 20px;">
    <h2 style="font-size: 2.5rem; color: var(--primary-dark); margin-bottom: 15px;">Besoin d'aide pour choisir ?</h2>
    <p style="font-size: 1.2rem; color: #cacaca; margin-bottom: 30px; max-width: 600px; margin-left: auto; margin-right: auto;">
        Notre équipe d'experts est là pour vous conseiller et vous aider à trouver le véhicule parfait pour votre occasion.
    </p>
    <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
        <a href="/contact" style="background: linear-gradient(135deg, #ff6b35, #f7931e); color: white; padding: 18px 35px; border-radius: 50px; text-decoration: none; font-weight: 700; transition: all 0.3s ease; box-shadow: 0 8px 25px rgba(255, 107, 53, 0.3);">
            💬 Parler à un expert
        </a>
        <a href="tel:+33123456789" style="background: rgba(255,255,255,0.1); color: var(--text-light); padding: 18px 35px; border-radius: 50px; text-decoration: none; font-weight: 600; transition: all 0.3s ease; backdrop-filter: blur(10px);">
            📞 Appeler maintenant
        </a>
    </div>
</section>

<!-- CSS et JavaScript -->
<style>
    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .spec-badge:hover {
        background: var(--primary-dark) !important;
        color: white !important;
        transform: translateY(-1px);
        box-shadow: 0 3px 10px rgba(197, 160, 39, 0.3) !important;
    }
    
    #search-input:focus,
    #fuel-filter:focus,
    #price-filter:focus,
    #sort-filter:focus,
    #category-filter:focus,
    #theme-filter:focus {
        border-color: var(--primary-dark);
        box-shadow: 0 0 0 3px rgba(197, 160, 39, 0.1);
        outline: none;
    }
    
    #reset-filters:hover {
        background: #5a6268;
        transform: translateY(-1px);
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('🚗 Catalog HSK - Page chargée avec filtres avancés !');
    
    // Animation des cartes au scroll
    const cards = document.querySelectorAll('.card');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, index * 100);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    cards.forEach(card => observer.observe(card));
    
    // Système de filtrage amélioré
    const searchInput = document.getElementById('search-input');
    const fuelFilter = document.getElementById('fuel-filter');
    const priceFilter = document.getElementById('price-filter');
    const categoryFilter = document.getElementById('category-filter');
    const themeFilter = document.getElementById('theme-filter');
    const sortFilter = document.getElementById('sort-filter');
    const resetButton = document.getElementById('reset-filters');
    const resultsCount = document.getElementById('results-count');
    
    function updateResultsCount() {
        const visibleCards = document.querySelectorAll('.card:not([style*="display: none"])');
        resultsCount.textContent = `${visibleCards.length} véhicule(s) trouvé(s)`;
        
        // Animation du compteur
        resultsCount.style.transform = 'scale(1.1)';
        setTimeout(() => {
            resultsCount.style.transform = 'scale(1)';
        }, 200);
    }
    
    function filterCars() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedFuel = fuelFilter.value;
        const selectedPrice = priceFilter.value;
        const selectedCategory = categoryFilter.value;
        const selectedTheme = themeFilter.value;
        
        let visibleCount = 0;
        
        cards.forEach(card => {
            const carName = card.dataset.carName || '';
            const carFuel = card.dataset.fuel || '';
            const carPrice = parseInt(card.dataset.price) || 0;
            const carCategory = card.dataset.category || '';
            const carTheme = card.dataset.theme || '';
            
            let showCard = true;
            
            // Filtre recherche
            if (searchTerm && !carName.includes(searchTerm)) {
                showCard = false;
            }
            
            // Filtre carburant
            if (selectedFuel && carFuel !== selectedFuel) {
                showCard = false;
            }
            
            // Filtre prix
            if (selectedPrice) {
                const [minPrice, maxPrice] = selectedPrice.split('-').map(Number);
                if (carPrice < minPrice || carPrice > maxPrice) {
                    showCard = false;
                }
            }
            
            // Filtre catégorie
            if (selectedCategory && carCategory !== selectedCategory) {
                showCard = false;
            }
            
            // Filtre thème
            if (selectedTheme && carTheme !== selectedTheme) {
                showCard = false;
            }
            
            // Affichage/masquage avec animation
            if (showCard) {
                card.style.display = 'block';
                card.style.animation = 'fadeInUp 0.5s ease forwards';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });
        
        // Affichage du message "aucun résultat"
        const noResultsDiv = document.getElementById('no-results');
        if (visibleCount === 0 && !noResultsDiv) {
            const vehiclesGrid = document.getElementById('vehicles-grid');
            const noResultsHTML = `
                <div id="no-results-filter" style="grid-column: 1 / -1; text-align: center; padding: 60px 40px; background: white; border-radius: 15px; margin: 20px; border: 2px dashed #ddd;">
                    <div style="font-size: 3rem; margin-bottom: 15px; opacity: 0.5;">🔍</div>
                    <h3 style="color: var(--primary-dark); margin-bottom: 10px; font-size: 1.5rem;">Aucun véhicule ne correspond à vos critères</h3>
                    <p style="color: #666; margin-bottom: 20px;">Essayez de modifier vos filtres ou réinitialisez la recherche.</p>
                    <button onclick="document.getElementById('reset-filters').click()" style="background: var(--primary-dark); color: white; padding: 10px 20px; border: none; border-radius: 20px; cursor: pointer; font-weight: 600;">
                        🔄 Réinitialiser les filtres
                    </button>
                </div>
            `;
            vehiclesGrid.insertAdjacentHTML('beforeend', noResultsHTML);
        } else if (visibleCount > 0) {
            const existingNoResults = document.getElementById('no-results-filter');
            if (existingNoResults) {
                existingNoResults.remove();
            }
        }
        
        updateResultsCount();
    }
    
    function sortCars() {
        const sortValue = sortFilter.value;
        const cardsArray = Array.from(cards);
        const container = document.getElementById('vehicles-grid');
        
        cardsArray.sort((a, b) => {
            switch(sortValue) {
                case 'price-asc':
                    return parseInt(a.dataset.price) - parseInt(b.dataset.price);
                case 'price-desc':
                    return parseInt(b.dataset.price) - parseInt(a.dataset.price);
                case 'name-asc':
                    return a.dataset.carName.localeCompare(b.dataset.carName);
                case 'year-desc':
                    return parseInt(b.dataset.year) - parseInt(a.dataset.year);
                default:
                    return 0;
            }
        });
        
        cardsArray.forEach(card => container.appendChild(card));
    }
    
    // Event listeners
    searchInput.addEventListener('input', filterCars);
    fuelFilter.addEventListener('change', filterCars);
    priceFilter.addEventListener('change', filterCars);
    categoryFilter.addEventListener('change', filterCars);
    themeFilter.addEventListener('change', filterCars);
    sortFilter.addEventListener('change', () => {
        sortCars();
        filterCars();
    });
    
    resetButton.addEventListener('click', () => {
        // Reset tous les filtres
        searchInput.value = '';
        fuelFilter.value = '';
        priceFilter.value = '';
        categoryFilter.value = '';
        themeFilter.value = '';
        sortFilter.value = 'default';
        
        // Supprimer le message "aucun résultat" s'il existe
        const existingNoResults = document.getElementById('no-results-filter');
        if (existingNoResults) {
            existingNoResults.remove();
        }
        
        // Afficher toutes les cartes
        cards.forEach(card => {
            card.style.display = 'block';
            card.style.animation = 'fadeInUp 0.5s ease forwards';
        });
        
        updateResultsCount();
        
        // Animation du bouton reset
        resetButton.style.transform = 'rotate(360deg)';
        setTimeout(() => {
            resetButton.style.transform = 'rotate(0deg)';
        }, 300);
    });
    
    // Tracking des vues
    window.trackView = function(slug) {
        console.log(`🔍 Vue véhicule: ${slug}`);
        // Ici vous pouvez ajouter Google Analytics ou autre
    };
    
    // Initial count
    updateResultsCount();
    
    // Info sur les filtres actifs
    function showActiveFilters() {
        const activeFilters = [];
        if (searchInput.value) activeFilters.push(`Recherche: "${searchInput.value}"`);
        if (fuelFilter.value) activeFilters.push(`Carburant: ${fuelFilter.options[fuelFilter.selectedIndex].text}`);
        if (priceFilter.value) activeFilters.push(`Prix: ${priceFilter.options[priceFilter.selectedIndex].text}`);
        if (categoryFilter.value) activeFilters.push(`Catégorie: ${categoryFilter.options[categoryFilter.selectedIndex].text}`);
        if (themeFilter.value) activeFilters.push(`Thème: ${themeFilter.options[themeFilter.selectedIndex].text}`);
        
        if (activeFilters.length > 0) {
            console.log('🔍 Filtres actifs:', activeFilters.join(', '));
        }
    }
    
    // Logger les filtres actifs quand on filtre
    [searchInput, fuelFilter, priceFilter, categoryFilter, themeFilter].forEach(filter => {
        filter.addEventListener('change', showActiveFilters);
        filter.addEventListener('input', showActiveFilters);
    });
});
</script>