<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
		<title>页全サイトキャッシュ更新</title>
		<zhjs/>
	</head>
	<body>
		<form method="post" action="{|U:'index'}" class="zh-form">
			<div class="wrap">
				<div class="title-header">
					暖かいヒント
				</div>
				<div class="help">
					初期インストール時、全サイトキャッシュ更新必要
				</div>
				<div class="title-header">
					キャッシュ更新
				</div>
				<style type="text/css">
					table.table2 td{
						height:35px;
					}
				</style>
				<table class="table1">
					<tr>
						<th class="w100">更新選択</th>
						<td>
						<table class="table2">
							<tr>
								<td><label>
									<input type="checkbox" name="Action[]" value="Config" checked=''/>
									サイト配置更新 </label></td>
							</tr>
							<tr>
								<td><label>
									<input type="checkbox" name="Action[]" value="Model" checked=''/>
									内容Model </label></td>
							</tr>
							<tr>
								<td><label>
									<input type="checkbox" name="Action[]" value="Field" checked=''/>
									ModelのField </label></td>
							</tr>
							<tr>
								<td><label>
									<input type="checkbox" name="Action[]" value="Category" checked=''/>
									カテゴリキャッシュ </label></td>
							</tr>
							<tr>
								<td><label>
									<input type="checkbox" name="Action[]" value="Table" checked=''/>
									DBテーブルキャッシュ </label></td>
							</tr>
							<tr>
								<td><label>
									<input type="checkbox" name="Action[]" value="Node" checked=''/>
									権限Node </label></td>
							</tr>
							<tr>
								<td><label>
									<input type="checkbox" name="Action[]" value="Role" checked=''/>
									会員役 </label></td>
							</tr>
							<tr>
								<td><label>
									<input type="checkbox" name="Action[]" value="Flag" checked=''/>
									内容FLAG </label></td>
							</tr>
						</table></td>
					</tr>
				</table>
				<div class="position-bottom">
					<input type="submit" value="更新開始" class="zh-success"/>
				</div>
			</div>
		</form>
	</body>
</html>