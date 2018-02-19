<!--Auteur:Axel Durand, Nicolas Reszka-->

<h2> <b> Créer une mission</b></h2>
			
<?php echo form_open('CreerMission/create_mission'); ?>
					   
	<label for="mission_name">
		Nom
	</label>
	<input type="text" name="mission_name" id="mission_name" value="" maxlength="52" placeholder=""/>	
	<br />
	 
	<label for="mission_nature">
		Type de la mission
	</label>
	 <!-- définir les types de missions-->
	 <SELECT name="mission_nature" id="mission_nature">
			<OPTION value="Réunions">Réunions</OPTION>
			<OPTION value="Consultation">Consultation</OPTION>
			<OPTION value="Mission">Mission</OPTION>
			<OPTION value="Convocation">Convocation</OPTION>
	</SELECT><br />
		
	<!-- <label for="mission_priority">
		Priorité :
	</label>
    <input type="number" name="mission_priority" id="mission_priority" required=""> <br>
 -->
	<label for="mission_date">
		Date de la mission :
	</label>
	<input type="date" name="mission_date" id="mission_date" value=""   required />	<br />
	
	<label for="mission_duration">
		Durée de la mission :
	</label>
    <input type="number" name="mission_duration" id="mission_duration" required=""> <br>

	<label for="mission_collaborators">
		Collaborateurs (entrer les noms complets séparés par des virgules) :
	</label>
	<input type="text" name="mission_collaborators" id="mission_collaborators">	<br />

	<button type="submit" name="submit">
    	Inscrire
	</button>
				 				
<?php echo form_close(); ?>