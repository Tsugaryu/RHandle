<h2> <b> Envoyer un message</b> </h2>
<?php echo form_open('Envoyer_message/create_message'); ?>
	<table>
		<tr>
			<label>
				Destinataire:
			</label>
			<input type="text" name="message_dst" id="message_dst">	
		</tr>
		<tr>
			<label>
				Objet:
			</label>
			<input type="text" name="message_title" id="message_title">	
		</tr>
		<tr>
			<textarea cols=150 >

			</textarea>
		</tr>
	</table>				   
	
	<button type="submit" name="submit">
    	Inscrire
	</button>
				 				
<?php echo form_close(); ?>