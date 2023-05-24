<?php

class M_entreprise extends CI_Model{
	private $userDB=null;
	function __construct() {
		parent::__construct();
		$this->userDB =$this->load->database('utilisateur',true);
	}
	function show($selectionString ='',$filter = array(),$forDatatable = false,$type="demandes")
	{
		if($selectionString !='')
			$this->userDB->select($selectionString);
		else
			$this->userDB->select('e.*,d.libelle, concat(emp.nom,\' \',emp.prenom) as directeur');
		$this->userDB->from('rh.entreprise e');
		$this->userDB->join('rh.employee as emp','e.id_directeur=emp.numeric_matricule','left');
		$this->userDB->join('rh.domaine_entreprise d','e.id_domaine=d.id','left');
		$this->userDB->where($filter);
		if(!$forDatatable)
			return $this->userDB->get()->result_array();
		else{
			$data = array();
			if($type=="demandes")
			{
				foreach($this->userDB->get()->result() as $r) {
					$myDateTime = new DateTime(html_escape($r->date_demande));
				
					$data[] = array(
			
						html_escape($r->numero),
						'<a href="#" class="avatar"><img alt="" src=""></a>',
						html_escape($r->nom),
						html_escape($r->tel),
						html_escape($r->mail),
						$myDateTime->format('d-m-Y'),
						html_escape($r->administrateur),
						html_escape($r->domaine),
						html_escape($r->ville),
						
						'<div class="dropdown dropdown-action"><a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a><div class="dropdown-menu dropdown-menu-right" ><a class="dropdown-item demande-detail" href="#">Détails</a><a class="dropdown-item demande-confirm" href="#">Confirmer </a><a class="dropdown-item demande-remove" href="#">Supprimer</a></div></div>'
						
					);
				}
			}
			else if($type=="listes")
			{
				foreach($this->userDB->get()->result() as $r) {
					
					$data[] = array(
			
						html_escape($r->numero),
						'<a href="#" class="avatar"><img alt="" src=""></a>',
						html_escape($r->nom),
						html_escape($r->tel),
						html_escape($r->mail),
						html_escape($r->administrateur),
						html_escape($r->active),
						''
						
						
					);
				}
			}
			$output = array(
		
				//"recordsTotal" => $rslt->num_rows(),
				//"recordsFiltered" => $rslt->num_rows(),
				"data" => $data
			);
			return $output;
			}
		/*$query="SELECT e.*,d.libelle as domaine,concat(emp.nom,' ',emp.prenom) as directeur from rh.entreprise e 
		LEFT JOIN rh.employee as emp on e.id_directeur=emp.numeric_matricule 
		LEFT JOIN rh.domaine_entreprise d on e.id_domaine=d.id ";
		//$this->userDB->where($filter);
		return $this->userDB->where(array('confirmed'=>'true'))->query($query)->result_array();*/
	}
	function entrepriseData($entreprise)
	{
		$query="SELECT e.*,d.libelle as domaine,concat(emp.nom,' ',emp.prenom) as directeur,co.conge_annee, co.created_at, to_char(co.heure_debut_travail,'HH24:MI') as hdebut, to_char(co.heure_fin_travail,'HH24:MI') as hfin, co.jour_semaine as jsemaine from rh.entreprise e 
		LEFT JOIN rh.employee as emp on e.id_directeur=emp.numeric_matricule 
		LEFT JOIN rh.domaine_entreprise d on e.id_domaine=d.id 
		LEFT JOIN rh.entrepriseconfig co on e.numero = co.id_entreprise
		where numero= ? ORDER BY co.created_at DESC LIMIT 1;";
		return $this->userDB->query($query,array($entreprise))->result_array()[0];
	}
	function updateConfig($dta)
	{
		$this->userDB->insert('rh.entrepriseconfig',$dta);
		if ($this->userDB->affected_rows()>0)
		{
			$q ='update rh.employee set conge_annee = ? where code_etablissement 
IN  (select code_etablissement from rh.etablissement where id_entreprise = ?)';
			$this->userDB->query($q,array($dta['conge_annee'],$dta['id_entreprise']));
			
			return true;
		}
		return false;
	}
	function updateField($entreprise,$val,$attr)
	{
		$query = "Update rh.entreprise set ".$attr."=? where numero = ?";
		$updateQUery = $this->userDB->query($query,array($val,$entreprise));
		if($updateQUery !== FALSE){
			return 1;
		}
		else
		{

			return 0;
		}
	}
	function loadDomaines()
	{
		$query='SELECT id as code,libelle FROM rh.domaine_entreprise ;';
		return $this->userDB->query($query)->result_array();
	}
	function entrepriseFolder($entreprise)
	{
		$query='SELECT dossier FROM rh.entreprise ;';
		return $this->userDB->query($query)->result_array()[0]['dossier'];
	}
	function entrepriseListeVille()
	{
		

		return $this->userDB->query('select nom_ville as ville from rh.ville order by ville asc')->result_array();
	}
	function addEntreprise($entrepriseArray,$directeurArray,$classArray,$rndomPassword)
	{
		$queryEntreprise = 'INSERT INTO rh.entreprise(nom,adresse, tel, mail, fax, ice, id_domaine,ville,date_creation) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?) ON CONFLICT (mail) DO NOTHING returning numero;';

		$Etablissementquery = "INSERT INTO rh.etablissement(id_niveau,id_entreprise,id_type, libelle, date_creation,visible)
		VALUES (1,?,'DG','Direction générale', CURRENT_TIMESTAMP,'true') returning code_etablissement";
		$classeQuery = "INSERT INTO rh.classe(libelle,id_entreprise,visible)VALUES ('Directeur Général',?,false) returning id_classe;"; 
		$fonctionQuery = "INSERT INTO rh.fonction(id_classe, id_type_fon, libelle, date_creation,visible,is_directeur) VALUES ( ?,4,'Directeur Général', CURRENT_TIMESTAMP,false,true) returning id_fonction";
		$employeQuery = 'INSERT INTO rh.employee ("nom","prenom","email","telephone","date_recrutement","emp_password","conge_annee","reliquat_conge","code_etablissement","id_fonction","first_password","is_directeur") VALUES (?,?,?,?,?,?,?,0,?,?,true,true) returning numeric_matricule,emp_password,char_matricule' ;
		$droitQuery ="INSERT INTO rh.emp_droit(id_autori_empl, date_autorisation, matricule) VALUES ('GAFF', CURRENT_TIMESTAMP,?),('GRH', CURRENT_TIMESTAMP,?),('GCONTRAT', CURRENT_TIMESTAMP,?);";
		$updateEtablissement = "update rh.entreprise set id_directeur =? where numero=?;";
		$this->userDB->trans_begin();
		$QueryEn=$this->userDB->query($queryEntreprise,$entrepriseArray)->result_array();
		if(!$QueryEn)
		{
			$this->userDB->trans_rollback();
			if ($this->userDB->affected_rows()<1)
		{
			return 'Email "'.$entrepriseArray['mail'].'" est déja utilisé';
		}
			else return false;
		}
		
		else
		{
			$QueryET=$this->userDB->query($Etablissementquery,array($QueryEn[0]['numero']))->result_array();
			if(!$QueryET)
			{
				$this->userDB->trans_rollback();
				return false;
			}
			else
			{
				$classArray['entreprise']=$QueryEn[0]['numero'];
				$QueryCL=$this->userDB->query($classeQuery,$classArray)->result_array();
				if(!$QueryCL)
				{
					$this->userDB->trans_rollback();
					return false;
				}
				else
				{

					$QueryFN=$this->userDB->query($fonctionQuery,array($QueryCL[0]['id_classe']))->result_array();
					if(!$QueryFN)
					{
						$this->userDB->trans_rollback();
						return false;
					}
					else
					{
						$directeurArray['code_etablissement']=$QueryET[0]['code_etablissement'];
						$directeurArray['id_fonction']=$QueryFN[0]['id_fonction'];
						$QueryEMP=$this->userDB->query($employeQuery,$directeurArray)->result_array();
						if(!$QueryEMP)
						{
							$this->userDB->trans_rollback();
							return false;
						}
						else
						{

							$QueryDR=$this->userDB->query($droitQuery,array($QueryEMP[0]['numeric_matricule'],$QueryEMP[0]['numeric_matricule'],$QueryEMP[0]['numeric_matricule']));
							if(!$QueryDR)
							{
								$this->userDB->trans_rollback();
								return false;
							}
							else
							{
								$Queryupdate=$this->userDB->query($updateEtablissement,array($QueryEMP[0]['numeric_matricule'],$QueryEn[0]['numero']));
								if(!$Queryupdate)
								{
									$this->userDB->trans_rollback();
									return false;
								}

								else
								{

			/****************************************************************************
			*				Envoi du mail avec password provisoire		       			*
			*																			*
			*****************************************************************************/
			$email = $directeurArray['email'];
			if($email!=''){

				$config = array(
   				 'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
   				 'smtp_host' => 'mail.futureambition.net', 
   				 'smtp_port' => 465,
   				 'smtp_user' => 'geosoffice-team@futureambition.net',
   				 'smtp_pass' => 'hafid_1992',
    			// 'mailtype' => 'html', //plaintext 'text' mails or 'html'
    			// 'smtp_timeout' => '7', //in seconds
    			// 'charset' => 'utf-8',
    			// 'newline'=>"\r\n",
    			
    		);
			
    $config['smtp_crypto']  = 'ssl';
    $config['smtp_timeout'] = "7";
    $config['mailtype']     = "html";
    $config['charset']      = "iso-8859-1";
    $config['newline']      = "\r\n";
    $config['wordwrap']     = TRUE;
    $config['validate']     = FALSE;
				$this->load->library('email',$config);
				
				if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

					$this->email->from($config['smtp_user']);
					$this->email->to($email);
					$this->email->subject('Inscription SmartDesk: ');
					$this->email->message('<p><h3>Bienvenue '.$directeurArray['prenom'].' '.$directeurArray['nom'].'</h3>
						<p>Le compte de votre entreprise '.$entrepriseArray['nom'].' vient d\'être créé sous le numéro '.$QueryEn[0]['numero'].'</p>
						</p><p>Votre matricule :'.$QueryEMP[0]['char_matricule'].'</p><p>Votre Mot de passe provisoire est : '.$rndomPassword.'  , vous serez invité à définir un nouveau mot de passe après la première connection</p>');
					if($this->email->send()){

						$mailSendedMessage='un Email contenant votre matricule et mot de passe provisoire vous a été envoyé à l\'adresse '.$email;
						$this->userDB->trans_commit();
						$QueryEMP[0]['id_entreprise']=$QueryEn[0]['numero'];
						$QueryEMP[0]['msg']=$mailSendedMessage;
						return $QueryEMP[0];

					}

					else {
						$mailSendedMessage= $this->email->print_debugger();
						$this->userDB->trans_rollback();
						return $mailSendedMessage;
					}
				}
				else {
					$mailSendedMessage= 'Erreur : Email contenant mot de passe n\'a pas été envoyé';
					$this->userDB->trans_rollback();
					return $mailSendedMessage;
				}


			}


		}


	}
}

}

}

}
}

}
}
?>