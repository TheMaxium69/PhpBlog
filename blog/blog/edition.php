
<?php require "logique.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un nouveau post</title>
    <link rel="stylesheet" href="https://bootswatch.com/5/solar/bootstrap.css">

</head>
<body>
<?php require_once dirname(__FILE__)."/../navbar.php" ?>
            <div class="container">
                <div class="">
                <?php
    foreach($leResultatDeMaRequeteArticleUnique as $value){?>


                    <form action="" method="POST">

                    <input type="hidden" name="idAModifier" value="<?php echo $value['id'] ?>">
                    <input type="hidden" name="postId" value="<?php echo $value['id'] ?>">

                   
                    <input class="form-control" type="text" name="titreEdite" id="" value="<?php echo $value['title'] ?>" placeholder="votre titre">
                    <textarea class="form-control" name="texteEdite" id="" cols="30" rows="10" placeholder="votre texte"><?php echo $value['content'] ?></textarea>
                    <input class="form-control btn btn-success" type="submit" value="Enregistrer les modifications">
                        
                    
                    
                    </form>
                    <?php }?>


<form action="" method="POST">
<input type="hidden" name="idSuppression" value="<?php echo $value['id'] ?>">

<div class="row">

<input type="submit" class="btn btn-danger" value="Supprimer cet Article" >

</div>

</form>

                                
                </div>
            </div>


</body>
</html>