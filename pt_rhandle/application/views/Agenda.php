<!-- Auteur : Nicolas Reszka -->

<section>
	<h3>Consulter votre Agenda</h3>
	<!-- endroit où l on place affichage agenda et manipulation de ce dernier -->
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<div id="calendar">
	<?php 
		if (isset($calendar)) {
			echo $calendar;
		}
	?>
</div>

<script>
	var lastID = <?php echo intval($last_id,10); ?>;

	function refresh_calendar()
	{
		/* Demander au serveur si de nouvelles missions ont été ajoutées */
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>" + "index.php/Agenda/refresh_calendar",
			data: {
				year:<?php echo intval($year,10); ?>,
				month:<?php echo intval($month,10); ?>,
				last_id:lastID
			}
		}).done(
			function(response)
			{
				/* Traiter la réponse du serveur */
				data = JSON.parse(response);

				/*console.log(data);*/

				/* De nouvelles missions ont été ajoutées */
				if (data.updated == true)
				{
					
					/* Actualiser le lastID */
					lastID = data.new_last_id;

					/*console.log("lastID = " + lastID);*/

					/* Afficher les nouvelles missions */
					for (let i = 0; i < data.new_missions.length; i++)
					{
						let temp_mission = data.new_missions[i];

						$("#"+temp_mission["DAY(dateDebut)"]).append(
							"<br><a href='"
							+"<?php echo base_url(); ?>" 
							+ "index.php/VoirMission/index/" 
							+ temp_mission.idMission
							+ "'>" 
							+ temp_mission.nom 
							+ "</a>"
						);
					}
				}

				/* Rafraichir toutes les 5 secondes */
				setTimeout(refresh_calendar, 5000);
			}
		);
	}

	$(document).ready(
		refresh_calendar()
	);	

</script>
