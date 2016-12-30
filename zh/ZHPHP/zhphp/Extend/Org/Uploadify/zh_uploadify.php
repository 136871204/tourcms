<?php
if (!defined("ZHPHP_PATH"))
    exit('No direct script access allowed');
// .-----------------------------------------------------------------------------------
// |  Software: [ZHPHP framework]
// |   Version: 2013.01
// |-----------------------------------------------------------------------------------
// |    Author: 周鸿 <136871204@qq.com>
// | Copyright (c) 2012-2013, 周鸿 136871204@qq.com. All Rights Reserved.

header("Content-Type: text/html; charset=utf-8");
//echo 'adfsd';die;
//删除图片 
if (METHOD == "zh_uploadify_del") {
    $files = array_filter(explode("@@", $_POST['file']));
    foreach ($files as $f) {
       is_file($f) && @unlink($f);
    }
    echo 1;
    exit;
}
//是否加水印
C("WATER_ON", $_POST['water']==1);
//图片裁切处理
if ($_POST['upload_img_max_width'] || $_POST['upload_img_max_height']) {
    C('UPLOAD_IMG_RESIZE_ON', true);
    C('upload_img_max_width', $_POST['upload_img_max_width']);
    C('upload_img_max_height', $_POST['upload_img_max_height']);
}
C("UPLOAD_THUMB_ON", false); //关闭生成缩略图
$upload_dir = isset($_POST['upload_dir']) ? $_POST['upload_dir'] : '';
$uploadSize = intval($_POST['fileSizeLimit']);
$data = array();
$upload = new upload($upload_dir,array(),$uploadSize);
$file = $upload->uploadFile();
if ($file) {
    $data['stat'] = 1;
    $data['url'] = __ROOT__ . '/' . $file[0]['path'];
    $data['path'] = $file[0]['path'];
    $data['name'] = $file[0]['filename'];
    $data['isimage'] = in_array(strtolower($file[0]['ext']), array("gif", "png", "jpeg", "jpg")) ? 1 : 0;
    $data['thumb'] = array(); //缩略图文件
    if (isset($_POST['zhphp_upload_thumb'])) {
        $size = explode(",", $_POST['zhphp_upload_thumb']); //获得缩略数数量
        $fileInfo = pathinfo($data['path']); //获得文件名信息
        $image = new Image();
        $id = 0; //缩略图ID
        $thumbFile = array(); //缩略图
        $saveDir = dirname($data['path']);
        for ($i = 0, $total = count($size); $i < $total;) {
            $toFile = $fileInfo['filename'] . '_' . $size[$i] . 'x' . $size[$i + 1] . '.' . $fileInfo['extension'];
            $thumbFile[] = $saveDir . '/' . $toFile;
            $image->thumb($data['path'], $toFile, $size[$i], $size[$i + 1]);
            $i += 2;
        }
        $data['thumb'] = $thumbFile;
    }
} else {
    $data['stat'] = 0;
    $data['msg'] = $upload->error;
}
echo json_encode($data);
exit;
