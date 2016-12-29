<?php
/**
 * Created by JetBrains PhpStorm.
 * User: taoqili
 * Date: 12-7-18
 * Time: 上午11: 32
 * UEditor编辑器通用上传类
 */
class Uploader
{
    private $fileField;            //文件域名
    private $file;                 //文件上传对象
    private $config;               //配置信息
    private $oriName;              //原始文件名
    private $fileName;             //新文件名
    private $fullName;             //完整文件名,即从当前配置目录开始的URL
    private $fileSize;             //文件大小
    private $fileType;             //文件类型
    private $stateInfo;            //上传状态信息,
    private $stateMap = array(    //上传状态映射表，国际化用户需考虑此处数据的国际化
        "SUCCESS" ,                //上传成功标记，在UEditor中内不可改变，否则flash判断会出错
        // "文件大小超出 upload_max_filesize 限制" ,
        '\u6587\u4ef6\u5927\u5c0f\u8d85\u51fa\u9650\u5236',
        // "文件大小超出 MAX_FILE_SIZE 限制" ,
        '\u6587\u4ef6\u5927\u5c0f\u8d85\u51fa\u9650\u5236',
        // "文件未被完整上传" ,
        '\u6587\u4ef6\u672a\u88ab\u5b8c\u6574\u4e0a\u4f20',
        // "没有文件被上传" ,
        '\u6ca1\u6709\u6587\u4ef6\u88ab\u4e0a\u4f20',
        // "上传文件为空" ,
        '\u4e0a\u4f20\u6587\u4ef6\u4e3a\u7a7a',
//        "POST" => "文件大小超出 post_max_size 限制" ,
        'POST' => '\u6587\u4ef6\u5927\u5c0f\u8d85\u51fa\u9650\u5236',
        // "SIZE" => "文件大小超出网站限制" ,
        'SIZE' => '\u6587\u4ef6\u5927\u5c0f\u8d85\u51fa\u7f51\u7ad9\u9650\u5236',
        // "TYPE" => "不允许的文件类型" ,
        'TYPE' => '\u4e0d\u5141\u8bb8\u7684\u6587\u4ef6\u7c7b\u578b',
        // "DIR" => "目录创建失败" ,
        'DIR' => '\u76ee\u5f55\u521b\u5efa\u5931\u8d25',
        // "IO" => "输入输出错误" ,
        'IO' => '\u8f93\u5165\u8f93\u51fa\u9519\u8bef',
        //"UNKNOWN" => "未知错误" ,
        'UNKNOWN'=>'\u672a\u77e5\u9519\u8bef',
        // "MOVE" => "文件保存时出错"
        'MOVE' => '\u6587\u4ef6\u4fdd\u5b58\u65f6\u51fa\u9519'
    );

    /**
     * 构造函数
     * @param string $fileField 表单名称
     * @param array $config  配置项
     * @param bool $base64  是否解析base64编码，可省略。若开启，则$fileField代表的是base64编码的字符串表单名
     */
    public function __construct( $fileField , $config , $base64 = false )
    {
        $this->fileField = $fileField;
        $this->config = $config;
        $this->stateInfo = $this->stateMap[ 0 ];
        $this->upFile( $base64 );
    }

    /**
     * 上传文件的主处理方法
     * @param $base64
     * @return mixed
     */
    private function upFile( $base64 )
    {
        //处理base64上传
        if ( "base64" == $base64 ) {
            $content = $_POST[ $this->fileField ];
            $this->base64ToImage( $content );
            return;
        }

        //处理普通上传
        $file = $this->file = $_FILES[ $this->fileField ];
        if ( !$file ) {
            $this->stateInfo = $this->getStateInfo( 'POST' );
            return;
        }
        if ( $this->file[ 'error' ] ) {
            $this->stateInfo = $this->getStateInfo( $file[ 'error' ] );
            return;
        }
        if ( !is_uploaded_file( $file[ 'tmp_name' ] ) ) {
            $this->stateInfo = $this->getStateInfo( "UNKNOWN" );
            return;
        }

        $this->oriName = $file[ 'name' ];
        $this->fileSize = $file[ 'size' ];
        $this->fileType = $this->getFileExt();

        if ( !$this->checkSize() ) {
            $this->stateInfo = $this->getStateInfo( "SIZE" );
            return;
        }
        if ( !$this->checkType() ) {
            $this->stateInfo = $this->getStateInfo( "TYPE" );
            return;
        }
        $this->fullName = $this->getFolder() . '/' . $this->getName();
        if ( $this->stateInfo == $this->stateMap[ 0 ] ) {
            if ( !move_uploaded_file( $file[ "tmp_name" ] , $this->fullName ) ) {
                $this->stateInfo = $this->getStateInfo( "MOVE" );

            }
            else
            {
                $waterfile = "../../../../application/config/watermark.php";

                if(file_exists($waterfile))
                {
                    $water = include($waterfile);//引入水印配置文件

                    //如果开启了水印设置，则添加水印 //添加生成缩略图判断,如果关闭了生成缩略图则不添加水印.
                    $bigimg=$this->fullName;//大图地址
                    if($water['watermark']['photo_markon'] == '1')
                    {

                        $this->setWater(
                            $bigimg,
                            $water['watermark']['photo_markimg'],
                            $water['watermark']['photo_marktext'],
                            $water['watermark']['photo_fontcolor'],
                            $water['watermark']['photo_waterpos'],
                            $water['watermark']['photo_fontsize'],
                            $water['watermark']['photo_marktype'],
                            $water['watermark']['photo_diaphaneity']
                        );
                    }

                }
                else{ echo 'not exist';}

            }
        }
    }

    /**
     * 处理base64编码的图片上传
     * @param $base64Data
     * @return mixed
     */
    private function base64ToImage( $base64Data )
    {
        $img = base64_decode( $base64Data );
        $this->fileName = time() . rand( 1 , 10000 ) . ".png";
        $this->fullName = $this->getFolder() . '/' . $this->fileName;
        if ( !file_put_contents( $this->fullName , $img ) ) {
            $this->stateInfo = $this->getStateInfo( "IO" );
            return;
        }
        $this->oriName = "";
        $this->fileSize = strlen( $img );
        $this->fileType = ".png";
    }

    /**
     * 获取当前上传成功文件的各项信息
     * @return array
     */
    public function getFileInfo()
    {
        return array(
            "originalName" => $this->oriName ,
            "name" => $this->fileName ,
            "url" => $this->fullName ,
            "size" => $this->fileSize ,
            "type" => $this->fileType ,
            "state" => $this->stateInfo
        );
    }

    /**
     * 上传错误检查
     * @param $errCode
     * @return string
     */
    private function getStateInfo( $errCode )
    {
        return !$this->stateMap[ $errCode ] ? $this->stateMap[ "UNKNOWN" ] : $this->stateMap[ $errCode ];
    }

    /**
     * 重命名文件
     * @return string
     */
    private function getName()
    {
        $count = 0;
        $dir = $this->getFolder();
        $timeStamp = time();
        if ($format = $this->config[ "fileNameFormat" ]) {

            $ext = $this->getFileExt();
            $oriName = substr($this->oriName, 0, strrpos($this->oriName, '.'));
            $randNum = rand(1, 10000000000);

            //过滤非法字符
            $format = preg_replace("/[\|\?\"\<\>\/\*\\\\]+/", '', $format);

            $d = split('-', date("Y-y-m-d-H-i-s"));
            $format = str_replace("{yyyy}", $d[0], $format);
            $format = str_replace("{yy}", $d[1], $format);
            $format = str_replace("{mm}", $d[2], $format);
            $format = str_replace("{dd}", $d[3], $format);
            $format = str_replace("{hh}", $d[4], $format);
            $format = str_replace("{ii}", $d[5], $format);
            $format = str_replace("{ss}", $d[6], $format);
            $format = str_replace("{time}", $timeStamp, $format);
            $format = str_replace("{filename}", $oriName, $format);

            if(preg_match("/\{rand\:([\d]*)\}/i", $format, $matches)) {
                $format = preg_replace("/\{rand\:[\d]*\}/i", substr($randNum, 0, $matches[1]), $format);
            }

            //过滤非法字符
            $format = preg_replace("/[\|\?\"\<\>\/\*\\\\]+/", '', $format);

            $fileName = $format.$ext;
            while (file_exists($dir.'/'.$fileName)){
                $fileName = $format.'_'.(++$count).$ext;
            }
        } else {
            do{
                $fileName = time().rand(1, 10000).$this->getFileExt();
            } while (file_exists($dir.'/'.$fileName));
        }
        return $this->fileName = $fileName;
    }

    /**
     * 文件类型检测
     * @return bool
     */
    private function checkType()
    {
        return in_array( $this->getFileExt() , $this->config[ "allowFiles" ] );
    }

    /**
     * 文件大小检测
     * @return bool
     */
    private function  checkSize()
    {
        return $this->fileSize <= ( $this->config[ "maxSize" ] * 1024 );
    }

    /**
     * 获取文件扩展名
     * @return string
     */
    private function getFileExt()
    {
        return strtolower( strrchr( $this->file[ "name" ] , '.' ) );
    }

    /**
     * 按照日期自动创建存储文件夹
     * @return string
     */
    private function getFolder()
    {
        $pathStr = $this->config[ "savePath" ];
        if ( strrchr( $pathStr , "/" ) != "/" ) {
            $pathStr .= "/";
        }
        $pathStr .= date( "Ymd" );
        if ( !file_exists( $pathStr ) ) {
            if ( !mkdir( $pathStr , 0777 , true ) ) {
                return false;
            }
        }
        return $pathStr;
    }
    //添加水印

    /*----

    $imgSrc：目标图片，可带相对目录地址，
    $markImg：水印图片，可带相对目录地址，支持PNG和GIF两种格式，如水印图片在执行文件mark目录下，可写成：mark/mark.gif
    $markText：给图片添加的水印文字
    $TextColor：水印文字的字体颜色
    $markPos：图片水印添加的位置，取值范围：0~9
    0：随机位置，在1~8之间随机选取一个位置
    1：顶部居左 2：顶部居中 3：顶部居右 4：左边居中
    5：图片中心 6：右边居中 7：底部居左 8：底部居中 9：底部居右
    $fontType：具体的字体库，可带相对目录地址
    $markType：图片添加水印的方式，img代表以图片方式，text代表以文字方式添加水印



    ----------*/


    private function setWater($imgSrc,$markImg,$markText,$TextColor,$markPos,$fontSize,$markType,$markDiaphaneity)
    {


        $srcInfo = @getimagesize($imgSrc);
        $srcImg_w    = $srcInfo[0];
        $srcImg_h    = $srcInfo[1];
        if($srcImg_w<300) return;

        switch ($srcInfo[2])
        {
            case 1:
                $srcim =imagecreatefromgif($imgSrc);
                break;
            case 2:
                $srcim =imagecreatefromjpeg($imgSrc);
                break;
            case 3:
                $srcim =imagecreatefrompng($imgSrc);
                break;
            default:
                die("不支持的图片文件类型");
                exit;
        }

        if(!strcmp($markType,"img")) //使用图片加水印.
        {
            $markImg = '../../../../../data/mark/'.$markImg;

            if(!file_exists($markImg) || empty($markImg))
            {
                return;
            }

            $markImgInfo = @getimagesize($markImg);
            $markImg_w    = $markImgInfo[0];
            $markImg_h    = $markImgInfo[1];

            //如果水印图大于要加水印的图片,则退出.
            /* if($markWidth < $markImg_w || $markHeight < $markImg_h)
             {
                 return;
             }*/

            switch ($markImgInfo[2])
            {
                case 1:
                    $markim =imagecreatefromgif($markImg);
                    break;
                case 2:
                    $markim =imagecreatefromjpeg($markImg);
                    break;
                case 3:
                    $markim =imagecreatefrompng($markImg);
                    break;
                default:
                    die("不支持的水印图片文件类型");
                    exit;
            }

            $logow = $markImg_w;
            $logoh = $markImg_h;
        }

        if(!strcmp($markType,"text"))
        {
            // $fontSize = 16;

            $fontType="../../../../../data/mark/STXINWEI.TTF";

            if(!empty($markText))
            {
                if(!file_exists($fontType))
                {
                    echo " fonttype not exist";
                    return;
                }
            }
            else {
                return;
            }

            $box = @imagettfbbox($fontSize, 0, $fontType,$markText);

            $logow = max($box[2], $box[4]) - min($box[0], $box[6]);
            $logoh = max($box[1], $box[3]) - min($box[5], $box[7]);
        }

        if($markPos == 0)
        {
            $markPos = rand(1, 9);
        }

        switch($markPos)
        {
            case 1:
                $x = +5;
                $y = +20;
                break;
            case 2:
                $x = ($srcImg_w - $logow) / 2;
                $y = +20;
                break;
            case 3:
                $x = $srcImg_w - $logow - 5;
                $y = +20;
                break;
            case 4:
                $x = +5;
                $y = ($srcImg_h - $logoh) / 2;
                break;
            case 5:
                $x = ($srcImg_w - $logow) / 2;
                $y = ($srcImg_h - $logoh) / 2;
                break;
            case 6:
                $x = $srcImg_w - $logow - 5;
                $y = ($srcImg_h - $logoh) / 2;
                break;
            case 7:
                $x = +5;
                $y = $srcImg_h - $logoh - 5;
                break;
            case 8:
                $x = ($srcImg_w - $logow) / 2;
                $y = $srcImg_h - $logoh - 5;
                break;
            case 9:
                $x = $srcImg_w - $logow - 5;
                $y = $srcImg_h - $logoh -5;
                break;
            default:
                die("此位置不支持");
                exit;
        }

        $dst_img = @imagecreatetruecolor($srcImg_w, $srcImg_h);
        imagecopy ( $dst_img, $srcim, 0, 0, 0, 0, $srcImg_w, $srcImg_h);

        if(!strcmp($markType,"img"))
        {
            // imagecopy($dst_img, $markim, $x, $y, 0, 0, $logow, $logoh);
            //imagedestroy($markim);
            //imagealphablending($watermark_logo, true);
            imagecopymerge($dst_img, $markim, $x, $y, 0, 0, $logow, $logoh, $markDiaphaneity);
            imagedestroy($markim);

        }

        if(!strcmp($markType,"text"))
        {
            $TextColor=str_replace('rgb(','',$TextColor);
            $TextColor=str_replace(')','',$TextColor);
            $rgb = explode(',', $TextColor);

            $color = imagecolorallocate($dst_img, intval($rgb[0]), intval($rgb[1]), intval($rgb[2]));

            imagettftext($dst_img, $fontSize, 0, $x, $y, $color, $fontType,$markText);


        }

        switch ($srcInfo[2])
        {
            case 1:
                imagegif($dst_img, $imgSrc);
                break;
            case 2:
                imagejpeg($dst_img, $imgSrc);
                break;
            case 3:
                imagepng($dst_img, $imgSrc);
                break;
            default:
                die("不支持的水印图片文件类型");
                exit;
        }

        imagedestroy($dst_img);
        imagedestroy($srcim);
    }
}