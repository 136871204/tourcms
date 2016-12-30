<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>属性管理</title>
    <zhjs/>
    <css file="__CONTROL_TPL__/css/css.css"/>
</head>
<body>
<div class="wrap">
	<form id="search" class="zh-form" onsubmit="return false;">
        <div class="search" id="search">
            Model：
            <select name="mid" class="w100">
                <list from='$model' name="m">
                <option value="{$m.mid}" <if value="$zh.request.mid eq $m.mid">selected=''</if>>{$m.model_name}</option>
                </list>
            </select>
        </div>
    </form>
    <script>
        $("[name='mid']").change(function(){
        	var mid = $(this).val();
           location.href="{|U:'index'}&mid="+mid;
        })
    </script>
    <div class="menu_list">
        <ul>
            <li><a href="javascript:;" class="action">属性管理</a></li>
            <li><a href="{|U:'add',array('mid'=>$_REQUEST['mid'])}">属性新規</a></li>
            <li><a href="javascript:zh_ajax('{|U:updateCache}',{mid:{$zh.request.mid}})">キャッシュ更新</a></li>
        </ul>
    </div>
    <form action="{|U:'edit'}" method="post" id="edit_form" class="zh-form" onsubmit="return zh_submit(this);">
    	<input type="hidden" name="mid" value="{$zh.request.mid}" />
        <table class="table2">
            <thead>
            <tr>
                <td class="w30">fid</td>
                <td>属性名称</td>
                <td width="50">操作</td>
            </tr>
            </thead>
            <tbody>
            <list from="$flag" name="name">
                <tr>
                    <td class="w100">
                        {$name}
                    </td>
                    <td>
                        <input type="text" name="flag[]" value="{$name}"/>
                    </td>
                    <td>
                            <a href="javascript:;"
                               onclick="if(confirm('属性削除しますか？'))zh_ajax('{|U:del}',{mid:{$zh.get.mid},number:<?php echo $zh['list']['name']['index'] - 1; ?>})">削除
                               </a>
                    </td>
                </tr>
            </list>
            </tbody>
        </table>
        <div class="position-bottom">
            <input type="submit" class="zh-success" id="updateSort" value="修正"/>
        </div>
    </form>
</div>
</body>
</html>