<?php

define('ROZHLAS', 'http://www.rozhlas.cz');
define('TMP', 'tmp');
define('WWW', 'app/src/main/assets/www');
define('WWWIMG', WWW.'/img');
define('APPNAME', 'Atlas rostlin');
define('IMGEXT', '.jpeg');
const PISMENA = array('B','C','Č','D','F','H','J','K','L','M','N','O','P','R','Ř','S','Š','T','U','V','Z','Ž',);

const MESICE = array(
  '2' => array('únor'),
  '3' => array('březen', 'březne'),
  '4' => array('duben'),
  '5' => array('květen'),
  '6' => array('červen'),
  '7' => array('červenec'),
  '8' => array('srpen', 'srpenc'),
  '9' => array('září'),
  '10' => array('říjen', 'říjenč', 'říječn'),
  '11' => array('listopad'),
);

const MESICEASCII = array(
  '2' => 'unor',
  '3' => 'brezen',
  '4' => 'duben',
  '5' => 'kveten',
  '6' => 'cerven',
  '7' => 'cervenec',
  '8' => 'srpen',
  '9' => 'zari',
  '10' => 'rijen',
  '11' => 'listopad',
);

libxml_use_internal_errors(true);
setlocale(LC_CTYPE, 'cs_CZ.UTF-8', 'Czech');

require 'vendor/autoload.php';
$smarty = new Smarty();
