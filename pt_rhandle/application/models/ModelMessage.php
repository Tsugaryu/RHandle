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
	public function create_message($data,$idEmissaire){
		$this->db->insert('Message',$idDemandeur,$data['idDestinataire'],$data['contenu'],$data['ecrit'],$data['etat'],$data['piece_jointe'],$data['objet']);
			if ($this->db->affected_rows() > 0) {
				return true;
			}
		 else {
			return false;
		}
	}
	public function delete_message($idEmissaire,$idDestinataire,$dateEcrit){
		$array = array('idEmissaire' => $idEmissaire, 'idDestinataire' => $idDestinataire,'ecrit'=>$dateEcrit);
		$this->db->where($array);
		$this->db->delete('Message');

	}
	public function get_all_message($idEmissaire){
		$this->db->select('*');
		$this->db->from('Message');
		$this->db->where('idEmissaire'=>$idEmissaire);
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
