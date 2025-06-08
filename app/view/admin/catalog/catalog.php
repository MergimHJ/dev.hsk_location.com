<?php extract($data); ?>

<!-- Messages de succès/erreur -->
<?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success">
        <?php
        switch ($_GET['success']) {
            case 'created': echo '✅ Voiture créée avec succès !'; break;
            case 'updated': echo '✅ Voiture mise à jour avec succès !'; break;
            case 'deleted': echo '✅ Voiture supprimée avec succès !'; break;
            default: echo '✅ Action réalisée avec succès !';
        }
        ?>
    </div>
<?php endif; ?>

<?php if (isset($_GET['error'])): ?>
    <div class="alert alert-danger">
        ❌ Erreur : <?= htmlspecialchars($_GET['error']); ?>
    </div>
<?php endif; ?>

<header>
     <h1>Catalog Management</h1>
     <p>Manage your cars, categories, and themes</p>
 </header>

 <nav>
     <div class="nav-tabs">
         <button class="nav-tab active" onclick="showSection('cars')">
             Cars (<?= count($cars) ?>)
         </button>
         <button class="nav-tab" onclick="showSection('categories')">
             Categories (<?= count($categories) ?>)
         </button>
         <button class="nav-tab" onclick="showSection('themes')">
             Themes (<?= count($themes) ?>)
         </button>
     </div>
 </nav>

 <main>
     <!-- Cars Section -->
     <section id="cars-section">
         <header class="section-header">
             <h2 class="section-title">Cars</h2>
             <a href="/admin/catalog/add" class="btn btn-primary">Add New Car</a>
         </header>

         <div class="stats">
             <?php
                $published = array_filter($cars, fn($car) => $car['status'] === 'published');
                $draft = array_filter($cars, fn($car) => $car['status'] === 'draft');
                $archived = array_filter($cars, fn($car) => $car['status'] === 'archived');
                ?>
             <span>Published: <?= count($published) ?></span>
             <span>Draft: <?= count($draft) ?></span>
             <span>Archived: <?= count($archived) ?></span>
         </div>

         <div class="table-container">
             <table>
                 <thead>
                     <tr>
                         <th>Image</th>
                         <th>Title</th>
                         <th>Model</th>
                         <th>Year</th>
                         <th>Price</th>
                         <th>Status</th>
                         <th>Stock</th>
                         <th>Specs</th>
                         <th>Created</th>
                         <th>Actions</th>
                     </tr>
                 </thead>
                 <tbody>
                     <?php foreach ($cars as $car): ?>
                         <tr>
                             <td>
                                 <?php if (!empty($car['image'])): ?>
                                     <img src="/assets/cars/<?= $car['slug']; ?>/<?= $car['image']; ?>"
                                         alt="<?= htmlspecialchars($car['title']) ?>"
                                         class="car-image">
                                 <?php else: ?>
                                     <div class="car-image" style="background: #e9ecef; display: flex; align-items: center; justify-content: center; color: #6c757d;">No Image</div>
                                 <?php endif; ?>
                             </td>
                             <td>
                                 <strong><?= htmlspecialchars($car['title']) ?></strong>
                                 <?php if ($car['description']): ?>
                                     <br><small style="color: #6c757d;"><?= htmlspecialchars(substr($car['description'], 0, 50)) ?>...</small>
                                 <?php endif; ?>
                             </td>
                             <td><?= htmlspecialchars($car['model']) ?></td>
                             <td><?= htmlspecialchars($car['year']) ?></td>
                             <td>
                                 <?php if ($car['price']): ?>
                                     <strong>€<?= number_format($car['price']) ?></strong>
                                 <?php else: ?>
                                     <span style="color: #6c757d;">-</span>
                                 <?php endif; ?>
                             </td>
                             <td>
                                 <span class="status-badge status-<?= $car['status'] ?>">
                                     <?= ucfirst($car['status']) ?>
                                 </span>
                             </td>
                             <td><?= $car['stock'] ?></td>
                             <td>
                                 <small>
                                     <?= $car['seats'] ?> seats • <?= $car['doors'] ?> doors<br>
                                     <?= ucfirst($car['fuel_type']) ?> • <?= ucfirst($car['transmission']) ?>
                                     <?php if ($car['horsepower']): ?>
                                         <br><?= $car['horsepower'] ?> HP
                                     <?php endif; ?>
                                 </small>
                             </td>
                             <td>
                                 <?php if (isset($car['created_at'])): ?>
                                     <small><?= date('M j, Y', strtotime($car['created_at'])) ?></small>
                                 <?php else: ?>
                                     <small>-</small>
                                 <?php endif; ?>
                             </td>
                             <td>
                                 <a href="/admin/catalog/edit/<?= $car['id'] ?>" class="btn btn-edit btn-sm">Edit</a>
                                 <button onclick="deleteCar(<?= $car['id'] ?>, '<?= htmlspecialchars($car['title'], ENT_QUOTES) ?>')"
                                     class="btn btn-delete btn-sm">Delete</button>
                             </td>
                         </tr>
                     <?php endforeach; ?>
                 </tbody>
             </table>
         </div>
     </section>

     <!-- Categories Section -->
     <section id="categories-section" class="hidden">
         <header class="section-header">
             <h2 class="section-title">Categories</h2>
             <a href="/admin/catalog/category" class="btn btn-primary">Add New Category</a>
         </header>

         <div class="table-container">
             <table>
                 <thead>
                     <tr>
                         <th>ID</th>
                         <th>Name</th>
                         <th>Slug</th>
                         <th>Description</th>
                         <th>Cars Using</th>
                         <th>Created</th>
                         <th>Actions</th>
                     </tr>
                 </thead>
                 <tbody>
                     <?php foreach ($categories as $category): ?>
                         <?php
                            $carsUsingCategory = array_filter($cars, fn($car) => $car['category_tag_id'] == $category['id']);
                            $carCount = count($carsUsingCategory);
                            ?>
                         <tr>
                             <td><?= $category['id'] ?></td>
                             <td><strong><?= htmlspecialchars($category['name']) ?></strong></td>
                             <td>
                                 <code style="background: #f8f9fa; padding: 0.25rem 0.5rem; border-radius: 4px;">
                                     <?= htmlspecialchars($category['slug']) ?>
                                 </code>
                             </td>
                             <td>
                                 <?php if (!empty($category['description'])): ?>
                                     <?= htmlspecialchars(substr($category['description'], 0, 80)) ?>...
                                 <?php else: ?>
                                     <span style="color: #6c757d;">-</span>
                                 <?php endif; ?>
                             </td>
                             <td>
                                 <span style="color: <?= $carCount > 0 ? '#28a745' : '#6c757d' ?>">
                                     <?= $carCount ?> cars
                                 </span>
                             </td>
                             <td>
                                 <?php if (isset($category['created_at'])): ?>
                                     <small><?= date('M j, Y', strtotime($category['created_at'])) ?></small>
                                 <?php else: ?>
                                     <small>-</small>
                                 <?php endif; ?>
                             </td>
                             <td>
                                 <button onclick="deleteTag(<?= $category['id'] ?>, '<?= htmlspecialchars($category['name'], ENT_QUOTES) ?>', 'category', <?= $carCount ?>)"
                                     class="btn btn-delete btn-sm" <?= $carCount > 0 ? 'title="Cannot delete: category is being used by cars"' : '' ?>>
                                     Delete
                                 </button>
                             </td>
                         </tr>
                     <?php endforeach; ?>
                 </tbody>
             </table>
         </div>
     </section>

     <!-- Themes Section -->
     <section id="themes-section" class="hidden">
         <header class="section-header">
             <h2 class="section-title">Themes</h2>
             <a href="/admin/catalog/category" class="btn btn-primary">Add New Theme</a>
         </header>

         <div class="table-container">
             <table>
                 <thead>
                     <tr>
                         <th>ID</th>
                         <th>Name</th>
                         <th>Slug</th>
                         <th>Description</th>
                         <th>Cars Using</th>
                         <th>Created</th>
                         <th>Actions</th>
                     </tr>
                 </thead>
                 <tbody>
                     <?php foreach ($themes as $theme): ?>
                         <?php
                            $carsUsingTheme = array_filter($cars, fn($car) => $car['theme_tag_id'] == $theme['id']);
                            $carCount = count($carsUsingTheme);
                            ?>
                         <tr>
                             <td><?= $theme['id'] ?></td>
                             <td><strong><?= htmlspecialchars($theme['name']) ?></strong></td>
                             <td>
                                 <code style="background: #f8f9fa; padding: 0.25rem 0.5rem; border-radius: 4px;">
                                     <?= htmlspecialchars($theme['slug']) ?>
                                 </code>
                             </td>
                             <td>
                                 <?php if (!empty($theme['description'])): ?>
                                     <?= htmlspecialchars(substr($theme['description'], 0, 80)) ?>...
                                 <?php else: ?>
                                     <span style="color: #6c757d;">-</span>
                                 <?php endif; ?>
                             </td>
                             <td>
                                 <span style="color: <?= $carCount > 0 ? '#28a745' : '#6c757d' ?>">
                                     <?= $carCount ?> cars
                                 </span>
                             </td>
                             <td>
                                 <?php if (isset($theme['created_at'])): ?>
                                     <small><?= date('M j, Y', strtotime($theme['created_at'])) ?></small>
                                 <?php else: ?>
                                     <small>-</small>
                                 <?php endif; ?>
                             </td>
                             <td>
                                 <button onclick="deleteTag(<?= $theme['id'] ?>, '<?= htmlspecialchars($theme['name'], ENT_QUOTES) ?>', 'theme', <?= $carCount ?>)"
                                     class="btn btn-delete btn-sm" <?= $carCount > 0 ? 'title="Cannot delete: theme is being used by cars"' : '' ?>>
                                     Delete
                                 </button>
                             </td>
                         </tr>
                     <?php endforeach; ?>
                 </tbody>
             </table>
         </div>
     </section>
 </main>