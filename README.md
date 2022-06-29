# Web panel with unlimited nesting of access rights

+ Perpetual authorization
+ Unlimited nesting of access levels
+ Sign in, sign up, remind password from e-mails. hCaptcha on this important forms
+ Automatically routed urls to php pages in users directories and API
  + route api url if exists php file
  + route authorized main page if exists file
  + route authorized other pages if exists file
  + route non authorized main page and authorized (with user navbar)
  + route user pages not authorized and authorized (with user navbar)
+ Automatically routed navigation bars to existing php files for users with access
+ Automatically active links in the navbar menu for current urls
+ PHP stack with execution timeout for any Javascript code (toast messages or any code)
+ Automatically modals confirmations and non confirmations Javascript actions
+ Automatically protection from CSRF attack for all POST forms
+ Automatic creation of the user table from the configuration file
+ Backend: PDO MySQL + PHP
+ Frontend: Bootstrap v4.6.0 + JQuery
