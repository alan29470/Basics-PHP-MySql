<?php

if (isset($_POST['change'])) {
if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name'])) {
   $tailleMax = 2097152;
   $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
   if($_FILES['avatar']['size'] <= $tailleMax) {
      $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
      if(in_array($extensionUpload, $extensionsValides)) {
         $chemin = "avatars/".$_SESSION['id'].".".$extensionUpload;
      
         $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
       
         if($resultat) {
            $updateavatar = $bdd->prepare('UPDATE inscriptions SET avatar = :avatar WHERE userId = :userId');
            $updateavatar->execute(array('avatar' => $_SESSION['id'].".".$extensionUpload,'userId' => $_SESSION['id']));
            
            header('Location: profil.php?id='.$_SESSION['id']);
         } else {
            $msg = "Erreur durant l'importation de votre photo de profil";
         }
      } else {
         $msg = "Votre photo de profil doit être au format jpg, jpeg, gif ou png";
      }
   } else {
      $msg = "Votre photo de profil ne doit pas dépasser 2Mo";
   }
}
}
?>