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

    if ($id && $title !== '' && $price > 0) {
        $propertyModel->update($id, $title, $category, $price, $bedrooms, $bathrooms, $area, $floor, $parking, $description, $imageName);
        Redirect::redirect('admin.php');
    }
}

require_once 'partials/header-admin.php';
?>

<div class="admin-card">
    <h2>Edit property #<?php echo (int)$property->id; ?></h2>

    <form method="POST">
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

        <div style="display:flex; gap:10px;">
            <button type="submit" class="btn-orange">Update Property</button>
            <a href="admin.php" class="btn-ghost">Cancel</a>
        </div>
    </form>
</div>

<?php require_once 'partials/footer-admin.php'; ?>