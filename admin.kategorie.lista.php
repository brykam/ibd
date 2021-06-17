<?php

require_once 'vendor/autoload.php';

use Ibd\Kategorie;
use Ibd\Stronicowanie;

$kategorie = new Kategorie();
$zapytanie = $kategorie->pobierzZapytanie($_GET);
$stronicowanie = new Stronicowanie($_GET, $zapytanie['parametry']);
$linki = $stronicowanie->pobierzLinki($zapytanie['sql'], 'admin.kategorie.lista.php');
$stats = $stronicowanie->pobierzLiczbePozycji($zapytanie['sql']);
$select = $stronicowanie->dodajLimit($zapytanie['sql']);
$lista = $kategorie->pobierzStrone($select, $zapytanie['parametry']);

//$select = $kategorie->pobierzSelect();
//$lista = $kategorie->pobierzWszystko($select);


include 'admin.header.php';
?>

<h2>
    Kategorie
    <small><a href="admin.kategorie.dodaj.php">dodaj</a></small>
</h2>

<?php if (isset($_GET['msg']) && $_GET['msg'] == 1): ?>
    <p class="alert alert-success">Kategoria została dodana.</p>
<?php endif; ?>

    <form method="get" action="" class="form-inline mb-4">
        <input type="text" name="fraza" placeholder="szukaj" class="form-control form-control-sm mr-2"
               value="<?= $_GET['fraza'] ?? '' ?>"/>



        <select name="sortowanie" id="sortowanie" class="form-control form-control-sm mr-2">
            <option value="">sortowanie</option>


            <option value="kategorie.nazwa ASC"
                <?= ($_GET['sortowanie'] ?? '') == 'kategorie.nazwa ASC' ? 'selected' : '' ?>
            >kategorii rosnąco
            </option>
            <option value="kategorie.nazwa DESC"
                <?= ($_GET['sortowanie'] ?? '') == 'kategorie.nazwa DESC' ? 'selected' : '' ?>
            >kategorii malejąco
            </option>

        </select>

        <button class="btn btn-sm btn-primary" type="submit">Szukaj</button>
    </form>


<table id="kategorie" class="table table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Kategoria</th>
            <th>Liczba książek</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($lista as $a): ?>
            <tr>
                <td><?= $a['id'] ?></td>
                <td><?= $a['nazwa'] ?></td>
                <td><?php $liczbaKsiazek = $kategorie->pobierzLiczbeKsiazek($a['id']);
                    if (count($liczbaKsiazek) == 0){
                        echo "0";}
                    else {
                        $liczba = $liczbaKsiazek[0]['liczba_ksiazek'];
                        echo "$liczba";
                    }

                    ?></td>
                <td>

                        <a href="admin.kategorie.edycja.php?id=<?= $a['id'] ?>" title="edycja" class="aEdytujKategorie"><em class="fas fa-pencil-alt"></em></a>
                    <?php if (count($liczbaKsiazek) <= 0): ?>
                    <a href="admin.kategorie.usun.php?id=<?= $a['id'] ?>" title="usuń" class="aUsunKategorie"><em class="fas fa-trash"></em></a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
    <p class="text-center"> <?= $stats ?></p>
    <nav class="text-center">
        <?= $linki ?>
    </nav>
<?php include 'admin.footer.php'; ?>