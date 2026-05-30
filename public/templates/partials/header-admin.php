<?php
    require_once '../../app/core/App.php';
    App::init();

    if (!Auth::check()) {
    Redirect::redirect('login.php');
}

$currentUser = Auth::user();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title><?php echo Helper::getPageTitle(); ?></title>

    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../assets/css/templatemo-villa-agency.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>

<nav class="admin-nav">
    <div class="container">
        <a href="admin.php"><strong>Villa Admin</strong></a>
        <a href="admin.php">Dashboard</a>
        <a href="index.php">View Site</a>
        <span style="float:right; color:#aaa; padding-top:8px;">
            Prihlásený ako <strong style="color:#fff;"><?php echo htmlspecialchars($currentUser->name); ?></strong>
            | <a href="logout.php" style="color:#f35525;">Logout</a>
        </span>
    </div>
</nav>

<div class="admin-wrap">
<div class="container"></div>