<?php include "logique.php"?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://bootswatch.com/5/solar/bootstrap.css">
</head>
<body>
   

<?php require_once dirname(__FILE__)."/../navbar.php" ?>
<?php if( isset($_GET['info']) && $_GET['info'] == 'edited' ){?>

<div class="alert alert-dismissible alert-success">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  <strong>Well done!</strong> You successfully edited <a href="#" class="alert-link">this article</a>.
</div>
<?php } ?>
<?php if( isset($_GET['info']) && $_GET['info'] == 'pasLeDroit' ){?>

<div class="alert alert-dismissible alert-danger">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  <strong>Well done!</strong> Vous n'avez pas le droit de modifier cet article <a href="#" class="alert-link">this article</a>.
</div>
<?php } ?>
    <div class="container mt-5">



   
  <div class="container">
  
  
  

<?php
    foreach($leResultatDeMaRequeteArticleUnique as $value){?>
                  
                  <div class="row text-center">
                  
                    <h2><?php echo $value["title"];?></h2>
                  
                  
                  </div>
                  
                  <div class="text-center">
                      <p><?php echo $value['content'];?></p>
                  </div>
                  
                    
                   
                   
            
    </div>
    </div>
<?php if($isLoggedIn && $isOwner){?>
            <div class="row">
            <form action="edition.php" method="post">
              <button type="submit" name="postId" value="<?php echo $value['id']?>" class="btn btn-primary">Modifier</button>
            </form>
            </div>
     <?php } ?>

<?php }?>

    <div class="row">
    
            <a href="/hb/blog" class="btn btn-danger">Retour a l'accueil</a>
    </div>
    
    
    
    
    
    
</body>
</html>