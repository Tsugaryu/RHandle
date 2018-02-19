<!--@author Axel DURAND-->
 <!-- 
La class every-people applique l effet sur toutes les personnes 
La class only RH sont des attributs visibles uniquement par les RH 
La class hiding document doit apparaitre lorsqu on hover sur document
La class hiding congé doit apparaitre lorsqu on hover sur congé
 -->
 <nav>
 	<div class="sidebar">
		<ul >
		<li class="every-people">	<a href="../index.html" >Accueil</a></li>
		<li class="every-people">	<a href="connexion.html" >Connexion</a></li>
		<li class="every-people">	<a href="utiliserMessagerie.html" >Messagerie</a></li>
		<li class="every-people">	<a href="utiliserAgenda.html" >Agenda</a></li>
		<li class="every-people">Document												</li>
		<li class="hiding-document">	<a href="creerDocument.html" >Créer un document</a></li>
		<li class="hiding-document">	<a href="listeDocument.html" >Consulter un document</a></li>
		<li class="every-people">	<a href="listeProfil.html" >Profil</a></li>
		<li class="every-people"> Congé</li>
		<li class="hiding-conge">	<a href="creerConge.html" >Demander un congé</a> </li>
		<li class="hiding-conge">	<a href="voirNotification.html" >Notification</a></li>
		
		<?php 
		if($statut==numeroRH){
			echo "<li class=\"only-RH\"><a href=\"./HTML/listeConge.html\" >voir les congés</a></li>";
			echo "<li class=\"only-RH\"><a href=\"./HTML/inscription.html\" >Profil</a></li>";
			echo "<li class=\"only-RH\"><a href=\"./HTML/voirListeAbsence.html\" >Profil</a></li>";
		}
		

		?>	  
		<li class="only-RH">	<a href="./HTML/listeConge.html" >voir les congés</a></li>
		<li class="only-RH">	<a href="./HTML/inscription.html" >Profil</a></li>
		<li class="only-RH">	<a href="./HTML/voirListeAbsence.html" >Profil</a></li>
		</ul>
	</div>
</nav>