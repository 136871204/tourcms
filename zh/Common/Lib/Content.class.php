<?php
/**
 *内容添加/删除/修改操作
 * @author 周鸿 <136871204@qq.com>
 */
class Content {
	private $_mid;
	private $_mode;
	public $error;
	public function __construct($mid) {
		$this -> _model = cache('model');
		$this -> _mid = $mid;
	}

	//获取单篇文章
	public function find($aid) {
		$ContentModel = ContentViewModel::getInstance($this -> _mid);
		$data = $ContentModel -> where($ContentModel -> tableFull . '.aid=' . $aid) -> find();
        
		if (!$data) {
			$this -> error = '文章不存在';
			return false;
		}
		$ContentOutModel = new ContentOutModel($this -> _mid);
		$data = $ContentOutModel -> get($data);
        
		if ($data == false) {
			$this -> error = $ContentOutModel -> error;
		} else {
			$data['time'] = date("Y/m/d", $data['addtime']);
			$data['caturl'] = Url::getCategoryUrl($data);
			//模板文件
			$template = empty($data['template']) ? $data['arc_tpl'] : $data['template'];
			$data['template'] = 'template/' . C('web_style') . '/' . $template;
			//是否为静态
            //url_type(content表格) 文章访问方式 1 静态访问 2 动态访问 3 继承栏目
            //arc_url_type(category表格) 文章访问方式 1 静态访问 2 动态访问
			$data['iscontenthtml'] = $data['url_type'] == 1 || ($data['url_type'] == 3 && $data['arc_url_type'] == 1);
			//静态文件
			$htmlDir = C("HTML_PATH") ? C("HTML_PATH") . '/' : '';
			$time = getdate($data['addtime']);
			if (!empty($data['html_path'])) {//单独设置
				$data['htmlfile'] = $htmlDir . $data['html_path'];
			} else {//使用栏目定义
				$data['htmlfile'] = $htmlDir . str_replace(array('{catdir}', '{y}', '{m}', '{d}', '{cid}', '{aid}', '{timestamp}'), array($data['catdir'], $time['year'], $time['mon'], $time['mday'], $data['cid'], $data['aid'], $data['addtime']), $data['arc_html_url']);
			}
			//用户头像数据
			if (empty($data['icon'])) {
				$data['icon'] = __ROOT__ . '/data/image/user/250.png';
			} else {
				$data['icon'] = __ROOT__ . '/' . $data['icon'];
			}
            //p($data);die;
			return $data;
		}
	}

	//添加文章
	public function add($data) {
		$ContentModel = ContentModel::getInstance($this -> _mid);
		if (!isset($this -> _model[$this -> _mid])) {
			$this -> error = '模型不存在';
		}
		$ContentInputModel = new ContentInputModel($this -> _mid);
		$insertData = $ContentInputModel -> get($data);
        
		if ($insertData == false) {
			$this -> error = $ContentInputModel -> error;
			return false;
		}
		if ($ContentModel -> create($insertData)) {
			$result = $ContentModel -> add($insertData);
            
			$aid = $result[$ContentModel -> table];
			$this -> editTagData($aid);
			M('upload') -> where(array('uid' => $_SESSION['uid'])) -> save(array('state' => 1));
			//============记录动态
			$DMessage = "发表了文章：<a target='_blank' href='" . U('Index/Index/content', array('mid' => $this->_mid, 'cid' => $insertData['cid'], 'aid' => $aid)) . "'>{$insertData['title']}</a>";
			addDynamic($_SESSION['uid'], $DMessage);
			//内容静态
			$Html = new Html;
			$Html -> content($this -> find($aid));
			$categoryCache = cache('category');
			$cat = $categoryCache[$insertData['cid']];
			$Html -> relation_category($insertData['cid']);
			$Html -> index();
			return $aid;
		} else {
			$this -> error = $ContentModel -> error;
			return false;
		}
	}

	//修改文章
	public function edit($data) {
		$ContentModel = ContentModel::getInstance($this -> _mid);
		if (!isset($this -> _model[$this -> _mid])) {
			$this -> error('模型不存在');
		}
		$ContentInputModel = new ContentInputModel($this -> _mid);
		$editData = $ContentInputModel -> get($data);
		;
		if ($editData == false) {
			$this -> error = $ContentInputModel -> error;
			return false;
		}
		if ($ContentModel -> create($editData)) {
			$result = $ContentModel -> save($editData);
			$aid = $result[$ContentModel -> table];
			$this -> editTagData($data['aid']);
			M('upload') -> where(array('uid' => $_SESSION['uid'])) -> save(array('state' => 1));
			return $aid;
		} else {
			$this -> error = $ContentModel -> error;
			return false;
		}
	}

	//修改Tag
	public function editTagData($aid) {
		$tagModel = M('tag');
		$contentTagModel = M("content_tag");
		//删除文章旧的tag记录
		$cid = Q('cid', 0, 'intval');
		$mid = Q('mid', 0, 'intval');
		$contentTagModel -> where(array('aid' => $aid, 'mid' => $mid)) -> del();
		//修改tag
		$tag = Q('tag');
		if ($tag) {
			$tag = String::toSemiangle($tag);
			$tagData = explode(',', $tag);
			if (!empty($tagData)) {
				$tagData = array_unique($tagData);
				foreach ($tagData as $tag) {
					$tid = $tagModel -> where(array('tag' => $tag)) -> getField('tid');
					if ($tid) {
						//修改tag记数
						$tagModel -> exe("UPDATE " . C('DB_PREFIX') . "tag SET `total`=total+1");
					} else {
						$tid = $tagModel -> add(array('tag' => $tag, 'total' => 1));
					}
					$contentTagModel -> add(array('aid' => $aid, 'uid' => $_SESSION['uid'], 'mid' => $mid, 'cid' => $cid, 'tid' => $tid));
				}
			}
		}
	}

	//删除文章
	public function del($aid) {
		$ContentModel = ContentModel::getInstance($this -> _mid);
		$data = $ContentModel -> find($aid);
		if (!$data) {
			$this -> error = '文章不存在';
			return false;
		}
		if ($ContentModel -> del($aid)) {
			//删除文章tag属性
			M('content_tag') -> where(array('mid' => $this -> _mid, 'cid' => $data['cid'])) -> del();
			return true;
		} else {
			$this -> error = '删除文章失败';
		}
	}

}
