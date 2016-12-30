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
  'aid' => 
  array (
    'field' => 'aid',
    'type' => 'int(11) unsigned',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'word' => 
  array (
    'field' => 'word',
    'type' => 'int(3) unsigned',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'isdisplay' => 
  array (
    'field' => 'isdisplay',
    'type' => 'int(1) unsigned',
    'null' => 'YES',
    'key' => false,
    'default' => '0',
    'extra' => '',
  ),
);
?>