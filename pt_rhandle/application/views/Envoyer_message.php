<h2> <b> Envoyer un message</b> </h2>
<?php echo form_open('Envoyer_message/create_message'); ?>
	<table>
		<tr>
		<td>
			<label>
				Destinataire:
			</label>
		</td>
		<td>
			<input type="mail" name="message_dst" id="message_dst">	
		</td>

		</tr> <br />
		<tr>
			<td>
			<label>
				Objet:
			</label>

			</td>
		<td  >
			<input type="text" name="message_title" id="message_title">	
		</td>

		</tr>
		<tr>
		<td colspan=2 >

			<textarea cols=40 name="contenu" >
			</textarea>
		</td>

			
		</tr>
	</table>				   
	
	<button type="submit" name="submit">
    	Envoyer
	</button>
				 				
<?php echo form_close(); ?>