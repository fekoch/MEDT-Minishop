<?php
session_start();
require_once 'Warenkorb.class.php';
$wk = new Warenkorb();
$wk->add("Klopapier",10);
$wk->add("asdf",3);
header("Location:index.php?site=korb");
