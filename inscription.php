<?php
$bdd = new PDO('mysql:host=localhost;dbname=testfilrouge', 'root', '');// on appel la base de donnée //

// on donne des conditions de sécurité sur les entrées utilisateurs //
if (isset($_POST['formis'])) {
	// on declare les variables avec la securité htmlspécialchars pour empecher l'incorporation de code html dans le formulaire et aussi on utilise md5 pour le hachage du mot de passe dans la base de donnée //
    $pseudo = htmlspecialchars($_POST['pseudo']);
	$mail = htmlspecialchars($_POST['mail']);
	$mail2 = htmlspecialchars($_POST['mail2']);
	$mdp = md5($_POST['mdp']);
	$mdp2 = md5($_POST['mdp2']);
	// on donne une conditions pour verifier que tout les champs sont bien remplit //	
    if (!empty($_POST['pseudo']) and !empty($_POST['mail']) and !empty($_POST['mail2']) and !empty($_POST['mdp']) and !empty($_POST['mdp2'])) {
     
		// on utilise la fonction strlen pour trouver des caractéres dans une chaine de caractère //
        $pseudolenght = strlen($pseudo);
        if ($pseudolenght <= 50) {
			// on envoi une requête pour verifier si le pseudo est deja enregistrer dans la base de donnée  //
			$reqpseudo = $bdd->prepare("SELECT * FROM inscriptions WHERE inscriptionUserLogin = ?");
			$reqpseudo->execute(array($pseudo));
			$pseudoexist = $reqpseudo->rowCount();
			 if($pseudoexist == 0)
			 {

			 
				// on verifie si les deux mails saisie sont identique et valide //
            if ($mail == $mail2) 
            {
				if (filter_var($mail, FILTER_VALIDATE_EMAIL)) 
				
                {
					// on envoi une requête pour verifier si le mail est deja enregistrer dans la base de donnée //
					$reqmail = $bdd->prepare("SELECT * FROM inscriptions WHERE inscriptionEmail = ?");
					$reqmail->execute(array($mail));
					$mailexist = $reqmail->rowCount();
					 if($mailexist == 0)
					 {
						 // on verifie si les deux mots de passe saisie sont identique  //
							if ($mdp == $mdp2) {
								// on insert les informations dans base de donnée //
								$insertmbr = $bdd->prepare("INSERT INTO inscriptions (inscriptionUserLogin, inscriptionEmail, inscriptionMotDePasse) VALUES (? ,? ,?)");
								$insertmbr->execute(array($pseudo, $mail, $mdp));
								$insertmbr->debugDumpParams();
								$valide = "Votre compte à bien été crée !";
								header("Location: login.php");
							} 
							else
							// on déclare la variable erreur pour afficher les differents messages d'erreurs si les conditions ne sont pas remplit // 
							{  
								$erreur4 = "vos mot de passe sont incorrect !";
							}
						}
						else
						{
							$erreur3 = "Email deja valide !";
						}	
                }
				else
				{
                    $erreur3 = " Adresse email invalide";
                }
				} 
				else 
				{
                    $erreur3 = "Vos email ne corresponde pas !";
				}
				
			}else{
				$erreur2 = "Pseudo déjà pris !";
			}
			} 
			else 
			{
                $erreur2 = "Votre pseudo ne doit pas dépasser 50 caractère !";
            }


		} 
		else
		 {
            $erreur1 = "tout les champs doivent être completer !";
        }
    }


    ?>