<?php

/**
 * 后台rbac权限管理
 * Class AccessControl
 * @author 周鸿 <136871204@qq.com>
 */
class AccessControl extends AuthControl
{

    //设置权限
    public function edit()
    {
    	$Model = K('Access');
        if (IS_POST) {
            $rid = Q("post.rid");
            $Model->where(array("rid" => $rid))->del();
            if (!empty($_POST['nid'])) {
                foreach ($_POST['nid'] as $v) {
                    $Model->add(
                        array("rid" => $rid, "nid" => $v)
                    );
                }
            }
            $this->success(L('admin_access_control_edit_success'));
        } else {
            $rid = Q("rid",0,'intval');
            $sql = "SELECT n.nid,n.title,n.pid,n.type,a.rid as access_rid FROM ".C("DB_PREFIX")."node AS n LEFT JOIN 
            			(SELECT * FROM (SELECT * FROM ".C("DB_PREFIX")."access WHERE rid=$rid) AS aa)AS a
                		ON n.nid = a.nid ORDER BY list_order ASC";
            $result = $Model->query($sql);
            foreach ($result as $n => $r) {
            	//有权限或不需要验证的节点
                $checked = $r['access_rid'] ||$r['type']==2? " checked=''" : '';
                //type 类型 1 权限控制菜单 2 普通菜单 
                $disabled=$r['type']==2?'disabled=""':'';
                $result[$n]['checkbox'] = "<label><input type='checkbox' name='nid[]' value='{$r['nid']}' $checked $disabled/> {$r['title']}</label>";
            }
            $this->access = Data::channelLevel($result, 0, '-', 'nid');
            $this->rid = $rid;
            $this->display();
        }
    }
}