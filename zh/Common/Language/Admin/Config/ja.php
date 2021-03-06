<?php
if (!defined("ZHPHP_PATH")) exit('No direct script access allowed');

return array(

    
    //管理画面，全站设置画面
    'admin_config_page_title'=>'サイト設置',
    'admin_config_page_hot_hint'=>'暖かい提示',
    'admin_config_page_help1'=>'テンプレート中、設置項目の使い方{ $zh.config.変数名称}',
    'admin_config_page_help2'=>'設置項目を正しく設定してください、不正な設置はサイトの性能と安全に影響する',
    'admin_config_page_help3'=>'設置項目がよくわからない場合、修正しないでください',
    'admin_config_page_tab_site'=>'サイト設置',
    'admin_config_page_tab_weixinweibo'=>'微信微博',
    'admin_config_page_tab_custom_service'=>'問い合わせ設置',
    'admin_config_page_tab_static'=>'偽静態',
    'admin_config_page_tab_upload'=>'アップロード設置',
    'admin_config_page_tab_member'=>'会員設置',
    'admin_config_page_tab_content'=>'内容関係',
    'admin_config_page_tab_water'=>'water mark設置',
    'admin_config_page_tab_safe'=>'安全配置',
    'admin_config_page_tab_speed'=>'性能最適化',
    'admin_config_page_tab_email'=>'メールアドレス設置',
    'admin_config_page_tab_cookie'=>'COOKIE設置',
    'admin_config_page_tab_session'=>'SESSION設置',
    'admin_config_page_tab_ec_shop_info'=>'ショップ情報',
    'admin_config_page_tab_ec_basic'=>'EC基本設置',
    'admin_config_page_tab_ec_display'=>'EC表示設置',
    'admin_config_page_table_th_title'=>'タイトル',
    'admin_config_page_table_th_config'=>'配置',
    'admin_config_page_table_th_variable'=>'変数',
    'admin_config_page_table_th_desc'=>'説明',
    
    
    'admin_config_allday_phone'=>'24時間連絡番号',
    'admin_config_weibo_link'=>'微博リンク先',
    'admin_config_weichat_qr'=>'微チャットQR',
    'admin_config_webname'=>'サイト名称',
    'admin_config_language'=>'サイト言語',
    'admin_config_icp'=>'ICP',
    'admin_config_html_path'=>'静態html目録',
    'admin_config_copyright'=>'サイト権利情報',
    'admin_config_keywords'=>'サイトキーワード',
    'admin_config_description'=>'サイト説明',
    'admin_config_email'=>'管理者メールアドレス',
    'admin_config_backup_dir'=>'データバックアップディレクトリ',
    'admin_config_web_open'=>'サイトオープン',
    'admin_config_auth_key'=>'cookie暗号化KEY',
    'admin_config_upload_path'=>'アップロード目録',
    'admin_config_upload_img_path'=>'画像アップロードするディレクトリ',
    'admin_config_allow_type'=>'アップロードタイプ',
    'admin_config_allow_size'=>'アップロードサイズ（バイト）',
    'admin_config_water_on'=>'アップロードwater mark',
    'admin_config_member_verify'=>'会員登録時審査必要ない',
    'admin_config_reg_show_code'=>'会員登録時検証番号check',
    'admin_config_web_title'=>'サイトタイトル',
    'admin_config_reg_interval'=>'2回登録の時間差',
    'admin_config_reg_interval_message'=>'単位は秒，0は設定しない',
    'admin_config_default_member_group'=>'新登録会員の処理グループ',
    'admin_config_token_on'=>'トークン検証',
    'admin_config_log_key'=>'ログファイル暗号化KEY',
    'admin_config_session_name'=>'SESSION_NAME値',
    'admin_config_session_name_message'=>'普通は修正する必要なし',
    'admin_config_super_admin_key'=>'サイトマスタトークン名称',
    'admin_config_tel'=>'連絡電話番号',
    'admin_config_water_text'=>'water mark文字',
    'admin_config_water_text_size'=>'文字サイズ',
    'admin_config_water_img'=>'water mark画像',
    'admin_config_water_pct'=>'water mark透明度',
    'admin_config_water_quality'=>'画像圧縮率',
    'admin_config_water_pos'=>'water mark位置',
    'admin_config_del_content_model'=>'文章削除する時、未審査にする',
    'admin_config_create_index_html'=>'トップページ作成',
    'admin_config_reply_credits'=>'コメントの積分',
    'admin_config_reply_credits_message'=>'会員コメントの積分',
    'admin_config_down_remote_pic'=>'遠隔画像ダウンロード',
    'admin_config_auto_desc'=>'内容を切り取って要約にする',
    'admin_config_auto_thumb'=>'内容画像を切り取って、サムネイルにする',
    'admin_config_upload_img_max_width'=>'画像max width',
    'admin_config_upload_img_max_width_message'=>'画像をアップロードする幅を超える時、リサイズする',
    'admin_config_upload_img_max_height'=>'画像max height',
    'admin_config_upload_img_max_height_message'=>'画像をアップロードする幅を超える時、リサイズする',
    'admin_config_member_open'=>'会員センタオーポン',
    'admin_config_web_close_message'=>'サイトを閉じる時のメッセージ',
    'admin_config_web_style'=>'サイトテンプレート',
    'admin_config_qq'=>'QQ番号',
    'admin_config_weibo'=>'sina weibo',
    'admin_config_tweibo'=>'qq weibo',
    'admin_config_enterprise_email'=>'企業メールアドレス',
    'admin_config_init_credits'=>'初期積分',
    'admin_config_cache_index'=>'トップページキャッシュ時間',
    'admin_config_cache_index_message'=>'秒単位、0：キャッシュしない',
    'admin_config_cache_category'=>'カテゴリキャッシュ時間',
    'admin_config_cache_category_message'=>'秒単位、0：キャッシュしない',
    'admin_config_cache_content'=>'文章キャッシュ時間',
    'admin_config_cache_content_message'=>'秒単位、0：キャッシュしない',
    'admin_config_comment_step_time'=>'評論時間間隔',
    'admin_config_comment_step_time_message'=>'秒単位、>1は必要',
    'admin_config_pathinfo_type'=>'偽静態開く',
    'admin_config_pathinfo_type_message'=>'環境設定必要',
    'admin_config_open_rewrite'=>'Rewrite機能開く',
    'admin_config_open_rewrite_message'=>'1:サーバはRewrtie機能支持 2:ZHCMS/htaccess.txtをhtaccess',
    'admin_config_email_username'=>'メールアドレス名',
    'admin_config_email_password'=>'メールアドレスパスワード',
    'admin_config_email_host'=>'smtp　アドレス',
    'admin_config_email_port'=>'smtp　ポート',
    'admin_config_email_fromname'=>'送信者',
    'admin_config_cookie_expire'=>'Coodie有效期',
    'admin_config_cookie_domain'=>'Cookie　ドメイン名',
    'admin_config_cookie_path'=>'Cookie ディレクトリ',
    'admin_config_session_domain'=>'SESSION　ドメイン名',
    'admin_config_member_email_validate'=>'登録時メールアドレス検証必要',
    'admin_config_web_domain'=>'サイトドメイン',
    'admin_config_use_storage'=>'在庫管理起用',
    'admin_config_default_storage'=>'デフォルト在庫数',
    'admin_config_market_price_rate'=>'市場価額比率',
    'admin_config_market_price_rate_message'=>'商品価額を入力する時、自動的に市場の価額を計算する',
    'admin_config_integral_percent'=>'ポイント支払う比率',
    'admin_config_integral_percent_message'=>'商品の値段が100元段階で、支払えられるポイント数',
    'admin_config_price_format'=>'商品価額表示ルール',
    'admin_config_price_format_select0'=>'不处理',
    'admin_config_price_format_select1'=>'保留不为 0 的尾数',
    'admin_config_price_format_select2'=>'不四舍五入，保留一位小数',
    'admin_config_price_format_select3'=>'不四舍五入，不保留小数',
    'admin_config_price_format_select4'=>'先四舍五入，保留一位小数',
    'admin_config_price_format_select5'=>'先四舍五入，不保留小数 ',
    'admin_config_currency_format'=>'価額フォーマット',
    'admin_config_currency_format_message'=>'商品価額表示する時のフォーマット，%sは対応の価額を入れ替わる',
    'admin_config_time_format'=>'時間フォーマット',
    'admin_config_bgcolor'=>'サムネイル背景色',
    'admin_config_bgcolor_message'=>'色は#FFFFFFのフォーマットで入力',
    'admin_config_auto_generate_gallery'=>'アップする商品には自動的にアルバム画像を作成',
    'admin_config_ec_image_width'=>'サムネイル寬',
    'admin_config_ec_image_height'=>'サムネイル高',
    'admin_config_ec_watermark_place'=>'水印位置',
    'admin_config_ec_watermark_place_select0'=>'无',
    'admin_config_ec_watermark_place_select1'=>'左上',
    'admin_config_ec_watermark_place_select2'=>'右上',
    'admin_config_ec_watermark_place_select3'=>'真ん中',
    'admin_config_ec_watermark_place_select4'=>'左下',
    'admin_config_ec_watermark_place_select5'=>'右下',
    'admin_config_ec_watermark'=>'水印ファイル',
    'admin_config_ec_watermark_message'=>'水印ファイルはgifのファイルしか透明できません。',
    'admin_config_ec_watermark_alpha'=>'透明程度',
    'admin_config_ec_watermark_alpha_message'=>'水印の透明程度，入力値0-100。100は不透明を意味する。',
    'admin_config_ec_sn_prefix'=>'商品番号接頭字',
    'admin_config_ec_retain_original_img'=>'商品アップ時オリジナル画像保留する',
    'admin_config_ec_shop_notice'=>'ショップ知らせ',
    'admin_config_ec_shop_notice_message'=>'以上の内容はトップの知らせの中で表示する、入力長さをご注意。',
    'admin_config_ec_top10_time'=>'統計時間ランキング',
    'admin_config_ec_top10_time_select0'=>'すべて',
    'admin_config_ec_top10_time_select1'=>'一年',
    'admin_config_ec_top10_time_select2'=>'半年',
    'admin_config_ec_top10_time_select3'=>'三ヶ月',
    'admin_config_ec_top10_time_select4'=>'一ヶ月',
    'admin_config_ec_top_number'=>'売り上げランキング数',
    'admin_config_ec_goods_name_length'=>'商品名前表示長さ',
    'admin_config_ec_date_format'=>'日付フォーマット',
    'admin_config_ec_shop_name'=>'ショップ名',
    'admin_config_ec_index_ad'=>'トップメイン広告設置',
    'admin_config_ec_article_number'=>'最新文章表示数',
    'admin_config_ec_article_title_length'=>'文章タイトル長さ',
    'admin_config_ec_recommend_order'=>'お勧め商品ソート',
    
    
);
?>
