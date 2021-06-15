<?php
require_once 'vendor/autoload.php';
include 'admin.header.php';

use Ibd\Ksiazki;
use Ibd\Kategorie;
use Ibd\Autorzy;
use Valitron\Validator;

$ksiazki = new Ksiazki();
$v = new Validator($_POST);
$dane = $_POST;

if (!empty($_POST)) {
    $v->rule('required', ['tytul', 'id_kategorii', 'id_autora', 'cena', 'isbn', 'opis']);

    if ($v->validate()) {
        if ($ksiazki->dodaj($_POST, $_FILES)) {
            header("Location: admin.ksiazki.lista.php?msg=1");
            exit();
        }
    }
}

// pobieranie kategorii
$kategorie = new Kategorie();
$listaKategorii = $kategorie->pobierzWszystkie();

$autorzy = new Autorzy();
$listaAutorow = $autorzy->pobierzWszystko("SELECT * FROM autorzy");
?>

<h2>
	Książki
	<small>dodaj</small>
</h2>

<?php include 'admin.ksiazki.form.php' ?>

<?php include 'admin.footer.php'; ?>