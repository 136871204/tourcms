   
//关闭
function close_window() {
    $(parent.document).find("[class*=modal]").remove();
}



//点击确定
$(function () {

    
    
    $("#lnglat_selected").click(function () {
        var lng_value=$("input[name='lng']").val();
        var lat_value=$("input[name='lat']").val();

        //父级input表单
        var _lng_input_obj = $(parent.document).find("[name=" + lng_field_name + "]");
        var _lat_input_obj = $(parent.document).find("[name=" + lat_field_name + "]");
        _lng_input_obj.val(lng_value);
        _lat_input_obj.val(lat_value);
        close_window();
    })
    
    //setiInit();
    
})
