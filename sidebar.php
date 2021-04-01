<?php

use Ibd\Ksiazki;

$ksiazki = new Ksiazki();
$lista = $ksiazki->pobierzBestsellery();

?>
<div class="col-md-2">
	<h1>Bestsellery</h1>
    <ul class="list-group">
    <?php foreach ($lista as $ks) : ?>
        <li class="list-group-item" onclick="location.href='ksiazki.szczegoly.php?id=<?= $ks['id'] ?>'">
            <?php if (!empty($ks['zdjecie'])) : ?>
                <img src="zdjecia/<?= $ks['zdjecie'] ?>" alt="<?= $ks['tytul'] ?>" class="img-thumbnail" />
            <?php else : ?>
                brak zdjęcia
            <?php endif; ?>
            <p class="text-center">
                <strong>
                    <?= $ks['imie'] . " " . $ks['nazwisko'] ?>
                </strong>
                <br>
                <?= $ks['tytul'] ?>
            </p>
        </li>

    <?php endforeach; ?>

    </ul>

</div>