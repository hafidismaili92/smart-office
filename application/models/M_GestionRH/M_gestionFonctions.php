<?php

class M_gestionFonctions extends CI_Model{
	private $userDB=null;
	function __construct() {
		parent::__construct();
		$this->userDB =$this->load->database('utilisateur',true);
	}

	function M_nouvelleFonctionsData($entreprise)
	{
		$nouvelleFonctionsData = 
		array(
			
			'type' =>$this->userDB->query('SELECT id_type_fon as id_type, libelle, date_creation
				FROM rh.type_fonction where rh.type_fonction.visible=true;')->result_array(),
			'typeEtablissement' =>$this->userDB->query('SELECT id_type as id_type, designation
				FROM rh.type_etablissement where rh.type_etablissement.visible=true;')->result_array(),
		);

		return $nouvelleFonctionsData;
	}
	function checkValidFonction($fonction,$entreprise)
	{
		$query="select * from rh.fonction where id_fonction =  ? and id_classe in (select id_classe from rh.classe where id_entreprise=?)";
		$rslt = $this->userDB->query($query,array($fonction,$entreprise))->result_array();
		if(count($rslt)>0)
		{
			return $rslt[0];
		}
		else
		{
			return 0;
		}
	}
	function insertfonction($dtaArray)
	{
		$Fquery = "INSERT INTO rh.fonction(id_classe, id_type_fon, libelle, date_creation) VALUES ( ?, ?, ?, CURRENT_TIMESTAMP);";
		$addFonctionQUery = $this->userDB->query($Fquery,$dtaArray);
		if($addFonctionQUery !== FALSE && $this->userDB->affected_rows() == 1){
			return 1;
		}
		else
		{
			return 0;
		}
	}
	function fonctionsList($entreprise)
	{
		$listFonctionsQuery = 'SELECT id_fonction, rh.fonction.id_classe as idclasse,rh.fonction.is_directeur as is_directeur,rh.fonction.libelle as libellefonction,classe.libelle as libelleclasse, type_fonction.id_type_fon as idtype, type_fonction.libelle as libelletype,rh.fonction.date_creation 
		FROM rh.classe RIGHT JOIN rh.fonction  ON rh.classe.id_classe=rh.fonction.id_classe LEFT JOIN rh.type_fonction ON rh.fonction.id_type_fon=rh.type_fonction.id_type_fon
		where rh.classe.id_entreprise=? and rh.fonction.visible=true   /*and rh.fonction.is_directeur=true;*/';
		$rslt = $this->userDB->query($listFonctionsQuery,array($entreprise));
		$data = array();

		foreach($rslt->result() as $r) {
			$DateCreation = new DateTime(html_escape($r->date_creation));
			$data[] = array(

				html_escape($r->id_fonction),
				html_escape($r->libellefonction),
				html_escape($r->libelleclasse),
				html_escape($r->libelletype),
				$DateCreation->format('d-m-Y'),
				'action',
				html_escape($r->is_directeur),
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
	function hideFonction($code,$identreprise)
	{
		$query ='update rh.fonction set visible=false where id_fonction=? and id_classe IN (select id_classe from rh.classe where id_entreprise=?) ';
		$exec= $this->userDB->query($query,array($code,$identreprise));
		if($exec && $this->userDB->affected_rows()>0)
			return 1;
		else
			return 0;
	}
	
}
?>