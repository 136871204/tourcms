<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
		<title>商店设置</title>
		<zhjs/>
	</head>
	<body>
    <form action="{|U:index}" method="post" class="zh-form" onsubmit="return zh_submit(this)">
		<div class="wrap">
            <div class="title-header">商店设置</div>
            <br />
			<div class="tab">
                <ul class="tab_menu">
                    <list from="$group_list" name="group">
                        <li lab="{$group.code}"><a href="#">{$group.name}</a></li>
                    </list>
                </ul>
                <div class="tab_content">
                    <list from="$group_list" name="group">
                        <div id="{$group.code}">
                            <table width="90%" id="{$group.code}-table"  class="table1" >
                            <list from="{$group.vars}" name="var">
                                <tr>
                                    <td class="label" valign="top">
                                        <if value="{$var.desc}">
                                            <a href="javascript:showNotice('notice{$var.code}');" title="{$lang.form_notice}">
                                                <img src="__STATIC__/image/notice.gif" width="16" height="16" border="0" alt="{$lang.form_notice}" />
                                            </a>
                                        </if>
                                        {$var.name}:
                                    </td>
                                    <td>
                                        <if value="{$var.type} eq 'text' ">
                                            <input name="value[{$var.id}]" type="text" value="{$var.value}" size="40" />
                                        <elseif value="{$var.type} eq 'password' ">
                                            <input name="value[{$var.id}]" type="password" value="{$var.value}" size="40" />
                                        <elseif value="{$var.type} eq 'textarea' ">
                                            <textarea name="value[{$var.id}]" cols="40" rows="5">{$var.value}</textarea>
                                        <elseif value="{$var.type} eq 'select' ">
                                            <list from="{$var.store_options}" name="opt">
                                                <label for="value_{$var.id}_{$key}">
                                                    <input type="radio" name="value[{$var.id}]" id="value_{$var.id}_{$k}" value="{$opt}"
                                                        <if value="{$var.value} eq {$opt} ">
                                                            checked="true"
                                                        </if>
                                                        <if value="{$var.code} eq {$rewrite} ">
                                                            onclick="return ReWriterConfirm(this);"
                                                        </if>
                                                        <if value="{$var.code} eq 'smtp_ssl' and {$opt}  eq 1 ">
                                                            onclick="return confirm('{$lang.smtp_ssl_confirm}');"
                                                        </if>
                                                        <if value="{$var.code} eq 'enable_gzip' and {$opt}  eq 1 ">
                                                            onclick="return confirm('{$lang.gzip_confirm}');"    
                                                        </if>
                                                        <if value="{$var.code} eq 'retain_original_img' and {$opt}  eq 0 ">
                                                            onclick="return confirm('{$lang.retain_original_confirm}');"
                                                        </if>
                                                    /><?php echo $var['display_options'][$key]; ?>
                                                </label>
                                            </list>
                                        <elseif value="{$var.type} eq 'options' ">
                                            <select name="value[{$var.id}]" id="value_{$var.id}_{$key}">
                                                <?php $options= $lang['cfg_range'][$var['code']];?>
                                                <html_options  options="$options" selected="{$var.value}">
                                            </select>
                                        <elseif value="{$var.type} eq 'file' ">
                                            
                                        </if>
                                    </td>
                                </tr>
                            </list>
                            </table>
                        </div>
                    </list>
                </div>
            </div>
		</div>
        <br /><br /><br /><br /><br /><br />
    </form>
    
	</body>
</html>