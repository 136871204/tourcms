<?php
/**
 * 商品类型
 * @author 周鸿 <136871204@qq.com>
 */
class SuppliersControl extends AuthControl {
    protected $db;
    
    public function __init() {
		$this -> db = K("Suppliers");
	}
    
	//商品类型一览
	public function index() {
        $count = $this -> db -> count();
		$page = new Page($count);
		$this -> page = $page -> show();
		$suppliers_list = $this -> db ->  limit($page -> limit()) -> all();
        
        $this -> suppliers_list = $suppliers_list;
        
        
        $this -> display();
	}
    
    //添加
	public function add() {
	    $db_prefix=C("DB_PREFIX");
        $adminLogModel=K("AdminLog");
		if (IS_POST) {
		  
            
            /* 提交值 */
            $suppliers = array('suppliers_name'   => trim($_POST['suppliers_name']),
                                'suppliers_desc'   => trim($_POST['suppliers_desc']),
                                'parent_id'        => 0
                           );
            //p($suppliers);die;
            /* 判断名称是否重复 */
            $sql = "SELECT suppliers_id
                FROM " . $db_prefix.'suppliers' . "
                WHERE suppliers_name = '" . $suppliers['suppliers_name'] . "' ";
            if (M()->getOne($sql,'suppliers_id'))
            {
                $this -> error("供应商名已经存在");
            }
            if($suppliers['suppliers_id']=$this->db->insert($suppliers)){
                if (isset($_POST['admins'])){
                    $sql = "UPDATE " . $db_prefix.'user' . 
                                " SET suppliers_id = '" . $suppliers['suppliers_id'] . "'
                                 WHERE uid " . db_create_in($_POST['admins']);
                    M()->exe($sql);
                }
                $adminLogModel->admin_log($suppliers['suppliers_name'], '添加', '供货商');
                $this -> success("供应商添加成功！");
            }else{
                $this -> error("供应商添加失败");
            }
            
		} else {
		    $suppliers = array();
            $sql = "SELECT 
                    uid, 
                    username, 
                    CASE
                        WHEN suppliers_id = 0 THEN 'free'
                        ELSE 'other' END AS type
                    FROM " . $db_prefix.'user' . "
                    WHERE agency_id = 0 ";
            $suppliers['admin_list'] = M()->getAll($sql);
            
            $this->suppliers=$suppliers;
			$this -> display();
		}
	}
    
  
    
    //修改
    public function edit(){
        $db_prefix=C("DB_PREFIX");
        $adminLogModel=K("AdminLog");
        if (IS_POST) {
            /* 提交值 */
            $suppliers = array('id'   => trim($_POST['id']));
            $suppliers['new'] = array('suppliers_name'   => trim($_POST['suppliers_name']),
                                    'suppliers_desc'   => trim($_POST['suppliers_desc'])
                                    );
            /* 取得供货商信息 */
            $sql = "SELECT * FROM " . $db_prefix.'suppliers' . " WHERE suppliers_id = '" . $suppliers['id'] . "'";
            $suppliers['old'] = M()->getRowSql($sql);
            if (empty($suppliers['old']['suppliers_id']))
            {
                $this -> error("供应商不存在");
            }
             /* 判断名称是否重复 */
            $sql = "SELECT suppliers_id
                    FROM " . $db_prefix.'suppliers' . "
                    WHERE suppliers_name = '" . $suppliers['new']['suppliers_name'] . "'
                    AND suppliers_id <> '" . $suppliers['id'] . "'";
            if (M()->getOne($sql,'suppliers_id'))
            {
                $this -> error("供应商名已经存在");
            }
            if($this->db->where(" suppliers_id = '" . $suppliers['id'] . "' ")->update($suppliers['new'])){
                /* 清空供货商的管理员 */
                $sql = "UPDATE " . $db_prefix.'user' . " 
                            SET suppliers_id = 0  WHERE suppliers_id = '" . $suppliers['id'] . "'";
                M()->exe($sql);
                if (isset($_POST['admins'])){
                    $sql = "UPDATE " . $db_prefix.'user' . 
                                " SET suppliers_id = '" . $suppliers['old']['suppliers_id']  . "'
                                 WHERE uid " . db_create_in($_POST['admins']);
                    M()->exe($sql);
                }
                $adminLogModel->admin_log($suppliers['old']['suppliers_name'], '修改', '供货商');
                $this -> success("供应商修改成功！");
            }else{
                $this -> error("供应商修改失败");
            }
        } else {
            $suppliers = array();

            /* 取得供货商信息 */
            $id = $_REQUEST['id'];
            $sql = "SELECT * FROM " . $db_prefix.'suppliers' . " WHERE suppliers_id = '$id'";
            
            $suppliers = M()->getRowSql($sql);
            if (count($suppliers) <= 0)
            {
                $this -> error("供应商不存在");
            }
            
            /* 取得所有管理员，*/
            /* 标注哪些是该供货商的('this')，哪些是空闲的('free')，哪些是别的供货商的('other') */
            /* 排除是办事处的管理员 */
            $sql = "SELECT 
                        uid, username, 
                        CASE
                            WHEN suppliers_id = '$id' THEN 'this'
                            WHEN suppliers_id = 0 THEN 'free'
                            ELSE 'other' END AS type
                        FROM " . $db_prefix.'user' . "
                    WHERE agency_id = 0 ";
            $suppliers['admin_list'] = M()->getAll($sql);
            $this->suppliers=$suppliers;
            $this -> display();
		}
    }
    
    public function del(){
        $db_prefix=C("DB_PREFIX");
        $adminLogModel=K("AdminLog");
        $id = intval($_REQUEST['id']);
        $sql = "SELECT *
            FROM " . $db_prefix.'suppliers' . "
            WHERE suppliers_id = '$id'";
        $suppliers = M()->getRowSql($sql, TRUE);
        if ($suppliers['suppliers_id'])
        {
            /* TODO之后再制作，删除时候需要很多业务 */
            $this -> error("TODO之后再制作，删除时候需要很多业务");
        }else{
            $this -> error("供应商不存在");
        }
    }
   

	
    
    
}
