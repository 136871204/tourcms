<?php
/**
 * 用户管理模型
 * Class UserModel
 */
class TourMemberOrderModel extends ViewModel {
    public $table = "tour_member_order";
    
    
    /*
     * 返积分操作
     * */
    public  function refundJifen($orderid)
    {
        /*$row = $this->find($orderid)
        if(isset($row))
        {
            $memberid = $row['memberid'];
            $jifenbook = intval($row['jifenbook']);
            $member = ORM::factory('member')->where("mid=$memberid");
            $member->jifen = intval($member->jifen) + $jifenbook;
            $member->save();
            if($member->saved())
            {
                $memberid = $member->mid;
                $content = "预订{$row['productname']}获得{$jifenbook}积分";
                self::addJifenLog($memberid,$content,$jifenbook,2);
            }

        }*/

    }
    
    /*
     * 返库存操作
     * */
    public  function refundStorage($orderid,$op)
    {
        $row = $this->where('id='.$orderid)->find();
        if(isset($row))
        {
            $dingnum = intval($row['dingnum'])+intval($row['childnum']);
            $suitid = $row['suitid'];
            $productid = $row['productautoid'];
            $typeid = $row['typeid'];
            $usedate = strtotime($row['usedate']);


            $storage_table=array(
                    '1'=>'zh_line_suit_price',
                    '2'=>'zh_hotel_room_price',
                    '3'=>'zh_car_suit_price',
                    '5'=>'zh_spot_ticket',
                    '8'=>'zh_visa',
                    '13'=>'zh_tuan'
            );
            $table = $storage_table[$typeid];
            //加库存
            if($op=='plus')
            {
                if($typeid==1||$typeid==2||$typeid==3)
                 $sql = "update {$table} set number=number+$dingnum where day='$usedate' and suitid='$suitid'";
                else
                 $sql = "update {$table} set number=number+$dingnum where id=$productid";
            }
            else if($op=='minus')
            {
                if($typeid==1||$typeid==2||$typeid==3)
                    $sql = "update {$table} set number=number-$dingnum where day='$usedate' and suitid='$suitid'";
                else
                    $sql = "update {$table} set number=number-$dingnum where id=$productid";
            }
            M()->exe($sql);
            //DB::query(2,$sql)->execute();
        }
    }
    
    function checkForm($arr){
        $temp = array();
        if( $arr["linkman"] == "" ){
            $temp["linkman"] = "预定联系人姓名不能为空";
        }
        if( $arr["linktel"] == "" ){
            $temp["linktel"] = "联系手机不能为空";
        }elseif( !preg_match("/^[1][3|4|5|8]+\\d{9}/",$arr["linktel"]) ){
            $temp["linktel"] = "请输入正确的联系手机号码";
        }
        if( $arr["linkemail"] == "" ){
            $temp["linkemail"] = "邮箱不能为空";
        }
        if( $arr["handleshop"] == "" ){
            $temp["handleshop"] = "处理支店不能为空";
        }
        foreach( $arr["tourer"] as $key => $val ){
            foreach( $val as $k => $v ){
                if( mb_substr($k,0,-2) == "tourername" ){
                    if($v==""){
                        $temp[$k] = "姓名不能为空！";
                        continue;
                    }
                }
                if( mb_substr($k,0,-2) == "tourersex" ){
                    if($v==""){
                        $temp[$k] = "性别不能为空！";
                        continue;
                    }
                }
                if( mb_substr($k,0,-2) == "tourerfnamealp" || mb_substr($k,0,-2) == "tourerlnamealp" ){
                    if($v==""){
                        $temp["pinyin".mb_substr($k,-2,2)] = "姓名拼音不能为空！";
                        continue;
                    }
                }
            }
        }
        if( count($temp) !='0')
            return json_encode($temp);
        
        return false;
    }
    
}
?>