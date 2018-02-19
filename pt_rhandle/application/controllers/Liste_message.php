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
			$base_data['title'] = "Liste des congés";//regarder ce que c est 
			$this->load->view('base', $base_data);//idem
			$this->load->view('Navigation');
			$this->liste_conge();
			$this->load->view('footer');
		}
	}

	/**
	**	@author  Axel Durand
	**	Crée la liste des congés
	**	 
	**	
	**/
	public 	function liste_conge()
	{
			$data = array();
			//recuperation de la liste des conges
			$data['Conge']= $this->ModelConge->get_all_conge();
			//	On inclut une vue
			$this->load->view('listeConge', $data);
	}
	/**
	*@author Axel Durand
	*A appeler quand un RH clique sur une croix pour effacer une notification
	**/
		public 	function valid_conge ($id_employe,$id_conge,$etat)
	{
				
	
	}
}
?>