/**
 * Created by netman on 15-4-13.
 */

var orderChart,visitChart,memberChart; //图表名称

$(function(){
    // 路径配置
    require.config({
        paths: {
            echarts: 'http://echarts.baidu.com/build/dist'
        }
    });
// 使用
    require(
        [
            'echarts',
            'echarts/chart/line', // 使用线性图就加载line模块，按需加载
            'echarts/chart/bar'
        ],
        function (ec) {

            orderChart = ec.init(document.getElementById('order-count-box'));
            visitChart = ec.init(document.getElementById('pv-count-box'));
            memberChart = ec.init(document.getElementById('member-count-box'));
            initChart();
        }
    );
})





//初始化图表
function initChart()
{
    getOrderChart(orderChart);
    getVisitChart(visitChart);
    getMemberChart(memberChart);
}

/*
* 订单图表
* */

function getOrderChart(orderChart)
{
    var starttime = $("#starttime").val();
    var endtime = $("#endtime").val();
    //读取数据
    $.ajax({
        type:'POST',
        url:URL+'index/ajax_order_num_graph',
        data:{starttime:starttime,endtime:endtime},
        dataType:'json',
        beforeSend:function(){
            orderChart.showLoading({text:'正在加载数据...'})
        },
        success:function(data){
            if (data) {
                orderChart.hideLoading();
                var line_num = eval(data.line);
                var hotel_num =eval(data.hotel);
                var car_num = eval(data.car);
                var spot_num =eval(data.spot);
                var visa_num = eval(data.visa);
                var tuan_num = eval(data.tuan);
                var ty_num = eval(data.ty);
                var label = eval(data.labels);
                var option = {
                    title : {
                        text: '',
                        subtext: ''
                    },
                    tooltip : {
                        trigger: 'axis'
                    },
                    legend: {
                        data:['线路','酒店','租车','门票','签证','团购','通用']
                    },
                    toolbox: {
                        show : false,
                        feature : {
                            mark : {show: true},
                            dataView : {show: true, readOnly: false},
                            magicType : {show: true, type: ['line', 'bar']},
                            restore : {show: true},
                            saveAsImage : {show: true}
                        }
                    },
                    calculable : false,
                    xAxis : [
                        {
                            type : 'category',
                            boundaryGap : false,
                            data :(function(){
                                return label ? label : ['周一','周二','周三','周四','周五','周六','周日'];
                            })()
                        }
                    ],
                    yAxis : [
                        {
                            type : 'value',
                            axisLabel : {
                                formatter: '{value} 笔'
                            }
                        }
                    ],

                    series : [
                        {
                            name:'线路',
                            type:'line',
                            smooth:true,
                            data:(function(){
                                return line_num;

                            })()
                        },

                        {
                            name:'酒店',
                            type:'line',
                            smooth:true,

                            data:(function(){
                                return hotel_num;

                            })()
                        },
                        {
                            name:'租车',
                            type:'line',
                            smooth:true,

                            data:(function(){
                                return car_num;

                            })()
                        },
                        {
                            name:'门票',
                            type:'line',
                            smooth:true,

                            data:(function(){
                                return spot_num;

                            })()
                        },
                        {
                            name:'签证',
                            type:'line',
                            smooth:true,

                            data:(function(){
                                return visa_num;

                            })()
                        },
                        {
                            name:'团购',
                            type:'line',
                            smooth:true,

                            data:(function(){
                                return tuan_num;

                            })()
                        },

                        {
                            name:'通用',
                            type:'line',
                            smooth:true,

                            data:(function(){
                                return ty_num;

                            })()
                        }
                    ]
                };
                // 为echarts对象加载数据
                orderChart.setOption(option);


            }
        }
    })

}

/*
*访问图表
* */
function getVisitChart(visitChart)
{
    var starttime = $("#starttime").val();
    var endtime = $("#endtime").val();
    $.ajax({
        type:'POST',
        url:URL+'index/ajax_ippv_num',
        data:{starttime:starttime,endtime:endtime},
        beforeSend:function(){
            visitChart.showLoading({text:'正在加载数据...'})
        },
        dataType:'json',
        success:function(data){
            visitChart.hideLoading();
            var ip_num = eval(data.ip);

            var pv_num = eval(data.pv);
            var label = eval(data.labels);
            var option = {
                title : {
                    text: '',
                    subtext: ''
                },
                tooltip : {
                    trigger: 'axis'
                },
                legend: {
                    data:['IP:点击量','PV:访问量']
                },
                toolbox: {
                    show : false,
                    feature : {
                        mark : {show: true},
                        dataView : {show: true, readOnly: false},
                        magicType : {show: true, type: ['line', 'bar', 'stack', 'tiled']},
                        restore : {show: true},
                        saveAsImage : {show: true}
                    }
                },
                calculable : false,
                xAxis : [
                    {
                        type : 'category',
                        boundaryGap : false,
                        data :(function(){
                            return label ? label : ['周一','周二','周三','周四','周五','周六','周日'];
                        })()
                    }
                ],
                yAxis : [
                    {
                        type : 'value'
                    }
                ],
                series : [
                    {
                        name:'IP:点击量',
                        type:'line',
                        smooth:true,

                        data:(function(){
                            return ip_num;
                        })()
                    },{
                        name:'PV:访问量',
                        type:'line',
                        smooth:true,

                        data:(function(){
                            return pv_num;
                        })()
                    }
                ]
            };
            // 为echarts对象加载数据
            visitChart.setOption(option);

        }
    })
}

/*
* 会员图表
* */
function getMemberChart(memberChart)
{
    var starttime = $("#starttime").val();
    var endtime = $("#endtime").val();
    $.ajax({
        type:'POST',
        url:URL+'index/ajax_member_num',
        data:{starttime:starttime,endtime:endtime},
        dataType:'json',
        beforeSend:function(){
            memberChart.showLoading({text:'正在加载数据...'})
        },
        success:function(data){
            memberChart.hideLoading();
            var membernum = eval(data.member);
            var label = eval(data.labels);
            var option = {
                title : {
                    text: '',
                    subtext: ''
                },
                tooltip : {
                    trigger: 'axis'
                },
                legend: {
                    data:['新增会员']
                },
                toolbox: {
                    show : false,
                    feature : {
                        mark : {show: true},
                        dataView : {show: true, readOnly: false},
                        magicType : {show: true, type: ['line', 'bar', 'stack', 'tiled']},
                        restore : {show: true},
                        saveAsImage : {show: true}
                    }
                },
                calculable : true,
                xAxis : [
                    {
                        type : 'category',
                        boundaryGap : false,
                        data :(function(){
                            return label ? label : ['周一','周二','周三','周四','周五','周六','周日'];
                        })()
                    }
                ],
                yAxis : [
                    {
                        type : 'value'
                    }
                ],
                series : [
                    {
                        name:'新增会员',
                        type:'line',
                        smooth:true,

                        data:(function(){
                            return membernum;
                        })()
                    }
                ]
            };
            // 为echarts对象加载数据
            memberChart.setOption(option);


        }

    });

}