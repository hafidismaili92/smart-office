<?php

class M_gestionAbsence extends CI_Model{
	private $userDB=null;
	function __construct() {
		parent::__construct();
		$this->userDB =$this->load->database('utilisateur',true);
	}

	function insertAbsence($dta)
	{
		$addAbencequery = "INSERT INTO rh.absence(date_absence, motif,avec_bon, lien_bon,heure_debut, heure_fin,matricule,deduite_de_conge)
		VALUES (?, ?, ?, ?, ?, ?,(select numeric_matricule from rh.employee where char_matricule=?),?);";
		$addAbsence = $this->userDB->query($addAbencequery,$dta);
		if($addAbsence !== FALSE && $this->userDB->affected_rows() == 1){
			return 1;
		}
		else
		{
			return 0;
		}
	}
	function Absence_peroid($dateStart,$datend,$matricule)
	{
		$AbenceJquery = "select to_char(date_absence, 'dd-mm-yyyy') as date_absence,extract(dow from date_absence ) as jour,
		ROUND((sum(extract(EPOCH from heure_fin-heure_debut))/3600)::numeric,1) as duree  from rh.absence 
		where date_absence >=? and date_absence <=? and matricule=(select numeric_matricule from rh.employee where char_matricule=?)
		group by 
		date_absence;";
		$rslt = $this->userDB->query($AbenceJquery,array($dateStart,$datend,$matricule));
		foreach($rslt->result() as $r) {
			$jourFr ='inconnu';
			switch ($r->jour) {
				case 1:
				$jourFr ='Lundi';
				break;
				case 2:
				$jourFr ='Mardi';
				break;
				case 3:
				$jourFr ='Mercredi';
				break;
				case 4:
				$jourFr ='Jeudi';
				break;
				case 5:
				$jourFr ='Vendredi';
				break;
				case 6:
				$jourFr ='Samedi';
				break;
				case 0:
				$jourFr ='Dimanche';
				break;
				default:
				$jourFr ='inconnu';
				break;
			}
			$data[] = array(
				$jourFr,
				html_escape($r->date_absence),
				html_escape($r->duree.' Heures'),
			);
		}

		$output = array(

			"recordsTotal" => $rslt->num_rows(),
			"recordsFiltered" => $rslt->num_rows(),
			"data" => isset($data)?$data:[]
		);

		return $output;
	}
	function get_AbsenceInterval($date,$matricule)
	{
		$AbenceJquery = "select heure_debut, heure_fin from rh.absence where date_absence =? and matricule=(select numeric_matricule from rh.employee where char_matricule=?);";
		$rslt = $this->userDB->query($AbenceJquery,array($date,$matricule))->result_array();
		return $rslt;
	}
	function AbsenceJList($date,$matricule)
	{
		$AbenceJquery = "select motif,heure_debut, heure_fin,ROUND((EXTRACT(EPOCH FROM heure_fin-heure_debut)/3600)::numeric,1) as duree,ROUND((EXTRACT(EPOCH FROM heure_debut)/3600)::numeric,1) as debutdecimal,
		ROUND((EXTRACT(EPOCH FROM heure_fin)/3600)::numeric,1) as findecimal,id_absence as num from rh.absence where date_absence =? and matricule=(select numeric_matricule from rh.employee where char_matricule=?);";
		$rslt = $this->userDB->query($AbenceJquery,array($date,$matricule));
		foreach($rslt->result() as $r) {

			$data[] = array(

				html_escape($r->heure_debut),
				html_escape($r->heure_fin),
				html_escape($r->duree).' Heures',
				html_escape($r->motif),
				html_escape($r->debutdecimal),
				html_escape($r->findecimal),
				'-',
				html_escape($r->num),
			);
		}

		$output = array(

			"recordsTotal" => $rslt->num_rows(),
			"recordsFiltered" => $rslt->num_rows(),
			"data" => isset($data)?$data:[]
		);

		return $output;
	}
	function deleteAbsence($code,$matricule)
	{
		$queryRemoveAbsc= "delete from rh.absence where id_absence=? and matricule = (select numeric_matricule from rh.employee where char_matricule = ? )";
		$removeAbsquery = $this->userDB->query($queryRemoveAbsc,array($code,$matricule));
		if($removeAbsquery !== FALSE){
			return 1;
		}
		else
		{
			return 0;
		}
	}

}
?>