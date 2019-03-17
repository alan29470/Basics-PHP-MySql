<?php
session_start(); // on démarre la session utilisateur //

$bdd = new PDO('mysql:host=localhost;dbname=monjob', 'root', '');// on appel  la base de donnée //
if(isset($_POST['formlog'])){
	// on declare les variables avec la securité htmlspécialchars pour empecher l'incorporation de code html dans le formulaire et aussi on utilise md5 pour le hachage du mot de passe dans la base de donnée //
	$pseudologin = htmlspecialchars($_POST['pseudologin']);
	$mdplogin = md5($_POST['mdplogin']);
	// on declare les conditions et on compare si il sont bien inscrit dans la base de donnée //
	if(!empty($pseudologin) AND !empty($mdplogin)){
		$requser = $bdd->prepare("SELECT * FROM entreprises WHERE userLogin = ? AND motDePasse = ?");
		$requser->execute(array($pseudologin, $mdplogin));
		$userexist = $requser->rowCount();
		// si l'utilisateur exist on démarre la session de l'utilisateur //
		if($userexist == 1)
		{   
			$userinfo = $requser->fetch();
			$_SESSION['id'] = $userinfo['userEId'];
			

			// on redirge sur la page profil de l'utilisateur //
			
			header("Location: index.php?id=" .$_SESSION['id']);

			// on gere les erreurs en affichant un message //
		}else{
			$erreur = "pseudo inconue !";
		}
	}else{
		$erreur = "tous les champs ne sont pas remplit !";
	}
}
?>