<section>
		<h2> <strong>  Créer une mission</strong></h2>
			
			<form method="POST" action="http://www.iut-fbleau.fr/sitebp/post.php" enctype="application/x-www-form-urlencoded" >
			
			     
					   
				  <label>
				 Nom Mission<input type="text" name="doc" value="" maxlength="52" placeholder="" />	<br />
				 </label>
				 
				  <label>
				 Type de la mission
				 </label>
				 <!-- définir les types de missions-->
				 <SELECT name="type_mission" size="1">
						<OPTION>Réunions
						<OPTION>Consultation
						<OPTION>Mission
						<OPTION>Convocation
						<OPTION>Autre? <!--<input type="text" name="other_nature" value=""  placeholder=""  />   -->
					</SELECT><br />
					
					
						 
				  <label> 
					Debut de la mission:<input type="date" name="mission_debut" value=""   required />	<br />
				  </label>
					    
				  <label>
					Fin de la mission:<input type="date" name="mission_end" value=""   required />	<br />
				 </label>
				 
				 <label>
					Périodicité:<input type="number" name="periode" value=""   required />	<br />
				 </label>
				 
				 <!-- comment lui faire ajouter une liste de collaborateur ?-->
				 <label>
					Collaborateur:<input type="number" name="periode" value=""    />	<br />
				 </label>
				 <label>
				 <input type="submit" value="Envoyer" name="send" />
				</label>				 
					
				</form>
			
		
		</section>