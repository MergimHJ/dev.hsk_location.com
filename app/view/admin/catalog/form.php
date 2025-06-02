<?php

?> <form action="/admin/catalog/save" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= htmlspecialchars($data['car']['id'] ?? '') ?>">

    <fieldset>
        <legend>Basic Information</legend>

        <div>
            <label for="title">Title *</label>
            <input type="text"
                id="title"
                name="title"
                value="<?= htmlspecialchars($data['car']['title'] ?? '') ?>"
                required
                maxlength="255">
        </div>

        <div>
            <label for="model">Model *</label>
            <input type="text"
                id="model"
                name="model"
                value="<?= htmlspecialchars($data['car']['model'] ?? '') ?>"
                required
                maxlength="100">
        </div>

        <div>
            <label for="slug">Slug *</label>
            <input type="text"
                id="slug"
                name="slug"
                value="<?= htmlspecialchars($data['car']['slug'] ?? '') ?>"
                required
                maxlength="255"
                pattern="[a-z0-9\-]+"
                title="Only lowercase letters, numbers, and hyphens allowed">
        </div>

        <div>
            <label for="description">Description</label>
            <textarea id="description"
                name="description"
                rows="3"
                maxlength="500"><?= htmlspecialchars($data['car']['description'] ?? '') ?></textarea>
        </div>

        <div>
            <label for="content">Content (Full Description)</label>
            <textarea id="content"
                name="content"
                rows="8"><?= htmlspecialchars($data['car']['content'] ?? '') ?></textarea>
        </div>
    </fieldset>

    <fieldset>
        <legend>Classification</legend>

        <label>Operator ID
            <select name="operator_id" required>
                <?php foreach ($data['operators'] as $operator): ?>
                    <option value="<?= $operator['id'] ?>" <?= isset($data['car']['operator_id']) && $data['car']['operator_id'] == $operator['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($operator['username']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            </div>

            <div>
                <label for="brand_id">Brand ID *</label>
                <input type="number"
                    id="brand_id"
                    name="brand_id"
                    value="<?= htmlspecialchars($data['car']['brand_id'] ?? '') ?>"
                    required
                    min="1">
            </div>

            <div>
                <label for="category_tag_id">Category Tag ID *</label>
                <select name="category_tag_id" required>
                    <?php foreach ($data['categories'] as $category): ?>
                        <option value="<?= $category['id'] ?>" <?= isset($data['car']['category_tag_id']) && $data['car']['category_tag_id'] == $category['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($category['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <small>Tag for category (SUV, sedan, etc.)</small>
            </div>

            <div>
                <label for="theme_tag_id">Theme Tag ID *</label>
                <input type="number"
                    id="theme_tag_id"
                    name="theme_tag_id"
                    value="<?= htmlspecialchars($data['car']['theme_tag_id'] ?? '') ?>"
                    required
                    min="1">
                <small>Tag for theme (wedding, business, etc.)</small>
            </div>

            <div>
                <label for="status">Status</label>
                <select id="status" name="status">
                    <option value="draft" <?= ($data['car']['status'] ?? 'draft') === 'draft' ? 'selected' : '' ?>>Draft</option>
                    <option value="published" <?= ($data['car']['status'] ?? '') === 'published' ? 'selected' : '' ?>>Published</option>
                    <option value="archived" <?= ($data['car']['status'] ?? '') === 'archived' ? 'selected' : '' ?>>Archived</option>
                </select>
            </div>
    </fieldset>

    <fieldset>
        <legend>Vehicle Specifications</legend>

        <div>
            <label for="year">Year *</label>
            <input type="number"
                id="year"
                name="year"
                value="<?= htmlspecialchars($data['car']['year'] ?? '') ?>"
                required
                min="1900"
                max="<?= date('Y') + 2 ?>">
        </div>

        <div>
            <label for="seats">Number of Seats</label>
            <input type="number"
                id="seats"
                name="seats"
                value="<?= htmlspecialchars($data['car']['seats'] ?? '2') ?>"
                min="1"
                max="50">
        </div>

        <div>
            <label for="doors">Number of Doors</label>
            <input type="number"
                id="doors"
                name="doors"
                value="<?= htmlspecialchars($data['car']['doors'] ?? '2') ?>"
                min="1"
                max="10">
        </div>

        <div>
            <label for="transmission">Transmission</label>
            <select id="transmission" name="transmission">
                <option value="automatic" <?= ($data['car']['transmission'] ?? 'automatic') === 'automatic' ? 'selected' : '' ?>>Automatic</option>
                <option value="manual" <?= ($data['car']['transmission'] ?? '') === 'manual' ? 'selected' : '' ?>>Manual</option>
                <option value="semi-automatic" <?= ($data['car']['transmission'] ?? '') === 'semi-automatic' ? 'selected' : '' ?>>Semi-Automatic</option>
            </select>
        </div>

        <div>
            <label for="fuel_type">Fuel Type</label>
            <select id="fuel_type" name="fuel_type">
                <option value="gasoline" <?= ($data['car']['fuel_type'] ?? 'gasoline') === 'gasoline' ? 'selected' : '' ?>>Gasoline</option>
                <option value="diesel" <?= ($data['car']['fuel_type'] ?? '') === 'diesel' ? 'selected' : '' ?>>Diesel</option>
                <option value="hybrid" <?= ($data['car']['fuel_type'] ?? '') === 'hybrid' ? 'selected' : '' ?>>Hybrid</option>
                <option value="electric" <?= ($data['car']['fuel_type'] ?? '') === 'electric' ? 'selected' : '' ?>>Electric</option>
            </select>
        </div>

        <div>
            <label for="carrosserie">Carrosserie</label>
            <input type="text"
                id="carrosserie"
                name="carrosserie"
                value="<?= htmlspecialchars($data['car']['carrosserie'] ?? '') ?>"
                maxlength="50">
        </div>
    </fieldset>

    <fieldset>
        <legend>Performance</legend>

        <div>
            <label for="horsepower">Horsepower (HP)</label>
            <input type="number"
                id="horsepower"
                name="horsepower"
                value="<?= htmlspecialchars($data['car']['horsepower'] ?? '') ?>"
                min="1"
                max="2000">
        </div>

        <div>
            <label for="cylinders">Cylinders *</label>
            <input type="number"
                id="cylinders"
                name="cylinders"
                value="<?= htmlspecialchars($data['car']['cylinders'] ?? '') ?>"
                required
                min="1"
                max="16">
        </div>

        <div>
            <label for="top_speed">Top Speed (km/h)</label>
            <input type="number"
                id="top_speed"
                name="top_speed"
                value="<?= htmlspecialchars($data['car']['top_speed'] ?? '') ?>"
                min="1"
                max="500">
        </div>

        <div>
            <label for="acceleration">0-100 km/h (seconds)</label>
            <input type="number"
                id="acceleration"
                name="acceleration"
                value="<?= htmlspecialchars($data['car']['acceleration'] ?? '') ?>"
                step="0.1"
                min="0.1"
                max="30.0">
        </div>

        <div>
            <label for="wheel_transmission">Wheel Transmission *</label>
            <input type="number"
                id="wheel_transmission"
                name="wheel-transmission"
                value="<?= htmlspecialchars($data['car']['wheel-transmission'] ?? '') ?>"
                required>
            <small>Note: Field name contains hyphen as per database schema</small>
        </div>
    </fieldset>

    <fieldset>
        <legend>Pricing & Availability</legend>

        <div>
            <label for="price">Price *</label>
            <input type="number"
                id="price"
                name="price"
                value="<?= htmlspecialchars($data['car']['price'] ?? '') ?>"
                required
                min="0">
        </div>

        <div>
            <label for="deposit">Security Deposit</label>
            <input type="number"
                id="deposit"
                name="deposit"
                value="<?= htmlspecialchars($data['car']['deposit'] ?? '') ?>"
                step="0.01"
                min="0">
        </div>

        <div>
            <label for="stock">Stock Quantity</label>
            <input type="number"
                id="stock"
                name="stock"
                value="<?= htmlspecialchars($data['car']['stock'] ?? '1') ?>"
                min="0"
                max="100">
        </div>
    </fieldset>

    <fieldset>
        <legend>Media</legend>

        <div>
            <label for="image">Main Image</label>
            <input type="file"
                id="image"
                name="image"
                accept="image/*">
            <?php if ($isEdit && !empty($data['car']['image'])): ?>
                <div>
                    <p>Current image: <?= htmlspecialchars(basename($data['car']['image'])) ?></p>
                    <img src="<?= htmlspecialchars($data['car']['image']) ?>"
                        alt="Current car image"
                        width="200"
                        height="150"
                        style="object-fit: cover;">
                </div>
                <input type="hidden" name="existing_image" value="<?= htmlspecialchars($data['car']['image']) ?>">
            <?php endif; ?>
        </div>
    </fieldset>

    <fieldset>
        <legend>Actions</legend>

        <button type="submit">
            Save
        </button>

        <a href="/admin/catalog">Cancel</a>
    </fieldset>
</form>