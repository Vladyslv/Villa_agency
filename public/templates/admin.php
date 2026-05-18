<?php
require_once '../../app/core/App.php';
App::init();

$propertyModel = new Property();
$contactModel = new Contact();

$properties = $propertyModel->all();
$contacts = $contactModel->all();

require_once 'partials/header-admin.php';
?>

<h1 style="margin-bottom: 6px; margin-left: 20px;">Admin Dashboard</h1>
<p style="color: #777; margin-bottom: 30px; margin-left: 20px">Prehľad nehnuteľností a kontaktných správ.</p>

<div class="row">
    <div class="col-md-4">
        <div class="admin-card stat-card">
            <h3><?php echo count($properties); ?></h3>
            <p>Properties celkom</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="admin-card stat-card">
            <h3><?php echo count($contacts); ?></h3>
            <p>Správy z kontaktu</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="admin-card stat-card">
            <h3>
                <?php
                    $totalValue = 0;
                    foreach ($properties as $p) {
                        $totalValue += (float)$p->price;
                    }
                    echo '$' . number_format($totalValue, 0, '.', '.');
                ?>
            </h3>
            <p>Celková hodnota</p>
        </div>
    </div>
</div>

<div class="admin-card">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:18px;">
        <h2 style="margin:0;">Properties</h2>
        <a href="property-create.php" class="btn-orange">+ New Property</a>
    </div>

    <?php if (empty($properties)): ?>
        <p style="color:#777;">Zatiaľ žiadne nehnuteľnosti v databáze.</p>
    <?php else: ?>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Beds / Baths</th>
                    <th>Area</th>
                    <th>Created</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($properties as $p): ?>
                    <tr>
                        <td>#<?php echo (int)$p->id; ?></td>
                        <td><?php echo htmlspecialchars($p->title); ?></td>
                        <td><?php echo htmlspecialchars($p->category); ?></td>
                        <td>$<?php echo number_format((float)$p->price, 0, '.', '.'); ?></td>
                        <td><?php echo (int)$p->bedrooms; ?> / <?php echo (int)$p->bathrooms; ?></td>
                        <td><?php echo (int)$p->area; ?>m²</td>
                        <td><?php echo date('d.m.Y', strtotime($p->created_at)); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<div class="admin-card">
    <h2>Kontaktné správy</h2>

    <?php if (empty($contacts)): ?>
        <p style="color:#777;">Zatiaľ žiadne správy z kontaktného formulára.</p>
    <?php else: ?>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Meno</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Správa</th>
                    <th>Dátum</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contacts as $c): ?>
                    <tr>
                        <td>#<?php echo (int)$c->id; ?></td>
                        <td><?php echo htmlspecialchars($c->name); ?></td>
                        <td><a href="mailto:<?php echo htmlspecialchars($c->email); ?>"><?php echo htmlspecialchars($c->email); ?></a></td>
                        <td><?php echo htmlspecialchars($c->subject ?? ''); ?></td>
                        <td style="max-width:300px;"><?php echo nl2br(htmlspecialchars(mb_substr($c->message, 0, 150))); ?><?php echo mb_strlen($c->message) > 150 ? '...' : ''; ?></td>
                        <td><?php echo date('d.m.Y H:i', strtotime($c->created_at)); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php require_once 'partials/footer-admin.php'; ?>