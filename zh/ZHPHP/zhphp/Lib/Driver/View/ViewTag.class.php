<?php
if (!defined("ZHPHP_PATH"))
    exit('No direct script access allowed');
//.-----------------------------------------------------------------------------------
// |  Software: [ZHPHP framework]
// |   Version: 2014.06
// |-----------------------------------------------------------------------------------
// |    Author: 周鸿 <136871204@qq.com>
// | Copyright (c) 2014, 周鸿 <136871204@qq.com>.All Rights Reserved.
// |-----------------------------------------------------------------------------------

/**
 * ZHPHP模板引擎标签解析类
 * @package        View
 * @subpackage  ZHPHP模板
 * @author      周鸿 <136871204@qq.com>
 */
class ViewTag {
    /**
     * block 块标签       1为块标签  0独立标签
     * 块标题不用设置，行标签必须设置
     * 设置时不用加前面的_
     */
     public $tag = array(
        'foreach' => array('block' => 1, 'level' => 4),
        'while' => array('block' => 1, 'level' => 4),
        'if' => array('block' => 1, 'level' => 5),
        'elseif' => array('block' => 0),
        'else' => array('block' => 0),
        'switch' => array('block' => 1),
        'case' => array('block' => 1),
        'break' => array('block' => 0),
        'default' => array('block' => 0),
        'load' => array('block' => 0),
        'include' => array('block' => 0),
        'list' => array('block' => 1, 'level' => 5),
        'js' => array('block' => 0),
        'css' => array('block' => 0),
        'empty' => array('block' => 0),
        'noempty' => array('block' => 0),
        
        'upload' => array('block' => 0), //uploadif上传组件
        'ueditor' => array('block' => 0),
        "zhjs" => array("block" => 0),
        "tourjs" => array("block" => 0),
        "pagejs" => array("block" => 0),
        'jquery' => array('block' => 0),
        'bootstrap' => array('block' => 0),
        
        'define' => array("block" => 0),
        'html_options' => array("block" => 0),
        
        
     );
     
     //格式化参数 字符串加引号
     private function formatArg($arg)
     {
        $valueFormat = trim(trim($arg, "'"), '"');
        return is_numeric($valueFormat) ? $valueFormat : '"' . $valueFormat . '"';
     }
     
     /**
     * 替换标签属性变量或常量为php表示形式
     * @param array $attr 标签属性
     * @param bool $php 返回PHP语法格式
     * @return mixed
     */
    private function replaceAttrConstVar($attr, $php = true)
    {
        foreach ($attr as $k => $at) {
            //替换变量
            $attr[$k] = preg_replace('/\$\w+\[.*\](?!=\[)|\$\w+(?!=[a-z])/', '<?php echo \0;?>', $attr[$k]);
        }
        return $attr;
    }
    
    //定义常量
    public function _define($attr, $content)
    {
        $name = $attr['name'];
        $value = is_numeric($attr['value']) ? $attr['value'] : "'" . $attr['value'] . "'";
        $str = "";
        $str .= "<?php ";
        $str .= "define('{$name}',$value);";
        $str .= ";?>";
        return $str;
    }

    //文件上传插件
    public function _upload($attr, $content, $view = null)
    {
        $uploadify_url = __ZHPHP_EXTEND__ . '/Org/Uploadify/'; //uploadify目录
        static $_zh_uploadify_js = false; //js文件只加载一次
        $attr = array_change_key_case_d($attr, 0);
        //表单类型 是点击input过来的，还是img图片（缩略图）过来的
        $_input_type = isset($attr['input_type']) && !empty($attr['input_type']) ? $attr['input_type'] : "input";
        $_elem_id = isset($attr['elem_id']) && !empty($attr['elem_id']) ? $attr['elem_id'] : ""; //表单类型
        $_name = isset($attr['name']) ? $attr['name'] : false; //上传表单name
        $_post = isset($attr['post']) ? $attr['post'] . ',' : ''; //POST数据
        if ($_name === false) {
            throw_exception("upload上传标签必须设置name属性");
        }
        //如果有[]就去除[]
        $name = str_replace("[]", "", $_name);
        $id = "zh_uploadify_" . $name;
        
        //是否加水印
        $_water = isset($attr['water']) ? $attr['water'] : false;
        if($_water == false || $_water == 0 ){
            $water=intval(C("WATER_ON"));
        }else{
            $water=($_water == 'false' ? 0 : 1);
        }
        //是否显示加水印复选框true 显示 false 不显示
        $_waterbtn = isset($attr['waterbtn']) && $attr['waterbtn'] == 'false' ? 0 : 1;
        $width = isset($attr['width']) ? trim($attr['width'], "px") : "200"; //（预览图的宽度）
        $height = isset($attr['height']) ? trim($attr['height'], "px") : "150"; //预览图的高度
        $removeTimeout = isset($attr['removetimeout']) ? $attr['removetimeout'] : 0; //提示框消失时间
        $upload_img_max_width = isset($attr['upload_img_max_width']) ? intval($attr['upload_img_max_width']) : intval(C('upload_img_max_width')); //图片最大宽度
        $upload_img_max_height = isset($attr['upload_img_max_height']) ? intval($attr['upload_img_max_height']) : intval(C('upload_img_max_height')); //图片最大宽度
        $thumb_type = isset($attr['thumb_type']) ? intval($attr['thumb_type']) : intval(C('thumb_type')); //图片最大宽度
        $size = isset($attr['size']) ? str_ireplace("MB", "", $attr['size']) . "MB" : "2MB"; //文件上传大小单位KB、MB、GB
        $thumb_size = isset($attr['thumb_size']) ? $attr['thumb_size'] :'';
        
        
        //允许上传文件类型
        if (isset($attr['type']) && !empty($attr['type'])) {
            //转换成array
            //例如
            /*  [type] => jpg,png,gif,jpeg 转换成
            Array
            (
                [0] => jpg
                [1] => png
                [2] => gif
                [3] => jpeg
            )
            */
            $_type = explode(";", str_replace(array(",", "*."), array(";", ""), $attr['type']));
            //换行加*.jpg等
            /*例如
            Array
            (
                [0] => *.jpg
                [1] => *.png
                [2] => *.gif
                [3] => *.jpeg
            )
            */
            foreach ($_type as $_type_k => $_type_t) {
                $_type[$_type_k] = '*.' . $_type_t;
            }
            //在此转换成*.jpg;*.png;*.gif;*.jpeg形式
            $type = implode(";", $_type);
        } else {
            //没有传入type的默认设置
            $type = "*.gif;*.jpg;*.png;*.jpeg";
        }
         $upload_dir = isset($attr['dir']) ? $attr['dir'] : ""; //上传文件存放目录
        //是否关闭上传进度条,没有传入 默认赋值  “zh_uploadify_zhcms_queue”
        $_queueclose = isset($attr['type']) ? $attr['type'] : "false";
        $queueclose = $_queueclose == 'true' || $_queueclose == '1' ? "true" : $id . "_queue";
        //是否显示描述
        $_alt = isset($attr['alt']) ? $attr['alt'] : 'true';
        $alt = $_alt == 'true' || $_alt == '1' ? "true" : 'false';
        //是上传文件大小等提示信息true是false不显示
        $_message = isset($attr['message']) ? $attr['message'] : 'true';
        $message = $_message == 'true' || $_message == '1' ? "block" : 'none';
        $limit = isset($attr['limit']) ? $attr['limit'] : "6"; //上传文件数量
        //上传图片时生成不同尺寸图片
        //例1：<upload name='img' thumb='200,200,500,500'/>
        $thumb = isset($attr['thumb']) ? $attr['thumb'] : ''; //生成缩略图尺寸
        $data = isset($attr['data']) ? $attr['data'] : false; //编辑时的图片数据
        if (!empty($thumb) && count(explode(",", $thumb)) % 2 !== 0) {
            DEBUG && halt("upload标签的thumb属性必须是数值并且成对设置如200,200,300,300");
        }
        //过滤非法数据，用于编辑显示使用
        if ($data) {
            $varName = preg_replace('/[\{\}\$]/', '', $attr['data']);
            if (isset($view->vars[$varName])) {
                $imgData = $view->vars[$varName];
                foreach ($imgData as $k => $_img) {
                    if (empty($_img['path'])) {
                        //删除path为空的图片元素
                        unset($view->vars[$varName][$k]);
                    }
                }
            }
        }
        //设置上传成功的图片数，上传时0，编辑时统计图片数据
        if ($data && isset($view->vars[$data])) {
            //编辑时统计图片数量
            $uploadsSuccessful = count($view->vars[$varName]);
        } else {
            //上传时初始上传成功文件为0
            $uploadsSuccessful = 0;
        }
        //编辑视图时显示缩略图片
        $uploadFileStr = '';
        if ($data) {
            $uploadFileStr .= '<?php
            $_uploadStr="";//编译文件需要的PHP字符串表示
            $upFileId=0;//第几张图片
            if(!empty($this->vars["' . $varName . '"])){
                //读取图片数据
                foreach ($this->vars["' . $varName . '"] as $f) {
                    $upFileId++;
                    $url = \'__ROOT__/\' . $f["path"];
                    $_uploadStr.="<li><div class=\'delUploadFile\'></div>";
                    $_uploadStr.="<img src=" . $url . " path=" . $f["path"] . " width=\'' . $width . 'px\' height=\'' . $height . 'px\'/>";
                    //显示图片alt
                    if(isset($f["alt"])){
                        $_uploadStr.="<div class=\'upload_title\'>
                        <input type=\'text\'  value=\'".$f["alt"]."\' name=\'' . $name . '[".$upFileId."][alt]\'>
                        </div>";
                    }
                    //显示原图
                    $_uploadStr.="<input t=\'file\' type=\'hidden\' name=\'' . $name . '[".$upFileId."][path]\' value=\'" . $f["path"] . "\'/>";
                    //缩略图
                    if(isset($f["thumb"])){
                        foreach($f["thumb"] as $thumbFile){
                            $_uploadStr.="<input t=\'file\' type=\'hidden\' name=\'' . $name . '[".$upFileId."][thumb][]\' value=\'" . $thumbFile. "\'/>";
                        }
                    }
                    $_uploadStr.="</li>";
                }
            }
            echo $_uploadStr;
        ;
        ?>';
        }
        $get = $_GET;
        unset($get['m']);
        $phpScript =  __WEB__ . '?' . http_build_query($get) . '&m=keditor_upload'; //PHP处理文件
        $str = '';
        if (!$_zh_uploadify_js) {
            $_zh_uploadify_js = true; //只加载一次
            $str .= '<link rel="stylesheet" type="text/css" href="' . $uploadify_url . 'uploadify.css" />
            <script type="text/javascript" src="' . $uploadify_url . 'jquery.uploadify.min.js"></script>
            <script type="text/javascript">
            var ZHPHP_CONTROL         = "' . $phpScript . '&g=' . GROUP_NAME . '";
            var UPLOADIFY_URL    = "' . $uploadify_url . '";
            var ZHPHP_UPLOAD_THUMB    ="' . $thumb . "\";\n";
            //已经成功上传的文件
            $uploadTotal = 0;
            if ($data && isset($view->vars[$data])) {
                $uploadTotal = count($view->vars[$varName]);
            }
            //定义上传成功文件数用于JS使用，主要是编辑时使用
            $str .= 'ZHPHP_UPLOAD_TOTAL = ' . $uploadTotal;
            $str .= '</script>
            <script type="text/javascript" src="' . $uploadify_url . 'zh_uploadify.js"></script>';
        }    
        $str .= '
                <script type="text/javascript">
                    $(function() {
                        zh_uploadify_options.removeTimeout  =' . $removeTimeout . ';
                        zh_uploadify_options.fileSizeLimit  ="' . $size . '";
                        zh_uploadify_options.fileTypeExts   ="' . $type . '";
                        zh_uploadify_options.queueID        ="' . $queueclose . '";
                        zh_uploadify_options.showalt        =' . $alt . ';
                        zh_uploadify_options.uploadLimit    =' . $limit . ';
                        zh_uploadify_options.input_type    ="' . $_input_type . '";
                        zh_uploadify_options.elem_id    ="' . $_elem_id . '";
                        zh_uploadify_options.upload_img_max_width    ="' . $upload_img_max_width . '";
                        zh_uploadify_options.upload_img_max_    ="' . $upload_img_max_height . '";
                        zh_uploadify_options.success_msg    ="正在上传...";//上传成功提示文字
                        zh_uploadify_options.formData ={' . $_post . 'water : "' . $water . '",upload_img_max_width:"' . $upload_img_max_width . '",upload_img_max_height:"' . $upload_img_max_height . '",thumb_type:"'.$thumb_type.'",fileSizeLimit:'.(intval($size)*1024*1024).', someOtherKey:1,' . session_name() . ':"' . session_id() . '",upload_dir:"' . $upload_dir . '",allow_type:"'.$type.'",thumb_size:"'.$thumb_size.'",zhphp_upload_thumb:"' . $thumb . '"};
                        zh_uploadify_options.thumb_width =' . $width . ';
                        zh_uploadify_options.thumb_height          =' . $height . ';
                        zh_uploadify_options.uploadsSuccessNums = ' . $uploadsSuccessful . ';
                        $("#' . $id . '").uploadify(zh_uploadify_options);
                        });
                </script>
                <input type="file" name="up" id="' . $id . '"/>
                <div class="' . $id . '_msg num_upload_msg" style="display:' . $message . '">
                ';
                        if ($_waterbtn) {
                            $str .= '<input type="checkbox" id="add_upload_water" uploadify_id="zh_uploadify_' . $_name . '" ' . ($water ? "checked='checked'" : "") . '/><strong style="color:#03565E">是否添加水印</strong>';
                        }
                        $str .= '<span></span>单文件最大<strong>' . $size . '，允许上传类型' . $type . '</strong>
                </div>
                
                <div id="' . $id . '_queue"></div>
                <div class="' . $id . '_files uploadify_upload_files" input_file_id ="' . $id . '">
                    <ul>' . $uploadFileStr . '</ul>
                    <div style="clear:both;"></div>
                </div>';
        return $str;
    }

    //百度编辑器
    public function _ueditor($attr, $content){
//        $ueditor_path = __ZHPHP_EXTEND__ . '/Org/Editor/Ueditor/'; //url路径
        $attr = array_change_key_case_d($attr, 0);
        //替换标签属性变量或常量为php表示形式
        $attr = $this->replaceAttrConstVar($attr);
        $style = isset($attr['style']) ? $attr['style'] : C("EDITOR_STYLE"); //1 完整  2精简
        $name = isset($attr['name']) ? $attr['name'] : "content";
        $initContent = isset($attr['content']) ? $attr['content'] : ""; //初始化编辑器的内容
        $width = isset($attr['width']) && intval($attr['width']) != 0 ? intval($attr['width']) : C("EDITOR_WIDTH"); //编辑器宽度
        $height = isset($attr['height']) && intval($attr['height']) != 0 ? intval($attr['height']) : C("EDITOR_HEIGHT"); //编辑器高度
        $width = '"' . str_ireplace("px", "", $width) . '"';
        $height = '"' . str_ireplace(array("px", "%"), "", $height) . '"';
        $water = isset($attr['water']) ? $attr['water'] : false; //是否加水印
        $water = $water === false ? intval(C("WATER_ON")) : ($water == 'false' ? 0 : 1); //是否加水印
        $maximagewidth = isset($attr['maximagewidth']) ? $attr['maximagewidth'] : 'false'; //最大图片宽度
        $maximageheight = isset($attr['maximageheight']) ? $attr['maximageheight'] : 'false'; //最大图片高度
        $uploadsize = isset($attr['uploadsize']) ? intval($attr['uploadsize']) * 1000 : C("EDITOR_FILE_SIZE"); //上传文件大小
        $autoClear = isset($attr['autoclear']) ? $attr['autoclear'] : "false"; //清除编辑器初始内容
        $readonly = isset($attr['readonly']) ? $attr['readonly'] : "false"; //编辑区域是否是只读的
        $wordCount = isset($attr['wordcount']) ? $attr['wordcount'] : "true"; //是否开启字数统计
        $maxword = isset($attr['maxword']) ? $attr['maxword'] : C("EDITOR_MAX_STR"); //允许的最大字符数
        $imageupload = isset($attr['imageupload']) && $attr['imageupload'] == 'true' ? '"insertimage",' : ''; //图片上传按钮
        $get = $_GET;
        unset($get['m']);
        $phpScript = isset($attr['php']) ? $attr['php'] : __WEB__ . '?' . http_build_query($get) . '&m=ueditor_upload'; //PHP处理文件
        //图片按钮
        if ($style == 2) {
            $toolbars = "[['FullScreen', 'Source', 'Undo', 'Redo','Bold','test',{$imageupload}'insertcode','preview']]";
        }else{
            $toolbars = "[
            ['fullscreen', 'source', '|', 'undo', 'redo', '|',
                'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
                'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
                'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
                'directionalityltr', 'directionalityrtl', 'indent', '|',
                'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
                'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
                'insertimage', 'emotion', 'scrawl', 'insertvideo', 'music', 'attachment', 'map', 'gmap', 'insertframe','insertcode', 'pagebreak', 'template', 'background', '|',
                'horizontal', 'date', 'time', 'spechars',  'wordimage', '|',
                'inserttable', 'deletetable', 'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols', 'charts', '|',
                'print', 'preview', 'searchreplace']
            ]";
        }
        $str = '';
        if (!defined("ZH_UEDITOR")) {
            $str .= '<script type="text/javascript" charset="utf-8" src="' . __ZHPHP_EXTEND__ . '/Org/Ueditor/ueditor.config.js"></script>';
            $str .= '<script type="text/javascript" charset="utf-8" src="' . __ZHPHP_EXTEND__ . '/Org/Ueditor/ueditor.all.min.js"></script>';
            $str .= '<script type="text/javascript">UEDITOR_HOME_URL="' . __ZHPHP_EXTEND__ . '/Org/Ueditor/"</script>';
            define("ZH_UEDITOR", true);
        }
         $str .= '<script id="zh_' . $name . '" name="' . $name . '" type="text/plain">' . $initContent . '</script>';
        $app_group = GROUP_NAME;
        $str .= "
        <script type='text/javascript'>
        $(function(){
                var ue = UE.getEditor('zh_{$name}',{
                imageUrl:'" . $phpScript . "&g={$app_group}&water={$water}&uploadsize={$uploadsize}&maximagewidth={$maximagewidth}&maximageheight={$maximageheight}'//处理上传脚本
                ,zIndex : 0
                ,autoClearinitialContent:{$autoClear}
                ,initialFrameWidth:{$width} //宽度1000
                ,initialFrameHeight:{$height} //宽度1000
                ,autoHeightEnabled:false //是否自动长高,默认true
                ,autoFloatEnabled:false //是否保持toolbar的位置不动,默认true
                ,maximumWords:{$maxword} //允许的最大字符数
                ,readonly : {$readonly} //编辑器初始化结束后,编辑区域是否是只读的，默认是false
                ,wordCount:{$wordCount} //是否开启字数统计
                ,imagePath:''//图片修正地址
                , toolbars:$toolbars//工具按钮
                , initialStyle:'p{line-height:1em; font-size: 14px; }'
            });
        })
        </script>";
        return $str;
    }
    
    
     //加载CSS文件
    public function _css($attr, $content)
    {
        //p($attr);die;
        //替换标签属性变量或常量为php表示形式
        $attr = $this->replaceAttrConstVar($attr, true);
        return '<link type="text/css" rel="stylesheet" href="' . $attr['file'] . '"/>';
    }
     
    public function _js($attr, $content)
    {
        if (!isset($attr['file'])) {
            error("Js标签必须设置file属性");
        }
        $attr = $this->replaceAttrConstVar($attr, true);
        return '<script type="text/javascript" src="' . $attr['file'] . '"></script>';
    }
     
    public function _list($attr, $content)
    {
        //row=' 显示行数' 
        //from=' 变量'  
        if (!isset($attr['from'])) halt('list标签缺少from属性');
        //name=' 值' 
        if (!isset($attr['name'])) halt('list标签缺少name属性');
        $var = $attr['from'];
        $name = str_replace('$', '', $attr['name']);
        //empty=' 为空时显示内容'
        $empty = isset($attr['empty']) ? $attr['empty'] : ''; //无数据时
        //注：属性start='2' 表示从第2 条数据开始显示
        $start = isset($attr['start']) ? intval($attr['start'] - 1) : 0;
        //属性step='2' 表示每次间隔2 条数据
        $step = isset($attr['step']) ? (int)$attr['step'] : 1;
        $php = '<?php ';
        $php .= '$zh["list"]["' . $name . '"]["total"]=0;'; //初始总计录条数
        $php .= 'if(isset(' . $var . ') && !empty(' . $var . ')):';
        $php .= '$_id_' . $name . '=0;'; //记录集中的第几条
        $php .= '$_index_' . $name . '=0;'; //采用的第几条
        $row = isset($attr['row']) ? (int)$attr['row'] * $step : 1000;
        $php .= '$last' . $name . '=min(' . $row . ',count(' . $var . '));' . "\n"; //共取几条记录
        $php .= '$zh["list"]["' . $name . '"]["first"]=true;' . "\n"; //第一条记录
        $php .= '$zh["list"]["' . $name . '"]["last"]=false;' . "\n"; //第最后一条记录
        $php .= '$_total_' . $name . '=ceil($last' . $name . '/' . $step . ');'; //共有多少条记录
        $php .= '$zh["list"]["' . $name . '"]["total"]=$_total_' . $name . ";\n"; //总记录条数
        $php .= "\$_data_" . $name . " = array_slice($var,$start,\$last" . $name . ");" . "\n"; //取要遍历的数据
        $php .= 'if(count($_data_' . $name . ')==0):echo "' . $empty . '";' . "\n"; //数组为空
        $php .= 'else:' . "\n"; //数组不为空时进行遍历
        $php .= 'foreach($_data_' . $name . ' as $key=>$' . $name . '):' . "\n";
        $php .= 'if(($_id_' . $name . ')%' . $step . '==0):$_id_' . $name . '++;else:$_id_' . $name . '++;continue;endif;' . "\n";
        $php .= '$zh["list"]["' . $name . '"]["index"]=++$_index_' . $name . ';' . "\n"; //第一条记录
        $php .= 'if($_index_' . $name . '>=$_total_' . $name . '):$zh["list"]["' . $name . '"]["last"]=true;endif;?>' . "\n"; //最后一条
        $php .= $content;
        $php .= '<?php $zh["list"]["' . $name . '"]["first"]=false;' . "\n";
        $php .= 'endforeach;' . "\n";
        $php .= 'endif;' . "\n";
        $php .= 'else:' . "\n";
        $php .= 'echo "' . $empty . '";' . "\n";
        $php .= 'endif;?>';
        return $php;
    }
    
    public function _foreach($attr, $content)
    {
        if (empty($attr['from'])) {
            halt('foreach 模板标签必须有from属性', false); //foreach 模板标签必须有from属性
        }
        if (empty($attr['value'])) {
            halt('foreach 模板标签必须有value属性', false); //foreach 模板标签必须有value属性
        }
        $php = ''; //组合成PHP
        $from = $attr['from'];
        $key = isset($attr['key']) ? $attr['key'] : false;
        $value = $attr['value'];
        $name=isset($attr['name']) ? $attr['name'] : '$index'; //无数据时
        //$name = $attr['name'];
        $php .= "<?php if(is_array($from)):?>";
        $php .= "<?php $name=0; ?>";
        if ($key) {
            $php .= '<?php ' . " foreach($from as $key=>$value){ ?>";
        } else {
            $php .= '<?php ' . " foreach($from as $value){ ?>";
        }
        
        $php .= $content;
        $php .= "<?php $name++; ?>";
        $php .= '<?php }?>';
        $php .= "<?php endif;?>";
        return $php;
    }
    
     //load标签的别名，加载模板文件
    public function _include($attr, $content)
    {
        return $this->_load($attr, $content);
    }
     
    /**
     * 加载模板文件
     * @param $attr
     * @param $content
     * @return string
     */
    public function _load($attr, $content)
    {
        if (!isset($attr['file'])) {
            halt('load 模板标签必须有file属性', false); //load标签必须有file属性
        }
        $const = print_const(false, true);
        foreach ($const as $k => $v) {
            $attr['file'] = str_replace($k, $v, $attr['file']);
        }
        $file = str_replace(__ROOT__ . '/', '', trim($attr['file']));
        $view = new ViewZh();
        $view->fetch($file);
        return $view->getCompileContent();
    }
     
     public function _switch($attr, $content, $res)
    {
        $value = $attr['value'];
        $php = ''; //组合成PHP
        $php .= '<?php ' . " switch($value):?>\r\n";
        $php .= preg_replace("/\s*<case/i", "<case", $content);
        $php .= '<?php endswitch;?>';
        return $php;
    }
    
    public function _case($attr, $content, $res)
    {
        $value = $this->formatArg($attr['value']);
        $php = ''; //组合成PHP
        $php .= '<?php ' . " case $value:{?>";
        $php .= $content;
        $php .= '<?php break;}?>';
        return $php;
    }
    
    public function _break($attr, $content, $res)
    {
        return '<?php break;?>';
    }
    
    public function _default($attr, $content, $res)
    {
        return '<?php default;?>';
    }
    
    public function _if($attr, $content, $res){
        if (empty($attr['value'])) {
            halt('if 模板标签必须有value属性', false); //if 模板标签必须有value属性
        }
        $value = $attr['value'];
        $php = ''; //组合成PHP
        $php .= '<?php if(' . $value . '){?>';
        $php .= $content;
        $php .= '<?php }?>';
        return $php;
     }
     
    public function _elseif($attr, $content, $res)
    {
        $value = $attr['value'];
        $php = ''; //组合成PHP
        $php .= '<?php ' . " }elseif($value){ ?>";
        $php .= $content;
        return $php;
    }
    
    public function _else($attr, $content, $res)
    {
        $php = ''; //组合成PHP
        $php .= '<?php ' . " }else{ ?>";
        return $php;
    }
     
     public function _while($attr, $content, $res)
    {
        if (empty($attr['value'])) {
            halt('while模板标签必须有value属性', false);
        }
        $value = $attr['value'];
        $php = ''; //组合成PHP
        $php .= '<?php ' . " while($value){ ?>";
        $php .= $content;
        $php .= '<?php }?>';
        return $php;
    }
    
    public function _empty($attr, $content, $res)
    {
        if (empty($attr['value'])) {
            halt('empty模板标签必须有value属性', false); //empty模板标签必须有value属性
        }
        $value = $attr['value'];
        $php = "";
        $php = '<?php $_emptyVar =isset(' . $value . ')?' . $value . ':null?>';
        $php .= '<?php ' . ' if( empty($_emptyVar)){?>';
        $php .= $content;
        $php .= '<?php }?>';
        return $php;
    }
    
    public function _noempty($attr, $content)
    {
        return '<?php }else{ ?>';
    }
     
     //设置js常量
    public function _jsconst($attr, $content)
    {
    	$const = get_defined_constants(true);
        $arr = preg_grep("/http/", $const['user']);
        $str = "<script type='text/javascript'>\n";
        foreach ($arr as $k => $v) {
        	$k=str_replace('_', '', $k) ;
            $str .= $k. " = '<?php echo \$GLOBALS['user']['$k'];?>';\n";
        }
        $str .= "</script>";
        return $str;
    }
     
     //bootstrap
    public function _bootstrap($attr, $content)
    {
        $str = '';
        $str .= "<link href='__ZHPHP_EXTEND__/Org/bootstrap/css/bootstrap.min.css' rel='stylesheet' media='screen'>\n";
        $str .= "<script src='__ZHPHP_EXTEND__/Org/bootstrap/js/bootstrap.min.js'></script>";
        $str .= '
                <!--[if lte IE 6]>
                <link rel="stylesheet" type="text/css" href="__ZHPHP_EXTEND__/Org/bootstrap/ie6/css/bootstrap-ie6.css">
                <![endif]-->';
        $str .= '
                <!--[if lt IE 9]>
                <script src="__ZHPHP_EXTEND__/Org/bootstrap/js/html5shiv.min.js"></script>
                <script src="__ZHPHP_EXTEND__/Org/bootstrap/js/respond.min.js"></script>
                <![endif]-->';
        return $str;
    }
     
     //js轮换版
    public function _slide($attr, $content)
    {
        return "<script src='__ZHPHP__/../zhjs/js/slide.js'></script>\n";
    }
    
    
     
     //jquery
    public function _jquery($attr, $content)
    {
        return "<script type='text/javascript' src='__ZHPHP_EXTEND__/Org/Jquery/jquery-1.8.2.min.js'></script>\n";
    }
     
    //日历
    public function _cal($attr, $content)
    {
        return "<script src='__ZHPHP__/../zhjs/org/cal/lhgcalendar.min.js'></script>\n";
    }
     
     
     
     
    
    //zhjs
    public function _zhjs($attr, $content)
    {
        //导入jquery框架，zhjs.css ,zhjs.js
        $php = '';
        $php .= "<script type='text/javascript' src='__ZHPHP_EXTEND__/Org/Jquery/jquery-1.8.2.min.js'></script>\n";
        $php .= "<link href='__ZHPHP__/../zhjs/css/zhjs.css' rel='stylesheet' media='screen'>\n";
        $php .= "<script src='__ZHPHP__/../zhjs/js/zhjs.js'></script>\n";
        $php .= $this->_slide(null, null);
        $php .= $this->_cal(null, null);
        $php .= $this->_jsconst(null, null);
        return $php;
    }
    
    //zhjs
    public function _tourjs($attr, $content)
    {
        //导入jquery框架，zhjs.css ,zhjs.js
        $php = '';
        $php .= "<script type='text/javascript' src='__ZHPHP_EXTEND__/Org/Jquery/jquery-1.8.2.min.js'></script>\n";
        $php .= $this->_slide(null, null);
        $php .= $this->_cal(null, null);
        $php .= $this->_jsconst(null, null);
        return $php;
    }
    
    //zhjs
    public function _pagejs($attr, $content)
    {
        //导入jquery框架，zhjs.css ,zhjs.js
        $php = '';
        $php .= "<script type='text/javascript' src='__ZHPHP_EXTEND__/Org/Jquery/jquery-1.8.2.min.js'></script>\n";
        $php .= $this->_slide(null, null);
        $php .= $this->_cal(null, null);
        $php .= $this->_jsconst(null, null);
        return $php;
    }
     
    function _html_options($attr,$content)
    {
        
        /*
        //row=' 显示行数' 
        //from=' 变量'  
        if (!isset($attr['from'])) halt('list标签缺少from属性');
        //name=' 值' 
        if (!isset($attr['name'])) halt('list标签缺少name属性');
        $var = $attr['from'];
        $name = str_replace('$', '', $attr['name']);
        //empty=' 为空时显示内容'
        $empty = isset($attr['empty']) ? $attr['empty'] : ''; //无数据时
        //注：属性start='2' 表示从第2 条数据开始显示
        $start = isset($attr['start']) ? intval($attr['start'] - 1) : 0;
        //属性step='2' 表示每次间隔2 条数据
        $step = isset($attr['step']) ? (int)$attr['step'] : 1;
        $php = '<?php ';
        $php .= '$zh["list"]["' . $name . '"]["total"]=0;'; //初始总计录条数
        $php .= 'if(isset(' . $var . ') && !empty(' . $var . ')):';
        $php .= '$_id_' . $name . '=0;'; //记录集中的第几条
        $php .= '$_index_' . $name . '=0;'; //采用的第几条
        $row = isset($attr['row']) ? (int)$attr['row'] * $step : 1000;
        $php .= '$last' . $name . '=min(' . $row . ',count(' . $var . '));' . "\n"; //共取几条记录
        $php .= '$zh["list"]["' . $name . '"]["first"]=true;' . "\n"; //第一条记录
        $php .= '$zh["list"]["' . $name . '"]["last"]=false;' . "\n"; //第最后一条记录
        $php .= '$_total_' . $name . '=ceil($last' . $name . '/' . $step . ');'; //共有多少条记录
        $php .= '$zh["list"]["' . $name . '"]["total"]=$_total_' . $name . ";\n"; //总记录条数
        $php .= "\$_data_" . $name . " = array_slice($var,$start,\$last" . $name . ");" . "\n"; //取要遍历的数据
        $php .= 'if(count($_data_' . $name . ')==0):echo "' . $empty . '";' . "\n"; //数组为空
        $php .= 'else:' . "\n"; //数组不为空时进行遍历
        $php .= 'foreach($_data_' . $name . ' as $key=>$' . $name . '):' . "\n";
        $php .= 'if(($_id_' . $name . ')%' . $step . '==0):$_id_' . $name . '++;else:$_id_' . $name . '++;continue;endif;' . "\n";
        $php .= '$zh["list"]["' . $name . '"]["index"]=++$_index_' . $name . ';' . "\n"; //第一条记录
        $php .= 'if($_index_' . $name . '>=$_total_' . $name . '):$zh["list"]["' . $name . '"]["last"]=true;endif;?>' . "\n"; //最后一条
        $php .= $content;
        $php .= '<?php $zh["list"]["' . $name . '"]["first"]=false;' . "\n";
        $php .= 'endforeach;' . "\n";
        $php .= 'endif;' . "\n";
        $php .= 'else:' . "\n";
        $php .= 'echo "' . $empty . '";' . "\n";
        $php .= 'endif;?>';
        return $php;*/
        
        $options = $attr['options'];
        $selected = isset($attr['selected']) ? $attr['selected'] : 'null'; //无数据时
        $php = '<?php ';
        $php .= 'if(isset(' . $options . ') && !empty(' . $options . ')):';
        $php .= '$arr["options"]=' . $options . ';';
        $php .= '$arr["selected"]='.$selected.';';
        $php .= 'echo html_options($arr);';
        $php .= 'endif;' . "\n";
        $php .= '?>';
        return $php;
        /*
        $selected = $attr['selected'];
        
        if ($arr['options'])
        {
            $options = (array)$arr['options'];
        }
        elseif ($arr['output'])
        {
            if ($arr['values'])
            {
                foreach ($arr['output'] AS $key => $val)
                {
                    $options["{$arr[values][$key]}"] = $val;
                }
            }
            else
            {
                $options = array_values((array)$arr['output']);
            }
        }
        if ($options)
        {
            foreach ($options AS $key => $val)
            {
                $out .= $key == $selected ? "<option value=\"$key\" selected>$val</option>" : "<option value=\"$key\">$val</option>";
            }
        }

        return $out;*/
    }
    
    
    
    
    
    
    
    
    
    
    
}
