<?php
require_once '../../app/core/App.php';
App::init();

$propertyModel = new Property();

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$property = $id > 0 ? $propertyModel->find($id) : false;

require_once 'partials/header.php';
?>

  <div class="page-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <span class="breadcrumb">
            <a href="index.php">Home</a> / <a href="properties.php">Properties</a> /
            <?php echo $property ? htmlspecialchars($property->title) : 'Not found'; ?>
          </span>
          <h3><?php echo $property ? htmlspecialchars($property->title) : 'Property not found'; ?></h3>
        </div>
      </div>
    </div>
  </div>

<?php if ($property): ?>

  <?php
    $imagePath = '../assets/images/single-property.jpg';
    if (!empty($property->image)) {
        if (file_exists(__DIR__ . '/../uploads/' . $property->image)) {
            $imagePath = '../uploads/' . $property->image;
        } else {
            $imagePath = '../assets/images/' . $property->image;
        }
    }
  ?>

  <div class="single-property section">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="main-image">
            <img src="<?php echo htmlspecialchars($imagePath); ?>" alt="<?php echo htmlspecialchars($property->title); ?>">
          </div>
          <div class="main-content">
            <span class="category"><?php echo htmlspecialchars($property->category); ?></span>
            <h4><?php echo htmlspecialchars($property->title); ?></h4>
            <p><?php echo nl2br(htmlspecialchars($property->description)); ?></p>
            <h3 style="color: #f35525; margin-top: 20px;">
              $<?php echo number_format((float)$property->price, 0, '.', '.'); ?>
            </h3>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="info-table">
            <ul>
              <li>
                <img src="../assets/images/info-icon-01.png" alt="" style="max-width: 52px;">
                <h4><?php echo (int)$property->area; ?> m2<br><span>Total Flat Space</span></h4>
              </li>
              <li>
                <img src="../assets/images/info-icon-02.png" alt="" style="max-width: 52px;">
                <h4><?php echo (int)$property->bedrooms; ?> / <?php echo (int)$property->bathrooms; ?><br><span>Bedrooms / Bathrooms</span></h4>
              </li>
              <li>
                <img src="../assets/images/info-icon-03.png" alt="" style="max-width: 52px;">
                <h4>Floor <?php echo htmlspecialchars($property->floor); ?><br><span>Property Floor</span></h4>
              </li>
              <li>
                <img src="../assets/images/info-icon-04.png" alt="" style="max-width: 52px;">
                <h4><?php echo htmlspecialchars($property->parking); ?><br><span>Parking</span></h4>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <div class="row" style="margin-top:40px;">
        <div class="col-12">
          <a href="properties.php" class="orange-button" style="padding:10px 25px; text-decoration:none;">&laquo; Back to properties</a>
        </div>
      </div>
    </div>
  </div>

<?php else: ?>

  <div class="section">
    <div class="container">
      <div class="text-center" style="padding: 60px 0;">
        <h2>Nehnuteľnosť sa nenašla</h2>
        <p>Požadovaná nehnuteľnosť neexistuje alebo bola odstránená.</p>
        <a href="properties.php" class="orange-button" style="padding:10px 25px; text-decoration:none;">Späť na zoznam</a>
      </div>
    </div>
  </div>

<?php endif; ?>

  <?php require_once 'partials/footer.php'; ?>