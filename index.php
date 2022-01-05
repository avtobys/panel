<?php

error_reporting(-1);
ob_start();
session_start();

header("Cache-Control: no-cache");
header("Expires: Thu, 01 Jan 1970 00:00:01 GMT");


spl_autoload_register(function ($class) {
    require __DIR__ . '/classes/' . strtolower($class) . '.class.php';
});
require __DIR__ . '/include/config.php';


$dsn = 'mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';port=' . DB_PORT . ';charset=utf8mb4';
try {
    $dbh = new PDO($dsn, DB_USER, DB_PASSWORD);
} catch (PDOException $e) {
    exit($e->getMessage());
}

if (!empty($sql_create_table_users) && !$dbh->query("SHOW TABLES LIKE 'users'")->fetchColumn()) {
    $dbh->exec($sql_create_table_users);
}


/** user session */
$_SESSION['user_id'] = empty($_SESSION['user_id']) ? 0 : $_SESSION['user_id'];
$_SESSION['user_id'] && !empty($_COOKIE['UID']) && ($_SESSION['user_id'] = abs(intval(@Get::idDecrypt($_COOKIE['UID']))));
$user = new User($_SESSION['user_id']);
$user->id && setcookie('UID', Get::idEncrypt($user->id), time() + 86400 * 365, '/', $_SERVER['HTTP_HOST']);
$csrf_token = md5(session_id()); // protection from CSRF attack for forms
if ($_SERVER['REQUEST_METHOD'] == 'POST' && (empty($_POST['csrf']) || $_POST['csrf'] != $csrf_token)) {
    exit('Invalid csrf!');
}

/** route urls */

$request = strtok($_SERVER['REQUEST_URI'], '?');

if ($_SESSION['user_id'] && (!$user->id || ($request == '/exit' && isset($_GET['s']) && $_GET['s'] == session_id()))) { // reset authorization
    unset($_SESSION['user_id']);
    setcookie('UID', false, time() - 86400 * 365, '/', $_SERVER['HTTP_HOST']);
    header("Location: /");
    exit;
}

if (preg_match('#^/api/.+#', $request, $matches) && file_exists(__DIR__ . $matches[0] . '.php')) { // route api if exists php file
    require __DIR__ . $matches[0] . '.php';
    exit;
}

register_shutdown_function(function ($user) {
    ObGetAppend::append();

    /** remove next code in your work project!!! */
    $user->id && ObGetAppend::appendHtml('<div class="dropdown position-fixed" style="right:10px;bottom:10px;">
    <button class="btn btn-secondary btn-lg dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Access level ' . $user->root . '
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
      <a class="dropdown-item' . ($user->root == 0 ? ' disabled' : '') . '" href="/level/0">Level 0</a>
      <a class="dropdown-item' . ($user->root == 1 ? ' disabled' : '') . '" href="/level/1">Level 1</a>
      <a class="dropdown-item' . ($user->root == 2 ? ' disabled' : '') . '" href="/level/2">Level 2</a>
      <a class="dropdown-item' . ($user->root == 3 ? ' disabled' : '') . '" href="/level/3">Level 3</a>
      <a class="dropdown-item' . ($user->root == 4 ? ' disabled' : '') . '" href="/level/4">Level 4</a>
    </div>
  </div>');
    /** end of remove code */
}, $user);

/** remove next code in your work project!!! */
if (preg_match('#^/level/(\d+)#', $request, $matches)) {
    $user->setRoot($matches[1]);
    header("Location: /");
    exit;
}
/** end of remove code */


if ($request == '/' && $user->id && file_exists(__DIR__ . '/tpl/root_' . $user->root . '/main.php')) { // route authorized main page if exists file
    require __DIR__ . '/tpl/root_' . $user->root . '/main.php';
    exit;
}

if ($user->id && file_exists(__DIR__ . '/tpl/root_' . $user->root . $request . '.php')) { // route authorized other pages if exists file
    require __DIR__ . '/tpl/root_' . $user->root . $request . '.php';
    exit;
}

if (($is_remind = (strpos($request, '/remind/') !== false)) || $request == '/') { // route non authorized main page and authorized (with user navbar)
    require __DIR__ . '/tpl/main.php';
    exit;
}

if (file_exists(__DIR__ . '/tpl' . $request . '.php')) { // route user pages not authorized and authorized (with user navbar)
    require __DIR__ . '/tpl' . $request . '.php';
    exit;
}

require __DIR__ . '/tpl/404.php';
