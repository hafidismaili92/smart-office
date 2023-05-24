<?php
class M_Attachements extends CI_Model
{
	private $userDB=null;
	function __construct() {
		parent::__construct();
		$this->userDB =$this->load->database('utilisateur',true);
	}
	function insertAttachements($dta)
	{
		$query ="INSERT INTO geobusiness.attachement(nom,extension,crypted_name,filekey,idgeoaffaire,date_creation) VALUES (?, ?, ?, ?, ?,CURRENT_DATE) returning nom,extension,crypted_name,filekey;";
		$executeQuery = $this->userDB->query($query,$dta);
		if($executeQuery && $this->userDB->affected_rows()>0)
			return $executeQuery->result_array()[0];
		else
			return 0;
	}
	function loadAttachements($dta,$isForDatatable=false,$filterImg=false)
	{
		$ImageCondition = $filterImg?"and extension in('png','jpeg','jpg','tiff','ico','gif')":"";
		$query = "SELECT id_attach as numero, b.nom as nom, filekey as key,extension from geobusiness.geobusiness a 
		LEFT JOIN geobusiness.attachement b on a.idgeoaffaire =b.idgeoaffaire 
		WHERE a.creerpar=? and a.idgeoaffaire=? and a.nom = ? ".$ImageCondition." order by numero desc";
		$rslt = $this->userDB->query($query,$dta);
		if($isForDatatable)
		{
			$data = array();
			foreach($rslt->result() as $r) {
				$data[] = array(
					html_escape($r->numero),
					html_escape($r->extension),
					html_escape($r->nom),
					html_escape($r->key)==''?'<i class="fas fa-question-circle" style="color: #1212131a;"></i>':'<a href="Attachements/downloadAttachement?file='.$r->key.'&a='.$r->numero.'"><i class="fas fa-download" style="color: #0e96ca;cursor:pointer;"></i></a>'
				);
			}
			$output = array(
				"data" => $data
			);
			return $output;
		}
		else
		{
			return $rslt->result_array();
		}
	}
	function getAttachementsImage($dta)
	{
		$query = "SELECT crypted_name,b.idgeoaffaire,creerpar,b.nom  from geobusiness.geobusiness a LEFT JOIN geobusiness.attachement b on a.idgeoaffaire =b.idgeoaffaire 
		WHERE a.creerpar=? and filekey=? and id_attach=?";
		$rslt = $this->userDB->query($query,$dta);
		if($rslt && count($rslt->result_array())>0)
		{
			return $rslt->result_array()[0];
		}
		else
		{
			
			return 0;
		}
	}
	function getAllAtachements($dta)
	{
		$query = "SELECT crypted_name,b.nom,a.creerpar,b.idgeoaffaire,a.nom as affnom  from geobusiness.geobusiness a LEFT JOIN geobusiness.attachement b on a.idgeoaffaire =b.idgeoaffaire 
		WHERE a.creerpar=? and a.idgeoaffaire=? and a.nom=?";
		$rslt = $this->userDB->query($query,$dta);
		if($rslt && count($rslt->result_array())>0)
		{
			return $rslt->result_array();
		}
		else
		{
			
			return 0;
		}
	}
}
?>