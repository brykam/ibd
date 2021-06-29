<?php
require_once 'vendor/autoload.php';
include 'admin.header.php';

use Ibd\Zamowienia;

$id = (int)$_GET['id'];
$zamowienia = new Zamowienia();

$lista = $zamowienia->pobierzZamowienie($id);
$suma = 0;
?>


<h2>Sczegóły zamówienia - #<?=$id?>, data dodania: <?=$lista[0]['data_dodania']?></h2>
<h4>Użytkownik: <?=$lista[0]['login']?></h4>
<h5>Status: <strong><?=$lista[0]['status']?></strong></h5>



<table id="zamowienia" class="table table-striped">
    <thead>
    <tr>
        <th>&nbsp;</th>
        <th>Tytuł</th>
        <th>Autor</th>
        <th>Cena (zł)</th>
        <th>Liczba sztuk</th>
        <th>Cena razem (zł)</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($lista as $z): ?>
        <tr>
            <td style="width: 100px">
                <?php if (!empty($z['zdjecie'])): ?>
                    <img src="zdjecia/<?= $z['zdjecie'] ?>" alt="<?= $z['tytul'] ?>" class="img-thumbnail"/>
                <?php else: ?>
                    brak zdjęcia
                <?php endif; ?>
            </td>
            <td><?=$z['tytul']?></td>
            <td><?=$z['autor']?></td>
            <td><?=$z['cena']?></td>
            <td><?=$z['liczba_sztuk']?></td>
            <td><?=$z['cena']*$z['liczba_sztuk']?></td>
            <?php $suma +=$z['cena']*$z['liczba_sztuk']?>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<div class="text-info text-right">Całkowity koszt: <?= $suma?> zł</div>

<?php include 'admin.footer.php'; ?>