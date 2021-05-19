<?php
require_once 'vendor/autoload.php';
session_start();

use Ibd\Uzytkownicy;

if (!empty($_POST)) {
    $uzytkownicy = new Uzytkownicy();
    $wynik = $uzytkownicy->zaloguj($_POST['login'], $_POST['haslo'], 'użytkownik');
    if ($wynik) {
        header("Location: $_POST[powrot]");
        exit();
    }
}

header("Location: index.php");