<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Shapefile\Shapefile;
use Shapefile\ShapefileException;
use Shapefile\ShapefileWriter;
use Shapefile\Geometry\Point;
use Shapefile\Geometry\Polygon;
use Shapefile\Geometry\LineString;
class EditGeoBusiness extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_Geobusiness/M_EditGeoBusiness','EditGeoBusiness');
		$this->load->library('form_validation');
	}
	function insertAffaire()
	{
		try {
			$this->form_validation->set_data($_POST);
			if($this->form_validation->run('ajouterGeoAffaire')== FALSE)
			{
				throw new Exception(validation_errors());
			}
			$dtaFields = $this->input->post('fields', TRUE);
			$dtaGeocomposantes = $this->input->post('geocomposantes', TRUE);
			if( !empty($dtaFields))
			{
				if($this->array_has_dupes($dtaFields))
					throw new Exception("un nom de champs est dupliqué! ");
				if(in_array('UniqueID',$dtaFields))
					throw new Exception("'UniqueID' est un mot reservé");
			}
			$dtaAffaire= array(
				pg_escape_string($this->input->post('affName', TRUE)),
				pg_escape_string($this->input->post('srid', TRUE)),
				pg_escape_string($this->input->post('geomType', TRUE)),
				$this->session->numeric_matricule,
			);
			$rslt = $this->EditGeoBusiness->insertNewAffaire($dtaAffaire,$dtaFields,$dtaGeocomposantes);
				/****************************************************************************
			*								creation du dossier de l'affaire     			*
			*																			*
			*****************************************************************************/
			if(!is_array($rslt)) 
				throw new Exception($rslt);
			else
			{
				$newAffaireId = $rslt[0]['idgeoaffaire'];
			mkdir($this->folderPath.'entreprises/'.$this->session->entreprise.'/geoBusiness/'.$this->session->numeric_matricule.'/'.$newAffaireId,0777, true);
			mkdir($this->folderPath.'entreprises/'.$this->session->entreprise.'/geoBusiness/'.$this->session->numeric_matricule.'/'.$newAffaireId.'/attachements',0777, true);
			echo $rslt[0]['idgeoaffaire'];
			}
			
		} catch (Exception $e) {
			$message = $e->getMessage();
			http_response_code(400);
			die( $message );
		}
	}
	function  load_GeoAffaires(){
		$dta = array($this->session->numeric_matricule);
		$rslt = $this->EditGeoBusiness->loadGeoAffaires($dta);
		echo json_encode($rslt);
	}
	function array_has_dupes($array) {
		return count($array) !== count(array_unique($array));
	}
	function setStyle()
	{
		try {
			$this->form_validation->set_data($_POST);
			$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
			if($this->form_validation->run('setStyle')== FALSE)
			{
				throw new Exception(validation_errors());
			}
			$idgeoaffaire = pg_escape_string($this->input->post('affaire', TRUE));
			$fill = pg_escape_string($this->input->post('style-fill', TRUE));
			$strokec = pg_escape_string($this->input->post('style-strokecolor', TRUE)); 
			$strokew = pg_escape_string($this->input->post('style-strokewidth', TRUE));
			if(!isset($_POST['affaire']) || !is_numeric($idgeoaffaire) || empty($idgeoaffaire) || strlen($idgeoaffaire)>50)
			{
				return;
			}
			$user = $this->session->numeric_matricule;
			$rslt = $this->EditGeoBusiness->setStyle(array($fill,$strokec,$strokew,$idgeoaffaire,$user));
			if(is_array($rslt)) echo json_encode($rslt);	
			else echo 0;
		} catch (Exception $e) {
			$message = $e->getMessage();
			http_response_code(400);
			die( $message );
		}
	}
	function export_Geoaffaire()
	{
		try {
			$this->load->model('M_Geobusiness/M_Composantes','Composantes');
			$this->load->helper('download');
			$this->form_validation->set_data($_GET);
			$this->form_validation->set_error_delimiters('<p>', '</p>');
			if($this->form_validation->run('exportAffaire')== FALSE)
			{
				throw new Exception(validation_errors());
			}
			$format = pg_escape_string($this->input->get('format', TRUE));
			$geoaffaire = pg_escape_string($this->input->get('geoaffaire', TRUE));
			$idaffaire = pg_escape_string($this->input->get('id', TRUE));
			$dta = array($this->session->numeric_matricule,$idaffaire,$geoaffaire);
			$affaireDta = $this->EditGeoBusiness->getGeoaffaire($dta);
			if($affaireDta ==0) throw new Exception("Affaire invalide");
			$attributeTable = $this->Composantes->getAttributeTable($dta);
			$geoComposantesInfo = $this->Composantes->getGeoComposantesInfo($dta);
			switch ($format) {
				case 'excel':
				$this->exportToExcel($affaireDta,$attributeTable,$geoComposantesInfo);
				break;
				case 'shp':
				$this->exportToShp($affaireDta,$attributeTable,$geoComposantesInfo);
				break;
			}
			
		} catch (Exception $e) {
			$message = $e->getMessage();
			http_response_code(400);
			die( $message );
		}
	}
	function exportToShp($affaireDta,$attributeTable,$geoComposantesInfo)
	{
		
		if(is_array($attributeTable) && is_array($geoComposantesInfo) && count($attributeTable)==count($geoComposantesInfo))
		{
			$fileDistination = time().'_shp';
			if(!is_dir('filesDownload/shp/'.$fileDistination)) mkdir('filesDownload/shp/'.$fileDistination);
			$Shapefile = new ShapefileWriter('filesDownload/shp/'.$fileDistination.'/'.$affaireDta['nom'].'.shp', [

				Shapefile::OPTION_EXISTING_FILES_MODE       => Shapefile::MODE_OVERWRITE,
			]);
			$countComp = count($geoComposantesInfo);
			$geomColumnsHeader = [];
			$geomtype = $geoComposantesInfo[0]['geomtype'];
			switch ($geomtype) {
				case 'Polygon':
				$Shapefile->setShapeType(Shapefile::SHAPE_TYPE_POLYGON);
				break;
				case 'LineString':
				$Shapefile->setShapeType(Shapefile::SHAPE_TYPE_POLYLINE);
				break;
				default:
				$Shapefile->setShapeType(Shapefile::SHAPE_TYPE_POINT);
				break;
			};
			$headers = array_keys(json_decode($attributeTable[0]['attributes'],true));
			foreach ($headers as $value) {
				$Shapefile->addCharField($value,55);
			}
			
			for ($i=0;$i<$countComp;$i++)
			{
				$geomString = $geoComposantesInfo[$i]['coord'];
				switch ($geomtype) {
					case 'Polygon':
					$geom = new Polygon();
					$geomString = 'POLYGON(('.$geomString.'))';
					break;
					case 'LineString':
					$geom = new LineString();
					$geomString = 'LINESTRING('.$geomString.')';
					break;
					default:
					$geom = new Point();
					$geomString = 'POINT('.$geomString.')';
					break;
				};
				$geom->initFromWKT($geomString);
				$geom->setDataArray(json_decode($attributeTable[$i]['attributes'],true));
				$Shapefile->writeRecord($geom);
			}
			
			$projection = array(
				'26191'=>'PROJCS["Merchich_Nord_Maroc",GEOGCS["GCS_Merchich",DATUM["D_Merchich",SPHEROID["Clarke_1880_IGN",6378249.2,293.46602]],PRIMEM["Greenwich",0],UNIT["Degree",0.017453292519943295]],PROJECTION["Lambert_Conformal_Conic"],PARAMETER["latitude_of_origin",33.3],PARAMETER["central_meridian",-5.4],PARAMETER["scale_factor",0.999625769],PARAMETER["false_easting",500000],PARAMETER["false_northing",300000],UNIT["Meter",1],PARAMETER["standard_parallel_1",33.3]]',
				'26192'=>'PROJCS["Merchich_Sud_Maroc",GEOGCS["GCS_Merchich",DATUM["D_Merchich",SPHEROID["Clarke_1880_IGN",6378249.2,293.46602]],PRIMEM["Greenwich",0],UNIT["Degree",0.017453292519943295]],PROJECTION["Lambert_Conformal_Conic"],PARAMETER["latitude_of_origin",29.7],PARAMETER["central_meridian",-5.4],PARAMETER["scale_factor",0.999615596],PARAMETER["false_easting",500000],PARAMETER["false_northing",300000],UNIT["Meter",1],PARAMETER["standard_parallel_1",29.7]]',
				'26194'=>'PROJCS["Merchich_Sahara_Nord",GEOGCS["GCS_Merchich",DATUM["D_Merchich",SPHEROID["Clarke_1880_IGN",6378249.2,293.46602]],PRIMEM["Greenwich",0],UNIT["Degree",0.017453292519943295]],PROJECTION["Lambert_Conformal_Conic"],PARAMETER["latitude_of_origin",26.1],PARAMETER["central_meridian",-5.4],PARAMETER["scale_factor",0.999616304],PARAMETER["false_easting",1200000],PARAMETER["false_northing",400000],UNIT["Meter",1],PARAMETER["standard_parallel_1",26.1]]',
				'26195'=>'PROJCS["Merchich_Sahara_Sud",GEOGCS["GCS_Merchich",DATUM["D_Merchich",SPHEROID["Clarke_1880_IGN",6378249.2,293.46602]],PRIMEM["Greenwich",0],UNIT["Degree",0.017453292519943295]],PROJECTION["Lambert_Conformal_Conic"],PARAMETER["latitude_of_origin",22.5],PARAMETER["central_meridian",-5.4],PARAMETER["scale_factor",0.999616437],PARAMETER["false_easting",1500000],PARAMETER["false_northing",400000],UNIT["Meter",1],PARAMETER["standard_parallel_1",22.5]]',
				'4326'=>'GEOGCS["GCS_WGS_1984",DATUM["D_WGS_1984",SPHEROID["WGS_1984",6378137,298.257223563]],PRIMEM["Greenwich",0],UNIT["Degree",0.017453292519943295]]',
			);
			$Shapefile->setPRJ($projection[$affaireDta['srid']]);
		$Shapefile = null;
		
		$zip = new ZipArchive;
		if ($zip->open('filesDownload/shp/'.$fileDistination.'/'.$affaireDta['nom'].'.zip', ZipArchive::CREATE) === TRUE)
		{
			$files = array_diff(scandir('filesDownload/shp/'.$fileDistination),array('.','..','...',$affaireDta['nom'].'.zip'));
			print_r($files);
			foreach ($files as $file) {
					
					$zip->addFile('filesDownload/shp/'.$fileDistination.'/'.$file,$file);
			}
			$zip->close();
			sleep(1);
			force_download('filesDownload/shp/'.$fileDistination.'/'.$affaireDta['nom'].'.zip', NULL);
		}
		else
			return;	
		}
		

		
	}
	function exportToExcel($affaireDta,$attributeTable,$geoComposantesInfo)
	{
		$phpExcel = new Spreadsheet();
		$phpExcel->getProperties()->setCreator('SMART-DESK')->setTitle('AFFAIRE '.$affaireDta['nom']);
		$AttributesSheet = $phpExcel->getActiveSheet()->setTitle("Informations Attributaires");
		$phpExcel->getActiveSheet()->getTabColor()->setRGB('F91827');
		$bornesSheet = $phpExcel->createSheet();
		$bornesSheet->getTabColor()->setRGB('1888F9');
		$bornesSheet->setTitle("Liste des bornes");
		$surfaceCuml = 0;
		$PerimetreCuml =0;
		$longueurCuml = 0;
		$countComp = 0;
		$geomtype = 'Point';
		if(is_array($attributeTable) && is_array($geoComposantesInfo) && count($attributeTable)==count($geoComposantesInfo))
		{
			$countComp = count($geoComposantesInfo);
			$geomColumnsHeader = [];
			$geomtype = $geoComposantesInfo[0]['geomtype'];
			switch ($geomtype) {
				case 'Polygon':
				array_push($geomColumnsHeader,'surface m²','Perimetre m');
				break;
				case 'LineString':
				array_push($geomColumnsHeader,'longueur m²');
				break;
			};
			$headers = array_merge(array_keys(json_decode($attributeTable[0]['attributes'],true)),$geomColumnsHeader);
			$AttributesSheet->fromArray($headers, NULL, 'A1');   
			$position = 1;
			$bornesSheet->getCell('A'.$position)->setValue('Libelle');
			$bornesSheet->getCell('B'.$position)->setValue('X');
			$bornesSheet->getCell('C'.$position)->setValue('Y');
			$styleBornesArray = [
				'font' => [
					'bold' => true,
					'color'=> ['argb' => 'FF7104']
				],

			];
			$bornesSheet->getStyle('A1:C1')->applyFromArray($styleBornesArray);
			for ($i=0;$i<$countComp;$i++)
			{
				$position++;
				$geomRow = [];
				$geomprop = explode(';', $geoComposantesInfo[$i]['geomprop']);
				$geomNoteString = "";
				switch ($geomtype) {
					case 'Polygon':
					array_push($geomRow,$geomprop[0],$geomprop[1]);
					$geomNoteString = "(Surface : ".$geomprop[0]."m² ; Perimetre:".$geomprop[1]." m)";
					$surfaceCuml+=$geomprop[0];
					$PerimetreCuml+=$geomprop[1];
					break;
					case 'LineString':
					array_push($geomRow,$geomprop[1]);
					$geomNoteString = "(Longueur:".$geomprop[1]." m)";
					$longueurCuml+=$geomprop[1];
					break;
				}
				$AttributesSheet->fromArray(array_merge(json_decode($attributeTable[$i]['attributes'],true),$geomRow), NULL, 'A'.($i+2));
				/*******************************Liste des bornes************************************************************/


				$bornesSheet->getCell('A'.$position)->setValue('Composant '.($i+1).' '.$geomNoteString);
				$bornesSheet->getCell('A'.$position)->getStyle()->getFont()->setBold(true);
				$bornesSheet->getCell('A'.$position)->getStyle()->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
				$bornesSheet->getCell('A'.$position)->getStyle()->getFill()->getStartColor()->setARGB('DEDEDE');
				$bornesSheet->mergeCells('A'.$position.':C'.$position);
				$bornesLabellsList = explode('&;&',$geoComposantesInfo[$i]['bornes']);
				$bornesCoordList = explode(',',$geoComposantesInfo[$i]['coord']);
				if($geomtype == 'Polygon')
				{
					array_pop($bornesLabellsList);
					array_pop($bornesCoordList);
				}
				for($j=0;$j<count($bornesLabellsList);$j++)
				{
					$position++;
					$point = explode(' ',$bornesCoordList[$j]);
					$bornesSheet->fromArray(array($bornesLabellsList[$j],$point[0],$point[1]), NULL, 'A'.$position);
				}
			}
			$projection = array(
				'26191'=>'Marco Lambert Z1',
				'26192'=>'Marco Lambert Z2',
				'26194'=>'Marco Lambert Z3',
				'26195'=>'Marco Lambert Z4',
				'4326'=>'World-WGS84',
			);
			$dtaAffInfo = array(
				array('title'=>'Nom de l\'affaire:','value'=>$affaireDta['nom']),
				array('title'=>'Date de Création:','value'=>$affaireDta['date_creation']),
				array('title'=>'Nombre de composantes:','value'=>$countComp),
				array('title'=>'CRS:','value'=>$projection[$affaireDta['srid']].'(SRID : '.$affaireDta['srid'].')'),
				array('title'=>'Type de Geometrie:','value'=>$affaireDta['geomtype']),
			);
			switch ($geomtype) {
				case 'Polygon':
				array_push($dtaAffInfo,array('title'=>'Surface globale:','value'=>$surfaceCuml.' m²'),array('title'=>'Piremetre global:','value'=>$PerimetreCuml.' m'));
				break;
				case 'LineString':
				array_push($dtaAffInfo,array('title'=>'Longueur globale:','value'=>$longueurCuml.' m'));
				break;
			};
			$infoGeneral = $phpExcel->createSheet();
			$infoGeneral->setTitle("Informations générales");
			$infoGeneral->getTabColor()->setRGB('F99F18');
			for ($i=0; $i <count($dtaAffInfo) ; $i++) { 
				$infoGeneral->getCell('A'.($i+1))->setValue($dtaAffInfo[$i]['title']);
				$infoGeneral->getCell('A'.($i+1))->getStyle()->getFont()->getColor()->setARGB('F99F18');
				$infoGeneral->getCell('A'.($i+1))->getStyle()->getFont()->setBold(true);
				$infoGeneral->getCell('B'.($i+1))->setValue($dtaAffInfo[$i]['value']);
			}
			$styleArray = [
				'font' => [
					'bold' => true,
					'color'=> ['argb' => 'FFFFFFFF']
				],
				'alignment' => [
					'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
				],
				'borders' => [
					'top' => [
						'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
					],
				],
				'fill' => [
					'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
					'rotation' => 90,
					'startColor' => [
						'argb' => '105D83',
					],
					'endColor' => [
						'argb' => 'FFFFFFFF',
					],
				],
			];
			$highestColumn = $phpExcel->getSheet(0)->getHighestColumn();
			$phpExcel->getSheet(0)->getStyle('A1:'.$highestColumn.'1')->applyFromArray($styleArray);
			for($k=0;$k<$phpExcel->getSheetCount();$k++)
			{
				$highestColumn = $phpExcel->getSheet($k)->getHighestColumn();
				foreach(range('A',$highestColumn) as $columnID) {
					$phpExcel->getSheet($k)->getColumnDimension($columnID)->setAutoSize(true);
				}
			}
			$writer = new Xlsx($phpExcel);
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment; filename="'.$affaireDta['nom'].'.xlsx"');
			ob_clean();
			$writer->save('php://output');
		}
	}
}
?>