<?php

require_once 'vendor/autoload.php';

use Ibd\Ksiazki;
use Ibd\Kategorie;
use Ibd\Autorzy;
use Valitron\Validator;

if (empty($_GET['id'])) {
    header("Location: admin.ksiazki.lista.php");
    exit();
} else {
    $id = (int)$_GET['id'];
}

$ksiazki = new Ksiazki();
$v = new Validator($_POST);

if (!empty($_POST)) {
    $v->rule('required', ['tytul', 'id_kategorii', 'id_autora', 'cena', 'isbn', 'opis']);

    if ($v->validate() && $ksiazki->edytuj($_POST, $id, $_FILES)) {
       header("Location: admin.ksiazki.edycja.php?id=$id&msg=1");
       exit();
   }
   $dane = $_POST;
} else {
    $dane = $ksiazki->pobierz($id);
}

include 'admin.header.php';

// pobieranie kategorii
$kategorie = new Kategorie();
$listaKategorii = $kategorie->pobierzWszystkie();

$autorzy = new Autorzy();
$listaAutorow = $autorzy->pobierzWszystko("SELECT * FROM autorzy");
?>

<h2>
	Książki
	<small>edycja</small>
</h2>

<?php if(isset($_GET['msg']) && $_GET['msg'] == 1): ?>
	<p class="alert alert-success">Książka została zapisana.</p>
<?php endif; ?>

<?php include 'admin.ksiazki.form.php' ?>

<?php include 'admin.footer.php'; ?>