<h1>test</h1>
<section>
            <h1>HSK Locations</h1>
        
            <h3><?= $data['car']['title'];?></h3>
            
            <img src="/assets/cars/<?= $data['car']['slug'] . '/' . $data['car']['image'];?>" alt="Logo" />
            <p><?= $data['car']['description'];?></p>
            <p><?= $data['car']['content'];?></p>
            <p>Prix: <?= $data['car']['prix'];?>€</p>
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
</section>