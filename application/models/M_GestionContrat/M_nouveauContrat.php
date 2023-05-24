<?php

class M_nouveauContrat extends CI_Model{
	private $userDB=null;
	function __construct() {
		parent::__construct();
		$this->userDB =$this->load->database('utilisateur',true);
	}

	function load_unites()
	{
		$query ="SELECT code, libelle FROM contrats.unite order by categorie,serial_num asc;";
		return $this->userDB->query($query)->result_array();
	}
	function load_Sectors($ville)
	{
		$query='';
		if($ville!='')
		{
			$query='SELECT code_postale as code,secteur FROM contrats.ville_affaire where ville=?;';
		}
		else
		{
			$query='SELECT code_postale as code,secteur FROM contrats.ville_affaire ;';
		}
		
		return $this->userDB->query($query,array($ville))->result_array();

	}
	function load_DomaineSectors($domaine)
	{
		$query='';
		if($domaine!='')
		{
			$query='SELECT id as code,libelle FROM contrats.secteur_affaire where domaine=? order by code asc;';
		}
		else
		{
			$query='SELECT id as code,libelle FROM contrats.secteur_affaire order by code asc;';
		}
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
	function insertContrat($Array)
	{
		
		$this->userDB->trans_begin();
		
		$this->userDB->insert('contrats.contrat', $Array['contrat']);
		
		$this->userDB->insert_batch('contrats.prix', $Array['toutprix']);
		
		if ($this->userDB->trans_status() === FALSE)
		{
			$this->userDB->trans_rollback();
			return 0;
		}
		else
		{
			$this->userDB->trans_commit();
			return 1;
			
		}
		

	}
}
?>