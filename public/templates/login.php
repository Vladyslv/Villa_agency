<?php
require_once '../../app/core/App.php';
App::init();

if (Auth::check()) {
    Redirect::redirect('admin.php');
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($email === '' || $password === '') {
        $error = 'Vyplňte email aj heslo.';
    } else {
        $auth = new Auth();
        if ($auth->login($email, $password)) {
            Redirect::redirect('admin.php');
        } else {
            $error = 'Nesprávny email alebo heslo.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo Helper::getPageTitle(); ?></title>
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/templatemo-villa-agency.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="login-wrap">
        <div class="login-card">
            <h1>Admin Login</h1>
            <p class="login-subtitle">Prihláste sa do administrácie</p>

            <?php if ($error !== ''): ?>
                <div class="login-error"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="form-row">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="admin@villa.local" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
                </div>

                <div class="form-row">
                    <label for="password">Heslo</label>
                    <input type="password" name="password" id="password" placeholder="********" required>
                </div>

                <button type="submit" class="btn-orange" style="width:100%; padding:12px;">Prihlásiť sa</button>
            </form>

            <a href="index.php" class="login-back">&laquo; Späť na stránku</a>
            <div class="login-hint">Default: admin@villa.local / admin123</div>
        </div>
    </div>
</body>
</html>