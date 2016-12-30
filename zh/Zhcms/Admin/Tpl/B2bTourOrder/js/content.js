//点击input表单实现 全选或反选
$(function () {
    //全选
    $("input#select_all").click(function () {
        $("[type='checkbox']").attr("checked", $(this).attr("checked") == "checked");
    })
})
//全选文章
function select_all() {
    $("[type='checkbox']").attr("checked", "checked");
}
//反选文章
function reverse_select() {
    $("[type='checkbox']").attr("checked", function () {
        return !$(this).attr("checked") == 1;
    });
}
//更新排序
function order(mid,cid) {
    if ($("input[type='text']").length == 0) {
        alert('ソートする文章がない！');
        return false;
    }
    var data = $("input[type='text']").serialize();
    zh_ajax(CONTROL + "&m=order&mid="+mid+"&cid=" + cid, data);
}
/**
 * 删除文章
 * @param mid
 * @param cid
 * @param aid
 */
function del(mid,cid,aid) {
    //单文章删除
    if (aid) {
        var ids = {aid: aid}
    } else {//多文章删除
        var aids = $("input:checked").serialize();
    }
    if (aids) {
        if (confirm("文章削除しますか?")) {
            $.ajax({
                type: "POST",
                url: CONTROL + "&m=del" + "&mid=" + mid+"&cid="+cid,
                dataType: "JSON",
                cache: false,
                data: aids,
                success: function (data) {
                    if (data.state == 1) {
                        $.dialog({
                            message: data.message,
                            type: "success",
                            close_handler: function () {
                                location.href = URL;
                            }
                        });
                    } else {
                        $.dialog({
                            message: data.message,
                            type: "error",
                            close_handler: function () {
                                location.href = URL;
                            }
                        });
                    }
                }
            })
        }
    } else {
        alert("削除したい文章を選択してください");
    }
}
//设置状态
function audit(mid,cid, state) {
    //单文章删除
    var ids = $("input:checked").serialize();
    if (ids) {
        $.ajax({
            type: "POST",
            url: CONTROL + "&m=audit" + "&content_state=" + state + "&mid="+mid+"&cid=" + cid,
            dataType: "JSON",
            cache: false,
            data: ids,
            success: function (data) {
                if (data.state == 1) {
                    $.dialog({
                        message: data.message,
                        type: "success",
                        close_handler: function () {
                            location.href = URL;
                        }
                    });
                } else {
                    $.dialog({
                        message: data.message,
                        type: "error",
                        close_handler: function () {
                            location.href = URL;
                        }
                    });
                }
            }
        })
    } else {
        alert("設置する文章を選択してください");
    }
}
/**
 * 移动文章
 * @param mid 模型mid
 * @param cid 当前栏目
 */
function move(mid,cid) {
    var aid = '';
    $("input[name*=aid]:checked").each(function (i) {
        aid += $(this).val() + "|";
    })
    aid = aid.slice(0, -1);
    if (aid) {
        $.modal({
            width: 600, height: 420,
            title: '文章移動',
            content: '<iframe style="width: 100%;height: 99%;" src="' + CONTROL + '&m=move&mid='+mid+'&cid=' + cid + '&aid=' + aid + '" frameborder="0"></iframe>'
        })
    } else {
        alert("移動する文章を選択してください");
    }
}

//区域弹出层
function select_treeselect(table,title_field,id_field,self_title,self_id)
{
    var url =WEB + "?a=Admin&c=TreeSelect&m=select&table="+table+"&title_field="+title_field+"&id_field="+id_field+"&self_title="+self_title+"&self_id="+self_id;
    //alert(url);
    $.modal({
		title : '区域',
		width : 650,
		height : 500,
		content : '<iframe frameborder=0 style="height:99%;border:none;" src="'+url+'"></iframe>'
	});
}


/**
 * 外部数据选择
 * @param input_id
 */
function select_exterior(table,pk,showf,showt,wherestr,select_type,field_name) {
    
    var url=APP + '&c=ExteriorSelect&m=select&table=' + table + '&pk=' + pk + '&showf=' + showf + '&showt=' + showt + '&wherestr=' + wherestr + '&select_type=' + select_type + '&field_name=' + field_name + '&value=' + $("[name=" + field_name + "]").val();
    //alert(url);
	$.modal({
		title : '外部データ選択',
		width : 650,
		height : 400,
		content : '<iframe frameborder=0 scrolling="no" style="height:99%;border:none;" src="' + url + '"></iframe>'
	});
}











