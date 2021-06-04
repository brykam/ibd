<?php
require_once 'vendor/autoload.php';

//session_start();
use Ibd\Zamowienia;

include 'header.php';
$zamowienia = new Zamowienia();
//var_dump($_SESSION);
if (empty($_SESSION['id_uzytkownika'])) {
    header("Location: index.php?msg=2");
    exit();
}


$listaZamowien = $zamowienia->pobierzWszystkie($_SESSION['id_uzytkownika']);
$order_counter = 1;
$last_order = -1;
$suma = 0;
?>

    <h2>Historia zamówień</h2>

<?php if (count($listaZamowien) > 0): ?>
    <?php for ($i = 0; $i < count($listaZamowien); $i++): ?>
        <?php if ($last_order != $listaZamowien[$i]['id_zamowienia']): ?>
            <?php if ($last_order != -1): ?>
                </tbody>
                </table>
            <div class="text-info text-right">Całkowity koszt: <?= $suma?> zł</div>
            <?php endif;
                  $suma = 0;
            ?>
            <h4>Zamówienie nr <?= $order_counter ?> - <?= $listaZamowien[$i]['data_dodania'] ?> </h4>
            <?php $order_counter++;
                  $last_order = $listaZamowien[$i]['id_zamowienia']; ?>
            <table class="table table-striped table-condensed">
            <thead>
            <tr>
                <th>Tytuł</th>
                <th>Cena (zł)</th>
                <th>Liczba sztuk</th>
                <th>Cena razem (zł)</th>
            </tr>
            </thead>
            <tbody>

        <?php endif; ?>
        <tr>
            <td><?= $listaZamowien[$i]['tytul'] ?></td>
            <td><?= $listaZamowien[$i]['cena'] ?></td>
            <td><?= $listaZamowien[$i]['liczba_sztuk'] ?></td>
            <td><?= $listaZamowien[$i]['cena'] * $listaZamowien[$i]['liczba_sztuk'] ?></td>
            <?php $suma += $listaZamowien[$i]['cena'] * $listaZamowien[$i]['liczba_sztuk'] ?>
        </tr>

    <?php endfor; ?>
    </tbody>
    </table>
    <div class="text-info text-right">Całkowity koszt: <?= $suma?> zł</div>
<?php else: ?>
    <tr>
        <td colspan="8" style="text-align: center">Brak zamówień. Zamów coś!</td>
    </tr>
<?php endif; ?>
<?php include 'footer.php'; ?>