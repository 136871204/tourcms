<?php
if (!defined("ZHPHP_PATH")) exit('No direct script access allowed');
//.-----------------------------------------------------------------------------------
// |  Software: [ZHPHP framework]
// |   Version: 2014.06
// |-----------------------------------------------------------------------------------
// |    Author: 周鸿 <136871204@qq.com>
// | Copyright (c) 2014, 周鸿 <136871204@qq.com>.All Rights Reserved.
// |-----------------------------------------------------------------------------------

/**
 * 系统核心类库包 自动加载优先
 * @package     Core
 * @author      周鸿 <136871204@qq.com>
 */
return array(
    "ip" => ZHPHP_EXTEND_PATH . 'Org/Ip/Ip.class.php', //IP处理类
    "mail" => ZHPHP_EXTEND_PATH . 'Org/Mail/Mail.class.php', //IP处理类
    "UEDITOR_UPLOAD" => ZHPHP_EXTEND_PATH . 'Org/Ueditor/php/ueditor_upload.php', //ueditor
    "KEDITOR_UPLOAD" => ZHPHP_EXTEND_PATH . 'Org/Keditor/php/upload_json.php', //keditor
    "HD_UPLOADIFY" => ZHPHP_EXTEND_PATH . 'Org/Uploadify/hd_uploadify.php', //uploadify上传
    "HD_UPLOADIFY_DEL" => ZHPHP_EXTEND_PATH . 'Org/Uploadify/hd_uploadify.php', //uploadify删除
    "editorCatcherUrl" => ZHPHP_EXTEND_PATH . 'Org/Editor/Ueditor/php/ueditorCatcherUrl.php', //ueditor,TODO:不需要了
);
?>
