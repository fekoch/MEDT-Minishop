<!-- Das ist ein Prototyp, um zu testen wie gut das mit dem PHP-Funktionen geht -->
<?php
 include 'site-parts.php';
 echo genTop('Login');
 ?>
    <div class="row align-items-center">
    <div class="col">
        <form>
            <div class="form-group">
                <label for="bname">Benutzername</label>
                <input type="text" class="form-control" id="bname" placeholder="Benutzername eingeben">
            </div>
            <div class="form-group">
                <label for="pwort">Passwort</label>
                <input type="password" class="form-control" id="pwort" placeholder="Passwort eingeben">
            </div>
            <button type="submit" class="btn btn-primary float-right">Anmelden</button>
        </form>
    </div>
    </div>
<? echo genBottom();?>
