<?php
require_once "private/db.php";
$connectDB = mysqli_connect($hostDB, $userDB, $passwordDB, $nameDB);
require_once "private/salt.php";
$key = $salt;

session_start();

$modeInscription = false;
$isLogged = false;
$modeConnect = false;
$modeEdit = false;
$modeCreate = false;

if(isset($_POST['modeConnect']) && $_POST['modeConnect']== "on"){
    $modeConnect = true;
}
if(isset($_POST['modeInscription']) && $_POST['modeInscription']== "on"){
    $modeInscription = true;
}
if(isset($_POST['modeDeco']) && $_POST['modeDeco']== "on"){
    session_unset();
}
if(isset($_POST['$modeCreate']) && $_POST['$modeCreate']== "on"){
    $modeCreate = true;
}

if(isset($_POST['modeEdit']) && $_POST['modeEdit']){
    $modeEdit = true;
    $idPostEdit = $_POST['modeEdit'];
    $requetePostsIdEdit = "SELECT * FROM posts WHERE id=$idPostEdit";
    $resultRequetePostsIdEdit = mysqli_query($connectDB, $requetePostsIdEdit);
}
if(isset($_POST['idEditUp']) && isset($_POST['titleEditUp']) && isset($_POST['contentEditUp'])){

    $idEditUp = $_POST['idEditUp'];
    $titleEditUp = $_POST['titleEditUp'];
    $contentEditUp = $_POST['contentEditUp'];

    $requeteUpdate = "UPDATE posts SET title  = '$titleEditUp', content = '$contentEditUp' WHERE id = $idEditUp";

    $resultUpdate = mysqli_query($connectDB, $requeteUpdate);

}
if(isset($_POST['authorIdCreate']) && isset($_POST['titleCreate']) && isset($_POST['contentCreate'])){

    $authorIdCreate = $_POST['authorIdCreate'];
    $titleCreate = $_POST['titleCreate'];
    $contentCreate = $_POST['contentCreate'];

    $requeteCreate = "INSERT INTO posts(title, content, author) VALUES ('$titleCreate', '$contentCreate', '$authorIdCreate')";

    $resultCreate = mysqli_query($connectDB, $requeteCreate);

}
if(isset($_POST['idEditSupp'])){

    $idEditSupp = $_POST['idEditSupp'];
    $requeteSupp = "DELETE FROM `posts` WHERE `id`='$idEditSupp'";

    $resultSupp = mysqli_query($connectDB, $requeteSupp);

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

if (isset($_GET['profile'])) {

    $userId = $_GET['profile'];

    $requeteUserId = "SELECT * FROM users WHERE id=$userId";

    $resultRequeteUserId = mysqli_query($connectDB, $requeteUserId);
}

if(isset($_POST['postId'])){

    $postId = $_POST['postId'];

    $requetePostsId = "SELECT * FROM posts WHERE id=$postId";

    $resultRequetePostsId = mysqli_query($connectDB, $requetePostsId);

} else if(isset($_GET['postId'])){

    $postId = $_GET['postId'];

    $requetePostsId = "SELECT * FROM posts WHERE id=$postId";

    $resultRequetePostsId = mysqli_query($connectDB, $requetePostsId);

} else{

    $requetePosts = "SELECT * FROM posts";

    $resultRequetePosts = mysqli_query($connectDB, $requetePosts);
}

if (isset($userId)) {
    $isLogged = true;

    $requeteUserId = "SELECT * FROM users WHERE id=$userId";

    $resultRequeteUserId = mysqli_query($connectDB, $requeteUserId);
}










?>