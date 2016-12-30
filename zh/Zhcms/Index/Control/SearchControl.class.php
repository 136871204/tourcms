<?php

/**
 * 内容关键字搜索
 * Class IndexControl
 * @author 周鸿 <136871204@qq.com>
 */
class SearchControl extends TripControl {

	//高级搜索
	public function index() {
		$this -> category =cache("category");
		$this -> model =cache("model");
		$this -> display("./template/plug/search.html");
	}
    
    public function coloudsearch(){
        //header("Content-type:text/html;charset=utf-8");
        $db_prefix=C("DB_PREFIX");
        $webid = Q('webid',1);
        //echo $webid;
        $typeid=Q('typeid',0);
        $w = $typeid != 0 ? " and typeid={$typeid}" : '';
        $w .= $webid !=1 ? " and webid={$webid}" : "";
        $keyword =Q('keyword');
        $this -> assign('keyword', $keyword);        
        $this -> addSearchkey($keyword);//添加热搜词        
        $this -> setcookies($keyword);//历史搜索记录
        
        $keyword = pregReplace($keyword,3);//只能搜索中文
        $typeid =  pregReplace($typeid,2);
        
        require ZHPHP_ORG_PATH."/cloudsearch/pscws4.class.php";
        $pscws = new PSCWS4('utf-8');
        //
        // 接下来, 设定一些分词参数或选项, set_dict 是必须的, 若想智能识别人名等需要 set_rule 
        //
        // 包括: set_charset, set_dict, set_rule, set_ignore, set_multi, set_debug, set_duality ... 等方法
        
        $pscws->set_charset('utf-8');
        $pscws->set_rule(ZHPHP_ORG_PATH.'/cloudsearch/rules.utf8.ini');
        $pscws->set_dict(ZHPHP_ORG_PATH.'/cloudsearch/dict.utf8.xdb');
        $pscws->send_text($keyword);
        while ($some = $pscws->get_result())
        {
            foreach ($some as $word)
            {        
                $words[]=$word['word'];
            }
        }
        $time = time();
        $where="linename is not null";
        $whereor="";
        
        //目的地
        $destArr = cache("all_dest");
        //p($destArr);
        
        if( isset($words) && $words != ""){
            foreach($words as $k=>$v)
            {
                $where.=" and  linename like '%$v%'";
                if(mb_strlen($v,'utf-8')>1)
                    $whereor.=" or  linename like '%$v%'";
                    
                foreach( $destArr as $key => $val ){
                    if($val["kindname"] == $v){
                        $destid = $val["id"];
                        $whereor.=" or FIND_IN_SET($destid , kindlist)";
                        continue;
                    }
                }
            }
        }
        
        $whereor=trim(trim($whereor),'or');
        
        
        $wh=!empty($whereor)? "($where) or ($whereor)":$where;
        //p($wh);
        $whereor=empty($whereor)?$where:$whereor;

        $sql="select a.* from 
                (
                    select 
                        *,
                        case 
                        when $where then 1 
                        when $whereor then 2 end as neworder 
                    from 
                        ".$db_prefix."line where ishidden = 0 and expire > $time and ($wh)".$w.") a 
                    order by neworder";
        $sqlcount = "select count(*) as cnt from ".$db_prefix."line where ishidden = 0 and expire > $time and ($wh)".$w;           
//echo ($wh).$w;
        //分页参数获取
        $count = $count = M()->getOne($sqlcount,'cnt');
        $this -> assign("count",$count);
        $page = new SearchPage($count,10); //总数，单页数量
        $this -> page = $page -> show(6); //$param => 页面风格选择
        $limitarr=$page -> limit();
        $limitstr=$limitarr['limit'];
        
        $sql .= " limit {$limitstr} ";
        $resultlines=M()->query($sql);
        if(count($resultlines)!="0"){
            foreach($resultlines as $key => $val){
                $resultlines[$key]["startcity"] = self::startplace($val["startcity"]);
                if(B2BLOGIN){
                    if( !empty($val['b2bminday']) && !empty($val['b2bmaxday']) ){
                        $resultlines[$key]["maxmindateshow"] = date("Y-m-d",$val['b2bminday']).'～'.date("Y-m-d",$val['b2bmaxday']);
                    }elseif( !empty($val['b2bminday']) || !empty($val['b2bmaxday']) ){
                        $resultlines[$key]["maxmindateshow"] = empty($val['b2bminday']) ? date("Y-m-d",$val['b2bmaxday']) : date("Y-m-d",$val['b2bminday']);
                    }else{
                        $resultlines[$key]["maxmindateshow"] = "出团日期电询";
                    }
                }else{
                    if( !empty($val['minday']) && !empty($val['maxday']) ){
                        $resultlines[$key]["maxmindateshow"] = date("Y-m-d",$val['minday']).'～'.date("Y-m-d",$val['maxday']);
                    }elseif( !empty($val['minday']) || !empty($val['maxday']) ){
                        $resultlines[$key]["maxmindateshow"] = empty($val['minday']) ? date("Y-m-d",$val['maxday']) : date("Y-m-d",$val['minday']);
                    }else{
                        $resultlines[$key]["maxmindateshow"] = "出团日期电询";
                    }
                }
                
                
                $resultlines[$key]['iconshow'] = getIconList($val['iconlist']);
                
                $magrecommend=explode(',',$val['magrecommend']);
                
                $magrecommendHtml = "";
                if(!empty($magrecommend)){
                    foreach($magrecommend as $k => $v){
                        $magrecommendHtml.="<li><span>".$v."</span></li>";
                    }
                }
                $resultlines[$key]['magrecommendHtml'] = $magrecommendHtml;
                
                
                if(B2BLOGIN){
                    $real=$val['b2blineprice'];//getLineRealPrice($val['id'],$val['webid']);
                    $val['b2blineprice'] = $real ? $real : $val['b2blineprice'];
                    $resultlines[$key]['price'] = empty($val['b2blineprice'])?'<p><strong>电询</strong></p>': '<p>¥ <strong>'.$val['b2blineprice'].'</strong> 起</p>';
                }else{
                    $real=$val['lineprice'];//getLineRealPrice($val['id'],$val['webid']);
                    $val['lineprice'] = $real ? $real : $val['lineprice'];
                    $resultlines[$key]['price'] = empty($val['lineprice'])?'<p><strong>电询</strong></p>': '<p>¥ <strong>'.$val['lineprice'].'</strong> 起</p>';
                }
               //p($magrecommendHtml);
            }
        }
        //p($resultlines);
        //p($keyword);
        $this -> assign('resultlines', $resultlines);
        $this -> assign('words', isset($words) ? $words : "");
        $this -> display('template/' . C('WEB_STYLE') . '/cloudsearch.html');
    }

    //添加热搜词表
    public function addSearchkey($keyword)
    {
        $db_prefix=C("DB_PREFIX");
        $sql = "select 1 from ".$db_prefix."search_keyword where keyword = '$keyword' limit 1";
        $result=M()->query($sql);
        if(!empty($result)){
            $updatesql = "update ".$db_prefix."search_keyword set keynumber = keynumber+1 where keyword = '$keyword'";
            M()->exe($updatesql);
        }else{
            $time = time();
            $insertsql = "insert into ".$db_prefix."search_keyword(keyword,keynumber,addtime) values('$keyword',1,'$time')";
            M()->exe($insertsql);
        }
    
    }

	//搜索内容
	public function search() {
		$word = Q('word');
		$categoryCache = cache('category');
		if (!$word) {
			$this -> error("検索内容は必須");
		} else {
			$cid = empty($_REQUEST['cid'])?null:intval($_GET['cid']);
			$mid =empty($_REQUEST['mid'])?1:intval($_GET['mid']);
			$_REQUEST['mid']=$mid;
			//=====================记录搜索词
			$SearchTotal = M('search')->where(array('word'=>$word))->getField('total');
			if($SearchTotal){
				M('search')->where(array('word'=>$word))->save(array('total'=>$SearchTotal+1));
			}else{
				M('search')->add(array('total'=>1,'word'=>$word,'mid'=>$_REQUEST['mid']));
			}
			
			if($cid && isset($categoryCache[$cid])){
				$_REQUEST['mid']=$mid =$categoryCache[$cid]['mid'];
			}
			$pre = C('DB_PREFIX');
			$seachType = Q('type', 'title');
			$modelCache = cache('model');
			$categoryCache = cache('category');
			$contentModel = ContentViewModel::getInstance($mid);
			$table = $modelCache[$mid]['table_name'];
			if ($seachType == 'tag') {
				$db = M();
				$countSql = "SELECT count(*) AS c FROM 
						(SELECT distinct(aid) FROM {$pre}tag AS t INNER JOIN {$pre}content_tag AS ct ON t.tid=ct.tid WHERE tag='{$word}' AND mid=1 GROUP BY aid) AS c";
				$count = $db -> query($countSql);
				$page = new Page($count[0]['c'], 15);
				$DataSql = "SELECT * FROM {$pre}category as cat JOIN {$pre}{$table} AS c  ON cat.cid = c.cid JOIN {$pre}content_tag AS ct  ON c.aid=ct.aid INNER 
										JOIN {$pre}tag AS t ON t.tid=ct.tid WHERE t.tag='{$word}' LIMIT " . $page -> limit(true);
				$data = $db -> query($DataSql);
			} else {
				$where = array();
				if ($cid) {
					$cids = getCategory($cid);
					$where[] = $pre . "category.cid IN(" . implode(',',$cids).")";
				}
				if (!empty($_GET['search_begin_time']) && !empty($_GET['search_end_time'])) {
					$where[] = "addtime>=" . strtotime($_GET['search_begin_time']) . " AND addtime<=" . $_GET['search_end_time'];
				}
				switch($seachType) {
					case 'title' :
						$where[] = "title like '%{$word}%'";
						$count = $contentModel -> join('category') -> where($where) -> count();
						$page = new Page($count, 15);
						$data = $contentModel -> join('category') -> where($where) -> all();
						break;
					case 'description' :
						$where[] = "description like '%{$word}%'";
						$count = $contentModel -> join('category') -> where($where) -> count();
						$page = new Page($count, 15);
						$data = $contentModel -> join('category') -> where($where) -> all();
						break;
					case 'username' :
						$where[] = "username like '%{$word}%'";
						$count = $contentModel -> join('category,user') -> where($where) -> count();
						$page = new Page($count, 15);
						$data = $contentModel -> join('category,user') -> where($where) -> all();
						break;
				}
			}
			$this -> assign('searchModel', $modelCache);
			$this -> assign('searchCategory', $categoryCache);
			$this -> assign('page', $page);
			$this -> assign('data', $data);
			$this -> display();
		}
	}

	/**热门搜索词
	 * 前台通过js调用
	 * <script type="text/javascript" src="__ROOT__/index.php?a=Search&c=Search&m=search_word&row=10"></script>
	 */
	public function search_word() {
		$row = Q("get.row", 10, "intval");
		$db = M("search");
		$result = $db -> limit($row) -> all();
		$str = "";
		if (!empty($result)) {
			foreach ($result as $field) {
				$field['url'] = __ROOT__ . '/index.php?a=Search&c=Search&m=search&word=' . $field['word'];
				$str .= " <a href='{$field['url']}'>{$field['word']}</a>";
			}
		}
		echo "document.write('" . addslashes($str) . "')";
		exit ;
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
    
    /**
     * 历史搜索记录
     */
    public function setcookies( $keyword ){
        $num = 5;
        $keywordtemp = cookie("searchkeyword");
        //echo $keywordtemp."<br />";
        if(empty($keywordtemp)){
            cookie("searchkeyword",$keyword);
        }else{
            //$keywordtemp = str_replace($keyword,"",$keywordtemp);
            $Attr = explode("#",$keywordtemp);
            foreach($Attr as $key => $val){
                if($val == $keyword){
                    unset($Attr[$key]);
                }
            }
            $keywordtemp = implode("#",$Attr);
            $temp = $keyword."#".$keywordtemp;
            $temp = str_replace("##","#",$temp); 
            $temp = trim($temp,"#");
            //echo $temp."<br />";
            /*$Attr = explode("#",$temp);
            foreach($Attr as $key => $val){
                if($val == $keyword){
                    unset($Attr[$key]);
                }
            }*/
            $Attr = explode("#",$temp);
            if(count($Attr)>$num){
                unset($Attr[$num]);
                $temp = implode("#",$Attr);
            }
            //echo $temp;die;
            cookie("searchkeyword",$temp);
        }
    }
    
    /**
     * 清空历史记录
     */
    public function clearcookie(){
        cookie("searchkeyword",null);
    }

}
