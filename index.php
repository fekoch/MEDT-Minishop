<!-- Das ist ein Prototyp, um zu testen wie gut das mit dem PHP-Funktionen geht -->
<?php
 include 'site-parts.php';
?>
<!DOCTYPE html>
<html lang="de">
<?php echo genHeader('Login'); ?>
<body class="bg-dark text-light">
<div class="container vh-100">
    <div class="row pt-5 pb-5">
        <div class="col">
            <h1 class="display-3 text-center">Minishop</h1>
        </div>
    </div>
<?php echo generateNav('Login'); ?>
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
</div>
</body>
</html>