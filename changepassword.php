<?php

	if(isset($_POST['newmdp']) AND !empty($_POST['newmdp']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2']))
	{

		$mdp = md5($_POST['newmdp']);
		$mdp2 = md5($_POST['newmdp2']);
		if($mdp == $mdp2)
		{
			$insertmdp = $bdd->prepare("UPDATE inscriptions SET inscriptionMotDePasse = ? WHERE userId = ? ");
			$insertmdp->execute(array($mdp, $_SESSION['id']));
			header("Location: profil.php?id=" .$_SESSION['id']);
		}
		else {
			$erreur = "vos mot de passe ne corresponde pas !";
		}
	}


?>