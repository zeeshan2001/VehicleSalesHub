if (!Function.prototype.apply) {
		Function.prototype.apply = function (o, a) {
				var r;
				if (!o) {
						o = {};
				}
				o.___apply = this;
				switch ((a && a.length) || 0) {
						case 0:
								r = o.___apply();
								break;
						case 1:
								r = o.___apply(a[0]);
								break;
						case 2:
								r = o.___apply(a[0], a[1]);
								break;
						case 3:
								r = o.___apply(a[0], a[1], a[2]);
								break;
						case 4:
								r = o.___apply(a[0], a[1], a[2], a[3]);
								break;
						case 5:
								r = o.___apply(a[0], a[1], a[2], a[3], a[4]);
								break;
						case 6:
								r = o.___apply(a[0], a[1], a[2], a[3], a[4], a[5]);
								break;
						default:
								for (var i = 0, s = ""; i < a.length; i++) {
										if (i != 0) {
												s += ",";
										}
										s += "a[" + i + "]";
								}
								//r = eval("o.___apply(" + s + ")");
				}
				o.__apply = null;
				return r;
		}
};
if (!Function.prototype.call) {
		Function.prototype.call = function (o) {
				var args = new Array(arguments.length - 1);
				for (var i = 1; i < arguments.length; i++) {
						args[i - 1] = arguments[i];
				}
				return this.apply(o, args);
		}
};
Function_bind = function (_this, object) {
		var __method = _this;
		return function () {
				__method.apply(object, arguments);
		}
};
Function_bindEventListener = function (_this, object) {
		var __method = _this;
		return function (event) {
				__method.call(object, event || window.event);
		}
};
if (!Array.prototype.push) {
		Array_push = function (_this, obj) {
				for (var i = 1; i < arguments.length; i++) {
						_this[_this.length] = arguments[i];
				}
				return _this.length;
		}
} else {
		Array_push = function (_this, obj) {
				for (var i = 1; i < arguments.length; i++) {
						_this.push(arguments[i]);
				}
				return _this.length;
		}
};
if (!Array.prototype.pop) {
		Array_pop = function (_this) {
				if (_this.length == 0) {
						try {
								return undefined;
						} catch (e) {
								return null;
						}
				}
				return _this[_this.length--];
		}
} else {
		Array_pop = function (_this) {
				return _this.pop();
		}
};
if (!Array.prototype.shift) {
		Array_shift = function (_this) {
				_this.reverse();
				var lastv = Array_pop(_this);
				_this.reverse();
				return lastv;
		};
} else {
		Array_shift = function (_this) {
				return _this.shift();
		};
};
if (!Array.prototype.splice) {
		Array_splice = function (_this, start, deleteCount) {
				var len = parseInt(_this.length);
				start = start ? parseInt(start) : 0;
				start = (start < 0) ? Math.max(start + len, 0) : Math.min(len, start);
				deleteCount = deleteCount ? parseInt(deleteCount) : 0;
				deleteCount = Math.min(Math.max(parseInt(deleteCount), 0), len);
				var deleted = _this.slice(start, start + deleteCount);
				var insertCount = Math.max(arguments.length - 1, 1);
				var new_len = _this.length + insertCount - deleteCount;
				var start_slide = start + insertCount;
				var nslide = len - start_slide;
				for (var i = new_len - 1; i >= start_slide; --i) {
						_this[i] = _this[i - nslide];
				}
				for (i = start; i < start + insertCount; ++i) {
						_this[i] = arguments[i - start + 3];
				}
				return deleted;
		};
} else {
		Array_splice = function (_this, start, deleteCount) {
				var args = [];
				var s = '';
				for (var i = 3; i < arguments.length; i++) {
						args[i - 3] = arguments[i];
						s += ', ' + 'args[' + (i - 3) + ']';
				}
				s = 'var ret = _this.splice(start, deleteCount' + s + ')';
				//eval(s);
				return ret;
		};
};
Object_toArray = function (_this, delim) {
		var result;
		if (typeof (delim) == 'undefined') {
				delim = ',';
		}
		switch (typeof (_this)) {
				case 'array':
						result = _this;
						break;
				case 'string':
						if (_this.indexOf(delim)) {
								result = _this.split(delim);
						} else {
								result.push(_this);
						}
						break;
				default:
						result.push(_this);
						break;
		}
};
Object_weave = function (_this, source) {
		for (property in source) {
				_this[property] = source[property];
		}
		return _this;
};
Object_weave_safe = function (_this, source) {
		for (property in source) {
				if (typeof _this[property] == 'undefined') {
						_this[property] = source[property];
				}
		}
		return _this;
};
Array_indexOf = function (_this, x) {
		for (var i = 0; i < _this.length; i++) {
				if (_this[i] == x) {
						return i;
				}
		}
		return -1;
};
Array_lastIndexOf = function (_this, x) {
		for (var i = _this.length - 1; i >= 0; i--) {
				if (_this[i] == x) {
						return i;
				}
		}
		return -1;
};
Array_last = function (_this) {
		if (_this.length > 0) {
				return _this[_this.length - 1];
		}
};
String_trim = function (_this, str) {
		if (!str) str = _this;
	var str = str.toString();
		return str.replace(/^\s*/, "").replace(/\s*$/, "");
};
String_normalize_space = function (_this, str) {
		if (!str) str = _this;
		return String_trim(str).replace(/\s+/g, " ");
};
String_htmlencode = function (_this, str) {
		if (!str) str = _this;
		return str.replace(/\&/g, "&amp;").replace(/\</g, "&lt;").replace(/\>/g, "&gt;").replace(/\"/g, "&quot;");
};
String_htmldecode = function (_this, str) {
		if (!str) str = _this;
		return str.replace(/&lt;/g, "<").replace(/&gt;/g, ">").replace(/&quot;/g, "\"").replace(/&amp;/g, "&");
};
Array_each = function (_this, block) {
		for (var index = 0; index < _this.length; ++index) {
				var item = _this[index];
				block(item, index)
		}
		return _this;
};
Number_times = function (_this, block) {
		for (var i = 0; i < _this; i++) block(i)
};
Array_min = function (_this) {
		if (_this.length == 0) return false;
		if (_this.length == 1) return _this[0];
		var min, me, val;
		min = 0;
		me = _this;
		Array_each(me, function (val, i) {
				if (val < me[min]) {
						min = i;
				}
		});
		return _this[min];
};
String_min = function (_this) {
		return Array_min(_this.split(','));
};

function min() {
		var a = [];
		Array_each(arguments, function (val, i) {
				Array_push(a, val);
		});
		return Array_min(a);
};
Array_max = function (_this) {
		if (_this.length == 0) return false;
		if (_this.length == 1) return _this[0];
		var max, me, val;
		max = 0;
		me = _this;
		Array_each(me, function (val, i) {
				if (val > me[max]) {
						max = i;
				}
		});
		return _this[max];
};
String_max = function (_this) {
		return Array_max(_this.split(','));
};

function max() {
		var a = [];
		Array_each(arguments, function (val, i) {
				Array_push(a, val);
		});
		return Array_max(a);
};
 window.onload = function() {       
document.getElementById('maincontent').style.transition="opacity 1s";
document.getElementById('maincontent').style.opacity="1";
}