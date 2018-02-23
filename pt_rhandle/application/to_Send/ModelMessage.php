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
	public function create_message($data){
		$this->db->insert('Message',$data);
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
	public function get_all_message_user($idDestinataire){
		$check="idDestinataire=".$idDestinataire;
		$this->db->select('*');
		$this->db->from('Message');
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
	public function get_prenom_emissaire($id){
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
		public function get_nom_emissaire($id){
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
	public function find_employe_by_mail($mail){
		$check="mail=".$mail;
			$this->db->select('id');
			$this->db->from(' Employe');
			$this->db->where("mail",$mail);
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
	public function find_employe_by_id($id){
		$check="id=".$id;
			$this->db->select('mail');
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


	}
?>
