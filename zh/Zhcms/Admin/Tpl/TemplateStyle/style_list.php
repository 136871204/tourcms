<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>{$zh.language.admin_template_style_style_list_page_title}</title>
    <zhjs/>
    <js file="__CONTROL_TPL__/js/style_list.js"/>
    <css file="__CONTROL_TPL__/css/style_list.css"/>
</head>
<body>
<div class="wrap" style="bottom: 0px;">
    <div class="title-header">{$zh.language.admin_template_style_style_list_page_section1_title}</div>
    <div class="help">
        <!--TODO：模板页面，和视频教程 之后运营的时候在制作-->
        <p>1. {$zh.language.admin_template_style_style_list_page_section1_content1} <a href="http://www.metaphase.co.jp" class="action" target="_blank">{$zh.language.admin_template_style_style_list_page_section1_content2}</a></p>
        <p>2. {$zh.language.admin_template_style_style_list_page_section1_content3}</p>
    </div>
    <div class="title-header">{$zh.language.admin_template_style_style_list_page_section2_title}</div>
    <div class="help">
        <p>{$zh.language.admin_template_style_style_list_page_section2_content1} >>><a href="http://www.metaphase.co.jp" target="_blank">{$zh.language.admin_template_style_style_list_page_section2_content2}</a></p>
    </div>
    <div class="tpl-list">
        <ul>
            <list from="$style" name="t">
                <li <if value="$t.current==1">class="active current"</if>>
                    <img src="{$t.template_img}" width="260"/>
                    <h2>{$t.name}</h2>
                    <p>{$zh.language.admin_template_style_style_list_page_list_title1}: {$t.author}</p>
                    <p>{$zh.language.admin_template_style_style_list_page_list_title2}: {$t.email}</p>
                    <p>{$zh.language.admin_template_style_style_list_page_list_title3}: {$t.dir_name}</p>

                    <div class="link">
                        <if value="$t.current neq 1">
                            <a href="javascript:;" class="btn" attr='select_tpl' onclick="zh_ajax('{|U:select_style}',{dir_name:'{$t.dir_name|basename}'})">{$zh.language.admin_template_style_style_list_page_list_title4}</a>
                       <else/>
                        <strong>{$zh.language.admin_template_style_style_list_page_list_title5}</strong>
                        </if>
                    </div>
                </li>
            </list>
        </ul>
    </div>
</div>
</body>
</html>