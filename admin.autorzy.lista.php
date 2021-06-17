<?php

require_once 'vendor/autoload.php';

use Ibd\Autorzy;
use Ibd\Stronicowanie;

$autorzy = new Autorzy();
$zapytanie = $autorzy->pobierzZapytanie($_GET);
$stronicowanie = new Stronicowanie($_GET, $zapytanie['parametry']);
$linki = $stronicowanie->pobierzLinki($zapytanie['sql'], 'admin.autorzy.lista.php');
$stats = $stronicowanie->pobierzLiczbePozycji($zapytanie['sql']);
$select = $stronicowanie->dodajLimit($zapytanie['sql']);
$lista = $autorzy->pobierzStrone($select, $zapytanie['parametry']);

//$select = $autorzy->pobierzSelect();
//$lista = $autorzy->pobierzWszystko($select);


include 'admin.header.php';
?>

<h2>
    Autorzy
    <small><a href="admin.autorzy.dodaj.php">dodaj</a></small>
</h2>

<?php if (isset($_GET['msg']) && $_GET['msg'] == 1): ?>
    <p class="alert alert-success">Autor został dodany.</p>
<?php endif; ?>

    <form method="get" action="" class="form-inline mb-4">
        <input type="text" name="fraza" placeholder="szukaj" class="form-control form-control-sm mr-2"
               value="<?= $_GET['fraza'] ?? '' ?>"/>



        <select name="sortowanie" id="sortowanie" class="form-control form-control-sm mr-2">
            <option value="">sortowanie</option>


            <option value="autorzy.nazwisko ASC"
                <?= ($_GET['sortowanie'] ?? '') == 'autorzy.nazwisko ASC' ? 'selected' : '' ?>
            >autorze rosnąco
            </option>
            <option value="autorzy.nazwisko DESC"
                <?= ($_GET['sortowanie'] ?? '') == 'autorzy.nazwisko DESC' ? 'selected' : '' ?>
            >autorze malejąco
            </option>

        </select>

        <button class="btn btn-sm btn-primary" type="submit">Szukaj</button>
    </form>


<table id="autorzy" class="table table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Imię</th>
            <th>Nazwisko</th>
            <th>Liczba książek</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($lista as $a): ?>
            <tr>
                <td><?= $a['id'] ?></td>
                <td><?= $a['imie'] ?></td>
                <td><?= $a['nazwisko'] ?></td>
                <td><?php $liczbaKsiazek = $autorzy->pobierzLiczbeKsiazek($a['id']);
                        if (count($liczbaKsiazek) == 0){
                            echo "0";}
                            else {
                                $liczba = $liczbaKsiazek[0]['liczba_ksiazek'];
                                echo "$liczba";
                            }

                    ?></td>
                <td>
                    <a href="admin.autorzy.edycja.php?id=<?= $a['id'] ?>" title="edycja" class="aEdytujAutora"><em class="fas fa-pencil-alt"></em></a>
                    <?php if (count($liczbaKsiazek) <= 0): ?>
                        <a href="admin.autorzy.usun.php?id=<?= $a['id'] ?>" title="usuń" class="aUsunAutora"><em class="fas fa-trash"></em></a>
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