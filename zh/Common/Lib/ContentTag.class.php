<?php
/**
 * ZHCMS标签库
 * Class ContentTag
 * @author zhouhong <hong@metaphase.co.jp>
 */
class ContentTag {
    public $tag = array(
                        'zhcms' => array('block' => 0), 
                        'channel' => array('block' => 1, 'level' => 4),
                        'member' => array('block' => 0),
                        'arclist' => array('block' => 1, 'level' => 4), 
                        'pagelist' => array('block' => 1, 'level' => 4), 
                        'pageshow' => array('block' => 0), 
                        'tag' => array('block' => 1),
                        'user' => array('block' => 1),
                        'comment' => array('block' => 1, 'level' => 4),
                        'plugin' => array('block' => 1),
                        'location' => array('block' => 0),
                        'pagenext' => array('block' => 0),
                        'createpages' => array('block' => 0),
                    );
    
    public function _createpages($attr, $content) {
        $count =  $attr['count'];
        $page =  $attr['page'];
        $php = <<<str
        <?php
        \$count = $count;
        \$page = $page;
        
        if (empty(\$page))
        {
            \$page = 1;
        }
        if (!empty(\$count)){
            \$str = "<option value='1'>1</option>";
            \$min = min(\$count - 1, \$page + 3);
            for (\$i = \$page - 3 ; \$i <= \$min ; \$i++){
                if (\$i < 2)
                {
                    continue;
                }
                \$str .= "<option value='$i'";
                \$str .= \$page == \$i ? " selected='true'" : '';
                \$str .= ">\$i</option>";
            }
            if (\$count > 1)
            {
                \$str .= "<option value='\$count'";
                \$str .= \$page == \$count ? " selected='true'" : '';
                \$str .= ">\$count</option>";
            }
        }
        else
        {
            \$str = '';
        }
        echo \$str;
        
        
        ?>
str;
        return $php;
    }
    
    //上一篇与下一篇
	public function _pagenext($attr, $content) {
		$type = isset($attr['type']) ? $attr['type'] : 'pre,next';
		$pre_str = isset($attr['pre']) ? $attr['pre'] : "上一篇: ";
		$next_str = isset($attr['next']) ? $attr['next'] : "上一篇: ";
		$titlelen = isset($attr['titlelen']) ? intval($attr['titlelen']) : 10;
		$php = <<<str
        <?php
        \$type='$type';
        \$titlelen = $titlelen;
        \$mid = Q('mid',0,'intval');
        //导入模型类
        \$db =ContentViewModel::getInstance(\$mid);
        //主表（有表前缀）
        \$table=\$db->tableFull;
        \$aid = Q('aid',NULL,'intval');
        //上一篇
        if(strstr(\$type,'pre')){
            \$content = \$db->join('category')->where("aid<\$aid")->order("aid desc")->find();
            if (\$content) {
                \$content['title']=mb_substr(\$content['title'],0,\$titlelen,'utf-8');
                \$url = Url::getContentUrl(\$content);
                echo "$pre_str <a href='".\$url."'>" . \$content['title'] . "</a>";
            } else {
                echo "$pre_str <span>没有了</span></li>";
            }
        }
        //下一篇
        if(strstr(\$type,'next')){
            \$content = \$db->join('category')->where("aid>\$aid")->order("aid ASC")->find();
            if (\$content) {
                \$content['title']=mb_substr(\$content['title'],0,\$titlelen,'utf-8');
                \$url = Url::getContentUrl(\$content);
                echo "$next_str <a href='".\$url."'>" . \$content['title'] . "</a>";
            } else {
                echo "$next_str <span>没有了</span>";
            }
        }
        ?>
str;
		return $php;
	}
    
   	//当前位置
	public function _location($attr, $content) {
		$sep = isset($attr['sep']) ? $attr['sep'] : ' > ';
		//分隔符
		$php = <<<str
        <?php
        \$sep = "$sep";
        if(!empty(\$_REQUEST['cid'])){
            \$cat = cache("category");
            \$cat= array_reverse(Data::parentChannel(\$cat,\$_REQUEST['cid']));
            \$str = "<a href='__ROOT__'>トップ</a>{$sep}";
            foreach(\$cat as \$c){
                \$str.="<a href='".Url::getCategoryUrl(\$c)."'>".\$c['catname']."</a>".\$sep;
            }
            echo substr(\$str,0,-(strlen(\$sep)));
        }
        ?>
str;
		return $php;
	}
    
    //基本js与css加载(必须使用的)
	public function _zhcms($attr, $content) {
		$php = "<script type='text/javascript'>
                    	var ROOT='<?php echo ROOT_URL;?>';var WEB='<?php echo WEB_URL;?>';var CONTROL='<?php echo CONTROL_URL;?>';
                	</script>";
		$php .= "<script type='text/javascript' src='__ROOT__/zh/Common/static/js/zhcms.js'></script>\n
                <link rel='stylesheet' type='text/css' href='__ROOT__/zh/Common/static/css/zhcms.css?ver=1.0'/>\n";
		return $php;
	}
    
    //插件调用
	public function _plugin($attr, $content) {
	   //<plugin plugin='Link' tag='link' type="all" tid="1">
		$plugin = $attr['plugin'];
		$class = $plugin . 'Tag';
		$classFile = 'zh/Plugin/' . $plugin . '/Tag/' . $class . '.class.php';
		if (!is_file($classFile)) {
			return '';
		} else {
			require_cache($classFile);
		}
		if (!class_exists($class, false)) {
			return;
		}
		$tagObj = new $class();
		if (!isset($attr['tag'])) {
			return '';
		}
		$method = '_' . $attr['tag'];
		if (!method_exists($tagObj, $method)) {
			return '';
		}
		$attr = array('attr' => $attr, 'content' => $content);
		return call_user_func_array(array($tagObj, $method), $attr);
	}
    
    //文章列表
	public function _arclist($attr, $content) {
		$cid = isset($attr['cid']) ? trim($attr['cid']) : '';
		if(!strstr($cid,'$')){
			$cid="'$cid'";
		}
		$aid = isset($attr['aid']) ? trim($attr['aid']) : '';
		$mid = isset($attr['mid']) && is_numeric($attr['mid']) ? intval($attr['mid']) : '';
		$row = isset($attr['row']) ? intval($attr['row']) : 10;
		//简单长度
		$infolen = isset($attr['infolen']) ? intval($attr['infolen']) : 80;
		//标题长度
		$titlelen = isset($attr['titlelen']) ? intval($attr['titlelen']) : 80;
		//属性
		$flag = isset($attr['flag']) ? trim($attr['flag']) : '';
		//排序
		$order = isset($attr['order']) ? trim($attr['order']) : '';
		//排序属性
		$noflag = isset($attr['noflag']) ? trim($attr['noflag']) : '';
		//获取类型（排序）
		$type = isset($attr['type']) ? strtolower(trim($attr['type'])) : 'new';
		//获取副表字段
		$subtable = isset($attr['subtable']) ? strtolower(trim($attr['subtable'])) : '';
		//子栏目处理
		$sub_channel = isset($attr['sub_channel']) ? intval($attr['sub_channel']) : 1;
		$php = <<<str
        <?php \$mid='$mid';\$cid =$cid;\$subtable ='$subtable';\$order ='$order';\$flag='$flag';\$noflag='$noflag';\$aid='$aid';\$type='$type';\$sub_channel=$sub_channel;
            \$mid = \$mid?\$mid:Q('mid',1,'intval');
            \$cid = !empty(\$cid)?\$cid:Q('cid',0,'intval');
            //导入模型类
            \$db =ContentViewModel::getInstance(\$mid);
            //主表（有表前缀）
            \$table=\$db->tableFull;
            //获取副表字段
			if(empty(\$subtable)){
				\$db->join('category,user');
			}
            //---------------------------排序类型-------------------------------
            switch(\$type){
                case 'hot':
                    //查看次数最多
                    \$db->order('click DESC');
                    break;
                case 'rand':
                    //随机排序
                    \$db->order('rand()');
                    break;
                case 'relative':
                    //与本文相关的，按标签相关联的
                    if(!empty(\$_REQUEST['aid']) && is_numeric(\$_REQUEST['aid'])){
                        \$_aid = \$_REQUEST['aid'];
                        \$_tag = M('content_tag')->field('tid')->where("mid=\$mid AND aid=\$_aid")->limit(10)->all();
                        if(\$_tag){
                            \$_tid=array();
                            foreach(\$_tag as \$tid){
                                \$_tid['tid'][]=\$tid['tid'];
                            }
                            \$_result = M('content_tag')->field('aid')->where(\$_tid)->where("aid <>\$_aid")->group('aid')->limit(20)->all();
                            if(!empty(\$_result)){
                                \$_tag_aid=array();
                                foreach(\$_result as \$d){
                                    \$_tag_aid[]=\$d['aid'];
                                }
                                \$db->where(\$db->tableFull.".aid IN(".implode(',',\$_tag_aid).")");
                            }
                        }
                    }
                    break;
                default:
					if(!empty(\$order)){
						\$order= str_replace('aid', \$db->tableFull.'.aid', \$order);
						\$order= str_replace('cid', \$db->tableFull.'.cid', \$order);
                    	\$db->order(\$order);
					}
                    break;
            }
            \$db->order('arc_sort ASC,updatetime DESC');
            //---------------------------查询条件-------------------------------
                \$where=array();
                //获取指定栏目的文章,子栏目处理
                if(\$cid){
                    //查询条件
                    if(\$sub_channel){
                        \$category = getCategory(\$cid);
                        \$where[]=\$db->tableFull.".cid IN(".implode(',',\$category).")";
                    }else{
                        \$where[]=\$db->tableFull.".cid IN(\$cid)";
                    }
                }
                //指定筛选属性flag='1,2,3'时,获取指定属性的文章
		        if(\$flag){
		            \$flagCache =cache(\$mid,false,FLAG_CACHE_PATH);
		            \$flag = explode(',',\$flag);
		            foreach(\$flag as \$f){
		                \$f=\$flagCache[\$f-1];
		                \$where[]="find_in_set('\$f',flag)";
		            }
		        }
		        //排除flag
		        if(\$noflag){
		            \$flagCache =cache(\$mid,false,FLAG_CACHE_PATH);
		            \$noflag = explode(',',\$noflag);
		            foreach(\$noflag as \$f){
		                \$f=\$flagCache[\$f-1];
		                \$where[]="!find_in_set('\$f',flag)";
		            }
		        }
                //指定文章
                if (\$aid) {
                    \$where[]=\$table.".aid IN(\$aid)";
                }
                //已经审核的文章
                \$where[]=\$table.'.content_state=1';
				
                //------------------关联content_flag表后有重复数据，去掉重复的文章---------------------
                \$db->group=\$table.'.aid';
                //---------------------------------指定显示条数--------------------------------------
                \$db->limit($row);
                //-----------------------------------获取数据----------------------------------------
                \$result = \$db->where(\$where)->all();
                if(\$result):
                    foreach(\$result as \$index=>\$field):
                        \$field['index']=\$index+1;
                        \$field['title']=mb_substr(\$field['title'],0,$titlelen,'utf8');
                        \$field['title']=\$field['color']?"<span style='color:".\$field['color']."'>".\$field['title']."</span>":\$field['title'];
                        \$field['description']=mb_substr(\$field['description'],0,$infolen,'utf-8');
                        \$field['time']=date("Y-m-d",\$field['updatetime']);
						\$field['icon']=empty(\$field['icon'])?"__ROOT__/data/image/user/150.png":'__ROOT__/'.\$field['icon'];
                        \$field['date_before']=date_before(\$field['addtime']);
                        \$field['thumb']='__ROOT__'.'/'.\$field['thumb'];
                        \$field['caturl']=Url::getCategoryUrl(\$field);
                        \$field['url']=Url::getContentUrl(\$field);
                         if(\$field['new_window'] || \$field['redirecturl']){
                        	\$field['link']='<a href="'.\$field['url'].'" target="_blank">'.\$field['title'].'</a>';
						}else{
							\$field['link']='<a href="'.\$field['url'].'">'.\$field['title'].'</a>';	
						}
                ?>
str;
		$php .= $content;
		$php .= '<?php endforeach;endif;?>';
		return $php;
	}
    
    //分页列表
	public function _pagelist($attr, $content) {
	   //<pagelist infolen="30" titlelen="20"  row="10" flag="4">
		$row = isset($attr['row']) ? intval($attr['row']) : 10;
		//标题长度
		$titlelen = isset($attr['titlelen']) ? intval($attr['titlelen']) : 80;
		//简介长度
		$infolen = isset($attr['infolen']) ? intval($attr['infolen']) : 500;
		//获取类型（排序）
		$order = isset($attr['order']) ? strtolower(trim($attr['order'])) : 'new';
		$flag = isset($attr['flag']) ? $attr['flag'] : '';
		//模型mid
		$mid = isset($attr['mid']) && intval($attr['mid']) ? intval($attr['mid']) : '';
		//栏目cid
		$cid = isset($attr['cid']) && intval($attr['cid']) ? trim($attr['cid']) : '';
		//子栏目处理
		$sub_channel = isset($attr['sub_channel']) ? intval($attr['sub_channel']) : 1;
		$php = <<<str
        <?php
        \$mid ='$mid';
        \$cid='$cid';
        \$flag = '$flag';
        \$sub_channel=$sub_channel;
        \$order = '$order';
        \$mid = \$mid?\$mid:Q('mid',1,'intval');
        \$cid = \$cid?\$cid:Q('cid',null,'intval');
        //导入模型类
        \$db =ContentViewModel::getInstance(\$mid);
        //主表（有表前缀）
        \$table=\$db->tableFull;
        //---------------------------排序Order-------------------------------
            switch(\$order){
                case 'hot':
                    //查看次数最多
                    \$order='click DESC';
                    break;
                case 'rand':
                    //随机排序
                    \$order='rand()';
                    break;
                case 'new':
                default:
                    //最新排序
                    \$order='aid DESC';
                    break;
            }
        //----------------------------条件Where-------------------------------------
        \$where=array();
        //子栏目处理
        if(\$cid){
            //查询条件
            if(\$sub_channel){
                \$category = getCategory(\$cid);
                \$where[]=\$table.".cid IN(".implode(',',\$category).")";
            }else{
                \$where[]=\$table.".cid IN(\$cid)";
            }
        }
        //指定筛选属性flag='1,2,3'时,获取指定属性的文章
        if(\$flag){
            \$flagCache =cache(\$mid,false,FLAG_CACHE_PATH);
            \$flag = explode(',',\$flag);
            foreach(\$flag as \$f){
                \$f=\$flagCache[\$f-1];
                \$where[]="find_in_set('\$f',flag)";
            }
        }
        \$where= implode(' AND ',\$where);
        //-------------------------获得数据-----------------------------
        //关联表
        \$join = "content_flag,category,user";
        \$count = \$db->join(\$join)->order("arc_sort ASC")->where(\$where)->where(\$table.'.content_state=1')->count(\$db->tableFull.'.aid');
		\$categoryCache=cache('category');
		if(\$cid){
			\$category=\$categoryCache[\$cid];
			if(\$category['cat_url_type']==2){//动态
				if(C('PATHINFO_TYPE')){
					\$Url = "list_{mid}_{cid}_{page}.html";
					\$pageUrl=str_replace(array('{mid}','{cid}'),array(\$category['mid'],\$category['cid']),\$Url);
				}else{
					\$Url = "a=Index&c=Index&m=category&mid={mid}&cid={cid}&page={page}";
  		 			\$pageUrl=str_replace(array('{mid}','{cid}'),array(\$category['mid'],\$category['cid']),\$Url);
				}
				\$ROOT_URL = C('URL_REWRITE')?'':WEB_URL.'?';
				Page::\$staticUrl=\$ROOT_URL.\$pageUrl;
			}else{//静态
				\$html_path = C("HTML_PATH") ? C("HTML_PATH") . '/' : '';
				Page::\$staticUrl=ROOT_URL.'/'.\$html_path.str_replace(array('{catdir}','{cid}'),array(\$category['catdir'],\$category['cid']),\$category['cat_html_url']);	
			}	
		}else{//首页
			Page::\$staticUrl=U('Index/Index/index',array('page'=>'{page}'));
		}
        \$page= new Page(\$count,$row);
        \$result= \$db->join(\$join)->order("arc_sort ASC")->where(\$where)->where(\$table.'.content_state=1')->order(\$order)->limit(\$page->limit())->all();
        if(\$result):
            //有结果集时处理
            foreach(\$result as \$field):
                    	\$field['index']=\$index+1;
                        \$field['title']=mb_substr(\$field['title'],0,$titlelen,'utf8');
                        \$field['title']=\$field['color']?"<span style='color:".\$field['color']."'>".\$field['title']."</span>":\$field['title'];
                        \$field['description']=mb_substr(\$field['description'],0,$infolen,'utf-8');
                        \$field['time']=date("Y-m-d",\$field['updatetime']);
						\$field['icon']=empty(\$field['icon'])?"__ROOT__/data/image/user/150.png":'__ROOT__/'.\$field['icon'];
                        \$field['date_before']=date_before(\$field['addtime']);
                        \$field['thumb']='__ROOT__'.'/'.\$field['thumb'];
                        \$field['caturl']=Url::getCategoryUrl(\$field);
                        \$field['url']=Url::getContentUrl(\$field);
                        if(\$field['new_window'] || \$field['redirecturl']){
                        	\$field['link']='<a href="'.\$field['url'].'" target="_blank">'.\$field['title'].'</a>';
						}else{
							\$field['link']='<a href="'.\$field['url'].'">'.\$field['title'].'</a>';	
						}
            ?>
str;
		$php .= $content;
		$php .= '<?php endforeach;endif?>';
		return $php;
	}
    
    public function _pageshow($attr, $content) {
		$style = isset($attr['style']) ? $attr['style'] : 2;
		$row = isset($attr['row']) ? $attr['row'] : 10;
		return <<<str
        <?php if(is_object(\$page)){
            echo \$page->show($style,$row);
            }
        ?>
str;

	}
    
    
    //显示标签云
	public function _tag($attr, $content) {
		$type = isset($attr['type']) ? $attr['type'] : 'hot';
		$row = isset($attr['row']) ? $attr['row'] : 10;
		$php = <<<str
        <?php \$type= '$type';\$row =$row;
        \$db=M('tag');
        switch(\$type){
            case 'new':
                \$result = \$db->order('tid DESC')->limit(\$row)->all();
                break;
			case 'hot':
			default:
                \$result = \$db->order('total DESC')->limit(\$row)->all();
                break;
        }
        foreach(\$result as \$field):
            \$field['url']=U('Index/Search/search',array('type'=>'tag','word'=>\$field['tag']));
        ?>
str;
		$php .= $content;
		$php .= "<?php endforeach;?>";
		return $php;
	}
    
    //会员登录窗口
	public function _member($attr, $content) {
		return '<script type="text/javascript" src="__WEB__?a=Member&c=Index&m=Member"></script>';
	}
    
    	//获得用户
	public function _user($attr, $content) {
		$row = isset($attr['row']) ? $attr['row'] : 20;
		$php = <<<str
        <?php
            \$db=M('user');
            \$data = \$db->field("uid,nickname,domain,icon")->where(" user_state=1")->order("credits DESC")->limit(\$row)->all();
            foreach(\$data as \$field):
                \$field['url'] = U('Member/Space/index',array('u'=>\$field['domain']));
                \$field['icon']=\$field['icon']?'__ROOT__/'.\$field['icon']:'__ROOT__/data/image/user/50.png';
            ?>
str;
		$php .= $content;
		$php .= "<?php endforeach;?>";
		return $php;

	}
    
    //栏目标签
	public function _channel($attr, $content) {
	   //类型  top 顶级 son 下级 self同级 current 指定的栏目
		$type = isset($attr['type']) ? $attr['type'] : "self";
		//显示条数
		$row = isset($attr['row']) ? $attr['row'] : 10;
		//指定的栏目cid
		$cid = isset($attr['cid']) ? $attr['cid'] : NULL;
		//当前栏目的class样式
		$class = isset($attr['class']) ? $attr['class'] : "";
        $php = <<<str
        <?php
        \$where = '';\$type=strtolower(trim('$type'));
        \$cid=str_replace(' ','','$cid');
        if(empty(\$cid)){
            \$cid=Q('cid',NULL,'intval');
        }
        \$db = M("category");
        if (\$type == 'top') {
            \$where = ' pid=0 ';
        }else if(\$cid) {
            switch (\$type) {
                case 'current':
                    \$where = " cid in(".\$cid.")";
                    break;
                case "son":
                    \$where = " pid IN(".\$cid.") ";
                    break;
                case "self":
                    \$pid = \$db->where(intval(\$cid))->getField('pid');
                    \$where = ' pid='.\$pid;
                    break;
            }
        }
        \$result = \$db->where(\$where)->where("cat_show=1")->order()->order("catorder ASC")->limit($row)->all();
        //无结果
        if(\$result){
            //当前栏目,用于改变样式
            \$_self_cid = isset(\$_REQUEST['cid'])?\$_REQUEST['cid']:0;
			\$categoryCache =cache('category');
            foreach (\$result as \$field):
                //当前栏目样式
                \$field['class']=\$_self_cid==\$field['cid']?"$class":"";
                \$field['caturl'] = Url::getCategoryUrl(\$field);
				\$field['childcategory']=Data::channelList(\$categoryCache,\$field['cid']);
            ?>
str;
		$php .= $content;
		$php .= '<?php endforeach;}?>';
		return $php;
	}
    
    //获得最新评论
	public function _comment($attr, $content) {
		$row = isset($attr['row']) ? $attr['row'] : 20;
		$len = isset($attr['contentlen']) ? $attr['contentlen'] : 20;
		$php = <<<str
        <?php
            \$db=M('comment');
            \$pre=C('DB_PREFIX');
            \$sql = "SELECT u.uid,comment_id,mid,cid,aid,nickname,pubtime,content,domain,icon
                FROM ".\$pre."user AS u
                JOIN ".\$pre."comment AS c ON u.uid = c.uid
                WHERE comment_state=1 ORDER BY comment_id DESC limit $row";
            \$data = \$db->query(\$sql);
            foreach(\$data as \$field):
                \$_tmp = empty(\$field['domain']) ? \$field['uid'] : \$field['domain'];
                \$field['userlink'] = ' __ROOT__/index.php?' . \$_tmp;
                \$field['url']='__WEB__?a=Index&c=Index&m=content&mid='.\$field['mid'].'&cid='.\$field['cid'].'&aid='.\$field['aid'].'&comment_id='.\$field['comment_id'];
                \$field['content'] =mb_substr(\$field['content'],0,$len,'utf-8');
                \$field['pubtime'] =date_before(\$field['pubtime']);
                \$field['icon']=\$field['icon']?'__ROOT__/'.\$field['icon']:'__ROOT__/data/image/user/100.png';
            ?>
str;
		$php .= $content;
		$php .= "<?php endforeach;?>";
		return $php;

	}
}
?>