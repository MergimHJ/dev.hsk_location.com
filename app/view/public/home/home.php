<section class="presentation">
      
      <div class="presentation-content">
        <div class="presentation-text">
          <h2>Qui sommes-nous?</h2>
          <p>Offrez-vous l'exception.
Chez HSK Locations, nous mettons à votre disposition une sélection prestigieuse de voitures de sport et de luxe pour transformer chacun de vos déplacements en une expérience inoubliable. Que ce soit pour un événement spécial, un déplacement professionnel ou simplement pour le plaisir de conduire, nos véhicules allient performance, élégance et confort haut de gamme.

Nous vous proposons une gamme exclusive des marques les plus emblématiques – Ferrari, Lamborghini, Porsche, Bentley, et bien d'autres – soigneusement entretenues et prêtes à prendre la route selon vos envies. Notre équipe vous accompagne avec discrétion, réactivité et professionnalisme, afin de vous offrir un service sur mesure, à la hauteur de vos exigences.

</p>
         
        </div>
        <div class="presentation-image">
          <img src="/assets/cars/bmw-m5-f90/BMW-M5-F90.webp" alt="Voiture sportive" />
        </div>
      </div>
    </section>
  
    <section class="services">
    <h2 class="services-header">Nos véhicules</h2>
  <!-- <div class="cases"> -->
    <?php foreach ($data['cars'] as $car): ?>
      <article class="card">
        <h2 class="car-title"><?= $car['title']; ?></h2>
        <img src="/assets/cars/<?= $car['slug']; ?>/<?= $car['image']; ?>" alt="<?= $car['title']; ?>">
        
        <!-- Specs rapides ajoutées -->
        <div style="display: flex; gap: 8px; margin: 10px 0; flex-wrap: wrap; justify-content: center;">
            <?php if (!empty($car['year'])): ?>
                <span style="background: #f0f0f0; padding: 3px 8px; border-radius: 10px; font-size: 0.7rem; color: #666;">
                    📅 <?= $car['year'] ?>
                </span>
            <?php endif; ?>
            <?php if (!empty($car['fuel_type'])): ?>
                <span style="background: #f0f0f0; padding: 3px 8px; border-radius: 10px; font-size: 0.7rem; color: #666;">
                    ⛽ <?= ucfirst($car['fuel_type']) ?>
                </span>
            <?php endif; ?>
            <?php if (!empty($car['seats'])): ?>
                <span style="background: #f0f0f0; padding: 3px 8px; border-radius: 10px; font-size: 0.7rem; color: #666;">
                    👥 <?= $car['seats'] ?> places
                </span>
            <?php endif; ?>
            <?php if (!empty($car['horsepower'])): ?>
                <span style="background: #f0f0f0; padding: 3px 8px; border-radius: 10px; font-size: 0.7rem; color: #666;">
                    ⚡ <?= $car['horsepower'] ?> ch
                </span>
            <?php endif; ?>
        </div>
        
        <p class="car-description"><?= $car['description']; ?></p>
        <p class="car-price">Caution: <?= $car['deposit']; ?>€</p>
        <a href="/catalog/item/<?= $car['slug']; ?>" class="car-link">Voir plus</a>
      </article>
    <?php endforeach; ?>
  <!-- </div> -->
</section>
    
    <section class="info-sections">
      <div class="testimonials">
        <div class="section-header">
          <h2>Avis des clients</h2>
        </div>
        <ul class="testimonial-list">
          <li><p>"Super service, voiture impeccable!" &#9733;&#9733;&#9733;&#9733;&#9733;</p></li>
          <li><p>"Expérience incroyable du début à la fin, personnel très professionnel." &#9733;&#9733;&#9733;&#9733;&#9734;</p></li>
          <li><p>"Réservation facile, accueil chaleureux et une voiture de rêve." &#9733;&#9733;&#9733;&#9733;&#9733;</p></li>
        </ul>
      </div>
      
      <div class="why-us">
        <div class="section-header">
          <h2>Pourquoi nous choisir?</h2>
        </div>
        <ul class="features-list">
          <li><p>🚗Large choix de véhicules haut de gamme</p></li>
          <li><p>🔒Réservation rapide et sécurisée</p></li>
          <li><p>💰Tarifs compétitifs et transparents</p></li>
        </ul>
      </div>
    </section>