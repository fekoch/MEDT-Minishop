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

$wk = new Warenkorb();
$wk->add($_POST['id'],$_POST['anz']);

