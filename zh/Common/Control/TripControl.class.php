<?php
/**
 * 前台使用的公共控制器
 * Class PublicControl
 */
class TripControl extends PublicControl {
	
    //缓存目录
	public $webid;
    public $urlroot;
    public $searchkeword;
    
	// 构造函数
	public function __construct() {
	       
        
       
		parent::__construct();
        
		$webid=Q('webid',1);
        
        //如果没有公开显示页面的话，并且不是管理员的话，回到首页
        /*if(  !IN_ADMIN &&  $webid==7 ){
            $url = "http://admin.his.com";
            header("Location:".$url);
        } */
        
        $this->webid=$webid;
        $this -> assign("webid", $webid);
        //p($webid);
        define('__WEBID__',$webid);
        
        $weblist = cache("weblist");
        
        if(empty($weblist)){
            $weblist = M('weblist')->all();
        }

        foreach( $weblist as $key => $val){
            if( $val["id"] == $webid ){
                $hisshopname = $val["webname"];
                break;
            }
        }
        
        $lists = getList();
        $jobtime = $lists["jobtime"][$webid];
        $histel = $lists["histel"][$webid];
        
        /*** addBy xie ***/
        switch($webid){
            case "2":
                $urlroot = "/shanghai";
                break;
            case "3":
                $urlroot = "/beijing";
                break;            
            case "6":
                $urlroot = "/other";
                break;
            /*case "7":
                $urlroot = "/guangzhou";
                break;*/
            default:
                $urlroot = "";
                break;
        }
        $this -> assign("jobtime", $jobtime);
        $this -> assign("hisshopname", $hisshopname);
        $this -> assign("lists", $lists);
        $this -> assign("histel", $histel);
        $this -> urlroot = $urlroot;
        $this -> assign("urlroot", $urlroot);
        
        $searchkeword = cookie("searchkeyword");
        if(!empty($searchkeword)){
            $searchkeword = explode("#",$searchkeword);
        }
        $searchkeword = empty($searchkeword) ? "" : $searchkeword;
        $this -> searchkeword = $searchkeword;
        $this -> assign("searchkeword",empty($searchkeword) ? "" : $searchkeword);
        
        
        $this->setRightBanner1();
        $this->setRightBanner2();
        $this->setRightBanner3();

        defined("B2BLOGIN")				or define("B2BLOGIN", isset($_SESSION['b2blogin']));

	}    
    
    public function setRightBanner3(){
        $bannerModel = ContentViewModel::getInstance(11);
        $rightBanner3=$bannerModel->where(" webid =  {$this->webid} and content_state = 1 ")->order(" arc_sort asc ")->All();
        $this -> assign("rightBanner3", $rightBanner3);
    }
    
    public function setRightBanner2(){
        $bannerModel = ContentViewModel::getInstance(10);
        $rightBanner2=$bannerModel->where(" webid =  {$this->webid} and content_state = 1 ")->order(" arc_sort asc ")->All();
        $this -> assign("rightBanner2", $rightBanner2);
    }
    
    public function setRightBanner1(){
        $bannerModel = ContentViewModel::getInstance(9);
        $rightBanner1=$bannerModel->where(" webid =  {$this->webid} and content_state = 1 ")->order(" arc_sort asc ")->limit(1)->All();
        if(!empty($rightBanner1)){
            $this -> assign("rightBanner1", $rightBanner1[0]);
        }
        
    }







}
