<section>
				<h2>Liste des Absences</h2>
			<!-- Afficher les différents Absence-->
			<ul>
				<?php 
 			 echo "<table>";
			foreach($all_info as $line){
				
            {
                  	 echo "<tr>";
                echo "<td>";
                //mettre le nom de l'employé 
               echo $line->prenom."  ".$line->nom;
                echo "</td>";
   
                 echo "</tr>  <br />";

              echo "<tr>";

              echo "<td>";
                echo $line->debut;
              echo "</td>";

               echo "<td>";
                   echo $line->fin;
               echo "</td>";

              echo "</tr> <br />";

              echo "<tr>";
                  echo "<td>";
                  echo $line->motif;
                  echo "</td>";

              echo "</tr>  <br />";
            	    
     		}
     		    echo "</table>";

		?>
		</ul>
		
	
</section>
