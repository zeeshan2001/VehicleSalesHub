/*
Macromedia(r) Flash(r) JavaScript Integration Kit License


Copyright (c) 2005 Macromedia, inc. All rights reserved.

Redistribution and use in source and binary forms, with or without modification,
are permitted provided that the following conditions are met:

1. Redistributions of source code must retain the above copyright notice, this
list of conditions and the following disclaimer.

2. Redistributions in binary form must reproduce the above copyright notice,
this list of conditions and the following disclaimer in the documentation and/or
other materials provided with the distribution.

3. The end-user documentation included with the redistribution, if any, must
include the following acknowledgment:

"This product includes software developed by Macromedia, Inc.
(http://www.macromedia.com)."

Alternately, this acknowledgment may appear in the software itself, if and
wherever such third-party acknowledgments normally appear.

4. The name Macromedia must not be used to endorse or promote products derived
from this software without prior written permission. For written permission,
please contact devrelations@macromedia.com.

5. Products derived from this software may not be called "Macromedia" or
"Macromedia Flash", nor may "Macromedia" or "Macromedia Flash" appear in their
name.
	
THIS SOFTWARE IS PROVIDED "AS IS" AND ANY EXPRESSED OR IMPLIED WARRANTIES,
INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND
FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL MACROMEDIA OR
ITS CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT
OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT,
STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY
OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH
DAMAGE.

--

This code is part of the Flash / JavaScript Integration Kit:
http://www.macromedia.com/go/flashjavascript/

Created by:

Christian Cantrell
http://weblogs.macromedia.com/cantrell/
mailto:cantrell@macromedia.com

Mike Chambers
http://weblogs.macromedia.com/mesh/
mailto:mesh@macromedia.com

Macromedia
*/


/**
 * Generates a browser-specific Flash tag. Create a new instance, set whatever
 * properties you need, then call either toString() to get the tag as a string, or
 * call write() to write the tag out.
 */

/**
 * Creates a new instance of the FlashTag.
 * src: The path to the SWF file.
 * width: The width of your Flash content.
 * height: the height of your Flash content.
 */
function FlashTag(src, width, height) {
	this.src	   = src;
	this.width	 = width;
	this.height	= height;
	this.version   = '8,0,24,0';
	this.id		= null;
	this.bgcolor   = 'ffffff';
	this.flashVars = null;
}

/**
 * Sets the Flash version used in the Flash tag.
 */
FlashTag.prototype.setVersion = function(v) {
	this.version = v;
}

/**
 * Sets the ID used in the Flash tag.
 */
FlashTag.prototype.setId = function(id) {
	this.id = id;
}

/**
 * Sets the background color used in the Flash tag.
 */
FlashTag.prototype.setBgcolor = function(bgc) {
	this.bgcolor = bgc;
}

/**
 * Sets any variables to be passed into the Flash content. 
 */
FlashTag.prototype.setFlashvars = function(fv) {
	this.flashVars = fv;
}

/**
 * Get the Flash tag as a string. 
 */
FlashTag.prototype.toString = function() {
	var ie = (navigator.appName.indexOf ("Microsoft") != -1) ? 1 : 0;
	var flashTag = new String();
	if (ie)
	{
		flashTag += '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" ';
		if (this.id != null)
		{
			flashTag += 'id="'+this.id+'" ';
		}
		flashTag += 'codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version='+this.version+'" ';
		flashTag += 'width="'+this.width+'" ';
		flashTag += 'height="'+this.height+'">';
		flashTag += '<param name="movie" value="'+this.src+'"/>';
		flashTag += '<param name="quality" value="high"/>';
		flashTag += '<param name="bgcolor" value="#'+this.bgcolor+'"/>';
		flashTag += '<param name="allowScriptAccess" value="always"/>';
		if (this.flashVars != null)
		{
			flashTag += '<param name="flashvars" value="'+this.flashVars+'"/>';
		}
		flashTag += '</object>';
	}
	else
	{
		flashTag += '<embed src="'+this.src+'" allowScriptAccess="always" ';
		flashTag += 'quality="high" '; 
		flashTag += 'bgcolor="#'+this.bgcolor+'" ';
		flashTag += 'width="'+this.width+'" ';
		flashTag += 'height="'+this.height+'" ';
		flashTag += 'type="application/x-shockwave-flash" ';
		if (this.flashVars != null)
		{
			flashTag += 'flashvars="'+this.flashVars+'" ';
		}
		if (this.id != null)
		{
			flashTag += 'name="'+this.id+'" ';
		}
		flashTag += 'pluginspage="http://www.macromedia.com/go/getflashplayer">';
		flashTag += '</embed>';
	}
	return flashTag;
}

/**
 * Write the Flash tag out. Pass in a reference to the document to write to. 
 */
FlashTag.prototype.write = function(doc) {
	doc.write(this.toString());
}

FlashTag.prototype.setHTMLContent = function(el) {
	el.innerHTML = this.toString();
}

/********************************************************
*********************************************************
*********************************************************
*********************************************************
********************************************************/

		 
function tNG_FlashUpload(relpath, domElementId, name) {
	if (relpath) {
		this.relpath = relpath + "includes/tng/pub/";
	} else {
		this.relpath = "includes/tng/pub/";
	}
	if (domElementId)
		this.domElementId = domElementId;
	if (name)
		this.instance = name;
	var uid = new Date().getTime();
	this.uid = uid;
}

tNG_FlashUpload.prototype.setColors = function(barCol, textCol, borderCol) {
	if (barCol) {
		this.barColor = barCol;
	} else {
		this.barColor = "haloBlue";
	}

	if (textCol) {
		this.textColor = textCol;
	} else {
		this.textColor = "haloBlue";
	}

	if (borderCol) {
		this.borderColor = borderCol;
	} else {
		this.borderColor = "#e2e2e2";
	}
	
}

tNG_FlashUpload.prototype.loadFlashMovie = function(url, maxSize, maxFiles, currentFileNumber, allowedExtensions, maxSizeError, maxFileError,emptyFileError, flash_skipping, flash_httperror, flash_httperror_head, flash_ioerror, flash_ioerror_head, flash_complete_msg, flash_upload_batch, flash_upload_single) {
	current_upload_div = document.getElementById(this.domElementId);
	if(current_upload_div) {
		current_upload_div.parentNode.removeChild(current_upload_div);
	}
	current_upload_div = document.createElement("DIV");
	current_upload_div.id = this.domElementId;

	//multiple-file-upload-container
	document.body.appendChild(current_upload_div);
	current_upload_div.style.position = 'absolute';
	current_upload_div.style.display = 'none';

	var tag = new FlashTag(this.relpath+"multiple-file-upload.swf","100%","100%") // last two arguments are height and width
	tag.setVersion("8,0,24,0");
	tag.setId("requiredid"); 
	var myFlashvars = 'url='+encodeURIComponent(url);
	myFlashvars = myFlashvars + '&lcId='+this.uid;
	myFlashvars = myFlashvars + '&maxSize='+maxSize;
	myFlashvars = myFlashvars + '&maxFileNumber='+maxFiles;
	myFlashvars = myFlashvars + '&currentFileNumber='+currentFileNumber;
	myFlashvars = myFlashvars + '&arrAllowedExtensions='+allowedExtensions;
	myFlashvars = myFlashvars + '&complete_function='+this.instance+'.onCompleteEvent';
	myFlashvars = myFlashvars + '&cancel_function='+this.instance+'.onCancelEvent';
	myFlashvars = myFlashvars + '&start_function='+this.instance+'.onStartEvent';
	myFlashvars = myFlashvars + '&resize_function='+this.instance+'.onResizeEvent';
	myFlashvars = myFlashvars + '&unblock_function='+this.instance+'.onUnblockEvent';
	myFlashvars = myFlashvars + '&pageContainer='+this.domElementId;
	myFlashvars = myFlashvars + '&maxSizeError='+encodeURIComponent(maxSizeError);
	myFlashvars = myFlashvars + '&maxFileError='+encodeURIComponent(maxFileError);
	myFlashvars = myFlashvars + '&emptyFileError='+encodeURIComponent(emptyFileError);
	myFlashvars = myFlashvars + '&flash_skipping='+encodeURIComponent(flash_skipping);
	myFlashvars = myFlashvars + '&flash_httperror='+encodeURIComponent(flash_httperror);
	myFlashvars = myFlashvars + '&flash_httperror_head='+encodeURIComponent(flash_httperror_head);
	myFlashvars = myFlashvars + '&flash_ioerror='+encodeURIComponent(flash_ioerror);
	myFlashvars = myFlashvars + '&flash_ioerror_head='+encodeURIComponent(flash_ioerror_head);
	myFlashvars = myFlashvars + '&flash_complete_msg='+encodeURIComponent(flash_complete_msg);
	myFlashvars = myFlashvars + '&flash_upload_batch='+encodeURIComponent(flash_upload_batch);
	myFlashvars = myFlashvars + '&flash_upload_single='+encodeURIComponent(flash_upload_single);
	//optional parameters to set the flash upload indicator style - the bar color and the text color
	// you can also send a flash haloTheme param as the barTextColor
	myFlashvars = myFlashvars + '&barTextColor='+this.textColor;
	myFlashvars = myFlashvars + '&singleBarColor='+this.barColor;
	myFlashvars = myFlashvars + '&borderColor='+this.borderColor;

	tag.setFlashvars(myFlashvars);
	tag.setHTMLContent(current_upload_div);
	tNG_cleanup();
	this.hideContainer(this.domElementId);
}

tNG_FlashUpload.prototype.hideContainer = function(el) {
	if (el) {
		element = el;
	} else {
		element = this.domElementId;
	}
	
	var elID = document.getElementById(element);
	elID.style.display = '';
	elID.style.width = "1px";
	elID.style.height = "1px";
}

tNG_FlashUpload.prototype.resizeContainer = function(el,w,h) {
	if (el) {
		element = el;
	} else {
		element = this.domElementId;
	}
	
	if (w) {
		w = w;
	} else {
		w = this.containerWidth;
	}
	
	if (h) {
		h = h;
	} else {
		h = this.containerHeight;
	}
	
	var elID = document.getElementById(element);
	elID.style.display = '';
	elID.style.width = w+"px";
	elID.style.height = h+"px";
}

tNG_FlashUpload.prototype.onResizeEvent = function(borderColor) {
	var width = -1;
	var height = -1;
	var mode = document.compatMode;

	if (mode || is.ie) { // (IE, Gecko, Opera)
		switch (mode) {
		case 'CSS1Compat': // Standards mode 
			width = document.documentElement.clientWidth;
			height = document.documentElement.clientHeight;
			var scrollTop = document.documentElement.scrollTop;
			break;
		default: // Quirks
			width = document.body.clientWidth;
			height = document.body.clientHeight;
			var scrollTop = document.body.scrollTop;
		}
	} else { // Safari
		width = self.innerWidth;
		height = self.innerHeight;
		var scrollTop = document.body.scrollTop;
	}

	current_upload_div.style.display = "block";
	current_upload_div.style.width = '400px';
	current_upload_div.style.height = '180px';
	current_upload_div.style.left=(width-400)/2 + "px";
	current_upload_div.style.top=(scrollTop + (height-200)/2) + "px";
	current_upload_div.style.borderStyle = "solid";
	current_upload_div.style.borderWidth = "10px";
	current_upload_div.style.borderColor = borderColor;
	utility.window.blockInterface();
}

tNG_FlashUpload.prototype.onCompleteEvent = function(err) {
	if (typeof err != 'undefined') {
		alert(decodeURI(err));
	}
	tNG_cleanup(true);

	if (typeof $ctrl != 'undefined') {
			if(current_upload_div) {
				setTimeout(function() {
				current_upload_div.parentNode.removeChild(current_upload_div);
					current_upload_div = {};
				}, 100);
			}
		utility.window.unblockInterface();
		KT_self_url = KT_self_url.replace(/&KT_ajax_request=true/, '');
		KT_self_url = KT_self_url.replace(/\?KT_ajax_request=true$/, '');
		KT_self_url = KT_self_url.replace(/\?KT_ajax_request=true&/, '?');
		$ctrl.loadPanels(KT_self_url);
	} else {
			window.location.href = KT_self_url;
	}
}

tNG_FlashUpload.prototype.onCancelEvent = function() {
	tNG_cleanup(true);
	if(current_upload_div) {
		setTimeout(function() {
			current_upload_div.parentNode.removeChild(current_upload_div);
			current_upload_div = {};
		}, 100);
	}
  utility.window.unblockInterface();
}


tNG_FlashUpload.prototype.onStartEvent = function(err) {
	utility.window.blockInterface();
}

tNG_FlashUpload.prototype.onUnblockEvent = function(err) {
	utility.window.unblockInterface();
}
	
/* ---- detection functions ---- */
getPlayerVersion = function(){
	var PlayerVersions = new PlayerVersion(0,0,0);
	if(navigator.plugins && navigator.mimeTypes.length){
		var x = navigator.plugins["Shockwave Flash"];
		if(x && x.description) {
			PlayerVersions = new PlayerVersion(x.description.replace(/([a-z]|[A-Z]|\s)+/, "").replace(/(\s+r|\s+b[0-9]+)/, ".").split("."));
		}
	} else if (window.ActiveXObject){
	   try {
   	   var axo = new ActiveXObject("ShockwaveFlash.ShockwaveFlash");
   		PlayerVersions = new PlayerVersion(axo.GetVariable("$version").split(" ")[1].split(","));
	   } catch (e) {}
	}
	return PlayerVersions;
};

PlayerVersion = function(arrVersion){
	this.major = parseInt(arrVersion[0]) || 0;
	this.minor = parseInt(arrVersion[1]) || 0;
	this.rev = parseInt(arrVersion[2]) || 0;
};

PlayerVersion.prototype.versionIsValid = function(fv){
	if(this.major < fv.major) return false;
	if(this.major > fv.major) return true;
	if(this.minor < fv.minor) return false;
	if(this.minor > fv.minor) return true;
	if(this.rev < fv.rev) return false;
	return true;
};

function tNG_initFileUpload(protocol) {
	document.getElementById('simple_upload').style.display = 'none';
	document.getElementById('multiple_upload').style.display = '';
	var version = getPlayerVersion(); 
	if ((version.major >= 8) && protocol == "http") {
		document.getElementById('simple_upload').style.display = 'none';
		document.getElementById('multiple_upload').style.display = '';
	} else {
		document.getElementById('multiple_upload').style.display = 'none';
		document.getElementById('simple_upload').style.display = '';
	}
}

function tNG_showIndicator() {
	var width = -1;
	var height = -1;
	var mode = document.compatMode;

	if (mode || is.ie) { // (IE, Gecko, Opera)
		switch (mode) {
		case 'CSS1Compat': // Standards mode 
			width = document.documentElement.clientWidth;
			height = document.documentElement.clientHeight;
			var scrollTop = document.documentElement.scrollTop;
			break;
		default: // Quirks
			width = document.body.clientWidth;
			height = document.body.clientHeight;
			var scrollTop = document.body.scrollTop;
		}
	} else { // Safari
		width = self.innerWidth;
		height = self.innerHeight;
		var scrollTop = document.body.scrollTop;
	}

	document.getElementById("singleUpload").style.display="none";
	document.getElementById("singleIndicator").style.display="";
	document.getElementById("singleIndicator").style.position="absolute";
	document.getElementById("singleIndicator").style.left=(width-243)/2 + "px";
	document.getElementById("singleIndicator").style.top=(scrollTop + (height-78)/2) + "px";
	        try {
          setTimeout(function() {
            var src = document.getElementById("pbar");
            var img = new Image();
            img.src = src.src;
            src.parentNode.replaceChild(img,src);
          },200);
        } 
        catch(err) {}

        utility.window.blockInterface();
}
	
function tNG_cleanup(doit) {
	externalProbSet = false;
	__flash_unloadHandler = function(){
		if (externalProbSet) {return};
		externalProbSet = true;
		   obj = document.getElementById("requredid");
		   if (obj) {
			var theObj = eval(obj);
			theObj.style.display = "none";
			for (var prop in theObj){
				if (typeof(theObj[prop]) == "function"){
					theObj[prop]=null;
				}
			}
			}

		if (__flash_savedUnloadHandler != null){
			__flash_savedUnloadHandler();
		}
	}
	if (typeof doit != 'undefined' && doit) {
		__flash_unloadHandler();
	}
	if (window.onunload != __flash_unloadHandler){
		__flash_savedUnloadHandler = window.onunload;
		window.onunload = __flash_unloadHandler;
	}
}