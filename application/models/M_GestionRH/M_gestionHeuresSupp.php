<?php
/**
 * 
 */
class M_gestionHeuresSupp extends CI_Model
{
	
	private $userDB=null;
	function __construct() {
		parent::__construct();
		$this->userDB =$this->load->database('utilisateur',true);
	}

	function getLien($key,$matricule,$entreprise)
	{
		$linkQuery = 'select emp.char_matricule as char_matricule,lien from rh.heure_sup LEFT JOIN rh.employee as emp on rh.heure_sup.matricule=emp.numeric_matricule LEFT JOIN rh.etablissement as et on emp.code_etablissement=et.code_etablissement where downloadkey=? and matricule=? and et.id_entreprise= ? ';
		$rslt = $this->userDB->query($linkQuery,array($key,$matricule,$entreprise))->result_array();
		if(!empty($rslt))
			{
				return $rslt[0];
			}
		else{
			return 0;
		};
	}
	function unPayedHSP($matricule)
	{
		$depQuery = "SELECT concat('Du ',to_char(datedb_heuresup,'DD-MM-YYYY'),' Au ',to_char(datefn_heuresup,'DD-MM-YYYY')) as periode, nombre_heure as nbrheure,justification, round((prixunit_heure)::numeric,2) as prix,round((prixunit_heure*nombre_heure)::numeric,2) as total,paye
	FROM rh.heure_sup where matricule=? and paye = 'false' order by id_heure_sup asc ;";

		$rslt = $this->userDB->query($depQuery,array($matricule))->result_array();
		return $rslt;
	}
	function heureSPList($matricule,$toDatatable=true)
	{
		$depQuery = "SELECT id_heure_sup as code,concat('Du ',to_char(datedb_heuresup,'DD-MM-YYYY'),' Au ',to_char(datefn_heuresup,'DD-MM-YYYY')) as periode, nombre_heure as nbrheure,justification, round((prixunit_heure)::numeric,2) as prix,round((prixunit_heure*nombre_heure)::numeric,2),paye,downloadkey as key
	FROM rh.heure_sup where matricule=? and EXTRACT(year FROM datedb_heuresup) = ? order by id_heure_sup asc ;";

		$rslt = $this->userDB->query($depQuery,array($matricule,date('Y')));
		if($toDatatable)
		{
			foreach($rslt->result() as $r) {
			
			$data[] = array(

				html_escape($r->periode),
				html_escape($r->nbrheure),
				html_escape($r->justification),
				'<a href="GestionHeuresSup/fiche_HSP?file='.html_escape($r->key).'&user='.$matricule.'"><i class="fa fa-download fa-lg" style="color:#b8b8b8;"></i></a><i class="fa fa-trash delete-heuresup table-actions" style="color:#ff5722;"></i>',
				html_escape($r->code),
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
	function insertHeureSupp($dtaArray)
	{
		$addCongeQUery = $this->userDB->insert('rh.heure_sup', $dtaArray);
		if($addCongeQUery !== FALSE && $this->userDB->affected_rows() == 1){
			return 1;
		}
		else
		{
			return 0;
		}
	}
	function deleteHSP($code,$matricule)
	{
		$queryRemoveHSP= "delete from rh.heure_sup where id_heure_sup=? and matricule = (select numeric_matricule from rh.employee where char_matricule = ? )";
		$removeHSPquery = $this->userDB->query($queryRemoveHSP,array($code,$matricule));
		if($removeHSPquery !== FALSE){
			return 1;
		}
		else
		{
			return 0;
		}
	}
}
?>