<?php

/**
 * 后台网站配置管理
 * Class ConfigControl
 * @author 周鸿 <136871204@qq.com>
 */
class ConfigControl extends AuthControl{
    


    public function __init() {
        $weblistModel = K("Weblist");
        $weblist=$weblistModel->All();
        $this -> weblist = $weblist;
	}
    
    //修改
	function edit() {
	   $Model = K("config");
       $webid = Q('webid', 0, 'intval');
       if (IS_POST) {
            if ($Model -> saveConfig($_POST)) {
                $this -> success("修正成功");
            }else {
				$this -> error($Model -> error);
			}
       }else{
            $data = $Model ->where( " webid = $webid ") -> order('order_list ASC') -> all();
            $config = array();
            if(!empty($data)){
    			foreach ($data as $d) {
    				$config[$d['name']] = $d;
    			}
            }
            //删除模型风格配置
			unset($config['WEB_STYLE']);
            //======================================会员角色
			$roleData = $Model -> table("role") -> where("admin=0") -> all();
            $config['DEFAULT_MEMBER_GROUP']['html'] = '<select name="DEFAULT_MEMBER_GROUP">';
            if(!empty($roleData)){
                if(isset($config['DEFAULT_MEMBER_GROUP']['value'])){
                    foreach ($roleData as $role) {
        				$checked = $config['DEFAULT_MEMBER_GROUP']['value'] == $role['rid'] ? "selected='selected'" : "";
        				$config['DEFAULT_MEMBER_GROUP']['html'] .= "<option value='{$role['rid']}' {$checked}>{$role['rname']}</option>";
        			}  
                }
                //p($roleData);die;
                
            }
            
            $config['DEFAULT_MEMBER_GROUP']['html'] .= '</select>';
            
            if(isset($config['EMAIL_PASSWORD']['value'])){
                //邮箱密码设置字段为PASSWORD
			     $config['EMAIL_PASSWORD']['html']="<input type='password' name='EMAIL_PASSWORD' value='{$config['EMAIL_PASSWORD']['value']}' class='w400'/>";
            }
			
            
            
            //======================================默认语言选择
            $languages=getEnableLan();
            $config['LANGUAGE']['html'] = '<select name="LANGUAGE">';
            if(!empty($languages)){
                if(isset($config['LANGUAGE']['value'])){
                    foreach ($languages as $lank=>$lanv) {
        				$checked = $config['LANGUAGE']['value'] == $lank ? "selected='selected'" : "";
        				$config['LANGUAGE']['html'] .= "<option value='{$lank}' {$checked}>{$lanv}</option>";
        			} 
                }
            }
            
            $config['LANGUAGE']['html'] .= '</select>';
            //die;
            //========================================水印位置
			ob_start();
			require TPL_PATH . 'Config/water.php';
			$con = ob_get_clean();
			$config['WATER_POS']['html'] = $con;
            //=======================================其他字段
			foreach ($config as $name => $c) {
		          if (in_array($name, array('DEFAULT_MEMBER_GROUP', 'WATER_POS','EMAIL_PASSWORD','LANGUAGE')))
					continue;
                  switch ($c['show_type']) {
					case '数字' :
					case '文本' :
						$config[$name]['html'] = "<input type='text' name='{$c['name']}' value='{$c['value']}' class='w400'/>";
						break;
					//布尔
					case '布尔(1/0)' :
						$Yes = $No = '';
						if ($c['value'] == 1) {
							$Yes = "checked='checked'";
						} else {
							$No = "checked='checked'";
						}
						$config[$name]['html'] = "<label><input type='radio' name='{$c['name']}' value='1'  $Yes/> 是</label>
                                        <label><input type='radio' name='{$c['name']}' value='0' $No/> 否</label>";
						break;
					//多行文本
					case '多行文本' :
						$config[$name]['html'] = "<textarea class='w400 h100' name='{$c['name']}'>{$c['value']}</textarea>";
						break;
                    case 'select' :
                        $temp_html='';
                        $temp_selects=split(',',$c['store_range']);
                        foreach($temp_selects as $store_range_key=>$store_range_value){
                            $checked_str="";
                            if($store_range_value==$c['value'])
                            {
                                $checked_str="checked='true'";
                            }
                            $temp_html.="<label><input type='radio' name='{$c['name']}' value='".$store_range_value."'  $checked_str /> ".L($c['title'].'_select'.$store_range_value)."</label>&nbsp;&nbsp;";
                        }
                        $config[$name]['html'] = $temp_html;
                        break;
                    case 'image':
                        $temp_html='';
                        $temp_html.="<input id='{$c['name']}' type='text' name='{$c['name']}'  value='{$c['value']}' src='{$c['value']}' class='w300 images' onmouseover='view_image(this)'/>";
                        $temp_html.="<button class='zh-cancel-small' onclick='file_upload({\"id\":\"{$c['name']}\",\"type\":\"image\",\"dir\":\"config\",\"num\":1,\"name\":\"{$c['name']}\",\"filetype\":\"jpg,png,gif,jpeg\",\"upload_img_max_width\":\"800\",\"upload_img_max_height\":\"800\"})' type='button'>图片上传</button>&nbsp;&nbsp;";
                        $temp_html.="<button class='zh-cancel-small' onclick='remove_upload_one_img(this)' type='button'>取消</button>";
                        $config[$name]['html'] = $temp_html;
                        break;
				}
                
            }
            $this -> assign("config", $config);
            $this -> assign("webid", $webid);
			$this -> display();
       }
	}
    
    //验证EMAIL发送
	public function checkEmail(){
        $Config  = array(
			'EMAIL_USERNAME'=>$_POST['EMAIL_USERNAME'],
			'EMAIL_PASSWORD'=>$_POST['EMAIL_PASSWORD'],
			'EMAIL_HOST'=>$_POST['EMAIL_HOST'],
			'EMAIL_PORT'=>$_POST['EMAIL_PORT'],
			'EMAIL_SSL'=>false,
			'EMAIL_CHARSET'=>'utf-8',
			'EMAIL_FORMMAIL'=>$_POST['EMAIL_USERNAME'],
			'EMAIL_FROMNAME'=>$_POST['EMAIL_FROMNAME'],
		);
		C($Config);
        $state = Mail::send("zh860418@163.com","周鸿","ZHCMSシステムテストメール","使用者サイト:".__HOST__);
        if($state){
			$this->success('メールアドレス配置正確、送信OK!');
		}else{
			$this->error('メールアドレス配置エラー...');
		}
        
	}
    
    //更新缓存
	public function updateCache() {
		$Model = K('config');
		if ($Model -> updateCache()) {
			$this -> success('キャッシュ更新成功！');
		} else {
			$this -> error($Model -> error);
		}
	}
    
}
