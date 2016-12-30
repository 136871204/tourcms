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
  'webid' => 
  array (
    'field' => 'webid',
    'type' => 'int(3)',
    'null' => 'YES',
    'key' => false,
    'default' => '1',
    'extra' => '',
  ),
  'columnname' => 
  array (
    'field' => 'columnname',
    'type' => 'varchar(30)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'chinesename' => 
  array (
    'field' => 'chinesename',
    'type' => 'varchar(100)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'displayorder' => 
  array (
    'field' => 'displayorder',
    'type' => 'int(3)',
    'null' => 'YES',
    'key' => false,
    'default' => '0',
    'extra' => '',
  ),
  'issystem' => 
  array (
    'field' => 'issystem',
    'type' => 'int(1)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'isopen' => 
  array (
    'field' => 'isopen',
    'type' => 'int(1)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'isline' => 
  array (
    'field' => 'isline',
    'type' => 'int(1)',
    'null' => 'YES',
    'key' => false,
    'default' => '0',
    'extra' => '',
  ),
);
?>