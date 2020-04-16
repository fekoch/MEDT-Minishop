<?php
require 'articleTools.php';
session_start();
$user = $_SESSION['username'];
//nicht angemeldete User haben keine Berechtigung
if($user == null) {
    header("Location:index.php?error=true?msg=user not authorized");
    die();
}

if (deleteArticle($_POST['id']) == false) header("Location:index.php?error=true?msg=user does not own article");
else header("Location:index.php");
