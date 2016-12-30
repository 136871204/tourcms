<?php

/**
 * 栏目管理模型
 * Class CategoryModel
 * @author 周鸿 <136871204@qq.com>
 */
class CategoryModel extends Model {
	//表
	public $table = "category";
	//模型缓存
	private $_model;
	//栏目缓存
	private $_category;
	//允许的栏目类型
	private $allowCategoryType = array(1 => '栏目', 2 => '封面', 3 => '外链', 4 => '单文章');

	//构造函数
	public function __init() {
		$this -> _category = cache("category");
		$this -> _model = cache("model");
	}

	// 添加栏目
	public function addCategory($InsertData) {
	   //p($InsertData);die;
		$catName = $InsertData['catname'];
		$mid = intval($InsertData['mid']);
		if (!in_array($InsertData['cattype'], array_keys($this -> allowCategoryType))) {
			$this -> error = 'カテゴリタイプエラー';
			return false;
		}
		if ( M('model') -> find($mid) == null) {
			$this -> error('Model存在しない');
			return false;
		}
		if ($this -> create($InsertData)) {
			$cid = $this -> add();
			if ($cid) {
				//设置权限
				//设置权限
				$categoryAccess = $InsertData['access'];
				$categoryAccessModel = M('category_access');
				$categoryAccessModel -> del(array('cid' => $cid));
				foreach ($categoryAccess as $access) {
				    /*
                    //只有2个参数说明只有， 
                    [rid] => 3
                    [admin] => 1
                    参数传入进来，等于没有设置权限
                    */
					if (count($access) == 2)
						continue;
					$access['cid'] = $cid;
					$access['mid'] = $mid;
					$categoryAccessModel -> add($access);
				}
				if (!$this -> updateCache()) {
					return false;
				} else {
					//更新静态
					$Html = new Html();
					$Html -> category($cid);
					$Html -> index();
					return $cid;
				}
			} else {
				$this -> error = 'カテゴリ新規失敗';
				return false;
			}
		}
	}

	//修改栏目
	public function editCategory($UpdateData) {
		$cid = intval($UpdateData['cid']);
		$mid = intval($UpdateData['mid']);
		if (! M('category') -> find($cid)) {
			$this -> error = 'カテゴリ存在しない';
			return false;
		}
		if (!in_array($UpdateData['cattype'], array_keys($this -> allowCategoryType))) {
			$this -> error = 'カテゴリタイプエラー';
			return false;
		}
		if ( M('model') -> find($mid) == null) {
			$this -> error('Model存在しない');
			return false;
		}
		if ($this -> create($UpdateData)) {
			$state = $this -> save();
			if ($state) {
				//设置权限
				$categoryAccess = $UpdateData['access'];
				$categoryAccessModel = M('category_access');
				$categoryAccessModel -> del(array('cid' => $cid));
				foreach ($categoryAccess as $access) {
					if (count($access) == 2)
						continue;
					$access['cid'] = $cid;
					$access['mid'] = $mid;
					$categoryAccessModel -> add($access);
				}
				if (!$this -> updateCache()) {
					return false;
				} else {
					return $cid;
				}
			} else {
				$this -> error = 'カテゴリ修正失敗';
				return false;
			}
		}
	}

	/**
	 * 更新栏目排序
	 */
	public function updateOrder() {
		$list_order = Q("post.list_order");
		$db = M('category');
		foreach ($list_order as $cid => $order) {
			$cid = intval($cid);
			$order = intval($order);
			$data = array("cid" => $cid, "catorder" => $order);
			$db -> save($data);
		}
		//重建缓存
		return $this -> updateCache();
	}

	//更新栏目缓存
	public function updateCache() {
		$db = V('category');
		$db -> view = array('model' => array('type' => INNER_JOIN, 'on' => 'category.mid=model.mid'));
		$categoryData = $db -> order("catorder ASC,cid ASC") -> all();
		if (empty($categoryData)) {
			cache('category', null);
			return true;
		}
		$categoryData = Data::tree($categoryData, "catname", "cid", "pid");
		$cacheData = array();
		foreach ($categoryData as $n => $cat) {
			//封面与链接栏目添加disabled属性
			$cat["disabled"] = $cat["cattype"] != 1 ? 'disabled=""' : '';
			$cat['cat_type_name'] = $this -> allowCategoryType[$cat['cattype']];
			//栏目模板
			switch ($cat['cattype']) {
				case 1 ://普通栏目
					$cat['template'] = 'template/' . C("WEB_STYLE") . '/' . $cat['list_tpl'];
					break;
				case 2 ://封面栏目
					$cat['template'] = 'template/' . C("WEB_STYLE") . '/' . $cat['index_tpl'];
					break;
			}
			$cacheData[$cat['cid']] = $cat;
		}
		if (cache("category", $cacheData)) {
			return true;
		} else {
			$this -> error = 'カテゴリキャッシュ更新失敗';
			return false;
		}
	}

	//删除栏目
	public function delCategory($cid) {
	   //TODO:有子栏目不能删除父栏目，以后添加
		$ContentModel = ContentModel::getInstance($this -> _category[$cid]['mid']);
		$ContentModel -> where(array('cid' => $cid)) -> del();
		//删除栏目权限
		M("category_access") -> where("cid=$cid") -> del();
		//删除栏目
		$state = $this -> del($cid);
		$this -> updateCache();
		return $state;
	}

	//获得栏目前后台角色权限
	public function getCategoryAccess($cid) {
		$pre = C("DB_PREFIX");
		$db = M("category_access");
		$sql = "SELECT a.cid,r.rid,r.rname,r.admin,a.add,a.del,a.edit,a.show,a.move,a.audit,a.order FROM  
					{$pre}role AS r  LEFT JOIN (SELECT * FROM {$pre}category_access  WHERE cid=$cid) AS a
               	 	ON r.rid = a.rid";
		$accessData = $db -> query($sql);
		$categoryAccess = array('admin' => array(), 'user' => array());
		foreach ($accessData as $access) {
			if ($access['admin'] == 1) {
				$categoryAccess['admin'][] = $access;
			} else {
				$categoryAccess['user'][] = $access;
			}
		}
		return $categoryAccess;
	}

}
