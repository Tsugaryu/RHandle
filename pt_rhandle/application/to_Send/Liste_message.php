<?php
/**
**	@author Axel DURAND
**/
defined('BASEPATH') OR exit('No direct script access allowed');

class 	Liste_message extends CI_Controller {

	public 	function __construct() 
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('ModelMessage');
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
		/*else if ($this->session->status < 1)
		{
			//redirect
		}*/
		else
		{
			$base_data['title'] = "Liste des messages reçus";//regarder ce que c est 
			$this->load->view('base', $base_data);//idem
			$this->load->view('Navigation');
			$this->liste_message();
			$this->load->view('footer');
		}
	}

	/**
	**	@author  Axel Durand
	**	Crée la liste des congés
	**	 
	**	
	**/
	public 	function liste_message()
	{
			$data = array();
			//recuperation de la liste des conges
			$data['message']= $this->ModelMessage->get_all_message_user($this->session->id);/*moyen pr récupérer idUser de la session*/
			foreach ($data['message'] as $line ) {
				$buffer=$this->ModelMessage->get_nom_emissaire($line->idEmploye);
				$line->nom=$buffer[0]->nom;
				$buffer=$this->ModelMessage->get_prenom_emissaire($line->idEmploye);
				$line->prenom=$buffer[0]->prenom;
				
			}
			
			$this->load->view('Liste_message', $data);
	}

}
?>