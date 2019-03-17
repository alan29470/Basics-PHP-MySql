                       <?php
                                    try {
                                    $bdd = new PDO('mysql:host=localhost;dbname=testfilrouge', 'root', '');// on appel la base de donnée //
                                } catch (Exception $e) {
                                    die('Erreur : ' . $e->getMessage());
                                }
                                    $requser = $bdd->query('SELECT userId, inscriptionNom, inscriptionPrenom, inscriptionAge, avatar FROM inscriptions ORDER BY inscriptions.userId DESC');
                                    
                                    $userinfoo = $requser->fetchAll();

                                    foreach ($userinfoo as $key => $profil) {

            ?>
				      
		
       
						 		
				 			<div class="emply-resume-list square">
				 				<div class="emply-resume-thumb">
								 <?php 
								if(!empty($profil['avatar']))
								{
								?>
								<img src="avatars/<?php echo $profil['avatar']; ?>" width="150" height="110"  alt="" />
								<?php 
								}
								?>
				 				</div>
				 				<div class="emply-resume-info">
				 					<h3><a href="#" title="">  </a> <?php echo $profil['inscriptionNom']; ?> &nbsp; <?php echo $profil['inscriptionPrenom']; ?> </h3>
				 					<span> <?php echo $profil['inscriptionAge']; ?> &nbsp; ans </span>
				 					<p></p>
				 				</div>
				 				<div class="shortlists">
				 					<a href="voir_profil.php?id=<?=$profil['userId'] ?>">Voir le profil</a>
				 				</div>
							 </div><!-- Emply List -->
							 <?php
							}

                        $requser->closeCursor(); 
                        ?>