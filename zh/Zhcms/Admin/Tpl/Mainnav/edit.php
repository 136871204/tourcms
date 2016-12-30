<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>商品ブランド管理</title>
    <zhjs/>
    <js file="__CONTROL_TPL__/js/js.js"/>
</head>
<body>
<div class="wrap">
    <div class="content-nr">
        <div class="web-set">
            <dl>
                <dt>站点：</dt>
                <dd>
                    <list from="$weblist" name="webinfo">
                        <if value="$webinfo.id eq $_GET['webid']">
                            <a class="on" href="{|U:'index',array('webid'=>$webinfo['id'])}">
                        <else>
                            <a  href="{|U:'index',array('webid'=>$webinfo['id'])}">
                        </if>
                        {$webinfo.webname}</a>
                    </list>
                </dd>
            </dl>
        </div>
    </div>
    <div class="menu_list">
        <ul>
            <li><a href="{|U:'index',array('webid'=>$_GET['webid'])}">主导航列表</a></li>
            <li><a href="javascript:;" class="action">修改主导航</a></li>
        </ul>
    </div>
    <div class="title-header">主导航信息</div>
    <form method="post" class="zh-form" onsubmit="return zh_submit(this,'{|U:index,array('webid'=>$_GET['webid'])}')">
        <input type="hidden" name="id" value="{$field.id}"/>
        <input type="hidden" name="webid" value="{$zh.get.webid}"/>
        <table class="table1">
            <tr>
                <th class="w100">导航名称</th>
                <td>
                    <input type="text" name="shortname" class="w300" required=""  value="{$field.shortname}"/>
                </td>
            </tr>
            <tr>
                <th class="w100">排序</th>
                <td>
                    <input type="text" name="displayorder" class="w50" required=""  value="{$field.displayorder}"/>
                </td>
            </tr>
            <tr>
                <th class="w100">链接</th>
                <td>
                    <input type="text" name="url" class="w600"  value="{$field.url}"/>
                </td>
            </tr>
            <tr>
                <th class="w100">显示</th>
                <td>
                    <input type="radio" name="isopen" value="1"  <if value="$field.isopen==1">checked="checked"</if> /> 显示
                    <input type="radio" name="isopen" value="0"  <if value="$field.isopen==0">checked="checked"</if>  /> 不显示
                </td>
            </tr>
            <tr>
                <th class="w100">外部链接</th>
                <td>
                    <input type="radio" name="isexternal" value="1"  <if value="$field.isexternal==1">checked="checked"</if> /> 是
                    <input type="radio" name="isexternal" value="0"  <if value="$field.isexternal==0">checked="checked"</if>  /> 不是
                </td>
            </tr>
        </table>
        <div class="position-bottom">
            <input type="submit" value="確認" class="zh-success"/>
        </div>
    </form>
</div>
</body>
</html>