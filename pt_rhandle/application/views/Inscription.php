<!--@author Axel DURAND-->
<h2> <b>Inscrire un employé</b></h2>

<?php echo form_open('Inscription/register'); ?>
	<label>
	Monsieur <input name="employee_sex" id="employee_sex" type="radio" value="0"> 
	</label>
	<label>
	Madame<input name="employee_sex" id="employee_sex" type="radio" value="1"> <br />
	</label>
 
	<label>
	Nom<input type="text" name="employee_last_name" id="employee_last_name" value="" maxlength="52"  required />	<br/>
	</label>
	 
	<label>
	Prénom<input type="text" name="employee_first_name" id="employee_first_name" value="" maxlength="52"  required />	<br />
	</label>
 
	<label>
	Adresse<input type="text" name="employee_address" id="employee_address" value="" maxlength="100"  required />	<br />
	</label>
	
	<label>
	Numéro de Sécurité Sociale<input type="number" 
	name="employee_social_security_number" 
	id="employee_social_security_number" value=""  required />	<br />
	</label>
 
	<label>
	RIB<input type="text" name="employee_bank_id" id="employee_bank_id" value=""  required />	<br />
	</label>

	<label>
	Adresse Mail<input type="email" name="employee_email" id="employee_email" value=""  required />	<br />
	</label>
 
	<label>
	Numéro de Téléphone <input type="tel" name="employee_telephone" id="employee_telephone" value="" required />	<br />
	</label>

	<input type="date" name="employee_birthday" id="employee_birthday" required>
	<label for="employee_birthday">Date de naissance</label>

	<br>
	<input type="text" name="employee_nationality" id="employee_nationality" required>
	<label for="employee_nationality">Nationalité</label>
 
  	<button type="submit" name="submit">
    	Inscrire
	</button>
	<br>
	<b><?php echo($register_error); ?></b>
	<b><?php echo($register_success); ?></b>
<?php echo form_close(); ?>