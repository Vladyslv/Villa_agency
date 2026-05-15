<?php
require_once '../../app/core/App.php';
App::init();

$propertyModel = new Property();
$properties = $propertyModel->all();

require_once 'partials/header.php';
?>

  <div class="page-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <span class="breadcrumb"><a href="index.php">Home</a> / Properties</span>
          <h3>Properties</h3>
        </div>
      </div>
    </div>
  </div>

  <div class="section properties">
    <div class="container">
      <ul class="properties-filter">
        <li><a class="is_active" href="#!" data-filter="*">Show All</a></li>
        <li><a href="#!" data-filter=".apartment">Apartment</a></li>
        <li><a href="#!" data-filter=".villa">Villa House</a></li>
        <li><a href="#!" data-filter=".penthouse">Penthouse</a></li>
        <li><a href="#!" data-filter=".condo">Modern Condo</a></li>
      </ul>

      <div class="row properties-box">
        <?php if (!empty($properties)): ?>
          <?php foreach ($properties as $p): ?>
            <?php
              $imagePath = '../assets/images/property-01.jpg';
              if (!empty($p->image)) {
                  if (file_exists(__DIR__ . '/../uploads/' . $p->image)) {
                      $imagePath = '../uploads/' . $p->image;
                  } else {
                      $imagePath = '../assets/images/' . $p->image;
                  }
              }

              $cat = strtolower($p->category);
              $cssClass = 'apartment';
              if (str_contains($cat, 'villa')) {
                  $cssClass = 'villa';
              } elseif (str_contains($cat, 'penthouse')) {
                  $cssClass = 'penthouse';
              } elseif (str_contains($cat, 'condo')) {
                  $cssClass = 'condo';
              }
            ?>
            <div class="col-lg-4 col-md-6 align-self-center mb-30 properties-items <?php echo $cssClass; ?>">
              <div class="item">
                <a href="property-details.php?id=<?php echo $p->id; ?>">
                  <img src="<?php echo htmlspecialchars($imagePath); ?>" alt="<?php echo htmlspecialchars($p->title); ?>">
                </a>
                <span class="category"><?php echo htmlspecialchars($p->category); ?></span>
                <h6>$<?php echo number_format((float)$p->price, 0, '.', '.'); ?></h6>
                <h4>
                  <a href="property-details.php?id=<?php echo $p->id; ?>">
                    <?php echo htmlspecialchars($p->title); ?>
                  </a>
                </h4>
                <ul>
                  <li>Bedrooms: <span><?php echo (int)$p->bedrooms; ?></span></li>
                  <li>Bathrooms: <span><?php echo (int)$p->bathrooms; ?></span></li>
                  <li>Area: <span><?php echo (int)$p->area; ?>m2</span></li>
                  <li>Floor: <span><?php echo htmlspecialchars($p->floor); ?></span></li>
                  <li>Parking: <span><?php echo htmlspecialchars($p->parking); ?></span></li>
                </ul>
                <div class="main-button">
                  <a href="property-details.php?id=<?php echo $p->id; ?>">Schedule a visit</a>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="col-12 text-center">
            <p>Žiadne nehnuteľnosti zatiaľ nie sú v databáze.</p>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <?php require_once 'partials/footer.php'; ?>