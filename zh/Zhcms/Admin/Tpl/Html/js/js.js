//更改模型后
$(function () {
    $("#mid").change(function () {
        var mid = $(this).val();
        var html = "<option selected='selected' value='0'>カテゴリ制限なし</option>";
        var attr='';
        for (var i in category) {
            //外部链接(在跳转Url处填写网址) 单页面(直接发布文章，如:公司简介)这样的不生成
        	if(category[i].cattype!=1 && category[i].cattype!=2){
        		continue;
        	}
            if (mid != 0 && category[i].mid != mid) {
                continue;
            }
            html += "<option value='" + category[i].cid + "' >" + category[i]._name + "</option>";
        }
        $("#cid").html(html);
        //开启或关闭详细选项选项
        if (mid == 0) {
            $("tr:gt(2)").hide();
        } else {
            $("tr:gt(2)").show();
        }
    })
    $("#mid").trigger("change");
})
//更新
function form_submit(type) {
    var html = "<input type='hidden' name='type' value='" + type + "'/>";
    //验证
    switch (type) {
        case "new":
            if (!$.trim($("[name='total_row']").val())) {
                alert("最新発表件数は必須");
                return false;
            }
            break;
        case "time":
            var start_time = $.trim($("[name='start_time']").val());
            var end_time = $.trim($("[name='end_time']").val());
            if (!start_time || !end_time) {
                alert("開始時間　或いは　終時間は必須");
                return false;
            }
            break;
        case "id":
            var start_id = $.trim($("[name='start_id']").val());
            var end_id = $.trim($("[name='end_id']").val());
            if (!start_id || !end_id) {
                alert("開始ID　或いは　最終IDは必須");
                return false;
            }
            break;
    }
    $("form").append(html);
    $("form").trigger("submit");
}