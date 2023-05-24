<?php

class M_affaires extends CI_Model{
	private $userDB=null;
	function __construct() {
		parent::__construct();
		$this->userDB =$this->load->database('utilisateur',true);
	}
	
	function affairesList($matricule_createur)
	{
		$listaffairesQuery = "SELECT affaire.numero_affaire,id_contrat,libelle,date_creation,case when affaire.terminee='true' then 'Terminee' when (affaire.date_creation+ interval '1 day'*affaire.delai<current_date) then 'En souffrance'  else 'En cours' end as etat, c.avancement,
		(select CONCAT(nom,' ',prenom,' (',char_matricule,')') from rh.employee where numeric_matricule = matricule_responsable) as responsable FROM affaires.affaire LEFT JOIN (SELECT affaires.taches.numero_affaire, round(sum(affaires.taches.avancement::decimal*affaires.taches.delai)/sum(affaires.taches.delai),0) as avancement from affaires.taches where niveau=1 GROUP BY affaires.taches.numero_affaire  ) as c on affaire.numero_affaire=c.numero_affaire where affaire.creer_par=? and affaire.isdeleted=false ;";
	$rslt = $this->userDB->query($listaffairesQuery,array($matricule_createur));
	$data = array();

	foreach($rslt->result() as $r) {
		$myDateTime = new DateTime(html_escape($r->date_creation));
		
		$data[] = array(

			html_escape(str_replace($this->session->entreprise.'_pfx_','',$r->numero_affaire)),
			html_escape($r->libelle),
			html_escape($r->avancement)!=''?html_escape($r->avancement):'0',
			$myDateTime->format('d-m-Y'),
			html_escape($r->etat),
			$r->id_contrat!=''?str_replace($this->session->entreprise.'_pfx_','',$r->id_contrat):'-',
			'actions'
			
		);
	}

	$output = array(

		//"recordsTotal" => $rslt->num_rows(),
		//"recordsFiltered" => $rslt->num_rows(),
		"data" => $data
	);

	return $output;
}

/*function deleteAffaire($numero,$createur)
{
	$query ='UPDATE affaires.affaire SET isdeleted=true,date_delete=current_date WHERE numero_affaire= ? and creer_par=? ';
	$exec= $this->userDB->query($query,array($numero,$createur));
if($exec && $this->userDB->affected_rows()>0)
	return 1;
else
	return 0;
}*/
function deleteAffaire($numero,$createur)
{
	$query ='DELETE  from affaires.affaire  WHERE numero_affaire= ? and creer_par=? ';
	$exec= $this->userDB->query($query,array($numero,$createur));
if($exec && $this->userDB->affected_rows()>0)
	return 1;
else
	return 0;
}
function check_responsableMatricule($user_codeEtablissement,$entreprise,$matricule)
{
	$checkResponsableQuery = "WITH RECURSIVE tableR (code_etabli_mere, code_etablissement,libelle)
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
	SELECT char_matricule,numeric_matricule FROM tableR inner join rh.employee on tableR.code_etablissement=rh.employee.code_etablissement where char_matricule=? ";
	$rslt = $this->userDB->query($checkResponsableQuery,array($user_codeEtablissement,$entreprise,$matricule))->result_array();
	return $rslt;

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