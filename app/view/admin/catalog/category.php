<?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success">
        ✅ Tag créé avec succès !
    </div>
<?php endif; ?>

<?php if (isset($_GET['error'])): ?>
    <div class="alert alert-danger">
        ❌ Erreur : <?= htmlspecialchars($_GET['error']); ?>
    </div>
<?php endif; ?>

<header>
    <h1>Add New Tag</h1>
    <p>Create categories and themes for organizing your vehicles</p>
</header>

<form action="/admin/catalog/addcategory" method="POST" enctype="multipart/form-data">
    <fieldset>
        <legend>Tag Information</legend>
        <div>
            <div>
                <label for="name">Name *</label>
                <input type="text" 
                    id="name" 
                    name="name" 
                    required
                    placeholder="e.g. Sports Car, Wedding, Luxury"
                    maxlength="100">
            </div>

            <div>
                <label for="slug">Slug *</label>
                <input type="text" 
                    id="slug" 
                    name="slug" 
                    required
                    pattern="[a-z0-9\-]+"
                    placeholder="e.g. sports-car, wedding, luxury"
                    title="Only lowercase letters, numbers, and hyphens allowed"
                    maxlength="100">
            </div>

            <div>
                <label for="type">Type *</label>
                <select id="type" name="type" required>
                    <option value="">Select Type</option>
                    <option value="category">Category (Vehicle type: SUV, Sports, etc.)</option>
                    <option value="theme">Theme (Use case: Wedding, Business, etc.)</option>
                </select>
            </div>

            <div style="grid-column: span 2;">
                <label for="description">Description (Optional)</label>
                <textarea id="description" 
                    name="description" 
                    rows="3"
                    placeholder="Optional description for this tag"
                    maxlength="500"></textarea>
            </div>
        </div>
    </fieldset>

    <fieldset>
        <legend>Actions</legend>
        <div style="display: flex; gap: 15px; align-items: center;">
            <button type="submit" class="btn btn-primary">Create Tag</button>
            <a href="/admin/catalog" class="btn" style="background: #6c757d; color: white; text-decoration: none;">Back to Catalog</a>
        </div>
    </fieldset>
</form>

<div style="margin-top: 40px; padding: 20px; background: #f8f9fa; border-radius: 10px; border-left: 4px solid var(--admin-primary);">
    <h3 style="color: var(--admin-primary); margin-bottom: 15px;">💡 Tag Usage Guide</h3>
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
        <div>
            <h4 style="color: var(--admin-dark); margin-bottom: 10px;">Categories</h4>
            <ul style="margin: 0; padding-left: 20px; color: #666;">
                <li>Sports Car</li>
                <li>Luxury Sedan</li>
                <li>SUV</li>
                <li>Convertible</li>
                <li>Electric</li>
            </ul>
        </div>
        <div>
            <h4 style="color: var(--admin-dark); margin-bottom: 10px;">Themes</h4>
            <ul style="margin: 0; padding-left: 20px; color: #666;">
                <li>Wedding</li>
                <li>Business</li>
                <li>Weekend</li>
                <li>Track Day</li>
                <li>City Driving</li>
            </ul>
        </div>
    </div>
</div>

<script>
// Auto-generate slug from name
document.getElementById('name').addEventListener('input', function() {
    const name = this.value;
    const slug = name.toLowerCase()
        .replace(/[^a-z0-9\s-]/g, '') // Remove special characters
        .replace(/\s+/g, '-') // Replace spaces with hyphens
        .replace(/-+/g, '-') // Replace multiple hyphens with single
        .trim('-'); // Remove leading/trailing hyphens
    
    document.getElementById('slug').value = slug;
});
</script>