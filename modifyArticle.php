<?php
require 'articleTools.php';
session_start();
$user = $_SESSION['username'];
//nicht angemeldete User haben keine Berechtigung
if($user == null) {
    header("Location:index.php?error=true?msg=nuser not authorized");
    die();
}

//delete old one
$oldArticle = deleteArticle($_POST['bez']);

//artikel nicht vorhanden / konnte nicht gelöscht werden
if($oldArticle == false) {
    header("Location:index.php?error=true?msg=could not delete article");
    die();
}

//add modified one
addArticle(array(
    'bez'=>$_POST['bez'],
    'ktxt'=>$_POST['ktxt'],
    'ltxt'=>$_POST['ltxt'],
    'pic'=>$_POST['pic'],
    'gewicht'=>$_POST['gew'],
    'gelagert'=>$_POST['gel'],
    'einheit'=>$_POST['ein'],
    'preis'=>$_POST['preis'],
    'user'=>$_SESSION['username']
));

header("Location:index.php?site=artikel&aid=".$_POST['bez']);
