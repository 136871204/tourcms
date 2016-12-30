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
  'destid' => 
  array (
    'field' => 'destid',
    'type' => 'int(11)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'cityname' => 
  array (
    'field' => 'cityname',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'isdefault' => 
  array (
    'field' => 'isdefault',
    'type' => 'int(1) unsigned',
    'null' => 'YES',
    'key' => false,
    'default' => '0',
    'extra' => '',
  ),
  'isopen' => 
  array (
    'field' => 'isopen',
    'type' => 'int(1) unsigned',
    'null' => 'YES',
    'key' => false,
    'default' => '0',
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
  'domain' => 
  array (
    'field' => 'domain',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'pid' => 
  array (
    'field' => 'pid',
    'type' => 'int(8)',
    'null' => 'NO',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
);
?>