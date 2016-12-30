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
  'lineid' => 
  array (
    'field' => 'lineid',
    'type' => 'int(11)',
    'null' => 'NO',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'suitname' => 
  array (
    'field' => 'suitname',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'description' => 
  array (
    'field' => 'description',
    'type' => 'text',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'displayorder' => 
  array (
    'field' => 'displayorder',
    'type' => 'int(11)',
    'null' => 'YES',
    'key' => false,
    'default' => '999999',
    'extra' => '',
  ),
  'jifenbook' => 
  array (
    'field' => 'jifenbook',
    'type' => 'int(11)',
    'null' => 'YES',
    'key' => false,
    'default' => '0',
    'extra' => '',
  ),
  'jifentprice' => 
  array (
    'field' => 'jifentprice',
    'type' => 'int(11)',
    'null' => 'YES',
    'key' => false,
    'default' => '0',
    'extra' => '',
  ),
  'jifencomment' => 
  array (
    'field' => 'jifencomment',
    'type' => 'int(11)',
    'null' => 'YES',
    'key' => false,
    'default' => '0',
    'extra' => '',
  ),
  'propgroup' => 
  array (
    'field' => 'propgroup',
    'type' => 'varchar(6)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'paytype' => 
  array (
    'field' => 'paytype',
    'type' => 'tinyint(1) unsigned',
    'null' => 'YES',
    'key' => false,
    'default' => '1',
    'extra' => '',
  ),
  'dingjin' => 
  array (
    'field' => 'dingjin',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'suittype' => 
  array (
    'field' => 'suittype',
    'type' => 'varchar(50)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
);
?>