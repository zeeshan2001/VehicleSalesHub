function show_as_buttons_func(){var t=!1;return"undefined"!=typeof $NXT_LIST_SETTINGS&&void 0!==$NXT_LIST_SETTINGS.show_as_buttons&&0!=$NXT_LIST_SETTINGS.show_as_buttons&&(t=!0),"undefined"!=typeof $NAV_SETTINGS&&void 0!==$NAV_SETTINGS.show_as_buttons&&0!=$NAV_SETTINGS.show_as_buttons&&(t=!0),t}function KT_style_replace_with_button(t,e){void 0===e&&(e=!1);var s=utility.dom.createElement("input",{type:"button",value:t.innerHTML});if(t.style.display="none",s=utility.dom.insertAfter(s,t),e){var a=t.onclick;s.onclick=a}return s.style.visibility=t.style.visibility,""==t.innerHTML&&(s.style.display="none"),s}function KT_style_modify_custom_links(t){var e=utility.dom.getClassNames(t);Array_indexOf(e,"KT_link")<0||(KT_style_replace_with_button(t).onclick=function(t){var e=this.previousSibling;if(e.onclick){e.onclick;e.onclick()}else{var s=utility.dom.getLink(e),a=s.toString().split("?");1==a.length&&(a[1]="");var n=new QueryString(a[1]),l=(a[0],[]);Array_each(n.keys,function(t,e){Array_push(l,[t,n.values[e]])});var i=utility.dom.createElement("FORM",{action:s,method:"GET",style:"display: none"});Array_each(l,function(t,e){i.appendChild(utility.dom.createElement("INPUT",{type:"hidden",id:t[0],name:t[0],value:t[1]}))}),(i=document.body.appendChild(i)).submit()}})}show_as_buttons="show_as_buttons_func()",not_show_as_buttons="!"+show_as_buttons;var tng_mtm_detail_key_re=/^mtm_(\d+)$/;function tng_form_enable_details(t){var e=document.getElementById(t),s=!e.checked,a=t.match(tng_mtm_detail_key_re),n=new RegExp("^mtm_(.+?)_"+a[1]+"$","");Array_each(e.form.elements,function(t){var e=t.name;if(e&&n.test(e))if(void 0===t.widget_id)t.disabled!=s&&(t.disabled=s);else try{window[t.widget_type][t.widget_id].setEnabled(!s)}catch(t){}})}function nxt_style_set_globals(){$lists=[];for(var t=utility.dom.getElementsByClassName(document,"KT_tng","div"),e=0;e<t.length;e++){var s={};if(!t[e].getAttribute("kt_styles_attached")&&(s.kt_styles_attached=!1,s.name=t[e].id,s.main=t[e],s.inner=utility.dom.getElementsByClassName(t[e],"KT_tnglist","div"),"object"==typeof s.inner&&null!=s.inner&&s.inner.length&&s.inner.length>0)){s.inner=s.inner[0],is.mozilla&&utility.dom.classNameAdd(s.inner,"fix_content_enlarge");for(var a=s.inner.getElementsByTagName("form")[0],n=0;n<a.childNodes.length;n++)if(1==a.childNodes[n].nodeType){var l=a.childNodes[n],i=l.tagName.toLowerCase(),o=l.className;if("table"==i&&(s.table=l),/KT_topbuttons/.test(o)&&(s.topbuttons=l),/KT_bottombuttons/.test(o)&&(s.bottombuttons=l),/KT_topnav/.test(o)){s.topnav=l;for(var r=s.topnav.getElementsByTagName("div"),_=0;_<r.length;_++)if(/KT_textnav/.test(r[_].className)){s.toptextnav=r[_];break}}if(/KT_bottomnav/.test(o)){s.bottomnav=l;for(r=s.bottomnav.getElementsByTagName("div"),_=0;_<r.length;_++)if(/KT_textnav/.test(r[_].className)){s.bottomtextnav=r[_];break}}}$lists.push(s)}}}function nxt_style_attach(){is.ie&&is.mac||(styles_arr=[],nxt_style_set_globals(),nxt_perform_transformations=function(){Array_each($TRANSFORMATIONS,function(t){var obj={};if(obj.selector=t,obj.start=new Date,eval(t.eval)){var sel=t.selector;if("function"==typeof sel)var arr=sel();else var arr=utility.dom.getElementsBySelector(t.selector);Array_each(arr,t.transform)}obj.end=new Date,obj.diff=obj.end-obj.start,styles_arr.push(obj)});for(var i=0;i<$lists.length;i++)$lists[i].kt_styles_attached=!0,$lists[i].main.setAttribute("kt_styles_attached",!0);KT_style_executed=!0,$style_executed=!0,"undefined"!=typeof nxt_list_attach&&nxt_list_attach()},nxt_perform_transformations())}$TRANSFORMATIONS=[{selector:function(){for(var t=[],e=0;e<$lists.length;e++)if(!$lists[e].kt_styles_attached){for(var s=$lists[e].bottombuttons.getElementsByTagName("a"),a=0;a<s.length;a++)/(KT_edit_op_link|KT_delete_op_link|KT_additem_op_link)/.test(s[a].className)&&t.push(s[a]);if($lists[e].topbuttons)for(s=$lists[e].topbuttons.getElementsByTagName("a"),a=0;a<s.length;a++)/(KT_edit_op_link|KT_delete_op_link|KT_additem_op_link)/.test(s[a].className)&&t.push(s[a])}return t},transform:function(t){KT_style_replace_with_button(t,!0)},eval:show_as_buttons},{selector:function(){for(var t=[],e=0;e<$lists.length;e++)if(!$lists[e].kt_styles_attached)for(var s=$lists[e].table.getElementsByTagName("th"),a=0;a<s.length;a++)if(/KT_sorter/.test(s[e].className))for(var n=s[e].getElementsByTagName("a"),l=0;l<n.length;l++)if(/KT_move_op_link/.test(n[l].className)){t.push(n[l]);break}return t},transform:function(t){KT_style_replace_with_button(t,!0).style.display="none"},eval:show_as_buttons},{selector:function(){for(var t=[],e=0;e<$lists.length;e++)if(!$lists[e].kt_styles_attached)for(var s=$lists[e].table.getElementsByTagName("a"),a=0;a<s.length;a++)/(KT_edit_link|KT_moveup_link|KT_movedown_link|KT_delete_link|KT_link)/.test(s[a].className)&&t.push(s[a]);return t},transform:function(t){var e=KT_style_replace_with_button(t);e.onclick=function(t){var e=this.previousSibling;if(/(KT_movedown_link|KT_moveup_link|KT_delete_link)/.test(e.className)){e.onclick;try{e.onclick(t)}catch(t){}}else if(/(KT_link)/.test(e.className))if(e.onclick){e.onclick;e.onclick()}else{var s=utility.dom.getLink(e),a=s.toString().split("?");1==a.length&&(a[1]="");var n=new QueryString(a[1]),l=(a[0],[]);Array_each(n.keys,function(t,e){Array_push(l,[t,n.values[e]])});var i=utility.dom.createElement("FORM",{action:s,method:"GET",style:"display: none"});Array_each(l,function(t,e){i.appendChild(utility.dom.createElement("INPUT",{type:"hidden",id:t[0],name:t[0],value:t[1]}))}),i=document.body.appendChild(i),"function"==typeof PanelForm_overrideSubmit&&(i.submit=PanelForm_overrideSubmit),i.submit()}else if(/(KT_edit_link)/.test(e.className))try{utility.dom.setEventVars(t);var o=utility.dom.getParentByTagName(this,"table"),r=utility.dom.getParentByTagName(this,"tr"),_=utility.dom.getElementsByClassName(r,"id_checkbox")[0],m=null;_.type&&"checkbox"==_.type.toLowerCase()&&_.name.toString().match(/^kt_pk/)&&(m=_);var d=utility.dom.getElementsByClassName(o,"id_checkbox");Array_each(d,function(t){t.type&&"checkbox"==t.type.toLowerCase()&&t.name.toString().match(/^kt_pk/)&&(t.checked=t==m)}),nxt_list_edit_link_form(this)}catch(t){window.location.href=e.href}else window.location.href=e.href};var s=/KT_moveup_link/.test(t.className),a=/KT_movedown_link/.test(t.className);s||a?((s&&"undefined"!=typeof $nxt_move_up_background_image||a&&"undefined"!=typeof $nxt_move_down_background_image)&&(e.value=""),e.className="button_smallest KT_button_move_"+(s?"up":"down")):e.className="button_big"},eval:show_as_buttons},{selector:function(){var t=[];if("undefined"!=typeof $ctrl)for(var e=0;e<$lists.length;e++)if(!$lists[e].kt_styles_attached)for(var s=utility.dom.getElementsByClassName($lists[e].inner,"KT_masterlink","TR"),a=0;a<s.length;a++)for(var n=s[a].getElementsByTagName("A"),l=0;l<n.length;l++)-1!=n[l].href.indexOf("includes/nxt/back.php")&&t.push(n[l]);return t},transform:function(t){t.onclick=function(){return $ctrl.loadPanels(t.href),!1}},eval:1},{selector:function(){for(var t=[],e=0;e<$lists.length;e++)if(!$lists[e].kt_styles_attached){for(var s=$lists[e].bottombuttons.getElementsByTagName("a"),a=0;a<s.length;a++)/KT_link/.test(s[a].className)&&t.push(s[a]);if($lists[e].topbuttons)for(s=$lists[e].topbuttons.getElementsByTagName("a"),a=0;a<s.length;a++)/KT_link/.test(s[a].className)&&t.push(s[a])}return t},transform:KT_style_modify_custom_links,eval:show_as_buttons},{selector:function(){var t=[];if($lists.length>0){for(var e=0;e<$lists.length;e++)if(!$lists[e].kt_styles_attached){if($lists[e].toptextnav)for(var s=$lists[e].toptextnav.getElementsByTagName("a"),a=0;a<s.length;a++)/(first|prev|next|last)/.test(s[a].parentNode.className)&&t.push(s[a]);if(!$lists[e].bottomtextnav.getAttribute("kt_styles_attached")){$lists[e].bottomtextnav.setAttribute("kt_styles_attached",!0);for(s=$lists[e].bottomtextnav.getElementsByTagName("a"),a=0;a<s.length;a++)/(first|prev|next|last)/.test(s[a].parentNode.className)&&t.push(s[a])}}}else{var n=utility.dom.getElementsByClassName(document,"KT_textnav","div");if(n)for(e=0;e<n.length;e++)if(!n[e].getAttribute("kt_styles_attached")){n[e].setAttribute("kt_styles_attached",!0);for(s=n[e].getElementsByTagName("a"),a=0;a<s.length;a++)/(first|prev|next|last)/.test(s[a].parentNode.className)&&t.push(s[a])}}return t},transform:function(t){var e=t.parentNode,s=KT_style_replace_with_button(t);if(t.href.match(/void\(0\)/)){var a=t.parentNode.getElementsByTagName("input");a.length>0&&(a[0].disabled=!0)}else s.onclick=function(e){"undefined"!=typeof $ctrl?$ctrl.loadPanels(t.href):window.location.href=t.href};s.value={first:"<<",prev:"<",next:">",last:">>"}[e.className.toString().replace(/ disabled/,"")],s.className="button_smallest"+(t.href.match(/void\(0\)/)?" disabled":"")},eval:show_as_buttons},{selector:function(){var t=[];if($lists.length>0){for(var e=0;e<$lists.length;e++)if(!$lists[e].kt_styles_attached){if($lists[e].toptextnav)for(var s=$lists[e].toptextnav.getElementsByTagName("a"),a=0;a<s.length;a++)/(first|prev|next|last)/.test(s[a].parentNode.className)&&t.push(s[a]);for(s=$lists[e].bottomtextnav.getElementsByTagName("a"),a=0;a<s.length;a++)/(first|prev|next|last)/.test(s[a].parentNode.className)&&t.push(s[a])}}else{var n=utility.dom.getElementsByClassName(document,"KT_textnav","div");if(n)for(e=0;e<n.length;e++)if(!n[e].getAttribute("kt_styles_attached")){n[e].setAttribute("kt_styles_attached",!0);for(s=n[e].getElementsByTagName("a"),a=0;a<s.length;a++)/(first|prev|next|last)/.test(s[a].parentNode.className)&&t.push(s[a])}}return t},transform:function(t){t.href.match(/void\(0\)/)&&utility.dom.classNameAdd(t,"disabled")},eval:not_show_as_buttons},{selector:function(){var t,e=[];if((t=document.getElementById("KT_tngdeverror"))&&!t.getAttribute("kt_styles_attached")){t.setAttribute("kt_styles_attached",!0);for(var s=t.getElementsByTagName("a"),a=0;a<s.length;a++)"javascript:needHelp()"==s[a].href&&(s[a].onclick=function(){needHelp()}),e.push(s[a])}if((t=document.getElementById("KT_tngtrace"))&&!t.getAttribute("kt_styles_attached")){t.setAttribute("kt_styles_attached",!0);for(s=t.getElementsByTagName("a"),a=0;a<s.length;a++)e.push(s[a])}return e},transform:function(t){KT_style_replace_with_button(t,!0)},eval:show_as_buttons},{selector_text:'div.KT_tnglist table.KT_tngtable tr.KT_row_filter input[type="submit"]',selector:function(){for(var t=[],e=0;e<$lists.length;e++)if(!$lists[e].kt_styles_attached)for(var s=$lists[e].table.getElementsByTagName("input"),a=0;a<$lists[e].table.rows.length;a++){var n=$lists[e].table.rows[e];if(/KT_row_filter/.test(n.className)){s=n.getElementsByTagName("input");for(var l="",i=0;i<s.length;i++)null==(l=s[i].getAttribute("type"))&&(l="text"),"submit"==l.toString().toLowerCase&&t.push(s[i])}}return t},transform:function(t){t.className="KT_row_filter_submit_button"},eval:"1"},{selector:function(){for(var t=[],e=0;e<$lists.length;e++)if(!$lists[e].kt_styles_attached)for(var s=$lists[e].main.getElementsByTagName("input"),a="",n=0;n<s.length;n++)null==(a=s[n].getAttribute("type"))&&(a="text"),/(text|widget|password)/i.test(a.toString())&&t.push(s[n]);return t},transform:function(t){utility.dom.classNameAdd(t,"input_text")},eval:"1"},{selector:"table.KT_tngtable",transform:function(t){if(!t.getAttribute("kt_checkboxes_attached")){t.setAttribute("kt_checkboxes_attached",!0);var e=utility.dom.getElementsByTagName(t,"label");Array_each(e,function(t){var e=t.htmlFor.toString().replace(/_\d+$/,""),s=(new RegExp("^"+e+"_\\d+$","g"),document.getElementById(e+"_1"));if(void 0!==s&&null!=s&&s.tagName&&"undefined"!=s.tagName&&("input"!=s.tagName.toLowerCase()||!s.type||"file"!=s.type.toLowerCase())){var a=document.getElementById(t.htmlFor.toString()),n=!0;void 0!==a&&null!=a||(n=!1),n&&void 0!==a.type&&null!=a.type&&"radio"==a.type.toString().toLowerCase()&&(n=!1),n&&tng_mtm_detail_key_re.test(t.htmlFor)&&(a.onclick=function(t){tng_form_enable_details(a.name)},a.checked||tng_form_enable_details(a.name))}})}},eval:"1"},{selector:"div.KT_tngform",transform:function(t){if(!t.getAttribute("kt_styles_attached")&&(t.setAttribute("kt_styles_attached",!0),is.mozilla&&utility.dom.classNameAdd(t,"fix_content_enlarge"),void 0===window.ktmls||!is.mozilla||"undefined"!=typeof ktml_isElementVisible)){multiple_edits=!1;var e=utility.dom.getElementsBySelector("div.KT_tngform table.KT_tngtable");e.length&&e.length>1&&(multiple_edits=!0);var s=!("undefined"==typeof $NXT_FORM_SETTINGS||void 0===$NXT_FORM_SETTINGS.show_as_grid||0==$NXT_FORM_SETTINGS.show_as_grid);if(1==e.length||!s)return!0;multiple_edits=!0;e[0].rows.length;var a=document.createElement("table",{className:"KT_tngtable"});a.className="KT_tngtable";var n=a.insertRow(-1),l=n.insertCell(-1);l.innerHTML=NXT_Messages.Record_FH,l.className="KT_th",Array_each(e[0].rows,function(t){var e=t.getElementsByTagName("label")[0],s=n.insertCell(-1);s.className="KT_th",e?s.appendChild(e):s.innerHTML=t.getElementsByTagName("td")[0].innerHTML});var i=utility.dom.getElementsByClassName(t,"id_field"),o=0;Array_each(e,function(t,e){var s=a.insertRow(-1),n=s.insertCell(-1);n.innerHTML=e+1+"",n.noWrap=!0,n.style.verticalAlign="top",Array_each(t.rows,function(t){var e=s.appendChild(t.getElementsByTagName("td")[1]);e.style.verticalAlign="top";var a=utility.dom.getElementsByClassName(e,"KT_field_hint","span");if(a.length)for(var n=0;n<a.length;n++)a[n].parentNode.removeChild(a[n])});var l=i[o++];l?n.appendChild(l):alert("could not find hidden !")}),Array_each(e,function(t,e){var s=t.previousSibling;try{for(;s.previousSibling&&(3==s.nodeType||"h2"!=s.tagName.toLowerCase());)s=s.previousSibling}catch(t){s=null}s&&s.parentNode.removeChild(s);var a=t.nextSibling;try{for(;a&&3!=a.nodeType&&"input"!=a.tagName.toLowerCase();)a=a.nextSibling}catch(t){a=null}a&&a.parentNode.removeChild(a),t.parentNode.removeChild(t)});var r=utility.dom.getElementsBySelector("div.KT_bottombuttons")[0];r.parentNode.insertBefore(a,r)}},eval:"(true)"}],utility.dom.attachEvent2(window,"onload",nxt_style_attach);