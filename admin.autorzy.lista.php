<?php

require_once 'vendor/autoload.php';

use Ibd\Autorzy;

$autorzy = new Autorzy();
$select = $autorzy->pobierzSelect();
$lista = $autorzy->pobierzWszystko($select);

include 'admin.header.php';
?>

<h2>
    Autorzy
    <small><a href="admin.autorzy.dodaj.php">dodaj</a></small>
</h2>

<?php if (isset($_GET['msg']) && $_GET['msg'] == 1): ?>
    <p class="alert alert-success">Autor został dodany.</p>
<?php endif; ?>

<table id="autorzy" class="table table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Imię</th>
            <th>Nazwisko</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($lista as $a): ?>
            <tr>
                <td><?= $a['id'] ?></td>
                <td><?= $a['imie'] ?></td>
                <td><?= $a['nazwisko'] ?></td>
                <td>
                    <a href="admin.autorzy.edycja.php?id=<?= $a['id'] ?>" title="edycja" class="aEdytujAutora"><em class="fas fa-pencil-alt"></em></a>
                    <a href="admin.autorzy.usun.php?id=<?= $a['id'] ?>" title="usuń" class="aUsunAutora"><em class="fas fa-trash"></em></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include 'admin.footer.php'; ?>