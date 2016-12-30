<?php
/**
 * 用户管理模型
 * Class UserModel
 */
class AdminLogModel extends ViewModel {
    public $table = "admin_log";
    
    /**
     * 记录管理员的操作内容
     *
     * @access  public
     * @param   string      $sn         数据的唯一值
     * @param   string      $action     操作的类型
     * @param   string      $content    操作的内容
     * @return  void
     */
    function admin_log($sn = '', $action, $content)
    {
        $log_info = $action . $content .': '. addslashes($sn);
    
        $attr = array(
                'log_time'          => gmtime(),
                'user_id'       => $_SESSION['uid'],
                'log_info'      => stripslashes($log_info),
                'ip_address' => real_ip(),
            );
        $this->insert($attr);
    }



}
?>