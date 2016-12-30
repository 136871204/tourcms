<?php
/**
 * 模型管理
 * @author 周鸿 <136871204@qq.com>
 */
class ModelModel extends Model {
	//表名
	public $table = 'model';
	//不允许删除的模型
	public $forbidDelete = array('content');
    
    public function __init()
    {
        C('language','Model'.DS.'Model'.DS.$_SESSION['language']);
    }
    
    
	/**
	 * 添加模型
	 */
	public function addModel($InsertData) {
		$this -> validate = array( 
            array('model_name', 'nonull', L('model_model_add_model_message1'), 2, 1), 
            array('table_name', 'nonull', L('model_model_add_model_message2'), 2, 1));
		$this -> auto = array( array('table_name', 'strtolower', 'function', 2, 1));
		//创建模型表
		if ($this -> create($InsertData)) {
			$data = $this -> data;
			//验证表是否存在
			if ($this -> tableExists($data['table_name'])) {
				$this -> error = L('model_model_add_model_message3');
				return false;
			}
			if ($this -> createModelSql($data['table_name'])) {
				//向模型表添加模型信息
				$mid = $this -> add();
				if ($mid) {
					//创建Field表信息
					$db = M();
					$db_prefix = C("DB_PREFIX");
					$table = $data['table_name'];
					require APP_PATH . '/Data/ModelSql/FieldInit.php';
					if ($this -> updateCache()) {
						//更新字段缓存
						$ModelField = new ModelFieldModel($mid);
						$ModelField -> updateCache();
						//更新文章属性缓存
						$FlagModel = new FlagModel($mid);
						$FlagModel -> updateCache();
						return $mid;
					}
				} else {
					return false;
				}
			}
		} else {
			return false;
		}
	}

	//修改模型
	public function editModel($data) {
		$this -> validate = array( array('model_name', 'nonull', L('model_model_edit_model_message1'), 2, 2));
		if ($this -> create($data)) {
			if (!$this -> save($data)) {
				$this -> error = L('model_model_edit_model_message2');
			} else {
				if (!$this -> updateCache()) {
					return false;
				} else {
					return true;
				}
			}
		}
	}

	/**
	 * 创建模型表
	 */
	public function createModelSql($tableName) {
		$table = strtolower(trim($tableName));
		$zhubiaoSql = file_get_contents(APP_PATH . 'Data/ModelSql/zhubiao.sql');
		$fuBiaoSql = file_get_contents(APP_PATH . 'Data/ModelSql/zhubiao_data.sql');

		$zhubiaoSql = preg_replace(array('/@pre@/', '/@table@/'), array(C("DB_PREFIX"), $tableName), $zhubiaoSql);
		$Model = M();
		if ($Model -> runSql($zhubiaoSql) === false) {
			$this -> error = L('model_model_create_model_sql_message1');
			return false;
		}
		$fuBiaoSql = preg_replace(array('/@pre@/', '/@table@/'), array(C("DB_PREFIX"), $tableName), $fuBiaoSql);
		if ($Model -> runSql($fuBiaoSql) === false) {
			$this -> error = L('model_model_create_model_sql_message2');
			return false;
		}
		return true;
	}

	/**
	 * 删除模型
	 */
	public function delModel($mid) {
		//验证栏目信息
		if ( M('category') -> find($mid)) {
			$this -> error = L('model_model_del_model_message1');
		}
		$model = $this -> find($mid);
		if (is_null($model)) {
			$this -> error = L('model_model_del_model_message2');   
			return false;
		}
		$table = $model['table_name'];
		$delTable = $this -> delTable(array($table, $table . '_data'));
		if ($delTable === true) {
			//删除表记录
			if ($modelStat = $this -> del($mid)) {
				//删除模型字段信息并更新字段缓存
				if ($delState = $this -> table("field") -> where("mid={$mid}") -> del()) {
					//删除字段缓存文件
					cache($mid, null, FIELD_CACHE_PATH);
					//更新模型缓存
					if (!$this -> updateCache()) {
						return false;
					}
					return $delState;
				} else {
					$this -> error = L('model_model_del_model_message3');
					return false;
				}
				return $modelStat;
			}
		}
	}

	//删除表
	private function delTable(array $tableArr) {
		foreach ($tableArr as $table) {
			if ($this -> tableExists($table)) {
				if (!$this -> dropTable($table)) {
					$this -> error = L('model_model_del_table_message1');
					return false;
				}
			}
		}
		return true;
	}

	//更新模型缓存
	public function updateCache() {
		$modelDb = M('model');
		$modelData = $modelDb -> order(array('mid' => "ASC")) -> all();
		if ($modelData !=false) {
			$CacheData = array();
			foreach ($modelData as $model) {
				$CacheData[$model['mid']] = $model;
			}
			$stat = cache("model", $CacheData);
			if ($stat) {
				return true;
			} else {
				$this -> error = L('model_model_update_cache_message1');
				return false;
			}
		}
	}

}
