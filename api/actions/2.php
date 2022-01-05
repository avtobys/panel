<?php

header("Cache-Control: no-cache");
header("Expires: Thu, 01 Jan 1970 00:00:01 GMT");
header("Content-Type: application/json");

exit(json_encode(['status' => 'ok', 'REQUEST_URI' => $_SERVER['REQUEST_URI'], '__FILE__' => str_replace(dirname(__FILE__, 3), '...', __FILE__), 'PHP_SELF' => $_SERVER['PHP_SELF'], 'POST data from ajax' => $_POST]));
