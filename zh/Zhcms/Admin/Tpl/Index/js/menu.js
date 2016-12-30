var menu_cache = {parent: {}, iframe: {}, link: {}};
//���ò˵�����
menu_cache.parent[0] = true;
menu_cache.iframe[0] = true;
//�����������
function get_left_menu(nid) {
    $("div.nav div.top_menu a").removeClass("action");
    var obj = $('a[class=top_menu][nid=' + nid + ']');
    $(obj).addClass("action");
    //��ȡ����
    if (menu_cache.parent[nid]) {
        //�����������˵�
        $("div.left_menu div").hide();
        //��ʾ��ǰ�˵�
        $("div.left_menu div.nid_" + nid).show();
        set_first_action(nid);
    } else {//���治����
        flush_left_menu(nid);
    }
}
/**
 * �������һ���˵�
 */
function set_first_action(nid) {
    //������һ��3���˵����
    var win = top || opener;
    $(win.document).find("div.nid_" + nid).find('a').eq(0).trigger('click');
}
//ˢ�����˵�
function flush_left_menu(nid) {
    $("div.left_menu div.nid_" + nid).remove();
    $.ajax({
        type: "GET",
        url: CONTROL+'&m=getChildMenu',
        data: {pid: nid},
        cache: false,
        success: function (html) {
            menu_cache.parent[nid] = true;
            //�����������˵�
            $("div.left_menu div").hide();
            $("div.left_menu").append(html);
            //������һ��3���˵����
            set_first_action(nid);
        }
    });
}

//����ӵ������
function get_content(obj, nid) {
    //�ı���ʽ
    $("div.left_menu dd a").removeClass("action");
    $(obj).addClass("action");
    //��ȡ����
    show_iframe(nid);
    //�����ʷ����
    add_menu_history(nid, $(obj).text());
    //����λ��
    favorite_menu_position(nid);
}
//��ʾiframe��ʾ����
function show_iframe(nid) {
    //��������iframe
    $("div.top_content iframe").hide();
    if (menu_cache.iframe[nid]) {
        var frm = $("iframe[nid='" + nid + "']");
        frm.show();
    } else {
        var obj = $("a[nid='" + nid + "']");
        var url = $(obj).attr("url");
        var html = '<iframe nid="' + nid + '" src="' + url + "&_=" + Math.random() + '" scrolling="auto" frameborder="0" style="height: 100%;width: 100%;"></iframe>';
        $("div.top_content").append(html);
        //ѹ�뻺��
        menu_cache.iframe[nid] = true;
    }
}
//�����ʷ����
function add_menu_history(nid, title) {
    //�����ڲ˵�ʱ���
    if ($("div.favorite_menu a[nid='" + nid + "']").length == 0) {
        var html = "<li class='action' nid='" + nid + "'>";
        html += "<a href='javascript:;' class='menu' nid='" + nid + "'>" + title + "</a>";
        html += "<a class='close' nid='" + nid + "'>x</a></li>";
        $("div.favorite_menu ul").append(html);
    }
    //���ĵ�ǰ�����ʽ
    $("div.favorite_menu li").removeClass("action");
    $("div.favorite_menu a.menu[nid='" + nid + "']").parent().addClass("action");
}
//��ʷ�������
$(function () {
    $("div.favorite_menu a.menu").live("click", function () {
        //�Ƴ����е������ʽ
        $("div.favorite_menu li").removeClass("action");
        //��ǰ��������Ӽ�action��ʽ
        $(this).parent("li").addClass("action");
        var nid = $(this).attr("nid");
        favorite_menu_position(nid);
        show_iframe(nid);
    })
    //�ر���ʷ����
    $("div.favorite_menu ul li a.close").live("click", function () {
        var nid = $(this).attr("nid");
        //��ʾ��һ��iframe
        $("iframe[nid='" + nid + "']").prev("iframe").show();
        //ɾ���رյ�iframe
        $("iframe[nid='" + nid + "']").remove();
        //�Ƴ�li��ʽaction
        $("div.favorite_menu ul li").removeClass("action");
        //������һ���˵���ʽ
        $(this).parent().prev("li").addClass("action");
        //�Ƴ��˵�
        $(this).parents("li").eq(0).remove();
        //�������
        menu_cache.link[nid] = undefined;
        menu_cache.iframe[nid] = undefined;
    })
})

//������ʷ����λ��
function favorite_menu_position(nid) {
    //ul����
    var ul_obj = $("div.favorite_menu ul");
    var ul_offset = ul_obj.offset();
    var ul_len = 0;
    $("li", ul_obj).each(function (i) {
        ul_len += parseInt($(this).outerWidth());
    })
    var ul_w = ul_obj.width(ul_len + 2);
    //div
    var div_obj = $("div.menu_nav");
    var div_offset = div_obj.offset();
    var div_left = div_offset.left;
    var div_right = div_obj.outerWidth() + div_offset.left;

    //li����
    var li_obj = $("div.favorite_menu ul li[nid='" + nid + "']");
    var li_offset = li_obj.offset();
    var li_left = li_offset.left;
    var li_right = li_left + li_obj.outerWidth();
    //�޸�ul���
    if (li_right > div_right) {
        var _s = li_right - div_right + 18;
        ul_obj.offset({left: ul_offset.left - _s});
    }
    if (li_left < div_left) {
        var _s = div_left - li_left + 18;
        ul_obj.offset({left: ul_offset.left + _s});
    }
    show_iframe(nid);
}

//��ʷ�˵�����
$(function () {
    $("div.direction a.left").click(function () {
        //��һ��li���
        var _li = $("div.favorite_menu li.action").prev();
        //ǰ��û����
        if (_li.length == 0)return;
        $("div.favorite_menu li").removeClass("action");
        _li.addClass("action");
        favorite_menu_position(_li.attr("nid"));
        show_iframe(_li.attr("nid"));
    })
    $("div.direction a.right").click(function () {
        //��һ��li���
        var _li = $("div.favorite_menu li.action").next();
        //ǰ��û����
        if (_li.length == 0)return;
        $("div.favorite_menu li").removeClass("action");
        _li.addClass("action");
        favorite_menu_position(_li.attr("nid"));
        show_iframe(_li.attr("nid"));
    })
})
//˫���ر���ʷ��ǩ
$(function () {
    $("a.menu").live("dblclick", function () {
        $(this).next("a").trigger("click");
    })
})


//�������������������������������������������������������µ�������������������������������������������������������������
/**
 * ���µ���һ�������������
 * @param id �˵�id��
 */
//function update_menu(pid, url) {
//  $.post(WEB + '?a=Menu&c=Menu&m=get_child_menu_id&pid=' + pid, function (sids) {
//      // ids �����Ӳ˵�
//      if (sids.length >= 1) {
//          var win = top || opener;
//          //�����������˵�������Ļ���
//          win.menu_cache.parent[pid] = false;
//          //����������������¼�
//          win.get_left_menu(pid);
//      }
//      //iframe��תurl
//      if (url) {
//          location.href = url;
//      }
//  }, "JSON");
//}
/**
 * ɾ����ʷ������iframe
 * @param nid
 */
function del_history_menu(nid) {
    var win = top || opener;
    //ɾ����ʷ����
    $(win.document).find("div.favorite_menu").find("li[nid='" + nid + "']").remove();
    //ɾ��iframe
    $(win.document).find('iframe[nid=' + nid + ']').remove();
    //���iframe������Ϣ
    if (win.menu_cache.iframe[nid])
        win.menu_cache.iframe[nid] = false;
}
//�������������������������������������������������������µ�������������������������������������������������������������























