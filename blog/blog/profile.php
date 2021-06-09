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




                    <h2>Ici le username : <?php echo $value['username'] ?>  </h2>

                    <h2>ici l'email : <?php echo $value['email'] ?></h2>
<?php } ?>
               
            </div>


</body>
</html>