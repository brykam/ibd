<?php

require_once 'vendor/autoload.php';

use Ibd\Autorzy;

if(empty($_GET['id'])) {
    header("Location: admin.autorzy.lista.php");
    exit();
} else {
    $id = (int)$_GET['id'];
}

$autorzy = new Autorzy();

if(!empty($_POST)) {
   if($autorzy->edytuj($_POST, $id)) {
       header("Location: admin.autorzy.edycja.php?id=$id&msg=1");
       exit();
   }
}

include 'admin.header.php';

$dane = $autorzy->pobierz($id);
?>

<h2>
	Autorzy
	<small>edycja</small>
</h2>

<?php if(isset($_GET['msg']) && $_GET['msg'] == 1): ?>
    <p class="alert alert-success">Autor został zapisany.</p>
<?php endif; ?>

<form method="post" action="" class="">
    <div class="form-group">
		<label for="imie">Imię</label>
		<input type="text" id="imie" name="imie" class="form-control" value="<?=$dane['imie'] ?>" />
	</div>
	<div class="form-group">
		<label for="nazwisko">Nazwisko</label>
		<input type="text" id="nazwisko" name="nazwisko" class="form-control" value="<?=$dane['nazwisko'] ?>" />
	</div>

	<button type="submit" class="btn btn-primary">Zapisz</button>

</form>

<?php include 'admin.footer.php'; ?>