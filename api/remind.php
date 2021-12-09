<?php

header("Cache-Control: no-cache");
header("Expires: Thu, 01 Jan 1970 00:00:01 GMT");
header("Content-Type: application/json");

if (
    !$user->id &&
    !empty($_POST['request']) &&
    !empty($_POST['password']) &&
    !empty($_POST['password2']) &&
    ($arr = explode('/', $_POST['request'])) &&
    count($arr) == 4
) {
    if ($_POST['password'] != $_POST['password2']) {
        exit(json_encode(['status' => 'service', 'title' => 'Error!', 'body' => 'Password mismatch']));
    }
    $user = new User($arr[2]);
    if ($user->id && md5($user->md5password . $user->email) == $arr[3] && ($_SESSION['user_id'] = $user->id)) {
        $user->setPassword($_POST['password']);
        stackJS::add('toast("Welcome!", "Welcome message...");');
        stackJS::add('toast("Passowrd changed!", "You password has been changed!");');
        exit(json_encode(['status' => 'ok', 'code' => 'location.href="/";']));
    }
}

exit(json_encode(['status' => 'service', 'title' => 'Error!', 'body' => 'Unknown error']));
