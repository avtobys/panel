<!DOCTYPE html>
<html lang="<?= LANGUAGE_CODE ?>">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/tpl/css/bootstrap.min.css">
    <link rel="stylesheet" href="/tpl/css/fa/css/all.min.css">
    <link rel="stylesheet" href="/tpl/css/main.css?<?= filemtime(dirname(__DIR__) . '/css/main.css') ?>">
    <title>Main</title>
</head>

<body>

    <?php
    if (file_exists(__DIR__ . '/navbar.php'))
        require __DIR__ . '/navbar.php';
    else
        require dirname(__DIR__) . '/navbar.php';
    ?>

    <div class="container my-4 py-3 bg-gradient-light shadow-lg">
        <p>index user page root = 1 (access level)</p>
        <p><?= $user->email ?></p>
        <a href="/example_page">/example_page</a> for the access level of this user
    </div>


    <script src="/tpl/js/jquery-3.6.0.min.js"></script>
    <script src="/tpl/js/bootstrap.bundle.min.js"></script>
    <script src="/tpl/js/main.js?<?= filemtime(dirname(__DIR__) . '/js/main.js') ?>"></script>
</body>

</html>
