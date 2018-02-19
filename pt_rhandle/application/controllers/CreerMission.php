<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class 	CreerMission extends CI_Controller {

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
		if ($this->session->logged_in == FALSE)
		{
			redirect("Connexion");
		} 
		else 
		{
			$base_data['title'] = "Créer une nouvelle mission";
			$this->load->view('base', $base_data);
			$this->load->view('Navigation');
			$this->load->view('creerMission');
			$this->load->view('footer');
		}
	}

	/**
	**	@author  Nicolas Reszka
	**	Valide le formulaire de création de mission
	**	divise la chaine de caractère contenue dans le champ 
	**	'mission_collaborators' à l'aide d'une expression régulière,
	**	insert les données du formulaire dans la base de données 
	**	puis gère les erreurs
	**/
	public 	function create_mission()
	{
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


		if ($this->form_validation->run() == FALSE) 
		{
			print("Veuillez remplir les champs requis");
		} 
		else
		{
			$mission_data = $this->security->xss_clean(
				array(
					"nom"           => $this->input->post('mission_name'),
					"typeMission"   => $this->input->post('mission_nature'),
					"priorite"      => $this->session->status,
					"idResponsable" => $this->session->id,
					"dateDebut"     => $this->input->post('mission_date'),
					"duree"         => $this->input->post('mission_duration')
				)
			);

			print("\n-- Données envoyées : --\n");
			print_r($mission_data);
			print("\n-- --\n");

			/* Insertion dans la table des missions */
			$mission_id = $this->ModelMission->create_mission($mission_data);

			/* Gestion des erreurs */
			if ($mission_id == 0)
			{
				print("La nature de la mission n'existe pas");
			}
			else if ($mission_id == -1)
			{
				print("Echec de l'insertion de la mission");
			}
			else if ($mission_id > 0)
			{
				print("La mission à été insérée avec succès");

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