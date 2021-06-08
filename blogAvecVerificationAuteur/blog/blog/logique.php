<?php 

session_start();
if(isset($_POST['logOut'])){
   session_unset();
} 


require_once dirname(__FILE__)."/../authentification/auth.php";
require_once dirname(__FILE__)."/../access/db.php";

    //Suppression d'un article

    if(isset($_POST['idSuppression'])){

      $idASupprimer = $_POST['idSuppression'];

      $maRequeteDeSuppression = "DELETE FROM posts WHERE id=$idASupprimer";

      $maSuppression= mysqli_query($maConnection, $maRequeteDeSuppression);

      header("Location: ../index.php");

    }
   


    // modification d'un article

      if(isset($_POST['titreEdite']) && isset($_POST['texteEdite'])){
         
            $titreEdite = $_POST['titreEdite'];
      
            $texteEdite = $_POST['texteEdite'];


      //on doit refaire passer l'ID par le biais d'un input supplémentaire dans le
            $idArticleAModifier = $_POST['idAModifier'];

          //  if($isLoggedIn && verifyOwnership($userId, $authorId) ){
           if($isLoggedIn && verifyOwnership() ){


            

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



     // function verifyOwnership($userId, $authorId){

         function verifyOwnership(){

         //on veut comparer l'userId au author_id
         //et regler $ownerVerified sur true ou false en fonction de cela


            $ownerVerified = true;






            if($ownerVerified){

               return true;
            }else{

               return false;
            }

      }




    


    







?>