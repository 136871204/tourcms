<?php

//模板选择（后台文章与栏目更改模板使用）
class ExteriorSelectControl extends CommonControl
{
    //选择模板文件（内容页与栏目管理页使用)
    public function select()
    { 
        //p($_GET);die;
        $showf=$_GET['showf'];
        $showt=$_GET['showt'];
        $this -> assign('showf', $showf);
        $this -> assign('showt', $showt);
        $this -> assign('select_type', $_GET['select_type']);
        $this->display();
    }
	//获得模板列表
	public function getDateList(){
        $table=$_GET['table'];
        $pk=$_GET['pk'];
        $select_type=$_GET['select_type'];
        $showf=explode(',',$_GET['showf']);
        $showt=explode(',',$_GET['showt']);
        $wherestr="";
        $wherestr=$_GET['wherestr'];
        
        $ContentModel=M(''.$table);
        $ContentModel->tableFull=$table;
        $where = array();
        if($search_keyword=Q('search_keyword'))
        {
            $freekeySql="";
            foreach($showf as $k=>$v){
                if($freekeySql==""){
                    $freekeySql.= "( $v LIKE '%$search_keyword%'";
                }else{
                    $freekeySql.= "OR $v LIKE '%$search_keyword%'";
                }
            }
            if($freekeySql!=""){
                $freekeySql.=")";
            }
            $where[] =$freekeySql;
        }
        if($wherestr!=""){            
            $where[] =str_replace("\'","'",$wherestr);
        }
        //p($where);die;
        $page = new Page($ContentModel -> join('') -> where($where) -> count(), 5);
        $data = $ContentModel -> join('') -> where($where) -> limit($page -> limit())-> all();
        
        //echo $ContentModel->$lastQuery;
        if(count($data)=="0"){
            
        }else{
            foreach($data as $k=>$v){
                $v['id']=$v["".$pk];
                $showf_index=1;
                $showf_value_array=array();
                foreach($showf as $showfk=>$showfv){
                    $showf_value_array['field'.$showf_index]=$v[$showfv];
                    $showf_index++;
                }
                $v['showf_value_array']=$showf_value_array;
                $data[$k]=$v;
            }
        }

        $this -> assign('showt', $showt);
        $this -> assign('data', $data);
        $this -> assign('select_type', $select_type);
        $this -> assign('table', $table);
        $this -> assign('page', $page -> show("exterior"));
        echo $this->fetch();exit;
	}
    
}