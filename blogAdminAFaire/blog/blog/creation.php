
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
                
                    <form action="logique.php" method="POST" enctype="multipart/form-data">
                    <input type="file" name="uploadPostPic">
                    <input class="form-control" type="text" name="nouveauTitre" id="" placeholder="votre titre">
                    <textarea class="form-control" name="nouveauTexte" id="" cols="30" rows="10" placeholder="votre texte"></textarea>
                    <input class="form-control btn btn-success" type="submit" value="Poster">
                        
                    
                    
                    </form>


               
            </div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</body>
</html>