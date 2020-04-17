<?php
ini_set('upload_max_filesize', '100M');
ini_set('post_max_size','100M');
require_once 'articleTools.php';
require_once 'Warenkorb.class.php';
/**
 * Generiert den Header-Block
 * @param $currentSite string der Name der Seite, der Titel setzt sich zusammen aus 'Minishop - '+$currentSite
 * @return string der fertige HTML-Code
 */
function genHeader($currentSite) {
    return ' <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="open-iconic/font/css/open-iconic-bootstrap.min.css" >
    <link href="mycss.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/myjs.js" ></script>
    <title>Minishop - '.$currentSite.'</title>
</head>';
}

/**
 * Generiert die Navigationsleiste (eine Bootstrap-Row)
 * @param $currentSite string Der Name der Seite (damit diese als .active makiert wird)
 * @return string der fertige HTML-Code
 */
function generateNav($currentSite) {
   $nav =
       '    <div class="row pb-4">'.
       '        <div class="col">'.
       '            <ul class="nav nav-tabs text-white">';

    $nav_items = [
        'Benutzer' => 'index.php?site=login',
        'Suchen' => 'index.php?site=suchen',
        'Warenkorb' => 'index.php?site=korb',
        'Neuer Artikel' => 'index.php?site=add'
    ];

    foreach ($nav_items as $item => $link) {
        if($item == $currentSite) $active = 'active';
        else $active = '';
        if($item == 'Warenkorb') {
            $wk = new Warenkorb();
            $total = $wk->getTotalArticles();
            if($total >0) {
                $badge = '&nbsp;&nbsp;<span class="badge badge-info badge-pill">'.$total.'</span>';
            }
        }
        else $badge ='';
        $nav .=
            '<li class="nav-item">'.
            '   <a class="nav-link '.$active.'" href="'.$link.'">'.$item.$badge.'</a>'.
            '</li>';
    }

    $nav .=
        '</ul>'.
        '</div>'.
        '</div>';

    return $nav;
}

/**
 * Generiert die Oberseite des Layouts
 * @param $currentSite string die gegenwärtige Seite
 * @return string der HTML-Code der Oberseite
 */
function genTop($currentSite) {
    $site_titles = array(
        'login' => "Login",
        'register' => 'Registrieren',
        'suchen' => 'Artikel suchen',
        'korb' => 'Warenkorb',
        'add' => 'Neuer Artikel',
        'logout' => 'Logout'
    );

    $site_navs = array(
        'login'=> "Benutzer",
        'register' => 'Login',
        'suchen' => 'Suchen',
        'korb' => 'Warenkorb',
        'add' => 'Neuer Artikel',
        'logout' => 'Benutzer'
    );

    $top = '   
    <!DOCTYPE html>
    <html lang="de">';

    $top .= genHeader($site_titles[$currentSite]);

    $top .='
    <body class="bg-dark text-light">
        <div class="container vh-100">
            <div class="row pt-5 pb-5">
                <div class="col">
                    <h1 class="display-3 text-center">Minishop</h1>
                </div>
            </div>';

    $top .= generateNav($site_navs[$currentSite]);

    return $top;
}

/**
 * @return string der HTML-Code des Schlusses
 */
function genBottom() {
    return '
        </div>
        </body>
        </html>
    ';
}

$login = '
    <div class="row align-items-center">
    <div class="col">
        <form method="post" action="handleLogin.php">
            <div class="form-group">
                <label for="bname">Benutzername</label>
                <input type="text" class="form-control" name="bname" id="bname" placeholder="Benutzername eingeben">
            </div>
            <div class="form-group">
                <label for="pwort">Passwort</label>
                <input type="password" class="form-control" name="pwort" id="pwort" placeholder="Passwort eingeben">
            </div>
            <button type="submit" class="btn btn-primary float-right">Anmelden</button>
        </form>
    </div>
    </div>
    <div class="row align-items-center">
        <div class="col ">
            <a href="index.php?site=register">Noch keinen Account? - jetzt registrieren...</a>
        </div>
    </div>';

$logout = '
    <div class="row align-items-center">
    <div class="col pt-3 text-center">
        <p>Angemeldet als <b>'.$_SESSION['username'].'</b></p>
    </div>
    </div>
    <div class="row">
    <div class="col text-center pt-3">
        <a href="logout.php" class="btn btn-danger">Abmelden</a>
    </div>
    </div>';

/**
 * holt sich einen Suchbegriff aus $_GET['suchbegriff']
 * @return string HTML-Code für die Suchen-Seite
 */
function genSuchen() {
    //beginn
    $artikelSuchen = '<div class="row">
        <div class="col-md-3 bg-secondary h-100 pt-2 pb-4 rounded">
            <form method="get">
                <div class="form-group">
                    <label for="suche">Suchen</label>
                    <input class="form-control" name="suchbegriff" type="text" id="suche" placeholder="';
    if($_GET['suchbegriff'] != null) $artikelSuchen .= $_GET['suchbegriff'];
    else {
        $artikelSuchen .= 'Suche eingeben';
        unset($_GET['suchbegriff']);
    }
    $artikelSuchen .= '">
                </div>
                <button type="submit" class="btn btn-primary w-100">Suchen</button>
            </form>
        </div>
        <div class="col-md-9">
            <div class="table-responsive-sm">
            <table class="table table-hover table-dark table-striped" style="">
                <thead>
                <tr>
                    <th scope="col">Bezeichnung</th>
                    <th scope="col">Bestellen</th>
                    <th scope="col">Preis</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>';

    $articles = loadArticles();

    if($_GET['suchbegriff'] != null) {
        //sucht nach dem als regex (i => case insensitive)
        $pattern = "/".$_GET['suchbegriff']."/i";
        $ergs = array_filter($articles, function ($a) use($pattern) {return preg_grep($pattern,$a);});
    }
    else $ergs = $articles;

    if($ergs != "") {
    foreach($ergs as $aName => $article) {
        //ein Artikel
        $artikelSuchen .='
                <tr class="click-row" data-artikel-id="'.$aName.'">
                    <th scope="row">'.$aName.'</th>
                    <td>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Menge">
                            <div class="input-group-append">
                                <button class="btn btn-primary order-article" type="button">
                                    <span class="oi oi-plus" title="Bestellen"></span>
                                </button>
                            </div>
                        </div>
                    </td>
                    <td>'.$article['preis'].'€ / '.$article['gewicht'].''.$article['einheit'].'</td>
                    <td>
                        <a class="btn btn-sm btn-warning edit-article">
                            <span class="oi oi-pencil" title="Edit" aria-hidden="true"></span>
                        </a>
                        <a class="btn btn-sm btn-danger delete-article">
                            <span class="oi oi-delete" title="Delete" aria-hidden="true"></span>
                        </a>
                    </td>
                </tr>';

    }}

    //ende
    $artikelSuchen .='
                </tbody>
            </table>
            </div>
        </div>
    </div>';
    return $artikelSuchen;
}

$register = '
    <div class="row align-items-center">
    <div class="col">
        <form method="post" action="handleRegister.php">
            <div class="form-group">
                <label for="bname">Benutzername</label>
                <input type="text" class="form-control" name="bname" id="bname" placeholder="Benutzername eingeben">
            </div>
            <div class="form-group">
                <label for="pwort">Passwort</label>
                <input type="password" class="form-control" name="pwort" id="pwort" placeholder="Passwort eingeben">
            </div>
            <div class="form-group">
                <label for="retype_pwort">Passwort bestätigen</label>
                <input type="password" class="form-control" name="retype_pwort" id="retype_pwort" placeholder="Passwort eingeben">
            </div>
            <button type="submit" class="btn btn-primary float-right">Registrieren</button>
        </form>
    </div>
    </div>';

function genAddArticle($currentUser) {
    return '<div class="row">
    <div class="col-lg-9 mr-auto ml-auto">
        <form method="post" action="addArticle.php">
            <div class="form-row">
                <div class="col">
                    <label for="bezeichnung">Artikelbezeichnung</label>
                    <input type="text" name="bez"" id="bezeichnung" class="form-control">
                </div>
                <div class="col">
                    <label for="kurztext">Kurzbeschreibung</label>
                    <input type="text" name="ktxt" id="kurztext" class="form-control">
                </div>
            </div>
            <div class="form-row mt-3">
                <div class="col">
                    <label for="langtext">Ausfürliche Beschreibung</label>
                    <textarea rows="3" name="ltxt" id="langtext" class="form-control">...</textarea>
                </div>
                <div class="col-5">
                    <label for="pic">Artikel-Bild</label>
                    <input type="file" name="pic" id="pic" class="form-control-file">
                </div>
            </div>
            <div class="form-row mt-3">
                <div class="col">
                    <label for="gewicht">Gewicht</label>
                    <input type="text" id="gewicht" name="gew" class="form-control text-center">
                </div>
                <div class="col">
                    <label for="gelagert">Menge auf Lager</label>
                    <input type="number" id="gelagert" name="gel" class=" form-control text-center">
                </div>
                <div class="col">
                    <label for="einheit">Einheit</label>
                    <input type="text" id="einheit" name="ein" class="form-control text-center">
                </div>
                <div class="col">
                    <label for="preis">Preis pro Einheit (€)</label>
                    <input type="number" id="preis" name="preis" class="form-control text-center">
                </div>
            </div>
            <div class="form-row mt-3">
                <div class="col-5 mr-auto">
                    <label for="user">Benutzer</label>
                    <input type="text" id="user" class="form-control" disabled placeholder="'.$currentUser.'">
                </div>
                <button type="submit" class="btn btn-lg btn-success mt-4">Speichern</button>
            </div>
        </form>
    </div>
</div>
';

}

/**
 * Artikel wird über $_GET['aid'] spezifiziert
 * Edit wird über $_GET['edit']=true
 * @return string HTML-Code für die Artikelansicht
 */
function genArtikelAnsicht() {
    $abez = $_GET['aid'];
    $user = $_SESSION['username'];
    if($abez == "") {
        header("Location:index.php");
        die();
    }

    $articles = loadArticles();
    $article = $articles[$abez];
    //wenn abez nicht existiert
    if($articles == "") {
        header("Location:index.php");
        die();
    }

    $ansicht= '
<form method="post" action="modifyArticle.php">
<div class="row">
    <div class="col-2">
        <img class="img-fluid" src="https://via.placeholder.com/150">
    </div>
    <div class="col">
        <div class="row">
            <div class="col">
                <h2>'.$abez.'</h2>
                <input value="'.$abez.'" name="bez" type="hidden">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="kurztext">Kurzbeschreibung</label>
                <input ';
    if($user != $article['user'] || $_GET['edit'] == false) $ansicht .= 'readonly';
    $ansicht.=' type="text" name="ktxt" id="kurztext" class="form-control" value="'.$article['ktxt'].'">
            </div>
            <div class="col">
                <label for="langtext">Ausfürliche Beschreibung</label>
                <textarea ';
    if($user != $article['user'] || $_GET['edit'] == false) $ansicht .= 'readonly';
    $ansicht .=' rows="3" name="ltxt" id="langtext" class="form-control">'.$article['ltxt'].'</textarea>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="row">
            <label for="gewicht">Gewicht</label>
            <input ';
    if($user != $article['user'] || $_GET['edit'] == false) $ansicht .= 'readonly';
    $ansicht .=' type="text" id="gewicht" name="gew" class="form-control text-center" value="'.$article['gewicht'].'">
        </div>
        <div class="row">
            <label for="gelagert">Menge auf Lager</label>
            <input ';
    if($user != $article['user'] || $_GET['edit'] == false) $ansicht .= 'readonly';
    $ansicht .=' type="number" id="gelagert" name="gel" class=" form-control text-center" value="'.$article['gelagert'].'">
        </div>
        <div class="row">
            <label for="einheit">Einheit</label>
            <input ';
    if($user != $article['user'] || $_GET['edit'] == false) $ansicht .= 'readonly';
    $ansicht .=' type="text" id="einheit" name="ein" class="form-control text-center" value="'.$article['einheit'].'">
        </div>
        <div class="row">
            <label for="preis">Preis pro Einheit (€)</label>
            <input ';
    if($user != $article['user'] || $_GET['edit'] == false) $ansicht .= 'readonly';
    $ansicht .=' type="number" id="preis" name="preis" class="form-control text-center" value="'.$article['preis'].'">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-5 mr-auto mb-3">
        <label for="user">Eigentümer</label>
        <input type="text" id="user" name="user" class="form-control" readonly value="'.$article['user'].'">
    </div>';
    if( $_GET['edit'] == true) {
        $ansicht .= '<button ';
        if($user != $article['user']) $ansicht .= 'disabled ';
        $ansicht .='type="submit" class="btn btn-lg btn-success mt-auto">Änderungen speichern</button>
</div>
</form>
';
    }
    else{
        $ansicht .= '<button onclick="goBack()" class="btn btn-lg btn-primary mt-auto">Zurück</button>';
    }
    //Debug
    $ansicht .= '<script>
console.log("Bild sollte unter: '.$article['img'].' liegen");
</script>';
    return $ansicht;
}

/**
 * @return string die Kauf-Seite
 */
function genBuy() {
    $wk = new Warenkorb();
    $site = '
<div class="row">
<div class="card text-dark m-auto">
    <div class="card-header text-center pl-5 pr-5 pt-4 pb-1">
        <h3 class="card-title">Rechnung</h3>
    </div>
    <div class="card-body text-right pt-1 pb-1">
        <ul class="list-group list-group-flush">
        ';
    $articles = loadArticles();
    $wk = new Warenkorb();
    foreach ($wk->getArray() as $id => $menge) {
        $site .= '<li class="list-group-item">';
        $site .= "$menge x<b> $id </b> -  ".$articles[$id]['preis']*$menge." €";
        $site .= '</li>';
    }
    $site .=
       '</ul>
    </div>
    <div class="card-footer text-center">
        <p>Gesamtkosten: <b>'.$wk->getTotalCost().'</b></p>
    </div>
</div>   
</div>
<script>
//Enable tooltips
$(function () {
  $(\'[data-toggle="tooltip"]\').tooltip()
})
</script>
<div class="row">
<div class="col mt-3 text-center" title="Die Zahlungsoption hat keine Funktion" data-toggle="tooltip">
    <div class="form-check">
      <input class="form-check-input" type="radio" name="z_opt_1" id="z_opt_1" value="1" checked>
      <label class="form-check-label" for="z_opt_1">
        Zahlungsoption 1
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="z_opt_1" id="z_opt_1" value="1" checked>
      <label class="form-check-label" for="z_opt_1">
        Zahlungsoption 2
      </label>
    </div>
</div>
</div>
<div class="row text-center pt-4">
<div class="col">
<a href="buy.php" class="btn btn-success btn-lg">Kauf bestätigen</a>
</div>
</div>
    ';
    return $site;
}
?>
