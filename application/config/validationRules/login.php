<?php
$login = array('login' => array(
        array(
            'field' => 'emp-matricule',
            'label' => 'matricule',
            'rules' => array('trim','required','max_length[10]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long'
            )
        ),
        array(
            'field' => 'emp-Password',
            'label' => 'Mot de passe',
            'rules' => array('trim','required'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter le {field}',
            )
        ),

    ),
    'resetPassword' => array(
        array(
            'field' => 'emp-matricule',
            'label' => 'matricule',
            'rules' => array('trim','required','max_length[10]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'max_length'=>'*{field} trop long'
            )
        ),
        array(
            'field' => 'emp-oldPassword',
            'label' => 'ancien Mot de passe',
            'rules' => array('trim','required'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
            )
        ),
        array(
            'field' => 'emp-newPassword',
            'label' => 'Nouveau Mot de passe',
            'rules' => array(
                'trim',
                'required',
                array('valid_password',function($password)
                {
                    $regex_lowercase = '/[a-z]/';
                    $regex_uppercase = '/[A-Z]/';
                    $regex_number = '/[0-9]/';
                    $regex_special = '/[!@#$%^&*()\-_=+{};:,<.>§~]/';
                    if (preg_match_all($regex_lowercase, $password) < 1)
                    {

                        return FALSE;
                    }
                    if (preg_match_all($regex_uppercase, $password) < 1)
                    {

                        return FALSE;
                    }
                    if (preg_match_all($regex_number, $password) < 1)
                    {

                        return FALSE;
                    }
                    if (preg_match_all($regex_special, $password) < 1)
                    {

                        return FALSE;
                    }
                    if (strlen($password) < 8)
                    {

                        return FALSE;
                    }
                    if (strlen($password) > 32)
                    {

                        return FALSE;
                    }
                    return TRUE;  
                }

            )
            ),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'valid_password'=>'le mot de passe ne correspond pas aux critères!'
            )
        ),
        array(
            'field' => 'emp-confirmPassword',
            'label' => 'confirmer Mot de passe',
            'rules' => array('trim','required','matches[emp-newPassword]'),
            'errors'=> array(
                'required'=>'*Veuillez ajouter la {field}',
                'matches'=>'les deux mot de passe ne sont pas identiques'
            )
        )   
    ));
?>