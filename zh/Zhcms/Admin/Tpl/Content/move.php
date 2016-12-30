<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>文章一括移動</title>
    <zhjs/>
    <js file="__CONTROL_TPL__/js/move.js"/>
    <css file="__CONTROL_TPL__/css/move.css"/>
</head>
<body>
<div class="wrap">
    <div class="title-header">暖かいヒント</div>
    <div class="help" style="margin-bottom:0px;"> Model違う文章は移動できない</div>
    <div class="line"></div>
    <form action="__METH__" method="post" onsubmit="return false" class="zh-form">
    	<input type="hidden" name="mid" value="{$zh.get.mid}"/>
        <input type="hidden" name="cid" value="{$zh.get.cid}"/>
        <table style="table1">
            <tr>
                <td>
                    指定元
                </td>
                <td>
                    目標カテゴリ
                </td>
            </tr>
            <tr>
                <td>
                    <ul class="fromtype">
                        <li>
                            <label><input type="radio" name="from_type" value="1" checked="checked"/> 指定aidから </label>
                        </li>
                        <li>
                            <label> <input type="radio" name="from_type" value="2" /> 指定カテゴリから</label>
                        </li>
                    </ul>
                    <div id="t_aid">
                        <textarea name="aid" class="w250 h180">{$zh.get.aid}</textarea>
                    </div>
                    <div id="f_cat" style="display: none">
                        <select id="fromid" style="width:250px;height:180px;" multiple="multiple" size="2"
                                name="from_cid[]">
                            <list from="$category" name="c">
                                <option value="{$c.cid}" {$c.disabled}>
                                {$c._name}
                                </option>
                            </list>
                        </select>
                    </div>
                </td>
                <td>
                    <select id="fromid" style="width:250px;height:215px;"  size="100"
                            name="to_cid">
                        <list from="$category" name="c">
                            <option value="{$c.cid}" {$c.disabled} {$c.selected}>
                            {$c._name}
                            </option>
                        </list>
                    </select>
                </td>
            </tr>
        </table>
        <div class="position-bottom">
            <input type="submit" class="zh-success" value="確認"/>
            <input type="button" class="zh-cancel" id="close_window" value="閉じる"/>
        </div>
    </form>
</div>
</body>
</html>