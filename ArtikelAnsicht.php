<?php
include 'site-parts.php';
echo genTop('Login');
?>
echo '
<form method="post" action="modifyArticle.php">
<div class="row">
    <div class="col-2">
        <img class="img-fluid" src="https://via.placeholder.com/150">
    </div>
    <div class="col">
        <div class="row">
            <div class="col">
                <h2>'.$abez.'</h2>
                <input content="'.$abez'." name="abez" class="d-none">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="kurztext">Kurzbeschreibung</label>
                <input type="text" name="ktxt" id="kurztext" class="form-control">
            </div>
            <div class="col">
                <label for="langtext">Ausfürliche Beschreibung</label>
                <textarea rows="3" name="ltxt" id="langtext" class="form-control">...</textarea>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="row">
            <label for="gelagert">Menge auf Lager</label>
            <input type="number" id="gelagert" name="gel" class=" form-control text-center">
        </div>
        <div class="row">
            <label for="einheit">Einheit</label>
            <input type="text" id="einheit" name="ein" class="form-control text-center">
        </div>
        <div class="row">
            <label for="preis">Preis pro Einheit (€)</label>
            <input type="number" id="preis" name="preis" class="form-control text-center">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-5 mr-auto mb-3">
        <label for="user">Benutzer</label>
        <input type="text" id="user" class="form-control" disabled placeholder="'.$currentUser.'">
    </div>
    <button type="submit" class="btn btn-lg btn-success mt-auto">Änderungen speichern</button>
</div>
</form>
';
<? echo genBottom();?>
