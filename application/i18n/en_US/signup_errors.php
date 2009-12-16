<?php
$lang = array(
  'password' => array (
	'required' => 'Required Field',
	'password_bad' => 'Password incorrect',
	'length' => 'Password too short',
  ),
  'password_confirm' => array (
	'matches' => 'Passwords must match',
	'required' => 'Required Field',
  ),
  'username' => array (
	'required' => 'Required Field',
    'chars' => 'Valid Chars: a-zA-Z0-9_',
	'length' => 'Length must be from 6 to 20 characters',
	'user_not_exist' => 'This username does not exist',
	'username_exists' => 'This user already exists',
  ),
  'email' => array (
    'required' => 'Required Field',
	'email' => 'Invalid Email',
    'email_exists' => 'This email exists',
  ),
  'subdomain' => array (
    'chars' => 'Valid Chars: a-zA-Z0-9',
    'length' => 'Length must be from 3 to 20 characters',
    'domain_unique' => 'This name is taken',
    'required' => 'Required',
  ),
  'tagline' => array (
    'required' => 'Required',
  ),
  'description' => array (
    'required' => 'Required',
  ),
  'keywords' => array (
    'required' => 'Required',
  ),
  'sitename' => array (
    'chars' => 'Valid Chars: a-zA-Z0-9',
    'length' => 'Length must be from 4 to 20 characters',
    'required' => 'Required',
    'sitename_exists' => 'This name is taken',
  ),
);
?>
