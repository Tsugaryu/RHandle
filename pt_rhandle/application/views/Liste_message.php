		<h2>Message reçu</h2>
		
				<?php 
				//pas fini
	 //print_r($message);
   echo "<table>";
   if($message==false){
    print("Vous n avez pas reçu de message");
   }
   else{
   	foreach ($message as $line)
            {
              echo "<tr>";

                echo "<td>";
                echo "Objet:".$line->objet;
                echo "</td>";




                echo "<td>";
                //mettre le nom de l'employé 
               echo $line->prenom."  ".$line->nom;
                echo "</td>";
               // Creation des boutons croix et V/ 
                

              echo "</tr>  <br />";

              echo "<tr>";
                echo "<td>";
                if($line->etat==0){
                   echo "Non Lu:";
                }
                else{
                   echo "Lu:";
                }
               
                echo "</td>";
                echo "<td>";
                if(isset($line->pieceJointe)){
                echo "PJ:".$line->pieceJointe;
                }
                else{
                  echo "PJ:Sans objet";
                }
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
        }
    echo "</table>";
		?>