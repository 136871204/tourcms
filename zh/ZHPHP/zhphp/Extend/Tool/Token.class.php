<?php
//.-----------------------------------------------------------------------------------
// |  Software: [ZHPHP framework]
// |   Version: 2014.06
// |-----------------------------------------------------------------------------------
// |    Author: 周鸿 <136871204@qq.com>
// | Copyright (c) 2014, 周鸿 <136871204@qq.com>.All Rights Reserved.
// |-----------------------------------------------------------------------------------
final class Token
{
    public static $key = "136871204@qq.com";
    
    /**
     * 创建令牌
     */
    static function create()
    {
        if (!is_null(session(C("TOKEN_NAME")))) {
            return session(C("TOKEN_NAME"));
        }
        $k = self::$key . mt_rand(1, 10000) . NOW . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT'];
        session(C("TOKEN_NAME"), md5($k));
    }
    
    /**
     * 验证令牌
     */
    static function check()
    {
        $tokenName = C("TOKEN_NAME");
        $key = session($tokenName);
        $cli_token = isset($_POST[$tokenName]) ? $_POST[$tokenName] :
            (isset($_GET[$tokenName]) ? $_GET[$tokenName] : NULL);
        return !is_null($key) && !is_null($cli_token) && ($key === $cli_token);
    }
    
}


?>