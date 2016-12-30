<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>商品ブランド管理</title>
    <zhjs/>
    <js file="__CONTROL_TPL__/js/js.js"/>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
                <li><a href="{|U:'index'}" class="action">商品ブランド一覧</a></li>
                <li><a href="{|U:'add'}">商品ブランド新規</a></li>
        </ul>
    </div>
    <table class="table2 zh-form">
        <thead>
        <tr>
            <td class="w30">brand_id</td>
            <td class="w100">ログ画像</td>
            <td class="w200">名称</td>
            <td class="w200">ホームページ</td>
            <td class="w150">紹介</td>
            <td class="w150">ソート順</td>
            <td class="w150">表示</td>
            <td class="w150">操作</td>
        </tr>
        </thead>
        <list from="$brand" name="b">
            <tr>
                <td>{$b.brand_id}</td>
                <td>
                    <a href="{$b.brand_logo}" target="_blank">
                        <img src="{$b.brand_logo}" class="w60 h30" title="クリックして、プレビュー図を見る" onmouseover="view_image(this)"/>
                    </a>
                </td>
                <td>{$b.brand_name}</td>
                <td><a href="{$b.site_url}" target="_blank">{$b.site_url}</a></td>
                <td>{$b.brand_desc|mb_substr:@@,0,36,'utf8'}...</td>
                <td>{$b.sort_order}</td>
                <td>
                    <if value="$b.is_show==1">
                        <img src="__CONTROL_TPL__/img/yes.gif" />
                    <else>
                        <img src="__CONTROL_TPL__/img/no.gif" />
                    </if>
                </td>
                <td>
				    <a href="{|U:'edit',array('brand_id'=>$b['brand_id'])}">
				        修正
				    </a>|
                    <a href="javascript:confirm('削除しますか')?zh_ajax('{|U:del}',{brand_id:{$b.brand_id}}):void(0);">削除</a>
                    
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