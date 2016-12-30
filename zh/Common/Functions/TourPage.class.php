<?php
//.-----------------------------------------------------------------------------------
// |  Software: [ZHPHP framework]
// |   Version: 2014.06
// |-----------------------------------------------------------------------------------
// |    Author: 周鸿 <136871204@qq.com>
// | Copyright (c) 2014, 周鸿 <136871204@qq.com>.All Rights Reserved.
// |-----------------------------------------------------------------------------------

/**
 * 分页处理类
 * @package     tools_class
 * @editor      周鸿 <136871204@qq.com>
 */
class TourPage
{
    static $staticTotalPage = null; //总页数
    static $staticUrl = null; //当前url
    static $fix = '';
    static $pageNumLabel = '{page}'; //替换标签
    public $totalRow; //总条数
    public $totalPage; //总页数
    public $arcRow; //每页显示数
    public $pageRow; //每页显示页码数
    public $selfPage; //当前页
    public $url; //页面地址
    public $args; //页面传递参数
    public $startId; //当前页开始ID
    public $endId; //当前页末尾ID
    public $desc = array(); //文字描述

    /**
     * @param int $total 总条数
     * @param string $row 每页显示条数
     * @param string $pageRow 显示页码数量
     * @param string $desc 描述文字
     * @param string $setSelfPage 当前页
     * @param string $customUrl 当前url
     * @param string $pageNumLabel 页码变量,默认为{page}
     */

    function __construct($total, $row = '', $pageRow = '', $desc = '',
                         $setSelfPage = '', $customUrl = '', $pageNumLabel = '{page}')
    {
        $this->totalRow = $total; //总条数
        /*
        'PAGE_ROW'      => 10,     //页码数量
        'PAGE_SHOW_ROW'    => 10,  //每页显示条数
        */
        $this->arcRow = empty($row) ? C("PAGE_SHOW_ROW") : $row; //每页显示条数
        $this->pageRow = empty($pageRow) ? C('PAGE_ROW') : $pageRow; //显示页码数量
        $this->totalPage = ceil($this->totalRow / $this->arcRow); //总页数
        self::$staticTotalPage = $this->totalPage; //总页数
        self::$pageNumLabel = empty($pageNumLabel) ? self::$pageNumLabel : $pageNumLabel; //替换标签
        /*
        $temp;
        //$setSelfPage 当前页 没有值
        if(empty($setSelfPage)){
            //$_get中没有传入分页变量
            if(empty($_GET[C("PAGE_VAR")])){
                $temp=1;
            }else{
                $temp= max(1, (int)$_GET[C("PAGE_VAR")]);
            }
        }else{
            $temp=max(1, (int)$setSelfPage);
        }
        $this->selfPage= min($this->totalPage,$temp)
        上面代码简化，取得当前页
        */
        //'PAGE_VAR'  => 'page',      //分页GET变量
        $this->selfPage = min($this->totalPage, empty($setSelfPage) ? empty($_GET[C("PAGE_VAR")]) ? 1 : max(1, (int)$_GET[C("PAGE_VAR")]) : max(1, (int)$setSelfPage)); //当前页
        //$page = new Page(88,10,6,'','','http://localhost/{page}.html','{page}');
        $this->url = $this->setUrl($customUrl); //配置url地址
        //当前页开始ID=(当前页 -1 )*每页显示条数 +1
        $this->startId = ($this->selfPage - 1) * $this->arcRow + 1; //当前页开始ID
        //当前页结束ID=（当前页 *每页显示条数 ,//总页数)
        $this->endId = min($this->selfPage * $this->arcRow, $this->totalRow); //当前页结束ID
        /*描述文字：分页文字设置如：
        array('pre' => ' 上一页', 
            'next' => ' 下一页', 
            'first'=> ' 首页', 
            'end' => ' 尾页', 
            'unit' => ' 条')
        */
        
        $this->desc = $this->desc($desc);
    }

    /**
     *
     * 配置描述文字
     * @param array $desc
     * <code>
     * "pre"=>"上一页"
     * "next"=>"下一页"
     * "pres"=>"前十页"
     * "nexts"=>"下十页"
     * "first"=>"首页"
     * "end"=>"尾页"
     * "unit"=>"条"
     * </code>
     * @return array
     */
    private function desc($desc)
    {
         /*描述文字：分页文字设置如：
        array('pre' => ' 上一页', 
            'next' => ' 下一页', 
            'first'=> ' 首页', 
            'end' => ' 尾页', 
            'unit' => ' 条')
        */
        /*
        'PAGE_DESC'    => array('pre' => '上一页', 'next' => '下一页',//分页文字设置
                                            'first' => '首页', 'end' => '尾页', 'unit' => '条'),
                                            config里面也能配置
        */
        $this->desc = array_change_key_case(C('PAGE_DESC'));
       
        if (empty($desc) || !is_array($desc))
            return $this->desc;

        function filter($v)
        {
            return !empty($v);
        }
        return array_merge($this->desc, array_filter($desc, "filter"));
    }

    //获取URL地址
    protected function getUrl($pageNum)
    {
        $returnUrl = $this->url;

        /*
        数型返回url地址
        b(before)返回url地址前部分
        a(after)返回url地址后部分
        */
        if (strtolower($pageNum) == 'b') {
            $returnUrl = substr($returnUrl, 0, strpos($returnUrl, self::$pageNumLabel));
        } elseif (strtolower($pageNum) == 'a') {
            $returnUrl = substr($returnUrl, strpos($returnUrl, self::$pageNumLabel) + strlen(self::$pageNumLabel));
        } else {
            $returnUrl = str_replace(self::$pageNumLabel, $pageNum, $returnUrl);
        }
        //echo $returnUrl;die;
        return $returnUrl;
    }

    //配置URL地址
    protected function setUrl($customUrl)
    {
        //例如$page = new Page(88,10,6,'','','http://localhost/{page}.html','{page}');
        if (!empty($customUrl)) {
            //如果有传入url就设置这个url
            $returnUrl = $customUrl;
        } elseif (is_null(self::$staticUrl)) {
            //如果全局static::$staticUrl 是空
            
            $get = $_GET;
            $get["webid"] = !empty($get["webid"]) ? $get["webid"] : 1;
            unset($get["a"]);
            unset($get['c']);
            unset($get["m"]);
            unset($get[C("PAGE_VAR")]);
            $url_type = C("URL_TYPE");
            //'URL_TYPE'    => 1,    //类型 1:PATHINFO模式 2:普通模式 3:兼容模式
            //switch ($url_type) {
            switch (4) {
                case 1:
                    $url = __METH__ . '/';
                    foreach ($get as $k => $v) {
                        $url .= $k . '/' . $v . '/';
                    }
                    //返回__METH__/参数/值/page/{page}.html
                    $returnUrl = rtrim($url, '/') . '/' . C("PAGE_VAR") . '/' . self::$pageNumLabel . self::$fix;
                    break;
                case 2:
                    $url = __METH__ . '&';
                    foreach ($get as $k => $v) {
                        $url .= $k . "=" . $v . '&';
                    }
                    $returnUrl = $url . C("PAGE_VAR") . '=' . self::$pageNumLabel . self::$fix;
                case 4:
                    //$url='http://admin.his.com/lines/';
                    $attr = cache("weblist");
                    if($get["webid"] == "1"){
                        $webname = "";
                    }else{
                        foreach($attr as $val){
                            if($val["id"] == $get["webid"]){
                                $webname = "/".$val["webroot"];
                                break;
                            }
                        }
                    }                    
                    $url = "http://".$_SERVER["HTTP_HOST"].$webname."/lines/";
                    unset($get["webid"]);
                    //p($get);
                    //p($url);
                    foreach ($get as $k => $v) {
                        if($v!=''){
                            $url .= $v . '-';
                        }
                        
                    }
                    $returnUrl=$url. self::$pageNumLabel . self::$fix;;
            }
        } else {
            $returnUrl = self::$staticUrl . self::$pageNumLabel . self::$fix; //配置url地址
        }
        return $returnUrl;
    }

    /**
     * SQL的limit语句
     * @param bool $stat true 返回字符串  false 返回数组
     * @return array|string
     */
    public function limit($stat = false)
    {
        if ($stat) {
            return max(0, ($this->selfPage - 1) * $this->arcRow) . "," . $this->arcRow;
        } else {
            //max(0,(当前页-1)*每页显示数)，每页显示数量
            return array("limit" => max(0, ($this->selfPage - 1) * $this->arcRow) . "," . $this->arcRow);
        }
    }

    //上一页
    protected function pre()
    {
        //当前页>1 && 当前页<=总页数
        if ($this->selfPage > 1 && $this->selfPage <= $this->totalPage) {
            return "<a href='" . $this->getUrl($this->selfPage - 1) . "' >上一页</a>";
            
        }
        return "<a href='javascript:void(0);' class='end'>上一页</a>";
    }
    
    //上一页
    protected function exteriorPre()
    {
        //当前页>1 && 当前页<=总页数
        if ($this->selfPage > 1 && $this->selfPage <= $this->totalPage) {
            return "<a  onclick='getDateList(\"" . $this->getUrl($this->selfPage - 1) . "\")' class='pre'>{$this->desc['pre']}</a>";
        }
        return "<span class='close'>{$this->desc['pre']}</span>";
    }

    //下一页
    public function next()
    {
        //$purl = $this->GetCurUrl2();
        //p($purl);
        //$purl .= "-".$this->selfPage + 1;
        //p($purl);
        $next = $this->desc ['next'];
        if ($this->selfPage < $this->totalPage) {
            return "<a href='" . $this->getUrl($this->selfPage + 1) . "' >下一页</a>";
            //$this->getUrl($this->selfPage + 1)
        }
        return "<a href='javascript:void(0);' class='end'>下一页</a>";
    }
    
     /**
     *  获得当前的页面文件的url(伪静态)
     *
     * @access    public
     * @return    string
     */
    public function GetCurUrl2()
    {
        
		/* if(!empty($_SERVER['REQUEST_URI']))
        {
            $nowurl = $_SERVER['REQUEST_URI'];
           
			 $nowurl=str_replace('.html','',$nowurl);
			 $nowurl=str_replace('.php','',$nowurl);
		     $nowurls = explode('_', $nowurl);
             $nowurl = $nowurls[0];
		
        }
        else
        {
            $nowurl = $_SERVER['PHP_SELF'];
        }*/
		$nowurl=str_replace('/search.php','',$_SERVER['PHP_SELF']);
        $nowurl=str_replace('/country.php','',$nowurl);
        $nowurl=str_replace('/index.php','',$nowurl);
        return $nowurl;
    }
    
    //下一页
    public function exteriorNext()
    {
        $next = $this->desc ['next'];
        if ($this->selfPage < $this->totalPage) {
            return "<a   onclick='getDateList(\"" . $this->getUrl($this->selfPage + 1) . "\")'  class='next'>{$next}</a>";
        
        }
        return "<span class='close'>{$next}</span>";
    }

    //列表项
    private function pageList()
    {
        //页码
        $pageList = '';
        $start = max(1, min($this->selfPage - ceil($this->pageRow / 2), $this->totalPage - $this->pageRow));
        $end = min($this->pageRow + $start, $this->totalPage);
        if ($end == 1) //只有一页不显示页码
        return '';
        for ($i = $start; $i <= $end; $i++) {
            if ($this->selfPage == $i) {
                $pageList [$i] ['url'] = "";
                $pageList [$i] ['str'] = $i;
                continue;
            }
            $pageList [$i] ['url'] = $this->getUrl($i);
            $pageList [$i] ['str'] = $i;
        }
        return $pageList;
    }

    //文字页码列表
    public function strList()
    {
        $arr = $this->pageList();
        $str = "";
        if (empty($arr))
            return "<strong class='selfpage'>1</strong>";
        foreach ($arr as $v) {
            $str .= empty($v ['url']) ? "<strong class='selfpage'>" . $v ['str'] . "</strong>" : "<a href={$v['url']}>{$v['str']}</a>";
        }
        return $str;
    }
    
    //文字页码列表
    public function exteriorStrList()
    {
        $arr = $this->pageList();
        $str = "";
        if (empty($arr))
            return "<strong class='selfpage'>1</strong>";
        foreach ($arr as $v) {
            $str .= empty($v ['url']) ? "<strong class='selfpage'>" . $v ['str'] . "</strong>" : "<a  onclick='getDateList(\"{$v['url']}\")'>{$v['str']}</a>";
        }
        return $str;
    }


    //图标页码列表
    public function picList()
    {
        $str = '';
        $first = $this->selfPage == 1 ? "" : "<a href='" . $this->getUrl(1) . "' class='picList'><span><<</span></a>";
        $end = $this->selfPage >= $this->totalPage ? "" : "<a href='" . $this->getUrl($this->totalPage) . "'  class='picList'><span>>></span></a>";
        $pre = $this->selfPage <= 1 ? "" : "<a href='" . $this->getUrl($this->selfPage - 1) . "'  class='picList'><span><</span></a>";
        $next = $this->selfPage >= $this->totalPage ? "" : "<a href='" . $this->getUrl($this->selfPage + 1) . "'  class='picList'><span>></span></a>";

        return $first . $pre . $next . $end;
    }

    //选项列表
    public function select()
    {
        $arr = $this->pageList();
        if (!$arr) {
            return '';
        }
        $str = "<select name='page' class='page_select' onchange='
		javascript:
		location.href=this.options[selectedIndex].value;'>";
        foreach ($arr as $v) {
            $str .= empty($v ['url']) ? "<option value='{$this->getUrl($v['str'])}' selected='selected'>{$v['str']}</option>" : "<option value='{$v['url']}'>{$v['str']}</option>";
        }
        return $str . "</select>";
    }

    //输入框
    public function input()
    {
        $str = "<input id='pagekeydown' type='text' name='page' value='{$this->selfPage}' class='pageinput' onkeydown = \"javascript:
					if(event.keyCode==13){
						location.href='{$this->getUrl('B')}'+this.value+'{$this->getUrl('A')}';
					}
				\"/>
				<button class='pagebt' onclick = \"javascript:
					var input = document.getElementById('pagekeydown');
					location.href='{$this->getUrl('B')}'+input.value+'{$this->getUrl('A')}';
				\">进入</button>
";
        return $str;
    }

    //前几页
    public function pres()
    {
        $num = max(1, $this->selfPage - $this->pageRow);
        return $this->selfPage > $this->pageRow ? "<a href='" . $this->getUrl($num) . "' class='pres'>前{$this->pageRow}页</a>" : "";
    }

    //后几页
    public function nexts()
    {
        $num = min($this->totalPage, $this->selfPage + $this->pageRow);
        return $this->selfPage + $this->pageRow < $this->totalPage ? "<a href='" . $this->getUrl($num) . "' class='nexts'>后{$this->pageRow}页</a>" : "";
    }

    //首页
    public function first()
    {
        $first = $this->desc ['first'];
        return $this->selfPage - $this->pageRow > 1 ? "<a href='" . $this->getUrl(1) . " class='first'>{$first}</a>" : "";
    }

    //末页
    public function end()
    {
        $end = $this->desc ['end'];
        return $this->selfPage < $this->totalPage - $this->pageRow ? "<a href='" . $this->getUrl($this->totalPage) . "' class='end'>{$end}</a>" : "";
    }

    //当前页记录
    public function nowPage()
    {
        return "<span class='nowPage'>" . L("page_nowPage") . "{$this->startId}-{$this->endId}{$this->desc['unit']}</span>";
    }

    //count统计
    public function count()
    {
        return "<span class='count'>[すべて「{$this->totalPage}」ページ] [{$this->totalRow}件]</span>";
    }
    
    public function midstr(){
        return "<span>{$this->selfPage} / {$this->totalPage}</span>";
    }

    /**
     * 返回所有分页信息
     * @return Array
     */
    public function getAll()
    {
        $show = array();
        $show['count'] = $this->count();
        $show['first'] = $this->first();
        $show['pre'] = $this->pre();
        $show['pres'] = $this->pres();
        $show['strList'] = $this->strList();
        $show['nexts'] = $this->nexts();
        $show['next'] = $this->next();
        $show['end'] = $this->end();
        $show['nowPage'] = $this->nowPage();
        $show['select'] = $this->select();
        $show['input'] = $this->input();
        $show['picList'] = $this->picList();
        return $show;
    }

    //页码风格
    public function show($s = '')
    {
        if (empty($s)) {
            $s = C('PAGE_STYLE');
        }
        switch ($s) {
            case 1 :
                return "{$this->count()}{$this->first()}{$this->pre()}{$this->pres()}{$this->strList()}{$this->nexts()}{$this->next()}{$this->end()}
                {$this->nowPage()}{$this->select()}{$this->input()}{$this->picList()}";
            case 2 :
                return $this->pre() . $this->strList() . $this->next() . $this->count();
            case 3 :
                return $this->pre() . $this->strList() . $this->next();
            case 4 :
                return "<span class='total'>" . L("page_show_case1") . ":{$this->totalRow}
                {$this->desc['unit']}</span>" . $this->picList() . $this->select();
            case 5:
                return $this->first() . $this->pre() . $this->strList() . $this->next() . $this->end();
            case 6:
                return $this->pre() . $this->midstr() . $this->next();
            case "exterior":
                return $this->exteriorPre(). $this->exteriorStrList() . $this->exteriorNext() . $this->count();
        }
    }

}