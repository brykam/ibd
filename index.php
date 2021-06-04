
<?php include 'header.php'; ?>


<h1>Witamy w księgarni internetowej</h1>

<p>
    Projekt na zaliczenie przedmiotu Internetowe Bazy Danych w roku akademickim <?=ROK_AKADEMICKI ?>.
</p>
<?php if(isset($_GET['msg'])): ?>
    <?php if($_GET['msg'] == 1): ?>
        <p class="text-info">Rejestracja przebiegła pomyślnie.</p>
    <?php endif;?>
    <?php if($_GET['msg'] == 2): ?>
        <p class="text-info">Zaloguj się, by przeglądać historię.</p>
    <?php endif;?>
<?php endif;?>

<?php include 'footer.php'; ?>