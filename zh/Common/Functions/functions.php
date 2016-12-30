<?php
if (!defined("ZHPHP_PATH"))
	exit ;

function editTextArea($text){
    $text=str_replace(" ","&nbsp;",$text);
    $text=nl2br($text);
    return $text;
}


function getExternalData($mid,$externalStr){
    //var_dump(explode('_',$externalStr));die;
    $ContentModel = ContentViewModel::getInstance($mid);
    
    //$map['aid'] = array('in' ,explode('_',$externalStr));
    $whereStr= $ContentModel -> tableFull . '.aid IN(' . implode(',', explode('_',$externalStr)) . ')';
    $data=$ContentModel-> where($whereStr)->all();
    for($i=0;$i<count($data);$i++){
        $ContentOutModel = new ContentOutModel($mid);
        $data[$i]=$ContentOutModel -> get($data[$i]);
    }

    return $data;
}

function getFiledValue($key,$data){
    if(count($data)==1){
        echo  $data[0][$key];
    }
}

function getWebSiteName($webid){
    $result=K("Weblist")->where(array('id'=>$webid))->field('webname')->find();
    return  $result['webname'];
    //return K("Weblist")->where(array('id'=>$webid))->field('webname')->find();
}

/**
 * ZHCMS缓存函数
 * @param String $name 缓存KEY
 * @param bool $value 删除缓存
 * @return bool
 */
function cache($name, $value = false, $CachePath = 'data/cache/Data') {
	if ($value === false) { 
		return F($name, false, $CachePath);
	} else {
		return F($name, $value, $CachePath);
	}
}


/**
 * 获得栏目
 * @param int $cid 栏目cid
 * @param int $type 1 子栏目  2 父栏目
 * @param int $returnType 1 只有cid  2 内容
 */
function getCategory($cid, $type = 1, $return = 1) {
	$cache = cache('category');
	$cat = $catid = array();
	if ($type == 1) {//子栏目
		$cat = Data::channelList($cache, $cid);
	} else if ($type == 2) {//父栏目
		$cat = parentChannel($cache, $cid);
	}
	if ($return == 1) {//返回cid
		foreach($cat as $c){
			$catid[]=$c['cid'];
		}
		$catid[] = $cid;
		return $catid;
	} else if ($return == 2) {//返回所有栏目数据
		$cat[] = $cache[$cid];
	}
	return $cat;
}

//添加会员动态
function addDynamic($uid, $conent) {
	K('UserDynamic') -> addDynamic($uid, $conent);
}

//发送系统信息
function addSystemMessage($uid, $message) {
	K('SystemMessage') -> addSystemMessage($uid, $message);
}

function getAttrInputTypeArray(){
    $attr_input_type_arr=array(
        0=> '手工录入',
        1=> '从列表中选择',
        2=> '多行文本框',
        );
    return $attr_input_type_arr;
}

function getList(){
    
    $lists = array();
    
    /**
     * key值对应webid
     */
    $lists["jobtime"] = array(
        "1" => "<table><tbody><tr><th>周一至周五：</th><td>09:00~18:00</td></tr><tr><th>周六：</th><td>11:00~18:00</td></tr></tbody></table>",
        "2" => "<table><tbody><tr><th>周一至周六：</th><td>09:30~18:00</td></tr></tbody></table>",
        "3" => "<table><tbody><tr><th>周一至周五：</th><td>09:30~18:00</td></tr></table>",
        "6" => "<table><tbody><tr><th>周一至周五：</th><td>10:00~18:00</td></tr></tbody></table>",
    );
    $lists["histel"] = array(
        "1" => "020-2223-0218",
        "2" => "021-3331-2136",
        "3" => "010-6539-1864",
        "6" => "021-3331-2136",
    );
    
    $lists["status"] = array(
        "0" => "未处理",
        "1" => "处理中",
        "2" => "交易成功",
        "3" => "取消订单",
    );
    
    return $lists;
    
}
