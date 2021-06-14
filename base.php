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
$modeUserEdit = false;

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
if(isset($_POST['modeUserEdit']) && $_POST['modeUserEdit']== "on"){
    $modeUserEdit = true;
    $userId = $_SESSION['userIdLog'];
    $requeteUserIdEdit = "SELECT * FROM users WHERE id=$userId";
    $resultRequeteUserIdEdit = mysqli_query($connectDB, $requeteUserIdEdit);
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
    
    $requetePostsCom = "SELECT * FROM comments WHERE post=$postId";

    $resultRequetePostsCom = mysqli_query($connectDB, $requetePostsCom);

} else if(isset($_GET['postId'])){

    $postId = $_GET['postId'];

    $requetePostsId = "SELECT * FROM posts WHERE id=$postId";

    $resultRequetePostsId = mysqli_query($connectDB, $requetePostsId);

    $requetePostsCom = "SELECT * FROM comments WHERE post=$postId";

    $resultRequetePostsCom = mysqli_query($connectDB, $requetePostsCom);
} else{

    $requetePosts = "SELECT * FROM posts";

    $resultRequetePosts = mysqli_query($connectDB, $requetePosts);
}

if (isset($userId)) {
    $isLogged = true;

    $requeteUserId = "SELECT * FROM users WHERE id=$userId";

    $resultRequeteUserId = mysqli_query($connectDB, $requeteUserId);
}
if(isset($_POST['userIdEditMD']) && isset($_POST['userMailEdit']) && isset($_POST['userNameEdit']) && isset($_POST['userNameEdit']) && isset($_POST['mdpConfirme'])){

    $userIdEditMD = $_POST['userIdEditMD'];
    $userMailEdit = $_POST['userMailEdit'];
    $userNameEdit = $_POST['userNameEdit'];
    $mdpConfirmEdit = $_POST['mdpConfirme'];

    $requetEditVerif = "SELECT * FROM users WHERE id = '$userIdEditMD'";
    $resultRequetEditVerif = mysqli_query($connectDB, $requetEditVerif);
            if( $resultRequetEditVerif->num_rows == 1){
                foreach( $resultRequetEditVerif as $value){
                    $vraiMotDePasse =  $value['password'];
                }
                if(md5($mdpConfirmEdit).md5($key) == $vraiMotDePasse){
                    $requeteUserUpdate = "UPDATE users SET displayname  = '$userNameEdit', email = '$userMailEdit' WHERE id = $userIdEditMD";
                    $resultUserUpdate = mysqli_query($connectDB, $requeteUserUpdate);
                }else{
                    echo "mauvais mot de passe";
                }
            }else{
                echo "Tes bugger";
            }
}
if(isset($_POST['userIdEditMdp']) && isset($_POST['OldMdp']) && isset($_POST['NewMdp']) && isset($_POST['CNewMdp'])){

    $userIdEditMdp = $_POST['userIdEditMdp'];
    $OldMdp = $_POST['OldMdp'];
    $NewMdp = $_POST['NewMdp'];
    $CNewMdp = $_POST['CNewMdp'];

    if ($NewMdp == $CNewMdp) {
        $requetEditVerifMdp = "SELECT * FROM users WHERE id = '$userIdEditMdp'";
        $resultRequetEditVerifMdp = mysqli_query($connectDB, $requetEditVerifMdp);
        if ($resultRequetEditVerifMdp->num_rows == 1) {
            foreach ($resultRequetEditVerifMdp as $value) {
                $vraiMotDePasse = $value['password'];
            }
            if (md5($OldMdp) . md5($key) == $vraiMotDePasse) {
                $NewMdpCrypt = md5($NewMdp);
                $NewMdpCryptSalt = $NewMdpCrypt.md5($key);

                $requeteUserUpdateMdp = "UPDATE users SET password  = '$NewMdpCryptSalt' WHERE id = $userIdEditMdp";
                $resultUserUpdateMdp = mysqli_query($connectDB, $requeteUserUpdateMdp);
                echo "mdp bien changer";
            } else {
                echo "mauvais mot de passe";
            }
        } else {
            echo "Tes bugger";
        }
    }else{
        echo "les deux mots de passe ne matchent pas";
    }
}
if(isset($_POST['comment'])){
    $comment = $_POST['comment'];
    $postId = $_GET['postId'];
    $userId = $_SESSION['userIdLog'];

    $requeteComAdd = "INSERT INTO comments(content, author, post) VALUES ('$comment', '$userId', '$postId' )";
    $resultRequeteComAdd = mysqli_query($connectDB, $requeteComAdd);
}
?>