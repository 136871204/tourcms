<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>天猫评论采集</title>
    <zhjs/>
    <js file="__CONTROL_TPL__/js/js.js"/>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li><a href="{|U:'Admin/Goods/index'}">商品列表</a></li>
            <li><a href="javascript:;" class="action">天猫评论采集</a></li>
        </ul>
    </div>
    <div class="title-header">天猫评论采集规则</div>
    <form method="post" class="zh-form" action="{|U:comment_preview,array('goods_id'=>$goods_id)}">
        <input type="hidden" name="goods_name" value="{$goods_name}" />
        <table class="table1">
            <tr>
                <th class="w200">淘宝/天猫商品URL：</th>
                <td>
                    <input type="text" name="taourl" id="taourl"   class="w600" value=""/>例如：http://item.taobao.com/item.htm?id=10682890468
                </td>
            </tr>

            <tr>
                <th class="w200">商品关键词过滤：</th>
                <td>
                   <input type="text" name="keyword" id="keyword"   class="w400" value=""/>例如：很好,将评论当中带有'很好'这个字符串的评论提取出来
                </td>
            </tr>
            <tr>
                <th class="w200">系统读取淘宝的页数:</th>
                <td>
                   <input type="text" name="GetNum" id="GetNum" value="3"/>提示：数值越大读取越慢，数值必须大于1
                </td>
            </tr>
            <tr>
                <th class="w200">生成评论的数量:</th>
                <td>
                    <input type="text" name="maxNum" id="maxNum" value="10"/>
                </td>
            </tr>
            <tr>
                <th class="w100">购买记录时间和评价时间之差:</th>
                <td>
                    <input type="text" name="TimeSplit" id="TimeSplit" value="172800"/>*[以秒为单位，默认值为172800 = 2天]
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