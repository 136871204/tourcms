<if value=" $type == 'weblist' ">
<!--站点选择弹出框-->
<div class="change-box-more" id="weblist_detail">
    <div class="level web_list">
        <a href="javascript:;" class="cur" onclick="CHOOSE.changeWeb(this,-1,'全部','{$resultid}')">全部</a>
        <foreach from="$weblist" value="$v" >
            <a href="javascript:;" onclick="CHOOSE.changeWeb(this,{$v['id']},'{$v['webname']}','{$resultid}')" >
                {$v['webname']}
            </a>
        </foreach>
    </div>
</div>
</if>

<if value=" $type == 'startplace' ">
<!--出发地选择弹出框-->
<div class="change-box-more" id="startplace_detail">
    <div class="level">
        <a href="javascript:;" class="cur" data-level="1" onclick="CHOOSE.changeStartPlace(this,0,'全部','{$resultid}',1)">全部</a>
        <foreach from="$startplace" value="$v" >
            <a href="javascript:;" data-level="1" onclick="CHOOSE.changeStartPlace(this,{$v['id']},'{$v['cityname']}','{$resultid}',0)" >{$v['cityname']}</a>
        </foreach>
    </div>
</div>
</if>


<if value=" $type == 'destlist' ">
<!--目的地选择弹出框-->
<div class="change-box-more" id="destlist_detail">
    <div class="level">
        <a href="javascript:;" class="cur" data-level="1" onclick="CHOOSE.changeDestId(this,0,'全部','{$resultid}',1)">全部</a>
        <foreach from="$destlist" value="$v" >
        <a href="javascript:;" data-level="1" onclick="CHOOSE.changeDestId(this,{$v['id']},'{$v['kindname']}','{$resultid}',0)" >{$v['kindname']}</a>
        </foreach>
    </div>
</div>
</if>


<if value=" $type == 'attrlist' ">
<!--属性选择弹出框-->
<div class="change-box-more" id="attrlist_detail">
    <input type="hidden" id="typeid" value="{$typeid}"/>
    <div class="level">

        <a href="javascript:;" class="cur" data-level="1" onclick="CHOOSE.changeAttrId(this,0,'全部','{$resultid}',1)">全部</a>
        <foreach from="$attrlist" value="$v" >
        <a href="javascript:;" data-level="1" onclick="CHOOSE.changeAttrId(this,{$v['id']},'({$weblist[$v['webid']]}){$v['attrname']}','{$resultid}',0)" >({$weblist[$v['webid']]}){$v['attrname']}</a>
        </foreach>
    </div>

</div>
</if>