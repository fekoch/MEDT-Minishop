<?php
require_once 'articleTools.php';
require_once 'Warenkorb.class.php';
session_start();
$user = $_SESSION['username'];
//nicht angemeldete User haben keine Berechtigung
if($user == null) {
    header("Location:index.php?error=true?msg=nuser not authorized");
    die();
}
$id = $_POST['id'];
$menge = $_POST['anz'];
$wk = new Warenkorb();
$lager = loadArticles();

if($lager[$id]['gelagert'] - $wk->getNumbersArticle($id)< $menge) {
    $response = array(
        'error' => true,
        'msg' => 'Es sind nur noch '.$lager[$id]['gelagert']- $wk->getNumbersArticle($id).' Artikel dieser Art verfügbar'
    );
}
else{
    $wk->add($id,$menge);
    $response = array(['err' => false]);
}
header('Content-type: application/json');
echo json_encode($response);


