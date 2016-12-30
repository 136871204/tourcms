<?php
/**
 * 用户管理模型
 * Class UserModel
 */
class LineAttrModel extends ViewModel {
    public $table = "line_attr";
    public $colName ="attrname";
    
    
    /**
     * 获得指定分类下的子分类的数组
     *
     * @access  public
     * @param   int     $desc_id    目的地ID
     * @param   int     $selected   当前选中分类的ID
     * @param   boolean $re_type    返回的类型: 值为真时返回下拉列表,否则返回数组
     * @param   int     $level      限定返回的级数。为0时返回所有级数
     * @param   int     $is_show_all 如果为true显示所有分类，如果为false隐藏不可见分类。
     * @return  mix
     */
    public function getList($webid=1,$id = 0, $selected = 0, $re_type = true, $level = 0, $is_show_all = true)
    {
        static $res = NULL;
        $db_prefix=C("DB_PREFIX");
        if ($res === NULL)
        {
            //TODO：关于缓存 之后再处理
            $data = null;//('cat_pid_releate');
            if ($data === null)
            {
                $sql = "SELECT 
                            c.id, 
                            c.".$this->colName.", 
                            c.isopen, 
                            c.pid,  
                            c.displayorder,
                            COUNT(s.id) AS has_children ".
                        'FROM ' . $this->tableFull. " AS c ".
                        "LEFT JOIN " . $this->tableFull . " AS s ON s.pid=c.id ".
                        "WHERE c.webid=".$webid." ".
                        "GROUP BY c.id ".
                        'ORDER BY c.pid, c.displayorder ASC';    
                        
                $res = $this->db->query($sql);

                
                //如果数组过大，不采用静态缓存方式
                if (count($res) <= 1000)
                {
                    //cache('cat_pid_releate',$res);
                }
            }
            else
            {
                $res = $data;
            }
        }
        
        if (empty($res) == true)
        {
            return $re_type ? '' : array();
        }
        
        $options =$this->options($id, $res); // 获得指定分类下的子分类的数组
        //p($res);die;
        $children_level = 99999; //大于这个分类的将被删除
        if ($is_show_all == false)
        {
            foreach ($options as $key => $val)
            {
                if ($val['level'] > $children_level)
                {
                    unset($options[$key]);
                }
                else
                {
                    if ($val['isopen'] == 0)
                    {
                        unset($options[$key]);
                        if ($children_level > $val['level'])
                        {
                            $children_level = $val['level']; //标记一下，这样子分类也能删除
                        }
                    }
                    else
                    {
                        $children_level = 99999; //恢复初始值
                    }
                }
            }
        }
    
        /* 截取到指定的缩减级别 */
        if ($level > 0)
        {
            if ($id == 0)
            {
                $end_level = $level;
            }
            else
            {
                $first_item = reset($options); // 获取第一个元素
                $end_level  = $first_item['level'] + $level;
            }
    
            /* 保留level小于end_level的部分 */
            foreach ($options AS $key => $val)
            {
                if ($val['level'] >= $end_level)
                {
                    unset($options[$key]);
                }
            }
        }
    
        if ($re_type == true)
        {
            $select = '';
            foreach ($options AS $var)
            {
                $select .= '<option value="' . $var['id'] . '" ';
                $select .= ($selected == $var['id']) ? "selected='ture'" : '';
                $select .= '>';
                if ($var['level'] > 0)
                {
                    $select .= str_repeat('&nbsp;', $var['level'] * 4);
                }
                $select .= htmlspecialchars(addslashes($var[$this->colName]), ENT_QUOTES) . '</option>';
            }
    
            return $select;
        }
        else
        {
            foreach ($options AS $key => $value)
            {
                //$options[$key]['url'] = ec_build_uri('category', array('cid' => $value['id']), $value[$this->colName]);
                $options[$key]['url']="";
            }
    
            return $options;
        }
    }
    
    /**
     * 过滤和排序所有分类，返回一个带有缩进级别的数组
     *
     * @access  private
     * @param   int     $cat_id     上级分类ID
     * @param   array   $arr        含有所有分类的数组
     * @param   int     $level      级别
     * @return  void
     */
    function options($spec_id, $arr)
    {
        static $result_options = array();
    
        if (isset($result_options[$spec_id]))
        {
            return $result_options[$spec_id];
        }
        
        if (!isset($result_options[0]))
        {
            
            $level = $last_id = 0;
            $options = $cat_id_array = $level_array = array();
            //TODO：关于缓存 之后再处理
            $data = null;//cache('cat_option_static');
            if ($data === null)
            {
                while (!empty($arr))
                {
                    foreach ($arr AS $key => $value)
                    {
                        $cat_id = $value['id'];
                        if ($level == 0 && $last_id == 0)
                        {
                            if ($value['pid'] > 0)
                            {
                                break;
                            }
    
                            $options[$cat_id]          = $value;
                            $options[$cat_id]['level'] = $level;
                            $options[$cat_id]['id']    = $cat_id;
                            $options[$cat_id]['name']  = $value[$this->colName];
                            unset($arr[$key]);
    
                            if ($value['has_children'] == 0)
                            {
                                continue;
                            }
                            $last_id  = $cat_id;
                            $cat_id_array = array($cat_id);
                            $level_array[$last_id] = ++$level;
                            continue;
                        }
    
                        if ($value['pid'] == $last_id)
                        {
                            $options[$cat_id]          = $value;
                            $options[$cat_id]['level'] = $level;
                            $options[$cat_id]['id']    = $cat_id;
                            $options[$cat_id]['name']  = $value[$this->colName];
                            unset($arr[$key]);
    
                            if ($value['has_children'] > 0)
                            {
                                if (end($cat_id_array) != $last_id)
                                {
                                    $cat_id_array[] = $last_id;
                                }
                                $last_id    = $cat_id;
                                $cat_id_array[] = $cat_id;
                                $level_array[$last_id] = ++$level;
                            }
                        }
                        elseif ($value['pid'] > $last_id)
                        {
                            break;
                        }
                    }
    
                    $count = count($cat_id_array);
                    if ($count > 1)
                    {
                        $last_id = array_pop($cat_id_array);
                    }
                    elseif ($count == 1)
                    {
                        if ($last_id != end($cat_id_array))
                        {
                            $last_id = end($cat_id_array);
                        }
                        else
                        {
                            $level = 0;
                            $last_id = 0;
                            $cat_id_array = array();
                            continue;
                        }
                    }
    
                    if ($last_id && isset($level_array[$last_id]))
                    {
                        $level = $level_array[$last_id];
                    }
                    else
                    {
                        $level = 0;
                    }
                }
                //如果数组过大，不采用静态缓存方式
                if (count($options) <= 2000)
                {
                    cache('cat_option_static', $options);
                }
            }
            else
            {
                $options = $data;
            }
            $result_options[0] = $options;
        }
        else
        {
            $options = $result_options[0];
        }
    
        if (!$spec_id)
        {
            return $options;
        }
        else
        {
            if (empty($options[$spec_id]))
            {
                return array();
            }
    
            $spec_cat_id_level = $options[$spec_id]['level'];
    
            foreach ($options AS $key => $value)
            {
                if ($key != $spec_id)
                {
                    unset($options[$key]);
                }
                else
                {
                    break;
                }
            }
    
            $spec_cat_id_array = array();
            foreach ($options AS $key => $value)
            {
                if (($spec_cat_id_level == $value['level'] && $value['id'] != $spec_id) ||
                    ($spec_cat_id_level > $value['level']))
                {
                    break;
                }
                else
                {
                    $spec_cat_id_array[$key] = $value;
                }
            }
            $result_options[$spec_id] = $spec_cat_id_array;
    
            return $spec_cat_id_array;
        }
    }
    
    
    
    
    /**
     * 检查分类是否已经存在
     *
     * @param   string      $cat_name       分类名称
     * @param   integer     $parent_dest     上级分类
     * @param   integer     $exclude        排除的分类ID
     *
     * @return  boolean
     */
    function exists($webid,$name, $parent, $exclude = 0)
    {
        $sql = "SELECT COUNT(*) FROM " .$this->tableFull.
        " WHERE pid = '$parent' AND ".$this->colName." = '$name' AND webid = $webid AND id<>'$exclude'";
        return ($this->getOne($sql,'COUNT(*)') > 0) ? true : false;
    }

   
    public  function getAttrnameList($attrid_str,$separator=',')
	{
	   $attr_str='';
		$attrid_arr=explode(',',$attrid_str);
		foreach($attrid_arr as $k=>$v)
		{
			$attr=$this->find($v);
			
			if($attr['attrname'])
			$attr_str.=$attr['attrname'].$separator;
		}
		$attr_str=trim($attr_str,$separator);
	    return $attr_str;
		
	}

    //更新缓存
    function updateCache()
    {
        $attrgroupdata=$this->attrgrouplist();
        $alldata=$this->all();
        cache("all_line_attr", $alldata);
        return cache("line_attrgroup", $attrgroupdata);
    }
    
    function attrgrouplist($typeid="1",$filterid='',$row=8){
        $db_prefix=C("DB_PREFIX");
        $w = !empty($filterid) ? " and id not in($filterid)" : '';//排除不要的项
        $w.= $typeid>13 ? " and typeid=$typeid" : '';//如果是扩展模块,则增加typeid判断
        $tablearr=array(
                    '1'=>$db_prefix.'line_attr',
                    '2'=>$db_prefix.'hotel_attr',
                    '3'=>$db_prefix.'car_attr',
                    '4'=>$db_prefix.'article_attr',
                    '5'=>$db_prefix.'spot_attr',
                    '6'=>$db_prefix.'photo_attr',
                    '11'=>$db_prefix.'jieban_attr',
                    '13'=>$db_prefix.'tuan_attr');
        $tablename=isset($tablearr[$typeid]) ? $tablearr[$typeid] : $db_prefix.'model_attr';
        $sql="select 
                    id,webid,attrname as groupname 
                from {$tablename} 
                where 
                    pid=0 and 
                    webid=1 and
                    isopen=1 
                    {$w} 
                order by displayorder asc limit 0,$row" ;
        $attrGroupList=M()->query($sql);
        if(!empty($attrGroupList)){
            foreach($attrGroupList as $key=>&$val){
                $val['attrList']=$this->getattrbygroup('1',$val['id'],$val['webid']);
                $val['attrid']=$val['id'];

            }
        }
        return $attrGroupList;
    }
    
    function getattrbygroup($typeid="1",$pid,$webid){
        $db_prefix=C("DB_PREFIX");
        $row=80;
        $tablearr=array(
                    '1'=>$db_prefix.'line_attr',
                    '2'=>$db_prefix.'hotel_attr',
                    '3'=>$db_prefix.'car_attr',
                    '4'=>$db_prefix.'article_attr',
                    '5'=>$db_prefix.'spot_attr',
                    '6'=>$db_prefix.'photo_attr',
                    '11'=>$db_prefix.'jieban_attr',
                    '13'=>$db_prefix.'tuan_attr');
        $tablename=isset($tablearr[$typeid]) ? $tablearr[$typeid] : $db_prefix.'model_attr';
        $sql="select id,attrname from {$tablename} where pid='$pid' and webid='$webid'  order by displayorder asc limit 0,{$row}";
        $attrlist=M()->query($sql);
        if(!empty($attrlist)){
            foreach($attrlist as $key=>&$val){
                $val['groupid_attrid']=$pid.'_'.$val['id'];
                $val['attrid']=$val['id'];

            }
        }
        return $attrlist;
    }
    
    
    
    
    
    
}
?>