<?php

header("Cache-Control: no-cache");
header("Expires: Thu, 01 Jan 1970 00:00:01 GMT");
header("Content-Type: application/json");

exit(json_encode(['status' => 'ok', 'REQUEST_URI' => $_SERVER['REQUEST_URI'], 'SCRIPT_NAME' => $_SERVER['SCRIPT_NAME'], 'POST data from ajax' => $_POST]));
