<?php

class M_tache_Staches extends CI_Model{
	private $userDB=null;
	function __construct() {
		parent::__construct();
		$this->userDB =$this->load->database('utilisateur',true);
	}
	function sTachesList($matricule_createur,$affaire,$numtacheMere)
	{
		$listStachesQuery = "SELECT id_tache, numero_affaire, iid_tache_mere as tach_mere, libelle, avancement, niveau, date_debut, date_validation, consulte, nouvel,libelle_dossier, (select CONCAT(nom,' ',prenom,'(',char_matricule,')') from rh.employee where employee.numeric_matricule=matricule)  as responsable, validee,delai, matricule,observations FROM affaires.taches WHERE matricule_createur=? and numero_affaire=? and iid_tache_mere =? ;";
		
	$rslt = $this->userDB->query($listStachesQuery,array($matricule_createur,$affaire,$numtacheMere));
	$data = array();

	foreach($rslt->result() as $r) {

			$Datedebut = new DateTime(html_escape($r->date_debut));
			$DatefinProbable = new DateTime(html_escape($r->date_debut));
			$DatefinProbable->add(new DateInterval('P'.html_escape($r->delai).'D'));
			$Datevalidation = $r->date_validation!=''?new DateTime(html_escape($r->date_validation)):null;
			$valideehtml= '<i class="fas fa-hourglass-start"></i>'; 
			$validee = 0; //0 en cours 1 validee -1 en souffrance
			$Now = strtotime(date('Y-m-d')); 
			$dateFnTimestamp = strtotime($DatefinProbable->format('Y-m-d')); 
			if(html_escape($r->validee)=='f')
			{
				if($dateFnTimestamp<$Now)
				{
					$valideehtml= '<i class="fas fa-exclamation-triangle" style="color:rgba(245, 67, 61, 1)"></i>';
					$validee = -1;
				}
			}
			else
			{
				$valideehtml= '<i class="fas fa-check-circle" style="color:rgba(110, 247, 133, 1)"></i>';
				$validee = 1;
			}
			$data[] = array(
				$valideehtml,
				html_escape($r->id_tache),
				html_escape($r->libelle),
				html_escape($r->numero_affaire),
				html_escape($r->responsable),
				html_escape($r->avancement)!=''?html_escape($r->avancement).'%':'0%',
				$Datedebut->format('d-m-Y'),
				html_escape($r->delai).' Jours',
				$DatefinProbable->format('d-m-Y'),
				($Datevalidation!=null)?$Datevalidation->format('d-m-Y'):'',
				html_escape($r->niveau),
				html_escape($r->tach_mere),
				$validee,
				html_escape($r->matricule),
				html_escape($r->observations),
				html_escape($r->libelle_dossier),
			);
		}

		$output = array(

		//"recordsTotal" => $rslt->num_rows(),
		//"recordsFiltered" => $rslt->num_rows(),
			"data" => $data
		);

		return $output;
}
function add_Stache($dtaStache)
{
	$qString ='INSERT INTO affaires.taches(delai,matricule,libelle,numero_affaire, iid_tache_mere,avancement, niveau,consulte, nouvel,validee, matricule_createur,date_debut)
	VALUES (?,(select numeric_matricule from rh.employee where char_matricule=?), ?, ?, ?, ?,(select niveau from affaires.taches where id_tache=?)+1 , ?, ?, ?, ?, ?);';
	$addMissionQUery = $this->userDB->query($qString,$dtaStache);
	if($addMissionQUery !== FALSE && $this->userDB->affected_rows() == 1){
			return 1;
		}
		else
		{
			return 0;
		}
}
function validate_tache($dta)
{
	$query = 'UPDATE affaires.taches
	SET validee=true WHERE id_tache=? and numero_affaire=? and matricule_createur=?;';
	$UpdateStachequery = $this->userDB->query($query,$dta);
	if($UpdateStachequery !== FALSE){
			return 1;
		}
		else
		{
			return 0;
		}
}
}

?>