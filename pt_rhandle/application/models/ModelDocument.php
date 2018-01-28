<?php

class ModelDocument extends CI_Model{
	
	/**
	*@author Axel Durand
	**/
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	/**
	*@author  Axel Durand
	*$data contient
	*@param nom
	*@param contenu
	*@param idAuteur
	**/
	public function createDocument($data,$idAuteur){
		$check = (
			"contenu =" . "'" . $data['contenu'] . "'"
		);

		$this->db->select('*');
		$this->db->from('Document');
		$this->db->where($check);
		$this->db->limit(1);

		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$this->db->insert('Document', $idAuteur,$data['nom'],$data['contenu']);
			if ($this->db->affected_rows() > 0) {
				return true;
			}
		} else {
			return false;
		}
	}

}