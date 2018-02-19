<?php
class 	Model_employes extends CI_Model 
{

	public 	function __construct() 
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('email');
		$this->load->helper('string');
	}
	
	/* 	login($data)
		-fonction:
			trouve l'employé dont le mail est égal à 
			$data('email') et dont le pwd est égal au
			$data('password') hashé à l'aide de sha1
		-arguments: 
			$data('email','password');
		-return: 
			la ligne de l'employé concerné si réussi
			false si échec
	*/
	/**
	**	@author  Nicolas Reszka
	**/
	public 	function login($data) 
	{
		$salt = sha1($data['password']);
		$data['password'] = $salt;

		$this->db->select('*');
		//$this->db->from('rhandle_employes');
		$this->db->from('Employe');
		$this->db->where("mail", $data['email']);
		$this->db->where("pwd", $data['password']);
		$this->db->limit(1);

		$query = $this->db->get();

		if ($query->num_rows() == 1)
		{
			return $query->result();
		} 
		else 
		{
			return false;
		}
	}

	/* 	create_employe($data)
		-fonction: 
			insert un employé avec les données $data,
			met le statut et le nbrCongeObtenu à zéro,
			crée un mot de passe hashé
			envoie un mail contenant le mot de passe
			non hashé à l'email contenu dans $data
		-arguments: 
			$data(
				'nom','prenom','numSS',
				'adresse','RIB','telephone',
				'mail','genre','naissance'
				,'nationalite'
			);
		-return: 
			true si l'insertion à réussi
			false si échec
	*/
	/**
	**	@author  Nicolas Reszka
	**/
	public 	function create_employee($data)
	{
		$data['nbrCongeObtenu'] = 0;
		$data['statut'] = 0;

		$password = random_string('alnum', 8);
		$data['pwd'] = sha1($password);

		//$this->db->insert('rhandle_employes', $data);
		$this->db->insert('Employe', $data);

		if ($this->db->affected_rows() > 0)
		{	
			$this->email->from(
				'noreply@rhandle.com', 
				'noreply'
			);
			$this->email->to($data['mail']);
			$this->email->subject('Mot de passe RHandle');
			$this->email->message(
				'Votre mot de passe RHandle est :'.$password
			);
			$this->email->send();

			return true;
		}
		else
		{
			return false;
		}
	}

}
?>