<?php

class ModelMessage extends CI_Model{
	
	/**
	*@author Axel Durand
	**/
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	/**
	*@author  Axel Durand
	*@param idEmissaire
	*@param
	*
	*
	**/
	public function createMessage($data){

		$this->db->insert('TypeMission', $nature);
			if ($this->db->affected_rows() > 0) {
				return true;
			}
		} else {
			return false;
		}
	}

}