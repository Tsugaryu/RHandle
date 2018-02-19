<?php
class 	ModelMission extends CI_Model
{
	
	/**
	**	@author Axel Durand
	**/
	public 	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	/**
	**	@author Nicolas Reszka
	**	@param $collaborators : la liste des noms des collaborateurs
	**	@param $mission_id : l'identifiant de la mission 
	**	@return :
	**		- 0   : Aucun collaborateur n'a été indiqué
	**		- 1   : Tous les collaborateurs ont été insérés
	**		-$error = array(employés non trouvé) : certains employé n'ont pas été trouvés
	**/
	public 	function create_collaborators($collaborators,$mission_id)
	{
		$error = array();

		/* Verifier si des collaborateurs ont été indiqués */
		if ((count($collaborators) == 1 && $collaborators[0] == ""))
		{
			return 0;	
		}

		/* Insertion des collaborateurs */
		foreach ($collaborators as $employe) 
		{
			$employe = trim($employe);

			/* Couper le prénom et le nom en deux chaines*/
			$employe = preg_split("/[\s]+/", $employe);

			/* Seul le nom ou le prénom indiqué */
			if ((count($employe) == 1)) 
			{
				array_push($error, $employe);
			} 
			else 
			{
				/* Chercher l'employé */
				$this->db->select("id");
				$this->db->from("Employe");
				$this->db->like("LOWER(prenom)",strtolower($employe[0]));
				$this->db->like("LOWER(nom)",strtolower($employe[1]));	
				$query = $this->db->get();

				/* Employé non trouvé */
				if ($query->num_rows() == 0)
				{
					array_push($error, $employe);
				}
				/* Ajout de l'employé dans la table associative */
				else
				{
					$this->db->insert(
						'Collaborateurs', 
						array(
							"idMission" => $mission_id,
							"idEmploye" => $query->result()[0]->id
						)
					);
				}
			}
		}
		
		if (count($error) > 0) {
			return $error;
		} else {
			return 1;
		}
	}


	/**
	**	@author Nicolas Reszka
	**	@param $data(
	**		nom         => décrit la mission,
	**		typeMission => doit exister dans la table "TypeMission",
	**		priorite    => statut du responsable de la mission,
	**		idResponsable,
	**		dateDebut,
	**		durée       => durée en heures
	**	);
	**	@return :
	**		- 0   : typeMission n'existe pas
	**		-(-1) : La mission n'a pas été inseré
	**		- mission_id > 0 : La mission à été insérée
	**/
	public 	function create_mission($data)
	{
		
		/* Verification de la nature de la mission */
		$this->db->select("*");
		$this->db->from("TypeMission");
		$this->db->where("nature",$data["typeMission"]);
		$query = $this->db->get();

		if ($query->num_rows() == 0)
		{
			return 0;
		}
		else
		{	
			/* Insertion de la mission */

			$data["terminee"] = false;

			/*$this->db->insert("rhandle_missions");*/
			$this->db->insert("Missions", $data);

			if ($this->db->affected_rows() > 0)
			{
				/* Renvoyer l'identifiant de la mission indiquée */
				return $this->db->insert_id();
			}
			else
			{
				return -1;
			}
		}
	}

	/**
	**	@author Nicolas Reszka
	**	@param $data(
	**		idMission	=> l'identifiant de la mission
	**		nom         => décrit la mission,
	**		typeMission => doit exister dans la table "TypeMission",
	**		priorite    => statut du responsable de la mission,
	**		idResponsable,
	**		dateDebut,
	**		durée       => durée en heures,
	**		terminee    => boolean qui décrit si la mission est terminée
	**	);
	**	@return :
	**		- 0   : typeMission n'existe pas
	**		-(-1) : La mission n'a pas été modifiée
	**		- 1   : La mission à été modifiée
	**/
	public 	function update_mission($data)
	{
		
		/* Verification de la nature de la mission */
		$this->db->select("*");
		$this->db->from("TypeMission");
		$this->db->where("nature",$data["typeMission"]);
		$query = $this->db->get();

		if ($query->num_rows() == 0)
		{
			return 0;
		}
		else
		{	
			/* Modification de la mission */
			$this->db->set($data);
			$this->db->where('idMission', $data["idMission"]);
			$this->db->update("Missions");

			if ($this->db->affected_rows() > 0)
			{
				return 1;
			}
			else
			{
				return -1;
			}
		}
	}

	/**
	**	@author  Nicolas Reszka
	**/
	public 	function delete_mission_by_id($id)
	{
		$this->db->where("idMission",$id);
		$this->db->delete("Missions");

		$this->delete_collaborators($id);
	}

	/**
	**	@author  Nicolas Reszka
	**/
	public 	function get_collaborators($mission_id)
	{
		$this->db->select("idEmploye");
		$this->db->from("Collaborateurs");
		$this->db->where("idMission",$mission_id);
		$query = $this->db->get();

		if ($query->num_rows() == 0)
		{
			return 0;
		} 
		else
		{
			$employe = array();

			foreach ($query->result() as $collaborator) 
			{
				array_push($employe, $collaborator->idEmploye);
			}

			$this->db->select("*");
			$this->db->from("Employe");
			$this->db->where_in('id',$employe);
			$query = $this->db->get();

			return $query->result();
		}
	}

	/**
	**	@author  Nicolas Reszka
	**/
	public 	function delete_collaborators($mission_id)
	{
		$this->db->where("idMission",$mission_id);
		$this->db->delete("Collaborateurs");
	}

	/**
	**	@author  Nicolas Reszka
	**/
	public 	function get_missions_by_id($id)
	{
		$this->db->select("*");
		/*$this->db->from("rhandle_missions");*/
		$this->db->from("Missions");
		$this->db->where("idMission",$id);
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

	/**
	**	@author  Nicolas Reszka
	**/
	public 	function get_missions_by_day($year,$month,$day)
	{
		$this->db->select("*,DAY(dateDebut)");
		/*$this->db->from("rhandle_missions");*/
		$this->db->from("Missions");
		$this->db->where("YEAR(dateDebut)",$year);
		$this->db->where("MONTH(dateDebut)",$month);
		$this->db->where("DAY(dateDebut)",$day);
		$this->db->order_by("priorite", "asc");

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


	/* 	get_missions_by_month($data)

		-fonction:
			trouve les missions dont le mois correspond à $month 
			et l'année à $year

		-arguments: 
			$month le mois
			$year l'annéee

		-return: 
			la liste des missions si succès
			false si échec
	*/
	/**
	**	@author  Nicolas Reszka
	**/
	public 	function get_missions_by_month($year,$month,$since_id=null)
	{
		$this->db->select("idMission,nom,dateDebut,DAY(dateDebut)");
		/*$this->db->from("rhandle_missions");*/
		$this->db->from("Missions");
		$this->db->where("YEAR(dateDebut)",$year);
		$this->db->where("MONTH(dateDebut)",$month);

		if(isset($since_id)) 
		{
			$this->db->where("idMission >",$since_id);
		}

		$this->db->order_by("priorite", "asc");

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


	/**
	**	@author  Nicolas Reszka
	**/
	public 	function get_last_id()
	{
		$this->db->select("AUTO_INCREMENT");
		$this->db->from("information_schema.tables");
		$this->db->where("TABLE_SCHEMA","gac");
		$this->db->where("TABLE_NAME","Missions");

		$query = $this->db->get();

		if ($query->num_rows() == 0)
		{
			return -1;
		} 
		else
		{
			return $query->result()[0]->AUTO_INCREMENT-1;
		}
	}
}
?>