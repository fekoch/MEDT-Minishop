<?php
require 'articleTools.php';
session_start();
$user = $_SESSION['username'];
//nicht angemeldete User haben keine Berechtigung
if($user == null) {
    header("Location:index.php?error=true");
    die();
}

//TODO all
//delete old one
//add modified one
