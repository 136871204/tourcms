<?php
/**
 * ブランド管理
 * @author 周鸿 <136871204@qq.com>
 */
class BrandControl extends AuthControl {
    protected $db;
    
    public function __init() {
		$this -> db = K("Brand");
	}
    
	//ブランド一覧
	public function index() {
	    $count = $this -> db -> count();
		$page = new Page($count);
		$this -> page = $page -> show();
		$brand = $this -> db -> order("sort_order asc") -> limit($page -> limit()) -> all();
        
        $this -> brand = $brand;
		$this -> display();
	}
    
    //添加
	public function add() {
		if (IS_POST) {
			if ($this -> db-> addBrand($_POST)) {
				$this -> success("新規成功！");
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
			if ($this -> db-> editBrand($_POST)) {
				$this -> success("修正成功！");
			} else {
				$this -> error($this -> db-> error);
			}
		} else {
			$brand_id = Q("brand_id",0, "intval");
			if ($brand_id) {
				$field = $this -> db-> find($brand_id);
				$this->assign('field',$field);
				$this -> display();
			}
		}
	}
    
    //删除
	public function del() {
		$brand_id = Q('brand_id', 0, 'intval');
        $result = $this -> db->where(array('brand_id' => $brand_id))->find();
        if(count($result)>0){
            @unlink(ROOT_PATH.$result['brand_logo']);
            if($this -> db ->del('brand_id = '.$brand_id)){
                //TODO 更新商品表格没有完成
                $this -> success("削除成功");
            }else{
                $this -> error("削除失敗");
            }
        }else{
            $this -> error("削除失敗");
        }
	}
 

	//验证用户是否存在
	public function check_brandname() {
	    $Model = M('brand');
		$brand_name = Q("post.brand_name");
		$where='';
		if ($brand_id = Q('brand_id')) {
			$where="brand_id<>$brand_id";
		}
		echo $Model->where($where)-> find("brand_name='$brand_name'") ? 0 : 1;
		exit ;
	}


    public function add_brand(){
        $db_prefix=C("DB_PREFIX");
        $brand = empty($_REQUEST['brand']) ? '' : trim($_REQUEST['brand']);
        if($this -> db->brand_exists($brand))
        {
            make_json_error('品牌名已经存在');
        }
        else
        {
            $sql = "INSERT INTO " . $db_prefix.'brand' . "(brand_name)" .
               "VALUES ( '$brand')";
            $brand_id=M()->exe($sql);
            $arr = array("id"=>$brand_id, "brand"=>$brand);
            make_json_result($arr);
        }
    }

	

	

	
    
    
}
