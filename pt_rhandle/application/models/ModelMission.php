<?php

class ModelMission extends CI_Model{
	
	/**
	*@author Axel Durand
	**/
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}/**
	*@author Axel Durand
	*dans $data il y a:
	*@param $nomMission
	*@param $createurMission
	*@param $nature
	*@param $heureDebut
	*@param $dateDebut
	*@param $duree
	*@param $tabCollaborateur
	*@param $periodicité
	*@param $idCreateur
	*On peut conserver le même nom , l'id doit s'auto-incrémenter normalement.
	**/
	//incomplet
	public function createMission($data,,$tabCollaborateur,$periodicité,$idCreateur,$statut){
		/*calculer horaire fin à l aide de heureDebut et duree*/
		$horaireFin;
		/*checker que le tuple est pas déja créer*/
		/*checker que la nature existe si n'existe pas la créer */
		/*checker qu'une mission n'existe pas déja sur l'horaire,si elle existe est elle d'un niveau d'importance inférieur ?*/
		/*Faire de même pour chaque collabo*/
		/*Créer le tuple(voir le problème de périodicité*/
		if ($query->num_rows() == 0) {
			$this->db->insert(
				'Mission', 
				array(
					'horaireDebut' => $data['heureDebut'],
					'horaireFin' =>$horaireFin,
					'nom' => $data['nomMission'],
					'nature' =>$data['nature'],
					'idCollaborateur' =>$data['tabCollaborateur'],
					'dateDebut' =>$data['dateDebut'],
					//'' =>$data[''],ajoute t-on une date de fin ou bien plusieurs date jusque la date de fin
					'idCreateur' =>$idCreateur,
					'importance' =>$statut,
				)
			);
			if ($this->db->affected_rows() > 0) {
				return true;
			}
		} else {
			return false;
		}
	}
}


>