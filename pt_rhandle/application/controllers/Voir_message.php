<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Voir_message extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('date');
		$this->load->library('session');
		$this->load->model('ModelMessage');
	}


	/**
	**	@author  Nicolas Reszka
	**/
	public function index() 
	{
		
	}


	
}

?>