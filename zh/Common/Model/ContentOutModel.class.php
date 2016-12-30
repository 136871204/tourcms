<?php
/**
 *  前台获取单篇文章数据
 */
class ContentOutModel {
	//字段缓存
	private $_field;
	private $_mid;
	//文章数据
	private $_data;
	/**
	 * 构造函数
	 * @param int $mid 模型mid
	 */
	public function __construct($mid) {
		$this -> _field = cache($mid, false, FIELD_CACHE_PATH);
		$this -> _mid = $mid;
	}

	/**
	 * 获得入库数据
	 * @param $actionType 1 添加  2 修改
	 */
	public function get($data) {
		$this -> _data = $data;
		foreach ($this->_field as $field => $fieldInfo) {
			$set = $fieldInfo['set'];
			$METHOD = $fieldInfo['field_type'];
			if (method_exists($this, $METHOD) && isset($data[$field])) {
				$Value = $this -> $METHOD($fieldInfo, $data[$field]);
				$data[$field] = $Value;
			}
		}
		return $data;
	}

	//标题字段
	private function title($fieldInfo, $value) {
		return $value;
	}

	//缩略图
	private function thumb($fieldInfo, $value) {
		if(!empty($value)){
			return __ROOT__ . '/' .$value ;
		}else{
			return '';
		}
	}

	//模板
	private function template($fieldInfo, $value) {
		return trim($value);
	}

	//栏目选择
	private function cid($fieldInfo, $value) {
		return (int)$value;
	}

	//文章内容
	private function content($fieldInfo, $value) {
		return $value;
	}

	//Flag文章属性
	private function flag($fieldInfo, $value) {
		return $value;
	}

	//文本字段
	private function input($fieldInfo, $value) {
		return $value;
	}

	//多行文本
	private function textarea($fieldInfo, $value) {
		return $value;
	}

    //数字
	private function number($fieldInfo, $value) {
        $set = $fieldInfo['set'];
		$field_type = isset($set['field_type']) ? $set['field_type'] : 'int';
		switch($field_type) {
			case "decimal" :
                return (float)$value;
			default :
                return (int)$value;
		}
		
	}

	//选项
	private function box($fieldInfo, $value) {
        $values = explode(',', $value);
        $options = $fieldInfo['set']['options'];
        $options = explode(',', $options);
        $result = array();
        foreach ($options as $option) {
            $boxData = explode('|', $option);
            foreach($values as $v) {
                 if ($boxData[0]== $v) {
                    $result[]=$boxData[1];
                 }
            }              
        }
        return array("key_string"=>$value,"value_string"=>implode(',', $result),"key_array"=>$values,"value_array"=>$result);
	}

	//编辑器
	private function editor($fieldInfo, $value) {
		return $value;
	}

	//单图上传
	private function image($fieldInfo, $value) {
		return $value;
	}

	//多图上传
	private function images($fieldInfo, $value) {
	    
		return  unserialize($value);
	}

	//日期时间
	private function datetime($fieldInfo, $value) {
		return $value;
	}

	//文件上传
	private function files($fieldInfo, $value) {
		return unserialize($value);
	}

}
