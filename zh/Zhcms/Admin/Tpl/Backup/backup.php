<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>DBバクアプ</title>
    <zhjs/>
    <js file="__CONTROL_TPL__/js/backup.js"/>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li><a href="{|U:'Backup/index'}">バクアプ一覧</a></li>
            <li><a href="javascript:;" class="action">DBバクアプ</a></li>
        </ul>
    </div>
    <form action="{|U:'backup_db'}" method="post"  class="zh-form" onsubmit="return backup();">
        <table class="table2">
            <thead>
            <tr>
                <td width="50">DBバクアプ</td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td width="50">
                    <table class="table">
                        <tr>
                            <td class="w100">分卷サイズ</td>
                            <td>
                                <input type="text" class="w150" name="size" value="200"/> KB
                            </td>
                        </tr>
                        <tr>
                            <td class="w100"></td>
                            <td>
                                <label>
                                    <input type="checkbox" name="structure" value="1" checked="checked">
                                    バックアップテーブル構造
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="w100">&nbsp;</td>
                            <td>
                                <input type="submit" class="zh-cancel" value="バックアップ開始"/>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
        <table class="table2">
            <thead>
            <tr>
                <td width="50">
                    <label><input type="checkbox" class="s_all_ck"/> 全选</label>
                </td>
                <td>テーブル名</td>
                <td>タイプ</td>
                <td>コード</td>
                <td>レコード数</td>
                <td>使用空間</td>
                <td>かけら</td>
                <td width="200">操作</td>
            </tr>
            </thead>
            <tbody>
            <list from="$table.table" name="t">
                <tr>
                    <td>
                        <input type="checkbox" name="table[]" value="{$t.tablename}"/>
                    </td>
                    <td>{$t.tablename}</td>
                    <td>{$t.engine}</td>
                    <td>{$t.charset}</td>
                    <td>{$t.rows}</td>
                    <td>{$t.size}</td>
                    <td>{$t.data_free|default:0}</td>
                    <td>
                        <a href="javascript:zh_ajax('{|U:optimize}',{table:['{$t.tablename}']})">最適化</a> |
                        <a href="javascript:zh_ajax('{|U:repair}',{table:['{$t.tablename}']})">修復</a>
                    </td>
                </tr>
            </list>
            </tbody>
        </table>
    </form>
</div>
<div class="position-bottom">
    <input type="button" class="zh-cancel" onclick="select_all('.table2')" value="全て選択"/>
    <input type="button" class="zh-cancel" onclick="reverse_select('.table2')" value="反选"/>
    <input type="button" class="zh-cancel" onclick="optimize()" value="一括最適化"/>
    <input type="button" class="zh-cancel" onclick="repair()" value="一括修復"/>
</div>
</body>
</html>