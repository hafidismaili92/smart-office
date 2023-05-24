<?php

class M_taches extends CI_Model{
	private $userDB=null;
	function __construct() {
		parent::__construct();
		$this->userDB =$this->load->database('utilisateur',true);
	}
	function tachesList($matricule)
	{
		$listTachesQuery = "SELECT id_tache, numero_affaire, iid_tache_mere as tach_mere, libelle, avancement, niveau, date_debut, date_validation, consulte, nouvel, (select CONCAT(nom,' ',prenom,'(',char_matricule,')') from rh.employee where employee.numeric_matricule=matricule_createur)  as creer_par, validee,delai, matricule_createur, observations FROM affaires.taches WHERE matricule=?";
		$rslt = $this->userDB->query($listTachesQuery,array($matricule));
		$data = array();

		foreach($rslt->result() as $r) {

			$Datedebut = new DateTime(html_escape($r->date_debut));
			$DatefinProbable = new DateTime(html_escape($r->date_debut));
			$DatefinProbable->add(new DateInterval('P'.html_escape($r->delai).'D'));
			$Datevalidation = $r->date_validation!=''?new DateTime(html_escape($r->date_validation)):null;
			$valideehtml= '<i class="fa  fa-hourglass-start" style="color: #FFCB7A;"></i>'; 
			$validee = 0; //0 en cours 1 validee -1 en souffrance
			$Now = strtotime(date('Y-m-d')); 
			$dateFnTimestamp = strtotime($DatefinProbable->format('Y-m-d')); 
			if(html_escape($r->validee)=='f')
			{
				if($dateFnTimestamp<$Now)
				{
					$valideehtml= '<i class="fa  fa-exclamation-triangle" style="color: #FE939E;"></i>';
					$validee = -1;
				}
			}
			else
			{
				$valideehtml= '<i class="fa  fa-check-circle" style="color:rgba(110, 247, 133, 1)"></i>';
				$validee = 1;
			}
			$data[] = array(
				$valideehtml,
				html_escape($r->id_tache),
				html_escape($r->libelle),
				str_replace($this->session->entreprise.'_pfx_','',$r->numero_affaire),
				html_escape($r->creer_par),
				html_escape($r->avancement)!=''?html_escape($r->avancement):'0',
				$Datedebut->format('d-m-Y'),
				html_escape($r->delai),
				$DatefinProbable->format('d-m-Y'),
				($Datevalidation!=null)?$Datevalidation->format('d-m-Y'):'',
				html_escape($r->niveau),
				html_escape($r->tach_mere),
				$validee,
				html_escape($r->matricule_createur),
				html_escape($r->observations),
				html_escape($r->consulte),
				'<div class="dropdown dropdown-action"><a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a><div class="dropdown-menu dropdown-menu-right"><span class="dropdown-item tache-actions tache-actions-detail" >Detail</span></div></div>'
			);
		}

		$output = array(

		//"recordsTotal" => $rslt->num_rows(),
		//"recordsFiltered" => $rslt->num_rows(),
			"data" => $data
		);

		return $output;
	}
	function update_tache($dtaArray)
	{
		$query = 'UPDATE affaires.taches
		SET avancement=?, observations=? WHERE id_tache=? and numero_affaire=? and matricule=?;';
		$UpdateTachesquery = $this->userDB->query($query,$dtaArray);
		if($UpdateTachesquery !== FALSE){
			return 1;
		}
		else
		{
			return 0;
		}

	}
	function setSelectedTache($dtaArray)
	{
		$query = 'UPDATE affaires.taches
		SET consulte=true WHERE id_tache=? and numero_affaire=? and matricule=?;';
		$UpdateTachesquery = $this->userDB->query($query,$dtaArray);
		if($UpdateTachesquery !== FALSE){
			return 1;
		}
		else
		{
			return 0;
		}

	}
	function tachesNotifications($matricule)
	{
		$query = "SELECT 1 as sort, count(id_tache) as nombrenonconsulte FROM affaires.taches WHERE matricule=? and consulte=false union SELECT 2 as sort,count(nouvel)  FROM affaires.taches WHERE matricule=? and nouvel=true order by sort asc";
		$unconsultedTachesQuery = $this->userDB->query($query,array($matricule,$matricule));

		if($unconsultedTachesQuery !== FALSE){
			$this->userDB->query('UPDATE affaires.taches SET nouvel=false WHERE matricule=?;',array($matricule));
			return array(
				'nonconsulte'=>$unconsultedTachesQuery->result_array()[0]['nombrenonconsulte'],
				'nonvu'=>$unconsultedTachesQuery->result_array()[1]['nombrenonconsulte']
			);

		}
		else
		{
			return 0;
		}


	}



}

?>