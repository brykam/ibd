<?php

use Ibd\Ksiazki;

ini_set('display_errors',1);
error_reporting(E_ALL|E_STRICT);
session_start();

require_once 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ksiazki = new Ksiazki();
    if ($ksiazki->usun($_GET['id'])) {
      echo 'ok';
    }
}