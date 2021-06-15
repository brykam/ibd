<form method="post" action="" enctype="multipart/form-data" id="<?=empty($id) ? 'fDodajKsiazke' : '' ?>">
    <?php if(!empty($dane['zdjecie'])): ?>
        <div>
            <img src="zdjecia/<?=$dane['zdjecie'] ?? ''?>?<?=time()?>" alt="<?=$ks['tytul']?>" />
        </div>
    <?php endif; ?>

    <div class="form-group">
        <label for="tytul">Tytuł</label>
        <input type="text" id="tytul" name="tytul" class="form-control <?= $v->errors('tytul') ? 'is-invalid' : '' ?>" value="<?= $dane['tytul'] ?? '' ?>" />
    </div>
    <div class="form-group">
        <label for="id_kategorii">Kategoria</label>
        <select name="id_kategorii" id="id_kategorii" class="form-control <?= $v->errors('id_kategorii') ? 'is-invalid' : '' ?>">
            <?php foreach ($listaKategorii as $kat) : ?>
                <option value="<?= $kat['id'] ?>" <?= ($dane['id_kategorii'] ?? '') == $kat['id'] ? 'selected="selected"' : '' ?>><?= $kat['nazwa'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="id_autora"">Autor</label>
        <select name=" id_autora" id="id_autora" class="form-control <?= $v->errors('id_autora') ? 'is-invalid' : '' ?>">
            <?php foreach ($listaAutorow as $a) : ?>
                <option value="<?= $a['id'] ?>" <?= ($dane['id_autora'] ?? '') == $a['id'] ? 'selected="selected"' : '' ?>><?= $a['imie'] . ' ' . $a['nazwisko'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="cena">Cena</label>
        <input type="text" id="cena" name="cena" class="form-control <?= $v->errors('cena') ? 'is-invalid' : '' ?>" value="<?= $dane['cena'] ?? '' ?>" />
    </div>
    <div class="form-group">
        <label for="liczba_stron">Liczba stron</label>
        <input type="text" id="liczba_stron" name="liczba_stron" class="form-control <?= $v->errors('liczba_stron') ? 'is-invalid' : '' ?>" value="<?= $dane['liczba_stron'] ?? '' ?>" />
    </div>
    <div class="form-group">
        <label for="isbn">ISBN</label>
        <input type="text" id="isbn" name="isbn" class="form-control <?= $v->errors('isbn') ? 'is-invalid' : '' ?>" value="<?= $dane['isbn'] ?? '' ?>" />
    </div>
    <div class="form-group">
        <label for="opis">Opis</label>
        <textarea name="opis" id="opis" class="form-control <?= $v->errors('opis') ? 'is-invalid' : '' ?>"><?= $dane['opis'] ?? '' ?></textarea>
    </div>
    <div class="form-group">
        <label for="zdjecie">Zdjęcie okładki (format JPG)</label>
        <input type="file" id="zdjecie" name="zdjecie" class="form-control <?= $v->errors('zdjecie') ? 'is-invalid' : '' ?>" />
    </div>

    <button type="submit" class="btn btn-primary">Zapisz</button>

    <?php if (!empty($id)): ?>
        <a href="admin.ksiazki.lista.php" class="btn btn-link">powrót</a>
    <?php endif; ?>

    <hr />
</form>