<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>选择模板</title>
    <zhjs/>
    <js file="__CONTROL_TPL__/js/lnglat_select.js"/>
    <css file="__CONTROL_TPL__/css/lnglat_select.css"/>
    <script type="text/javascript" charset="utf-8">
        var lng_field_name ="{$zh.get.lngfield}" ;
        var lat_field_name ="{$zh.get.latfield}" ;

    </script>
    
    <script type="text/javascript" src="http://ditu.google.cn/maps/api/js?sensor=false&language=zh-CN" mce_src="http://ditu.google.cn/maps/api/js?sensor=false&language=zh-CN"></script>
</head>
<body>
<div class="wrap">
    <div class="select_result">当前没有选择</div>
    
    <div class="tab">
        <ul class="tab_menu">
            <li lab="select_tpl"><a href="#">选择内容</a></li>
        </ul>
        <div class="tab_content">
            <div id="select_tpl" style="overflow-y: auto;height:700px;">
                <table class="table2 zh-form">
                        <tr>
    						<td>
                                アドレス
    						</td>
    						<td>
                                <input validate="1" style="width:300px" class="" name="address" value="{$zh.get.addressvalue}" type="text" />
                                <span id="zh_region"></span>
                                <button class="zh-cancel-small" type="button" onclick="getLatlngByAddress('address')">座標検索</button> 
                            </td>
    					</tr>
                        <tr>
    						<td>
                                緯度
    						</td>
    						<td>
                                <input validate="1" style="width:300px" class="" name="lat" value="{$zh.get.latvalue}" type="text">
                            </td>
    					</tr>
                        <tr>
    						<td>
                                経度
    						</td>
    						<td>
                                <input validate="1" style="width:300px" class="" name="lng" value="{$zh.get.lonvalue}" type="text">
                            </td>
    					</tr>
                        
    					<tr>
    						<td>
                                地図
    						</td>
    						<td>
                                <div id="map" style="width:400px; height: 400px; border: 1px solid black;"></div>
                            </td>
    					</tr>
    			</table>
            </div>
        </div>
    </div>
</div>
<div class="position-bottom" style="position: fixed;bottom:0px;">

        <input type="button" class="zh-success" id="lnglat_selected" value="确定"/>
        <input type="button" class="zh-cancel" value="关闭" onclick="close_window();"/>
        
    </div>
<script language="javascript" type="text/javascript">
    var map;
    var marker;
    var infowindow;
    var geocoder;
    var markersArray = [];

    function initialize() {
        var latlng = new google.maps.LatLng(35.6572703, 139.72995949999995);
        var myOptions = {
            zoom: 6,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById("map"), myOptions);
        geocoder = new google.maps.Geocoder();

        google.maps.event.addListener(map, 'click', function (event) {
            placeMarker(event.latLng);
        });
    }
	  function codeAddress() {
	    clearOverlays(infowindow);
		
		var $pro,$city,$street=$('#adr').val();
		if($("#pro").val() != "0"){
			$pro =showPro();             
		}else{
			$pro ='';
		}
		if ($("#city").val() != "0"){
			$city=showCity();
		}else{
			$city='';
		}
		if($street!= ""){
			$street=$('#adr').val()
		}else{
			$street="";
		}
		var address=$pro+$city+$street;

		geocoder.geocode( { 'address': address}, function(results, status) { 
		  if (status == google.maps.GeocoderStatus.OK) { 
			console.log(results[0].geometry.location) 
			map.setCenter(results[0].geometry.location); 
			marker = new google.maps.Marker({ 
				title:address, 
				map: map,  
				position: results[0].geometry.location 
			}); 
			markersArray.push(marker);
					var infowindow = new google.maps.InfoWindow({ 
						content: '<strong>'+address+'</strong><br/>'+'?�x: '+results[0].geometry.location.lat()+'<br/>?�x: '+results[0].geometry.location.lng() 
					}); 
				
					infowindow.open(map,marker); 
		  } else { 
			alert("Geocode was not successful for the following reason: " + status); 
		  } 
		}); 
	  } 
	

    function placeMarker(location) {
        clearOverlays(infowindow);
        marker = new google.maps.Marker({
            position: location,
            map: map
        });
        markersArray.push(marker);

        if (geocoder) {
            geocoder.geocode({ 'location': location }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        attachSecretMessage(marker, results[0].geometry.location, results[0].formatted_address);
                    }
                } else {
                    alert("Geocoder failed due to: " + status);
                }
            });
        }
    }

    function attachSecretMessage(marker, piont, address) {
        var message = "<b>経緯度:</b>" + piont.lat() + " , " + piont.lng() + "<br />" + "<b>アドレス:</b>" + address;
        $("input[name='lat']").val(piont.lat());
        $("input[name='lng']").val(piont.lng());
        var infowindow = new google.maps.InfoWindow(
            {
                content: message,
                size: new google.maps.Size(50, 50)
            });
        infowindow.open(map, marker);
        if (typeof (mapClick) == "function") mapClick(piont.lng(), piont.lat(), address);
    }

    function clearOverlays(infowindow) {
        if (markersArray && markersArray.length > 0) {
            for (var i = 0; i < markersArray.length; i++) {
                markersArray[i].setMap(null);
            }
            markersArray.length = 0;
        }
        if (infowindow) {
            infowindow.close();
        }
    }
    function setiInit() {
        var lattxt =$("input[name='lat']").val();
        var lngtxt =$("input[name='lng']").val();
        var addresstxt = $("input[name='address']").val();

        if (lattxt != '' && lngtxt != '' && addresstxt == '') {
            var latlng = new google.maps.LatLng(lattxt, lngtxt);
            map.setZoom(14);
            placeMarker(latlng);
        }else if(lattxt == '' && lngtxt == '' && addresstxt != ''){
            markAddress(addresstxt);
        }else if(lattxt != '' && lngtxt != '' && addresstxt != ''){
            var latlng = new google.maps.LatLng(lattxt, lngtxt);
            map.setZoom(14);
            placeMarker(latlng);
        }
        // ---end
    }
    
    function markAddress(address){
        if(address==''){
            alert("アドレスを入力してください: " ); 
            return ;
        }
        clearOverlays(infowindow);
		
        
		geocoder.geocode( { 'address': address}, function(results, status) { 
		  if (status == google.maps.GeocoderStatus.OK) { 
			console.log(results[0].geometry.location) 
			map.setCenter(results[0].geometry.location); 
            map.setZoom(14);
			marker = new google.maps.Marker({ 
				title:address, 
				map: map,  
				position: results[0].geometry.location 
			}); 
			markersArray.push(marker);
					var infowindow = new google.maps.InfoWindow({ 
						content: '<strong>'+address+'</strong><br/>'+'緯度: '+results[0].geometry.location.lat()+'<br/>経度: '+results[0].geometry.location.lng() 
                    }); 
				    $("input[name='lat']").val(results[0].geometry.location.lat());
                    $("input[name='lng']").val(results[0].geometry.location.lng());
                    
					infowindow.open(map,marker); 
		  } else { 
			alert("このアドレスで座標見つかりません: " + status); 
		  } 
		}); 
    }
    
    function getLatlngByAddress(addressfield){
        var addresstxt = $("input[name='"+addressfield+"']").val();
        markAddress(addresstxt);
    }
    
    function mapClick(lng, lat, address) {
        /*document.getElementById("lng").value = lng;
        document.getElementById("lat").value = lat;
        document.getElementById("address").value = address;*/
    }
    initialize();
    window.onload = function () {
        setiInit();
		
    }
</script>

</body>
</html>