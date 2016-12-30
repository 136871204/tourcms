<?php
if (!defined("ZHPHP_PATH")) exit('No direct script access allowed');

return array(

    //controller
    'admin_plugin_control_check_plugin_error1'=>'インストールSQLファイルinstall.sql存在しない',
    'admin_plugin_control_check_plugin_error2'=>'アンインストールSQLファイルuninstall.sqlが存在しない',
    'admin_plugin_control_check_plugin_error3'=>'Pluginのヘルプファイルhelp.phpが存在しない',
    'admin_plugin_control_check_plugin_error4'=>'配置ファイルconfig.phpが存在しない',
    'admin_plugin_control_install_message1'=>'パラメタエラー',
    'admin_plugin_control_install_message2'=>'Pluginがすでに存在している、削除して後再インストールしてください',
    'admin_plugin_control_install_message3'=>'SQL失敗',
    'admin_plugin_control_install_message4'=>'インストールSQLファイルエラー',
    'admin_plugin_control_install_message5'=>'Pluginインストール成功',
    'admin_plugin_control_install_message6'=>'Pluginインストール失敗',
    'admin_plugin_control_uninstall_message1'=>'パラメタエラー',
    'admin_plugin_control_uninstall_message2'=>'SQL実行失敗',
    'admin_plugin_control_uninstall_message3'=>'アンインストールSQLファイルエラー',
    'admin_plugin_control_uninstall_message4'=>'インストールディレクトリ削除失敗',
    'admin_plugin_control_uninstall_message5'=>'Pluginアンインストール成功',
    
    
    //plugin_list page
    'admin_plugin_list_page_title'=>'Plugin一覧',
    'admin_plugin_list_page_tab1'=>'Plugin一覧',
    'admin_plugin_list_page_table_th1'=>'Plugin名称',
    'admin_plugin_list_page_table_th2'=>'バージョン',
    'admin_plugin_list_page_table_th3'=>'発表時間',
    'admin_plugin_list_page_table_th4'=>'開発チーム',
    'admin_plugin_list_page_table_th5'=>'Plugin状態',
    'admin_plugin_list_page_table_th6'=>'Pluginディレクトリ',
    'admin_plugin_list_page_table_th7'=>'管理',
    'admin_plugin_list_page_table_td_message1'=>'使い方',
    
    //help page
    'admin_plugin_help_page_title'=>'Plugin説明',
    'admin_plugin_help_page_tab1'=>'Plugin一覧',
    'admin_plugin_help_page_tab2'=>'Plugin説明',
    'admin_plugin_help_page_content_header'=>'Plugin説明',
    
    //uninstall php
    'admin_plugin_uninstall_page_title'=>'Plugin　アンインストール',
    'admin_plugin_uninstall_page_tab1'=>'Plugin一覧',
    'admin_plugin_uninstall_page_tab2'=>'Plugin　アンインストール',
    'admin_plugin_uninstall_page_form_header'=>'Plugin情報',
    'admin_plugin_uninstall_page_form_item1'=>'Plugin名称',
    'admin_plugin_uninstall_page_form_item2'=>'バージョン',
    'admin_plugin_uninstall_page_form_item3'=>'チーム名称',
    'admin_plugin_uninstall_page_form_item4'=>'発表時間',
    'admin_plugin_uninstall_page_form_item5'=>'サイト',
    'admin_plugin_uninstall_page_form_item6'=>'メールアドレス',
    'admin_plugin_uninstall_page_form_item7'=>'Pluginファイル処理方法',
    'admin_plugin_uninstall_page_form_item7_message1'=>'手動でファイルを削除する、アンインストールするだけ',
    'admin_plugin_uninstall_page_form_item7_message2'=>'ファイルをすべて削除する',
    'admin_plugin_uninstall_page_form_submit'=>'削除',
    
    //install php
    'admin_plugin_install_page_title'=>'Plugin　インストール',
    'admin_plugin_install_page_tab1'=>'Plugin一覧',
    'admin_plugin_install_page_tab2'=>'Plugin　インストール',
    'admin_plugin_install_page_form_header'=>'Plugin情報',
    'admin_plugin_install_page_form_item1'=>'Plugin名称',
    'admin_plugin_install_page_form_item2'=>'バージョン',
    'admin_plugin_install_page_form_item3'=>'チーム名称',
    'admin_plugin_install_page_form_item4'=>'発表時間',
    'admin_plugin_install_page_form_item5'=>'サイト',
    'admin_plugin_install_page_form_item6'=>'メールアドレス',
    'admin_plugin_install_page_form_submit'=>'インストール',
    
);
?>
