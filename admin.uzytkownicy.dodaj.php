<?php

require_once 'vendor/autoload.php';

use Ibd\Uzytkownicy;
use Valitron\Validator;

$uzytk = new Uzytkownicy();
$v = new Validator($_POST);
$dane = $_POST;

if (!empty($_POST)) {
    $v->rule('required', ['imie', 'nazwisko', 'adres', 'email', 'login', 'haslo', 'grupa']);

    if ($v->validate()) {
        if ($uzytk->dodaj($_POST, $_POST['grupa'])) {
            header("Location: admin.uzytkownicy.lista.php?msg=1");
            exit();
        }
    }
}

include 'admin.header.php';
?>

<h2>
	Użytkownicy
	<small>dodaj</small>
</h2>

<?php if(isset($_GET['msg']) && $_GET['msg'] == 1): ?>
    <p class="alert alert-success">Użytkownik został zapisany.</p>
<?php endif; ?>

<?php include 'admin.uzytkownicy.form.php' ?>

<?php include 'admin.footer.php'; ?>