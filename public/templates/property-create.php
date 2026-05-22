<?php
require_once '../../app/core/App.php';
App::init();

$propertyModel = new Property();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $category = trim($_POST['category'] ?? 'Apartment');
    $price = (float) ($_POST['price'] ?? 0);
    $bedrooms = (int) ($_POST['bedrooms'] ?? 0);
    $bathrooms = (int) ($_POST['bathrooms'] ?? 0);
    $area = (int) ($_POST['area'] ?? 0);
    $floor = trim($_POST['floor'] ?? '1');
    $parking = trim($_POST['parking'] ?? '0');
    $description = trim($_POST['description'] ?? '');

    $imageName = 'property-01.jpg';

    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $uploadDir = __DIR__ . '/../uploads/';

        $extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];

        if (in_array($extension, $allowed, true)) {
            $imageName = time() . '-' . basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $imageName);
        }
    }

    if ($title !== '' && $category !== '' && $price > 0) {
        $propertyModel->create($title, $category, $price, $bedrooms, $bathrooms, $area, $floor, $parking, $description, $imageName);
        Redirect::redirect('admin.php');
    }
}

require_once 'partials/header-admin.php';
?>

<div class="admin-card">
    <h2>Create new property</h2>

    <form method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-8">
                <div class="form-row">
                    <label>Title (address)</label>
                    <input type="text" name="title" placeholder="18 New Street Miami, OR 97219" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-row">
                    <label>Category</label>
                    <select name="category">
                        <option value="Apartment">Apartment</option>
                        <option value="Luxury Villa">Luxury Villa</option>
                        <option value="Penthouse">Penthouse</option>
                        <option value="Modern Condo">Modern Condo</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="form-row">
                    <label>Price (USD)</label>
                    <input type="number" name="price" step="0.01" min="0" placeholder="450000" required>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-row">
                    <label>Bedrooms</label>
                    <input type="number" name="bedrooms" min="0" value="0">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-row">
                    <label>Bathrooms</label>
                    <input type="number" name="bathrooms" min="0" value="0">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-row">
                    <label>Area (m²)</label>
                    <input type="number" name="area" min="0" value="0">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-row">
                    <label>Floor</label>
                    <input type="text" name="floor" value="1" placeholder="napr. 3 alebo 25th">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-row">
                    <label>Parking</label>
                    <input type="text" name="parking" value="0" placeholder="napr. 2 cars alebo 6 spots">
                </div>
            </div>
        </div>

        <div class="form-row">
            <label>Description</label>
            <textarea name="description" rows="6" placeholder="Detailný popis nehnuteľnosti..."></textarea>
        </div>

        <div class="form-row">
            <label>Image</label>
            <input type="file" name="image" accept=".jpg,.jpeg,.png,.webp">
            <small style="color:#999;">Ak nenahráte obrázok, použije sa default.</small>
        </div>

        <div style="display:flex; gap:10px;">
            <button type="submit" class="btn-orange">Save Property</button>
            <a href="admin.php" class="btn-ghost">Cancel</a>
        </div>
    </form>
</div>

<?php require_once 'partials/footer-admin.php'; ?>