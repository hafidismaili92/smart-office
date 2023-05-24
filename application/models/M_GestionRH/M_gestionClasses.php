<?php

class M_gestionClasses extends CI_Model{
	private $userDB=null;
	function __construct() {
		parent::__construct();
		$this->userDB =$this->load->database('utilisateur',true);
	}

	
	function insertClasse($dtaArray)
	{
		$Cquery = "INSERT INTO rh.classe(libelle, salaire_base,id_entreprise)VALUES (?, ?,?);";
		$addClasseQUery = $this->userDB->query($Cquery,$dtaArray);
	if($addClasseQUery !== FALSE && $this->userDB->affected_rows() == 1){
			return 1;
		}
		else
		{
			return 0;
		}
	}
	function checkValideClasse($classe,$entreprise)
	{
		$query = "select * from rh.classe where id_classe=? and id_entreprise =? and visible=true;";
		$rslt = $this->userDB->query($query,array($classe,$entreprise))->result_array();
		if(count($rslt)>0)
		{
			return $rslt[0];
		}
		else
		{
			return 0;
		}
	}
	function classeList($entreprise)
	{
		$listClassesQuery = 'SELECT id_classe, libelle, salaire_base FROM rh.classe where rh.classe.id_entreprise= ? and rh.classe.visible=true;';
		$rslt = $this->userDB->query($listClassesQuery,array($entreprise));
		$data = array();

          foreach($rslt->result() as $r) {
          	
               $data[] = array(
              
                    html_escape($r->id_classe),
                    html_escape($r->libelle),
                    html_escape($r->salaire_base),
                    'action'
               );
          }

          $output = array(
               
                 "recordsTotal" => $rslt->num_rows(),
                 "recordsFiltered" => $rslt->num_rows(),
                 "data" => $data
            );
          
  return $output;
	}
	function hideClasse($code,$identreprise)
	{
	$query ='update rh.classe set visible=false where id_classe=? and id_entreprise=? ';
	$exec= $this->userDB->query($query,array($code,$identreprise));
if($exec && $this->userDB->affected_rows()>0)
	return 1;
else
	return 0;
	}
}
?>