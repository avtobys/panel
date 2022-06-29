<?php

// database
const DB_HOST = 'localhost';
const DB_NAME = 'db_name';
const DB_USER = 'db_user';
const DB_PASSWORD = 'db_password';
const DB_PORT = '3306';

const LANGUAGE_CODE = 'en';

// hcaptcha sitekey
const SITEKEY = 'sitekey string';
const SECRETSITEKEY = 'secret sitekey string';

const EMAIL = 'info@example.com'; // e-mail address From send mail headers

/**
 * replacements
 * %HOST%      => $_SERVER['HTTP_HOST']
 * %EMAIL%     => user email
 * %PASSWORD%  => user password
 * %REMIND_LINK%      => link for remind password
 */
const MAILS_TEMPLATES = [
  'SIGN_UP' => [
    'subject' => 'You sign up on %HOST%',
    'body' => 'You sign up on <b>%HOST%</b><br><br>E-mail: %EMAIL%<br>Password: %PASSWORD%'
  ],
  'REMIND_PASSWORD' => [
    'subject' => 'Remind password on %HOST%',
    'body' => 'For remind you password on <b>%HOST%</b><br><br>Click this link: <a href="%REMIND_LINK%">%REMIND_LINK%</a>'
  ]
];

const SENDMAILS = true; // enables or disables sending emails

const ONLINE_UPDATE_TIMEOUT = 30; // online update every this seconds

$_BRAND = $_SERVER['HTTP_HOST'];




$sql_create_table_users = 'CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `root` tinyint(1) NOT NULL,
  `email` varchar(255) NOT NULL,
  `md5password` varchar(32) NOT NULL,
  `date_online` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_created` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `email_md5password` (`email`,`md5password`) USING BTREE
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8';

