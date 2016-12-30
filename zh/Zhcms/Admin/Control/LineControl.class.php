<?php
/**
 * ブランド管理
 * @author 周鸿 <136871204@qq.com>
 */
class LineControl extends AuthControl {
    protected $lineKinds;
    protected $jiaotong = array('飞机','汽车','火车','轮船');
    protected $magrecommend = array('购物','免税店','温泉','景点','美食','文化','水族馆');
    
    
    public function __init() {
        $this->lineKinds = array(
                            	    'lineprice'=>array('name'=>'价格分类','url'=>U('Admin/Line/price'),'itemid'=>'3'),
                            		'lineday'=>array('name'=>'天数分类','url'=>U('Admin/Line/day'),'itemid'=>'3'),
                            		'lineattr'=>array('name'=>'属性分类','url'=>U('Admin/Line/attr',array('webid'=>1)),'itemid'=>'3'),
                            		//'linejieshao'=>array('name'=>'内容介绍','url'=>'attrid/content/parentkey/kind/itemid/3/typeid/1','itemid'=>3),
                            		//'linedest'=>array('name'=>'线路目的地','url'=>'destination/destination/parentkey/kind/itemid/3/typeid/1','itemid'=>3),
                                    //'lineextend'=>array('name'=>'扩展字段','url'=>'attrid/extendlist/parentkey/kind/itemid/3/typeid/1','itemid'=>3)
                            	
                            );
        $this->assign('lineKinds',$this->lineKinds);
        $weblistModel = K("Weblist");
        $result=$weblistModel->All();
        $weblist = array();
        foreach ($result AS $row)
        {
            $weblist[$row['id']] = addslashes($row['webname']);
        }
        //p($weblist);die;
        $this -> weblist = $weblist;
        $this -> webSelectArr=TourCommon::getWebList();
        
	}
    

    
    
    //线路管理
    public function index(){
        //echo 'index';die;
        
        $this->display();
    }

    public function editsuit(){
        $lineModel=K("Line");
        $lineSuitModel=K("LineSuit");
        
        $suitid=Q('suitid');
        $info=$lineSuitModel->find($suitid);
        $lineinfo=$lineModel->find($info['lineid']);
        $this->assign('action','edit');

        $this->assign('lineinfo',$lineinfo);
        $this->assign('info',$info);
        $this->assign('position','修改套餐');
        $this->display('suit_edit');
        
    }

    /*
     * 添加套餐
     */
    public function addsuit()
    {
        $lineModel=K("Line");
        
        
        $lineid=Q('lineid');
        $lineinfo=$lineModel->find($lineid);
        $this->assign('lineinfo',$lineinfo);
        $this->assign('action','add');
        $this->assign('position','添加套餐');
        $this->display('suit_edit');
    }
    

    public function add(){
        
        
        $webid=1;
        $this->assign('webid',1);
        $lineContentModel=K('LineContent');
        $startplaceModel = K("Startplace");
        
        
        $columns=$lineContentModel->where("webid=".$webid." and isopen=1 and isline=0 and columnname!='linespot' ")->order(' displayorder  asc ')->All();

        $startplaceSelect=$startplaceModel->getList(0);
        $this->assign('startplacelist',$startplaceSelect);
        $this->assign('columns',$columns);
        $this->assign('usertransport',array());
        $this->assign('usermagrecommend',array());
        $this->assign('position','添加线路');
        $this->assign('action','add');
        $this->assign('sysjiaotong',$this->jiaotong);//交通
        $this->assign('sysmagrecommend',$this->magrecommend);//交通
        $info=array(
            'ishidden'=>1,
            'isstyle' =>2,
            'biaozhun_isstyle' =>2
        );
        $this->assign('info',$info);
        $this->display('line_edit.php');

        
    }
    
    public function edit(){
        $lineModel=K("Line");
        $startplaceModel = K("Startplace");
        $destinationsModel=K('Destinations');
        $lineContentModel=K('LineContent');
        $lineJieshaoModel=K('LineJieshao');
        
        
        $lineid=Q("lineid");
        $model=$lineModel->find($lineid);
        $this->assign('action','edit');
        $startplaceSelect=$startplaceModel->getList(0,$model['startcity']);
        $this->assign('startplacelist',$startplaceSelect);
        $this->assign('sysjiaotong',$this->jiaotong);//交通
        $this->assign('sysmagrecommend',$this->magrecommend);//交通
        
        if($model['id']){
            $info=$model;
            $info['kindlist_arr']=$destinationsModel->getKindlistArr($info['kindlist']);
            $info['attrlist_arr']=TourCommon::getSelectedAttr(1,$info['attrid']);
            $info['iconlist_arr']=TourCommon::getSelectedIcon($info['iconlist']);
            $day_arr= $lineJieshaoModel->where(" lineid='".$info['id']."' ")->order(' day asc ')->All();
            if(!empty($day_arr)){
                $day_arr=array_chunk($day_arr,$info['lineday']);
            }
            
            /* add by xie 20151208 for 航班信息*/
            /*if( $info['biaozhun_isstyle'] == '2' ){
                $info["biaozhun_detail"] = unserialize($info["biaozhun_detail"]);
            }*/
            $info["biaozhun_detail"] = unserialize($info["biaozhun_detail"]);
            /* end */
            
            $info['linejieshao_arr'] = $day_arr[0];
            $info['static_path']=__STATIC__;
         
            $columns=$lineContentModel->where("webid=1 and isopen=1 and isline=0 and columnname!='linespot' ")->order(' displayorder  asc ')->All();
            $this->assign('columns',$columns);
            $this->assign('webid',$info['webid']);
            $this->assign('info',$info);
            $this->assign('usertransport',explode(',',$info['transport']));
            $this->assign('usermagrecommend',explode(',',$info['magrecommend']));
            $this->display('line_edit.php');
        }else{
            echo 'URL地址错误，请重新选择线路';
        }
        
    }
    
    public function ajax_suitsave(){
        $lineSuitModel=K('LineSuit');
        //$lineModel=K('Line');
        
        $lineid=Q('lineid');
        $suitid=Q('suitid');
        $data_arr=array();
        $data_arr['suitname']=Q('suitname');
        $data_arr['suittype']=Q('suittype');
        $data_arr['lineid']=Q('lineid');
        $data_arr['description']=Q('description');
        $propgroup=Q('propgroup');
        if(empty($propgroup)){
            $data_arr['propgroup']="";
        }else{
            $data_arr['propgroup']=implode(',',$propgroup);
        }
        $data_arr['jifentprice']=Q('jifentprice') ? Q('jifentprice') : 0 ;
        $data_arr['jifenbook']=Q('jifenbook')? Q('jifenbook') : 0 ;
        $data_arr['jifencomment']=Q('jifencomment') ? Q('jifencomment'):0;
        $data_arr['paytype']=Q('paytype');
        $data_arr['dingjin']=Q('dingjin');
        //p($data_arr);die;
        if($suitid)
        {
            $model=$lineSuitModel->find($suitid);
        }else{
            
        }
        foreach($data_arr as $k=>$v)
        {
            $model[$k]=$v;
        }
        //p($model);die;
        if($suitid){
            $opid=$lineSuitModel->update($model);
            if($opid){
                $this->saveBaoJia($lineid,$suitid,$_POST);
                //$lineModel->updateMinPrice($lineid);
                echo $suitid;exit;
            }else{
                echo 'no';exit;
            }
        }else{
            $opid=$lineSuitModel->add($model);
            if($opid){
                $this->saveBaoJia($lineid,$opid,$_POST);
                //$lineModel->updateMinPrice($lineid);
                echo $opid;exit;
            }else{
                echo 'no';exit;
            }
        }
        
        
    }
    
    public function saveBaoJia($lineid,$suitid,$arr)
    {
        $lineSuitPriceModel=K('LineSuitPrice');
        
        $pricerule =Q('pricerule');
        $starttime = Q('starttime');
        $endtime = Q('endtime');
        if(empty($starttime)||empty($endtime))
            return false;
        
        $adultbasicprice = Q('adultbasicprice') ? Q('adultbasicprice') :0;
        $adultprofit = Q('adultprofit') ? Q('adultprofit') :0; 
        $childbasicprice = Q('childbasicprice') ? Q('childbasicprice') :0; 
        $childprofit = Q('childprofit') ? Q('childprofit') :0; 
        $oldbasicprice = Q('oldbasicprice') ? Q('oldbasicprice') :0;  
        $oldprofit = Q('oldprofit') ? Q('oldprofit') :0;  
        $description = Q('description'); //描述
        $number = Q('number');
        $monthval = Q('monthval');
        $weekval = Q('weekval');
        
        $stime=strtotime($starttime);
        $etime=strtotime($endtime);
        $adultprice = (int)$adultbasicprice+(int)$adultprofit;
        $childprice = (int)$childbasicprice+(int)$childprofit;
        $oldprice = (int)$oldbasicprice+(int)$oldprofit;
        
        //按日期范围报价
        if($pricerule=='all')
        {
            $begintime=$stime;
            while(true)
            {
                $model = $lineSuitPriceModel->where(" suitid=$suitid and day='$begintime'")->find();
                $data_arr=array();
                $data_arr['lineid'] = $lineid;
                $data_arr['suitid'] = $suitid;
                $data_arr['adultbasicprice']=$adultbasicprice;
                $data_arr['adultprofit']=$adultprofit;
                $data_arr['adultprice']=$adultprice;
                $data_arr['childbasicprice']=$childbasicprice;
                $data_arr['childprofit']=$childprofit;
                $data_arr['childprice']=$childprice;
                $data_arr['oldbasicprice']=$oldbasicprice;
                $data_arr['oldprofit']=$oldprofit;
                $data_arr['oldprice']=$oldprice;
                $data_arr['day']= $begintime;
                $data_arr['description'] = $description;
                $data_arr['number'] = $number;
                if($model['suitid'])
                {
                    $lineSuitPriceModel->where(" suitid=$suitid and day='$begintime' ")->update($data_arr);
                }else
                {
                    foreach($data_arr as $k=>$v)
                    {
                        $model[$k]=$v;
                    }
                    $lineSuitPriceModel->add($model);
                }
                $begintime=$begintime+86400;
                if($begintime>$etime)
                   break;
            }
        }//按号进行报价
        else if($pricerule=='month')
        {
            $syear=date('Y',$stime);
            $smonth=date('m',$stime);
            $sday=date('d',$stime);
            
            $eyear=date('Y',$etime);
            $emonth=date('m',$etime);
            $eday=date('d',$etime);
            
            $beginyear=$syear;
            $beginmonth=$smonth;
            
            while(true)
            {
                $daynum=date('t',strtotime($beginyear.'-'.$beginmonth.'-'.'01'));
                foreach($monthval as $v)
                {
                    if((int)$v<10)
                        $v='0'.$v;
                    $newtime=strtotime($beginyear.'-'.$beginmonth.'-'.$v);
                    if($v>$daynum||$newtime<$stime||$newtime>$etime)
                        break;
                    $model = $lineSuitPriceModel->where("suitid=$suitid and day='$newtime'")->find();
                    $data_arr['lineid'] = $lineid;
                    $data_arr['suitid'] = $suitid;
                    $data_arr['adultbasicprice']=$adultbasicprice;
                    $data_arr['adultprofit']=$adultprofit;
                    $data_arr['adultprice']=$adultprice;
                    $data_arr['childbasicprice']=$childbasicprice;
                    $data_arr['childprofit']=$childprofit;
                    $data_arr['childprice']=$childprice;
                    $data_arr['oldbasicprice']=$oldbasicprice;
                    $data_arr['oldprofit']=$oldprofit;
                    $data_arr['oldprice']=$oldprice;
                    $data_arr['day']= $newtime;
                    $data_arr['description'] = $description;
                    $data_arr['number'] = $number;
                    if($model['suitid'])
                    {
                        $lineSuitPriceModel->where("suitid=$suitid and day='$newtime'")->update($data_arr);
                    }else{
                        foreach($data_arr as $k=>$v)
                        {
                            $model[$k]=$v;
                        }
                        $lineSuitPriceModel->add($model);
                    }
                }
                $beginmonth=(int)$beginmonth+1;
                if($beginmonth>12)
                {
                    $beginmonth=$beginmonth-12;
                    $beginyear++;
                }
                if(($beginmonth>$emonth&&$beginyear>=$eyear)||($beginmonth<=$emonth&&$beginyear>$eyear))
                    break;
                $beginmonth=$beginmonth<10?'0'.$beginmonth:$beginmonth;
            }
        }//按星期进行报价
        else if($pricerule=='week')
        {
            $begintime=$stime;
            while(true)
            {
                $cur_week=date('w',$begintime);
                $cur_week=$cur_week==0?7:$cur_week;
                if(in_array($cur_week,$weekval))
                {
                    $model = $lineSuitPriceModel->where("suitid=$suitid and day='$begintime'")->find();
                    $data_arr['lineid'] = $lineid;
                    $data_arr['suitid'] = $suitid;
                    $data_arr['adultbasicprice']=$adultbasicprice;
                    $data_arr['adultprofit']=$adultprofit;
                    $data_arr['adultprice']=$adultprice;
                    $data_arr['childbasicprice']=$childbasicprice;
                    $data_arr['childprofit']=$childprofit;
                    $data_arr['childprice']=$childprice;
                    $data_arr['oldbasicprice']=$oldbasicprice;
                    $data_arr['oldprofit']=$oldprofit;
                    $data_arr['oldprice']=$oldprice;
                    $data_arr['day']=$begintime;
                    $data_arr['description'] = $description;
                    $data_arr['number'] = $number;
                    if($model['suitid'])
                    {
                        $lineSuitPriceModel->where("suitid=$suitid and day='$begintime'")->update($data_arr);
                    }else{
                        foreach($data_arr as $k=>$v)
                        {
                            $model[$k]=$v;
                        }
                        $lineSuitPriceModel->add($model);
                    }
                }
                $begintime=$begintime+86400;
                if($begintime>$etime)
                    break;
            }
        }
        $lineModel=K('Line');
        $lineModel->updateMinPrice($lineid);
    }
    
    public function ajax_linesave(){
        $lineModel=K("Line");
        $lineAttrModel=K("LineAttr");
        $lineid = Q('lineid');
        //p($_POST);
        
        $attrids =Q('attrlist');//属性
        if(!empty($attrids)){
            $attrids =implode(',',$attrids);//属性
            $attrmode = $lineAttrModel->where("id in ($attrids)")->group('pid')->All();
            foreach ($attrmode as $k => $v) {
                $attrids = $v['pid'].','.$attrids;
            }
        }else{
            $attrids='';
        }
        
        $data_arr=array();
        $data_arr['webid']=Q('webid');
        $data_arr['webid']=empty($data_arr['webid'])?1:$data_arr['webid'];
        $webid = $data_arr['webid'];
        
        
        
        $data_arr['linename']=Q('linename');
        $data_arr['sellpoint']=Q('sellpoint');
        $data_arr['linesn']=Q('linesn');
        $data_arr['baf'] =Q('baf',0); //显示隐藏
        $data_arr['hotlines']=Q('hotlines');
        
        $data_arr['hotlinetel']=Q('hotlinetel');
        $data_arr['holiday']=Q('holiday');
        $data_arr['corporationnum']=Q('corporationnum',1);
        
        $kindlist = Q('kindlist');
        if(empty($kindlist)){
            $data_arr['kindlist']='';
        }else{
            $data_arr['kindlist']=implode(',',$kindlist);
        }
        $data_arr['attrid']=$attrids;
        $data_arr['lineday']=Q('lineday',1);
        $data_arr['linenight']=Q('linenight',0);
        // $data_arr['supplierlist']=implode(',',Arr::get($_POST,'supplierlist'));
        $data_arr['linebefore']=Q('linebefore',0);
        $data_arr['storeprice']=Q('storeprice',0);
        $data_arr['childrule']=Q('childrule');
        $data_arr['babyrule']=Q('babyrule');
        
        $data_arr['template']= Q('template');
        $data_arr['template'] = empty($data_arr['template']) ? 'line_show.htm' : $data_arr['template'];
        $data_arr['color']=Q('color');
        $data_arr['yesjian']=Q('yesjian',0);//推荐次数 
        $data_arr['satisfyscore']=Q('satisfyscore',0);
        $data_arr['bookcount']=Q('bookcount',0);
        $data_arr['ishidden'] =Q('ishidden',0); //显示隐藏
        $data_arr['seotitle']=Q('seotitle');
        $data_arr['keyword']=Q('keyword');
        //$data_arr['tagword']=Q('ishidden');Arr::get($_POST,'tagword');
        $data_arr['description']=Q('description');
        $data_arr['modtime']=time();
        if($lineid){
            $data_arr['moduid']=$_SESSION['uid'];
        }else{
            $data_arr['addtime']=time();
            $data_arr['adduid']=$_SESSION['uid'];
            $data_arr['moduid']=$_SESSION['uid'];
        }
        
        $data_arr['isstyle']=Q('isstyle',2);
        $data_arr['showrepast']=Q('showrepast',1);
        
        $data_arr['jieshao']=Q('jieshao');
        
        $data_arr['biaozhun'] = Q('biaozhun');
        
        /* add by xie 20151208 for 航班信息修改 */
        $data_arr['biaozhun_isstyle'] = Q('post.biaozhun_isstyle',2);
        //$biaozhun = self::getbiaozhun($_POST);
        /*if( $data_arr['biaozhun_isstyle'] == '2'){
            $data_arr['biaozhun_detail'] = self::getbiaozhun($_POST);
        }else{
            $data_arr['biaozhun_detail'] = "";
        }*/
        $data_arr['biaozhun_detail'] = self::getbiaozhun($_POST);
        /* end */        
        
        $data_arr['beizu'] = Q('beizu');
        $data_arr['payment'] = Q('payment');
        $data_arr['feeinclude'] = Q('feeinclude');
        $data_arr['features'] = Q('features');
        $data_arr['reserved1'] = Q('reserved1');
        $data_arr['reserved2'] = Q('reserved2');
        $data_arr['reserved3'] = Q('reserved3');
        $data_arr['reserved4'] = Q('reserved4');
        $data_arr['shotcontent'] = Q('shotcontent');
        $data_arr['lineicon'] = '';
        $data_arr['startcity'] = Q('startcity');
        $data_arr['transport'] = Q('transport_pub') ? implode(',', Q('transport_pub')) : '';
        $data_arr['magrecommend'] = Q('magrecommend_pub') ? implode(',', Q('magrecommend_pub')) : '';
        $data_arr['iconlist'] =  Q('iconlist') ? implode(',',Q('iconlist')) : '';
        $data_arr['linepic']=Q('linepic');
        $expirev=Q('expire');
        //$test = unserialize($data_arr['biaozhun']);
        //p($test);
        if(empty($expirev)){
            $data_arr['expire']="";
        }else{
            $data_arr['expire']=strtotime($expirev);
        }
        
        
        
        //图片处理
        if(isset($_POST['piclist'])){
            $tpiclist=$_POST['piclist'];
            $tpiclist=array_sort_images($tpiclist);
            $_POST['piclist']=$tpiclist;
            $images_arr=$_POST['piclist']['path'];//Q('imgages');
            
            $imagestitle_arr=$_POST['piclist']['alt'];
            
            $imgstr="";
            foreach($images_arr as $k=>$v){
                $imgstr.=$v.'||'.$imagestitle_arr[$k].',';
            }
            $imgstr=trim($imgstr,',');
            $data_arr['piclist']=$imgstr;
        }else{
            $data_arr['piclist']='';
        }
        
        if(isset($_POST['linedoc'])){
            $file_arr=$_POST['linedoc']['path'];
            $filetitle_arr=$_POST['linedoc']['alt'];
            $filestr="";
            foreach($file_arr as $k=>$v){
                $filestr.=$v.'||'.$filetitle_arr[$k].',';
            }
            $data_arr['linedoc']=$filestr;
        }else{
            $data_arr['linedoc']='';
        }
        
        
       
        if($lineid){
            $id=$lineModel->where(" id = $lineid ")->update($data_arr);
            if($id){
                $this->savejieshao($lineid);
                $this -> success('修改线路成功!');
            }else{
                $this -> error('修改线路失败!');
            }
        }else{
            $id =$lineModel->add($data_arr);
            if($id){
                $this->savejieshao($id);
                $this -> success('添加线路成功!');
            }else{
                $this -> error('添加线路失败!');
            }
        }
        
    }
    
    /* add by xie 20151208 for 航班信息修改*/
    public function getbiaozhun($info){
       
        $arr = array();
        $count = empty($info["biaozhuncount"]) ? "1" : $info["biaozhuncount"];
        for($i=1;$i<=$count;$i++){
       	    if(
        		empty($info["biaozhuninfo$i"]) &&
        		empty($info["biaozhuncompany$i"]) &&
        		empty($info["biaozhunnum$i"]) &&
        		empty($info["biaozhunstartairport$i"]) &&
        		empty($info["biaozhunstarttime$i"]) &&
        		empty($info["biaozhunendairport$i"]) &&
        		empty($info["biaozhunendtime$i"]) 
        	  ){
        	  	  continue;
        	}
            $arr[$i]["biaozhuninfo$i"] = $info["biaozhuninfo$i"];
            $arr[$i]["biaozhuncompany$i"] = $info["biaozhuncompany$i"];
            $arr[$i]["biaozhunnum$i"] = $info["biaozhunnum$i"];
            $arr[$i]["biaozhunstartairport$i"] = $info["biaozhunstartairport$i"];
            $arr[$i]["biaozhunstarttime$i"] = $info["biaozhunstarttime$i"];
            $arr[$i]["biaozhunendairport$i"] = $info["biaozhunendairport$i"];
            $arr[$i]["biaozhunendtime$i"] = $info["biaozhunendtime$i"];
        }
    /*
        foreach($info as $k=>$v)
        {
            if(preg_match('/^biaozhun/',$k)) //找出所有游客信息
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
        }*/
        return serialize($arr); 
    }
    
    //保存介绍
    public function savejieshao($lineid)
    {
        //echo $lineid;
        $lineJieshaoModel=K('LineJieshao');
        
        $title_arr=Q('jieshaotitle');
        $breakfirsthas_arr=Q('breakfirsthas');
        $breakfirst_arr=Q('breakfirst');
        $lunchhas_arr=Q('lunchhas');
        $lunch_arr=Q('lunch');
        $supperhas_arr=Q('supperhas');
        $supper_arr=Q('supper');
        $hotel_arr=isset($_REQUEST['hotel'])?$_REQUEST['hotel']:array();
        $tjieshao_arr=isset($_REQUEST['tjieshao'])?$_REQUEST['tjieshao']:array();
        $transport_arr=isset($_REQUEST['transport'])?$_REQUEST['transport']:array();//$_REQUEST['transport'];//Q('transport');echo 'aa';die;
        $jieshao_arr=isset($_REQUEST['txtjieshao'])?$_REQUEST['txtjieshao']:array();//$_REQUEST['txtjieshao'];//Q('txtjieshao');
        if(empty($title_arr)){
            return ;
        }
        //p($title_arr);die;
        foreach($title_arr as $k=>$v)
        {
            
            $model=$lineJieshaoModel->where(" lineid='$lineid' and day='$k' ")->find();
            
            $model['lineid']=$lineid;
            $model['day']=$k;
            $model['hotel']=$hotel_arr[$k];
            $model['breakfirst']=$breakfirst_arr[$k];
            $model['lunch']=$lunch_arr[$k];
            $model['supper']=$supper_arr[$k];
            $model['tjieshao']=$tjieshao_arr[$k];
            $model['title']=$v;
           // p($k);
            //图片处理
            
            //$value=array_sort_images($value);
            
            if(isset($_POST['timg'.$k])){
                $tempImges=$_POST['timg'.$k];
                $tempImges=array_sort_images($tempImges);
                $images_arr=$tempImges['path'];//Q('imgages');
                $imagestitle_arr=$tempImges['alt'];
                
                $imgstr="";
                foreach($images_arr as $ik=>$iv){
                    $imgstr.=$iv.'||'.$imagestitle_arr[$ik].',';
                }
                $imgstr=trim($imgstr,',');
                $model['timg']=$imgstr;
            }else{
                $model['timg']='';
            }
            
            //p($model);die;
            $supperhas_arr[$k]=empty($supperhas_arr[$k])?0:$supperhas_arr[$k];
            $lunchhas_arr[$k]=empty($lunchhas_arr[$k])?0:$lunchhas_arr[$k];
            $breakfirsthas_arr[$k]=empty($breakfirsthas_arr[$k])?0:$breakfirsthas_arr[$k];
            
            
            $model['supperhas']=$supperhas_arr[$k];
            $model['lunchhas']=$lunchhas_arr[$k];
            $model['breakfirsthas']=$breakfirsthas_arr[$k];
            //echo $k;p($transport_arr);
            if(isset($transport_arr[$k])){
                $model['transport']=implode(',',$transport_arr[$k]);
            }else{
                $model['transport']="";
            }
            
            $model['jieshao']=$jieshao_arr[$k];
            //p($model);die;
            if(empty($model['id']))
            {
                $lineJieshaoModel->add($model);
            }else{
                $lineJieshaoModel->update($model);
            }
        }
    }
    
    public function line(){
        $action = Q('action');
        $db_prefix=C("DB_PREFIX");
        $destinationsModel=K("Destinations");
        $lineAttrModel=K('LineAttr');
        $iconModel=K('Icon');
        $lineModel=K('Line');
        $lineSuitModel=K('LineSuit');
        $lineSuitPriceModel=K('LineSuitPrice');
        
        if($action=='read') {
            $start=Q('start');
			$limit=Q('limit');
			$keyword=Q('keyword');
			$kindid=Q('kindid');
			$attrid=Q('attrid');
			$startcity=Q('startcity');
			$sort=isset($_GET['sort'])?$_GET['sort']:'';
           // p($sort);exit;
			$webid=Q('webid');
            $webid = empty($webid) ? '-1' : $webid;
            //$webid = $webid==1 ? '-1' : $webid;
            //$keyword = TourCommon::getKeyword($keyword);
            
            $order='order by a.addtime desc';
            
            if(!empty($sort)){
                $sort=str_replace('\"','"',$sort);
                $sort=json_decode($sort);
                if($sort[0]->property)
    			{
    				if($sort[0]->property=='displayorder')
    				    $prefix='';
    			    else if($sort[0]->property=='ishidden')
    				{
    					$prefix='a.';
    				}
    					
    				$order='order by '.$prefix.$sort[0]->property.' '.$sort[0]->direction.' ,a.addtime desc ';
    			}

            }
            //echo $order;exit;
            
            $w="a.id is not null";
            $w.=empty($keyword)?'':" and (a.linename like '%{$keyword}%' or a.id like '%{$keyword}%' or a.linesn like '%{$keyword}%' )";
			$w.=empty($kindid)?'':" and find_in_set($kindid,a.kindlist)";
			$w.=empty($attrid)?'':" and find_in_set($attrid,a.attrid)";
			$w.=empty($startcity)?'':" and a.startcity='$startcity'";
			$w.=$webid=='-1'  || $webid == 1? '' : " and a.webid=$webid";
            
            /*
            1 中国
            2 上海支店
            3 北京支店
            6 其他支店
            */
            $roleid=$_SESSION['rid'];
            switch ($roleid)
            {
                case 19://北京管理员
                  $w.=" and a.webid=3 ";
                  break;  
                case 20://上海管理员
                  $w.=" and a.webid=2 ";
                  break;
                case 22://其他地区管理员
                  $w.=" and a.webid=6 ";
                  break;
                default:
                  ;
            }
            
            $allorderw=$webid=='-1' ? 'and b.webid=0' : " and b.webid=$webid";
            
            if($kindid!=0)
			{
				$sql="select 
                        a.id,a.aid,a.linename,a.iconlist,a.lineprice,a.tprice,a.profit,a.startcity,a.expire,a.addtime,a.moduid,a.adduid,
                        a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,
                        a.piclist,a.themelist,a.supplierlist,a.linesn,
                        b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia 
                        from 
                            ".$db_prefix."line as a left join 
                            ".$db_prefix."kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=$kindid $allorderw )   
                        where 
                            $w $order limit  $start,$limit";
			}
			else
			{
			    $sql="select 
                        a.id,a.aid,a.linename,a.supplierlist,a.iconlist,a.lineprice,a.tprice,a.profit,a.startcity,a.expire,a.addtime,a.moduid,a.adduid,
                        a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.piclist,
                        a.themelist,a.linesn,
                        b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia 
                        from 
                            ".$db_prefix."line as a left join 
                            ".$db_prefix."allorderlist b on (a.id=b.aid and b.typeid=1 $allorderw ) 
                        where 
                            $w $order  limit $start,$limit";
			}
            
            
            $countSql="select count(*) as num from ".$db_prefix."line a where $w";
            $totalcount_arr=M()->query($countSql);
            //echo $sql;die;
            $list=M()->query($sql);

            $new_list=array();
            $userModel = K("User");
            if(!empty($list)){
                foreach($list as $k=>$v){
                    $v['kindname']=$destinationsModel->getKindnameList($v['kindlist']);
                    $v['attrname']=$lineAttrModel->getAttrnameList($v['attrid']);
                    $v['url'] = '/lines/detail/'.$v['id'].'.html';
                    $iconname = $iconModel->getIconName($v['iconlist']);
                    //p($iconname);die;
                    $name = '';
                    foreach($iconname as $icon)
                    {
                       if(!empty($icon))
                       $name.='<span style="color:red">['.$icon.']</span>';
                    }
                    $v['iconname'] = $name;
                    $v['lineseries'] = TourCommon::getSeries($v['id'],'01');//线路编号
                    
                    if(!empty($v['expire'])){
                        $v['expire']=date('Y-m-d',$v['expire']);
                    }else{
                        //$v['expire']=date('Y-m-d',$v['expire']);
                    }
                    if(!empty($v['addtime'])){
                        $v['addtime']=date('Y-m-d',$v['addtime']);
                    }else{
                        //$v['expire']=date('Y-m-d',$v['expire']);
                    }
                    
                    if(!empty($v['moduid'])){
                            
                        $user = $userModel -> where(array('uid' => $v['moduid'])) -> find();
                        $v['moduid']=$user['username'];
                    }else{
                        $v['moduid']='未输入';
                    }
                     
                    $suit=$lineSuitModel->where("lineid={$v['id']}")->order(' displayorder asc,suittype desc ')->All();
                    if(!empty($suit))
				        $v['tr_class']='parent-line-tr';
                   
                    $new_list[]=$v;
                    if(!empty($suit)){
                        foreach($suit as $key=>$val)
                        {
                            $val['linename']=$val['suitname'];
                            $val['minprice']=$lineSuitPriceModel->getMinPrice($val['id']);
                            $val['minprofit']=$lineSuitPriceModel->getMinPrice($val['id'],'adultprofit');
                            $val['id']='suit_'.$val['id'];
                            $val['suittype']='<span style="font-size: 16px; font-weight: bold;">'.$val['suittype'].'</span>';
                            if($key!=count($suit)-1)
				                $val['tr_class']='suit-tr';
                     
                            $new_list[]=$val;
                        }
                    }
                    
                }
            }

            $result['total']=$totalcount_arr[0]['num'];
			$result['lines']=$new_list;
			$result['success']=true;
            echo json_encode($result);exit;
            
        }else if($action=='update'){
            $id=Q('id');
			$field=Q('field');
			$val=Q('val');
			$kindid=Q('kindid');
            
            $webid=Q('webid');
            $webid = empty($webid) || $webid == -1? 0 : $webid;
           // echo 'aaaa'.$webid;exit;
            if($field=='displayorder')
            {
                if(is_numeric($id))   //如果是线路
                {
                    $displayorder=$val;
                    if(empty($kindid))  //全局排序
                    {
                        $order=K('Allorderlist');
                        $order_mod=$order->where("aid='$id' and typeid=1 and webid=$webid ")->find();
                        $displayorder=empty($displayorder)?9999:$displayorder;
                        if(!empty($order_mod)){
                            $order_mod['displayorder']=$displayorder;
                            $opid=$order -> where("aid='$id' and typeid=1 and webid=$webid ") -> save($order_mod);
                        }else{
                            $order_mod['displayorder']=$displayorder;
                            $order_mod['aid']=$id;
                            $order_mod['webid']=$webid;
                            $order_mod['typeid']=1;
                            $opid=$order->add($order_mod);
                        }
                        if($opid){
                            echo 'ok';
                        }else{
                            echo 'no';
                        }
                    }
                    else  //按目的地排序
                    {
                        $kindorder=K('Kindorderlist');
                        $kindorder_mod=$kindorder->where("aid='$id' and typeid=1 and classid=$kindid and webid=$webid ")->find();
                        $displayorder=empty($displayorder)?9999:$displayorder;
                        if(!empty($kindorder_mod)){
                            $kindorder_mod['displayorder']=$displayorder;
                            $opid=$kindorder -> where("aid='$id' and typeid=1 and classid=$kindid and webid=$webid ") -> save($kindorder_mod);
                        }else{
                            $kindorder_mod['displayorder']=$displayorder;
                            $kindorder_mod['aid']=$id;
                            $kindorder_mod['classid']=$kindid;
                            $kindorder_mod['webid']=$webid;
                            $kindorder_mod['typeid']=1;
                            $opid=$kindorder->add($kindorder_mod);
                        }
                        if($opid){
                            echo 'ok';
                        }else{
                            echo 'no';
                        }
                    }
                }
                else if(strpos($id,'suit')!==FALSE)//如果是套餐
				{
				    $lineSuitModel=K('LineSuit');
					$suitid=substr($id,strpos($id,'_')+1);
					$suit=$lineSuitModel->find($suitid); 
					$displayorder=$val;
					$displayorder=empty($displayorder)?999999:$displayorder; 
					if($suit['id'])
					{
					  $suit['displayorder']=$displayorder;
                      $opid=$lineSuitModel->update($suit);
					  if($opid)
					     echo 'ok';
					   else
					      echo 'no';	 
					}
				}
            }else //如果不是排序
            {
                if(is_numeric($id))
				{
				    $model=$lineModel->find($id);
				}else if(strpos($id,'suit')!==FALSE)
				{
					//$suitid=substr($id,strpos($id,'_')+1);
					//$model=ORM::factory('line_suit',$suitid);
				}
                if($model['id'])
                {
                    $model[$field]=$val;
                    $id = $lineModel->update($model);
                    if($id){
                        echo 'ok';
                    } 
			         else{
                        echo 'no';
                    }
						   
                }
            }
            exit;
        }else if($action == 'delete'){
            
            $lineJieshaoModel=K('LineJieshao');
            $lineSuitModel=K('LineSuit');
            $rawdata=file_get_contents('php://input');
            $data=json_decode($rawdata);
            $id=$data->id;
            if(is_numeric($id)) //线路删除
            {
                $lineModel->deleteClear($id);
                $lineJieshaoModel->deleteByLineId($id);
            }else if(strpos($id,'suit')!==FALSE)
            {
                $suitid=substr($id,strpos($id,'_')+1);
                $lineSuitModel->deleteClear($suitid);
            }
            exit;
        }
    }
    
    
    //属性分类
    public function attr(){
        $lineAttrModel=K('LineAttr');
        $webid = Q('webid', 0, 'intval');
        
        $list=$lineAttrModel->getList($webid,0,0,false);
        $this->assign('list_info',$list);
        $this->assign('currentKindName',$this->lineKinds['lineattr']['name']);
        $this->display();
    }
    
    public function attr_add(){
        $lineAttrModel=K('LineAttr');
        $webid = Q('webid', 1, 'intval');
        if (IS_POST) {
            $db_prefix=C("DB_PREFIX");
            /* 初始化变量 */
            $info['id']       = !empty($_POST['id'])       ? intval($_POST['id'])     : 0;
            $info['pid']    = !empty($_POST['pid'])    ? intval($_POST['pid'])  : 0;
            $info['displayorder']   = !empty($_POST['displayorder'])   ? intval($_POST['displayorder']) : 9999;
            $info['attrname']     = !empty($_POST['attrname'])     ? trim($_POST['attrname'])     : '';
            $info['isopen']  = !empty($_POST['isopen'])  ? intval($_POST['isopen']): 0;
            $info['webid']  = $webid;
            if($lineAttrModel ->exists($webid,$info['attrname'],$info['pid']))
            {
                $this -> error("同级别下不能有重复的分类名称！");
            }

            if($id=$lineAttrModel->insert($info)){
                $lineAttrModel->updateCache();
                $this -> success("添加成功！");
            }else{
                $this -> success("添加失败！");
            }
        }else{
            $pid = Q("pid",0, "intval");
            $select=$lineAttrModel->getList($webid,0,$pid,true);
            $info=array('isopen' => 1);


            $this->assign('info',$info);
            $this->assign('select',$select);
            $this->assign('currentKindName',$this->lineKinds['lineattr']['name']);
			$this -> display();
        }
    }
    
    public function attr_edit(){
        $db_prefix=C("DB_PREFIX");
        $lineAttrModel=K('LineAttr');
        $webid = Q('webid', 1, 'intval');
        if (IS_POST) {
            
             /* 初始化变量 */
            $id              = !empty($_POST['id'])       ? intval($_POST['id'])     : 0;
            $old_name        = $_POST['old_name'];
            $info['pid']    = !empty($_POST['pid'])    ? intval($_POST['pid'])  : 0;
            $info['displayorder']   = !empty($_POST['displayorder'])   ? intval($_POST['displayorder']) : 9999;
            $info['attrname']     = !empty($_POST['attrname'])     ? trim($_POST['attrname'])     : '';
            $info['isopen']  = !empty($_POST['isopen'])  ? intval($_POST['isopen']): 0;
            /* 判断分类名是否重复 */
            if ($info['attrname'] != $old_name)
            {
                if ($lineAttrModel ->exists($webid,$info['attrname'],$info['pid'], $id))
                {
                    $this -> error("同级别下不能有重复的分类名称！");
                }
            }

            /* 判断上级目录是否合法 */
            $children = array_keys($lineAttrModel->getList($webid,$id, 0, false));     // 获得当前分类的所有下级分类
            if (in_array($info['pid'], $children))
            {
                $this -> error("上级目录不合法");
            }
            if( $lineAttrModel->where(" id = '$id'  ")->update($info)){
                $lineAttrModel->updateCache();
                $this -> success("修改成功！");
            }else{
                $this -> error("修改失败");
            }
        }else{
            $id = intval($_REQUEST['id']);
            $info = $lineAttrModel->where(" id='$id' ")->getRow();

            $select=$lineAttrModel->getList($webid,0,$info['pid'],true);
            
            $this->assign('info',$info);
            $this->assign('select',$select);
            $this->assign('currentKindName',$this->lineKinds['lineattr']['name']);
            
    	    $this -> display();
        }
    }
    
    public function attr_del(){
        $db_prefix=C("DB_PREFIX");
        $lineAttrModel=K('LineAttr');
        $webid = Q('webid', 1, 'intval');
        
        /* 初始化分类ID并取得分类名称 */
        $id   = Q('id',0,'intval');
        //$name = M()->getOne('SELECT attrname FROM ' .$db_prefix.'startplace'. " WHERE id='$id'",'cityname');
        /* 当前分类下是否有子分类 */
        $count = M()->getOne('SELECT COUNT(*) FROM ' .$db_prefix.'line_attr'. " WHERE pid='$id'",'COUNT(*)');
        /* 当前分类下是否存在商品 */
        //TODO之后完成
        //$goods_count = M()->getOne('SELECT COUNT(*) FROM ' .$db_prefix.'goods'. " WHERE cat_id='$cat_id'",'COUNT(*)');
        /* 如果不存在下级子分类和商品，则删除之 */
        //if ($cat_count == 0 && $goods_count == 0){
        if ($count == 0){
            /* 删除分类 */
            $sql = 'DELETE FROM ' .$db_prefix.'line_attr'. " WHERE id = '$id'";
            if (M()->exe($sql)){
                $lineAttrModel->updateCache();
                $this -> success("删除成功！");
            }else{
                $this -> success("删除失败！");
            }
            
        }else{
           // $this -> error("有下级菜单或者有商品存在");
            $this -> error("有下级菜单存在");
        }
    }
    
    //天数分类
     public function resetDayPost($action){
        if($action == 'add'){
            if(empty($_POST['word'])){
                unset($_POST['word']);
            }
        }else if($action == 'edit'){
            if(empty($_POST['word'])){
                $_POST['word']='NULL';
            }
        }
        
    }
    
    public function day(){
        $lineDayModel=K('LineDay');
        if(empty($action)){
            $list=$lineDayModel->order('webid asc,word asc')->All();
            $this->assign('list',$list);
            $this->assign('currentKindName',$this->lineKinds['lineday']['name']);
            $this->display();
        }
    }
    
    public function day_UpdateCache(){
        $lineDayModel=K('LineDay');
        if($lineDayModel->updateCache()){
            $this -> success("更新缓存成功！");
        }else{
            $this -> error("更新缓存失败！");
        }
    }
    
    public function day_add(){
        if (IS_POST) {
            $lineDayModel=K('LineDay');
            $this->resetDayPost('add');
			if ($lineDayModel->add($_POST)) {
				$this -> success("添加成功！");
			} else {
				$this -> error("添加失败！");
			}
		} else {
            $this->assign('currentKindName',$this->lineKinds['lineday']['name']);
			$this -> display();
		}
    }
    
    public function day_edit(){
        $lineDayModel=K('LineDay');
        $id = Q("id",0, "intval");
        if (IS_POST) {
            $this->resetDayPost('edit');
            if ($lineDayModel-> where("id={$id}") -> save($_POST)) {
				$this -> success("修改成功！");
			} else {
				$this -> error("修改失败！");
			}
        }else{
            $this->assign('currentKindName',$this->lineKinds['lineday']['name']);
			if ($id) {
				$field = $lineDayModel-> find($id);
				$this->assign('field',$field);
				$this -> display();
			}
        }
    }
    
    public function day_del(){
        $lineDayModel=K('LineDay');
        $id = Q("id",0, "intval");
        
        $result = $lineDayModel->where(array('id' => $id))->find();
        if(count($result)>0){
            if($lineDayModel ->del('id = '.$id)){
                $this -> success("删除成功");
            }else{
                $this -> error("删除失败");
            }
        }else{
            $this -> error("删除失败");
        }
    }
    
    //价格分类
    public function resetPricePost($action){
        if($action == 'add'){
            if(empty($_POST['lowerprice'])){
                unset($_POST['lowerprice']);
            }
            if(empty($_POST['highprice'])){
                unset($_POST['highprice']);
            }
        }else if($action == 'edit'){
            if(empty($_POST['lowerprice'])){
                $_POST['lowerprice']='NULL';
            }
            if(empty($_POST['highprice'])){
                $_POST['highprice']='NULL';
            }
        }
    }
    
    public function price(){
        $LinePricelistModel=K('LinePricelist');
        $action=Q('action');
        if(empty($action)){
            $list=$LinePricelistModel->order('webid asc,lowerprice asc')->All();
            $this->assign('list',$list);
            $this->assign('currentKindName',$this->lineKinds['lineprice']['name']);
            $this->display();
        }
    }
    
    
    public function price_UpdateCache()
    {
        $LinePricelistModel=K('LinePricelist');
        if($LinePricelistModel->updateCache()){
            $this -> success("更新缓存成功！");
        }else{
            $this -> error("更新缓存失败！");
        }
    }
    
    
    public function price_add(){
        if (IS_POST) {
            $LinePricelistModel=K('LinePricelist');
            $this->resetPricePost('add');
			if ($LinePricelistModel->add($_POST)) {
				$this -> success("添加成功！");
			} else {
				$this -> error("添加失败！");
			}
		} else {
		  
            
            $this->assign('currentKindName',$this->lineKinds['lineprice']['name']);
			$this -> display();
		}
    }
    
    
    public function price_edit(){
        $LinePricelistModel=K('LinePricelist');
        $id = Q("id",0, "intval");
        if (IS_POST) {
            $this->resetPricePost('edit');
            if ($LinePricelistModel-> where("id={$id}") -> save($_POST)) {
				$this -> success("修改成功！");
			} else {
				$this -> error("修改失败！");
			}
        }else{
            
            $this->assign('currentKindName',$this->lineKinds['lineprice']['name']);
			if ($id) {
				$field = $LinePricelistModel-> find($id);
				$this->assign('field',$field);
				$this -> display();
			}
        }
    }
    
    public function price_del(){
        $LinePricelistModel=K('LinePricelist');
        $id = Q("id",0, "intval");
        
        $result = $LinePricelistModel->where(array('id' => $id))->find();
        if(count($result)>0){
            if($LinePricelistModel ->del('id = '.$id)){
                $this -> success("删除成功");
            }else{
                $this -> error("删除失败");
            }
        }else{
            $this -> error("删除失败");
        }
    }

	

	

	
    
    
}
