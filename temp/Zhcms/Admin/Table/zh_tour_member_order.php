<?php if(!defined('ZHPHP_PATH'))exit;
return array (
  'id' => 
  array (
    'field' => 'id',
    'type' => 'int(11) unsigned',
    'null' => 'NO',
    'key' => true,
    'default' => NULL,
    'extra' => 'auto_increment',
  ),
  'ordersn' => 
  array (
    'field' => 'ordersn',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'memberid' => 
  array (
    'field' => 'memberid',
    'type' => 'int(11) unsigned',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'typeid' => 
  array (
    'field' => 'typeid',
    'type' => 'int(3) unsigned',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'webid' => 
  array (
    'field' => 'webid',
    'type' => 'int(3) unsigned',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'productaid' => 
  array (
    'field' => 'productaid',
    'type' => 'int(11) unsigned',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'productname' => 
  array (
    'field' => 'productname',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'productautoid' => 
  array (
    'field' => 'productautoid',
    'type' => 'int(11) unsigned',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'litpic' => 
  array (
    'field' => 'litpic',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'price' => 
  array (
    'field' => 'price',
    'type' => 'float(10,2) unsigned',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'childprice' => 
  array (
    'field' => 'childprice',
    'type' => 'float(10,2) unsigned',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'usedate' => 
  array (
    'field' => 'usedate',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'dingnum' => 
  array (
    'field' => 'dingnum',
    'type' => 'int(3) unsigned',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'childnum' => 
  array (
    'field' => 'childnum',
    'type' => 'int(11) unsigned',
    'null' => 'YES',
    'key' => false,
    'default' => '0',
    'extra' => '',
  ),
  'ispay' => 
  array (
    'field' => 'ispay',
    'type' => 'int(10) unsigned',
    'null' => 'YES',
    'key' => false,
    'default' => '0',
    'extra' => '',
  ),
  'status' => 
  array (
    'field' => 'status',
    'type' => 'int(1) unsigned',
    'null' => 'YES',
    'key' => false,
    'default' => '0',
    'extra' => '',
  ),
  'linkman' => 
  array (
    'field' => 'linkman',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'linktel' => 
  array (
    'field' => 'linktel',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'linkemail' => 
  array (
    'field' => 'linkemail',
    'type' => 'varchar(100)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'linkqq' => 
  array (
    'field' => 'linkqq',
    'type' => 'varchar(16)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'isneedpiao' => 
  array (
    'field' => 'isneedpiao',
    'type' => 'int(1) unsigned',
    'null' => 'YES',
    'key' => false,
    'default' => '0',
    'extra' => '',
  ),
  'addtime' => 
  array (
    'field' => 'addtime',
    'type' => 'int(10) unsigned',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'finishtime' => 
  array (
    'field' => 'finishtime',
    'type' => 'int(10) unsigned',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'ispinlun' => 
  array (
    'field' => 'ispinlun',
    'type' => 'int(1) unsigned',
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
  'jifentprice' => 
  array (
    'field' => 'jifentprice',
    'type' => 'int(11)',
    'null' => 'YES',
    'key' => false,
    'default' => '0',
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
  'dingjin' => 
  array (
    'field' => 'dingjin',
    'type' => 'int(11)',
    'null' => 'YES',
    'key' => false,
    'default' => '0',
    'extra' => '',
  ),
  'suitid' => 
  array (
    'field' => 'suitid',
    'type' => 'int(11)',
    'null' => 'YES',
    'key' => false,
    'default' => '0',
    'extra' => '',
  ),
  'paytype' => 
  array (
    'field' => 'paytype',
    'type' => 'int(1)',
    'null' => 'YES',
    'key' => false,
    'default' => '1',
    'extra' => '',
  ),
  'oldnum' => 
  array (
    'field' => 'oldnum',
    'type' => 'int(11)',
    'null' => 'YES',
    'key' => false,
    'default' => '0',
    'extra' => '',
  ),
  'oldprice' => 
  array (
    'field' => 'oldprice',
    'type' => 'float(10,2)',
    'null' => 'YES',
    'key' => false,
    'default' => '0.00',
    'extra' => '',
  ),
  'usejifen' => 
  array (
    'field' => 'usejifen',
    'type' => 'int(1) unsigned',
    'null' => 'YES',
    'key' => false,
    'default' => '0',
    'extra' => '',
  ),
  'needjifen' => 
  array (
    'field' => 'needjifen',
    'type' => 'int(11) unsigned',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'pid' => 
  array (
    'field' => 'pid',
    'type' => 'int(11)',
    'null' => 'YES',
    'key' => false,
    'default' => '0',
    'extra' => '',
  ),
  'haschild' => 
  array (
    'field' => 'haschild',
    'type' => 'int(1) unsigned',
    'null' => 'YES',
    'key' => false,
    'default' => '0',
    'extra' => '',
  ),
  'remark' => 
  array (
    'field' => 'remark',
    'type' => 'mediumtext',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'kindlist' => 
  array (
    'field' => 'kindlist',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => '',
    'extra' => '',
  ),
  'handleshop' => 
  array (
    'field' => 'handleshop',
    'type' => 'varchar(4)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'linksex' => 
  array (
    'field' => 'linksex',
    'type' => 'int(2)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'totalprice' => 
  array (
    'field' => 'totalprice',
    'type' => 'float(10,2) unsigned',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'admin_note' => 
  array (
    'field' => 'admin_note',
    'type' => 'text',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'updatetime' => 
  array (
    'field' => 'updatetime',
    'type' => 'int(10) unsigned',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'contacttype' => 
  array (
    'field' => 'contacttype',
    'type' => 'char(3)',
    'null' => 'NO',
    'key' => false,
    'default' => '',
    'extra' => '',
  ),
);
?>