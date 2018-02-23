<?php
/**
**	@author Axel DURAND
**/
defined('BASEPATH') OR exit('No direct script access allowed');

class 	Liste_conge extends CI_Controller {

	public 	function __construct() 
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('ModelConge');
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
			$buffer;
			$data['Conge']= $this->ModelConge->get_all_asking_conge();
			foreach ($data['Conge'] as $line ) {
				$buffer=$this->ModelConge->get_name_by_id($line->idEmploye);
				$line->nom=$buffer[0]->nom;
				$buffer=$this->ModelConge->get_prenom_by_id($line->idEmploye);
				$line->prenom=$buffer[0]->prenom;
				$buffer=$this->ModelConge->get_conge_obtenu_by_id($line->idEmploye);
				$line->resteConge=$buffer[0]->nbrCongeObtenu;
				//la première étape est de transformer cette date en timestamp
				$dateDepartTimestamp = strtotime($line->debut);
				//on calcule la date de fin
				$dateFin=date('Y-m-d',strtotime('+'.$line->duree.' days', $dateDepartTimestamp ));
				$line->fin=$dateFin;
			}
			//	On inclut une vue
			$this->load->view('listeConge', $data);
	}
	/**
	*@author Axel Durand
	*A appeler quand un RH clique sur une croix pour effacer une notification
	**/
		public 	function valid_conge ($id_employe,$id_conge,$etat)
	{
			$this->ModelConge->update_conge($id_employe,$id_conge,$etat);
			redirect('Liste_conge');
	
	}
}
?>