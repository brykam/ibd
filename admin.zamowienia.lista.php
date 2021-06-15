<?php
require_once 'vendor/autoload.php';
include 'admin.header.php';

use Ibd\Zamowienia;

$zamowienia = new Zamowienia();

$lista = $zamowienia->pobierzWszystkie();
?>

<h2>Zamówienia</h2>

<table id="zamowienia" class="table table-striped">
	<thead>
		<tr>
		<th>Id</th>
		<th>Użytkownik</th>
		<th>Status</th>
		<th>Suma</th>
		<th>Liczba produktów</th>
		<th>Liczba sztuk</th>
		<th>Data dodania</th>
		<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($lista as $z): ?>
			<tr>
				<td><?=$z['id']?></td>
				<td><?=$z['login']?></td>
				<td><?=$z['status']?></td>
				<td><?=$z['suma']?></td>
				<td><?=$z['liczba_produktow']?></td>
				<td><?=$z['liczba_sztuk']?></td>
				<td><?=$z['data_dodania']?></td>
				<td>
					<a href="admin.zamowienia.szczegoly.php?id=<?= $z['id'] ?>" title="szczegoly"><em class="fas fa-pencil"></em></a>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<?php include 'admin.footer.php'; ?>