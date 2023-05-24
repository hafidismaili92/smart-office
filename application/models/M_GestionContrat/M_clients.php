<?php

class M_clients extends CI_Model{
	private $userDB=null;
	function __construct() {
		parent::__construct();
		$this->userDB =$this->load->database('utilisateur',true);
	}
	function clientsList($entreprise,$todatatable=true)
	{
		$listClientQuery = "SELECT libelle, adresse, tel, mail, fax,ice, identifiant, representant,to_char(date_ajout,'dd-mm-yyyy') as date_ajout FROM contrats.client where contrats.client.id_entreprise=? order by date_ajout desc;";
		$rslt = $this->userDB->query($listClientQuery,array($entreprise));
		if($todatatable)
		{
			
		$data = array();

          foreach($rslt->result() as $r) {

               $data[] = array(
              
                    html_escape($r->identifiant),
                    html_escape($r->libelle),
                    html_escape($r->tel),
                    html_escape($r->fax),
                    html_escape($r->mail),
                    html_escape($r->representant),
                  	html_escape($r->adresse),
                  	html_escape($r->ice),
                  	html_escape($r->date_ajout),
                  	'<i class="fa fa-edit client-actions client-actions-edit " style="color:#197f96"></i>',
                  	
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
function insertClient($dtaArray)
{
	$querystring = 'INSERT INTO contrats.client(libelle, adresse, tel, mail, fax, identifiant, representant,ice,date_ajout,id_entreprise) SELECT ?,?,?,?,?,?,?,?,?,? WHERE NOT EXISTS (SELECT identifiant FROM contrats.client WHERE identifiant=? and id_entreprise='.$dtaArray[9].' LIMIT 1)';
	$addclientQUery = $this->userDB->query($querystring,$dtaArray);
	if($addclientQUery !== FALSE && $this->userDB->affected_rows() == 1){
			return 1;
		}
		else
		{
			return 0;
		}
}
function editClient($dta)
{
	$q = "UPDATE contrats.client SET libelle=?, adresse=?, tel=?, mail=?, fax=?, identifiant=?, representant=?, ice=? WHERE id_entreprise=? and identifiant=?;";
	$EditClientquery = $this->userDB->query($q,$dta);
		if($EditClientquery !== FALSE){
			return 1;
		}
		else
		{
			return 0;
		}
}
}
?>