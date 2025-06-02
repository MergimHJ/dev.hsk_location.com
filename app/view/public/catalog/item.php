<!-- <section class="presentation-item">
    <h2>Fiche technique de la <?= $data['car']['title'];?></h2>
        
            
            <img src="/assets/cars/<?= $data['car']['slug'] . '/' . $data['car']['image'];?>" alt="Logo" />
            <p><?= $data['car']['description'];?></p>
            <p><?= $data['car']['content'];?></p>
            <p>Prix: <?= $data['car']['price'];?>€</p>
            <p>Carburant: <?= $data['car']['fuel_type'];?></p>
            <p>Boite: <?= $data['car']['transmission'];?></p>
            <p>Puissance: <?= $data['car']['horsepower'];?></p>
            <p>Vitesse: <?= $data['car']['top_speed'];?></p>
            <p>0-100: <?= $data['car']['acceleration'];?></p>
            <p>Nombre de roues motrices: <?= $data['car']['wheel-transmission'];?></p>
            <p>Places: <?= $data['car']['seats'];?></p>
            <p>Année: <?= $data['car']['year'];?></p>
            <p>Marque: <?= $data['car']['title'];?></p>
            <p>Modèle: <?= $data['car']['model'];?></p>
            <p>Carrosserie: <?= $data['car']['carrosserie'];?></p>
            <p>Nombre de portes: <?= $data['car']['doors'];?></p>
            <p>Nombre de places: <?= $data['car']['seats'];?></p>
            <p>Nombre de cylindres: <?= $data['car']['cylinders'];?></p>
            <p>Caution: <?= $data['car']['deposit'];?></p>
            <p>Stock: <?= $data['car']['stock'];?></p>
            <a href="contact.html">Réserver</a>
</section> -->

<!-- <section class="presentation-item">
    <h2>Fiche technique de la <?= $data['car']['title'];?></h2>
</section>     --> 

 <!-- Hero avec image principale -->
    <section class="item-car-hero">
        <img src="/assets/cars/<?= $data['car']['slug'] . '/' . $data['car']['image'];?>" alt="<?= $data['car']['title'];?>" />
        <div class="item-car-title-overlay">
            <h1><?= $data['car']['title'];?></h1>
            <p class="item-car-subtitle"><?= $data['car']['model'];?> • <?= $data['car']['year'];?></p>
        </div>
    </section>

    <div class="item-car-detail-container">
        <!-- Section principale -->
        <div class="item-car-content">
            <!-- Description -->
            <div class="item-car-description">
                <h2>À propos de cette voiture</h2>
                <p><?= $data['car']['description'];?></p>
                <p><?= $data['car']['content'];?></p>
            </div>

            <!-- Sidebar -->
            <div class="item-car-sidebar">
                <!-- Prix et réservation -->
                <div class="item-price-card">
                    <div class="item-price-value"><?= $data['car']['price'];?>€</div>
                    <div class="item-price-label">par jour</div>
                    
                    <div class="item-deposit-info">
                        <strong>Caution : <?= $data['car']['deposit'];?>€</strong>
                    </div>
                    
                    <?php 
                    $stockClass = $data['car']['stock'] > 2 ? 'stock-available' : 'stock-low';
                    $stockText = $data['car']['stock'] > 2 ? 'Disponible' : 'Stock limité';
                    ?>
                    <div class="item-stock-status <?= $stockClass; ?>"><?= $stockText; ?></div>
                </div>

                <a href="/contact" class="item-reserve-btn">Réserver maintenant</a>

                <!-- Specs rapides -->
                <div class="item-specs-card">
                    <h3>Caractéristiques</h3>
                    <div class="item-specs-grid">
                        <div class="item-spec-item">
                            <span class="item-spec-label">Carburant</span>
                            <span class="item-spec-value"><?= $data['car']['fuel_type'];?></span>
                        </div>
                        <div class="item-spec-item">
                            <span class="item-spec-label">Transmission</span>
                            <span class="item-spec-value"><?= $data['car']['transmission'];?></span>
                        </div>
                        <div class="item-spec-item">
                            <span class="item-spec-label">Places</span>
                            <span class="item-spec-value"><?= $data['car']['seats'];?></span>
                        </div>
                        <div class="item-spec-item">
                            <span class="item-spec-label">Portes</span>
                            <span class="item-spec-value"><?= $data['car']['doors'];?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Performances en highlight -->
        <div class="item-performance-highlights">
            <div class="item-perf-item">
                <div class="item-perf-value"><?= $data['car']['horsepower'];?></div>
                <div class="item-perf-label">Chevaux</div>
            </div>
            <div class="item-perf-item">
                <div class="item-perf-value"><?= $data['car']['top_speed'];?></div>
                <div class="item-perf-label">Vitesse max</div>
            </div>
            <div class="item-perf-item">
                <div class="item-perf-value"><?= $data['car']['acceleration'];?></div>
                <div class="item-perf-label">0-100 km/h</div>
            </div>
        </div>

        <!-- Spécifications détaillées -->
        <section class="item-detailed-specs">
            <h2>Fiche technique complète</h2>
            <div class="item-specs-categories">
                <div class="item-spec-category">
                    <h4>🚗 Général</h4>
                    <div class="item-specs-grid">
                        <div class="item-spec-item">
                            <span class="item-spec-label">Marque</span>
                            <span class="item-spec-value"><?= $data['car']['title'];?></span>
                        </div>
                        <div class="item-spec-item">
                            <span class="item-spec-label">Modèle</span>
                            <span class="item-spec-value"><?= $data['car']['model'];?></span>
                        </div>
                        <div class="item-spec-item">
                            <span class="item-spec-label">Année</span>
                            <span class="item-spec-value"><?= $data['car']['year'];?></span>
                        </div>
                        <div class="item-spec-item">
                            <span class="item-spec-label">Carrosserie</span>
                            <span class="item-spec-value"><?= $data['car']['category_tag_id'];?></span>
                        </div>
                    </div>
                </div>

                <div class="item-spec-category">
                    <h4>⚡ Performance</h4>
                    <div class="item-specs-grid">
                        <div class="item-spec-item">
                            <span class="item-spec-label">Puissance</span>
                            <span class="item-spec-value"><?= $data['car']['horsepower'];?> ch</span>
                        </div>
                        <div class="item-spec-item">
                            <span class="item-spec-label">Vitesse max</span>
                            <span class="item-spec-value"><?= $data['car']['top_speed'];?></span>
                        </div>
                        <div class="item-spec-item">
                            <span class="item-spec-label">0-100 km/h</span>
                            <span class="item-spec-value"><?= $data['car']['acceleration'];?></span>
                        </div>
                        <div class="item-spec-item">
                            <span class="item-spec-label">Cylindres</span>
                            <span class="item-spec-value"><?= $data['car']['cylinders'];?></span>
                        </div>
                    </div>
                </div>

                <div class="item-spec-category">
                    <h4>🔧 Technique</h4>
                    <div class="item-specs-grid">
                        <div class="item-spec-item">
                            <span class="item-spec-label">Carburant</span>
                            <span class="item-spec-value"><?= $data['car']['fuel_type'];?></span>
                        </div>
                        <div class="item-spec-item">
                            <span class="item-spec-label">Transmission</span>
                            <span class="item-spec-value"><?= $data['car']['transmission'];?></span>
                        </div>
                        <div class="item-spec-item">
                            <span class="item-spec-label">Roues motrices</span>
                            <span class="item-spec-value"><?= $data['car']['wheel-transmission'];?></span>
                        </div>
                        <div class="item-spec-item">
                            <span class="item-spec-label">Portes</span>
                            <span class="item-spec-value"><?= $data['car']['doors'];?></span>
                        </div>
                    </div>
                </div>
            </div>
        </section>