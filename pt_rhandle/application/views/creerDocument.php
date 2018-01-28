<!-- Auteur:Axel Durand-->
<section>
		<h2> <strong>  Créer un document</strong></h2>
			
			<form method="POST" action="" enctype="application/x-www-form-urlencoded" >
			
	<!--		      <label> 
						Prénom Auteur <input type="text" name="prénom" value="" maxlength="26" placeholder="" required />	<br />
				  </label>
						
			      <label> 
					Nom Auteur: <input type="text" name="nom" value="" maxlength="26" placeholder="" required />	<br />
				  </label>
		
		retirer de la liste car on a déja le nom et le prénom de l auteur
		-->			   
				  <label>
				 Nom Document<input type="text" name="doc" value="" maxlength="52" placeholder="" required />	<br />
				 </label>
				 
				  <label>
				 Contenu du Document<input type="file" name="doc_file" required  />	<br />
				 </label>
					
					
						  <input type="submit" value="Envoyer" name="send" />
				  </p>
				</form>
			
		
		</section>