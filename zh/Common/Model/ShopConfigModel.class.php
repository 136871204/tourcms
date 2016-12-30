<?php
/**
 * 用户管理模型
 * Class UserModel
 */
class ShopConfigModel extends ViewModel {
    public $table = "shop_config";
    
    public function __init()
    {
        include (COMMON_LANGUAGE_PATH . 'Model'.DS.'ShopConfig'.DS.$_SESSION['language'] . '.php');
    }
    
    /**
     * 获得设置信息
     *
     * @param   array   $groups     需要获得的设置组
     * @param   array   $excludes   不需要获得的设置组
     *
     * @return  array
     * get_settings(null, array('5'))
     */
    public function get_settings($groups=null, $excludes=null){   
        include (COMMON_LANGUAGE_PATH . 'Model'.DS.'ShopConfig'.DS.$_SESSION['language'] . '.php');
        //global $_LANG;
        //p($_LANG);die;
        $config_groups = '';
        $excludes_groups = '';
        if (!empty($groups))
        {
            foreach ($groups AS $key=>$val)
            {
                $config_groups .= " AND (id='$val' OR parent_id='$val')";
            }
        }
        if (!empty($excludes))
        {
            foreach ($excludes AS $key=>$val)
            {
                $excludes_groups .= " AND (parent_id<>'$val' AND id<>'$val')";
            }
        }
        /* 取出全部数据：分组和变量 */
        $sql = "SELECT * FROM " . $this->tableFull .
            " WHERE type<>'hidden' $config_groups $excludes_groups ORDER BY parent_id, sort_order, id";
        $item_list=M()->getAll($sql);
        
         /* 整理数据 */
        $group_list = array();
        foreach ($item_list AS $key => $item)
        {
            $pid = $item['parent_id'];
            $item['name'] = isset($_LANG['cfg_name'][$item['code']]) ? $_LANG['cfg_name'][$item['code']] : $item['code'];
            $item['desc'] = isset($_LANG['cfg_desc'][$item['code']]) ? $_LANG['cfg_desc'][$item['code']] : '';
            if ($item['code'] == 'sms_shop_mobile')
            {
                $item['url'] = 1;
            }
            if ($pid == 0)
            {
                /* 分组 */
                if ($item['type'] == 'group')
                {
                    $group_list[$item['id']] = $item;
                }
            }
            else
            {
                /* 变量 */
                if (isset($group_list[$pid]))
                {
                    if ($item['store_range'])
                    {
                         $item['store_options'] = explode(',', $item['store_range']);
                         foreach ($item['store_options'] AS $k => $v)
                         {
                            $item['display_options'][$k] = isset($_LANG['cfg_range'][$item['code']][$v]) ?
                                $_LANG['cfg_range'][$item['code']][$v] : $v;
                         }
                    }
                    $group_list[$pid]['vars'][] = $item;
                }
            }
        }
        return $group_list;
    }
    

}
?>