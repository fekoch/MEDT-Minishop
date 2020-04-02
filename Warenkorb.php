<?php
include 'site-parts.php';
echo genTop('Login');
?>
<form>
<div class="row">
    <div class="col-md-9">
        <div class="table-responsive-sm">
            <table class="table table-hover table-dark table-striped" style="">
                <thead>
                <tr>
                    <th scope="col">Bezeichnung</th>
                    <th scope="col">Menge</th>
                    <th scope="col">Gesamtpreis</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <!-- Ein Artikel in der Tabelle -->
                <tr class="click-row" data-artikel-id="1">
                    <th scope="row">
                        $Artikel
                    </th>
                    <td>
                        $Menge
                    </td>
                    <td>
                        <input content="$Menge*$Preis">

                    </td>
                    <td>
                        <a class="btn btn-sm btn-danger">
                            <span class="oi oi-minus" title="Delete" aria-hidden="true"></span>
                        </a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-3 bg-secondary  pt-2 pb-4 rounded">
        <div class="form-group">
            <label for="gesamtpreis">Gesamtpreis</label>
            <input class="form-control" type="text" id="Gesamtpreis" content="$gesamtpreis" contenteditable="false">
        </div>
        <button type="submit" class="btn btn-primary w-100">Kaufen</button>
    </div>
</div>
</form>
<? echo genBottom();?>