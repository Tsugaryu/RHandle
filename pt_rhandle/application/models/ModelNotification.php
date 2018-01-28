<?php

class ModelNotification extends CI_Model{
	
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
	//incomplet
	public function createNotification($idConcerné,$nom,$contenu){
		$moment;
		$this->db->insert('Notification', $idConcerné,$nom,$contenu,$moment);						
		if($this->db->affected_rows() > 0){
				return true;
		}
		else {
			return false;
		}
	}

}