<?php
require_once "private/db.php";
$connectDB = mysqli_connect($hostDB, $userDB, $passwordDB, $nameDB);
require_once "private/salt.php";
$key = $salt;


$modeInscription = false;
$isLogged = false;
$modeConnect = false;


if(isset($_POST['modeConnect']) && $_POST['modeConnect']== "on"){
    $modeConnect = true;
}
if(isset($_POST['modeInscription']) && $_POST['modeInscription']== "on"){
    $modeInscription = true;
}




if($modeInscription){
    require_once "connect/signup.php";
}
if($isLogged){
    echo "tu est bien log";
}else{
    require_once "connect/login.php";
}












?>