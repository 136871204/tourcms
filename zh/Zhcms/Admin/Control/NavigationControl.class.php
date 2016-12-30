<?php

/**
 * 前台导航
 * Class NavigationControl
 */
class NavigationControl extends AuthControl
{
    //操作模型
    private $_db;
    //导航缓存
    private $_navigation;

    public function __init()
    {
        $this->_db = K("Navigation");
        
        $this->_navigation = cache('navigation');
    }

    public function index()
    {
        $this->navigation = $this->_navigation;
        $this->display();
    }

    public function add()
    {
        if (IS_POST) {
            if ($this->_db->add_nav()) {
                $this->_ajax(1, 'ナビゲーション新規成功');
            }
        } else {
            $this->nav = $this->_navigation;
            $this->display();
        }
    }

    /**
     * 修改导航
     */
    public function edit()
    {
        if (IS_POST) {
            if ($this->_db->edit_nav()) {
                $this->ajax(array('state' => 1, 'message' => 'ナビゲーション修正成功！'));
            }
        } else {
            $this->nav = $this->_navigation;
            $field = $this->_navigation[Q('nid')];
            //替换链接中的[ROOT]变量
            $field['url'] = str_replace('[ROOT]', __ROOT__, $field['url']);
            $this->field = $field;
            $this->display();
        }
    }

    /**
     * 删除导航
     */
    public function del()
    {
        if ($this->_db->del_nav()) {
            $this->_ajax(1, 'ナビ削除成功');
        } else {
            $this->_ajax(0, $this->_db->error);
        }
    }

    /**
     * 更新排序
     */
    public function update_order()
    {
        if ($this->_db->update_order()) {
            $this->_ajax(1, 'ソート更新成功');
        }
    }

    public function update_cache()
    {
        if ($this->_db->update_cache()) {
            $this->_ajax(1, 'キャッシュ更新成功！');
        }
    }
}