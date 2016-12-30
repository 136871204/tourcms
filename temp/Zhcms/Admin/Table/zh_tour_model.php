<?php if(!defined('ZHPHP_PATH'))exit;
return array (
  'id' => 
  array (
    'field' => 'id',
    'type' => 'int(10) unsigned',
    'null' => 'NO',
    'key' => true,
    'default' => NULL,
    'extra' => 'auto_increment',
  ),
  'modulename' => 
  array (
    'field' => 'modulename',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'pinyin' => 
  array (
    'field' => 'pinyin',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'maintable' => 
  array (
    'field' => 'maintable',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'addtable' => 
  array (
    'field' => 'addtable',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'attrtable' => 
  array (
    'field' => 'attrtable',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => 'model_attr',
    'extra' => '',
  ),
  'issystem' => 
  array (
    'field' => 'issystem',
    'type' => 'int(1)',
    'null' => 'YES',
    'key' => false,
    'default' => '0',
    'extra' => '',
  ),
  'isopen' => 
  array (
    'field' => 'isopen',
    'type' => 'int(1)',
    'null' => 'YES',
    'key' => false,
    'default' => '1',
    'extra' => '',
  ),
);
?>