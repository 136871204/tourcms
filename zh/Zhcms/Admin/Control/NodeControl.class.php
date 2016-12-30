<?php

/**
 * 权限节点管理
 * Class NodeControl
 * @author 周鸿 <136871204@qq.com>
 */
class NodeControl extends AuthControl{
    //模型
    private $_db;
    //节点树
    private $_node;
    
    public function __init()
    {
        //获得模型实例
        $this->_db = K("Node");
        $this->_node = cache("node");
    }
    
    //节点列表
    public function index()
    {
        $this->node = $this->_db->change_title($this->_node);
        $this->display();
    }
    
    //添加节点
    public function add(){
        if (IS_POST) {
            if ($this->_db->add_node()) {
                $this->_ajax( 1,  L('admin_node_control_add_success'));
            }
        } else {
            
            //配置菜单列表
            $this->node = $this->_db->change_title($this->_node);
           // $this->node = $this->_node;
            $this->display();
        }
    }
    
    //删除节点
    public function del()
    {
        //TODO:之后在来增加，如果有子节点就，不能删除功能
        if ($this->_db->del_node()) {
            $this->_ajax(1, L('admin_node_control_del_success'));
        } else {
            $this->_ajax(0, $this->_db->error);
        }
    }
    
    //修改节点
    public function edit()
    {
        if (IS_POST) {
            if($this->_db->edit_node()){
                $this->_ajax(1,  L('admin_node_control_edit_success'));
            }
        } else {
            $nid=Q('nid');
            $this->field = $this->_node[$nid];
            foreach($this->_node as $id=>$node){
                $this->_node[$id]['disabled']=Data::isChild($this->_node,$id,$nid,'nid')?' disabled="disabled" ':'';
            }
            $this->node = $this->_db->change_title($this->_node);
            //$this->node = $this->_node;
            $this->display();
        }
    }
    
    //更改菜单排序
    public function update_order()
    {
        $menu_order = Q("post.list_order");
        foreach ($menu_order as $nid => $order) {
            //排序
            $order = intval($order);
            $this->_db->save(array(
                "nid" => $nid,
                "list_order" => $order
            ));
        }
        $this->_ajax(1,L('admin_node_control_update_order_success'));
    }
    
    //更新缓存
    public function update_cache()
    {
        if ($this->_db->updateCache()) {
            $this->_ajax( 1,  L('admin_node_control_update_cache_success'));
        }
    }
}
