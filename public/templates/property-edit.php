<?php
require_once '../../app/core/App.php';
App::init();

$propertyModel = new Property();

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    Redirect::redirect('admin.php');
}

$property = $propertyModel->find($id);

if (!$property) {
    Redirect::redirect('admin.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int) ($_POST['id'] ?? 0);
    $title = trim($_POST['title'] ?? '');
    $category = trim($_POST['category'] ?? 'Apartment');
    $price = (float) ($_POST['price'] ?? 0);
    $bedrooms = (int) ($_POST['bedrooms'] ?? 0);
    $bathrooms = (int) ($_POST['bathrooms'] ?? 0);
    $area = (int) ($_POST['area'] ?? 0);
    $floor = trim($_POST['floor'] ?? '1');
    $parking = trim($_POST['parking'] ?? '0');
    $description = trim($_POST['description'] ?? '');

    $imageName = $property->image;

    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $uploadDir = __DIR__ . '/../uploads/';

        $extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];

        if (in_array($extension, $allowed, true)) {
            $imageName = time() . '-' . basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $imageName);
        }
    }

    if ($id && $title !== '' && $price > 0) {
        $propertyModel->update($id, $title, $category, $price, $bedrooms, $bathrooms, $area, $floor, $parking, $description, $imageName);
        Redirect::redirect('admin.php');
    }
}

require_once 'partials/header-admin.php';
?>

<div class="admin-card">
    <h2>Edit property #<?php echo (int)$property->id; ?></h2>

    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo (int)$property->id; ?>">

        <div class="row">
            <div class="col-md-8">
                <div class="form-row">
                    <label>Title (address)</label>
                    <input type="text" name="title" value="<?php echo htmlspecialchars($property->title); ?>" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-row">
                    <label>Category</label>
                    <select name="category">
                        <?php
                        $categories = ['Apartment', 'Luxury Villa', 'Penthouse', 'Modern Condo'];
                        foreach ($categories as $cat):
                            $selected = $property->category === $cat ? 'selected' : '';
                        ?>
                            <option value="<?php echo $cat; ?>" <?php echo $selected; ?>><?php echo $cat; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="form-row">
                    <label>Price (USD)</label>
                    <input type="number" name="price" step="0.01" min="0" value="<?php echo htmlspecialchars($property->price); ?>" required>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-row">
                    <label>Bedrooms</label>
                    <input type="number" name="bedrooms" min="0" value="<?php echo (int)$property->bedrooms; ?>">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-row">
                    <label>Bathrooms</label>
                    <input type="number" name="bathrooms" min="0" value="<?php echo (int)$property->bathrooms; ?>">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-row">
                    <label>Area (m²)</label>
                    <input type="number" name="area" min="0" value="<?php echo (int)$property->area; ?>">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-row">
                    <label>Floor</label>
                    <input type="text" name="floor" value="<?php echo htmlspecialchars($property->floor); ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-row">
                    <label>Parking</label>
                    <input type="text" name="parking" value="<?php echo htmlspecialchars($property->parking); ?>">
                </div>
            </div>
        </div>

        <div class="form-row">
            <label>Description</label>
            <textarea name="description" rows="6"><?php echo htmlspecialchars($property->description ?? ''); ?></textarea>
        </div>

        <?php
            $currentImage = '../assets/images/property-01.jpg';
            if (!empty($property->image)) {
                if (file_exists(__DIR__ . '/../uploads/' . $property->image)) {
                    $currentImage = '../uploads/' . $property->image;
                } else {
                    $currentImage = '../assets/images/' . $property->image;
                }
            }
        ?>

        <div class="form-row">
            <label>Current image</label>
            <div style="margin-bottom:8px;">
                <img src="<?php echo htmlspecialchars($currentImage); ?>" alt="" style="max-width:200px; max-height:140px; border:1px solid #ddd; padding:4px; border-radius:6px;">
            </div>
            <label>Change image (optional)</label>
            <input type="file" name="image" accept=".jpg,.jpeg,.png,.webp">
        </div>

        <div style="display:flex; gap:10px;">
            <button type="submit" class="btn-orange">Update Property</button>
            <a href="admin.php" class="btn-ghost">Cancel</a>
        </div>
    </form>
</div>

<?php require_once 'partials/footer-admin.php'; ?>