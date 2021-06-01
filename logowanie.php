<?php
require_once 'vendor/autoload.php';
session_start();

use Ibd\Uzytkownicy;
var_dump($_POST);
echo "W logowaniu";
if (!empty($_POST)) {
    $uzytkownicy = new Uzytkownicy();
    $wynik = $uzytkownicy->zaloguj($_POST['login'], $_POST['haslo'], 'użytkownik');
    var_dump($wynik);
    if ($wynik) {
        header("Location: $_POST[powrot]");
        exit();
    }
}

header("Location: index.php");