// JavaScript Document
	var scrolltotop = {
			//startline: Integer. Number of pixels from top of doc scrollbar is scrolled before showing control
			//scrollto: Keyword (Integer, or "Scroll_to_Element_ID"). How far to scroll document up when control is clicked on (0=top).
			setting: {startline:20, scrollto:0, scrollduration:300, fadeduration:[500, 100]},
			//controlHTML: '<div class="scrollTop"><div class="top_qq"><span class="btn"></span><span class="content"><i class="arrow"></i><a href="tencent://message/?uin=246478119&apm;Site=text&apm;Menu=yes">QQ咨询</a></span></div><div class="top_phone"><span class="btn"></span><span class="content"><i class="arrow"></i>咨询电话：021-6329-7878</span></div><div class="top_weixin"><span class="btn"></span><span class="content"><i class="arrow"></i><img src="'+TEMPLATE+'/common/images/weinxin_code.jpg" alt=""></span></div><div class="top_btn"><span class="btn"></span></div></div>', //HTML for control, which is auto wrapped in DIV w/ ID="topcontrol"
            controlHTML: '<div class="scrollTop"><div class="top_btn"><span class="btn"></span></div></div>', //HTML for control, which is auto wrapped in DIV w/ ID="topcontrol"
			controlattrs: {offsetx:0, offsety:44}, //offset of control relative to right/ bottom of window corner
			anchorkeyword: '#top', //Enter href value of HTML anchors on the page that should also act as "Scroll Up" links

			state: {isvisible:false, shouldvisible:false},

			scrollup:function(){
				if (!this.cssfixedsupport) //if control is positioned using JavaScript
					//this.$control.css({opacity:0}) //hide control immediately after clicking it
					this.$control.css({"display":none});
				var dest=isNaN(this.setting.scrollto)? this.setting.scrollto : parseInt(this.setting.scrollto)
				if (typeof dest=="string" && jQuery('#'+dest).length==1) //check element set by string exists
					dest=jQuery('#'+dest).offset().top
				else
					dest=0
				this.$body.animate({scrollTop: dest}, this.setting.scrollduration);
			},

			keepfixed:function(){
				var $window=jQuery(window)
				var controlx=($window.scrollLeft() + $window.width())/2
				var controly=$window.scrollTop() + $window.height() - this.$control.height() - this.controlattrs.offsety
				this.$control.css({left:controlx+'px', top:controly+'px'})
			},

			togglecontrol:function(){
				var scrolltop=jQuery(window).scrollTop()
				if (!this.cssfixedsupport)
					this.keepfixed()
				this.state.shouldvisible=(scrolltop>=this.setting.startline)? true : false
				if (this.state.shouldvisible && !this.state.isvisible){
					//this.$control.stop().animate({opacity:1}, this.setting.fadeduration[0])
					this.$control.css("display","block");
					this.state.isvisible=true
				}
				else if (this.state.shouldvisible==false && this.state.isvisible){
					//this.$control.stop().animate({opacity:0}, this.setting.fadeduration[1])
					this.$control.css("display","none");
					this.state.isvisible=false
				}
			},

			init:function(){
				jQuery(document).ready(function($){
					var mainobj=scrolltotop
					var iebrws=document.all
					mainobj.cssfixedsupport=!iebrws || iebrws && document.compatMode=="CSS1Compat" && window.XMLHttpRequest //not IE or IE7+ browsers in standards mode
					mainobj.$body=(window.opera)? (document.compatMode=="CSS1Compat"? $('html') : $('body')) : $('html,body')
					mainobj.$control=$('<div id="topcontrol">'+mainobj.controlHTML+'</div>')
						.css({position:mainobj.cssfixedsupport? 'fixed' : 'absolute', bottom:mainobj.controlattrs.offsety,top:"50%",right:"0" ,marginTop:"-80px",display:"none", cursor:'pointer'})
						.attr({title:'TOP'})
						// .click(function(){mainobj.scrollup(); return false})
						.appendTo('body');
					$(".top_btn").click(function(){mainobj.scrollup(); return false});
					if (document.all && !window.XMLHttpRequest && mainobj.$control.text()!='')
						mainobj.$control.css({width:mainobj.$control.width()})
					mainobj.togglecontrol()
					$('a[href="' + mainobj.anchorkeyword +'"]').click(function(){
						mainobj.scrollup()
						return false
					})
					$(window).bind('scroll resize', function(e){
						mainobj.togglecontrol()
					})
				})
			}
		}

		scrolltotop.init()

