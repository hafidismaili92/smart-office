<?php

class M_nouvelAffaire extends CI_Model{
	private $userDB=null;
	function __construct() {
		parent::__construct();
		$this->userDB =$this->load->database('utilisateur',true);
	}

	function rangeeList($proprietaire)
	{
		$query ='SELECT id_rangee as rangee FROM affaires.rangee where proprietaire = ?;';
		return $this->userDB->query($query,array($proprietaire))->result_array();
	}
	function load_Sectors($ville)
	{
		$query='SELECT code_postale as code,secteur FROM contrats.ville_affaire where ville=?;';
		return $this->userDB->query($query,array($ville))->result_array();

	}
	function load_DomaineSectors($domaine)
	{
		$query='SELECT id as code,libelle FROM contrats.secteur_affaire where domaine=? order by code asc;';
		return $this->userDB->query($query,array($domaine))->result_array();
	}
	function villesList()
	{
		$query ='SELECT ville,max(code_postale) as code FROM contrats.ville_affaire group by ville order by code asc ;';
		return $this->userDB->query($query)->result_array();
	}
	function domainesList()
	{
		$query ='SELECT id, libelle FROM contrats.domaine;';
		return $this->userDB->query($query)->result_array();
	}
	function insertRangee($Rangeename,$matricule)
	{
		$query ='INSERT INTO affaires.rangee(id_rangee, proprietaire) select ?, ? WHERE NOT EXISTS (SELECT id_rangee FROM affaires.rangee WHERE id_rangee=? and proprietaire=?   LIMIT 1);';
		$addRangeeQUery = $this->userDB->query($query,array($Rangeename,$matricule,$Rangeename,$matricule));

		if($addRangeeQUery !== FALSE && $this->userDB->affected_rows() == 1){
			return 1;
		}
		else
		{
			return 0;
		}
		
	}
	function insertAffaire($data)
	{
		
			$insertAffaire = "INSERT into affaires.affaire(
		numero_affaire, creer_par,libelle,delai,id_contrat, observation, date_creation, avancement, dossier,archive) values (?,?,?,?,?,?,current_timestamp,0,?,false)  ON CONFLICT ON CONSTRAINT pk_affaire DO NOTHING;";
		
		
		
		$this->userDB->trans_begin();
		$this->userDB->query($insertAffaire,$data);
		if ($this->userDB->trans_status() === FALSE)
		{
			$this->userDB->trans_rollback();
			return 0;
		}
		else
		{
			$this->userDB->trans_commit();
			return $this->userDB->affected_rows() == 1?1:2;
			
			}
		

	}
}
?>