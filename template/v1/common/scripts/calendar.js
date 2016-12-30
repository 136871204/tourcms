var Calendar_itinerary; //日历数据的全局变量
function Calendar() {
    var $id =  '', $url = "javascript:void(0);";
    var $lineid = '';
    var $this = this;
    var $date = new Date();
    var $weeks = ["日", "一", "二", "三", "四", "五", "六"];
    var $days = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

    var SolarTermStr = new Array(
                        "小寒", "大寒", "立春", "雨水", "惊蛰", "春分", "清明", "谷雨", "立夏", "小满", "芒种", "夏至",
                        "小暑", "大暑", "立秋", "处暑", "白露", "秋分", "寒露", "霜降", "立冬", "小雪", "大雪", "冬至"); //24节气
    var DifferenceInMonth = new Array(
                        1272060, 1275495, 1281180, 1289445, 1299225, 1310355, 1321560, 1333035, 1342770, 1350855, 1356420, 1359045,
                        1358580, 1355055, 1348695, 1340040, 1329630, 1318455, 1306935, 1297380, 1286865, 1277730, 1274550, 1271556); //24节气值

    var V = { "0101": "*1元旦", "0214": "情人节", "0305#": "学雷锋纪念日", "0308": "妇女节", "0312#": "植树节", "0315#": "消费者权益日", "0401#": "愚人节", "0501": "*1劳动节", "0504": "青年节", "0601": "儿童节", "0701": "建党节", "0801": "建军节", "0910": "教师节", "1001": "*3国庆节", "1224": "平安夜", "1225": "圣诞节" }; //阳历节日
    var T = { "0101": "*2春节", "0115": "元宵节", "0505": "*1端午节", "0815": "*1中秋节", "0707": "七夕", "0909": "重阳节", "1010#": "感恩节", "1208#": "腊八节", "0100": "除夕" }; //阴历节日

    var regzhongwen = /[A-Za-z_\-\~\!\@\#\$\%\^\&\*\(\)\|\0-9]+/; //过滤特殊字符、英文与数字
    var $reservation_title = ""; //"<span>(点击日历上价格可以进行预订)<span>";

    this.year = $date.getFullYear();
    this.month = $date.getMonth() + 1;
    this.date = $date.getDate();
    var ui; //this.ui = null;
    if(IsPC()){
        this.even = true; //是否启用两个日历框
    }else{
        this.even = false; 
    }
    
    this.isSolarTerm = true; //是否显示节日、节气
    this.isChangeCss = false; //是否改变当前对象的样式 2012-08-01 JoJo
    this.isWeb = false; //当前是否为前台调用 2012-08-02 JoJo

    Calendar.isLeapYear = function(year) {
        return (year % 4 == 0 && year % 100 != 0) || (year % 400 == 0);
    }

    this.createUI = function() {
        var grid = document.createElement("TABLE");
        var gridBody = document.createElement("TBODY");
        var btnPrev = document.createElement("A");
        var btnNext = document.createElement("A");

        with (grid) {
            border = "0";
            className = "calendar";
            cellPadding = "0";
            cellSpacing = "0";
        }

        with (btnPrev) {
            href = "javascript:void(0);";
            id = "subPrev";
            innerText = textContent = "";
            onclick = function(e) {
                e = e || window.event;
                var date = new Date($this.year, $this.month - (($this.even || $.trim($(this).attr("even"))) ? 2 : 1), $this.date);
                $this.year = date.getFullYear(); // $this.year;
                $this.month = date.getMonth(); // $this.month;
                $this.date = date.getDate();
                if ($this.month == 0) {
                    $this.year = $this.year - 1;
                    $this.month = 12;
                }
                if ($.trim($(this).attr("even")) == "1") {
                    $(this).parent().parents("div").find("a[id='subPrev']").eq(1).removeAttr("even").click();
                }
                $this.change($this.year, $this.month, $this.date);
            };
        }

        with (btnNext) {
            href = "javascript:void(0);";
            id = "subNext";
            innerText = textContent = "";
            onclick = function(e) {
                e = e || window.event;
                var date = new Date($this.year, $this.month + (($this.even || $.trim($(this).attr("even"))) ? 1 : 0), $this.date);
                $this.year = date.getFullYear();
                $this.month = date.getMonth() + 1;
                $this.date = date.getDate();
                if ($this.even) {
                    $(this).parent().parents("div").find("a[id='subNext']").eq(0).attr("even", "1").click();
                }
                $this.change($this.year, $this.month, $this.date);
            };
        }

        grid.appendChild(gridBody);
        for (var i = 0; i < 8; ++i) {
            var row = document.createElement("TR");
            switch (i) {
                case 0:
                    row.className = "calendar-title";
                    break;
                case 1:
                    row.className = "calendar-weeks";
                    break;
                default:
                    row.className = "calendar-week-days";
                    break;
            }
            for (var j = 0; j < 7; ++j) {
                var cell = document.createElement("TD");
                cell.style.width = "auto";
                cell.className = (j == 0 || j == 6) ? "calendar_color_ff6600" : ""; //星期日 星期六
                switch (i) {
                    case 0:
                        switch (j) {
                            case 0:
                                cell.appendChild(btnPrev);
                                break;
                            case 1:
                                j = 5;
                                with (cell) {
                                    colSpan = "5";
                                    className = "calendar-title-current-month";
                                }
                                break;
                            default:
                                cell.appendChild(btnNext);
                                break;
                        }
                        break;
                    case 1:
                        cell.innerText = cell.textContent = $weeks[j];
                        break;
                    default:
                        cell.innerText = cell.textContent = " ";
                        break;
                }
                row.appendChild(cell);
            }
            gridBody.appendChild(row);
        }

        return grid;
    }

    this.change = function(year, month, date, frequency, lineid) {
        var tflag;
        var nowDate = new Date(year, month, date);
        var itinerary = Calendar_itinerary; //日历切位对象集合
        var dtime = [year, month]; //初始当前日期为传入日期值，即使ajax未返回查询集合最小值也能正常向下走
        //var itinerary = eval("(" + msg + ")"); //转换为json对象
        /*if (itinerary && itinerary.data.length >= 1) {
            dtime = itinerary.data[0].pdatetime.split('-'); //重新给定返回集合的最小日期
        }*/
        if (frequency == 1) { //取到第一个对象的日期

            var tempDate = new Date(year, month, 1);

            var regExp = /^0\d{1}$/;
            if (dtime[1].length > 1 && regExp.test(dtime[1])) {
                var monthArr = dtime[1].split("0");
                if (monthArr.length > 1) {
                    dtime[1] = monthArr[1];
                }
            }
			tempDate = new Date(parseInt(dtime[0]), parseInt(dtime[1]), 1); //无数据时的日期
			
			//此方法不实用，返回有数据中的最小日期
            /*if ($(ui).parent("div").find("table").length == 1) {
                tempDate = new Date(parseInt(dtime[0]), parseInt(dtime[1]), 1); //当前返回数据的最小日期
                year = tempDate.getFullYear(); month = tempDate.getMonth();
            }
            else {
                if (itinerary.data.length <= 0) {
                    tempDate = new Date(parseInt(dtime[0]), parseInt(dtime[1]), 1); //无数据时的日期
                }
                else {
                    tempDate = new Date(parseInt($.trim(dtime[0])), parseInt($.trim(dtime[1])) + 1, 1); //取第一个日期加一
                }
                year = tempDate.getFullYear(); month = tempDate.getMonth();
            }*/
            $date = new Date(year, month, 1);
            $this.year = $date.getFullYear();
            $this.month = $date.getMonth();
            $this.date = $date.getDate();
            if ($this.month == 0) {
                $this.year = $this.year - 1;
                $this.month = 12;
                year = $this.year; month = 12;
            }
        } //end if (frequency == 1 && dtime.length >= 2)//首次加载可跨月
        with (ui.rows[0].children[1]) {
            innerText = textContent = year + " 年 " + month + " 月"; //+ (month < 10 ? "0" : "")
            innerHTML = innerText + $reservation_title; //标题
        }
        
        for (var i = 2; i < ui.rows.length; ++i) {
            for (var j = 0; j < 7; ++j) {
                with (ui.rows[i].children[j]) {
                    innerText = textContent = "";
                }
            }
        } // end for
        
        var date = new Date(year, month - 1, 1);
        var dayOfWeek = date.getDay();
        var day = 1, days = $days[month - 1] + (month == 2 && Calendar.isLeapYear(year) ? 1 : 0);
        //$this.date = (month == 2 && Calendar.isLeapYear(year)) ? day : $this.date; /*$this.date = day;****/改动1
        //alert(dayOfWeek);
        for (var i = 2; i < ui.rows.length; ++i) {

            for (var j = i == 2 ? dayOfWeek : 0; j < 7; ++j) {
                var isToday = (year == new Date().getFullYear() && month == new Date().getMonth() + 1 && day == new Date().getDate());
                

                with (ui.rows[i].children[j]) {
                    className = isToday ? "calendar-today" : "";
                    var dayT = "";
                    if ($this.isSolarTerm == true) {
                        var tdate = new Date(date.getFullYear(), date.getMonth(), day);
                        dayT = T[showCal(tdate, true)]; dayT = dayT ? dayT : ""; //GetCNDate.js showCal(date, lockNum)//以阴历节日为主

                        if (!dayT) {
                            var dayV = V[(month < 10 ? "0" + month : month.toString()) + (day < 10 ? "0" + day : day.toString())]; //阳历节日
                            dayT = dayV ? dayV : "";
                            if (!dayT) {
                                var dayJ = $this.jieqi(tdate); //24节气 如果当前天没有公历与农历节日则判断性取节气
                                if (dayJ) dayT = dayJ ? dayJ : "";
                            }
                        }
                        dayT = dayT ? "<span class='v-holiday'>" + dayT.replace(regzhongwen, '') + "</span>" : ""; //节日text
                    } //end if (this.isSolarTerm == true)  是否显示节日、节气
                    
                    if (itinerary) {
                        for (var itr = 0; itr < itinerary.data.length; itr++) {
                            var otime = itinerary.data[itr].pdatetime.split('-'); //当前服务器的时间
                            var _day = new Date(otime[1] + '/' + otime[2] + '/' + otime[0]).getDate();
                            var _month = new Date(otime[1] + '/' + otime[2] + '/' + otime[0]).getMonth() + 1;
                            var _year = new Date(otime[1] + '/' + otime[2] + '/' + otime[0]).getFullYear();
							
                            if (_day == day && month == _month && _year == year) {
                                className = isToday ? "calendar-tag" : "";  //表示当前天为今天则改有红色字体及12号字
								
								//目前没有超时的判断
                                var time1 = new Date(itinerary.data[itr].pdatetime.replace(/-/, "/").replace("-", "/"));
                                var pagelinebefore=$("#pagelinebefore").val();
                                var time2 = new Date();
                                time2 = new Date(time2.getTime() + pagelinebefore*24*60*60*1000);  //前一天var nextDate = new 

                                var flag = time1 < time2; //判断当前日历日期是否小于当前日期加上提前预定天数
                                //tflag=flag;
                                //var flag = false;
								if(itinerary.data[itr].info != "")
								{
									var infoArr = itinerary.data[itr].info.split(";");
									for(var li = 0; li < infoArr.length; li++)
									{
										var timeArr = infoArr[li].split('::');
										var starttime = timeArr[0].replace(/\-/g, "/");
										var endtime = timeArr[1].replace(/\-/g, "/");
										var info = timeArr[2];
										var dayArr = info.split(",");
										var price = '';
										var comDay = new Array();
										var comPrice = new Array();
										//var priceArr = info.split("||");
										for(var xi = 0; xi < dayArr.length; xi++)
										{
											var priceArr = dayArr[xi].split("||");
											comDay.push(priceArr[0]);
											comPrice.push(priceArr[1]);
										}
										comDay.reverse();
										comPrice.reverse();
										for(var ci = 0; ci < comDay.length; ci++)
										{
											var cDateD = new Date(year + "/" + (month < 10 ? "0" + month : month) + "/" + (day < 10 ? "0" + day : day));
											var cDate = new Date(new Date().getFullYear() + "/" + (new Date().getMonth() + 1) + "/" + new Date().getDate());
											var sDate = new Date(starttime);
											var jDate = new Date(endtime);
											
											var diffd = (cDateD.getTime() - cDate.getTime())/(24 * 60 * 60 * 1000);
											
											//alert(diffd);
											if(cDateD.getTime() >= sDate.getTime() && cDateD.getTime() <= jDate.getTime())
											{
												if(diffd >= comDay[ci])
												{
													price = Math.round(itinerary.data[itr].price - comPrice[ci]);
													break;
												}
												else
												{
													price = Math.round(itinerary.data[itr].price);
												}
											}
											else
											{
												price = Math.round(itinerary.data[itr].price);
											}
										}
									}
								}
								else
								{
									price = Math.round(itinerary.data[itr].price);
									
								}
								var childprice =Math.round(itinerary.data[itr].childprice);
                                var tempDateTime = year + "-" + (month < 10 ? "0" + month : month) + "-" + (day < 10 ? "0" + day : day); //2012-08-02 JoJo 考虑值的获取与传递 标签自定义属性date >>exists 是否存在切位于后台使用
								
                                if (flag) {
									var pricehtml = price == "0" ? "电询" : "￥" + price;
                                    pricehtml=pricehtml+' 起';
                                    innerHTML = textContext = "<div class='has_gone' datetime='" + tempDateTime + "' exists='false'>" + dayT + day + "<div><a class='calendar_red'  >" + pricehtml + "</a></div></div>";
                                }
                                else {
									var pricehtml = price == "0" ? "电询" : "￥" + price;
                                    pricehtml=pricehtml+' 起';
									var pricepost = price == "0" ? 0 : price;
                                    if(itinerary.data[itr].state=='3'){
                                        var thhtml = "<div id='d" + itr + "' " + (this.isWeb == true ? "" : "") + " datetime='" + tempDateTime + "' exists='true' onmouseover='divchange1(this)' onmouseout='divchange2(this)' onclick=\"setBeginTime("+year+","+month+","+day+","+price+","+childprice+","+$lineid+","+$id+")\" style='background:#fff;'>" + dayT + day + "<div><a class='calendar_red'  >" + pricehtml + "</a><a style=\"display:block;text-align:center;color: #a1a8b3;\">" + itinerary.data[itr].description + "</a></div></div>";
                                    }else if(itinerary.data[itr].state=='1'){
                                        var thhtml = "<div id='d" + itr + "' " + (this.isWeb == true ? "" : "") + " datetime='" + tempDateTime + "' exists='true' onmouseover='divchange1(this)' onmouseout='divchange2(this)' onclick=\"setBeginTime("+year+","+month+","+day+","+price+","+childprice+","+$lineid+","+$id+")\" style='background:#fff;'>" + dayT + day + "<div><a class='calendar_red'  >" + pricehtml + "</a><span style='display:block;'><img src='" + TEMPLATE + "/common/images/detail/ico_rest.png' /></span></div></div>";
                                    }else if(itinerary.data[itr].state=='2'){
                                        var thhtml = "<div id='d" + itr + "' " + (this.isWeb == true ? "" : "") + " datetime='" + tempDateTime + "' exists='true' onmouseover='divchange1(this)' onmouseout='divchange2(this)' style='background:#fff;'>" + dayT + day + "<div><a class='calendar_red'  >" + pricehtml + "</a><span class='phone_call' style='display:block;'><img src='" + TEMPLATE + "/common/images/detail/ico_phone.png' />电询</span></div></div>";
                                    }else{
                                        var thhtml = "<div id='d" + itr + "' " + (this.isWeb == true ? "" : "") + " datetime='" + tempDateTime + "' exists='true' onmouseover='divchange1(this)' onmouseout='divchange2(this)' onclick=\"setBeginTime("+year+","+month+","+day+","+price+","+childprice+","+$lineid+","+$id+")\" style='background:#fff;'>" + dayT + day + "<div><a class='calendar_red'  >" + pricehtml + "</a><span style='display:block;'><img src='" + TEMPLATE + "/common/images/detail/ico_rest.png' /></span></div></div>";
                                    }
                                    
                                    textContext = innerHTML = thhtml;
                                } //end else
                            } //end if                                    
                        } //end for
                    } //end if

                    /*var timeNow=new Date().getTime();
                    var pagelinebefore=$("#pagelinebefore").val();
                    var timeEnd = new Date();
                    timeEnd = new Date(timeEnd.getTime() + pagelinebefore*24*60*60*1000);  //前一天var nextDate = new
                    timeEnd = timeEnd.getTime();
                    var timeFlag = timeNow < timeEnd;*/
                    
                    //目前没有超时的判断
                    var time1 = new Date(date.getFullYear(), date.getMonth(), day);
                    //var time1 = new Date(itinerary.data[itr].pdatetime.replace(/-/, "/").replace("-", "/"));
                    var pagelinebefore=$("#pagelinebefore").val();
                    pagelinebefore=parseInt(pagelinebefore);
                    var time2 = new Date();
                    time2 = new Date(time2.getTime() + pagelinebefore*24*60*60*1000);  //前一天var nextDate = new 

                    var tflag = time1 < time2; //判断当前日历日期是否小于当前日期加上提前预定天数
                    
                    if (innerHTML == "") {
                        //alert(tflag);
                        //alert(tflag);
                        if(tflag==false){
                            innerHTML = textContext = "<div>" + dayT + (day) + "</div>"; //innerText = textContent = (isToday ? "今天" : day) + dayV;
                        }else{
                            innerHTML = textContext = "<div class='has_gone' style='height:69px' >" + dayT + (day) + "</div>"; //innerText = textContent = (isToday ? "今天" : day) + dayV;
                        }
                          
                    }
                } // end with
                ++day;
                if (day > days)
                    return;
            } //end for
        } //end for
    }   //**************************************************************** end change ********************************************

    //节气
    this.jieqi = function(date) {
        var DifferenceInYear = 31556926;
        var BeginTime = new Date(1901 / 1 / 1);
        BeginTime.setTime(947120460000);
        for (; date.getFullYear() < BeginTime.getFullYear(); ) {
            BeginTime.setTime(BeginTime.getTime() - DifferenceInYear * 1000);
        }
        for (; date.getFullYear() > BeginTime.getFullYear(); ) {
            BeginTime.setTime(BeginTime.getTime() + DifferenceInYear * 1000);
        }
        for (var M = 0; date.getMonth() > BeginTime.getMonth(); M++) {
            BeginTime.setTime(BeginTime.getTime() + DifferenceInMonth[M] * 1000);
        }
        if (date.getDate() > BeginTime.getDate()) {
            BeginTime.setTime(BeginTime.getTime() + DifferenceInMonth[M] * 1000);
            M++;
        }
        if (date.getDate() > BeginTime.getDate()) {
            BeginTime.setTime(BeginTime.getTime() + DifferenceInMonth[M] * 1000);
            M == 23 ? M = 0 : M++;
        }
        var JQ = "";
        if (date.getDate() == BeginTime.getDate()) {
            JQ += SolarTermStr[M];
        }
        return JQ;
    }

    this.show = function(ele, id, url, iseven, ischangecss, isweb,lineid) {
        ele.innerHTML='';
		ui = ui || this.createUI();
        this.date = 1; //初始化
        $id = id; $url = url ? url : $url;
        $lineid = lineid;
		var idarr = id.split('||');
        //iseven=false;
        $this.even = Boolean(iseven); //表示为两个日历框
        $this.isChangeCss = (ischangecss != undefined && ischangecss == false) ? false : true; //ischangecss不传值或非false则进行样式的改变 传false不做改变 2012-08-01 JoJo
        $this.isWeb = (isweb != undefined && isweb == false) ? false : true; // Js等相关信息的调用
        
        if (this.even == false && ele) {
            //ele.appendChild(ui);
			//if($('#calenderPartEven').find('table').length<2)
			//{
				ele.appendChild(ui);
			//}
            this.change(this.year, this.month, this.date, 1, idarr[2]);
            /*if (this.isChangeCss == true) {
                $(ele).css({ "filter": "alpha(opacity=0,finishopacity=100,style=1)" }).show().fadeTo(2000, 0.9, function() { $(this).removeAttr("style").find("table").css({ "float": "left" }); }); //滤镜效果
            }*/
        } //不为双日历时快速填充，否则用下面方法进行填充

        if (this.even && ele) {
            $date = new Date(this.year, this.month, this.date);
            $this.year = $date.getFullYear();
            $this.month = $date.getMonth() + 1;
            $this.date = $date.getDate();
            new Calendar().show(ele, id, url, "", $this.isChangeCss, $this.isWeb,lineid);
			//if($('#calenderPartEven').find('table').length<2)
			//{
				ele.appendChild(ui);
			//}
            $this.change($this.year, $this.month, $this.date, 1, idarr[2]);
            $(ele).find("a[id='subPrev']").eq(1).css("display", "none");
            $(ele).find("a[id='subNext']").eq(0).css("display", "none");

            $(ele).find("a[id='subPrev']").eq(0).attr("even", "1");
            $(ele).find("a[id='subNext']").eq(1).css("even", "1");
            $(ele).find("table").css({ "float": "left" });
        }
    }
    this.reNew1 = function(ele, id, url, iseven, ischangecss, isweb,year,month,date,lineid){
        ele.innerHTML='';
        ui = ui || this.createUI();
        this.date = 1; //初始化
        $id = id; $url = url ? url : $url;
        $lineid = lineid;
        var idarr = id.split('||');
        //iseven=false;
        $this.even = Boolean(iseven); //表示为两个日历框
        $this.isChangeCss = (ischangecss != undefined && ischangecss == false) ? false : true; //ischangecss不传值或非false则进行样式的改变 传false不做改变 2012-08-01 JoJo
        $this.isWeb = (isweb != undefined && isweb == false) ? false : true; // Js等相关信息的调用
        
        if (this.even == false && ele) {
            $this.year = Number(year);
            $this.month = Number(month);
            $this.date = Number(date);
            //ele.appendChild(ui);
            //if($('#calenderPartEven').find('table').length<2)
            //{
                ele.appendChild(ui);
            //}
            this.change(year, month, date, 1, idarr[2]);
            /*if (this.isChangeCss == true) {
                $(ele).css({ "filter": "alpha(opacity=0,finishopacity=100,style=1)" }).show().fadeTo(2000, 0.9, function() { $(this).removeAttr("style").find("table").css({ "float": "left" }); }); //滤镜效果
            }*/
        } //不为双日历时快速填充，否则用下面方法进行填充
        if (this.even && ele) {
            
            $this.year = Number(year);
            $this.month = Number(month);
            $this.date = Number(date);
            new Calendar().show(ele, id, url, "", $this.isChangeCss, $this.isWeb,lineid);
            //if($('#calenderPartEven').find('table').length<2)
            //{
                ele.appendChild(ui);
            //}
            $this.change($this.year, $this.month, $this.date, 1, idarr[2]);
            $(ele).find("a[id='subPrev']").eq(1).css("display", "none");
            $(ele).find("a[id='subNext']").eq(0).css("display", "none");

            $(ele).find("a[id='subPrev']").eq(0).attr("even", "1");
            $(ele).find("a[id='subNext']").eq(1).css("even", "1");
            $(ele).find("table").css({ "float": "left" });
        }
    }
    this.reNew = function(ele,id,url,iseven,ischangecss,isweb,year,month,date,lineid){
            ele.innerHTML='';
            ui = ui || this.createUI();
            this.date = 1; //初始化
            $id = id; $url = url ? url : $url;
            $lineid = lineid;
            var idarr = id.split('||');
            //iseven=false;
            $this.even = Boolean(iseven); //表示为两个日历框
            $this.isChangeCss = (ischangecss != undefined && ischangecss == false) ? false : true; //ischangecss不传值或非false则进行样式的改变 传false不做改变 2012-08-01 JoJo
            $this.isWeb = (isweb != undefined && isweb == false) ? false : true; // Js等相关信息的调用
            if (this.even == false && ele) {
                $this.year = Number(year);
                $this.month = Number(month);
                $this.date = Number(date);
                //ele.appendChild(ui);
                //if($('#calenderPartEven').find('table').length<2)
                //{
                    ele.appendChild(ui);
                //}
                this.change(year, month, date, 1, idarr[2]);
                /*if (this.isChangeCss == true) {
                    $(ele).css({ "filter": "alpha(opacity=0,finishopacity=100,style=1)" }).show().fadeTo(2000, 0.9, function() { $(this).removeAttr("style").find("table").css({ "float": "left" }); }); //滤镜效果
                }*/
            } //不为双日历时快速填充，否则用下面方法进行填充
            if (this.even && ele) {
                $this.year = Number(year);
                $this.month = Number(month) + 1;
                $this.date = Number(date);
                //new Calendar().show(ele, id, url, "", $this.isChangeCss, $this.isWeb,lineid);
                new Calendar().reNew1(ele, id, url, "", $this.isChangeCss, $this.isWeb,year,month,date,lineid);
                if($('#calenderPartEven').find('table').length<2)
                {
                    ele.appendChild(ui);
                }
                $this.change($this.year, $this.month, $this.date, 1, idarr[2]);
                //console.log($(ele)).find("a[id='subPrev']"));
                $(ele).find("a[id='subPrev']").eq(1).css("display", "none");
                $(ele).find("a[id='subNext']").eq(0).css("display", "none");

                $(ele).find("a[id='subPrev']").eq(0).attr("even", "1");
                $(ele).find("a[id='subNext']").eq(1).css("even", "1");
                $(ele).find("table").css({ "float": "left" });
            }
    }
    this.toString = function() {
        alert(this.year + "-" + this.month + "-" + this.date);
    }
}

/**
* ele 为显示日期对象的层
* id 为产品ID
* url 需要请求的URL
* iseven 是否显示双日历  默认为false
* ischangecss 是否改变样式启用前台滤镜等效果 默认为true
* isweb 当前不否为前台调用 前后台调用请求方式不一样 默认为true
**/
function Calendar_GetPdateAndPrice(ele, id, url, iseven, ischangecss, isweb) {
    var date = new Date();
    var year = date.getFullYear();
    var month = date.getMonth() + 1;
    var date = date.getDate();
	var idarr = id.split('||');
    if (isweb!=undefined && isweb == false) {
		//后台操作
    }
    else {
        $.ajax({
            type: "post",
            url: "/public/ajax_set.php",
			data: "dopost=getPrice&hotelid="+idarr[0]+"&tid="+idarr[1],
            success: function(msg) {
                
				if(!msg)
				  $("#zxyd").remove(); 
                Calendar_itinerary = eval("(" + msg + ")"); //转换为json对象
				
				if(Calendar_itinerary)
				//var b=Calendar_itinerary
                  new Calendar().show(ele, id, url, iseven);
				 
            }
        });
    }
}


/**
* ele 为显示日期对象的层
* id 为产品ID
* url 需要请求的URL
* iseven 是否显示双日历  默认为false
* ischangecss 是否改变样式启用前台滤镜等效果 默认为true
* isweb 当前不否为前台调用 前后台调用请求方式不一样 默认为true
**/

function Calendar_GetPdateAndPrice_New(ele, id, url, iseven, ischangecss, isweb,func,lineid) {
    var date = new Date();
    var year = date.getFullYear();
    var month = date.getMonth() + 1;
    var date = date.getDate();
	//var idarr = id.split('||');
	var suitid = id;
    $lineid = lineid;
    func = func || function(){};
    if (isweb!=undefined && isweb == false) {
		//后台操作
    }
    else {

        $.ajax({
            type: "post",
            url: CONTROL+"&m=getlineprice2",
			data: "suitid="+suitid,
			
            success: function(msg) {

                  if(!msg)
				  $("#zxyd").remove(); 
                  //var msg = '{"data":[ { "pdatetime": "2016-01-09", "price": "9999","childprice": "","description": "余位充足", "info": ""},{ "pdatetime": "2016-01-16", "price": "9999","childprice": "","description": "余位充足", "info": ""},{ "pdatetime": "2016-01-21", "price": "9999","childprice": "","description": "余位充足", "info": ""},{ "pdatetime": "2016-01-22", "price": "9999","childprice": "","description": "余位充足", "info": ""},{ "pdatetime": "2016-01-23", "price": "9999","childprice": "","description": "余位充足", "info": ""},{ "pdatetime": "2016-01-24", "price": "9999","childprice": "","description": "余位充足", "info": ""},{ "pdatetime": "2016-01-25", "price": "9999","childprice": "","description": "余位充足", "info": ""},{ "pdatetime": "2016-01-26", "price": "9999","childprice": "","description": "余位充足", "info": ""},{ "pdatetime": "2016-01-27", "price": "9999","childprice": "","description": "余位充足", "info": ""},{ "pdatetime": "2016-01-28", "price": "9999","childprice": "","description": "余位充足", "info": ""},{ "pdatetime": "2016-01-30", "price": "9999","childprice": "","description": "余位充足", "info": ""} ]}';
				Calendar_itinerary = eval("(" + msg + ")"); //转换为json对象
                //alert(currentCalendar);
                currentCalendar = new Calendar();
                currentCalendar.show(document.getElementById('calendar'),id,"",this.even,function(){$(".calendar:first").css("margin-right","18px")},lineid);
                currentCalendar.reNew(document.getElementById('calendar'),id,"",this.even,false,false,year,month,date,lineid);
                //alert(id);
                //new Calendar().show(ele, id, url, iseven,ischangecss,isweb,lineid);
                
                func();
                //fpMonth();
                changePrice();
            }
        });
    }
}



//日历焦点样式的变动
function divchange1(obj) {
    $(obj).css({ "background-color": "#ffe5dd", "cursor": "pointer" });

}
//日历焦点样式的变动
function divchange2(obj) {
    $(obj).css("background-color", "#fff");
}


function showDiv(obj, hotelid, tid, lineid)
{
	var top = $(obj).offset().top + 40;
	var right = ($(window).width() - 980)/2;
	var id = hotelid + '||' + tid + '||' + lineid;
	if($('#calenderPartEven').css('top') == top + 'px')
	{
		_hide();
	}
	else
	{
		$('#calenderPartEven').css({'position':'absolute', 'top':top+'px', 'right':right+'px'}).fadeIn();
		$('#calenderPartEven').append('<div class="closeui"><span onclick="_hide()">关闭</span></div>');
		
		Calendar_GetPdateAndPrice(document.getElementById("calenderPartEven"), id,"",this.even);
	}
}

//重写show
function showCalendar(containid, suitid,func,lineid)
{
	/*var top = $(obj).offset().top + 40;
	var right = ($(window).width() - 980)/2;
	var id = hotelid + '||' + tid + '||' + lineid;
	if($('#calenderPartEven').css('top') == top + 'px')
	{
		_hide();
	}
	else
	{
		$('#calenderPartEven').css({'position':'absolute', 'top':top+'px', 'right':right+'px'}).fadeIn();
		$('#calenderPartEven').append('<div class="closeui"><span onclick="_hide()">关闭</span></div>');
		
		
	}*/

	Calendar_GetPdateAndPrice_New(document.getElementById(containid), suitid,"",this.even,null,null,func,lineid);
}

function _hide()
{
	$('#calenderPartEven').html('').css({'top':'0px'}).fadeOut();
}

function locatioBook(lineid, price, year, month, day)
{
	var istemplet = $('#istemplet').val();
	window.location.href = "http://" + window.location.host + "/lines/booking_" + lineid + "_" + price + "_" + istemplet + 
						   "_" + year + "-" + month + "-" + day + ".html";
}


//判断是否pc
function IsPC()  
{  
    
    var ww = $(window).width();
    if(ww < 768){
        var flag = false;
    }else{
        var flag = true;
    }
    // var userAgentInfo = navigator.userAgent;  
    // var Agents = new Array("Android", "iPhone", "SymbianOS", "Windows Phone", "iPad", "iPod");  
    // var flag = true;  
    // for (var v = 0; v < Agents.length; v++) {  
    //    if (userAgentInfo.indexOf(Agents[v]) > 0) { flag = false; break; }  
    // }  
    return flag;
} 
