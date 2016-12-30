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
  'webname' => 
  array (
    'field' => 'webname',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'weburl' => 
  array (
    'field' => 'weburl',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'webid' => 
  array (
    'field' => 'webid',
    'type' => 'int(11)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'webroot' => 
  array (
    'field' => 'webroot',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'webprefix' => 
  array (
    'field' => 'webprefix',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'is_main' => 
  array (
    'field' => 'is_main',
    'type' => 'tinyint(1)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'name1' => 
  array (
    'field' => 'name1',
    'type' => 'varchar(225)',
    'null' => 'NO',
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
    'default' => '9999',
    'extra' => '',
  ),
);
?>