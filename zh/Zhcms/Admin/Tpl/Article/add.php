<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>添加新文章</title>
    <zhjs/>
    <js file="__CONTROL_TPL__/js/js.js"/>
    <script src='__STATIC__/js/utils.js'></script>
    <script type="text/javascript" src="__STATIC__/js/selectzone.js"></script>
    <script src='__STATIC__/js/transport.js'></script>
    <script src='__STATIC__/js/json2.js'></script>
    
    <script>
    var not_allow_add="系统保留分类，不允许在该分类添加文章";
    </script>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li><a href="{|U:'index'}">文章列表</a></li>
            <li><a href="javascript:;" class="action">添加新文章</a></li>
        </ul>
    </div>
    <div class="title-header">新文章信息</div>
    <form method="post" class="zh-form"  name="theForm"  enctype="multipart/form-data">
        <div class="tab">
            <ul class="tab_menu">
                <li lab="general-tab"><a href="#">通用信息</a></li>
                <li lab="detail-tab"><a href="#">文章内容</a></li>
                <li lab="goods-tab"><a href="#">管理商品</a></li>
            </ul>
            <div class="tab_content">
                <div id="general-tab">
                    <table class="table1">
                        <tr>
                            <td>文章标题</td>
                            <td>
                            <input type="text" name="title" class="w400"  maxlength="60" value="{$article.title|htmlspecialchars:@@}" />
                            </td>
                        </tr>
                        <if value="$article.cat_id egt 0">
                        <tr>
                            <td>文章分类</td>
                            <td>
                                <select name="article_cat" onchange="catChanged()">
                                <option value="0">请选择...</option>
                                {$cat_select}
                              </select>
                            </td>
                        </tr>
                        <else>
                        <input type="hidden" name="article_cat" value="-1" />
                        </if>
                        <if value="$article.cat_id egt 0">
                        <tr>
                            <td>文章重要性</td>
                            <td>
                                <input type="radio" name="article_type" value="0" <if value="$article.article_type eq 0">checked</if> />
                                普通
                                <input type="radio" name="article_type" value="1" <if value="$article.article_type eq 1">checked</if> />
                                置顶 
                            </td>
                        </tr>
                        <tr>
                            <td class="narrow-label">是否显示</td>
                            <td>
                                <input type="radio" name="is_open" value="1" <if value="$article.is_open eq 1">checked</if> /> 显示 
                                <input type="radio" name="is_open" value="0" <if value="$article.is_open eq 0">checked</if> /> 不显示
                            </td>
                        </tr>
                        <else>
                        <tr style="display:none">
                            <td colspan="2">
                                <input type="hidden" name="article_type" value="0" />
                                <input type="hidden" name="is_open" value="1" />
                            </td>
                        </tr>
                        </if>
                        <tr>
                            <td class="narrow-label">文章作者</td>
                            <td><input type="text" name="author" maxlength="60" value="{$article.author|htmlspecialchars:@@}" /></td>
                        </tr>
                        <tr>
                            <td class="narrow-label">作者email</td>
                            <td><input type="text" name="author_email" maxlength="60" value="{$article.author_email|htmlspecialchars:@@}" /></td>
                        </tr>
                        <tr>
                            <td class="narrow-label">关键字</td>
                            <td><input type="text" name="keywords" maxlength="60" value="{$article.keywords|htmlspecialchars:@@}" /></td>
                        </tr>
                        <tr>
                            <td class="narrow-label">网页描述</td>
                            <td><textarea name="description" id="description" cols="40" rows="5">{$article.description|htmlspecialchars:@@}</textarea></td>
                        </tr>
                        <tr>
                            <td class="narrow-label">外部链接</td>
                            <td>
                                <input name="link_url" type="text" id="link_url" value="<if value="$article.link neq ''">{$article.link|htmlspecialchars:@@}<else>http://</if>" maxlength="60" />
                            </td>
                        </tr>
                        <tr>
                            <td class="narrow-label">上传文件</td>
                            <td>
                                <input type="file" name="file"/>
                                <span class="narrow-label">或输入文件地址
                                 <input name="file_url" type="text" value="{$article.file_url|htmlspecialchars:@@}" class="w300" maxlength="255" />
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div id="detail-tab">
                    <table width="90%" id="detail-table"   class="table1">
                      <tr>
                        <td>
                        <ueditor name="FCKeditor1" content="{$goods.FCKeditor1}" />
                        </td>
                      </tr>
                    </table>
                </div>
                <div id="goods-tab">
                    <table width="90%" id="goods-table" class="table1">
                        <tr>
                            <td colspan="5">
                                <img src="__STATIC__/image/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
                                <!-- 分类 -->
                                <select name="cat_id">
                                    <option value="0">所有分类</caption>
                                    {$goods_cat_list}
                                </select>
                                <!-- 品牌 -->
                                <select name="brand_id">
                                    <option value="0">所有品牌</option>
                                    <html_options  options="{$brand_list}"  >
                                </select>
                                <!-- 关键字 -->
                                <input type="text" name="keyword"  class="w300"  size="30" />
                                <input type="button" value="搜索" onclick="searchGoods()" class="button" />
                            </td>
                        </tr>
                        <!-- 商品列表 -->
                        <tr>
                            <th></th>
                            <th>操作</th>
                            <th></th>
                        </tr>
                        <tr>
                            <td width="45%" align="center">
                                <select name="source_select" size="20" style="width:90%" ondblclick="sz.addItem(false, 'add_link_goods', articleId)" multiple="true">
                                </select>
                            </td>
                            <td align="center">
                                <p><input type="button" value="&gt;&gt;" onclick="sz.addItem(true, 'add_link_goods', articleId)" class="button" /></p>
                                <p><input type="button" value="&gt;" onclick="sz.addItem(false, 'add_link_goods', articleId)" class="button" /></p>
                                <p><input type="button" value="&lt;" onclick="sz.dropItem(false, 'drop_link_goods', articleId)" class="button" /></p>
                                <p><input type="button" value="&lt;&lt;" onclick="sz.dropItem(true, 'drop_link_goods', articleId)" class="button" /></p>
                            </td>
                            <td width="45%" align="center">
                                <select name="target_select" multiple="true" size="20" style="width:90%" ondblclick="sz.dropItem(false, 'drop_link_goods', articleId)">
                                    <foreach from="$goods_list" value="$goods" >
                                        <option value="{$goods.goods_id}">{$goods.goods_name}</option>
                                    </foreach>
                                </select>
                            </td>
                        </tr>
                        
                    </table>
                </div>
            </div>        
        </div>
        
        <div class="position-bottom">
            <input type="submit" value="確認" class="zh-success"/>
        </div>
    </form>
</div>
<script>
var articleId = 0;
var elements  = document.forms['theForm'].elements;
var sz        = new SelectZone(1, elements['source_select'], elements['target_select'], '');


function searchGoods()
{
    var elements  = document.forms['theForm'].elements;
    var filters   = new Object;

    filters.cat_id = elements['cat_id'].value;
    filters.brand_id = elements['brand_id'].value;
    filters.keyword = Utils.trim(elements['keyword'].value);

    //alert($.toJSON(filters));
    sz.loadOptions('get_goods_list', filters);
}

/**
 * 选取上级分类时判断选定的分类是不是底层分类
 */
function catChanged()
{
  var obj = document.forms['theForm'].elements['article_cat'];

  cat_type = obj.options[obj.selectedIndex].getAttribute('cat_type');
  if (cat_type == undefined)
  {
    cat_type = 1;
  }

  if ((obj.selectedIndex > 0) && (cat_type == 2 || cat_type == 4))
  {
    alert(not_allow_add);
    obj.selectedIndex = 0;
    return false;
  }

  return true;
}
</script>
</body>
</html>