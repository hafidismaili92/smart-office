<?php

class M_details extends CI_Model{
	private $userDB=null;
	function __construct() {
		parent::__construct();
		$this->userDB =$this->load->database('utilisateur',true);
	}
	function M_getDetails($dtaArray)
	{
		/*$Query = "SELECT affaire.numero_affaire,b.typeaffaire,b.montant_ttc,c.avancement,(select CONCAT(nom,' ',prenom,'(',char_matricule,')') from rh.employee where employee.numeric_matricule=creer_par)  as creer_par,id_rangee, libelle, delai, observation, date_creation,dossier, ville, archive,terminee  (select CONCAT(nom,' ',prenom,'(',char_matricule,')') from rh.employee where employee.numeric_matricule=matricule_responsable) as responsable FROM affaires.affaire LEFT JOIN (Select 'contrat' as typeaffaire,numero_affaire,montant_ttc from affaires.contrat union Select 'APPEL OFFRE' as typeaffaire,numero_affaire,montant_ttc from affaires.appel_offre) as b on affaire.numero_affaire=b.numero_affaire LEFT JOIN (SELECT affaires.taches.numero_affaire, round(AVG(affaires.taches.avancement),0) as avancement from affaires.taches where niveau=1 GROUP BY affaires.taches.numero_affaire  ) as c on affaire.numero_affaire=c.numero_affaire  where affaire.numero_affaire =? and creer_par=?  ;";*/
		$Query = "SELECT affaire.numero_affaire,c.avancement,COALESCE(c.tachesvalide,0) as tachesvalide,COALESCE(c.tachesnonvalide,0) as tachesnonvalide,COALESCE(c.tachesensouffrance,0) as tachesensouffrance,
(select CONCAT(nom,' ',prenom,'(',char_matricule,')') from rh.employee where employee.numeric_matricule=creer_par)  as creer_par,
id_rangee, libelle, delai, observation, date_creation,dossier, ville, archive,case when terminee = TRUE then '1' else '0' end as statut
FROM affaires.affaire
LEFT JOIN (SELECT affaires.taches.numero_affaire, round(sum(affaires.taches.avancement::decimal*affaires.taches.delai)/sum(affaires.taches.delai),0) as avancement,sum(CASE WHEN affaires.taches.validee=true  THEN 1 ELSE 0 END) as tachesvalide,sum(CASE WHEN affaires.taches.validee=false and date_debut+affaires.taches.delai* INTERVAL '1 day' < now()   THEN 1 ELSE 0 END) as tachesensouffrance,sum(CASE WHEN affaires.taches.validee=false and date_debut+affaires.taches.delai* INTERVAL '1 day' >= now()   THEN 1 ELSE 0 END) as tachesnonvalide from affaires.taches where niveau=1 GROUP BY affaires.taches.numero_affaire  ) as c on affaire.numero_affaire=c.numero_affaire  
where affaire.numero_affaire =? and creer_par=?  ;";
		$rslt = $this->userDB->query($Query,$dtaArray);
		
		$rslt = $this->userDB->query($Query,$dtaArray);
		if($rslt)
		{
			$rsltArray = $rslt->result_array()[0];
			$rsltArray['numero_affaire']= str_replace($this->session->entreprise.'_pfx_','',$rsltArray['numero_affaire']);
			$DatefinProbable = new DateTime(html_escape($rsltArray['date_creation']));
			$DatefinProbable->add(new DateInterval('P'.html_escape($rsltArray['delai']).'D'));
			$Now = strtotime(date('Y-m-d')); 
			$dateFnTimestamp = strtotime($DatefinProbable->format('Y-m-d')); 
			if(html_escape($rsltArray['statut'])!=1)
			{

				if($dateFnTimestamp<$Now)
				{
					$rsltArray['statut'] = 2;
				}

			}
			$rsltArray['date_creation'] = new DateTime(html_escape($rsltArray['date_creation']));
			$rsltArray['date_creation'] = $rsltArray['date_creation']->format('d-m-Y');
			$rsltArray['date_fin'] = $DatefinProbable->format('d-m-Y');
			return $rsltArray;
			//return $rslt->result_array();
			
		}

	}
	function editAffaire($dta)
	{
		$queryEditAffaire = "UPDATE affaires.affaire
	SET libelle=?, delai=?, observation=?, terminee=? WHERE numero_affaire=? and creer_par=?;";
		$EditAffairequery = $this->userDB->query($queryEditAffaire,$dta);
		if($EditAffairequery !== FALSE){
			return 1;
		}
		else
		{
			return 0;
		}
	}

}
?>