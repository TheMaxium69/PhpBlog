<?php include "base.php"?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Php User</title>
    <link href="" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="screen" href="styles.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-danger">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">PhpBlog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">

                    <form method="POST" class="d-flex">
                        <button class="btn btn-outline-dark">Home</button>
                    </form>
                </li>
            </ul>
            <form method="POST" class="d-flex">
                <?php if(!$isLogged && !$modeInscription && !isset($_SESSION["userIdLog"])){ ?>
                <button class="btn btn-dark" name="modeConnect" value="on">Connecte/Inscription</button>
                <?php } if(isset($_SESSION["userIdLog"])){?>
                    <form action="" method="post"><button class="btn btn-outline-dark" name="modeDeco" value="on">Se déconnecter</button></form>
                    <form action="" method="post"><button class="btn btn-dark" type="submit" name="userId" value="<?php echo $_SESSION["userIdLog"] ?>">Profils de <?php echo $_SESSION["userIdLog"]; ?></button></form>
                <?php } ?>
            </form>
        </div>
    </div>
</nav>
<?php if(!$connectDB){ ?>
<div class='alert alert-dismissible alert-warning'>
    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
    <h4 class='alert-heading'>Attention !</h4>
    <p class='mb-0'>Probleme de connection à la base de données.</p>
</div>
<?php die(); } ?>
    <?php /*if(isset($_GET['info']) && $_GET['info']== "registered"){ ?>
        <div class="alert alert-success" role="alert">
            Successfully registered !
        </div>
    <?php }?>
    <?php if(isset($_GET['info']) && $_GET['info']== "login"){ ?>
        <div class="alert alert-success" role="alert">
            Successfully login !
        </div>
    <?php }*/ ?>


<?php if($modeConnect == true) { ?>
    <h1>tu veut te connecté ?</h1>
    <h3>Connecte toi , ou créer toi un compte</h3>
            <?php if(!$isLogged && !$modeInscription){ ?>
                <form method="POST">
                    <div class="form-group">
                        <label for="username">Username</label>

                        <input type="text" class="form-control" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">password</label>

                        <input type="password" class="form-control" name="password" required>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Log in" class="btn btn-outline-light">
                    </div>
                </form>
                <form method="POST">
                    <button class="btn btn-outline-danger" type="submit" name="modeInscription" value="on">Créer un compte</button>
                </form>
            <?php } ?>
<?php } else if($modeInscription){ ?>
        <h3>Ah tu na pas de compte pas grave créer toi le ici</h3>
    <form method="post">
        <div class="form-group">
            <label for="username">Username Unique</label>
            <input type="text" class="form-control" name="usernameSignUp">
        </div>
        <div class="form-group">
            <label for="username">Name</label>
            <input type="text" class="form-control" name="displayNameSignUp">
        </div>
        <div class="form-group">
            <label for="username">Email</label>
            <input type="email" class="form-control" name="emailSignUp">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="passwordSignUp">
        </div>
        <div class="form-group">
            <label for="passwordRetype">Re-type Password</label>
            <input type="password" class="form-control" name="passwordRetypeSignUp">
        </div>
        <div class="form-group">
            <input type="hidden" name="modeInscription" value="on">
            <input type="submit" value="Sign up" class="btn btn-outline-light">
        </div>
    </form>
    <form method="POST">
        <input type="hidden" name="modeConnect" value="on"></input>
        <button class="btn btn-outline-danger" name="modeInscription" value="off">Se connecter</button>
    </form>
<?php } else if (isset($_POST['userId'])) {?>
    <?php foreach($resultRequeteUserId as $value){ ?>
        <p>Name = <?php echo $value["displayname"]; ?></p>
        <p>Username = <?php echo $value["username"]; ?></p>
        <p>Email = <?php echo $value["email"]; ?></p>
        <button class="btn btn-danger">Edit</button>
<?php } } else { ?>
    <div class="container">
        <div class="row mt-5">
            <?php if(isset($_POST['postId'])){ ?>
                <?php foreach($resultRequetePostsId as $value){ ?>
                    <h1><?php echo $value["id"]; ?> : <?php echo $value["title"]; ?></h1>
                    <p><?php echo $value["content"]; ?></p>
                    <h6><?php echo $value["author"]; ?></h6>
                <?php } }else{ ?>
                <h1> Voici les article du site</h1>
                <?php foreach($resultRequetePosts as $value){ ?>
                    <div class="col-4">
                        <div class="card text-white bg-danger mb-3" style="max-width: 20rem;">
                            <div class="card-header"><?php echo $value["id"]; ?> : <?php echo $value["title"]; ?></div>
                            <div class="card-body">
                                <p class="card-text"><?php echo $value["content"]; ?></p>
                                <p class="card-text"><?php echo $value["author"]; ?></p>
                            </div>
                            <form method="POST">
                                <button class="btn btn-danger" type="submit" name="postId" value="<?php echo $value['id'] ?>">Aller à l'article</button>
                            </form>
                        </div>
                    </div>
                <?php } }?>
        </div>
    </div>
<?php } ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script></body>
</html>