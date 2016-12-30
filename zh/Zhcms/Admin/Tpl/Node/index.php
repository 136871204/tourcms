<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>{$zh.language.admin_node_index_page_title}</title>
    <zhjs/>
    <js file="__CONTROL_TPL__/js/js.js"/>
    <css file="__CONTROL_TPL__/css/css.css"/>
    <script>
    var admin_node_js_check_message1='{$zh.language.admin_node_js_check_message1}';
    var admin_node_js_update_order_error1='{$zh.language.admin_node_js_update_order_error1}';
    </script>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li><a href="javascript:;" class="action">{$zh.language.admin_node_index_page_tab1}</a></li>
            <li><a href="{|U:'add',array('pid'=>0)}">{$zh.language.admin_node_index_page_tab2}</a></li>
            <li><a href="javascript:zh_ajax('{|U:update_cache}');">{$zh.language.admin_node_index_page_tab3}</a></li>
        </ul>
    </div>
    <table class="table2 hd-form form-inline">
        <thead>
        <tr>
            <td class="w50">{$zh.language.admin_node_index_page_table_column_header1}</td>
            <td class="w50">{$zh.language.admin_node_index_page_table_column_header2}</td>
            <td>{$zh.language.admin_node_index_page_table_column_header3}</td>
            <td>{$zh.language.admin_node_index_page_table_column_header4}</td>
            <td class="w80">{$zh.language.admin_node_index_page_table_column_header5}</td>
            <td class="w150">{$zh.language.admin_node_index_page_table_column_header6}</td>
        </tr>
        </thead>
        <list from="$node" name="n">
            <tr <if value="$n.pid eq 0">class="top"</if>>
                <td>
                    <input type="text" class="w30" value="{$n.list_order}" name="list_order[{$n.nid}]"/>
                </td>
                <td>{$n.nid}</td>
                <td>
                    <if value="$n.pid eq 0 && Data::hasChild(cache('node'),$n.nid)">
                        <img src="__STATIC__/image/contract.gif" action="2" class="explodeCategory"/>
                    </if>
                    <if value="$n.pid eq 0">
                        <strong>{$n._name}</strong>
                        <else/>
                        {$n._name}
                    </if>
                </td>
                <td>
                    <if value="$n.state==1">
                        {$zh.language.admin_node_index_page_table_column_show1}
                        <else>
                        {$zh.language.admin_node_index_page_table_column_show2}
                    </if>
                </td>
                <td>
                    <if value="$n.type==1">
                        {$zh.language.admin_node_index_page_table_column_show3}
                        <else>
                        {$zh.language.admin_node_index_page_table_column_show4}
                    </if>
                </td>
                <td style="text-align: right">
                    <if value="$n._level==3">
                        <span class="disabled">{$zh.language.admin_node_index_page_table_operator1}  | </span>
                    <else>
                        <a href="{|U('add',array('pid'=>$n['nid']))}">{$zh.language.admin_node_index_page_table_operator1}</a> |
                    </if>

                    <if value="$n.is_system==0">
                        <a href="{|U('edit',array('nid'=>$n['nid']))}">{$zh.language.admin_node_index_page_table_operator2}</a> |
                        <a href="javascript:if(confirm('{$zh.language.admin_node_index_page_confirm_delete}'))zh_ajax('{|U:del}',{nid:{$n.nid}})">{$zh.language.admin_node_index_page_table_operator3}</a>
                    <else/>
                         <span class="disabled">{$zh.language.admin_node_index_page_table_operator2} | </span>
                         <span class="disabled">{$zh.language.admin_node_index_page_table_operator3}</span>
                    </if>
                </td>
            </tr>
        </list>
    </table>
    <br /><br /><br /><br />
</div>
<div class="position-bottom">
    <input type="button" class="zh-success" value="{$zh.language.admin_node_index_page_form_update_order}" onclick="update_order();"/>
</div>
<style type="text/css">
    img.explodeCategory {
        cursor: pointer;
    }
</style>
<script>
    //展开栏目
    $(".explodeCategory").click(function () {
        var action = parseInt($(this).attr("action"));
        var tr = $(this).parents('tr').eq(0);
        switch (action) {
            case 1://展示
                $(tr).nextUntil('.top').show();
                $(this).attr('action', 2);
                $(this).attr('src', "__STATIC__/image/contract.gif");
                break;
            case 2://收缩
                $(tr).nextUntil('.top').hide();
                $(this).attr('action', 1);
                $(this).attr('src', "__STATIC__/image/explode.gif");
                break;
        }
    })
    //关闭栏目子栏目（隐藏子栏目）
    $(".explodeCategory").trigger('click');
    //全部收起子栏目
    function explodeCategory() {
        $(".explodeCategory").each(function (i) {
            $(this).trigger('click');
        })
    }
</script>

</body>
</html>