<?php
/**
 * 添加、删除文章时表单处理
 */
class ContentFormModel extends CommonModel {
	//表
	public $table = "field";
	//模型mid
	private $_mid;
	//字段缓存
	private $_field;
	//模型缓存
	private $_model;
	//表单验证
	public $formValidate = array();
	//旧数据
	private $_data;

	//构造函数
	public function __init() {
		$this -> _mid = Q("mid", NULL, "intval");
		//字段所在表模型信息
		$this -> _model = cache("model", false);
		//字段缓存
		$this -> _field = F($this -> _mid, false, FIELD_CACHE_PATH);
	}

	/**
	 * 编辑与修改动作时根据不同字段类型获取界面
	 * @param array $data 编辑数据时的数据
	 * @return string
	 */
	public function get($data = array()) {
		$this -> _data = $data;
       
		//当前模型字段缓存
		$fieldCache = cache($this -> _mid, false, FIELD_CACHE_PATH);

		if (!$fieldCache) {
			return array();
		}
        
		$form = array();
		foreach ($fieldCache as $field) {
			//禁用字段不处理
			if ($field['field_state'] == 0) {
				continue;
			}
			//前台投稿字段过滤
			if ($field['isadd'] == 0 && APP == 'Member') {
				continue;
			}
			//表单值  添加时使用set['default'] 编辑时使用data数据
            if(isset($data[$field['field_name']])  && $data[$field['field_name']]!=""){
                $value=$data[$field['field_name']];
            }else{
                if((isset($field['set']['default']))){
                    $value=$field['set']['default'];
                }else{
                    $value='';
                }
            }
			//$value = isset($data[$field['field_name']]) ? $data[$field['field_name']] : (isset($field['set']['default']) ? $field['set']['default'] : '');
			$value = trim($value);
			//处理函数
			$function = $field['field_type'];
			//是否为基本字段，基本字段在左侧 显示
			$isbase = intval($field['isbase']) ? 'base' : 'nobase';
			$field['form'] = $this -> $function($field, $value);
			//设置验证规则
			$this -> setValidateRule($field, $value);
			//验证规则
			$form[$isbase][] = $field;
		}
		//编辑验证规则为合法的JS格式
		$this -> validateCompileJs();
		return $form;
	}

	//编辑验证规则为合法的JS格式
	protected function validateCompileJs() {
		$va = array();
		foreach ($this -> formValidate as $field => $value) {
			$rule = $error = array();
			foreach ($value['rule'] as $r => $func) {
				$rule[] = $r . ':' . $func;
			}
			foreach ($value['error'] as $e => $msg) {
				$error[] = $e . ":'$msg'";
			}
			$message = empty($value['message']) ? '' : $value['message'];
			$va[] = $field . ':{rule:{' . implode(',', $rule) . '},error:{' . implode(',', $error) . '},message:"' . $message . '"}';
		}
		$this -> formValidate = '{' . implode(',', $va) . '}';
	}

	//设置验证规则
	protected function setValidateRule($field, $value) {
		$set = $field['set'];
		//设置验证规则
		$validate = array('rule' => array(), 'error' => array(), 'message' => '');
		if ((int)$field['required']) {
			$validate['rule']['required'] = 1;
			$validate['error']['required'] = $field['title'] . '必須';
		}
		if (!empty($field['validate'])) {
			$validate['rule']['regexp'] = $field['validate'];
			$validate['error']['regexp'] = empty($field['error']) ? '入力エラー' : $field['error'];
		}
		//验证长度
		if (!empty($field['minlength'])) {
			$validate['rule']['minlen'] = (int)$field['minlength'];
			$validate['error']['minlen'] = '<' . (int)$field['minlength'] . '文字エラー';
		}
		//验证长度
		if (!empty($field['maxlength'])) {
			$validate['rule']['maxlen'] = (int)$field['maxlength'];
			$validate['error']['maxlen'] = '>' . (int)$field['maxlength'] . '文字エラー';
		}

		if (!empty($field['tips'])) {
			$validate['message'] = $field['tips'];
		}
		$this -> formValidate[$field['field_name']] = $validate;
	}

	//Input字段
	protected function input($field, $value) {
		$set = $field['set'];
		//表单类型
		$type = $set['ispasswd'] == 1 ? "password" : "text";
		return "<input style=\"width:{$set['size']}px\" type=\"{$type}\" class=\"{$field['css']}\" name=\"{$field['field_name']}\" value=\"$value\"/>";
	}

	//tag字段
	protected function tag($field, $value) {
		$set = $field['set'];
		//表单类型
		return "<input style=\"width:{$set['size']}px\" type=\"text\" class=\"{$field['css']}\" name=\"{$field['field_name']}\" value=\"$value\"/>";
	}

	//Input字段
	protected function number($field, $value) {
		$set = $field['set'];
		//表单类型
		return "<input style=\"width:{$set['size']}px\" type=\"text\" class=\"{$field['css']}\" name=\"{$field['field_name']}\" value=\"$value\"/>";
	}

	//Title标题字段
	protected function title($field, $value) {
		$set = $field['set'];
		if (APP != 'Member') {
			$color = isset($this -> _data['color']) ? $this -> _data['color'] : '';
			if (isset($this -> _data['new_window']) && $this -> _data['new_window'] == 1) {
				$new_window_check = 'checked=""';
                $new_window_value='value="1"';
			} else {
				$new_window_check = '';
                $new_window_value='value="0"';
			}
			return '<input id="title" type="text" name="' . $field['field_name'] . '" style="width:' . $set['size'] . 'px" class="title ' . $field['css'] . '" value="' . $value . '">
                        <label class="checkbox inline">
                            	タイトル色 <input type="text" name="color" class="w60" value="' . $color . '">
                        </label>
                        <button type="button" onclick="selectColor(this,\'color\')" class="zh-cancel">色選択</button>
                        <label class="checkbox inline">
                            <input type="checkbox" name="new_window_check" value="1" ' . $new_window_check . ' onclick="setNewWindow(this);" > _blankで開く
                            <input type="hidden" name="new_window" '.$new_window_value.' />
                        </label>
                        <script>
                            function setNewWindow(ob){
                                if($(ob).attr("checked")){
                                    $("input[name=\'new_window\']").val("1");
                                }else{
                                    $("input[name=\'new_window\']").val("0");
                                }
                            }
                        </script>
                        <span id="zh_' . $field['field_name'] . '"></span>';
		} else {
			return "<input type='text' name='{$field['field_name']}' value='$value' class='w300'/>";
		}
	}

	//文章Flag属性如推荐、置顶等
	protected function flag($field, $value) {
		$flag = cache($this -> _mid, false, FLAG_CACHE_PATH);
		$set = $field['set'];
		if (!empty($value)) {
			$value = explode(',', $value);
		}
		$form = '';
		foreach ($flag as $N => $f) {
			$checked = "";
			if (!empty($value)) {
				if (in_array($f, $value)) {
					$checked = 'checked=""';
				}
			}
			$form .= '<label class="checkbox inline">
					<input type="checkbox" name="flag[]" value="' . $f . '" ' . $checked . '> 
                                	' . $f . '[' . ($N + 1) . ']</label>';
		}
		return $form;
	}

	//栏目cid
	protected function cid($field, $value) {
		$category = cache('category');
		$set = $field['set'];
		$cid = Q('cid', 0, 'intval');
		return $category[Q('cid')]['catname'] . "<input type='hidden' name='cid' value='$cid'/>";
	}

	//栏目文本域
	protected function textarea($field, $value) {
		$set = $field['set'];
		return "<textarea class=\"{$field['css']}\" name=\"{$field['field_name']}\" style=\"width:{$set['width']}px;height:{$set['height']}px\">{$value}</textarea>";
	}
    
    //外部データ
	protected function exterior($field, $value) {
		$set = $field['set'];

        return '<input type="text" id="'.$field['field_name'].'" name="' . $field['field_name'] . '" style="width:300px" class=""  value="'.$value.'" >
        <button class="zh-cancel-small" type="button"　 onclick="select_exterior(\'' . $field['set']['table'] . '\',\'' . $field['set']['pk'] . '\',\'' . $field['set']['showf'] . '\',\'' . $field['set']['showt'] . '\',\'' . $field['set']['wherestr'] . '\',\'' . $field['set']['select_type'] . '\',\'' . $field['field_name'] . '\');"　 >外部データ選択</button>';
	}
    
    //ツリー選択
	protected function treeselect($field, $value) {
		$set = $field['set'];
        $table=$field['set']['table'];
        $treeData = cache($table);
        $showValue=Data::menu_linkage_level($value,0,$treeData);
        return '<input type="text" id="'.$field['field_name'].'_title" name="' . $field['field_name'] . '_title" style="width:300px" class=""  value="'.$showValue.'" >
        <input type="hidden" id="'.$field['field_name'].'" name="' . $field['field_name'] . '" style="width:300px" class=""  value="'.$value.'" >
        <button class="zh-cancel-small" type="button"　 onclick="select_treeselect(\'' . $field['set']['table'] . '\',\'' . $field['set']['title_field'] . '\',\'' . $field['set']['id_field'] . '\',\'' . $field['field_name'] . '_title\',\'' . $field['field_name'] . '\');"　 >外部データ選択</button>';
	}

	//模板选择
	protected function template($field, $value) {
		$set = $field['set'];
		return '<input style="width:300px;" type="text" id="'.$field['field_name'].'" name="' . $field['field_name'] . '" value="' . $value . '" onfocus="select_template(\'' . $field['field_name'] . '\');">
                        <button class="zh-cancel-small" type="button" onclick="select_template(\'' . $field['field_name'] . '\');">テンプレート選択</button>';
	}

	//文章正文
	protected function content($field, $value) {
		if (APP != 'Member') {
			$category = cache('category');
			$set = $field['set'];
			//自动截取内容为摘要
			$AUTO_DESC = C('AUTO_DESC')?'checked=""':'';
			$DOWN_REMOTE_PIC=C('DOWN_REMOTE_PIC')?'checked=""':'';
			$AUTO_THUMB=C('AUTO_THUMB')?'checked=""':'';
			$html = tag('ueditor', array("name" => $field['field_name'], "content" => $value, "height" => 300));
			$html .= '
			<div class="editor_set control-group">
                                <label class="checkbox inline">
                                    <input type="checkbox" name="down_remote_pic" value="1" '.$DOWN_REMOTE_PIC.'/>遠隔画像下載
                                </label>
                                <label class="checkbox inline">
                                    <input type="checkbox" name="auto_desc" value="1" '.$AUTO_DESC.'/>内容カット
                                </label>
                                <label class="checkbox inline">
                                    <input type="text" value="200" class="w80" name="auto_desc_length"> 内容適用になる文字数
                                </label>
                                &nbsp;&nbsp;&nbsp;
                                <label class="checkbox inline">
                                    <input type="checkbox" name="auto_thumb" value="1" '.$AUTO_THUMB.'/>内容の何文字
                                </label>
                                <label class="checkbox inline">
                                    <input type="text" class="w80" value="1" name="auto_thumb_num">
                                     	この画像をサムネイルにする
                                </label>
                            </div>';
		} else {
				$html=tag('ueditor', array("name" => $field['field_name'], "content" => $value, "height" => 300));
		}
		return $html;
	}
    
    //编辑器
    private function editor($field, $value)
    {
        return tag('ueditor', array("name" => $field['field_name'], "content" => $value, "style" => $field['set']['style']));
    }

	//选项radio,select,checkbox
	protected function box($field, $value) {
	   //set
       /*
       例如 
        array (
          'options' => '1| 是,2|否',
          'form_type' => 'radio',
          'default' => '1',
        ),
       */
		$set = $field['set'];
		//表单值
		$_v = explode(",", $set['options']);
		$options = array();
		foreach ($_v as $n => $p) {
			$p = explode("|", $p);
			$options[$p[0]] = $p[1];
		}
		$h = '';
		//select添加select
		if ($set['form_type'] == 'select') {
			$h .= "<select name='{$field['field_name']}'>";
		}
		foreach ($options as $v => $text) {
			switch ($set['form_type']) {
				case "radio" :
					$checked = $value == $v ? 'checked=""' : '';
					$h .= "<label><input type='radio' name=\"{$field['field_name']}\" value=\"{$v}\" {$checked}/>{$text}</label>&nbsp;&nbsp;";
					break;
				case "checkbox" :
					$s = explode(",", $value);
					$checked = in_array($v, $s) ? "checked='checked'" : "";
					$h .= "<label><input type='checkbox' name=\"{$field['field_name']}[]\" value=\"{$v}\" {$checked}/> {$text}</label> ";
					break;
				case "select" :
					$selected = $value == $v ? "selected='selected'" : "";
					$h .= "<option name=\"{$field['field_name']}\" value=\"{$v}\" {$selected}> {$text}</option>";
					break;
			}
		}
		if ($set['form_type'] == 'select') {
			$h .= "</select>";
		}
		return $h;
	}

	//缩略图
	protected function thumb($field, $value) {
		$src = empty($value) ? __ROOT__ . '/zh/Common/static/img/upload-pic.png' : __ROOT__ . '/' . $value;
		$fieldName = $field['field_name'];
		return '  <img id="' . $fieldName . '" src="' . $src . '" style="cursor: pointer;width:145px;height:123px;margin-bottom:5px;" onclick="file_upload({id:\'' . $fieldName . '\',type:\'thumb\',num:1,name:\'' . $fieldName . '\'})">
                        <input type="hidden" name="' . $fieldName . '" value="' . $value . '"/>
                        <button type="button" class="zh-cancel-small" onclick="file_upload({id:\'' . $fieldName . '\',type:\'thumb\',num:1,name:\'' . $fieldName . '\'})">画像アップロード</button>
                        &nbsp;&nbsp;
                        <button type="button" class="zh-cancel-small" onclick="remove_thumb(this)">アップロード取り消す</button>';
	}

	//日期Date
	protected function datetime($field, $value) {
		$set = $field['set'];
		$format = array("Y-m-d", "Y/m/d H:i:s", "H:i:s");
		$value = empty($value) ? date($format[$set['format']]): date($format[$set['format']], $value);
		//默认值
		$h = "<input type='text' id='{$field['field_name']}' name='{$field['field_name']}' value='$value' class='w150'/>";
		$format = array("yyyy-MM-dd", "yyyy/MM/dd HH:mm:ss", "HH:mm:ss");
		$h .= "<script>$('#{$field['field_name']}').calendar({format: '" . $format[$set['format']] . "'});</script>";
		return $h;
	}

	//多图上传
	protected function images($field, $value) {
		$set = $field['set'];
		$id = "img_" . $field['field_name'];
		//允许上传数量
		$num = $set['num'];
		//已经上传图片
		if (!empty($value)) {
			$img = unserialize($value);
			$num = $num - count($img['path']);
		}
		$h = "<fieldset class='img_list'>
<legend style='color:#666;font-size: 12px;line-height: 25px;padding: 0px 10px; text-align:center;margin: 0px;'>画像一覧</legend>
<center>
<div style='color:#666;font-size:12px;margin-bottom: 5px;'>
最大
<span style='color:red' id='zh_up_{$id}'>$num</span>
の画像がアップロードできます
</div>
</center>
<div id='$id' class='picList'>";
		if (!empty($value)) {
			$img = unserialize($value);
			if (!empty($img) && is_array($img)) {
				$h .= '<ul>';
				foreach ($img['path'] as $N => $path) {
					$alt = $img['alt'][$N];
					$h .= "<li><div class='img'><img src='" . __ROOT__ . "/" . $path . "' style='width:135px;height:135px;'/>";
					$h .= "<a href='javascript:;' onclick='remove_upload(this,\"{$id}\")'>X</a>";
					$h .= "</div>";
					$h .= "<input type='hidden' name='" . $field['field_name'] . "[path][]'  value='" . $path . "' src='" . __ROOT__ . '/' . $path . "' class='w400 images'/> ";
					$h .= "<input type='text' name='" . $field['field_name'] . "[alt][]' value='" . $alt . "' placeholder='画像説明...'/>";
					$h .= "</li>";
				}
				$h .= '</ul>';
			}
		}
        $thumb_type=isset($set['thumb_type'])?$set['thumb_type']:C('thumb_type');
		$options = json_encode(array('id' => $id, 'type' => 'images', 'num' => $num, 'name' => $field['field_name'], 'filetype' => 'jpg,png,gif,jpeg', 'upload_img_max_width' => $set['upload_img_max_width'], 'upload_img_max_height' => $set['upload_img_max_height'], 'thumb_type' => $thumb_type));
		$h .= "</div>
</fieldset>
<button class='zh-cancel-small' onclick='file_upload({$options})' type='button'>画像アップロード</button>";
		$h .= " <span class='{$field['field_name']} validate-message'>" . $field['tips'] . "</span>";
		return $h;
	}

	//单张图
	private function image($field, $value) {
		$set = $field['set'];
		$id = "img_" . $field['field_name'];
		$path = isset($value) ? $value : "";
		$src = !empty($value) ? __ROOT__ . '/' . $value : "";
        $thumb_type=isset($set['thumb_type'])?$set['thumb_type']:C('thumb_type');
		$options = json_encode(array('id' => $id, 'type' => 'image', 'num' => 1, 'name' => $field['field_name'], 'filetype' => 'jpg,png,gif,jpeg', 'upload_img_max_width' => $set['upload_img_max_width'], 'upload_img_max_height' => $set['upload_img_max_height'], 'thumb_type' => $thumb_type));
		$h = "<input id='$id' type='text' name='" . $field['field_name'] . "'  value='$path' src='$src' class='w300 images' onmouseover='view_image(this)'/> ";
		$h .= "<button class='zh-cancel-small' onclick='file_upload($options)' type='button'>画像アップロード</button>&nbsp;&nbsp;";
		$h .= "<button class='zh-cancel-small' onclick='remove_upload_one_img(this)' type='button'>取り除く</button>";
		$h .= " <span class='{$field['field_name']} validate-message'>" . $field['tips'] . "</span>";
		return $h;
	}

	//多文件上传
	private function files($field, $value) {
		$set = $field['set'];
		$id = $field['field_name'];
		//允许上传数量
		$num = $set['num'];
		//已经上传图片
		if (!empty($value)) {
			$img = unserialize($value);
			$num = $num - count($img['path']);
		}
		$h = "<fieldset class='img_list'>
<legend style='color:#666;font-size: 12px;line-height: 25px;padding: 0px 10px; text-align:center;margin: 0px;'>ファイル一覧</legend>
<center>
<div style='color:#666;font-size:12px;margin-bottom: 5px;'>
最大
<span style='color:red' id='zh_up_{$id}'>$num</span>
個ファイルがアップロードできる
</div>
</center>
<div id='$id' class='fileList'>";
		if (!empty($value)) {
			$file = unserialize($value);
			if (!empty($file) && is_array($file)) {
				$h .= '<ul>';
				foreach ($file['path'] as $N => $path) {
					$h .= "<li style='width:45%'>";
					$h .= "<img src='" . __ZHPHP_EXTEND__ . "/Org/Uploadify/default.png' style='width:50px;height:50px;'/>";
					$h .= "<input type='hidden' name='" . $field['field_name'] . "[path][]'  value='" . $path . "'/> ";
					$h .= "説明：<input type='text' name='" . $field['field_name'] . "[alt][]' style='width:200px;' value='" . $file['alt'][$N] . "'/>";
					$h .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
					$h .= "下載金貨：<input type='text' name='" . $field['field_name'] . "[credits][]' style='width:200px;' value='" . $file['credits'][$N] . "'/>";
					$h .= "&nbsp;&nbsp;&nbsp;<a href='javascript:;' onclick='remove_upload(this,\"{$id}\")'>削除</a>";
					$h .= "</li>";
				}
				$h .= '</ul>';
			}
		}
		$options = json_encode(array('id' => $id, 'type' => 'files', 'num' => $num, 'name' => $field['field_name'], 'filetype' => $set['filetype']));
		$h .= "</div>
</fieldset>
<button class='zh-cancel-small' onclick='file_upload($options)' type='button'>ファイルアップロード</button>";
		$h .= " <span class='{$field['field_name']} validate-message'>" . $field['tips'] . "</span>";
		return $h;
	}

}
