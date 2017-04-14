if (!("ace" in window)) {
	window.ace = {}
}
	
ace.config = {
	cookie_expiry: 604800, 
	storage_method: 2
};

ace.settings = {
	is: function(b, a) {
		return (ace.data.get("settings", b + "-" + a) == 1)
	},
	exists: function(b, a) {
		return (ace.data.get("settings", b + "-" + a) !== null)
	},
	set: function(b, a) {
		ace.data.set("settings", b + "-" + a, 1)
	},
	unset: function(b, a) {
		ace.data.set("settings",b+"-"+a,-1)
	},
	remove: function(b, a) {
		ace.data.remove("settings", b + "-" + a)
	},
	navbar_fixed: function(a) {
		a = a || false;
		if (!a && ace.settings.is("sidebar", "fixed")) {
			ace.settings.sidebar_fixed(false)
		}
		var b = document.getElementById("navbar");
		var b = $("#navbar");
		if (a) {
			if (!ace.hasClass(b, "navbar-fixed-top")) {
				ace.addClass(b, "navbar-fixed-top")
			}
			if (!ace.hasClass(document.body, "navbar-fixed")) {
				ace.addClass(document.body, "navbar-fixed")
			}
			ace.settings.set("navbar","fixed")
		} else {
			ace.removeClass(b, "navbar-fixed-top");
			ace.removeClass(document.body, "navbar-fixed");
			ace.settings.unset("navbar", "fixed")
		}
		document.getElementById("ace-settings-navbar").checked = a
	},
	breadcrumbs_fixed: function(a) {
		a = a || false;
		if (a && !ace.settings.is("sidebar", "fixed")) {
			ace.settings.sidebar_fixed(true)
		}
		var b = document.getElementById("breadcrumbs");
		if (a) {
			if (!ace.hasClass(b, "breadcrumbs-fixed")) {
				ace.addClass(b, "breadcrumbs-fixed")
			}
			if (!ace.hasClass(document.body, "breadcrumbs-fixed")) {
				ace.addClass(document.body, "breadcrumbs-fixed")
			}
			ace.settings.set("breadcrumbs", "fixed")
		} else {
			ace.removeClass(b, "breadcrumbs-fixed");
			ace.removeClass(document.body, "breadcrumbs-fixed");
			ace.settings.unset("breadcrumbs", "fixed")
		}
		document.getElementById("ace-settings-breadcrumbs").checked = a
	},
	sidebar_fixed: function(a) {
		a = a || false;
		if (!a && ace.settings.is("breadcrumbs", "fixed")) {
			ace.settings.breadcrumbs_fixed(false)
		}
		if (a && !ace.settings.is("navbar", "fixed")) {
			ace.settings.navbar_fixed(true)
		}
		var b = document.getElementById("sidebar");
		if (a) {
			if (!ace.hasClass(b, "sidebar-fixed")) {
				ace.addClass(b, "sidebar-fixed")
			}
			ace.settings.set("sidebar", "fixed")
		} else {
			ace.removeClass(b,"sidebar-fixed");
			ace.settings.unset("sidebar", "fixed")
		}
		document.getElementById("ace-settings-sidebar").checked = a
	},
	main_container_fixed: function(a) {
		a = a||false;
		var c = document.getElementById("main-container");
		var b = document.getElementById("navbar-container");
		if (a) {
			if (!ace.hasClass(c, "container")) {
				ace.addClass(c, "container")
			}
			if(!ace.hasClass(b, "container")) {
				ace.addClass(b, "container")
			}
			ace.settings.set("main-container", "fixed")
		} else {
			ace.removeClass(c, "container");
			ace.removeClass(b, "container");
			ace.settings.unset("main-container", "fixed")
		}
		document.getElementById("ace-settings-add-container").checked = a;
		if (navigator.userAgent.match(/webkit/i)) {
			var d = document.getElementById("sidebar");
			ace.toggleClass(d, "menu-min");
			setTimeout(function() {
				ace.toggleClass(d, "menu-min")
			}, 0)
		}
	},
	sidebar_collapsed: function(c) {
		c = c || false;
		var e = document.getElementById("sidebar");
		var d = document.getElementById("sidebar-collapse").querySelector('[class*="icon-"]');
		var b = d.getAttribute("data-icon1");
		var a = d.getAttribute("data-icon2");
		
		// added by jokyongsu
		var prevWidth = 0;
		var prevEastLeft_1 = 0; var prevEastLeft_2 = 0;
		
		var northDiv_1 = $('#map-panel > div.easyui-layout.layout > div.panel.layout-panel.layout-panel-north');
		if (northDiv_1 != null && northDiv_1.length == 1)
			prevWidth = northDiv_1[0].clientWidth;
		
		var northDiv_2 = $('#map-panel > div.easyui-layout.layout > div.panel.layout-panel.layout-panel-north > div');
		
		//
		var southDiv_1 = $('#map-panel > div.easyui-layout.layout > div.panel.layout-panel.layout-panel-south');
		var southDiv_2 = $('#map-panel > div.easyui-layout.layout > div.panel.layout-panel.layout-panel-south > div.panel-header');
		var southDiv_3 = $('#map-panel > div.easyui-layout.layout > div.panel.layout-panel.layout-panel-south > div#search_result_table');
		var southDiv_4 = $('#map-panel > div.easyui-layout.layout > div:nth-child(7)');
		var southDiv_5 = $('#map-panel > div.easyui-layout.layout > div:nth-child(7) > div.panel-header');
		//
		var eastDiv_1 = $('#map-panel > div.easyui-layout.layout > div.panel.layout-panel.layout-panel-east');
		if (eastDiv_1 != null && eastDiv_1.length == 1)
			prevEastLeft_1 = eastDiv_1[0].offsetLeft;
			
		var eastDiv_2 = $('#map-panel > div.easyui-layout.layout > div:nth-child(8)');
		if (eastDiv_2 != null && eastDiv_2.length == 1)
			prevEastLeft_2 = eastDiv_2[0].offsetLeft;
			
		var prevMapWidth = 0;
		var centerDiv_1 = $('#map-panel > div.easyui-layout.layout > div.panel.layout-panel.layout-panel-center');
		if (centerDiv_1 != null && centerDiv_1.length == 1)
			prevMapWidth = centerDiv_1[0].clientWidth;
		
		var difference = 190-43;
		//
		
		var curVal = 0;
		
		if (c) {
			ace.addClass(e, "menu-min");
			ace.removeClass(d, b);
			ace.addClass(d, a);
			ace.settings.set("sidebar", "collapsed");

			// added by jokyongsu
			if (northDiv_1 != null && northDiv_1.length == 1) {
				curVal = prevWidth + difference;
				northDiv_1.css({width: curVal});
			}
			
			if (northDiv_2 != null && northDiv_2.length == 1) {
				curVal = prevWidth + difference;
				northDiv_2.css({width: curVal});
			}

			if (southDiv_1 != null && southDiv_1.length == 1 && southDiv_1[0].clientWidth > 0) {
				curVal = prevWidth + difference;
				southDiv_1.css({width: curVal});
			}
			
			if (southDiv_2 != null && southDiv_2.length == 1 && (southDiv_2[0].clientWidth > 0 || southDiv_4[0].clientWidth > 0)) {
				curVal = prevWidth + difference;
				southDiv_2.css({width: curVal});
			}
			
			if (southDiv_3 != null && southDiv_3.length == 1 && southDiv_3[0].clientWidth > 0) {
				curVal = prevWidth + difference;
				southDiv_3.css({width: curVal});
			}

			if (southDiv_4 != null && southDiv_4.length == 1 && southDiv_4[0].clientWidth > 0) {
				curVal = prevWidth + difference;
				southDiv_4.css({width: curVal});
			}
			
			if (southDiv_5 != null && southDiv_5.length == 1 && southDiv_5[0].clientWidth > 0) {
				curVal = prevWidth + difference;
				southDiv_5.css({width: curVal});
			}

			if (eastDiv_1 != null && eastDiv_1.length == 1) {
				curVal = prevEastLeft_1 + difference;
				eastDiv_1.css({left: curVal});
			}

			if (eastDiv_2 != null && eastDiv_2.length == 1) {
				curVal = prevEastLeft_2 + difference;
				eastDiv_2.css({left: curVal});
			}
			
			if (centerDiv_1 != null && centerDiv_1.length == 1) {
				curVal = prevMapWidth + difference;
				centerDiv_1.css({width: curVal});
			}
			//
		} else {
			ace.removeClass(e, "menu-min");
			ace.removeClass(d, a);
			ace.addClass(d, b);
			ace.settings.unset("sidebar", "collapsed");
			
			// added by jokyongsu
			if (northDiv_1 != null && northDiv_1.length == 1) {
				curVal = prevWidth - difference;
				northDiv_1.css({width: curVal});
			}
			
			if (northDiv_2 != null && northDiv_2.length == 1) {
				curVal = prevWidth - difference;
				northDiv_2.css({width: curVal});
			}

			if (southDiv_1 != null && southDiv_1.length == 1 && southDiv_1[0].clientWidth > 0) {
				curVal = prevWidth - difference;
				southDiv_1.css({width: curVal});
			}

			if (southDiv_2 != null && southDiv_2.length == 1 && (southDiv_2[0].clientWidth > 0 || southDiv_4[0].clientWidth > 0)) {
				curVal = prevWidth - difference;
				southDiv_2.css({width: curVal});
			}
			
			if (southDiv_3 != null && southDiv_3.length == 1 && southDiv_3[0].clientWidth > 0) {
				curVal = prevWidth - difference;
				southDiv_3.css({width: curVal});
			}
			
			if (southDiv_4 != null && southDiv_4.length == 1) {
				curVal = prevWidth - difference;
				southDiv_4.css({width: curVal});
			}
			
			if (southDiv_5 != null && southDiv_5.length == 1 && southDiv_5[0].clientWidth > 0) {
				curVal = prevWidth - difference;
				southDiv_5.css({width: curVal});
			}

			if (eastDiv_1 != null && eastDiv_1.length == 1) {
				curVal = prevEastLeft_1 - difference;
				eastDiv_1.css({left: curVal});
			}

			if (eastDiv_2 != null && eastDiv_2.length == 1) {
				curVal = prevEastLeft_2 - difference;
				eastDiv_2.css({left: curVal});
			}
			
			if (centerDiv_1 != null && centerDiv_1.length == 1 && centerDiv_1[0].clientWidth > 0) {
				curVal = prevMapWidth - difference;
				centerDiv_1.css({width: curVal});
			}
			//
		}
	},
};

ace.settings.check = function(c, e) {
	if (!ace.settings.exists(c, e)) {
		return
	}
	
	var a = ace.settings.is(c, e);
	var b = {"navbar-fixed": "navbar-fixed-top",
		"sidebar-fixed": "sidebar-fixed",
		"breadcrumbs-fixed": "breadcrumbs-fixed",
		"sidebar-collapsed": "menu-min",
		"main-container-fixed": "container"
	};
	
	var d = document.getElementById(c);
	if (a != ace.hasClass(d, b[c + "-" + e])) {
		ace.settings[c.replace("-", "_") + "_" + e](a)
	}
};

ace.data_storage = function(e, c) {
	var b = "ace.";
	var d = null;
	var a = 0;
	if ((e == 1 || e === c) && "localStorage" in window && window.localStorage !== null) {
		d = ace.storage;
		a = 1
	} else {
		if (d == null && (e == 2 || e === c) && "cookie" in document && document.cookie !== null) {
			d = ace.cookie;
			a = 2
		}
	}
	this.set = function(h, g, i, k) {
		if (!d) {
			return
		}
		if (i === k) {
			i = g;
			g = h;
			if (i == null) {
				d.remove(b + g)
			} else {
				if (a == 1) {
					d.set(b + g, i)
				} else {
					if (a == 2) {
						d.set(b + g, i, ace.config.cookie_expiry)
					}
				}
			}
		} else {
			if (a == 1) {
				if (i == null) {
					d.remove(b + h + "." + g)
				} else {
					d.set(b + h + "." + g, i)
				}
			} else {
				if (a == 2) {
					var j = d.get(b + h);
					var f = j ? JSON.parse(j) : {};
					if (i == null) {
						delete f[g];
						if (ace.sizeof(f) == 0) {
							d.remove(b + h);
							return
						}
					} else {
						f[g] = i
					}
					d.set(b + h, JSON.stringify(f), ace.config.cookie_expiry)
				}
			}
		}
	};
	this.get = function(h, g, j) {
		if (!d) {
			return null
		}
		if (g === j) {
			g = h;
			return d.get(b + g)
		} else {
			if (a == 1) {
				return d.get(b + h + "." + g)
			} else {
				if (a == 2) {
					var i = d.get(b + h);
					var f = i ? JSON.parse(i) : {};
					return g in f ? f[g] : null
				}
			}
		}
	};
	this.remove = function(g, f, h) {
		if (!d) {
			return
		}
		if (f === h) {
			f = g;
			this.set(f, null)
		} else {
			this.set(g, f, null)
		}
	}
};

ace.cookie = {
	get: function(c) {
		var d = document.cookie, g, f = c + "=", a;
		if (!d) {
			return
		}
		a = d.indexOf("; " + f);
		if (a == -1) {
			a = d.indexOf(f);
			if (a != 0) {
				return null
			}
		} else {
			a += 2
		}
		g = d.indexOf(";", a);
		if (g == -1) {
			g = d.length
		}
		return decodeURIComponent(d.substring(a + f.length, g))
	},
	set: function(b, e, a, g, c, f) {
		var h = new Date();
		if (typeof(a) == "object" && a.toGMTString) {
			a = a.toGMTString()
		} else {
			if (parseInt(a, 10)){
				h.setTime(h.getTime() + (parseInt(a, 10)*1000));
				a = h.toGMTString()
			} else {
				a = ""
			}
		}
		document.cookie = b + "=" + encodeURIComponent(e) + ((a) ? "; expires=" + a : "") + ((g) ? "; path=" + g : "") + ((c) ? "; domain=" + c : "") + ((f) ? "; secure" : "")
	},
	remove: function(a, b) {
		this.set(a, "", -1000, b)
	}
};

ace.storage = {
	get: function(a) {
		return window.localStorage.getItem(a)
	},
	set: function(a, b) {
		window.localStorage.setItem(a, b)
	},
	remove: function(a) {
		window.localStorage.removeItem(a)
	}
};

ace.sizeof = function(c) {
	var b = 0;
	for (var a in c) {
		if (c.hasOwnProperty(a)) {
			b++
		}
	}
	return b
};

ace.hasClass = function(b, a) {
	return(" " + b.className + " ").indexOf(" " + a + " ") > -1
};

ace.addClass = function(c, b) {
	if (!ace.hasClass(c, b)) {
		var a = c.className;
		c.className = a + (a.length ? " " : "") + b
	}
};

ace.removeClass = function(b, a) {
	ace.replaceClass(b, a)
};

ace.replaceClass = function(c, b, d) {
	var a = new RegExp(("(^|\\s)" + b + "(\\s|$)"), "i");
	c.className = c.className
		.replace(a, function(e, g, f) {
			return d ? (g + d + f) : " "
		})
		.replace(/^\s+|\s+$/g, "")
};

ace.toggleClass = function(b, a) {
	if (ace.hasClass(b, a)) {
		ace.removeClass(b, a)
	} else {
		ace.addClass(b, a)
	}
};

ace.data = new ace.data_storage(ace.config.storage_method);