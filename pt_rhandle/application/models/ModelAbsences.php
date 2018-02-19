<?php

class ModelAbsences extends CI_Model{
	
	/**
	*@author Axel Durand
	**/
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	/**
	*@author  Axel Durand 
	*@param dateDebut
	*@param dateFin
	*@param idConcerne
	**/
	public function createAbsences($idConcerne,$data){
		$checkUn = (
			"idEmployé =" . "'" .$idConcerne
			. "' AND " 
			."debut >=" . "'" .  $data['dateDebut']
			."' AND " 
			."fin <=" . "'" .  $data['dateFin']
			. "'"
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

}
?>