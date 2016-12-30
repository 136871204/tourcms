<?php

//模板选择（后台文章与栏目更改模板使用）
class TreeSelectControl extends CommonControl
{
    //选择模板文件（内容页与栏目管理页使用)
    public function select()
    { 
        $table=$_GET['table'];
        $treeData = Cache(''.$table);
        $this -> assign('treeData', json_encode($treeData));
        $this->display();
    }
    
    public function getTreeTitle(){
        $table=$_POST['table'];
        $selectId=$_POST['id'];
        $treeData = cache($table);
        $showValue=Data::menu_linkage_level($selectId,0,$treeData);
        $msg="ok";
        $data=$showValue;
        $this -> _ajax(1,$msg, $data);
    }
	
    
}