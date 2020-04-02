<?php
session_start();
$user = $_SESSION['username'];
//nicht angemeldete User haben keine Berechtigung
if($user == null) {
    header("Location:index.php?error=true");
    die();
}

$new_article = array(
'bez' => $_POST['bez'],
'ktxt' => $_POST['ktxt'],
'ltxt' => $_POST['ltxt'],
'pic' => 'not_found',// der file-path wird erst nachher festgelegt
'gewicht' => $_POST['gew'],
'gelagert' => $_POST['gel'],
'einheit' => $_POST['ein'],
'cost' => $_POST['preis'],
'user' => $user
);

//falls ein Wert fehlt => abbruch
foreach ($new_article as $item) {
    if($item == null) {
        header("Location:index.php?site=add&error=true");
        die();
    }
}

//secure file upload
$upload_folder = 'artikelbilder/';
$filename = pathinfo($_FILES["pic"]['name'], PATHINFO_FILENAME);
$extension = strtolower(pathinfo($_FILES['pic']['name'], PATHINFO_EXTENSION));

/*
 * TODO why doesn't the file-upload work
 * (der extensioncheck verhindert den Upload)
//Bild-extension
$allowed_extensions = array('png','jpg','jpeg','gif','bmp');
if (! in_array($extension,$allowed_extensions)) {
    header("Location:index.php?site=add&error=true&reason=wrongExt");
    die();
}
*/

//max file size
$max_size = 500 * 1024;
if($_FILES['pic']['size']>$max_size) {
    header("Location:index.php?site=add&error=true&reason=fileSize");
    die();
}

//Upload-Path
$new_path = $upload_folder.$filename.'.'.$extension;

//Überschreiben von gleichnamingen files vermeiden
if (file_exists($new_path)) {
    $fid = 1;
    do {
        $new_path = $upload_folder.$filename."_".$fid.'.'.$extension;
    }while(file_exists($new_path));
}

//file auf neuen Pfad verschieben
move_uploaded_file($_FILES['pic']['tmp_name'],$new_path);
//neuen Pfad in article speichern
$new_article['pic'] = $new_path;


//Article abspeichern
$articles = fopen('article.csv','a');
fputcsv($articles,$new_article,';');
fclose($articles);

echo implode(';',$new_article)." abgelget";

header("Location:index.php");
