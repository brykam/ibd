<?php

require_once 'vendor/autoload.php';

use Ibd\Autorzy;

$autorzy = new Autorzy();

if (!empty($_POST)) {
    $autorzy = new Autorzy();
    if ($autorzy->dodaj($_POST)) {
        header("Location: admin.autorzy.lista.php?msg=1");
    }
}

include 'admin.header.php';

?>

<h2>
	Autorzy
	<small>dodaj</small>
</h2>

<form method="post" action="" class="">
    <div class="form-group">
		<label for="imie">Imię</label>
		<input type="text" id="imie" name="imie" class="form-control" />
	</div>
	<div class="form-group">
		<label for="nazwisko">Nazwisko</label>
		<input type="text" id="nazwisko" name="nazwisko" class="form-control" />
	</div>

	<button type="submit" class="btn btn-primary">Zapisz</button>

</form>

<?php include 'admin.footer.php'; ?>