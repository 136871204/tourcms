<?php
/**
 * 权限模型
 * Class AccessModel
 * @author 周鸿 <136871204@qq.com>
 */
class ConfigModel extends Model {
    public $table = "config";
    
    //修改配置文件
	public function saveConfig($configData) {
	    $webid = $configData['webid'];
	    if (!is_array($configData)) {
			$this -> error = 'データは必須';
			return false;
		}
        if(isset($configData['SESSION_DOMAIN'])){
            //SESSION域名验证
    		$sessionDomain = trim($configData['SESSION_DOMAIN'],'.');
            if(!empty($sessionDomain) && !strpos(__ROOT__, $sessionDomain)){
    			$this->error='SESSIONドメイン設定ミス';
    			return false;
    		}
        }
        
        if(isset($configData['COOKIE_DOMAIN'])){
            //Cookie有效域名
    		$cookieDomain = trim($configData['COOKIE_DOMAIN'],'.');
    		if(!empty($cookieDomain) && !strpos(__ROOT__, $cookieDomain)){
    			$this->error='COOKIEドメイン設定ミス';
    			return false;
    		}
        }
        
        if(isset($configData['ALLOW_SIZE'])){
            //上传文件大小
    		if(intval($configData['ALLOW_SIZE'])<100000){
    			$this->error='アップロードファイルは >　100KB';
    			return false;
    		}
        }
        
        if(isset($configData['ALLOW_TYPE'])){
            //允许上传类型
    		if(empty($configData['ALLOW_TYPE'])){
    			$this->error='アップロードタイプは必須';
    			return false;
    		}
        }
        
        if(isset($configData['OPEN_REWRITE'])){
            //伪静态检测
    		if($configData['OPEN_REWRITE']==1 && !is_file('.htaccess')){
    			$this->error='.htaccessファイルは存在しない，オープンRewrite失敗';
    			return false;
    		}
        }
        
        //将数组键名变成大写
        $configData = array_change_key_case_d($configData, 1);
        foreach ($configData AS $name => $value) {
			$this -> where(array('name' => $name,'webid'=>$webid )) -> save(array('name' => $name, 'value' => $value));
		}
        return $this -> updateCache($webid);
    }
    
    //更新配置文件
	public function updateCache($webid) {
        $configData = $this -> where(array('webid'=>1 )) -> order('order_list ASC') -> all();
        $data = array();
		foreach ($configData as $c) {
			$name = strtoupper($c['name']);
			$data[$name] = $c['value'];
		}
        //写入配置文件
		$content = "<?php if (!defined('ZHPHP_PATH')) exit; \nreturn " . var_export($data, true) . ";\n?>";
        file_put_contents("data/config/config.inc.php", $content);
        
        $siteConfigData = $this -> where(array('webid'=>$webid )) -> order('order_list ASC') -> all();
        $siteData = array();
		foreach ($siteConfigData as $c) {
			$name = strtoupper($webid.'_'.$c['name']);
			$siteData[$name] = $c['value'];
		}
        //写入配置文件
		$siteContent = "<?php if (!defined('ZHPHP_PATH')) exit; \nreturn " . var_export($siteData, true) . ";\n?>";
		return file_put_contents("data/config/".$webid."_config.inc.php", $siteContent);
    }
}