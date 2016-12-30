<?php
/**
 * ブランド管理
 * @author 周鸿 <136871204@qq.com>
 */
class ArticlecatControl extends AuthControl {
    protected $db;
    
    public function __init() {
		$this -> db = K("ArticleCat");
        
	}
    
    
    
	//ブランド一覧
	public function index() {
	    
	    include (COMMON_LANGUAGE_PATH . 'Model'.DS.'Articlecat'.DS.$_SESSION['language'] . '.php');
	    $articlecat = article_cat_list(0, 0, false);
        foreach ($articlecat as $key => $cat)
        {
            $articlecat[$key]['type_name'] = $_LANG['type_name'][$cat['cat_type']];
        }
        //p($articlecat);die;
        $this->assign('articlecat',        $articlecat);
		$this -> display();
	}
    
    //添加
	public function add() {
	    $db_prefix=C("DB_PREFIX");
        $adminLogModel=K("AdminLog");
		if (IS_POST) {
            /*检查分类名是否重复*/
            $is_only = $this->db->is_only('cat_name', $_POST['cat_name']);
            if (!$is_only)
            {
                $this -> error('分类名已经存在');
            }
            //;1,普通分类;2,系统分类;3,网店信息;4,帮助分类;5,网店帮助
            $cat_type = 1;
            if ($_POST['parent_id'] > 0)
            {
                $sql = "SELECT cat_type FROM " . $this->db->tableFull . " WHERE cat_id = '$_POST[parent_id]'";
                $p_cat_type = M()->getOne($sql,'cat_type');
                if ($p_cat_type == 2 || $p_cat_type == 3 || $p_cat_type == 5)
                {
                    $this -> error('你所选分类不允许添加子分类');
                }else if ($p_cat_type == 4)
                {
                    $cat_type = 5;
                }
            }
            $sql = "INSERT INTO ".$this->db->tableFull."
                    (cat_name, cat_type, cat_desc,keywords, parent_id, sort_order, show_in_nav)
                    VALUES 
                    ('$_POST[cat_name]', '$cat_type',  '$_POST[cat_desc]','$_POST[keywords]', '$_POST[parent_id]', '$_POST[sort_order]', '$_POST[show_in_nav]')";
            $insert_id=M()->exe($sql);
            if($_POST['show_in_nav'] == 1)
            {
                $vieworder = M()->getOne("SELECT max(vieworder) FROM ". $db_prefix.'nav' . " WHERE type = 'middle'",'max(vieworder)');
                $vieworder += 2;
                //显示在自定义导航栏中
                $sql = "INSERT INTO " . $db_prefix.'nav' . " 
                        (name,ctype,cid,ifshow,vieworder,opennew,url,type) VALUES
                        ('" . $_POST['cat_name'] . "', 'a', '" . $insert_id . "','1','$vieworder','0', '" . ec_build_uri('article_cat', array('acid'=> $insert_id), $_POST['cat_name']) . "','middle')";
                M()->exe($sql);
            }
            $adminLogModel->admin_log($_POST['cat_name'], '添加', '文章分类');
            cache('art_cat_pid_releate',null);
			$this -> success("添加成功！");
		} else {
            $this->assign('cat_select',  article_cat_list(0));
			$this -> display();
		}
	}
    
    //修改
	public function edit() {
	    $db_prefix=C("DB_PREFIX");
        $adminLogModel=K("AdminLog");
        $tempDb=M();
	    $exc = new Exchange($db_prefix."article_cat", $tempDb, 'cat_id', 'cat_name');
	    
		if (IS_POST) {
		    /*检查重名*/
            if ($_POST['cat_name'] != $_POST['old_catname']){
                /*检查分类名是否重复*/
                $is_only = $this->db->is_only('cat_name', $_POST['cat_name'], $_POST['id']);
                if (!$is_only)
                {
                    $this -> error('分类名已经存在');
                }
            }
            if(!isset($_POST['parent_id']))
            {
                $_POST['parent_id'] = 0;
            }
            $row = M()->getRowSql("SELECT 
                                    cat_type, parent_id FROM " . $db_prefix.'article_cat' . " 
                                    WHERE cat_id='$_POST[id]'");
            $cat_type = $row['cat_type'];
            //分类类型；1，普通分类；2，系统分类；3，网店信息；4，帮助分类；5，网店帮助
            if ($cat_type == 3 || $cat_type ==4)
            {
                $_POST['parent_id'] = $row['parent_id'];
            }
            /* 检查设定的分类的父分类是否合法 */
            $child_cat = article_cat_list($_POST['id'], 0, false);
            if (!empty($child_cat))
            {
                foreach ($child_cat as $child_data)
                {
                    $catid_array[] = $child_data['cat_id'];
                }
            }
            if (in_array($_POST['parent_id'], $catid_array))
            {
                    
                    $this -> error('分类名 '.stripslashes($_POST['cat_name']).' 的父分类不能设置成本身或本身的子分类');
            }
            if ($cat_type == 1 || $cat_type == 5)
            {
                if ($_POST['parent_id'] > 0)
                {
                    $sql = "SELECT cat_type FROM " . $db_prefix.'article_cat' . " WHERE cat_id = '$_POST[parent_id]'";
                    $p_cat_type = M()->getOne($sql,'cat_type');
                    ////分类类型；1，普通分类；2，系统分类；3，网店信息；4，帮助分类；5，网店帮助
                    if ($p_cat_type == 4)
                    {
                        $cat_type = 5;
                    }
                    else
                    {
                        $cat_type = 1;
                    }
                }
                else
                {
                    $cat_type = 1;
                }
            }
            $dat = M()->getOneRow("SELECT 
                                cat_name, show_in_nav FROM ". $db_prefix.'article_cat' . " 
                                WHERE cat_id = '" . $_POST['id'] . "'");          
            if ($exc->edit("cat_name = '$_POST[cat_name]', 
                            cat_desc ='$_POST[cat_desc]', 
                            keywords='$_POST[keywords]',
                            parent_id = '$_POST[parent_id]', 
                            cat_type='$cat_type', 
                            sort_order='$_POST[sort_order]', 
                            show_in_nav = '$_POST[show_in_nav]'",  $_POST['id']))
            {
                if($_POST['cat_name'] != $dat['cat_name'])
                {
                    //如果分类名称发生了改变
                    $sql = "UPDATE " . $db_prefix.'nav' . " 
                            SET 
                                name = '" . $_POST['cat_name'] . "' 
                            WHERE 
                                ctype = 'a' AND 
                                cid = '" . $_POST['id'] . "' AND 
                                type = 'middle'";
                    M()->exe($sql);
                }
                if($_POST['show_in_nav'] != $dat['show_in_nav'])
                {
                    if($_POST['show_in_nav'] == 1)
                    {
                        //显示
                        $nid = M()->getOne("SELECT 
                                                id 
                                            FROM ". $db_prefix.'nav' . " 
                                            WHERE 
                                                ctype = 'a' AND 
                                                cid = '" . $_POST['id'] . "' AND 
                                                type = 'middle'",'id');
                        if(empty($nid))
                        {
                            $vieworder = M()->getOne("SELECT max(vieworder) FROM ". $db_prefix.'nav' . " WHERE type = 'middle'");
                            $vieworder += 2;
                            $uri = ec_build_uri('article_cat', array('acid'=> $_POST['id']), $_POST['cat_name']);
                            //不存在
                            $sql = "INSERT INTO " . $db_prefix.'nav' .
                                    " (name,ctype,cid,ifshow,vieworder,opennew,url,type) ".
                                    "VALUES('" . $_POST['cat_name'] . "', 'a', '" . $_POST['id'] . "','1','$vieworder','0', '" . $uri . "','middle')";
                        }
                        else
                        {
                            $sql = "UPDATE " . $db_prefix.'nav' . " SET ifshow = 1 WHERE ctype = 'a' AND cid = '" . $_POST['id'] . "' AND type = 'middle'";
                        }
                        M()->exe($sql);
                    }
                    else
                    {
                        //去除
                        M()->exe("UPDATE " . $db_prefix.'nav' . " 
                                    SET ifshow = 0 
                                    WHERE ctype = 'a' AND cid = '" . $_POST['id'] . "' AND type = 'middle'");
                    }
                }
                $adminLogModel->admin_log($_POST['cat_name'], '修改', '文章分类');
            
                cache('art_cat_pid_releate',null);
                $this -> success("修改成功！");
            }else{
                $this -> error("修改失败！");
            }
            

		} else {
            $sql = "SELECT cat_id, cat_name, cat_type, cat_desc, show_in_nav, keywords, parent_id,sort_order FROM ".
                    $db_prefix.'article_cat'. " WHERE cat_id='$_REQUEST[id]'";
            $cat = M()->getRowSql($sql);
            if ($cat['cat_type'] == 2 || $cat['cat_type'] == 3 || $cat['cat_type'] ==4)
            {
                $this->assign('disabled', 1);
            }
            $options    =   article_cat_list(0, $cat['parent_id'], false);
            $select     =   '';
            $selected   =   $cat['parent_id'];
            foreach ($options as $var)
            {
                if ($var['cat_id'] == $_REQUEST['id'])
                {
                    continue;
                }
                $select .= '<option value="' . $var['cat_id'] . '" ';
                $select .= ' cat_type="' . $var['cat_type'] . '" ';
                $select .= ($selected == $var['cat_id']) ? "selected='ture'" : '';
                $select .= '>';
                if ($var['level'] > 0)
                {
                    $select .= str_repeat('&nbsp;', $var['level'] * 4);
                }
                $select .= htmlspecialchars($var['cat_name']) . '</option>';
            }
            unset($options);
            $this->assign('cat',         $cat);
            $this->assign('cat_select',  $select);
            $this -> display();
		}
	}
    
    //删除
	public function del() {
	    $db_prefix=C("DB_PREFIX");
        $adminLogModel=K("AdminLog");
        $tempDb=M();
	    $exc = new Exchange($db_prefix."article_cat", $tempDb, 'cat_id', 'cat_name');
        
	    $id  = Q('id', 0, 'intval');
        $sql = "SELECT cat_type FROM " . $db_prefix.'article_cat' . " WHERE cat_id = '$id'";
        $cat_type = M()->getOne($sql,'cat_type');
        if ($cat_type == 2 || $cat_type == 3 || $cat_type ==4)
        {
            /* 系统保留分类，不能删除 */
            $this -> error("系统保留分类，不能删除 ");
        }
        $sql = "SELECT COUNT(*) FROM " . $db_prefix.'article_cat' . " WHERE parent_id = '$id'";
        if (M()->getOne($sql,'COUNT(*)') > 0)
        {
            /* 还有子分类，不能删除 */
            $this -> error("还有子分类，不能删除 ");
        }
        else
        {
            $exc->drop($id);
            M()->exe("DELETE FROM " . $db_prefix.'nav' . " 
                        WHERE  
                            ctype = 'a' AND 
                            cid = '$id' AND 
                            type = 'middle'");
            cache('art_cat_pid_releate',null);
            $adminLogModel->admin_log($id, '删除', '文章分类');
            $this -> success("删除成功！");
        }
        
	}
 


	

	

	
    
    
}
