<?php

class ModelConge extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	//incomplete
	public function createAbsence($data,$idChef){
		$state=null;
		$checkUn = (
			"idEmployé = '" .$idChef
			. "' AND date >= '" .  $data['jour']
			."'" 
			
		);
		
		if(nombre_abscence($idChef)<10){
		$checkDeux;
		$this->db->select('*');
		$this->db->from('TypeMission');
		$this->db->where($data['state']);//si le type de mission existe on peut continuer
		$this->db->limit(1);

		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			$this->db->insert('Absence',$idChef,$data['debut'],$data['duree'],null);
			if ($this->db->affected_rows() > 0) {
				return true;
			}
			else {
			return false;
		}else {
			//$this->db->insert('TypeMission',	
			$this->ModelTypeMission->createTypeMission($data[state]);
			if($this->db->affected_rows() > 0){
			$this->db->insert('Absence',$idChef,$data['debut'],$data['duree'],null);
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
	}

	/**
	*@return nombre d'absence de l employé
	**/
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

	/**
	**/
	//ok
	public function delete_absence($id_employe,$id_absence){
		$array = array('idEmploye' => $id_employe, 'idAbsence' => $id_absence);
		$this->db->where($array);
		$this->db->delete('Absence');

	}
	/**
	*@return
	**/
	/*public function get_all_Absence(){
		$check="etat=null OR etat=false";
		$this->db->select('*');
		$this->db->from('Absence');
		$this->db->where($check);
		$query = $this->db->get();
		return $query;
	}**/

}
?>