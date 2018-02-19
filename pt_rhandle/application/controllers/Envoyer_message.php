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
		
	}
	
		}

?>