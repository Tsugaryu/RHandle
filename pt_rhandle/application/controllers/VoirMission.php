<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class VoirMission extends CI_Controller {

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
		/* L'utilisateur n'est pas connecté */
		if ($this->session->logged_in != TRUE)
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
				/* Charger la vue */
				else
				{
					$base_data['title'] = $mission[0]->nom;
					$this->load->view('base', $base_data);
					$this->load->view('Navigation');
					$this->load->view('VoirMission',$mission[0]);
					$this->load->view('footer');
				}
			}
		}
	}
}

?>