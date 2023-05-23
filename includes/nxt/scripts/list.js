function nxt_list_collect_checked(t) {
		var e = [],
				i = !1;
		return Array_each(utility.dom.getElementsByTagName(t, "INPUT"), function (t, n) {
				"checkbox" == t.type && (t.name.match(/^kt_pk/) && (i = !0), t.name.match(/^kt_pk/) && t.checked && Array_push(e, [t.name, t.value, t]))
		}), i || (e = null), e
}

function nxt_list_select_cbx_from_link(t) {
		var e = utility.dom.getParentByTagName(t, "TR"),
				i = null;
		return Array_each(utility.dom.getElementsByTagName(e, "INPUT"), function (t, e) {
				!i && "checkbox" == t.type && t.name.match(/^kt_pk/) && (i = t)
		}), i && (i.checked = !0, nxt_list_set_checkbox_state(i)), i
}

function nxt_list_submit_inputs(t, e, i) {
		var n = {
				action: "",
				method: "POST",
				rename: !0,
				skip_rename: 0
		};
		for (var a in n) void 0 === e[a] && (e[a] = n[a]);
		void 0 === i && (i = []);
		var o = utility.dom.createElement("FORM", {
				action: e.action,
				method: e.method,
				style: "display: none"
		});
		return Array_each(t, function (t, i) {
				var n = t[0];
				e.rename && i >= e.skip_rename && (n += "_" + (i - e.skip_rename + 1)), o.appendChild(utility.dom.createElement("INPUT", {
						type: "hidden",
						name: n,
						id: n,
						value: t[1]
				}))
		}), Array_each(i, function (t, e) {
				o.appendChild(utility.dom.createElement("INPUT", {
						type: "hidden",
						id: t[0],
						name: t[0],
						value: t[1]
				}))
		}), document.body.appendChild(o), o
}

function nxt_list_edit_link_row() {
		return nxt_list_select_cbx_from_link(this), nxt_list_edit_link_base(utility.dom.getParentByTagName(this, "FORM"))
}

function nxt_list_edit_link_form(t, e) {
		nxt_list_edit_link_base(utility.dom.getParentByTagName(t, "FORM"), e)
}

function nxt_list_edit_link_base(t, e) {
		if (!nxt_list_check_changed()) return !1;
		list_has_changed = !1;
		var i = nxt_list_collect_checked(t);
		if (null == i) return !1;
		if (0 == i.length) return alert(NXT_Messages.please_select_record), !0;
		var n = "function" == typeof PanelForm_overrideSubmit,
				a = [],
				o = [];
		n || o.push(["KT_back", "1"]);
		var r = new QueryString(t.param_name);
		Array_each(r.keys, function (t, e) {
				"KT_back" != t && Array_push(o, [t, r.values[e]])
		}), Array_each(i, function (t, e) {
				var i = utility.dom.getChildrenByTagName(t[2].parentNode, "input");
				Array_push(a, [i[1].name, i[1].value, i[1]])
		}), void 0 === e && (e = t.form_action);
		var l = nxt_list_submit_inputs(a, {
				action: e,
				method: "GET",
				skip_rename: 1
		}, o);
		return n && (l.submit = PanelForm_overrideSubmit), l.submit(), !1
}

function nxt_list_delete_link_row() {
		var t = nxt_list_select_cbx_from_link(this),
				e = utility.dom.getParentByTagName(this, "table");
		return Array_each(utility.dom.getElementsByTagName(e, "INPUT"), function (e, i) {
				"checkbox" == e.type && e.name.match(/^kt_pk/) && (!0, e != t && (e.checked = !1))
		}), nxt_list_delete_link_base(utility.dom.getParentByTagName(this, "FORM"))
}

function nxt_list_delete_link_form(t) {
		nxt_list_delete_link_base(utility.dom.getParentByTagName(t, "FORM"))
}

function nxt_list_delete_link_base(t) {
		if (!nxt_list_check_changed()) return !1;
		list_has_changed = !1;
		var e = nxt_list_collect_checked(t);
		if (null == e) return !1;
		if (0 == e.length) return alert(NXT_Messages.please_select_record), !1;
		if (!confirm(NXT_Messages.are_you_sure_delete)) return !1;
		document.getElementById("overlay").style.display = "block", new Spinner(opts).spin(target);
		var i = [];
		Array_each(e, function (t, e) {
				var n = utility.dom.getChildrenByTagName(t[2].parentNode, "input");
				Array_push(i, [n[1].name, n[1].value, n[1]])
		});
		var n = t.form_action;
		Array_each(i, function (t, e) {
				var i = t[0];
				e >= 1 && (i += "_" + e), n += (n.indexOf("?") >= 0 ? "&" : "?") + i + "=" + t[1]
		});
		var a = "function" == typeof PanelForm_overrideSubmit;
		a || (n += (n.indexOf("?") >= 0 ? "&" : "?") + "KT_back=1");
		var o = new QueryString(t.param_name);
		Array_each(o.keys, function (t, e) {
				"KT_back" != t && (n += (n.indexOf("?") >= 0 ? "&" : "?") + t + "=" + o.values[e])
		});
		var r = nxt_list_submit_inputs(e, {
				action: n,
				method: "POST"
		}, [
				["KT_Delete1", "1"]
		]);
		return a && (r.submit = PanelForm_overrideSubmit), r.submit(), !1
}

function nxt_list_additem(t) {
		if (!nxt_list_check_changed()) return !1;
		list_has_changed = !1;
		var e = utility.dom.getLink(utility.dom.getElementsBySelector("a.KT_additem_op_link")[0]);
		if (-1 != e.indexOf("?")) {
				parts = e.split("?");
				var i = parts[1];
				i = i.replace(/&amp;/, "&");
				var n = new QueryString(i);
				form_action = parts[0]
		}
		var a = utility.dom.getElementById(utility.dom.getParentByTagName(t, "div"), "no_new");
		if (1 == a.length) var o = a[0].value;
		else o = 1;
		utility.dom.getParentByTagName(t, "FORM");
		var r = [
				["no_new", o],
				["KT_back", 1]
		];
		Array_each(n.keys, function (t, e) {
				"KT_back" != t && Array_push(r, [t, n.values[e]])
		});
		var l = nxt_list_submit_inputs([], {
				action: form_action,
				method: "GET"
		}, r);
		return "function" == typeof PanelForm_overrideSubmit && (l.submit = PanelForm_overrideSubmit), l.submit(), !1
}

function nxt_list_first_data_row(t) {
		return 1 + utility.dom.getElementsByClassName(t, "KT_row_filter", "tr").length
}

function nxt_list_last_data_row(t) {
		return t.rows.length - 1
}

function nxt_list_check_changed(t) {
		if (void 0 !== t) var e = utility.dom.setEventVars(t);
		if ("undefined" != typeof list_has_changed && 1 == list_has_changed) {
				if (confirm(NXT_Messages.are_you_sure_move)) return !0;
				try {
						utility.dom.stopEvent(e.e)
				} catch (t) {}
				return !1
		}
		return !0
}

function nxt_list_check_changed_unload() {
		if ("undefined" != typeof list_has_changed && 1 == list_has_changed) return NXT_Messages.are_you_sure_move
}

function nxt_list_move_link_row_up(t) {
		var e = utility.dom.setEventVars(t);
		return toret = nxt_list_move_link_row(this, -1), utility.dom.stopEvent(e.e), toret
}

function nxt_list_move_link_row_down(t) {
		var e = utility.dom.setEventVars(t);
		return toret = nxt_list_move_link_row(this, 1), utility.dom.stopEvent(e.e), toret
}

function nxt_list_move_link_row(t, e) {
		utility.dom.getParentByTagName(t, "FORM");
		var i = utility.dom.getParentByTagName(t, "table"),
				n = utility.dom.getParentByTagName(t, "tr"),
				a = i.getElementsByTagName("tbody")[0].getElementsByTagName("tr").length;
		a += utility.dom.getElementsByClassName(i, "KT_row_filter").length;
		var o = utility.dom.getParentByTagName(t, "tbody");
		n.style.backgroundColor = $nxt_tr_movehighlight_color, n.setAttribute("moved", "1");
		var r = nxt_list_first_data_row(i),
				l = n.rowIndex,
				_ = l + e;
		if (1 == e && l == i.rows.length - 1) return !1;
		if (-1 == e && l <= r) return !1;
		list_has_changed = !0;
		var s = i.rows[_],
				m = i.rows[l]; - 1 == e && o.insertBefore(o.removeChild(m), s), 1 == e && o.insertBefore(o.removeChild(s), m);
		var c = [];
		Array_each([m, s], function (t, e) {
				Array_each(utility.dom.getElementsByTagName(t, "input"), function (t) {
						"checkbox" == t.type.toLowerCase() && (c[e] = t.checked)
				})
		});
		var d = utility.dom.getElementsByClassName(m, "KT_orderhidden"),
				u = utility.dom.getElementsByClassName(s, "KT_orderhidden");
		if (1 == d.length && 1 == u.length) {
				d = d[0], u = u[0];
				var y = d.value.split("|"),
						g = u.value.split("|");
				d.value = y[0] + "|" + g[1], u.value = g[0] + "|" + y[1]
		}
		Array_indexOf(utility.dom.getClassNames(m), "KT_even") >= 0 ? ("1" != m.getAttribute("moved") && utility.dom.classNameRemove(m, "KT_even"), "1" != s.getAttribute("moved") && utility.dom.classNameAdd(s, "KT_even")) : ("1" != m.getAttribute("moved") && utility.dom.classNameRemove(s, "KT_even"), "1" != s.getAttribute("moved") && utility.dom.classNameAdd(m, "KT_even")), void 0 !== $NXT_LIST_SETTINGS.row_effects && $NXT_LIST_SETTINGS.row_effects && (Array_indexOf(utility.dom.getClassNames(m), "KT_highlight") >= 0 ? "1" != m.getAttribute("moved") && utility.dom.classNameRemove(m, "KT_highlight") : "1" != m.getAttribute("moved") && utility.dom.classNameRemove(s, "KT_highlight")), Array_each([m, s], function (t, e) {
				Array_each(utility.dom.getElementsByTagName(t, "input"), function (t) {
						"checkbox" == t.type.toLowerCase() && (t.checked = c[e])
				})
		});
		var h = m.rowIndex > s.rowIndex ? s : m,
				v = m.rowIndex > s.rowIndex ? m : s;
		if (h.rowIndex == r) {
				nxt_hide_move_link(utility.dom.getElementsByClassName(h, "KT_order")[0], 1);
				var f = "";
				f = $NXT_LIST_SETTINGS.show_as_buttons ? "input" : "a", Array_each(utility.dom.getElementsByClassName(v, "KT_order")[0].getElementsByTagName(f), function (t) {
						t.style.visibility = "visible"
				})
		} else v.rowIndex == a && (nxt_hide_move_link(utility.dom.getElementsByClassName(v, "KT_order")[0], 0), f = $NXT_LIST_SETTINGS.show_as_buttons ? "input" : "a", Array_each(utility.dom.getElementsByClassName(h, "KT_order")[0].getElementsByTagName(f), function (t) {
				t.style.visibility = "visible"
		}));
		2 == a && (nxt_hide_move_link(utility.dom.getElementsByClassName(h, "KT_order")[0], 1), nxt_hide_move_link(utility.dom.getElementsByClassName(v, "KT_order")[0], 0));
		for (var T = utility.dom.getElementsBySelector("a.KT_move_op_link"), b = 0; b < T.length; b++) {
				var p = T[b],
						N = utility.dom.getNextSiblingByTagName(p, "input");
				null != N && (p = N), p.style.display = "";
				var k = utility.dom.getParentByTagName(p, "th");
				Array_each(k.getElementsByTagName("a"), function (t) {
						t != T[b] && (t.style.display = "none")
				}), utility.dom.classNameAdd(k, "KT_order_selected")
		}
		return !1
}

function nxt_list_move_link_form(t) {
		var e = utility.dom.getParentByTagName(t, "FORM"),
				i = [];
		Array_each(utility.dom.getElementsByTagName(e, "INPUT"), function (t, e) {
				if ("checkbox" == t.type && t.name.match(/^kt_pk/)) {
						var n = utility.dom.getParentByTagName(t, "tr"),
								a = utility.dom.getElementsByClassName(n, "KT_orderhidden");
						if (a.length > 0) {
								var o = a[0].value.split("|");
								"" == o[0] && (o[0] = "0"), "" == o[1] && (o[1] = "0"), Array_push(i, t.value + "|" + o.join("|"))
						}
				}
		}), i = i.join(",");
		var n = "function" == typeof PanelForm_overrideSubmit;
		if (n) var a = new QueryString(window.location.hash.replace(/#/, ""));
		else a = new QueryString(window.location.search.replace(/\?/, ""));
		var o = [],
				r = {};
		Array_each(a.keys, function (t, e) {
				void 0 === r[t] && (r[t] = 1, Array_push(o, t + "=" + a.values[e]))
		});
		var l = window.location.protocol + "//" + window.location.host + window.location.pathname + "?" + o.join("&");
		list_has_changed = !1, n || (l += window.location.hash);
		var _ = nxt_list_submit_inputs([], {
				action: l = (l = l.replace(/#$/i, "")).replace(/\?$/i, ""),
				method: "POST"
		}, [
				[$NXT_MOVE_SETTINGS.orderfield, i]
		]);
		return n && (_.submit = PanelForm_overrideSubmit), _.submit(), !1
}

function nxt_list_set_checkbox_state(t, e) {
		var i = utility.dom.getParentByTagName(t, "TR");
		void 0 === e ? e = t.checked : t.checked = e, void 0 !== $NXT_LIST_SETTINGS.row_effects && $NXT_LIST_SETTINGS.row_effects && "1" != i.getAttribute("moved") && (e ? utility.dom.classNameAdd(i, "KT_highlight") : utility.dom.classNameRemove(i, "KT_highlight"))
}

function nxt_list_cbxmass_onchange() {
		var t = this;
		Array_each(utility.dom.getElementsByTagName(t.parent_div, "INPUT"), function (e, i) {
				"checkbox" == e.type && void 0 !== e.parent_div && nxt_list_set_checkbox_state(e, t.checked)
		})
}

function nxt_list_cbx_onchange(t) {
		var e = utility.dom.setEventVars(t),
				i = !0,
				n = null;
		return Array_each(utility.dom.getElementsByTagName(cb.parent_div, "INPUT"), function (t, e) {
				"checkbox" == t.type && void 0 !== t.parent_div && ("KT_selAll" != t.name ? (i = i && t.checked, nxt_list_set_checkbox_state(t)) : n = t)
		}), n && (n.checked = i), utility.dom.stopEvent(e.e), !0
}

function nxt_list_toggle_filter() {
		utility.dom.toggleElem(this.filter_div)
}

function nxt_list_attach() {
		var t;
		if ("undefined" == typeof is && (is = new BrowserCheck), $nxt_tr_over_color = "", $nxt_tr_even_color = "", $nxt_tr_highlight_color = "", $nxt_tr_movehighlight_color = "", $nxt_move_up_background_image = "", $nxt_move_down_background_image = "", is.mozilla || is.ie || is.safari)
				for (var e = 0; e < document.styleSheets.length; e++)
						for (var i = utility.dom.getImports(document.styleSheets[e]), n = 0; n < i.length; n++)
								if (i[n].href.match(/nxt\.css/)) try {
										$nxt_tr_over_color = utility.dom.getRuleBySelector(i[n], /KT_over/)[0].style.backgroundColor, $nxt_tr_even_color = utility.dom.getRuleBySelector(i[n], /KT_even/)[0].style.backgroundColor, $nxt_tr_highlight_color = utility.dom.getRuleBySelector(i[n], /KT_highlight/)[0].style.backgroundColor, $nxt_tr_movehighlight_color = utility.dom.getRuleBySelector(i[n], /KT_movehighlight/)[0].style.backgroundColor, $nxt_move_up_background_image = utility.dom.getRuleBySelector(i[n], /KT_button_move_up/)[0].style.backgroundImage, $nxt_move_down_background_image = utility.dom.getRuleBySelector(i[n], /KT_button_move_down/)[0].style.backgroundImage
								} catch (t) {
										$nxt_tr_over_color = "", $nxt_tr_even_color = "", $nxt_tr_highlight_color = "", $nxt_tr_movehighlight_color = "", $nxt_move_up_background_image = "", $nxt_move_down_background_image = ""
								}
		t = utility.dom.getElementsByClassName(document, "KT_tng", "DIV"), Array_each(t, function (t) {
				if (!t.getAttribute("kt_list_attached") && (t.setAttribute("kt_list_attached", !0), list_obj = {}, list_obj.main = t, list_obj.inner = utility.dom.getElementsByClassName(list_obj.main, "KT_tnglist", "div"), "object" == typeof list_obj.inner && null != list_obj.inner && list_obj.inner.length && list_obj.inner.length > 0)) {
						list_obj.inner = list_obj.inner[0];
						for (var e = list_obj.inner.getElementsByTagName("form")[0], i = 0; i < e.childNodes.length; i++)
								if (1 == e.childNodes[i].nodeType) {
										var n = e.childNodes[i],
												a = n.tagName.toLowerCase(),
												o = n.className;
										if ("table" == a && (list_obj.table = n), /KT_topbuttons/.test(o) && (list_obj.topbuttons = n), /KT_bottombuttons/.test(o) && (list_obj.bottombuttons = n), /KT_topnav/.test(o)) {
												list_obj.topnav = n;
												for (var r = list_obj.topnav.getElementsByTagName("div"), l = 0; l < r.length; l++)
														if (/KT_textnav/.test(r[l].className)) {
																list_obj.toptextnav = r[l];
																break
														}
										}
										if (/KT_bottomnav/.test(o)) {
												list_obj.bottomnav = n;
												for (r = list_obj.bottomnav.getElementsByTagName("div"), l = 0; l < r.length; l++)
														if (/KT_textnav/.test(r[l].className)) {
																list_obj.bottomtextnav = r[l];
																break
														}
										}
								} r = (s = list_obj.bottombuttons).getElementsByTagName("div");
						for (var _ = 0; _ < r.length; _++) /KT_operations/.test(r[_].className) && utility.dom.classNameAdd(r[_], "KT_left");
						if ($NXT_LIST_SETTINGS.duplicate_buttons)
								if (void 0 === list_obj.topbuttons)(m = document.createElement("DIV")).className = "KT_topbuttons", m.innerHTML = s.innerHTML, s.parentNode.insertBefore(m, s.parentNode.firstChild), Array_each(["input"], function (t) {
										var e = s.getElementsByTagName(t),
												i = m.getElementsByTagName(t);
										Array_each(e, function (t, n) {
												i[n].__eventHandlers = e[n].__eventHandlers, i[n].onclick = e[n].onclick
										})
								});
						if ($NXT_LIST_SETTINGS.duplicate_navigation) {
								var s = list_obj.bottomnav;
								if (void 0 === list_obj.topnav) {
										var m;
										(m = s.cloneNode(!0)).className = "KT_topnav";
										var c = utility.dom.getElementsByClassName(s.parentNode, "KT_options", "div")[0];
										s.parentNode.insertBefore(m, c), Array_each(["input"], function (t) {
												var e = s.getElementsByTagName(t),
														i = m.getElementsByTagName(t);
												Array_each(e, function (t, n) {
														i[n].__eventHandlers = e[n].__eventHandlers, i[n].onclick = e[n].onclick
												})
										})
								}
						}
						var d, u, y = list_obj.table,
								g = utility.dom.getElementsByTagName(t, "INPUT");
						Array_each(g, function (t, e) {
								if ("checkbox" == t.type)
										if (t.name.match(/^kt_pk/)) {
												t.parent_div = y;
												var i = utility.dom.getParentByTagName(t, "TR");
												Array_each(i.getElementsByTagName("A"), function (t, e) {
														var i, n;
														d || Array_indexOf(utility.dom.getClassNames(t), "KT_edit_link") >= 0 && -1 != (i = t.href).indexOf("?") && (n = i.split("?"), d = n[0], u = (u = (u = n[1]).replace(/&amp;/, "&")).replace(/[^&]*=[^&]*&KT_back=1/g, "").replace("&$", ""));
														t.href.toString().match(/#delete/) && (t.onclick = nxt_list_delete_link_row), t.href.toString().match(/#move_up/) && (t.onclick = nxt_list_move_link_row_up), t.href.toString().match(/#move_down/) && (t.onclick = nxt_list_move_link_row_down)
												})
										} else "KT_selAll" == t.name && (t.parent_div = y, t.onclick = nxt_list_cbxmass_onchange)
						});
						var h = list_obj.table,
								v = h.getElementsByTagName("tr"),
								f = 0;
						Array_each(v, function (t, e) {
								var i = utility.dom.getClassNames(t);
								Array_indexOf(["KT_row_order", "KT_row_filter"], i[0]) < 0 && (t.cells.length > 1 && f++, void 0 !== $NXT_LIST_SETTINGS.row_effects && $NXT_LIST_SETTINGS.row_effects && (utility.dom.attachEvent(t, "mouseover", function (t) {
										var e = utility.dom.setEventVars(t),
												i = utility.dom.getParentByTagName(e.targ, "tr");
										return "1" != i.getAttribute("moved") && (i.setAttribute("oldBackgroundColor", i.style.backgroundColor), "undefined" != typeof $nxt_tr_over_color && (i.style.backgroundColor = $nxt_tr_over_color)), utility.dom.stopEvent(e.e), !1
								}), utility.dom.attachEvent(t, "mouseout", function (t) {
										var e = utility.dom.setEventVars(t),
												i = utility.dom.getParentByTagName(e.targ, "tr");
										return "1" != i.getAttribute("moved") && (i.style.backgroundColor = i.getAttribute("oldBackgroundColor")), utility.dom.stopEvent(e.e), !1
								})), utility.dom.attachEvent(t, "click", function (t) {
										var e = utility.dom.setEventVars(t),
												i = utility.dom.getParentByTagName(e.targ, "tr"),
												n = utility.dom.getElementsByTagName(i, "INPUT");
										return Array_each(n, function (t, i) {
												if ("checkbox" == t.type && t.name.match(/^kt_pk/)) {
														if (e.targ != t) {
																var n = t.checked;
																t.checked = !n
														}
														var a = !0,
																o = null;
														Array_each(utility.dom.getElementsByTagName(t.parent_div, "INPUT"), function (t, e) {
																"checkbox" == t.type && void 0 !== t.parent_div && ("KT_selAll" != t.name ? (a = a && t.checked, nxt_list_set_checkbox_state(t)) : o = t)
														}), o && (o.checked = a)
												}
										}), !1
								})), t = null
						}), 0 == f && Array_each(["KT_topbuttons", "KT_bottombuttons"], function (t) {
								var e = utility.dom.getElementsByClassName(document.body, t, "div");
								if (1 == e.length) {
										var i = utility.dom.getElementsByTagName(e[0], "a");
										Array_each(i, function (t) {
												void 0 !== t.onclick && null != t.onclick && t.onclick && (t.onclick.toString().indexOf("edit_link") >= 0 || t.onclick.toString().indexOf("delete_link") >= 0) && (t.style.display = "none")
										})
								}
						});
						var T = utility.dom.getElementsBySelector("a.KT_move_op_link");
						for (i = 0; i < T.length; i++) {
								T[i].style.display = "none";
								var b = utility.dom.getNextSiblingByTagName(T[i], "input");
								null != b && (b.style.display = "none")
						}
						if (void 0 !== $NXT_LIST_SETTINGS.record_counter && "undefined" != typeof $NAV_Text_start && $NXT_LIST_SETTINGS.record_counter) {
								var p = nxt_list_first_data_row(h),
										N = !1;
								try {
										Array_each(y.rows[p].cells[0].getElementsByTagName("input"), function (t) {
												"checkbox" == t.type && t.name.match(/^kt_pk/) && (N = !0)
										})
								} catch (t) {
										N = !1
								}
								i = 0;
								for (var k = 1; i < y.rows.length; i++) {
										var x, E = y.rows[i];
										if (1 == E.cells.length) return void(E.cells[0].colSpan = parseInt(E.cells[0].colSpan, 10) + 1);
										if (i)(x = document.createElement("td")).innerHTML = i >= p ? k++ + $NAV_Text_start - 1 : "&nbsp;";
										else(x = document.createElement("th")).innerHTML = "No.";
										N ? utility.dom.insertAfter(x, E.cells[0]) : E.cells[0].parentNode.insertBefore(x, E.cells[0])
								}
						}
						var B = utility.dom.getElementsByClassName(y.getElementsByTagName("tbody")[0], "KT_order");
						nxt_list_last_data_row(h) != nxt_list_first_data_row(h) ? (nxt_hide_move_link(B[0], 1), nxt_hide_move_link(B[B.length - 1], 0)) : nxt_hide_move_link(B[0], "*");
						var w = utility.dom.getElementsByTagName(t, "FORM"),
								A = [];
						Array_each(w, function (t) {
								utility.dom.getParentByTagName(t, "div").className.match(/KT_tng(list|form)/) && Array_push(A, t)
						}), 1 == A.length && (form = A[0], form.form_action = d, form.param_name = u)
				}
		})
}

function nxt_hide_move_link(t, e) {
		if (void 0 === t) return !0;
		var i = [];
		$NXT_LIST_SETTINGS.show_as_buttons ? (Array_each(t.getElementsByTagName("input"), function (t, e) {
				"button" == t.type && Array_push(i, t)
		}), 0 == i.length && (i = t.getElementsByTagName("a"))) : i = t.getElementsByTagName("a");
		for (var n = 0; n < i.length; n++) i[n].style.visibility = "*" == e ? "hidden" : n == e ? "hidden" : "visible"
}

function nxt_list_attach_timeout() {
		"undefined" != typeof $style_executed ? (nxt_list_attach(), delete $style_executed) : window.setTimeout("nxt_list_attach_timeout()", 10)
}

function nxt_list_detach() {
		if (is.opera) return !0;
		for (var t = utility.dom.getElementsByClassName(document, "KT_tng", "div"), e = 0; e < t.length; e++) {
				for (var i = t[e], n = utility.dom.getElementsByTagName(i, "*"), a = 0; a < n.length; a++) utility.dom.stripAttributes(n[a], ["parent_div"]);
				utility.dom.stripAttributes(t[e], ["parent_div"])
		}
		var o = utility.dom.getElementsByClassName(document, "KT_tngtable", "table");
		for (e = 0; e < o.length; e++) {
				for (o[e], n = utility.dom.getElementsByTagName(i, "*"), a = 0; a < n.length; a++) utility.dom.stripAttributes(n[a], ["parent_div"]);
				utility.dom.stripAttributes(o[e], ["parent_div"])
		}
		return document.all && function t(e) {
				for (var i in e) {
						"object" == typeof i && t(i);
						try {
								delete e[i], e[i] = null
						} catch (t) {}
				}
				try {
						delete e, e = null
				} catch (t) {}
		}(window), window.CollectGarbage && window.CollectGarbage(), !0
}
window.onbeforeunload = nxt_list_check_changed_unload, utility.dom.attachEvent2(window, "onunload", nxt_list_detach);
try {
		Kore.addUnloadListener(nxt_list_detach, window)
} catch (t) {}
