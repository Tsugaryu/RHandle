<?php

class ModelTypeMission extends CI_Model{
	
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
	public function createTypeMission($nature){
		$check = (
			"UPPER(nature) =" . "'UPPER(" . $nature
			. ")'"
		);

		$this->db->select('*');
		$this->db->from('TypeMission');
		$this->db->where($check);
		$this->db->limit(1);

		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$this->db->insert('TypeMission', $nature);
			if ($this->db->affected_rows() > 0) {
				return true;
			}
		} else {
			return false;
		}
	}
	/*A utiliser au moment de la création d'une mission pour vérifier s'il y a une nouvelle nature de mission à creer plus tard*/
	public function getAllTypeMission(){

	}
}