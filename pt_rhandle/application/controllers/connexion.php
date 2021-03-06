<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class 	connexion extends CI_Controller {

	public 	function __construct() 
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->library('session');

		$this->load->model('model_employes');
	}


	/**
	**	@author  Nicolas Reszka
	**/
	public 	function index() 
	{
		if ($this->session->logged_in == TRUE)
		{
			//Redirect
		} 
		else 
		{
			$base_data['title'] = "Connexion";
			$this->load->view('base', $base_data);
			$this->load->view('login');
			$this->load->view('footer');

		}
	}

	/* 	login()
		-fonction:
			connecte l'utilisateur, crée un cookie 
			de session et redirige l'utilisateur
	*/
	/**
	**	@author  Nicolas Reszka
	**/
	public 	function login() 
	{
		$this->form_validation->set_rules(
			'email', 
			'Email', 
			'trim|required|xss_clean'
		);
		$this->form_validation->set_rules(
			'password', 
			'Password', 
			'trim|required|xss_clean'
		);

		if ($this->form_validation->run() == FALSE) 
		{
			$this->index();
		} 
		else 
		{
			$user_data = array(
				'email' => $this->input->post('email'),
				'password' => $this->input->post('password')
			);

			$user = $this->model_employes->login($user_data);

			if ($user == FALSE) 
			{
				//Erreur
			} 
			else 
			{
				$session_data = array(
					'id'		=> $user[0]->id,
					'email'     => $user[0]->email,
					'name'		=> $user[0]->prenom.' '.$user[0]->nom,
					'logged_in' => TRUE
				);
				$this->session->set_userdata($session_data);
				//Redirect vers l'accueil
				redirect('Accueil');

			}
		}	
	}

	/* 	logout()
		-fonction:
			détruit le cookie de session et redirige l'utilisateur vers la page de login
	*/
	/**
	**	@author  Nicolas Reszka
	**/
	public 	function logout() 
	{
		session_destroy();
		redirect('login');
	}
}

?>