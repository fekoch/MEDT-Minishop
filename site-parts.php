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
        'Suchen' => '#',
        'Login' => '#',
        'Warenkorb' => '#',
        'Neuer Artikel' => '#'
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
 */
function genTop($currentSite) {
    $top = '   
    <!DOCTYPE html>
    <html lang="de">';

    $top .= genHeader($currentSite);

    $top .='
    <body class="bg-dark text-light">
        <div class="container vh-100">
            <div class="row pt-5 pb-5">
                <div class="col">
                    <h1 class="display-3 text-center">Minishop</h1>
                </div>
            </div>';

    $top .= generateNav($currentSite);
}
?>
