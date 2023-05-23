var is = new BrowserCheck;

function al(t, e) {
		alert(utility.debug.dumpone(t, e))
}
"undefined" == typeof utility && (utility = {}), Object_weave_safe(utility, {
		math: {}
}), utility.math.intbgr2hexrgb = function (t) {
		return d2h = utility.math.dec2hex, pad = utility.math.zeroPad, "#" + pad(d2h(t % 256), 2) + pad(d2h(t / 256 % 256), 2) + pad(d2h(t / 65536 % 256), 2)
}, utility.math.mozcolor2rgb = function (t) {
		return t
}, utility.math.dec2hex = function (t) {
		return Number(parseInt(t)).toString(16)
}, utility.math.hex2dec = function (t) {
		return parseInt(t, 16)
}, utility.math.zeroPad = function (t, e) {
		for (t || (t = ""), t = t.toString(); t.length < e;) t = "0" + t;
		return t
}, utility.math.rgb2hexcolor = function (t) {
		var e;
		if (e = t.match(/^rgb\(([0-9]+),\s*([0-9]+),\s*([0-9]+)\)/i)) {
				for (var o = "", i = 1; i < 4; i++) {
						for (var r = utility.math.dec2hex(e[i]); r.length < 2;) r = "0" + r;
						o += r
				}
				return "#" + o
		}
		return t
}, Object_weave_safe(utility, {
		js: {}
}), utility.js.build = function (t, e) {
		return function () {
				e && e(), t && t()
		}
}, utility.js.empty_func = function () {}, Object_weave_safe(utility, {
		debug: {}
}), utility.debug.dump = function (t, e) {
		if (null == e && (e = ""), tm = "", "object" == typeof t) {
				for (var o in t) tm += e + o + ":{\n" + utility.debug.dump(t[o], e + "  ") + "}\n";
				return tm
		}
		return "function" == typeof t ? e + typeof t + "\n" : e + t + "\n"
}, utility.debug.dumpone = function (t, e, o) {
		if (null == e && (e = new RegExp("", "")), null == o && (o = ""), tm = "", "object" == typeof t && null != t) {
				if (void 0 !== t.push && t.push.toString().indexOf("[native code]") > 0) tm = o + "Array[" + t.length + "]\n";
				else
						for (i in t)
								if (i.toUpperCase() != i && e.test(i)) try {
										"function" != typeof t[i] && (tm += o + i + ":{" + t[i] + "}\n")
								} catch (t) {
										tm += o + i + ":ERROR{" + t.message + "}\n"
								}
				return tm
		}
		return "function" == typeof t ? o + typeof t + "\n" : o + t + "\n"
}, utility.debug.breakpoint = function (evalFunc, msg, initialExprStr) {
		null == evalFunc && (evalFunc = function (e) {
				//PM return eval(e)
		}), null == msg && (msg = "");
		for (var result = initialExprStr || "1+2";;) {
				var expr = prompt("BREAKPOINT: " + msg + "\nEnter an expression to evaluate, or Cancel to continue.", result);
				if (null == expr || "" == expr) return;
				try {
						result = evalFunc(expr)
				} catch (t) {
						result = t
				}
		}
}, Object_weave_safe(utility, {
		string: {}
}), utility.string.htmlspecialchars = function (t) {
		return Array_each([
				[">", "&gt;"],
				["<", "&lt;"],
				[" ", "&nbsp;"],
				['"', "&quot;"]
		], function (e, o) {
				t = t.replace(new RegExp("[" + e[0] + "]", "g"), e[1])
		}), t
}, utility.string.getInnerText = function (t) {
		"undefined" == typeof getInnerText_tmpDiv && (getInnerText_tmpDiv = document.createElement("div"));
		var e = t;
		try {
				getInnerText_tmpDiv.innerHTML = t, is.safari ? (t = getInnerText_tmpDiv.innerHTML, getInnerText_tmpDiv.innerHTML = "") : (t = getInnerText_tmpDiv.innerText, getInnerText_tmpDiv.innerHTML = "")
		} catch (t) {
				return e
		}
		return void 0 === t ? e : t
}, utility.string.sprintf = function () {
		if (arguments && !(arguments.length < 1) && RegExp) {
				for (var t = arguments[0], e = arguments[0], o = /([^%]*)%('.|0|\x20)?(-)?(\d+)?(\.\d+)?(%|b|c|d|u|f|o|s|x|X)(.*)/, i = b = [], r = 0; i = o.exec(t);) {
						var n = i[1],
								l = (i[2], i[3], i[4], i[5], i[6]),
								a = i[7];
						if (0, "%" == l) u = "%";
						else {
								if (++r >= arguments.length) return e;
								var s = arguments[r],
										u = s;
								"c" == l ? u = String.fromCharCode(parseInt(s)) : "d" == l ? u = parseInt(s) ? parseInt(s) : 0 : "s" == l && (u = s)
						}
						t = n + u + a
				}
				return t
		}
}, Object_weave_safe(utility, {
		dom: {}
}), utility.dom.setUnselectable = function (t) {
		if (is.ie)
				for (var e = 0; e < t.all.length; e++)
						if ("INPUT" != t.all[e].tagName && "TEXTAREA" != t.all[e].tagName) {
								var o = utility.dom.getStyleProperty(t.all[e], "cursor");
								t.all[e].unselectable = "On", "auto" == o && (t.all[e].style.cursor = "default")
						} else "text" != t.all[e].type && "TEXTAREA" != t.all[e].tagName || (t.all[e].style.cursor = "text");
		else {
				var i = utility.dom.getElementsByTagName(t, "*");
				Array_each(i, function (t) {
						var e = utility.dom.getStyleProperty(t, "cursor"),
								o = (t.nodeType, !!("input" == t.nodeName.toLowerCase() && t.getAttribute("type") && "text" == t.getAttribute("type").toLowerCase() || t.getAttribute("type") && "password" == t.getAttribute("type").toLowerCase())),
								i = "textarea" == t.nodeName.toLowerCase();
						o || i ? t.style.cursor = "text !important" : ("auto" == e && (t.style.cursor = "default"), !!utility.dom.getElementsByTagName(t, "*").length || (t.style.MozUserSelect = "none"))
				})
		}
}, utility.dom.getPixels = function (t, e) {
		var o = utility.dom.getStyleProperty(t, e);
		return o = "medium" == o ? 2 : parseInt(o, 10), o = isNaN(o) ? 0 : o
}, utility.dom.getBorderBox = function (t, e) {
		if (e = e || document, "string" == typeof t && (t = e.getElementById(t)), !t) return !1;
		if (null === t.parentNode || "none" == utility.dom.getStyleProperty(t, "display")) return !1;
		var o, i = {
						x: 0,
						y: 0,
						width: 0,
						height: 0
				},
				r = null;
		if (t.getBoundingClientRect) {
				o = t.getBoundingClientRect();
				var n = e.documentElement.scrollTop || e.body.scrollTop,
						l = e.documentElement.scrollLeft || e.body.scrollLeft;
				i.x = o.left + l, i.y = o.top + n, i.width = o.right - o.left, i.height = o.bottom - o.top
		} else if (e.getBoxObjectFor) {
				o = e.getBoxObjectFor(t), i.x = o.x, i.y = o.y, i.width = o.width, i.height = o.height;
				var a = utility.dom.getPixels(t, "border-top-width"),
						s = utility.dom.getPixels(t, "border-left-width");
				i.x -= s, i.y -= a
		} else {
				if (i.x = t.offsetLeft, i.y = t.offsetTop, i.width = t.offsetWidth, i.height = t.offsetHeight, (r = t.offsetParent) != t)
						for (; r;) i.x += r.offsetLeft, i.y += r.offsetTop, r = r.offsetParent;
				s = utility.dom.getPixels(t, "border-left-width"), a = utility.dom.getPixels(t, "border-top-width");
				i.x -= s, i.y -= a;
				navigator.userAgent.toLowerCase();
				(is.opera || is.safari && "absolute" == utility.dom.getStyleProperty(t, "position")) && (i.y -= e.body.offsetTop)
		}
		for (r = t.parentNode ? t.parentNode : null; r && "BODY" != r.tagName && "HTML" != r.tagName;) i.x -= r.scrollLeft, i.y -= r.scrollTop, r = r.parentNode ? r.parentNode : null;
		return i
}, utility.dom.setBorderBox = function (t, e) {
		var o = utility.dom.getBorderBox(t, t.ownerDocument);
		if (!1 === o) return !1;
		var i = utility.dom.getPixels(t, "left"),
				r = utility.dom.getPixels(t, "top"),
				n = {
						x: 0,
						y: 0
				};
		return null !== e.x && (n.x = e.x - o.x + i), null !== e.y && (n.y = e.y - o.y + r), null !== e.x && (t.style.left = n.x + "px"), null !== e.y && (t.style.top = n.y + "px"), !0
}, utility.dom.bringIntoView = function (t) {
		var e = utility.dom.getBorderBox(t, t.ownerDocument);
		if (!1 === e) return !1;
		var o = utility.dom.getPixels(t, "left"),
				i = utility.dom.getPixels(t, "top"),
				r = {
						x: 0,
						y: 0
				},
				n = {
						x: 0,
						y: 0
				},
				l = "CSS1Compat" == t.ownerDocument.compatMode,
				a = is.ie && l || is.mozilla ? t.ownerDocument.documentElement : t.ownerDocument.body;
		n.x = utility.dom.getPixels(a, "border-left-width"), n.y = utility.dom.getPixels(a, "border-top-width");
		var s = a.scrollTop,
				u = a.clientHeight,
				d = e.y + (is.ie ? -n.y : n.y),
				c = e.y + e.height + (is.ie ? -n.y : n.y);
		c - s > u ? (r.y = u - (c - s), d + r.y < s && (r.y = s - d)) : d < s && (r.y = s - d), 0 != r.y && (t.style.top = i + r.y + "px");
		var m = a.scrollLeft,
				y = a.clientWidth,
				f = e.x + (is.ie ? -n.x : n.x),
				p = e.x + e.width + (is.ie ? -n.x : n.x);
		p - m > y ? (r.x = y - (p - m), f + r.x < m && (r.x = m - f)) : f < m && (r.x = m - f), 0 != r.x && (t.style.left = o + r.x + "px")
}, utility.dom.putElementAt = function (source, target, relative, offset, biv) {
		offset = util_defaultValue(offset, {
				x: 0,
				y: 0
		}), biv = util_defaultValue(biv, !0);
		var si = parseInt(relative.charAt(0), 10),
				ti = parseInt(relative.charAt(1), 10),
				source_box = utility.dom.getBorderBox(source, source.ownerDocument),
				target_box = utility.dom.getBorderBox(target, target.ownerDocument),
				sx = ["0", "-source_box.width", "-source_box.width", "0", "-source_box.width/2", "-source_box.width", "-source_box.width/2", "0", "-source_box.width/2"],
				tx = ["target_box.x", "target_box.x+target_box.width", "target_box.x+target_box.width", "target_box.x", "target_box.x+target_box.width/2", "target_box.x+target_box.width", "target_box.x+target_box.width/2", "target_box.x", "target_box.x+target_box.width/2"],
				sy = ["0", "0", "-source_box.height", "-source_box.height", "0", "-source_box.height/2", "-source_box.height", "-source_box.height/2", "-source_box.height/2"],
				ty = ["target_box.y", "target_box.y", "target_box.y+target_box.height", "target_box.y+target_box.height", "target_box.y", "target_box.y+target_box.height/2", "target_box.y+target_box.height", "target_box.y+target_box.height/2", "target_box.y+target_box.height/2"],
				box = {
						x: 0,
						y: 0
				};
		//PM		return box.x = eval(sx[si] + " + " + tx[ti]) + offset.x, box.y = eval(sy[si] + " + " + ty[ti]) + offset.y, utility.dom.setBorderBox(source, box), biv && utility.dom.bringIntoView(source), !0
}, utility.dom.put = function (t, e, o) {
		t.style.left = e + "px", t.style.top = o + "px"
}, utility.dom.resize = function (t, e, o) {
		t.style.width = e + "px", t.style.height = o + "px"
}, utility.dom.focusElem = function (t) {
		var e;
		(e = this.getElem(t)) && e.focus && e.focus()
}, utility.dom.hideElem = function (t) {
		this.setCssProperty(t, "display", "none")
}, utility.dom.showElem = function (t, e) {
		var o, i = {
						table: "table",
						tr: "table-row",
						td: "table-cell"
				},
				r = (t = utility.dom.getElem(t)).tagName.toLowerCase();
		o = e ? "force" : void 0 !== i[r] ? i[r] : "block";
		try {
				this.setCssProperty(t, "display", o)
		} catch (e) {
				this.setCssProperty(t, "display", "block")
		}
}, utility.dom.toggleElem = function (t, e) {
		t = utility.dom.getElem(t);
		try {
				t.style.display && "none" != t.style.display ? utility.dom.hideElem(t) : utility.dom.showElem(t, e)
		} catch (t) {}
}, utility.dom.selectOption = function (t, e) {
		var o;
		if (t) {
				for (o = 0; o < t.options.length; o++) t.options[o].removeAttribute("selected");
				for (o = 0; o < t.options.length; o++) {
						if (t.options[o].value == e) return t.options[o].setAttribute("selected", "selected"), void(t.options[o].selected = !0);
						t.options[o].removeAttribute("selected")
				}
		}
}, utility.dom.getSelected = function (t) {
		return t.options[t.selectedIndex].value
}, utility.dom.getPositionRelativeTo00 = function (t, e, o, i) {
		var r, n, l, a, s;
		is.mozilla ? (r = document.width, n = document.height, l = window.pageXOffset, a = window.pageYOffset) : (r = (s = "CSS1Compat" == document.compatMode ? document.documentElement : document.body).offsetWidth - 20, n = s.offsetHeight, l = s.scrollLeft, a = s.scrollTop);
		return t + o > r + l && (t = r + l - o), e + i > n + a && (e = n + a - i), t < 0 && (t = 0), e < 0 && (e = 0), {
				x: t,
				y: e
		}
}, utility.dom.setCssProperty = function (t, e, o) {
		var i;
		t && e && o && (i = this.getElem(t)) && (i.style[e] = o)
}, utility.dom.getElem = function (t) {
		return "string" == typeof t ? document.getElementById(t) : t
}, utility.dom.getClassNames = function (t) {
		if (!(t = utility.dom.getElem(t))) return !1;
		var e = void 0 === t.className ? "" : t.className,
				o = String_trim(String_normalize_space(e));
		return "" == o ? [] : o.split(" ")
}, utility.dom.classNameAdd = function (t, e) {
		var o = utility.dom.getClassNames(t);
		"string" == typeof e && (e = e.split(",")), Array_each(e, function (t, e) {
				-1 == Array_indexOf(o, t) && Array_push(o, t)
		}), o = String_trim(o.join(" "));
		var i = void 0 === t.className ? "" : t.className;
		String_trim(i) != o && (t.className = o)
}, utility.dom.classNameRemove = function (t, e) {
		var o = utility.dom.getClassNames(t),
				i = [];
		"string" == typeof e && (e = e.split(",")), Array_each(o, function (t, o) {
				-1 == Array_indexOf(e, t) && Array_push(i, t)
		}), o = String_trim(i.join(" "));
		var r = void 0 === t.className ? "" : t.className;
		String_trim(r) != o && (t.className = o)
}, utility.dom.insertAfter = function (t, e) {
		var o = e.nextSibling,
				i = e.parentNode;
		if (null == o) var r = i.appendChild(t);
		else r = i.insertBefore(t, o);
		return r
}, utility.dom.getPreviousSiblingByTagName = function (t, e, o) {
		if (t.nodeName.toLowerCase() == e.toLowerCase() && !o) return t;
		for (; t.previousSibling && t.previousSibling.nodeName.toLowerCase() != e.toLowerCase();) t = t.previousSibling;
		return t.previousSibling && t.previousSibling.nodeName.toLowerCase() == e.toLowerCase() ? t.previousSibling : null
}, utility.dom.getNextSiblingByTagName = function (t, e, o) {
		if (t.nodeName.toLowerCase() == e.toLowerCase() && !o) return t;
		for (; t.nextSibling && t.nextSibling.nodeName.toLowerCase() != e.toLowerCase();) t = t.nextSibling;
		return t.nextSibling && t.nextSibling.nodeName.toLowerCase() == e.toLowerCase() ? t.nextSibling : null
}, utility.dom.getParentByTagName = function (t, e) {
		if (t.nodeName.toLowerCase() == e.toLowerCase()) return t;
		for (; t.parentNode && t.parentNode.nodeName.toLowerCase() != e.toLowerCase() && "BODY" != t.parentNode.nodeName;) t = t.parentNode;
		return t.parentNode && t.parentNode.nodeName.toLowerCase() == e.toLowerCase() ? t.parentNode : null
}, utility.dom.getElementsByTagName = function (t, e) {
		return t = void 0 === t ? document : utility.dom.getElem(t), "*" == e || void 0 === e ? utility.dom.getAllChildren(t) : t.getElementsByTagName(e.toLowerCase())
}, utility.dom.getElementsByClassName = function (t, e, o) {
		var i = [];
		return Array_each(utility.dom.getElementsByTagName(t, o), function (t, o) {
				-1 != Array_indexOf(utility.dom.getClassNames(t), e) && Array_push(i, t)
		}), i
}, utility.dom.getElementById = function (t, e, o) {
		var i = [];
		return Array_each(utility.dom.getElementsByTagName(t, o), function (t, o) {
				void 0 !== t.id && null != t.id && t.id.toString() == e && Array_push(i, t)
		}), i
}, utility.dom.getElementsByProps = function (t, e) {
		var r, n = [];
		return t = void 0 === t ? document : utility.dom.getElem(o), r = o.all ? o.all : o.getElementsByTagName("*"), Array_each(r, function (t) {
				var o = !0;
				for (i in e) {
						try {
								var r = t[i]
						} catch (t) {
								r = null
						}
						o = o && r == e[i]
				}
				o && Array_push(n, t)
		}), n
}, utility.dom.getChildrenByTagName = function (t, e) {
		var o, i = [];
		if (void 0 === e && (e = "*"), e = e.toLowerCase(), !t.childNodes) return i;
		for (var r = 0; r < t.childNodes.length; r++) {
				o = t.childNodes[r];
				try {
						(void 0 !== o && void 0 !== o.tagName && o.tagName.toLowerCase() == e || "*" == e) && Array_push(i, o)
				} catch (t) {}
		}
		return i
}, utility.dom.getChildrenByClassName = function (t, e, o) {
		var i = [];
		i = Array_each(utility.dom.getChildrenByTagName(o), function (t, o) {
				-1 != Array_indexOf(utility.dom.getClassNames(item), e) && Array_push(i, t)
		})
}, utility.dom.getAllChildren = function (t) {
		return t.all ? t.all : t.getElementsByTagName("*")
}, utility.dom.getElementsBySelector = function (t, e) {
		if (void 0 === e && (e = document), !document.getElementsByTagName) return [];
		for (var o = t.split(" "), i = new Array(e), r = 0; r < o.length; r++)
				if (token = o[r].replace(/^\s+/, "").replace(/\s+$/, ""), token.indexOf("#") > -1) {
						var n = (s = token.split("#"))[0],
								l = s[1],
								a = document.getElementById(l);
						if (a && n && a.nodeName.toLowerCase() != n) return [];
						i = new Array(a)
				} else if (token.indexOf(".") > -1) {
				n = (s = token.split("."))[0];
				var s, u = s[1];
				n || (n = "*");
				for (var d = new Array, c = 0, m = 0; m < i.length; m++) {
						x = "*" == n ? utility.dom.getAllChildren(i[m]) : i[m].getElementsByTagName(n);
						for (var y = 0; y < x.length; y++) d[c++] = x[y]
				}
				i = new Array;
				for (var f = 0, p = 0; p < d.length; p++) {
						var g = void 0 === d[p].className ? "" : d[p].className;
						g && g.match(new RegExp("\\b" + u + "\\b")) && (i[f++] = d[p])
				}
		} else if (token.match(/^(\w*)\[(\w+)([=~\|\^\$\*]?)=?"?([^\]"]*)"?\]$/)) {
				n = RegExp.$1;
				var h = RegExp.$2,
						v = RegExp.$3,
						w = RegExp.$4;
				n || (n = "*");
				for (d = new Array, c = 0, m = 0; m < i.length; m++) {
						x = "*" == n ? utility.dom.getAllChildren(i[m]) : i[m].getElementsByTagName(n);
						for (y = 0; y < x.length; y++) d[c++] = x[y]
				}
				i = new Array;
				var b;
				f = 0;
				switch (v) {
						case "=":
								b = function (t) {
										try {
												return t.getAttribute(h).toString() == w
										} catch (t) {}
								};
								break;
						case "~":
								b = function (t) {
										try {
												return t.getAttribute(h).toString().match(new RegExp(w))
										} catch (t) {
												return !1
										}
								};
								break;
						case "|":
								b = function (t) {
										return t.getAttribute(h).toString().match(new RegExp("^" + w + "-?"))
								};
								break;
						case "^":
								b = function (t) {
										return 0 == t.getAttribute(h).toString().indexOf(w)
								};
								break;
						case "$":
								b = function (t) {
										return t.getAttribute(h).toString().lastIndexOf(w) == t.getAttribute(h).length - w.length
								};
								break;
						case "*":
								b = function (t) {
										return t.getAttribute(h).toString().indexOf(w) > -1
								};
								break;
						default:
								b = function (t) {
										return t.getAttribute(h)
								}
				}
				i = new Array;
				for (f = 0, p = 0; p < d.length; p++) b(d[p]) && (i[f++] = d[p])
		} else {
				n = token;
				for (d = new Array, c = 0, m = 0; m < i.length; m++)
						if (null != i[m]) {
								var x = i[m].getElementsByTagName(n);
								for (y = 0; y < x.length; y++) d[c++] = x[y]
						} i = d
		}
		return i
}, utility.dom.createForm = function (t, e, o) {
		void 0 === t && (t = {}), void 0 === e && (e = []), void 0 === o && (o = document);
		t = Object_weave_safe(t, {
				name: "",
				id: "",
				action: "",
				method: "POST",
				target: ""
		});
		var i = utility.dom.createElement("FORM", {
				name: t.name,
				id: t.id,
				action: t.action,
				method: t.method,
				style: "display: none"
		});
		return Array_each(e, function (t, e) {
				i.appendChild(utility.dom.createElement("INPUT", {
						type: "hidden",
						id: t[0],
						name: t[0],
						value: t[1]
				}))
		}), (i = o.body.appendChild(i)).target = t.target, i
}, utility.dom.createIframe = function (t, e) {
		void 0 === t && (t = {}), void 0 === e && (e = document);
		var o, i = {
				name: "",
				id: "",
				src: t.src
		};
		if (t = Object_weave_safe(t, i), is.mozilla)(o = utility.dom.createElement("iframe", {
				id: t.id,
				name: t.name,
				style: "display: none;"
		})).src = t.src, (o = e.body.appendChild(o)).name = t.name, o.id = t.id;
		else if (is.ie) {
				var r = '<iframe name="' + t.name + '" src="' + t.src + '" id="' + t.id + '" style="display: none;"></iframe>',
						n = e.createElement("div");
				e.body.appendChild(n), n.innerHTML = r
		}
		return o = e.getElementById(t.id)
}, utility.dom.addIframeLoad = function (t, e) {
		is.mozilla ? t.onload = function () {
				e()
		} : t.onreadystatechange = function () {
				"complete" == t.readyState && e()
		}
}, utility.dom.removeIframeLoad = function (t) {
		is.ie && (t.onreadystatechange = function () {}), is.mozilla && (t.onload = function () {})
}, utility.dom.buildUrl = function () {}, utility.dom.stripAttributes = function (t, e) {
		var o = ["onload", "data", "onmouseover", "onmouseout", "onmousedown", "onmouseup", "ondblclick", "onclick", "onselectstart", "oncontextmenu", "onkeydown", "onkeypress", "onkeyup", "onblur", "onfocus", "onbeforedeactivate", "onchange"];
		if (void 0 === t || null == t) return !0;
		for (var i = o.length; i--;) t[o[i]] = null;
		if (void 0 !== e)
				for (i = e.length; i--;) t[e[i]] = null
}, utility.dom.attachEvent2 = function (t, e, o, i) {
		utility.dom.attachEvent_base(t, e, o, i, 1)
}, utility.dom.attachEvent = function (t, e, o, i) {
		utility.dom.attachEvent_base(t, e, o, i, 0)
}, utility.dom.attachEvent_base = function (t, e, o, i, r) {
		void 0 === i && (i = 1);
		var n = e.match(/unload$/i),
				l = (e.match(/^on/), e.replace(/^on/, ""));
		void 0 === t.__eventHandlers && (t.__eventHandlers = {});
		var a = null;
		if (void 0 === t.__eventHandlers[l]) {
				t.__eventHandlers[l] = [], a = t.__eventHandlers[l];
				var s = function (e) {
						!e && window.event && (e = window.event);
						for (var o = 0; o < t.__eventHandlers[l].length; o++) {
								var i = t.__eventHandlers[l][o];
								"function" == typeof i && (i.apply(t, [e]), i = null)
						}
				};
				t.addEventListener ? t.addEventListener(l, s, !1) : t.attachEvent ? t.attachEvent("on" + l, s) : t["on" + l] = s, is.ie && is.mac || n || EventCache.add(t, l, s, 1)
		} else a = t.__eventHandlers[l];
		for (var u = 0; u < a.length; u++) {
				if (a[u] == o) return;
				try {
						if (a[u] && o && a[u].toString() == o.toString()) return
				} catch (t) {}
		}
		a[a.length] = o
};
var EventCache = function () {
		var t = [];
		return {
				listEvents: t,
				add: function (e, o, i, r) {
						Array_push(t, arguments)
				},
				flush: function () {
						var e, o;
						for (e = t.length - 1; e >= 0; e -= 1)
								if (o = t[e]) {
										o[0].removeEventListener && o[0].removeEventListener(o[1], o[2], o[3]);
										var i = "";
										"on" != o[1].substring(0, 2) ? (i = o[1], o[1] = "on" + o[1]) : i = o[1].substring(2, event_name_without_on.length), void 0 !== o[0].__eventHandlers && void 0 !== o[0].__eventHandlers[i] && (o[0].__eventHandlers[i] = null), o[0].detachEvent && o[0].detachEvent(o[1], o[2]), o[0][o[1]] = null
								} t = null
				}
		}
}();
utility.dom.getStyleProperty = function (t, e) {
		try {
				var o = t.style[e]
		} catch (t) {
				return ""
		}
		if (!o)
				if (t.ownerDocument.defaultView && "function" == typeof t.ownerDocument.defaultView.getComputedStyle) o = t.ownerDocument.defaultView.getComputedStyle(t, "").getPropertyValue(e);
				else if (t.currentStyle) {
				var i = e.split(/-/);
				if (i.length > 0) {
						e = i[0];
						for (var r = 1; r < i.length; r++) e += i[r].charAt(0).toUpperCase() + i[r].substring(1)
				}
				o = t.currentStyle[e]
		} else t.style && (o = t.style[e]);
		return o
}, utility.dom.getLink = function (t) {
		return is.ie ? is.mac ? href = t.getAttribute("href") : href = t.outerHTML.toString().replace(/.*href="([^"]*)".*/, "$1") : href = t.getAttribute("href"), href
}, utility.dom.getDisplay = function (t) {
		return utility.dom.getStyleProperty(t, "display")
}, utility.dom.getVisibility = function (t) {
		return utility.dom.getStyleProperty(t, "visibility")
};
var first_getAbsolutePos_caller_element = null;
utility.dom.getAbsolutePos = function (t) {
		var e = 0,
				o = 0,
				i = t.tagName.toUpperCase();
		utility.dom.getAbsolutePos.caller != utility.dom.getAbsolutePos && (first_getAbsolutePos_caller_element = t), -1 == Array_indexOf(["BODY", "HTML"], i) && first_getAbsolutePos_caller_element != t && (t.scrollLeft && (e = t.scrollLeft), t.scrollTop && (o = t.scrollTop));
		var r = {
				x: t.offsetLeft - e,
				y: t.offsetTop - o
		};
		if (t.offsetParent && "BODY" != i) {
				var n = utility.dom.getAbsolutePos(t.offsetParent);
				r.x += n.x, r.y += n.y
		}
		return r
}, utility.dom.setEventVars = function (t) {
		var e, o, i = 0,
				r = 0;
		if (t || (t = window.event), !t) return {
				e: null,
				relTarg: null,
				targ: null,
				posx: 0,
				posy: 0,
				leftclick: !1,
				middleclick: !1,
				rightclick: !1,
				type: ""
		};
		t.relatedTarget ? o = t.relatedTarget : t.fromElement && (o = t.fromElement), t.target ? e = t.target : t.srcElement && (e = t.srcElement);
		var n = utility.dom.getPageScroll();
		if (t.pageX || t.pageY ? (i = t.pageX, r = t.pageY) : (t.clientX || t.clientY) && (i = t.clientX + n.x, r = t.clientY + n.y), window.event) var l = 1 == t.button,
				a = 4 == t.button,
				s = 2 == t.button;
		else l = 0 == t.button, a = 1 == t.button, s = 2 == t.button || 0 == t.button && is.mac && t.ctrlKey;
		var u = {
				e: t,
				relTarg: o,
				targ: e,
				posx: i,
				posy: r,
				leftclick: l,
				middleclick: a,
				rightclick: s
		};
		try {
				u.type = t.type
		} catch (t) {
				u.type = ""
		}
		return u
}, utility.dom.stopEvent = function (t) {
		return void 0 === is && (is = new BrowserCheck), void 0 !== t && null != t && (is.ie && (t.cancelBubble = !0), t.stopPropagation && t.stopPropagation(), is.ie && (t.returnValue = !1), t.preventDefault && t.preventDefault()), !1
}, utility.dom.toggleSpecialTags = function (t, e, o, i, r) {
		var n = ["select"];
		if (1 == o) var l = utility.dom.getBox(t);
		for (var a = 0; a < n.length; a++) {
				var s = null;
				i && i.nodeType && 9 == i.nodeType ? (s = i, utility.dom.toggleSpecialTags._saved_DOC = i) : s = i && utility.dom.toggleSpecialTags._saved_DOC && utility.dom.toggleSpecialTags._saved_DOC.nodeType && 9 == utility.dom.toggleSpecialTags._saved_DOC.nodeType ? utility.dom.toggleSpecialTags._saved_DOC : document;
				for (var u = s.getElementsByTagName(n[a]), d = 0; d < u.length; d++)
						if (e != u[d])
								if (1 == o) {
										var c = utility.dom.getVisibility(u[d]);
										if ("none" == utility.dom.getDisplay(u[d]) || "hidden" == c) continue;
										var m = utility.dom.getBox(u[d]);
										if (r) {
												var y = utility.dom.getBox(r);
												m.x += y.x, m.y += y.y
										}
										if (utility.dom.boxOverlap(l, m))
												if (i && r) {
														if (!u[d].oldPosition) {
																var f = utility.dom.getStyleProperty(u[d], "position");
																u[d].oldPosition = f
														}
														if (!u[d].oldLeft) {
																var p = utility.dom.getStyleProperty(u[d], "left");
																u[d].oldLeft = p
														}
														u[d].style.position = "relative", u[d].style.left = "-1000px"
												} else u[d].oldvisibility || (u[d].oldvisibility = c), u[d].style.visibility = "hidden"
								} else i && r ? (u[d].oldPosition && (u[d].style.position = u[d].oldPosition, u[d].removeAttribute("oldPosition")), u[d].oldLeft && (u[d].style.left = u[d].oldLeft, u[d].removeAttribute("oldLeft"))) : u[d].oldvisibility && (u[d].style.visibility = u[d].oldvisibility)
		}
}, utility.dom.boxOverlap = function (t, e) {
		return !(t.x + t.width < e.x || t.x > e.x + e.width || t.y + t.height < e.y || t.y > e.y + e.height)
}, utility.dom.getBox = function (t) {
		var e = {
						x: 0,
						y: 0,
						width: 0,
						height: 0,
						scrollTop: 0,
						scrollLeft: 0
				},
				o = "CSS1Compat" == t.ownerDocument.compatMode;
		if (t.ownerDocument.getBoxObjectFor) {
				var i = t.ownerDocument.getBoxObjectFor(t);
				e.x = i.x - t.parentNode.scrollLeft, e.y = i.y - t.parentNode.scrollTop, e.width = i.width, e.height = i.height, e.scrollLeft = (o ? t.ownerDocument.documentElement : t.ownerDocument.body).scrollLeft, e.scrollTop = (o ? t.ownerDocument.documentElement : t.ownerDocument.body).scrollTop
		} else if (t.getBoundingClientRect) {
				i = t.getBoundingClientRect();
				e.x = i.left, e.y = i.top, e.width = i.right - i.left, e.height = i.bottom - i.top, e.scrollLeft = 0, e.scrollTop = 0
		} else {
				var r = utility.dom.getAbsolutePos(t);
				e.x = r.x - t.parentNode.scrollLeft, e.y = r.y - t.parentNode.scrollTop, e.width = utility.dom.getStyleProperty(t, "width"), e.height = utility.dom.getStyleProperty(t, "height"), e.scrollLeft = t.ownerDocument.body.scrollLeft, e.scrollTop = t.ownerDocument.body.scrollTop
		}
		return e
}, utility.dom.getBBox = function (t) {
		var e = {
						x: 0,
						y: 0,
						width: 0,
						height: 0,
						scrollTop: 0,
						scrollLeft: 0
				},
				o = "CSS1Compat" == t.ownerDocument.compatMode;
		if (t.ownerDocument.getBoxObjectFor) {
				o ? t.ownerDocument.documentElement : document;
				for (var i = parseInt(utility.dom.getStyleProperty(t, "border-top-width")), r = parseInt(utility.dom.getStyleProperty(t, "border-left-width")), n = (parseInt(utility.dom.getStyleProperty(t, "border-right-width")), parseInt(utility.dom.getStyleProperty(t, "border-bottom-width")), t.ownerDocument.getBoxObjectFor(t)), l = 0, a = 0; t.parentNode;) t.scrollTop && (a += t.scrollTop), t.scrollLeft && (l += t.scrollLeft), t = t.parentNode;
				e.scrollLeft = l, e.scrollTop = a, e.x = n.x - r - l, e.y = n.y - i - a, e.width = n.width, e.height = n.height
		} else if (t.getBoundingClientRect) {
				var s = o ? t.ownerDocument.documentElement : document.body;
				i = parseInt(utility.dom.getStyleProperty(t, "border-top-width")) || 0, r = parseInt(utility.dom.getStyleProperty(t, "border-left-width")) || 0, n = t.getBoundingClientRect();
				e.x = n.left - r, e.y = n.top - i, e.width = n.right - n.left, e.height = n.bottom - n.top, e.scrollLeft = 0, e.scrollTop = 0
		} else {
				s = t.ownerDocument.documentElement;
				var u = parseInt(utility.dom.getStyleProperty(s, "margin-top")),
						d = parseInt(utility.dom.getStyleProperty(s, "margin-left")),
						c = (i = parseInt(utility.dom.getStyleProperty(s, "border-top-width")), r = parseInt(utility.dom.getStyleProperty(s, "border-left-width")), parseInt(utility.dom.getStyleProperty(s, "padding-top"))),
						m = parseInt(utility.dom.getStyleProperty(s, "padding-left"));
				s = t.offsetParent;
				var y = parseInt(utility.dom.getStyleProperty(s, "margin-top")),
						f = parseInt(utility.dom.getStyleProperty(s, "margin-left")),
						p = utility.dom.getAbsolutePos(t);
				e.x = p.x, e.y = p.y, e.width = parseInt(utility.dom.getStyleProperty(t, "width")), e.height = parseInt(utility.dom.getStyleProperty(t, "height")), e.scrollLeft = t.ownerDocument.body.scrollLeft, e.scrollTop = t.ownerDocument.body.scrollTop, is.opera && (e.x -= d + r + m + f, e.y -= u + i + c + y)
		}
		return e
}, utility.dom.getPageInnerSize = function () {
		var t, e;
		return void 0 !== self.innerHeight ? (t = self.innerWidth, e = self.innerHeight) : void 0 !== document.compatMode && "CSS1Compat" == document.compatMode ? (t = document.documentElement.clientWidth, e = document.documentElement.clientHeight) : document.body && (t = document.body.clientWidth, e = document.body.clientHeight), {
				x: t,
				y: e
		}
}, utility.dom.getPageScroll = function () {
		var t, e;
		return void 0 !== self.pageYOffset ? (t = self.pageXOffset, e = self.pageYOffset) : void 0 !== document.compatMode && "CSS1Compat" == document.compatMode ? (t = document.documentElement.scrollLeft, e = document.documentElement.scrollTop) : document.body && (t = document.body.scrollLeft, e = document.body.scrollTop), {
				x: t,
				y: e
		}
}, utility.dom.createElement = function (t, e, o) {
		if (void 0 === is && (is = new BrowserCheck), void 0 !== o) var i = o.document.createElement(t);
		else i = document.createElement(t);
		if (void 0 !== e)
				for (var r in e) switch (!0) {
						case "text" == r:
								i.appendChild(document.createTextNode(e[r]));
								break;
						case "class" == r:
								i.className = e[r];
								break;
						case "id" == r:
								i.id = e[r];
								break;
						case "type" == r:
								if ("input" == t.toLowerCase() && is.ie && is.mac) {
										var n = document.createElement("SPAN");
										document.body.appendChild(n), n.style.display = "none", n.innerHTML = i.outerHTML.replace(/<input/i, '<input type="' + e[r] + '"'), i = n.firstChild, document.body.removeChild(n)
								} else "input" == t.toLowerCase() && is.mac && is.safari ? i.setAttribute("type", e[r]) : i.type = e[r];
								break;
						case "style" == r:
								i.style.cssText = e[r];
								break;
						default:
								try {
										i.setAttribute(r, e[r]), i[r] = e[r]
								} catch (t) {}
				}
		return e.value && (i.value = e.value), i
}, utility.dom.getImports = function (t) {
		try {
				if (is.ie) return t.imports;
				for (var e = [], o = 0; o < t.cssRules.length; o++) is.safari ? void 0 !== t.cssRules[o].href && Array_push(e, t.cssRules[o].styleSheet) : t.cssRules[o].toString().match("CSSImportRule") && Array_push(e, t.cssRules[o].styleSheet);
				return e
		} catch (t) {
				return []
		}
}, utility.dom.getRuleBySelector = function (t, e) {
		try {
				var o = [];
				o = is.ie ? t.rules : t.cssRules;
				for (var i = [], r = 0; r < o.length; r++) {
						var n = o[r];
						n.selectorText.toString().match(e) && Array_push(i, n)
				}
				return i
		} catch (t) {
				return []
		}
}, utility.dom.createStyleSheet = function (t, e) {
		if (is.ie) return t.createStyleSheet(e);
		if (is.mozilla) {
				var o = t.getElementsByTagName("head")[0],
						i = t.createElement("style");
				if (i.type = "text/css", i.rules = new Array, o.appendChild(i), "" != e) {
						var r = new XMLHttpRequest;
						try {
								r.open("GET", e, !1), r.send(null)
						} catch (o) {
								return alert('Cannot load a stylesheet from a server other than the current server.\r\nThe current server is "' + t.location.hostname + '".\r\nThe requested stylesheet URL is "' + e + '".'), null
						}
						if (404 == r.status) return prompt("Stylesheet was not found:", e), null;
						var n = t.createTextNode(r.responseText);
						i.appendChild(n);
						nameList = r.responseText.split(/\s*\{([^\}]*)\}\s*/);
						for (var l = 0; l < nameList.length; l += 2) {
								var a = new Object;
								a.selectorText = nameList[l], a.cssText = nameList[l + 1], i.rules.push(a)
						}
				} else {
						n = t.createTextNode("u");
						i.appendChild(n)
				}
				return i
		}
}, Object_weave_safe(utility, {
		date: {}
}), $UNI_DATETIME_MASK_SEPARATORS = ["-", "/", "[", "]", "(", ")", "*", "+", ".", "s", ":"], $UNI_DATETIME_MASK_REGEXP = "[";
for (var zi = 0; zi < $UNI_DATETIME_MASK_SEPARATORS.length; zi++) $UNI_DATETIME_MASK_REGEXP += "\\" + $UNI_DATETIME_MASK_SEPARATORS[zi] + "|";

function prepfixieinsertnodescrollup() {
		if (is.ie && "undefined" != typeof ktmls) {
				prepfixieinsertnodescrollup.scrolls = [];
				for (var t = 0; t < ktmls.length; t++) ktmls[t].destroyed || (prepfixieinsertnodescrollup.scrolls[t] = ktmls[t].edit.body.scrollTop)
		}
}

function fixieinsertnodescrollup() {
		window.setTimeout("fixieinsertnodescrollup_late()", 1)
}

function fixieinsertnodescrollup_late() {
		if (is.ie && "undefined" != typeof ktmls)
				for (var t = ktmls.length - 1; t >= 0; t--) ktmls[t].destroyed || (ktmls[t].edit.body.scrollTop = prepfixieinsertnodescrollup.scrolls[t])
}

function getDomDocumentPrefix() {
		if (getDomDocumentPrefix.prefix) return getDomDocumentPrefix.prefix;
		for (var t = ["MSXML2", "Microsoft", "MSXML", "MSXML3"], e = 0; e < t.length; e++) try {
				return new ActiveXObject(t[e] + ".DomDocument"), getDomDocumentPrefix.prefix = t[e]
		} catch (t) {}
		throw new Error("Could not find an installed XML parser")
}

function getXmlHttpPrefix() {
		if (getXmlHttpPrefix.prefix) return getXmlHttpPrefix.prefix;
		for (var t = ["MSXML2", "Microsoft", "MSXML", "MSXML3"], e = 0; e < t.length; e++) try {
				return new ActiveXObject(t[e] + ".XmlHttp"), getXmlHttpPrefix.prefix = t[e]
		} catch (t) {}
		throw new Error("Could not find an installed XML parser")
}

function XmlHttp() {}

function XmlDocument() {}
if ($UNI_DATETIME_MASK_REGEXP += "]", $UNI_DATETIME_MASK_REGEXP = new RegExp($UNI_DATETIME_MASK_REGEXP, "g"), utility.date.date2regexp = function (t) {
				return t = (t = (t = (t = (t = (t = (t = (t = (t = (t = (t = (t = (t = (t = (t = (t = (t = (t = (t = (t = (t = (t = (t = t.replace(/[\/\-\.]/g, "DATESEPARATOR")).replace(/([-\/\[\]\(\)\*\+\.\:])/g, "\\$1")).replace(/DATESEPARATOR/g, "[\\/\\-\\.]")).replace(/(\\s)/g, "s")).replace(/yyyy/gi, "([0-9]{1,4})")).replace(/yy/gi, "([0-9]{1,4})")).replace(/y/gi, "([0-9]{1,4})")).replace(/mm/g, "([0-9]{1,2})")).replace(/m/g, "([0-9]{1,2})")).replace(/dd/g, "([0-9]{1,2})")).replace(/d/g, "([0-9]{1,2})")).replace(/HH/g, "([0-9]{1,2})*")).replace(/H/g, "([0-9]{1,2})*")).replace(/hh/g, "([0-9]{1,2})*")).replace(/h/g, "([0-9]{1,2})*")).replace(/ii/g, "([0-9]{1,2})*")).replace(/i/g, "([0-9]{1,2})*")).replace(/ss/g, "([0-9]{1,2})*")).replace(/s/g, "([0-9]{1,2})*")).replace(/tt/g, "(AM|PM|am|pm|A|P|a|p)*")).replace(/t/g, "(AM|PM|am|pm|A|P|a|p)*")).replace(/ /g, " *")).replace(/:/g, ":*"), new RegExp("^" + t + "$")
		}, utility.date.parse_date = function (t, e) {
				for (var o = vMonth = vDay = null, i = vHour12h = vHour24H = vMinutes = vSeconds = vTimeMarker1C = vTimeMarker2C = null, r = e.split($UNI_DATETIME_MASK_REGEXP), n = 0, l = 0, a = 0; a < r.length; a++) {
						var s = r[a],
								u = t[++n];
						if (Array_indexOf("HH,H,ii,i,ss,s".split(","), s) >= 0 && ("" != u && void 0 !== u || (u = "0")), Array_indexOf("hh,h".split(","), s) >= 0) {
								var d = parseInt(u, 10);
								if ("" == u || void 0 === u) u = "12";
								else if (d > 12 && d < 24) {
										"" == t[Array_indexOf(r, "t") >= 0 ? Array_indexOf(r, "t") + 1 : Array_indexOf(r, "tt") + 1] && (u = d - 12, l = 1)
								}
						}
						switch (Array_indexOf("tt,t".split(","), s) >= 0 && "" == u && (u = [
								["A", "AM"],
								["P", "PM"]
						][l][s.length - 1]), s) {
								case "yyyy":
								case "YYYY":
										o = parseInt(u, 10);
										break;
								case "yy":
								case "YY":
								case "y":
										(o = parseInt(u, 10)) < 1e3 && (o = o < 10 ? 2e3 + o : o < 70 ? 2e3 + o : 1900 + o);
										break;
								case "mm":
								case "m":
										vMonth = parseInt(u, 10);
										break;
								case "dd":
								case "d":
										vDay = parseInt(u, 10);
										break;
								case "HH":
								case "H":
										vHour24H = parseInt(u, 10);
										break;
								case "hh":
								case "h":
										vHour12h = parseInt(u, 10);
										break;
								case "ii":
								case "i":
										vMinutes = parseInt(u, 10);
										break;
								case "ss":
								case "s":
										vSeconds = parseInt(u, 10);
										break;
								case "t":
										vTimeMarker1C = u;
										break;
								case "tt":
										vTimeMarker2C = u
						}
				}
				o = null == o ? 1900 : o, vMonth = null == vMonth ? 0 : vMonth, vDay = null == vDay ? 1 : vDay, vMinutes = null == vMinutes ? 0 : vMinutes, vSeconds = null == vSeconds ? 0 : vSeconds;
				null != vHour12h ? vHour12h >= 1 && vHour12h <= 12 ? (i = vHour12h, "P" == (vTimeMarker1C || vTimeMarker2C || "").charAt(0) ? vHour12h < 12 && (i = vHour12h + 12) : 12 == vHour12h && (i = 0)) : i = -1e3 : i = null != vHour24H ? vHour24H : 0;
				var c = {
						year: o,
						month: vMonth,
						day: vDay,
						hour: i,
						minutes: vMinutes,
						seconds: vSeconds
				};
				return e.indexOf("y") < 0 && e.indexOf("m") < 0 && e.indexOf("d") < 0 && (c.year = "1900", c.month = "1", c.day = 1), c
		}, Object_weave_safe(utility, {
				window: {}
		}), utility.window.openWindow = function (t, e, o, i) {
				var r, n = "width=" + o + ",height=" + i + ",resizable=No,scrollbars=No,status=Yes,modal=yes,dependent=yes,dialog=yes,left=" + (screen.width - o) / 2 + ",top=" + (screen.height - i) / 2;
				if (r = window.open(e, t, n)) {
						if (utility.window.reference = r, l = document.getElementById("modalBlocker")) l.style.display = "block";
						else {
								var l = utility.dom.createElement("DIV", {
												id: "modalBlocker",
												style: "display: block"
										}),
										a = utility.dom.getPageInnerSize();
								l.style.zIndex = 999, l.style.width = a.x + "px", l.style.height = a.y + "px", prepfixieinsertnodescrollup(), l = document.body.insertBefore(l, document.body.firstChild), utility.dom.attachEvent(l, "onmousedown", function () {
										return utility.window.focusmodal()
								}), utility.dom.attachEvent(l, "ondblclick", function () {
										return utility.window.focusmodal()
								}), utility.dom.attachEvent(l, is.ie ? "onbeforeactivate" : "onfocus", function () {
										return utility.window.focusmodal()
								}), utility.dom.attachEvent(is.mozilla ? window.document.body : window, is.ie ? "onbeforeactivate" : "focus", function () {
										return utility.window.focusmodal()
								}), fixieinsertnodescrollup()
						}
						r.focus()
				}
				return r || alert(translate("Cannot open dialog. Please allow site popups.")), r
		}, utility.window.focusmodal = function () {
				!utility.window.reference || utility.window.reference.closed ? utility.window.hideModalBlocker() : utility.window.reference.focus()
		}, utility.window.hideModalBlocker = function (t) {
				if (t || (t = window), utility.window.reference = null, !t.closed) {
						var e = t.document.getElementById("modalBlocker");
						e && (e.style.display = "none")
				}
		}, utility.window.close = function () {
				window.close()
		}, utility.popup = {}, utility.popup.stiva = [], utility.popup.makeModal = function (t, e, o) {
				void 0 === o && (o = !0), utility.popup.stiva.push({
						element: e,
						callback: t,
						stopEvents: o
				})
		}, utility.popup.removeModal = function (t) {
				if (0 != utility.popup.stiva.length) {
						if (utility.popup.force || t) {
								var e = utility.popup.stiva[utility.popup.stiva.length - 1];
								if (t) {
										for (var o = utility.dom.setEventVars(t).targ; o && (!e.element || o != e.element) && (!o.mi || "mousedown" == o.mi.action_event);) o = o.parentNode;
										if (o) return
								}
								e.callback && e.callback(), utility.popup.stiva.pop(), utility.popup.removeModal(t)
						}
						utility.dom.toggleSpecialTags(null, !1, 0, !0, !0)
				}
		}, utility.popup.escapeModal = function (t) {
				if (utility.popup.stiva.length > 0) {
						if (!utility.popup.stiva[utility.popup.stiva.length - 1].stopEvents) return !0;
						var e = utility.dom.setEventVars(t);
						if (27 == t.keyCode && (utility.popup.force = !0, utility.popup.removeModal(e.e), utility.popup.force = !1), is.ie && !e.e.ctrlKey) try {
								e.e.keyCode = 90909090
						} catch (t) {}
						return utility.dom.stopEvent(e.e), !1
				}
				return !0
		}, utility.window.blockInterface = function (t, e, o) {
				void 0 === t && (t = "wait");
				var i, r = utility.dom.createElement("div", {});
				r.className = "interfaceBlocker", r.id = o || "interfaceBlocker", prepfixieinsertnodescrollup(), r = document.body.appendChild(r), fixieinsertnodescrollup(), r.style.cursor = t, e ? (i = utility.dom.getBox(e), r.style.top = i.y + "px", r.style.left = i.x + "px", r.style.width = i.width + "px", r.style.height = i.height + "px") : (i = utility.dom.getPageInnerSize(), r.style.width = i.x + "px", r.style.height = i.y + "px")
		}, utility.window.unblockInterface = function () {
				var t = document.getElementById("interfaceBlocker");
				t && document.body.removeChild(t)
		}, utility.window.setModal = function (t) {
				void 0 === t && (t = !0), window.isloading = !1, window.focus(), window.dialogArguments ? window.opener = dialogArguments : (window.onbeforeunload = function () {
						window.opener.closed || utility.window.hideModalBlocker(window.opener)
				}, t && utility.dom.setUnselectable(window.document.body)), window.opener ? (window.opener.topOpener ? window.topOpener = window.opener.topOpener : window.topOpener = window.opener, utility.dom.attachEvent(is.ie ? window.document.body : window, "keydown", function (t) {
						utility.popup.escapeModal(t) && 27 == t.keyCode && utility.window.close()
				}), utility.dom.attachEvent2(window.document.body, "mousedown", utility.popup.removeModal)) : document.body.innerHTML = '<center>Invalid context! No opener.</center><div style="display:none !important">' + document.body.innerHTML + "</div>"
		}, Object_weave_safe(utility, {
				cookie: {}
		}), utility.cookie.set = function (t, e, o, i) {
				var r = t + "=" + escape(e);
				if (null != o) {
						var n = new Date;
						n.setTime(n.getTime() + 864e5 * o), r += "; expires=" + n.toGMTString()
				}
				return null != i && (r += "; path=" + i), document.cookie = r, null
		}, utility.cookie.get = function (t) {
				for (var e = t + "=", o = document.cookie.split(";"), i = 0; i < o.length; i++) {
						for (var r = o[i];
								" " == r.charAt(0);) r = r.substring(1, r.length);
						if (0 == r.indexOf(e)) return unescape(r.substring(e.length, r.length))
				}
				return null
		}, utility.cookie.del = function (t, e) {
				utility.cookie.set(t, "", -1, e)
		}, UIDGenerator = function (t) {
				void 0 === t && (t = "iaktuid_" + Math.random().toString().substring(2, 6) + "_"), this.name = t, this.counter = 1
		}, UIDGenerator.prototype.generate = function (t) {
				return void 0 === t && (t = ""), this.name + t + this.counter++ + "_"
		}, ObjectStorage = function (t) {
				this.storage = {}, this.gen = new UIDGenerator(t + "_reference_by_id_")
		}, ObjectStorage.prototype.add = ObjectStorage.prototype.storeObject = function (t) {
				var e = t.constructor.toString().match(/^\s*function\s*([^\s\(]*)\s*\(/i);
				e = e ? e[1] : "unknown_contructor";
				var o = this.gen.generate(e);
				t.id = o, this.storage[o] = t
		}, ObjectStorage.prototype.get = ObjectStorage.prototype.getObject = function (t) {
				return this.storage[t]
		}, ObjectStorage.prototype.deleteObject = function (t) {
				delete this.storage[t]
		}, ObjectStorage.prototype.dispose = function () {
				this.storage = null
		}, QueryString = function (t) {
				if (void 0 === t) t = window.location.search.toString();
				this.keys = new Array, this.values = new Array;
				var e = t;
				0 == t.indexOf("?") && (e = t.substring(1));
				for (var o = (e = e.replace(/&amp;/g, "&")).split("&"), i = 0; i < o.length; i++) {
						var r = o[i].indexOf("=");
						if (r >= 0) {
								var n = o[i].substring(0, r),
										l = o[i].substring(r + 1);
								this.keys[this.keys.length] = n, this.values[this.values.length] = l
						}
				}
		}, QueryString.prototype.find = function (t) {
				for (var e = null, o = 0; o < this.keys.length; o++)
						if (this.keys[o] == t) {
								e = this.values[o];
								break
						} return e
		}, KT_Tooltips = {
				cname: "kt_add_tooltips",
				worked: [],
				cancel: !1,
				gen: new UIDGenerator,
				show: function (t, e, o) {
						var i = document.getElementById(t);
						if (i) {
								i.style.left = "-1000px", i.style.top = "-1000px", i.style.display = "block";
								var r = utility.dom.getBBox(i),
										n = utility.dom.getPositionRelativeTo00(e, o, r.width + 2, r.height + 2);
								i.style.left = n.x + "px", i.style.top = n.y + "px"
						}
				},
				hide: function (t) {
						var e = document.getElementById(t);
						e && (e.style.display = "none")
				},
				clear_timeout: function (t, e) {
						var o = t + e + "timeout";
						void 0 !== window[o] && clearTimeout(window[o])
				},
				clear_showtimeout: function (t) {
						KT_Tooltips.clear_timeout(t, "show")
				},
				clear_hidetimeout: function (t) {
						KT_Tooltips.clear_timeout(t, "hide")
				},
				set_timeout: function (t, e, o) {
						var i = "",
								r = [];
						if (arguments.length > 3)
								for (var n = 3; n < arguments.length; n++) Array_push(r, arguments[n]);
						"" != (i = r.join(", ")) && (i = ", " + i);
						var l = "KT_Tooltips." + e + "('" + t + "'" + i + ")";
						window[t + e + "timeout"] = setTimeout(l, o)
				},
				set_showtimeout: function (t, e) {
						KT_Tooltips.set_timeout(t, "show", 1e3, e.x, e.y)
				},
				set_hidetimeout: function (t) {
						KT_Tooltips.set_timeout(t, "hide", 250)
				},
				attach_single: function (t) {
						if (!is.ie && !is.safari) {
								var e = t.title,
										o = null;
								if (t.getAttribute("divid") && ((o = document.getElementById(t.getAttribute("divid"))) && document.body.removeChild(o), t.removeAttribute("divid")), /[\r\n]/.test(e)) {
										var i = KT_Tooltips.gen.generate("tooltip"),
												r = utility.dom.createElement("div", {
														class: "tooltip_div",
														id: i
												});
										r.innerHTML = t.getAttribute("title").toString().replace(/\r\n/g, "<br />").replace(/[\r|\n]/g, "<br />"), t.divid = i, r = document.body.appendChild(r), t.removeAttribute("title"), t.setAttribute("divid", i), o || (utility.dom.attachEvent(t, "mouseover", function (e) {
												var o = t.getAttribute("divid"),
														i = utility.dom.getBBox(t);
												utility.dom.setEventVars(e);
												KT_Tooltips.clear_hidetimeout(o);
												var r = {
														x: i.x + Math.round(i.width / 2),
														y: i.y + Math.round(i.height / 2) + 10
												};
												KT_Tooltips.set_showtimeout(o, r), utility.dom.stopEvent(e)
										}), utility.dom.attachEvent(t, "mouseout", function (e) {
												var o = t.getAttribute("divid");
												KT_Tooltips.clear_showtimeout(o), KT_Tooltips.set_hidetimeout(o), utility.dom.stopEvent(e)
										}))
								}
						}
				},
				attach: function () {
						KT_Tooltips.worked = [], is.ie || is.safari || Array_each(utility.dom.getElementsByClassName(document.body, KT_Tooltips.cname), function (t) {
								Array_each(t.getElementsByTagName("a"), KT_Tooltips.attach_single)
						})
				}
		}, utility.dom.attachEvent(window, "load", KT_Tooltips.attach), XmlHttp.create = function () {
				try {
						if (window.XMLHttpRequest) {
								var t = new XMLHttpRequest;
								return null == t.readyState && (t.readyState = 1, t.addEventListener("load", function () {
										t.readyState = 4, "function" == typeof t.onreadystatechange && t.onreadystatechange()
								}, !1)), t
						}
						if (window.ActiveXObject) return new ActiveXObject(getXmlHttpPrefix() + ".XmlHttp")
				} catch (t) {}
				throw new Error("Your browser does not support XmlHttp objects")
		}, XmlHttp.post = function (t, e, o) {
				try {
						t.open("POST", e, !1), t.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"), t.send(o)
				} catch (t) {
						return !1
				}
				return t
		}, XmlHttp.get = function (t, e, o) {
				try {
						t.open("GET", o, !1), t.send(null)
				} catch (t) {
						return !1
				}
				return t
		}, XmlDocument.create = function () {
				try {
						if (document.implementation && document.implementation.createDocument) {
								var t = document.implementation.createDocument("", "", null);
								return null == t.readyState && (t.readyState = 1, t.addEventListener("load", function () {
										t.readyState = 4, "function" == typeof t.onreadystatechange && t.onreadystatechange()
								}, !1)), t
						}
						if (window.ActiveXObject) return new ActiveXObject(getDomDocumentPrefix() + ".DomDocument")
				} catch (t) {}
				throw new Error("Your browser does not support XmlDocument objects")
		}, window.DOMParser && window.XMLSerializer && window.Node && Node.prototype && Node.prototype.__defineGetter__) {
		Document.prototype.loadXML = function (t) {
				for (var e = (new DOMParser).parseFromString(t, "text/xml"); this.hasChildNodes();) this.removeChild(this.lastChild);
				for (var o = !1, i = 0; i < e.childNodes.length; i++) this.appendChild(this.importNode(e.childNodes[i], !0)), o = !0;
				return o
		};
		var documentProto = Document.prototype,
				documentGrandProto = documentProto.__proto__ = {
						__proto__: documentProto.__proto__
				};
		documentGrandProto && documentGrandProto.__defineGetter__("xml", function () {
				return (new XMLSerializer).serializeToString(this)
		});
		var elementProto = Element.prototype,
				elementGrandProto = elementProto.__proto__ = {
						__proto__: elementProto.__proto__
				};
		elementGrandProto && (elementGrandProto.__defineGetter__("text", function () {
				return this.textContent
		}), elementGrandProto.__defineGetter__("innerText", function () {
				return this.textContent
		}), elementGrandProto.__defineSetter__("innerText", function (t) {
				var e = this.ownerDocument.createTextNode(t);
				this.innerHTML = "", this.appendChild(e)
		}))
}

function evaluateXPath(t, e) {
		var o = [];
		if (is.mozilla) {
				void 0 === evaluateXPath.xpe && (evaluateXPath.xpe = new XPathEvaluator);
				for (var i = evaluateXPath.xpe.evaluate(e, t, null, XPathResult.ANY_TYPE, null); res = i.iterateNext();) o.push(res)
		} else if (is.ie) {
				i = t.selectNodes(e);
				for (var r = 0; r < i.length; r++) o.push(i[r])
		}
		return 0 == o.length && (o = !1), o
}

function BrowserCheck() {
		navigator.appName.toString(), navigator.platform.toString();
		var t = navigator.userAgent.toString();
		this.mozilla = this.ie = this.opera = r = !1;
		var e = /Opera.([0-9\.]*)/i,
				o = /MSIE.([0-9\.]*)/i;
		if (t.match(e)) r = t.match(e), this.opera = !0, this.version = parseFloat(r[1]);
		else if (t.match(o)) r = t.match(o), this.ie = !0, this.version = parseFloat(r[1]);
		else if (t.match(/safari\/([\d\.]*)/i)) this.mozilla = !0, this.safari = !0, this.version = 1.4;
		else if (t.match(/gecko/i)) {
				r = t.match(/rv:\s*([0-9\.]+)/i), this.mozilla = !0, this.version = parseFloat(r[1])
		}
		this.windows = this.mac = this.linux = !1, this.Platform = t.match(/windows/i) ? "windows" : t.match(/linux/i) ? "linux" : t.match(/mac/i) ? "mac" : t.match(/unix/i) ? "unix" : "unknown", this[this.Platform] = !0, this.v = this.version, this.valid = this.ie && this.v >= 6 || this.mozilla && this.v >= 1.4, this.safari && this.mac && this.mozilla && (this.mozilla = !1)
}

function sortFormHandlers(t) {
		for (var e = 0; e < t.length; e++)
				for (var o = t[e], i = e + 1; i < t.length; i++) {
						var r = t[i];
						if (r[0] < o[0]) {
								var n = o;
								t[e] = r, t[i] = n
						}
				}
}

function GLOBAL_registerFormSubmitEventHandler(t, e) {
		for (var o = document.getElementsByTagName("form"), i = 0; i < o.length; i++) {
				var r, n = o[i];
				if (void 0 !== n.onsubmit && null != n.onsubmit)(r = n.form_handlers) ? (r[r.length] = [e, t], sortFormHandlers(r)) : (n.__kt_onsubmit = n.onsubmit, n.onsubmit = new Function("e", "if (!KT_formSubmittalHandler(e)) return false;"), (r = [])[r.length] = [e, t]), n.form_handlers = r;
				else n.onsubmit = new Function("e", "return KT_formSubmittalHandler(e);"), (r = [])[r.length] = [e, t], n.form_handlers = r
		}
}
var fire_starter = null,
		global_form_submit_lock = !1;

function KT_formSubmittalHandler(e) {
		var frm = null,
				o = utility.dom.setEventVars(e);
		if (!o.e) return !0;
		try {
				if (global_form_submit_lock) return utility.dom.stopEvent(o.e), !1;
				if (frm = o.targ, !frm) return !0;
				if (!frm.tagName) return !0;
				"form" != frm.tagName.toLowerCase() && (frm = frm.form)
		} catch (t) {}
		if (frm || (frm = fire_starter), !frm) return !0;
		"undefined" != typeof UNI_disableButtons && UNI_disableButtons(frm, /.*/, !0);
		var ret = !0,
				form_handlers = frm.form_handlers;
		if (form_handlers)
				for (var i = 0; i < form_handlers.length; i++) {
						var fun = form_handlers[i];
						//	if (eval("ret = " + fun[1] + "(o.e);"), !ret) break
				}
		if (is.ie && is.mac && "undefined" != typeof UNI_disableButtons && UNI_disableButtons(frm, /.*/, !1), ret) {
				if (frm.__kt_onsubmit) {
						var ret = frm.__kt_onsubmit(o.e);
						return !(void 0 !== ret && !ret)
				}
				return !0
		}
		try {
				utility.dom.stopEvent(o.e)
		} catch (t) {}
		return global_form_submit_lock || "undefined" == typeof UNI_disableButtons || UNI_disableButtons(frm, /.*/, !1), !1
}
utility.dom.attachEvent(window, "unload", EventCache.flush);
