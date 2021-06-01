<?php

require_once 'vendor/autoload.php';

use Ibd\Uzytkownicy;
use Valitron\Validator;

if(empty($_GET['id'])) {
    header("Location: admin.uzytkownicy.lista.php");
    exit();
} else {
    $id = (int)$_GET['id'];
}

$uzytk = new Uzytkownicy();
$v = new Validator($_POST);

if(!empty($_POST)) {
    $v->rule('required', ['imie', 'nazwisko', 'adres', 'email', 'login', 'grupa']);
    $dane = $_POST;

    if ($v->validate()) {
        if ($uzytk->edytuj($_POST, $id)) {
            header("Location: admin.uzytkownicy.edycja.php?id=$id&msg=1");
            exit();
        }
    }
} else {
	$dane = $uzytk->pobierz($id);
}

include 'admin.header.php';
?>

<h2>
	Użytkownicy
	<small>edycja</small>
</h2>

<?php if(isset($_GET['msg']) && $_GET['msg'] == 1): ?>
    <p class="alert alert-success">Użytkownik został zapisany.</p>
<?php endif; ?>

<?php include 'admin.uzytkownicy.form.php' ?>

<?php include 'admin.footer.php'; ?>