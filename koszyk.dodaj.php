<?php
ini_set('display_errors',1);
error_reporting(E_ALL|E_STRICT);
session_start();
require_once 'vendor/autoload.php';

use Ibd\Koszyk;

$koszyk = new Koszyk();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['id'])) {
    if ($koszyk->czyIstnieje($_GET['id'], session_id())) {
			// ksiazka już istnieje w koszyku, zwiększ ilość
			// TODO: dodać odpowiednią funkcjonalność
    } else {
			// książki nie ma w koszyku, dodaj do koszyka
			if ($koszyk->dodaj($_GET['id'], session_id())) {
				echo 'ok';
			}
    }
}