<?php

class M_affaireMissions extends CI_Model{
	private $userDB=null;
	function __construct() {
		parent::__construct();
		$this->userDB =$this->load->database('utilisateur',true);
	}
	function missionsList($matricule_createur,$affaire)
	{
		$listMissionsQuery = "SELECT id_tache, numero_affaire, iid_tache_mere as tach_mere, libelle, avancement, niveau, date_debut, date_validation, consulte, nouvel,libelle_dossier, (select CONCAT(nom,' ',prenom) from rh.employee where employee.numeric_matricule=matricule)  as responsable,(select char_matricule from rh.employee where employee.numeric_matricule=matricule)  as responsable_mat, validee,delai, matricule,observations FROM affaires.taches WHERE matricule_createur=? and numero_affaire=? and iid_tache_mere IS  NULL ;";
		
		$rslt = $this->userDB->query($listMissionsQuery,array($matricule_createur,$affaire));
		$data = array();

		foreach($rslt->result() as $r) {

			$Datedebut = new DateTime(html_escape($r->date_debut));
			$DatefinProbable = new DateTime(html_escape($r->date_debut));
			$DatefinProbable->add(new DateInterval('P'.html_escape($r->delai).'D'));
			$Datevalidation = $r->date_validation!=''?new DateTime(html_escape($r->date_validation)):null;
			$valideehtml= '<i class="fa fa-hourglass-start " style="color:#FFCB7A"></i>'; 
			$validerAction = 'Valider';
			$validerClass = "missions-actions-validate";
			$validee = 0; //0 en cours 1 validee -1 en souffrance
			$Now = strtotime(date('Y-m-d')); 
			$dateFnTimestamp = strtotime($DatefinProbable->format('Y-m-d')); 
			if(html_escape($r->validee)=='f')
			{

				if($dateFnTimestamp<$Now)
				{
					$valideehtml= '<i class="fa fa-exclamation-triangle " style="color:#FE939E"></i>';
					$validee = -1;
				}

			}
			else
			{
				$valideehtml= '<i class="fa fa-check-circle " style="color:rgba(110, 247, 133, 1)"></i>';
				$validee = 1;
				$validerClass = "missions-actions-unvalidate";
				$validerAction = 'Supprimer la validation';
			}
			$data[] = array(
				$valideehtml,
				'<a href="#" class="avatar"><img alt="" src="'.base_url().'/ImgProfil?u='.html_escape($r->responsable_mat).'"></a>',
				html_escape($r->id_tache),
				html_escape($r->libelle),
				html_escape($r->responsable),
				html_escape($r->responsable_mat),
				html_escape($r->avancement)!=''?html_escape($r->avancement):'0',
				$Datedebut->format('d-m-Y'),
				html_escape($r->numero_affaire),
				html_escape($r->delai).' Jours',
				$DatefinProbable->format('d-m-Y'),
				($Datevalidation!=null)?$Datevalidation->format('d-m-Y'):'',
				html_escape($r->niveau),
				html_escape($r->tach_mere),
				$validee,
				html_escape($r->matricule),
				html_escape($r->observations),
				'<div class="dropdown dropdown-action"><a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a><div class="dropdown-menu dropdown-menu-right"><span class="dropdown-item missions-actions missions-actions-detail" >Detail</span><span class="dropdown-item missions-actions '.$validerClass.'" >'.$validerAction.'</span><span class="dropdown-item missions-actions missions-actions-edit" >Modifier</span><span class="dropdown-item missions-actions missions-actions-remove" >Supprimer</span></div></div>'
				
			);
		}

		$output = array(

		//"recordsTotal" => $rslt->num_rows(),
		//"recordsFiltered" => $rslt->num_rows(),
			"data" => $data
		);

		return $output;
	}
	function insertMission($dtaMission)
	{
		$addMissionQUery = $this->userDB->insert('affaires.taches',$dtaMission);
		if($addMissionQUery !== FALSE && $this->userDB->affected_rows() == 1){
			return $insert_id = $this->userDB->insert_id();
		}
		else
		{
			return 0;
		}
	}
	function insertTacheAtt($dta)
	{
		$query ="INSERT INTO affaires.t_attachement(nom,extension,crypted_name,filekey,id_tache,date_creation) VALUES (?, ?, ?, ?, ?,CURRENT_DATE) returning nom,extension,crypted_name,filekey;";
		$executeQuery = $this->userDB->query($query,$dta);
		if($executeQuery && $this->userDB->affected_rows()>0)
			return $executeQuery->result_array()[0];
		else
			return 0;
	}
	function getAttachements($dta,$ownerOrResp)
	{
		$ownerOrResp = $ownerOrResp=="OWNER"?'matricule_createur':'matricule';
		$queryatt = "SELECT id_attach as num,a.id_tache as tnum, nom, filekey as key, t.numero_affaire, extension FROM affaires.taches t LEFT JOIN  affaires.t_attachement a  on t.id_tache= a.id_tache 
where a.id_tache=? and numero_affaire=? and ".$ownerOrResp."=?;";
		$attquery = $this->userDB->query($queryatt,$dta);
		if($attquery !== FALSE){
			return $attquery->result_array();
		}
		else
		{
			return 0;
		}
	}
	function M_allMesAttach($matricule,$entreprise)
	{
		$Query = "select at.*,af.numero_affaire,af.matricule_responsable as responsable from affaires.t_attachement at LEFT JOIN affaires.taches t on at.id_tache=t.id_tache 
		LEFT JOIN affaires.affaire af on t.numero_affaire=af.numero_affaire where t.matricule=?";
		$rslt = $this->userDB->query($Query,array($matricule));
		
		$data = array();

	foreach($rslt->result() as $r) {
		$myDateTime = new DateTime(html_escape($r->date_creation));
		
		$data[] = array(
			html_escape($r->id_attach),
			html_escape($r->extension),
			html_escape($r->nom),
			$myDateTime->format('d-m-Y'),
			html_escape(str_replace($entreprise.'_pfx_','',$r->numero_affaire)),
			'<div style="display:flex;justify-content:space-between;max-width:40px;"><a href="Affaire_missions/downloadAttachement?file='.$r->filekey.'&t='.$r->id_tache.'&ty=RESP"><i class="fa fa-download" style="color: #f95e66;cursor:pointer;"></i></a><i class="fa  fa-share-alt mesdocuments-actions share-document text-info" style="cursor:pointer;"></i></div>'
			
		);
	}

	$output = array(

		//"recordsTotal" => $rslt->num_rows(),
		//"recordsFiltered" => $rslt->num_rows(),
		"data" => $data
	);

	return $output;
		
		return $dtaString;
	}
	function M_filesShared($matricule)
	{
		$Query = "select sf.share_date,at.nom,at.extension,at.filekey,t.id_tache,concat(em.nom,' ',em.prenom,'(',em.char_matricule,')') as partage_par from affaires.shared_files sf LEFT JOIN affaires.t_attachement at on sf.id_file=at.id_attach 
		LEFT JOIN affaires.taches t on at.id_tache=t.id_tache
		LEFT JOIN rh.employee em  on t.matricule_createur = em.numeric_matricule
		where sf.share_with=? order by sf.share_date desc";
		$rslt = $this->userDB->query($Query,array($matricule));
		
		$data = array();

	foreach($rslt->result() as $r) {
		$myDateTime = new DateTime(html_escape($r->share_date));
		
		$data[] = array(
			
			html_escape($r->extension),
			html_escape($r->nom),
			$myDateTime->format('d-m-Y'),
			html_escape($r->partage_par),
			'<div style="display:flex;justify-content:space-between;max-width:40px;"><a href="Affaire_missions/downloadAttachement?file='.$r->filekey.'&t='.$r->id_tache.'&ty=RESP"><i class="fa fa-download" style="color: #f95e66;cursor:pointer;"></i></a></div>'
			
		);
	}
	$output = array(

		//"recordsTotal" => $rslt->num_rows(),
		//"recordsFiltered" => $rslt->num_rows(),
		"data" => $data
	);

	return $output;
		
		return $dtaString;
	}
	function add_sharedFile($data)
	{
		$q="select * from affaires.shared_files where id_file =?";
		$matricules = [];
		
		$rslt = $this->userDB->query($q,array($data[0]['id_file']));
		$rwos = $rslt->result_array();
		foreach ($rwos as $row) {
			foreach($data as $key=>$val)
		{
			
			if ($val['share_with']==$row['share_with'])
				unset($data[$key]);
		}
		}
		if(count($data)>0)
			$this->userDB->insert_batch('affaires.shared_files',$data);
		
		if ($this->userDB->trans_status() === FALSE)
		{
			
			return 0;
		}
		else
		{
			
			return 1;
			
		}

	}
	function suggestContact($filter,$entreprise) 
	{
		$q = "select char_matricule as c_matricule,numeric_matricule as matricule,nom,prenom from rh.employee e LEFT JOIN rh.etablissement t on e.code_etablissement=t.code_etablissement   where t.id_entreprise = ? and( char_matricule like ? or nom like ? or prenom like ?)";
		$rslt = $this->userDB->query($q,array($entreprise,$filter."%",$filter."%",$filter."%"));
		if($rslt)
		{
			$dtaemp= $rslt->result_array();
			return $dtaemp;
		}
		else
		{
			return [];
		}
	}
	function getAttByKey($dta,$ownerOrResp)
	{
		$ownerOrResp = $ownerOrResp=="OWNER"?'matricule_createur':'matricule';
		$queryatt = "SELECT a.id_tache as tnum,a.nom, t.numero_affaire as affaire,t.dossier as dossier,crypted_name  FROM affaires.t_attachement a  LEFT JOIN affaires.taches t    on  a.id_tache = t.id_tache where a.filekey=? and a.id_tache = ? and ".$ownerOrResp."=?;";
		$attquery = $this->userDB->query($queryatt,$dta);
		if($attquery && count($attquery->result_array())>0)
		{
			return $attquery->result_array()[0];
		}
		else
		{
			
			return 0;
		}
	}
	function removeMission($dta)
	{
		$queryRemoveMission = "delete from affaires.taches where id_tache=? and numero_affaire=? and matricule_createur=?";
		$removeMissionquery = $this->userDB->query($queryRemoveMission,$dta);
		if($removeMissionquery !== FALSE){
			return 1;
		}
		else
		{
			return 0;
		}
	}
	function editMission($dta)
	{
		$queryEditMission = "update affaires.taches set delai= ?,matricule=?,libelle=?
		where  id_tache=? and matricule_createur=? and numero_affaire=?";
		$EditMissionquery = $this->userDB->query($queryEditMission,$dta);
		if($EditMissionquery !== FALSE){
			return 1;
		}
		else
		{
			return 0;
		}
	}
	function validate_mission($arrayData,$validate)
	{
		$validee=$validate==1?'true':'false';
		$query = 'UPDATE affaires.taches
		SET validee='.$validee.' WHERE id_tache=? and numero_affaire=? and matricule_createur=?;';
		$UpdateMissionquery = $this->userDB->query($query,$arrayData);
		if($UpdateMissionquery !== FALSE){
			return 1;
		}
		else
		{
			return 0;
		}
	}
	function employeesList($user_codeEtablissement,$entreprise)
	{
		$listemployeesQuery = "WITH RECURSIVE tableR (code_etabli_mere, code_etablissement,libelle)
		AS
		(
		SELECT e.code_etabli_mere, e.code_etablissement, e.libelle
		FROM rh.etablissement AS e   
		WHERE code_etablissement = ? and id_entreprise=?
		UNION all
		SELECT e.code_etabli_mere, e.code_etablissement, e.libelle
		FROM rh.etablissement AS e
		INNER JOIN tableR AS d
		ON e.code_etabli_mere = d.code_etablissement
		)
		SELECT tableR.libelle as etablissementlibelle,char_matricule,nom,prenom,(select rh.fonction.libelle as fonctionlebelle from rh.fonction where fonction.id_fonction=rh.employee.id_fonction)
		FROM tableR inner join rh.employee on tableR.code_etablissement=rh.employee.code_etablissement ";
		$rslt = $this->userDB->query($listemployeesQuery,array($user_codeEtablissement,$entreprise));
		$data = array();

		foreach($rslt->result() as $r) {

			$data[] = array(

				html_escape($r->char_matricule),
				html_escape($r->nom).' '.html_escape($r->prenom),
				html_escape($r->fonctionlebelle),
				html_escape($r->etablissementlibelle)
			);
		}

		$output = array(

		//"recordsTotal" => $rslt->num_rows(),
		//"recordsFiltered" => $rslt->num_rows(),
			"data" => $data
		);

		return $output;
	}

}

?>