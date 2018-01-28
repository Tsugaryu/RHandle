<?php

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
	public function createConge($data,$idDemandeur){
		$state=null;
		$checkUn = (
			"idEmployé =" . "'" .$idDemandeur
			. "' AND " 
			."dateDebut >=" . "'" .  $data['dateDebut']
			."' AND " 
			."dateFin <=" . "'" .  $data['dateFin']
			. "'"
		);
		//vérifier limite du nombre de congé
		$checkDeux;
		$this->db->select('*');
		$this->db->from('TypeMission');
		$this->db->where($check);
		$this->db->limit(1);

		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$this->db->insert('Congé',$idDemandeur,$data['dateDebut'],$data['dateFin'],$data['motif'],$state);
			if ($this->db->affected_rows() > 0) {
				return true;
			}
		} else {
			return false;
		}
	}

}