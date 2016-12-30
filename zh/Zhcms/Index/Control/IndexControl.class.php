<?php

/**
 * 网站前台
 * Class IndexControl
 * @author 周鸿 <136871204@qq.com>
 */
class IndexControl extends TripControl {
    
    
	//网站首页
	public function index() {
	   //echo B2BLOGIN;die;
       /*if(B2BLOGIN){
        echo 'login';
       }else{
        echo 'logout';
       }
       die;*/
	   //echo 'aaa';die;
        $this->setMainBanner();//首页KV
        $this->setNewLine();//最新线路
        $this->setTopLineList();

	   //缓存时间设定
		$CacheTime = C('CACHE_INDEX') >= 1 ? C('CACHE_INDEX') : -1;
        //echo U('index/index/index/',array('webid'=>2));
		$this -> display('template/' . C('WEB_STYLE') . '/index.html', $CacheTime);
	}
    
    public function setTopLineList(){
        $db_prefix=C("DB_PREFIX");
        $time = time();
        $navDestSql=" 
                SELECT 
                    a.id AS kindid, 
                    a.*
                FROM 
                    ".$db_prefix."destinations a left join 
                    ".$db_prefix."line_kindlist b on(a.id = b.kindid) 
                WHERE 
                b.isnav = '1' AND 
                a.isopen =1
                ORDER BY 
                    b.displayorder ASC
                    LIMIT 0 , 5 ";
        $navDestResult=M()->query($navDestSql);

        $topLineListDataList=array();
        for($i=0;isset($navDestResult[$i]);$i++){
            $row=$navDestResult[$i];
            $hotdest = $this->getHotDest($row['id']);
            $row['hotdest']=$hotdest;
            $hotLineList=array();
            if(!empty($hotdest)){
                foreach($hotdest as $hotdestK => $hotdestV){
                    $hotLineList[$hotdestK]['id']=$hotdestV['id'];
                    $hotLineList[$hotdestK]['kindname']=$hotdestV['kindname'];
                    $hotLineList[$hotdestK]['pinyin']=$hotdestV['pinyin'];
                    $hotLineList[$hotdestK]['lineList']=$this->getLineList($hotdestV['id']);
                }
            }
            $row['hotDestLineList']=$hotLineList;
            $row['currentLineList']=$this->getLineList($row['id']);
            if($row['currentLineList']){
                $topLineListDataList[]=$row;
            }
            //$topLineListDataList[]=$row;
            
        }
        //p($topLineListDataList);
        $this -> assign("topLineListDataList", $topLineListDataList);

    }
    
    public function getLineList($destId){
        $db_prefix=C("DB_PREFIX");
        $where1="";
        $where2="";
        $time = time();
        if($this->webid == 1){
            $where2 = " and c.webid =  1 ";
            $where1 = " and a.expire > $time ";
        }else{
            $where1 = " and a.webid =  {$this->webid} and a.expire > $time ";
            $where2 = " and c.webid =  {$this->webid} ";
        }
        
        $sql="select 
            a.aid,a.id,a.webid,a.linename,a.lineicon,a.seotitle,a.sellpoint,a.linepic,a.storeprice,a.lineprice,a.linedate,
            a.features,a.transport,a.lineday,a.startcity,a.overcity,a.shownum,a.satisfyscore,a.bookcount,
            a.jifentprice,a.jifenbook,a.jifencomment,a.attrid,a.kindlist,a.color,a.iconlist,a.holiday,a.b2blineprice,
            c.isjian,c.istejia,c.isding 
        from 
            ".$db_prefix."line as a left join 
            ".$db_prefix."kindorderlist as c on (c.classid=".$destId." and a.id=c.aid and c.typeid=1 $where2) 
        where 
            a.ishidden=0 and 
            FIND_IN_SET(".$destId.",a.kindlist) $where1
        order by 
            case when c.displayorder is null then 9999 end,
            c.displayorder asc,a.addtime desc,
            a.modtime desc 
        limit 0,24";
        $arr = M()->query($sql);
        $startplaceModel=K('Startplace');
        if(!empty($arr)){
            foreach($arr as $key => &$val){
                $val['startcity'] = $startplaceModel->getStartCityNameShow($val['startcity']);
                $val['iconlist_arr']=TourCommon::getSelectedIcon($val['iconlist']);
                
                if(B2BLOGIN){
                    $real=$val['b2blineprice'];//getLineRealPrice($val['id'],$val['webid']);
                    //p($real);
                    $val['b2blineprice']=$real ? $real : $val['b2blineprice'];
                    if(!empty($val['b2blineprice'])&&!empty($val['storeprice']))
                    {
                        $val['discount']=abs((int)$val['storeprice']-(int)$val['b2blineprice']);
                    }else{
                        $val['discount']=0; 
                    }
                    $val['price'] = empty($val['b2blineprice'])?'<span class="now">电询</span>': '<span class="now">¥ <strong>'.$val['b2blineprice'].'</strong>元起</span>';
                }else{
                    $real=$val['lineprice'];//getLineRealPrice($val['id'],$val['webid']);
                    $val['lineprice']=$real ? $real : $val['lineprice'];
                    if(!empty($val['lineprice'])&&!empty($val['storeprice']))
                    {
                        $val['discount']=abs((int)$val['storeprice']-(int)$val['lineprice']);
                    }else{
                        $val['discount']=0; 
                    }
                    $val['price'] = empty($val['lineprice'])?'<span class="now">电询</span>': '<span class="now">¥ <strong>'.$val['lineprice'].'</strong>元起</span>';
                }
                //$val['price2'] = empty($val['lineprice'])?'<span>电询</span>' : '<span>&yen;</span><strong>'.$val['lineprice'].'</strong><i>起</i>';
                //$showAttrs="";
                $showAttrs=getLineAttrName2($val['attrid'],2);
                $val['showattrs']=$showAttrs;
                
                
                $val['shopname']=$this->getShopName($val['webid']);;
                $val['maxmindateshow']=getMaxMinSuitTimeShow($val['id']);
                $val['iconshow']=getIconList($val['iconlist']);
                
            }
        }
        //p($arr);die;
        return $arr;
    }
        
    public function getShopName($siteid){
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
    



    
    
    
    //获取相应目的地下所有热门目的地
    public function getHotDest($destid)
    {
        $db_prefix=C("DB_PREFIX");

    
        $sql = "select 
                    a.id,
                    a.kindname,
                    a.pinyin 
                from 
                    ".$db_prefix."destinations a  left join 
                    ".$db_prefix."line_kindlist b on(a.id = b.kindid) 
                where a.pid in ($destid) and b.ishot = 1 and a.isopen =1 order by b.displayorder asc";
        $arr = M()->query($sql);
        return $arr;
    }
    
    public function setMainBanner(){
        $mainBannerModel = ContentViewModel::getInstance(8);
        $mainBanner=$mainBannerModel->where(" webid =  {$this->webid} and content_state = 1 ")->order(" arc_sort asc ")->All();
        $this -> assign("mainBanner", $mainBanner);
    }
    
    public function setNewLine(){
        $lineModel=K('Line');
        $time = time();
        if($this->webid == 1){
            $newLineList=$lineModel->where("  ishidden = 0 and expire > $time")->order(" modtime desc ")->limit("9")->All();
        }else{
            $newLineList=$lineModel->where(" webid =  {$this->webid} AND ishidden = 0 and expire > $time ")->order(" addtime desc ")->limit("9")->All();
        }
        
        $this -> assign("newLineList", $newLineList);
    }
    
    
    public function line_list(){
        echo 'this is '.$_GET['dest_id'].' list page';
        $CacheTime = C('CACHE_INDEX') >= 1 ? C('CACHE_INDEX') : -1;
        $this -> display('template/' . C('WEB_STYLE') . '/index.html', $CacheTime);
    }
    
	//内容页
	public function content() {
		$mid = Q('mid', 0, 'intval');
		$cid = Q('cid', 0, 'intval');
		$aid = Q('aid', 0, 'intval');
		if (!$mid || !$cid || !$aid) {
			_404();
		}
		$ContentAccessModel = K('ContentAccess');
		if (!$ContentAccessModel -> isShow($cid)) {
			$this -> error('閲覧権限がない');
		}
		$CacheTime = C('CACHE_CONTENT') >= 1 ? C('CACHE_CONTENT') : -1;
		if (!$this -> isCache()) {
			$ContentModel = new Content($mid);
			$field = $ContentModel -> find($aid);
			if ($field) {
				$this -> assign('zhcms', $field);
                //echo $field['template'];die;
				$this -> display($field['template'], $CacheTime);EXIT;
			}
		} else {
			$this -> display(null, $CacheTime);
		}
	}

	//栏目列表
	public function category() {
		$mid = Q('mid', 0, 'intval');
		$cid = Q('cid', 0, 'intval');
		$cache = cache('category');
		if (!$mid || !$cid || !isset($cache[$cid])) {
			_404();
		}
		$cachetime = C('CACHE_CATEGORY') >= 1 ? C('CACHE_CATEGORY') : null;
		if (!$this -> isCache()) {
			$category = $cache[$cid];
			//外部链接，直接跳转
			if ($category['cattype'] == 3) {
				go($category['cat_redirecturl']);
			} else {
				$Model = ContentViewModel::getInstance($category['mid']);
				$catid = getCategory($category['cid']);
				$category['content_num'] = $Model -> join() -> where("cid IN(" . implode(',', $catid) . ")") -> count();
				$category['comment_num'] = intval( M('comment') -> where("cid IN(" . implode(',', $catid) . ")") -> count());
				$this -> assign("zhcms", $category);
                //echo $category['template'];die;
				$this -> display($category['template'], $cachetime);
			}
		} else {
			$this -> display(null, $cachetime);
		}
	}

	//404页面
	public function _404() {
		$this -> display('template/system/404.html');
	}

	//加入收藏
	public function addFavorite() {
		if (!session("uid")) {
			$this -> error('ログインして後操作してください');
		} else {
			$db = M('favorite');
			$data = array();
			$data['uid'] = $_SESSION['uid'];
			$data['mid'] = intval($_POST['mid']);
			$data['cid'] = intval($_POST['cid']);
			$data['aid'] = intval($_POST['aid']);
			if ($db -> where($data) -> find()) {
				$this -> error('すでにカードしました');
			} else {
				$db -> add($data);
				$this -> success('カード成功!');
			}
		}
	}
	//获得点击数
	public function getClick() {
		$mid = Q('mid', 0, 'intval');
		$aid = Q('aid', 0, 'intval');
		$modelCache = cache('model');
		$Model = M($modelCache[$mid]['table_name']);
		$result = $Model -> find($aid);
		$Model -> save(array('aid' => $result['aid'], 'click' => $result['click'] + 1));
		echo "document.write({$result['click']});";
		exit ;
	}
    
    public function law(){
        $CacheTime = C('CACHE_INDEX') >= 1 ? C('CACHE_INDEX') : -1;
        $this -> display('template/' . C('WEB_STYLE') . '/about/law.html', $CacheTime);
    }
    
    public function contact(){
        $CacheTime = C('CACHE_INDEX') >= 1 ? C('CACHE_INDEX') : -1;
        $this -> display('template/' . C('WEB_STYLE') . '/about/contact.html', $CacheTime);
    }
    
    public function company(){
        $CacheTime = C('CACHE_INDEX') >= 1 ? C('CACHE_INDEX') : -1;
        $this -> display('template/' . C('WEB_STYLE') . '/about/company.html', $CacheTime);
    }
    
    public function jrpass(){
        $CacheTime = C('CACHE_INDEX') >= 1 ? C('CACHE_INDEX') : -1;
        $this -> display('template/' . C('WEB_STYLE') . '/jrpass/index.html', $CacheTime);
    }
    
    public function jpvisa(){
        $CacheTime = C('CACHE_INDEX') >= 1 ? C('CACHE_INDEX') : -1;
        $this -> display('template/' . C('WEB_STYLE') . '/jpvisa/index.html', $CacheTime);
    }
    
    public function jpwifi(){
        $CacheTime = C('CACHE_INDEX') >= 1 ? C('CACHE_INDEX') : -1;
        $this -> display('template/' . C('WEB_STYLE') . '/jpwifi/index.html', $CacheTime);
    }
    
    public function agent(){
        $CacheTime = C('CACHE_INDEX') >= 1 ? C('CACHE_INDEX') : -1;
        $this -> display('template/' . C('WEB_STYLE') . '/agent/index.html', $CacheTime);
    }
}
