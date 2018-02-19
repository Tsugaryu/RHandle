<!-- Nicolas Reszka-->

<h2> <b> Modifer une mission</b></h2>
			
<?php echo form_open('ModifierMission/update_mission'); ?>
			
	

	<label for="mission_name">
		Nom
	</label>
	<input type="text" name="mission_name" id="mission_name" value="<?php echo $mission->nom?>" maxlength="52" placeholder=""/>	
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
	
	<div style="display:none;">
		<label for="mission_id">
			ID Mission :
		</label>
	    <input type="number" name="mission_id" id="mission_id" value="<?php echo $mission->idMission?>"  required> <br>
    </div>

	<label for="mission_date">
		Date de la mission :
	</label>
	<input type="date" name="mission_date" id="mission_date" value="<?php echo $mission->dateDebut?>"   required />	<br />
	
	<label for="mission_duration">
		Durée de la mission :
	</label>
    <input type="number" name="mission_duration" value="<?php echo $mission->duree?>" id="mission_duration" required=""> <br>

	<label for="mission_collaborators">
		Collaborateurs (entrer les noms complets séparés par des virgules) :
	</label>
	<input 
		type="text" name="mission_collaborators" 
		value="<?php 
			foreach($collaborators as $key => $collaborator) 
			{
				echo $collaborator->prenom." ".$collaborator->nom;

				if (count($collaborators) > $key)
				{
					echo ",";
				} 
			}
		?>" 
		id="mission_collaborators"
	><br />

	<input type="checkbox" name="mission_over" id="mission_over" value="<?php echo $mission->terminee?>">

	<button type="submit" name="submit">
    	Inscrire
	</button>
				 				
<?php echo form_close(); ?>