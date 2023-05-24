<?php

class M_gestionEtablissements extends CI_Model{
	private $userDB=null;
	function __construct() {
		parent::__construct();
		$this->userDB =$this->load->database('utilisateur',true);
	}

	function M_nouvelleEtablissementData()
	{
		$nouvelleEtablissementsData = 
		array(
			'classe' =>$this->userDB->query('SELECT rh.etablissement.code_etablissement,rh.etablissement.libelle, rh.type_etablissement.id_type,rh.type_etablissement.designation, rh.etablissement.id_niveau, mere.code_etablissement as code_mere,mere.libelle as merelibelle, rh.etablissement.libelle, rh.etablissement.date_creation
	FROM rh.etablissement LEFT JOIN rh.type_etablissement on rh.type_etablissement.id_type =rh.etablissement.id_type LEFT JOIN rh.etablissement as mere on rh.etablissement.code_etabli_mere= mere.code_etablissement   ;')->result_array(),
			'type' =>$this->userDB->query('SELECT id_type, designation FROM rh.type_etablissement;')->result_array(),
		);

		return $nouvelleEtablissementsData;
	}
	function checkValidEtablissement($code,$entreprise)
	{
		$query = "select * from rh.etablissement where code_etablissement=? and id_entreprise =? and visible=true;";
		$rslt = $this->userDB->query($query,array($code,$entreprise))->result_array();
		if(count($rslt)>0)
		{
			return $rslt[0];
		}
		else
		{
			return 0;
		}
	}
	function insertEtablissement($dtaArray)
	{
		$Equery = "INSERT INTO rh.etablissement(id_niveau, code_etabli_mere,id_type, libelle,id_entreprise,date_creation)
	VALUES (?,?,?, ?,?,CURRENT_TIMESTAMP)";
		
		$addEtablissementQUery = $this->userDB->query($Equery,$dtaArray);
	if($addEtablissementQUery !== FALSE && $this->userDB->affected_rows() == 1){
			return 1;
		}
		else
		{
			return 0;
		}
	}
	function updateEtablissement($dtaArray)
	{
		$Equery = "UPDATE rh.etablissement set id_niveau = ?, code_etabli_mere = ?, id_type = ?, libelle = ? WHERE code_etablissement = ? and id_entreprise = ? and id_type!='DG'";
		$updateEtablissementQUery = $this->userDB->query($Equery,$dtaArray);
	if($updateEtablissementQUery !== FALSE && $this->userDB->affected_rows() == 1){
			return 1;
		}
		else
		{
			return 0;
		}
	}
	function etablissementList($entreprise)
	{
		$listEtablissementsQuery = 'SELECT rh.etablissement.code_etablissement,rh.etablissement.libelle, rh.type_etablissement.id_type,rh.type_etablissement.designation, rh.etablissement.id_niveau, mere.code_etablissement as code_mere,mere.libelle as merelibelle, rh.etablissement.date_creation
	FROM rh.etablissement LEFT JOIN rh.type_etablissement on rh.type_etablissement.id_type =rh.etablissement.id_type LEFT JOIN rh.etablissement as mere on rh.etablissement.code_etabli_mere= mere.code_etablissement where rh.etablissement.visible=true and rh.etablissement.id_entreprise=?   ;';
		$rslt = $this->userDB->query($listEtablissementsQuery,array($entreprise));
		$data = array();

          foreach($rslt->result() as $r) {
          	$DateCreation = new DateTime(html_escape($r->date_creation));
               $data[] = array(
              
                    html_escape($r->code_etablissement),
                    html_escape($r->libelle),
                    html_escape($r->designation),
                    html_escape($r->merelibelle),
                    $DateCreation->format('d-m-Y'),
                    html_escape($r->id_type)!='DG'?'action':'noaction'
                    //html_escape($r->id_classe),
                    //html_escape($r->idtype),
                  	
               );
          }

          $output = array(
               
                 "recordsTotal" => $rslt->num_rows(),
                 "recordsFiltered" => $rslt->num_rows(),
                 "data" => $data
            );
          
  return $output;
	}
	function hideEtablissement($code,$identreprise)
	{
	$query ='update rh.etablissement set visible=false where code_etablissement=? and id_entreprise=? ';
	$exec= $this->userDB->query($query,array($code,$identreprise));
if($exec && $this->userDB->affected_rows()>0)
	return 1;
else
	return 0;
	}
	function deleteEtablissement($code,$identreprise)
	{
		$query ="delete from rh.etablissement et where code_etablissement = ? and id_entreprise =? 
and id_type !='DG' and not exists (select 1 from rh.etablissement child where child.code_etabli_mere=et.code_etablissement) 
and not exists (select 1 from rh.employee emp where emp.code_etablissement=et.code_etablissement)";
	$exec= $this->userDB->query($query,array($code,$identreprise));
if($exec && $this->userDB->affected_rows()>0)
	return 1;
else
	return 0;
	}
	function getOrganigramme($entreprise)
	{
		$query = 'WITH RECURSIVE mere as(
		SELECT code_etablissement,code_etabli_mere as mere, libelle, date_creation
		FROM rh.etablissement where id_entreprise = ? and code_etabli_mere is null
		Union
		select  fille.code_etablissement,fille.code_etabli_mere as mere, fille.libelle, fille.date_creation
		from rh.etablissement fille
		inner join mere 
		on 
		fille.code_etabli_mere = mere.code_etablissement
		)
		select * from mere';
		$exec= $this->userDB->query($query,array($entreprise));
		if($exec)
			return $exec->result_array();
		else
			return 0;
	}
}
?>