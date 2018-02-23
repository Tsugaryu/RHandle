<?php
//need to verif
class ModelConge extends CI_Model{
	
	/**
	*@author Axel Durand
	**/
	public function __construct(){
		parent::__construct();
		$this->load->database();
		
	}
	/**
	*@author  Axel Durand
	**/
	//incomplete
	public function createConge($data){
		
		//vérifier limite du nombre de congé
		$buffer=$this->nombre_conge_obtenu($data['idEmploye']);
		print_r("Buffer=   ".$buffer[0]->nbrCongeObtenu);
		if($buffer[0]->nbrCongeObtenu<=25){
		$this->db->insert('Conge',$data);
			if ($this->db->affected_rows() > 0) {
				print("Données bien inséré");
				return true;
			}
		 else {
			print("Données pas bien inséré");
			return false;
		}
	  }
	  else{
		 	print("   Retournez au travail !");

	  }
	}

	/**
	*@author Axel Durand
	*@return nombre de congé de l employé
	**/
	public function nombre_conge_obtenu($id_employe){
		$check = (
			"idEmploye =" . "'" .$id_employe
		);
		/*Compte nombre de Congé*/
		$this->db->select('nbrCongeObtenu');
		//$this->db->select('COUNT(*)');
		$this->db->from('Employe');
		$this->db->where("id",$id_employe);
		

		$query = $this->db->get();
			if ($query->num_rows() > 0)
			{
				return $query->result();
			} 
			else 
			{
				return false;
			}

		}
	/**
	*@author Axel Durand
	*@param accept est un boolean 
	*
	**/
	//manque les notifications
	public function update_conge($id_employe,$id_conge,$accept){
		$data = array(
        'etat' => $accept,
		);

		$array = array('idEmploye' => $id_employe, 'idConge' => $id_conge);
		$this->db->where($array);

		$this->db->update('Conge', $data);
		if ($this->db->affected_rows() > 0) {
				//creer notification
				print("ok");
				return true;
					}
		else 
			return false;

		
	}
	/**
	*@author Axel Durand
	**/
	//ok
	public function delete_conge($id_employe,$id_conge){
		$array = array('idEmploye' => $id_employe, 'idConge' => $id_conge);
		$this->db->where($array);
		$this->db->delete('Conge');

	}
	/**
	*@author Axel Durand
	*@return tableau contenant tous les congés et les données de la table qui sont null ou false 
	*
	*/

		public function get_name_by_id($id){
			$this->db->select('nom');
			$this->db->from(' Employe');
			$this->db->where('id',$id);
			$query = $this->db->get();
			if ($query->num_rows() > 0)
			{
				return $query->result();
			} 
			else 
			{
				return false;
			}

		}
			public function get_prenom_by_id($id){
			$this->db->select('prenom');
			$this->db->from(' Employe');
			$this->db->where("id",$id);
			$query = $this->db->get();
			if ($query->num_rows() > 0)
			{
				return $query->result();
			} 
			else 
			{
				return false;
			}

		}
		public function get_conge_obtenu_by_id($id){
			$this->db->select('nbrCongeObtenu');
			$this->db->from(' Employe');
			$this->db->where("id",$id);
			$query = $this->db->get();
			if ($query->num_rows() > 0)
			{
				return $query->result();
			} 
			else 
			{
				return false;
			}
		}


		public function get_all_asking_conge(){
		$check="etat=0";
		$this->db->select('*');
		$this->db->from('Conge');
		$this->db->where($check);
		$query = $this->db->get();
		if ($query->num_rows() > 0)
		{
			return $query->result();
		} 
		else 
		{
			return false;
		}
	}
		public function calculer_date($date,$duree){
		$this->db->select('ADDDATE('.$date.','.$duree.') AS temps ');
		$this->db->from('Conge');
		$this->db->where('debut',$date);
		$query = $this->db->get();
		if ($query->num_rows() > 0)
		{
			return $query->result();
		} 
		else 
		{
			return false;
		}


		
	}

}
?>