<?php
include 'header.php';

use Ibd\Ksiazki;

$ksiazki = new Ksiazki();
$lista = $ksiazki->pobierzWszystkie();
?>

<h1>Książki</h1>

<table class="table table-striped table-condensed">
	<thead>
		<tr>
			<th>&nbsp;</th>
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
					<?php if (!empty($ks['zdjecie'])) : ?>
						<img src="zdjecia/<?= $ks['zdjecie'] ?>" alt="<?= $ks['tytul'] ?>" class="img-thumbnail" />
					<?php else : ?>
						brak zdjęcia
					<?php endif; ?>
				</td>
				<td><?= $ks['tytul'] ?></td>
				<td><?= $ks['imie'] . " " . $ks['nazwisko'] ?></td>
				<td><?= $ks['kategoria'] ?></td>
				<td><?= $ks['cena'] ?></td>
				<td>
					<a href="#" title="dodaj do koszyka"><i class="fas fa-cart-plus"></i></a>
					<a href="ksiazki.szczegoly.php?id=<?= $ks['id'] ?>" title="szczegóły"><i class="fas fa-folder-open"></i></a>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<?php include 'footer.php'; ?>