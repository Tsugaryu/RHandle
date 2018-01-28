<!--Auteur:Axel Durand -->
<section>
		<h2> <strong>  Demander un congé</strong></h2>
			
				<form method="POST" action="http://www.iut-fbleau.fr/sitebp/post.php" enctype="application/x-www-form-urlencoded" >
				 <label> 
					Debut du congé:<input type="date" name="conge_debut" value=""   required />	<br />
				  </label>
					    
				  <label>
					Fin du congé:<input type="date" name="conge_end" value=""   required />	<br />
				 </label>

				 <label>
				  <p>Motif </p>
			      <textarea name="motif" cols=50 rows=3  required> 
				  		
				  </textarea>
				  <br />
					</label>	
			     
					
					
						  <input type="submit" value="Demander" name="send" />
				 
				</form>
			
		
		</section>