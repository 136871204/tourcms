//------------------------------------------全选与反选  checkbox
$(function () {
    //checkbox选择
    $(".s_all_ck").click(function () {
        $("input[name*='table']").attr("checked", !!$(this).attr("checked"));
    })
})
//备份数据库
function backup() {
     if ($("[name*='table']:checked").length == 0) {
        alert("テーブル選択してください");
        return false;
    }
    return true;
}

//检查有没有选择备份目录
function check_select_table() {
    if ($("[name*='table']:checked").length == 0) {
        alert("テーブル選択してください");
        return false;
    }
    return true;
}

//优化表
function optimize() {
    if (check_select_table()) {
        zh_ajax(CONTROL + '&m=optimize', $("[name*='table']:checked").serialize());
    }
}
//修复表
function repair() {
    if (check_select_table()) {
        zh_ajax(CONTROL + '&m=repair', $("[name*='table']:checked").serialize());
    }
}