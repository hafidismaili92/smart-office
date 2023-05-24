<?php
include ("phpSpreadSheet/vendor/autoload.php");
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class R extends CI_Controller
{
	
	function __construct()
  {
    parent::__construct();
    $this->load->model('M_GestionContrat/M_listeFactures','listeFactures');
    $this->load->model('M_GestionContrat/M_dashboard','dashboard');
    $this->load->model('M_GestionRH/M_gestionFonctions','gestionFonctions');
    
  }
  
  function currentYear_conge()
  {
    try {
      $matricule = '1114B';
      $matriculeData = $this->employes->employee($matricule);
      $numMatricule=0;
      if(is_array($matriculeData))
      {
        $numMatricule = $matriculeData[0]['num_matricule'];
      }
      else
      {
        throw new Exception("matricule invalide");
        
      }
      $rslt = $this->gestionConge->congeList($numMatricule);
      echo json_encode($rslt);
    } catch (Exception $e) {

      $message = $e->getMessage();
      http_response_code(400);
      die( $message );
      
    }
  }
  function index()
  {
   try {

     
      $periode = 'five-year';
      switch ($periode) {
        case "current-year":
          $monthOrYear='Month';
          $yearsNombre=1;
          break;
        case "five-year":
          $monthOrYear='Year';
          $yearsNombre=5;
          break;
        case "teen-year":
          $monthOrYear='Year';
          $yearsNombre=10;
          break;
        
      }
      $rsltParSecteur = $this->dashboard->contratsparSecteur($this->session->entreprise,$monthOrYear,$yearsNombre);
      $rsltParEtat= $this->dashboard->contratparEtat($this->session->entreprise,$yearsNombre);
      $rsltParMontant= $this->dashboard->contratsparMontant($this->session->entreprise,$monthOrYear,$yearsNombre);
      echo json_encode(array('parMontant'=>$rsltParMontant)); 
   
    
      
    } catch (Exception $e) {
      $message = $e->getMessage();
      http_response_code(400);
      die( $message );
    }
  
}
}
/**  Define a Read Filter class implementing \PhpOffice\PhpSpreadsheet\Reader\IReadFilter  */
class MyReadFilter implements \PhpOffice\PhpSpreadsheet\Reader\IReadFilter
{

  private $startRow = 0;
  private $endRow   = 0;
  private $columns  = [];

  /**  Get the list of rows and columns to read  */
  public function __construct($startRow, $endRow, $columns) {
    $this->startRow = $startRow;
    $this->endRow   = $endRow;
    $this->columns  = $columns;
  }

  public function readCell($column, $row, $worksheetName = '') {
        //  Only read the rows and columns that were configured
    if ($row >= $this->startRow && $row <= $this->endRow) {
      if (in_array($column,$this->columns)) {
        return true;
      }
    }
    return false;
  }
}
?>