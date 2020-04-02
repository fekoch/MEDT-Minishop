<?php

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
        'Login' => 'index.php?site=login',
        'Suchen' => 'index.php?site=suchen',
        'Warenkorb' => '#',
        'Neuer Artikel' => 'index.php?site=add'
    ];

    foreach ($nav_items as $item => $link) {
        if($item == $currentSite) $active = 'active';
        else $active = '';
        $nav .=
            '<li class="nav-item">'.
            '   <a class="nav-link '.$active.'" href="'.$link.'">'.$item.'</a>'.
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
        'add' => 'Neuer Artikel'
    );

    $site_navs = array(
        'login'=> "Login",
        'register' => 'Login',
        'suchen' => 'Suchen',
        'korb' => 'Warenkorb',
        'add' => 'Neuer Artikel'
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
    $bot = '
        </div>
        </body>
        </html>
    ';
    return $bot;
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

$artikelSuchen = '<div class="row">
        <div class="col-md-3 bg-secondary h-100 pt-2 pb-4 rounded">
            <form>
                <div class="form-group">
                    <label for="suche">Suchen</label>
                    <input class="form-control" type="text" id="suche" placeholder="Suche eingeben">
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
                <tbody>
                <!-- Ein Artikel in der Tabelle -->
                <tr class="click-row" data-artikel-id="1">
                    <th scope="row">Artikel1</th>
                    <td>
                        <!-- Ich überlege dass noch anzupassen, sodass es auf sm-devices auch noch passt -->
                        <!--    womöglich ohne eingabe, nur mit dem plus-Button -->
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Menge">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <span class="oi oi-plus" title="Bestellen"></span>
                                </button>
                            </div>
                        </div>
                    </td>
                    <td>2.40€ / stk</td>
                    <td>
                        <a class="btn btn-sm btn-warning">
                            <span class="oi oi-pencil" title="Edit" aria-hidden="true"></span>
                        </a>
                        <a class="btn btn-sm btn-danger">
                            <span class="oi oi-delete" title="Delete" aria-hidden="true"></span>
                        </a>
                    </td>
                </tr>
                <!-- Ein Artikel in der Tabelle -->
                <tr class="click-row" data-artikel-id="2">
                    <th scope="row">Artikel2</th>
                    <td>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Menge">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <span class="oi oi-plus" title="Bestellen"></span>
                                </button>
                            </div>
                        </div>
                    </td>
                    <td>2.40€ / stk</td>
                    <td>
                        <a class="btn btn-sm btn-warning">
                            <span class="oi oi-pencil" title="Edit" aria-hidden="true"></span>
                        </a>
                        <a class="btn btn-sm btn-danger">
                            <span class="oi oi-delete" title="Delete" aria-hidden="true"></span>
                        </a>
                    </td>
                </tr>
                <!-- Ein Artikel in der Tabelle -->
                <tr class="click-row" data-artikel-id="3">
                    <th scope="row">Artikel3</th>
                    <td>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Menge">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <span class="oi oi-plus" title="Bestellen"></span>
                                </button>
                            </div>
                        </div>
                    </td>
                    <td>2.40€ / stk</td>
                    <td>
                        <a class="btn btn-sm btn-warning">
                            <span class="oi oi-pencil" title="Edit" aria-hidden="true"></span>
                        </a>
                        <a class="btn btn-sm btn-danger">
                            <span class="oi oi-delete" title="Delete" aria-hidden="true"></span>
                        </a>
                    </td>
                </tr>
                </tbody>
            </table>
            </div>
        </div>
    </div>';

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

?>
