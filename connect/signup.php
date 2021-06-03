<?php
if(isset($_POST['usernameSignUp']) && isset($_POST['displayNameSignUp']) && isset($_POST['emailSignUp'])&& isset($_POST['passwordSignUp']) && isset($_POST['passwordRetypeSignUp']) ){
    echo "tout est set" . "<br>";
    if( !empty($_POST['usernameSignUp']) &&  !empty($_POST['displayNameSignUp']) &&  !empty($_POST['emailSignUp']) &&  !empty($_POST['passwordSignUp']) &&  !empty($_POST['passwordRetypeSignUp']) ){
        echo "tout est plein" . "<br>";
        $usernameSignUp = $_POST['usernameSignUp'];
        $displayNameSignUp = $_POST['displayNameSignUp'];
        $emailSignUp = $_POST['emailSignUp'];
        $passwordSignUp = $_POST['passwordSignUp'];
        $passwordRetypeSignUp = $_POST['passwordRetypeSignUp'];
        if($passwordSignUp == $passwordRetypeSignUp){
            require_once "base.php";
            $requeteUsername = "SELECT * FROM users WHERE username = '$usernameSignUp'";
            $resultUsername = mysqli_query($connectDB, $requeteUsername);
            if($resultUsername->num_rows == 0){
                echo "on peut l'inscrire" . "<br>";
                $passwordSignUpCrypt = md5($passwordSignUp);
                require_once "base.php";
                $passwordSignUpCryptSalt = $passwordSignUpCrypt.md5($key);
                $requeteInsert = "INSERT INTO users(username, displayname, email, password, role) VALUES ('$usernameSignUp', '$displayNameSignUp', '$emailSignUp', '$passwordSignUpCryptSalt', 'user')";
                echo $requeteInsert;
                $resultInsert = mysqli_query($connectDB, $requeteInsert);
                header("location: index.php?info=registered");
            }else{
                echo "username non disponible";
            }
        }else{
            echo  "les deux mots de passe ne matchent pas";
        }
    }else{
        echo "il manque des trucs dans le formulaire";
    }
}else{
    echo "il manque des trucs";
}
?>