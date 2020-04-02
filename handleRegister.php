<?php
session_start();
if (""==$_POST['bname'] or ""==$_POST['pwort'] or ""== $_POST['retype_pwort']) {
    header("Location:index.php?site=register&error=true");
    die();
}

$user = $_POST['bname'];
$pwort = $_POST['pwort'];
$pwort2 = $_POST['pwort'];

//pwort must be equal
if($pwort != $pwort2) {
    header("Location:index.php?site=login&error=true&reason=pwNotEqual");
    die();
}


//load users.csv into an array 'username'=>'password'
$user_file = file('users.csv');
$users = array();
for($i = 0; $i < count($user_file); $i++) {
    $line = explode(';',$user_file[$i]);
    $line[1] = str_replace("\r",'',$line[1]);
    $line[1] = str_replace("\n",'',$line[1]);
    $users[$line[0]] = $line[1];
}

//check if user exists
if(isset($users[$user])) {
    header("Location:index.php?site=login&error=true&reason=userExists");
    die();
}

//TODO check PW-Strength

//append user
file_put_contents('users.csv',"\r\n$user;".md5($pwort),FILE_APPEND);

$_SESSION['username'] = $user;

header("Location:index.php");
die();
