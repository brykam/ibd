<?php

use Ibd\Ksiazki;

$ksiazki = new Ksiazki();
$lista = $ksiazki->pobierzBestsellery();

?>
<div class="col-md-3">
    <?php if (empty($_SESSION['id_uzytkownika'])): ?>
        <h1>Logowanie</h1>

        <form method="post" action="logowanie.php">
            <div class="form-group">
                <label for="login">Login:</label>
                <input type="text" id="login" name="login" class="form-control input-sm" />
            </div>
            <div class="form-group">
                <label for="haslo">Hasło:</label>
                <input type="password" id="haslo" name="haslo" class="form-control input-sm" />
            </div>
            <div class="form-group">
                <button type="submit" name="zaloguj" id="submit" class="btn btn-primary btn-sm">Zaloguj się</button>
                <a href="rejestracja.php" class="btn btn-link btn-sm">Zarejestruj się</a>
                <input type="hidden" name="powrot" value="<?= basename($_SERVER['SCRIPT_NAME']) ?>" />
            </div>
        </form>
    <?php else: ?>
        <p class="text-right">
            Zalogowany: <strong><?= $_SESSION['login'] ?></strong>
            &nbsp;
            <a href="wyloguj.php" class="btn btn-secondary btn-sm">wyloguj się</a>
        </p>
    <?php endif; ?>

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