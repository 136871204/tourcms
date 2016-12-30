<?php
/**
 * ブランド管理
 * @author 周鸿 <136871204@qq.com>
 */
class MainnavControl extends AuthControl {
    protected $db;
    
    public function __init() {
		$this -> db = K("Mainnav");
        $weblistModel = K("Weblist");
        $weblist=$weblistModel->All();
        $this -> weblist = $weblist;
	}
    
	//ブランド一覧
	public function index() {
	    
        $webid = Q('webid', 0, 'intval');
	    $count = $this -> db ->where(" webid =  $webid ") -> count();
		$page = new Page($count);
		$this -> page = $page -> show();
		$mainnav = $this -> db ->where(" webid =  $webid ") -> order("displayorder asc") -> limit($page -> limit()) -> all();

        $this -> mainnav = $mainnav;
        
		$this -> display();
	}
    
    //添加
	public function add() {
		if (IS_POST) {
			if ($this -> db-> addMainnav($_POST)) {
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
			if ($this -> db-> editMainnav($_POST)) {
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
    


	
    
    
}
