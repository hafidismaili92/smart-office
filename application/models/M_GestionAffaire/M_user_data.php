<?php
/**
 * 
 */
class M_user_data extends CI_model
{
	private $userDB=null;
	function __construct() {
		parent::__construct();
		$this->userDB =$this->load->database('utilisateur',true);
	}

	function employeeData($etablissement,$matricule,$entreprise)
	{
		$checkEmployee = "WITH RECURSIVE tableR (code_etabli_mere, code_etablissement,libelle)
	AS
	(
	SELECT frst.code_etabli_mere, frst.code_etablissement, frst.libelle
	FROM rh.etablissement AS frst   
	WHERE code_etablissement = ? and id_entreprise=?
	UNION all
	SELECT secnd.code_etabli_mere, secnd.code_etablissement, secnd.libelle
	FROM rh.etablissement AS secnd
	INNER JOIN tableR AS d
	ON secnd.code_etablissement = d.code_etabli_mere
	)
	
SELECT etablissementData.etabli_libelle,etablissementData.code_etablissement as code_etabli,fonctionData.fonction_libelle,fonctionData.classe_libelle,hierarchie.herar_string,char_matricule as matricule,numeric_matricule as num_matricule, CONCAT(nom,' ',prenom) as nom_complet,lien_photo as photo from rh.employee 
LEFT JOIN (select max(tableR.code_etablissement) as code,string_agg(libelle, '&&' ORDER BY tableR.code_etablissement) as herar_string from tableR) as hierarchie on rh.employee.code_etablissement=hierarchie.code
LEFT JOIN (SELECT id_fonction, rh.fonction.libelle as fonction_libelle,rh.classe.libelle as classe_libelle FROM rh.fonction LEFT JOIN rh.classe on rh.fonction.id_classe = classe.id_classe ) as fonctionData on rh.employee.id_fonction=fonctionData.id_fonction
LEFT JOIN (SELECT code_etablissement,libelle as etabli_libelle FROM rh.etablissement) as etablissementData on rh.employee.code_etablissement= etablissementData.code_etablissement
where numeric_matricule=?; ";
		$rslt = $this->userDB->query($checkEmployee,array($etablissement,$entreprise,$matricule))->result_array();
		if(count($rslt)>0)
		{
			return $rslt[0];
		}
		else
		{
			return 0;
		}
	}
	

}
?>