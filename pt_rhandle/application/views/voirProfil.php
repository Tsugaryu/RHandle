<section>
		<h2> <strong> Profil de <?php echo $genre;?> <?php echo $prenom;?> <?php echo $nom;?> </strong></h2>
		
		<!--   Afficher les différents champs			-->
		<ul>
		<li>Age: <?php echo $age;?></li><!--calculer auparavant dans le controller-->
		<li> Mail: <?php echo $mail;?></li>
		<li>Telephone:  <?php echo $numero;?> </li>
		<?php 
		if($statut==numeroRH ||$statut=numeroDirecteur){
			echo "<li>Lieu de Naissance". $lieu ."</li>";
			echo "<li>Nationalité". $nationalite ."</li>";
			echo "<li>RIB". $rib ."</li>";
			echo "<li>Numéro de Sécurité Sociale".$numSS  ."</li>";
		}
		

		?>	
		</ul>

		
		</section>