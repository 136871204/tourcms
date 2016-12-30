<?php

/**
 * 插件安装
 * Class InstallControl
 */
class PluginControl extends AuthControl {
	private $_db;
	//插件环境错误
	private $_error;
	public function __init() {
		$this -> _db = K("Plugin");
	}

	/**
	 * 插件列表
	 */
	public function plugin_list() {
		$Model = K("Plugin");
		$dir = Dir::tree('zh/Plugin');
		$plugin = array();
		if (!empty($dir)) {
			foreach ($dir as $d) {
				//插件应用名
				$app = $d['name'];
				$conf = require "zh/Plugin/$app/Config/config.php";
				$conf['app'] = $app;
				//转为小写，方便视图调用
				$conf = array_change_key_case_d($conf);
				$plugin[$d['name']] = $conf;
				$plugin[$d['name']]['dirname'] = $app;
				//是否安装
				$installed = $Model -> where("app='$app'") -> find();
				$plugin[$d['name']]['installed'] = $installed ? 1 : 0;
			}
		}
		$this -> assign("plugin", $plugin);
		$this -> display();
	}

	/**
	 * 验证插件
	 */
	private function check_plugin($plugin) {
		$pluginDir = 'zh/Plugin/' . $plugin . '/';
		//安装sql检测
		if (!is_file($pluginDir . 'Data/install.sql')) {
			$this -> _error = L('admin_plugin_control_check_plugin_error1');
			return false;
		}
		//删除sql
		if (!is_file($pluginDir . 'Data/uninstall.sql')) {
			$this -> _error = L('admin_plugin_control_check_plugin_error2');
			return false;
		}
		//删除sql
		if (!is_file($pluginDir . 'Data/help.php')) {
			$this -> _error = L('admin_plugin_control_check_plugin_error3');
			return false;
		}
		//检测配置文件
		if (!is_file($pluginDir . 'Config/config.php')) {
			$this -> _error = L('admin_plugin_control_check_plugin_error4');
			return false;
		}
		return true;
	}

	//安装插件
	public function install() {
		$plugin = Q('plugin', null);
		if (!$this -> check_plugin($plugin)) {
			$this -> error($this -> _error);
		}

		if (!$plugin) {
			$this -> error(L('admin_plugin_control_install_message1'));
			exit ;
		}
		if (IS_POST) {
			//检测插件是否已经存在
			if ($this -> _db -> where(array('app' => $plugin)) -> find()) {
				$this -> error = L('admin_plugin_control_install_message2');
			}
			//创建数据表
			$installSql = "zh/Plugin/{$plugin}/Data/install.sql";
			if (is_file($installSql)) {
				$sqls = explode(';', file_get_contents($installSql));
				if (!empty($sqls) && is_array($sqls)) {
					foreach ($sqls as $sql) {
						$sql = trim($sql);
						if (empty($sql)) {
							continue;
						}
						if (! M() -> exe($sql)) {
							$this -> error(L('admin_plugin_control_install_message3'));
						}
					}
				} else {
					$this -> error(L('admin_plugin_control_install_message4'));
				}
			}
			$data =
			require 'zh/Plugin/' . $plugin . '/Config/config.php';
			$data = array_change_key_case_d($data);
			$data['app'] = $plugin;
			$data['install_time'] = date("Y-m-d");
			//添加菜单
			if ($this -> _db -> add($data)) {
				$data = array('title' => $data['name'], //节点名称
				'app_group' => 'Plugin', //应用组
				'app' => $plugin, //应用名称
				'control' => 'Manage', //默认控制器
				'method' => 'index', //默认方法
				'state' => 1, //状态
				'pid' => 94, //父级菜单id(正在使用)
				'plugin' => 1, //是否为插件
				'type' => 2, //普通菜单
				);
				M('node') -> add($data);
				$NodeModel = K('Node');
				$NodeModel -> updateCache();
				$this -> success(L('admin_plugin_control_install_message5'));
			} else {
				$this -> error(L('admin_plugin_control_install_message6'));
			}
		} else {
			//分配配置项
			$field = array_change_key_case_d(
			require 'zh/Plugin/' . $plugin . '/Config/config.php');
			$field['plugin'] = $plugin;
			$this -> field = $field;
			$this -> display();
		}
	}

	//卸载插件
	public function uninstall() {
		$plugin = Q('plugin', null);
		if (!$plugin) {
			$this -> error(L('admin_plugin_control_uninstall_message1'));
			exit ;
		}
		if (IS_POST) {
			$uninstallSql = "zh/Plugin/{$plugin}/Data/uninstall.sql";
			if (is_file($uninstallSql)) {
				$sqls = explode(';', file_get_contents($uninstallSql));
				if (!empty($sqls) && is_array($sqls)) {
					foreach ($sqls as $sql) {
						$sql = trim($sql);
						if (empty($sql)) {
							continue;
						}
						if (! M() -> exe($sql)) {
							$this -> error(L('admin_plugin_control_uninstall_message2'));
						}
					}
				} else {
					$this -> error(L('admin_plugin_control_uninstall_message3'));
				}
			}
			//删除Plugin表信息
			$this -> _db -> del("app='$plugin'");
			//删除插件菜单信息
			M('node') -> where(array('app_group' => 'Plugin', 'app' => $plugin)) -> del();
			$NodeModel = K('Node');
			$NodeModel -> updateCache();
			//删除文件
			if (Q('del_dir')) {
				if (!dir::del('zh/Plugin/' . $plugin)) {
					$this -> error(L('admin_plugin_control_uninstall_message4'));
				}
			}
			$this -> success(L('admin_plugin_control_uninstall_message5'));
		} else {
			//分配配置项
			$field = array_change_key_case_d(
			require 'zh/Plugin/' . $plugin . '/Config/config.php');
			$field['plugin'] = $plugin;
			$this -> assign("field", $field);
			$this -> display();
		}
	}

	//使用帮助
	public function help() {
		$plugin = Q('plugin');
		$help_file = "zh/Plugin/" . $plugin . '/Data/help.php';
		if (is_file($help_file)) {
			$this -> help = file_get_contents($help_file);
			$this -> display();
		}
	}

}
