
  <section class="presentation-catalog">
    <h2>Notre flotte</h2>
  </section>

<section class="catalog">    
<?php
// var_dump($data);
foreach ($data['car'] as $car) {
    echo '<article class="card">';
    echo '<h2>' . $car['title'] . '</h2>';
    echo '<img src="/assets/cars/' . $car['slug'] . '/' . $car['image'] . '" alt="' . $car['title'] . '">';
    echo '<p>' . $car['description'] . '</p>';
    echo '<p>Caution: ' . $car['deposit'] . '€</p>';
    echo '<a href="/catalog/item/' . $car['slug'] . '">Voir plus</a>';
    echo '</article>';
}
?>
</section>
