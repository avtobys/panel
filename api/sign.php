<?php

header("Cache-Control: no-cache");
header("Expires: Thu, 01 Jan 1970 00:00:01 GMT");
header("Content-Type: application/json");

if (!Get::hcaptcha($_POST['h-captcha-response']) || $user->id) {
    exit(json_encode(['status' => 'fail']));
}

switch ($_POST['form']) {
    case 0:
        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $sth = $dbh->prepare("SELECT `id`, `md5password` FROM `users` WHERE `email` = ?");
            $sth->execute([trim($_POST['email'])]);
            $user = $sth->fetch(PDO::FETCH_OBJ);
            if ($user->md5password == md5($_POST['password']) && ($_SESSION['user_id'] = $user->id)) {
                stackJS::add('toast("Welcome!", "Welcome message...");');
                exit(json_encode(['status' => 'ok', 'code' => 'location.reload();']));
            }
        }
        exit(json_encode(['status' => 'service', 'title' => 'Error!', 'body' => 'Wrong password']));
        break;
    case 1:
        if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password2'])) {
            if (!filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL)) {
                exit(json_encode(['status' => 'service', 'title' => 'Error!', 'body' => 'Email not valid']));
            }
            if (mb_strlen(trim($_POST['password']), 'utf-8') < 6 || mb_strlen(trim($_POST['password']), 'utf-8') > 100) {
                exit(json_encode(['status' => 'service', 'title' => 'Error!', 'body' => 'Wrong password']));
            }
            if ($_POST['password'] != $_POST['password2']) {
                exit(json_encode(['status' => 'service', 'title' => 'Error!', 'body' => 'Password mismatch']));
            }
            $email = trim($_POST['email']);
            $sth = $dbh->prepare("SELECT COUNT(*) FROM `users` WHERE `email` = ?");
            $sth->execute([$email]);
            if ($sth->fetchColumn()) {
                exit(json_encode(['status' => 'service', 'title' => 'Error!', 'body' => 'User already exists']));
            }
            $sth = $dbh->prepare("INSERT INTO `users` (`email`, `md5password`) VALUES (?, ?)");
            $sth->execute([$email, md5(trim($_POST['password']))]);
            if ($_SESSION['user_id'] = $dbh->lastInsertId()) {
                $user = new User($_SESSION['user_id']);
                $template_mail = array_map(function ($item) {
                    global $user;
                    $item = str_replace(['%HOST%', '%EMAIL%', '%PASSWORD%'], [$_SERVER['HTTP_HOST'], $user->email, trim($_POST['password'])], $item);
                    return $item;
                }, MAILS_TEMPLATES['SIGN_UP']);
                $subject = '=?UTF-8?B?' . base64_encode($template_mail['subject']) . '?=';
                $headers = "Content-type: text/html; charset=utf-8\r\n";
                $headers .= "From: " . EMAIL . "\r\n";
                SENDMAILS && mail(
                    $user->email,
                    $subject,
                    $template_mail['body'],
                    $headers,
                    '-f ' . EMAIL
                );
                exit(json_encode(['status' => 'ok', 'code' => 'location.reload();']));
            }
        }
        break;
    case 2:
        if (!empty($_POST['email'])) {
            $email = trim($_POST['email']);
            $sth = $dbh->prepare("SELECT * FROM `users` WHERE `email` = ?");
            $sth->execute([$email]);
            if ($user = $sth->fetch(PDO::FETCH_OBJ)) {
                $remind_link = 'http' . (Get::isSecure() ? 's' : '') . '://' . $_SERVER['HTTP_HOST'] . '/remind/' . $user->id . '/' . md5($user->md5password . $user->email);
                $template_mail = array_map(function ($item) {
                    global $user, $remind_link;
                    $item = str_replace(['%HOST%', '%EMAIL%', '%REMIND_LINK%'], [$_SERVER['HTTP_HOST'], $user->email, $remind_link], $item);
                    return $item;
                }, MAILS_TEMPLATES['REMIND_PASSWORD']);
                $subject = '=?UTF-8?B?' . base64_encode($template_mail['subject']) . '?=';
                $headers = "Content-type: text/html; charset=utf-8\r\n";
                $headers .= "From: " . EMAIL . "\r\n";
                SENDMAILS && mail(
                    $user->email,
                    $subject,
                    $template_mail['body'],
                    $headers,
                    '-f ' . EMAIL
                );
                exit(json_encode(['status' => 'service', 'title' => 'Check you e-mail', 'body' => 'Recovery instructions have been sent to your e-mail <b>' . $user->email . '</b><br><small>If you have not received your email, please check your spam folder</small>']));
            }
        }
        break;
}

exit(json_encode(['status' => 'service', 'title' => 'Error!', 'body' => 'Unknown error']));
