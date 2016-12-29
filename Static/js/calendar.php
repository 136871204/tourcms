<?php


$lang = (!empty($_GET['lang'])) ? trim($_GET['lang']) : 'zh';

if (!file_exists('./calendar/languages/' . $lang . '/calendar.php') || strrchr($lang,'.'))
{
    $lang = 'zh';
}

//require(dirname(dirname(__FILE__)) . '/data/config.php');
header('Content-type: application/x-javascript; charset=' . EC_CHARSET);

include_once('./calendar/languages/' . $lang . '/calendar.php');

foreach ($_LANG['calendar_lang'] AS $cal_key => $cal_data)
{
    echo 'var ' . $cal_key . " = \"" . $cal_data . "\";\r\n";
}

include_once('./calendar/calendar.js');

?>