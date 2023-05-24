<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Custom_crypt 
{
public function normalizeString ($str = '')
	{
		$str = strip_tags($str); 
		$str = preg_replace('/[\r\n\t ]+/', '_', $str);
		$str = preg_replace('/[\"\*\/\:\<\>\?\'\|]+/', '_', $str);
		$str = strtolower($str);
		$str = html_entity_decode( $str, ENT_QUOTES, "utf-8" );
		$str = htmlentities($str, ENT_QUOTES, "utf-8");
		$str = preg_replace("/(&)([a-z])([a-z]+;)/i", '_', $str);
		$str = str_replace(' ', '_', $str);
		$str = rawurlencode($str);
		$str = str_replace('%', '_', $str);
		return $str;
	}

}
