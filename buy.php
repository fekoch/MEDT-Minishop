<?php
require_once 'articleTools.php';
require_once 'Warenkorb.class.php';
session_start();

$wk = new Warenkorb();
$lager = loadArticles();

foreach ($wk->getArray() as $id => $menge) {
    $ml = $lager[$id]['gelagert'];
    $ml -= $menge;
    $old =$lager[$id];
    deleteArticle($id);
    $wk->remove($id);
    if ($ml != 0) {
        $old['gelagert'] = $ml;
        addArticle($old);
   }
}


header("Location:index.php?site=suchen");
