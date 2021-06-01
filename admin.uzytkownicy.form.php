<form method="post" action="" id="<?=empty($id) ? 'fDodajUzytkownika' : '' ?>" class="mb-3">
    <div class="form-group">
        <label for="imie">Imię</label>
        <input type="text" id="imie" name="imie" class="form-control <?= $v->errors('imie') ? 'is-invalid' : '' ?>" value="<?= $dane['imie'] ?? '' ?>"/>
    </div>
    <div class="form-group">
        <label for="nazwisko">Nazwisko</label>
        <input type="text" id="nazwisko" name="nazwisko" class="form-control <?= $v->errors('nazwisko') ? 'is-invalid' : '' ?>" value="<?= $dane['nazwisko'] ?? '' ?>"/>
    </div>
    <div class="form-group">
        <label for="adres">Adres</label>
        <input type="text" id="adres" name="adres" class="form-control <?= $v->errors('adres') ? 'is-invalid' : '' ?>" value="<?= $dane['adres'] ?? '' ?>"/>
    </div>
    <div class="form-group">
        <label for="telefon">Telefon</label>
        <input type="text" id="telefon" name="telefon" class="form-control <?= $v->errors('telefon') ? 'is-invalid' : '' ?>" value="<?= $dane['telefon'] ?? '' ?>"/>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" id="email" name="email" class="form-control <?= $v->errors('email') ? 'is-invalid' : '' ?>" value="<?= $dane['email'] ?? '' ?>"/>
    </div>
    <div class="form-group">
        <label for="login">Login</label>
        <input type="text" id="login" name="login" class="form-control <?= $v->errors('login') ? 'is-invalid' : '' ?>" value="<?= $dane['login'] ?? '' ?>"/>
    </div>
    <div class="form-group">
        <label for="haslo">Hasło</label>
        <input type="password" id="haslo" name="haslo" class="form-control <?= $v->errors('haslo') ? 'is-invalid' : '' ?>" />
    </div>
    <div class="form-group">
        <label for="login">Grupa</label>
        <select name="grupa" id="grupa" class="form-control <?= $v->errors('grupa') ? 'is-invalid' : '' ?>">
            <option <?= ($dane['grupa'] ?? '') == 'użytkownik' ? 'selected' : '' ?> >użytkownik</option>
            <option <?= ($dane['grupa'] ?? '') == 'administrator' ? 'selected' : '' ?> >administrator</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Zapisz</button>

    <?php if (!empty($id)): ?>
        <a href="admin.uzytkownicy.lista.php" class="btn btn-link">powrót</a>
    <?php endif; ?>
</form>