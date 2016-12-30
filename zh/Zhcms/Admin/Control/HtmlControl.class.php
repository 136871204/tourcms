<?php
/**
 * 静态处理模块
 * Class HtmlControl
 * @author 周鸿 <136871204@qq.com>
 */
class HtmlControl extends AuthControl {
	//批量生成静态时的下一步动作
	private $RedirectInfo;
	//一键生成全站静态
	public function create_all() {
		if (IS_POST) {
		  //echo C('HTML_PATH');die;
			//删除html目录
			Dir::del(C('HTML_PATH'));
             
			F("RedirectInfo", array( 
                array('url' => 'create_index', 'title' => 'トップページ作成準備'), 
                array('url' => 'create_category', 'title' => 'カテゴリページ作成準備...'), 
                array('url' => 'create_content', 'title' => '内容ページ作成準備...'), 
                array('url' => 'create_all', 'title' => '全部作成完了...')));
			//echo 'aaa';die;
            //生成首页
			$this -> success('初期化完了...', 'create_index');
		} else {
			F("RedirectInfo", null);
			$this -> display();
		}
	}
	//生成首页
	public function create_index() {
		$this -> RedirectInfo = F('RedirectInfo');
		if (IS_POST || $this -> RedirectInfo) {
			$html = new Html();
			$html -> index();
            //echo 'ssss';die;
            //p($this -> RedirectInfo);die;
            //echo if($this -> RedirectInfo);die;
			if ($this -> RedirectInfo) {
			 //echo 'aaaa';die;
				$redirect = array_shift($this -> RedirectInfo);
				F('RedirectInfo', $this -> RedirectInfo);
				$this -> success($redirect['title'], $redirect['url'], 0);
			} else {
				$this -> success('トップページ作成完了', __METH__, 0);
			}
		} else {
			$this -> display();
		}
	}
	//创建栏目
	public function create_category() {
		$this -> RedirectInfo = F('RedirectInfo');
		if (IS_POST || $this -> RedirectInfo) {
			$categoryCache = cache("category");
			$category = array();
            
			//没有选择栏目
			if (!isset($_POST['cid']) || count($_POST['cid']) == 1 && $_POST['cid'][0] == 0) {
			   
				//生成所有栏目
				if (empty($_POST['mid']) || $_POST['mid'] == 0) {
					$HtmlCategory = M('category') -> where(array('cat_url_type' => 1)) -> all();
				} else {//生成指定模型栏目
					$HtmlCategory = M('category') -> where(array('mid' => $_POST['mid'], 'cat_url_type' => 1)) -> all();
				}
			} else {//指定栏目
				$HtmlCategory = M('category') -> where(array('cid' => $_POST['cid'], 'cat_url_type' => 1)) -> all();
			}
           
			if (empty($HtmlCategory)) {
				if ($this -> RedirectInfo) {
					$redirect = array_shift($this -> RedirectInfo);
					F('RedirectInfo', $this -> RedirectInfo);
					$this -> success($redirect['title'], $redirect['url'], 0);
				} else {
					$this -> success('カテゴリ作成完了', __METH__, 0);
				}
			} else {
				$html = new Html();
				//最终生成的栏目
				$createCategory = array();
				foreach ($HtmlCategory as $cat) {
					$html -> category($cat['cid']);
                    
					$step_row = Q('step_row', 10, 'intval');
					$cat['pageTotal'] = $GLOBALS['totalPage'];
					$cat['currentPage'] = 1;
					$cat['step_row'] = $step_row;
					$createCategory[$cat['cid']] = $cat;
				}
				F('createCategoryFile', $createCategory);
                
				$this -> success('カテゴリ作成初期化完了...', U('BatchCategory'), 0);
			}
		} else {
			F('createCategoryFile', null);
			$this -> assign('category', json_encode(cache("category")));
			$this -> assign('model', cache("model"));
			$this -> display();
		}
	}
	//批量生成栏目
	public function BatchCategory() {
	  
		$this -> RedirectInfo = F('RedirectInfo');
		$createCategory = F('createCategoryFile');
		if (empty($createCategory)) {
			F('createCategoryFile', null);
			if ($this -> RedirectInfo) {
				$redirect = array_shift($this -> RedirectInfo);
				F('RedirectInfo', $this -> RedirectInfo);
				$this -> success($redirect['title'], $redirect['url'], 0);
			} else {
				$this -> success('カテゴリ作成完了', U('create_category'), 0);
			}
		} else {
		   
			$html = new Html();
			$category = current($createCategory);
			for ($i = 0; $i <= $category['step_row']; $i++) {
				$html -> category($category['cid'], $category['currentPage']);
				$category['currentPage']++;
                //echo 'aaa';die;
				if ($category['currentPage'] > $category['pageTotal']) {
					unset($createCategory[$category['cid']]);
                    
					F('createCategoryFile', $createCategory);
                   
					$this -> success("カテゴリ[{$category['catname']}]作成完了...", __METH__, 0);
				}
			}
            
			$createCategory[$category['cid']] = $category;
			F('createCategoryFile', $createCategory);
			$message = "カテゴリの{$category['catname']}の" . $category['step_row'] . "ページ,全部{$category['pageTotal']}ページ(<font color='red'>" . floor($category['currentPage'] / $category['pageTotal'] * 100) . "%</font>)";
			$this -> success($message, __METH__, 0);
		}
	}
	//生成内容页
	public function create_content() {
	    
		$this -> RedirectInfo = F('RedirectInfo');
		if (IS_POST || $this -> RedirectInfo) {
			//没有选择栏目
			if (empty($_POST['cid']) || count($_POST['cid']) == 1 && $_POST['cid'][0] == 0) {
				//生成所有栏目
				if (empty($_POST['mid']) || $_POST['mid'] == 0) {
					$HtmlCategory = cache('category');
				} else {
					$HtmlCategory = M('category') -> where(array('mid' => $_POST['mid'])) -> all();
				}
			} else {
				$HtmlCategory = M('category') -> where(array('cid' => $_POST['cid'])) -> all();
			}
            
			if (empty($HtmlCategory)) {
				F('createContentFile', null);
				if ($this -> RedirectInfo) {
					$redirect = array_shift($this -> RedirectInfo);
					F('RedirectInfo', $this -> RedirectInfo);
					$this -> success($redirect['title'], $redirect['url'], 0);
				} else {
					$this -> success('全部内容ページ作成完了', U('create_content'), 0);
				}
			} else {
			 
				//指定条件更新
				$where = array();
				if (isset($_POST['type']) && $_POST['type'] != 'all') {
					//更新最新发布N条
					if (!empty($_POST['total_row'])) {
						$total_row = $_POST['total_row'];
					}
					//发布时间
					if (!empty($_POST['start_time']) && !empty($_POST['end_time'])) {
						$where[] = 'addtime>=' . strtotime($_POST['start_time']) . " AND addtime<=" . strtotime($_POST['end_time']);
					}
					//起始与结束aid
					if (!empty($_POST['start_id']) && !empty($_POST['end_id'])) {
						$where[] = 'aid>=' . $_POST['start_id'] . " AND aid<=" . $_POST['end_id'];
					}
				}
				$modelCache = cache('model');
				//最终生成的栏目
				$createCategory = array();
                
				foreach ($HtmlCategory as $cat) {
					$cat['options']['step_row'] = Q('step_row', 20, 'intval');
					$cat['options']['currentNum'] = 0;
					$cat['options']['where'] = $where;
					$cat['options']['where'][] = C('DB_PREFIX') . 'category.cid=' . $cat['cid'];
					//总条数
					if (isset($total_row)) {
						$cat['options']['total_row'] = $total_row;
					} else {
						$table = $modelCache[$cat['mid']]['table_name'];
                        //echo 
						$cat['options']['total_row'] = M($table) -> count();
					}
					$createCategory[$cat['cid']] = $cat;
				}
               
				F('createContentFile', $createCategory);
                
				$this -> success('内容ページ作成初期化完了...', U('BatchContent'), 0);
			}
		} else {
			F('createContentFile', null);
			$this -> assign('category', json_encode(cache('category')));
			$this -> assign('model', cache('model'));
			$this -> display();
		}
	}

	//指生成内容页
	public function BatchContent() {
	   
		$this -> RedirectInfo = F('RedirectInfo');
		$createCategory = F('createContentFile');
		if (empty($createCategory)) {
			if ($this -> RedirectInfo) {
				$redirect = array_shift($this -> RedirectInfo);
				F('RedirectInfo', $this -> RedirectInfo);
				$this -> success($redirect['title'], $redirect['url'], 0);
			} else {
				$this -> success('全部内容ページ作成完了...', U('create_content'), 0);
			}
		}
		$html = new Html();
		$modelCache = cache('model');
		$categorycache = cache('category');
		$oldCategory = $createCategory;
		foreach ($oldCategory as $id => $category) {
		  
			$options = $category['options'];
           
			$contentModel = ContentViewModel::getInstance($category['mid']);
			$limit = $options['currentNum'] . ',' . $options['step_row'];
			$contentData = $contentModel -> join('category') -> where($options['where']) -> limit($limit) -> all();
            
			if (empty($contentData)) {
				unset($createCategory[$id]);
				F('createContentFile', $createCategory);
				$this -> success("[{$category['catname']}]内容ページ作成完了...", __METH__, 0);
			}
            //p($contentData);die;
			$Content = new Content($category['mid']);
			foreach ($contentData as $content) {
				$html -> content($Content -> find($content['aid']));
			}
            
			$options['currentNum'] = $options['currentNum'] + $options['step_row'] - 1;
            //p($options);
			if ($options['currentNum'] >= $options['total_row']) {
			 //echo 'aaa';die;
				unset($createCategory[$id]);
				F('createContentFile', $createCategory);
				$this -> success("[{$category['catname']}] 作成完了...", __METH__, 0);
			} else {
			// echo 'bbbb';die;
				$createCategory[$id]['options'] = $options;
				F('createContentFile', $createCategory);
				$createCategory[$id]['options'] = $options;
				$message = "[{$category['catname']}]
                                すでに{$options['currentNum']}件更新完了
                                (<font color='red'>" . floor($options['currentNum'] / $options['total_row'] * 100) . "%</font>)";
				$this -> success($message, __METH__, 0);
			}
		}
	}

}
