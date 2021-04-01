<?php

// jesli nie podano parametru id, przekieruj do listy książek
if(empty($_GET['id'])) {
    header("Location: ksiazki.lista.php");
    exit();
}

$id = (int)$_GET['id'];

include 'header.php';

use Ibd\Ksiazki;

$ksiazki = new Ksiazki();
$dane = $ksiazki->pobierz($id);
?>

<h2><?=$dane['tytul']?></h2>

    <div class="row">
        <div class="col-3">
            <?php if (!empty($dane['zdjecie'])) : ?>
                <img src="zdjecia/<?= $dane['zdjecie'] ?>" alt="<?= $dane['tytul'] ?>" class="img-thumbnail" />
            <?php else : ?>
                brak zdjęcia
            <?php endif; ?>
        </div>

        <div class="col-7">
            <table class="table">
                <tr>
                    <td>Opis</td>
                    <td><?= $dane['opis'] ?></td>
                </tr>
                <tr>
                    <td>Cena</td>
                    <td><?= $dane['cena'] ?></td>
                </tr>
                <tr>
                    <td>Liczba stron</td>
                    <td><?= $dane['liczba_stron'] ?></td>
                </tr>
                <tr>
                    <td>ISBN</td>
                    <td><?= $dane['isbn'] ?></td>
                </tr>

            </table>
        </div>
</div>


<p>
	<a href="ksiazki.lista.php"><i class="fas fa-chevron-left"></i> Powrót</a>
</p>


<?php include 'footer.php'; ?>