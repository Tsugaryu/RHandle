<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class 	Demander_conge extends CI_Controller {

	public 	function __construct() 
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('ModelConge');
	}

	/**
	**	@author  Nicolas Reszka;Axel Durand
	**/
	public 	function index() 
	{
		if ($this->session->logged_in == FALSE)
		{
			redirect("Connexion");
		} 
		else 
		{
			$base_data['title'] = "Demander un congé ";
			$this->load->view('base', $base_data);
			$this->load->view('Navigation');
			$this->load->view('creerConge');
			$this->load->view('footer');
		}
	}

	public 	function create_conge()
	{
		print('bombfork');
		$this->form_validation->set_rules(
			'motif', 
			'Motif', 
			'trim|required'
		);

		$this->form_validation->set_rules(
			'conge_debut', 
			'DebutConge', 
			'trim|required'
		);

	

		$this->form_validation->set_rules(
			'duree', 
			'Duree', 
			'trim|required'
		);

		if ($this->form_validation->run() == FALSE) 
		{
			print("Veuillez remplir les champs requis");
		} 
		else{
				$conge_data=$this->security->xss_clean(
				array(
				"idEmploye" =>$this->session->id,
				"debut"=>$this->input->post('conge_debut'),
				"duree"=>$this->input->post('duree'),
				"etat"=>0,
				"motif"=>$this->input->post('motif'),
				)

			);
			print("\n-- Données envoyées : --\n");
			print_r($conge_data);
			$this->ModelConge->createConge($conge_data);
			redirect('Demander_conge');
		}


	}
	
		}

?>