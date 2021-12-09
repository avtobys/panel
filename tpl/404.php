<?php

ob_clean();
http_response_code(404);

header("Cache-Control: no-cache");
header("Expires: Thu, 01 Jan 1970 00:00:01 GMT");
?>
<!DOCTYPE html>
<html lang="<?= LANGUAGE_CODE ?>">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/tpl/css/bootstrap.min.css">
    <link rel="stylesheet" href="/tpl/css/fa/css/all.min.css">
    <link rel="stylesheet" href="/tpl/css/main.css?<?= filemtime(__DIR__ . '/css/main.css') ?>">
    <title>404 Not Found</title>
</head>

<body>

    <main class="position-fixed h-100 w-100" role="main" style="top: 0; left: 0;">
        <div class="d-flex justify-content-center align-items-center flex-column h-100 text-danger">
            <div style="font-size:100px;line-height: 1;"><i class="fas fa-exclamation-triangle"></i></div>
            <div class="mt-3" style="font-size:100px;font-weight: 700;line-height: 1;">404</div>
            <a class="mt-3" href="/"><?= $_SERVER['HTTP_HOST'] ?></a>
        </div>
    </main>

    <script src="/tpl/js/jquery-3.6.0.min.js"></script>
    <script src="/tpl/js/bootstrap.bundle.min.js"></script>
    <script src="/tpl/js/main.js?<?= filemtime(__DIR__ . '/js/main.js') ?>"></script>
</body>

</html>
<?php exit; ?>