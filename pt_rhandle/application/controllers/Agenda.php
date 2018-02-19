<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('date');
		$this->load->library('session');
		$this->load->model('ModelMission');
	}


	/**
	**	@author  Nicolas Reszka
	**/
	public function index() 
	{
		if ($this->session->logged_in != TRUE)
		{
			redirect("Connexion");
		} 
		else
		{
			/* Configurer la class calendar */
			$preferences = array(
				'start_day'			=> 'monday',
				'show_next_prev'	=> TRUE,
				'next_prev_url' 	=> base_url().'index.php/Agenda/index/'
			);
			$this->load->library('calendar',$preferences);

			/* Recupérer l'année et le mois depuis l'url */
			if ($this->uri->segment(3) != null && $this->uri->segment(4) != null) 
			{
				$year = $this->uri->segment(3);
				$month = $this->uri->segment(4);
			}
			/* Sinon prendre le mois actuel */
			else 
			{
				$year = date("Y");
				$month = date("m");
			}
			
			/* Charger la base */
			$base_data['title'] = "Agenda";
			$this->load->view('base', $base_data);

			$view_data = array(
				/* Génerer le calendrier */
				'calendar' => $this->generate_calendar($year,$month), 
				'last_id'  => $this->ModelMission->get_last_id(), 
				'year'     => $year,
				'month'    => $month
			);

			/* Charger la vue */
			$this->load->view('Navigation');
			$this->load->view('Agenda',$view_data);
			$this->load->view('footer');
		}
	}

	/**
	**	@author  Nicolas Reszka
	**/
	public function generate_calendar($year,$month)
	{
		/* Récupérer les missions */	
		$missions = $this->ModelMission->get_missions_by_month(
			$year,$month
		);

		$days = array();

		if (is_array($missions))
		{
			/* Placer chaque missions dans un tableau dont la clé est le jour */
			foreach ($missions as $mission)
			{	

				if (!isset($days[date('j', strtotime($mission->dateDebut))]))
				{
					$days[date('j', strtotime($mission->dateDebut))] = array();
				}
				
				/* La clé de la mission est son nom et sa valeur est son url */
				$days[date('j',strtotime($mission->dateDebut))][$mission->nom] = base_url()."index.php/VoirMission/index/".$mission->idMission;
			}
		}

		return $this->calendar->generate($year,$month,$days);
	}


	/**
	**	@author  Nicolas Reszka
	**/
	public 	function refresh_calendar()
	{
		/* Récupérer le last_id de l'utilisateur */
		$current_last_id = $this->input->post("last_id");

		/* Récupérer le last_id de la base de données */
		$new_last_id = $this->ModelMission->get_last_id();
		
		$refresh_data = array();

		/* Comparer les deux */
		if ($current_last_id < $new_last_id)
		{	
			/* Si le last_id à changé, cela veut dire qu'il y a des nouvelles missions */
			$year = $this->input->post("year");
			$month = $this->input->post("month");

			$refresh_data["updated"] = true;
			$refresh_data["new_last_id"] = $new_last_id;
			$refresh_data["new_missions"] = $this->ModelMission->get_missions_by_month(
				$year,$month,$current_last_id
			); 
		}
		else
		{
			/* Pas de nouvelles missions */
			$refresh_data["updated"] = false;
		}

		/* Envoyer les données à l'utilisateur */
		echo json_encode($refresh_data);
	}
}

?>