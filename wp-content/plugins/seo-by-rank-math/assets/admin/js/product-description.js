!function(e){var t={};function n(r){if(t[r])return t[r].exports;var i=t[r]={i:r,l:!1,exports:{}};return e[r].call(i.exports,i,i.exports,n),i.l=!0,i.exports}n.m=e,n.c=t,n.d=function(e,t,r){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:r})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var r=Object.create(null);if(n.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var i in e)n.d(r,i,function(t){return e[t]}.bind(null,i));return r},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=71)}({3:function(e,t){e.exports=jQuery},52:function(e,t,n){var r=n(53),i=n(72),o=n(75),c=Math.max,a=Math.min;e.exports=function(e,t,n){var u,s,f,l,p,m,v=0,d=!1,h=!1,y=!0;if("function"!=typeof e)throw new TypeError("Expected a function");function b(t){var n=u,r=s;return u=s=void 0,v=t,l=e.apply(r,n)}function _(e){return v=e,p=setTimeout(g,t),d?b(e):l}function x(e){var n=e-m;return void 0===m||n>=t||n<0||h&&e-v>=f}function g(){var e=i();if(x(e))return w(e);p=setTimeout(g,function(e){var n=t-(e-m);return h?a(n,f-(e-v)):n}(e))}function w(e){return p=void 0,y&&u?b(e):(u=s=void 0,l)}function j(){var e=i(),n=x(e);if(u=arguments,s=this,m=e,n){if(void 0===p)return _(m);if(h)return clearTimeout(p),p=setTimeout(g,t),b(m)}return void 0===p&&(p=setTimeout(g,t)),l}return t=o(t)||0,r(n)&&(d=!!n.leading,f=(h="maxWait"in n)?c(o(n.maxWait)||0,t):f,y="trailing"in n?!!n.trailing:y),j.cancel=function(){void 0!==p&&clearTimeout(p),v=0,u=m=s=p=void 0},j.flush=function(){return void 0===p?l:w(i())},j}},53:function(e,t){e.exports=function(e){var t=typeof e;return null!=e&&("object"==t||"function"==t)}},54:function(e,t,n){var r=n(73),i="object"==typeof self&&self&&self.Object===Object&&self,o=r||i||Function("return this")();e.exports=o},55:function(e,t,n){var r=n(54).Symbol;e.exports=r},6:function(e,t){e.exports=wp.hooks},71:function(e,t,n){"use strict";n.r(t);var r=n(3),i=n.n(r),o=n(52),c=n.n(o),a=n(6),u=n(9);function s(e,t){for(var n=0;n<t.length;n++){var r=t[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}var f=function(){function e(){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e),this.excerpt=i()("#excerpt"),this.elemPrice=i()("#_sale_price"),this.elemRegPrice=i()("#_regular_price"),this.refreshWCPrice=this.refreshWCPrice.bind(this),this.events(),this.hooks()}var t,n,r;return t=e,(n=[{key:"hooks",value:function(){void 0!==this.excerpt&&Object(a.addFilter)("rank_math_content","rank-math",this.getContent.bind(this))}},{key:"getContent",value:function(e){return e+="undefined"!=typeof tinymce&&tinymce.activeEditor&&"excerpt"===tinymce.activeEditor.id?tinymce.activeEditor.getContent():this.excerpt.val()}},{key:"events",value:function(){"undefined"!=typeof tinymce&&tinymce.activeEditor&&void 0!==tinymce.editors.excerpt&&tinymce.editors.excerpt.on("keyup change",c()((function(){rankMathEditor.refresh("content")}),500)),this.debounceWCPrice=c()(this.refreshWCPrice,500),this.elemPrice.on("input",this.debounceWCPrice),this.elemRegPrice.on("input",this.debounceWCPrice)}},{key:"refreshWCPrice",value:function(){u.a.setVariable("wc_price",this.getWooCommerceProductPrice()),Object(a.doAction)("rank_math_update_description_preview")}},{key:"getWooCommerceProductPrice",value:function(){var e=this.elemPrice.val()?this.elemPrice.val():this.elemRegPrice.val();return accounting.formatMoney(e,{symbol:woocommerce_admin_meta_boxes.currency_format_symbol,decimal:woocommerce_admin_meta_boxes.currency_format_decimal_sep,thousand:woocommerce_admin_meta_boxes.currency_format_thousand_sep,precision:woocommerce_admin_meta_boxes.currency_format_num_decimals,format:woocommerce_admin_meta_boxes.currency_format})}}])&&s(t.prototype,n),r&&s(t,r),e}();i()((function(){new f}))},72:function(e,t,n){var r=n(54);e.exports=function(){return r.Date.now()}},73:function(e,t,n){(function(t){var n="object"==typeof t&&t&&t.Object===Object&&t;e.exports=n}).call(this,n(74))},74:function(e,t){var n;n=function(){return this}();try{n=n||new Function("return this")()}catch(e){"object"==typeof window&&(n=window)}e.exports=n},75:function(e,t,n){var r=n(53),i=n(76),o=/^\s+|\s+$/g,c=/^[-+]0x[0-9a-f]+$/i,a=/^0b[01]+$/i,u=/^0o[0-7]+$/i,s=parseInt;e.exports=function(e){if("number"==typeof e)return e;if(i(e))return NaN;if(r(e)){var t="function"==typeof e.valueOf?e.valueOf():e;e=r(t)?t+"":t}if("string"!=typeof e)return 0===e?e:+e;e=e.replace(o,"");var n=a.test(e);return n||u.test(e)?s(e.slice(2),n?2:8):c.test(e)?NaN:+e}},76:function(e,t,n){var r=n(77),i=n(80);e.exports=function(e){return"symbol"==typeof e||i(e)&&"[object Symbol]"==r(e)}},77:function(e,t,n){var r=n(55),i=n(78),o=n(79),c=r?r.toStringTag:void 0;e.exports=function(e){return null==e?void 0===e?"[object Undefined]":"[object Null]":c&&c in Object(e)?i(e):o(e)}},78:function(e,t,n){var r=n(55),i=Object.prototype,o=i.hasOwnProperty,c=i.toString,a=r?r.toStringTag:void 0;e.exports=function(e){var t=o.call(e,a),n=e[a];try{e[a]=void 0;var r=!0}catch(e){}var i=c.call(e);return r&&(t?e[a]=n:delete e[a]),i}},79:function(e,t){var n=Object.prototype.toString;e.exports=function(e){return n.call(e)}},80:function(e,t){e.exports=function(e){return null!=e&&"object"==typeof e}},9:function(e,t,n){"use strict";n.d(t,"a",(function(){return c}));var r=n(3),i=n.n(r);function o(e,t){for(var n=0;n<t.length;n++){var r=t[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}var c=new(function(){function e(){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e),this.map=null}var t,n,r;return t=e,(n=[{key:"swap",value:function(e,t){var n=this;if(!(e=e||""))return"";var r=new RegExp(/%(([a-z0-9_-]+)\(([^)]*)\)|[^\s]+)%/,"giu");return e.replace(" %page%","").replace("%sep% %sep%","%sep%").replace(r,(function(e){return n.replace(t,e)})).trim()}},{key:"replace",value:function(e,t){var n=t.toLowerCase().slice(1,-1);return["term_description","user_description"].includes(n)?i()("#description").val():n.includes("customfield(")?(n=n.replace("customfield(","").replace(")",""))in rankMath.customFields?rankMath.customFields[n]:"":(e=e||this.getMap(),(n="seo_description"===(n="seo_title"===(n=n.includes("(")?n.split("(")[0]:n)?"title":n)?"excerpt":n)in e?e[n]:"")}},{key:"getMap",value:function(){var e=this;return null!==this.map||(this.map={},i.a.each(rankMath.variables,(function(t,n){t=t.toLowerCase().replace(/%+/g,"").split("(")[0],e.map[t]=n.example}))),this.map}},{key:"setVariable",value:function(e,t){null!==this.map?this.map[e]=t:void 0!==rankMath.variables[e]&&(rankMath.variables[e].example=t)}}])&&o(t.prototype,n),r&&o(t,r),e}())}});