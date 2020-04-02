<?php include 'site-parts.php'; echo genTop('Neuer Artikel');?>
<div class="row">
    <div class="col-lg-9 mr-auto ml-auto">
        <form>
            <div class="form-row">
                <div class="col">
                    <label for="bezeichnung">Artikelbezeichnung</label>
                    <input type="text" id="bezeichnung" class="form-control">
                </div>
                <div class="col">
                    <label for="kurztext">Kurzbeschreibung</label>
                    <input type="text" id="kurztext" class="form-control">
                </div>
            </div>
            <div class="form-row mt-3">
                <div class="col">
                    <label for="langtext">Ausfürliche Beschreibung</label>
                    <textarea rows="3" id="langtext" class="form-control">...</textarea>
                </div>
                <div class="col-5">
                    <label for="bild">Artikel-Bild</label>
                    <input type="file" id="bild" class="form-control-file">
                </div>
            </div>
            <div class="form-row mt-3">
                <div class="col">
                    <label for="gewicht">Gewicht</label>
                    <input type="text" id="gewicht" class="form-control text-center">
                </div>
                <div class="col">
                    <label for="gelagert">Menge auf Lager</label>
                    <input type="number" id="gelagert" class=" form-control text-center">
                </div>
                <div class="col">
                    <label for="einheit">Einheit</label>
                    <input type="text" id="einheit" class="form-control text-center">
                </div>
                <div class="col">
                    <label for="preis">Preis pro Einheit (€)</label>
                    <input type="number" id="gewicht" class="form-control text-center">
                </div>
            </div>
            <div class="form-row mt-3">
                <div class="col-5 mr-auto">
                    <label for="user">Benutzer</label>
                    <input type="text" id="user" class="form-control" disabled placeholder="$currentUser">
                </div>
                <button type="submit" class="btn btn-lg btn-success mt-4">Speichern</button>
            </div>
        </form>
    </div>
</div>
<?php echo genBottom()?>
