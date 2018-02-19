<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class 	ModifierMission extends CI_Controller {

	public 	function __construct() 
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('ModelMission');
	}

	/**
	**	@author  Nicolas Reszka
	**/
	public 	function index() 
	{
		/* L'utilisateur n'est pas connecté */
		if ($this->session->logged_in == FALSE)
		{
			redirect("Connexion");
		} 
		else 
		{
			/* L'id de la mission n'a pas été spécifié dans l'url*/
			if ($this->uri->segment(3) == null) 
			{
				print("404");
			}
			else 
			{
				$id = $this->uri->segment(3);
				$mission = $this->ModelMission->get_missions_by_id($id);

				/* La mission n'a pas été trouvée */
				if ($mission == false)
				{
					print("404 mission non trouvée");
				}
				else
				{
					$base_data['title'] = "Modifer une mission";
					$this->load->view('base', $base_data);

					/* L'employé n'est pas le responsable de la mission, il n'a pas à l'éditer */
					if ($mission[0]->idResponsable !=  $this->session->id)
					{
						print("Vous n'etes pas le responsable de cette mission");
					}
					/* Charger la vue */
					else 
					{
						$view_data = array(
							'mission' => $mission[0],
							'collaborators' => $this->ModelMission->get_collaborators($id)
						);
						$this->load->view('Navigation');
						$this->load->view('ModifierMission',$view_data);
						$this->load->view('footer');
					}
				}
			}
			
		}
	}

	/**
	**	@author  Nicolas Reszka
	**/
	public 	function update_mission()
	{
		$this->form_validation->set_rules(
			'mission_id', 
			'MissionID', 
			'trim|required'
		);

		$this->form_validation->set_rules(
			'mission_name', 
			'MissionName', 
			'trim|required'
		);

		$this->form_validation->set_rules(
			'mission_nature', 
			'MissionNature', 
			'trim|required'
		);

		// $this->form_validation->set_rules(
		// 	'mission_priority', 
		// 	'MissionPriority', 
		// 	'trim|required'
		// );

		$this->form_validation->set_rules(
			'mission_date', 
			'MissionDate', 
			'trim|required'
		);

		$this->form_validation->set_rules(
			'mission_duration', 
			'MissionDuration', 
			'trim|required'
		);

		$this->form_validation->set_rules(
			'mission_collaborators', 
			'MissionCollaborators', 
			'trim'
		);

		$this->form_validation->set_rules(
			'mission_over', 
			'MissionOver', 
			'trim'
		);


		if ($this->form_validation->run() == FALSE) 
		{
			print("Veuillez remplir les champs requis");
		} 
		else
		{
			$mission_id = $this->input->post('mission_id');
			$mission_data = $this->security->xss_clean(
				array(
					"idMission"		=> $mission_id,
					"nom"           => $this->input->post('mission_name'),
					"typeMission"   => $this->input->post('mission_nature'),
					"priorite"      => $this->session->status,
					"idResponsable" => $this->session->id,
					"dateDebut"     => $this->input->post('mission_date'),
					"duree"         => $this->input->post('mission_duration'),
					"terminee"		=> $this->input->post('mission_over')
				)
			);

			print("\n-- Données envoyées : --\n");
			print_r($mission_data);
			print("\n-- --\n");

			$update_success = $this->ModelMission->update_mission($mission_data);

			/* Gestion des erreurs */
			if ($update_success == 0)
			{
				print("La nature de la mission n'existe pas");
			}
			else if ($update_success != 0)
			{
				print("La mission à été mise à jour avec succès");

				/* 	Mettre les chaines de caractères contenant les noms complets des 
				collaborateurs dans un tableau en les divisant avec des virgules
				',' à l'aide d'une expression régulière 
				*/
				$collaborators = preg_split(
					"/[,]+/", 
					$this->input->post('mission_collaborators')
				);

				print("\n-- Données envoyées : --\n");
				print_r($collaborators);
				print("\n-- --\n");

				/* Si il y a des collaborateurs, les enlever pour pouvoir les réinserer */
				$this->ModelMission->delete_collaborators($mission_id);

				$insert_success = $this->ModelMission->create_collaborators($collaborators,$mission_id);
				
				/* Gestion des erreurs */
				if ($insert_success == 0)
				{
					print("Vous n'avez pas indiqué de collaborateurs");
				}
				else if (is_array($insert_success))
				{
					print("Certains collaborateurs n'ont pas été trouvés :");
					print_r($insert_success);
				}
				else if ($insert_success == 1)
				{
					print("Tous les collaborateurs ont été insérés avec succès");
				}
			}
		}
	}
}

?>