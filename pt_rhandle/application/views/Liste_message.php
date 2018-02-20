		<h2>Liste des demandes de congé</h2>
			<!-- Afficher les différents congés-->
			<ul>
				<?php 
				//pas fini
	//	  print_r($Conge);
   echo "<table>";
   	foreach($Conge as $line)
            {
              echo "<tr>";

                echo "<td>";
                echo $line->objet;
                echo "</td>";




                echo "<td>";
                //mettre le nom de l'employé 
               echo $line->prenom."  ".$line->nom;
                echo "</td>";
                /*Creation des boutons croix et V*/ 
                

              echo "</tr>  <br />";

              echo "<tr>";
                echo "<td>";
                echo "Lu:".$line->etat;
                echo "</td>";
 
                echo "<td>";
                echo "PJ:";
                echo "</td>";

                echo "<td>";
                echo "Date:".$line->ecrit;
                echo "<td>";



              
              echo "</tr> <br />";

              echo "<tr>";
              echo "<td>";
                echo $line->contenu;
              echo "<td>";
   

              echo "</tr>  <br />";
               
               ///Mr Intel 24-01->25-02         
     			}
    echo "</table>";
		?>