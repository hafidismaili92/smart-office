<?php

class M_employes extends CI_Model{
	private $userDB=null;
	function __construct() {
		parent::__construct();
		$this->userDB =$this->load->database('utilisateur',true);
	}

	function M_nouveauEmployeData($entreprise)
	{
		$nouveauEmployeeData = 
		array(
			'contrats' =>$this->userDB->query('select id_contrat as code_contrat,libelle  from rh.type_contrat')->result_array(),
			'villes' =>$this->userDB->query('select nom_ville as ville from rh.ville order by ville asc')->result_array());

		return $nouveauEmployeeData;
	}
	function employee($matricule,$entreprise)
	{
		$checkEmployee = "SELECT a.char_matricule as matricule,a.is_directeur,b.id_entreprise,a.numeric_matricule as num_matricule, CONCAT(a.prenom,' ',a.nom) as nom_complet,a.lien_photo as photo,b.code_etablissement as etablissement from rh.employee a 
		LEFT JOIN rh.etablissement b on a.code_etablissement=b.code_etablissement 
		where a.numeric_matricule=(select numeric_matricule from rh.employee where char_matricule=?) and b.id_entreprise=?";
		$rslt = $this->userDB->query($checkEmployee,array($matricule,$entreprise))->result_array();
		if(count($rslt)>0)
		{
			return $rslt;
		}
		else
		{
			return 0;
		}
	}
	function getUserProfilImg($matricule)
	{
		$checkEmployee = "SELECT lien_photo as photo from rh.employee where numeric_matricule=(select numeric_matricule from rh.employee where char_matricule=?)";
		$rslt = $this->userDB->query($checkEmployee,array($matricule))->result_array();
		if(count($rslt)>0)
		{
			return $rslt;
		}
		else
		{
			return 0;
		}
	}
	function checkAttachement($matricule,$entreprise,$type)
	{
		switch ($type) {
			case 'contrat':
			$checkAttachement = "SELECT c.lien as lien_contrat,e.char_matricule from rh.contrat_employe c  LEFT JOIN rh.employee e on c.matricule = e.numeric_matricule LEFT JOIN rh.etablissement et on e.code_etablissement=et.code_etablissement where matricule=? and et.id_entreprise=? order by date_debut desc limit 1";
			break;
			case 'diplome':
			$checkAttachement = "SELECT e.lien_diplome,e.char_matricule from rh.employee e LEFT JOIN rh.etablissement et on e.code_etablissement=et.code_etablissement
			where numeric_matricule=?  and et.id_entreprise=?;";
			break;
			default:
			return 0;
			break;
		}
		$rslt = $this->userDB->query($checkAttachement,array($matricule,$entreprise))->result_array();
		if(is_array($rslt))
		{
			return $rslt[0];
		}
		else
		{
			return 0;
		}
	}
	function getUserProfil($matricule,$entreprise)
	{
		$checkEmployee = "SELECT cnt.id_contrat,typecnt.libelle as lib_contrat,cin,emp.is_directeur as isdg, emp.code_etablissement, emp.id_fonction,et.libelle as et_libelle,f.libelle as f_libelle, ville_residence, ville_origine, nom, prenom,to_char(date_naissance,'DD/MM/YYYY') as date_naissance, to_char(date_recrutement,'DD/MM/YYYY') as date_recrutement, sexe, situation_famille, compte_bancaire, telephone, email, adresse,date_fin_activite, emp.motif_fin,numeric_matricule, agence_bancaire, char_matricule, lien_photo,libelle_diplome,lien_diplome,cnt.lien as lien_contrat
		FROM rh.employee emp
		LEFT JOIN rh.etablissement et on emp.code_etablissement=et.code_etablissement 
		LEFT JOIN rh.fonction f on emp.id_fonction = f.id_fonction 
		LEFT JOIN rh.contrat_employe cnt on cnt.matricule = emp.numeric_matricule
		LEFT JOIN rh.type_contrat typecnt on cnt.id_contrat = typecnt.id_contrat
		where emp.char_matricule=? and et.id_entreprise=? and emp.visible=true order by cnt.date_debut desc limit 1";
		$rslt = $this->userDB->query($checkEmployee,array($matricule,$entreprise))->result_array();
		if(count($rslt)>0)
		{
			return $rslt;
		}
		else
		{
			return 0;
		}
	}
	function employeesListe($entreprise)
	{
		$listemployeesQuery = "SELECT  char_matricule,nom, prenom,email,cin,ville_residence, ville_origine,to_char(date_naissance,'dd-mm-yyyy') as date_naissance, to_char(date_recrutement,'dd-mm-yyyy') as date_recrutement,situation_famille, compte_bancaire, telephone, adresse,reliquat_conge, conge_annee, date_fin_activite, agence_bancaire,rh.etablissement.libelle as etablissement,rh.fonction.libelle as fonction from rh.employee LEFT JOIN rh.etablissement on rh.employee.code_etablissement=rh.etablissement.code_etablissement LEFT JOIN rh.fonction on rh.employee.id_fonction = rh.fonction.id_fonction where rh.etablissement.id_entreprise=? and rh.employee.visible=true;";
		$rslt = $this->userDB->query($listemployeesQuery,array($entreprise));
		$data = array();

		foreach($rslt->result() as $r) {

			$data[] = array(
				'<a href="#" class="avatar"><img alt="" src="'.base_url().'/ImgProfil?u='.html_escape($r->char_matricule).'"></a>',
				html_escape($r->char_matricule),
				html_escape($r->nom),
				html_escape($r->prenom),
				html_escape($r->fonction),
				html_escape($r->etablissement),
				html_escape($r->email),
				html_escape($r->telephone),
				html_escape($r->cin),
				html_escape($r->ville_residence),
				html_escape($r->ville_origine),
				html_escape($r->date_naissance),
				html_escape($r->date_recrutement),
				html_escape($r->adresse),
				html_escape($r->compte_bancaire),
				html_escape($r->situation_famille),
				html_escape($r->reliquat_conge),
				html_escape($r->conge_annee),
				html_escape($r->date_fin_activite),
				html_escape($r->agence_bancaire),
				
				'
				<button type="button" class="btn btn-sm employee-action bg-info" style="width:40px;max-width:80%;position:relative;padding:0;color:white;padding:4px;"><i class="fa fa-cogs fa-lg"></i></button>'
			);
		}

		$output = array(

		//"recordsTotal" => $rslt->num_rows(),
		//"recordsFiltered" => $rslt->num_rows(),
			"data" => $data
		);

		return $output;
	}
	function editEmployee($dta,$entreprise,$is_directeur=false)
	{
		if($is_directeur==true)
		{
			$q = "WITH employeerow as (UPDATE rh.employee
	SET cin=?, ville_residence=?, ville_origine=?, nom=?, prenom=?, date_naissance=?, date_recrutement=?, sexe=?, situation_famille=?, compte_bancaire=?, telephone=?, email=?, adresse=?,agence_bancaire=?,lien_photo=?
	WHERE EXISTS(select 1 from rh.employee e LEFT JOIN rh.etablissement et on e.code_etablissement=et.code_etablissement LEFT JOIN rh.entreprise en on et.id_entreprise= en.numero where e.char_matricule=? and en.numero=".$entreprise." ) and char_matricule=? returning char_matricule as char_mat,numeric_matricule ,lien_diplome as liend,lien_photo as lienp) select* from employeerow ";
		}
		else
		{
			$q = "WITH employeerow as (UPDATE rh.employee
	SET cin=?, code_etablissement=?, id_fonction=?, ville_residence=?, ville_origine=?, nom=?, prenom=?, date_naissance=?, date_recrutement=?, sexe=?, situation_famille=?, compte_bancaire=?, telephone=?, email=?, adresse=?, lien_diplome=COALESCE (?,lien_diplome), libelle_diplome=?,agence_bancaire=?,lien_photo=?
	WHERE EXISTS(select 1 from rh.employee e LEFT JOIN rh.etablissement et on e.code_etablissement=et.code_etablissement LEFT JOIN rh.entreprise en on et.id_entreprise= en.numero where e.char_matricule=? and en.numero=".$entreprise." ) and char_matricule=? and is_directeur ='false' returning char_matricule as char_mat,numeric_matricule ,lien_diplome as liend,lien_photo as lienp),contratrow as (UPDATE rh.contrat_employe SET id_contrat=?,lien=COALESCE(?,lien) from employeerow where matricule=numeric_matricule  returning lien as lienc) select* from employeerow,contratrow ";
		}
		
	$Query=$this->userDB->query($q,$dta)->result_array();
	if(is_array($Query) and count($Query)>0){
			return $Query[0];
		}
		else
		{
			return 0;
		}
	}
	function insertEmployee($data,$droitArray,$rndomPassword,$nameEntreprise)
	{
		
		
		$sql = 'WITH employeerow as (INSERT INTO rh.employee ("reliquat_conge","conge_annee","cin", "code_etablissement", "sexe", "prenom", "nom", "situation_famille", "ville_residence", "date_naissance", "ville_origine", "date_recrutement", "adresse", "libelle_diplome", "id_fonction", "agence_bancaire", "compte_bancaire", "email", "telephone","char_matricule","lettre","lien_photo","lien_diplome","emp_password","first_password") VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,null,null,?,?,?,true) returning numeric_matricule as matricule,char_matricule as char_mat,lien_diplome as liend,lien_photo as lienp,nom,prenom,email), contratrow as (INSERT INTO rh.contrat_employe(lien,id_contrat,matricule,date_debut,encours) select ?,?,matricule,CURRENT_TIMESTAMP,true from employeerow returning lien as lienc) select* from employeerow,contratrow  ';
		$this->userDB->trans_begin();
		$Query=$this->userDB->query($sql,$data)->result_array();
		if(!$Query)
		{
			$this->userDB->trans_rollback();
			return false;
		}
		else
		{
			$correctQuery = true;
			foreach ($droitArray AS $key => $item){
				$droitQuery ='INSERT INTO rh.emp_droit(id_autori_empl, date_autorisation, matricule) VALUES (?, CURRENT_TIMESTAMP,'. $Query[0]['matricule'].');';
				$this->userDB->query($droitQuery,array($item));
				if ($this->userDB->trans_status() === FALSE)
				{
					$correctQuery = false;
					break;
				}
				
			}
			if($correctQuery)
			{
				/****************************************************************************
			*				Envoi du mail avec password provisoire		       			*
			*																			*
			*****************************************************************************/
			$email = $Query[0]['email'];
			if($email!=''){

				$config = array(
   				 'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
   				 'smtp_host' => 'ssl://smtp.gmail.com', 
   				 'smtp_port' => 465,
   				 'smtp_user' => 'geosolutions.team',
   				 'smtp_pass' => 'hafid_1992',
    			'mailtype' => 'html', //plaintext 'text' mails or 'html'
    			'smtp_timeout' => '7', //in seconds
    			'charset' => 'utf-8',
    			'newline'=>"\r\n",
    			
    		);
				$this->load->library('email',$config);
				
				if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

					$this->email->from($config['smtp_user']);
					$this->email->to($email);
					$this->email->subject('REINITIALISATION MOT DE PASSE: ');
					$this->email->message('<h3 style="border-bottom:1px solid #ce0d20;width:180px;">'.$nameEntreprise.'</h3><p><h3>Bienvenue '.$Query[0]['prenom'].' '.$Query[0]['nom'].'</h3></p><p>Votre matricule :'.$Query[0]['char_mat'].'</p><p>Votre Mot de passe provisoire est "'.$rndomPassword.'"  vous serez invité à définir un nouveau mot de passe après la première connection</p>');
					if($this->email->send()){

						$mailSendedMessage='un Email contenant le mot de passe provisoire a été envoyé à la nouvel recru à l\'adresse '.$email;
						$Query[0]['msg']=$mailSendedMessage;
						$this->userDB->trans_commit();
						return $Query[0];

					}

					else {
						$mailSendedMessage= 'Erreur : Email  n\'a pas été envoyé';
						$this->userDB->trans_rollback();
						return $mailSendedMessage;
					}
				}
				else {
					throw new Exception($email." n'est pas une adresse email valide.");
					$this->userDB->trans_rollback();
					return $mailSendedMessage;
				}


			}

		}
		else
		{
			$this->userDB->trans_rollback();
			return false;
		}

	}



}
}
?>