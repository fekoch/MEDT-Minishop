<?php
session_start();
//redirect to login if not logged in
$site = $_GET['site'];
if($site != 'login' and $site != 'register' and ! isset($_SESSION['username'])) {
    header("Location:index.php?site=login");
    die();
}
require_once 'site-parts.php';

if($site == '') $site = 'suchen';
if($site == 'login' and isset($_SESSION['username'])) $site = 'logout';

echo genTop($site);

switch ($site) {
    case 'logout':
        echo $logout;
        break;
    case 'login':
        echo $login;
        break;
    case 'register':
        echo $register;
        break;
    case 'suchen':
        echo genSuchen();
        break;
    case 'add':
        echo genAddArticle($_SESSION['username']);
        break;
    case 'artikel':
        echo genArtikelAnsicht();
        break;
    case 'korb':
        $wk = new Warenkorb();
        echo $wk->genHTML();
        break;
    case 'buy':
        echo genBuy();
        break;
    default:
        throw new RuntimeException();
}

echo genBottom();?>
