<?php



/**
 * 公共静态类模块
 * User: Netman
 * Date: 14-4-1
 * Time: 下午1:48
 */
class TourCommon {
    public static $pinyin = array();
    
     /*
	删除一个图片及它的所有缩略图和原图
	*/
	public static function deleteRelativeImage($imgpath)
    {
        
    }
    /*
     * 后台获取搜索词
     * */
    public static function getKeyword($keyword)
    {
        $keyword = str_replace(' ','',trim($keyword));
        $num = substr($keyword,1,strlen($keyword));
        $out = '';
        if(intval($num))
        {
            $out = intval($num);
        }
        else
        {
            $out = $keyword;
        }
       /* $flag = intval($keyword);

        if($flag)
        {
            $num = substr($keyword,1,strlen($keyword));

            $keyword = intval($num);
        }*/

        return $out;
    }
    
    /*
     * 获取子站列表
     * return array
     * */
    public static function getWebList()
    {

        $weblistModel = K("Weblist");
        $arr =$weblistModel->order(" id asc ")->All();
        foreach ($arr as $key => $value) {
            $arr[$key]['webid'] = $value['id'];
            $arr[$key]['webname'] = $value['webname'];
        }
       /* $main=array(
            array(
            'webid' => 0 ,
            'webname'=>'主站'
            )
        );*/
       // $ar = array_merge($main,$arr);
        return $arr;
    }
    
    /**
     *  获取编辑器
     *
     * @access    public
     * @param     string  $fname 表单名称
     * @param     string  $fvalue 表单值
     * @param     string  $nheight 内容高度
     * @param     string  $etype 编辑器类型
     * @param     string  $gtype 获取值类型
     * @param     string  $isfullpage 是否全屏
     * @return    string
     */
   public static function getEditor($fname,$fvalue,$nwidth="700",$nheight="350",$etype="Sline",$ptype='',$gtype="print",$jsEditor=false)
    {
        // TourCommon::getEditor('jseditor','',700,300,'Sline','','print',true);

            require(STATIC_PATH . '/tour/vendor/slineeditor/ueditor.php');
            $UEditor = new UEditor();
            
            $UEditor->basePath = STATIC_PATH.'tour/vendor/slineeditor/';
            
            $nheight = $nheight==400 ? 300 : $nheight;
            $config = $events = array();
            $GLOBALS['tools'] = empty($toolbar[$etype])? $GLOBALS['tools'] : $toolbar[$etype] ;
            $config['toolbars'] = $GLOBALS['tools'];
            $config['minFrameHeight'] = $nheight;
            $config['initialFrameHeight'] = $nheight;
            $config['initialFrameWidth'] = $nwidth;
			if(!$jsEditor)
		    {
              $code = $UEditor->editor($fname, $fvalue, $config, $events);
			}
			else
		    {
			  $code = $UEditor->jseditor($fname,$fvalue,$config,$events);
			}

            if($gtype=="print")
            {
                echo $code;
            }
            else
            {
               return $code;
            }

    }
    
    
    /*
     * 获取编号
     * */
    //获取编号,共6位,不足6位前面被0
    public static function getSeries($id,$prefix)
    {
          $ar = array(
            '01'=>'A',
            '02'=>'B',
            '05'=>'C',
            '03'=>'D',
            '08'=>'E',
            '13'=>'G',
            '14'=>'H',
            '15'=>'I',
            '16'=>'J',
            '17'=>'K',
            '18'=>'L',
            '19'=>'M',
            '20'=>'N',
            '21'=>'O',
            '22'=>'P',
            '23'=>'Q',
            '24'=>'R',
            '25'=>'S',
            '26'=>'T'
          );
        $prefix = $ar[$prefix];
        $len=strlen($id);
        $needlen=4-$len;
        if($needlen==3)$s='000';
        else if($needlen==2)$s='00';
        else if($needlen==1)$s='0';

        $out=$prefix.$s."{$id}";
        return $out;

    }
    
    /*
     * 根据,分隔的属性字符串获取相应的属性数组(修改页面用)
     */
    public static function getSelectedAttr($typeid,$attr_str)
    {
        $productattr_arr=array(1=>'line_attr',2=>'hotel_attr',3=>'car_attr',4=>'article_attr',5=>'spot_attr',6=>'photo_attr',13=>'tuan_attr');
        $attrtable = $typeid<14 ? $productattr_arr[$typeid] : 'model_attr';
        $attrid_arr=explode(',',$attr_str);
        $attr_arr=array();
        foreach($attrid_arr as $k=>$v)
        {
            if($typeid<14)
            {
                $attr=M($attrtable)->where("pid!=0 and id='$v'")->find();
            }
            else
            {
                $attr=M($attrtable)->where("pid!=0 and id='$v' and typeid='$typeid'")->find();
            }

            if($attr['id'])
            {
              $attr_arr[]=$attr;
            }
        }
        return $attr_arr;
    }
    
    
    /*
     * 根据,分隔的字符串获取图标数组(修改页面用)
     * */
    public static function getSelectedIcon($iconlist)
    {
        $iconModel=K('Icon');
        $iconarr=array();
        if(!empty($iconlist)){
            $iconid_arr=explode(',',$iconlist);
            $all_line_icon=cache('all_line_icon');
            
            if(empty($all_line_icon)){
                foreach($iconid_arr as $k=>$v)
                {
                   $icon=$iconModel->find($v);
                   if($icon['id'])
                       $iconarr[]=$icon;
                }
            }else{
                foreach($iconid_arr as $k=>$v)
                {
                    foreach($all_line_icon as $ticon)
                    {
                        if($ticon['id']==$v){
                            $iconarr[]=$ticon;
                        }
                    }
                }
            }
            
        }
       

       return $iconarr;
    }
    
    
    /**
     *  获取拼音信息
     *
     * @access    public
     * @param     string  $str  字符串
     * @param     int  $ishead  是否为首字母
     * @param     int  $isclose  解析后是否释放资源
     * @return    string
     */
    public static function getPinYin($str, $ishead=0, $isclose=1)
    {
        $str = iconv('utf-8','gbk//ignore',$str);
        $restr = '';
        $str = trim($str);
        $slen = strlen($str);
        if($slen < 2)
        {
            return $str;
        }

        if(count(self::$pinyin) == 0)
        {
            //echo STATIC;die;
            $fp = fopen(ROOT_PATH.'Static/tour/vendor/pinyin/pinyin.dat', 'r');
            while(!feof($fp))
            {
                $line = trim(fgets($fp));
                self::$pinyin[$line[0].$line[1]] = substr($line, 3, strlen($line)-3);
            }
            fclose($fp);
        }
        for($i=0; $i<$slen; $i++)
        {
            if(ord($str[$i])>0x80)
            {
                $c = $str[$i].$str[$i+1];
                $i++;
                if(isset(self::$pinyin[$c]))
                {
                    if($ishead==0)
                    {
                        $restr .= self::$pinyin[$c];
                    }
                    else
                    {
                        $restr .= self::$pinyin[$c][0];
                    }
                }else
                {
                    $restr .= "_";
                }
            }else if( preg_match("/[a-z0-9]/i", $str[$i]) )
            {
                $restr .= $str[$i];
            }
            else
            {
                $restr .= "_";
            }
        }
        if($isclose==0)
        {
            unset(self::$pinyin);
        }
        $sheng = "/.*sheng.*/";
        $shi = "/.*shi.*/";
        $qu = "/.*qu.*/";
        if(preg_match($sheng,$restr,$matches))
        {
            $restr = str_replace('sheng','',$matches[0]);
        }
        if(preg_match($shi,$restr,$matches))
        {
            $restr = str_replace('shi','',$matches[0]);
        }
        if(preg_match($qu,$restr,$matches))
        {
            $restr = str_replace('qu','',$matches[0]);
        }
        return $restr;
    }
    
    
    /*
     * 时间转换函数
     * */
    public static function myDate($format,$timest)
    {
        $addtime = 8 * 3600;
        if(empty($format))
        {
            $format = 'Y-m-d H:i:s';
        }
        return gmdate ($format, $timest+$addtime);
    }
    
    
    //获取时间范围
    /*
     * 1:今日
     * 2:昨日
     * 3:本周
     * 4:上周
     * 5:本月
     * 6:上月
     * */
    public static  function getTimeRange($type)
    {
        switch($type)
        {
            case 1:
                $starttime = strtotime(date('Y-m-d 00:00:00'));
                $endtime = strtotime(date('Y-m-d 23:59:59'));
                break;
            case 2:
                $starttime = strtotime(date('Y-m-d 00:00:00' , strtotime('-1 day')));
                $endtime=strtotime(date('Y-m-d 23:59:59' , strtotime('-1 day')));
                break;
            case 3:
                $starttime = mktime(0, 0 , 0,date("m"),date("d")-date("w")+1,date("Y"));;
                $endtime = time();
                break;
            case 4:
                $starttime = strtotime(date('Y-m-d 00:00:00' , strtotime('last Sunday')));
                $endtime = strtotime(date('Y-m-d H:i:s' ,  strtotime('last Sunday') + 7 * 24 * 3600 - 1));
                break;
            case 5:
                $starttime = strtotime(date('Y-m-01 00:00:00' ,time()));
                $endtime = time();
                break;
            case 6:
                $starttime = strtotime(date('Y-m-01 00:00:00' ,strtotime('-1 month')));
                $endtime = strtotime(date('Y-m-31 23:59:00' ,strtotime('-1 month')));
                break;



        }
        $out = array(
            $starttime,
            $endtime
        );
        return $out;

    }
    
    
    
    
    
}

/*
 * 根据拼音获取目的地id
 * */

function getDestIdByPinYin($pinyin)
{
    /*$model = M('destinations');
    
	$row = $model->where("pinyin='$pinyin' and isopen='1'")->find();*/

    $row=cache('all_dest');
    if(!empty($row)){
        foreach($row as $val){
            if($val['pinyin']==$pinyin && $val['isopen']=='1' ){
                return $val['id'];
            }
        }
    }else{
        return '';
    }
    //return $row['id'];

}
    

//获取父级目的地链接信息.
function get_par_value($kindlist, $typeid)
{
    $last_dest_id = array_remove_value($kindlist);
    $destinfo = getParentDestNav($last_dest_id);
    $arr = array('1'=>'旅游','2'=>'酒店','3'=>'租车','4'=>'攻略','5'=>'景点','6'=>'相册');
    $arrType = array('1'=>'lines','2'=>'hotels','3'=>'cars','4'=>'raiders','5'=>'spots','6'=>'photos');
    $str='';
    if(!empty($destinfo)){
        foreach($destinfo as $v)
        {
            $url="";
            $webid=Q('webid',1);
            $attr = cache("weblist");
            if($webid == "1"){
                $url .= "";
            }else{
                foreach($attr as $val){
                    if($val["id"] == $webid){
                        $url .= "/".$val["webroot"];
                        break;
                    }
                }
            }
            
            $str.= ' &gt; <span><a href="' . $url . '/' . $arrType[$typeid] . '/' . $v['pinyin'].'/">' . $v['kindname'] . $arr[$typeid] . '</a></span>';
        }
    }
    
    
    return $str;
}

//获取目的地的所有父目的地，并从大到小排列 
function getParentDestNav($destid)
{
    if(empty($destid))
        return null;
    $cdata=cache('parent_dest_nav_'.$destid,false,'data/cache/Data/dest');
    if(empty($cdata)){
        $_destModule=M('destinations');
    
        $loopid=$destid;
        $result=array();
        while(1)
        {
         $pidR=$_destModule->where( "id='$loopid'" )->field('pid')->find();
         $pid=$pidR['pid'];
         $pinfo=$_destModule->where( "id='$pid'" )->find();
         if(empty($pinfo))
        	 break;
         else
        	{
        	   $result[]=$pinfo;
        	   $loopid=$pinfo['id'];
        	}
        }
        $count=count($result);
        
        for($i=$count-1;$i>=0;$i--)
        {
           $newresult[]=$result[$i];
        }
        
        $destinfo=$_destModule->where( "id='$destid'" )->find();
        $newresult[]=$destinfo;
        cache('parent_dest_nav_'.$destid,$newresult,'data/cache/Data/dest');
        return $newresult;
    }else{
        return $cdata;
    }
    
}

//取kindlist最大值
function array_remove_value($kindlist)
{
    $db_prefix=C("DB_PREFIX");
    
	$arr = explode(",", $kindlist);
	if(count($arr)==1)
             return $kindlist;

	$arr_new = array();
	foreach($arr AS $val)
	{
		if($val != '36' && $val != '37')
		{
			$is_arr=M()->getOneRow("select id from ".$db_prefix."destinations where id='$val'");
			if(!empty($is_arr))
			$arr_new[] = $val;
		}
	}
	return @max($arr_new);
}


/*
* 获取当前目的地下级目的地,如果不存在则读取当前级
* @param int destid
* @param int typeid
* @return array
* */
function getChildDest($destid,$typeid){
    $db_prefix=C("DB_PREFIX");
    $tables = array(
        '1'=>$db_prefix.'line_kindlist',
        '2'=>$db_prefix.'hotel_kindlist',
        '3'=>$db_prefix.'car_kindlist',
        '4'=>$db_prefix.'article_kindlist',
        '5'=>$db_prefix.'spot_kindlist',
        '6'=>$db_prefix.'photo_kindlist'

    );
    //$table = isset($tables[$typeid]) ? $tables[$typeid] : self::getKindListTable($typeid);
    $table = $tables[$typeid];
    $destid=empty($destid)?0:$destid;
    $sql="select 
                a.id,
                a.kindname 
            from ".$db_prefix."destinations a left join 
                {$table} b on a.id=b.kindid 
            where a.isopen=1 and a.pid='$destid' order by case when b.displayorder is null then 9999 end, b.displayorder asc";
    $result=M()->query($sql);
    //p($sql);
    //p($result);
    if(empty($result))
    {
        $sql2="select pid from ".$db_prefix."destinations where id=$destid";
        $re=M()->getOneRow($sql2);
        $sql="select 
                    a.id,
                    a.kindname 
                from 
                    ".$db_prefix."destinations a left join 
                    {$table} b on a.id=b.kindid 
                where a.isopen=1 and a.pid='{$re['pid']}' order by  case when b.displayorder is null then 9999 end, b.displayorder asc";
                //p($sql);
            $result=M()->query($sql);
    }
    //p($sql);
    //p($sql2);
    return $result;
}

/*
* 获取当前目的地下级目的地,如果不存在返回空
* @param int destid
* @param int typeid
* @return array
* */
function getChildDests($destid,$typeid){
    $db_prefix=C("DB_PREFIX");
    $tables = array(
        '1'=>$db_prefix.'line_kindlist',
        '2'=>$db_prefix.'hotel_kindlist',
        '3'=>$db_prefix.'car_kindlist',
        '4'=>$db_prefix.'article_kindlist',
        '5'=>$db_prefix.'spot_kindlist',
        '6'=>$db_prefix.'photo_kindlist'

    );
    //$table = isset($tables[$typeid]) ? $tables[$typeid] : self::getKindListTable($typeid);
    $table = $tables[$typeid];
    $destid=empty($destid)?0:$destid;
    $childdata=cache('child_'.$destid.'data',false,'data/cache/Data/destchild');
    if(empty($childdata)){
        $sql="select 
                a.id,
                a.kindname 
            from ".$db_prefix."destinations a left join 
                {$table} b on a.id=b.kindid 
            where a.isopen=1 and a.pid='$destid'
            order by case when b.displayorder is null then 9999 end, b.displayorder asc";

        $result=M()->query($sql);
        cache('child_'.$destid.'data',$result,'data/cache/Data/destchild');
    }else{
        $result=$childdata;
    }
    
    
    return $result;
}


//搜索Url
function getSearchUrl($val=null,$key=null,$exclude=null,$arr=array('para1','para2','day','priceid','sorttype','keyword','attrid','startcity'),$url="/lines/",$table="zh_line_attr")
{
    
	return getUrlStatic($val,$key,$exclude,$arr,$url,$table);
}

//搜索Url
function getSearchUrlWithPage($val=null,$key=null,$exclude=null,$arr=array('para1','para2','day','priceid','sorttype','keyword','attrid','startcity','pages'),$url="/lines/",$table="zh_line_attr")
{
    
	return getUrlStatic($val,$key,$exclude,$arr,$url,$table);
}


function getUrlStatic($val=null,$key=null,$exclude=null,$arr,$url,$table,$usemdd=1){
    $str = null;
    
    /*** AddBy xie ***/
    $webid = Q('webid',1);
    if($webid > 1){
        $weblist = cache("weblist");
        foreach($weblist as $web){
            if($web["id"] == $webid){
                $webroot = $web["webroot"];
                break;
            }
        }
        $url = "/".$webroot.$url;
    }
    /*** AddBy xie ***/

    if($key == 'dest_id') //生成只有目的地的链接
    {
        //p($arr);
        if(empty($_GET['para1']))
        {
            $tpr1='0';
        }else{
            $tpr1=$_GET['para1'];
        }
        $destinationsModel=K('Destinations');
        $destinfo = $destinationsModel->getDestInfo($val);
        if($destinfo['iswebsite']==1)
        {
            return $destinfo['weburl'].$url;
        }
        if($val == 'all') //全部
        {
            return $url.'all-'.$tpr1.'-0-0-0-0-0-0-0.html';
        }
        else
        {
            //$py = getDestPinyin($val);
            $py = $val;
            //$py = !empty($py) ? $py : $val;

            return $url.$py.'-'.$tpr1.'-0-0-0-0-0-0-0.html';
        }
    }
    if($usemdd){
        if($key == 'dest_id')
        {
            $destinationsModel=K('Destinations');
            $destinfo = $destinationsModel->getDestInfo($val);
            if($val == 'all') //全部
            {
                $str = $url.'all-';
            }
            else
            {
                $py = $val;//getDestPinyin($val);
    
                $py = !empty($py) ? $py : $val;
    
                $str = $url.$py.'-';
            }
            //$str = $val.$pinyin.'-';
        }else{
            if(isset($_GET['dest_id']))
            {
                $dest_id=$_GET['dest_id'];
                $pinyin=$dest_id;//getDestPinyin($dest_id);
                if(!empty($pinyin)){
                    $pinyin=$pinyin;
                }else{
                    $pinyin='all';
                }
                $str = $url.$pinyin.'-';
            }
        }
        
        //$pinyin=getDestPinyin($GLOBALS['dest_id']);
    }
    else
    {
        $str = $url;
    }
    //将参数名不为$key，且不是attrid的参数生成参数字符串
	foreach($arr as $v)
    {
        if($v!='attrid')
        {
            if($key != $v) //如果非当前参数
            {
                $pa_v = pregReplace($_GET[$v],2);
                $str.=!empty($pa_v)?"{$pa_v}-":'0-';
            }
            else
            {
                $str.= $val.'-'; //当前值
            }
        }
    }
    if(!empty($_GET['attrid']))
    {
        $orgattr_arr=explode('_',$_GET['attrid']);
        //p($orgattr_arr);die;
    }
    
    if($key=='attrid') //当前参数
    {
        if(empty($_GET['attrid']))
        {
            $str.=!empty($val) ? $val: '0'; //如果没有选择其它属性.
        }
        else
        {
            $all_line_attr=cache('all_line_attr');
            if(empty($all_line_attr)){
                $temp_result=M()->getOneRow("select pid from $table where id=$val");
                $temp_attrid=M()->query("select id from $table where pid={$temp_result['pid']}");
            }else{
                //$temp_result=M()->getOneRow("select pid from $table where id=$val");
                //$temp_attrid=M()->query("select id from $table where pid={$temp_result['pid']}");
                foreach($all_line_attr as $tattr){
                    if($tattr['id']==$val){
                        $temp_result=$tattr;
                        break;
                    }
                }
                
                foreach($all_line_attr as $tattr){
                    if($tattr['pid']==$temp_result['pid']){
                        $temp_attrid[]=$tattr;

                    }
                }
            }
            foreach($temp_attrid as $ke=>$va)
		    {
			     $attr_value[]=$va['id'];
		    }
            //p($orgattr_arr);
            //判断已存在的参数里是否包含$attr_value里的值，有则删除
            foreach($orgattr_arr as $k=>$v)
            {
                if(empty($v))
                {
                    unset($orgattr_arr[$k]);
                }
                if(in_array($v,$attr_value))
                {
                    unset($orgattr_arr[$k]);
                    break;
                }
            }
            $orgattr_arr[]=$val; //添加当前值
            if($val==0)unset($orgattr_arr);
            $str.=!empty($orgattr_arr) ? implode('_',$orgattr_arr):'0';
        }
    }
    else
    {
        //p($exclude);
        //p($orgattr_arr);
        //排除组id下的所有子id,用于显示组的全部
        if(!empty($exclude))
        {
            $has_exclude=M()->getOneRow("select count(*) as num from $table where id='$exclude'");
            
            if($has_exclude['num']<=0)
			{
				$_exclude=M()->getOneRow("select id from $table where attrname='$exclude'");
				$exclude=$_exclude['id'];
			}
            foreach($orgattr_arr as $k=>$v)
		  	{
		  	  // echo "select count(*) as num from $table where id='$v' and pid='$exclude'";die;
			    $one_arr=M()->getOneRow("select count(*) as num from $table where id='$v' and pid='$exclude'");
				if($one_arr['num']>0)
                {
					 unset($orgattr_arr[$k]);
                }
			}	
        }
        $orgattr_arr=array_diff($orgattr_arr,array('',0)); 
        //p($orgattr_arr);
        $str.=!empty($orgattr_arr) ? implode('_',$orgattr_arr):'0';
    }
    $url = $str.'.html';
    //echo $url;die;
    return $url;
}

function getDestPinyin($destid)
{
    //p($destid);
    $all_dest=cache('all_dest');
    if(empty($all_dest)){
        $db_prefix=C("DB_PREFIX");
        $sql = "select pinyin from ".$db_prefix."destinations where id='$destid' and isopen='1'";
        $row = M()->getOneRow($sql);
        return !empty($row['pinyin']) ? $row['pinyin'] : $destid;
    }else{
        foreach($all_dest as $dest){
            if($dest['pinyin']==$destid && $dest['isopen']=='1' ){
                return !empty($dest['pinyin']) ? $dest['pinyin'] : $destid;
            }
        }
    }
    
}

/*
 * 替换
 * */
function pregReplace($str,$type)
{
    $pattern = '';
    switch($type)
    {
        case '1': //只能有中文和英文
            $pattern = "/[^a-zA-Z\x7f-\xff]+/";
            break;
        case '2': //只能数字
            $pattern = "/[^0-9]/";
            break;
        case '3'://只能中文
            $pattern = "/[^\x7f-\xff]/";
            break;
        case '4'://只能有数字和_
            $pattern = "/[^0-9_]/";
            break;
	    case '5':
            $pattern = "/[^-|\x7f-\xff|0-9|a-zA-Z|@|:|.)]/";
            break;
    }
    $out = preg_replace($pattern,'',$str);
    return $out;

}



//获取属性查询条件

function getAttWhere($attlist)
{
   $arr=RemoveEmpty(explode('_',$attlist));
   $str="";
   foreach($arr as $value)
   {
	  if($value!=0)
	  {
	    $str.=" and FIND_IN_SET($value,a.attrid) ";
	  }
   }
   return $str;	
	
}

//去除php数组空值
if(!function_exists('RemoveEmpty'))
{
  function RemoveEmpty($arr)
  {
	  $newarr=array_diff($arr,array(null,'null','',' '));
	  return $newarr;
  }
}


function getMaxMinSuitTime($lineid){
    $db_prefix=C("DB_PREFIX");
    if(B2BLOGIN){
        $sql = "select 
                min(a.day) as minday,max(a.day) as maxday 
            from ".$db_prefix."line_suit_price  AS a inner join
                ".$db_prefix."line_suit AS b on   a.suitid =b.id
            where a.lineid='$lineid'  and b.suittype='b2b' ";
    }else{
        $sql = "select 
                min(a.day) as minday,max(a.day) as maxday 
            from ".$db_prefix."line_suit_price  AS a inner join
                ".$db_prefix."line_suit AS b on   a.suitid =b.id
            where a.lineid='$lineid'  and b.suittype='b2c' ";
    }
    
    $row = M()->getOneRow($sql);
    if(!empty($row['minday'])){
        $row['minday']=date('y.m.d',$row['minday']);
    }
    
    if(!empty($row['maxday'])){
        $row['maxday']=date('y.m.d',$row['maxday']);
    }
    
    if(empty($row['minday']) || empty($row['maxday']))
    {
        return "出发日期请电询";
    }else{
        return $row['minday'].'～'.$row['maxday'];
    }
    
}

function getMaxMinSuitTimeShow($row){
    if(B2BLOGIN){
        if(!empty($row['b2bminday'])){
            $row['minday']=date('y.m.d',$row['b2bminday']);
        }
        
        if(!empty($row['b2bmaxday'])){
            $row['maxday']=date('y.m.d',$row['b2bmaxday']);
        }
        
        if(empty($row['b2bminday']) || empty($row['b2bmaxday']))
        {
            return "出发日期请电询";
        }else{
            return $row['minday'].'～'.$row['maxday'];
        }
    }else{
        if(!empty($row['minday'])){
        $row['minday']=date('y.m.d',$row['minday']);
        }
        
        if(!empty($row['maxday'])){
            $row['maxday']=date('y.m.d',$row['maxday']);
        }
        
        if(empty($row['minday']) || empty($row['maxday']))
        {
            return "出发日期请电询";
        }else{
            return $row['minday'].'～'.$row['maxday'];
        }
    }
    
}

//获取属性名2
//获取attrname
function getLineAttrName2($attrid,$count=1)
{
    $out="";
    $arr = getLineAttrArr($attrid);
    $i=0;
    foreach($arr as $v)
    {
        if($i>=$count){
            break;
        }
        $out.="<li><span>{$v}</span></li> ";
        $i++;
    }
    return $out;

}

function getLineAttrArr($attrid,$esplit=',')
{
    $db_prefix=C("DB_PREFIX");
    $arr = explode($esplit,$attrid);
    $out = array();
    $all_line_attr=cache('all_line_attr');
    foreach($arr as $id)
    {
        if(!empty($all_line_attr)){
            foreach($all_line_attr as $data){
                if($data['id']==$id && $data['pid']!=0){
                    array_push($out,$data['attrname']);
                }
            }
        }
        
    }
    /*p($attrid);
    p($out);*/
    return $out;
}

//获取线路当前日期起2月内最低报价.
function getLineRealPrice($id,$webid){
    $price = 0 ;
     $price = getNewRealPrice($id,$webid);
    if($webid!=0)
    {
       //$price = getOldRealPrice($aid,$webid);
    }
    else
    {
       //$price = getNewRealPrice($aid,$webid);
    }
    return $price;
}


//获取新版报价最低报价
function getNewRealPrice($id,$webid)
{
    $db_prefix=C("DB_PREFIX");

    
     $time = time();
     if(B2BLOGIN){
        $sql = "select 
                    min(a.adultprice) as price 
                from 
                    ".$db_prefix."line_suit_price  AS a inner join
                     ".$db_prefix."line_suit AS b on   a.suitid =b.id
                    where 
                    a.lineid='$id' and a.day > '$time' and 
                    a.adultprice!=0  and b.suittype='b2b'  ";
     }else{
        $sql = "select 
                    min(a.adultprice) as price 
                from 
                    ".$db_prefix."line_suit_price  AS a inner join
                     ".$db_prefix."line_suit AS b on   a.suitid =b.id
                    where 
                    a.lineid='$id' and a.day > '$time' and 
                    a.adultprice!=0  and b.suittype='b2c'  ";
     }
     
    $row = M()->getOneRow($sql);
    return $row['price'] ? $row['price'] : 0;
}

//更新访问次数
//访问数量
function updateVisit($aid,$typeid)
{
    $db_prefix=C("DB_PREFIX");
	$table=array(
	        '1'=>$db_prefix.'line',
			'2'=>$db_prefix.'hotel',
			'3'=>$db_prefix.'car',
			'4'=>$db_prefix.'article',
			'5'=>$db_prefix.'spot',
			'6'=>$db_prefix.'photo',
			'8'=>$db_prefix.'visa',
			'13'=>$db_prefix.'tuan'
     );
	 $tablename = $table[$typeid];
	$update="update {$tablename} set shownum=shownum+1 where  id=$aid";
    M()->exe($update);
}

function getShopName($siteid){
    
    $all_weblist=cache('weblist');
    if(empty($all_weblist)){
        $db_prefix=C("DB_PREFIX");
        $sql = "select webname from ".$db_prefix."weblist where id='$siteid' ";
        $row = M()->getOneRow($sql);
        if(!empty($row['webname'])){
            return $row['webname'];
        }else{
            return '其他支店';
        }
    }else{
        foreach($all_weblist as $web){
            if($web['id'] == $siteid ){
                if(!empty($web['webname'])){
                    return $web['webname'];
                }else{
                    return '其他支店';
                }
            }
        }
        return '其他支店';
    }
    
    
    
    
}

//获取星期
function getWeekDay($num)
{
    $arr=array('日','一','二','三','四','五','六');
    return $arr[(int)$num];
}


//跳转404页面
function head404()
{
	header("HTTP/1.1 404 Not Found");
    header("Status: 404 Not Found");
    //header("Location: ".$GLOBALS['cfg_basehost']."/404.php");
    echo "<script>window.location.href='/404.php'</script>";
    exit; 
	
}

//获取编号,共6位,不足6位前面被0
function getSeries($id,$prefix)
{
  /* $len=strlen($id);
   $needlen=6-$len;
   if($needlen==5)$s='00000';
   else if($needlen==4)$s='0000';
   else if($needlen==3)$s='000';
   else if($needlen==2)$s='00';
   else if($needlen==1)$s='0';
   $out=$prefix.$s."{$id}";
   return $out;*/
    $ar = array(
        '01'=>'A',
        '02'=>'B',
        '05'=>'C',
        '03'=>'D',
        '08'=>'E',
        '13'=>'G',
        '14'=>'H',
        '15'=>'I',
        '16'=>'J',
        '17'=>'K',
        '18'=>'L',
        '19'=>'M',
        '20'=>'N',
        '21'=>'O',
        '22'=>'P',
        '23'=>'Q',
        '24'=>'R',
        '25'=>'S',
        '26'=>'T'
    );
    $prefix = $ar[$prefix];
    $len=strlen($id);
    $needlen=4-$len;
    if($needlen==3)$s='000';
    else if($needlen==2)$s='00';
    else if($needlen==1)$s='0';

    $out=$prefix.$s."{$id}";
    return $out;
	
}

/*
 * 处理订单联系人
 * */
function getTourer($info)
{
    $arr = array();

    foreach($info as $k=>$v)
    {
        if(preg_match('/^tourer/',$k)) //找出所有游客信息
        {
            
            preg_match('/[1-3][0-9]/',$k,$match);
           // p($match);

            if(!isset($arr[$match[0]]))
            {
                $arr[$match[0]] = array();
                $arr[$match[0]][$k]=pregReplace($v,5);
            }
            else
            {
                $arr[$match[0]][$k]=pregReplace($v,5);
            }


        }
    }
    return $arr;
}


if(!function_exists("get_order_sn"))
{
  function get_order_sn($kind)
  {
	  /* 选择一个随机的方案 */
	  mt_srand((double) microtime() * 1000000);
  
	  return $kind.date('md') . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
  }
}

function get_handle_shop_all(){
    $shoparr=array(
        '1'=>'上海支店',
        '2'=>'北京支店',
        '3'=>'成都支店',
        '4'=>'广州支店',
        '5'=>'青岛支店',
        '6'=>'大连支店',
        //'7'=>'苏州支店',
    );
    return $shoparr;
}

function get_handle_shop(){
    $shoparr=array(
        '3'=>'成都支店',
        '4'=>'广州支店',
        '5'=>'青岛支店',
        '6'=>'大连支店',
        //'7'=>'苏州支店',
    );
    return $shoparr;
}

function get_shop_mail( $id ){
    $arr_mail = array(
        '1'=>'136871204@qq.com',
        '2'=>'136871204@qq.com',
        '3'=>'136871204@qq.com',
        '4'=>'136871204@qq.com',
        '5'=>'136871204@qq.com',
        '6'=>'136871204@qq.com',
        '7'=>'136871204@qq.com', 
    );
    return $arr_mail[$id];
}

function get_shop_mail_name( $id ){
    $arr_mail = array(
        '1'=>'Meta.上海支店',
        '2'=>'Meta.北京支店',
        '3'=>'Meta.成都支店',
        '4'=>'Meta.广州支店',
        '5'=>'Meta.青岛支店',
        '6'=>'Meta.大连支店',
        '7'=>'Meta.苏州支店', 
    );
    return $arr_mail[$id];
}

function getIconList($iconids,$esplit=',')
{
    $db_prefix=C("DB_PREFIX");
    $arr = explode($esplit,$iconids);
    $out = array();
    
    $all_line_icon=cache('all_line_icon');
    if(empty($all_line_icon)){
        $sql = "select * from ".$db_prefix."icon ";  
        $result=M()->query($sql);
        $all_line_icon=$result;
        cache('all_line_icon',$result);
    }
    foreach($arr as $id)
    {
        foreach($all_line_icon as $icon){
            if($icon['id']==$id){
                array_push($out,$icon);
            }
        }   
        /*$sql = "select kind,picurl from ".$db_prefix."icon where id='$id' ";  
        $row = M()->getOneRow($sql);
        if(!empty($row['kind']))
            array_push($out,$row);*/

    }
    
    $count=10;
    $i=0;
    $outstr="";
    foreach($out as $v)
    {
        if($i>$count){
            break;
        }
        //$outstr.="<i class='tag_01'>{$v}</i> ";
        $outstr .= '<li><img src="'.$v["picurl"].'" width="32" height="20" alt="'.$v["kind"].'"></li>';
        $i++;
    }
    return $outstr;
}

//生成历史记录的链接
function getSearchKeyUrl($val){
    $url = "/index.php?a=Index&c=Search&m=coloudsearch";
    $str = "";
    $webid = Q('webid',1);
    if($webid > 1){
        $weblist = cache("weblist");
        foreach($weblist as $web){
            if($web["id"] == $webid){
                $webroot = $web["webroot"];
                break;
            }
        }
        $url = "/".$webroot.$url;
    }
    $str = $url."&keyword=".$val;
    return $str;
}
