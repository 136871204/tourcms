<?php
$globalConfig 									= require './data/config/config.inc.php';
$web1Config  									= require './data/config/1_config.inc.php';
$web2Config  									= require './data/config/2_config.inc.php';
$web3Config  									= require './data/config/3_config.inc.php';
$web5Config  									= require './data/config/5_config.inc.php';
$web6Config  									= require './data/config/6_config.inc.php';

$globalConfig['EMAIL_FORMMAIL']	=$globalConfig['EMAIL_USERNAME'];//邮箱发件人
$config = array(
    'DB_DRIVER' 							=> 'mysql', //数据库驱动
	'DB_PCONNECT' 					=> true, //数据库持久链接
	'TPL_TAGS' 								=> array('@@.Common.Lib.ContentTag'), //标签
	'AUTO_LOAD_FILE' 				=> array(
                                        'zh/Common/Functions/functions.php',
                                        'zh/Common/Functions/ecconstant.php',
                                        'zh/Common/Functions/TourPage.class.php',
                                        'zh/Common/Functions/SearchPage.class.php'), //自动加载文件
	'DEFAULT_GROUP' 				=> 'Zhcms', //默认组
    '404_URL' 								=> '', //404跳转url
	'SESSION_OPTIONS' 				=> array('tpye' => 'mysql', 'table' => 'session'), //session处理
    'URL_TYPE' 								=> 2, //普通模式 GET方式
	'DEFAULT_GROUP' 				=> 'Zhcms', //默认组
    'DEFAULT_APP' 						=> 'Index', //默认应用
	'TPL_FIX' 									=> '.php', //模板后缀
    'UPLOAD_IMG_RESIZE_ON' 	=> true, //图片上传缩放开启
	'EDITOR_SAVE_PATH' 			=> ROOT_PATH . 'upload/editor/' . date('Y/m/d/'), //文件储存目录
	'TPL_ERROR' 							=> 'zh/Common/Template/error.html', //错误页面
	'TPL_SUCCESS' 						=> 'zh/Common/Template/success.html', //正确页面
	 '404_URL'								=> '?m=_404', //404跳转url
     
     /***********************EC*******************/
     'NO_PICTURE'								=> 'Static/ecimage/no_picture.gif', //404跳转url
     
);
$config['URL_REWRITE'] 			= 	intval($globalConfig['OPEN_REWRITE']);//REWRITE重写

if (intval($globalConfig['PATHINFO_TYPE'])) {
	$config['ROUTE'] 					= array(
                                                        
                                                        '/^jrpass$/' => 'a=Index&c=Index&m=jrpass',
                                                        '/^law$/' => 'a=Index&c=Index&m=law',
                                                        '/^contact$/' => 'a=Index&c=Index&m=contact',
                                                        '/^company$/' => 'a=Index&c=Index&m=company',
                                                        '/^jpvisa$/' => 'a=Index&c=Index&m=jpvisa',
                                                        '/^jpwifi$/' => 'a=Index&c=Index&m=jpwifi',
                                                        '/^agent$/' => 'a=Index&c=Index&m=agent',
                                                        '/^lines\/detail\/(\d+)$/' => 'a=Index&c=Lines&m=show&webid=1&aid=#1',
                                                        '/^lines\/([a-z0-9]+)$/' => 'a=Index&c=Lines&m=search&webid=1&dest_id=#1',
                                                        '/^lines\/([a-z0-9]+)-([0-9]+)-([0-9]+)-([0-9]+)-([0-9]+)-([0-9]+)-([^-]+)-([0-9]+)-([0-9_]+)$/' => 'a=Index&c=Lines&m=search&webid=1&dest_id=#1&para1=#2&para2=#3&day=#4&priceid=#5&sorttype=#6&keyword=#7&startcity=#8&attrid=#9',
                                                        '/^lines\/([a-z0-9]+)-([0-9]+)-([0-9]+)-([0-9]+)-([0-9]+)-([0-9]+)-([^-]+)-([0-9]+)-([0-9_]+)-([0-9_]+)$/' => 'a=Index&c=Lines&m=search&webid=1&dest_id=#1&para1=#2&para2=#3&day=#4&priceid=#5&sorttype=#6&keyword=#7&startcity=#8&attrid=#9&page=#10',
                                                        
                                                        '/^shanghai$/' => 'a=Index&c=Index&m=Index&webid=2',
                                                        '/^shanghai\/jrpass$/' => 'a=Index&c=Index&m=jrpass&webid=2',
                                                        '/^shanghai\/law$/' => 'a=Index&c=Index&m=law&webid=2',
                                                        '/^shanghai\/contact$/' => 'a=Index&c=Index&m=contact&webid=2',
                                                        '/^shanghai\/company$/' => 'a=Index&c=Index&m=company&webid=2',
                                                        '/^shanghai\/jpvisa$/' => 'a=Index&c=Index&m=jpvisa&webid=2',
                                                        '/^shanghai\/jpwifi$/' => 'a=Index&c=Index&m=jpwifi&webid=2',
                                                        '/^shanghai\/agent$/' => 'a=Index&c=Index&m=agent&webid=2',
                                                        '/^shanghai\/([a-z0-9]+)$/' => 'a=Index&c=Index&m=line_list&webid=2&dest_id=#1',
                                                        '/^shanghai\/lines\/detail\/(\d+)$/' => 'a=Index&c=Lines&m=show&webid=2&aid=#1',
                                                        '/^shanghai\/lines\/show_(\d+)$/' => 'a=Index&c=Lines&m=show&webid=2&aid=#1',
                                                        '/^shanghai\/lines\/([a-z0-9]+)$/' => 'a=Index&c=Lines&m=search&webid=2&dest_id=#1',
                                                        '/^shanghai\/lines\/([a-z0-9]+)-([0-9]+)-([0-9]+)-([0-9]+)-([0-9]+)-([0-9]+)-([^-]+)-([0-9]+)-([0-9_]+)$/' => 'a=Index&c=Lines&m=search&webid=2&dest_id=#1&para1=#2&para2=#3&day=#4&priceid=#5&sorttype=#6&keyword=#7&startcity=#8&attrid=#9',
                                                        '/^shanghai\/lines\/([a-z0-9]+)-([0-9]+)-([0-9]+)-([0-9]+)-([0-9]+)-([0-9]+)-([^-]+)-([0-9]+)-([0-9_]+)-([0-9_]+)$/' => 'a=Index&c=Lines&m=search&webid=2&dest_id=#1&para1=#2&para2=#3&day=#4&priceid=#5&sorttype=#6&keyword=#7&startcity=#8&attrid=#9&page=#10',
                                                        '/^shanghai\/(.*)$/' => '#1&webid=2',
                                                        
                                                        '/^beijing$/' => 'a=Index&c=Index&m=Index&webid=3',
                                                        '/^beijing\/jrpass$/' => 'a=Index&c=Index&m=jrpass&webid=3',
                                                        '/^beijing\/law$/' => 'a=Index&c=Index&m=law&webid=3',
                                                        '/^beijing\/contact$/' => 'a=Index&c=Index&m=contact&webid=3',
                                                        '/^beijing\/company$/' => 'a=Index&c=Index&m=company&webid=3',
                                                        '/^beijing\/jpvisa$/' => 'a=Index&c=Index&m=jpvisa&webid=3',
                                                        '/^beijing\/jpwifi$/' => 'a=Index&c=Index&m=jpwifi&webid=3',
                                                        '/^beijing\/agent$/' => 'a=Index&c=Index&m=agent&webid=3',
                                                        '/^beijing\/([a-z0-9]+)$/' => 'a=Index&c=Index&m=line_list&webid=3&dest_id=#1',
                                                        '/^beijing\/lines\/detail\/(\d+)$/' => 'a=Index&c=Lines&m=show&webid=3&aid=#1',
                                                        '/^beijing\/lines\/([a-z0-9]+)$/' => 'a=Index&c=Lines&m=search&webid=3&dest_id=#1',
                                                        '/^beijing\/lines\/([a-z0-9]+)-([0-9]+)-([0-9]+)-([0-9]+)-([0-9]+)-([0-9]+)-([^-]+)-([0-9]+)-([0-9_]+)$/' => 'a=Index&c=Lines&m=search&webid=3&dest_id=#1&para1=#2&para2=#3&day=#4&priceid=#5&sorttype=#6&keyword=#7&startcity=#8&attrid=#9',
                                                        '/^beijing\/lines\/([a-z0-9]+)-([0-9]+)-([0-9]+)-([0-9]+)-([0-9]+)-([0-9]+)-([^-]+)-([0-9]+)-([0-9_]+)-([0-9_]+)$/' => 'a=Index&c=Lines&m=search&webid=3&dest_id=#1&para1=#2&para2=#3&day=#4&priceid=#5&sorttype=#6&keyword=#7&startcity=#8&attrid=#9&page=#10',
                                                        '/^beijing\/(.*)$/' => '#1&webid=3',
                                                        
                                                        
                                                        /*'/^guangzhou$/' => 'a=Index&c=Index&m=Index&webid=7',
                                                        '/^guangzhou\/jrpass$/' => 'a=Index&c=Index&m=jrpass&webid=7',
                                                        '/^guangzhou\/law$/' => 'a=Index&c=Index&m=law&webid=7',
                                                        '/^guangzhou\/contact$/' => 'a=Index&c=Index&m=contact&webid=7',
                                                        '/^guangzhou\/company$/' => 'a=Index&c=Index&m=company&webid=7',
                                                        '/^guangzhou\/([a-z0-9]+)$/' => 'a=Index&c=Index&m=line_list&webid=7&dest_id=#1',
                                                        '/^guangzhou\/lines\/detail\/(\d+)$/' => 'a=Index&c=Lines&m=show&webid=7&aid=#1',
                                                        '/^guangzhou\/lines\/([a-z0-9]+)$/' => 'a=Index&c=Lines&m=search&webid=7&dest_id=#1',
                                                        '/^guangzhou\/lines\/([a-z0-9]+)-([0-9]+)-([0-9]+)-([0-9]+)-([0-9]+)-([0-9]+)-([^-]+)-([0-9]+)-([0-9_]+)$/' => 'a=Index&c=Lines&m=search&webid=7&dest_id=#1&para1=#2&para2=#3&day=#4&priceid=#5&sorttype=#6&keyword=#7&startcity=#8&attrid=#9',
                                                        '/^guangzhou\/lines\/([a-z0-9]+)-([0-9]+)-([0-9]+)-([0-9]+)-([0-9]+)-([0-9]+)-([^-]+)-([0-9]+)-([0-9_]+)-([0-9_]+)$/' => 'a=Index&c=Lines&m=search&webid=7&dest_id=#1&para1=#2&para2=#3&day=#4&priceid=#5&sorttype=#6&keyword=#7&startcity=#8&attrid=#9&page=#10',
                                                        '/^guangzhou\/(.*)$/' => '#1&webid=7',*/
                                                        
                                                        '/^other$/' => 'a=Index&c=Index&m=Index&webid=6',
                                                        '/^other\/jrpass$/' => 'a=Index&c=Index&m=jrpass&webid=6',
                                                        '/^other\/law$/' => 'a=Index&c=Index&m=law&webid=6',
                                                        '/^other\/contact$/' => 'a=Index&c=Index&m=contact&webid=6',
                                                        '/^other\/company$/' => 'a=Index&c=Index&m=company&webid=6',
                                                        '/^other\/jpvisa$/' => 'a=Index&c=Index&m=jpvisa&webid=6',
                                                        '/^other\/jpwifi$/' => 'a=Index&c=Index&m=jpwifi&webid=6',
                                                        '/^other\/agent$/' => 'a=Index&c=Index&m=agent&webid=6',
                                                        '/^other\/([a-z0-9]+)$/' => 'a=Index&c=Index&m=line_list&webid=6&dest_id=#1',
                                                        '/^other\/lines\/detail\/(\d+)$/' => 'a=Index&c=Lines&m=show&webid=6&aid=#1',
                                                        '/^other\/lines\/([a-z0-9]+)$/' => 'a=Index&c=Lines&m=search&webid=6&dest_id=#1',
                                                        '/^other\/lines\/([a-z0-9]+)-([0-9]+)-([0-9]+)-([0-9]+)-([0-9]+)-([0-9]+)-([^-]+)-([0-9]+)-([0-9_]+)$/' => 'a=Index&c=Lines&m=search&webid=6&dest_id=#1&para1=#2&para2=#3&day=#4&priceid=#5&sorttype=#6&keyword=#7&startcity=#8&attrid=#9',
                                                        '/^other\/lines\/([a-z0-9]+)-([0-9]+)-([0-9]+)-([0-9]+)-([0-9]+)-([0-9]+)-([^-]+)-([0-9]+)-([0-9_]+)-([0-9_]+)$/' => 'a=Index&c=Lines&m=search&webid=6&dest_id=#1&para1=#2&para2=#3&day=#4&priceid=#5&sorttype=#6&keyword=#7&startcity=#8&attrid=#9&page=#10',
                                                        '/^other\/(.*)$/' => '#1&webid=6',
                                                        
														);
}

//$config['ROUTE']['/^([0-9a-z]+)$/']	=	'a=Member&c=Space&m=index&u=#1';//个人主页
if (!empty($globalConfig['SESSION_NAME'])) 		
    $config['SESSION_OPTIONS']['name'] 		= $globalConfig['SESSION_NAME'];
if (!empty($globalConfig['SESSION_DOMAIN']))	
    $config['SESSION_OPTIONS']['domain'] 	= $globalConfig['SESSION_DOMAIN'];
    


return array_merge($globalConfig,$web1Config,$web2Config,$web3Config,$web5Config,$web6Config,require './data/config/db.inc.php', $config);

?>