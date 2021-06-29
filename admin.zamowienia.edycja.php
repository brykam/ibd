<?php
require_once 'vendor/autoload.php';

use Ibd\Zamowienia;
use Valitron\Validator;

if (empty($_GET['id'])) {
    header("Location: admin.ksiazki.lista.php");
    exit();
} else {
    $id = (int)$_GET['id'];
}

$zamowienia = new Zamowienia();


$v = new Validator($_POST);

if (!empty($_POST)) {
    $v->rule('required', ['status']);

    if ($v->validate() && $zamowienia->edytuj($_POST, $id)) {
        var_dump(($_POST));
        header("Location: admin.ksiazki.edycja.php?id=$id&msg=1");
        exit();
    }
    $dane = $_POST;
} else {
    $dane = $zamowienia->pobierz($id);
}


include 'admin.header.php';
$statusy = $zamowienia->pobierzStatusy();
?>

<h2>
    Zamówienie
    <small>edycja</small>
</h2>

<form method="post" action="" enctype="multipart/form-data" id="<?=empty($id)?>">


    <div class="form-group">
        <label for="status">Status</label>
        <select name="status" id="status" class="form-control <?= $v->errors('status') ? 'is-invalid' : '' ?>">
            <?php foreach ($statusy as $stat) : ?>
                <option value="<?= $stat['id'] ?>" <?= ($dane['id_statusu'] ?? '') == $stat['id'] ? 'selected="selected"' : '' ?>><?= $stat['nazwa'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

<button type="submit" class="btn btn-primary">Zapisz</button>
<?php if (!empty($id)): ?>
    <a href="admin.zamowienia.lista.php" class="btn btn-link">powrót</a>
<?php endif; ?>
</form>

<?php if(isset($_GET['msg']) && $_GET['msg'] == 1): ?>
    <p class="alert alert-success">Książka została zapisana.</p>
<?php endif; ?>


<?php include 'admin.footer.php'; ?>
