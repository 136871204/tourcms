<?php

/**
 * 权限节点管理
 * Class NodeControl
 * @author 周鸿 <136871204@qq.com>
 */
class TourOrderControl extends AuthControl{
    //模型
    private $_db;
    //节点树
    private $_node;
    
    public function __init()
    {
        //获得模型实例
        //$this->_db = K("Node");
        //$this->_node = cache("node");
    }
    
    //节点列表
    public function index()
    {
        $db_prefix=C('DB_PREFIX');
        $tourModelModel=K('TourModel');
        $tourMemberOrderModel=K('TourMemberOrder');
        
        
        $action=Q("action");
        $typeid=Q("typeid");
        $webid=Q("webid");
        
        $this->assign('typeid',$typeid);
        $channelname = $tourModelModel->getModuleName($typeid);
        
        /***** By xie  *****/        
        $this->assign('position',$channelname.'订单');
        $this->assign('channelname',$channelname);
        
        $keyword=Q("keyword");
        $status=Q("status");
        $order='order by a.addtime desc,a.status asc';
        $w = "where a.typeid = $typeid and contacttype = 'b2c'";
        if(!empty($keyword))
        {
            $w .=" and (a.ordersn like '%{$keyword}%' or a.linkman like '%{$keyword}%' or a.linktel like '%{$keyword}%' or a.productname like '%{$keyword}%')";
            $start = 0;
        }
        if(!empty($status)){
            $w .=" and status=$status";
        }
        $w.=empty($webid)||$webid==1?'  ':" and a.webid=$webid";
        
        //分页
        $countSql="select count(*) as num from ".$db_prefix."tour_member_order a $w ";
        $totalcount_arr=M()->query($countSql);
        //p($totalcount_arr);
        $page = new Page($totalcount_arr[0]["num"],10);  
        $this -> page = $page -> show(); //$param => 页面风格选择
        $limitarr=$page -> limit();
        $limitstr=$limitarr['limit'];     
        
        $sql="select a.*  from ".$db_prefix."tour_member_order as a $w $order limit $limitstr";
        $list=M()->query($sql);
        
        $new_list=array();
        if(!empty($list)){
            foreach($list as $k=>$v)
            {
                $v['addtime'] = TourCommon::myDate('Y-m-d H:i:s',$v['addtime']);
                if($v['pid']!=0)
                {
                    $v['productname'] = $v['productname']."[<span style='color:red'>子订单</span>]";
                }

                $new_list[] = $v;
            }
        }
        
        $result['total']=$totalcount_arr[0]['num'];
        $result['lists']=$new_list;
        $result['success']=true;
        
        $this -> assign("data",$result);
        $this -> assign("keyword",$keyword);
        $this -> assign("status",$status);
        $this -> assign("lists",getList());
        
        $this->display('list.php');
        
    }
    
    //新增订单
    public function add(){
        $typeid = Q('typeid',0);

        if( IS_POST ){
            $lineid=Q('lineid');
            $usedate=Q('usedate');
            $suitid=Q('suitid');
            $adultnum=Q('adultnum');
            $childnum=Q('childnum');
            $oldnum=Q('oldnum');

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
            $status = Q('status');
            $admin_note = Q('admin_note');
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
                'admin_note'=>nl2br($admin_note),
                'remark'=>$remarkinfo,
                'handleshop'=>$handleshop,
                'linksex'=>$linksex,
                'tourer'=>$tourer,
                'totalprice'=>$totalprice,
                'contacttype'=>'b2c',
            );
            $price    =  $arr['price'];
            $remark   = $arr['remark'];
            $dingnum  = $arr['dingnum'];
            $childnum = $arr['childnum'];
            //p($arr);
            if($this->addOrder($arr))
            {            
                echo "true";
                //$this -> success('発表成功！');                
                exit;
            }else{
                echo "false";
                exit;
            }
        }else{
            $this -> assign("typeid",$typeid);
            $this -> assign("handleshop", get_handle_shop_all());
            $this -> assign("lists",getList());
            $this -> display("add.php");
        }
        
    }
    
    public function edit(){
        
        if( IS_POST ){
            ;
            $id=Q('id');
            $usedate=Q('usedate');
            $suitid=Q('suitid');
            $adultnum=Q('adultnum',0);
            $childnum=Q('childnum',0);
            $oldnum=Q('oldnum',0);
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
            $price=Q('price');
            $childprice=Q('childprice');
            $oldprice=Q('oldprice');
            $linktel=pregReplace($linktel,2);
            $totalprice = Q('totalprice');
            $status = Q('status');
            $admin_note = Q('admin_note');
            
            $tourer = getTourer($_POST);
            //p($tourer);
            $webid='1';
            $memberid='1';
            $arr = array(
                "id"=>$id,
                //'ordersn'=>$ordersn,//产品序列号
                //'memberid'=>$memberid,
                //'webid'=>$webid,//站点id
                //'typeid'=>$typeid,//线路的typeid是1
                'productautoid'=>$productautoid,//线路id
                'productaid'=>$productaid,
                'productname'=>$productname,
                'price'=>$price,
                'childprice'=>$childprice,
                'oldprice'=>$oldprice,
                'usedate'=>$usedate,
                'dingnum'=>pregReplace($adultnum,2),
                'childnum'=>pregReplace($childnum,2),
                'oldnum'=>pregReplace($oldnum,2),
                'linkman'=>pregReplace($linkman,5),
                'linksex'=>$linksex,
                'linktel'=>pregReplace($linktel,2),
                'linkemail'=>pregReplace($linkemail,5),
                'handleshop'=>$handleshop,
                'remark'=>$remarkinfo,
                'updatetime'=>time(),
                'dingjin'=>pregReplace($dingjin,2),
                //'paytype'=>$suitinfo['paytype'],
                'suitid'=>$suitid,
                'status'=>$status,
                'admin_note'=>$admin_note,
                'tourer'=>$tourer,
                'totalprice'=>$totalprice
            );
            if($this->editOrder($arr))
            {            
                //echo "true";
                $this -> success('修改成功！');
                exit;
            }else{
                //echo "false";
                $this -> error('修改失败！');
                exit;
            }

        }else{
            $id = Q('id');//订单ID
            $order = M('tour_member_order') -> find($id);//订单信息
            $tourer = M('tour_member_order_tourer')->where("orderid = '".$order["id"]."'")->all();//套餐信息
            $lineinfo = K('Line')->getStandardInfo($order["productautoid"]);//线路信息
            $suit = M('line_suit')->find($order["suitid"]);//套餐信息
            //p($tourer);die;
            
            $arr = array();
            if(count($tourer)!="0"){
                foreach($tourer as $key => $val){
                    if($val["ptype"]=="1"){
                        $arr["adult"][]=$val;
                        continue;
                    }
                    if($val["ptype"]=="2"){
                        $arr["child"][]=$val;
                        continue;
                    }
                    if($val["ptype"]=="3"){
                        $arr["old"][]=$val;
                        continue;
                    }
                }
            }
            $tourer = $arr;
            //p($tourer);die;
            $this -> assign("order",$order);
            $this -> assign("lineinfo",$lineinfo);
            $this -> assign("suit",$suit);
            $this -> assign("tourer",$tourer);
            $this -> assign("handleshop", get_handle_shop_all());
            $this -> assign("lists",getList());
            $this -> display("edit.php");
        }
        
    }
    
    //预览
    public function views(){
        $db_prefix=C('DB_PREFIX');
        $tourMemberOrderModel=K('TourMemberOrder');
        
        $id = Q('id');
        //$typeid = Q('typeid');
        
        $info = $tourMemberOrderModel->find($id);
        $sql = "select * from ".$db_prefix."tour_member_order_tourer where orderid='{$info['id']}'";
        $tourer =M()->query($sql);
        if(!empty($tourer))$this->assign('tourer',$tourer);
        
        $this->assign('info',$info);
        //$this->assign('typeid',$typeid);
        
        $this -> assign("lists",getList());
        
        $this -> display("views.php");
    }
    
    // 删除
    public function del(){
        
        $id = Q('id', 0, 'intval');
            
		//删除订单
		if( M('tour_member_order') -> del($id) ){
		    M('tour_member_order_tourer') ->where("orderid = $id") -> del();
            $this -> success("删除成功");
		}else{
		    $this -> error("删除失败");
		}
		
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
                //$this->addTourer($tourer,$flag) ;//添加联系人 
                if( !$this->addTourer($tourer,$flag) ){
                    return false;
                }
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
            }
            
            return $flag;
        }
    }
    
    public function editOrder($arr){
        
        $flag = 0;
        $tourMemberOrderModel=K('TourMemberOrder');

        if( $temp = $tourMemberOrderModel -> checkForm($arr) ){
            echo $temp;
            exit;
        }

        if(is_array($arr))
        {
            /*$arr['kindlist'] = $this->getProductKindList($arr['productautoid'],$arr['typeid']);
            if($arr['paytype']=='3')//这里补充一个当为二次确认时,修改订单为未处理状态.
            {
                $arr['status'] = 0;
            }
            else
            {
                //$arr['status'] = 1;
            }*/
            if(isset($arr['tourer']))
            {
                $tourer = $arr['tourer'];
                unset($arr['tourer']);
            }
            
            //修改联系人信息
            $flag = M('tour_member_order') -> where("id='".$arr["id"]."'") -> save($arr);
            
            //先删除旧的游客
            $delflag = M('tour_member_order_tourer') -> where("orderid='".$arr["id"]."'") -> del();

            if( !$delflag ){
                return false;
            }
            
            $addnew = $this->addTourer($tourer,$arr["id"]);
            //p($addnew);
            //在添加新的游客信息
            if( !$addnew){
                return false;
            }
            
            return $flag;
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
            $row = $tempArr;

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
            $flagadd = $tourMemberOrderTourerModel->add($ar);
            if(!$flagadd){
                return false;
            }
            $i++;
        }
        
        return true;
    }
                
    //线路详细信息
    public function ajax_linedetail(){
        //使用model声明
        $lineModel=K('Line');
        
        //基本参数取得
        $typeid=1;
        $lineid=Q('lineid');
        $usedate=Q('usedate');
        $suitid=Q('suitid');
        //echo $lineid."_".$usedate."_".$suitid;
        //画面数据取得
        $lineinfo = $lineModel->getStandardInfo($lineid);//基本信息
        $suitinfo=$this->getLineSuitInfo($suitid);
        $priceinfo = $this->getDayPrice($usedate,$suitid);
        $group = explode(',',$suitinfo['propgroup']);//人群
  
        $lineinfo['title'] = $lineinfo['linename']."({$suitinfo['suitname']})";            
        $lineinfo['price'] = $priceinfo['adultprice']; //成人价格
        $lineinfo['childprice'] =  $priceinfo['childprice']; //小孩价格
        $lineinfo['oldprice'] =  $priceinfo['oldprice']; //婴儿价格
        if(in_array(1,$group))$lineinfo['haschild']=1;
        if(in_array(2,$group))$lineinfo['hasadult']=1;
        if(in_array(3,$group))$lineinfo['hasold']=1;

        echo json_encode($lineinfo);
        exit;
    }
    
    /**
     *  获得预订线路套餐基本信息
     *
     * @access    private
     * @return    array
     */
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
    
    
/***********************************************************************/
    
    public function view(){
        $db_prefix=C('DB_PREFIX');
        $tourMemberOrderModel=K('TourMemberOrder');
        
        $id = Q('id');
        $type = Q('type');
        $typeid = Q('typeid');
        if($type == 'dz') //customize订单
        {
            $info = ORM::factory('customize')->where('id','=',$id)->find()->as_array();
            $templet = 'dz_view';
        }

        else if($type == 'xy') //协议订单
        {
            $info = ORM::factory('dzorder')->where('id','=',$id)->find()->as_array();
            $templet = 'xy_view';

        }
        else //普通产品订单
        {
            $info = $tourMemberOrderModel->find($id);
            $templet = 'view.php';
        }
        
        if($typeid=='1' || $typeid=='8') //线路和签证有游客信息
        {
            $sql = "select * from ".$db_prefix."tour_member_order_tourer where orderid='{$info['id']}'";
            $tourer =M()->query($sql);
            if(!empty($tourer))$this->assign('tourer',$tourer);
        }
        
        $this->assign('info',$info);
        $this->assign('typeid',$typeid);
        $this->display($templet);
    }
    
    public function ajax_save(){
        $tourMemberOrderModel=K('TourMemberOrder'); 
        
        $id = Q('id');
        $type = Q('type');
        
        $status = false;
        if(empty($type))
        {
            $model = $tourMemberOrderModel->find($id);  
            $model['price'] = Q('price');
            $oldstatus = $model['status'];//原来状态*/

        }    
        else if($type == 'dz')
        {
            //$model = ORM::factory('customize',$id);

        }
        else if($type == 'xy')
        {
            //$model = ORM::factory('dzorder',$id);
        }
        $model['status'] = Q('status');
        $opid=$tourMemberOrderModel->update($model);
        if($opid)
        {
            $current_status = Q('status');
            if($oldstatus!=$current_status)
            {
                if($oldstatus!=3 && $current_status==3)
                {
                    $tourMemberOrderModel->refundStorage($id,'plus');//订单取消,增加库存
                }
                else if($oldstatus==3 && $current_status==1) //由取消变为在处理中
                { 
                    $tourMemberOrderModel->refundStorage($id,'minus');//订单增加,库存减少
                }
            }
            $status = true;
        }
        echo json_encode(array('status'=>$status));exit;
    }
    
    
    public function excel(){
               
        $this->assign('typeid',Q('typeid'));
        $this->display('excel.php');
                            
    }
    
    public function genexcel(){
        $tourMemberOrderModel=K('TourMemberOrder');
        
        
        $typeid = Q('typeid');
        $timetype = Q('timetype');
        $starttime = strtotime(Q('starttime'));
        $endtime = strtotime(Q('endtime'));
        switch($timetype)
        {
            case 1:
                $time_arr = TourCommon::getTimeRange(1);
                break;
            case 2:
                $time_arr = TourCommon::getTimeRange(2);
                break;
            case 3:
                $time_arr = TourCommon::getTimeRange(3);
                break;
            case 5:
                $time_arr = TourCommon::getTimeRange(5);
                break;
            case 6:
                $time_arr = array($starttime,$endtime);
                break;

        }
        $stime = date('Y-m-d',$time_arr[0]);
        $etime = date('Y-m-d',$time_arr[1]);
        
        $arr = $tourMemberOrderModel->where("addtime>=$time_arr[0] and addtime<=$time_arr[1] and typeid='$typeid' and pid=0")->All();
        $table = "<table><tr>";
        $table.="<td>订单号</td>";
        $table.="<td>产品名称</td>";
        $table.="<td>预订日期</td>";
        $table.="<td>使用日期</td>";
        $table.="<td>成人数量</td>";
        $table.="<td>成人价格</td>";
         if($typeid==1)
        {
            $table.="<td>儿童数量</td>";
            $table.="<td>儿童价格</td>";
            $table.="<td>老人数量</td>";
            $table.="<td>老人价格</td>";
        }
        $table.="</tr>";
        if(!empty($arr)){
            foreach($arr as $row)
            {
                $table.="<tr>";
                $table.="<td>{$row['ordersn']}</td>";
                $table.="<td>{$row['productname']}</td>";
                $table.="<td>".TourCommon::myDate('Y-m-d H:i:s',$row['addtime'])."</td>";
                $table.="<td>{$row['usedate']}</td>";
                $table.="<td>{$row['dingnum']}</td>";
                $table.="<td>{$row['price']}</td>";
    
                if($typeid==1)
                {
                    $table.="<td>{$row['childnum']}</td>";
                    $table.="<td>{$row['childprice']}</td>";
                    $table.="<td>{$row['oldnum']}</td>";
                    $table.="<td>{$row['oldprice']}</td>";
                }
                $table.="</tr>";
    
            }
        }
        $table.="</table>";
        
        $filename = date('Ymdhis');
        header ( 'Pragma:public');
        header ( 'Expires:0');
        header ( 'Cache-Control:must-revalidate,post-check=0,pre-check=0');
        header ( 'Content-Type:application/force-download');
        header ( 'Content-Type:application/vnd.ms-excel');
        header ( 'Content-Type:application/octet-stream');
        header ( 'Content-Type:application/download');
        header ( 'Content-Disposition:attachment;filename='.$filename.".xls" );
        header ( 'Content-Transfer-Encoding:binary');
        echo $table;
        exit();
    }
    
    /*
     * 订单统计数据查看
     * */
    public function dataview()
    {
        $year = date('Y');
        $this->assign('thisyear',$year);
        $this->assign('typeid',Q('typeid'));
        $this->display('data_view.php');
    }
    
    public function ajax_year_tj(){
        $year = Q('year');
        $typeid = Q('typeid');
        $current_year = date('Y');
        if($current_year<$year) exit('12');
        for($i=1;$i<=12;$i++)
        {
            $starttime =date('Y-m-d',mktime(0,0,0,$i,1,$year));//开始时间

            $endtime = strtotime("$starttime +1 month -1 day");//结束时间
            $timearr = array(strtotime($starttime),$endtime);

            $out[$i]= $this->getOrderDetailPrice($timearr,$typeid);
        }
        echo json_encode($out);exit;
    }
    
    public function ajax_sell_tj(){
        $out = array();
        $typeid = Q('typeid');
        //今日销售
        $time_arr = TourCommon::getTimeRange(1);
        $out['today'] = $this->getOrderDetailPrice($time_arr,$typeid);

        //昨日销售
        $time_arr = TourCommon::getTimeRange(2);
        $out['last'] = $this->getOrderDetailPrice($time_arr,$typeid);

        //本周销售
        $time_arr = TourCommon::getTimeRange(3);
        $out['thisweek'] = $this->getOrderDetailPrice($time_arr,$typeid);

        //本月销售
        $time_arr = TourCommon::getTimeRange(5);
        $out['thismonth'] = $this->getOrderDetailPrice($time_arr,$typeid);

        echo json_encode($out);exit;
    }
    
    /*
     * 获取已付款,未付款,已取消数量及价格
     * */
    private function getOrderDetailPrice($timearr,$typeid)
    {
        $tourMemberOrderModel=K('TourMemberOrder');
        $where = '';
        $out = array();
        if(is_array($timearr))
        {
            $starttime = $timearr[0];
            $endtime = $timearr[1];
            $where = "addtime>=$starttime and addtime<=$endtime and";
        }
        //已付款
        $arr = $tourMemberOrderModel->where("{$where} typeid=$typeid and ispay=1")->All();
        $price = 0;
        if(!empty($arr)){
            foreach($arr as $row)
            {
                $price+= intval($row['dingnum'])*$row['price']+intval($row['childnum'])*$row['childprice'];
            } 
        }
        
        $out['pay']=array(
            'num'=>count($arr),
            'price'=>$price
        );
        //未付款
        $arr = $tourMemberOrderModel->where("{$where} typeid=$typeid and ispay=0")->All();
        $price = 0;
        if(!empty($arr)){
            foreach($arr as $row)
            {
                $price+= intval($row['dingnum'])*$row['price']+intval($row['childnum'])*$row['childprice'];
            }
        }
        $out['unpay']=array(
            'num'=>count($arr),
            'price'=>$price
        );
        //已取消
        $arr = $tourMemberOrderModel->where("{$where} typeid=$typeid and status=3")->All();
        $price = 0;
        if(!empty($arr)){
            foreach($arr as $row)
            {
                $price+= intval($row['dingnum'])*$row['price']+intval($row['childnum'])*$row['childprice'];
            }
        }
        $out['cancel']=array(
            'num'=>count($arr),
            'price'=>$price
        );
        return $out;


    }
    
    
    public function ajax_sell_info(){
        $out = array();
        $typeid = Q('typeid');
        
        //今日销售
        $time_arr = TourCommon::getTimeRange(1);
        $out['today'] = $this->getOrderPrice($time_arr,$typeid);
        
         //昨日销售
        $time_arr = TourCommon::getTimeRange(2);
        $out['last'] = $this->getOrderPrice($time_arr,$typeid);

        //本周销售
        $time_arr = TourCommon::getTimeRange(3);
        $out['thisweek'] = $this->getOrderPrice($time_arr,$typeid);

        //本月销售
        $time_arr = TourCommon::getTimeRange(5);
        $out['thismonth'] = $this->getOrderPrice($time_arr,$typeid);

        //全部销售额
        $out['total'] = $this->getOrderPrice(0,$typeid);
        
        echo json_encode($out);
        exit;
        
    }
    
    //根据时间范围获取某个产品类型订单数量.
    private function getOrderPrice($timearr,$typeid)
    {
        $tourMemberOrderModel=K('TourMemberOrder');
        $where = '';
        if(is_array($timearr))
        {
            $starttime = $timearr[0];
            $endtime = $timearr[1];
            $where = "addtime>=$starttime and addtime<=$endtime and";
        }
        $arr =$tourMemberOrderModel->where("{$where} typeid=$typeid")->All();
        $price = 0;
        if(empty($arr)){
            return $price;
        }
        foreach($arr as $row)
        {
            $price+= intval($row['dingnum'])*$row['price']+intval($row['childnum'])*$row['childprice'];
        }
        return $price;
    }
    
    
    /**
     * 
     */
    public function startplace( $cityid ){
        $startcity = cache("all_startplace");
        
        if(count($startcity)!="0"){
            foreach( $startcity as $key => $val ){
                if( $val["id"] == $cityid ){
                    return $val["cityname"];
                }
            }
        }
        
        $startplaceModel=K('Startplace');
        return $startplaceModel->getStartCityNameShow($cityid);
        
    }
    
}
