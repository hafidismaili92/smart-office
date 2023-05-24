<?php

class M_gestionDeplacement extends CI_Model{
	private $userDB=null;
	function __construct() {
		parent::__construct();
		$this->userDB =$this->load->database('utilisateur',true);
	}
	function getLien($key,$matricule,$entreprise)
	{
		$linkQuery = 'select emp.char_matricule as char_matricule,lien from rh.deplacement LEFT JOIN rh.employee as emp on rh.deplacement.matricule=emp.numeric_matricule LEFT JOIN rh.etablissement as et on emp.code_etablissement=et.code_etablissement  where downloadkey=? and matricule=? and et.id_entreprise= ? ';
		$rslt = $this->userDB->query($linkQuery,array($key,$matricule,$entreprise))->result_array();
		if(!empty($rslt))
			{
				return $rslt[0];
			}
		else{
			return 0;
		};
	}
	function unPayedDeplacement($matricule)
	{
		$depQuery = "SELECT to_char(date_deplacement,'DD-MM-YYYY') as date_deplacement,lieu, objet,nombre_jour,round((prix_unitaire)::numeric,2) as prix,round((prix_unitaire*nombre_jour)::numeric,2) as total,paye
	FROM rh.deplacement where matricule=? and paye = 'false' order by id_deplacement asc ;";

		$rslt = $this->userDB->query($depQuery,array($matricule))->result_array();
		return $rslt;
	}
	function deplacementList($matricule,$toDatatable=true)
	{
		$depQuery = "SELECT id_deplacement as code,to_char(date_deplacement,'DD-MM-YYYY') as date_deplacement,lieu, objet,nombre_jour,round((prix_unitaire)::numeric,2) as prix,round((prix_unitaire*nombre_jour)::numeric,2),paye, downloadkey as key
	FROM rh.deplacement where matricule=? and EXTRACT(year FROM date_deplacement) = ? order by id_deplacement asc ;";

		$rslt = $this->userDB->query($depQuery,array($matricule,date('Y')));
		if($toDatatable)
		{
			foreach($rslt->result() as $r) {
			
			$data[] = array(

				html_escape($r->date_deplacement),
				html_escape($r->lieu),
				html_escape($r->objet),
				html_escape($r->nombre_jour),
				'<a href="GestionDeplacement/fiche_deplacement?file='.html_escape($r->key).'&user='.$matricule.'"><i class="fa fa-download fa-lg" style="color:#b8b8b8;"></i></a><i class="fa fa-trash delete-deplacement table-actions" style="color:#ff5722;"></i>',
				html_escape($r->code)
			);
		}
		
		$output = array(

			"recordsTotal" => $rslt->num_rows(),
			"recordsFiltered" => $rslt->num_rows(),
			"data" => isset($data)?$data:[]
		);

		return $output;
		}
		else
		{
			return $rslt->result_array();
		}
		
	}
	function insertDeplacement($dtaArray)
	{
		$addCongeQUery = $this->userDB->insert('rh.deplacement', $dtaArray);
		if($addCongeQUery !== FALSE && $this->userDB->affected_rows() == 1){
			return 1;
		}
		else
		{
			return 0;
		}
	}
	function deleteDeplacement($code,$matricule)
	{
		$queryRemoveDep= "delete from rh.deplacement where id_deplacement=? and matricule = (select numeric_matricule from rh.employee where char_matricule = ? )";
		$removeDepquery = $this->userDB->query($queryRemoveDep,array($code,$matricule));
		if($removeDepquery !== FALSE){
			return 1;
		}
		else
		{
			return 0;
		}
	}

}
?>