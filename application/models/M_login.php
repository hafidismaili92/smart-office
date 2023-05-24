<?php
/**
 * 
 */
class M_login extends CI_model
{
	
	function __construct()
	{
		parent::__construct();
		$this->userDB =$this->load->database('utilisateur',true);
	}
	function adminLogin($matricule,$password)
	{
		$adminDataQuery = 'select  * from public.systemadmin where nom=?';
		$Query=$this->userDB->query($adminDataQuery,array($matricule))->result_array();
		if(!$Query)
		{
			return false;
		}
		
		else
		{
			if(!password_verify($password,$Query[0]['password']) )
			{
				return false;
			}
			else
			{
				
					return $Query[0];
				
			}
			
			
		}
	}
	function userLogin($matricule,$password)
	{

		$userDataQuery = 'select rh.employee.nom,prenom,char_matricule,id_entreprise as entreprise,email,numeric_matricule,first_password,emp_password,rh.employee.code_etablissement as code_etablissement,rh.etablissement.libelle as libelle_etabli,rh.fonction.libelle as libelle_fonction,rh.employee.id_fonction as id_fonction, (select numero_affaire from affaires.affaire where creer_par=(select numeric_matricule from rh.employee where char_matricule=?) order by date_creation desc limit 1  ) as numero_affaire,ent.confirmed,ent.active from rh.employee 
		LEFT JOIN rh.fonction on rh.fonction.id_fonction=rh.employee.id_fonction 
		LEFT JOIN rh.etablissement on rh.etablissement.code_etablissement=rh.employee.code_etablissement 
		LEFT JOIN rh.entreprise ent on rh.etablissement.id_entreprise = ent.numero
		where char_matricule=?';
		$Query=$this->userDB->query($userDataQuery,array($matricule,$matricule))->result_array();
		if(!$Query)
		{
			return false;
		}
		
		else
		{
			if(!password_verify($password,$Query[0]['emp_password']) )
			{
				return false;
			}
			else
			{
				if ($Query[0]['first_password']=='t') {
					$resetPassword = true;
					return $resetPassword;
				} else {
					return $Query[0];
				}
			}
			
			//return $Query[0];
		}
		
	}
	function verifierDroit($matricule)
	{
		$verificationQuery = 'SELECT id_autori_empl as droit FROM rh.emp_droit WHERE matricule=?;';
		$verifResult = $this->userDB->query($verificationQuery,array($matricule))->result();
		$droitArray=array();
		foreach($verifResult as $r) {
			$droitArray[]=$r->droit;
		}
		return $droitArray;
	}
	function verifierAdmin($matricule)
	{
		$verificationQuery = 'SELECT Cast(is_admin as integer) as is_admin  FROM rh.employee WHERE numeric_matricule=?;';
		$verifResult = $this->userDB->query($verificationQuery,array($matricule))->result_array();
		
		return $verifResult[0]['is_admin'];
	}
	function userResetPassword($matricule,$oldPassword,$newPassword)
	{
		$userDataQuery = 'select emp_password from rh.employee where char_matricule=?';
		$Query=$this->userDB->query($userDataQuery,array($matricule))->result_array();
		if(!$Query)
		{
			return 'une erreur produite!';
		}
		else
		{
			if(!password_verify($oldPassword,$Query[0]['emp_password']) )
			{
				return 'Mot de passe incorrect!';
			}
			else
			{
				$userUpdateQuery = 'UPDATE rh.employee SET emp_password=?, first_password=false WHERE char_matricule=? RETURNING emp_password as password;';

				$this->userDB->trans_begin();
				$Query=$this->userDB->query($userUpdateQuery,array($newPassword,$matricule))->result_array();
				if(count($Query)<=0 || $this->userDB->trans_status() === FALSE)
				{
					$this->userDB->trans_rollback();
					return 'une erreur produite!';

				}
				
				else
				{
					$userDataQuery = 'select nom,prenom,char_matricule,id_entreprise as entreprise,email,numeric_matricule,emp_password,rh.employee.code_etablissement as code_etablissement,rh.etablissement.libelle as libelle_etabli,rh.fonction.libelle as libelle_fonction,rh.employee.id_fonction as id_fonction, (select numero_affaire from affaires.affaire where creer_par=(select numeric_matricule from rh.employee where char_matricule=?) order by date_creation desc limit 1  ) as numero_affaire from rh.employee LEFT JOIN rh.fonction on rh.fonction.id_fonction=rh.employee.id_fonction LEFT JOIN rh.etablissement on rh.etablissement.code_etablissement=rh.employee.code_etablissement where char_matricule=? and emp_password=?';
					$QuerySelect=$this->userDB->query($userDataQuery,array($matricule,$matricule,$Query[0]['password']))->result_array();
					if(!$QuerySelect)
					{
						$this->userDB->trans_rollback();
						return 'une erreur produite!';
					}

					else
					{
						$this->userDB->trans_commit();
						return $QuerySelect[0];
						
						
					}
					

				}

			}
			
			//return $Query[0];
		}
	}
}
?>