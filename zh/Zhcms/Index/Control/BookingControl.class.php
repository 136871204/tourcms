<?php

/**
 * 网站前台
 * Class IndexControl
 * @author 周鸿 <136871204@qq.com>
 */
class BookingControl extends TripControl {
    
    
	//网站首页
	public function index() {
	   $typeid=1; //线路栏目
       
       $lineid=Q('lineid');
       $lineid=pregReplace($lineid,2);
       $suitid=Q('suitid');
       $dopost=Q('dopost');
       $usedate=Q('usedate');
       $adultnum=Q('adultnum');
       $childnum=Q('childnum');
       $oldnum=Q('oldnum');
       if(empty($dopost))
       {

            $lineinfo=$this->getLineInfo($lineid);
            $suitinfo=$this->getLineSuitInfo($suitid);
            $priceinfo = $this->getDayPrice($usedate,$suitid);
            //p($lineinfo);die;
            if(!isset($lineinfo))
            {
                head404();
         
            }
            if(empty($lineinfo['linesn'])){
                //$line_sn = 'HIS' . str_repeat('0', 8 - strlen($aid)) . $aid;
                $line_sn = 'HIS' . str_repeat('0', 8 - strlen($lineinfo["id"])) . $lineinfo["id"];
                $lineinfo['lineseries']=$line_sn;//线路编号
            }else{
                $lineinfo['lineseries']=$lineinfo['linesn'];//线路编号
            }
            $lineinfo['usedate']=$usedate;//出团日期
            $lineinfo['title'] = $lineinfo['linename']."({$suitinfo['suitname']})";
            $lineinfo['suitname'] = $suitinfo['suitname'];
  
            $lineinfo['price'] = $priceinfo['adultprice']; //成人价格
            $lineinfo['childprice'] =  $priceinfo['childprice']; //小孩价格
            $lineinfo['oldprice'] =  $priceinfo['oldprice']; //婴儿价格
  
            
            $lineinfo['dingnum'] = intval($adultnum) ? intval($adultnum) : 1;//数量
            $lineinfo['childnum'] = intval($childnum) ? intval($childnum) : 0;
            $lineinfo['oldnum'] = intval($oldnum) ? intval($oldnum) : 0;
            $group = explode(',',$suitinfo['propgroup']);//人群
            
            $lineinfo['suitid'] = $suitid;
            $lineinfo['totalprice'] = $priceinfo['adultprice'] * $adultnum + $priceinfo['childprice'] * $childnum + $priceinfo['oldprice']* $oldnum;//总价格
            if(!empty($suitinfo['dingjin']))$GLOBALS['condition']['_djsupport']=1;//是否支持定金
            if(!empty($suitinfo['jifentprice']))$GLOBALS['condition']['_has_jifentprice']=1;
            if(!empty($suitinfo['jifencomment']))$GLOBALS['condition']['_has_jifencomment']=1;
            if(!empty($suitinfo['jifenbook']))$GLOBALS['condition']['_has_jifenbook']=1;
            if(in_array(1,$group))$lineinfo['haschild']=1;
            if(in_array(2,$group))$lineinfo['hasadult']=1;
            if(in_array(3,$group))$lineinfo['hasold']=1;
            $lineinfo['dingjin'] = $suitinfo['dingjin'];
            $lineinfo['jifentprice'] = $suitinfo['jifentprice'];
            $lineinfo['jifencomment'] = $suitinfo['jifencomment'];
            $lineinfo['jifenbook'] = $suitinfo['jifenbook'];
            $lineinfo['shopname']=getShopName($lineinfo['webid']);
            
            //出发城市 AddBy Xie
            $startplaceModel=K('Startplace');
            $lineinfo['startcity'] = $startplaceModel->getStartCityName($lineinfo['startcity']);
            
            //日期选择 Addby Xie
            $db_prefix=C("DB_PREFIX");
            
            $linebefore=$lineinfo['linebefore'];
            if(!empty($linebefore)){
                $time = strtotime("+".$linebefore." day");
            }else{
                $time = strtotime(date('Y-m-d'));//现在时间
            }
            
            //$time = strtotime(date('Y-m-d'));//现在时间
            $sql = "select day from ".$db_prefix."line_suit_price 
                    where suitid='$suitid' and day > '$time' and adultprice>0 and `number`!=0 limit 0,100";
            $day = M()->query($sql);
            $this -> assign("day",$day);
             /* 日期选择 显示 价格
             if(!empty($day)){
                foreach($day as $row)
                {
                   
                    $day = date('Y-m-d',$row['day']); //m-d
                    $weekday = '周'.getWeekDay(date('w',$row['day']));//周X
                    if(in_array(2,$group))
                    {
                        $adultprice = $row['adultprice'];
                        $peopleinfo = ' 成人价 '.$adultprice."起";
                        $out['hasadult'] = 1;
            
                    }
                    if(in_array(1,$group) && !empty($row['childprice']))
                    {
                        $childprice = $row['childprice'];
                        $peopleinfo .= ' 儿童价 '.$childprice."起";
                        $out['haschild'] = 1;
                    }
                    if(in_array(3,$group) && !empty($row['oldprice']))
                    {
                        $oldprice = $row['oldprice'];
                        $peopleinfo.= ' 婴儿价 '.$oldprice."起";
                        $out['hasold'] = 1;
                    }
                    $text = $day.'('.$weekday.')'.$peopleinfo;
                    $monthli.='<option value="'.$day.'" data-price="'.$adultprice.'" data-childprice="'.$childprice.'" data-oldprice="'.$oldprice.'" data-number="'.$row['number'].'">'.$text.'</option>';
                    
                    //$dayoption = "<option value='".date('Y-m-d',$row['day'])."'></option>";
                }
            }*/
            
            $lists = getList();
            $this -> assign("lineinfo", $lineinfo);
            $this -> assign("handleshop", get_handle_shop());
            $this -> assign("lists", $lists);
            $this -> assign("handleshopjobtime", $lists["jobtime"][$lineinfo["webid"]]);
            $this -> assign("histeljs", json_encode(getList()));
            
            $CacheTime =-1;
            $this -> display('template/' . C('WEB_STYLE') . '/lines/line_booking.html', $CacheTime);
        
       }elseif( $dopost=="save" ){
        
            $data = self::clearyymmdd($_POST);
            
            $this -> assign("data",$data);
            $this -> assign("handleshop",get_handle_shop());
            $this -> display('template/' . C('WEB_STYLE') . '/lines/line_booking_ajax.html');
            exit;
            
       }else if($dopost=="savebooking"){
        
            //p($_POST);
            $tourer = getTourer($_POST);

            $ordersn=get_order_sn('01');//订单号
            $suitinfo=$this->getLineSuitInfo($suitid);
            $priceinfo = $this->getDayPrice($usedate,$suitid);
            //p($suitinfo);die;
            $status = $suitinfo['paytype']==1 ? 1 : 0;
            $adultnum = pregReplace($adultnum,2);
            $childnum = pregReplace($childnum,2);
            $oldnum = pregReplace($oldnum,2);
            $total_dingnum = $adultnum+$childnum+$oldnum;
            if(intval($priceinfo['number'])!=-1 && intval($priceinfo['number']) < $total_dingnum)
            {
                echo 'nonumber';
                exit;
            }
            
            $linkman=Q('linkman');
            $linktel=Q('linktel');
            $linkemail=Q('linkemail');
            $remarkinfo=Q('remarkinfo');
            $productautoid=Q('productautoid');
            $productaid=Q('productaid');
            $dingjin=Q('dingjin');
            $productname=Q('productname');
            $handleshop=Q('handleshop');
            $linksex=Q('linksex');
            $linktel=pregReplace($linktel,2);
            $totalprice = Q('totalprice');
            //'webid'=>$webid,需要根据选择支店来分配
            $webid='1';
            $memberid='1';
            $arr = array(
                'ordersn'=>$ordersn,//产品序列号
                'memberid'=>$memberid,
                'webid'=>$webid,//站点id
                'typeid'=>$typeid,//线路的typeid是1
                'productautoid'=>$productautoid,//线路id
                'productaid'=>$productaid,
                'productname'=>$productname,
                'price'=>$priceinfo['adultprice'],
                'childprice'=>$priceinfo['childprice'],
                'oldprice'=>$priceinfo['oldprice'],
                'usedate'=>$usedate,
                'dingnum'=>pregReplace($adultnum,2),
                'childnum'=>pregReplace($childnum,2),
                'oldnum'=>pregReplace($oldnum,2),
                'linkman'=>pregReplace($linkman,5),
                'linktel'=>pregReplace($linktel,2),
                'linkemail'=>pregReplace($linkemail,5),
                'addtime'=>time(),
                'dingjin'=>pregReplace($dingjin,2),
                'paytype'=>$suitinfo['paytype'],
                'suitid'=>$suitid,
                'status'=>$status,
                'remark'=>$remarkinfo,
                'handleshop'=>$handleshop,
                'linksex'=>$linksex,
                'tourer'=>$tourer,
                'totalprice'=>$totalprice
            );
            
            //新增预定类别 b2b b2c
            if( B2BLOGIN ){
                $arr["contacttype"] = "b2b";
            }else{
                $arr["contacttype"] = "b2c";
            }
            
            $price    =  $arr['price'];
            $remark   = $arr['remark'];
            $dingnum  = $arr['dingnum'];
            $childnum = $arr['childnum'];
            //p($arr);
            if($this->addOrder($arr))
            {
                //line_booking_success.html
                
                echo "true";
                exit;
                
            }else{
                
                echo "false";
                exit;
                
                //$CacheTime =-1;
                //$this -> display('template/' . C('WEB_STYLE') . '/lines/line_booking_error.html', $CacheTime);
            }
       }
       
	}
    
    public function success(){
        //echo 'success';die;
        $CacheTime =-1;
        $this -> display('template/' . C('WEB_STYLE') . '/lines/line_booking_success.html', $CacheTime);
    }
    
    public  function addOrder($arr)
    {
        
        $flag = 0;
        
        $tourMemberOrderModel=K('TourMemberOrder');

        if( $temp = $tourMemberOrderModel -> checkForm($arr) ){
            echo $temp;
            exit;
        }
        
        if(is_array($arr))
        {
            $arr['kindlist'] = $this->getProductKindList($arr['productautoid'],$arr['typeid']);
            if($arr['paytype']=='3')//这里补充一个当为二次确认时,修改订单为未处理状态.
            {
                $arr['status'] = 0;
            }
            else
            {
                //$arr['status'] = 1;
            }
            if(isset($arr['tourer']))
            {
                $tourer = $arr['tourer'];
                unset($arr['tourer']);
            }
            
            $flag = $tourMemberOrderModel->add($arr);
            if($flag)
            {
                $this->addTourer($tourer,$flag) ;//添加联系人                    
                //减库存                    
                $dingnum = intval($arr['dingnum'])+intval($arr['childnum'])+intval($arr['oldnum']);
                $this->minusStorage($arr['usedate'],$arr['typeid'],$arr['suitid'],$arr['productautoid'],$dingnum);
                //查询库存量
                $count = M('line_suit_price') ->where(' suitid = '.$arr['suitid']. ' and day = '.strtotime($arr['usedate']) ) -> all();
                if( !empty($count) ){
                    $countlast = $count[0];
                }else{
                    return $flag;
                }
                
                //发送邮件代码
                
                //$title = "订购成功";//邮件主题
                //B2B 邮件主题
                if( B2BLOGIN ){
                    $title = "【B2B】订购成功";
                }else{
                    $title = "订购成功";
                }

                //$msghtml = $this->sendmailhtml($arr,$countlast);
                //发送邮件
                
                /*$Config  = array(
                    'EMAIL_USERNAME'=>"136871204@qq.com",
                    'EMAIL_PASSWORD'=>"******",
                    'EMAIL_HOST'=>'smtp.qq.com',
                    'EMAIL_PORT'=>'25',
                    'EMAIL_SSL'=>false,
                    'EMAIL_CHARSET'=>'utf-8',
                    'EMAIL_FORMMAIL'=>'136871204@qq.com',
                    'EMAIL_FROMNAME'=>'Meta中国-预约订单',
                );*/
                
                //C($Config);
                //p($arr);
                
                //正式环境 邮箱
                //$admin_mail = get_shop_mail($arr["handleshop"]);
                //测试环境 邮箱
                
                //$admin_name = get_shop_mail_name($arr["handleshop"]);
                //$state1 = Mail::send($admin_mail,$admin_name,$title,$msghtml);
                $state1=true;
                //$admin_mail2 = "hong@metaphase.co.jp";
                //$admin_mail2 = "xiecong@metaphase.co.jp";
                //$state2 = Mail::send($admin_mail2,$admin_name,$title,$msghtml);
            }
            
            return $flag;
        }
    }
    
    
    public function minusStorage($dingdate,$typeid,$suitid,$productid,$dingnum)
    {
        $db_prefix=C("DB_PREFIX");
        $day = strtotime($dingdate);
        $dingnum = $dingnum ? $dingnum : 1;
        switch($typeid)
        {
            case '1':

                $sql = "update ".$db_prefix."line_suit_price set number=number-$dingnum where day='$day' and suitid='$suitid' and number!=0 and number!=-1";
                M()->exe($sql);
                break;
        }
    }
    
    public function addTourer($arr,$orderid)
    {
        $tourMemberOrderTourerModel=K('TourMemberOrderTourer');
        $i=1;
        foreach($arr as $row)
        {
            $tempArr = array();
            foreach($row as $key => $val){
                $temp = mb_substr($key,0,-2);
                $tempArr[$temp] = $val;
            }
            
            $row = self::clearyymmdd($tempArr);
            
            //$row = $tempArr;
            //p($row);die;
            $ar = array();
            $ar['tourername']= $row['tourername'];
            $ar['sex'] = $row['tourersex'];
            $ar['fnamealp'] = $row['tourerfnamealp'];
            $ar['lnamealp'] = $row['tourerlnamealp'];
            $ar['birthdayy'] = $row['tourerbirthdayy'];
            $ar['birthdaym'] = $row['tourerbirthdaym'];
            $ar['birthdayd'] = $row['tourerbirthdayd'];
            $ar['passbook'] = isset($row['tourerpassbook']) ? $row['tourerpassbook'] : '';
            $ar['effectivey'] = isset($row['tourereffectivey']) ? $row['tourereffectivey'] : '';
            $ar['effectivem'] = isset($row['tourereffectivem']) ? $row['tourereffectivem'] : '';
            $ar['effectived'] = isset($row['tourereffectived']) ? $row['tourereffectived'] : '';
            $ar['ptype'] = $row['tourerptype'];
            $ar['orderid'] = $orderid;
            $tourMemberOrderTourerModel->add($ar);
            $i++;
        }
    }
    
    public function getProductKindList($id,$typeid){
        $db_prefix=C("DB_PREFIX");
        $sql = "select maintable from ".$db_prefix."tour_model where id=$typeid";
        $row = M()->GetOneRow($sql);
        $table = $db_prefix.$row['maintable'];
        $sql = "select kindlist from $table where id='$id'";
        $row1 = M()->GetOneRow($sql);
        return $row1['kindlist'];
    }
    
    public function getDayPrice($usedate,$suitid)
    {
        $db_prefix=C("DB_PREFIX");
        $day = strtotime($usedate);
        $sql = "select 
                    adultprice,childprice,oldprice,number 
                from ".$db_prefix."line_suit_price where day='$day' and suitid='$suitid'";
        $row = M()->GetOneRow($sql);
        return $row;
    }

    
    /**
     *  获得预订线路套餐基本信息
     *
     * @access    private
     * @return    array
     */
    public function getLineSuitInfo($suitid)
    {
        $db_prefix=C("DB_PREFIX");
        $sql="select * from ".$db_prefix."line_suit where id=$suitid";
        $row=M()->GetOneRow($sql);
        return $row;
    }
        
    
    /**
     *  获得预订线路的基本信息
     *
     * @access    private
     * @return    array
     */
    public function getLineInfo($id)
    {
       $db_prefix=C("DB_PREFIX");
       $sql="select a.* from ".$db_prefix."line a where a.id=$id";
       $row=M()->GetOneRow($sql);
       return $row;
    }
    
    /**
     * 订购成功 发送邮件内容
     */
    public function sendmailhtml( $vars , $count ){                  
        
        //产品编号
        $lineinfo=$this->getLineInfo($vars['productautoid']);
        if(empty($lineinfo['linesn'])){
            //$line_sn = 'HIS' . str_repeat('0', 8 - strlen($aid)) . $aid;
            $line_sn = '' . str_repeat('0', 8 - strlen($lineinfo["id"])) . $lineinfo["id"];//线路编号
        }else{
            $line_sn=$lineinfo['linesn'];//线路编号
        }
        //p($line_sn);
        if( $vars["remark"] ){
            $remark = nl2br($vars["remark"]);
        }else{
            $remark = "";
        }        
        
        $num = "";
        if( count($count) !="0" ){
            if( $count['number'] == "-1" ){
                $num = "不限";
            }else{
                $num = $count['number'];            
            }
        }
        
        // 线路名称与套餐名
        
        $mail_msg_usr =<<<_MAIL_TO_USR

订单号：　　　【${vars["ordersn"]}】<br/>
产品编号：　　【${line_sn}】<br/>
线路名称：　　【${vars["productname"]}】<br/>
------------------------预订人信息---------------------<br/>
联系人姓名：　【${vars["linkman"]}】<br/>
联系人电话：　【${vars["linktel"]}】<br/>
出发日期：　　【${vars["usedate"]}】<br/>
库存剩余：　　【${num}】<br />
------------------------游客信息-----------------------<br/>
成人：　　　　【${vars["dingnum"]}】名<br/>
儿童：　　　　【${vars["childnum"]}】名<br/>
婴儿：　　　　【${vars["oldnum"]}】名<br/>
------------------------订单金额-----------------------<br/>
成人：　　　　【${vars["price"]}】x【${vars["dingnum"]}】名<br/>
儿童：　　　　【${vars["childprice"]}】x【${vars["childnum"]}】名<br/>
婴儿：　　　　【${vars["oldprice"]}】x【${vars["oldnum"]}】名<br/>
总价：　　　　【${vars["totalprice"]}】<br/>
<br/>
<br/>
留言：<br/>
${remark}


_MAIL_TO_USR;

        return $mail_msg_usr;

    }
    
    //清楚多余的yyyymmdd
    public function clearyymmdd($data){
        
        foreach($data as $key => $val){
            if( preg_match('/^tourerbirthday/',$key) ){
                if( $val == "yyyy" or $val == "mm" or $val == "dd" ){
                    $data[$key] = "";
                }
            }
            if( preg_match('/^tourereffective/',$key) ){
                if( $val == "yyyy" or $val == "mm" or $val == "dd" ){
                    $data[$key] = "";
                }
            }
        }
        return $data;
    }
        
}
