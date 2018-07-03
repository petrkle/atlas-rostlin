<?php

define('ROZHLAS', 'http://www.rozhlas.cz');
define('TMP', 'tmp');
define('WWW', 'app/src/main/assets/www');
define('WWWIMG', WWW.'/img');
const PISMENA = array('B','C','Č','D','F','H','J','K','L','M','N','O','P','R','Ř','S','Š','T','U','V','Z','Ž',);
libxml_use_internal_errors(true);
setlocale(LC_CTYPE, 'cs_CZ.UTF-8', 'Czech');

require 'vendor/autoload.php';
$smarty = new Smarty();
