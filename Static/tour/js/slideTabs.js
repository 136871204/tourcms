jQuery.fn.switchTab = function(l) {
	l = jQuery.extend({
		defaultIndex: 0,
		titOnClassName: "on",
		titCell: ".tabnav span",
		mainCell: ".tabcon",
		delayTime: 250,
		interTime: 0,
		trigger: "click",
		effect: "",
		omitLinks: false,
		debug: ""
	}, l, {
		version: 120
	});
	this.each(function() {
		var b;
		var c = -1;
		var d = jQuery(this);
		if (l.omitLinks) {
			l.titCell = l.titCell + "[href^='#']"
		}
		var e = d.find(l.titCell);
		var f = d.find(l.mainCell);
		var g = e.length;
		var h = function(a) {
				if (a != c) {
					e.eq(c).removeClass(l.titOnClassName);
					f.hide();
					d.find(l.titCell + ":eq(" + a + ")").addClass(l.titOnClassName);
					if (l.delayTime < 250 && l.effect != "") l.effect = "";
					if (l.effect == "fade") {
						d.find(l.mainCell + ":eq(" + a + ")").fadeIn({
							queue: false,
							duration: 250
						})
					} else if (l.effect == "slide") {
						d.find(l.mainCell + ":eq(" + a + ")").slideDown({
							queue: false,
							duration: 250
						})
					} else {
						d.find(l.mainCell + ":eq(" + a + ")").show()
					}
					c = a
				}
			};
		var j = function() {
				e.eq(c).removeClass(l.titOnClassName);
				f.hide();
				if (++c >= g) c = 0;
				e.eq(c).addClass(l.titOnClassName);
				f.eq(c).show()
			};
		h(l.defaultIndex);
		if (l.interTime > 0) {
			var k = setInterval(function() {
				j()
			}, l.interTime)
		}
		e.each(function(i, a) {
			if (l.trigger == "click") {
				jQuery(a).click(function() {
					h(i);
					return false
				})
			} else if (l.delayTime > 0) {
				jQuery(a).hover(function() {
					b = setTimeout(function() {
						h(i);
						b = null
					}, l.delayTime)
				}, function() {
					if (b != null) clearTimeout(b)
				})
			} else {
				jQuery(a).click(function() {
					h(i)
				})
			}
		})
	});
	if (l.debug != "") alert(l[l.debug]);
	return this
};