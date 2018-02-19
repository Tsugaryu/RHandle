<!--@author Axel DURAND-->

<section>
				<h2>Liste des documents</h2>
			<!-- Afficher les différents documents-->
		<ul>
		<?php 

			foreach($datadoc as $line){
				
            {
                   echo "<ol>"."<a href=".voirDocument.
                   ".php?nomDocument=".        
                   $line['nomDoc']."&auteurN=".
                   $line['nomAuteur']."&auteurPr".
                   $line['prenomAuteur']."$linkDoc".
                   $line['linkDoc'].">";
                   echo $line['nomDocument'].
                   			   "</a>
                   </ol>";
                    
                
     			}
		?>
		</ul>
		</section>
	<!-- part 2 de listeDocument.html-->
	<a href="<?php echo "ta_page.php?var1=".$var1."&var2=".$var2."" ?>></a>