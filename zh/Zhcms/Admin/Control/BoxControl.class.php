<?php
/**
 * ブランド管理
 * @author 周鸿 <136871204@qq.com>
 */
class BoxControl extends AuthControl {
    protected $db;
    
    public function __init() {
        $resultid = Q('resultid');
        $this->assign('resultid',$resultid);
        
	}
    
	//ブランド一覧
	public function index() {
	    $type = Q('type');
        $webListModel = K("Weblist");
        $startplaceModel = K("Startplace");
        $destinationsModel=K("Destinations");
        $lineAttrModel=K("LineAttr");
        //站点
        if($type=='weblist')
        {
           $this->assign('weblist',$webListModel->All());
        }
        //出发地
        if($type=='startplace')
        {
            $this->assign('startplace',$startplaceModel->where(' pid=0 and isopen=1')->All());
        }
        //目的地
        if($type=='destlist')
        {
            $this->assign('destlist',$destinationsModel->where('pid=0 and isopen=1')->All());
        }
        //属性
        if($type=='attrlist')
        {
            $typeid = Q('typeid');
            
            $weblistModel = K("Weblist");
            $result=$weblistModel->All();
            $weblist = array();
            foreach ($result AS $row)
            {
                $weblist[$row['id']] = addslashes($row['webname']);
            }
        
            $this->assign('weblist',$weblist);
            $this->assign('typeid',$typeid);
            $this->assign('attrlist',$lineAttrModel->where(" isopen=1 and pid=0 ")->All());
        }
        $this->assign('type',$type);
        $this->display();
	}
    
    
    public function ajax_get_citychild()
    {
        $startplaceModel = K("Startplace");
        $pid = Q('pid');
        $citylist = $startplaceModel->where(' pid='.$pid.' and isopen=1 ')->All();
        echo json_encode($citylist);exit;
    }
    
    
    public function ajax_get_destchild(){
        $destinationsModel=K("Destinations");
        $pid = Q('pid');
        $citylist = $destinationsModel->where(' pid='.$pid.' and isopen=1 ')->All();
        echo json_encode($citylist);exit;
    }
	
    public function ajax_get_attrchild(){
        $lineAttrModel=K("LineAttr");
        $pid = Q('pid');
        $list =$lineAttrModel->where(' pid='.$pid.' and isopen=1 ')->All();// Model_Attrlist::getAttr($typeid,$pid);
        echo json_encode($list);exit;
    }

	
    
    
}
