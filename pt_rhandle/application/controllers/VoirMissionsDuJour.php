<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class VoirMissionsDuJour extends CI_Controller {

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
		// if ($this->session->logged_in != TRUE)
		// {
		// 	//Redirect
		// } 
		// else 
		// {
			
		// }

		/* Recupérer l'année, le mois et le jour depuis l'url */
		if 
		(
		   $this->uri->segment(3) != null 
		&& $this->uri->segment(4) != null 
		&& $this->uri->segment(5) != null
		) {
			$year = $this->uri->segment(3);
			$month = $this->uri->segment(4);
			$day = $this->uri->segment(5);
		} 
		/* Sinon prendre la date du jour */
		else 
		{
			$year = date("Y");
			$month = date("m");
			$day = date("j");
		}
		
		/* Afficher la date du jour dans le titre */
		$base_data['title'] = "Missions au ".$day."/".$month."/".$year;
		$this->load->view('base', $base_data);

		$view_data = array(
			'missions' => $this->ModelMission->get_missions_by_day($year,$month,$day), 
			'last_id'  => $this->ModelMission->get_last_id(), 
			'year'     => $year,
			'month'    => $month,
			'day'      => $day
		);
		$this->load->view('Navigation');
		$this->load->view('VoirMissionsDuJour',$view_data);
		$this->load->view('footer');
	}


	/**
	**	@author  Nicolas Reszka
	**/
	public 	function refresh_schedule()
	{
		/* Récupérer le last_id de l'utilisateur */
		$current_last_id = $this->input->post("last_id");

		/* Récupérer le last_id de la base de données */
		$new_last_id = $this->ModelMission->get_last_id();
		
		$refresh_data = array();

		/* Comparer les deux */
		if ($current_last_id < $new_last_id)
		{
			/* Si le last_id à changé, ça veut dire qu'il y a des nouvelles missions */
			$year = $this->input->post("year");
			$month = $this->input->post("month");
			$day = $this->input->post("day");

			$refresh_data["updated"] = true;
			$refresh_data["new_last_id"] = $new_last_id;
			$refresh_data["new_missions"] = $this->ModelMission->get_missions_by_day(
				$year,$month,$day
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