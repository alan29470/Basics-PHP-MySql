<?php


$id = htmlentities(trim($_GET['id']));
$id = (int) $id;
			if(!is_int($id) || $id == 0 || (isset($_SESSION['id'])) && $id == $_SESSION['id']){
				header('Location: views/voir_profil.php');
				exit;
			}
			$afficher_profil = $bdd->prepare("SELECT * FROM inscriptions WHERE userId = ?", array($id));
			$afficher_profil->execute(array($id));
			$profil = $afficher_profil->fetch();
?>