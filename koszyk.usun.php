<?php
ini_set('display_errors',1);
error_reporting(E_ALL|E_STRICT);
session_start();
require_once 'vendor/autoload.php';

$koszyk = new Ibd\Koszyk();

if(isset($_GET['id_koszyka'])) {
    $koszyk->zmienLiczbeSztuk([$_GET['id_koszyka'] => 0]);
    include 'koszyk.lista.php';
}