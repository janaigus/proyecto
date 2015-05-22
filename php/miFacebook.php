<?php
define('FACEBOOK_SDK_V4_SRC_DIR', './lib/fb-php-sdk-v4/src/Facebook/');
require __DIR__ . './lib/facebook-php-sdk-v4/autoload.php';

// Make sure to load the Facebook SDK for PHP via composer or manually

use Facebook\FacebookSession;
// add other classes you plan to use, e.g.:
// use Facebook\FacebookRequest;
// use Facebook\GraphUser;
// use Facebook\FacebookRequestException;

FacebookSession::setDefaultApplication('1114829315199633', '15bb057040dc852580e2aa07e1036dce');


?>