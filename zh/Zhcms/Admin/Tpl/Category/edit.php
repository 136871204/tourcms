<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>{$zh.language.admin_category_edit_page_title}</title>
    <zhjs/>
    <js file="__CONTROL_TPL__/js/addEdit.js"/>
        <script>
    var admin_category_add_edit_js_form_message1='{$zh.language.admin_category_add_edit_js_form_message1}';
    var admin_category_add_edit_js_form_message2='{$zh.language.admin_category_add_edit_js_form_message2}';
    var admin_category_add_edit_js_form_message3='{$zh.language.admin_category_add_edit_js_form_message3}';
    var admin_category_add_edit_js_form_message4='{$zh.language.admin_category_add_edit_js_form_message4}';
    var admin_category_add_edit_js_form_message5='{$zh.language.admin_category_add_edit_js_form_message5}';
    var admin_category_add_edit_js_form_message6='{$zh.language.admin_category_add_edit_js_form_message6}';
    var admin_category_add_edit_js_form_message7='{$zh.language.admin_category_add_edit_js_form_message7}';
    var admin_category_add_edit_js_form_message8='{$zh.language.admin_category_add_edit_js_form_message8}';
    var admin_category_add_edit_js_form_message9='{$zh.language.admin_category_add_edit_js_form_message9}';
    var admin_category_add_edit_js_form_message10='{$zh.language.admin_category_add_edit_js_form_message10}';
    var admin_category_add_edit_js_form_message11='{$zh.language.admin_category_add_edit_js_form_message11}';
    var admin_category_add_edit_js_form_message12='{$zh.language.admin_category_add_edit_js_form_message12}';
    var admin_category_add_edit_js_form_message13='{$zh.language.admin_category_add_edit_js_form_message13}';
    var admin_category_add_edit_js_form_message14='{$zh.language.admin_category_add_edit_js_form_message14}';
    var admin_category_add_edit_js_form_message15='{$zh.language.admin_category_add_edit_js_form_message15}';
    var admin_category_add_edit_js_form_message16='{$zh.language.admin_category_add_edit_js_form_message16}';
    var admin_category_add_edit_js_form_message17='{$zh.language.admin_category_add_edit_js_form_message17}';
    var admin_category_add_edit_js_form_message18='{$zh.language.admin_category_add_edit_js_form_message18}';
    var admin_category_add_edit_js_form_message19='{$zh.language.admin_category_add_edit_js_form_message19}';
    var admin_category_add_edit_js_form_message20='{$zh.language.admin_category_add_edit_js_form_message20}';
    var admin_category_add_edit_js_form_message21='{$zh.language.admin_category_add_edit_js_form_message21}';
    var admin_category_add_edit_js_form_message22='{$zh.language.admin_category_add_edit_js_form_message22}';
    var admin_category_add_edit_js_form_message23='{$zh.language.admin_category_add_edit_js_form_message23}';
    var admin_category_add_edit_js_form_message24='{$zh.language.admin_category_add_edit_js_form_message24}';
    var admin_category_add_edit_js_form_message25='{$zh.language.admin_category_add_edit_js_form_message25}';
    var admin_category_add_edit_js_form_message26='{$zh.language.admin_category_add_edit_js_form_message26}';
    var admin_category_add_edit_js_form_message27='{$zh.language.admin_category_add_edit_js_form_message27}';
    var admin_category_add_edit_js_select_template_message1='{$zh.language.admin_category_add_edit_js_select_template_message1}';
    var admin_category_add_edit_js_select_template_message2='{$zh.language.admin_category_add_edit_js_select_template_message2}';
    </script>
</head>
<body>
<form action="{|U:edit}" method="post" class="zh-form" onsubmit="return zh_submit(this,'{|U:index}')">
    <input type="hidden" value="{$field.cid}" name="cid"/>
    <div class="wrap">
        <div class="menu_list">
            <ul>
                <li><a href="{|U:'index'}">{$zh.language.admin_category_edit_page_tab1}</a></li>
                <li><a href="javascript:;" class="action">{$zh.language.admin_category_edit_page_tab2}</a></li>
            </ul>
        </div>
        <input type="hidden" name="mid" value="{$field.mid}"/>
        <div class="tab">
            <ul class="tab_menu">
                <li lab="base"><a href="#">{$zh.language.admin_category_edit_page_form_tab1}</a></li>
                <li lab="tpl"><a href="#">{$zh.language.admin_category_edit_page_form_tab2}</a></li>
                <li lab="html"><a href="#">{$zh.language.admin_category_edit_page_form_tab3}</a></li>
                <li lab="seo"><a href="#">{$zh.language.admin_category_edit_page_form_tab4}</a></li>
                <li lab="access"><a href="#">{$zh.language.admin_category_edit_page_form_tab5}</a></li>
                <li lab="charge"><a href="#">{$zh.language.admin_category_edit_page_form_tab6}</a></li>
            </ul>
            <div class="tab_content">
                <div id="base">
                    <table class="table1">
                        <tr>
                            <th class="w100">{$zh.language.admin_category_edit_page_form_tab1_item2}</th>
                            <td>
                                <select name="pid">
                                    <option value="0">{$zh.language.admin_category_edit_page_form_tab1_item2_message1}</option>
                                    <list from="$category" name="c">
                                        <option value="{$c.cid}"
                                        {$c.selected} {$c.disabled}>
                                        {$c._name}
                                        </option>
                                    </list>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>{$zh.language.admin_category_edit_page_form_tab1_item3}</th>
                            <td>
                                <input type="text" name="catname" value="{$field.catname}" class="w300" required=""/>
                            </td>
                        </tr>
                        <tr>
                            <th>{$zh.language.admin_category_edit_page_form_tab1_item4}</th>
                            <td>
                                <label>
                                    <input type="radio" name="cattype" value="1" <if value="$field.cattype==1">checked="checked"</if>/> {$zh.language.admin_category_edit_page_form_tab1_item4_message1}
                                </label>
                                <label>
                                    <input type="radio" name="cattype" value="2" <if value="$field.cattype==2">checked="checked"</if>/> {$zh.language.admin_category_edit_page_form_tab1_item4_message2}
                                </label>
                                <label>
                                    <input type="radio" name="cattype" value="3" <if value="$field.cattype==3">checked="checked"</if>/> {$zh.language.admin_category_edit_page_form_tab1_item4_message3}
                                </label>
                                <label><input type="radio" name="cattype" value="4" <if value="$field.cattype==4">checked="checked"</if>/>{$zh.language.admin_category_edit_page_form_tab1_item4_message4}</label>
                            </td>
                        </tr>
                        <tr>
                            <th>{$zh.language.admin_category_edit_page_form_tab1_item5}</th>
                            <td>
                                <input type="text" name="catdir" value="{$field.catdir}" class="w300" required=""/>
                            </td>
                        </tr>
                        <tr>
                            <th>{$zh.language.admin_category_edit_page_form_tab1_item6}</th>
                            <td>
                                <input type="text" name="cat_redirecturl" value="{$field.cat_redirecturl}" class="w300"/>
                            </td>
                        </tr>
                        <tr>
                            <th>{$zh.language.admin_category_edit_page_form_tab1_item7}</th>
                            <td>
                                <label>
                                    <input type="radio" name="cat_url_type" value="1" <if value="$field.cat_url_type==1">checked="checked"</if>/> {$zh.language.admin_category_edit_page_form_tab1_item7_message1}
                                </label>
                                <label>
                                    <input type="radio" name="cat_url_type" value="2" <if value="$field.cat_url_type==2">checked="checked"</if>/> {$zh.language.admin_category_edit_page_form_tab1_item7_message2}
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th>{$zh.language.admin_category_edit_page_form_tab1_item8}</th>
                            <td>
                                <label>
                                    <input type="radio" name="arc_url_type" value="1" <if value="$field.arc_url_type==1">checked="checked"</if>/> {$zh.language.admin_category_edit_page_form_tab1_item8_message1}
                                </label>
                                <label>
                                    <input type="radio" name="arc_url_type" value="2" <if value="$field.arc_url_type==2">checked="checked"</if>/> {$zh.language.admin_category_edit_page_form_tab1_item8_message2}
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th>{$zh.language.admin_category_edit_page_form_tab1_item9}</th>
                            <td>
                                <label>
                                    <input type="radio" name="cat_show" value="1" <if value="$field.cat_show==1">checked="checked"</if>/> {$zh.language.admin_category_edit_page_form_tab1_item9_message1}
                                </label>
                                <label>
                                    <input type="radio" name="cat_show" value="0" <if value="$field.cat_show==0">checked="checked"</if>/> {$zh.language.admin_category_edit_page_form_tab1_item9_message2}
                                </label>
                                <span class="validate-message">{$zh.language.admin_category_edit_page_form_tab1_item9_message3}&lt;channel&gt;{$zh.language.admin_category_edit_page_form_tab1_item9_message4}</span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div id="tpl" class="con">
                    <table class="table1">
                        <tr>
                            <th class="w100">{$zh.language.admin_category_edit_page_form_tab2_item1}</th>
                            <td>
                                <input type="text" name="index_tpl" required="" class="w200" id="index_tpl" value="{$field.index_tpl}"
                                       onclick="select_template('index_tpl')" readonly="" onfocus="select_template('index_tpl');"/>
                                <button type="button" class="zh-cancel" onclick="select_template('index_tpl')">{$zh.language.admin_category_edit_page_form_tab2_item1_message1}</button>
                                <span id="zh_index_tpl"></span>
                            </td>
                        </tr>
                        <tr>
                            <th>{$zh.language.admin_category_edit_page_form_tab2_item2}</th>
                            <td>
                                <input type="text" name="list_tpl" required="" id="list_tpl" class="w200" value="{$field.list_tpl}"
                                       onclick="select_template('list_tpl')" readonly="" onfocus="select_template('list_tpl');"/>
                                <button type="button" class="zh-cancel" onclick="select_template('list_tpl')">{$zh.language.admin_category_edit_page_form_tab2_item2_message1}</button>
                                <span id="zh_list_tpl"></span>
                            </td>
                        </tr>
                        <tr>
                            <th>{$zh.language.admin_category_edit_page_form_tab2_item3}</th>
                            <td>
                                <input type="text" name="arc_tpl" required="" id="arc_tpl" class="w200" value="{$field.arc_tpl}"
                                       onclick="select_template('arc_tpl')" readonly="" onfocus="select_template('arc_tpl');"/>
                                <button type="button" class="zh-cancel" onclick="select_template('arc_tpl')">{$zh.language.admin_category_edit_page_form_tab2_item3_message1}</button>
                                <span id="zh_arc_tpl"></span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div id="html" class="con">
                    <table class="table1">
                        <tr>
                            <th class="w100">{$zh.language.admin_category_edit_page_form_tab3_item1}</th>
                            <td>
                                <input type="text" name="cat_html_url" required="" class="w300" value="{$field.cat_html_url}"/>
                                <span id="zh_cat_html_url"></span>
                            </td>
                        </tr>
                        <tr>
                            <th>{$zh.language.admin_category_edit_page_form_tab3_item2}</th>
                            <td>
                                <input type="text" name="arc_html_url" required="" class="w300" value="{$field.arc_html_url}"/>
                                <span id="zh_arc_html_url"></span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div id="seo">
                    <table class="table1">
                        <tr>
                            <th>{$zh.language.admin_category_edit_page_form_tab4_item1}</th>
                            <td>
                                <input type="text" name="cat_keyworks" value="{$field.cat_keyworks}" class="w350"/>
                            </td>
                        </tr>
                        <tr>
                            <th>{$zh.language.admin_category_edit_page_form_tab4_item2}</th>
                            <td>
                                <textarea name="cat_description" class="w350 h100">{$field.cat_description}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <th class="w100">{$zh.language.admin_category_edit_page_form_tab4_item3}</th>
                            <td>
                                <input type="text" name="cat_seo_title" value="{$field.cat_seo_title}" class="w350"/>
                            </td>
                        </tr>
                        <tr>
                            <th>{$zh.language.admin_category_edit_page_form_tab4_item4}</th>
                            <td>
                                <textarea name="cat_seo_description" class="w400 h150">{$field.cat_seo_description}</textarea>
                            </td>
                        </tr>
                    </table>
                </div>

                <div id="access">
                    <table class="table1">
                        <tr>
                            <th class="w100">
                                {$zh.language.admin_category_edit_page_form_tab5_item1}
                            </th>
                            <td>
                                <label><input type="radio" name="member_send_state" value="1" <if value="$field.member_send_state eq 1">checked=""</if>/> YES </label>
                                <label><input type="radio" name="member_send_state" value="0" <if value="$field.member_send_state eq 0">checked=""</if>/> NO </label>
                            </td>
                        </tr>
                    </table>
                    <table class="table1">
                        <tr>
                            <th class="w100">
                                {$zh.language.admin_category_edit_page_form_tab5_item2}
                            </th>
                            <td>
                                <table class="table2">
                                    <thead>
                                    <tr>
                                        <td class="w250">{$zh.language.admin_category_edit_page_form_tab5_item2_message1}</td>
                                        <td>{$zh.language.admin_category_edit_page_form_tab5_item2_message2}</td>
                                        <td>{$zh.language.admin_category_edit_page_form_tab5_item2_message3}</td>
                                        <td>{$zh.language.admin_category_edit_page_form_tab5_item2_message4}</td>
                                        <td>{$zh.language.admin_category_edit_page_form_tab5_item2_message5}</td>
                                        <td>{$zh.language.admin_category_edit_page_form_tab5_item2_message6}</td>
                                        <td>{$zh.language.admin_category_edit_page_form_tab5_item2_message7}</td>
                                        <td>{$zh.language.admin_category_edit_page_form_tab5_item2_message8}</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <list from="$access.admin" name="r">
                                        <tr>
                                            <td>
                                                <a href="javascript:" onclick="select_access_checkbox(this)">{$r.rname}</a>
                                                <input type="hidden" name="access[{$r.rid}][rid]" value="{$r.rid}"/>
                                                <input type="hidden" name="access[{$r.rid}][admin]" value="1"/>
                                            </td>
                                            <td><input type="checkbox" name="access[{$r.rid}][show]" value="1" <if value="$r.show">checked=""</if>/></td>
                                            <td><input type="checkbox" name="access[{$r.rid}][add]" value="1" <if value="$r.add">checked=""</if>/></td>
                                            <td><input type="checkbox" name="access[{$r.rid}][edit]" value="1" <if value="$r.edit">checked=""</if>/></td>
                                            <td><input type="checkbox" name="access[{$r.rid}][del]" value="1" <if value="$r.del">checked=""</if>/></td>
                                            <td><input type="checkbox" name="access[{$r.rid}][order]" value="1" <if value="$r.order">checked=""</if>/></td>
                                            <td><input type="checkbox" name="access[{$r.rid}][move]" value="1" <if value="$r.move">checked=""</if>/></td>
                                            <td><input type="checkbox" name="access[{$r.rid}][audit]" value="1" <if value="$r.audit">checked=""</if>/></td>
                                        </tr>
                                    </list>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <th class="w100">
                                {$zh.language.admin_category_edit_page_form_tab5_item3}
                            </th>
                            <td>
                                <table class="table2">
                                    <thead>
                                    <tr>
	                                    <td class="w250">{$zh.language.admin_category_edit_page_form_tab5_item3_message1}</td>
	                                    <td>{$zh.language.admin_category_edit_page_form_tab5_item3_message2}</td>
	                                    <td>{$zh.language.admin_category_edit_page_form_tab5_item3_message3}</td>
	                                    <td>{$zh.language.admin_category_edit_page_form_tab5_item3_message4}</td>
	                                    <td>{$zh.language.admin_category_edit_page_form_tab5_item3_message5}</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <list from="$access.user" name="r">
                                        <tr>
                                            <td>
                                                <a href="javascript:" onclick="select_access_checkbox(this)">{$r.rname}</a>
                                                <input type="hidden" name="access[{$r.rid}][rid]" value="{$r.rid}"/>
                                                <input type="hidden" name="access[{$r.rid}][admin]" value="0"/>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="access[{$r.rid}][show]" value="1" <if value="$r.show">checked=""</if>/>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="access[{$r.rid}][add]" value="1" <if value="$r.add">checked=""</if>/>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="access[{$r.rid}][edit]" value="1" <if value="$r.edit">checked=""</if>/>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="access[{$r.rid}][del]" value="1" <if value="$r.del">checked=""</if>/>
                                            </td>
                                        </tr>
                                    </list>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>

                <div id="charge">
                    <table class="table1">
                        <tr>
                            <th class="w100">{$zh.language.admin_category_edit_page_form_tab6_item1}</th>
                            <td>
                                <label><input type="radio" name="allow_user_set_credits" value="1" <if value="$field.allow_user_set_credits eq 1">checked=""</if>/> {$zh.language.admin_category_edit_page_form_tab6_item1_message1}</label>
                                <label><input type="radio" name="allow_user_set_credits" value="0" <if value="$field.allow_user_set_credits eq 0">checked=""</if>/> {$zh.language.admin_category_edit_page_form_tab6_item1_message2}</label>
                                <span class="validate-message">
                                    {$zh.language.admin_category_edit_page_form_tab6_item1_message3}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th class="w100">{$zh.language.admin_category_edit_page_form_tab6_item2}</th>
                            <td>
                                <input type="text" name="add_reward" required="" class="w100" value="{$field.add_reward}"/> {$zh.language.admin_category_edit_page_form_tab6_item2_message1}
                                <span id="zh_add_reward"></span>
                            </td>
                        </tr>
                        <tr>
                            <th class="w100">{$zh.language.admin_category_edit_page_form_tab6_item3}</th>
                            <td>
                                <input type="text" name="show_credits" required="" class="w100" value="{$field.show_credits}"/> {$zh.language.admin_category_edit_page_form_tab6_item3_message1}
                                <span id="zh_show_credits"></span>
                            </td>
                        </tr>
                        <tr>
                            <th class="w100">{$zh.language.admin_category_edit_page_form_tab6_item4}</th>
                            <td>
                                <input type="text" name="repeat_charge_day" required="" class="w100" value="{$field.repeat_charge_day}"/> {$zh.language.admin_category_edit_page_form_tab6_item4_message1}
                                <span id='zh_repeat_charge_day'>

                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="position-bottom">
        <input type="submit" class="zh-success" value="{$zh.language.admin_category_edit_page_form_submit}"/>
        <input type="button" class="zh-cancel" value="{$zh.language.admin_category_edit_page_form_cancel}" onclick="location.href='__CONTROL__'"/>
    </div>
</form>
</body>
</html>