<?php
/**
 * 用户管理模型
 * Class UserModel
 */
class LineJieshaoModel extends ViewModel {
    public $table = "line_jieshao";
    
    
    public function deleteByLineId($lineid)
    {
        $sql = "delete from ".$this->tableFull." where lineid = '$lineid'";
        //echo $sql;exit;
        $this->exe($sql);
        //$this->exe($lineid);
    }
    
}
?>