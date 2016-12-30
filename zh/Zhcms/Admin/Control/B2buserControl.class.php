<?php

/**
 * B2B管理员管理模块
 * Class B2badminControl
 * @author 周鸿 <136871204@qq.com>
 */

class B2buserControl extends AuthControl{
    
    private $_db;
    
    public function __init(){
        $this -> _db = K("B2buser");
    }
    
    //b2b会员列表
    public function index(){
        
        //分页
        $totalcount_arr = $this -> _db -> count();//总数量
        //p($totalcount_arr);die;
        $page = new Page($totalcount_arr,10);  
        $this -> page = $page -> show(); //$param => 页面风格选择
        $limitarr=$page -> limit();        
        
		$data = $this -> _db -> order("b2bid ASC") ->limit($page -> limit()) -> all();
        //p($data);die;
		$this -> assign('data', $data);
        $this -> display();
    }
    
    //验证用户是否存在
	public function check_username() {
		$b2busername = Q("post.b2busername");
		$b2bid = Q("post.b2bid",'0');
		echo $this -> _db -> join() -> find("b2busername='$b2busername' and b2bid <> $b2bid") ? 0 : 1;
		exit ;
	}

	//验证邮箱
	public function check_email() {
		$email = Q("post.email");
		echo $this -> _db -> join() -> find("email='$email'") ? 0 : 1;
		exit ;
	}
    
    //添加b2b会员
    public function add(){
        
        if( IS_POST ){
            //user_state 1 正常 0 锁定
			$_POST['b2buser_state']=1;
			if ($this -> _db -> addB2bUser($_POST)) {
				$this -> success("OK");
			} else {
				$this -> error($this -> _db -> error);
			}
        }else{
            $this -> display();
        }
    }
    
    /**
	 * 修改管理员
	 */
	public function edit() {
	   
		$b2bid = Q('b2bid');
        
		if (IS_POST) {

			if (!$b2bid) {
				$this -> error("操作失败");
			}
			$_POST['b2bid']=$b2bid;
			if ($this -> _db -> editB2bUser($_POST)) {
				$this -> success("操作成功");
			} else {
				$this -> error($this -> _db -> error);
			}
		} else {
			if ($b2bid) {
				//会员信息
				$this -> field = $this -> _db -> find($b2bid);
                
                //管理员id
                $roleid=$_SESSION['rid'];
                if($roleid == "1" || $roleid == "18"){
                    
                }
                $this -> assign("superadmin", $roleid == "1" || $roleid == "18" ? "1" : "");
				$this -> display();
			}
		}
	}
    
    //删除管理员
	public function del() {
		$uid = Q("POST.b2bid", null, "intval");
		if ($uid) {
			if ($this -> _db -> delUser($uid)) {
				$this -> success("操作成功！");
			}
		} else {
			$this -> error("操作失败！");
		}
	}
    
    //到处Excel
    public function excel(){
        
        $arr = $this -> _db -> order("b2bid ASC") -> all();
        //p($arr);die;
        $table = "<table><tr>";
        $table.="<td>省份</td>";
        $table.="<td>地区</td>";
        $table.="<td>全称</td>";
        $table.="<td>简称</td>";
        
        $table.="<td>b2b用户名</td>";
        $table.="<td>b2b密码</td>";
        $table.="<td>法人代表</td>";
        $table.="<td>姓名</td>";
        $table.="<td>昵称</td>";
        $table.="<td>性别</td>";
        $table.="<td>部门</td>";
        $table.="<td>职位</td>";
        $table.="<td>手机</td>";
        $table.="<td>办公电话</td>";
        $table.="<td>传真</td>";
        $table.="<td>QQ号码</td>";
        $table.="<td>电子邮件</td>";
        $table.="<td>财务电话</td>";
        $table.="<td>备注</td>";
        $table.="</tr>";
        if(!empty($arr)){
            foreach($arr as $row)
            {
                $table.="<tr>";
                $table.="<td>{$row['province']}</td>";
                $table.="<td>{$row['addr']}</td>";
                $table.="<td>{$row['fullname']}</td>";
                $table.="<td>{$row['simplename']}</td>";
                
                $table.="<td>{$row['b2busername']}</td>";
                $table.="<td>{$row['b2bpassword']}</td>";
                $table.="<td>{$row['legalrepresentative']}</td>";
                $table.="<td>{$row['name']}</td>";
                $table.="<td>{$row['nickname']}</td>";
                $table.="<td>". ($row['gender'] == '2' ? '女' : '男') ."</td>";
                $table.="<td>{$row['department']}</td>";
                $table.="<td>{$row['position']}</td>";
                $table.="<td>{$row['mobile']}</td>";
                $table.="<td>{$row['tel']}</td>";
                $table.="<td>{$row['fax']}</td>";
                $table.="<td>{$row['qq']}</td>";
                $table.="<td>{$row['email']}</td>";
                $table.="<td>{$row['financetel']}</td>";
                $table.="<td>{$row['remark']}</td>";
                $table.="</tr>";
    
            }
        }
        $table.="</table>";
        
        $filename = date('Ymdhis');
        header ( 'Pragma:public');
        header ( 'Expires:0');
        header ( 'Cache-Control:must-revalidate,post-check=0,pre-check=0');
        header ( 'Content-Type:application/force-download');
        header ( 'Content-Type:application/vnd.ms-excel');
        header ( 'Content-Type:application/octet-stream');
        header ( 'Content-Type:application/download');
        header ( 'Content-Disposition:attachment;filename='.$filename.".xls" );
        header ( 'Content-Transfer-Encoding:binary');
        echo $table;
        exit();
        
    }
    
}


?>