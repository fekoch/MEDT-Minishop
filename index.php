<?php
session_start();
//redirect to login if not logged in
$site = $_GET['site'];
if($site != 'login' and $site != 'register' and ! isset($_SESSION['username'])) {
    header("Location:index.php?site=login");
    die();
}
include 'site-parts.php';

if($site == '') $site = 'suchen';

echo genTop($site);

switch ($site) {
    case 'login':
        echo $login;
        break;
    case 'register':
        echo $register;
        break;
    case 'suchen':
        echo $artikelSuchen;
        break;
    default:
        throw new RuntimeException();
}

echo genBottom();?>
