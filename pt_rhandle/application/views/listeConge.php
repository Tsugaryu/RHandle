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
               echo "Demandeur du congé:\t".$line->prenom."  ".$line->nom;
                echo "</td>";
                /*Creation des boutons croix et V*/ 
                echo "<td>";
                    echo "<a href=".base_url()."index.php/Liste_conge/valid_conge/".$line->idEmploye."/".$line->idConge."/-1><input type=\"button\" value=\"X\"></a>";
                echo "</td>";

                echo "<td>";
                   echo "<a href=".base_url()."index.php/Liste_conge/valid_conge/".$line->idEmploye."/".$line->idConge."/1><input type=\"button\" value=\"V\"></a>";
                echo "</td>";


              echo "</tr>  <br />";

              echo "<tr>";
          
              echo "<td>";
                echo "Conge du :\t".$line->debut;
              echo "</td>";
          

               echo "<td>";
                   echo "au \t"./*$line->duree*/$line->fin;
               echo "</td>";

              echo "<td>";
              //mettre le nombre de conge restant 
               echo "Nombre de congé obtenu:\t".$line->resteConge;
              echo "</td>";

              echo "</tr> <br />";

           
                  echo "<td>";
                  echo "Motif:\t".$line->motif;
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