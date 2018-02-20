<?php
/**
**	@author Axel DURAND
**/
defined('BASEPATH') OR exit('No direct script access allowed');

class 	Liste_absences extends CI_Controller {

	public 	function __construct() 
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('ModelAbsences');
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
			$base_data['title'] = "Liste des absences";//regarder ce que c est 
			$this->load->view('base', $base_data);//idem
			$this->load->view('Navigation');
			$this->liste_absences();
			$this->load->view('footer');
		}
	}

	/**
	**	@author  Axel Durand
	**	
	**	insert les données du formulaire dans la base de données 
	**	
		**/
	public 	function liste_absences()
	{


		
		/*if ($this->form_validation->run() == FALSE) 
		{
			$this->index();
		} 
		else
		{*/
			$data = array();
			$buffer;
			//recuperation de la liste des personnes 
			$data['all_info'] = $this->ModelAbsences->get_all_Absence();//qd j aurais accés au model ça changera probablement
			foreach ($data['all_info'] as $line ) {
				$buffer=$this->ModelAbsences->get_name_by_id($line->idEmploye);
				$line->nom=$buffer[0]->nom;
				$buffer=$this->ModelAbsences->get_prenom_by_id($line->idEmploye);
				$line->prenom=$buffer[0]->prenom;
		
			}
		//	On inclut une vue

			$this->load->view('listeAbscences', $data);
			
		//}
	}
	/**
	*@author Axel Durand
	*A appeler quand un RH clique sur une croix pour effacer une notification
	**/
		public 	function delete_absences ($id_employe,$date_debut)
	{
		$this->ModelAbsences->delete_absence($id_employe,$date_debut);//qd j aurais accés au model ça changera probablement
				
	
	}
}
?>
