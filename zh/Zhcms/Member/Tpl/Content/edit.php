<!DOCTYPE html>
<html>
	<head>
		<title>文章修正</title>
		<link rel="shortcut icon" href="favicon.ico">
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<zhjs/>
		<bootstrap/>
		<link rel="stylesheet" type="text/css" href="__CONTROL_TPL__/css/content.css?ver=1.0"/>
		<js file="__GROUP__/Zhcms/Admin/Tpl/Content/js/addEdit.js"/>
		<css file="__GROUP__/Zhcms/Admin/Tpl/Content/css/css.css"/>
	</head>
	<body>
		<load file="__TPL__/Public/block/top_menu.php"/>
		<form method="post" onsubmit="return false;">
			<input type="hidden" name="mid" value="{$zh.request.mid}"/>
    		<input type="hidden" name="aid" value="{$zh.request.aid}"/>
			<div class="main center-block">
				
				<div class="form">
					
					<div class="title-header">文章修正</div>
					<table class="table1">
						<?php foreach($form['base'] as $field):
						?>
						<tr>
							<th class="w80"> {$field['title']} <td> {$field['form']} </td>
						</tr>
						<?php endforeach; ?>
					</table>
					<div class="position-bottom" style="position: relative;">
				<input type="submit" class="zh-success" value="確認"/>
				<input type="button" class="zh-cancel" onclick="zh_close_window()" value="閉じる"/>
			</div>
				</div>
				<div class="help">
					<table class="table1">
						<?php foreach($form['nobase'] as $field):
						?>
						<tr>
							<th>{$field['title']}</th>
						</tr>
						<tr>
							<td> {$field['form']} </td>
						</tr>
						<?php endforeach; ?>
					</table>
					<h1 style="margin-top:20px;">ヒント</h1>
					<ul>
						<li>
							確認する前に、入力したタイトル或いは内容をチェックしてください
						</li>
						<li>
							添付ファイルアップロードする時、zip或いはrarに圧縮して後にしてください
						</li>
					</ul>
				</div>

			</div>

		</form>
	</body>
</html>