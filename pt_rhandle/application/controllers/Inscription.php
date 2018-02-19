<?php 

defined('BASEPATH') OR exit('No direct script access allowed');


class 	Inscription extends CI_Controller
{
	
	/**
	**	@author  Nicolas Reszka
	**/
	public function 	__construct()
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
	public function 	index()
	{
		if ($this->session->logged_in == FALSE)
		{
			redirect('Connexion');
		} 
		/* L'employé ne fait pas partie des ressources humaines*/
		else if ($this->session->status < 1)
		{
			$base_data['title'] = "Inscription";
			$this->load->view('base', $base_data);
			print("Vous n'êtes pas dans la bonne salle");
		}
		/* L'employé fait partie des ressources humaines*/
		else 
		{
			$base_data['title'] = "Inscription";
			$this->load->view('base', $base_data);
			$this->load->view('Navigation');
			$view_data['register_error'] = "";
			$view_data['register_success'] = "";
			$this->load->view('Inscription', $view_data);
			$this->load->view('footer');
		}
	}

	/**
	**	@author  Nicolas Reszka
	**/
	/**
	**	@author  Nicolas Reszka
	**	Valide le formulaire d'inscription
	**	insert les données du formulaire dans la base de données 
	**	puis gère les erreurs
	**/
	public 	function register()
	{
		$this->form_validation->set_rules(
			'employee_first_name', 
			'EmployeeFristName', 
			'trim|required'
		);

		$this->form_validation->set_rules(
			'employee_last_name', 
			'EmployeeLastName', 
			'trim|required'
		);

		$this->form_validation->set_rules(
			'employee_social_security_number', 
			'EmployeeSocialSecurityNumber', 
			'trim|required'
		);

		$this->form_validation->set_rules(
			'employee_address', 
			'EmployeeAddress', 
			'trim|required'
		);

		$this->form_validation->set_rules(
			'employee_bank_id', 
			'EmployeeBankID', 
			'trim|required'
		);

		$this->form_validation->set_rules(
			'employee_telephone', 
			'EmployeeTelephone', 
			'trim|required'
		);


		$this->form_validation->set_rules(
			'employee_email', 
			'EmployeeEmail', 
			'trim|required'
		);

		$this->form_validation->set_rules(
			'employee_sex', 
			'EmployeeSex', 
			'trim|required'
		);

		$this->form_validation->set_rules(
			'employee_birthday', 
			'EmployeeBirthday', 
			'trim|required'
		);

		$this->form_validation->set_rules(
			'employee_nationality', 
			'EmployeeNationality', 
			'trim|required'
		);

		if ($this->form_validation->run() == FALSE) 
		{
			$this->index();
		} 
		else
		{
			$employee_data = $this->security->xss_clean(
				array(
					'nom'			=> $this->input->post('employee_last_name'),
					'prenom' 		=> $this->input->post('employee_first_name'),
					'numSS'			=> $this->input->post('employee_social_security_number'),
					'adresse'		=> $this->input->post('employee_address'),
					'RIB'			=> $this->input->post('employee_bank_id'),
					'telephone'		=> $this->input->post('employee_telephone'),
					'mail'			=> $this->input->post('employee_email'),
					'genre'			=> $this->input->post('employee_sex'),
					'naissance' 	=> $this->input->post('employee_birthday'),
					'nationalite'	=> $this->input->post('employee_nationality')
				)
			);

			/* Insertion dans la table des missions */
			$insert_success = $this->Model_employes->create_employee($employee_data);

			$base_data['title'] = "Inscription";
			$this->load->view('base', $base_data);


			/* Gestion des erreurs */
			if ($insert_success == FALSE)
			{	
				$view_data['register_error'] = "Erreur";
				$view_data['register_success'] = "";
			}
			else 
			{
				$view_data['register_error'] = "";
				$view_data['register_success'] = "Succès !";
			}

			$this->load->view('Inscription', $view_data);
		}
	}
}

?>