!function(t){var e={};function n(o){if(e[o])return e[o].exports;var r=e[o]={i:o,l:!1,exports:{}};return t[o].call(r.exports,r,r.exports,n),r.l=!0,r.exports}n.m=t,n.c=e,n.d=function(t,e,o){n.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:o})},n.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},n.t=function(t,e){if(1&e&&(t=n(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var o=Object.create(null);if(n.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var r in t)n.d(o,r,function(e){return t[e]}.bind(null,r));return o},n.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return n.d(e,"a",e),e},n.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},n.p="/",n(n.s=42)}({1:function(t,e){var n;n=function(){return this}();try{n=n||new Function("return this")()}catch(t){"object"==typeof window&&(n=window)}t.exports=n},42:function(t,e,n){t.exports=n(43)},43:function(t,e,n){"use strict";n.r(e),function(t){var n="undefined"!=typeof window&&"undefined"!=typeof document&&"undefined"!=typeof navigator;const o=function(){const t=["Edge","Trident","Firefox"];for(let e=0;e<t.length;e+=1)if(n&&navigator.userAgent.indexOf(t[e])>=0)return 1;return 0}();var r=n&&window.Promise?function(t){let e=!1;return()=>{e||(e=!0,window.Promise.resolve().then(()=>{e=!1,t()}))}}:function(t){let e=!1;return()=>{e||(e=!0,setTimeout(()=>{e=!1,t()},o))}};function i(t){return t&&"[object Function]"==={}.toString.call(t)}function s(t,e){if(1!==t.nodeType)return[];const n=t.ownerDocument.defaultView.getComputedStyle(t,null);return e?n[e]:n}function f(t){return"HTML"===t.nodeName?t:t.parentNode||t.host}function p(t){if(!t)return document.body;switch(t.nodeName){case"HTML":case"BODY":return t.ownerDocument.body;case"#document":return t.body}const{overflow:e,overflowX:n,overflowY:o}=s(t);return/(auto|scroll|overlay)/.test(e+o+n)?t:p(f(t))}function a(t){return t&&t.referenceNode?t.referenceNode:t}const l=n&&!(!window.MSInputMethodContext||!document.documentMode),c=n&&/MSIE 10/.test(navigator.userAgent);function d(t){return 11===t?l:10===t?c:l||c}function u(t){if(!t)return document.documentElement;const e=d(10)?document.body:null;let n=t.offsetParent||null;for(;n===e&&t.nextElementSibling;)n=(t=t.nextElementSibling).offsetParent;const o=n&&n.nodeName;return o&&"BODY"!==o&&"HTML"!==o?-1!==["TH","TD","TABLE"].indexOf(n.nodeName)&&"static"===s(n,"position")?u(n):n:t?t.ownerDocument.documentElement:document.documentElement}function h(t){return null!==t.parentNode?h(t.parentNode):t}function m(t,e){if(!(t&&t.nodeType&&e&&e.nodeType))return document.documentElement;const n=t.compareDocumentPosition(e)&Node.DOCUMENT_POSITION_FOLLOWING,o=n?t:e,r=n?e:t,i=document.createRange();i.setStart(o,0),i.setEnd(r,0);const{commonAncestorContainer:s}=i;if(t!==s&&e!==s||o.contains(r))return function(t){const{nodeName:e}=t;return"BODY"!==e&&("HTML"===e||u(t.firstElementChild)===t)}(s)?s:u(s);const f=h(t);return f.host?m(f.host,e):m(t,h(e).host)}function g(t,e="top"){const n="top"===e?"scrollTop":"scrollLeft",o=t.nodeName;if("BODY"===o||"HTML"===o){const e=t.ownerDocument.documentElement;return(t.ownerDocument.scrollingElement||e)[n]}return t[n]}function b(t,e){const n="x"===e?"Left":"Top",o="Left"===n?"Right":"Bottom";return parseFloat(t[`border${n}Width`])+parseFloat(t[`border${o}Width`])}function w(t,e,n,o){return Math.max(e["offset"+t],e["scroll"+t],n["client"+t],n["offset"+t],n["scroll"+t],d(10)?parseInt(n["offset"+t])+parseInt(o["margin"+("Height"===t?"Top":"Left")])+parseInt(o["margin"+("Height"===t?"Bottom":"Right")]):0)}function y(t){const e=t.body,n=t.documentElement,o=d(10)&&getComputedStyle(n);return{height:w("Height",e,n,o),width:w("Width",e,n,o)}}var v=Object.assign||function(t){for(var e=1;e<arguments.length;e++){var n=arguments[e];for(var o in n)Object.prototype.hasOwnProperty.call(n,o)&&(t[o]=n[o])}return t};function x(t){return v({},t,{right:t.left+t.width,bottom:t.top+t.height})}function E(t){let e={};try{if(d(10)){e=t.getBoundingClientRect();const n=g(t,"top"),o=g(t,"left");e.top+=n,e.left+=o,e.bottom+=n,e.right+=o}else e=t.getBoundingClientRect()}catch(t){}const n={left:e.left,top:e.top,width:e.right-e.left,height:e.bottom-e.top},o="HTML"===t.nodeName?y(t.ownerDocument):{},r=o.width||t.clientWidth||n.width,i=o.height||t.clientHeight||n.height;let f=t.offsetWidth-r,p=t.offsetHeight-i;if(f||p){const e=s(t);f-=b(e,"x"),p-=b(e,"y"),n.width-=f,n.height-=p}return x(n)}function O(t,e,n=!1){const o=d(10),r="HTML"===e.nodeName,i=E(t),f=E(e),a=p(t),l=s(e),c=parseFloat(l.borderTopWidth),u=parseFloat(l.borderLeftWidth);n&&r&&(f.top=Math.max(f.top,0),f.left=Math.max(f.left,0));let h=x({top:i.top-f.top-c,left:i.left-f.left-u,width:i.width,height:i.height});if(h.marginTop=0,h.marginLeft=0,!o&&r){const t=parseFloat(l.marginTop),e=parseFloat(l.marginLeft);h.top-=c-t,h.bottom-=c-t,h.left-=u-e,h.right-=u-e,h.marginTop=t,h.marginLeft=e}return(o&&!n?e.contains(a):e===a&&"BODY"!==a.nodeName)&&(h=function(t,e,n=!1){const o=g(e,"top"),r=g(e,"left"),i=n?-1:1;return t.top+=o*i,t.bottom+=o*i,t.left+=r*i,t.right+=r*i,t}(h,e)),h}function L(t){if(!t||!t.parentElement||d())return document.documentElement;let e=t.parentElement;for(;e&&"none"===s(e,"transform");)e=e.parentElement;return e||document.documentElement}function M(t,e,n,o,r=!1){let i={top:0,left:0};const l=r?L(t):m(t,a(e));if("viewport"===o)i=function(t,e=!1){const n=t.ownerDocument.documentElement,o=O(t,n),r=Math.max(n.clientWidth,window.innerWidth||0),i=Math.max(n.clientHeight,window.innerHeight||0),s=e?0:g(n),f=e?0:g(n,"left");return x({top:s-o.top+o.marginTop,left:f-o.left+o.marginLeft,width:r,height:i})}(l,r);else{let n;"scrollParent"===o?(n=p(f(e)),"BODY"===n.nodeName&&(n=t.ownerDocument.documentElement)):n="window"===o?t.ownerDocument.documentElement:o;const a=O(n,l,r);if("HTML"!==n.nodeName||function t(e){const n=e.nodeName;if("BODY"===n||"HTML"===n)return!1;if("fixed"===s(e,"position"))return!0;const o=f(e);return!!o&&t(o)}(l))i=a;else{const{height:e,width:n}=y(t.ownerDocument);i.top+=a.top-a.marginTop,i.bottom=e+a.top,i.left+=a.left-a.marginLeft,i.right=n+a.left}}const c="number"==typeof(n=n||0);return i.left+=c?n:n.left||0,i.top+=c?n:n.top||0,i.right-=c?n:n.right||0,i.bottom-=c?n:n.bottom||0,i}function T({width:t,height:e}){return t*e}function D(t,e,n,o,r,i=0){if(-1===t.indexOf("auto"))return t;const s=M(n,o,i,r),f={top:{width:s.width,height:e.top-s.top},right:{width:s.right-e.right,height:s.height},bottom:{width:s.width,height:s.bottom-e.bottom},left:{width:e.left-s.left,height:s.height}},p=Object.keys(f).map(t=>v({key:t},f[t],{area:T(f[t])})).sort((t,e)=>e.area-t.area),a=p.filter(({width:t,height:e})=>t>=n.clientWidth&&e>=n.clientHeight),l=a.length>0?a[0].key:p[0].key,c=t.split("-")[1];return l+(c?"-"+c:"")}function N(t,e,n,o=null){return O(n,o?L(e):m(e,a(n)),o)}function F(t){const e=t.ownerDocument.defaultView.getComputedStyle(t),n=parseFloat(e.marginTop||0)+parseFloat(e.marginBottom||0),o=parseFloat(e.marginLeft||0)+parseFloat(e.marginRight||0);return{width:t.offsetWidth+o,height:t.offsetHeight+n}}function S(t){const e={left:"right",right:"left",bottom:"top",top:"bottom"};return t.replace(/left|right|bottom|top/g,t=>e[t])}function H(t,e,n){n=n.split("-")[0];const o=F(t),r={width:o.width,height:o.height},i=-1!==["right","left"].indexOf(n),s=i?"top":"left",f=i?"left":"top",p=i?"height":"width",a=i?"width":"height";return r[s]=e[s]+e[p]/2-o[p]/2,r[f]=n===f?e[f]-o[a]:e[S(f)],r}function P(t,e){return Array.prototype.find?t.find(e):t.filter(e)[0]}function B(t,e,n){return(void 0===n?t:t.slice(0,function(t,e,n){if(Array.prototype.findIndex)return t.findIndex(t=>t[e]===n);const o=P(t,t=>t[e]===n);return t.indexOf(o)}(t,"name",n))).forEach(t=>{t.function&&console.warn("`modifier.function` is deprecated, use `modifier.fn`!");const n=t.function||t.fn;t.enabled&&i(n)&&(e.offsets.popper=x(e.offsets.popper),e.offsets.reference=x(e.offsets.reference),e=n(e,t))}),e}function C(){if(this.state.isDestroyed)return;let t={instance:this,styles:{},arrowStyles:{},attributes:{},flipped:!1,offsets:{}};t.offsets.reference=N(this.state,this.popper,this.reference,this.options.positionFixed),t.placement=D(this.options.placement,t.offsets.reference,this.popper,this.reference,this.options.modifiers.flip.boundariesElement,this.options.modifiers.flip.padding),t.originalPlacement=t.placement,t.positionFixed=this.options.positionFixed,t.offsets.popper=H(this.popper,t.offsets.reference,t.placement),t.offsets.popper.position=this.options.positionFixed?"fixed":"absolute",t=B(this.modifiers,t),this.state.isCreated?this.options.onUpdate(t):(this.state.isCreated=!0,this.options.onCreate(t))}function A(t,e){return t.some(({name:t,enabled:n})=>n&&t===e)}function W(t){const e=[!1,"ms","Webkit","Moz","O"],n=t.charAt(0).toUpperCase()+t.slice(1);for(let o=0;o<e.length;o++){const r=e[o],i=r?`${r}${n}`:t;if(void 0!==document.body.style[i])return i}return null}function j(){return this.state.isDestroyed=!0,A(this.modifiers,"applyStyle")&&(this.popper.removeAttribute("x-placement"),this.popper.style.position="",this.popper.style.top="",this.popper.style.left="",this.popper.style.right="",this.popper.style.bottom="",this.popper.style.willChange="",this.popper.style[W("transform")]=""),this.disableEventListeners(),this.options.removeOnDestroy&&this.popper.parentNode.removeChild(this.popper),this}function k(t){const e=t.ownerDocument;return e?e.defaultView:window}function $(t,e,n,o){n.updateBound=o,k(t).addEventListener("resize",n.updateBound,{passive:!0});const r=p(t);return function t(e,n,o,r){const i="BODY"===e.nodeName,s=i?e.ownerDocument.defaultView:e;s.addEventListener(n,o,{passive:!0}),i||t(p(s.parentNode),n,o,r),r.push(s)}(r,"scroll",n.updateBound,n.scrollParents),n.scrollElement=r,n.eventsEnabled=!0,n}function I(){this.state.eventsEnabled||(this.state=$(this.reference,this.options,this.state,this.scheduleUpdate))}function R(){var t,e;this.state.eventsEnabled&&(cancelAnimationFrame(this.scheduleUpdate),this.state=(t=this.reference,e=this.state,k(t).removeEventListener("resize",e.updateBound),e.scrollParents.forEach(t=>{t.removeEventListener("scroll",e.updateBound)}),e.updateBound=null,e.scrollParents=[],e.scrollElement=null,e.eventsEnabled=!1,e))}function U(t){return""!==t&&!isNaN(parseFloat(t))&&isFinite(t)}function Y(t,e){Object.keys(e).forEach(n=>{let o="";-1!==["width","height","top","right","bottom","left"].indexOf(n)&&U(e[n])&&(o="px"),t.style[n]=e[n]+o})}const V=n&&/Firefox/i.test(navigator.userAgent);function _(t,e,n){const o=P(t,({name:t})=>t===e),r=!!o&&t.some(t=>t.name===n&&t.enabled&&t.order<o.order);if(!r){const t=`\`${e}\``,o=`\`${n}\``;console.warn(`${o} modifier is required by ${t} modifier in order to work, be sure to include it before ${t}!`)}return r}var q=["auto-start","auto","auto-end","top-start","top","top-end","right-start","right","right-end","bottom-end","bottom","bottom-start","left-end","left","left-start"];const z=q.slice(3);function G(t,e=!1){const n=z.indexOf(t),o=z.slice(n+1).concat(z.slice(0,n));return e?o.reverse():o}const X="flip",J="clockwise",K="counterclockwise";function Q(t,e,n,o){const r=[0,0],i=-1!==["right","left"].indexOf(o),s=t.split(/(\+|\-)/).map(t=>t.trim()),f=s.indexOf(P(s,t=>-1!==t.search(/,|\s/)));s[f]&&-1===s[f].indexOf(",")&&console.warn("Offsets separated by white space(s) are deprecated, use a comma (,) instead.");const p=/\s*,\s*|\s+/;let a=-1!==f?[s.slice(0,f).concat([s[f].split(p)[0]]),[s[f].split(p)[1]].concat(s.slice(f+1))]:[s];return a=a.map((t,o)=>{const r=(1===o?!i:i)?"height":"width";let s=!1;return t.reduce((t,e)=>""===t[t.length-1]&&-1!==["+","-"].indexOf(e)?(t[t.length-1]=e,s=!0,t):s?(t[t.length-1]+=e,s=!1,t):t.concat(e),[]).map(t=>function(t,e,n,o){const r=t.match(/((?:\-|\+)?\d*\.?\d*)(.*)/),i=+r[1],s=r[2];if(!i)return t;if(0===s.indexOf("%")){let t;switch(s){case"%p":t=n;break;case"%":case"%r":default:t=o}return x(t)[e]/100*i}if("vh"===s||"vw"===s){let t;return t="vh"===s?Math.max(document.documentElement.clientHeight,window.innerHeight||0):Math.max(document.documentElement.clientWidth,window.innerWidth||0),t/100*i}return i}(t,r,e,n))}),a.forEach((t,e)=>{t.forEach((n,o)=>{U(n)&&(r[e]+=n*("-"===t[o-1]?-1:1))})}),r}var Z={placement:"bottom",positionFixed:!1,eventsEnabled:!0,removeOnDestroy:!1,onCreate:()=>{},onUpdate:()=>{},modifiers:{shift:{order:100,enabled:!0,fn:function(t){const e=t.placement,n=e.split("-")[0],o=e.split("-")[1];if(o){const{reference:e,popper:r}=t.offsets,i=-1!==["bottom","top"].indexOf(n),s=i?"left":"top",f=i?"width":"height",p={start:{[s]:e[s]},end:{[s]:e[s]+e[f]-r[f]}};t.offsets.popper=v({},r,p[o])}return t}},offset:{order:200,enabled:!0,fn:function(t,{offset:e}){const{placement:n,offsets:{popper:o,reference:r}}=t,i=n.split("-")[0];let s;return s=U(+e)?[+e,0]:Q(e,o,r,i),"left"===i?(o.top+=s[0],o.left-=s[1]):"right"===i?(o.top+=s[0],o.left+=s[1]):"top"===i?(o.left+=s[0],o.top-=s[1]):"bottom"===i&&(o.left+=s[0],o.top+=s[1]),t.popper=o,t},offset:0},preventOverflow:{order:300,enabled:!0,fn:function(t,e){let n=e.boundariesElement||u(t.instance.popper);t.instance.reference===n&&(n=u(n));const o=W("transform"),r=t.instance.popper.style,{top:i,left:s,[o]:f}=r;r.top="",r.left="",r[o]="";const p=M(t.instance.popper,t.instance.reference,e.padding,n,t.positionFixed);r.top=i,r.left=s,r[o]=f,e.boundaries=p;const a=e.priority;let l=t.offsets.popper;const c={primary(t){let n=l[t];return l[t]<p[t]&&!e.escapeWithReference&&(n=Math.max(l[t],p[t])),{[t]:n}},secondary(t){const n="right"===t?"left":"top";let o=l[n];return l[t]>p[t]&&!e.escapeWithReference&&(o=Math.min(l[n],p[t]-("right"===t?l.width:l.height))),{[n]:o}}};return a.forEach(t=>{const e=-1!==["left","top"].indexOf(t)?"primary":"secondary";l=v({},l,c[e](t))}),t.offsets.popper=l,t},priority:["left","right","top","bottom"],padding:5,boundariesElement:"scrollParent"},keepTogether:{order:400,enabled:!0,fn:function(t){const{popper:e,reference:n}=t.offsets,o=t.placement.split("-")[0],r=Math.floor,i=-1!==["top","bottom"].indexOf(o),s=i?"right":"bottom",f=i?"left":"top",p=i?"width":"height";return e[s]<r(n[f])&&(t.offsets.popper[f]=r(n[f])-e[p]),e[f]>r(n[s])&&(t.offsets.popper[f]=r(n[s])),t}},arrow:{order:500,enabled:!0,fn:function(t,e){if(!_(t.instance.modifiers,"arrow","keepTogether"))return t;let n=e.element;if("string"==typeof n){if(n=t.instance.popper.querySelector(n),!n)return t}else if(!t.instance.popper.contains(n))return console.warn("WARNING: `arrow.element` must be child of its popper element!"),t;const o=t.placement.split("-")[0],{popper:r,reference:i}=t.offsets,f=-1!==["left","right"].indexOf(o),p=f?"height":"width",a=f?"Top":"Left",l=a.toLowerCase(),c=f?"left":"top",d=f?"bottom":"right",u=F(n)[p];i[d]-u<r[l]&&(t.offsets.popper[l]-=r[l]-(i[d]-u)),i[l]+u>r[d]&&(t.offsets.popper[l]+=i[l]+u-r[d]),t.offsets.popper=x(t.offsets.popper);const h=i[l]+i[p]/2-u/2,m=s(t.instance.popper),g=parseFloat(m["margin"+a]),b=parseFloat(m[`border${a}Width`]);let w=h-t.offsets.popper[l]-g-b;return w=Math.max(Math.min(r[p]-u,w),0),t.arrowElement=n,t.offsets.arrow={[l]:Math.round(w),[c]:""},t},element:"[x-arrow]"},flip:{order:600,enabled:!0,fn:function(t,e){if(A(t.instance.modifiers,"inner"))return t;if(t.flipped&&t.placement===t.originalPlacement)return t;const n=M(t.instance.popper,t.instance.reference,e.padding,e.boundariesElement,t.positionFixed);let o=t.placement.split("-")[0],r=S(o),i=t.placement.split("-")[1]||"",s=[];switch(e.behavior){case X:s=[o,r];break;case J:s=G(o);break;case K:s=G(o,!0);break;default:s=e.behavior}return s.forEach((f,p)=>{if(o!==f||s.length===p+1)return t;o=t.placement.split("-")[0],r=S(o);const a=t.offsets.popper,l=t.offsets.reference,c=Math.floor,d="left"===o&&c(a.right)>c(l.left)||"right"===o&&c(a.left)<c(l.right)||"top"===o&&c(a.bottom)>c(l.top)||"bottom"===o&&c(a.top)<c(l.bottom),u=c(a.left)<c(n.left),h=c(a.right)>c(n.right),m=c(a.top)<c(n.top),g=c(a.bottom)>c(n.bottom),b="left"===o&&u||"right"===o&&h||"top"===o&&m||"bottom"===o&&g,w=-1!==["top","bottom"].indexOf(o),y=!!e.flipVariations&&(w&&"start"===i&&u||w&&"end"===i&&h||!w&&"start"===i&&m||!w&&"end"===i&&g),x=!!e.flipVariationsByContent&&(w&&"start"===i&&h||w&&"end"===i&&u||!w&&"start"===i&&g||!w&&"end"===i&&m),E=y||x;(d||b||E)&&(t.flipped=!0,(d||b)&&(o=s[p+1]),E&&(i=function(t){return"end"===t?"start":"start"===t?"end":t}(i)),t.placement=o+(i?"-"+i:""),t.offsets.popper=v({},t.offsets.popper,H(t.instance.popper,t.offsets.reference,t.placement)),t=B(t.instance.modifiers,t,"flip"))}),t},behavior:"flip",padding:5,boundariesElement:"viewport",flipVariations:!1,flipVariationsByContent:!1},inner:{order:700,enabled:!1,fn:function(t){const e=t.placement,n=e.split("-")[0],{popper:o,reference:r}=t.offsets,i=-1!==["left","right"].indexOf(n),s=-1===["top","left"].indexOf(n);return o[i?"left":"top"]=r[n]-(s?o[i?"width":"height"]:0),t.placement=S(e),t.offsets.popper=x(o),t}},hide:{order:800,enabled:!0,fn:function(t){if(!_(t.instance.modifiers,"hide","preventOverflow"))return t;const e=t.offsets.reference,n=P(t.instance.modifiers,t=>"preventOverflow"===t.name).boundaries;if(e.bottom<n.top||e.left>n.right||e.top>n.bottom||e.right<n.left){if(!0===t.hide)return t;t.hide=!0,t.attributes["x-out-of-boundaries"]=""}else{if(!1===t.hide)return t;t.hide=!1,t.attributes["x-out-of-boundaries"]=!1}return t}},computeStyle:{order:850,enabled:!0,fn:function(t,e){const{x:n,y:o}=e,{popper:r}=t.offsets,i=P(t.instance.modifiers,t=>"applyStyle"===t.name).gpuAcceleration;void 0!==i&&console.warn("WARNING: `gpuAcceleration` option moved to `computeStyle` modifier and will not be supported in future versions of Popper.js!");const s=void 0!==i?i:e.gpuAcceleration,f=u(t.instance.popper),p=E(f),a={position:r.position},l=function(t,e){const{popper:n,reference:o}=t.offsets,{round:r,floor:i}=Math,s=t=>t,f=r(o.width),p=r(n.width),a=-1!==["left","right"].indexOf(t.placement),l=-1!==t.placement.indexOf("-"),c=e?a||l||f%2==p%2?r:i:s,d=e?r:s;return{left:c(f%2==1&&p%2==1&&!l&&e?n.left-1:n.left),top:d(n.top),bottom:d(n.bottom),right:c(n.right)}}(t,window.devicePixelRatio<2||!V),c="bottom"===n?"top":"bottom",d="right"===o?"left":"right",h=W("transform");let m,g;if(g="bottom"===c?"HTML"===f.nodeName?-f.clientHeight+l.bottom:-p.height+l.bottom:l.top,m="right"===d?"HTML"===f.nodeName?-f.clientWidth+l.right:-p.width+l.right:l.left,s&&h)a[h]=`translate3d(${m}px, ${g}px, 0)`,a[c]=0,a[d]=0,a.willChange="transform";else{const t="bottom"===c?-1:1,e="right"===d?-1:1;a[c]=g*t,a[d]=m*e,a.willChange=`${c}, ${d}`}const b={"x-placement":t.placement};return t.attributes=v({},b,t.attributes),t.styles=v({},a,t.styles),t.arrowStyles=v({},t.offsets.arrow,t.arrowStyles),t},gpuAcceleration:!0,x:"bottom",y:"right"},applyStyle:{order:900,enabled:!0,fn:function(t){var e,n;return Y(t.instance.popper,t.styles),e=t.instance.popper,n=t.attributes,Object.keys(n).forEach((function(t){!1!==n[t]?e.setAttribute(t,n[t]):e.removeAttribute(t)})),t.arrowElement&&Object.keys(t.arrowStyles).length&&Y(t.arrowElement,t.arrowStyles),t},onLoad:function(t,e,n,o,r){const i=N(0,e,t,n.positionFixed),s=D(n.placement,i,e,t,n.modifiers.flip.boundariesElement,n.modifiers.flip.padding);return e.setAttribute("x-placement",s),Y(e,{position:n.positionFixed?"fixed":"absolute"}),n},gpuAcceleration:void 0}}};class tt{constructor(t,e,n={}){this.scheduleUpdate=()=>requestAnimationFrame(this.update),this.update=r(this.update.bind(this)),this.options=v({},tt.Defaults,n),this.state={isDestroyed:!1,isCreated:!1,scrollParents:[]},this.reference=t&&t.jquery?t[0]:t,this.popper=e&&e.jquery?e[0]:e,this.options.modifiers={},Object.keys(v({},tt.Defaults.modifiers,n.modifiers)).forEach(t=>{this.options.modifiers[t]=v({},tt.Defaults.modifiers[t]||{},n.modifiers?n.modifiers[t]:{})}),this.modifiers=Object.keys(this.options.modifiers).map(t=>v({name:t},this.options.modifiers[t])).sort((t,e)=>t.order-e.order),this.modifiers.forEach(t=>{t.enabled&&i(t.onLoad)&&t.onLoad(this.reference,this.popper,this.options,t,this.state)}),this.update();const o=this.options.eventsEnabled;o&&this.enableEventListeners(),this.state.eventsEnabled=o}update(){return C.call(this)}destroy(){return j.call(this)}enableEventListeners(){return I.call(this)}disableEventListeners(){return R.call(this)}}tt.Utils=("undefined"!=typeof window?window:t).PopperUtils,tt.placements=q,tt.Defaults=Z,e.default=tt}.call(this,n(1))}});
//# sourceMappingURL=popper.js.map