<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class 	Connexion extends CI_Controller {

	public 	function __construct() 
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->library('session');

		$this->load->model('Model_employes');
	}


	/**
	**	@author  Nicolas Reszka
	**/
	public 	function index() 
	{
		if ($this->session->logged_in == TRUE)
		{
			print("already logged in");
			redirect('Accueil');
		} 
		else 
		{
			print("not logged in");
			$base_data['title'] = "Connexion";
			$this->load->view('base', $base_data);

			$view_data['login_error'] = "";
			$this->load->view('connexion', $view_data);
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
			'login_email', 
			'Email', 
			'trim|required'
		);
		$this->form_validation->set_rules(
			'login_password', 
			'Password', 
			'trim|required'
		);

		if ($this->form_validation->run() == FALSE) 
		{
			$this->index();
			print("lol nope");
		} 
		else 
		{
			$user_data = $this->security->xss_clean(
				array(
					'email' => $this->input->post('login_email'),
					'password' => $this->input->post('login_password')
				)
			);

			/* Connecter l'utilisateur */
			$user = $this->Model_employes->login($user_data);

			print_r($user);
			if ($user == FALSE) 
			{
				$base_data['title'] = "Connexion";
				$this->load->view('base', $base_data);

				$view_data['login_error'] = "Error";
				$this->load->view('connexion', $view_data);
			}
			else
			{
				$session_data = array(
					'id'		=> $user[0]->id,
					'email'     => $user[0]->email,
					'name'		=> $user[0]->prenom.' '.$user[0]->nom,
					'status'	=> $user[0]->statut,
					'logged_in' => TRUE
				);
				$this->session->set_userdata($session_data);
				print("logged !");
				redirect('Agenda');
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