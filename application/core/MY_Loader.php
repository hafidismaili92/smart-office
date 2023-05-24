<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Loader Class
 *
 * Loads views and files
 *
 * @package     CodeIgniter
 * @subpackage  Libraries
 * @author      Phil Sturgeon
 * @category    Loader
 * @link        http://codeigniter.com/user_guide/libraries/loader.html
 */
class MY_Loader extends CI_Loader {

    function __construct($config = array()){
      parent::__construct($config);
  }

    public function image($file_path, $mime_type_or_return = 'image/png')
    {
        $this->helper('file');

        $image_content = file_get_contents($file_path);

        // Image was not found
        if($image_content === FALSE)
        {
            show_error('Image "'.$file_path.'" could not be found.');
            return FALSE;
        }

        // Return the image or output it?
        if($mime_type_or_return === TRUE)
        {
            return $image_content;
        }
        ob_end_clean();
        header('Content-Length: '.strlen($image_content)); // sends filesize header
        header('Content-Type: '.$mime_type_or_return); // send mime-type header
        header('Content-Disposition: inline; filename="'.basename($file_path).'";'); // sends filename header
        exit($image_content); // reads and outputs the file onto the output buffer
    }
    public function dateLess($datestring,$param)
{
    //$referenceDate = new DateTime('31-12-'.date('Y'));
    
    $date= new DateTime($datestring);
    $dateRef= new DateTime($param[0]);
    if($param[1]>0)
        $dateRef->sub(new DateInterval('P'.$param[1].'Y'));
    $interval = date_diff($date,$dateRef); 
    return $interval->format('%R%a') <0?false:true;
}
}
?>