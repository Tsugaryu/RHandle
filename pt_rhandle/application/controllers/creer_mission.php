<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class 	creer_mission extends CI_Controller {

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
			redirect("connexion");
		} 
		else 
		{
			$base_data['title'] = "Créer une nouvelle mission";
			$this->load->view('base', $base_data);
			$this->load->view('Navigation');
			$this->load->view('creer_mission');
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
			'trim|required|xss_clean'
		);

		$this->form_validation->set_rules(
			'mission_nature', 
			'MissionNature', 
			'trim|required|xss_clean'
		);

		$this->form_validation->set_rules(
			'mission_date', 
			'MissionDate', 
			'trim|required|xss_clean'
		);

		$this->form_validation->set_rules(
			'mission_hour', 
			'MissionHour', 
			'trim|required|xss_clean'
		);

		$this->form_validation->set_rules(
			'mission_duration', 
			'MissionDuration', 
			'trim|required|xss_clean'
		);

		$this->form_validation->set_rules(
			'mission_periodicity', 
			'MissionPeriodicity', 
			'trim|required|xss_clean'
		);


		$this->form_validation->set_rules(
			'mission_collaborators', 
			'MissionCollaborators', 
			'trim|required|xss_clean'
		);


		if ($this->form_validation->run() == FALSE) 
		{
			$this->index();
		} 
		else
		{
			/* 	Mettre les chaines de caractères contenant les noms complets des 
				collaborateurs dans un tableau en les divisant avec des virgules
				',' à l'aide d'une expression régulière 
			*/
			$mission_collaborators_list = preg_split(
				"/[,]+/", 
				$this->input->post('mission_collaborators')
			);

			$mission_data = array(
				'idCreateur'		=> $this->session->userdata('id'),
				'createurMission' 	=> $this->session->userdata('name'),
				'nomMission'		=> $this->input->post('mission_name'),
				'nature'			=> $this->input->post('mission_nature'),
				'dateDebut'			=> $this->input->post('mission_date'),
				'heureDebut'		=> $this->input->post('mission_hour'),
				'duree'				=> $this->input->post('mission_duration'),
				'periodicité'		=> $this->input->post('mission_periodicity'),
				'tabCollaborateur' 	=> $mission_collaborators_list
			);

			/* Insertion dans la table des missions */
			$insert_success = this->ModelMission->createMission($mission_data);

			/* Gestion des erreurs */
			if ($insert_success == FALSE)
			{
				//Erreur
			}
			else 
			{
				//Succès
			}
		}
	}
}

