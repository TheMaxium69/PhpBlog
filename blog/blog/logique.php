<?php 

session_start();
if(isset($_POST['logOut'])){
   session_unset();
} 

$racineSite = "http://localhost/hb/blog";


require_once dirname(__FILE__)."/../authentification/auth.php";
require_once dirname(__FILE__)."/../access/db.php";





   // Affichage de profil

   if(isset($_GET['profile']) && $_GET['profile'] !=""){

         $userId = $_GET['profile'];

            $maRequeteProfile = "SELECT * FROM users WHERE id = '$userId'";

            $resultatRequeteProfil = mysqli_query($maConnection, $maRequeteProfile);

            


   }






    //Suppression d'un article


$isOwner = false;




    if(isset($_POST['idSuppression'])){

      $idASupprimer = $_POST['idSuppression'];


      if($isLoggedIn && verifyOwnership($_SESSION['userId'], $idASupprimer, $maConnection) ){


      $maRequeteDeSuppression = "DELETE FROM posts WHERE id=$idASupprimer";

      $maSuppression= mysqli_query($maConnection, $maRequeteDeSuppression);

      header("Location: ../index.php");

      }else{
         header("Location: ../index.php?info=pasLeDroit");

      }


    }
   


    // modification d'un article

      if(isset($_POST['titreEdite']) && isset($_POST['texteEdite'])){
         
            $titreEdite = $_POST['titreEdite'];
      
            $texteEdite = $_POST['texteEdite'];


      //on doit refaire passer l'ID par le biais d'un input supplémentaire dans le
            $idArticleAModifier = $_POST['idAModifier'];

          //  if($isLoggedIn && verifyOwnership($userId, $postId) ){
           if($isLoggedIn && verifyOwnership($_SESSION['userId'], $idArticleAModifier, $maConnection) ){


            

               $maRequeteUpdate = "UPDATE posts SET title  = '$titreEdite', content = '$texteEdite' WHERE id = $idArticleAModifier";

               $monResultat = mysqli_query($maConnection, $maRequeteUpdate);

               header("Location: postUnique.php?postId=$idArticleAModifier&info=edited");

           } else{
            header("Location: postUnique.php?postId=$idArticleAModifier&info=pasLeDroit");

           }


         }






    //creation d'article

    if( isset($_POST['nouveauTitre']) && isset($_POST['nouveauTexte']) ){
            if( $_POST['nouveauTitre'] !== "" && $_POST['nouveauTexte'] !== "" ){
                    $nouveauTitre = $_POST['nouveauTitre'];
                    $nouveauTexte = $_POST['nouveauTexte'];
                    $authorId = $_SESSION['userId'];

                    $maRequete = "INSERT INTO posts(title, content, author_id) VALUES ('$nouveauTitre', '$nouveauTexte', '$authorId')";
                     
                     $leResultatDeMonAjoutArticle = mysqli_query($maConnection, $maRequete);
                   
                   
                     // TEST qu ne doit pas etre visible pour les uilisateurs
                     if(!$leResultatDeMonAjoutArticle){
                        die("RAPPORT ERREUR ".mysqli_error($maConnection));
                        
                     } 
                     
                     header("Location: ../index.php?info=added");
                  }
         else{
            echo "remplis ton formulaire en entier";
         }
           
    }
    
    //effectuer une requete pour un article spécifique:
     if(  isset($_GET['postId']) || isset($_POST['postId']) ){

           if(isset($_GET['postId'])){
              $postId = $_GET['postId'];
           }else{
            $postId = $_POST['postId'];
           }
         if($isLoggedIn){

            if(verifyOwnership($_SESSION['userId'], $postId, $maConnection)){

            $isOwner = true;
           }
         }     
           
           
            

             $maRequeteArticleUnique = "SELECT * FROM posts WHERE id=$postId";

             $leResultatDeMaRequeteArticleUnique = mysqli_query($maConnection, $maRequeteArticleUnique);
     
     
     
            }else if(isset($_POST['myPosts']) && $isLoggedIn  ){


            $userId = $_SESSION['userId'];

            echo "on est bien dans le cas MES POSTS";
        $maRequete = "SELECT * FROM posts WHERE author_id = '$userId'";

        $leResultatDeMaRequete = mysqli_query($maConnection, $maRequete);







     }else{    //effectuer une requete SQL pour récupérer TOUS les posts

        $maRequete = "SELECT * FROM posts";

        $leResultatDeMaRequete = mysqli_query($maConnection, $maRequete);





     }



      function verifyOwnership($userId, $postId, $maConnection){

      
         //on veut comparer l'userId au author_id

         //a partir du postId faire une requete SQL pour récurérer l'author_id
         //et comparer l'userId de la session à cet author_id récupéré directement depuis la BDD
         //et regler $ownerVerified sur true ou false en fonction de cela


            $maRequeteDeVerification = "SELECT * FROM posts WHERE id = '$postId'";



               $resultatRequeteVerification = mysqli_query($maConnection, $maRequeteDeVerification);

               foreach($resultatRequeteVerification as $value){
                  $authorId = $value['author_id'];

               }

               $ownerVerified = false;

               if($userId == $authorId){

                  $ownerVerified = true;
               }


            






            if($ownerVerified){

               return true;
            }else{

               return false;
            }

      }




    


    







?>