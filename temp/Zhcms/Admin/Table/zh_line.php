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
    'type' => 'int(11) unsigned',
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
  'linetype' => 
  array (
    'field' => 'linetype',
    'type' => 'varchar(50)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'linename' => 
  array (
    'field' => 'linename',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'lineicon' => 
  array (
    'field' => 'lineicon',
    'type' => 'varchar(100)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'oldname' => 
  array (
    'field' => 'oldname',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'wholesale' => 
  array (
    'field' => 'wholesale',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'wholesalel' => 
  array (
    'field' => 'wholesalel',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'starttime' => 
  array (
    'field' => 'starttime',
    'type' => 'int(11)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'endtime' => 
  array (
    'field' => 'endtime',
    'type' => 'int(11)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'seotitle' => 
  array (
    'field' => 'seotitle',
    'type' => 'varchar(100)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'startcity' => 
  array (
    'field' => 'startcity',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'overcity' => 
  array (
    'field' => 'overcity',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'linedate' => 
  array (
    'field' => 'linedate',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'lineclassid' => 
  array (
    'field' => 'lineclassid',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'tprice' => 
  array (
    'field' => 'tprice',
    'type' => 'decimal(10,0)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'profit' => 
  array (
    'field' => 'profit',
    'type' => 'decimal(10,0)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'lineprice' => 
  array (
    'field' => 'lineprice',
    'type' => 'int(11) unsigned',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'lineday' => 
  array (
    'field' => 'lineday',
    'type' => 'int(3) unsigned',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'linenight' => 
  array (
    'field' => 'linenight',
    'type' => 'int(5)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'linephone' => 
  array (
    'field' => 'linephone',
    'type' => 'int(11)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'linespot' => 
  array (
    'field' => 'linespot',
    'type' => 'longtext',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'linepic' => 
  array (
    'field' => 'linepic',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'linedoc' => 
  array (
    'field' => 'linedoc',
    'type' => 'text',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'tagword' => 
  array (
    'field' => 'tagword',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'keyword' => 
  array (
    'field' => 'keyword',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'jieshao' => 
  array (
    'field' => 'jieshao',
    'type' => 'longtext',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'biaozhun' => 
  array (
    'field' => 'biaozhun',
    'type' => 'longtext',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'biaozhun_isstyle' => 
  array (
    'field' => 'biaozhun_isstyle',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => '2',
    'extra' => '',
  ),
  'biaozhun_detail' => 
  array (
    'field' => 'biaozhun_detail',
    'type' => 'longtext',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'beizu' => 
  array (
    'field' => 'beizu',
    'type' => 'longtext',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'payment' => 
  array (
    'field' => 'payment',
    'type' => 'longtext',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'feeinclude' => 
  array (
    'field' => 'feeinclude',
    'type' => 'longtext',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'features' => 
  array (
    'field' => 'features',
    'type' => 'longtext',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'description' => 
  array (
    'field' => 'description',
    'type' => 'varchar(700)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'shownum' => 
  array (
    'field' => 'shownum',
    'type' => 'int(11)',
    'null' => 'YES',
    'key' => false,
    'default' => '1',
    'extra' => '',
  ),
  'seatleft' => 
  array (
    'field' => 'seatleft',
    'type' => 'int(11)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'storeprice' => 
  array (
    'field' => 'storeprice',
    'type' => 'int(11)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'childprice' => 
  array (
    'field' => 'childprice',
    'type' => 'int(11)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'transport' => 
  array (
    'field' => 'transport',
    'type' => 'longtext',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'linebefore' => 
  array (
    'field' => 'linebefore',
    'type' => 'int(11)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'isjian' => 
  array (
    'field' => 'isjian',
    'type' => 'int(11)',
    'null' => 'YES',
    'key' => false,
    'default' => '0',
    'extra' => '',
  ),
  'isding' => 
  array (
    'field' => 'isding',
    'type' => 'int(11)',
    'null' => 'YES',
    'key' => false,
    'default' => '0',
    'extra' => '',
  ),
  'istejia' => 
  array (
    'field' => 'istejia',
    'type' => 'int(3)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'yesjian' => 
  array (
    'field' => 'yesjian',
    'type' => 'int(11) unsigned',
    'null' => 'YES',
    'key' => false,
    'default' => '0',
    'extra' => '',
  ),
  'nojian' => 
  array (
    'field' => 'nojian',
    'type' => 'int(11) unsigned',
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
  'modtime' => 
  array (
    'field' => 'modtime',
    'type' => 'int(10) unsigned',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'reserved1' => 
  array (
    'field' => 'reserved1',
    'type' => 'longtext',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'reserved2' => 
  array (
    'field' => 'reserved2',
    'type' => 'longtext',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'reserved3' => 
  array (
    'field' => 'reserved3',
    'type' => 'longtext',
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
    'default' => '9999',
    'extra' => '',
  ),
  'isbold' => 
  array (
    'field' => 'isbold',
    'type' => 'int(2)',
    'null' => 'YES',
    'key' => false,
    'default' => '0',
    'extra' => '',
  ),
  'color' => 
  array (
    'field' => 'color',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'bigpic' => 
  array (
    'field' => 'bigpic',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'ssmaltype' => 
  array (
    'field' => 'ssmaltype',
    'type' => 'int(1)',
    'null' => 'YES',
    'key' => false,
    'default' => '0',
    'extra' => '',
  ),
  'ssmalprovince' => 
  array (
    'field' => 'ssmalprovince',
    'type' => 'int(1)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'ssmalcity' => 
  array (
    'field' => 'ssmalcity',
    'type' => 'int(1)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'ssmalarea' => 
  array (
    'field' => 'ssmalarea',
    'type' => 'int(1)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'sdisplayorder' => 
  array (
    'field' => 'sdisplayorder',
    'type' => 'int(11)',
    'null' => 'YES',
    'key' => false,
    'default' => '9999',
    'extra' => '',
  ),
  'childrule' => 
  array (
    'field' => 'childrule',
    'type' => 'varchar(255)',
    'null' => 'NO',
    'key' => false,
    'default' => '',
    'extra' => '',
  ),
  'kindlist' => 
  array (
    'field' => 'kindlist',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'themelist' => 
  array (
    'field' => 'themelist',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'webidfs' => 
  array (
    'field' => 'webidfs',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'attrid' => 
  array (
    'field' => 'attrid',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'satisfyscore' => 
  array (
    'field' => 'satisfyscore',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'bookcount' => 
  array (
    'field' => 'bookcount',
    'type' => 'int(11) unsigned',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'ishidden' => 
  array (
    'field' => 'ishidden',
    'type' => 'int(3)',
    'null' => 'YES',
    'key' => false,
    'default' => '0',
    'extra' => '',
  ),
  'childkind' => 
  array (
    'field' => 'childkind',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'txtjieshao' => 
  array (
    'field' => 'txtjieshao',
    'type' => 'mediumtext',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'isstyle' => 
  array (
    'field' => 'isstyle',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'sellpoint' => 
  array (
    'field' => 'sellpoint',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'upstyle' => 
  array (
    'field' => 'upstyle',
    'type' => 'int(1)',
    'null' => 'NO',
    'key' => false,
    'default' => '0',
    'extra' => '',
  ),
  'piclist' => 
  array (
    'field' => 'piclist',
    'type' => 'text',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'distance' => 
  array (
    'field' => 'distance',
    'type' => 'int(6)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'zijiaseat' => 
  array (
    'field' => 'zijiaseat',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'zijiaprice' => 
  array (
    'field' => 'zijiaprice',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'zijiacar' => 
  array (
    'field' => 'zijiacar',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
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
  'showrepast' => 
  array (
    'field' => 'showrepast',
    'type' => 'int(1)',
    'null' => 'YES',
    'key' => false,
    'default' => '1',
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
  'template' => 
  array (
    'field' => 'template',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => 'line_show.htm',
    'extra' => '',
  ),
  'iconlist' => 
  array (
    'field' => 'iconlist',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'supplierlist' => 
  array (
    'field' => 'supplierlist',
    'type' => 'varchar(255)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'babyrule' => 
  array (
    'field' => 'babyrule',
    'type' => 'varchar(225)',
    'null' => 'NO',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'holiday' => 
  array (
    'field' => 'holiday',
    'type' => 'varchar(100)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'corporationnum' => 
  array (
    'field' => 'corporationnum',
    'type' => 'int(11)',
    'null' => 'YES',
    'key' => false,
    'default' => '1',
    'extra' => '',
  ),
  'magrecommend' => 
  array (
    'field' => 'magrecommend',
    'type' => 'longtext',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'shotcontent' => 
  array (
    'field' => 'shotcontent',
    'type' => 'longtext',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'linesn' => 
  array (
    'field' => 'linesn',
    'type' => 'varchar(100)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'baf' => 
  array (
    'field' => 'baf',
    'type' => 'int(3)',
    'null' => 'YES',
    'key' => false,
    'default' => '0',
    'extra' => '',
  ),
  'hotlinetel' => 
  array (
    'field' => 'hotlinetel',
    'type' => 'varchar(100)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'hotlines' => 
  array (
    'field' => 'hotlines',
    'type' => 'varchar(200)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'reserved4' => 
  array (
    'field' => 'reserved4',
    'type' => 'longtext',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'expire' => 
  array (
    'field' => 'expire',
    'type' => 'int(10)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'minday' => 
  array (
    'field' => 'minday',
    'type' => 'int(11)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'maxday' => 
  array (
    'field' => 'maxday',
    'type' => 'int(11)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'moduid' => 
  array (
    'field' => 'moduid',
    'type' => 'int(20)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'adduid' => 
  array (
    'field' => 'adduid',
    'type' => 'int(20)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'b2blineprice' => 
  array (
    'field' => 'b2blineprice',
    'type' => 'int(11)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'b2bminday' => 
  array (
    'field' => 'b2bminday',
    'type' => 'int(11)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'b2bmaxday' => 
  array (
    'field' => 'b2bmaxday',
    'type' => 'int(11)',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
);
?>