<?php
if (isset($_POST['username']) && isset($_POST['password'])){
    $usernameEntre = $_POST['username'];
    $passwordEntre = $_POST['password'];
    if( $usernameEntre != "" && $passwordEntre !=""){
        require_once "base.php";
        $maRequete = "SELECT * FROM users WHERE username = '$usernameEntre'";
        $leResultatDeMaRequeteLogin = mysqli_query($connectDB, $maRequete);
        if(  $leResultatDeMaRequeteLogin->num_rows == 1){
            foreach( $leResultatDeMaRequeteLogin as $value){
                $vraiMotDePasse =  $value['password'];
                $userId =  $value['id'];
                $userName =  $value['displayname'];
            }
            require_once "base.php";
            if( md5($passwordEntre).md5($key) == $vraiMotDePasse  ){
                $isLogged = true;
            }else{
                echo "mauvais mot de passe, $usernameEntre";
            }
        }else{
            echo "username inexistant dans la DB";
        }
    }else{

        echo "Veuillez entrer un username et un password";
    }
}
?>