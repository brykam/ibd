<?php
require_once 'vendor/autoload.php';
session_start();

use Ibd\Koszyk, Ibd\Zamowienia;

if (empty($_SESSION['id_uzytkownika'])) {
	header("Location: index.php");
	exit();
}
	
$koszyk = new Koszyk();
$zamowienia = new Zamowienia();
$listaKsiazek = $koszyk->pobierzWszystkie(session_id());

if (isset($_POST['zamow'])) {
    $idZamowienia = $zamowienia->dodaj($_SESSION['id_uzytkownika']);
    $zamowienia->dodajSzczegoly($idZamowienia, $listaKsiazek);
    $koszyk->wyczysc(session_id());

    header("Location: index.php?msg=3");
}

include 'header.php';
?>

<h1>Finalizacja zamówienia</h1>

<form method="post" action="">

<table class="table table-striped table-condensed">
	<thead>
		<tr>
			<th>&nbsp;</th>
			<th>Tytuł</th>
			<th>Autor</th>
			<th>Kategoria</th>
			<th>Cena PLN</th>
			<th>Liczba sztuk</th>
			<th>Cena razem</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($listaKsiazek as $ks): ?>
		<tr>
            <td style="width: 100px">
                <?php if (!empty($ks['zdjecie'])): ?>
                    <img src="zdjecia/<?=$ks['zdjecie']?>" alt="<?=$ks['tytul']?>" class="img-thumbnail" />
                <?php else: ?>
                    brak zdjęcia
                <?php endif; ?>
			</td>
			<td><?=$ks['tytul']?></td>
			<td><?=$ks['id_autora']?></td>
			<td><?=$ks['id_kategorii']?></td>
			<td><?=$ks['cena']?> zł</td>
			<td><?=$ks['liczba_sztuk']?></td>
			<td><?=$ks['cena']*$ks['liczba_sztuk']?> zł</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
    <tfoot>
		<tr>
			<td colspan="7" class="text-right">
				<input type="submit" name="zamow" class="btn btn-primary btn-sm" value="Złóż zamówienie" />
				<a href="koszyk.lista.php" class="btn btn-link btn-sm">Powrót do koszyka</a>
			</td>
		</tr>
    </tfoot>

</table>

</form>

<?php include 'footer.php'; ?>