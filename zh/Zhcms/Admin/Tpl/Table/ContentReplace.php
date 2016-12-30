<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>DBデータ変更</title>
	<zhjs/>
	<style type="text/css">
		div#tablefieldlist{
			margin:10px 0px;
			padding:10px;
		}
			div#tablefieldlist a{
				display:inline-block;margin-right:5px;
				border:solid 1px #dcdcdc;padding:3px 6px;
				margin-bottom: 5px;
			}
			div#tablefieldlist a.select{
				background: #006DCC;
				color:#fff;
			}
	</style>
	<script type="text/javascript" charset="utf-8">
		$(function(){
		$('form').validate({
			table:{
				rule:{required:true},
				error:{required:'テーブル選択してください'}
			},
			field:{
				rule:{required:true},
				error:{required:'Field選択してください'}
			},
			searchcontent:{
				rule:{required:true},
				error:{required:'必須'}
			},
			replacecontent:{
				rule:{required:true},
				error:{required:'必須'}
			},
			code:{
				rule:{required:true,ajax:{url:'{|U:'checkCode'}'}},
				error:{required:'必須',ajax:'検証番号エラー'}
			}
		})
		});
	</script>
	<script type="text/javascript" charset="utf-8">
		$(function(){
			//选择表时获取字段
			$("#tables").change(function(){
					var tablesJson={$tablesJson};
					var fieldHtml ='';
					var table = $(this).val();
					for(var field in tablesJson[table]['field']){
						fieldHtml+='<a href="javascript:;" onclick="selectField(\''+field+'\')" id=\''+field+'\'>'+field+'</a>';
					} 
					$("#tablefieldlist").css('background','#ffffff').html(fieldHtml);
			})
		})
		function selectField(field){
				$("#tablefieldlist a").removeClass('select');
				$("#"+field).addClass('select');
				$("input[name=field]").val(field);
		}
	</script>
	
</head>
<body>
	<form action="{|U:'ContentReplace'}" class="zh-form" method="post"  onsubmit="return zh_submit(this)">
	<div class="wrap">
		<div class="title-header">ヒント</div>
		<div class="help">プログラムでDBデータ一括変更する，この操作は極めて危険を使って、気をつけてください。。</div>
		<div class="title-header">DBデータ変更</div>
		<table class="table1">
			<tr>
				<th class="w150">テーブルとFieldを選択</th>
				<td>
					<select name="table" id="tables"  size="10" class="w500">
						<list from="$tables" name="table">
						<option value="{$table.tablename}">{$table.tablename}</option>
						</list>
					</select>
					<div id="tablefieldlist"></div>
					 フィールド：<input type="text" name="field" class="w200" />
				</td>
			</tr>
			<tr>
				<th>検索内容</th>
				<td>
					<textarea name="searchcontent"  class="w500 h80"></textarea>
				</td>
			</tr>
			<tr>
				<th>変更内容</th>
				<td>
					<textarea name="replacecontent"  class="w500 h80"></textarea>
				</td>
			</tr>
			<tr>
				<th>変更条件</th>
				<td>
					<textarea name="replacewhere"  class="w500 h80"></textarea>
				</td>
			</tr>
			<tr>
				<th>安全検証</th>
				<td>
					<input type="text" name="code" class="w150"/>
					<img src="{|U:'code'}" onclick="this.src='{|U:'code'}&_'+Math.random()" style="cursor: pointer"/>
					<span id="zh_code"></span>
				</td>
			</tr>
		</table>
        <br /><br /><br />
		<div class="position-bottom">
			<input type="submit" value="変更" class="zh-success"/>
		</div>
	</div>
	</form>
</body>
</html>