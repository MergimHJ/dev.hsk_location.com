<header>
    <h1>Dashboard Admin HSK</h1>
    <p>Gérez votre flotte de véhicules de luxe</p>
</header>

<!-- Statistiques principales -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 40px;">
    <div style="background: linear-gradient(135deg, var(--admin-primary), #e2c462); color: white; padding: 25px; border-radius: 15px; text-align: center; box-shadow: 0 4px 15px rgba(197, 160, 39, 0.3);">
        <div style="font-size: 2.5rem; font-weight: 700; margin-bottom: 5px;">
            <?= $data['stats']['total_cars'] ?? 0 ?>
        </div>
        <div style="opacity: 0.9;">Véhicules total</div>
    </div>
    
    <div style="background: linear-gradient(135deg, var(--admin-success), #20c997); color: white; padding: 25px; border-radius: 15px; text-align: center; box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);">
        <div style="font-size: 2.5rem; font-weight: 700; margin-bottom: 5px;">
            <?= $data['stats']['published'] ?? 0 ?>
        </div>
        <div style="opacity: 0.9;">Publiés</div>
    </div>
    
    <div style="background: linear-gradient(135deg, var(--admin-accent), #f7931e); color: white; padding: 25px; border-radius: 15px; text-align: center; box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);">
        <div style="font-size: 2.5rem; font-weight: 700; margin-bottom: 5px;">
            <?= $data['stats']['draft'] ?? 0 ?>
        </div>
        <div style="opacity: 0.9;">Brouillons</div>
    </div>
    
    <div style="background: linear-gradient(135deg, #6f42c1, #8a63d2); color: white; padding: 25px; border-radius: 15px; text-align: center; box-shadow: 0 4px 15px rgba(111, 66, 193, 0.3);">
        <div style="font-size: 2.5rem; font-weight: 700; margin-bottom: 5px;">
            <?= $data['stats']['revenue'] ?? '0€' ?>
        </div>
        <div style="opacity: 0.9;">Revenus</div>
    </div>
</div>

<!-- Actions rapides -->
<div style="background: white; border-radius: 15px; padding: 30px; margin-bottom: 40px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
    <h2 style="color: var(--admin-primary); margin-bottom: 25px; border-bottom: 2px solid var(--admin-primary); padding-bottom: 10px;">Actions rapides</h2>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
        <a href="/admin/catalog/add" style="background: linear-gradient(145deg, #ffffff, #f8f8f8); padding: 20px; border-radius: 10px; text-decoration: none; color: inherit; border: 1px solid #e9ecef; transition: all 0.3s ease; display: block;" 
           onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.1)'"
           onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
            <div style="font-size: 2rem; margin-bottom: 10px;">🚗</div>
            <h3 style="color: var(--admin-primary); margin-bottom: 8px;">Ajouter une voiture</h3>
            <p style="color: #666; margin: 0; font-size: 0.9rem;">Ajoutez un nouveau véhicule à votre flotte</p>
        </a>
        
        <a href="/admin/catalog" style="background: linear-gradient(145deg, #ffffff, #f8f8f8); padding: 20px; border-radius: 10px; text-decoration: none; color: inherit; border: 1px solid #e9ecef; transition: all 0.3s ease; display: block;"
           onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.1)'"
           onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
            <div style="font-size: 2rem; margin-bottom: 10px;">📝</div>
            <h3 style="color: var(--admin-primary); margin-bottom: 8px;">Gérer le catalogue</h3>
            <p style="color: #666; margin: 0; font-size: 0.9rem;">Modifiez vos véhicules existants</p>
        </a>
        
        <a href="/admin/catalog/category" style="background: linear-gradient(145deg, #ffffff, #f8f8f8); padding: 20px; border-radius: 10px; text-decoration: none; color: inherit; border: 1px solid #e9ecef; transition: all 0.3s ease; display: block;"
           onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.1)'"
           onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
            <div style="font-size: 2rem; margin-bottom: 10px;">🏷️</div>
            <h3 style="color: var(--admin-primary); margin-bottom: 8px;">Gérer les tags</h3>
            <p style="color: #666; margin: 0; font-size: 0.9rem;">Créez des catégories et thèmes</p>
        </a>
        
        <a href="/checkin/bye" style="background: linear-gradient(145deg, #ffffff, #f8f8f8); padding: 20px; border-radius: 10px; text-decoration: none; color: inherit; border: 1px solid #e9ecef; transition: all 0.3s ease; display: block;"
           onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.1)'"
           onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
            <div style="font-size: 2rem; margin-bottom: 10px;">🚪</div>
            <h3 style="color: var(--admin-danger); margin-bottom: 8px;">Déconnexion</h3>
            <p style="color: #666; margin: 0; font-size: 0.9rem;">Quitter l'administration</p>
        </a>
    </div>
</div>

<!-- Véhicules récents -->
<?php if (!empty($data['cars'])): ?>
<div style="background: white; border-radius: 15px; padding: 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
    <h2 style="color: var(--admin-primary); margin-bottom: 25px; border-bottom: 2px solid var(--admin-primary); padding-bottom: 10px;">Véhicules récents</h2>
    
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Véhicule</th>
                    <th>Statut</th>
                    <th>Prix</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (array_slice($data['cars'], 0, 5) as $car): ?>
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
                            <strong><?= htmlspecialchars($car['title']) ?></strong><br>
                            <small style="color: #666;"><?= htmlspecialchars($car['model']) ?> • <?= $car['year'] ?></small>
                        </td>
                        <td>
                            <span class="status-badge status-<?= $car['status'] ?>">
                                <?= ucfirst($car['status']) ?>
                            </span>
                        </td>
                        <td>
                            <strong>€<?= number_format($car['price']) ?></strong>/jour
                        </td>
                        <td><?= $car['stock'] ?></td>
                        <td>
                            <a href="/admin/catalog/edit/<?= $car['id'] ?>" class="btn btn-edit btn-sm">Edit</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <div style="text-align: center; margin-top: 20px;">
        <a href="/admin/catalog" class="btn btn-primary">Voir tous les véhicules</a>
    </div>
</div>
<?php else: ?>
<div style="background: white; border-radius: 15px; padding: 40px; text-align: center; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
    <div style="font-size: 4rem; margin-bottom: 20px; opacity: 0.3;">🚗</div>
    <h3 style="color: var(--admin-primary); margin-bottom: 15px;">Aucun véhicule</h3>
    <p style="color: #666; margin-bottom: 25px;">Commencez par ajouter votre premier véhicule à la flotte HSK.</p>
    <a href="/admin/catalog/add" class="btn btn-primary">Ajouter le premier véhicule</a>
</div>
<?php endif; ?>