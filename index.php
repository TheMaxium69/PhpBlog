<?php include "base.php";
//var_dump($_POST);
?>
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
                    <?php if(isset($_GET['postId']) || isset($_GET['profile'])){ ?>
                    <form method="GET" class="d-flex">
                        <button class="btn btn-outline-dark">Home</button>
                    </form>
                    <?php } else { ?>
                        <form method="POST" class="d-flex">
                            <button class="btn btn-outline-dark">Home</button>
                        </form>
                    <?php } ?>
                </li>
            </ul>
            <form method="POST" class="d-flex">
                <?php if(!$isLogged && !$modeInscription && !isset($_SESSION["userIdLog"])){ ?>
                <button class="btn btn-dark" name="modeConnect" value="on">Connecte/Inscription</button>
                <?php } if(isset($_SESSION["userIdLog"])){?>
                    <form action="" method="post"><button class="btn btn-outline-dark" name="modeDeco" value="on">Se déconnecter</button></form>
                    <form action="" method="post"><button class="btn btn-dark" type="submit" name="userId" value="<?php echo $_SESSION["userIdLog"] ?>">Votre Profils <?php echo $_SESSION["userNameLog"]; ?></button></form>
                    <form action="" method="post"><button class="btn btn-dark" type="submit" name="modeCreate" value="on">Céer un article</button></form>
                    <form action="" method="POST"><button type="submit" name="myPosts" class="btn btn-dark" >Mes Posts</button></form>
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
    <?php if(isset($_GET['info']) && $_GET['info']== "registered"){ ?>
        <div class="alert alert-success" role="alert">
            Successfully registered !
        </div>
    <?php }?>
    <?php if(isset($_GET['info']) && $_GET['info']== "login"){ ?>
        <div class="alert alert-success" role="alert">
            Successfully login !
        </div>
    <?php } ?>


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
<?php } else if (isset($_POST['userId']) || isset($_GET['profile']) ) {?>
    <?php foreach($resultRequeteUserId as $value){ ?>
        <p>Name = <?php echo $value["displayname"]; ?></p>
        <p>Username = <?php echo $value["username"]; ?></p>
        <p>Email = <?php echo $value["email"]; ?></p>
        <p> Date de création : <?php echo $value["date"]; ?></p>
        <?php
        if (isset($_SESSION["userIdLog"]) && isset($_POST['userId']) && $_SESSION["userIdLog"] == $_POST['userId']){ ?>
            <form method="POST" class="d-flex"><button type="submit" name="modeUserEdit" value="on" class="btn btn-danger">Edit</button></form>
            <form method="POST" class="d-flex"><button class="btn btn-danger">Retour</button></form>
        <?php } else if (isset($_GET['profile']) ){ ?>
        <form method="GET"><input class="btn btn-danger" type="submit" value="Retour"> </input></form>
<?php } } } else { ?>
    <div class="container">
        <div class="row mt-5">
            <?php if(isset($_POST['postId']) || isset($_GET['postId'])){ ?>
                <?php foreach($resultRequetePostsId as $value){ ?>
                    <h1><?php echo $value["id"];?> : <?php echo $value["title"]; ?></h1>
                    <p><?php echo $value["content"]; ?></p>
                    <h6> Ceer par : <?php
                        $postUserId = $value["author"];
                        $requetePostsUsers = "SELECT * FROM users WHERE id=$postUserId";
                        $resultRequetePostsUsers = mysqli_query($connectDB, $requetePostsUsers);
                        foreach($resultRequetePostsUsers as $valueUsers){ ?>
                            <a style="color: white" href="index.php?profile=<?php echo $valueUsers["id"] ?>"> <?php echo $valueUsers["username"] ?></a>
                            <?php } ?></h6>
                    <p> Date de création : <?php echo $value["date"]; ?></p>
                    <p> statue : <?php if($value['publish'] == 0){?> public <?php } else {?>prive<?php }?></p>
                    <form method="GET"><button class="btn btn-outline-danger" type="submit">retour</button></form>
                    <?php if (isset($_SESSION["userIdLog"]) && $postUserId == $_SESSION["userIdLog"]) { ?>
                        <form action="index.php" method="post"><button class="btn btn-danger" type="submit" name="modeEdit" value="<?php echo $value["id"]; ?>">Edit</button></form>
                        <?php if($value['publish'] == 0){ ?>
                        <form action="index.php" method="post"><button class="btn btn-danger" type="submit" name="modePrivate" value="<?php echo $value["id"]; ?>">Mettre en privé</button></form>
                        <?php } else { ?>
                        <form action="index.php" method="post"><button class="btn btn-danger" type="submit" name="modePublic" value="<?php echo $value["id"]; ?>">Mettre en public</button></form>
                    <?php } } ?>
                    <hr>
                    <?php if(isset($_SESSION["userIdLog"])){?>
                        <h5>Mettre un commentaire</h5>
                        <div class="row">
                            <form action="" method="post">
                                <div class="form-group"><input type="text" name="comment" id="" class="form-control" placeholder="Votre commentaire"></div>
                                <div class="form-group"><button type="submit" class="btn btn-danger">Poster le commentaire</button></div>
                            </form>
                        </div>
                        <hr>
                    <?php } ?>
                    <h6>les commentaires</h6>
                    <?php foreach($resultRequetePostsCom as $value){
                                    $postUserId = $value["author"];
                                    $requetePostsUsers = "SELECT * FROM users WHERE id=$postUserId";
                                    $resultRequetePostsUsers = mysqli_query($connectDB, $requetePostsUsers);
                                    foreach($resultRequetePostsUsers as $valueUsers){?>
                                        <hr>
                                        <h6> De : <?php echo $valueUsers["username"] ?> à <?php echo $value["date"]; ?></h6>
                                    <?php } ?>
                        <p><?php echo $value["content"]; ?></p>
                    <?php } } }else if($modeEdit == true) {
                foreach($resultRequetePostsIdEdit as $value){?>
                    <form action="" method="post">
                        <input type="hidden" name="idEditUp" value="<?php echo $value['id'] ?>">
                        <input class="form-control" type="text" name="titleEditUp" id="" value="<?php echo $value['title'] ?>" placeholder="votre titre">
                        <textarea class="form-control" name="contentEditUp" id="" cols="30" rows="10" placeholder="votre texte"><?php echo $value['content'] ?></textarea>
                        <input class="form-control btn btn-danger" type="submit" value="Enregistrer les modifications">
                    </form>
                    <form action="" method="post">
                        <input type="hidden" name="idEditSupp" value="<?php echo $value['id'] ?>">
                        <input class="form-control btn btn-danger" type="submit" value="Supprimé">
                    </form>
               <?php }

            } else if (isset($_POST['myPosts'])){?>
                <h1 class="card-text"> Post de  : <?php
                            $postUserId = $_SESSION["userIdLog"];

                            $requetePostsUsers = "SELECT * FROM users WHERE id=$postUserId";

                            $resultRequetePostsUsers = mysqli_query($connectDB, $requetePostsUsers);

                            foreach($resultRequetePostsUsers as $valueUsers){
                                echo $valueUsers["username"];
                            }
                            ?></h1>
                <?php foreach($resultRequetePosts as $value){ ?>
                    <?php if ($value["author"] == $_SESSION["userIdLog"]) {?>

                    <div class="col-4">
                        <div class="card text-white bg-danger mb-3" style="max-width: 20rem;">
                            <div class="card-header"><?php echo $value["id"]; ?> : <?php echo $value["title"]; ?></div>
                            <div class="card-body">
                                <p class="card-text"><?php echo $value["content"]; ?></p>
                                <h6 class="card-text"> Ceer par : <?php
                                    $postUserId = $value["author"];

                                    $requetePostsUsers = "SELECT * FROM users WHERE id=$postUserId";

                                    $resultRequetePostsUsers = mysqli_query($connectDB, $requetePostsUsers);

                                    foreach($resultRequetePostsUsers as $valueUsers){?>
                                        <a style="color: white" href="index.php?profile=<?php echo $valueUsers["id"] ?>"> <?php echo $valueUsers["username"] ?></a>
                                    <?php }
                                    ?></h6>
                                <p><?php echo $value["date"]; ?></p>
                            </div>
                            <form method="POST">
                                <button class="btn btn-danger" type="submit" name="postId" value="<?php echo $value['id'] ?>">Aller à l'article</button>
                            </form>
                        </div>
                    </div>
                <?php } }
            } else if (isset($_POST['modeCreate'])){?>
                <h3>Créer un post ici</h3>
                <form method="post">
                    <input type="hidden" name="authorIdCreate" value="<?php echo $_SESSION["userIdLog"] ?>">
                    <div class="form-group">
                        <label for="username">Title</label>
                        <input type="text" class="form-control" name="titleCreate">
                    </div>
                    <div class="form-group">
                        <label for="username">Content</label>
                        <input type="text" class="form-control" name="contentCreate">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Create" class="btn btn-outline-light">
                    </div>
                </form>
            <?php } else if (isset($_POST['modeUserEdit'])){
                     foreach($resultRequeteUserIdEdit as $value){ ?>
                         <h3>Edit Mail and Diplay name</h3>
                         <form method="post">
                             <input type="hidden" name="userIdEditMD" value="<?php echo $_SESSION["userIdLog"] ?>">
                             <div class="form-group">
                                 <label for="username">Mail</label>
                                 <input type="text" class="form-control" name="userMailEdit" value="<?php echo $value["email"] ?>">
                             </div>
                             <div class="form-group">
                                 <label for="username">diplay name</label>
                                 <input type="text" class="form-control" name="userNameEdit" value="<?php echo $value["displayname"] ?>">
                             </div>
                             <div class="form-group">
                                 <label for="username">Mot de passe</label>
                                 <input type="password" class="form-control" name="mdpConfirme" placeholder="Confirmer votre mot de passe">
                             </div>
                             <div class="form-group">
                                 <input type="submit" value="Mettre a jour" class="btn btn-outline-danger">
                             </div>
                         </form>
                         <h3>Changer mot de passe</h3>
                         <form method="post">
                             <input type="hidden" name="userIdEditMdp" value="<?php echo $_SESSION["userIdLog"] ?>">
                             <div class="form-group">
                                 <label for="username">Ancien mot de pase</label>
                                 <input type="password" class="form-control" name="OldMdp" placeholder="Ancien mot de pase">
                             </div>
                             <div class="form-group">
                                 <label for="username">Nouveau mots de passe</label>
                                 <input type="password" class="form-control" name="NewMdp" placeholder="Nouveau mots de passe">
                             </div>
                             <div class="form-group">
                                 <label for="username">Confirmer nouveau mot de passe</label>
                                 <input type="password" class="form-control" name="CNewMdp" placeholder="Confirmer nouveau mot de passe">
                             </div>
                             <div class="form-group">
                                 <input type="submit" value="Changez de mots de passe" class="btn btn-outline-danger">
                             </div>
                         </form>
            <?php  } } else { ?>
                <h1> Voici les article du site</h1>
                <?php foreach($resultRequetePosts as $value){

                    if($value['publish'] == 0){?>
                    <div class="col-4">
                        <div class="card text-white bg-danger mb-3" style="max-width: 20rem;">
                            <div class="card-header"><?php echo $value["id"]; ?> : <?php echo $value["title"]; ?></div>
                            <div class="card-body">
                                <p class="card-text"><?php echo $value["content"]; ?></p>
                                <h6 class="card-text"> Ceer par : <?php
                                    $postUserId = $value["author"];

                                    $requetePostsUsers = "SELECT * FROM users WHERE id=$postUserId";

                                    $resultRequetePostsUsers = mysqli_query($connectDB, $requetePostsUsers);

                                    foreach($resultRequetePostsUsers as $valueUsers){?>
                                        <a style="color: white" href="index.php?profile=<?php echo $valueUsers["id"] ?>"> <?php echo $valueUsers["username"] ?></a>
                                    <?php }
                                    ?></h6>
                                <p><?php echo $value["date"]; ?></p>
                            </div>
                            <form method="GET">
                                <button class="btn btn-danger" type="submit" name="postId" value="<?php echo $value['id'] ?>">Aller à l'article</button>
                            </form>
                        </div>
                    </div>
                <?php } } }?>
        </div>
    </div>
<?php } ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script></body>
</html>