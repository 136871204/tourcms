<?php if(!defined('ZHPHP_PATH'))exit;
return array (
  'id' => 
  array (
    'field' => 'id',
    'type' => 'int(11)',
    'null' => 'NO',
    'key' => true,
    'default' => NULL,
    'extra' => 'auto_increment',
  ),
  'orderid' => 
  array (
    'field' => 'orderid',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => '0',
    'extra' => '',
  ),
  'tourername' => 
  array (
    'field' => 'tourername',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => '0',
    'extra' => '',
  ),
  'sex' => 
  array (
    'field' => 'sex',
    'type' => 'int(2)',
    'null' => 'YES',
    'key' => false,
    'default' => '1',
    'extra' => '',
  ),
  'cardtype' => 
  array (
    'field' => 'cardtype',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => '0',
    'extra' => '',
  ),
  'cardnumber' => 
  array (
    'field' => 'cardnumber',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => '0',
    'extra' => '',
  ),
  'mobile' => 
  array (
    'field' => 'mobile',
    'type' => 'varchar(15)',
    'null' => 'YES',
    'key' => false,
    'default' => '0',
    'extra' => '',
  ),
  'fnamealp' => 
  array (
    'field' => 'fnamealp',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'lnamealp' => 
  array (
    'field' => 'lnamealp',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'birthdayy' => 
  array (
    'field' => 'birthdayy',
    'type' => 'varchar(10)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'birthdaym' => 
  array (
    'field' => 'birthdaym',
    'type' => 'varchar(10)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'birthdayd' => 
  array (
    'field' => 'birthdayd',
    'type' => 'varchar(10)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'passbook' => 
  array (
    'field' => 'passbook',
    'type' => 'varchar(100)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'effectivey' => 
  array (
    'field' => 'effectivey',
    'type' => 'varchar(10)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'effectivem' => 
  array (
    'field' => 'effectivem',
    'type' => 'varchar(10)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'effectived' => 
  array (
    'field' => 'effectived',
    'type' => 'varchar(10)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'ptype' => 
  array (
    'field' => 'ptype',
    'type' => 'char(1)',
    'null' => 'YES',
    'key' => false,
    'default' => '1',
    'extra' => '',
  ),
);
?>