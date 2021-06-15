<?php
require_once 'vendor/autoload.php';
include 'admin.header.php';

use Ibd\Ksiazki;
use Ibd\Kategorie;
use Ibd\Autorzy;

$ksiazki = new Ksiazki();

$lista = $ksiazki->pobierzWszystkie();

// pobieranie kategorii
$kategorie = new Kategorie();
$listaKategorii = $kategorie->pobierzWszystkie();

$autorzy = new Autorzy();
$listaAutorow = $autorzy->pobierzWszystko("SELECT * FROM autorzy");
?>

<h2>
	Książki
	<small><a href="admin.ksiazki.dodaj.php">dodaj</a></small>
</h2>

<?php if (isset($_GET['msg']) && $_GET['msg'] == 1) : ?>
	<p class="alert alert-success">Książka została dodana.</p>
<?php endif; ?>

<table id="ksiazki" class="table table-striped table-condensed">
	<thead>
		<tr>
			<th>&nbsp;</th>
			<th>Id</th>
			<th>Tytuł</th>
			<th>Autor</th>
			<th>Kategoria</th>
			<th>Cena PLN</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($lista as $ks) : ?>
			<tr>
                <td style="width: 100px">
                    <?php if(!empty($ks['zdjecie'])): ?>
                        <img src="zdjecia/<?= $ks['zdjecie'] ?>" alt="<?= $ks['tytul'] ?>" class="img-thumbnail" />
                    <?php else: ?>
                        brak zdjęcia
                    <?php endif; ?>
                </td>
				<td><?= $ks['id'] ?></td>
				<td><?= $ks['tytul'] ?></td>
				<td><?= $ks['autor'] ?></td>
				<td><?= $ks['kategoria'] ?></td>
				<td><?= $ks['cena'] ?></td>
				<td>
					<a href="admin.ksiazki.edycja.php?id=<?= $ks['id'] ?>" title="edycja"><em class="fas fa-pencil-alt"></em></a>
					<a href="admin.ksiazki.usun.php?id=<?= $ks['id'] ?>" title="usuń" class="aUsunKsiazke"><em class="fas fa-trash"></em></a>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<?php include 'admin.footer.php'; ?>