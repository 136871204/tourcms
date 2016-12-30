<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>主导航管理</title>
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
            <li><a href="{|U:'index',array('webid'=>$_GET['webid'])}" class="action">主导航列表</a></li>
            <li><a href="{|U:'add',array('webid'=>$_GET['webid'])}">添加主导航</a></li>
        </ul>
    </div>
    
    <table class="table2 zh-form">
        <thead>
        <tr>
            <td class="w30">排序</td>
            <td class="w100">导航名称</td>
            <td class="w200">链接</td>
            <td class="w150">显示</td>
            <td class="w150">外部链接</td>
            <td class="w150">操作</td>
        </tr>
        </thead>
        <list from="$mainnav" name="nav">
            <tr>
                <td>{$nav.displayorder}</td>
                <td>{$nav.shortname}</td>
                <td>{$nav.url}</td>
                <td>
                    <if value="$nav.isopen==1">
                        <img src="__CONTROL_TPL__/img/yes.gif" />
                    <else>
                        <img src="__CONTROL_TPL__/img/no.gif" />
                    </if>
                </td>
                <td>
                    <if value="$nav.isexternal==1">
                        <img src="__CONTROL_TPL__/img/yes.gif" />
                    <else>
                        <img src="__CONTROL_TPL__/img/no.gif" />
                    </if>
                </td>
                <td>
                    <a href="{|U:'edit',array('id'=>$nav['id'],'webid'=>$_GET['webid'])}">
				        修改
				    </a>|
                    <a href="javascript:confirm('是否删除')?zh_ajax('{|U:del}',{id:{$nav.id}}):void(0);">删除</a>
                </td>
            </tr>
        </list>
    </table>
    <div class="page1">
        {$page}
    </div>
    <div class="h60"></div>
</div>
</body>
</html>