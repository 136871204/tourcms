<?php
/**
 * ブランド管理
 * @author 周鸿 <136871204@qq.com>
 */
class WeblistControl extends AuthControl {
    protected $db;
    
    public function __init() {
		$this -> db = K("Weblist");
	}
    
    public function index(){
        $count = $this -> db -> count();
		$page = new Page($count);
		$this -> page = $page -> show();
		$weblist = $this -> db -> order("displayorder asc") -> limit($page -> limit()) -> all();
        
        $this -> weblist = $weblist;
		$this -> display();
    }
    
    public function add(){
        if (IS_POST) {
			if ($this -> db-> addWeblist($_POST)) {
				$this -> success("添加成功！");
			} else {
				$this -> error($this -> db-> error);
			}
		} else {
			$this -> display();
		}
    }
    
    //修改
	public function edit() {
		if (IS_POST) {
			if ($this -> db-> editWeblist($_POST)) {
				$this -> success("修改成功！");
			} else {
				$this -> error($this -> db-> error);
			}
		} else {
			$id = Q("id",0, "intval");
			if ($id) {
				$field = $this -> db-> find($id);
				$this->assign('field',$field);
				$this -> display();
			}
		}
	}
    
    //删除
	public function del() {
		$id = Q('id', 0, 'intval');
        $result = $this -> db->where(array('id' => $id))->find();
        if(count($result)>0){
            if($this -> db ->del('id = '.$id)){
                $this -> success("删除成功");
            }else{
                $this -> error("删除失败");
            }
        }else{
            $this -> error("删除失败");
        }
	}
    
    
    public function updateCache(){
        $this -> db->updateCache();
        if ($this -> db->updateCache()) {
			$this -> success('缓存更新成功');
		} else {
			$this -> error( '缓存更新失败');
		}
    }
    
    
}
