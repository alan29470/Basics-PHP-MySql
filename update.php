<?php

	if (isset($_POST['change'])) {
		
			

		if(isset($_POST['newpseudo']) and !empty($_POST['newpseudo']))
			{
				
				$newpseudo = htmlspecialchars($_POST['newpseudo']);
				$newprenom = htmlspecialchars($_POST['newprenom']);
				$newage = htmlspecialchars($_POST['newage']);
				$facebook = htmlspecialchars($_POST['newfacebook']);
				$twiter = htmlspecialchars($_POST['newtwiter']);
				$linkedin = htmlspecialchars($_POST['newlinkedin']);
				$insertpseudo = $bdd->prepare('UPDATE inscriptions SET inscriptionNom = ?, inscriptionPrenom = ?, inscriptionAge = ?, inscriptionFacebook = ?, inscriptionTwiter = ?, inscriptionLinkedin = ? WHERE userId = ? ');
				$insertpseudo->execute(array($newpseudo,$newprenom,$newage,$facebook,$twiter,$linkedin, $_SESSION['id']));
				header("Location: profil.php");
				
				
			}
	}
?>