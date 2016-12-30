<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>目的地</title>
    <zhjs/>

    
    <js file="__STATIC__/tour/js/jquery-1.8.3.min.js"/>
    <js file="__STATIC__/tour/js/common.js"/>
    <js file="__STATIC__/tour/js/jquery.hotkeys.js"/>
    <js file="__STATIC__/tour/js/msgbox/msgbox.js"/>
    <js file="__STATIC__/tour/js/extjs/ext-all.js"/>
    <js file="__STATIC__/tour/js/extjs/locale/ext-lang-zh_CN.js"/>
    <link type="text/css" href="__STATIC__/tour/js/msgbox/msgbox.css" rel="stylesheet" />
    <link type="text/css" href="__STATIC__/tour/css/common.css" rel="stylesheet"/>
    <link type="text/css" href="__STATIC__/tour/js/extjs/resources/ext-theme-neptune/ext-theme-neptune-all-debug.css" rel="stylesheet"/>
    

   <script>
    
    </script>
    
    <link type="text/css" href="__STATIC__/tour/css/style.css" rel="stylesheet"/>
    <link type="text/css" href="__STATIC__/tour/css/base.css" rel="stylesheet"/>
    <link type="text/css" href="__STATIC__/tour/css/base2.css" rel="stylesheet"/>
    <link type="text/css" href="__STATIC__/tour/css/plist.css" rel="stylesheet"/>   
    <link type="text/css" href="__STATIC__/tour/js/extjs/resources/ext-theme-neptune/ext-theme-neptune-all-debug.css" rel="stylesheet"/>   
    <script type="text/javascript" src="__STATIC__/tour/js/uploadify/jquery.uploadify.min.js?t=2081955"></script>
    <script type="text/javascript" src="__STATIC__/tour/js/listimageup.js"></script>
    <script type="text/javascript" src="__STATIC__/tour/js/common.js"></script>   
    <link type="text/css" href="__STATIC__/tour/js/uploadify/uploadify.css" rel="stylesheet"/>
    
    <style>
    /* line 221, ../../../ext-theme-neutral/sass/src/tree/Panel.scss */
.x-tree-node-text {
	color:#666;
  font-size: 16px;
  line-height: 30px;
  padding-left: 4px;
}
    </style>
</head>
<body>
<div class="wrap content-rt-td">
    <div  class="search-bar filter" id="search_bar" >
        <span class="tit ml-10">筛选</span>
        <div class="pro-search ml-10" style=" float:left; margin-top:5px">
            <input type="text" id="searchkey" value="目的地名称" datadef="目的地名称" class="sty-txt1 set-text-xh wid_200"/>
            <input type="button" value="搜索" class="sty-btn1 default-btn wid_60" onclick="searchDest()" />
            
        </div>
        <span class="display-mdd">
              <a href="javascript:void(0);" onClick="togMod(this,0,'全局目的地')" <?php  if($typeid==0) echo 'class="on"';   ?>>全局</a>
              <a href="javascript:void(0);" onClick="togMod(this,1,'线路目的地')" <?php  if($typeid==1) echo 'class="on"';   ?>>线路</a>
              
    </div>
    <div id="line_grid_panel" class="content-nrt">
        <div id="dest_tree_panel" class="content-nrt">
        </div>
        <div class="panel_bar">
            <a class="abtn" href="javascript:;" onClick="chooseAll()">全选</a>
            <a class="abtn" href="javascript:;" onClick="chooseDiff()">反选</a>
            <a class="abtn" href="javascript:;" onClick="delDest()">删除</a>
        </div>
    </div>
</div>
<script>
SITEURL="__WEB__";
window.display_mode ={$typeid};
var typename_json={type1:'线路',type2:'酒店',type3:'租车',type4:'攻略',type5:'景点',type6:'相册',type13:'团购'}

Ext.onReady(
    function () {

        $("#searchkey").focusEffect();
        //目的地store
        window.dest_store = Ext.create('Ext.data.TreeStore', {
            fields: [
                {name: 'displayorder',
                    sortType: sortTrans

                },
                {name: 'isopen',
                    sortType: sortTrans

                },
                {name: 'isnav',
                    sortType: sortTrans

                },
                {name: 'ishot',
                    sortType: sortTrans
                },
                {
                    name: 'istopnav',
                    sortType: sortTrans
                },
                {
                    name: 'iswebsite',
                    sortType: sortTrans
                },
                {
                    name: 'pinyin',
                    sortType: sortPinyin
                },
                {name: 'id', convert: function (v, record) {
                    return 'dest_' + v;
                }},
                'kindname',
                'pid',
                'seotitle',
                'keyword',
                'description',
                'tagword',
                'jieshao',
                'kindtype',
                'isfinishseo',
                'templetpath',
                'litpic',
                'piclist',
                'issel',
                'shownum',
                'templet'

            ],
            proxy: {
                type: 'ajax',
                extraParams: {typeid: window.display_mode},
                api: {
                    read: SITEURL+'?g=Zhcms&a=Admin&c=destination&m=destination&action=read',  //读取数据的URL
                    update: SITEURL+'?g=Zhcms&a=Admin&c=destination&m=destination&action=save',
                    destroy: SITEURL+'?g=Zhcms&a=Admin&c=destination&m=destination&action=delete'
                },
                reader: 'json'
            },
            autoLoad: true,
            listeners: {
                sort: function (node, childNodes, eOpts) {

                },
                load:function( store, records, successful, eOpts )
                {
                    if(!successful){
                        ST.Util.showMsg("{__('norightmsg')}",5,1000);
                    }


                }
            }

        });

        window.sel_model = Ext.create('Ext.selection.CheckboxModel');

        //目的地panel
        window.dest_treepanel = Ext.create('Ext.tree.Panel', {
            store: dest_store,
            rootVisible: false,
            padding: '2px',
            renderTo: 'dest_tree_panel',
            border: 0,
            style: 'border:0px;',
            width: "100%",
            bodyBorder: 0,
            bodyStyle: 'border-width:0px',
            scroll:'vertical',


            listeners: {
                itemmousedown: function (node, record, item, index, e, eOpts) {
                    var x = e.xy[0];
                    var column_x = Ext.getCmp('dest_name').getX();
                    var column_width = Ext.getCmp('dest_name').getWidth();

                    if (x < column_x || x > column_x + column_width)
                        return false;

                    window.node_moving = true;

                },
                sortchange: function (ct, column, direction, eOpts) {

                    window.sort_direction = direction;

                    var field = column.dataIndex;
                    if (field == 'kindname')
                        field = 'pinyin';
                    window.dest_store.sort(field, direction);

                },
                celldblclick: function (view, td, cellIndex, record, tr, rowIndex, e, eOpts) {

                    if (record.get('displayorder') == 'add')
                        return false;
                },
                afterlayout: function (panel) {
                    
                    var data_height = panel.getView().getEl().down('.x-grid-table').getHeight();

                    var height = Ext.dom.Element.getViewportHeight();

                    // console.log(data_height+'---'+height);
                    if (data_height > height - 120) {
                        window.has_biged = true;
                        panel.height = height - 120;
                    }
                    else if (data_height < height - 120) {
                        if (window.has_biged) {
                            delete panel.height;
                            window.has_biged = false;
                            window.dest_treepanel.doLayout();
                        }
                    }

                }


            },
            viewConfig: {
                forceFit: true,
                border: 0,
                plugins: {
                    ptype: 'treeviewdragdrop',
                    enableDrag: true,
                    enableDrop: true,
                    displayField: 'kindname'
                },

                listeners: {
                    boxready: function () {

                        var height = Ext.dom.Element.getViewportHeight();

                        this.up('treepanel').maxHeight = height - 120;
                        this.up('treepanel').doLayout();
                    },

                    beforedrop: function (node, data, overModel, dropPosition, dropHandlers) {
                        if (dropPosition != 'append') {
                            dropHandlers.processDrop();
                            return;
                        }

                        if (overModel.isLoaded())
                            dropHandlers.processDrop();
                        else {

                            overModel.expand(false, function () {
                                dropHandlers.processDrop();
                            });
                        }

                        dropHandlers.cancelDrop();


                    },
                    drop: function (node, data, overModel, dropPosition, eOpts) {

                        var params = {};
                        params['moveid'] = data.records[0].get('id');
                        params['overid'] = overModel.get('id');
                        params['position'] = dropPosition;
                        params['moveid'] = params['moveid'].substr(params['moveid'].indexOf('_') + 1);
                        params['overid'] = params['overid'].substr(params['overid'].indexOf('_') + 1);


                        if (dropPosition == 'append') {

                            var btn_node = window.dest_store.getNodeById(params['overid'] + 'add');
                            overModel.insertBefore(data.records[0], btn_node);

                        }

                        //alert(overModel.children);
                        Ext.Ajax.request({
                            url: SITEURL+'?g=Zhcms&a=Admin&c=destination&m=destination&action=drag',
                            params: params,
                            method: 'POST',
                            success: function (response) {
                                var text = response.responseText;
                                if (text == 'ok') {

                                } else {

                                }
                                // process server response here
                            }
                        });

                    }
                }

            },
            columns: [
                {
                    text: '<span class="grid_column_text">选择</span>',
                    width: '8%',
                    dataIndex: 'issel',
                    tdCls: 'dest-al-mid',
                    xtype: 'templatecolumn',
                    align: 'center',
                    draggable: false,

                    tpl: new Ext.XTemplate(
                        '{[this.realName(values.id,values.issel)]}',
                        {
                            realName: function (id, issel) {
                                if (id.indexOf('add') > 1)
                                    return '';
                                id = id.substr(id.indexOf('_') + 1);
                                // var ischecked=issel?"checked='checked'":'';
                                return "<input type='checkbox' class='dest_check' value='" + id + "' style='cursor:pointer' onclick='togCheck(" + id + ")'/>";
                            }
                        }
                    )
                },
                {
                    text: '<span class="grid_column_text">排序</span>',
                    dataIndex: 'displayorder',
                    //  tdCls:'dest-al-mid',
                    width: '5%',
                    xtype: 'templatecolumn',

                    editor: 'textfield',
                    draggable: false,
                    tpl: new Ext.XTemplate(
                        '{[this.realName(values.displayorder)]}',
                        {
                            realName: function (order) {
                                //alert(order);
                                if (order == '9999' || order == 'add')
                                    return '';
                                else
                                    return order;
                            }
                        }
                    )

                },
                {
                    xtype: 'treecolumn',   //有展开按钮的指定为treecolumn
                    text: '<span class="grid_column_text">目的地</span>',
                    dataIndex: 'kindname',
                    id: 'dest_name',
                    locked: false,
                    width: '22%',
                    editor: 'textfield'
                },
                {
                    text: '<span class="grid_column_text">开启/关闭</span>',
                    dataIndex: 'isopen',
                    width: '14%',
                    xtype: 'actioncolumn',
                    tdCls: 'dest-al-mid',
                    align: 'center',

                    items: [
                        {
                            getClass: function (v, meta, rec) {          // Or return a class from a function

                                var id = rec.get('id');
                                if (id.indexOf('add') > 0)
                                    return '';
                                if (v == 1)
                                    return 'dest-status-ok';
                                else
                                    return 'dest-status-none';
                            },
                            handler: function (view, index, colindex, itm, e, record) {
                                // alert(itm);
                                //  var val=record.get('isopen');
                                togStatus(null, record, 'isopen');


                            }
                        }
                    ]
                },
                {
                    text: '<span class="grid_column_text">首页显示</span>',
                    dataIndex: 'isnav',
                    width: '22%',
                    xtype: 'actioncolumn',
                    tdCls: 'dest-al-mid',
                    align: 'center',
                    border: 0,

                    items: [
                        {
                            getClass: function (v, meta, rec) {          // Or return a class from a function
                                var id = rec.get('id');
                                if (id.indexOf('add') > 0)
                                    return '';
                                if (v == 1)
                                    return 'dest-status-ok';
                                else
                                    return 'dest-status-none';
                            },
                            handler: function (view, index, colindex, itm, e, record) {
                                // alert(itm);
                                //  var val=record.get('isopen');
                                togStatus(null, record, 'isnav');


                            }
                        }
                    ]
                },
                {
                    text: '<span class="grid_column_text">是否热门</span>',
                    dataIndex: 'ishot',
                    width: '22%',
                    xtype: 'actioncolumn',
                    tdCls: 'dest-al-mid',
                    align: 'center',
                    items: [
                        {
                            getClass: function (v, meta, rec) {          // Or return a class from a function
                                var id = rec.get('id');
                                if (id.indexOf('add') > 0)
                                    return '';
                                if (v == 1)
                                    return 'dest-status-ok';
                                else
                                    return 'dest-status-none';
                            },
                            handler: function (view, index, colindex, itm, e, record) {
                                // alert(itm);
                                //  var val=record.get('isopen');
                                togStatus(null, record, 'ishot');


                            }
                        }
                    ]
                },
                
                {
                    text: '<span class="grid_column_text">管理</span>',
                    dataIndex: 'id',
                    width: '10%',
                    tdCls: 'dest-al-mid',
                    xtype: 'templatecolumn',
                    sortable: false,

                    tpl: new Ext.XTemplate(
                        '{[this.realName(values.id,values.pid,values.iswebsite)]}',
                        {
                            realName: function (id,pid,iswebsite) {
                                if (id.indexOf('add') > 1)
                                    return '';
                                var delhtml = '';
                                if(id != 36 && id!=37)
                                {
                                     delhtml = '&nbsp;&nbsp;<a href="javascript:;" onclick="delSingle(\''+id+'\',\''+iswebsite+'\')">删除</a>';
                                }

                                return delhtml;
                            }
                        }
                    ),
                    listeners: {
                        afterrender: function (obj, eopts) {

                            if (window.display_mode != 0)
                                obj.hide();
                            else
                                obj.show();
                        }
                    }

                },
                {
                    text: '<span class="grid_column_text">管理</span>',
                    dataIndex: 'id',
                    width: '21%',
                    tdCls: 'dest-al-mid',
                    xtype: 'templatecolumn',
                    sortable: false,
                    align: 'center',
                    border: 0,

                    tpl: new Ext.XTemplate(
                        '{[this.realName(values.id)]}',
                        {
                            realName: function (id) {
                                if (id.indexOf('add') > 1)
                                    return '';
                                return '<a href="javascript:;" onclick="destProductSet(\'' + id + '\')">优化设置</a>'
                            }
                        }
                    ),
                    listeners: {
                        afterrender: function (obj, eopts) {

                            if (window.display_mode != 0)
                                obj.show();
                            else
                                obj.hide();
                        }
                    }

                }
            ],
            plugins: [
                Ext.create('Ext.grid.plugin.CellEditing', {
                    clicksToEdit: 2,
                    listeners: {
                        beforeEdit:function(editor,e){
                            if(window.display_mode!=0 && e.field!='displayorder') //排除非主目的地的编辑
                            return false;
                        },
                        edit: function (editor, e) {

                            var pinyin = e.record.get('pinyin');
                            e.record.save({params: {field: e.field,pinyin:pinyin}});
                            e.record.commit();

                        }
                    }
                })
            ]
        });


    }
);

Ext.getBody().on('mouseup', function () {
    window.node_moving = false;

    //console.log('up_'+window.node_moving);
});
Ext.getBody().on('mousemove', function (e, t, eOpts) {

    if (window.node_moving == true) {
        // console.log('mov_'+window.node_moving);

        var tree_view = window.dest_treepanel.down('treeview');
        var view_y = tree_view.getY();
        var view_bottom = view_y + tree_view.getHeight();
        var mouse_y = e.getY();
        if (mouse_y < view_y)
            tree_view.scrollBy(0, -5, false);
        if (mouse_y > view_bottom)
            tree_view.scrollBy(0, 5, false);

    }
});

Ext.EventManager.onWindowResize(function () {
    var height = Ext.dom.Element.getViewportHeight();
    var data_height = window.dest_treepanel.getView().getEl().down('.x-grid-table').getHeight();
    if (data_height > height - 120)
        window.dest_treepanel.height = (height - 120);
    else
        delete window.dest_treepanel.height;
    window.dest_treepanel.doLayout();
})



function addSub(pid) {
    var precord = pid == 0 ? window.dest_store.getRootNode() : window.dest_store.getNodeById(pid);
    var addnode = window.dest_store.getNodeById(pid + 'add');

    Ext.Ajax.request({
        method: 'post',
        url: CONTROL +'&m=destination&action=addsub',
        params: {pid: pid},
        success: function (response) {
            var newrecord = Ext.decode(response.responseText);

            var view_el = window.dest_treepanel.getView().getEl()
            var scroll_top = view_el.getScrollTop();

            precord.insertBefore(newrecord, addnode);

            //view_el.scroll('t',scroll_top);
        }
    });

}

function sortTrans(val) {
    //alert('111'+val);
    if (!window.sort_direction)
        return window.parseInt(val);
    else {

        if (val == 'add') {
            if (window.sort_direction == 'ASC')
                return 100000000000000000;
            else
                return -10;
        }
        else
            return window.parseInt(val);
    }
    // alert(val);
}

function sortPinyin(val) {

    if (!window.sort_direction)
        return val;
    else {
        if (val == 'add') {
            if (window.sort_direction == 'ASC')
                return 1000000000000;
            else
                return 1;
        }
        else {
            if (!val)
                return 555555555555;
            else {
                val.toLowerCase();
                var num1 = val.charCodeAt(0);
                var num2 = val.charCodeAt(1);
                if (isNaN(num2))
                    num2 = '000';
                if (num2 < 100)
                    num2 = '0' + num2;

                var num3 = val.charCodeAt(2);
                if (isNaN(num3))
                    num3 = '000';
                if (num3 < 100)
                    num3 = '0' + num3;

                var num4 = val.charCodeAt(3);
                if (isNaN(num4))
                    num4 = '000';
                if (num4 < 100)
                    num4 = '0' + num4;

                var result = window.parseInt(num1 + '' + num2 + '' + num3 + '' + num4);

               // console.log(val + '_' + result);
                return result;
            }
        }
    }
}


function togStatus(obj, record, field) {

    var val = record.get(field);
    var id = record.get('id');
    id = id.substr(id.indexOf('_') + 1);
    var newval = val == 1 ? 0 : 1;
    Ext.Ajax.request({
        url: CONTROL +'&m=destination&action=update',
        method: "POST",
        datatype: "JSON",
        params: {id: id, field: field, val: newval, typeid: window.display_mode},
        success: function (response, opts) {
            if (response.responseText == 'ok') {
                record.set(field, newval);
                record.commit();
            }
        }});

}

function chooseAll() {
    var check_cmp = Ext.query('.dest_check');
    for (var i in check_cmp) {
        if (!Ext.get(check_cmp[i]).getAttribute('checked'))
            check_cmp[i].click();
    }

    //  window.sel_model.selectAll();
}
function chooseDiff() {
    var check_cmp = Ext.query('.dest_check');
    for (var i in check_cmp)
        check_cmp[i].click();
    //var records=window.sel_model.getSelection();
    //window.sel_model.selectAll(true);

    //	window.sel_model.deselect(records,true);

    //var
}


function delDest() {
    Ext.Msg.confirm("提示", "确定删除", function (buttonId) {

        if (buttonId == 'no')
            return;
        var check_cmp = Ext.select('.dest_check:checked');
        check_cmp.each(
            function (el, c, index) {

                window.dest_store.getNodeById(el.getValue()).destroy();

            }
        );
    });

}



//模块列表
var model_list = {
    mod_1: '线路',
    mod_2: '酒店',
    mod_3: '租车',
    mod_4: '攻略',
    mod_5: '景点',
    mod_6: '相册',
    mod_13: '团购'
}
//切换模块
function togMod(obj, num,title) {
    window.display_mode = num;
    Ext.get(obj).parent().select("a.on").removeCls('on');
    Ext.get(obj).addCls('on');
    for (var i in window.dest_treepanel.columns) {
        window.dest_treepanel.columns[i].fireEvent('afterrender', window.dest_treepanel.columns[i]);
    }
    window.dest_store.getProxy().setExtraParam('typeid', num);
    window.dest_store.load();
    $("#position").html(title);
    if(num!=0)
    {
        $(".panel_bar").hide();
        $(".dest_check").hide();

    }
    else
    {
        $(".panel_bar").show();
        $(".dest_check").show();
    }


}


//删除目的地
function delSingle(id,iswebsite)
{

    if(iswebsite==1){
        ST.Util.showMsg('当前目的地已经设置成子站,不能删除!',5);
        return;
    }
    id = id.substr(id.indexOf('_') + 1);
    Ext.Msg.confirm("提示","当前目的地和下级目的地都将被删除,确定删除吗？",function(buttonId){
        if(buttonId=='yes')
            window.dest_store.getById(id.toString()).destroy();
    })
}

function searchDest() {

    var s_str = Ext.get('searchkey').getValue();
    //s_str=s_str.trim();
    Ext.select('.search-dest-tr').removeCls('search-dest-tr');
    if (!s_str)
        return;
    Ext.Ajax.request({
        url: CONTROL+'&m=destination&action=search',
        params: {keyword: s_str},
        method: 'POST',
        success: function (response) {


            var text = response.responseText;
            if (text == 'no') {
                ST.Util.showMsg('未找到与'+s_str+'相关的目的地',5,1000);
                //Ext.Msg.alert('查询结果', "未找到与'" + s_str + "'相关的目的地");
            } else {
                var list = Ext.decode(text);
                var index = 0;
                for (var i in list) {

                    var dest = list[i];
                    cascadeDest(dest, index);
                    index++;
                }
            }
            // process server response here
        }
    });

}

function cascadeDest(dest, index) {
    if (dest.length == 1) {
        var node = window.dest_store.getNodeById(dest[0]);
        var ele = window.dest_treepanel.getView().getNode(node);
        if (ele) {

            var edom = Ext.get(ele);
            edom.addCls('search-dest-tr');
            if (index == 0)
                viewScroll(edom);
        }
    }
    else {
        var node = window.dest_store.getNodeById(dest[0]);
        dest.shift();
        node.expand(false, function () {
            cascadeDest(dest, index);
        });

    }
}
function viewScroll(extdom)   //在treeview里滚动
{
    var tree_view = window.dest_treepanel.getView();
    var view_y = tree_view.getY();
    var dom_y = extdom.getY();


    window.setTimeout(function () {
        window.first_scroll = true;
        extdom.scrollIntoView(tree_view.getEl());
    }, 450);
    //else
    // extdom.scrollIntoView(tree_view.getEl());


}
</script>
</body>
</html>