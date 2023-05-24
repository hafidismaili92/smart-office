<?php

class M_clients extends CI_Model{
	private $userDB=null;
	function __construct() {
		parent::__construct();
		$this->userDB =$this->load->database('utilisateur',true);
	}
	function clientsList()
	{
		$listClientQuery = 'SELECT libelle, adresse, tel, mail, fax, identifiant, representant FROM affaires.client;';
		$rslt = $this->userDB->query($listClientQuery);
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
               );
          }

          $output = array(
               
                 "recordsTotal" => $rslt->num_rows(),
                 "recordsFiltered" => $rslt->num_rows(),
                 "data" => $data
            );
          
  return $output;
	}
function insertClient($dtaArray)
{
	$querystring = 'INSERT INTO affaires.client(libelle, adresse, tel, mail, fax, identifiant, representant)SELECT ?,?,?,?,?,?,? WHERE NOT EXISTS (SELECT identifiant FROM affaires.client WHERE identifiant=? LIMIT 1)';
	$addclientQUery = $this->userDB->query($querystring,$dtaArray);
	if($addclientQUery !== FALSE && $this->userDB->affected_rows() == 1){
			return 1;
		}
		else
		{
			return 0;
		}
}
}
?>