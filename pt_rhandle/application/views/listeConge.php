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
                //mettre le nom de l'employé 
               echo $line->prenom."  ".$line->nom;
                echo "</td>";
                /*Creation des boutons croix et V*/ 
                echo "<td>";
                    echo "<input type=\"button\" value=\"X\">";
                echo "</td>";

                echo "<td>";
                   echo "<input type=\"button\" value=\"V\">";
                echo "</td>";


              echo "</tr>  <br />";

              echo "<tr>";

              echo "<td>";
                echo $line->debut;
              echo "</td>";

               echo "<td>";
                   echo $line->duree;
               echo "</td>";

              echo "<td>";
              //mettre le nombre de conge restant 
               echo $line->resteConge;
              echo "</td>";

              echo "</tr> <br />";

              echo "<tr>";
                  echo "<td>";
                  echo $line->motif;
                  echo "</td>";

              echo "</tr>  <br />";
               
               ///Mr Intel 24-01->25-02         
     			}
    echo "</table>";
		?>
    <!--
    tablequi contient tt ce qui est au dessus
    <table>
    <tr>
    echo "   a href=".base_url()."voirConge?=idEmploye=".$line->idEmploye."&etat=".
                   $line->etat."/motif=".$line->motif."/debut=".
                   $line->debut.">";
             echo $line->idEmploye.
                           "</a></ol>";      
    </tr>
    </table>

  -->