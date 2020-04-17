<?php

/**
 * @return array ladedt alle Artikel in ein Array (Key ist Artikelbezeichnung)
 */
function loadArticles() {
    $articleFile = fopen("article.csv",'r');

    $articles = array();

    while (($data = fgetcsv($articleFile,'0',';')) !== FALSE) {
        $articles [$data[0]] = array(
            'abez'=> $data[0],
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
 * läscht einen Article, selbst wenn der Benutzer ihn nicht besitzt
 * @param $abez string die Bezeichnung des Articles
 * @return bool|mixed der geläschte Artikel oder false
 */
function deleteArticleAlways($abez) {
    $articles = loadArticles();
    if($articles[$abez] == null) {
        //article nicht vorhanden
        return false;
    }

    $file = fopen('article.csv','w');
    foreach ($articles as $article){
        if ($article['abez'] != $abez) {
            fputcsv($file,$article,';');
        }
    }
    fclose($file);
    return $articles[$abez];
}

/**
 * läscht einen Article
 * @param $abez string die Bezeichnung des Articles
 * @return bool|mixed der geläschte Artikel oder false
 */
function deleteArticle($abez) {
    $articles = loadArticles();
    //nur eigentümer darf löschen
    if($_SESSION['username']!= $articles[$abez]['user']) {
        return false;
    }
    return deleteArticleAlways($abez);
}

/**
 * fügt einen neuen Artikel hinzu
 * @param $new_article array Ein Artikel-Array
 * @return bool false, if the article-array was not correcty formatted
 */
function addArticle($new_article) {
//falls ein Wert fehlt => abbruch
    if (!empty($new_article) and sizeof($new_article)==9) {
//Article abspeichern
        $articles = fopen('article.csv','a');
        fputcsv($articles,$new_article,';');
        fclose($articles);
        return true;
    }
    else{
        return false;
    }
}



