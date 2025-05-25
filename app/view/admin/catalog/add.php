<form action="/admin/catalog/save" method="POST" enctype="multipart/form-data">
  <fieldset>
    <legend>Informations principales</legend>

    <label for="operator_id">Opérateur :</label>
    <input type="number" id="operator_id" name="operator_id" required>

    <label for="brand_id">Marque :</label>
    <input type="number" id="brand_id" name="brand_id" required>

    <label for="model">Modèle :</label>
    <input type="text" id="model" name="model" required>

    <label for="title">Titre :</label>
    <input type="text" id="title" name="title" required>

    <label for="slug">Slug (URL) :</label>
    <input type="text" id="slug" name="slug" required>

    <label for="description">Description courte :</label>
    <textarea id="description" name="description"></textarea>

    <label for="content">Contenu détaillé :</label>
    <textarea id="content" name="content"></textarea>
  </fieldset>

  <fieldset>
    <legend>Caractéristiques</legend>

    <label for="year">Année :</label>
    <input type="number" id="year" name="year" required>

    <label for="seats">Nombre de sièges :</label>
    <input type="number" id="seats" name="seats" min="1" value="2">

    <label for="doors">Nombre de portes :</label>
    <input type="number" id="doors" name="doors" min="1" value="2">

    <label for="transmission">Transmission :</label>
    <select id="transmission" name="transmission">
      <option value="automatic">Automatique</option>
      <option value="manual">Manuelle</option>
      <option value="semi-automatic">Semi-automatique</option>
    </select>

    <label for="fuel_type">Type de carburant :</label>
    <select id="fuel_type" name="fuel_type">
      <option value="gasoline">Essence</option>
      <option value="diesel">Diesel</option>
      <option value="hybrid">Hybride</option>
      <option value="electric">Électrique</option>
    </select>

    <label for="horsepower">Puissance (ch) :</label>
    <input type="number" id="horsepower" name="horsepower">

    <label for="top_speed">Vitesse max (km/h) :</label>
    <input type="number" id="top_speed" name="top_speed">

    <label for="acceleration">Accélération (0–100 km/h en s) :</label>
    <input type="number" step="0.1" id="acceleration" name="acceleration">

    <label for="cylinders">Cylindres :</label>
    <input type="number" id="cylinders" name="cylinders" required>

    <label for="carrosserie">Carrosserie :</label>
    <input type="text" id="carrosserie" name="carrosserie" required>

    <label for="wheel_transmission">Transmission par roue :</label>
    <input type="number" id="wheel_transmission" name="wheel_transmission" required>
  </fieldset>

  <fieldset>
    <legend>Détails commerciaux</legend>

    <label for="price">Prix (€) :</label>
    <input type="number" id="price" name="price" required>

    <label for="deposit">Dépôt de garantie (€) :</label>
    <input type="number" step="0.01" id="deposit" name="deposit">

    <label for="stock">Stock disponible :</label>
    <input type="number" id="stock" name="stock" value="1">

    <label for="status">Statut :</label>
    <select id="status" name="status">
      <option value="draft">Brouillon</option>
      <option value="published">Publié</option>
      <option value="archived">Archivé</option>
    </select>
  </fieldset>

  <fieldset>
    <legend>Catégories et thèmes</legend>

    <label for="category_tag_id">Catégorie (ex : SUV) :</label>
    <input type="number" id="category_tag_id" name="category_tag_id" required>

    <label for="theme_tag_id">Thème (ex : mariage) :</label>
    <input type="number" id="theme_tag_id" name="theme_tag_id" required>
  </fieldset>

  <fieldset>
    <legend>Image</legend>

    <label for="image">Image principale :</label>
    <input type="file" id="image" name="image" accept="image/*">
  </fieldset>

  <button type="submit">Ajouter le véhicule</button>
</form>
