<form action="/admin/catalog/addcategory" method="POST" enctype="multipart/form-data">
  <fieldset>
    <legend>Informations principales</legend>

    <label for="name">Type :</label>
    <input type="text" id="name" name="name" required>

    <label for="slug">Slug :</label>
    <input type="text" id="slug" name="slug" required>

     <label for="type">Type :</label>
    <input type="text" id="type" name="type" required>

    <button type="submit">Ajouter la catégorie</button>

</form>