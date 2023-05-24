<?php

class M_documents extends CI_Model{
	private $userDB=null;
	function __construct() {
		parent::__construct();
		$this->userDB =$this->load->database('utilisateur',true);
	}
	function M_getDocuments($dtaArray)
	{
		$Query = "SELECT numero_affaire,libelle_dossier,id_tache as code,matricule as responsable,matricule_createur as createur from affaires.taches   where affaires.taches.numero_affaire =? and affaires.taches.niveau=1 and matricule_createur=?;";
		$rslt = $this->userDB->query($Query,$dtaArray)->result_array();
		
		$dtaString = array();
		for ($i=0; $i <count($rslt) ; $i++) { 
			
			array_push($dtaString,array('id'=>$rslt[$i]['code'],'text' =>$rslt[$i]['libelle_dossier'],'data'=>array('affaire'=>$rslt[$i]['numero_affaire'],'createur'=>$rslt[$i]['createur'],'responsable'=>$rslt[$i]['responsable'])));
			
		}
		
		return $dtaString;
	}
	

}
?>