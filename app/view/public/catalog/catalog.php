<section>
            <h1>HSK Locations</h1>
            <img src="/assets/cars/<?= $car['slug'] . '/' . $car['image'];?>" alt="Logo" />
            <a href="contact.html">Réserver</a>
</section>

<section>    
<?php
// var_dump($data);
foreach ($data['car'] as $car) {
    echo '<article class="card">';
    echo '<h2>' . $car['title'] . '</h2>';
    echo '<img src="/assets/cars/' . $car['slug'] . '/' . $car['image'] . '" alt="' . $car['title'] . '">';
    echo '<p>Prix: ' . $car['price'] . '€</p>';
    echo '<a href="/catalog/item/' . $car['slug'] . '">Voir plus</a>';
    echo '</article>';
}
?>
</section>
