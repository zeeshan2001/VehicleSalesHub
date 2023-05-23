var bu_fixed=[];function bu_fixing(name){bu_fixed[bu_fixed.length]=name;};if(!Function.prototype.apply){bu_fixing('Function.apply');Function.prototype.apply=function(o,a){var r;if(!o){o={};}o.___apply=this;switch((a && a.length)|| 0){case 0: r=o.___apply();break;case 1: r=o.___apply(a[0]);break;case 2: r=o.___apply(a[0],a[1]);break;case 3: r=o.___apply(a[0],a[1],a[2]);break;case 4: r=o.___apply(a[0],a[1],a[2],a[3]);break;case 5: r=o.___apply(a[0],a[1],a[2],a[3],a[4]);break;case 6: r=o.___apply(a[0],a[1],a[2],a[3],a[4],a[5]);break;default: for(var i=0, s="";i<a.length;i++){if(i!=0){s +=",";};s +="a[" + i +"]";};r=eval("o.___apply(" + s + ")");};o.__apply=null;return r;};};if(!Function.prototype.call){bu_fixing('Function.call');Function.prototype.call=function(o){var args=new Array(arguments.length - 1);for(var i=1;i<arguments.length;i++){args[i - 1]=arguments[i];};return this.apply(o, args);};};if(!Array.prototype.push){bu_fixing('Array.push');Array.prototype.push=function(){for(var i=0;i < arguments.length;i++){this[this.length]=arguments[i];};return this.length;};};if(!Array.prototype.pop){bu_fixing('Array.pop');Array.prototype.pop=function(){if(this.length==0){try{return undefined;}catch(e){return null;};};return this[this.length--];};};if(!Array.prototype.shift){bu_fixing('Array.shift');Array.prototype.shift=function(){this.reverse();var lastv=this.pop();this.reverse();return lastv;};};if(!Array.prototype.splice){bu_fixing('Array.splice');Array.prototype.splice=function(start, deleteCount){var len=parseInt(this.length);start=start ? parseInt(start): 0;start=(start < 0)? Math.max(start+len,0): Math.min(len,start);deleteCount=deleteCount ? parseInt(deleteCount): 0;deleteCount=Math.min(Math.max(parseInt(deleteCount),0), len);var deleted=this.slice(start, start+deleteCount);var insertCount=Math.max(arguments.length - 2,0);var new_len=this.length + insertCount - deleteCount;var start_slide=start + insertCount;var nslide=len - start_slide;for(var i=new_len - 1;i>=start_slide;--i){this[i]=this[i - nslide];};for(i=start;i<start+insertCount;++i){this[i]=arguments[i-start+2];};return deleted;};};if(!Array.prototype.unshift){bu_fixing('Array.unshift');Array.prototype.unshift=function(){var a=[0,0];for(var i=0;i<arguments.length;i++){a.push(arguments[i]);};var ret=this.splice.apply(a);return this.length;};};var bu_jscript_version=null;if(typeof ScriptEngineMajorVersion=='function'){bu_jscript_version=parseFloat(ScriptEngineMajorVersion()+ '.' + ScriptEngineMinorVersion());};if((typeof Error=='undefined')||(bu_jscript_version&&(bu_jscript_version < 5.5))){bu_fixing('Error');Error=function(msg){if(!(typeof this == "Error")){return new Error(msg);};this.message=msg || '';return this;};Error.prototype=new Object();Error.prototype.name='Error';Error.prototype.toString=function(){return this.name + ': ' + this.message;};};if(typeof bu_loaded !='undefined'){bu_loaded('fix_ecma.js');};try{if(window["__scripts__"]){__scripts__.provide(__config__.corePath+"sigslot_core.js");__scripts__.require(__config__.corePath+"fix_ecma.js");};}catch(e){window=this;};__sig__=new function(){var sestr="please pass the name of the function, not a pointer";this.lock=false;this.squelchSlotExceptions=true;this.timeCalls=((window["__config__"])&&(__config__.profileSigslot))? __config__.profileSigslot : false;this.timingData=[];var anonFuncId=0;this.setAnonFunc=function(funcObj, funcCaller){if(!funcCaller){funcCaller=window;};var fn="NWanonFunc"+anonFuncId++;if(!funcCaller[fn]){funcCaller[fn]=funcObj;return fn;}else{return this.setAnonFunc(funcObj, funcCaller);};};this.connectByName=function(obj, funcName, trigObj, trigFuncName, onceOnly, defaultArgs, overRideArgs, mutators, finalMutator){if(!obj){obj=window;};if(!trigObj){trigObj=window;};this.addBareSignalByName(trigObj, trigFuncName);var subs=this.addBareSignalByName(obj, funcName);if(onceOnly){for(var i=subs.length-1;i>=0;i=i-1){if((subs[i][0]===trigObj)&&(subs[i][1]==trigFuncName)){return false;};};};subs.push([trigObj, trigFuncName, defaultArgs, overRideArgs, mutators, finalMutator]);return true;};this.connectOnceByName=function(o,f,to,tf){return this.connectByName(o,f,to,tf,true);};this.disconnectOnceByName=function(o,f,to,tf){return this.disconnectAllByName(o,f,to,tf,true);};this.disconnectAllByName=function(obj, funcName, trigObj, trigFuncName, onceOnly){if(!obj){obj=window;}var subs=obj[funcName + '__subscribers__'];if(!subs){return 0;}if(!trigObj){trigObj=window;}var count=0;for(var i=subs.length-1;i>=0;i=i-1){if((subs[i][0]===trigObj)&&(subs[i][1]==trigFuncName)){subs.splice(i, 1);count++;if(onceOnly){break;};};};return count;};this.addBareSignalByName=function(obj, funcName){if(!obj){obj=window;};var subname=funcName + '__subscribers__';var subs=typeof obj[subname]=='undefined' ? null : obj[subname];if(subs){return subs;};var origname=funcName + '__orig__';obj[origname]=obj[funcName] || function(){return true;};subs=obj[subname]=[];obj[funcName]=function(){if(__sig__.timeCalls){if(!__sig__.timingData[funcName]){__sig__.timingData[funcName]=[];};var sl=__sig__.timingData[funcName].length;__sig__.timingData[funcName].push([new Date()]);};if((!obj)||(!obj[origname])){return;};var ret=obj[origname].apply(obj, arguments);if(__sig__.timeCalls){__sig__.timingData[funcName][sl].push(new Date());};if(__sig__.lock){return ret;};for(var i=0;i<subs.length;++i){var na=[];var trigObj=subs[i][0];var das=subs[i][2];var oas=subs[i][3];var mas=subs[i][4];var fmas=subs[i][5];if(das||oas||mas){var tl=Math.max(das.length, oas.length, mas.length, arguments.length);for(var j=0;j<tl;j++){if(((typeof na[j]=="undefined")&&(das[j]))||(oas[j])){na[j]=oas[j]||das[j];}else{na[j]=arguments[j];};if(mas[j]){na[j]=mas[j](na[j], na);};};if(das.length>na.length){na.length=das.length;};}else if(fmas){for(var x=0;x<arguments.length;x++){na.push(arguments[x]);};}else{na=arguments;};if(fmas){na=fmas(na);};try{trigObj[subs[i][1]].apply(trigObj, na);}catch(e){if(!__sig__.squelchSlotExceptions){throw e;};if(window["__log__"]){__log__.exception(subs[i][1], e, true);};};};if(__sig__.timeCalls){__sig__.timingData[funcName][sl].push(new Date());};return ret;};var lcfn=funcName.toLowerCase();if((window["__env__"])&&(lcfn.slice(0, 2)=="on")&&(lcfn.slice(0,8)!="onunload")){NW_attachEvent_list.push([obj, funcName, obj[funcName]]);NW_expando_list.push([obj, origname, obj[origname]]);NW_expando_props_obj.add(origname);NW_expando_props_obj.add(funcName);};return subs;};this.addBareSigByName=this.addBareSignalByName;this.disconnectByName=this.disconnectAllByName;this.disconnect=function(obj, funcName, trigObj, trigFuncName){if((typeof funcName !="string")||(typeof trigFuncName !="string")){throw new Error(sestr);};return this.disconnectByName(obj, funcName, trigObj, trigFuncName, false);};this.disconnectAll=this.disconnect;this.connect=function(obj, funcName, trigObj, trigFuncName, defaultArgs, overRideArgs, mutators, finalMutator){if(arguments.length<4){if(arguments.length==2){if(typeof funcName=="function"){trigObj=window;trigFuncName=this.setAnonFunc(funcName);}else if(typeof funcName=="string"){trigObj=window;trigFuncName=funcName;}else{throw new Error("invalid arguments");};if(typeof obj=="function"){funcName=this.setAnonFunc(obj);obj=window;}else if(typeof obj=="string"){funcName=obj;obj=window;}else{throw new Error("invalid arguments");};}else if(arguments.length==3){if(typeof arguments[1]=="string"){if(typeof trigObj=="function"){trigFuncName=this.setAnonFunc(trigObj);}else{trigFuncName=String(trigObj);};trigObj=window;}else{trigFuncName=String(trigObj);trigObj=funcName;if(typeof obj=="function"){funcName=this.setAnonFunc(obj);}else{funcName=String(obj);};obj=window;};}else if(arguments.length==1){return this.kwConnect(arguments[0]);};}else if((typeof funcName !="string")||(typeof trigFuncName !="string")){throw new Error(sestr);};return this.connectByName(obj, funcName, trigObj, trigFuncName, false, defaultArgs, overRideArgs, mutators, finalMutator);};this.kwConnect=function(ka){return this.connectByName((ka["signalObj"]||ka["signalObject"]||window), ka.signalName,(ka["slotObj"]||ka["slotObject"]||window), ka.slotName, ka["once"], ka["defaults"], ka["overRides"], ka["mutators"],(ka["finalMutator"]||ka["mutator"]));};};try{if(window["__scripts__"]){__scripts__.finalize(__config__.corePath+"sigslot_core.js");};}catch(e){};
