/*function UNI_isktml(e) {
		var t = !1;
		if (void 0 !== e.name && "undefined" != typeof ktmls && null != ktmls && ktmls.length) {
				t = !1;
				Array_each(ktmls, function (a) {
						a.name == e.name && (t = a)
				})
		}
		return t
}*/

function UNI_date2regexp(e) {
		return utility.date.date2regexp(e)
}

function UNI_mask2regexp(e) {
		return e = (e = (e = (e = (e = e.replace(/([-\/\[\]()\*\+])/g, "\\$1")).replace(/9/g, "\\d")).replace(/\?/g, ".")).replace(/X/g, "\\w")).replace(/A/g, "[A-Za-z]"), new RegExp("^" + e + "$")
}

function UNI_regexp2regexp(e) {
		var t = e.substring(0, 1),
				a = e.lastIndexOf(t),
				r = e.substring(1, a),
				n = "";
		if (a + 1 <= e.length - 1) n = e.substring(a + 1, e.length);
		return new RegExp(r, n)
}

function UNI_init_error_elements(e) {
		for (var t = {}, a = e.name, r = document.getElementsByTagName("LABEL"), n = 0; n < r.length; n++)
				if (r[n].htmlFor == e.id) {
						t.label = r[n];
						break
				} if (null != e.getAttribute("wdg:type")) {
				for (var i = e; i && !(void 0 !== i.className && i.className.indexOf("widget_container") >= 0);) i = i.parentNode;
				i && (e = i)
		}
		for (t.container = e.parentNode; 1 != t.container.nodeType;) t.container = t.container.parentNode;
		var o = document.getElementById(a + "_error_element");
		if (null != o) t.error_element = o;
		else {
				t.error_element = utility.dom.createElement("DIV", {
						id: a + "_error_element"
				});
				var _ = utility.dom.getElementsByClassName(e.parentNode, $UNI_CLASSNAME_ERROR_SS);
				_.length > 0 && e.parentNode.removeChild(_[0]);
				var m = utility.dom.getElementsByClassName(e.parentNode, "KT_field_hint")[0];
				if (void 0 === m && (m = e, e.type && "radio" == e.type.toString().toLowerCase())) try {
						m = e.parentNode
				} catch (t) {
						m = e
				}
				for (; m.nextSibling;) m = m.nextSibling;
				t.error_element = utility.dom.insertAfter(t.error_element, m)
		}
		return t
}

function UNI_fieldok_action(e, t) {
		var a = UNI_init_error_elements(e);
		try {
				utility.dom.classNameRemove(a.label, $UNI_CLASSNAME_ERROR_LABEL), utility.dom.classNameRemove(a.container, $UNI_CLASSNAME_ERROR_CONTAINER), utility.dom.classNameRemove(e, $UNI_CLASSNAME_ERROR_ELEMENT), a.error_element.parentNode.removeChild(a.error_element)
		} catch (e) {}
		a = void 0
}

function UNI_required_action(e, t) {
		var a = UNI_init_error_elements(e);
		a.label && utility.dom.classNameAdd(a.label, $UNI_CLASSNAME_ERROR_LABEL), a.container && utility.dom.classNameAdd(a.container, $UNI_CLASSNAME_ERROR_CONTAINER), e && utility.dom.classNameAdd(e, $UNI_CLASSNAME_ERROR_ELEMENT);
		var r = t.errorMessage;
		"" == r && (r = utility.string.sprintf(window[$UNI_GLOBALVARNAME_MESSAGES].required, e.name));
		try {
				a.error_element.innerText = r, a.error_element.innerHTML = r
		} catch (e) {}
		a.error_element && utility.dom.classNameAdd(a.error_element, $UNI_CLASSNAME_ERROR_ERROR_ELEMENT)
}

function UNI_format_action(e, t) {
		var a = UNI_init_error_elements(e);
		a.label && utility.dom.classNameAdd(a.label, $UNI_CLASSNAME_ERROR_LABEL), a.container && utility.dom.classNameAdd(a.container, $UNI_CLASSNAME_ERROR_CONTAINER), e && utility.dom.classNameAdd(e, $UNI_CLASSNAME_ERROR_ELEMENT);
		var r = t.errorMessage;
		if ("" == r) {
				var n = window[$UNI_GLOBALVARNAME_MESSAGES][t.type + "_" + t.format],
						i = window[$UNI_GLOBALVARNAME_MESSAGES][t.type + "_"];
				r = void 0 !== n ? utility.string.sprintf(window[$UNI_GLOBALVARNAME_MESSAGES].format, n) : void 0 !== i ? utility.string.sprintf(window[$UNI_GLOBALVARNAME_MESSAGES].format, i) : utility.string.sprintf(window[$UNI_GLOBALVARNAME_MESSAGES].format, t.format)
		}
		try {
				a.error_element.innerText = r, a.error_element.innerHTML = r
		} catch (e) {}
		a.error_element && utility.dom.classNameAdd(a.error_element, $UNI_CLASSNAME_ERROR_ERROR_ELEMENT)
}

function UNI_boundary_action(e, t, a, r) {
		sprintf = utility.string.sprintf;
		var n = UNI_init_error_elements(e);
		n.label && utility.dom.classNameAdd(n.label, $UNI_CLASSNAME_ERROR_LABEL), n.container && utility.dom.classNameAdd(n.container, $UNI_CLASSNAME_ERROR_CONTAINER), e && utility.dom.classNameAdd(e, $UNI_CLASSNAME_ERROR_ELEMENT);
		var i = "text" == t.type ? "text" : "other",
				o = t.errorMessage;
		"" == o && (o = null != a && null != r ? sprintf(window[$UNI_GLOBALVARNAME_MESSAGES][i + "_between"], t.min, t.max) : null != a ? sprintf(window[$UNI_GLOBALVARNAME_MESSAGES][i + "_min"], t.min) : sprintf(window[$UNI_GLOBALVARNAME_MESSAGES][i + "_max"], t.max));
		try {
				n.error_element.innerText = o, n.error_element.innerHTML = o
		} catch (e) {}
		n.error_element && utility.dom.classNameAdd(n.error_element, $UNI_CLASSNAME_ERROR_ERROR_ELEMENT)
}

function UNI_validateRegExp(e, t) {
		var a = !0;
		return UNI_regexp2regexp(t.additional_params).exec(e.value) || (a = !1), a
}

function UNI_validateMask(e, t) {
		var a = !0;
		return UNI_mask2regexp(t.additional_params).exec(e.value) || (a = !1), a
}

function UNI_parse_date(e, t) {
		return utility.date.parse_date(e, t)
}

function UNI_dateBuilder(e, t, a, r, n, i) {
		var o = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
		return parseInt(e) > 0 && (parseInt(t) > 0 && parseInt(t) <= 12 && ((parseInt(e) % 4 == 0 && parseInt(e) % 100 != 0 || parseInt(e) % 400 == 0) && (o[1] = 29), parseInt(a) > 0 && parseInt(a) <= o[parseInt(t) - 1] && (o[1] = 28, parseInt(r) >= 0 && parseInt(r) <= 23 && (parseInt(n) >= 0 && parseInt(n) <= 59 && (parseInt(i) >= 0 && parseInt(i) <= 59 && (e = utility.math.zeroPad(e, 4)) + (t = utility.math.zeroPad(t, 2)) + (a = utility.math.zeroPad(a, 2)) + (r = utility.math.zeroPad(r, 2)) + (n = utility.math.zeroPad(n, 2)) + (i = utility.math.zeroPad(i, 2)))))))
}

function UNI_validateDate(e, t) {
		var a = !0,
				r = t.additional_params,
				n = utility.date.date2regexp(r).exec(e.value);
		if (n) {
				var i = utility.date.parse_date(n, r);
				0 == UNI_dateBuilder(i.year, i.month, i.day, i.hour, i.minutes, i.seconds) && (a = !1)
		} else a = !1;
		return a
}

function UNI_validate_required(e, t) {
		var a = !0;
		if ("radio" == e.type.toString().toLowerCase()) {
				var r = [];
				Array_each(e.form.elements, function (t, a) {
						t.name == e.name && Array_push(r, t)
				}), a = !1, Array_each(r, function (e, t) {
						e.checked && (a = !0)
				}), a || UNI_required_action(e, t)
		} else("" == e.value || e.value.match(/^<br[^>]*>$/gi) || e.value.match(/^<p[^>]*>(&nbsp;|)<\/p>$/gi) || e.value.match(/^<div[^>]*>(&nbsp;|)<\/div>$/gi) || e.value.match(/^<span[^>]*>(&nbsp;|)<\/span>$/gi) || "checkbox" == e.type.toLowerCase() && 0 == e.checked) && (UNI_required_action(e, t), a = !1);
		return a
}

function UNI_validate_generic(e, t) {
		var a = !0;
		if ("" != e.value && "" != t.additional_params) {
				if (t.additional_params.match(/^([^0-9A-Za-z]).*\1[gism]*$/)) var r = UNI_validateRegExp;
				else r = UNI_validateMask;
				r(e, t) || (UNI_format_action(e, t), a = !1)
		}
		return a
}

function UNI_validate_format_regexp(e, t) {
		var a = !0;
		return "" != e.value && (UNI_validateRegExp(e, t) || (UNI_format_action(e, t), a = !1)), a
}

function UNI_validate_format_mask(e, t) {
		var a = !0;
		return "" != e.value && (UNI_validateMask(e, t) || (UNI_format_action(e, t), a = !1)), a
}

function UNI_validate_format_date(e, t) {
		var a = !0;
		return "" != e.value && (UNI_validateDate(e, t) || (UNI_format_action(e, t), a = !1)), a
}

function UNI_validate_format_text_ip(e, t) {
		var a = !0;
		return "" != e.value && (UNI_validateRegExp(e, t) ? Array_each(e.value.toString().split("."), function (r) {
				if (parseInt(r) > 255) return UNI_format_action(e, t), void(a = !1)
		}) : (UNI_format_action(e, t), a = !1)), a
}

function UNI_validate_minmax(e, t) {
		var a = !0,
				r = !0,
				n = !0;
		return "" != e.value && ("" != t.min && (n = e.value >= t.min, a = a && n), "" != t.max && (r = e.value <= t.max, a = a && r), r && n || UNI_boundary_action(e, t, n, r)), a
}

function UNI_validate_minmax_text(e, t) {
		var a = !0,
				r = null,
				n = null;
		if ("" != t.min) {
				n = e.value.length >= parseInt(t.min);
				a = a && n
		}
		if ("" != t.max) {
				r = e.value.length <= parseInt(t.max);
				a = a && r
		}
		return r && n || UNI_boundary_action(e, t, n, r), a
}

function UNI_validate_minmax_numeric(e, t) {
		var a = !0,
				r = null,
				n = null;
		if ("" != t.min) {
				n = parseFloat(e.value) >= parseFloat(t.min);
				a = a && n
		}
		if ("" != t.max) {
				r = parseFloat(e.value) <= parseFloat(t.max);
				a = a && r
		}
		return r && n || UNI_boundary_action(e, t, n, r), a
}

function UNI_validate_minmax_double(e, t) {
		var a = !0,
				r = null,
				n = null;
		if ("" != t.min) {
				n = parseFloat(e.value) >= parseFloat(t.min);
				a = a && n
		}
		if ("" != t.max) {
				r = parseFloat(e.value) <= parseFloat(t.max);
				a = a && r
		}
		return r && n || UNI_boundary_action(e, t, n, r), a
}

function UNI_validate_minmax_date(e, t) {
		var a = !0,
				r = null,
				n = null,
				i = t.additional_params,
				o = utility.date.date2regexp(i),
				_ = o.exec(e.value),
				m = utility.date.parse_date(_, i);
		if (m = UNI_dateBuilder(m.year, m.month, m.day, m.hour, m.minutes, m.seconds), "" != t.min) {
				_ = o.exec(t.min);
				var l = UNI_dateBuilder((l = utility.date.parse_date(_, i)).year, l.month, l.day, l.hour, l.minutes, l.seconds);
				n = parseInt(m) >= parseInt(l);
				a = a && n
		}
		if ("" != t.max) {
				_ = o.exec(t.max);
				var d = UNI_dateBuilder((d = utility.date.parse_date(_, i)).year, d.month, d.day, d.hour, d.minutes, d.seconds);
				r = parseInt(m) <= parseInt(d);
				a = a && r
		}
		return r && n || UNI_boundary_action(e, t, n, r), a
}

function UNI_buttonHandler(e) {
		var t = utility.dom.setEventVars(e);
		(t.targ.name.match($UNI_DELETE_BUTTON_NAME) || t.targ.name.match($UNI_INSERT_BUTTON_NAME) || t.targ.name.match($UNI_UPDATE_BUTTON_NAME) || t.targ.name.match($UNI_LOGIN_BUTTON_NAME) || void 0 !== t.targ.tagName && "submit" == t.targ.type.toLowerCase()) && t.targ.form.removeAttribute("haschanged"), t.targ.name.match($UNI_DELETE_BUTTON_NAME) || t.targ.name.match($UNI_CANCEL_BUTTON_NAME) ? (t.targ.form.setAttribute("donotcheck", "1"), window.UNI_buttonpressed = t.targ.name) : (t.targ.name.match($UNI_INSERT_BUTTON_NAME) || t.targ.name.match($UNI_UPDATE_BUTTON_NAME), t.targ.form.setAttribute("donotcheck", "0"), window.UNI_buttonpressed = t.targ.name)
}

function UNI_navigateCancel(e, t) {
		var a = utility.dom.setEventVars(e);
		if (null != a.targ.form.getAttribute("haschanged")) {
				if (confirm(UNI_Messages.form_was_modified)) {
						a.targ.form.removeAttribute("haschanged");
						var r = t;
						try {
								0 == r.indexOf("/") || r.match(/\w+:\/\//) || (r = document.getElementsByTagName("base")[0].href.toString() + r)
						} catch (e) {
								r = t
						}
						return "undefined" != typeof $ctrl ? $ctrl.loadPanels(r) : window.location.href = r, !0
				}
				return utility.dom.stopEvent(a.e), !1
		}
		r = t;
		try {
				0 == r.indexOf("/") || r.match(/\w+:\/\//) || (r = document.getElementsByTagName("base")[0].href.toString() + r)
		} catch (e) {
				r = t
		}
		return "undefined" != typeof $ctrl ? $ctrl.loadPanels(r) : window.location.href = r, !0
}
"undefined" == typeof KT_FVO && (KT_FVO = {}, KT_FVO_properties = {
		noTriggers: 0,
		noTransactions: 0
}), $UNI_GLOBALVARNAME = "KT_FVO", $UNI_GLOBALVARNAME_MESSAGES = "UNI_Messages", $UNI_ATTRNAME_ERRORMESSAGE = "errormessage", $UNI_DEFAULTERRORMESSAGE = "The field '%s' has an invalid value !", $UNI_FORM_SUBMIT_PRIORITY = 10, $UNI_CLASSNAME_ERROR_LABEL = "form_validation_field_error_label", $UNI_CLASSNAME_ERROR_CONTAINER = "form_validation_field_error_container", $UNI_CLASSNAME_ERROR_ELEMENT = "form_validation_field_error_text", $UNI_CLASSNAME_ERROR_ERROR_ELEMENT = "form_validation_field_error_error_message", $UNI_CLASSNAME_ERROR_SS = "KT_field_error", $UNI_CLASSNAME_ERROR_FORM = "form_validation_form_error", $UNI_DELETE_BUTTON_NAME = /delete/i, $UNI_INSERT_BUTTON_NAME = /insert/i, $UNI_UPDATE_BUTTON_NAME = /update/i, $UNI_CANCEL_BUTTON_NAME = /cancel/i, $UNI_LOGIN_BUTTON_NAME = /login/i;
var UNI_navigateAway_locked = !1;

function UNI_navigateAway(e) {
		if (UNI_navigateAway_locked) UNI_navigateAway_locked = !1;
		else {
				for (var t = document.forms, a = !1, r = 0; r < t.length; r++) {
						null != t[r].getAttribute("haschanged") && (a = !0)
				}
				if (1 == a) return UNI_Messages.form_was_modified
		}
}

function UNI_attachToButtons() {
		if (!is.ie || !is.mac)
				for (var e = document.getElementsByTagName("form"), t = 0; t < e.length; t++)
						for (var a = e[t], r = 0; a.elements.length; r++) {
								var n = a.elements[r];
								if (null == n) break;
								if (n.name) {
										var i = !1;
										(n.name.toString().match($UNI_DELETE_BUTTON_NAME) || n.name.toString().match($UNI_CANCEL_BUTTON_NAME)) && (i = !0, n["on" + (is.safari ? "mousedown" : "focus")] = UNI_buttonHandler), (n.name.toString().match($UNI_INSERT_BUTTON_NAME) || n.name.toString().match($UNI_UPDATE_BUTTON_NAME)) && (i = !0, n["on" + (is.safari ? "mousedown" : "focus")] = UNI_buttonHandler), "submit" != n.type.toLowerCase() || i || (n["on" + (is.safari ? "mousedown" : "focus")] = UNI_buttonHandler)
								}
						}
}

function UNI_attachToForm() {
		GLOBAL_registerFormSubmitEventHandler("UNI_formSubmittalHandler", $UNI_FORM_SUBMIT_PRIORITY), is.windows && is.ie && GLOBAL_registerFormSubmitEventHandler("UNI_enableButtonsIEBug", $UNI_FORM_SUBMIT_PRIORITY + 1), UNI_attachToButtons()
}

function UNI_attachEmptyProps(e) {
		return Array_each(["colname", "required", "type", "format", "additional_params", "min", "max", "errorMessage"], function (t) {
				void 0 === e[t] && (e[t] = "")
		}), e
}

function UNI_workOnElement(e) {
		var t = !0;
		if (e && e.type && "hidden" == e.type.toLowerCase() && !UNI_isktml(e)) return !0;
		if (void 0 === window[$UNI_GLOBALVARNAME]) return !0;
		var a = e.name;
		window[$UNI_GLOBALVARNAME][e.name] || (a = a.replace(/_\d+$/, ""));
		var r = UNI_attachEmptyProps(window[$UNI_GLOBALVARNAME][a]);
		if (r.required && (t = t && UNI_validate_required(e, r)), !t) return t;
		if ("" != r.format || "mask" == r.type || "regexp" == r.type) {
				var n = window["UNI_validate_format_" + r.type + "_" + r.format],
						i = window["UNI_validate_format_" + r.type],
						o = UNI_validate_generic;
				t = "function" == typeof n ? t && n(e, r) : "function" == typeof i ? t && i(e, r) : t && o(e, r)
		}
		if (!t) return t;
		if ("" != e.value && ("" != r.min || "" != r.max)) {
				o = UNI_validate_minmax;
				"function" == typeof (n = window["UNI_validate_minmax_" + r.type]) ? t = t && n(e, r): "function" == typeof o && (t = t && o(e, r))
		}
		return t ? (1 == t && UNI_fieldok_action(e, r), t) : t
}

function UNI_disableButtons(e, t, a) {
		Array_each(e.getElementsByTagName("input"), function (e, r) {
				if (e.type && Array_indexOf(["submit", "button"], e.type.toLowerCase()) >= 0) {
						if ("mxw_v" == e.className || "mxw_add" == e.className) return !0;
						e.name.match(t) && (e.disabled = a)
				}
		})
}

function UNI_formSubmittalHandler(e) {
		if (is.ie && is.mac) return !0;
		focus_happened = !1;
		var t = utility.dom.setEventVars(e).targ;
		t = utility.dom.getParentByTagName(t, "form");
		var a = !0;
		if (t.removeAttribute("haschanged"), void 0 !== window.UNI_buttonpressed) var r = window.UNI_buttonpressed;
		else {
				var n = [];
				if (Array_each(t.getElementsByTagName("input"), function (e, t) {
								!e.type || "submit" != e.type.toLowerCase() && "button" != e.type.toLowerCase() || Array_push(n, e)
						}), 1 == n.length) r = n[0].name;
				else {
						for (var i = !1, o = !1, _ = !1, m = 0; m < n.length; m++) {
								var l = n[m];
								l.name.toString().match($UNI_UPDATE_BUTTON_NAME) && (i = !0), l.name.toString().match($UNI_INSERT_BUTTON_NAME) && (o = !0), l.name.toString().match($UNI_LOGIN_BUTTON_NAME) && (_ = !0)
						}
						if (i) r = $UNI_UPDATE_BUTTON_NAME;
						else if (o) r = $UNI_INSERT_BUTTON_NAME;
						else if (_) r = $UNI_LOGIN_BUTTON_NAME
				}
		}
		if (Array_each(t.getElementsByTagName("input"), function (e, a) {
						if (e.type && ("submit" == e.type.toLowerCase() || "button" == e.type.toLowerCase())) {
								if ("mxw_v" == e.className || "mxw_add" == e.className) return !0;
								if (e.name.match(r)) {
										var n = utility.dom.createElement("input", {
												type: "hidden",
												name: e.name,
												value: e.value
										});
										n = t.appendChild(n)
								}
						}
				}), "1" == t.getAttribute("donotcheck")) return !0;
		var d = !0;
		Array_each(utility.dom.getElementsByTagName(document, "input"), function (e) {
				void 0 !== e.type && void 0 !== e.name && "hidden" == e.type.toLowerCase() && e.name.toString().match(/^kt_pk/) && e.value && "KT_NEW" == e.value && (d = !1)
		});
		var N = t.elements,
				s = [];
		if (Array_each(N, function (e, r) {
						if (!(Array_indexOf(s, e) >= 0 || void 0 !== e.tagName && "fieldset" == e.tagName.toLowerCase())) {
								"radio" == e.type.toString().toLowerCase() && Array_each(t.elements, function (t, a) {
										t.name == e.name && Array_push(s, t)
								});
								e.tagName;
								var n = e.name;
								if (n && (void 0 !== window[$UNI_GLOBALVARNAME] && void 0 === window[$UNI_GLOBALVARNAME][n] && (n = d ? n.replace(/_\d+$/, "") : n.replace(/_1$/, "")), void 0 !== window[$UNI_GLOBALVARNAME] && void 0 !== window[$UNI_GLOBALVARNAME][n])) {
										var i = UNI_workOnElement(e);
										if (!i && !focus_happened) try {
												e.focus(), focus_happened = !0
										} catch (e) {
												focus_happened = !1
										}
										a = a && i
								}
						}
				}), !a) return t.setAttribute("fvo_error", "1"), r = "", Array_indexOf(utility.dom.getClassNames(t), "KT_tngformerror") >= 0 && utility.dom.classNameAdd(t, $UNI_CLASSNAME_ERROR_FORM), !1;
		try {
				utility.dom.classNameRemove(t, $UNI_CLASSNAME_ERROR_FORM)
		} catch (e) {}
		return a
}

/* function UNI_enableButtonsIEBug(e) {
		var t = utility.dom.setEventVars(e).targ;
		t = utility.dom.getParentByTagName(t, "form");
		var a = [/[a-z]:\\.*$/i, /\\\\.*$/i],
				r = !0;
		return Array_each(t.getElementsByTagName("input"), function (e) {
				if (e.type && "file" == e.type.toLowerCase()) {
						for (var t = !1, n = 0; n < a.length; n++) e.value.match(a[n]) && (t = !0);
						r = r && t
				} */
	//	}), r || UNI_disableButtons(t, /.*/, !1), !0
//} 

function UNI_handle_required(e) {
		var t = e.htmlFor,
				a = !1;
		if (t) {
				var r = is.ie && "description" == t.toLowerCase() ? document.body.all(t) : document.getElementById(t);
				if (void 0 !== r && null != r && void 0 !== window[$UNI_GLOBALVARNAME]) {
						if (void 0 === r.name || null == r.name) return;
						var n = r.name;
						window[$UNI_GLOBALVARNAME][r.name] || (n = n.replace(/_\d+$/, ""));
						var i = window[$UNI_GLOBALVARNAME][n],
								o = !1;
						if ("radio" == r.type.toLowerCase() && e && e.parentNode && r && r.parentNode && e.parentNode == r.parentNode) o = !0;
						if (void 0 !== i && void 0 !== i.required && i.required && !o) {
								var _ = utility.dom.createElement("SPAN", {
										className: "KT_required"
								});
								_.innerHTML = "*", e.appendChild(_)
						}
						if (utility.dom.getElementsByClassName(r.parentNode, $UNI_CLASSNAME_ERROR_SS).length > 0 && !a) {
								try {
										r.focus()
								} catch (e) {}
								a = !0, Array_indexOf(utility.dom.getClassNames(r.form), "KT_tngformerror") >= 0 && utility.dom.classNameAdd(r.form, $UNI_CLASSNAME_ERROR_FORM)
						}
				}
		}
}

function UNI_handle_changed(e) {
		var t = e.htmlFor;
		if (t) {
				var a = is.ie && "description" == t.toLowerCase() ? document.body.all(t) : document.getElementById(t);
				if (void 0 !== a && null != a) {
						if (void 0 === a.name || null == a.name) return;
						a.name;
						var r = !1;
						if ("radio" == a.type.toLowerCase() && e && e.parentNode && a && a.parentNode && e.parentNode == a.parentNode) r = !0;
						r || utility.dom.attachEvent(a, "change", function (e) {
								try {
										utility.dom.getParentByTagName(this, "form").setAttribute("haschanged", "1")
								} catch (e) {}
						})
				}
		}
}

function UNI_form_attach() {
		var e = !1,
				t = utility.dom.getElementsByClassName(document, "KT_tng", "div"),
				a = null;
		if (void 0 !== (a = 1 == t.length ? t[0] : utility.dom.getElementsByClassName(document, "KT_tngtable", "table")[0]) && (Array_each(a.getElementsByTagName("input"), function (t, a) {
						if (t.type && Array_indexOf(["submit", "button"], t.type.toLowerCase()) >= 0) {
								if ("mxw_v" == t.className || "mxw_add" == t.className) return;
								t.name.match($UNI_UPDATE_BUTTON_NAME) && (e = !0)
						}
				}), e)) {
				var r = document.getElementsByTagName("form");
				if ("undefined" != typeof KT_FVO_properties && (KT_FVO_properties.noTriggers, 1) && void 0 !== KT_FVO_properties.noTransactions) {
						var n = parseInt(KT_FVO_properties.noTriggers, 10),
								o = parseInt(KT_FVO_properties.noTransactions, 10);
						if (1 == n && o > 1)
								for (i in KT_FVO) {
										var _ = new RegExp("^" + i, "g");
										Array_each(r, function (e) {
												Array_each(e.elements, function (e) {
														e && e.name && e.name.match(_) && "input" == e.tagName.toLowerCase() && e.type && Array_indexOf(["file", "password"], e.type.toLowerCase()) >= 0 && (KT_FVO[i].required = !1)
												})
										})
								}
				}
		}
		try {
				if (void 0 !== KT_FVO.kt_login_user) {
						var m = document.getElementById("kt_login_user");
						m && m.focus()
				}
		} catch (e) {}
		Array_each(utility.dom.getElementsByClassName(document, "KT_tngtable", "TABLE"), function (e, t) {
				null == e.getAttribute("kt_uni_attached") && (e.setAttribute("kt_uni_attached", "true"), Array_each(utility.dom.getElementsByTagName(e, "label"), function (e) {
						UNI_handle_required(e), UNI_handle_changed(e)
				}))
		}), window.UNI_uniqueid = new UIDGenerator, UNI_attachToForm()
}
"undefined" == typeof UNI_form_attach_executed && (utility.dom.attachEvent2(window, "onload", UNI_form_attach), UNI_form_attach_executed = !0), window.onbeforeunload = UNI_navigateAway;
