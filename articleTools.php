<?php

/**
 * @return array ladedt alle Artikel in ein Array (Key ist Artikelbezeichnung)
 */
function loadArticles() {
    $articleFile = fopen("article.csv",'r');

    $articles = array();

    while (($data = fgetcsv($articleFile,'0',';')) !== FALSE) {
        $articles [$data[0]] = array(
            'abez'=> strtolower($data[0]),
            'ktxt' => $data[1],
            'ltxt'=> $data[2],
            'img'=> $data[3],
            'gewicht'=> $data[4],
            'gelagert'=> $data[5],
            'einheit'=> $data[6],
            'preis'=> $data[7],
            'user'=>$data[8]
        );
    }
    fclose($articleFile);
    return $articles;
}

/**
 * läscht einen Article
 * @param $abez string die Bezeichnung des Articles
 * @return bool|mixed der geläschte Artikel oder false
 */
function deleteArticle($abez) {
    $articles = loadArticles();
    if($articles[$abez] == null) {
        //article nicht vorhanden
        return false;
    }

    //nur eigentümer darf löschen
    if($_SESSION['username']!= $articles[$abez]['user']) {
        return false;
    }

    $file = fopen('article.csv','w');
    foreach ($articles as $article){
        if ($article['abez'] != $abez) {
            fputcsv($file,article,';');
        }
    }
    fclose($file);
    return $articles[$abez];
}

/**
 * fügt einen neuen Artikel hinzu
 * @param $article array Ein Artikel-Array
 */
function addArticle($article) {
    $_POST['bez']=$article['bez'];
    $_POST['ktxt']=$article['ktxt'];
    $_POST['ltxt']=$article['ltxt'];
    $_POST['pic']=$article['pic'];
    $_POST['gew']=$article['gewicht'];
    $_POST['gel']=$article['gelagert'];
    $_POST['ein']=$article['einheit'];
    $_POST['preis']=$article['preis'];
    header("Location:addArticle.php");
}



