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
                
            <?php if(isset($_GET['info']) && $_GET['info']== "edited"){ ?>

<div class="alert alert-success" role="alert">
Your profile was successfully edited !
</div>


<?php }?>
<?php if(isset($_GET['info']) && $_GET['info']== "picUploaded"){ ?>

<div class="alert alert-success" role="alert">
Your new profile picture was successfully uploaded !
</div>


<?php }?>
<?php if(isset($_GET['info']) && $_GET['info']== "uploadFailed"){ ?>

<div class="alert alert-danger" role="alert">
Your upload failed !
</div>


<?php }?>
<?php if(isset($_GET['info']) && $_GET['info']== "resolution"){ ?>

<div class="alert alert-danger" role="alert">
image trop large ou trop haute !
</div>


<?php }?>
<?php if(isset($_GET['info']) && $_GET['info']== "oversized"){ ?>

<div class="alert alert-danger" role="alert">
image trop lourde !
</div>


<?php }?>
<?php if(isset($_GET['info']) && $_GET['info']== "extension"){ ?>

<div class="alert alert-danger" role="alert">
merci d'utiliser des images aux formats jpg/jpeg/png
</div>


<?php }?>


        <?php foreach($resultatRequeteProfil as $value){ ?>


                    <img src="../images/profiles/<?php echo $value['image']?>">

                    <h2>Ici le username : <?php echo $value['username'] ?>  </h2>
                    <h2>Ici le display name : <?php echo $value['display_name'] ?>  </h2>

                    <h2>ici l'email : <?php echo $value['email'] ?></h2>

                <?php if($isLoggedIn && $isUser){?>
                
                    <form action="profileEdit.php" method="post">

                        <button name='profileEdit' value="<?php echo $_SESSION['userId'] ?>" type="submit" class="btn btn-warning">Modifier mon profil</button>
                    
                    
                    
                    </form>
                
                
                
                <?php } ?>



<?php } ?>
               
            </div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</body>
</html>