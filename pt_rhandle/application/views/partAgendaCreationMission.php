<!--@author Axel DURAND-->
<section>
		<h2> <strong> Agenda </strong></h2>
		<a href="creerMission.html" >+</a>
		<!-- pr le chef de projet on rajoute une page remplacer mission où on l envoi direct sur creer mission ?-->
		<?php 
			<?php 
		if($statut==numeroChef ||$statut=numeroDirecteur){
			echo "<a href="remplacerMission.html">RemplacerMissionEmployé</a>";
		}
		?>	
	
</section>