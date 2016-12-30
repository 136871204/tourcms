/*====================================================================================================
//////////////////////////////////////////////////////////////////////////////////////////////////////

 Author : http://www.metaphase.co.jp
 created: 2007/11/01
 update : 2010/07/12

//////////////////////////////////////////////////////////////////////////////////////////////////////
====================================================================================================*/

var metaLoader = {

	conf : {
		loader : "jsloader.js",
		loadJS : ["jquery.js","html5.js","placeHolder.js","init.js","m_init.js"]
	},
	
	main : function(){
		var script = document.getElementsByTagName("script");
		for(var i=0;i<script.length;i++){
			if(script[i].getAttribute("src") && script[i].getAttribute("src").match(metaLoader.conf.loader)){
				

				var prefix = metaLoader.dirname(script[i].src);
				for(var i = 0; i < metaLoader.conf.loadJS.length; i++) {
					document.write('<script type="text/javascript" src="' + prefix + '/' + metaLoader.conf.loadJS[i] + '"></script>');
				}

			break;
			}
		}
	},
	
	dirname : function(path) {
		return path.substring(0, path.lastIndexOf('/'));
	}
	
}

metaLoader.main();