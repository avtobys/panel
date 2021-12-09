<!DOCTYPE html>
<html lang="<?= LANGUAGE_CODE ?>">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/tpl/css/bootstrap.min.css">
    <link rel="stylesheet" href="/tpl/css/fa/css/all.min.css">
    <link rel="stylesheet" href="/tpl/css/main.css?<?= filemtime(__DIR__ . '/css/main.css') ?>">
    <title>Example page</title>
</head>

<body>

    <?php
    if ($user->id && file_exists(__DIR__ . '/root_' . $user->root . '/navbar.php'))
        require __DIR__ . '/root_' . $user->root . '/navbar.php';
    else
        require __DIR__ . '/navbar.php';
    ?>

    <div class="container my-4 py-3 bg-gradient-light shadow-lg">
        <p>example user page not authorized and authorized (with user navbar)</p>
        <p>For Link 2 (this url) automatically added class active</p>
    </div>


    <script src="/tpl/js/jquery-3.6.0.min.js"></script>
    <script src="/tpl/js/bootstrap.bundle.min.js"></script>
    <script src="/tpl/js/main.js?<?= filemtime(__DIR__ . '/js/main.js') ?>"></script>
</body>

</html>