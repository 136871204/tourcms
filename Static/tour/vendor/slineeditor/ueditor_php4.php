<?php

class UEditor{
    var $initialized = false;
    var $timestamp = "ABH04T2";
    var $returnOutput = false;

    function UEditor($basePath = null) {
		if (!empty($basePath)) {
			$this->basePath = $basePath;
		}
	}

    function editor($name, $value = "", $config = array(), $events = array())
	{
        $out = "";
        if (!$this->initialized) {
			$out .= $this->init();
		}
        $out .= '<div id="' . $name . '" style="width:' . $config['minWidth'] . 'px; margin:5px 0px 5px 5px; text-indent:0;"></div>';
        $config['UEDITOR_HOME_URL'] = $this->ueditorPath();
        $config['textarea'] = $name;
        $config['initialContent'] = $value;
		$config['wordCount'] = false;
		$config['elementPathEnabled'] = false;
		$config['autoHeightEnabled'] = false;

        $_config = $this->configSettings($config, $events);
        $str = 'var options' . $name . ' = '.$this->jsEncode($_config).';';
        $str .= "var " . $name . "Editor = new baidu.editor.ui.Editor(options" . $name . ");";
        $str .= $name . 'Editor.render("' . $name . '")';
        $out .= $this->script($str);
		if (!$this->returnOutput) {
			print $out;
			$out = "";
		}
		return $out;
	}

    function configSettings($config = array(), $events = array())
	{

		$_config = $this->config;
		$_events = $this->events;

		if (is_array($config) && !empty($config)) {
			$_config = array_merge($config);
		}

		if (is_array($events) && !empty($events)) {
			foreach ($events as $eventName => $code) {
				if (!isset($_events[$eventName])) {
					$_events[$eventName] = array();
				}
				if (!in_array($code, $_events[$eventName])) {
					$_events[$eventName][] = $code;
				}
			}
		}
		if (!empty($_events)) {
			foreach($_events as $eventName => $handlers) {
				if (empty($handlers)) {
					continue;
				}
				else if (count($handlers) == 1) {
					$_config['on'][$eventName] = '@@'.$handlers[0];
				}
				else {
					$_config['on'][$eventName] = '@@function (ev){';
					foreach ($handlers as $handler => $code) {
						$_config['on'][$eventName] .= '('.$code.')(ev);';
					}
					$_config['on'][$eventName] .= '}';
				}
			}
		}
		return $_config;
	}
    
    function ueditorPath()
	{
		if (!empty($this->basePath)) {
			return $this->basePath;
		}
		if (isset($_SERVER['SCRIPT_FILENAME'])) {
			$realPath = dirname($_SERVER['SCRIPT_FILENAME']);
		}
		else {
			$realPath = realpath( './' ) ;
		}

		$selfPath = dirname($_SERVER['PHP_SELF']);
		$file = str_replace("\\", "/", __FILE__);

		if (!$selfPath || !$realPath || !$file) {
			return "/slineeditor/";
		}

		$documentRoot = substr($realPath, 0, strlen($realPath) - strlen($selfPath));
		$fileUrl = substr($file, strlen($documentRoot));
		$ueditorUrl = str_replace("ueditor_php5.php", "", $fileUrl);

		return $ueditorUrl;
	}

    function script($js)
	{
		$out = "<script type=\"text/javascript\">";
		$out .= "//<![CDATA[\n";
		$out .= $js;
		$out .= "\n//]]>";
		$out .= "</script>\n";

		return $out;
	}

    function init()
	{
		static $initComplete;
		$out = "";

		if (!empty($initComplete)) {
			return "";
		}

		if ($this->initialized) {
			$initComplete = true;
			return "";
		}

		$args = "";
		$ueditorPath = $this->ueditorPath();

		if (!empty($this->timestamp) && $this->timestamp != "%"."TIMESTAMP%") {
			$args = '?t=' . $this->timestamp;
		}

		if (strpos($ueditorPath, '..') !== 0) {
			$out .= $this->script("window.UEDITOR_HOME_URL='". $ueditorPath ."';");
		}

        $out .= "<script type=\"text/javascript\" src=\"" . $ueditorPath . 'js/editor_config.js' . $args . "\"></script>\n";
		$out .= "<script type=\"text/javascript\" src=\"" . $ueditorPath . 'js/editor_ui_all.js' . $args . "\"></script>\n";
        $out .= "<link rel='stylesheet' type='text/css' href='".$ueditorPath."themes/default/ueditor.css'/>\n";

		$initComplete = $this->initialized = true;

		return $out;
	}

    function jsEncode($val)
	{
		if (is_null($val)) {
			return 'null';
		}
		if ($val === false) {
			return 'false';
		}
		if ($val === true) {
			return 'true';
		}
		if (is_scalar($val))
		{
			if (is_float($val))
			{
				$val = str_replace(",", ".", strval($val));
			}

			if (strpos($val, '@@') === 0) {
				return substr($val, 2);
			}
			else {
				static $jsonReplaces = array(array("\\", "/", "\n", "\t", "\r", "\b", "\f", '"'),
				array('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"'));

				$val = str_replace($jsonReplaces[0], $jsonReplaces[1], $val);

				return '"' . $val . '"';
			}
		}
		$isList = true;
		for ($i = 0, reset($val); $i < count($val); $i++, next($val))
		{
			if (key($val) !== $i)
			{
				$isList = false;
				break;
			}
		}
		$result = array();
		if ($isList)
		{
			foreach ($val as $v) $result[] = $this->jsEncode($v);
			return '[ ' . join(', ', $result) . ' ]';
		}
		else
		{
			foreach ($val as $k => $v) $result[] = $this->jsEncode($k).': '.$this->jsEncode($v);
			return '{ ' . join(', ', $result) . ' }';
		}
	}
}
?>