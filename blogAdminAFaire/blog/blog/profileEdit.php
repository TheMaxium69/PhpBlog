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
                

        <?php foreach($resultatRequeteProfil as $value){ ?>


            <img src="../images/profiles/<?php echo $value['image']?>">
<p>modifier la photo :</p>
            <form action="" method="POST" enctype="multipart/form-data">

                    <input type="hidden" name="profilePic" value="upload">

                    <input type="hidden" name="userId" value="<?php echo $value['id'] ?>">

                    <input type="file" name="pictureToUpload">
                    <button type="submit" class="btn btn-primary">Envoyer la photo</button>
            </form>

            <form action="" method="POST">

<input type="hidden" name="userIdAModifier" value="<?php echo $value['id'] ?>">


<input class="form-control" type="text" name="displayName" id="" value="<?php echo $value['display_name'] ?>" placeholder="votre display name">
<input class="form-control" type="text" name="email" id="" value="<?php echo $value['email'] ?>" placeholder="votre email">

<input class="form-control btn btn-success" type="submit" value="Enregistrer les modifications">
    


</form>


<?php } ?>
               
            </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</body>
</html>