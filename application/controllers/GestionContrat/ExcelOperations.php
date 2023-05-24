<?php
include ("phpSpreadSheet/vendor/autoload.php");
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class ExcelOperations extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		

		if (defined('BASEPATH') && $_SERVER['REQUEST_METHOD'] != "POST") 
			exit('<h1>No direct script access allowed<h2>');
		
	}
	function prixFromXls()
	{

		try {

			/****************************************************************************
			*								verification du fichier excel        			*
			*																			*
			*****************************************************************************/
			if (isset($_FILES['fileXls']['name'])  && !empty($_FILES['fileXls']['name'])) {
				$configPhotos['allowedMime'] = array('application/vnd.ms-excel','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				$configPhotos['max_size'] = 1.5*1024*1024;
				$file_info = finfo_open(FILEINFO_MIME_TYPE);
				$mime = finfo_file($file_info, $_FILES['fileXls']['tmp_name']);

				if (!in_array($mime,$configPhotos['allowedMime'])) {
					
					throw new Exception('Fichier non autorisé : ');
				}
				elseif ($_FILES['fileXls']['size']>$configPhotos['max_size']) {
					throw new Exception('Fichier dépassant 1.5 Mo : '.$_FILES['fileXls']['name']);
				}
				elseif (0 < $_FILES['fileXls']['error']) {
					throw new Exception('erreur de lecture' . $_FILES['fileXls']['error']);
				}
				
				$jsonData = $this->excelPrixToJson($_FILES['fileXls']['tmp_name']);
				echo $jsonData;
			}
			else
			{
				throw new Exception('Veuillez ajouter la fiche des Heures Sup');
			}

			
			
		} catch (Exception $e) {
			$message = $e->getMessage();
			http_response_code(400);
			die( $message );
		}

	}
	
	private function excelPrixToJson($file)
	{
		try {
			$firstRow = 2;
			$lastRow = 1500;
			$firstCol = 'A';
			$lastCol = 'E';
			$filterSubset = new MyReadFilter($firstRow,$lastRow,range($firstCol,$lastCol));
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			$reader->setReadDataOnly(true);
			$reader->setReadFilter($filterSubset);
			$spreadsheet = $reader->load($file);
			$worksheet = $spreadsheet->getActiveSheet();
		$highestRow = $worksheet->getHighestRow(); // e.g. 10
		$dtaArray = [];
		for ($row = $firstRow; $row <= $highestRow; ++$row) {
			if (is_numeric($worksheet->getCell('E' . $row)->getValue()) && is_numeric($worksheet->getCell('D' . $row)->getValue())) 
			{
				$unit = $worksheet->getCell('C' . $row)->getValue();
				$superscriptUnit = str_replace('3','³',$unit);
				$rowArray = array(
					'<input type ="text" class="tbl-numero-prix" value ="'.$worksheet->getCell('A' . $row)->getValue().'" style="outline: none;border:none;border-bottom:1px solid #2c5364;font-size:1.1em;color:gray;width:95%;">',
					'<input type ="text" class="tbl-libelle-prix" value ="'.$worksheet->getCell('B' . $row)->getValue().'" style="outline: none;border:none;border-bottom:1px solid #2c5364;font-size:1.1em;color:gray;width:95%;">',
					'<input type ="text" class="tbl-unite-prix" value ="'.$superscriptUnit.'" style="outline: none;border:none;border-bottom:1px solid #2c5364;font-size:1.1em;color:gray;width:95%;">',
					'<input type ="number" step="0.01" class="tbl-quantite-prix" value ="'.$worksheet->getCell('D' . $row)->getValue().'" style="outline: none;border:none;border-bottom:1px solid #2c5364;font-size:1.1em;color:gray;width:95%;">',
					'<input type ="number" step="0.01" class="tbl-pu-prix" value ="'.$worksheet->getCell('E' . $row)->getValue().'" style="outline: none;border:none;border-bottom:1px solid #2c5364;font-size:1.1em;color:gray;width:95%;">',
					'<input type ="number" class="tbl-total-prix" value ="'.$worksheet->getCell('E' . $row)->getValue()*$worksheet->getCell('D' . $row)->getValue().'" style="outline: none;border:none;border-bottom:1px solid #2c5364;font-size:1.1em;color:gray;width:95%;" readonly>',
					'<button type="button" class="btn btn-outline-danger btn-xs remove-prix" style="padding:0;border:none;"><i class="fas fa-trash"></i></button>'
				);
				$dtaArray[]=$rowArray;

			}
			else
			{
				throw new Exception("Valeurs invalides en ligne ".$row);
				
			}

		}
		return json_encode($dtaArray);


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