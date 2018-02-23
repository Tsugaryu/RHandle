<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class 	Envoyer_message extends CI_Controller {

	public 	function __construct() 
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('ModelMessage');
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
			$base_data['title'] = "Envoyer un message ";
			$this->load->view('base', $base_data);
			$this->load->view('Navigation');
			$this->load->view('Envoyer_message');
			$this->load->view('footer');
		}
	}

	public 	function create_message()
	{
		print('bombfork');
		$annee=date("Y");
		$jour=date("d");
		$mois=date("m");
		$current="".$annee."-".$mois."-".$jour;
		$buffer=$this->ModelMessage->find_employe_by_mail($this->input->post('message_dst'));
		$this->form_validation->set_rules(
			'message_dst', 
			'MessageDestination', 
			'trim|required'
		);

		$this->form_validation->set_rules(
			'message_title', 
			'MessageTitle', 
			'trim|required'
		);

		 $this->form_validation->set_rules(
		 	'pj', 
		 	'piecejointe', 
		 	'trim'
		);

		$this->form_validation->set_rules(
			'contenu', 
			'Contenu', 
			'trim|required'
		);

		if ($this->form_validation->run() == FALSE) 
		{
			print("Veuillez remplir les champs requis");
		} 
		else{
			$msg_data=$this->security->xss_clean(
				array(
				"idEmissaire" =>$this->session->id,
				"idDestinataire"=>$buffer[0]->id,
				"contenu"=>$this->input->post('contenu'),
				"ecrit"=>$current,
				"piecejointe"=>$this->input->post('pj'),
				"objet"=>$this->input->post('message_title')
				)

			);
			print("\n-- Données envoyées : --\n");
			print_r($msg_data);
			$this->ModelMessage->create_message($msg_data);
		}


	}
	
		}

?>