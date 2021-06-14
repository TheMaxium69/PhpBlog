<?php 

require_once "logique.php";

if ($isAdmin){?>


    <p>salut admin</p>

// la liste de tous les posts et pour chaque post : 
 //   -un lien vers l'affichage du post
   // -un bouton publier/dépublier fonctionnel
   // -un bouton supprimer

// la liste de tous les users sauf l'admin lui-même, et pour chaque user  
     //       -un bouton supprimer



<?php }else{?>


<p>vous n'etes pas administrateur</p>


<?php }?>