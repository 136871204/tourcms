<?php
/**
 * 更新缓存
 * @author 周红 <136871204@qq.com>
 */
class CacheControl extends AuthControl {
	public function updateCache() {
		$ActionCache = F('updateCache');
		if ($ActionCache) {
			$action = array_shift($ActionCache);
			F('updateCache', $ActionCache);
			switch($action) {
				case "Config" :
					$Model = K("Config");
					$Model -> updateCache();
					$this -> success('サイト配置更新完了...', U("updateCache"), 0);
					break;
				case "Model" :
					$Model = K("Model");
					$Model -> updateCache();
					$this -> success('Model更新完了...', U("updateCache"), 0);
					break;
				case "Field" :
					$Model = new ModelFieldModel(1);
					$ModelCache = cache("model");
					foreach ($ModelCache as $mid => $data) {
						$Model -> updateCache($mid);
					}
					$this -> success('Field更新完了...', U("updateCache"), 0);
					break;
				case "Category" :
					$Model = K("Category");
					$Model -> updateCache();
					$this -> success('カテゴリ更新完了...', U("updateCache"), 0);
					break;
				case "Node" :
					$Model = K("Node");
					$Model -> updateCache();
					$this -> success('権限Node更新完了...', U("updateCache"), 0);
					break;
				case "Table" :
					cache('table',null);
					$this -> success('DBテーブル更新完了...', U("updateCache"), 0);
					break;
				case "Role" :
					$Model = K("Role");
					$Model -> updateCache();
					$this -> success('役更新完了...', U("updateCache"), 0);
					break;
				case "Flag" :
					$Model = new FlagModel(1);
					$ModelCache = cache("model");
					foreach ($ModelCache as $mid => $data) {
						$Model -> updateCache($mid);
					}
					$this -> success('Flag更新完了...', U("updateCache"), 0);
					break;
			}
		} else {
			Dir::del('temp');
			$this -> success('キャッシュ更新完了...', U('index'), 0);
		}
	}

	//结束
	public function index() {
		if (IS_POST) {
			$Action = Q('Action');
			F("updateCache", $Action);
			$this -> success('更新準備...', U('updateCache'),1);
		} else {
			$this -> display();
		}
	}

}
