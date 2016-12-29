<?php

if ( !function_exists('version_compare') || version_compare( phpversion(), '5', '<' ) ){
    include_once( 'ueditor_php4.php' ) ;
}
	
else{
    include_once( 'ueditor_php5.php' ) ;
}
	
// 载入基本配置
require('ueditor.inc.php');
