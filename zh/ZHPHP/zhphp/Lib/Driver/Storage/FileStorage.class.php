<?php
/**
 * 文件存储
 * @author 周鸿 <136871204@qq.com>
 */
class FileStorage {
	private $contents = array();
	/**
	 * 储存内容
	 * @param string $fileName 文件名
	 * @param string $content 数据
	 */
	public function save($fileName, $content) {
	   //dirname() 函数返回路径中的目录部分。
		$dir = dirname($fileName);
        //创建目录
		Dir::create($dir);
        //生成文件
		if (file_put_contents($fileName, $content) === false) {
			halt("创建文件{$fileName}失败");
		}
        //缓存文件内容
		$this -> contents[$fileName] = $content;
		return true;
	}

	/**
	 * 获得
	 * @param string $fileName 文件名
	 */
	public function get($fileName) {
		if (isset($this -> contents[$fileName])) {
			return $this -> contents[$fileName];
		}
		if (!is_file($fileName)) {
			return false;
		}
		$content = file_get_contents($fileName);
		$this -> contents[$fileName] = $content;
		return $content;
	}

}
