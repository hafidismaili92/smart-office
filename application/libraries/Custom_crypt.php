<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Custom_crypt 
{

	
	public function cryptPassword($password,$hash_method=PASSWORD_BCRYPT,$costValue=12)
	{
		$options = [
			'cost' => $costValue,
		];
		$rndomPasswordCrypt = password_hash($password,$hash_method,$options);
		return $rndomPasswordCrypt;
	}
	public function generatePassword() {
$min_length=6;  //Minimum length of the password
$min_numbers=1; //Minimum of numbers AND special characters
$min_letters=4; //Minimum of letters

$password = '';
$numbers=0;
$letters=0;
$length=0;

while ( $length <= $min_length OR $numbers <= $min_numbers OR $letters <= $min_letters) {
	$length+=1;
	$type=rand(1, 4);
	if ($type==1) {
        $password .= chr(rand(48, 57)); //Numbers and special characters
        $numbers+=1;
    }elseif ($type==2) {
        $password .= chr(rand(65, 90)); //A->Z
        $letters+=1;
    }elseif ($type==4) {
        $password .= chr(rand(97, 122)); //a->z
        $letters+=1;
    }
    else
    {
    	$list = array('_','-','*');
    	$password .= $list[rand(0,2)];
        $letters+=1;
    }

}
return $password;   
}

function random_str($length = 35,$subdata='',$keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_') {
    if ($length < 1) {
        throw new \RangeException("Length must be a positive integer");
    }
    $keyspace=str_shuffle($subdata.'_'.$keyspace );
    $pieces = [];
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $pieces []= $keyspace[random_int(0, $max)];
    }
    return implode('', $pieces);
}

}


