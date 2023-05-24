<?php

class M_gestionConge extends CI_Model{
	private $userDB=null;
	function __construct() {
		parent::__construct();
		$this->userDB =$this->load->database('utilisateur',true);
	}
	function getLien($key,$matricule,$entreprise)
	{
		$linkQuery = 'select emp.char_matricule as char_matricule,lien from rh.conge LEFT JOIN rh.employee as emp on rh.conge.matricule=emp.numeric_matricule LEFT JOIN rh.etablissement as et on emp.code_etablissement=et.code_etablissement  where downloadkey=? and matricule=? and et.id_entreprise= ?  ';
		
		$rslt = $this->userDB->query($linkQuery,array($key,$matricule,$entreprise))->result_array();
		if(!empty($rslt))
		{
			return $rslt[0];
		}
		else{
			return 0;
		};
	}
	function typeConge_list()
	{
		$list = $this->userDB->query('SELECT libelle, code FROM rh.type_conge;')->result_array();
		return $list;
	}
	function insertConge($dtaArray)
	{
		$addCongeQUery = $this->userDB->insert('rh.conge', $dtaArray);
		if($addCongeQUery !== FALSE && $this->userDB->affected_rows() == 1){
			return 1;
		}
		else
		{
			return 0;
		}
	}
	function congeList($matricule)
	{
		$congeQuery = "with tble as (select -1 as pseudoid,'Reliquat' as libelle,'-' as date_debut,'-' as date_reprise,COALESCE(reliquat_conge,0) as nbr_jour,'-' as type,'-' as typec,'-' as key from rh.employee where numeric_matricule=?
		union
		select 0 as pseudoid,'Droit annee','-' as date_debut,'-' as date_reprise, COALESCE(conge_annee,0),'-' as type,'-' as typec,'-' as key from rh.employee where numeric_matricule=?
		union
		(select id_conge as pseudoid,'Periode',to_char(date_debut,'DD-MM-YYYY HH24:MI'),to_char(date_reprise,'DD-MM-YYYY HH24:MI'),COALESCE(nbr_jour,0),typeconge.libelle,rh.conge.code_type as typec,downloadkey from rh.conge LEFT JOIN rh.type_conge as typeconge on rh.conge.code_type=typeconge.code where matricule=? and EXTRACT(year FROM date_debut) = ? order by id_conge asc)
		) 
		select * from tble order by pseudoid ";

		$rslt = $this->userDB->query($congeQuery,array($matricule,$matricule,$matricule,date('Y')));
		$disponible=0;
		foreach($rslt->result() as $key => $r) {
			if(html_escape($r->libelle)=='Periode')
			{
				$disponible=html_escape($r->typec)=='CR'?$disponible-html_escape($r->nbr_jour):$disponible;
			}
			else
			{
				$disponible+=html_escape($r->nbr_jour);	
			}
			$data[] = array(

				html_escape($r->libelle)=='Periode'?'Periode '.($key-1):html_escape($r->libelle),
				html_escape($r->date_debut),
				html_escape($r->date_reprise),
				html_escape($r->nbr_jour),
				html_escape($r->type),
				html_escape($r->key)=='-'?'-':'<a href="GestionConges/fiche_conge?file='.$r->key.'&user='.$matricule.'"><i class="fa fa-download fa-lg" style="color:#b8b8b8;"></i></a><i class="fa fa-trash fa-lg delete-conge table-actions" style="color:#ff5722;"></i>',
				html_escape($r->pseudoid)>0?html_escape($r->pseudoid):0
			);
		}
		$color = $disponible>=0?'green':'red';
		$data[] = array(

			'<span style="color:'.$color.';font-weight:bold;">Disponible</span>',
			'<span style="color:'.$color.';font-weight:bold;">-</span>',
			'<span style="color:'.$color.';font-weight:bold;">-</span>',
			'<span style="color:'.$color.';font-weight:bold;">'.$disponible.'</span>',
			'<span style="color:'.$color.';font-weight:bold;">-</span>',
			'<span style="color:'.$color.';font-weight:bold;">-</span>'
		);
		$output = array(

			"recordsTotal" => $rslt->num_rows(),
			"recordsFiltered" => $rslt->num_rows(),
			"data" => isset($data)?$data:[]
		);

		return $output;
	}
function deleteConge($code,$matricule)
	{
		$queryRemoveConge= "delete from rh.conge where id_conge=? and matricule = (select numeric_matricule from rh.employee where char_matricule = ? )";
		$removeCongequery = $this->userDB->query($queryRemoveConge,array($code,$matricule));
		if($removeCongequery !== FALSE){
			return 1;
		}
		else
		{
			return 0;
		}
	}
}
?>