<?php

//模板选择（后台文章与栏目更改模板使用）
class TemplateSelectControl extends AuthControl
{
    //选择模板文件（内容页与栏目管理页使用)
    public function select_tpl()
    { 
        $this->display();
    }
	//获得模板列表
	public function getFileList(){
		$stylePath = ROOT_PATH . 'template/' . C("WEB_STYLE").'/';
        $path = Q("request.path", '',"urldecode");
		if($path){
			$history = __METH__.'&path='.urlencode(dirname($path));
			$dir = $path;
		}else{
			$history='';
			$dir = $stylePath;
		}
        $file = Dir::tree($dir, "htm");
        foreach ($file as $n => $v) {
            if ($v['type'] == 'dir') {
                $file[$n]['url'] = __METH__.'&path='.urlencode($v['path']);
            } else {
            	$startPos=strrpos($stylePath, C("WEB_STYLE"))+strlen(C("WEB_STYLE"))+1;
                $file[$n]['path'] = substr($v['path'],$startPos);
            }
        }
		$this->assign('history',$history);
		$this->assign('file',$file);
		echo $this->fetch();exit;
	}
}