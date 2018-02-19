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
	}

	/**
	**	@author  Nicolas Reszka;Axel Durand
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
			$base_data['title'] = "Accueil";//regarder ce que c est 
			$this->load->view('base', $base_data);//idem
			$this->load->view('Navigation');
			$this->load->view('footer');
		}
	}
}

?>