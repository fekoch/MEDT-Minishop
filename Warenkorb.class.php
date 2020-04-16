<?php
require_once 'articleTools.php';

/**
 * Class Warenkorb Ein Warenkorb der die einkäufe des Benutzers speichert
 * der Inhalt des Warenkorbs wird in der Session gespeichert
 */
class Warenkorb {
    private $wk;

    /**
     * Warenkorb constructor erzeugt einen Warenkorb aus der Session
     */
    function __construct()
    {
        if(! isset($_SESSION['warenkorb'])) {
            $this->wk = array();
        }
        else {
            $this->wk = unserialize($_SESSION['warenkorb']);
        }
    }

    /**
     * Fügt einen neuen Artikel hinzu
     * @param $article string Eine Artikel-ID
     * @param $menge integer die Menge
     */
    function add($article,$menge) {
        $this->wk[$article] += $menge;
    }

    /**
     * Entfernt einen Artikel aus dem Warenkorb
     * @param $article string Eine Artikel-ID
     */
    function remove($article) {
        unset($this->wk[$article]);
    }

    function genHTML() {
        $articles = loadArticles();
        $gesamtpreis = 0;
        $html = '
<form>
<div class="row">
    <div class="col-md-9">
        <div class="table-responsive-sm">
            <table class="table table-hover table-dark table-striped" style="">
                <thead>
                <tr>
                    <th scope="col">Bezeichnung</th>
                    <th scope="col">Menge</th>
                    <th scope="col">Preis</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                ';
        foreach ($this->wk as $id => $menge) {
            $preis = $articles[$id]['preis'] * $menge;
            $html .= '
                <tr class="click-row" data-artikel-id="1">
                    <th scope="row">
                        '.$id.'
                    </th>
                    <td>
                        '.$menge.'
                    </td>
                    <td>
                        '.$preis.' €
                    </td>
                    <td>
                        <a class="btn btn-sm btn-danger">
                            <span class="oi oi-minus" title="Delete" aria-hidden="true"></span>
                        </a>
                    </td>
                </tr>';
            $gesamtpreis += $preis;
        }

        $html .= '
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-3 bg-secondary  pt-2 pb-4 rounded">
        <div class="form-group">
            <label for="gesamtpreis">Gesamtpreis</label>
            <input class="form-control text-center" type="text" id="Gesamtpreis" contenteditable="false" disabled value="'.$gesamtpreis.' €">
        </div>
        <button type="submit" class="btn btn-primary w-100">Kaufen</button>
    </div>
</div>
</form>
    ';
        return $html;
    }

    /**
     * speichert die Änderungen vom Warenkorb in der Session
     */
    public function __destruct()
    {
        $_SESSION['warenkorb'] = serialize($this->wk);
    }
}
