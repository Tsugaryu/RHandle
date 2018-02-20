<?php

class ModelAbsences extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
		public function get_name_by_id($id){
			$check="id=".$id;
			$this->db->select('nom');
			$this->db->from(' Employe');
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
			public function get_prenom_by_id($id){
			$check="id=".$id;
			$this->db->select('prenom');
			$this->db->from(' Employe');
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


	//incomplete
/*	public function createAbsence($data,$idDemandeur){
		$state=null;
		$checkUn = (
			"idEmployé = '" .$idDemandeur
			. "' AND date >= '" .  $data['jour']
			."'" 
			
		);
		
		if(nombre_abscence($idDemandeur)<10){
		$checkDeux;
		$this->db->select('*');
		$this->db->from('TypeMission');
		$this->db->where($data['state']);//si le type de mission existe on peut continuer
		$this->db->limit(1);

		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			$this->db->insert('Absence',$idDemandeur,$data['debut'],$data['duree'],null,$data['motif'],$data['state']);
			if ($this->db->affected_rows() > 0) {
				return true;
			}
			else {
			return false;
		}else {
			//$this->db->insert('TypeMission',	
			$this->ModelTypeMission->createTypeMission($data[state]);
			if($this->db->affected_rows() > 0){
			$this->db->insert('Absence',$idDemandeur,$data['debut'],$data['duree'],null,$data['motif'],$data['state']);
			if ($this->db->affected_rows() > 0) {
				return true;
			}
			else {
			return false;
		}
	}
		}
		} 
	}
	}*/

	public function nombre_absence_obtenu($id_employe){
		$check = (
			"idEmploye =" . "'" .$id_employe
		);
		/*Compte nombre de Congé*/
		$this->db->select('COUNT(*)');
		$this->db->from('absence');
		$this->db->where($check);
		$this->db->limit(1);

		$query = $this->db->get();

		return $query;

		}
	/**
	*@param accept est un boolean 
	*
	**/
	//manque les notifications
	public function update_absence($id_employe,$id_absence,$accept){
		$data = array(
        'etat' => $accept,
		);

		$array = array('idEmploye' => $id_employe, 'idAbsence' => $id_absence);
		$this->db->where($array);

		$this->db->update('Absence', $data);
		if ($this->db->affected_rows() > 0) {
				//creer notification
				return true;
					}
		else 
			return false;

		
	}
	/**
	**/
	//ok
	public function delete_absence($id_employe,$id_absence){
		$array = array('idEmploye' => $id_employe, 'idAbsence' => $id_absence);
		$this->db->where($array);
		$this->db->delete('Absence');

	}
	/**
	*@return tableau contenant tous les congés et les données de la table qui sont null ou false 
	**/
	public function get_all_Absence(){
		$this->db->select('*');
		$this->db->from('Absence');
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