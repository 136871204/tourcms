<?php
/**
 * 模板风格选择
 * @author 周鸿<136871204@qq.com>
 */
class TemplateStyleControl extends  AuthControl {
	//模板风格列表
	public function style_list() {
		$style = array();
		$dirs = Dir::tree('template');
		//循环template 下的文件，做处理
        foreach ($dirs as $tpl) {
            //如果是system文件夹的话，下面处理不执行
			if($tpl['name']=='system')continue;
			//说明文档
			$readme = $tpl['path'] . "/readme.txt";
			if (is_file($readme) && is_readable($readme)) {
				$tmp = preg_split('@\n@', file_get_contents($readme));
				$config['name'] = mb_substr($tmp[0], 0, 20, 'utf-8');
				$config['author'] = mb_substr($tmp[1], 0, 20, 'utf-8');
				$config['email'] = mb_substr($tmp[2], 0, 20, 'utf-8');
			} else {
				$config = array("name" => L('admin_template_style_control_style_list_message1'), 
                                "author" => L('admin_template_style_control_style_list_message2'), 
                                "email" => L('admin_template_style_control_style_list_message3'));
			}
			//模板目录名
			$config['dir_name'] = $tpl['name'];
			//模板缩略图
			$template_img = $tpl['path'] . "/template.jpg";
			if (is_file($template_img)) {
				$template_img = str_replace(ROOT_PATH, '', $template_img);
				$config['template_img'] = __ROOT__ . '/' . $template_img;
			} else {
				$config['template_img'] = __CONTROL_TPL__ . '/img/default.jpg';
			}
			//正在使用的模板
			if (strtolower(C("WEB_STYLE")) == strtolower($tpl['name'])) {
				$config['current'] = true;
			} else {
				$config['current'] = false;
			}
			$style[] = $config;
		}
		$this -> style = $style;
		$this -> display();
	}

	//读取模板目录
	public function show_dir() {
		$dirName =  (Q("get.dir_name") ? Q("get.dir_name",'',"urldecode") : 'template/'.C("WEB_STYLE"));
		$this -> dirs = Dir::tree($dirName, 'html');
		$this -> display();
	}
	//选择模板风格（使用模板）
	public function select_style() {
		$dir_name = Q("dir_name");
		if ($dir_name) {
			//import('Config.Model.ConfigModel');
			$Model = K("Config");
			$Model->where("name='WEB_STYLE' AND  webid = 1 ") -> save(array("value" => $dir_name));

			//更新配置文件
			$Model -> updateCache(1);
            
			//删除前台编译文件
			is_dir("./temp/Zhcms/Content/Compile") and Dir::del("./temp/Zhcms/Content/Compile");
            
			//删除编译文件
			is_dir('temp/Zhcms/Index') and dir::del('temp/Zhcms/Index');
			$this -> success(L('admin_template_style_control_show_dir_message1'));
		}
	}

	//编辑模板内容
	public function edit_tpl() {
		if (IS_POST) {
			//检测模板文件写权限
			if (!is_writable($_POST['file_path'])) {
				$this -> error(L('admin_template_style_control_edit_tpl_message1'));
			}
			//新文件名
			$new = dirname($_POST['file_path']) . '/' . $_POST['file_name'] . '.html';
			//修改文件名
			rename($_POST['file_path'], $new);
			//修改模板内容
			if (file_put_contents($new, $_POST['content'])) {
				$this -> success(L('admin_template_style_control_edit_tpl_message2'));
			} else {
				$this -> error(L('admin_template_style_control_edit_tpl_message3'));
			}
		} else {
			$file_path = Q("get.file_path", "", "urldecode");
			$content = htmlspecialchars(file_get_contents($file_path));
			//模板文件详细信息
			$info = pathinfo($file_path);
			$field = array("file_path" => $file_path, "file_name" => $info['filename'], "content" => $content);
			$this -> field = $field;
			$this -> display();
		}
	}

}
