<?php

require_once 'vendor/autoload.php';

use Ibd\Kategorie;

$kategorie = new Kategorie();

if (!empty($_POST)) {
    $kategorie = new Kategorie();
    if ($kategorie->dodaj($_POST)) {
        header("Location: admin.kategorie.lista.php?msg=1");
    }
}

include 'admin.header.php';

?>

<h2>
	Kategorie
	<small>dodaj</small>
</h2>

<form method="post" action="" class="">
    <div class="form-group">
		<label for="kategoria">Kategoria</label>
		<input type="text" id="kategoria" name="kategoria" class="form-control" />
	</div>
	<button type="submit" class="btn btn-primary">Zapisz</button>

</form>

<?php include 'admin.footer.php'; ?>