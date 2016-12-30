<?php
/**
 * 用户管理模型
 * Class UserModel
 */
class DestinationsModel extends ViewModel {
    public $table = "destinations";
    
    
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
    public function dest_list($dest_id = 0, $selected = 0, $re_type = true, $level = 0, $is_show_all = true)
    {
        static $res = NULL;
        $db_prefix=C("DB_PREFIX");
        if ($res === NULL)
        {
            //TODO：关于缓存 之后再处理
            $data = null;//('cat_pid_releate');
            if ($data === null)
            {
                /*$sql = "SELECT 
                            c.cat_id, 
                            c.cat_name, 
                            c.measure_unit, 
                            c.parent_id, 
                            c.is_show, 
                            c.show_in_nav, 
                            c.grade, 
                            c.sort_order, 
                            COUNT(s.cat_id) AS has_children ".
                        'FROM ' . $this->tableFull. " AS c ".
                        "LEFT JOIN " . $this->tableFull . " AS s ON s.parent_id=c.cat_id ".
                        "GROUP BY c.cat_id ".
                        'ORDER BY c.parent_id, c.sort_order ASC';    */
                $sql = "SELECT 
                            c.id, 
                            c.kindname, 
                            c.isopen, 
                            c.isnav,
                            c.ishot,                                                                                    
                            c.pid,  
                            c.displayorder,
                            COUNT(s.id) AS has_children ".
                        'FROM ' . $this->tableFull. " AS c ".
                        "LEFT JOIN " . $this->tableFull . " AS s ON s.pid=c.id ".
                        "GROUP BY c.id ".
                        'ORDER BY c.pid, c.displayorder ASC';    
                        
                $res = $this->db->query($sql);

                /*$sql = "SELECT 
                            cat_id, 
                            COUNT(*) AS goods_num " .
                        " FROM " . $db_prefix.'goods' .
                        " WHERE 
                            is_delete = 0 AND 
                            is_on_sale = 1 " .
                        " GROUP BY cat_id";
                $res2 = $this->db->query($sql);
                $sql = "SELECT 
                            gc.cat_id, 
                            COUNT(*) AS goods_num " .
                        " FROM 
                        " . $db_prefix.'goods_cat' . " AS gc , 
                        " .  $db_prefix.'goods' . " AS g " .
                        " WHERE 
                            g.goods_id = gc.goods_id AND 
                            g.is_delete = 0 AND 
                            g.is_on_sale = 1 " .
                        " GROUP BY gc.cat_id";
                $res3 = $this->db->query($sql);

                $newres = array();
                foreach($res2 as $k=>$v)
                {
                    $newres[$v['cat_id']] = $v['goods_num'];
                    foreach($res3 as $ks=>$vs)
                    {
                        if($v['cat_id'] == $vs['cat_id'])
                        {
                        $newres[$v['cat_id']] = $v['goods_num'] + $vs['goods_num'];
                        }
                    }
                }
    
                foreach($res as $k=>$v)
                {
                    $res[$k]['goods_num'] = !empty($newres[$v['cat_id']]) ? $newres[$v['cat_id']] : 0;
                }*/
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
        
        $options =$this->dest_options($dest_id, $res); // 获得指定分类下的子分类的数组

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
            if ($dest_id == 0)
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
                $select .= htmlspecialchars(addslashes($var['kindname']), ENT_QUOTES) . '</option>';
            }
    
            return $select;
        }
        else
        {
            foreach ($options AS $key => $value)
            {
                $options[$key]['url'] = ec_build_uri('category', array('cid' => $value['id']), $value['kindname']);
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
    function dest_options($spec_dest_id, $arr)
    {
        static $dest_options = array();
    
        if (isset($dest_options[$spec_dest_id]))
        {
            return $dest_options[$spec_dest_id];
        }
        
        if (!isset($dest_options[0]))
        {
            
            $level = $last_dest_id = 0;
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
                        if ($level == 0 && $last_dest_id == 0)
                        {
                            if ($value['pid'] > 0)
                            {
                                break;
                            }
    
                            $options[$cat_id]          = $value;
                            $options[$cat_id]['level'] = $level;
                            $options[$cat_id]['id']    = $cat_id;
                            $options[$cat_id]['name']  = $value['kindname'];
                            unset($arr[$key]);
    
                            if ($value['has_children'] == 0)
                            {
                                continue;
                            }
                            $last_dest_id  = $cat_id;
                            $cat_id_array = array($cat_id);
                            $level_array[$last_dest_id] = ++$level;
                            continue;
                        }
    
                        if ($value['pid'] == $last_dest_id)
                        {
                            $options[$cat_id]          = $value;
                            $options[$cat_id]['level'] = $level;
                            $options[$cat_id]['id']    = $cat_id;
                            $options[$cat_id]['name']  = $value['kindname'];
                            unset($arr[$key]);
    
                            if ($value['has_children'] > 0)
                            {
                                if (end($cat_id_array) != $last_dest_id)
                                {
                                    $cat_id_array[] = $last_dest_id;
                                }
                                $last_dest_id    = $cat_id;
                                $cat_id_array[] = $cat_id;
                                $level_array[$last_dest_id] = ++$level;
                            }
                        }
                        elseif ($value['pid'] > $last_dest_id)
                        {
                            break;
                        }
                    }
    
                    $count = count($cat_id_array);
                    if ($count > 1)
                    {
                        $last_dest_id = array_pop($cat_id_array);
                    }
                    elseif ($count == 1)
                    {
                        if ($last_dest_id != end($cat_id_array))
                        {
                            $last_dest_id = end($cat_id_array);
                        }
                        else
                        {
                            $level = 0;
                            $last_dest_id = 0;
                            $cat_id_array = array();
                            continue;
                        }
                    }
    
                    if ($last_dest_id && isset($level_array[$last_dest_id]))
                    {
                        $level = $level_array[$last_dest_id];
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
            $dest_options[0] = $options;
        }
        else
        {
            $options = $dest_options[0];
        }
    
        if (!$spec_dest_id)
        {
            return $options;
        }
        else
        {
            if (empty($options[$spec_dest_id]))
            {
                return array();
            }
    
            $spec_cat_id_level = $options[$spec_dest_id]['level'];
    
            foreach ($options AS $key => $value)
            {
                if ($key != $spec_dest_id)
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
                if (($spec_cat_id_level == $value['level'] && $value['id'] != $spec_dest_id) ||
                    ($spec_cat_id_level > $value['level']))
                {
                    break;
                }
                else
                {
                    $spec_cat_id_array[$key] = $value;
                }
            }
            $dest_options[$spec_dest_id] = $spec_cat_id_array;
    
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
    function dest_exists($dest_name, $parent_dest, $exclude = 0)
    {
        $sql = "SELECT COUNT(*) FROM " .$this->tableFull.
        " WHERE pid = '$parent_dest' AND kindname = '$dest_name' AND id<>'$exclude'";
        return ($this->getOne($sql,'COUNT(*)') > 0) ? true : false;
    }

    /*
	   获取目的地的所有祖先目的地
	*/
    public  function getParents($id){
        //echo $id;
        $first_dest=$this->where( " id = $id " )->All();
        if(isset($first_dest[0])){
            $first_dest=$first_dest[0];
        }
        
        //p($first_dest);exit;
        if(!$first_dest['id']){
            return null;
        }
        $cid=$first_dest['pid'];
        while(true)
        {
            $cur_dest=$this->where( " id = $cid " )->All();
            if(isset($cur_dest[0])){
                $cur_dest=$cur_dest[0];
            }
        
            if($cur_dest['id']==0)
            {
                return null;
            }
            $new_row['id']=$cur_dest['id'];
			$new_row['kindname']=$cur_dest['id'];
			$parents[]=$new_row;  
            
            if($cur_dest['pid']==0)
            {
                break;
            }
            $cid=$cur_dest['pid'];
        }
        //p($parents);exit;
        return $parents;
        
    }
    
    
    /*
	   根据目的地ID字符串（逗号分隔) ，返回目的地名称
	*/
	public function getKindnameList($kindid_str,$separator=',')
	{
	   $dest_str="";
		$kind_arr=explode(',',$kindid_str);
		foreach($kind_arr as $k=>$v)
		{
			$dest= $this->find($v); //ORM::factory('destinations',$v);
			if($dest['kindname'])
			 $dest_str.=$dest['kindname'].$separator;
		}
		$dest_str=trim($dest_str,$separator);
	    return $dest_str;
	}
    
    /*
     * 根据目的地ID字符串（逗号分隔) ，返回目的地数组
     */
	public  function getKindlistArr($kindid_str)
    {
        $kindid_arr=explode(',',$kindid_str);
        $kind_arr=array();
        foreach($kindid_arr as $v)
        {
            $dest=$this->find($v); 
            if($dest['id'])
            {
                $kind_arr[]=$dest;
            }

        }
        return $kind_arr;

    }
    
    /*
     * 获取目的地信息
     * */
    public  function getDestInfo($destid)
    {
        $all_dest=cache('all_dest');
        if(empty($all_dest)){
            $sql = "select * from ".$this->tableFull." where id='$destid'";
            $row = $this->getOneRow($sql);
            return $row;
        }else{
            foreach($all_dest as $dest){
                if($dest['id']==$destid){
                    return $dest;
                }
            }
        }
        
    }
    
    //更新缓存
    function updateCache()
    {
        $alldata=$this->all();
        Dir::del('./data/cache/Data/dest/' );
        Dir::del('./data/cache/Data/destchild/' );
        //$data = $this->order('webid asc,lowerprice asc')->all();
        return cache("all_dest", $alldata);
    }
    
    
}
?>