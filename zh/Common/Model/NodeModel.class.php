<?php
/**
 * 菜单管理(权限节点)
 * Class MenuModel
 * @author 周鸿 <136871204@qq.com>
 */
class NodeModel extends ViewModel {
    
    public $table = "node";
    //节点缓存
    public $_node;
    //关联权限表
    public $view = array(
        'access' => array(
            'type' => INNER_JOIN,
            "on" => "node.nid=access.nid",
        )
    );
    
    public function __init()
    {
        C('language','Model'.DS.'Node'.DS.$_SESSION['language']);
        $this->_node = cache("node");
    }
    
    /**
     * 添加节点
     */
    public function add_node()
    {
        if ($this->create()) {
            return $this->add();
        }
    }
    
    /**
     * 修改节点
     */
    public function edit_node()
    {
        if ($this->create()) {
            return $this->save();
        }
    }
    
    /**
     * 删除节点
     */
    public function del_node()
    {
        $nid = Q("nid");
        $state = $this->join()->where(array("pid" => $nid))->find();
        if (!$state) {
            return $this->del($nid);
        } else {
            $this->error = L('del_node_error1');
            return false;
        }
    }
    
    //更新缓存
    function updateCache()
    {
        $data = $this->join(NULL)->order(array("list_order" => "ASC",'nid'=>'ASC'))->all();
        $node = Data::tree($data, "title", "nid", "pid");
        return cache("node", $node);
    }
    
     function __after_insert($data)
    {
        $this->updateCache($data);
    }

    function __after_update($data)
    {
        $this->updateCache($data);
    }

    function __after_delete($data)
    {
        $this->updateCache($data);
    }
    
    function change_title($menu){
        
        if(!empty($menu)){
            foreach ($menu as &$node) {
                if(isset($node['_name'])){
                    $node['_name']=str_replace($node['title'],L($node['title']),$node['_name']);
                }
                
                if(L($node['title'])){
                   $node['title']= L($node['title']);
                   //$node['title']= L($node['title']);
                }
                
                //$node['title']= L($node['title']);
            }
        }
        //p($menu);die;
        return $menu;
    }

}