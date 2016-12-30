<?php

/**
 * 网站前台
 * Class IndexControl
 * @author 周鸿 <136871204@qq.com>
 */
class LinesControl extends TripControl {
    
    
    public function ajax_suitoption(){
        $db_prefix=C("DB_PREFIX");
        //使用model声明
        $lineModel=K('Line');
        
        $lineid=Q('lineid');
        $suitid=Q('suitid');
        
        $lineinfo=$lineModel->find($lineid);
        if(!empty($lineinfo)){
            $linebefore=$lineinfo['linebefore'];
            if(!empty($linebefore)){
                $time = strtotime("+".$linebefore." day");
            }else{
                $time = strtotime(date('Y-m-d'));//现在时间
            }
        }else{
            $time = strtotime(date('Y-m-d'));//现在时间
        }
        if(B2BLOGIN){
            $sql = "select a.* from ".$db_prefix."line_suit_price as a inner join 
                ".$db_prefix."line_suit AS b on   a.suitid =b.id
                where a.suitid='$suitid' and a.day > '$time' and a.adultprice>0 and a.number !=0 and b.suittype='b2b' ";
        }else{
            $sql = "select a.* from ".$db_prefix."line_suit_price as a inner join 
                ".$db_prefix."line_suit AS b on   a.suitid =b.id
                where a.suitid='$suitid' and a.day > '$time' and a.adultprice>0 and a.number !=0 and b.suittype='b2c' ";
        }
        
        //p($sql);die;
        $arr = M()->query($sql);
        $monthli = '';
        $suitinfo = $this->getPeopleGroup($suitid);
        $group = explode(',',$suitinfo['propgroup']);//适用人群
        $jifentprice = $suitinfo['jifentprice'] ? $suitinfo['jifentprice'] : '无';
        $jifenbook = $suitinfo['jifenbook'] ? $suitinfo['jifenbook'] : '无';
        $jifenarr = array('jifentprice'=>$jifentprice,'jifenbook'=>$jifenbook);
        $out = array();
        $childprice="";
        $oldprice="";
        if(!empty($arr)){
            foreach($arr as $row)
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
            }
        }
        $out['monthli']=$monthli;
        $out['jifen']=$jifenarr;
        echo json_encode($out);
        exit;
    }
    
    
    
    
    //获取套餐适用人群与优惠
    public function getPeopleGroup($suitid)
    {
        $db_prefix=C("DB_PREFIX");
        $sql = "select propgroup,jifentprice,jifenbook from ".$db_prefix."line_suit
                where id='$suitid' ";
                
        $group =M()->getOneRow($sql);
        
        return $group;
    
    }
    
    
    public function show(){
        //使用model声明
        $lineModel=K('Line');
        $startplaceModel=K('Startplace');
        
        //基本参数取得
        $typeid=1;
        $aid=Q('aid');
        $webid=Q('webid',1);
        
        //画面数据取得
        $row = $lineModel->getStandardInfo($aid);//基本信息
        
        //如果没有公开显示页面的话，并且不是管理员的话，回到首页
        if( isset($row["ishidden"]) && $row["ishidden"] == "1" && !IN_ADMIN){
            $url = "http://".$_SERVER["HTTP_HOST"].$this->urlroot."/";
            header("Location:".$url);
        }
        //如果线路过期，返回首页
        if( isset($row["expire"]) && $row["expire"] < time() && !IN_ADMIN ){
            $url = "http://".$_SERVER["HTTP_HOST"].$this->urlroot."/";
            header("Location:".$url);
        }
        
        //p($row);
        //更新访问量
        updateVisit($aid,$typeid);
        
        //线路显示内容编辑
        $line_sn = 'HIS' . str_repeat('0', 8 - strlen($aid)) . $aid;
        if(empty($row['linesn'])){
            $row['linesn']=$line_sn;
        }
        $row['shopname']=getShopName($row['webid']);
        $real=getLineRealPrice($row['id'],$row['webid']);

        if( B2BLOGIN ){
            $row['lineprice']=$real ? $real : $row['b2blineprice'];
        }else{
            $row['lineprice']=$real ? $real : $row['lineprice'];
        }
        //echo $row['lineprice'];die;
        $row['price'] = empty($row['lineprice'])?'<strong class="price_one"><span>电询</span></strong>': '<strong class="price_one">¥ <span>'.$row['lineprice'].'</span> 起</strong>';
        $row['startcity'] = $startplaceModel->getStartCityNameShow($row['startcity']);
        $row['maxmindateshow']=getMaxMinSuitTime($row['id']);
        //经理推荐
        $magrecommend=explode(',',$row['magrecommend']);
        $magrecommendHtml="";
        if(!empty($magrecommend)){
            foreach($magrecommend as $key => $val){
                $magrecommendHtml.="<li><span>".$val."</span></li>";
            }
        }
        $row['magrecommendHtml']=$magrecommendHtml;
        //行程下载 
        $linedocHtml = "";
        if( $row["linedoc"] !='' ){
            $linedoc = explode( ",",trim($row["linedoc"],",") );
            foreach($linedoc as $key => $val){
                $linedocone = explode("||",$val);
                if(empty($linedocone[1])){
                    $title = "点击下载";
                }else{
                    $title = $linedocone[1];
                }
                $linedocHtml .= "<li><a href='".__ROOT__."/".$linedocone[0]."' target='_blank'><img src='".__TEMPLATE__."/common/images/ico/ico_pdf.png' alt=''><span>".$title."</span></a></li>\n";
            }
        }
        
        //航班信息
        $row['biaozhun_detail'] = unserialize($row['biaozhun_detail']);
        
        $row['linedocHtml']=$linedocHtml;
        $row['iconshow'] = getIconList($row['iconlist']);
        $pic_arr_show=$this->getPiclistArr($row);//读取图片带样式列表
        $row['photoHtml']=$pic_arr_show["biglist"];
        $row['photoHtml_mb']=$pic_arr_show["biglist_mb"];
        $this -> getLineSuit($row['id']);
        $jieshoout=$this -> getJieShao_smore($row['id']);
        $daysout=$this -> getdayshtml($row['lineday']);
        
        
        $basefield = "a.aid,a.id,a.webid,a.linename,a.lineicon,a.seotitle,a.sellpoint,a.linepic,a.storeprice,a.lineprice,a.linedate,a.features,a.transport,a.lineday,a.startcity,a.overcity,a.shownum,a.satisfyscore,a.bookcount,a.jifentprice,a.jifenbook,a.jifencomment,a.attrid,a.kindlist,a.color,a.iconlist";
        $db_prefix=C("DB_PREFIX");
        $time = time();
        if(empty($row['hotlines'])){
            $fieldwhere="";
            if(!empty($row['kindlist'])){
                $kindarr = explode(",", $row['kindlist']);
                
                $fieldwhere.=" AND ( ";
                $index=0;
                foreach($kindarr AS $val)
            	{
            	   if($index==0){
            	       $fieldwhere.="  FIND_IN_SET($val,a.kindlist) ";
            	   }else{
            	       $fieldwhere.="  OR FIND_IN_SET($val,a.kindlist) ";
            	   }
                   $index++;
            	}
                $fieldwhere.=" ) ";
            }
            
            if($webid!='1'){
                $fieldwhere .= " and a.webid=$webid";
            }
            
            $sql="select {$basefield} from {$db_prefix}line a where  a.ishidden=0 and a.expire > $time {$fieldwhere} order by a.shownum desc,a.addtime desc,a.modtime desc limit 0,4";
        	$hostLines=M()->query($sql);
        }else{
            $fieldwhere="";
            if($webid!='1'){
                $fieldwhere .= " and a.webid=$webid";
            }
            $sql="select {$basefield} from {$db_prefix}line a where  a.ishidden=0 and a.expire > $time {$fieldwhere} and id in({$row['hotlines']}) order by a.shownum desc,a.addtime desc,a.modtime desc limit 0,4";
            $hostLines=M()->query($sql);            
        }

        $this -> assign("jieshoout", $jieshoout);
        $this -> assign("daysout", $daysout);
        $this -> assign("lineinfo", $row);
        $this -> assign("hostLines", $hostLines);
        
        if($row["kindlist"]){
            $destarr_id = explode(",",$row["kindlist"]);
            arsort($destarr_id);
            $dest_id = $destarr_id[0];
            $pkname = get_par_value($dest_id,$typeid);//上一级
        }else{
            $pkname = '&gt; <span><a href="' . $this ->urlroot . '/lines/show_' . $row['id'] . '.html/">' . $row['linename'] . '</a></span>';
        }        

        //$pkname = get_par_value($dest_id,$typeid);//上一级
        $this -> assign("pkname", $pkname);
        
        
        /* 页面title keywords description */
        $seoinfo = array();
        $seostring = "";
        if($row["kindlist"]){
            $kindlist = explode(",",$row["kindlist"]);
            $dest = cache("all_dest");
            if(empty($dest)){
                $dest = M('destinations')->all();
            }
            foreach( $kindlist as $val ){
                foreach($dest as $v){
                    if($val==$v["id"]){
                        $seostring .= $v["kindname"]."旅游,";
                        continue;
                    }
                }
                
            }
            $seostring = trim($seostring,",");
        }
        
        if( !empty($row["seotitle"])){
            $seoinfo["title"] = $row["seotitle"];
        }else{
            $seoinfo["title"] = trim($row["linename"].",".$seostring,",");
        }
        
        if( !empty($row["keyword"])){
             $seoinfo["keyword"] = $row["keyword"];
        }else{
            $seoinfo["keyword"] = $seostring;
        }
        
        if( !empty($row["description"])){
             $seoinfo["description"] = $row["description"];
        }else{
            $seoinfo["description"] = $row["linename"];
        }
        
        $this -> assign("seoinfo",$seoinfo);
        
        $CacheTime =-1;
        $this -> display('template/' . C('WEB_STYLE') . '/lines/line_show.html', $CacheTime);
    }
    
    public function getdayshtml($lineday){
        $dayshtml='';
        for($i=1; $i<=$lineday; $i++)
        {
            $dayshtml.='<li><a href="">Day '.$i.'</a></li>';
        }
        return $dayshtml;
    }
    
    public function getJieShao_smore($lineid)
    {
        $db_prefix=C("DB_PREFIX");
        if($this ->checkJieShao3($lineid))
        {
            return $this ->getJieShao_transfer($lineid);
        }else{
            /*$str = "";
            $sql = "select id,isstyle,lineday,txtjieshao,jieshao,showrepast from ".$db_prefix."line where id='$lineid' ";
            $row = M()->getOneRow($sql);
            p($row);*/
        }
    }
    
    public function getJieShao_transfer($lineid)
    {
        $db_prefix=C("DB_PREFIX");
        $str = "";
        $sql = "select id,isstyle,lineday,jieshao,showrepast from ".$db_prefix."line where id='$lineid' ";
        $row = M()->getOneRow($sql);
        $repast_style = empty($row['showrepast']) ? "style='display:none'" : '';
        $lineday = $row['lineday'];
        $out = '';
        if(empty($row['isstyle']) || $row['isstyle'] == 0)
        {
            $row['isstyle'] = 1;
        }
        else
        {
            $row['isstyle'] = $row['isstyle'];
        }
        if($row['isstyle'] == 1) //编辑器里编辑的行程,直接读取
        {
            $out = $row['jieshao'];
        }
        else if($row['isstyle'] == 2) //按天数上传的行程
        {
            $sql = "select * from ".$db_prefix."line_jieshao where lineid='$lineid' order by day asc";
            $arr = M()->query($sql);
            if( isset($arr[0]) && $arr[0]["title"]=="" ){
                return "";
            }
            
            $out .= '<div class="tour_day_detail">';
            for($i=1; $i<=$lineday; $i++)
            {
                $j = $i-1;
                //餐饮信息
                $breakinfo = $arr[$j]['breakfirsthas'] ? '含' : 'x';
                $lunchinfo = $arr[$j]['lunchhas'] ? '含' : 'x';
                $supperinfo = $arr[$j]['supperhas'] ? '含' : 'x';
                $b_desc = !empty($arr[$j]['breakfirst']) ? $arr[$j]['breakfirst'] : '';
                $l_desc = !empty($arr[$j]['lunch']) ? $arr[$j]['lunch'] : '';
                $s_desc = !empty($arr[$j]['supper']) ? $arr[$j]['supper'] : '';
                
                //酒店信息
                $arr[$j]['hotel'] = str_replace('\'','',$arr[$j]['hotel']);
                //$hotelinfo = getInfo('#@__hotel',"where hotelname='{$arr[$j]['hotel']}'");
                $hotelinfo = array();
                $hashotel = !empty($hotelinfo['hotelname']) ? 1 : 0;//是否有对应酒店.
                if($hashotel)
                {
                }
                else
                {
                    $hotelstyle = "style='display:none'"; //酒店隐藏
                    $simple_hotel_style =  "style='display:block'"; //简单酒店显示
                }
                
                $dayimages=$arr[$j]['timg'];
                $timgarr=explode(',',$dayimages);
                $timghtml="";
                foreach($timgarr as $ivalue)
                {
                    if(empty($ivalue))
                    {
                        continue;
                    }
                    $temparr=explode('||',$ivalue);
                    $timghtml .='<li>
                					<img width="256" src="/'.$temparr[0].'" title="">
                				</li>';
                }
                
                $detailhtml="";
                if(!empty($arr[$j]['jieshao'])){
                    $detailhtml.='<p>
                                  '.html_entity_decode($arr[$j]['jieshao']).'
                                  </p>';
                }
                
                $out.='<div class="tdd_content">';
                        if($lineday == "1"){
                            $out.='<span class="td_begin"><span class="td_begin_in">'.$arr[$j]['title'] .'</span></span>';
                        }else{
                            $out .='<span class="td_begin"><span class="td_begin_in">第'.$i.'天  '.$arr[$j]['title'] .'</span></span>';
                        }
    		                
				     $out .='<div class="td_content_detail">
                                <span class="td_detail_begin eat"'.$repast_style.'>
                                <span class="td_inner_block">
                                <table class="td_eat_table"'.$repast_style.'>
    					            <tbody>
                                      <tr>
                                        <th>早餐：</th>';
                                        if($b_desc){
                                            $out.='<td>'.$b_desc.'</td>';
                                        }else{
                                            $out.='<td>'.$breakinfo.'</td>';
                                        }
                                $out.=' <th>午餐：</th>';
                                        if($l_desc){
                                            $out.='<td>'.$l_desc.'</td>';
                                        }else{
                                            $out.='<td>'.$lunchinfo.'</td>';
                                        }
                                $out.=' <th>晚餐：</th>';
                                        if($s_desc){
                                            $out.='<td>'.$s_desc.'</td>';
                                        }else{
                                            $out.='<td>'.$supperinfo.'</td>';
                                        }
                            $out.='</tbody>
                                </table>
                                </span>
                                </span>';
                                if(!empty($arr[$j]['hotel'])){                                    
                                    $out.='<span class="td_detail_begin hotel" '.$simple_hotel_style.'>
                                        <span class="td_inner_block">
                                         住宿：'.$arr[$j]['hotel'].'
                                         </span>
                                    </span>';
                                }
                                if(!empty($arr[$j]['transport'])){  
                                    $out.='<span class="td_detail_begin vehicle">
                                        交通工具：'.$arr[$j]['transport'].'
                                    </span>';
                                }
                                if( !empty($arr[$j]['tjieshao']) || !empty($timghtml) || !empty($detailhtml)){
                            $out.='<div class="td_travel_detai">
                                        <dl>
                                            <dt>介绍</dt>
                                            <dd>';
                                            if(!empty($arr[$j]['tjieshao'])){
                                                $out .='<p>'.nl2br($arr[$j]['tjieshao']).'</p>';
                                            }
                                            if(!empty($timghtml)){
                                                $out .='<ul class="t_d_list_03">
                                                    '.$timghtml.'
                                                </ul>';
                                            }
                                            if(!empty($detailhtml)){
                                                $out .= $detailhtml;
                                            }   
                                            $out.='</dd>
                                        </dl>
                                    </div>';
                                    }
                        $out.='</div>
    					</div>';
            }
            $out .= '</div>';
        }
        //header("Content-Type: text/html; charset=utf-8");
        //echo $out;die;
        return $out;
    }
    
    public function checkJieShao3($lineid)
    {
        $db_prefix=C("DB_PREFIX");
        $sql = "select count(*) as num from ".$db_prefix."line_jieshao where lineid='$lineid'";
        $row = M()->getOneRow($sql);
        //p($row);
        return $row['num']>0 ? 1 : 0;
    
    }
        
    
    public function getLineSuit($lineid){
        $db_prefix=C("DB_PREFIX");
        if(B2BLOGIN){
            $sql="select a.* from ".$db_prefix."line_suit a where a.lineid='$lineid' and a.suittype='b2b' order by a.displayorder asc";
        }else{
            $sql="select a.* from ".$db_prefix."line_suit a where a.lineid='$lineid' and a.suittype='b2c' order by a.displayorder asc";
        }
        //$sql="select a.* from ".$db_prefix."line_suit a where a.lineid='$lineid' order by a.displayorder asc";
        $suitR=M()->query($sql);
        $this -> assign("linesuit", $suitR);
    }
    
    public function getPiclistArr($row)
    {
        $num=0;
        $defaultImg='template/' . C('WEB_STYLE') ."/common/images/500x280_default.jpg";
        $biglist="";
        $biglist_mb="";
        if(empty($row['linepic'])&&empty($row['piclist']))//没有任何图片时处理
        {
            $biglist .='<li>
            					<a href="/'.$defaultImg.'">
            						<img src="/'.$defaultImg.'" title="">
            					</a>
            				</li>';
            $biglist_mb .='<div class="item">
            					<img class="lazyOwl" data-src="/'.$defaultImg.'" src="" alt="">
            				</div>';
                            
        }else if(empty($row['piclist'])&&!empty($row['linepic'])) //只上传封面的情况.
        {
            $biglist .='<li>
            					<a href="/'.$row['linepic'].'">
            						<img src="/'.$row['linepic'].'" title="">
            					</a>
            				</li>';
            $biglist_mb .='<div class="item">
            					<img class="lazyOwl" data-src="/'.$row['linepic'].'" src="" alt="">
            				</div>';
        }else
        {
            $picarr=explode(',',$row['piclist']);
            if(!empty($row['linepic']))
            {
                $biglist .='<li>
            					<a href="/'.$row['linepic'].'">
            						<img src="/'.$row['linepic'].'" title="">
            					</a>
            				</li>';
            $biglist_mb .='<div class="item">
            					<img class="lazyOwl" data-src="/'.$row['linepic'].'" src="" alt="">
            				</div>';
            }
            foreach($picarr as $value)
            {
                if(empty($value))
                {
                    continue;
                }
                $temparr=explode('||',$value);
                $biglist .='<li>
            					<a href="/'.$temparr[0].'">
            						<img src="/'.$temparr[0].'" title="">
            					</a>
            				</li>';
                $biglist_mb .='<div class="item">
                					<img class="lazyOwl" data-src="/'.$temparr[0].'" src="" alt="">
                				</div>';
            }
        }
        return array("biglist"=>$biglist,"biglist_mb"=>$biglist_mb);
    }
    
	//网站首页
	public function search() {
       
        //获得参数，参数初始化
        $db_prefix=C("DB_PREFIX");
        $typeid=1;
        $webid = Q("webid");
        $dest_id=Q('dest_id');
        
        if(!is_numeric($dest_id)) //如果dest_id不是数字,则用户使用拼音访问需要获取相应的目的地id,否则,则直接赋值
        {
            if($dest_id!='all')
            {
                //根据拼音获取目的地id
                $d_id = getDestIdByPinYin($dest_id);
  
                $dest_id = !empty($d_id) ? $d_id : 0;
            }
            else
            {
               $dest_id = 0 ;
            }
        }
        
        //存储前一个用户选择导航.
        $dest_id=isset($dest_id) ? $dest_id : 0;
        $para1=Q('para1',0);
        $day=Q('day',0);
        $priceid=Q('priceid',0);
        $attrid=Q('attrid',0);
        $sorttype=Q('sorttype',0);
        $cityid = $startcity=Q('startcity',0);
        
        
        //设置检索项目显示内容
        //设置目的城市数据
        $this->setDestdata($dest_id,$typeid);
        //设置行程天数
        $this->setlineguide('day',$dest_id);
        //设置价格区间
        $this->setlineguide('price',$dest_id); 
        //设置出发城市
        $this->setstartplace($dest_id);    
        //设置线路属性
        $this->setattrgrouplist($dest_id);
       
        //设置画面显示内容
        //获取父级目的地链接信息
        $this -> assign("destid", $dest_id);
        $this -> assign("para1", $para1);
        $this -> assign("day", $day);
        $this -> assign("priceid", $priceid);
        $this -> assign("sorttype", $sorttype);
        $this -> assign("attrid", $attrid);
        $this -> assign("startcity", $startcity);
        $pkname = get_par_value($dest_id,$typeid);//上一级
        $this -> assign("pkname", $pkname);


        //获取sql语句
        $sqlArr=$this->setSearchListSql($dest_id);

        //分页参数获取
        $count = M()->getOne($sqlArr['countsql'],'cnt');
        $this -> assign("count",$count);
        $page = new TourPage($count,10); //总数，单页数量
        $this -> page = $page -> show(6); //$param => 页面风格选择
        $limitarr=$page -> limit();
        $limitstr=$limitarr['limit'];
        
        //查询sql 查询数据用
        if(!empty($dest_id))
        {
            $sql=$sqlArr['searchsql']." limit {$limitstr} ";
        }
        else
        {
            $sql=$sqlArr['searchsql']." limit {$limitstr}  ";
        }
         
        //右侧热门线路 数据
        $hotLineSql=$sqlArr['hotlinesql'];
        //无数据则显示推荐线路 数据
        $linelist_tjsql = $sqlArr['linelist_tjsql'];
        
        //线路数据
        $lineList=M()->query($sql);
        $startplaceModel=K('Startplace');
        if(!empty($lineList)){
            foreach($lineList as $key => &$val){
                $val['startcity'] = $startplaceModel->getStartCityNameShow($val['startcity']);
                $val['maxmindateshow']=getMaxMinSuitTimeShow($val);
                $showAttrs=getLineAttrName2($val['attrid'],20);
                $val['showattrs']=$showAttrs;
                if(B2BLOGIN){
                    $real=$val['b2blineprice'];//getLineRealPrice($val['id'],$val['webid']);
                    $val['b2blineprice']=$real ? $real : $val['b2blineprice'];
                    $val['price'] = empty($val['b2blineprice'])?'<p><strong>电询</strong></p>': '<p>¥ <strong>'.$val['b2blineprice'].'</strong>起</p>';
                }else{
                    $real=$val['lineprice'];//getLineRealPrice($val['id'],$val['webid']);
                    $val['lineprice']=$real ? $real : $val['lineprice'];
                    $val['price'] = empty($val['lineprice'])?'<p><strong>电询</strong></p>': '<p>¥ <strong>'.$val['lineprice'].'</strong>起</p>';
                }
                $val['iconshow'] = getIconList($val['iconlist']);
            }
        }
        $this -> assign("lineList", $lineList);        
        
        //右侧热门线路
        $hotLineList=M()->query($hotLineSql);
        if(!empty($hotLineList)){
            foreach($hotLineList as $key => &$val){
                $val['startcity'] = $startplaceModel->getStartCityNameShow($val['startcity']);
                
                if(B2BLOGIN){
                    $real=$val['b2blineprice'];//getLineRealPrice($val['id'],$val['webid']);
                    $val['b2blineprice']=$real ? $real : $val['b2blineprice'];
                    $val['price'] = empty($val['b2blineprice'])?'<strong>电询</strong>': '<strong>¥'.$val['b2blineprice'].'起</strong>';
                    //$val['iconshow']=$this->getIconList($val['iconlist']);
                }else{
                    $real=$val['lineprice'];//getLineRealPrice($val['id'],$val['webid']);
                    $val['lineprice']=$real ? $real : $val['lineprice'];
                    $val['price'] = empty($val['lineprice'])?'<strong>电询</strong>': '<strong>¥'.$val['lineprice'].'起</strong>';
                    //$val['iconshow']=$this->getIconList($val['iconlist']);
                }
                

            }
        }
        $this -> assign("hotLineList", $hotLineList);
        
        
        //无数据显示推荐线路
        $linelist_tj = "";
        if(count($lineList)=="0"){
            $linelist_tj = M()->query($linelist_tjsql);
            if(!empty($linelist_tj)){
                foreach($linelist_tj as $key => &$val){
                    $val['startcity'] = $startplaceModel->getStartCityNameShow($val['startcity']);
                    $val['maxmindateshow']=getMaxMinSuitTimeShow($val);
                    $showAttrs=getLineAttrName2($val['attrid'],20);
                    $val['showattrs']=$showAttrs;
                    $real=$val['lineprice'];//getLineRealPrice($val['id'],$val['webid']);
                    $val['lineprice']=$real ? $real : $val['lineprice'];
                    $val['price'] = empty($val['lineprice'])?'<p><strong>电询</strong></p>': '<p>¥ <strong>'.$val['lineprice'].'</strong>起</p>';
                    $val['iconshow'] = getIconList($val['iconlist']);
                }
            }
        }
        $this -> assign("linelist_tj", $linelist_tj);
        //p($linelist_tj);
       
	    $CacheTime = C('CACHE_LINES_SEARCH') >= 1 ? C('CACHE_LINES_SEARCH') : -1;
		$this -> display('template/' . C('WEB_STYLE') . '/lines/line_search.html', $CacheTime);
	}
    
    //检索页面的sql问设定
    public function setSearchListSql($dest_id){
        //所需参数设置
        $db_prefix=C("DB_PREFIX");
        $typeid=1;
        $webid = Q("webid");
        $day=Q('day',0);
        $priceid=Q('priceid',0);
        $attrid=Q('attrid',0);
        $sorttype=Q('sorttype',0);
        $cityid = $startcity=Q('startcity',0);
       
        //sql文创建开始
        $where="";
        $wherecount="";
        $hotlinewhere="";
        $orderby=""; 
        $time = time();
        if( $webid == "1" ){
            $where="where a.ishidden=0 and a.expire > $time ";
            $wherecount=" where  a.ishidden=0 and a.expire > $time ";
            $hotlinewhere="where a.ishidden=0 and a.expire > $time ";
        }else{            
            $where="where a.ishidden=0 and a.webid = $webid and a.expire > $time ";
            $wherecount=" where  a.ishidden=0  and a.webid = $webid and a.expire > $time ";
            $hotlinewhere="where a.ishidden=0 and a.webid = $webid and a.expire > $time ";
        }
        
        if(!empty($dest_id)&& $dest_id!=0)
        {
            $orderby=" order by case when b.displayorder is null then 9999 end,b.displayorder asc ";
        }else{
            $orderby="order by a.isding desc,a.displayorder asc ";
        }
        
        if(!empty($dest_id)&& $dest_id!=0)
        {
            if(empty($key_dest))
            {
                $where.=" and FIND_IN_SET($dest_id,a.kindlist)";
                $wherecount.="  and FIND_IN_SET($dest_id,a.kindlist)";
                $hotlinewhere.= " and FIND_IN_SET($dest_id,a.kindlist)";
                $orderby=" order by case when b.displayorder is null then 9999 end,b.displayorder asc ";
               // p($dest_id);
            }
            else
            {
                $orderby=" order by case when b.displayorder is null then 9999 end,b.displayorder asc ";
            }
        }else{
            $orderby="order by a.isding desc,a.displayorder asc ";
        }
        
        //天数
        if(!empty($day) && $day!=0)
        { 
          $where.=" and a.lineday=$day ";
          $wherecount.=" and a.lineday=$day ";
        }
        //价格范围
        if(!empty($priceid)&& $priceid!=0)
        {
           $pricearr=$this->getMinMaxprice($priceid);//取得价格范围的最小与最大值 .
           $where.=" and a.lineprice >= {$pricearr['min']} and a.lineprice <= {$pricearr['max']} ";
           $wherecount.=" and a.lineprice >= {$pricearr['min']} and a.lineprice <= {$pricearr['max']} ";
        }
        //出发城市
        if(!empty($startcity) && $startcity!=0)
        {
            $where.=" and a.startcity = '$startcity' ";
            $wherecount.=" and a.startcity = '$startcity' ";
        }
        //属性
        if($attrid)
        { 
           $attrwhere = getAttWhere($attrid);//属性条件
           $where.= $attrwhere;
          
           $wherecount.= $attrwhere;
        }
        $fields="a.id,a.aid,a.linepic,a.iconlist,a.webid,a.lineicon,a.linename as title,a.piclist,a.seotitle,
                a.sellpoint,a.linepic as litpic,a.storeprice,a.lineprice,a.linedate,a.transport,a.lineday,
                a.startcity,a.overcity,a.shownum,a.satisfyscore,a.bookcount,a.features,a.jifenbook,a.jifentprice,
                a.jifencomment,a.paytype,a.attrid,a.storeprice,a.holiday,a.minday,a.maxday,a.b2blineprice,a.b2bminday,a.b2bmaxday";
        if(!empty($sorttype) && $sorttype!=0)
        {

            if($sorttype==1) //推荐排序
            {
                $orderby = "order by a.yesjian desc";	
            }
            else if($sorttype==2) //价格低到高
        	{
        	    $orderby=" order by a.lineprice asc";	
        	}
            else if($sorttype==3) //销量
        	{
        		$orderby=" order by a.bookcount desc";
        	}
            else if($sorttype==4) //人气
        	{
        		$orderby=" order by a.shownum desc";
        	}
            else if($sorttype==5) //价格高到低
        	{
        		$orderby=" order by a.lineprice desc";
        	}
        }
        //查询sql 总数，分页用
        if(!empty($dest_id))
        {
            $countsql="select 
                    count(*) as cnt
                    from 
                    ".$db_prefix."line as a left join 
                    ".$db_prefix."kindorderlist b on(a.id=b.aid and b.typeid=1 and b.classid=$dest_id and b.webid = $webid ) 
                    {$where}
                    {$orderby},addtime desc,modtime desc ";
            
        }
        else
        {
            $countsql="select 
                    count(*) as cnt
                    from 
                    ".$db_prefix."line as a left join 
                    ".$db_prefix."allorderlist b on(a.id=b.aid and b.typeid=1  and b.webid = $webid ) 
                    {$where}
                    {$orderby},addtime desc,modtime desc ";

        }
        
        //查询sql 查询数据用
        if(!empty($dest_id))
        {
            $searchsql="select 
                    {$fields},a.linepic as litpic,b.isjian,b.isding,b.istejia 
                    from 
                    ".$db_prefix."line as a left join 
                    ".$db_prefix."kindorderlist b on(a.id=b.aid and b.typeid=1 and b.classid=$dest_id  and b.webid = $webid ) 
                    {$where}
                    {$orderby},addtime desc,modtime desc";
            
        }
        else
        {
            $searchsql="select 
                    {$fields},a.linepic as litpic,b.isjian,b.isding,b.istejia 
                    from 
                    ".$db_prefix."line as a left join 
                    ".$db_prefix."allorderlist b on(a.id=b.aid and b.typeid=1  and b.webid = $webid ) 
                    {$where}
                    {$orderby},addtime desc,modtime desc";
        }
        
        //右侧热门线路 数据
        $hotlinesql="select 
                    {$fields},a.linepic as litpic
                    from 
                    ".$db_prefix."line as a left join 
                    ".$db_prefix."allorderlist b on(a.id=b.aid and b.typeid=1 and b.webid = $webid ) 
                      $hotlinewhere  and FIND_IN_SET(1,a.iconlist)
                    {$orderby} , addtime desc,modtime desc limit 0,3";
                    
        //推荐数据
        $linelist_tjsql="select 
                    {$fields},a.linepic as litpic,b.isjian,b.isding,b.istejia 
                    from 
                    ".$db_prefix."line as a left join 
                    ".$db_prefix."kindorderlist b on(a.id=b.aid and b.typeid=1 and b.webid = $webid ) 
                    where a.ishidden=0 and a.iconlist is not null and a.iconlist <> ''
                    order by addtime desc,modtime desc limit 0,8";
                    
             
        return array(
                    'countsql'=>$countsql,
                    'searchsql'=>$searchsql,
                    'hotlinesql'=>$hotlinesql,
                    'linelist_tjsql'=>$linelist_tjsql
                );
    }
    
    
    public function getMinMaxprice($priceid)
    {
        $db_prefix=C("DB_PREFIX");
        $arr=array();
        $arr['min']='';
        $arr['max']='';
        /*$sql="select lowerprice as min,highprice as max from ".$db_prefix."line_pricelist where id=$priceid";
        $row=M()->getOneRow($sql);*/
        $priceArr=cache('line_pricelist');
        if(!empty($priceArr)){
            foreach($priceArr as $price ){
                if($priceid == $price['id']){
                    $arr['min']=!empty($price['lowerprice'])?$price['lowerprice']:0;
                    $arr['max']=!empty($price['highprice'])?$price['highprice']:99999;
                }
            }
        }
       /* p($priceArr);die;
    
        if(is_array($row))
        {
            $arr['min']=!empty($row['min'])?$row['min']:0;
            $arr['max']=!empty($row['max'])?$row['max']:99999;
        }*/
     
        return $arr;
    }
    
    //设置目的城市数据
    public function setDestdata($dest_id,$typeid){
        //当前状态
        $destinfo = getParentDestNav($dest_id);
        if(count($destinfo)!="0"){            
            $tids=array();//目的地 当前选中状态id
            $destlevel=array();
            $level=1;
            foreach($destinfo as $k => $v){
                $r = getChildDests($v['pid'],$typeid); //获取下级目的地
                $r=$this -> checkDest($r);
                $destlevel[$level]=$r;
                $level++;
                $tids[]=$v['id'];
            }

            $this -> assign("tids", $tids);
            $this -> assign("destlevel", $destlevel);

            //下级目的地
            $destlist = getChildDests($dest_id,$typeid); 
            $destlist=$this -> checkDest($destlist);
            
            //p($destlist);
            $this -> assign("destlist", $destlist);
        }else{
            $destlevel[1] = getChildDests($dest_id,$typeid);
            $destlevel[1]=$this -> checkDest($destlevel[1]);
            $this -> assign("destlevel", $destlevel);
        }
    }
    
    public function checkDest($destlist){
        $tdestlist=array();
        if(!empty($destlist)){
            foreach($destlist as $dest){
                if($this->CheckLineDest($dest['id'])){
                    $tdestlist[]=$dest;
                }
            }
        }
        return $tdestlist;
    }
    

    
    public function CheckLineDest($dest_id){
        $db_prefix=C("DB_PREFIX");
        $webid = Q("webid");
        $w="";
        if( $webid == "1" ){
            $w.="";
        }else{
            $w.=" and webid='$webid'";
        }
        $sql="select 1 from ".$db_prefix."line where FIND_IN_SET($dest_id,kindlist) $w and ishidden=0  and expire > ".time()." limit 1";
        return M()->query($sql);
    }
    
    
    //设置行程天数和价格区间
    public function setlineguide($flag='',$dest_id,$row=10){
        $db_prefix=C("DB_PREFIX");
        if($flag=='day')
    	{
    	     $tdayResult=array();
            //$sql="select id,word from ".$db_prefix."line_day  where webid=1 order by word asc";
            //$dayResult=M()->query($sql);
            $dayResult=cache('line_day');
            if(!empty($dayResult)){
                $autoindex=0;
                $rowcount=count($dayResult);
                foreach($dayResult as $key=>&$row){
                    $autoindex++;
                    $number=substr($row['word'],0,2);
                    $arr=array("零","一","二","三","四","五","六","七","八","九");
                    if(strlen($number)==1)
      		        {
                       $result=$arr[$number];
                    }
                    else
                    {
                        if($number==10)
                        {
                            $result="十";
                        }
                        else{
                            if($number<20)
                            {
                                $result="十";
                            }
                            else{
                                $result=$arr[substr($number,0,1)]."十";
                            }
                            if(substr($number,1,1)!="0")
                            {
                                $result.=$arr[substr($number,1,1)]; 
                            }
                        }
                    }
                    if($this->CheckLineDay($row['word'],$dest_id)) //检测是否存在.
                    {
                        if($autoindex==$rowcount){
                            $row['title']=$result."日游以上";
                        }
                        else
                        {
                            $row['title']=$result."日游";
                        }
                        $tdayResult[]=$row;
                    }else
      		        {
                        continue;
      		        }
                }
                
            }
           

            $this -> assign("dayResult", $tdayResult);
    	}else if($flag=='price'){
    	  /*$sql="select 
                    id,aid,lowerprice as min,highprice as max 
                from ".$db_prefix."line_pricelist where webid=1 order by min limit 0,{$row}";
            $priceResult=M()->query($sql);*/
            $tpriceResult=array();
            $priceResult=cache('line_pricelist');
            if(!empty($priceResult)){
                $autoindex=0;
                $rowcount=count($priceResult);
                foreach($priceResult as $key=>&$row){
                    if($this->CheckLinePrice($row['lowerprice'],$row['highprice'],$dest_id)) //检测价格范围是否存在.
                    {
                        if($row['lowerprice']!=''&& $row['highprice']!='' && $row['lowerprice']!=0)
        			   {
        				  $row['title']=$row['lowerprice'].'~'.$row['highprice'].'';
        			   }
        			   else if($row['lowerprice']=='' || $row['lowerprice']==0)
        			   {
        				  $row['title']=$row['highprice'].'以下';
        			   }
        			   else if($row['highprice']=='')
        			   {
        				  $row['title']=$row['lowerprice'].'以上';
        			   }
                       $tpriceResult[]=$row;
                    }
                }
            }
            $this -> assign("priceResult", $tpriceResult);
    	}
        
    }
    public function CheckLineDay($value,$dest_id){
        $db_prefix=C("DB_PREFIX");
        $webid = Q("webid");
        $w="";
        if( $webid == "1" ){
            $w.="";
        }else{
            $w.=" and webid='$webid'";
        }
        
        if($dest_id != 0){
            $sql="select 1 from ".$db_prefix."line where lineday='$value' $w and ishidden=0 and expire > ".time()." and FIND_IN_SET($dest_id,kindlist) limit 1";
        }else{
            $sql="select 1 from ".$db_prefix."line where lineday='$value' $w and ishidden=0 and expire > ".time()." limit 1";
        }
        return M()->query($sql);
    }
    
     public function CheckLinePrice($min,$max,$dest_id){
        $db_prefix=C("DB_PREFIX");
        $webid = Q("webid");
        $w="";
        if( $webid == "1" ){
            $w.="";
        }else{
            $w.=" and webid='$webid'";
        }
        $min=!empty($min) ? $min : 0;
        $max=!empty($max) ? $max : 999999;
    
        if($dest_id != 0){
            $sql="select 1 from ".$db_prefix."line where lineprice>=$min and lineprice<=$max $w and ishidden=0 and expire > ".time()." and FIND_IN_SET($dest_id,kindlist) limit 1";
        }else{
            $sql="select 1 from ".$db_prefix."line where lineprice>=$min and lineprice<=$max $w and ishidden=0 and expire > ".time()." limit 1";
        }
        return M()->query($sql);
    }
    
    //设置出发城市
    public function setstartplace($dest_id,$row=20,$flag='top',$limit=0,$pname=''){
        /*$db_prefix=C("DB_PREFIX");
        if($flag=='top')
    	{
    		$sql="select * from ".$db_prefix."startplace where isopen=1 and pid!=0 order by displayorder asc limit $limit,$row";
    	}*/
        $startplace=cache('top_startplace');
        //p($startplace);die;
        $tempStartPlace=array();
        foreach($startplace as $place){
            if($this->CheckLineStartPlace($place['id'],$dest_id)){
                $tempStartPlace[]=$place;
            }
        }
        //$this -> assign("startplace", $startplace);
        $this -> assign("startplace", $tempStartPlace);
    }
    
    public function CheckLineStartPlace($value,$dest_id){
        $db_prefix=C("DB_PREFIX");
        $webid = Q("webid");
        $w="";
        if( $webid == "1" ){
            $w.="";
        }else{
            $w.=" and webid='$webid'";
        }
        if($dest_id != 0){
            $sql="select 1 from ".$db_prefix."line where startcity='$value' $w and ishidden=0 and expire > ".time()." and FIND_IN_SET($dest_id,kindlist) limit 1";
        }else{
            $sql="select 1 from ".$db_prefix."line where startcity='$value' $w and ishidden=0 and expire > ".time()." limit 1";
        }

        return M()->query($sql);
    }
    
    //设置线路属性
    public function setattrgrouplist($dest_id,$typeid="1",$filterid='91',$row=8){
        $line_attrgroup=cache('line_attrgroup');
        //p($line_attrgroup);
        foreach($line_attrgroup as &$attrgroup){
            $tattr=array();
            foreach($attrgroup['attrList'] as $attr){
                if($this->CheckLineAttr($attr['id'],$dest_id)){
                    $tattr[]=$attr;
                }
            }
            $attrgroup['attrList']=$tattr;
        }
        //p($line_attrgroup);
        $this -> assign("attrGroupList", $line_attrgroup);
    }
    
    public function CheckLineAttr($value,$dest_id){
        $db_prefix=C("DB_PREFIX");
        $webid = Q("webid");
        $w="";
        if( $webid == "1" ){
            $w.="";
        }else{
            $w.=" and webid='$webid'";
        }
        if($dest_id != 0){
            $sql="select 1 from ".$db_prefix."line where  FIND_IN_SET($value,attrid) $w and ishidden=0 and expire > ".time()." and FIND_IN_SET($dest_id,kindlist) limit 1";
        }else{
            $sql="select 1 from ".$db_prefix."line where  FIND_IN_SET($value,attrid)  $w and ishidden=0 and expire > ".time()." limit 1";
        }

        return M()->query($sql);
    }
    
    public function getlineprice2(){
        $db_prefix=C("DB_PREFIX");
        $suitid=Q('suitid');
        $time = strtotime(date('Y-m-d',time()));
        //$sql="select * from ".$db_prefix."line_suit_price where suitid='$suitid' and day >='$time' and adultprice>0 and `number`!=0 ";
        
        if(B2BLOGIN){
            $sql="select a.* 
                    from 
                        ".$db_prefix."line_suit_price  as a inner join 
                        ".$db_prefix."line_suit AS b on   a.suitid =b.id
                    where a.suitid='$suitid'  and a.adultprice>0  and b.suittype='b2b' ";
        }else{
            $sql="select a.* 
                    from 
                        ".$db_prefix."line_suit_price  as a inner join 
                        ".$db_prefix."line_suit AS b on   a.suitid =b.id
                    where a.suitid='$suitid'  and a.adultprice>0  and b.suittype='b2c' ";
                    
        }
        //$sql="select * from ".$db_prefix."line_suit_price where suitid='$suitid'  and adultprice>0  ";
        //p($sql);
        $arr=M()->query($sql);
        //p($arr);die;
        $str='';
        $str='{"data":[ ';
        if(!empty($arr)){
            foreach($arr as $row){
                $day = date('Y-m-d',$row['day']);//
                $adultprice = $row['adultprice'];//成人价格
                $number = $row['number']==-1 ? '余位充足' : '余位 '.$row['number'];
                if( $row['day']<$time){
                    $state='5';
                }else if($row['number'] == -1){
                    $state='1';
                }else if($row['number'] == 0){
                    $state='2';
                }else if($row['number'] == 1 || $row['number'] == 2){
                    $number='余位 '.$row['number'];
                    $state='3';
                }else{
                    $state='4';
                }
                //if($row['number']==0)continue;
                //$oldprice = $row['oldprice'];//老人价格
                $str.='{ "pdatetime": "'.$day.'", "price": "'.$adultprice.'","childprice": "","description": "'.$number.'", "info": "","state":"'.$state.'"},';
            }
        }
        //$str.=" ]";
        $str = substr($str, 0 ,strlen($str) - 1);
        $str.=' ]}';
        echo $str;
        exit();
    }
    
    public function vlist($row=100,$name=''){
        
    }
    
}
