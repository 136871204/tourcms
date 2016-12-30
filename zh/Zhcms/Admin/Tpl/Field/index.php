<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>{$zh.language.admin_field_index_page_title}</title>
    <zhjs/>
    <css file="__CONTROL_TPL__/css/css.css"/>
    <js file="__CONTROL_TPL__/js/js.js"/>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li><a href="{|U:'Model/index'}">{$zh.language.admin_field_index_page_tab1}</a></li>
            <li><a href="javascript:;" class="action">{$zh.language.admin_field_index_page_tab2}</a></li>
            <li><a href="{|U('add',array('mid'=>$_GET['mid']))}">{$zh.language.admin_field_index_page_tab3}</a></li>
            <li><a href="javascript:;" onclick="zh_ajax('{|U:updateCache}',{mid:{$zh.get.mid}})">{$zh.language.admin_field_index_page_tab4}</a></li>
        </ul>
    </div>
    <table class="table2 zh-form">
        <thead>
        <tr>
            <td class="w50">{$zh.language.admin_field_index_page_table_col_title1}</td>
            <td class="w50">{$zh.language.admin_field_index_page_table_col_title2}</td>
            <td class="w200">{$zh.language.admin_field_index_page_table_col_title3}</td>
            <td>{$zh.language.admin_field_index_page_table_col_title4}</td>
            <td class="w200">{$zh.language.admin_field_index_page_table_col_title5}</td>
            <td class="w100">{$zh.language.admin_field_index_page_table_col_title6}</td>
            <td class="w80">{$zh.language.admin_field_index_page_table_col_title7}</td>
            <td class="w80">{$zh.language.admin_field_index_page_table_col_title8}</td>
            <td class="w80">{$zh.language.admin_field_index_page_table_col_title9}</td>
            <td class="w80">{$zh.language.admin_field_index_page_table_col_title10}</td>
            <td class="w120">{$zh.language.admin_field_index_page_table_col_title11}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        </tr>
        </thead>
        <tbody>
        <list from="$field" name="f">
            <tr>
                <td>
                    <input type="text" name="fieldsort[{$f.fid}]" class="w30" value="{$f.fieldsort}"/>
                </td>
                <td>
                    {$f.fid}
                </td>
                <td>{$f.title}</td>
                <td>{$f.field_name}</td>
                <td>{$f.table_name}</td>
                <td>{$f.field_type}</td>
                <td>
                    <if value="{$f.is_system}">
                    	<font color="red">√</font>
                        <else><font color="blue">×</font>
                    </if>
                </td>
                <td>
                    <if value="{$f.required}">
                    	<font color="red">√</font>
                        <else><font color="blue">×</font>
                    </if>
                </td>
                <td>
                    <if value="{$f.issearch}">
                    	<font color="red">√</font>
                        <else><font color="blue">×</font>
                    </if>
                </td>
                <td>
                    <if value="{$f.isadd}">
                    	<font color="red">√</font>
                        <else><font color="blue">×</font>
                    </if>
                </td>
                <td>
                	 <a href="{|U:'edit',array('mid'=>$f['mid'],'fid'=>$f['fid'])}">{$zh.language.admin_field_index_page_table_operator1}</a>       
                	 |
                	 <?php if(in_array($f['field_name'],$noallowforbidden)){?>
                	 	<span style='color:#666'>{$zh.language.admin_field_index_page_table_operator2}</span>
                	 	<?php }else if($f['field_state']==1){?>
                   <a href="javascript:zh_ajax('{|U:forbidden}',{fid:{$f.fid},field_state:0,mid:{$f.mid}})" >{$zh.language.admin_field_index_page_table_operator2}</a>             
                   		<?php }else{?>
                   		<a href="javascript:zh_ajax('{|U:forbidden}',{fid:{$f.fid},field_state:1,mid:{$f.mid}},'__URL__')" style='color:red'>{$zh.language.admin_field_index_page_table_operator3}</a>			
                   			<?php }?>
                    |
                    <?php if(in_array($f['field_name'],$noallowdelete)):?>
                			<span style='color:#666'>{$zh.language.admin_field_index_page_table_operator4}</span>
                	<?php else:?>
                		 <a href="javascript:"
                       onclick="return confirm('【{$f.title}】{$zh.language.admin_field_index_page_confirm_del}')?zh_ajax('{|U:del}',{mid:{$f['mid']},fid:{$f['fid']}}):false;">{$zh.language.admin_field_index_page_table_operator4}</a>
                	<?php endif;?>
                   
                </td>
            </tr>
        </list>
        </tbody>
    </table>
    <br /><br /><br />
    <div class="position-bottom">
        <input type="button" class="zh-success" onclick="update_sort({$zh.get.mid});" value="{$zh.language.admin_field_index_page_operator_sort}"/>
    </div>
</div>
</body>
</html>