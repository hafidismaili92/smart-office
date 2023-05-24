<?php
//defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
 // Import classes
use Shapefile\Shapefile;
use Shapefile\ShapefileException;
use Shapefile\ShapefileReader;
class  CustomReader extends MY_controller{
  function __construct()
  {
    parent::__construct();
    // if (defined('BASEPATH') && $_SERVER['REQUEST_METHOD'] != "POST") 
    //  exit('<h1>No direct script access allowed<h2>');
    $this->load->model('M_GestionAffaire/M_affaireMissions','affaireMissions');
    $this->load->model('M_GestionAffaire/M_affaires','M_affaires');
    $this->load->library('form_validation');
  }
  function index()
  {
    echo "<pre>";
    try {
    // Open Shapefile
      $Shapefile = new ShapefileReader('uploads\zip\stations.shp');
      while ($Geometry = $Shapefile->fetchRecord()) {
        // Skip the record if marked as "deleted"
        if ($Geometry->isDeleted()) {
          continue;
        }
        echo 'Print Geometry as an Array';
        print_r($Geometry->getArray());
        echo 'Print Geometry as WKT';
        print_r($Geometry->getWKT());
        echo 'Print Geometry as GeoJSON';
        print_r($Geometry->getGeoJSON());
        echo 'Print DBF data';
        print_r($Geometry->getDataArray());
      }
    // Get Shape Type
      echo "Shape Type : ";
      echo $Shapefile->getShapeType() . " - " . $Shapefile->getShapeType(Shapefile::FORMAT_STR);
      echo "\n\n";
    // Get number of Records
      echo "Records : ";
      print_r($Shapefile->getTotRecords());
      echo "\n\n";
    // Get Bounding Box
      echo "Bounding Box : ";
      print_r($Shapefile->getBoundingBox());
      echo "\n\n";
    // Get PRJ
      echo "PRJ : ";
      print_r($Shapefile->getPRJ());
      echo "\n\n";
    // Get Charset
      echo "Charset : ";
      print_r($Shapefile->getCharset());
      echo "\n\n";
    // Get DBF Fields
      echo "DBF Fields : ";
      print_r($Shapefile->getFields());
      echo "\n\n";
    } catch (ShapefileException $e) {
    // Print detailed error information
      echo "Error Type: " . $e->getErrorType()
      . "\nMessage: " . $e->getMessage()
      . "\nDetails: " . $e->getDetails();
    }
    echo "</pre>";
  }
  function extract($fileFullName,$destination){
   if(!empty($fileFullName)){ 
     $zip = new ZipArchive;
     $res = $zip->open($fileFullName);
     if ($res === TRUE) {
               // Unzip path
       $extractpath = $destination;
               // Extract file
       $zip->extractTo($extractpath);
       $zip->close();
       return true;
     } else {
       return false;
     }
   }else{ 
    return false;
  } 
}
function parseComposante()
{
  if (defined('BASEPATH') && $_SERVER['REQUEST_METHOD'] != "POST") 
    exit('<h1>No direct script access allowed<h2>');
      //http://stackoverflow.com/questions/18382740/cors-not-working-php
  if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
      }
    // Access-Control headers are received during OPTIONS requests
      if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
          header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
          header("Access-Control-Allow-Headers:
            {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
        exit(0);
      }
      $maxSize="100000";
      $allowMime = array('application/vnd.ms-excel','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','text/plain','application/octet-stream','zz-application/zz-winassoc-dat','application/zip', 'application/octet-stream', 'application/x-zip-compressed', 'multipart/x-zip');
      $filesData = $this->readFiles($_FILES['file'],$maxSize,$allowMime,['xlsx','xls']);
      echo json_encode($filesData);
    }
    function parseAffaire()
    {
      if (defined('BASEPATH') && $_SERVER['REQUEST_METHOD'] != "POST") 
        exit('<h1>No direct script access allowed<h2>');
      //http://stackoverflow.com/questions/18382740/cors-not-working-php
      if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
      }
    // Access-Control headers are received during OPTIONS requests
      if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
          header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
          header("Access-Control-Allow-Headers:
            {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
        exit(0);
      }
      $maxSize="100000";
      $allowMime = array('application/vnd.ms-excel','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','text/plain','application/octet-stream','zz-application/zz-winassoc-dat','application/zip', 'application/octet-stream', 'application/x-zip-compressed', 'multipart/x-zip');
      $filesData = $this->readFiles($_FILES['file'],$maxSize,$allowMime,['zip']);
      echo json_encode($filesData);
    }
    function readFiles($file,$maxSize,$allowMime,$extArray)
    {
      $maxSize=(5*1024*1024);
      /*$allowMime = array('application/vnd.ms-excel','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','text/plain','application/octet-stream','zz-application/zz-winassoc-dat','application/zip', 'application/octet-stream', 'application/x-zip-compressed', 'multipart/x-zip');*/
      try {
        if (isset($file['name'])) {
          $name = $file['name'];
          $file_info = finfo_open(FILEINFO_MIME_TYPE);
          $mime = $file['type'];
          if (0 < $file['error']) {
            throw new Exception('Error during file upload');
          }
          else if (!in_array($mime,$allowMime)) {
            throw new Exception("Fichier non autorisé");
          }
          else if ($file['size']>$maxSize) {
            throw new Exception('taille max dépassée!');
          }
          else {
            $path_parts = pathinfo($name);
            $ext = $path_parts['extension'];
            /*******************************IF XLSX*******************************************/
            $envoie = array();
            $brns = array();
            $newName = (string)time();
            if(!in_array($ext,$extArray))
              throw new Exception("Fichier non autorisé");
            switch ($ext) {
              case 'xlsx':
              case 'xls':
              move_uploaded_file($file['tmp_name'],'uploads/excel/'.$newName.'.'.$ext);
              $tmpfname = "uploads/excel/".$newName.".".$ext;
              $reader = $ext=='xlsx'?new Xlsx():new Xls();
              $reader->setReadDataOnly(true);
              $worksheetData = $reader->listWorksheetInfo( $tmpfname);
              $sheetName = $worksheetData[0]['worksheetName'];
              $reader->setLoadSheetsOnly($sheetName);
              $spreadsheet = $reader->load($tmpfname);
              $worksheet = $spreadsheet->getActiveSheet();
              $last_row=$worksheet->getHighestRow();
              $coord = $worksheet->rangeToArray('C2:D'.$last_row);
              $labels=[];
              foreach($worksheet->rangeToArray('B2:B'.$last_row) as $vals) {
                array_push($labels,$vals[0]);
              }
              $composanteName= $worksheet->getCell('A2')->getValue();
              return ['coord'=>$coord,'labels'=>$labels,'composanteName'=>$composanteName,'id'=> time().'_1'];
              break;
              case 'zip':
              mkdir('uploads/zip/'.$newName);
              move_uploaded_file($file['tmp_name'],'uploads/zip/'.$newName.'/'.$newName.'.zip');
              if ($this->extract('uploads/zip/'.$newName.'/'.$newName.'.zip','uploads/zip/'.$newName.'/'))
              {
                $shpFile = glob("uploads/zip/".$newName."/*.shp")[0];
                $Shapefile = new ShapefileReader($shpFile);
                $shpProj =$Shapefile->getPRJ();
                $proj = null;
                $esriValidProjection = array(
                  '26191'=>array('PROJCS["Nord_Maroc"','PROJCS["Merchich_Nord_Maroc"'),
                  '26192'=>array('PROJCS["Sud_Maroc"','PROJCS["Merchich_Sud_Maroc"'),
                  '26194'=>array('PROJCS["Merchich_Sahara_Nord"','PROJCS["Merchich_Sahara_Nord"'),
                  '26195'=>array('PROJCS["Merchich_Sahara_Sud"','PROJCS["Merchich_Sahara_Sud"'),
                  '4326'=>array('GEOGCS["GCS_WGS_1984"')
                );
                foreach ($esriValidProjection as $key => $value)
                {
                  for($i=0;$i<count($value);$i++)
                  {

                    if($this->startsWith($shpProj,$value[$i]))
                    {
                      $proj = $key;
                      
                      break 2;
                    }
                  }
                }
                if(empty($proj))
                  throw new Exception('système de coodonnée non prise en charge!');
                $Recordarr = array('features'=>[],'fields'=>[]);
                $compteur =1;
                while ($Geometry = $Shapefile->fetchRecord()) {
                  $randomID = time().'_'.$compteur;
                  if ($Geometry->isDeleted()) {
                    continue;
                  }
                  $htmlActions = '<div class="customtooltip onAdd-actions"><i class="far fa-trash-alt remove-feature "></i><span class="tooltiptext">Supprimer</span></div><div class="customtooltip onAdd-actions"><i class="fas fa-vector-square feature-showBorne"></i><span class="tooltiptext">Afficher les bornes</span></div>';
                  array_push($Recordarr['features'],[
                    'type'=>'Feature',
                    'properties'=>['idFeature'=>$randomID,'dataSource'=>'shp','fieldsRow'=>array_merge([$randomID,$htmlActions],array_values($Geometry->getDataArray())),'confirmed'=>true,'deleted'=>false],
                    'geometry'=>json_decode($Geometry->getGeoJSON()),
                  ]);
                  $compteur++;
                }
                $dta = ['record'=>$Recordarr,
                'fieldsName'=>array_keys($Shapefile->getFields()),
                'proj'=>$proj,
                'geomType'=>$Shapefile->getShapeType(Shapefile::FORMAT_STR)
              ];
               // $this->deleteDir("uploads/zip/".$newName);
              sleep(1);
              return $dta;
            }
            break;
            default:
            throw new Exception('extension non prise en charge!');
            break;
          }
        }
      }
      else {
        throw new Exception('Veuillez choisir un fichier');
      }
    } catch (Exception $e) {
      $message = $e->getMessage();
      http_response_code(400);
      die( $message );
    }
  }
  function emptyDir($dir) {
    if (is_dir($dir)) {
      $scn = scandir($dir);
      foreach ($scn as $files) {
        if ($files !== '.') {
          if ($files !== '..') {
            if (!is_dir($dir . '/' . $files)) {
              unlink($dir . '/' . $files);
            } else {
              emptyDir($dir . '/' . $files);
              rmdir($dir . '/' . $files);
            }
          }
        }
      }
    }
  }
  function startsWith ($string, $startString) 
  { 
    $len = strlen($startString); 
    return (substr($string, 0, $len) === $startString); 
  } 
  function deleteDir($dir) {
    foreach(glob($dir . '/' . '*') as $file) {
      if(is_dir($file)){
        deleteDir($file);
      } else {
        unlink($file);
      }
    }
    $this->emptyDir($dir);
    rmdir($dir);
  }
}
?>