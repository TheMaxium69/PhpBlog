<?php
require_once "private/db.php";
$connectDB = mysqli_connect($hostDB, $userDB, $passwordDB, $nameDB);
require_once "private/salt.php";
$key = $salt;

session_start();

$modeInscription = false;
$isLogged = false;
$modeConnect = false;

echo $isLogged;

if(isset($_POST['modeConnect']) && $_POST['modeConnect']== "on"){
    $modeConnect = true;
}
if(isset($_POST['modeInscription']) && $_POST['modeInscription']== "on"){
    $modeInscription = true;
}
if(isset($_POST['modeDeco']) && $_POST['modeDeco']== "on"){
    session_unset();
}

if($modeInscription){
    require_once "connect/signup.php";
}
if($isLogged){

}else{
    require_once "connect/login.php";
}
if (isset($_POST['userId'])) {

    $userId = $_POST['userId'];

    $requeteUserId = "SELECT * FROM users WHERE id=$userId";

    $resultRequeteUserId = mysqli_query($connectDB, $requeteUserId);
}

if(isset($_POST['postId'])){

    $postId = $_POST['postId'];

    $requetePostsId = "SELECT * FROM posts WHERE id=$postId";

    $resultRequetePostsId = mysqli_query($connectDB, $requetePostsId);
}else{

    $requetePosts = "SELECT * FROM posts";

    $resultRequetePosts = mysqli_query($connectDB, $requetePosts);
}

if (isset($userId)) {
    $isLogged = true;

    $requeteUserId = "SELECT * FROM users WHERE id=$userId";

    $resultRequeteUserId = mysqli_query($connectDB, $requeteUserId);
}










?>