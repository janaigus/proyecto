<?php
define('FACEBOOK_SDK_V4_SRC_DIR', './lib/fb-php-sdk-v4/src/Facebook/');
require __DIR__ . './lib/facebook-php-sdk-v4/autoload.php';

// Make sure to load the Facebook SDK for PHP via composer or manually

use Facebook\FacebookSession;
// add other classes you plan to use, e.g.:
// use Facebook\FacebookRequest;
// use Facebook\GraphUser;
// use Facebook\FacebookRequestException;

FacebookSession::setDefaultApplication('YOUR_APP_ID', 'YOUR_APP_SECRET');


?>