<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>{$zh.language.admin_plugin_list_page_title}</title>
    <zhjs/>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li>
                <a class="action" href="{|U:'plugin_list'}">{$zh.language.admin_plugin_list_page_tab1}</a>
            </li>
        </ul>
    </div>
    <table class="table2 zh-form">
        <thead>
        <tr>
            <td>{$zh.language.admin_plugin_list_page_table_th1}</td>
            <td class="w150">{$zh.language.admin_plugin_list_page_table_th2}</td>
            <td class="w150">{$zh.language.admin_plugin_list_page_table_th3}</td>
            <td class="w150">{$zh.language.admin_plugin_list_page_table_th4}</td>
            <td class="w150">{$zh.language.admin_plugin_list_page_table_th5}</td>
            <td class="w100">{$zh.language.admin_plugin_list_page_table_th6}</td>
            <td class="w50">{$zh.language.admin_plugin_list_page_table_th7}</td>
        </tr>
        </thead>
        <tbody>
        <list from="$plugin" name="p">
            <tr>
                <td>{$p.name}</td>
                <td>{$p.version}</td>
                <td>{$p.pubdate}</td>
                <td>{$p.team}</td>
                <td>
                	<if value="$p.installed eq 1">
                		<font color='green'>install OK</font>
						<a href='__CONTROL__&m=uninstall&plugin={$p.dirname}' style='color:green'>
						<u>uninstall</u>
						</a>
                		<else/>
                		no install
 					<a href='__CONTROL__&m=install&plugin={$p.dirname}'><u>install</u></a>
                	</if>
                </td>
                <td>{$p.app}</td>
                <td>
                    <a href="{|U:'Plugin/help',array('plugin'=>$p['app'])}">{$zh.language.admin_plugin_list_page_table_td_message1}</a>
                </td>
            </tr>
        </list>
        </tbody>
    </table>
</div>
</body>
</html>