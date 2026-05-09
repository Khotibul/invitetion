var y=(e,n)=>()=>(n||e((n={exports:{}}).exports,n),n.exports);import{T as Tooltip}from"./vendor-bootstrap-f4TNcP9e.js";import{S as Swal}from"./vendor-swal-YZDMVk0e.js";var R=y((exports,module)=>{function get(e){return getComputedStyle(e)}function set(e,n){for(var o in n){var Q=n[o];typeof Q=="number"&&(Q=Q+"px"),e.style[o]=Q}return e}function div(e){var n=document.createElement("div");return n.className=e,n}var elMatches=typeof Element<"u"&&(Element.prototype.matches||Element.prototype.webkitMatchesSelector||Element.prototype.mozMatchesSelector||Element.prototype.msMatchesSelector);function matches(e,n){if(!elMatches)throw new Error("No element matching method supported");return elMatches.call(e,n)}function remove(e){e.remove?e.remove():e.parentNode&&e.parentNode.removeChild(e)}function queryChildren(e,n){return Array.prototype.filter.call(e.children,function(o){return matches(o,n)})}var cls={main:"ps",rtl:"ps__rtl",element:{thumb:function(e){return"ps__thumb-"+e},rail:function(e){return"ps__rail-"+e},consuming:"ps__child--consume"},state:{focus:"ps--focus",clicking:"ps--clicking",active:function(e){return"ps--active-"+e},scrolling:function(e){return"ps--scrolling-"+e}}},scrollingClassTimeout={x:null,y:null};function addScrollingClass(e,n){var o=e.element.classList,Q=cls.state.scrolling(n);o.contains(Q)?clearTimeout(scrollingClassTimeout[n]):o.add(Q)}function removeScrollingClass(e,n){scrollingClassTimeout[n]=setTimeout(function(){return e.isAlive&&e.element.classList.remove(cls.state.scrolling(n))},e.settings.scrollingThreshold)}function setScrollingClassInstantly(e,n){addScrollingClass(e,n),removeScrollingClass(e,n)}var EventElement=function(n){this.element=n,this.handlers={}},prototypeAccessors={isEmpty:{configurable:!0}};EventElement.prototype.bind=function(n,o){typeof this.handlers[n]>"u"&&(this.handlers[n]=[]),this.handlers[n].push(o),this.element.addEventListener(n,o,!1)};EventElement.prototype.unbind=function(n,o){var Q=this;this.handlers[n]=this.handlers[n].filter(function(c){return o&&c!==o?!0:(Q.element.removeEventListener(n,c,!1),!1)})};EventElement.prototype.unbindAll=function(){for(var n in this.handlers)this.unbind(n)};prototypeAccessors.isEmpty.get=function(){var e=this;return Object.keys(this.handlers).every(function(n){return e.handlers[n].length===0})};Object.defineProperties(EventElement.prototype,prototypeAccessors);var EventManager=function(){this.eventElements=[]};EventManager.prototype.eventElement=function(n){var o=this.eventElements.filter(function(Q){return Q.element===n})[0];return o||(o=new EventElement(n),this.eventElements.push(o)),o};EventManager.prototype.bind=function(n,o,Q){this.eventElement(n).bind(o,Q)};EventManager.prototype.unbind=function(n,o,Q){var c=this.eventElement(n);c.unbind(o,Q),c.isEmpty&&this.eventElements.splice(this.eventElements.indexOf(c),1)};EventManager.prototype.unbindAll=function(){this.eventElements.forEach(function(n){return n.unbindAll()}),this.eventElements=[]};EventManager.prototype.once=function(n,o,Q){var c=this.eventElement(n),U=function(B){c.unbind(o,U),Q(B)};c.bind(o,U)};function createEvent(e){if(typeof window.CustomEvent=="function")return new CustomEvent(e);var n=document.createEvent("CustomEvent");return n.initCustomEvent(e,!1,!1,void 0),n}function processScrollDiff(e,n,o,Q,c){Q===void 0&&(Q=!0),c===void 0&&(c=!1);var U;if(n==="top")U=["contentHeight","containerHeight","scrollTop","y","up","down"];else if(n==="left")U=["contentWidth","containerWidth","scrollLeft","x","left","right"];else throw new Error("A proper axis should be provided");processScrollDiff$1(e,o,U,Q,c)}function processScrollDiff$1(e,n,o,Q,c){var U=o[0],B=o[1],F=o[2],g=o[3],d=o[4],C=o[5];Q===void 0&&(Q=!0),c===void 0&&(c=!1);var a=e.element;e.reach[g]=null,a[F]<1&&(e.reach[g]="start"),a[F]>e[U]-e[B]-1&&(e.reach[g]="end"),n&&(a.dispatchEvent(createEvent("ps-scroll-"+g)),n<0?a.dispatchEvent(createEvent("ps-scroll-"+d)):n>0&&a.dispatchEvent(createEvent("ps-scroll-"+C)),Q&&setScrollingClassInstantly(e,g)),e.reach[g]&&(n||c)&&a.dispatchEvent(createEvent("ps-"+g+"-reach-"+e.reach[g]))}function toInt(e){return parseInt(e,10)||0}function isEditable(e){return matches(e,"input,[contenteditable]")||matches(e,"select,[contenteditable]")||matches(e,"textarea,[contenteditable]")||matches(e,"button,[contenteditable]")}function outerWidth(e){var n=get(e);return toInt(n.width)+toInt(n.paddingLeft)+toInt(n.paddingRight)+toInt(n.borderLeftWidth)+toInt(n.borderRightWidth)}var env={isWebKit:typeof document<"u"&&"WebkitAppearance"in document.documentElement.style,supportsTouch:typeof window<"u"&&("ontouchstart"in window||"maxTouchPoints"in window.navigator&&window.navigator.maxTouchPoints>0||window.DocumentTouch&&document instanceof window.DocumentTouch),supportsIePointer:typeof navigator<"u"&&navigator.msMaxTouchPoints,isChrome:typeof navigator<"u"&&/Chrome/i.test(navigator&&navigator.userAgent)};function updateGeometry(e){var n=e.element,o=Math.floor(n.scrollTop),Q=n.getBoundingClientRect();e.containerWidth=Math.round(Q.width),e.containerHeight=Math.round(Q.height),e.contentWidth=n.scrollWidth,e.contentHeight=n.scrollHeight,n.contains(e.scrollbarXRail)||(queryChildren(n,cls.element.rail("x")).forEach(function(c){return remove(c)}),n.appendChild(e.scrollbarXRail)),n.contains(e.scrollbarYRail)||(queryChildren(n,cls.element.rail("y")).forEach(function(c){return remove(c)}),n.appendChild(e.scrollbarYRail)),!e.settings.suppressScrollX&&e.containerWidth+e.settings.scrollXMarginOffset<e.contentWidth?(e.scrollbarXActive=!0,e.railXWidth=e.containerWidth-e.railXMarginWidth,e.railXRatio=e.containerWidth/e.railXWidth,e.scrollbarXWidth=getThumbSize(e,toInt(e.railXWidth*e.containerWidth/e.contentWidth)),e.scrollbarXLeft=toInt((e.negativeScrollAdjustment+n.scrollLeft)*(e.railXWidth-e.scrollbarXWidth)/(e.contentWidth-e.containerWidth))):e.scrollbarXActive=!1,!e.settings.suppressScrollY&&e.containerHeight+e.settings.scrollYMarginOffset<e.contentHeight?(e.scrollbarYActive=!0,e.railYHeight=e.containerHeight-e.railYMarginHeight,e.railYRatio=e.containerHeight/e.railYHeight,e.scrollbarYHeight=getThumbSize(e,toInt(e.railYHeight*e.containerHeight/e.contentHeight)),e.scrollbarYTop=toInt(o*(e.railYHeight-e.scrollbarYHeight)/(e.contentHeight-e.containerHeight))):e.scrollbarYActive=!1,e.scrollbarXLeft>=e.railXWidth-e.scrollbarXWidth&&(e.scrollbarXLeft=e.railXWidth-e.scrollbarXWidth),e.scrollbarYTop>=e.railYHeight-e.scrollbarYHeight&&(e.scrollbarYTop=e.railYHeight-e.scrollbarYHeight),updateCss(n,e),e.scrollbarXActive?n.classList.add(cls.state.active("x")):(n.classList.remove(cls.state.active("x")),e.scrollbarXWidth=0,e.scrollbarXLeft=0,n.scrollLeft=e.isRtl===!0?e.contentWidth:0),e.scrollbarYActive?n.classList.add(cls.state.active("y")):(n.classList.remove(cls.state.active("y")),e.scrollbarYHeight=0,e.scrollbarYTop=0,n.scrollTop=0)}function getThumbSize(e,n){return e.settings.minScrollbarLength&&(n=Math.max(n,e.settings.minScrollbarLength)),e.settings.maxScrollbarLength&&(n=Math.min(n,e.settings.maxScrollbarLength)),n}function updateCss(e,n){var o={width:n.railXWidth},Q=Math.floor(e.scrollTop);n.isRtl?o.left=n.negativeScrollAdjustment+e.scrollLeft+n.containerWidth-n.contentWidth:o.left=e.scrollLeft,n.isScrollbarXUsingBottom?o.bottom=n.scrollbarXBottom-Q:o.top=n.scrollbarXTop+Q,set(n.scrollbarXRail,o);var c={top:Q,height:n.railYHeight};n.isScrollbarYUsingRight?n.isRtl?c.right=n.contentWidth-(n.negativeScrollAdjustment+e.scrollLeft)-n.scrollbarYRight-n.scrollbarYOuterWidth-9:c.right=n.scrollbarYRight-e.scrollLeft:n.isRtl?c.left=n.negativeScrollAdjustment+e.scrollLeft+n.containerWidth*2-n.contentWidth-n.scrollbarYLeft-n.scrollbarYOuterWidth:c.left=n.scrollbarYLeft+e.scrollLeft,set(n.scrollbarYRail,c),set(n.scrollbarX,{left:n.scrollbarXLeft,width:n.scrollbarXWidth-n.railBorderXWidth}),set(n.scrollbarY,{top:n.scrollbarYTop,height:n.scrollbarYHeight-n.railBorderYWidth})}function clickRail(e){e.element,e.event.bind(e.scrollbarY,"mousedown",function(n){return n.stopPropagation()}),e.event.bind(e.scrollbarYRail,"mousedown",function(n){var o=n.pageY-window.pageYOffset-e.scrollbarYRail.getBoundingClientRect().top,Q=o>e.scrollbarYTop?1:-1;e.element.scrollTop+=Q*e.containerHeight,updateGeometry(e),n.stopPropagation()}),e.event.bind(e.scrollbarX,"mousedown",function(n){return n.stopPropagation()}),e.event.bind(e.scrollbarXRail,"mousedown",function(n){var o=n.pageX-window.pageXOffset-e.scrollbarXRail.getBoundingClientRect().left,Q=o>e.scrollbarXLeft?1:-1;e.element.scrollLeft+=Q*e.containerWidth,updateGeometry(e),n.stopPropagation()})}function dragThumb(e){bindMouseScrollHandler(e,["containerWidth","contentWidth","pageX","railXWidth","scrollbarX","scrollbarXWidth","scrollLeft","x","scrollbarXRail"]),bindMouseScrollHandler(e,["containerHeight","contentHeight","pageY","railYHeight","scrollbarY","scrollbarYHeight","scrollTop","y","scrollbarYRail"])}function bindMouseScrollHandler(e,n){var o=n[0],Q=n[1],c=n[2],U=n[3],B=n[4],F=n[5],g=n[6],d=n[7],C=n[8],a=e.element,l=null,i=null,t=null;function s(h){h.touches&&h.touches[0]&&(h[c]=h.touches[0].pageY),a[g]=l+t*(h[c]-i),addScrollingClass(e,d),updateGeometry(e),h.stopPropagation(),h.type.startsWith("touch")&&h.changedTouches.length>1&&h.preventDefault()}function r(){removeScrollingClass(e,d),e[C].classList.remove(cls.state.clicking),e.event.unbind(e.ownerDocument,"mousemove",s)}function u(h,I){l=a[g],I&&h.touches&&(h[c]=h.touches[0].pageY),i=h[c],t=(e[Q]-e[o])/(e[U]-e[F]),I?e.event.bind(e.ownerDocument,"touchmove",s):(e.event.bind(e.ownerDocument,"mousemove",s),e.event.once(e.ownerDocument,"mouseup",r),h.preventDefault()),e[C].classList.add(cls.state.clicking),h.stopPropagation()}e.event.bind(e[B],"mousedown",function(h){u(h)}),e.event.bind(e[B],"touchstart",function(h){u(h,!0)})}function keyboard(e){var n=e.element,o=function(){return matches(n,":hover")},Q=function(){return matches(e.scrollbarX,":focus")||matches(e.scrollbarY,":focus")};function c(U,B){var F=Math.floor(n.scrollTop);if(U===0){if(!e.scrollbarYActive)return!1;if(F===0&&B>0||F>=e.contentHeight-e.containerHeight&&B<0)return!e.settings.wheelPropagation}var g=n.scrollLeft;if(B===0){if(!e.scrollbarXActive)return!1;if(g===0&&U<0||g>=e.contentWidth-e.containerWidth&&U>0)return!e.settings.wheelPropagation}return!0}e.event.bind(e.ownerDocument,"keydown",function(U){if(!(U.isDefaultPrevented&&U.isDefaultPrevented()||U.defaultPrevented)&&!(!o()&&!Q())){var B=document.activeElement?document.activeElement:e.ownerDocument.activeElement;if(B){if(B.tagName==="IFRAME")B=B.contentDocument.activeElement;else for(;B.shadowRoot;)B=B.shadowRoot.activeElement;if(isEditable(B))return}var F=0,g=0;switch(U.which){case 37:U.metaKey?F=-e.contentWidth:U.altKey?F=-e.containerWidth:F=-30;break;case 38:U.metaKey?g=e.contentHeight:U.altKey?g=e.containerHeight:g=30;break;case 39:U.metaKey?F=e.contentWidth:U.altKey?F=e.containerWidth:F=30;break;case 40:U.metaKey?g=-e.contentHeight:U.altKey?g=-e.containerHeight:g=-30;break;case 32:U.shiftKey?g=e.containerHeight:g=-e.containerHeight;break;case 33:g=e.containerHeight;break;case 34:g=-e.containerHeight;break;case 36:g=e.contentHeight;break;case 35:g=-e.contentHeight;break;default:return}e.settings.suppressScrollX&&F!==0||e.settings.suppressScrollY&&g!==0||(n.scrollTop-=g,n.scrollLeft+=F,updateGeometry(e),c(F,g)&&U.preventDefault())}})}function wheel(e){var n=e.element;function o(B,F){var g=Math.floor(n.scrollTop),d=n.scrollTop===0,C=g+n.offsetHeight===n.scrollHeight,a=n.scrollLeft===0,l=n.scrollLeft+n.offsetWidth===n.scrollWidth,i;return Math.abs(F)>Math.abs(B)?i=d||C:i=a||l,i?!e.settings.wheelPropagation:!0}function Q(B){var F=B.deltaX,g=-1*B.deltaY;return(typeof F>"u"||typeof g>"u")&&(F=-1*B.wheelDeltaX/6,g=B.wheelDeltaY/6),B.deltaMode&&B.deltaMode===1&&(F*=10,g*=10),F!==F&&g!==g&&(F=0,g=B.wheelDelta),B.shiftKey?[-g,-F]:[F,g]}function c(B,F,g){if(!env.isWebKit&&n.querySelector("select:focus"))return!0;if(!n.contains(B))return!1;for(var d=B;d&&d!==n;){if(d.classList.contains(cls.element.consuming))return!0;var C=get(d);if(g&&C.overflowY.match(/(scroll|auto)/)){var a=d.scrollHeight-d.clientHeight;if(a>0&&(d.scrollTop>0&&g<0||d.scrollTop<a&&g>0))return!0}if(F&&C.overflowX.match(/(scroll|auto)/)){var l=d.scrollWidth-d.clientWidth;if(l>0&&(d.scrollLeft>0&&F<0||d.scrollLeft<l&&F>0))return!0}d=d.parentNode}return!1}function U(B){var F=Q(B),g=F[0],d=F[1];if(!c(B.target,g,d)){var C=!1;e.settings.useBothWheelAxes?e.scrollbarYActive&&!e.scrollbarXActive?(d?n.scrollTop-=d*e.settings.wheelSpeed:n.scrollTop+=g*e.settings.wheelSpeed,C=!0):e.scrollbarXActive&&!e.scrollbarYActive&&(g?n.scrollLeft+=g*e.settings.wheelSpeed:n.scrollLeft-=d*e.settings.wheelSpeed,C=!0):(n.scrollTop-=d*e.settings.wheelSpeed,n.scrollLeft+=g*e.settings.wheelSpeed),updateGeometry(e),C=C||o(g,d),C&&!B.ctrlKey&&(B.stopPropagation(),B.preventDefault())}}typeof window.onwheel<"u"?e.event.bind(n,"wheel",U):typeof window.onmousewheel<"u"&&e.event.bind(n,"mousewheel",U)}function touch(e){if(!env.supportsTouch&&!env.supportsIePointer)return;var n=e.element;function o(t,s){var r=Math.floor(n.scrollTop),u=n.scrollLeft,h=Math.abs(t),I=Math.abs(s);if(I>h){if(s<0&&r===e.contentHeight-e.containerHeight||s>0&&r===0)return window.scrollY===0&&s>0&&env.isChrome}else if(h>I&&(t<0&&u===e.contentWidth-e.containerWidth||t>0&&u===0))return!0;return!0}function Q(t,s){n.scrollTop-=s,n.scrollLeft-=t,updateGeometry(e)}var c={},U=0,B={},F=null;function g(t){return t.targetTouches?t.targetTouches[0]:t}function d(t){return t.pointerType&&t.pointerType==="pen"&&t.buttons===0?!1:!!(t.targetTouches&&t.targetTouches.length===1||t.pointerType&&t.pointerType!=="mouse"&&t.pointerType!==t.MSPOINTER_TYPE_MOUSE)}function C(t){if(d(t)){var s=g(t);c.pageX=s.pageX,c.pageY=s.pageY,U=new Date().getTime(),F!==null&&clearInterval(F)}}function a(t,s,r){if(!n.contains(t))return!1;for(var u=t;u&&u!==n;){if(u.classList.contains(cls.element.consuming))return!0;var h=get(u);if(r&&h.overflowY.match(/(scroll|auto)/)){var I=u.scrollHeight-u.clientHeight;if(I>0&&(u.scrollTop>0&&r<0||u.scrollTop<I&&r>0))return!0}if(s&&h.overflowX.match(/(scroll|auto)/)){var b=u.scrollWidth-u.clientWidth;if(b>0&&(u.scrollLeft>0&&s<0||u.scrollLeft<b&&s>0))return!0}u=u.parentNode}return!1}function l(t){if(d(t)){var s=g(t),r={pageX:s.pageX,pageY:s.pageY},u=r.pageX-c.pageX,h=r.pageY-c.pageY;if(a(t.target,u,h))return;Q(u,h),c=r;var I=new Date().getTime(),b=I-U;b>0&&(B.x=u/b,B.y=h/b,U=I),o(u,h)&&t.preventDefault()}}function i(){e.settings.swipeEasing&&(clearInterval(F),F=setInterval(function(){if(e.isInitialized){clearInterval(F);return}if(!B.x&&!B.y){clearInterval(F);return}if(Math.abs(B.x)<.01&&Math.abs(B.y)<.01){clearInterval(F);return}if(!e.element){clearInterval(F);return}Q(B.x*30,B.y*30),B.x*=.8,B.y*=.8},10))}env.supportsTouch?(e.event.bind(n,"touchstart",C),e.event.bind(n,"touchmove",l),e.event.bind(n,"touchend",i)):env.supportsIePointer&&(window.PointerEvent?(e.event.bind(n,"pointerdown",C),e.event.bind(n,"pointermove",l),e.event.bind(n,"pointerup",i)):window.MSPointerEvent&&(e.event.bind(n,"MSPointerDown",C),e.event.bind(n,"MSPointerMove",l),e.event.bind(n,"MSPointerUp",i)))}var defaultSettings=function(){return{handlers:["click-rail","drag-thumb","keyboard","wheel","touch"],maxScrollbarLength:null,minScrollbarLength:null,scrollingThreshold:1e3,scrollXMarginOffset:0,scrollYMarginOffset:0,suppressScrollX:!1,suppressScrollY:!1,swipeEasing:!0,useBothWheelAxes:!1,wheelPropagation:!0,wheelSpeed:1}},handlers={"click-rail":clickRail,"drag-thumb":dragThumb,keyboard,wheel,touch},PerfectScrollbar=function(n,o){var Q=this;if(o===void 0&&(o={}),typeof n=="string"&&(n=document.querySelector(n)),!n||!n.nodeName)throw new Error("no element is specified to initialize PerfectScrollbar");this.element=n,n.classList.add(cls.main),this.settings=defaultSettings();for(var c in o)this.settings[c]=o[c];this.containerWidth=null,this.containerHeight=null,this.contentWidth=null,this.contentHeight=null;var U=function(){return n.classList.add(cls.state.focus)},B=function(){return n.classList.remove(cls.state.focus)};this.isRtl=get(n).direction==="rtl",this.isRtl===!0&&n.classList.add(cls.rtl),this.isNegativeScroll=(function(){var d=n.scrollLeft,C=null;return n.scrollLeft=-1,C=n.scrollLeft<0,n.scrollLeft=d,C})(),this.negativeScrollAdjustment=this.isNegativeScroll?n.scrollWidth-n.clientWidth:0,this.event=new EventManager,this.ownerDocument=n.ownerDocument||document,this.scrollbarXRail=div(cls.element.rail("x")),n.appendChild(this.scrollbarXRail),this.scrollbarX=div(cls.element.thumb("x")),this.scrollbarXRail.appendChild(this.scrollbarX),this.scrollbarX.setAttribute("tabindex",0),this.event.bind(this.scrollbarX,"focus",U),this.event.bind(this.scrollbarX,"blur",B),this.scrollbarXActive=null,this.scrollbarXWidth=null,this.scrollbarXLeft=null;var F=get(this.scrollbarXRail);this.scrollbarXBottom=parseInt(F.bottom,10),isNaN(this.scrollbarXBottom)?(this.isScrollbarXUsingBottom=!1,this.scrollbarXTop=toInt(F.top)):this.isScrollbarXUsingBottom=!0,this.railBorderXWidth=toInt(F.borderLeftWidth)+toInt(F.borderRightWidth),set(this.scrollbarXRail,{display:"block"}),this.railXMarginWidth=toInt(F.marginLeft)+toInt(F.marginRight),set(this.scrollbarXRail,{display:""}),this.railXWidth=null,this.railXRatio=null,this.scrollbarYRail=div(cls.element.rail("y")),n.appendChild(this.scrollbarYRail),this.scrollbarY=div(cls.element.thumb("y")),this.scrollbarYRail.appendChild(this.scrollbarY),this.scrollbarY.setAttribute("tabindex",0),this.event.bind(this.scrollbarY,"focus",U),this.event.bind(this.scrollbarY,"blur",B),this.scrollbarYActive=null,this.scrollbarYHeight=null,this.scrollbarYTop=null;var g=get(this.scrollbarYRail);this.scrollbarYRight=parseInt(g.right,10),isNaN(this.scrollbarYRight)?(this.isScrollbarYUsingRight=!1,this.scrollbarYLeft=toInt(g.left)):this.isScrollbarYUsingRight=!0,this.scrollbarYOuterWidth=this.isRtl?outerWidth(this.scrollbarY):null,this.railBorderYWidth=toInt(g.borderTopWidth)+toInt(g.borderBottomWidth),set(this.scrollbarYRail,{display:"block"}),this.railYMarginHeight=toInt(g.marginTop)+toInt(g.marginBottom),set(this.scrollbarYRail,{display:""}),this.railYHeight=null,this.railYRatio=null,this.reach={x:n.scrollLeft<=0?"start":n.scrollLeft>=this.contentWidth-this.containerWidth?"end":null,y:n.scrollTop<=0?"start":n.scrollTop>=this.contentHeight-this.containerHeight?"end":null},this.isAlive=!0,this.settings.handlers.forEach(function(d){return handlers[d](Q)}),this.lastScrollTop=Math.floor(n.scrollTop),this.lastScrollLeft=n.scrollLeft,this.event.bind(this.element,"scroll",function(d){return Q.onScroll(d)}),updateGeometry(this)};PerfectScrollbar.prototype.update=function(){this.isAlive&&(this.negativeScrollAdjustment=this.isNegativeScroll?this.element.scrollWidth-this.element.clientWidth:0,set(this.scrollbarXRail,{display:"block"}),set(this.scrollbarYRail,{display:"block"}),this.railXMarginWidth=toInt(get(this.scrollbarXRail).marginLeft)+toInt(get(this.scrollbarXRail).marginRight),this.railYMarginHeight=toInt(get(this.scrollbarYRail).marginTop)+toInt(get(this.scrollbarYRail).marginBottom),set(this.scrollbarXRail,{display:"none"}),set(this.scrollbarYRail,{display:"none"}),updateGeometry(this),processScrollDiff(this,"top",0,!1,!0),processScrollDiff(this,"left",0,!1,!0),set(this.scrollbarXRail,{display:""}),set(this.scrollbarYRail,{display:""}))};PerfectScrollbar.prototype.onScroll=function(n){this.isAlive&&(updateGeometry(this),processScrollDiff(this,"top",this.element.scrollTop-this.lastScrollTop),processScrollDiff(this,"left",this.element.scrollLeft-this.lastScrollLeft),this.lastScrollTop=Math.floor(this.element.scrollTop),this.lastScrollLeft=this.element.scrollLeft)};PerfectScrollbar.prototype.destroy=function(){this.isAlive&&(this.event.unbindAll(),remove(this.scrollbarX),remove(this.scrollbarY),remove(this.scrollbarXRail),remove(this.scrollbarYRail),this.removePsClasses(),this.element=null,this.scrollbarX=null,this.scrollbarY=null,this.scrollbarXRail=null,this.scrollbarYRail=null,this.isAlive=!1)};PerfectScrollbar.prototype.removePsClasses=function(){this.element.className=this.element.className.split(" ").filter(function(n){return!n.match(/^ps([-_].+|)$/)}).join(" ")};(function(e,n){for(var o in n)e[o]=n[o]})(window,(function(e){var n={};function o(Q){if(n[Q])return n[Q].exports;var c=n[Q]={i:Q,l:!1,exports:{}};return e[Q].call(c.exports,c,c.exports,o),c.l=!0,c.exports}return o.m=e,o.c=n,o.d=function(Q,c,U){o.o(Q,c)||Object.defineProperty(Q,c,{enumerable:!0,get:U})},o.r=function(Q){typeof Symbol<"u"&&Symbol.toStringTag&&Object.defineProperty(Q,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(Q,"__esModule",{value:!0})},o.t=function(Q,c){if(c&1&&(Q=o(Q)),c&8||c&4&&typeof Q=="object"&&Q&&Q.__esModule)return Q;var U=Object.create(null);if(o.r(U),Object.defineProperty(U,"default",{enumerable:!0,value:Q}),c&2&&typeof Q!="string")for(var B in Q)o.d(U,B,(function(F){return Q[F]}).bind(null,B));return U},o.n=function(Q){var c=Q&&Q.__esModule?function(){return Q.default}:function(){return Q};return o.d(c,"a",c),c},o.o=function(Q,c){return Object.prototype.hasOwnProperty.call(Q,c)},o.p="",o(o.s="./js/helpers.js")})({"./js/helpers.js":(function(module,__webpack_exports__,__webpack_require__){eval(`__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "Helpers", function() { return Helpers; });
function _toArray(arr) { return _arrayWithHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableRest(); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }

function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _iterableToArrayLimit(arr, i) { var _i = arr == null ? null : typeof Symbol !== "undefined" && arr[Symbol.iterator] || arr["@@iterator"]; if (_i == null) return; var _arr = []; var _n = true; var _d = false; var _s, _e; try { for (_i = _i.call(arr); !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }

// Constants
var TRANS_EVENTS = ['transitionend', 'webkitTransitionEnd', 'oTransitionEnd'];
var TRANS_PROPERTIES = ['transition', 'MozTransition', 'webkitTransition', 'WebkitTransition', 'OTransition'];
var INLINE_STYLES = "\\n.layout-menu-fixed .layout-navbar-full .layout-menu,\\n.layout-page {\\n  padding-top: {navbarHeight}px !important;\\n}\\n.content-wrapper {\\n  padding-bottom: {footerHeight}px !important;\\n}"; // Guard

function requiredParam(name) {
  throw new Error("Parameter required".concat(name ? ": \`".concat(name, "\`") : ''));
}

var Helpers = {
  // Root Element
  ROOT_EL: typeof window !== 'undefined' ? document.documentElement : null,
  // Large screens breakpoint
  LAYOUT_BREAKPOINT: 1200,
  // Resize delay in milliseconds
  RESIZE_DELAY: 200,
  menuPsScroll: null,
  mainMenu: null,
  // Internal variables
  _curStyle: null,
  _styleEl: null,
  _resizeTimeout: null,
  _resizeCallback: null,
  _transitionCallback: null,
  _transitionCallbackTimeout: null,
  _listeners: [],
  _initialized: false,
  _autoUpdate: false,
  _lastWindowHeight: 0,
  // *******************************************************************************
  // * Utilities
  // ---
  // Scroll To Active Menu Item
  _scrollToActive: function _scrollToActive() {
    var animate = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;
    var duration = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 500;
    var layoutMenu = this.getLayoutMenu();
    if (!layoutMenu) return;
    var activeEl = layoutMenu.querySelector('li.menu-item.active:not(.open)');

    if (activeEl) {
      // t = current time
      // b = start value
      // c = change in value
      // d = duration
      var easeInOutQuad = function easeInOutQuad(t, b, c, d) {
        t /= d / 2;
        if (t < 1) return c / 2 * t * t + b;
        t -= 1;
        return -c / 2 * (t * (t - 2) - 1) + b;
      };

      var element = this.getLayoutMenu().querySelector('.menu-inner');

      if (typeof activeEl === 'string') {
        activeEl = document.querySelector(activeEl);
      }

      if (typeof activeEl !== 'number') {
        activeEl = activeEl.getBoundingClientRect().top + element.scrollTop;
      } // If active element's top position is less than 2/3 (66%) of menu height than do not scroll


      if (activeEl < parseInt(element.clientHeight * 2 / 3, 10)) return;
      var start = element.scrollTop;
      var change = activeEl - start - parseInt(element.clientHeight / 2, 10);
      var startDate = +new Date();

      if (animate === true) {
        var animateScroll = function animateScroll() {
          var currentDate = +new Date();
          var currentTime = currentDate - startDate;
          var val = easeInOutQuad(currentTime, start, change, duration);
          element.scrollTop = val;

          if (currentTime < duration) {
            requestAnimationFrame(animateScroll);
          } else {
            element.scrollTop = change;
          }
        };

        animateScroll();
      } else {
        element.scrollTop = change;
      }
    }
  },
  // ---
  // Add classes
  _addClass: function _addClass(cls) {
    var el = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : this.ROOT_EL;

    if (el.length !== undefined) {
      // Add classes to multiple elements
      el.forEach(function (e) {
        cls.split(' ').forEach(function (c) {
          return e.classList.add(c);
        });
      });
    } else {
      // Add classes to single element
      cls.split(' ').forEach(function (c) {
        return el.classList.add(c);
      });
    }
  },
  // ---
  // Remove classes
  _removeClass: function _removeClass(cls) {
    var el = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : this.ROOT_EL;

    if (el.length !== undefined) {
      // Remove classes to multiple elements
      el.forEach(function (e) {
        cls.split(' ').forEach(function (c) {
          return e.classList.remove(c);
        });
      });
    } else {
      // Remove classes to single element
      cls.split(' ').forEach(function (c) {
        return el.classList.remove(c);
      });
    }
  },
  // Toggle classes
  _toggleClass: function _toggleClass() {
    var el = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : this.ROOT_EL;
    var cls1 = arguments.length > 1 ? arguments[1] : undefined;
    var cls2 = arguments.length > 2 ? arguments[2] : undefined;

    if (el.classList.contains(cls1)) {
      el.classList.replace(cls1, cls2);
    } else {
      el.classList.replace(cls2, cls1);
    }
  },
  // ---
  // Has class
  _hasClass: function _hasClass(cls) {
    var el = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : this.ROOT_EL;
    var result = false;
    cls.split(' ').forEach(function (c) {
      if (el.classList.contains(c)) result = true;
    });
    return result;
  },
  _findParent: function _findParent(el, cls) {
    if (el && el.tagName.toUpperCase() === 'BODY' || el.tagName.toUpperCase() === 'HTML') return null;
    el = el.parentNode;

    while (el && el.tagName.toUpperCase() !== 'BODY' && !el.classList.contains(cls)) {
      el = el.parentNode;
    }

    el = el && el.tagName.toUpperCase() !== 'BODY' ? el : null;
    return el;
  },
  // ---
  // Trigger window event
  _triggerWindowEvent: function _triggerWindowEvent(name) {
    if (typeof window === 'undefined') return;

    if (document.createEvent) {
      var event;

      if (typeof Event === 'function') {
        event = new Event(name);
      } else {
        event = document.createEvent('Event');
        event.initEvent(name, false, true);
      }

      window.dispatchEvent(event);
    } else {
      window.fireEvent("on".concat(name), document.createEventObject());
    }
  },
  // ---
  // Trigger event
  _triggerEvent: function _triggerEvent(name) {
    this._triggerWindowEvent("layout".concat(name));

    this._listeners.filter(function (listener) {
      return listener.event === name;
    }).forEach(function (listener) {
      return listener.callback.call(null);
    });
  },
  // ---
  // Update style
  _updateInlineStyle: function _updateInlineStyle() {
    var navbarHeight = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 0;
    var footerHeight = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 0;

    if (!this._styleEl) {
      this._styleEl = document.createElement('style');
      this._styleEl.type = 'text/css';
      document.head.appendChild(this._styleEl);
    }

    var newStyle = INLINE_STYLES.replace(/\\{navbarHeight\\}/gi, navbarHeight).replace(/\\{footerHeight\\}/gi, footerHeight);

    if (this._curStyle !== newStyle) {
      this._curStyle = newStyle;
      this._styleEl.textContent = newStyle;
    }
  },
  // ---
  // Remove style
  _removeInlineStyle: function _removeInlineStyle() {
    if (this._styleEl) document.head.removeChild(this._styleEl);
    this._styleEl = null;
    this._curStyle = null;
  },
  // ---
  // Redraw layout menu (Safari bugfix)
  _redrawLayoutMenu: function _redrawLayoutMenu() {
    var layoutMenu = this.getLayoutMenu();

    if (layoutMenu && layoutMenu.querySelector('.menu')) {
      var inner = layoutMenu.querySelector('.menu-inner');
      var scrollTop = inner.scrollTop;
      var pageScrollTop = document.documentElement.scrollTop;
      layoutMenu.style.display = 'none'; // layoutMenu.offsetHeight

      layoutMenu.style.display = '';
      inner.scrollTop = scrollTop;
      document.documentElement.scrollTop = pageScrollTop;
      return true;
    }

    return false;
  },
  // ---
  // Check for transition support
  _supportsTransitionEnd: function _supportsTransitionEnd() {
    if (window.QUnit) return false;
    var el = document.body || document.documentElement;
    if (!el) return false;
    var result = false;
    TRANS_PROPERTIES.forEach(function (evnt) {
      if (typeof el.style[evnt] !== 'undefined') result = true;
    });
    return result;
  },
  // ---
  // Calculate current navbar height
  _getNavbarHeight: function _getNavbarHeight() {
    var _this = this;

    var layoutNavbar = this.getLayoutNavbar();
    if (!layoutNavbar) return 0;
    if (!this.isSmallScreen()) return layoutNavbar.getBoundingClientRect().height; // Needs some logic to get navbar height on small screens

    var clonedEl = layoutNavbar.cloneNode(true);
    clonedEl.id = null;
    clonedEl.style.visibility = 'hidden';
    clonedEl.style.position = 'absolute';
    Array.prototype.slice.call(clonedEl.querySelectorAll('.collapse.show')).forEach(function (el) {
      return _this._removeClass('show', el);
    });
    layoutNavbar.parentNode.insertBefore(clonedEl, layoutNavbar);
    var navbarHeight = clonedEl.getBoundingClientRect().height;
    clonedEl.parentNode.removeChild(clonedEl);
    return navbarHeight;
  },
  // ---
  // Get current footer height
  _getFooterHeight: function _getFooterHeight() {
    var layoutFooter = this.getLayoutFooter();
    if (!layoutFooter) return 0;
    return layoutFooter.getBoundingClientRect().height;
  },
  // ---
  // Get animation duration of element
  _getAnimationDuration: function _getAnimationDuration(el) {
    var duration = window.getComputedStyle(el).transitionDuration;
    return parseFloat(duration) * (duration.indexOf('ms') !== -1 ? 1 : 1000);
  },
  // ---
  // Set menu hover state
  _setMenuHoverState: function _setMenuHoverState(hovered) {
    this[hovered ? '_addClass' : '_removeClass']('layout-menu-hover');
  },
  // ---
  // Toggle collapsed
  _setCollapsed: function _setCollapsed(collapsed) {
    var _this2 = this;

    if (this.isSmallScreen()) {
      if (collapsed) {
        this._removeClass('layout-menu-expanded');
      } else {
        setTimeout(function () {
          _this2._addClass('layout-menu-expanded');
        }, this._redrawLayoutMenu() ? 5 : 0);
      }
    }
  },
  // ---
  // Add layout sivenav toggle animationEnd event
  _bindLayoutAnimationEndEvent: function _bindLayoutAnimationEndEvent(modifier, cb) {
    var _this3 = this;

    var menu = this.getMenu();
    var duration = menu ? this._getAnimationDuration(menu) + 50 : 0;

    if (!duration) {
      modifier.call(this);
      cb.call(this);
      return;
    }

    this._transitionCallback = function (e) {
      if (e.target !== menu) return;

      _this3._unbindLayoutAnimationEndEvent();

      cb.call(_this3);
    };

    TRANS_EVENTS.forEach(function (e) {
      menu.addEventListener(e, _this3._transitionCallback, false);
    });
    modifier.call(this);
    this._transitionCallbackTimeout = setTimeout(function () {
      _this3._transitionCallback.call(_this3, {
        target: menu
      });
    }, duration);
  },
  // ---
  // Remove layout sivenav toggle animationEnd event
  _unbindLayoutAnimationEndEvent: function _unbindLayoutAnimationEndEvent() {
    var _this4 = this;

    var menu = this.getMenu();

    if (this._transitionCallbackTimeout) {
      clearTimeout(this._transitionCallbackTimeout);
      this._transitionCallbackTimeout = null;
    }

    if (menu && this._transitionCallback) {
      TRANS_EVENTS.forEach(function (e) {
        menu.removeEventListener(e, _this4._transitionCallback, false);
      });
    }

    if (this._transitionCallback) {
      this._transitionCallback = null;
    }
  },
  // ---
  // Bind delayed window resize event
  _bindWindowResizeEvent: function _bindWindowResizeEvent() {
    var _this5 = this;

    this._unbindWindowResizeEvent();

    var cb = function cb() {
      if (_this5._resizeTimeout) {
        clearTimeout(_this5._resizeTimeout);
        _this5._resizeTimeout = null;
      }

      _this5._triggerEvent('resize');
    };

    this._resizeCallback = function () {
      if (_this5._resizeTimeout) clearTimeout(_this5._resizeTimeout);
      _this5._resizeTimeout = setTimeout(cb, _this5.RESIZE_DELAY);
    };

    window.addEventListener('resize', this._resizeCallback, false);
  },
  // ---
  // Unbind delayed window resize event
  _unbindWindowResizeEvent: function _unbindWindowResizeEvent() {
    if (this._resizeTimeout) {
      clearTimeout(this._resizeTimeout);
      this._resizeTimeout = null;
    }

    if (this._resizeCallback) {
      window.removeEventListener('resize', this._resizeCallback, false);
      this._resizeCallback = null;
    }
  },
  _bindMenuMouseEvents: function _bindMenuMouseEvents() {
    var _this6 = this;

    if (this._menuMouseEnter && this._menuMouseLeave && this._windowTouchStart) return;
    var layoutMenu = this.getLayoutMenu();
    if (!layoutMenu) return this._unbindMenuMouseEvents();

    if (!this._menuMouseEnter) {
      this._menuMouseEnter = function () {
        if (_this6.isSmallScreen() || _this6._hasClass('layout-transitioning')) {
          return _this6._setMenuHoverState(false);
        }

        return _this6._setMenuHoverState(false);
      };

      layoutMenu.addEventListener('mouseenter', this._menuMouseEnter, false);
      layoutMenu.addEventListener('touchstart', this._menuMouseEnter, false);
    }

    if (!this._menuMouseLeave) {
      this._menuMouseLeave = function () {
        _this6._setMenuHoverState(false);
      };

      layoutMenu.addEventListener('mouseleave', this._menuMouseLeave, false);
    }

    if (!this._windowTouchStart) {
      this._windowTouchStart = function (e) {
        if (!e || !e.target || !_this6._findParent(e.target, '.layout-menu')) {
          _this6._setMenuHoverState(false);
        }
      };

      window.addEventListener('touchstart', this._windowTouchStart, true);
    }
  },
  _unbindMenuMouseEvents: function _unbindMenuMouseEvents() {
    if (!this._menuMouseEnter && !this._menuMouseLeave && !this._windowTouchStart) return;
    var layoutMenu = this.getLayoutMenu();

    if (this._menuMouseEnter) {
      if (layoutMenu) {
        layoutMenu.removeEventListener('mouseenter', this._menuMouseEnter, false);
        layoutMenu.removeEventListener('touchstart', this._menuMouseEnter, false);
      }

      this._menuMouseEnter = null;
    }

    if (this._menuMouseLeave) {
      if (layoutMenu) {
        layoutMenu.removeEventListener('mouseleave', this._menuMouseLeave, false);
      }

      this._menuMouseLeave = null;
    }

    if (this._windowTouchStart) {
      if (layoutMenu) {
        window.addEventListener('touchstart', this._windowTouchStart, true);
      }

      this._windowTouchStart = null;
    }

    this._setMenuHoverState(false);
  },
  // *******************************************************************************
  // * Methods
  scrollToActive: function scrollToActive() {
    var animate = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;

    this._scrollToActive(animate);
  },
  // ---
  // Collapse / expand layout
  setCollapsed: function setCollapsed() {
    var _this7 = this;

    var collapsed = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : requiredParam('collapsed');
    var animate = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;
    var layoutMenu = this.getLayoutMenu();
    if (!layoutMenu) return;

    this._unbindLayoutAnimationEndEvent();

    if (animate && this._supportsTransitionEnd()) {
      this._addClass('layout-transitioning');

      if (collapsed) this._setMenuHoverState(false);

      this._bindLayoutAnimationEndEvent(function () {
        // Collapse / Expand
        if (_this7.isSmallScreen) _this7._setCollapsed(collapsed);
      }, function () {
        _this7._removeClass('layout-transitioning');

        _this7._triggerWindowEvent('resize');

        _this7._triggerEvent('toggle');

        _this7._setMenuHoverState(false);
      });
    } else {
      this._addClass('layout-no-transition');

      if (collapsed) this._setMenuHoverState(false); // Collapse / Expand

      this._setCollapsed(collapsed);

      setTimeout(function () {
        _this7._removeClass('layout-no-transition');

        _this7._triggerWindowEvent('resize');

        _this7._triggerEvent('toggle');

        _this7._setMenuHoverState(false);
      }, 1);
    }
  },
  // ---
  // Toggle layout
  toggleCollapsed: function toggleCollapsed() {
    var animate = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : true;
    this.setCollapsed(!this.isCollapsed(), animate);
  },
  // ---
  // Set layout positioning
  setPosition: function setPosition() {
    var fixed = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : requiredParam('fixed');
    var offcanvas = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : requiredParam('offcanvas');

    this._removeClass('layout-menu-offcanvas layout-menu-fixed layout-menu-fixed-offcanvas');

    if (!fixed && offcanvas) {
      this._addClass('layout-menu-offcanvas');
    } else if (fixed && !offcanvas) {
      this._addClass('layout-menu-fixed');

      this._redrawLayoutMenu();
    } else if (fixed && offcanvas) {
      this._addClass('layout-menu-fixed-offcanvas');

      this._redrawLayoutMenu();
    }

    this.update();
  },
  // *******************************************************************************
  // * Getters
  getLayoutMenu: function getLayoutMenu() {
    return document.querySelector('.layout-menu');
  },
  getMenu: function getMenu() {
    var layoutMenu = this.getLayoutMenu();
    if (!layoutMenu) return null;
    return !this._hasClass('menu', layoutMenu) ? layoutMenu.querySelector('.menu') : layoutMenu;
  },
  getLayoutNavbar: function getLayoutNavbar() {
    return document.querySelector('.layout-navbar');
  },
  getLayoutFooter: function getLayoutFooter() {
    return document.querySelector('.content-footer');
  },
  // *******************************************************************************
  // * Update
  update: function update() {
    if (this.getLayoutNavbar() && (!this.isSmallScreen() && this.isLayoutNavbarFull() && this.isFixed() || this.isNavbarFixed()) || this.getLayoutFooter() && this.isFooterFixed()) {
      this._updateInlineStyle(this._getNavbarHeight(), this._getFooterHeight());
    }

    this._bindMenuMouseEvents();
  },
  setAutoUpdate: function setAutoUpdate() {
    var _this8 = this;

    var enable = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : requiredParam('enable');

    if (enable && !this._autoUpdate) {
      this.on('resize.Helpers:autoUpdate', function () {
        return _this8.update();
      });
      this._autoUpdate = true;
    } else if (!enable && this._autoUpdate) {
      this.off('resize.Helpers:autoUpdate');
      this._autoUpdate = false;
    }
  },
  // *******************************************************************************
  // * Tests
  isRtl: function isRtl() {
    return document.querySelector('body').getAttribute('dir') === 'rtl' || document.querySelector('html').getAttribute('dir') === 'rtl';
  },
  isMobileDevice: function isMobileDevice() {
    return typeof window.orientation !== 'undefined' || navigator.userAgent.indexOf('IEMobile') !== -1;
  },
  isSmallScreen: function isSmallScreen() {
    return (window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth) < this.LAYOUT_BREAKPOINT;
  },
  isLayoutNavbarFull: function isLayoutNavbarFull() {
    return !!document.querySelector('.layout-wrapper.layout-navbar-full');
  },
  isCollapsed: function isCollapsed() {
    if (this.isSmallScreen()) {
      return !this._hasClass('layout-menu-expanded');
    }

    return this._hasClass('layout-menu-collapsed');
  },
  isFixed: function isFixed() {
    return this._hasClass('layout-menu-fixed layout-menu-fixed-offcanvas');
  },
  isNavbarFixed: function isNavbarFixed() {
    return this._hasClass('layout-navbar-fixed') || !this.isSmallScreen() && this.isFixed() && this.isLayoutNavbarFull();
  },
  isFooterFixed: function isFooterFixed() {
    return this._hasClass('layout-footer-fixed');
  },
  isLightStyle: function isLightStyle() {
    return document.documentElement.classList.contains('light-style');
  },
  // *******************************************************************************
  // * Events
  on: function on() {
    var event = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : requiredParam('event');
    var callback = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : requiredParam('callback');

    var _event$split = event.split('.'),
        _event$split2 = _slicedToArray(_event$split, 1),
        _event = _event$split2[0];

    var _event$split3 = event.split('.'),
        _event$split4 = _toArray(_event$split3),
        namespace = _event$split4.slice(1); // let [_event, ...namespace] = event.split('.')


    namespace = namespace.join('.') || null;

    this._listeners.push({
      event: _event,
      namespace: namespace,
      callback: callback
    });
  },
  off: function off() {
    var _this9 = this;

    var event = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : requiredParam('event');

    var _event$split5 = event.split('.'),
        _event$split6 = _slicedToArray(_event$split5, 1),
        _event = _event$split6[0];

    var _event$split7 = event.split('.'),
        _event$split8 = _toArray(_event$split7),
        namespace = _event$split8.slice(1);

    namespace = namespace.join('.') || null;

    this._listeners.filter(function (listener) {
      return listener.event === _event && listener.namespace === namespace;
    }).forEach(function (listener) {
      return _this9._listeners.splice(_this9._listeners.indexOf(listener), 1);
    });
  },
  // *******************************************************************************
  // * Life cycle
  init: function init() {
    var _this10 = this;

    if (this._initialized) return;
    this._initialized = true; // Initialize \`style\` element

    this._updateInlineStyle(0); // Bind window resize event


    this._bindWindowResizeEvent(); // Bind init event


    this.off('init._Helpers');
    this.on('init._Helpers', function () {
      _this10.off('resize._Helpers:redrawMenu');

      _this10.on('resize._Helpers:redrawMenu', function () {
        // eslint-disable-next-line no-unused-expressions
        _this10.isSmallScreen() && !_this10.isCollapsed() && _this10._redrawLayoutMenu();
      }); // Force repaint in IE 10


      if (typeof document.documentMode === 'number' && document.documentMode < 11) {
        _this10.off('resize._Helpers:ie10RepaintBody');

        _this10.on('resize._Helpers:ie10RepaintBody', function () {
          if (_this10.isFixed()) return;
          var scrollTop = document.documentElement.scrollTop;
          document.body.style.display = 'none'; // document.body.offsetHeight

          document.body.style.display = 'block';
          document.documentElement.scrollTop = scrollTop;
        });
      }
    });

    this._triggerEvent('init');
  },
  destroy: function destroy() {
    var _this11 = this;

    if (!this._initialized) return;
    this._initialized = false;

    this._removeClass('layout-transitioning');

    this._removeInlineStyle();

    this._unbindLayoutAnimationEndEvent();

    this._unbindWindowResizeEvent();

    this._unbindMenuMouseEvents();

    this.setAutoUpdate(false);
    this.off('init._Helpers'); // Remove all listeners except \`init\`

    this._listeners.filter(function (listener) {
      return listener.event !== 'init';
    }).forEach(function (listener) {
      return _this11._listeners.splice(_this11._listeners.indexOf(listener), 1);
    });
  },
  // ---
  // Init Password Toggle
  initPasswordToggle: function initPasswordToggle() {
    var toggler = document.querySelectorAll('.form-password-toggle i');

    if (typeof toggler !== 'undefined' && toggler !== null) {
      toggler.forEach(function (el) {
        el.addEventListener('click', function (e) {
          e.preventDefault();
          var formPasswordToggle = el.closest('.form-password-toggle');
          var formPasswordToggleIcon = formPasswordToggle.querySelector('i');
          var formPasswordToggleInput = formPasswordToggle.querySelector('input');

          if (formPasswordToggleInput.getAttribute('type') === 'text') {
            formPasswordToggleInput.setAttribute('type', 'password');
            formPasswordToggleIcon.classList.replace('bx-show', 'bx-hide');
          } else if (formPasswordToggleInput.getAttribute('type') === 'password') {
            formPasswordToggleInput.setAttribute('type', 'text');
            formPasswordToggleIcon.classList.replace('bx-hide', 'bx-show');
          }
        });
      });
    }
  },
  // ---
  // Init Speech To Text
  initSpeechToText: function initSpeechToText() {
    var SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
    var speechToText = document.querySelectorAll('.speech-to-text');

    if (SpeechRecognition !== undefined && SpeechRecognition !== null) {
      if (typeof speechToText !== 'undefined' && speechToText !== null) {
        var recognition = new SpeechRecognition();
        var toggler = document.querySelectorAll('.speech-to-text i');
        toggler.forEach(function (el) {
          var listening = false;
          el.addEventListener('click', function () {
            el.closest('.input-group').querySelector('.form-control').focus();

            recognition.onspeechstart = function () {
              listening = true;
            };

            if (listening === false) {
              recognition.start();
            }

            recognition.onerror = function () {
              listening = false;
            };

            recognition.onresult = function (event) {
              el.closest('.input-group').querySelector('.form-control').value = event.results[0][0].transcript;
            };

            recognition.onspeechend = function () {
              listening = false;
              recognition.stop();
            };
          });
        });
      }
    }
  },
  // Ajax Call Promise
  ajaxCall: function ajaxCall(url) {
    return new Promise(function (resolve, reject) {
      var req = new XMLHttpRequest();
      req.open('GET', url);

      req.onload = function () {
        return req.status === 200 ? resolve(req.response) : reject(Error(req.statusText));
      };

      req.onerror = function (e) {
        return reject(Error("Network Error: ".concat(e)));
      };

      req.send();
    });
  },
  // ---
  // SidebarToggle (Used in Apps)
  initSidebarToggle: function initSidebarToggle() {
    var sidebarToggler = document.querySelectorAll('[data-bs-toggle="sidebar"]');
    sidebarToggler.forEach(function (el) {
      el.addEventListener('click', function () {
        var target = el.getAttribute('data-target');
        var overlay = el.getAttribute('data-overlay');
        var appOverlay = document.querySelectorAll('.app-overlay');
        var targetEl = document.querySelectorAll(target);
        targetEl.forEach(function (tel) {
          tel.classList.toggle('show');

          if (typeof overlay !== 'undefined' && overlay !== null && overlay !== false && typeof appOverlay !== 'undefined') {
            if (tel.classList.contains('show')) {
              appOverlay[0].classList.add('show');
            } else {
              appOverlay[0].classList.remove('show');
            }

            appOverlay[0].addEventListener('click', function (e) {
              e.currentTarget.classList.remove('show');
              tel.classList.remove('show');
            });
          }
        });
      });
    });
  }
}; // *******************************************************************************
// * Initialization

if (typeof window !== 'undefined') {
  Helpers.init();

  if (Helpers.isMobileDevice() && window.chrome) {
    document.documentElement.classList.add('layout-menu-100vh');
  } // Update layout after page load


  if (document.readyState === 'complete') Helpers.update();else document.addEventListener('DOMContentLoaded', function onContentLoaded() {
    Helpers.update();
    document.removeEventListener('DOMContentLoaded', onContentLoaded);
  });
} // ---


//# sourceURL=[module]
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9qcy9oZWxwZXJzLmpzPzBiMjEiXSwibmFtZXMiOlsiVFJBTlNfRVZFTlRTIiwiVFJBTlNfUFJPUEVSVElFUyIsIklOTElORV9TVFlMRVMiLCJyZXF1aXJlZFBhcmFtIiwibmFtZSIsIkVycm9yIiwiSGVscGVycyIsIlJPT1RfRUwiLCJ3aW5kb3ciLCJkb2N1bWVudCIsImRvY3VtZW50RWxlbWVudCIsIkxBWU9VVF9CUkVBS1BPSU5UIiwiUkVTSVpFX0RFTEFZIiwibWVudVBzU2Nyb2xsIiwibWFpbk1lbnUiLCJfY3VyU3R5bGUiLCJfc3R5bGVFbCIsIl9yZXNpemVUaW1lb3V0IiwiX3Jlc2l6ZUNhbGxiYWNrIiwiX3RyYW5zaXRpb25DYWxsYmFjayIsIl90cmFuc2l0aW9uQ2FsbGJhY2tUaW1lb3V0IiwiX2xpc3RlbmVycyIsIl9pbml0aWFsaXplZCIsIl9hdXRvVXBkYXRlIiwiX2xhc3RXaW5kb3dIZWlnaHQiLCJfc2Nyb2xsVG9BY3RpdmUiLCJhbmltYXRlIiwiZHVyYXRpb24iLCJsYXlvdXRNZW51IiwiZ2V0TGF5b3V0TWVudSIsImFjdGl2ZUVsIiwicXVlcnlTZWxlY3RvciIsImVhc2VJbk91dFF1YWQiLCJ0IiwiYiIsImMiLCJkIiwiZWxlbWVudCIsImdldEJvdW5kaW5nQ2xpZW50UmVjdCIsInRvcCIsInNjcm9sbFRvcCIsInBhcnNlSW50IiwiY2xpZW50SGVpZ2h0Iiwic3RhcnQiLCJjaGFuZ2UiLCJzdGFydERhdGUiLCJEYXRlIiwiYW5pbWF0ZVNjcm9sbCIsImN1cnJlbnREYXRlIiwiY3VycmVudFRpbWUiLCJ2YWwiLCJyZXF1ZXN0QW5pbWF0aW9uRnJhbWUiLCJfYWRkQ2xhc3MiLCJjbHMiLCJlbCIsImxlbmd0aCIsInVuZGVmaW5lZCIsImZvckVhY2giLCJlIiwic3BsaXQiLCJjbGFzc0xpc3QiLCJhZGQiLCJfcmVtb3ZlQ2xhc3MiLCJyZW1vdmUiLCJfdG9nZ2xlQ2xhc3MiLCJjbHMxIiwiY2xzMiIsImNvbnRhaW5zIiwicmVwbGFjZSIsIl9oYXNDbGFzcyIsInJlc3VsdCIsIl9maW5kUGFyZW50IiwidGFnTmFtZSIsInRvVXBwZXJDYXNlIiwicGFyZW50Tm9kZSIsIl90cmlnZ2VyV2luZG93RXZlbnQiLCJjcmVhdGVFdmVudCIsImV2ZW50IiwiRXZlbnQiLCJpbml0RXZlbnQiLCJkaXNwYXRjaEV2ZW50IiwiZmlyZUV2ZW50IiwiY3JlYXRlRXZlbnRPYmplY3QiLCJfdHJpZ2dlckV2ZW50IiwiZmlsdGVyIiwibGlzdGVuZXIiLCJjYWxsYmFjayIsImNhbGwiLCJfdXBkYXRlSW5saW5lU3R5bGUiLCJuYXZiYXJIZWlnaHQiLCJmb290ZXJIZWlnaHQiLCJjcmVhdGVFbGVtZW50IiwidHlwZSIsImhlYWQiLCJhcHBlbmRDaGlsZCIsIm5ld1N0eWxlIiwidGV4dENvbnRlbnQiLCJfcmVtb3ZlSW5saW5lU3R5bGUiLCJyZW1vdmVDaGlsZCIsIl9yZWRyYXdMYXlvdXRNZW51IiwiaW5uZXIiLCJwYWdlU2Nyb2xsVG9wIiwic3R5bGUiLCJkaXNwbGF5IiwiX3N1cHBvcnRzVHJhbnNpdGlvbkVuZCIsIlFVbml0IiwiYm9keSIsImV2bnQiLCJfZ2V0TmF2YmFySGVpZ2h0IiwibGF5b3V0TmF2YmFyIiwiZ2V0TGF5b3V0TmF2YmFyIiwiaXNTbWFsbFNjcmVlbiIsImhlaWdodCIsImNsb25lZEVsIiwiY2xvbmVOb2RlIiwiaWQiLCJ2aXNpYmlsaXR5IiwicG9zaXRpb24iLCJBcnJheSIsInByb3RvdHlwZSIsInNsaWNlIiwicXVlcnlTZWxlY3RvckFsbCIsImluc2VydEJlZm9yZSIsIl9nZXRGb290ZXJIZWlnaHQiLCJsYXlvdXRGb290ZXIiLCJnZXRMYXlvdXRGb290ZXIiLCJfZ2V0QW5pbWF0aW9uRHVyYXRpb24iLCJnZXRDb21wdXRlZFN0eWxlIiwidHJhbnNpdGlvbkR1cmF0aW9uIiwicGFyc2VGbG9hdCIsImluZGV4T2YiLCJfc2V0TWVudUhvdmVyU3RhdGUiLCJob3ZlcmVkIiwiX3NldENvbGxhcHNlZCIsImNvbGxhcHNlZCIsInNldFRpbWVvdXQiLCJfYmluZExheW91dEFuaW1hdGlvbkVuZEV2ZW50IiwibW9kaWZpZXIiLCJjYiIsIm1lbnUiLCJnZXRNZW51IiwidGFyZ2V0IiwiX3VuYmluZExheW91dEFuaW1hdGlvbkVuZEV2ZW50IiwiYWRkRXZlbnRMaXN0ZW5lciIsImNsZWFyVGltZW91dCIsInJlbW92ZUV2ZW50TGlzdGVuZXIiLCJfYmluZFdpbmRvd1Jlc2l6ZUV2ZW50IiwiX3VuYmluZFdpbmRvd1Jlc2l6ZUV2ZW50IiwiX2JpbmRNZW51TW91c2VFdmVudHMiLCJfbWVudU1vdXNlRW50ZXIiLCJfbWVudU1vdXNlTGVhdmUiLCJfd2luZG93VG91Y2hTdGFydCIsIl91bmJpbmRNZW51TW91c2VFdmVudHMiLCJzY3JvbGxUb0FjdGl2ZSIsInNldENvbGxhcHNlZCIsInRvZ2dsZUNvbGxhcHNlZCIsImlzQ29sbGFwc2VkIiwic2V0UG9zaXRpb24iLCJmaXhlZCIsIm9mZmNhbnZhcyIsInVwZGF0ZSIsImlzTGF5b3V0TmF2YmFyRnVsbCIsImlzRml4ZWQiLCJpc05hdmJhckZpeGVkIiwiaXNGb290ZXJGaXhlZCIsInNldEF1dG9VcGRhdGUiLCJlbmFibGUiLCJvbiIsIm9mZiIsImlzUnRsIiwiZ2V0QXR0cmlidXRlIiwiaXNNb2JpbGVEZXZpY2UiLCJvcmllbnRhdGlvbiIsIm5hdmlnYXRvciIsInVzZXJBZ2VudCIsImlubmVyV2lkdGgiLCJjbGllbnRXaWR0aCIsImlzTGlnaHRTdHlsZSIsIl9ldmVudCIsIm5hbWVzcGFjZSIsImpvaW4iLCJwdXNoIiwic3BsaWNlIiwiaW5pdCIsImRvY3VtZW50TW9kZSIsImRlc3Ryb3kiLCJpbml0UGFzc3dvcmRUb2dnbGUiLCJ0b2dnbGVyIiwicHJldmVudERlZmF1bHQiLCJmb3JtUGFzc3dvcmRUb2dnbGUiLCJjbG9zZXN0IiwiZm9ybVBhc3N3b3JkVG9nZ2xlSWNvbiIsImZvcm1QYXNzd29yZFRvZ2dsZUlucHV0Iiwic2V0QXR0cmlidXRlIiwiaW5pdFNwZWVjaFRvVGV4dCIsIlNwZWVjaFJlY29nbml0aW9uIiwid2Via2l0U3BlZWNoUmVjb2duaXRpb24iLCJzcGVlY2hUb1RleHQiLCJyZWNvZ25pdGlvbiIsImxpc3RlbmluZyIsImZvY3VzIiwib25zcGVlY2hzdGFydCIsIm9uZXJyb3IiLCJvbnJlc3VsdCIsInZhbHVlIiwicmVzdWx0cyIsInRyYW5zY3JpcHQiLCJvbnNwZWVjaGVuZCIsInN0b3AiLCJhamF4Q2FsbCIsInVybCIsIlByb21pc2UiLCJyZXNvbHZlIiwicmVqZWN0IiwicmVxIiwiWE1MSHR0cFJlcXVlc3QiLCJvcGVuIiwib25sb2FkIiwic3RhdHVzIiwicmVzcG9uc2UiLCJzdGF0dXNUZXh0Iiwic2VuZCIsImluaXRTaWRlYmFyVG9nZ2xlIiwic2lkZWJhclRvZ2dsZXIiLCJvdmVybGF5IiwiYXBwT3ZlcmxheSIsInRhcmdldEVsIiwidGVsIiwidG9nZ2xlIiwiY3VycmVudFRhcmdldCIsImNocm9tZSIsInJlYWR5U3RhdGUiLCJvbkNvbnRlbnRMb2FkZWQiXSwibWFwcGluZ3MiOiI7Ozs7Ozs7Ozs7Ozs7Ozs7OztBQUFBO0FBQ0EsSUFBTUEsWUFBWSxHQUFHLENBQUMsZUFBRCxFQUFrQixxQkFBbEIsRUFBeUMsZ0JBQXpDLENBQXJCO0FBQ0EsSUFBTUMsZ0JBQWdCLEdBQUcsQ0FBQyxZQUFELEVBQWUsZUFBZixFQUFnQyxrQkFBaEMsRUFBb0Qsa0JBQXBELEVBQXdFLGFBQXhFLENBQXpCO0FBQ0EsSUFBTUMsYUFBYSxrTUFBbkIsQyxDQVNBOztBQUNBLFNBQVNDLGFBQVQsQ0FBdUJDLElBQXZCLEVBQTZCO0FBQzNCLFFBQU0sSUFBSUMsS0FBSiw2QkFBK0JELElBQUksZ0JBQVVBLElBQVYsU0FBcUIsRUFBeEQsRUFBTjtBQUNEOztBQUVELElBQU1FLE9BQU8sR0FBRztBQUNkO0FBQ0FDLFNBQU8sRUFBRSxPQUFPQyxNQUFQLEtBQWtCLFdBQWxCLEdBQWdDQyxRQUFRLENBQUNDLGVBQXpDLEdBQTJELElBRnREO0FBSWQ7QUFDQUMsbUJBQWlCLEVBQUUsSUFM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Q0FBNEIsTUFBNUI7QUFDRCxhQUZELE1BRU87QUFDTG9LLHdCQUFVLENBQUMsQ0FBRCxDQUFWLENBQWNySyxTQUFkLENBQXdCRyxNQUF4QixDQUErQixNQUEvQjtBQUNEOztBQUNEa0ssc0JBQVUsQ0FBQyxDQUFELENBQVYsQ0FBY2xGLGdCQUFkLENBQStCLE9BQS9CLEVBQXdDLFVBQUFyRixDQUFDLEVBQUk7QUFDM0NBLGVBQUMsQ0FBQzJLLGFBQUYsQ0FBZ0J6SyxTQUFoQixDQUEwQkcsTUFBMUIsQ0FBaUMsTUFBakM7QUFDQW9LLGlCQUFHLENBQUN2SyxTQUFKLENBQWNHLE1BQWQsQ0FBcUIsTUFBckI7QUFDRCxhQUhEO0FBSUQ7QUFDRixTQWxCRDtBQW1CRCxPQXpCRDtBQTBCRCxLQTNCRDtBQTRCRDtBQXp5QmEsQ0FBaEIsQyxDQTR5QkE7QUFDQTs7QUFFQSxJQUFJLE9BQU92RCxNQUFQLEtBQWtCLFdBQXRCLEVBQW1DO0FBQ2pDRixTQUFPLENBQUNpTCxJQUFSOztBQUVBLE1BQUlqTCxPQUFPLENBQUNxSyxjQUFSLE1BQTRCbkssTUFBTSxDQUFDOE4sTUFBdkMsRUFBK0M7QUFDN0M3TixZQUFRLENBQUNDLGVBQVQsQ0FBeUJrRCxTQUF6QixDQUFtQ0MsR0FBbkMsQ0FBdUMsbUJBQXZDO0FBQ0QsR0FMZ0MsQ0FPakM7OztBQUNBLE1BQUlwRCxRQUFRLENBQUM4TixVQUFULEtBQXdCLFVBQTVCLEVBQXdDak8sT0FBTyxDQUFDMEosTUFBUixHQUF4QyxLQUVFdkosUUFBUSxDQUFDc0ksZ0JBQVQsQ0FBMEIsa0JBQTFCLEVBQThDLFNBQVN5RixlQUFULEdBQTJCO0FBQ3ZFbE8sV0FBTyxDQUFDMEosTUFBUjtBQUNBdkosWUFBUSxDQUFDd0ksbUJBQVQsQ0FBNkIsa0JBQTdCLEVBQWlEdUYsZUFBakQ7QUFDRCxHQUhEO0FBSUgsQyxDQUVEIiwiZmlsZSI6Ii4vanMvaGVscGVycy5qcy5qcyIsInNvdXJjZXNDb250ZW50IjpbIi8vIENvbnN0YW50c1xuY29uc3QgVFJBTlNfRVZFTlRTID0gWyd0cmFuc2l0aW9uZW5kJywgJ3dlYmtpdFRyYW5zaXRpb25FbmQnLCAnb1RyYW5zaXRpb25FbmQnXVxuY29uc3QgVFJBTlNfUFJPUEVSVElFUyA9IFsndHJhbnNpdGlvbicsICdNb3pUcmFuc2l0aW9uJywgJ3dlYmtpdFRyYW5zaXRpb24nLCAnV2Via2l0VHJhbnNpdGlvbicsICdPVHJhbnNpdGlvbiddXG5jb25zdCBJTkxJTkVfU1RZTEVTID0gYFxuLmxheW91dC1tZW51LWZpeGVkIC5sYXlvdXQtbmF2YmFyLWZ1bGwgLmxheW91dC1tZW51LFxuLmxheW91dC1wYWdlIHtcbiAgcGFkZGluZy10b3A6IHtuYXZiYXJIZWlnaHR9cHggIWltcG9ydGFudDtcbn1cbi5jb250ZW50LXdyYXBwZXIge1xuICBwYWRkaW5nLWJvdHRvbToge2Zvb3RlckhlaWdodH1weCAhaW1wb3J0YW50O1xufWBcblxuLy8gR3VhcmRcbmZ1bmN0aW9uIHJlcXVpcmVkUGFyYW0obmFtZSkge1xuICB0aHJvdyBuZXcgRXJyb3IoYFBhcmFtZXRlciByZXF1aXJlZCR7bmFtZSA/IGA6IFxcYCR7bmFtZX1cXGBgIDogJyd9YClcbn1cblxuY29uc3QgSGVscGVycyA9IHtcbiAgLy8gUm9vdCBFbGVtZW50XG4gIFJPT1RfRUw6IHR5cGVvZiB3aW5kb3cgIT09ICd1bmRlZmluZWQnID8gZG9jdW1lbnQuZG9jdW1lbnRFbGVtZW50IDogbnVsbCxcblxuICAvLyBMYXJnZSBzY3JlZW5zIGJyZWFrcG9pbnRcbiAgTEFZT1VUX0JSRUFLUE9JTlQ6IDEyMDAsXG5cbiAgLy8gUmVzaXplIGRlbGF5IGluIG1pbGxpc2Vjb25kc1xuICBSRVNJWkVfREVMQVk6IDIwMCxcblxuICBtZW51UHNTY3JvbGw6IG51bGwsXG5cbiAgbWFpbk1lbnU6IG51bGwsXG5cbiAgLy8gSW50ZXJuYWwgdmFyaWFibGVzXG4gIF9jdXJTdHlsZTogbnVsbCxcbiAgX3N0eWxlRWw6IG51bGwsXG4gIF9yZXNpemVUaW1lb3V0OiBudWxsLFxuICBfcmVzaXplQ2FsbGJhY2s6IG51bGwsXG4gIF90cmFuc2l0aW9uQ2FsbGJhY2s6IG51bGwsXG4gIF90cmFuc2l0aW9uQ2FsbGJhY2tUaW1lb3V0OiBudWxsLFxuICBfbGlzdGVuZXJzOiBbXSxcbiAgX2luaXRpYWxpemVkOiBmYWxzZSxcbiAgX2F1dG9VcGRhdGU6IGZhbHNlLFxuICBfbGFzdFdpbmRvd0hlaWdodDogMCxcblxuICAvLyAqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqXG4gIC8vICogVXRpbGl0aWVzXG5cbiAgLy8gLS0tXG4gIC8vIFNjcm9sbCBUbyBBY3RpdmUgTWVudSBJdGVtXG4gIF9zY3JvbGxUb0FjdGl2ZShhbmltYXRlID0gZmFsc2UsIGR1cmF0aW9uID0gNTAwKSB7XG4gICAgY29uc3QgbGF5b3V0TWVudSA9IHRoaXMuZ2V0TGF5b3V0TWVudSgpXG5cbiAgICBpZiAoIWxheW91dE1lbnUpIHJldHVyblxuXG4gICAgbGV0IGFjdGl2ZUVsID0gbGF5b3V0TWVudS5xdWVyeVNlbGVjdG9yKCdsaS5tZW51LWl0ZW0uYWN0aXZlOm5vdCgub3BlbiknKVxuXG4gICAgaWYgKGFjdGl2ZUVsKSB7XG4gICAgICAvLyB0ID0gY3VycmVudCB0aW1lXG4gICAgICAvLyBiID0gc3RhcnQgdmFsdWVcbiAgICAgIC8vIGMgPSBjaGFuZ2UgaW4gdmFsdWVcbiAgICAgIC8vIGQgPSBkdXJhdGlvblxuICAgICAgY29uc3QgZWFzZUluT3V0UXVhZCA9ICh0LCBiLCBjLCBkKSA9PiB7XG4gICAgICAgIHQgLz0gZCAvIDJcbiAgICAgICAgaWYgKHQgPCAxKSByZXR1cm4gKGMgLyAyKSAqIHQgKiB0ICsgYlxuICAgICAgICB0IC09IDFcbiAgICAgICAgcmV0dXJuICgtYyAvIDIpICogKHQgKiAodCAtIDIpIC0gMSkgKyBiXG4gICAgICB9XG5cbiAgICAgIGNvbnN0IGVsZW1lbnQgPSB0aGlzLmdldExheW91dE1lbnUoKS5xdWVyeVNlbGVjdG9yKCcubWVudS1pbm5lcicpXG5cbiAgICAgIGlmICh0eXBlb2YgYWN0aXZlRWwgPT09ICdzdHJpbmcnKSB7XG4gICAgICAgIGFjdGl2ZUVsID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcihhY3RpdmVFbClcbiAgICAgIH1cbiAgICAgIGlmICh0eXBlb2YgYWN0aXZlRWwgIT09ICdudW1iZXInKSB7XG4gICAgICAgIGFjdGl2ZUVsID0gYWN0aXZlRWwuZ2V0Qm91bmRpbmdDbGllbnRSZWN0KCkudG9wICsgZWxlbWVudC5zY3JvbGxUb3BcbiAgICAgIH1cblxuICAgICAgLy8gSWYgYWN0aXZlIGVsZW1lbnQncyB0b3AgcG9zaXRpb24gaXMgbGVzcyB0aGFuIDIvMyAoNjYlKSBvZiBtZW51IGhlaWdodCB0aGFuIGRvIG5vdCBzY3JvbGxcbiAgICAgIGlmIChhY3RpdmVFbCA8IHBhcnNlSW50KChlbGVtZW50LmNsaWVudEhlaWdodCAqIDIpIC8gMywgMTApKSByZXR1cm5cblxuICAgICAgY29uc3Qgc3RhcnQgPSBlbGVtZW50LnNjcm9sbFRvcFxuICAgICAgY29uc3QgY2hhbmdlID0gYWN0aXZlRWwgLSBzdGFydCAtIHBhcnNlSW50KGVsZW1lbnQuY2xpZW50SGVpZ2h0IC8gMiwgMTApXG4gICAgICBjb25zdCBzdGFydERhdGUgPSArbmV3IERhdGUoKVxuXG4gICAgICBpZiAoYW5pbWF0ZSA9PT0gdHJ1ZSkge1xuICAgICAgICBjb25zdCBhbmltYXRlU2Nyb2xsID0gKCkgPT4ge1xuICAgICAgICAgIGNvbnN0IGN1cnJlbnREYXRlID0gK25ldyBEYXRlKClcbiAgICAgICAgICBjb25zdCBjdXJyZW50VGltZSA9IGN1cnJlbnREYXRlIC0gc3RhcnREYXRlXG4gICAgICAgICAgY29uc3QgdmFsID0gZWFzZUluT3V0UXVhZChjdXJyZW50VGltZSwgc3RhcnQsIGNoYW5nZSwgZHVyYXRpb24pXG4gICAgICAgICAgZWxlbWVudC5zY3JvbGxUb3AgPSB2YWxcbiAgICAgICAgICBpZiAoY3VycmVudFRpbWUgPCBkdXJhdGlvbikge1xuICAgICAgICAgICAgcmVxdWVzdEFuaW1hdGlvbkZyYW1lKGFuaW1hdGVTY3JvbGwpXG4gICAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgIGVsZW1lbnQuc2Nyb2xsVG9wID0gY2hhbmdlXG4gICAgICAgICAgfVxuICAgICAgICB9XG4gICAgICAgIGFuaW1hdGVTY3JvbGwoKVxuICAgICAgfSBlbHNlIHtcbiAgICAgICAgZWxlbWVudC5zY3JvbGxUb3AgPSBjaGFuZ2VcbiAgICAgIH1cbiAgICB9XG4gIH0sXG5cbiAgLy8gLS0tXG4gIC8vIEFkZCBjbGFzc2VzXG4gIF9hZGRDbGFzcyhjbHMsIGVsID0gdGhpcy5ST09UX0VMKSB7XG4gICAgaWYgKGVsLmxlbmd0aCAhPT0gdW5kZWZpbmVkKSB7XG4gICAgICAvLyBBZGQgY2xhc3NlcyB0byBtdWx0aXBsZSBlbGVtZW50c1xuICAgICAgZWwuZm9yRWFjaChlID0+IHtcbiAgICAgICAgY2xzLnNwbGl0KCcgJykuZm9yRWFjaChjID0+IGUuY2xhc3NMaXN0LmFkZChjKSlcbiAgICAgIH0pXG4gICAgfSBlbHNlIHtcbiAgICAgIC8vIEFkZCBjbGFzc2VzIHRvIHNpbmdsZSBlbGVtZW50XG4gICAgICBjbHMuc3BsaXQoJyAnKS5mb3JFYWNoKGMgPT4gZWwuY2xhc3NMaXN0LmFkZChjKSlcbiAgICB9XG4gIH0sXG5cbiAgLy8gLS0tXG4gIC8vIFJlbW92ZSBjbGFzc2VzXG4gIF9yZW1vdmVDbGFzcyhjbHMsIGVsID0gdGhpcy5ST09UX0VMKSB7XG4gICAgaWYgKGVsLmxlbmd0aCAhPT0gdW5kZWZpbmVkKSB7XG4gICAgICAvLyBSZW1vdmUgY2xhc3NlcyB0byBtdWx0aXBsZSBlbGVtZW50c1xuICAgICAgZWwuZm9yRWFjaChlID0+IHtcbiAgICAgICAgY2xzLnNwbGl0KCcgJykuZm9yRWFjaChjID0+IGUuY2xhc3NMaXN0LnJlbW92ZShjKSlcbiAgICAgIH0pXG4gICAgfSBlbHNlIHtcbiAgICAgIC8vIFJlbW92ZSBjbGFzc2VzIHRvIHNpbmdsZSBlbGVtZW50XG4gICAgICBjbHMuc3BsaXQoJyAnKS5mb3JFYWNoKGMgPT4gZWwuY2xhc3NMaXN0LnJlbW92ZShjKSlcbiAgICB9XG4gIH0sXG5cbiAgLy8gVG9nZ2xlIGNsYXNzZXNcbiAgX3RvZ2dsZUNsYXNzKGVsID0gdGhpcy5ST09UX0VMLCBjbHMxLCBjbHMyKSB7XG4gICAgaWYgKGVsLmNsYXNzTGlzdC5jb250YWlucyhjbHMxKSkge1xuICAgICAgZWwuY2xhc3NMaXN0LnJlcGxhY2UoY2xzMSwgY2xzMilcbiAgICB9IGVsc2Uge1xuICAgICAgZWwuY2xhc3NMaXN0LnJlcGxhY2UoY2xzMiwgY2xzMSlcbiAgICB9XG4gIH0sXG5cbiAgLy8gLS0tXG4gIC8vIEhhcyBjbGFzc1xuICBfaGFzQ2xhc3MoY2xzLCBlbCA9IHRoaXMuUk9PVF9FTCkge1xuICAgIGxldCByZXN1bHQgPSBmYWxzZVxuXG4gICAgY2xzLnNwbGl0KCcgJykuZm9yRWFjaChjID0+IHtcbiAgICAgIGlmIChlbC5jbGFzc0xpc3QuY29udGFpbnMoYykpIHJlc3VsdCA9IHRydWVcbiAgICB9KVxuXG4gICAgcmV0dXJuIHJlc3VsdFxuICB9LFxuXG4gIF9maW5kUGFyZW50KGVsLCBjbHMpIHtcbiAgICBpZiAoKGVsICYmIGVsLnRhZ05hbWUudG9VcHBlckNhc2UoKSA9PT0gJ0JPRFknKSB8fCBlbC50YWdOYW1lLnRvVXBwZXJDYXNlKCkgPT09ICdIVE1MJykgcmV0dXJuIG51bGxcbiAgICBlbCA9IGVsLnBhcmVudE5vZGVcbiAgICB3aGlsZSAoZWwgJiYgZWwudGFnTmFtZS50b1VwcGVyQ2FzZSgpICE9PSAnQk9EWScgJiYgIWVsLmNsYXNzTGlzdC5jb250YWlucyhjbHMpKSB7XG4gICAgICBlbCA9IGVsLnBhcmVudE5vZGVcbiAgICB9XG4gICAgZWwgPSBlbCAmJiBlbC50YWdOYW1lLnRvVXBwZXJDYXNlKCkgIT09ICdCT0RZJyA/IGVsIDogbnVsbFxuICAgIHJldHVybiBlbFxuICB9LFxuXG4gIC8vIC0tLVxuICAvLyBUcmlnZ2VyIHdpbmRvdyBldmVudFxuICBfdHJpZ2dlcldpbmRvd0V2ZW50KG5hbWUpIHtcbiAgICBpZiAodHlwZW9mIHdpbmRvdyA9PT0gJ3VuZGVmaW5lZCcpIHJldHVyblxuXG4gICAgaWYgKGRvY3VtZW50LmNyZWF0ZUV2ZW50KSB7XG4gICAgICBsZXQgZXZlbnRcblxuICAgICAgaWYgKHR5cGVvZiBFdmVudCA9PT0gJ2Z1bmN0aW9uJykge1xuICAgICAgICBldmVudCA9IG5ldyBFdmVudChuYW1lKVxuICAgICAgfSBlbHNlIHtcbiAgICAgICAgZXZlbnQgPSBkb2N1bWVudC5jcmVhdGVFdmVudCgnRXZlbnQnKVxuICAgICAgICBldmVudC5pbml0RXZlbnQobmFtZSwgZmFsc2UsIHRydWUpXG4gICAgICB9XG5cbiAgICAgIHdpbmRvdy5kaXNwYXRjaEV2ZW50KGV2ZW50KVxuICAgIH0gZWxzZSB7XG4gICAgICB3aW5kb3cuZmlyZUV2ZW50KGBvbiR7bmFtZX1gLCBkb2N1bWVudC5jcmVhdGVFdmVudE9iamVjdCgpKVxuICAgIH1cbiAgfSxcblxuICAvLyAtLS1cbiAgLy8gVHJpZ2dlciBldmVudFxuICBfdHJpZ2dlckV2ZW50KG5hbWUpIHtcbiAgICB0aGlzLl90cmlnZ2VyV2luZG93RXZlbnQoYGxheW91dCR7bmFtZX1gKVxuXG4gICAgdGhpcy5fbGlzdGVuZXJzLmZpbHRlcihsaXN0ZW5lciA9PiBsaXN0ZW5lci5ldmVudCA9PT0gbmFtZSkuZm9yRWFjaChsaXN0ZW5lciA9PiBsaXN0ZW5lci5jYWxsYmFjay5jYWxsKG51bGwpKVxuICB9LFxuXG4gIC8vIC0tLVxuICAvLyBVcGRhdGUgc3R5bGVcbiAgX3VwZGF0ZUlubGluZVN0eWxlKG5hdmJhckhlaWdodCA9IDAsIGZvb3RlckhlaWdodCA9IDApIHtcbiAgICBpZiAoIXRoaXMuX3N0eWxlRWwpIHtcbiAgICAgIHRoaXMuX3N0eWxlRWwgPSBkb2N1bWVudC5jcmVhdGVFbGVtZW50KCdzdHlsZScpXG4gICAgICB0aGlzLl9zdHlsZUVsLnR5cGUgPSAndGV4dC9jc3MnXG4gICAgICBkb2N1bWVudC5oZWFkLmFwcGVuZENoaWxkKHRoaXMuX3N0eWxlRWwpXG4gICAgfVxuXG4gICAgY29uc3QgbmV3U3R5bGUgPSBJTkxJTkVfU1RZTEVTLnJlcGxhY2UoL1xce25hdmJhckhlaWdodFxcfS9naSwgbmF2YmFySGVpZ2h0KS5yZXBsYWNlKFxuICAgICAgL1xce2Zvb3RlckhlaWdodFxcfS9naSxcbiAgICAgIGZvb3RlckhlaWdodFxuICAgIClcblxuICAgIGlmICh0aGlzLl9jdXJTdHlsZSAhPT0gbmV3U3R5bGUpIHtcbiAgICAgIHRoaXMuX2N1clN0eWxlID0gbmV3U3R5bGVcbiAgICAgIHRoaXMuX3N0eWxlRWwudGV4dENvbnRlbnQgPSBuZXdTdHlsZVxuICAgIH1cbiAgfSxcblxuICAvLyAtLS1cbiAgLy8gUmVtb3ZlIHN0eWxlXG4gIF9yZW1vdmVJbmxpbmVTdHlsZSgpIHtcbiAgICBpZiAodGhpcy5fc3R5bGVFbCkgZG9jdW1lbnQuaGVhZC5yZW1vdmVDaGlsZCh0aGlzLl9zdHlsZUVsKVxuICAgIHRoaXMuX3N0eWxlRWwgPSBudWxsXG4gICAgdGhpcy5fY3VyU3R5bGUgPSBudWxsXG4gIH0sXG5cbiAgLy8gLS0tXG4gIC8vIFJlZHJhdyBsYXlvdXQgbWVudSAoU2FmYXJpIGJ1Z2ZpeClcbiAgX3JlZHJhd0xheW91dE1lbnUoKSB7XG4gICAgY29uc3QgbGF5b3V0TWVudSA9IHRoaXMuZ2V0TGF5b3V0TWVudSgpXG5cbiAgICBpZiAobGF5b3V0TWVudSAmJiBsYXlvdXRNZW51LnF1ZXJ5U2VsZWN0b3IoJy5tZW51JykpIHtcbiAgICAgIGNvbnN0IGlubmVyID0gbGF5b3V0TWVudS5xdWVyeVNlbGVjdG9yKCcubWVudS1pbm5lcicpXG4gICAgICBjb25zdCB7IHNjcm9sbFRvcCB9ID0gaW5uZXJcbiAgICAgIGNvbnN0IHBhZ2VTY3JvbGxUb3AgPSBkb2N1bWVudC5kb2N1bWVudEVsZW1lbnQuc2Nyb2xsVG9wXG5cbiAgICAgIGxheW91dE1lbnUuc3R5bGUuZGlzcGxheSA9ICdub25lJ1xuICAgICAgLy8gbGF5b3V0TWVudS5vZmZzZXRIZWlnaHRcbiAgICAgIGxheW91dE1lbnUuc3R5bGUuZGlzcGxheSA9ICcnXG4gICAgICBpbm5lci5zY3JvbGxUb3AgPSBzY3JvbGxUb3BcbiAgICAgIGRvY3VtZW50LmRvY3VtZW50RWxlbWVudC5zY3JvbGxUb3AgPSBwYWdlU2Nyb2xsVG9wXG5cbiAgICAgIHJldHVybiB0cnVlXG4gICAgfVxuXG4gICAgcmV0dXJuIGZhbHNlXG4gIH0sXG5cbiAgLy8gLS0tXG4gIC8vIENoZWNrIGZvciB0cmFuc2l0aW9uIHN1cHBvcnRcbiAgX3N1cHBvcnRzVHJhbnNpdGlvbkVuZCgpIHtcbiAgICBpZiAod2luZG93LlFVbml0KSByZXR1cm4gZmFsc2VcblxuICAgIGNvbnN0IGVsID0gZG9jdW1lbnQuYm9keSB8fCBkb2N1bWVudC5kb2N1bWVudEVsZW1lbnRcblxuICAgIGlmICghZWwpIHJldHVybiBmYWxzZVxuXG4gICAgbGV0IHJlc3VsdCA9IGZhbHNlXG4gICAgVFJBTlNfUFJPUEVSVElFUy5mb3JFYWNoKGV2bnQgPT4ge1xuICAgICAgaWYgKHR5cGVvZiBlbC5zdHlsZVtldm50XSAhPT0gJ3VuZGVmaW5lZCcpIHJlc3VsdCA9IHRydWVcbiAgICB9KVxuXG4gICAgcmV0dXJuIHJlc3VsdFxuICB9LFxuXG4gIC8vIC0tLVxuICAvLyBDYWxjdWxhdGUgY3VycmVudCBuYXZiYXIgaGVpZ2h0XG4gIF9nZXROYXZiYXJIZWlnaHQoKSB7XG4gICAgY29uc3QgbGF5b3V0TmF2YmFyID0gdGhpcy5nZXRMYXlvdXROYXZiYXIoKVxuXG4gICAgaWYgKCFsYXlvdXROYXZiYXIpIHJldHVybiAwXG4gICAgaWYgKCF0aGlzLmlzU21hbGxTY3JlZW4oKSkgcmV0dXJuIGxheW91dE5hdmJhci5nZXRCb3VuZGluZ0NsaWVudFJlY3QoKS5oZWlnaHRcblxuICAgIC8vIE5lZWRzIHNvbWUgbG9naWMgdG8gZ2V0IG5hdmJhciBoZWlnaHQgb24gc21hbGwgc2NyZWVuc1xuXG4gICAgY29uc3QgY2xvbmVkRWwgPSBsYXlvdXROYXZiYXIuY2xvbmVOb2RlKHRydWUpXG4gICAgY2xvbmVkRWwuaWQgPSBudWxsXG4gICAgY2xvbmVkRWwuc3R5bGUudmlzaWJpbGl0eSA9ICdoaWRkZW4nXG4gICAgY2xvbmVkRWwuc3R5bGUucG9zaXRpb24gPSAnYWJzb2x1dGUnXG5cbiAgICBBcnJheS5wcm90b3R5cGUuc2xpY2UuY2FsbChjbG9uZWRFbC5xdWVyeVNlbGVjdG9yQWxsKCcuY29sbGFwc2Uuc2hvdycpKS5mb3JFYWNoKGVsID0+IHRoaXMuX3JlbW92ZUNsYXNzKCdzaG93JywgZWwpKVxuXG4gICAgbGF5b3V0TmF2YmFyLnBhcmVudE5vZGUuaW5zZXJ0QmVmb3JlKGNsb25lZEVsLCBsYXlvdXROYXZiYXIpXG5cbiAgICBjb25zdCBuYXZiYXJIZWlnaHQgPSBjbG9uZWRFbC5nZXRCb3VuZGluZ0NsaWVudFJlY3QoKS5oZWlnaHRcblxuICAgIGNsb25lZEVsLnBhcmVudE5vZGUucmVtb3ZlQ2hpbGQoY2xvbmVkRWwpXG5cbiAgICByZXR1cm4gbmF2YmFySGVpZ2h0XG4gIH0sXG5cbiAgLy8gLS0tXG4gIC8vIEdldCBjdXJyZW50IGZvb3RlciBoZWlnaHRcbiAgX2dldEZvb3RlckhlaWdodCgpIHtcbiAgICBjb25zdCBsYXlvdXRGb290ZXIgPSB0aGlzLmdldExheW91dEZvb3RlcigpXG5cbiAgICBpZiAoIWxheW91dEZvb3RlcikgcmV0dXJuIDBcblxuICAgIHJldHVybiBsYXlvdXRGb290ZXIuZ2V0Qm91bmRpbmdDbGllbnRSZWN0KCkuaGVpZ2h0XG4gIH0sXG5cbiAgLy8gLS0tXG4gIC8vIEdldCBhbmltYXRpb24gZHVyYXRpb24gb2YgZWxlbWVudFxuICBfZ2V0QW5pbWF0aW9uRHVyYXRpb24oZWwpIHtcbiAgICBjb25zdCBkdXJhdGlvbiA9IHdpbmRvdy5nZXRDb21wdXRlZFN0eWxlKGVsKS50cmFuc2l0aW9uRHVyYXRpb25cblxuICAgIHJldHVybiBwYXJzZUZsb2F0KGR1cmF0aW9uKSAqIChkdXJhdGlvbi5pbmRleE9mKCdtcycpICE9PSAtMSA/IDEgOiAxMDAwKVxuICB9LFxuXG4gIC8vIC0tLVxuICAvLyBTZXQgbWVudSBob3ZlciBzdGF0ZVxuICBfc2V0TWVudUhvdmVyU3RhdGUoaG92ZXJlZCkge1xuICAgIHRoaXNbaG92ZXJlZCA/ICdfYWRkQ2xhc3MnIDogJ19yZW1vdmVDbGFzcyddKCdsYXlvdXQtbWVudS1ob3ZlcicpXG4gIH0sXG5cbiAgLy8gLS0tXG4gIC8vIFRvZ2dsZSBjb2xsYXBzZWRcbiAgX3NldENvbGxhcHNlZChjb2xsYXBzZWQpIHtcbiAgICBpZiAodGhpcy5pc1NtYWxsU2NyZWVuKCkpIHtcbiAgICAgIGlmIChjb2xsYXBzZWQpIHtcbiAgICAgICAgdGhpcy5fcmVtb3ZlQ2xhc3MoJ2xheW91dC1tZW51LWV4cGFuZGVkJylcbiAgICAgIH0gZWxzZSB7XG4gICAgICAgIHNldFRpbWVvdXQoXG4gICAgICAgICAgKCkgPT4ge1xuICAgICAgICAgICAgdGhpcy5fYWRkQ2xhc3MoJ2xheW91dC1tZW51LWV4cGFuZGVkJylcbiAgICAgICAgICB9LFxuICAgICAgICAgIHRoaXMuX3JlZHJhd0xheW91dE1lbnUoKSA/IDUgOiAwXG4gICAgICAgIClcbiAgICAgIH1cbiAgICB9XG4gIH0sXG5cbiAgLy8gLS0tXG4gIC8vIEFkZCBsYXlvdXQgc2l2ZW5hdiB0b2dnbGUgYW5pbWF0aW9uRW5kIGV2ZW50XG4gIF9iaW5kTGF5b3V0QW5pbWF0aW9uRW5kRXZlbnQobW9kaWZpZXIsIGNiKSB7XG4gICAgY29uc3QgbWVudSA9IHRoaXMuZ2V0TWVudSgpXG4gICAgY29uc3QgZHVyYXRpb24gPSBtZW51ID8gdGhpcy5fZ2V0QW5pbWF0aW9uRHVyYXRpb24obWVudSkgKyA1MCA6IDBcblxuICAgIGlmICghZHVyYXRpb24pIHtcbiAgICAgIG1vZGlmaWVyLmNhbGwodGhpcylcbiAgICAgIGNiLmNhbGwodGhpcylcbiAgICAgIHJldHVyblxuICAgIH1cblxuICAgIHRoaXMuX3RyYW5zaXRpb25DYWxsYmFjayA9IGUgPT4ge1xuICAgICAgaWYgKGUudGFyZ2V0ICE9PSBtZW51KSByZXR1cm5cbiAgICAgIHRoaXMuX3VuYmluZExheW91dEFuaW1hdGlvbkVuZEV2ZW50KClcbiAgICAgIGNiLmNhbGwodGhpcylcbiAgICB9XG5cbiAgICBUUkFOU19FVkVOVFMuZm9yRWFjaChlID0+IHtcbiAgICAgIG1lbnUuYWRkRXZlbnRMaXN0ZW5lcihlLCB0aGlzLl90cmFuc2l0aW9uQ2FsbGJhY2ssIGZhbHNlKVxuICAgIH0pXG5cbiAgICBtb2RpZmllci5jYWxsKHRoaXMpXG5cbiAgICB0aGlzLl90cmFuc2l0aW9uQ2FsbGJhY2tUaW1lb3V0ID0gc2V0VGltZW91dCgoKSA9PiB7XG4gICAgICB0aGlzLl90cmFuc2l0aW9uQ2FsbGJhY2suY2FsbCh0aGlzLCB7IHRhcmdldDogbWVudSB9KVxuICAgIH0sIGR1cmF0aW9uKVxuICB9LFxuXG4gIC8vIC0tLVxuICAvLyBSZW1vdmUgbGF5b3V0IHNpdmVuYXYgdG9nZ2xlIGFuaW1hdGlvbkVuZCBldmVudFxuICBfdW5iaW5kTGF5b3V0QW5pbWF0aW9uRW5kRXZlbnQoKSB7XG4gICAgY29uc3QgbWVudSA9IHRoaXMuZ2V0TWVudSgpXG5cbiAgICBpZiAodGhpcy5fdHJhbnNpdGlvbkNhbGxiYWNrVGltZW91dCkge1xuICAgICAgY2xlYXJUaW1lb3V0KHRoaXMuX3RyYW5zaXRpb25DYWxsYmFja1RpbWVvdXQpXG4gICAgICB0aGlzLl90cmFuc2l0aW9uQ2FsbGJhY2tUaW1lb3V0ID0gbnVsbFxuICAgIH1cblxuICAgIGlmIChtZW51ICYmIHRoaXMuX3RyYW5zaXRpb25DYWxsYmFjaykge1xuICAgICAgVFJBTlNfRVZFTlRTLmZvckVhY2goZSA9PiB7XG4gICAgICAgIG1lbnUucmVtb3ZlRXZlbnRMaXN0ZW5lcihlLCB0aGlzLl90cmFuc2l0aW9uQ2FsbGJhY2ssIGZhbHNlKVxuICAgICAgfSlcbiAgICB9XG5cbiAgICBpZiAodGhpcy5fdHJhbnNpdGlvbkNhbGxiYWNrKSB7XG4gICAgICB0aGlzLl90cmFuc2l0aW9uQ2FsbGJhY2sgPSBudWxsXG4gICAgfVxuICB9LFxuXG4gIC8vIC0tLVxuICAvLyBCaW5kIGRlbGF5ZWQgd2luZG93IHJlc2l6ZSBldmVudFxuICBfYmluZFdpbmRvd1Jlc2l6ZUV2ZW50KCkge1xuICAgIHRoaXMuX3VuYmluZFdpbmRvd1Jlc2l6ZUV2ZW50KClcblxuICAgIGNvbnN0IGNiID0gKCkgPT4ge1xuICAgICAgaWYgKHRoaXMuX3Jlc2l6ZVRpbWVvdXQpIHtcbiAgICAgICAgY2xlYXJUaW1lb3V0KHRoaXMuX3Jlc2l6ZVRpbWVvdXQpXG4gICAgICAgIHRoaXMuX3Jlc2l6ZVRpbWVvdXQgPSBudWxsXG4gICAgICB9XG4gICAgICB0aGlzLl90cmlnZ2VyRXZlbnQoJ3Jlc2l6ZScpXG4gICAgfVxuXG4gICAgdGhpcy5fcmVzaXplQ2FsbGJhY2sgPSAoKSA9PiB7XG4gICAgICBpZiAodGhpcy5fcmVzaXplVGltZW91dCkgY2xlYXJUaW1lb3V0KHRoaXMuX3Jlc2l6ZVRpbWVvdXQpXG4gICAgICB0aGlzLl9yZXNpemVUaW1lb3V0ID0gc2V0VGltZW91dChjYiwgdGhpcy5SRVNJWkVfREVMQVkpXG4gICAgfVxuXG4gICAgd2luZG93LmFkZEV2ZW50TGlzdGVuZXIoJ3Jlc2l6ZScsIHRoaXMuX3Jlc2l6ZUNhbGxiYWNrLCBmYWxzZSlcbiAgfSxcblxuICAvLyAtLS1cbiAgLy8gVW5iaW5kIGRlbGF5ZWQgd2luZG93IHJlc2l6ZSBldmVudFxuICBfdW5iaW5kV2luZG93UmVzaXplRXZlbnQoKSB7XG4gICAgaWYgKHRoaXMuX3Jlc2l6ZVRpbWVvdXQpIHtcbiAgICAgIGNsZWFyVGltZW91dCh0aGlzLl9yZXNpemVUaW1lb3V0KVxuICAgICAgdGhpcy5fcmVzaXplVGltZW91dCA9IG51bGxcbiAgICB9XG5cbiAgICBpZiAodGhpcy5fcmVzaXplQ2FsbGJhY2spIHtcbiAgICAgIHdpbmRvdy5yZW1vdmVFdmVudExpc3RlbmVyKCdyZXNpemUnLCB0aGlzLl9yZXNpemVDYWxsYmFjaywgZmFsc2UpXG4gICAgICB0aGlzLl9yZXNpemVDYWxsYmFjayA9IG51bGxcbiAgICB9XG4gIH0sXG5cbiAgX2JpbmRNZW51TW91c2VFdmVudHMoKSB7XG4gICAgaWYgKHRoaXMuX21lbnVNb3VzZUVudGVyICYmIHRoaXMuX21lbnVNb3VzZUxlYXZlICYmIHRoaXMuX3dpbmRvd1RvdWNoU3RhcnQpIHJldHVyblxuXG4gICAgY29uc3QgbGF5b3V0TWVudSA9IHRoaXMuZ2V0TGF5b3V0TWVudSgpXG4gICAgaWYgKCFsYXlvdXRNZW51KSByZXR1cm4gdGhpcy5fdW5iaW5kTWVudU1vdXNlRXZlbnRzKClcblxuICAgIGlmICghdGhpcy5fbWVudU1vdXNlRW50ZXIpIHtcbiAgICAgIHRoaXMuX21lbnVNb3VzZUVudGVyID0gKCkgPT4ge1xuICAgICAgICBpZiAodGhpcy5pc1NtYWxsU2NyZWVuKCkgfHwgdGhpcy5faGFzQ2xhc3MoJ2xheW91dC10cmFuc2l0aW9uaW5nJykpIHtcbiAgICAgICAgICByZXR1cm4gdGhpcy5fc2V0TWVudUhvdmVyU3RhdGUoZmFsc2UpXG4gICAgICAgIH1cblxuICAgICAgICByZXR1cm4gdGhpcy5fc2V0TWVudUhvdmVyU3RhdGUoZmFsc2UpXG4gICAgICB9XG4gICAgICBsYXlvdXRNZW51LmFkZEV2ZW50TGlzdGVuZXIoJ21vdXNlZW50ZXInLCB0aGlzLl9tZW51TW91c2VFbnRlciwgZmFsc2UpXG4gICAgICBsYXlvdXRNZW51LmFkZEV2ZW50TGlzdGVuZXIoJ3RvdWNoc3RhcnQnLCB0aGlzLl9tZW51TW91c2VFbnRlciwgZmFsc2UpXG4gICAgfVxuXG4gICAgaWYgKCF0aGlzLl9tZW51TW91c2VMZWF2ZSkge1xuICAgICAgdGhpcy5fbWVudU1vdXNlTGVhdmUgPSAoKSA9PiB7XG4gICAgICAgIHRoaXMuX3NldE1lbnVIb3ZlclN0YXRlKGZhbHNlKVxuICAgICAgfVxuICAgICAgbGF5b3V0TWVudS5hZGRFdmVudExpc3RlbmVyKCdtb3VzZWxlYXZlJywgdGhpcy5fbWVudU1vdXNlTGVhdmUsIGZhbHNlKVxuICAgIH1cblxuICAgIGlmICghdGhpcy5fd2luZG93VG91Y2hTdGFydCkge1xuICAgICAgdGhpcy5fd2luZG93VG91Y2hTdGFydCA9IGUgPT4ge1xuICAgICAgICBpZiAoIWUgfHwgIWUudGFyZ2V0IHx8ICF0aGlzLl9maW5kUGFyZW50KGUudGFyZ2V0LCAnLmxheW91dC1tZW51JykpIHtcbiAgICAgICAgICB0aGlzLl9zZXRNZW51SG92ZXJTdGF0ZShmYWxzZSlcbiAgICAgICAgfVxuICAgICAgfVxuICAgICAgd2luZG93LmFkZEV2ZW50TGlzdGVuZXIoJ3RvdWNoc3RhcnQnLCB0aGlzLl93aW5kb3dUb3VjaFN0YXJ0LCB0cnVlKVxuICAgIH1cbiAgfSxcblxuICBfdW5iaW5kTWVudU1vdXNlRXZlbnRzKCkge1xuICAgIGlmICghdGhpcy5fbWVudU1vdXNlRW50ZXIgJiYgIXRoaXMuX21lbnVNb3VzZUxlYXZlICYmICF0aGlzLl93aW5kb3dUb3VjaFN0YXJ0KSByZXR1cm5cblxuICAgIGNvbnN0IGxheW91dE1lbnUgPSB0aGlzLmdldExheW91dE1lbnUoKVxuXG4gICAgaWYgKHRoaXMuX21lbnVNb3VzZUVudGVyKSB7XG4gICAgICBpZiAobGF5b3V0TWVudSkge1xuICAgICAgICBsYXlvdXRNZW51LnJlbW92ZUV2ZW50TGlzdGVuZXIoJ21vdXNlZW50ZXInLCB0aGlzLl9tZW51TW91c2VFbnRlciwgZmFsc2UpXG4gICAgICAgIGxheW91dE1lbnUucmVtb3ZlRXZlbnRMaXN0ZW5lcigndG91Y2hzdGFydCcsIHRoaXMuX21lbnVNb3VzZUVudGVyLCBmYWxzZSlcbiAgICAgIH1cbiAgICAgIHRoaXMuX21lbnVNb3VzZUVudGVyID0gbnVsbFxuICAgIH1cblxuICAgIGlmICh0aGlzLl9tZW51TW91c2VMZWF2ZSkge1xuICAgICAgaWYgKGxheW91dE1lbnUpIHtcbiAgICAgICAgbGF5b3V0TWVudS5yZW1vdmVFdmVudExpc3RlbmVyKCdtb3VzZWxlYXZlJywgdGhpcy5fbWVudU1vdXNlTGVhdmUsIGZhbHNlKVxuICAgICAgfVxuICAgICAgdGhpcy5fbWVudU1vdXNlTGVhdmUgPSBudWxsXG4gICAgfVxuXG4gICAgaWYgKHRoaXMuX3dpbmRvd1RvdWNoU3RhcnQpIHtcbiAgICAgIGlmIChsYXlvdXRNZW51KSB7XG4gICAgICAgIHdpbmRvdy5hZGRFdmVudExpc3RlbmVyKCd0b3VjaHN0YXJ0JywgdGhpcy5fd2luZG93VG91Y2hTdGFydCwgdHJ1ZSlcbiAgICAgIH1cbiAgICAgIHRoaXMuX3dpbmRvd1RvdWNoU3RhcnQgPSBudWxsXG4gICAgfVxuXG4gICAgdGhpcy5fc2V0TWVudUhvdmVyU3RhdGUoZmFsc2UpXG4gIH0sXG5cbiAgLy8gKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKlxuICAvLyAqIE1ldGhvZHNcblxuICBzY3JvbGxUb0FjdGl2ZShhbmltYXRlID0gZmFsc2UpIHtcbiAgICB0aGlzLl9zY3JvbGxUb0FjdGl2ZShhbmltYXRlKVxuICB9LFxuXG4gIC8vIC0tLVxuICAvLyBDb2xsYXBzZSAvIGV4cGFuZCBsYXlvdXRcbiAgc2V0Q29sbGFwc2VkKGNvbGxhcHNlZCA9IHJlcXVpcmVkUGFyYW0oJ2NvbGxhcHNlZCcpLCBhbmltYXRlID0gdHJ1ZSkge1xuICAgIGNvbnN0IGxheW91dE1lbnUgPSB0aGlzLmdldExheW91dE1lbnUoKVxuXG4gICAgaWYgKCFsYXlvdXRNZW51KSByZXR1cm5cblxuICAgIHRoaXMuX3VuYmluZExheW91dEFuaW1hdGlvbkVuZEV2ZW50KClcblxuICAgIGlmIChhbmltYXRlICYmIHRoaXMuX3N1cHBvcnRzVHJhbnNpdGlvbkVuZCgpKSB7XG4gICAgICB0aGlzLl9hZGRDbGFzcygnbGF5b3V0LXRyYW5zaXRpb25pbmcnKVxuICAgICAgaWYgKGNvbGxhcHNlZCkgdGhpcy5fc2V0TWVudUhvdmVyU3RhdGUoZmFsc2UpXG5cbiAgICAgIHRoaXMuX2JpbmRMYXlvdXRBbmltYXRpb25FbmRFdmVudChcbiAgICAgICAgKCkgPT4ge1xuICAgICAgICAgIC8vIENvbGxhcHNlIC8gRXhwYW5kXG4gICAgICAgICAgaWYgKHRoaXMuaXNTbWFsbFNjcmVlbikgdGhpcy5fc2V0Q29sbGFwc2VkKGNvbGxhcHNlZClcbiAgICAgICAgfSxcbiAgICAgICAgKCkgPT4ge1xuICAgICAgICAgIHRoaXMuX3JlbW92ZUNsYXNzKCdsYXlvdXQtdHJhbnNpdGlvbmluZycpXG4gICAgICAgICAgdGhpcy5fdHJpZ2dlcldpbmRvd0V2ZW50KCdyZXNpemUnKVxuICAgICAgICAgIHRoaXMuX3RyaWdnZXJFdmVudCgndG9nZ2xlJylcbiAgICAgICAgICB0aGlzLl9zZXRNZW51SG92ZXJTdGF0ZShmYWxzZSlcbiAgICAgICAgfVxuICAgICAgKVxuICAgIH0gZWxzZSB7XG4gICAgICB0aGlzLl9hZGRDbGFzcygnbGF5b3V0LW5vLXRyYW5zaXRpb24nKVxuICAgICAgaWYgKGNvbGxhcHNlZCkgdGhpcy5fc2V0TWVudUhvdmVyU3RhdGUoZmFsc2UpXG5cbiAgICAgIC8vIENvbGxhcHNlIC8gRXhwYW5kXG4gICAgICB0aGlzLl9zZXRDb2xsYXBzZWQoY29sbGFwc2VkKVxuXG4gICAgICBzZXRUaW1lb3V0KCgpID0+IHtcbiAgICAgICAgdGhpcy5fcmVtb3ZlQ2xhc3MoJ2xheW91dC1uby10cmFuc2l0aW9uJylcbiAgICAgICAgdGhpcy5fdHJpZ2dlcldpbmRvd0V2ZW50KCdyZXNpemUnKVxuICAgICAgICB0aGlzLl90cmlnZ2VyRXZlbnQoJ3RvZ2dsZScpXG4gICAgICAgIHRoaXMuX3NldE1lbnVIb3ZlclN0YXRlKGZhbHNlKVxuICAgICAgfSwgMSlcbiAgICB9XG4gIH0sXG5cbiAgLy8gLS0tXG4gIC8vIFRvZ2dsZSBsYXlvdXRcbiAgdG9nZ2xlQ29sbGFwc2VkKGFuaW1hdGUgPSB0cnVlKSB7XG4gICAgdGhpcy5zZXRDb2xsYXBzZWQoIXRoaXMuaXNDb2xsYXBzZWQoKSwgYW5pbWF0ZSlcbiAgfSxcblxuICAvLyAtLS1cbiAgLy8gU2V0IGxheW91dCBwb3NpdGlvbmluZ1xuICBzZXRQb3NpdGlvbihmaXhlZCA9IHJlcXVpcmVkUGFyYW0oJ2ZpeGVkJyksIG9mZmNhbnZhcyA9IHJlcXVpcmVkUGFyYW0oJ29mZmNhbnZhcycpKSB7XG4gICAgdGhpcy5fcmVtb3ZlQ2xhc3MoJ2xheW91dC1tZW51LW9mZmNhbnZhcyBsYXlvdXQtbWVudS1maXhlZCBsYXlvdXQtbWVudS1maXhlZC1vZmZjYW52YXMnKVxuXG4gICAgaWYgKCFmaXhlZCAmJiBvZmZjYW52YXMpIHtcbiAgICAgIHRoaXMuX2FkZENsYXNzKCdsYXlvdXQtbWVudS1vZmZjYW52YXMnKVxuICAgIH0gZWxzZSBpZiAoZml4ZWQgJiYgIW9mZmNhbnZhcykge1xuICAgICAgdGhpcy5fYWRkQ2xhc3MoJ2xheW91dC1tZW51LWZpeGVkJylcbiAgICAgIHRoaXMuX3JlZHJhd0xheW91dE1lbnUoKVxuICAgIH0gZWxzZSBpZiAoZml4ZWQgJiYgb2ZmY2FudmFzKSB7XG4gICAgICB0aGlzLl9hZGRDbGFzcygnbGF5b3V0LW1lbnUtZml4ZWQtb2ZmY2FudmFzJylcbiAgICAgIHRoaXMuX3JlZHJhd0xheW91dE1lbnUoKVxuICAgIH1cblxuICAgIHRoaXMudXBkYXRlKClcbiAgfSxcblxuICAvLyAqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqXG4gIC8vICogR2V0dGVyc1xuXG4gIGdldExheW91dE1lbnUoKSB7XG4gICAgcmV0dXJuIGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJy5sYXlvdXQtbWVudScpXG4gIH0sXG5cbiAgZ2V0TWVudSgpIHtcbiAgICBjb25zdCBsYXlvdXRNZW51ID0gdGhpcy5nZXRMYXlvdXRNZW51KClcblxuICAgIGlmICghbGF5b3V0TWVudSkgcmV0dXJuIG51bGxcblxuICAgIHJldHVybiAhdGhpcy5faGFzQ2xhc3MoJ21lbnUnLCBsYXlvdXRNZW51KSA/IGxheW91dE1lbnUucXVlcnlTZWxlY3RvcignLm1lbnUnKSA6IGxheW91dE1lbnVcbiAgfSxcblxuICBnZXRMYXlvdXROYXZiYXIoKSB7XG4gICAgcmV0dXJuIGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJy5sYXlvdXQtbmF2YmFyJylcbiAgfSxcblxuICBnZXRMYXlvdXRGb290ZXIoKSB7XG4gICAgcmV0dXJuIGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJy5jb250ZW50LWZvb3RlcicpXG4gIH0sXG5cbiAgLy8gKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKlxuICAvLyAqIFVwZGF0ZVxuXG4gIHVwZGF0ZSgpIHtcbiAgICBpZiAoXG4gICAgICAodGhpcy5nZXRMYXlvdXROYXZiYXIoKSAmJlxuICAgICAgICAoKCF0aGlzLmlzU21hbGxTY3JlZW4oKSAmJiB0aGlzLmlzTGF5b3V0TmF2YmFyRnVsbCgpICYmIHRoaXMuaXNGaXhlZCgpKSB8fCB0aGlzLmlzTmF2YmFyRml4ZWQoKSkpIHx8XG4gICAgICAodGhpcy5nZXRMYXlvdXRGb290ZXIoKSAmJiB0aGlzLmlzRm9vdGVyRml4ZWQoKSlcbiAgICApIHtcbiAgICAgIHRoaXMuX3VwZGF0ZUlubGluZVN0eWxlKHRoaXMuX2dldE5hdmJhckhlaWdodCgpLCB0aGlzLl9nZXRGb290ZXJIZWlnaHQoKSlcbiAgICB9XG5cbiAgICB0aGlzLl9iaW5kTWVudU1vdXNlRXZlbnRzKClcbiAgfSxcblxuICBzZXRBdXRvVXBkYXRlKGVuYWJsZSA9IHJlcXVpcmVkUGFyYW0oJ2VuYWJsZScpKSB7XG4gICAgaWYgKGVuYWJsZSAmJiAhdGhpcy5fYXV0b1VwZGF0ZSkge1xuICAgICAgdGhpcy5vbigncmVzaXplLkhlbHBlcnM6YXV0b1VwZGF0ZScsICgpID0+IHRoaXMudXBkYXRlKCkpXG4gICAgICB0aGlzLl9hdXRvVXBkYXRlID0gdHJ1ZVxuICAgIH0gZWxzZSBpZiAoIWVuYWJsZSAmJiB0aGlzLl9hdXRvVXBkYXRlKSB7XG4gICAgICB0aGlzLm9mZigncmVzaXplLkhlbHBlcnM6YXV0b1VwZGF0ZScpXG4gICAgICB0aGlzLl9hdXRvVXBkYXRlID0gZmFsc2VcbiAgICB9XG4gIH0sXG5cbiAgLy8gKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKlxuICAvLyAqIFRlc3RzXG5cbiAgaXNSdGwoKSB7XG4gICAgcmV0dXJuIChcbiAgICAgIGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJ2JvZHknKS5nZXRBdHRyaWJ1dGUoJ2RpcicpID09PSAncnRsJyB8fFxuICAgICAgZG9jdW1lbnQucXVlcnlTZWxlY3RvcignaHRtbCcpLmdldEF0dHJpYnV0ZSgnZGlyJykgPT09ICdydGwnXG4gICAgKVxuICB9LFxuXG4gIGlzTW9iaWxlRGV2aWNlKCkge1xuICAgIHJldHVybiB0eXBlb2Ygd2luZG93Lm9yaWVudGF0aW9uICE9PSAndW5kZWZpbmVkJyB8fCBuYXZpZ2F0b3IudXNlckFnZW50LmluZGV4T2YoJ0lFTW9iaWxlJykgIT09IC0xXG4gIH0sXG5cbiAgaXNTbWFsbFNjcmVlbigpIHtcbiAgICByZXR1cm4gKFxuICAgICAgKHdpbmRvdy5pbm5lcldpZHRoIHx8IGRvY3VtZW50LmRvY3VtZW50RWxlbWVudC5jbGllbnRXaWR0aCB8fCBkb2N1bWVudC5ib2R5LmNsaWVudFdpZHRoKSA8IHRoaXMuTEFZT1VUX0JSRUFLUE9JTlRcbiAgICApXG4gIH0sXG5cbiAgaXNMYXlvdXROYXZiYXJGdWxsKCkge1xuICAgIHJldHVybiAhIWRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJy5sYXlvdXQtd3JhcHBlci5sYXlvdXQtbmF2YmFyLWZ1bGwnKVxuICB9LFxuXG4gIGlzQ29sbGFwc2VkKCkge1xuICAgIGlmICh0aGlzLmlzU21hbGxTY3JlZW4oKSkge1xuICAgICAgcmV0dXJuICF0aGlzLl9oYXNDbGFzcygnbGF5b3V0LW1lbnUtZXhwYW5kZWQnKVxuICAgIH1cbiAgICByZXR1cm4gdGhpcy5faGFzQ2xhc3MoJ2xheW91dC1tZW51LWNvbGxhcHNlZCcpXG4gIH0sXG5cbiAgaXNGaXhlZCgpIHtcbiAgICByZXR1cm4gdGhpcy5faGFzQ2xhc3MoJ2xheW91dC1tZW51LWZpeGVkIGxheW91dC1tZW51LWZpeGVkLW9mZmNhbnZhcycpXG4gIH0sXG5cbiAgaXNOYXZiYXJGaXhlZCgpIHtcbiAgICByZXR1cm4gKFxuICAgICAgdGhpcy5faGFzQ2xhc3MoJ2xheW91dC1uYXZiYXItZml4ZWQnKSB8fCAoIXRoaXMuaXNTbWFsbFNjcmVlbigpICYmIHRoaXMuaXNGaXhlZCgpICYmIHRoaXMuaXNMYXlvdXROYXZiYXJGdWxsKCkpXG4gICAgKVxuICB9LFxuXG4gIGlzRm9vdGVyRml4ZWQoKSB7XG4gICAgcmV0dXJuIHRoaXMuX2hhc0NsYXNzKCdsYXlvdXQtZm9vdGVyLWZpeGVkJylcbiAgfSxcblxuICBpc0xpZ2h0U3R5bGUoKSB7XG4gICAgcmV0dXJuIGRvY3VtZW50LmRvY3VtZW50RWxlbWVudC5jbGFzc0xpc3QuY29udGFpbnMoJ2xpZ2h0LXN0eWxlJylcbiAgfSxcblxuICAvLyAqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqXG4gIC8vICogRXZlbnRzXG5cbiAgb24oZXZlbnQgPSByZXF1aXJlZFBhcmFtKCdldmVudCcpLCBjYWxsYmFjayA9IHJlcXVpcmVkUGFyYW0oJ2NhbGxiYWNrJykpIHtcbiAgICBjb25zdCBbX2V2ZW50XSA9IGV2ZW50LnNwbGl0KCcuJylcbiAgICBsZXQgWywgLi4ubmFtZXNwYWNlXSA9IGV2ZW50LnNwbGl0KCcuJylcbiAgICAvLyBsZXQgW19ldmVudCwgLi4ubmFtZXNwYWNlXSA9IGV2ZW50LnNwbGl0KCcuJylcbiAgICBuYW1lc3BhY2UgPSBuYW1lc3BhY2Uuam9pbignLicpIHx8IG51bGxcblxuICAgIHRoaXMuX2xpc3RlbmVycy5wdXNoKHsgZXZlbnQ6IF9ldmVudCwgbmFtZXNwYWNlLCBjYWxsYmFjayB9KVxuICB9LFxuXG4gIG9mZihldmVudCA9IHJlcXVpcmVkUGFyYW0oJ2V2ZW50JykpIHtcbiAgICBjb25zdCBbX2V2ZW50XSA9IGV2ZW50LnNwbGl0KCcuJylcbiAgICBsZXQgWywgLi4ubmFtZXNwYWNlXSA9IGV2ZW50LnNwbGl0KCcuJylcbiAgICBuYW1lc3BhY2UgPSBuYW1lc3BhY2Uuam9pbignLicpIHx8IG51bGxcblxuICAgIHRoaXMuX2xpc3RlbmVyc1xuICAgICAgLmZpbHRlcihsaXN0ZW5lciA9PiBsaXN0ZW5lci5ldmVudCA9PT0gX2V2ZW50ICYmIGxpc3RlbmVyLm5hbWVzcGFjZSA9PT0gbmFtZXNwYWNlKVxuICAgICAgLmZvckVhY2gobGlzdGVuZXIgPT4gdGhpcy5fbGlzdGVuZXJzLnNwbGljZSh0aGlzLl9saXN0ZW5lcnMuaW5kZXhPZihsaXN0ZW5lciksIDEpKVxuICB9LFxuXG4gIC8vICoqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKipcbiAgLy8gKiBMaWZlIGN5Y2xlXG5cbiAgaW5pdCgpIHtcbiAgICBpZiAodGhpcy5faW5pdGlhbGl6ZWQpIHJldHVyblxuICAgIHRoaXMuX2luaXRpYWxpemVkID0gdHJ1ZVxuXG4gICAgLy8gSW5pdGlhbGl6ZSBgc3R5bGVgIGVsZW1lbnRcbiAgICB0aGlzLl91cGRhdGVJbmxpbmVTdHlsZSgwKVxuXG4gICAgLy8gQmluZCB3aW5kb3cgcmVzaXplIGV2ZW50XG4gICAgdGhpcy5fYmluZFdpbmRvd1Jlc2l6ZUV2ZW50KClcblxuICAgIC8vIEJpbmQgaW5pdCBldmVudFxuICAgIHRoaXMub2ZmKCdpbml0Ll9IZWxwZXJzJylcbiAgICB0aGlzLm9uKCdpbml0Ll9IZWxwZXJzJywgKCkgPT4ge1xuICAgICAgdGhpcy5vZmYoJ3Jlc2l6ZS5fSGVscGVyczpyZWRyYXdNZW51JylcbiAgICAgIHRoaXMub24oJ3Jlc2l6ZS5fSGVscGVyczpyZWRyYXdNZW51JywgKCkgPT4ge1xuICAgICAgICAvLyBlc2xpbnQtZGlzYWJsZS1uZXh0LWxpbmUgbm8tdW51c2VkLWV4cHJlc3Npb25zXG4gICAgICAgIHRoaXMuaXNTbWFsbFNjcmVlbigpICYmICF0aGlzLmlzQ29sbGFwc2VkKCkgJiYgdGhpcy5fcmVkcmF3TGF5b3V0TWVudSgpXG4gICAgICB9KVxuXG4gICAgICAvLyBGb3JjZSByZXBhaW50IGluIElFIDEwXG4gICAgICBpZiAodHlwZW9mIGRvY3VtZW50LmRvY3VtZW50TW9kZSA9PT0gJ251bWJlcicgJiYgZG9jdW1lbnQuZG9jdW1lbnRNb2RlIDwgMTEpIHtcbiAgICAgICAgdGhpcy5vZmYoJ3Jlc2l6ZS5fSGVscGVyczppZTEwUmVwYWludEJvZHknKVxuICAgICAgICB0aGlzLm9uKCdyZXNpemUuX0hlbHBlcnM6aWUxMFJlcGFpbnRCb2R5JywgKCkgPT4ge1xuICAgICAgICAgIGlmICh0aGlzLmlzRml4ZWQoKSkgcmV0dXJuXG4gICAgICAgICAgY29uc3QgeyBzY3JvbGxUb3AgfSA9IGRvY3VtZW50LmRvY3VtZW50RWxlbWVudFxuICAgICAgICAgIGRvY3VtZW50LmJvZHkuc3R5bGUuZGlzcGxheSA9ICdub25lJ1xuICAgICAgICAgIC8vIGRvY3VtZW50LmJvZHkub2Zmc2V0SGVpZ2h0XG4gICAgICAgICAgZG9jdW1lbnQuYm9keS5zdHlsZS5kaXNwbGF5ID0gJ2Jsb2NrJ1xuICAgICAgICAgIGRvY3VtZW50LmRvY3VtZW50RWxlbWVudC5zY3JvbGxUb3AgPSBzY3JvbGxUb3BcbiAgICAgICAgfSlcbiAgICAgIH1cbiAgICB9KVxuXG4gICAgdGhpcy5fdHJpZ2dlckV2ZW50KCdpbml0JylcbiAgfSxcblxuICBkZXN0cm95KCkge1xuICAgIGlmICghdGhpcy5faW5pdGlhbGl6ZWQpIHJldHVyblxuICAgIHRoaXMuX2luaXRpYWxpemVkID0gZmFsc2VcblxuICAgIHRoaXMuX3JlbW92ZUNsYXNzKCdsYXlvdXQtdHJhbnNpdGlvbmluZycpXG4gICAgdGhpcy5fcmVtb3ZlSW5saW5lU3R5bGUoKVxuICAgIHRoaXMuX3VuYmluZExheW91dEFuaW1hdGlvbkVuZEV2ZW50KClcbiAgICB0aGlzLl91bmJpbmRXaW5kb3dSZXNpemVFdmVudCgpXG4gICAgdGhpcy5fdW5iaW5kTWVudU1vdXNlRXZlbnRzKClcbiAgICB0aGlzLnNldEF1dG9VcGRhdGUoZmFsc2UpXG5cbiAgICB0aGlzLm9mZignaW5pdC5fSGVscGVycycpXG5cbiAgICAvLyBSZW1vdmUgYWxsIGxpc3RlbmVycyBleGNlcHQgYGluaXRgXG4gICAgdGhpcy5fbGlzdGVuZXJzXG4gICAgICAuZmlsdGVyKGxpc3RlbmVyID0+IGxpc3RlbmVyLmV2ZW50ICE9PSAnaW5pdCcpXG4gICAgICAuZm9yRWFjaChsaXN0ZW5lciA9PiB0aGlzLl9saXN0ZW5lcnMuc3BsaWNlKHRoaXMuX2xpc3RlbmVycy5pbmRleE9mKGxpc3RlbmVyKSwgMSkpXG4gIH0sXG5cbiAgLy8gLS0tXG4gIC8vIEluaXQgUGFzc3dvcmQgVG9nZ2xlXG4gIGluaXRQYXNzd29yZFRvZ2dsZSgpIHtcbiAgICBjb25zdCB0b2dnbGVyID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbCgnLmZvcm0tcGFzc3dvcmQtdG9nZ2xlIGknKVxuICAgIGlmICh0eXBlb2YgdG9nZ2xlciAhPT0gJ3VuZGVmaW5lZCcgJiYgdG9nZ2xlciAhPT0gbnVsbCkge1xuICAgICAgdG9nZ2xlci5mb3JFYWNoKGVsID0+IHtcbiAgICAgICAgZWwuYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCBlID0+IHtcbiAgICAgICAgICBlLnByZXZlbnREZWZhdWx0KClcbiAgICAgICAgICBjb25zdCBmb3JtUGFzc3dvcmRUb2dnbGUgPSBlbC5jbG9zZXN0KCcuZm9ybS1wYXNzd29yZC10b2dnbGUnKVxuICAgICAgICAgIGNvbnN0IGZvcm1QYXNzd29yZFRvZ2dsZUljb24gPSBmb3JtUGFzc3dvcmRUb2dnbGUucXVlcnlTZWxlY3RvcignaScpXG4gICAgICAgICAgY29uc3QgZm9ybVBhc3N3b3JkVG9nZ2xlSW5wdXQgPSBmb3JtUGFzc3dvcmRUb2dnbGUucXVlcnlTZWxlY3RvcignaW5wdXQnKVxuXG4gICAgICAgICAgaWYgKGZvcm1QYXNzd29yZFRvZ2dsZUlucHV0LmdldEF0dHJpYnV0ZSgndHlwZScpID09PSAndGV4dCcpIHtcbiAgICAgICAgICAgIGZvcm1QYXNzd29yZFRvZ2dsZUlucHV0LnNldEF0dHJpYnV0ZSgndHlwZScsICdwYXNzd29yZCcpXG4gICAgICAgICAgICBmb3JtUGFzc3dvcmRUb2dnbGVJY29uLmNsYXNzTGlzdC5yZXBsYWNlKCdieC1zaG93JywgJ2J4LWhpZGUnKVxuICAgICAgICAgIH0gZWxzZSBpZiAoZm9ybVBhc3N3b3JkVG9nZ2xlSW5wdXQuZ2V0QXR0cmlidXRlKCd0eXBlJykgPT09ICdwYXNzd29yZCcpIHtcbiAgICAgICAgICAgIGZvcm1QYXNzd29yZFRvZ2dsZUlucHV0LnNldEF0dHJpYnV0ZSgndHlwZScsICd0ZXh0JylcbiAgICAgICAgICAgIGZvcm1QYXNzd29yZFRvZ2dsZUljb24uY2xhc3NMaXN0LnJlcGxhY2UoJ2J4LWhpZGUnLCAnYngtc2hvdycpXG4gICAgICAgICAgfVxuICAgICAgICB9KVxuICAgICAgfSlcbiAgICB9XG4gIH0sXG5cbiAgLy8gLS0tXG4gIC8vIEluaXQgU3BlZWNoIFRvIFRleHRcbiAgaW5pdFNwZWVjaFRvVGV4dCgpIHtcbiAgICBjb25zdCBTcGVlY2hSZWNvZ25pdGlvbiA9IHdpbmRvdy5TcGVlY2hSZWNvZ25pdGlvbiB8fCB3aW5kb3cud2Via2l0U3BlZWNoUmVjb2duaXRpb25cbiAgICBjb25zdCBzcGVlY2hUb1RleHQgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yQWxsKCcuc3BlZWNoLXRvLXRleHQnKVxuICAgIGlmIChTcGVlY2hSZWNvZ25pdGlvbiAhPT0gdW5kZWZpbmVkICYmIFNwZWVjaFJlY29nbml0aW9uICE9PSBudWxsKSB7XG4gICAgICBpZiAodHlwZW9mIHNwZWVjaFRvVGV4dCAhPT0gJ3VuZGVmaW5lZCcgJiYgc3BlZWNoVG9UZXh0ICE9PSBudWxsKSB7XG4gICAgICAgIGNvbnN0IHJlY29nbml0aW9uID0gbmV3IFNwZWVjaFJlY29nbml0aW9uKClcbiAgICAgICAgY29uc3QgdG9nZ2xlciA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoJy5zcGVlY2gtdG8tdGV4dCBpJylcbiAgICAgICAgdG9nZ2xlci5mb3JFYWNoKGVsID0+IHtcbiAgICAgICAgICBsZXQgbGlzdGVuaW5nID0gZmFsc2VcbiAgICAgICAgICBlbC5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsICgpID0+IHtcbiAgICAgICAgICAgIGVsLmNsb3Nlc3QoJy5pbnB1dC1ncm91cCcpLnF1ZXJ5U2VsZWN0b3IoJy5mb3JtLWNvbnRyb2wnKS5mb2N1cygpXG4gICAgICAgICAgICByZWNvZ25pdGlvbi5vbnNwZWVjaHN0YXJ0ID0gKCkgPT4ge1xuICAgICAgICAgICAgICBsaXN0ZW5pbmcgPSB0cnVlXG4gICAgICAgICAgICB9XG4gICAgICAgICAgICBpZiAobGlzdGVuaW5nID09PSBmYWxzZSkge1xuICAgICAgICAgICAgICByZWNvZ25pdGlvbi5zdGFydCgpXG4gICAgICAgICAgICB9XG4gICAgICAgICAgICByZWNvZ25pdGlvbi5vbmVycm9yID0gKCkgPT4ge1xuICAgICAgICAgICAgICBsaXN0ZW5pbmcgPSBmYWxzZVxuICAgICAgICAgICAgfVxuICAgICAgICAgICAgcmVjb2duaXRpb24ub25yZXN1bHQgPSBldmVudCA9PiB7XG4gICAgICAgICAgICAgIGVsLmNsb3Nlc3QoJy5pbnB1dC1ncm91cCcpLnF1ZXJ5U2VsZWN0b3IoJy5mb3JtLWNvbnRyb2wnKS52YWx1ZSA9IGV2ZW50LnJlc3VsdHNbMF1bMF0udHJhbnNjcmlwdFxuICAgICAgICAgICAgfVxuICAgICAgICAgICAgcmVjb2duaXRpb24ub25zcGVlY2hlbmQgPSAoKSA9PiB7XG4gICAgICAgICAgICAgIGxpc3RlbmluZyA9IGZhbHNlXG4gICAgICAgICAgICAgIHJlY29nbml0aW9uLnN0b3AoKVxuICAgICAgICAgICAgfVxuICAgICAgICAgIH0pXG4gICAgICAgIH0pXG4gICAgICB9XG4gICAgfVxuICB9LFxuXG4gIC8vIEFqYXggQ2FsbCBQcm9taXNlXG4gIGFqYXhDYWxsKHVybCkge1xuICAgIHJldHVybiBuZXcgUHJvbWlzZSgocmVzb2x2ZSwgcmVqZWN0KSA9PiB7XG4gICAgICBjb25zdCByZXEgPSBuZXcgWE1MSHR0cFJlcXVlc3QoKVxuICAgICAgcmVxLm9wZW4oJ0dFVCcsIHVybClcbiAgICAgIHJlcS5vbmxvYWQgPSAoKSA9PiAocmVxLnN0YXR1cyA9PT0gMjAwID8gcmVzb2x2ZShyZXEucmVzcG9uc2UpIDogcmVqZWN0KEVycm9yKHJlcS5zdGF0dXNUZXh0KSkpXG4gICAgICByZXEub25lcnJvciA9IGUgPT4gcmVqZWN0KEVycm9yKGBOZXR3b3JrIEVycm9yOiAke2V9YCkpXG4gICAgICByZXEuc2VuZCgpXG4gICAgfSlcbiAgfSxcblxuICAvLyAtLS1cbiAgLy8gU2lkZWJhclRvZ2dsZSAoVXNlZCBpbiBBcHBzKVxuICBpbml0U2lkZWJhclRvZ2dsZSgpIHtcbiAgICBjb25zdCBzaWRlYmFyVG9nZ2xlciA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoJ1tkYXRhLWJzLXRvZ2dsZT1cInNpZGViYXJcIl0nKVxuXG4gICAgc2lkZWJhclRvZ2dsZXIuZm9yRWFjaChlbCA9PiB7XG4gICAgICBlbC5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsICgpID0+IHtcbiAgICAgICAgY29uc3QgdGFyZ2V0ID0gZWwuZ2V0QXR0cmlidXRlKCdkYXRhLXRhcmdldCcpXG4gICAgICAgIGNvbnN0IG92ZXJsYXkgPSBlbC5nZXRBdHRyaWJ1dGUoJ2RhdGEtb3ZlcmxheScpXG4gICAgICAgIGNvbnN0IGFwcE92ZXJsYXkgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yQWxsKCcuYXBwLW92ZXJsYXknKVxuICAgICAgICBjb25zdCB0YXJnZXRFbCA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwodGFyZ2V0KVxuXG4gICAgICAgIHRhcmdldEVsLmZvckVhY2godGVsID0+IHtcbiAgICAgICAgICB0ZWwuY2xhc3NMaXN0LnRvZ2dsZSgnc2hvdycpXG4gICAgICAgICAgaWYgKFxuICAgICAgICAgICAgdHlwZW9mIG92ZXJsYXkgIT09ICd1bmRlZmluZWQnICYmXG4gICAgICAgICAgICBvdmVybGF5ICE9PSBudWxsICYmXG4gICAgICAgICAgICBvdmVybGF5ICE9PSBmYWxzZSAmJlxuICAgICAgICAgICAgdHlwZW9mIGFwcE92ZXJsYXkgIT09ICd1bmRlZmluZWQnXG4gICAgICAgICAgKSB7XG4gICAgICAgICAgICBpZiAodGVsLmNsYXNzTGlzdC5jb250YWlucygnc2hvdycpKSB7XG4gICAgICAgICAgICAgIGFwcE92ZXJsYXlbMF0uY2xhc3NMaXN0LmFkZCgnc2hvdycpXG4gICAgICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgICBhcHBPdmVybGF5WzBdLmNsYXNzTGlzdC5yZW1vdmUoJ3Nob3cnKVxuICAgICAgICAgICAgfVxuICAgICAgICAgICAgYXBwT3ZlcmxheVswXS5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIGUgPT4ge1xuICAgICAgICAgICAgICBlLmN1cnJlbnRUYXJnZXQuY2xhc3NMaXN0LnJlbW92ZSgnc2hvdycpXG4gICAgICAgICAgICAgIHRlbC5jbGFzc0xpc3QucmVtb3ZlKCdzaG93JylcbiAgICAgICAgICAgIH0pXG4gICAgICAgICAgfVxuICAgICAgICB9KVxuICAgICAgfSlcbiAgICB9KVxuICB9XG59XG5cbi8vICoqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKipcbi8vICogSW5pdGlhbGl6YXRpb25cblxuaWYgKHR5cGVvZiB3aW5kb3cgIT09ICd1bmRlZmluZWQnKSB7XG4gIEhlbHBlcnMuaW5pdCgpXG5cbiAgaWYgKEhlbHBlcnMuaXNNb2JpbGVEZXZpY2UoKSAmJiB3aW5kb3cuY2hyb21lKSB7XG4gICAgZG9jdW1lbnQuZG9jdW1lbnRFbGVtZW50LmNsYXNzTGlzdC5hZGQoJ2xheW91dC1tZW51LTEwMHZoJylcbiAgfVxuXG4gIC8vIFVwZGF0ZSBsYXlvdXQgYWZ0ZXIgcGFnZSBsb2FkXG4gIGlmIChkb2N1bWVudC5yZWFkeVN0YXRlID09PSAnY29tcGxldGUnKSBIZWxwZXJzLnVwZGF0ZSgpXG4gIGVsc2VcbiAgICBkb2N1bWVudC5hZGRFdmVudExpc3RlbmVyKCdET01Db250ZW50TG9hZGVkJywgZnVuY3Rpb24gb25Db250ZW50TG9hZGVkKCkge1xuICAgICAgSGVscGVycy51cGRhdGUoKVxuICAgICAgZG9jdW1lbnQucmVtb3ZlRXZlbnRMaXN0ZW5lcignRE9NQ29udGVudExvYWRlZCcsIG9uQ29udGVudExvYWRlZClcbiAgICB9KVxufVxuXG4vLyAtLS1cbmV4cG9ydCB7IEhlbHBlcnMgfVxuIl0sInNvdXJjZVJvb3QiOiIifQ==
//# sourceURL=webpack-internal:///./js/helpers.js
`)})}));(function(e,n){if(typeof exports=="object"&&typeof module=="object")module.exports=n();else if(typeof define=="function"&&define.amd)define([],n);else{var o=n();for(var Q in o)(typeof exports=="object"?exports:e)[Q]=o[Q]}})(self,(function(){return(function(){var e={d:function(d,C){for(var a in C)e.o(C,a)&&!e.o(d,a)&&Object.defineProperty(d,a,{enumerable:!0,get:C[a]})},o:function(d,C){return Object.prototype.hasOwnProperty.call(d,C)},r:function(d){typeof Symbol<"u"&&Symbol.toStringTag&&Object.defineProperty(d,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(d,"__esModule",{value:!0})}},n={};function o(d){return o=typeof Symbol=="function"&&typeof Symbol.iterator=="symbol"?function(C){return typeof C}:function(C){return C&&typeof Symbol=="function"&&C.constructor===Symbol&&C!==Symbol.prototype?"symbol":typeof C},o(d)}function Q(d){return(function(C){if(Array.isArray(C))return c(C)})(d)||(function(C){if(typeof Symbol<"u"&&C[Symbol.iterator]!=null||C["@@iterator"]!=null)return Array.from(C)})(d)||(function(C,a){if(C){if(typeof C=="string")return c(C,a);var l=Object.prototype.toString.call(C).slice(8,-1);return l==="Object"&&C.constructor&&(l=C.constructor.name),l==="Map"||l==="Set"?Array.from(C):l==="Arguments"||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(l)?c(C,a):void 0}})(d)||(function(){throw new TypeError(`Invalid attempt to spread non-iterable instance.
In order to be iterable, non-array objects must have a [Symbol.iterator]() method.`)})()}function c(d,C){(C==null||C>d.length)&&(C=d.length);for(var a=0,l=new Array(C);a<C;a++)l[a]=d[a];return l}function U(d,C){if(!(d instanceof C))throw new TypeError("Cannot call a class as a function")}function B(d,C){for(var a=0;a<C.length;a++){var l=C[a];l.enumerable=l.enumerable||!1,l.configurable=!0,"value"in l&&(l.writable=!0),Object.defineProperty(d,(i=(function(t,s){if(o(t)!=="object"||t===null)return t;var r=t[Symbol.toPrimitive];if(r!==void 0){var u=r.call(t,"string");if(o(u)!=="object")return u;throw new TypeError("@@toPrimitive must return a primitive value.")}return String(t)})(l.key),o(i)==="symbol"?i:String(i)),l)}var i}e.r(n),e.d(n,{Menu:function(){return g}});var F=["transitionend","webkitTransitionEnd","oTransitionEnd"],g=(function(){function d(i){var t=arguments.length>1&&arguments[1]!==void 0?arguments[1]:{},s=arguments.length>2&&arguments[2]!==void 0?arguments[2]:null;if(U(this,d),this._el=i,this._horizontal=t.orientation==="horizontal",this._animate=t.animate!==!1,this._accordion=t.accordion!==!1,this._showDropdownOnHover=!!t.showDropdownOnHover,this._closeChildren=!!t.closeChildren,this._rtl=document.documentElement.getAttribute("dir")==="rtl"||document.body.getAttribute("dir")==="rtl",this._onOpen=t.onOpen||function(){},this._onOpened=t.onOpened||function(){},this._onClose=t.onClose||function(){},this._onClosed=t.onClosed||function(){},this._psScroll=null,this._topParent=null,this._menuBgClass=null,i.classList.add("menu"),i.classList[this._animate?"remove":"add"]("menu-no-animation"),this._horizontal){i.classList.add("menu-horizontal"),i.classList.remove("menu-vertical"),this._inner=i.querySelector(".menu-inner");var r=this._inner.parentNode;this._prevBtn=i.querySelector(".menu-horizontal-prev"),this._prevBtn||(this._prevBtn=document.createElement("a"),this._prevBtn.href="#",this._prevBtn.className="menu-horizontal-prev",r.appendChild(this._prevBtn)),this._wrapper=i.querySelector(".menu-horizontal-wrapper"),this._wrapper||(this._wrapper=document.createElement("div"),this._wrapper.className="menu-horizontal-wrapper",this._wrapper.appendChild(this._inner),r.appendChild(this._wrapper)),this._nextBtn=i.querySelector(".menu-horizontal-next"),this._nextBtn||(this._nextBtn=document.createElement("a"),this._nextBtn.href="#",this._nextBtn.className="menu-horizontal-next",r.appendChild(this._nextBtn)),this._innerPosition=0,this.update()}else{i.classList.add("menu-vertical"),i.classList.remove("menu-horizontal");var u=s||window.PerfectScrollbar;u?(this._scrollbar=new u(i.querySelector(".menu-inner"),{suppressScrollX:!0,wheelPropagation:!d._hasClass("layout-menu-fixed layout-menu-fixed-offcanvas")}),window.Helpers.menuPsScroll=this._scrollbar):i.querySelector(".menu-inner").classList.add("overflow-auto")}for(var h=i.classList,I=0;I<h.length;I++)h[I].startsWith("bg-")&&(this._menuBgClass=h[I]);i.setAttribute("data-bg-class",this._menuBgClass),this._horizontal&&window.innerWidth<window.Helpers.LAYOUT_BREAKPOINT&&this.switchMenu("vertical"),this._bindEvents(),i.menuInstance=this}var C,a,l;return C=d,a=[{key:"_bindEvents",value:function(){var i=this;this._evntElClick=function(t){if(t.target.closest("ul")&&t.target.closest("ul").classList.contains("menu-inner")){var s=d._findParent(t.target,"menu-item",!1);s&&(i._topParent=s.childNodes[0])}var r=t.target.classList.contains("menu-toggle")?t.target:d._findParent(t.target,"menu-toggle",!1);r&&(t.preventDefault(),r.getAttribute("data-hover")!=="true"&&i.toggle(r))},(!this._showDropdownOnHover&&this._horizontal||!this._horizontal||window.Helpers.isMobileDevice)&&this._el.addEventListener("click",this._evntElClick),this._evntWindowResize=function(){i.update(),i._lastWidth!==window.innerWidth&&(i._lastWidth=window.innerWidth,i.update());var t=document.querySelector("[data-template^='horizontal-menu']");i._horizontal||t||i.manageScroll()},window.addEventListener("resize",this._evntWindowResize),this._horizontal&&(this._evntPrevBtnClick=function(t){t.preventDefault(),i._prevBtn.classList.contains("disabled")||i._slide("prev")},this._prevBtn.addEventListener("click",this._evntPrevBtnClick),this._evntNextBtnClick=function(t){t.preventDefault(),i._nextBtn.classList.contains("disabled")||i._slide("next")},this._nextBtn.addEventListener("click",this._evntNextBtnClick),this._evntBodyClick=function(t){!i._inner.contains(t.target)&&i._el.querySelectorAll(".menu-inner > .menu-item.open").length&&i.closeAll()},document.body.addEventListener("click",this._evntBodyClick),this._showDropdownOnHover&&(this._evntElMouseOver=function(t){if(t.target!==t.currentTarget&&!t.target.parentNode.classList.contains("open")){var s=t.target.classList.contains("menu-toggle")?t.target:null;s&&(t.preventDefault(),s.getAttribute("data-hover")!=="true"&&i.toggle(s))}t.stopPropagation()},this._horizontal&&window.screen.width>window.Helpers.LAYOUT_BREAKPOINT&&this._el.addEventListener("mouseover",this._evntElMouseOver),this._evntElMouseOut=function(t){var s=t.currentTarget,r=t.target,u=t.toElement||t.relatedTarget;if(r.closest("ul")&&r.closest("ul").classList.contains("menu-inner")&&(i._topParent=r),r!==s&&(r.parentNode.classList.contains("open")||!r.classList.contains("menu-toggle"))&&u&&u.parentNode&&!u.parentNode.classList.contains("menu-link")){if(i._topParent&&!d.childOf(u,i._topParent.parentNode)){var h=i._topParent.classList.contains("menu-toggle")?i._topParent:null;h&&(t.preventDefault(),h.getAttribute("data-hover")!=="true"&&(i.toggle(h),i._topParent=null))}if(d.childOf(u,r.parentNode))return;var I=r.classList.contains("menu-toggle")?r:null;I&&(t.preventDefault(),I.getAttribute("data-hover")!=="true"&&i.toggle(I))}t.stopPropagation()},this._horizontal&&window.screen.width>window.Helpers.LAYOUT_BREAKPOINT&&this._el.addEventListener("mouseout",this._evntElMouseOut)))}},{key:"_unbindEvents",value:function(){this._evntElClick&&(this._el.removeEventListener("click",this._evntElClick),this._evntElClick=null),this._evntElMouseOver&&(this._el.removeEventListener("mouseover",this._evntElMouseOver),this._evntElMouseOver=null),this._evntElMouseOut&&(this._el.removeEventListener("mouseout",this._evntElMouseOut),this._evntElMouseOut=null),this._evntWindowResize&&(window.removeEventListener("resize",this._evntWindowResize),this._evntWindowResize=null),this._evntBodyClick&&(document.body.removeEventListener("click",this._evntBodyClick),this._evntBodyClick=null),this._evntInnerMousemove&&(this._inner.removeEventListener("mousemove",this._evntInnerMousemove),this._evntInnerMousemove=null),this._evntInnerMouseleave&&(this._inner.removeEventListener("mouseleave",this._evntInnerMouseleave),this._evntInnerMouseleave=null)}},{key:"open",value:function(i){var t=this,s=arguments.length>1&&arguments[1]!==void 0?arguments[1]:this._closeChildren,r=this._findUnopenedParent(d._getItem(i,!0),s);if(r){var u=d._getLink(r,!0);d._promisify(this._onOpen,this,r,u,d._findMenu(r)).then((function(){t._horizontal&&d._isRoot(r)?(t._toggleDropdown(!0,r,s),t._onOpened&&t._onOpened(t,r,u,d._findMenu(r))):t._animate&&!t._horizontal?(window.requestAnimationFrame((function(){return t._toggleAnimation(!0,r,!1)})),t._accordion&&t._closeOther(r,s)):t._animate?(t._toggleDropdown(!0,r,s),t._onOpened&&t._onOpened(t,r,u,d._findMenu(r))):(r.classList.add("open"),t._onOpened&&t._onOpened(t,r,u,d._findMenu(r)),t._accordion&&t._closeOther(r,s))})).catch((function(){}))}}},{key:"close",value:function(i){var t=this,s=arguments.length>1&&arguments[1]!==void 0?arguments[1]:this._closeChildren,r=arguments.length>2&&arguments[2]!==void 0&&arguments[2],u=d._getItem(i,!0),h=d._getLink(i,!0);u.classList.contains("open")&&!u.classList.contains("disabled")&&d._promisify(this._onClose,this,u,h,d._findMenu(u),r).then((function(){if(t._horizontal&&d._isRoot(u))t._toggleDropdown(!1,u,s),t._onClosed&&t._onClosed(t,u,h,d._findMenu(u));else if(t._animate&&!t._horizontal)window.requestAnimationFrame((function(){return t._toggleAnimation(!1,u,s)}));else{if(u.classList.remove("open"),s)for(var I=u.querySelectorAll(".menu-item.open"),b=0,m=I.length;b<m;b++)I[b].classList.remove("open");t._onClosed&&t._onClosed(t,u,h,d._findMenu(u))}})).catch((function(){}))}},{key:"_closeOther",value:function(i,t){for(var s=d._findChild(i.parentNode,["menu-item","open"]),r=0,u=s.length;r<u;r++)s[r]!==i&&this.close(s[r],t)}},{key:"toggle",value:function(i){var t=arguments.length>1&&arguments[1]!==void 0?arguments[1]:this._closeChildren,s=d._getItem(i,!0);s.classList.contains("open")?this.close(s,t):this.open(s,t)}},{key:"_toggleDropdown",value:function(i,t,s){var r=d._findMenu(t),u=t,h=!1;if(i){d._findParent(t,"menu-sub",!1)&&(h=!0,t=this._topParent?this._topParent.parentNode:t);var I=Math.round(this._wrapper.getBoundingClientRect().width),b=this._innerPosition,m=this._getItemOffset(t),L=Math.round(t.getBoundingClientRect().width);m-5<=-1*b?this._innerPosition=-1*m:m+b+L+5>=I&&(this._innerPosition=L>I?-1*m:-1*(m+L-I)),u.classList.add("open");var p=Math.round(r.getBoundingClientRect().width);h?m+this._innerPosition+2*p>I&&p<I&&p>=L&&(r.style.left=[this._rtl?"100%":"-100%"]):m+this._innerPosition+p>I&&p<I&&p>L&&(r.style[this._rtl?"marginRight":"marginLeft"]="-".concat(p-L,"px")),this._closeOther(u,s),this._updateSlider()}else{var x=d._findChild(t,["menu-toggle"]);if(x.length&&x[0].removeAttribute("data-hover","true"),t.classList.remove("open"),r.style[this._rtl?"marginRight":"marginLeft"]=null,s)for(var f=r.querySelectorAll(".menu-item.open"),E=0,v=f.length;E<v;E++)f[E].classList.remove("open")}}},{key:"_slide",value:function(i){var t,s=Math.round(this._wrapper.getBoundingClientRect().width),r=this._innerWidth;i==="next"?r+(t=this._getSlideNextPos())<s&&(t=s-r):(t=this._getSlidePrevPos())>0&&(t=0),this._innerPosition=t,this.update()}},{key:"_getSlideNextPos",value:function(){for(var i=Math.round(this._wrapper.getBoundingClientRect().width),t=this._innerPosition,s=this._inner.childNodes[0],r=0;s;){if(s.tagName){var u=Math.round(s.getBoundingClientRect().width);if(r+t-5<=i&&r+t+u+5>=i){u>i&&r===-1*t&&(r+=u);break}r+=u}s=s.nextSibling}return-1*r}},{key:"_getSlidePrevPos",value:function(){for(var i=Math.round(this._wrapper.getBoundingClientRect().width),t=this._innerPosition,s=this._inner.childNodes[0],r=0;s;){if(s.tagName){var u=Math.round(s.getBoundingClientRect().width);if(r-5<=-1*t&&r+u+5>=-1*t){u<=i&&(r=r+u-i);break}r+=u}s=s.nextSibling}return-1*r}},{key:"_findUnopenedParent",value:function(i,t){for(var s=[],r=null;i;)i.classList.contains("disabled")?(r=null,s=[]):(i.classList.contains("open")||(r=i),s.push(i)),i=d._findParent(i,"menu-item",!1);if(!r)return null;if(s.length===1)return r;for(var u=0,h=(s=s.slice(0,s.indexOf(r))).length;u<h;u++)if(s[u].classList.add("open"),this._accordion){for(var I=d._findChild(s[u].parentNode,["menu-item","open"]),b=0,m=I.length;b<m;b++)if(I[b]!==s[u]&&(I[b].classList.remove("open"),t))for(var L=I[b].querySelectorAll(".menu-item.open"),p=0,x=L.length;p<x;p++)L[p].classList.remove("open")}return r}},{key:"_toggleAnimation",value:function(i,t,s){var r=this,u=d._getLink(t,!0),h=d._findMenu(t);d._unbindAnimationEndEvent(t);var I=Math.round(u.getBoundingClientRect().height);t.style.overflow="hidden";var b=function(){t.classList.remove("menu-item-animating"),t.classList.remove("menu-item-closing"),t.style.overflow=null,t.style.height=null,r._horizontal||r.update()};i?(t.style.height="".concat(I,"px"),t.classList.add("menu-item-animating"),t.classList.add("open"),d._bindAnimationEndEvent(t,(function(){b(),r._onOpened(r,t,u,h)})),setTimeout((function(){t.style.height="".concat(I+Math.round(h.getBoundingClientRect().height),"px")}),50)):(t.style.height="".concat(I+Math.round(h.getBoundingClientRect().height),"px"),t.classList.add("menu-item-animating"),t.classList.add("menu-item-closing"),d._bindAnimationEndEvent(t,(function(){if(t.classList.remove("open"),b(),s)for(var m=t.querySelectorAll(".menu-item.open"),L=0,p=m.length;L<p;L++)m[L].classList.remove("open");r._onClosed(r,t,u,h)})),setTimeout((function(){t.style.height="".concat(I,"px")}),50))}},{key:"_getItemOffset",value:function(i){for(var t=this._inner.childNodes[0],s=0;t!==i;)t.tagName&&(s+=Math.round(t.getBoundingClientRect().width)),t=t.nextSibling;return s}},{key:"_updateSlider",value:function(){var i=arguments.length>0&&arguments[0]!==void 0?arguments[0]:null,t=arguments.length>1&&arguments[1]!==void 0?arguments[1]:null,s=arguments.length>2&&arguments[2]!==void 0?arguments[2]:null,r=i!==null?i:Math.round(this._wrapper.getBoundingClientRect().width),u=t!==null?t:this._innerWidth,h=s!==null?s:this._innerPosition;u<r||window.innerWidth<window.Helpers.LAYOUT_BREAKPOINT?(this._prevBtn.classList.add("d-none"),this._nextBtn.classList.add("d-none")):(this._prevBtn.classList.remove("d-none"),this._nextBtn.classList.remove("d-none")),u>r&&window.innerWidth>window.Helpers.LAYOUT_BREAKPOINT&&(h===0?this._prevBtn.classList.add("disabled"):this._prevBtn.classList.remove("disabled"),u+h<=r?this._nextBtn.classList.add("disabled"):this._nextBtn.classList.remove("disabled"))}},{key:"_innerWidth",get:function(){for(var i=this._inner.childNodes,t=0,s=0,r=i.length;s<r;s++)i[s].tagName&&(t+=Math.round(i[s].getBoundingClientRect().width));return t}},{key:"_innerPosition",get:function(){return parseInt(this._inner.style[this._rtl?"marginRight":"marginLeft"]||"0px",10)},set:function(i){return this._inner.style[this._rtl?"marginRight":"marginLeft"]="".concat(i,"px"),i}},{key:"closeAll",value:function(){for(var i=arguments.length>0&&arguments[0]!==void 0?arguments[0]:this._closeChildren,t=this._el.querySelectorAll(".menu-inner > .menu-item.open"),s=0,r=t.length;s<r;s++)this.close(t[s],i)}},{key:"update",value:function(){if(this._horizontal){this.closeAll();var i=Math.round(this._wrapper.getBoundingClientRect().width),t=this._innerWidth,s=this._innerPosition;i-s>t&&((s=i-t)>0&&(s=0),this._innerPosition=s),this._updateSlider(i,t,s)}else this._scrollbar&&this._scrollbar.update()}},{key:"manageScroll",value:function(){var i=window.PerfectScrollbar,t=document.querySelector(".menu-inner");if(window.innerWidth<window.Helpers.LAYOUT_BREAKPOINT)this._scrollbar!==null&&(this._scrollbar.destroy(),this._scrollbar=null),t.classList.add("overflow-auto");else{if(this._scrollbar===null){var s=new i(document.querySelector(".menu-inner"),{suppressScrollX:!0,wheelPropagation:!1});this._scrollbar=s}t.classList.remove("overflow-auto")}}},{key:"switchMenu",value:function(i){this._unbindEvents();var t=document.querySelector("nav.layout-navbar"),s=document.querySelector("#navbar-collapse"),r=document.querySelector("#layout-menu div"),u=document.querySelector("#layout-menu"),h=document.querySelector(".menu-horizontal-wrapper"),I=document.querySelector(".menu-inner"),b=document.querySelector(".app-brand"),m=document.querySelector(".layout-menu-toggle"),L=document.querySelectorAll(".menu-inner .active");if(i==="vertical"){var p,x;this._horizontal=!1,r.insertBefore(b,h),r.insertBefore(I,h),r.classList.add("flex-column","p-0"),(p=u.classList).remove.apply(p,Q(u.classList)),(x=u.classList).add.apply(x,["layout-menu","menu","menu-vertical"].concat([this._menuBgClass])),b.classList.remove("d-none","d-lg-flex"),m.classList.remove("d-none"),I.classList.add("overflow-auto");for(var f=0;f<L.length-1;++f)L[f].classList.add("open")}else{var E,v;this._horizontal=!0,t.children[0].insertBefore(b,s),b.classList.add("d-none","d-lg-flex"),h.appendChild(I),r.classList.remove("flex-column","p-0"),(E=u.classList).remove.apply(E,Q(u.classList)),(v=u.classList).add.apply(v,["layout-menu-horizontal","menu","menu-horizontal","container-fluid","flex-grow-0"].concat([this._menuBgClass])),m.classList.add("d-none"),I.classList.remove("overflow-auto");for(var V=0;V<L.length;++V)L[V].classList.remove("open")}this._bindEvents()}},{key:"destroy",value:function(){if(this._el){this._unbindEvents();for(var i=this._el.querySelectorAll(".menu-item"),t=0,s=i.length;t<s;t++)d._unbindAnimationEndEvent(i[t]),i[t].classList.remove("menu-item-animating"),i[t].classList.remove("open"),i[t].style.overflow=null,i[t].style.height=null;for(var r=this._el.querySelectorAll(".menu-menu"),u=0,h=r.length;u<h;u++)r[u].style.marginRight=null,r[u].style.marginLeft=null;this._el.classList.remove("menu-no-animation"),this._wrapper&&(this._prevBtn.parentNode.removeChild(this._prevBtn),this._nextBtn.parentNode.removeChild(this._nextBtn),this._wrapper.parentNode.insertBefore(this._inner,this._wrapper),this._wrapper.parentNode.removeChild(this._wrapper),this._inner.style.marginLeft=null,this._inner.style.marginRight=null),this._el.menuInstance=null,delete this._el.menuInstance,this._el=null,this._horizontal=null,this._animate=null,this._accordion=null,this._showDropdownOnHover=null,this._closeChildren=null,this._rtl=null,this._onOpen=null,this._onOpened=null,this._onClose=null,this._onClosed=null,this._scrollbar&&(this._scrollbar.destroy(),this._scrollbar=null),this._inner=null,this._prevBtn=null,this._wrapper=null,this._nextBtn=null}}}],l=[{key:"childOf",value:function(i,t){if(i.parentNode){for(;(i=i.parentNode)&&i!==t;);return!!i}return!1}},{key:"_isRoot",value:function(i){return!d._findParent(i,"menu-item",!1)}},{key:"_findParent",value:function(i,t){var s=!(arguments.length>2&&arguments[2]!==void 0)||arguments[2];if(i.tagName.toUpperCase()==="BODY")return null;for(i=i.parentNode;i.tagName.toUpperCase()!=="BODY"&&!i.classList.contains(t);)i=i.parentNode;if(!(i=i.tagName.toUpperCase()!=="BODY"?i:null)&&s)throw new Error("Cannot find `.".concat(t,"` parent element"));return i}},{key:"_findChild",value:function(i,t){for(var s=i.childNodes,r=[],u=0,h=s.length;u<h;u++)if(s[u].classList){for(var I=0,b=0;b<t.length;b++)s[u].classList.contains(t[b])&&(I+=1);t.length===I&&r.push(s[u])}return r}},{key:"_findMenu",value:function(i){for(var t=i.childNodes[0],s=null;t&&!s;)t.classList&&t.classList.contains("menu-sub")&&(s=t),t=t.nextSibling;if(!s)throw new Error("Cannot find `.menu-sub` element for the current `.menu-toggle`");return s}},{key:"_hasClass",value:function(i){var t=arguments.length>1&&arguments[1]!==void 0?arguments[1]:window.Helpers.ROOT_EL,s=!1;return i.split(" ").forEach((function(r){t.classList.contains(r)&&(s=!0)})),s}},{key:"_getItem",value:function(i,t){var s=null,r=t?"menu-toggle":"menu-link";if(i.classList.contains("menu-item")?d._findChild(i,[r]).length&&(s=i):i.classList.contains(r)&&(s=i.parentNode.classList.contains("menu-item")?i.parentNode:null),!s)throw new Error("".concat(t?"Toggable ":"","`.menu-item` element not found."));return s}},{key:"_getLink",value:function(i,t){var s=[],r=t?"menu-toggle":"menu-link";if(i.classList.contains(r)?s=[i]:i.classList.contains("menu-item")&&(s=d._findChild(i,[r])),!s.length)throw new Error("`".concat(r,"` element not found."));return s[0]}},{key:"_bindAnimationEndEvent",value:function(i,t){var s=function(u){u.target===i&&(d._unbindAnimationEndEvent(i),t(u))},r=window.getComputedStyle(i).transitionDuration;r=parseFloat(r)*(r.indexOf("ms")!==-1?1:1e3),i._menuAnimationEndEventCb=s,F.forEach((function(u){return i.addEventListener(u,i._menuAnimationEndEventCb,!1)})),i._menuAnimationEndEventTimeout=setTimeout((function(){s({target:i})}),r+50)}},{key:"_promisify",value:function(i){for(var t=arguments.length,s=new Array(t>1?t-1:0),r=1;r<t;r++)s[r-1]=arguments[r];var u=i.apply(void 0,s);return u instanceof Promise?u:u===!1?Promise.reject():Promise.resolve()}},{key:"_unbindAnimationEndEvent",value:function(i){var t=i._menuAnimationEndEventCb;i._menuAnimationEndEventTimeout&&(clearTimeout(i._menuAnimationEndEventTimeout),i._menuAnimationEndEventTimeout=null),t&&(F.forEach((function(s){return i.removeEventListener(s,t,!1)})),i._menuAnimationEndEventCb=null)}},{key:"setDisabled",value:function(i,t){d._getItem(i,!1).classList[t?"add":"remove"]("disabled")}},{key:"isActive",value:function(i){return d._getItem(i,!1).classList.contains("active")}},{key:"isOpened",value:function(i){return d._getItem(i,!1).classList.contains("open")}},{key:"isDisabled",value:function(i){return d._getItem(i,!1).classList.contains("disabled")}}],a&&B(C.prototype,a),l&&B(C,l),Object.defineProperty(C,"prototype",{writable:!1}),d})();return n})()}));(function(e,n){for(var o in n)e[o]=n[o]})(window,(function(e){var n={};function o(Q){if(n[Q])return n[Q].exports;var c=n[Q]={i:Q,l:!1,exports:{}};return e[Q].call(c.exports,c,c.exports,o),c.l=!0,c.exports}return o.m=e,o.c=n,o.d=function(Q,c,U){o.o(Q,c)||Object.defineProperty(Q,c,{enumerable:!0,get:U})},o.r=function(Q){typeof Symbol<"u"&&Symbol.toStringTag&&Object.defineProperty(Q,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(Q,"__esModule",{value:!0})},o.t=function(Q,c){if(1&c&&(Q=o(Q)),8&c||4&c&&typeof Q=="object"&&Q&&Q.__esModule)return Q;var U=Object.create(null);if(o.r(U),Object.defineProperty(U,"default",{enumerable:!0,value:Q}),2&c&&typeof Q!="string")for(var B in Q)o.d(U,B,(function(F){return Q[F]}).bind(null,B));return U},o.n=function(Q){var c=Q&&Q.__esModule?function(){return Q.default}:function(){return Q};return o.d(c,"a",c),c},o.o=function(Q,c){return Object.prototype.hasOwnProperty.call(Q,c)},o.p="",o(o.s=7)})({7:function(e,n,o){function Q(F,g){if(!(F instanceof g))throw new TypeError("Cannot call a class as a function")}function c(F,g){for(var d=0;d<g.length;d++){var C=g[d];C.enumerable=C.enumerable||!1,C.configurable=!0,"value"in C&&(C.writable=!0),Object.defineProperty(F,C.key,C)}}o.r(n),o.d(n,"Menu",(function(){return B}));var U=["transitionend","webkitTransitionEnd","oTransitionEnd"],B=(function(){function F(a){var l=arguments.length>1&&arguments[1]!==void 0?arguments[1]:{},i=arguments.length>2&&arguments[2]!==void 0?arguments[2]:null;Q(this,F),this._el=a,this._animate=l.animate!==!1,this._accordion=l.accordion!==!1,this._closeChildren=!!l.closeChildren,this._onOpen=l.onOpen||function(){},this._onOpened=l.onOpened||function(){},this._onClose=l.onClose||function(){},this._onClosed=l.onClosed||function(){},this._psScroll=null,this._topParent=null,this._menuBgClass=null,a.classList.add("menu"),a.classList[this._animate?"remove":"add"]("menu-no-animation"),a.classList.add("menu-vertical");var t=i||window.PerfectScrollbar;t?(this._scrollbar=new t(a.querySelector(".menu-inner"),{suppressScrollX:!0,wheelPropagation:!F._hasClass("layout-menu-fixed layout-menu-fixed-offcanvas")}),window.Helpers.menuPsScroll=this._scrollbar):a.querySelector(".menu-inner").classList.add("overflow-auto");for(var s=a.classList,r=0;r<s.length;r++)s[r].startsWith("bg-")&&(this._menuBgClass=s[r]);a.setAttribute("data-bg-class",this._menuBgClass),this._bindEvents(),a.menuInstance=this}var g,d,C;return g=F,C=[{key:"childOf",value:function(a,l){if(a.parentNode){for(;(a=a.parentNode)&&a!==l;);return!!a}return!1}},{key:"_isRoot",value:function(a){return!F._findParent(a,"menu-item",!1)}},{key:"_findParent",value:function(a,l){var i=!(arguments.length>2&&arguments[2]!==void 0)||arguments[2];if(a.tagName.toUpperCase()==="BODY")return null;for(a=a.parentNode;a.tagName.toUpperCase()!=="BODY"&&!a.classList.contains(l);)a=a.parentNode;if(!(a=a.tagName.toUpperCase()!=="BODY"?a:null)&&i)throw new Error("Cannot find `.".concat(l,"` parent element"));return a}},{key:"_findChild",value:function(a,l){for(var i=a.childNodes,t=[],s=0,r=i.length;s<r;s++)if(i[s].classList){for(var u=0,h=0;h<l.length;h++)i[s].classList.contains(l[h])&&(u+=1);l.length===u&&t.push(i[s])}return t}},{key:"_findMenu",value:function(a){for(var l=a.childNodes[0],i=null;l&&!i;)l.classList&&l.classList.contains("menu-sub")&&(i=l),l=l.nextSibling;if(!i)throw new Error("Cannot find `.menu-sub` element for the current `.menu-toggle`");return i}},{key:"_hasClass",value:function(a){var l=arguments.length>1&&arguments[1]!==void 0?arguments[1]:window.Helpers.ROOT_EL,i=!1;return a.split(" ").forEach((function(t){l.classList.contains(t)&&(i=!0)})),i}},{key:"_getItem",value:function(a,l){var i=null,t=l?"menu-toggle":"menu-link";if(a.classList.contains("menu-item")?F._findChild(a,[t]).length&&(i=a):a.classList.contains(t)&&(i=a.parentNode.classList.contains("menu-item")?a.parentNode:null),!i)throw new Error("".concat(l?"Toggable ":"","`.menu-item` element not found."));return i}},{key:"_getLink",value:function(a,l){var i=[],t=l?"menu-toggle":"menu-link";if(a.classList.contains(t)?i=[a]:a.classList.contains("menu-item")&&(i=F._findChild(a,[t])),!i.length)throw new Error("`".concat(t,"` element not found."));return i[0]}},{key:"_bindAnimationEndEvent",value:function(a,l){var i=function(s){s.target===a&&(F._unbindAnimationEndEvent(a),l(s))},t=window.getComputedStyle(a).transitionDuration;t=parseFloat(t)*(t.indexOf("ms")!==-1?1:1e3),a._menuAnimationEndEventCb=i,U.forEach((function(s){return a.addEventListener(s,a._menuAnimationEndEventCb,!1)})),a._menuAnimationEndEventTimeout=setTimeout((function(){i({target:a})}),t+50)}},{key:"_promisify",value:function(a){for(var l=arguments.length,i=new Array(l>1?l-1:0),t=1;t<l;t++)i[t-1]=arguments[t];var s=a.apply(void 0,i);return s instanceof Promise?s:s===!1?Promise.reject():Promise.resolve()}},{key:"_unbindAnimationEndEvent",value:function(a){var l=a._menuAnimationEndEventCb;a._menuAnimationEndEventTimeout&&(clearTimeout(a._menuAnimationEndEventTimeout),a._menuAnimationEndEventTimeout=null),l&&(U.forEach((function(i){return a.removeEventListener(i,l,!1)})),a._menuAnimationEndEventCb=null)}},{key:"setDisabled",value:function(a,l){F._getItem(a,!1).classList[l?"add":"remove"]("disabled")}},{key:"isActive",value:function(a){return F._getItem(a,!1).classList.contains("active")}},{key:"isOpened",value:function(a){return F._getItem(a,!1).classList.contains("open")}},{key:"isDisabled",value:function(a){return F._getItem(a,!1).classList.contains("disabled")}}],(d=[{key:"_bindEvents",value:function(){var a=this;this._evntElClick=function(l){if(l.target.closest("ul")&&l.target.closest("ul").classList.contains("menu-inner")){var i=F._findParent(l.target,"menu-item",!1);i&&(a._topParent=i.childNodes[0])}var t=l.target.classList.contains("menu-toggle")?l.target:F._findParent(l.target,"menu-toggle",!1);t&&(l.preventDefault(),t.getAttribute("data-hover")!=="true"&&a.toggle(t))},window.Helpers.isMobileDevice&&this._el.addEventListener("click",this._evntElClick),this._evntWindowResize=function(){a.update(),a._lastWidth!==window.innerWidth&&(a._lastWidth=window.innerWidth,a.update());var l=document.querySelector("[data-template^='horizontal-menu']");a._horizontal||l||a.manageScroll()},window.addEventListener("resize",this._evntWindowResize)}},{key:"_unbindEvents",value:function(){this._evntElClick&&(this._el.removeEventListener("click",this._evntElClick),this._evntElClick=null),this._evntElMouseOver&&(this._el.removeEventListener("mouseover",this._evntElMouseOver),this._evntElMouseOver=null),this._evntElMouseOut&&(this._el.removeEventListener("mouseout",this._evntElMouseOut),this._evntElMouseOut=null),this._evntWindowResize&&(window.removeEventListener("resize",this._evntWindowResize),this._evntWindowResize=null),this._evntBodyClick&&(document.body.removeEventListener("click",this._evntBodyClick),this._evntBodyClick=null),this._evntInnerMousemove&&(this._inner.removeEventListener("mousemove",this._evntInnerMousemove),this._evntInnerMousemove=null),this._evntInnerMouseleave&&(this._inner.removeEventListener("mouseleave",this._evntInnerMouseleave),this._evntInnerMouseleave=null)}},{key:"open",value:function(a){var l=this,i=arguments.length>1&&arguments[1]!==void 0?arguments[1]:this._closeChildren,t=this._findUnopenedParent(F._getItem(a,!0),i);if(t){var s=F._getLink(t,!0);F._promisify(this._onOpen,this,t,s,F._findMenu(t)).then((function(){l._horizontal&&F._isRoot(t)?l._onOpened&&l._onOpened(l,t,s,F._findMenu(t)):l._animate&&!l._horizontal?(window.requestAnimationFrame((function(){return l._toggleAnimation(!0,t,!1)})),l._accordion&&l._closeOther(t,i)):l._animate?l._onOpened&&l._onOpened(l,t,s,F._findMenu(t)):(t.classList.add("open"),l._onOpened&&l._onOpened(l,t,s,F._findMenu(t)),l._accordion&&l._closeOther(t,i))})).catch((function(){}))}}},{key:"close",value:function(a){var l=this,i=arguments.length>1&&arguments[1]!==void 0?arguments[1]:this._closeChildren,t=arguments.length>2&&arguments[2]!==void 0&&arguments[2],s=F._getItem(a,!0),r=F._getLink(a,!0);s.classList.contains("open")&&!s.classList.contains("disabled")&&F._promisify(this._onClose,this,s,r,F._findMenu(s),t).then((function(){if(l._horizontal&&F._isRoot(s))l._onClosed&&l._onClosed(l,s,r,F._findMenu(s));else if(l._animate&&!l._horizontal)window.requestAnimationFrame((function(){return l._toggleAnimation(!1,s,i)}));else{if(s.classList.remove("open"),i)for(var u=s.querySelectorAll(".menu-item.open"),h=0,I=u.length;h<I;h++)u[h].classList.remove("open");l._onClosed&&l._onClosed(l,s,r,F._findMenu(s))}})).catch((function(){}))}},{key:"_closeOther",value:function(a,l){for(var i=F._findChild(a.parentNode,["menu-item","open"]),t=0,s=i.length;t<s;t++)i[t]!==a&&this.close(i[t],l)}},{key:"toggle",value:function(a){var l=arguments.length>1&&arguments[1]!==void 0?arguments[1]:this._closeChildren,i=F._getItem(a,!0);i.classList.contains("open")?this.close(i,l):this.open(i,l)}},{key:"_findUnopenedParent",value:function(a,l){for(var i=[],t=null;a;)a.classList.contains("disabled")?(t=null,i=[]):(a.classList.contains("open")||(t=a),i.push(a)),a=F._findParent(a,"menu-item",!1);if(!t)return null;if(i.length===1)return t;for(var s=0,r=(i=i.slice(0,i.indexOf(t))).length;s<r;s++)if(i[s].classList.add("open"),this._accordion){for(var u=F._findChild(i[s].parentNode,["menu-item","open"]),h=0,I=u.length;h<I;h++)if(u[h]!==i[s]&&(u[h].classList.remove("open"),l))for(var b=u[h].querySelectorAll(".menu-item.open"),m=0,L=b.length;m<L;m++)b[m].classList.remove("open")}return t}},{key:"_toggleAnimation",value:function(a,l,i){var t=this,s=F._getLink(l,!0),r=F._findMenu(l);F._unbindAnimationEndEvent(l);var u=Math.round(s.getBoundingClientRect().height);l.style.overflow="hidden";var h=function(){l.classList.remove("menu-item-animating"),l.classList.remove("menu-item-closing"),l.style.overflow=null,l.style.height=null,t.update()};a?(l.style.height="".concat(u,"px"),l.classList.add("menu-item-animating"),l.classList.add("open"),F._bindAnimationEndEvent(l,(function(){h(),t._onOpened(t,l,s,r)})),setTimeout((function(){l.style.height="".concat(u+Math.round(r.getBoundingClientRect().height),"px")}),50)):(l.style.height="".concat(u+Math.round(r.getBoundingClientRect().height),"px"),l.classList.add("menu-item-animating"),l.classList.add("menu-item-closing"),F._bindAnimationEndEvent(l,(function(){if(l.classList.remove("open"),h(),i)for(var I=l.querySelectorAll(".menu-item.open"),b=0,m=I.length;b<m;b++)I[b].classList.remove("open");t._onClosed(t,l,s,r)})),setTimeout((function(){l.style.height="".concat(u,"px")}),50))}},{key:"_getItemOffset",value:function(a){for(var l=this._inner.childNodes[0],i=0;l!==a;)l.tagName&&(i+=Math.round(l.getBoundingClientRect().width)),l=l.nextSibling;return i}},{key:"_innerWidth",get:function(){for(var a=this._inner.childNodes,l=0,i=0,t=a.length;i<t;i++)a[i].tagName&&(l+=Math.round(a[i].getBoundingClientRect().width));return l}},{key:"_innerPosition",get:function(){return parseInt(this._inner.style[this._rtl?"marginRight":"marginLeft"]||"0px",10)},set:function(a){return this._inner.style[this._rtl?"marginRight":"marginLeft"]="".concat(a,"px"),a}},{key:"closeAll",value:function(){for(var a=arguments.length>0&&arguments[0]!==void 0?arguments[0]:this._closeChildren,l=this._el.querySelectorAll(".menu-inner > .menu-item.open"),i=0,t=l.length;i<t;i++)this.close(l[i],a)}},{key:"update",value:function(){this._scrollbar&&this._scrollbar.update()}},{key:"manageScroll",value:function(){var a=window.PerfectScrollbar,l=document.querySelector(".menu-inner");if(window.innerWidth<window.Helpers.LAYOUT_BREAKPOINT)this._scrollbar!==null&&(this._scrollbar.destroy(),this._scrollbar=null),l.classList.add("overflow-auto");else{if(this._scrollbar===null){var i=new a(document.querySelector(".menu-inner"),{suppressScrollX:!0,wheelPropagation:!1});this._scrollbar=i}l.classList.remove("overflow-auto")}}},{key:"destroy",value:function(){if(this._el){this._unbindEvents();for(var a=this._el.querySelectorAll(".menu-item"),l=0,i=a.length;l<i;l++)F._unbindAnimationEndEvent(a[l]),a[l].classList.remove("menu-item-animating"),a[l].classList.remove("open"),a[l].style.overflow=null,a[l].style.height=null;for(var t=this._el.querySelectorAll(".menu-menu"),s=0,r=t.length;s<r;s++)t[s].style.marginRight=null,t[s].style.marginLeft=null;this._el.classList.remove("menu-no-animation"),this._wrapper&&(this._prevBtn.parentNode.removeChild(this._prevBtn),this._nextBtn.parentNode.removeChild(this._nextBtn),this._wrapper.parentNode.insertBefore(this._inner,this._wrapper),this._wrapper.parentNode.removeChild(this._wrapper),this._inner.style.marginLeft=null,this._inner.style.marginRight=null),this._el.menuInstance=null,delete this._el.menuInstance,this._el=null,this._animate=null,this._accordion=null,this._closeChildren=null,this._onOpen=null,this._onOpened=null,this._onClose=null,this._onClosed=null,this._scrollbar&&(this._scrollbar.destroy(),this._scrollbar=null),this._inner=null,this._prevBtn=null,this._wrapper=null,this._nextBtn=null}}}])&&c(g.prototype,d),C&&c(g,C),Object.defineProperty(g,"prototype",{writable:!1}),F})()}}));let menu;(function(){document.querySelectorAll("#layout-menu").forEach(function(F){menu=new Menu(F,{orientation:"vertical",closeChildren:!1}),window.Helpers.scrollToActive(!1),window.Helpers.mainMenu=menu}),document.querySelectorAll(".layout-menu-toggle").forEach(F=>{F.addEventListener("click",g=>{g.preventDefault(),window.Helpers.toggleCollapsed()})});let o=function(F,g){let d=null;F.onmouseenter=function(){Helpers.isSmallScreen()?d=setTimeout(g,0):d=setTimeout(g,300)},F.onmouseleave=function(){document.querySelector(".layout-menu-toggle").classList.remove("d-block"),clearTimeout(d)}};document.getElementById("layout-menu")&&o(document.getElementById("layout-menu"),function(){Helpers.isSmallScreen()||document.querySelector(".layout-menu-toggle").classList.add("d-block")});let Q=document.getElementsByClassName("menu-inner"),c=document.getElementsByClassName("menu-inner-shadow")[0];Q.length>0&&c&&Q[0].addEventListener("ps-scroll-y",function(){this.querySelector(".ps__thumb-y").offsetTop?c.style.display="block":c.style.display="none"});const U=function(F){F.type=="show.bs.collapse"||F.type=="show.bs.collapse"?F.target.closest(".accordion-item").classList.add("active"):F.target.closest(".accordion-item").classList.remove("active")};[].slice.call(document.querySelectorAll(".accordion")).map(function(F){F.addEventListener("show.bs.collapse",U),F.addEventListener("hide.bs.collapse",U)}),window.Helpers.setAutoUpdate(!0),window.Helpers.initPasswordToggle(),window.Helpers.initSpeechToText(),!window.Helpers.isSmallScreen()&&window.Helpers.setCollapsed(!0,!1)})();function imageEl(e,n,o,Q="single"){var c='<div class="item-image">';return c+=`<img src="${o}" alt="${e}">`,c+='<div class="overlay">',c+='<button title="button" class="remove unchoose-image">&times;</button>',c+=`<h4>${e}</h4>`,Q=="single"?c+=`<input type="hidden" name="file" value="${n}">`:Q=="multiple"&&(c+=`<input type="hidden" name="files[]" value="${n}">`),c+="</div>",c+="</div>",c}$(document).on("change",".check-row",function(){let e=[];$(".check-row:checked").each(function(n){e[n]=$(this).val()}),$(this).prop("checked")?$(this).parent().parent().addClass("checked"):$(this).parent().parent().removeClass("checked"),e.length>0?($(".form-delete input[name=id_delete]").val(e),$(".form-delete button").prop("disabled",!1),$(".form-delete button").children("b").text(e.length)):($(".form-delete input[name=id_delete]").val(null),$(".form-delete button").prop("disabled",!0),$(".form-delete button").children("b").text(null))});$(document).on("change",".check-image",function(){let e=[];$(".check-image:checked").each(function(n){e[n]=$(this).val()}),e.length>0?($(".choose-images input[name=id_image]").val(e),$(".choose-images button").prop("disabled",!1),$(".choose-images button").children("b").text(`(${e.length})`)):($(".choose-images input[name=id_image]").val(null),$(".choose-images button").prop("disabled",!0),$(".choose-images button").children("b").text(null))});$(document).on("change","#grouped",function(){$(this).prop("checked")==!0?$("#grouped-alert").removeClass("d-none"):$(this).prop("checked")==!1&&$("#grouped-alert").addClass("d-none")});$(document).on("click",".unchoose-image",function(e){e.preventDefault(),$(this).parent().parent().parent().remove()});$(".btn-back").length>0&&$(".btn-back").on("click",function(e){window.history.back()});$(".change-file-type").length>0&&$(".change-file-type").on("click",function(){$("#input-file-type").val($(this).data("file-type"))});$(".change-input-edited").length>0&&$(".change-input-edited").on("keyup change",function(){let e=$(this).data("edit");$(`#edit-${e}`).prop("checked",!0)});$(".change-input-status").length>0&&$(".change-input-status").on("change",function(){let e=$(this).data("brand"),n=$(`.input-group-${e}`),o=$(`.input-${e}`);$(this).prop("checked")==!0?(n.removeClass("disabled"),o.prop("readonly",!1)):$(this).prop("checked")==!1&&(n.addClass("disabled"),o.prop("readonly",!0))});$(".choose-image").length>0&&$(".choose-image").on("change",function(){const e=this.files[0];if(e){let n=new FileReader;n.onload=function(o){$("#thumbail-preview").html(null),$("#thumbail-preview").append(`<div>${imageEl("Gambar","image",o.target.result)}</div>`)},n.readAsDataURL(e)}});$(".choose-images").length>0&&$(".choose-images").on("submit",function(e){e.preventDefault();let n=$(this).attr("action"),o=$("meta[name=csrf-token]").attr("content"),Q=$(".choose-images input[name=id_image]");$.ajax({type:"POST",url:n,dataType:"json",data:{_token:o,id:Q.val()},error:function(c,U,B){console.log(c),console.log(c.responseText)},success:function(c){$("#single-storage-modal").length>0?($("#thumbail-preview").html(null),$("#single-storage-modal").modal("hide"),$.each(c,function(U,B){$("#thumbail-preview").append(`<div>${imageEl(B.title,B.file,B.url,"single")}</div>`)})):$("#multiple-storage-modal").length>0&&($("#multiple-storage-modal").modal("hide"),$.each(c,function(U,B){$("#thumbail-preview").append(`<div class="col-6 col-md-3">${imageEl(B.title,B.file,B.url,"multiple")}<input type="text" name="files_name[]" class="form-control rounded-0" value="${B.title}"></div>`)})),$(".check-image").prop("checked",!1),setTimeout(()=>{Q.val(null),$(".choose-images button").children("b").text(null)},200)}})});$(".choose-youtube").length>0&&$(".choose-youtube").on("submit",function(e){e.preventDefault();let n=$(this).attr("action"),o=$("meta[name=csrf-token]").attr("content"),Q=$(".choose-youtube input[name=url-input-youtube]");$.ajax({type:"POST",url:n,dataType:"json",data:{_token:o,id:Q.val()},error:function(c,U,B){console.log(c),console.log(c.responseText)},success:function(c){console.log(c),$("#input-youtube-modal").modal("hide"),$("#thumbail-preview").html(null),$.each(c,function(U,B){$("#thumbail-preview").append(`<div>${imageEl(B.title,B.file,B.url)}</div>`)})}})});$(".counting-input").length>0&&$(".counting-input").on("keyup",function(){$(".counting").text($(this).val().length)});$(".dropify").length>0&&($(".dropify").dropify({messages:{default:"",replace:"",remove:"&times;"}}),$(".dropify").on("change",function(e){$(".dropify-title").val(e.target.files[0].name)}));$(".paste-button").length>0&&$(".paste-button").on("click",function(e){e.preventDefault(),navigator.clipboard.readText().then(n=>$(".paste-input").val(n),n=>console.log(n))});if($(".select2").length>0){let e=function(n){if(!n.id)return n.text;var o=$('<span><i class="bx bx-album"></i> '+n.text+"</span>");return o};$(".select2").select2({templateResult:e})}if($(".tag-input").length>0){let e=function(n){return`<span class="badge bg-primary mt-1 me-1"><i class="bx bx-x text-danger cursor-pointer me-1 tag-remove"></i>${n}<input type="hidden" name="tags[]" value="${n}"></span>`};var tag_preview=$("#tag-preview"),tag_input=$(".tag-input");$(".tag-button").on("click",function(n){n.preventDefault(),tag_preview.append(e(tag_input.val())),tag_input.val(null)}),$(document).on("click",".tag-remove",function(n){n.preventDefault(),$(this).parent().remove()})}const Toast=Swal.mixin({toast:!0,position:"top-end",showConfirmButton:!1,timer:5e3,timerProgressBar:!0,didOpen:e=>{e.addEventListener("mouseenter",Swal.stopTimer),e.addEventListener("mouseleave",Swal.resumeTimer)}}),SwalDelete=Swal.mixin({title:"Buang data?",icon:"question",showCancelButton:!0,confirmButtonText:"Ya, buang!",cancelButtonText:"Batal",reverseButtons:!0,customClass:{confirmButton:"btn btn-danger mx-1",cancelButton:"btn btn-light mx-1"},buttonsStyling:!1,allowOutsideClick:!1});new PerfectScrollbar(".menu-inner");$(".horizonbar").length>1&&new PerfectScrollbar(".horizonbar");if($(".dataTables-origin").length>0){var dataTables=$(".dataTables-origin").DataTable({responsive:!0,ordering:!0,autoWidth:!1,language:{search:"_INPUT_",searchPlaceholder:"Cari",searchClass:"form-control",lengthMenu:"_MENU_",zeroRecords:"Kosong",info:"Data total: _TOTAL_",infoEmpty:"",paginate:{previous:'<i class="bx bx-chevron-left"></i>',next:'<i class="bx bx-chevron-right"></i>'},infoFiltered:"/ _MAX_"}});$(".dataTables_filter").children("label").addClass("d-block p-3"),$(".dataTables_filter").children("label").children("input").addClass("form-control m-0"),$(".dataTables_length").children("label").addClass("d-block p-3"),$(".dataTables_length").children("label").children("select").addClass("form-select m-0"),$(".dataTables_info").addClass("p-3"),$(".dataTables_paginate").addClass("p-3")}if($(".dataTables").length>0){let e=$(".dataTables").data("list"),n=$("meta[name=csrf-token]").attr("content");var dataTables=$(".dataTables").DataTable({responsive:!0,ordering:!1,autoWidth:!1,language:{search:"_INPUT_",searchPlaceholder:"Cari",searchClass:"form-control",lengthMenu:"_MENU_",zeroRecords:"Kosong",info:"Data total: _TOTAL_",infoEmpty:"",paginate:{previous:'<i class="bx bx-chevron-left"></i>',next:'<i class="bx bx-chevron-right"></i>'},infoFiltered:"/ _MAX_"},serverSide:!0,ajax:{url:e,type:"post",dataType:"json",data:{_token:n},error:function(Q,c,U){console.log(Q.responseText)}},columns:[{data:"id",name:"id"},{data:"title",name:"title"},{data:"info",name:"info"},{data:"log",name:"log"}]});$(".dataTables_filter").children("label").addClass("d-block p-3"),$(".dataTables_filter").children("label").children("input").addClass("form-control m-0"),$(".dataTables_length").children("label").addClass("d-block p-3"),$(".dataTables_length").children("label").children("select").addClass("form-select m-0"),$(".dataTables_info").addClass("p-3"),$(".dataTables_paginate").addClass("p-3")}$(".form-insert").length>0&&(document.addEventListener("keydown",function(e){e.ctrlKey&&e.key==="s"&&(e.preventDefault(),$(".form-insert").submit())}),$(".form-insert").on("submit",function(e){e.preventDefault();let n=$(this).attr("action");$.ajax({type:"POST",url:n,dataType:"json",data:new FormData(this),contentType:!1,cache:!1,processData:!1,error:function(o,Q,c){console.log(o),console.log(o.responseText),$(".form-insert").find("button[type=submit]").prop("disabled",!1);let U="<ol style=padding:10px>";$.each(o.responseJSON.errors,function(B,F){U+=`<li>${F}</li>`}),U+="</ol>",Swal.fire({icon:"error",title:"Error",html:U})},beforeSend:function(){$(".form-insert").find("button[type=submit]").prop("disabled",!0),Toast.fire({icon:"info",title:"Mohon tunggu",text:"Sedang dalam proses..",timer:!1})},success:function(o){$(".form-insert").find("button[type=submit]").prop("disabled",!1),Toast.fire(o.toast),o.redirect.type=="assign"?setTimeout(()=>{window.location.assign(o.redirect.value)},1e3):o.redirect.type=="dataTables"?(dataTables.ajax.reload(),$(".form-insert")[0].reset(),$(".dropify-clear").click()):o.redirect.type=="reload"?setTimeout(()=>{window.location.reload()},1e3):o.redirect.type=="nothing"}})}));$(".form-update").length>0&&(document.addEventListener("keydown",function(e){e.ctrlKey&&e.key==="s"&&(e.preventDefault(),$(".form-update").submit())}),$(".form-update").on("submit",function(e){e.preventDefault();let n=$(this).attr("action");$.ajax({type:"POST",url:n,dataType:"json",data:new FormData(this),contentType:!1,cache:!1,processData:!1,error:function(o,Q,c){console.log(o),console.log(o.responseText),$(".form-update").find("button[type=submit]").prop("disabled",!1);let U="<ol style=padding:10px>";$.each(o.responseJSON.errors,function(B,F){U+=`<li>${F}</li>`}),U+="</ol>",Swal.fire({icon:"error",title:"Error",html:U})},beforeSend:function(){$(".form-update").find("button[type=submit]").prop("disabled",!0),Toast.fire({icon:"info",title:"Mohon tunggu",text:"Sedang dalam proses..",timer:!1})},success:function(o){$(".form-update").find("button[type=submit]").prop("disabled",!1),Toast.fire(o.toast),o.redirect.type=="assign"?setTimeout(()=>{window.location.assign(o.redirect.value)},1e3):o.redirect.type=="dataTables"?(dataTables.ajax.reload(),$(".form-update")[0].reset(),$(".dropify-clear").click()):o.redirect.type=="reload"?setTimeout(()=>{window.location.reload()},1e3):o.redirect.type=="nothing"}})}));$(".form-delete").length>0&&($(window).bind("keyup","delete",function(e){e.which==46&&(e.preventDefault(),$(".form-delete").submit())},!1),$(".form-delete").on("submit",function(e){e.preventDefault();let n=$(this).attr("action"),o=$("meta[name=csrf-token]").attr("content"),Q=$("input[name=id_delete]").val(),c=$(".form-delete").data("message");SwalDelete.fire({text:c}).then(U=>{U.isConfirmed&&$.ajax({type:"DELETE",url:n,dataType:"json",data:{_token:o,id:Q},error:function(B,F,g){console.log(B),console.log(B.responseText)},success:function(B){Toast.fire(B.toast),B.redirect.type=="assign"?setTimeout(()=>{window.location.assign(B.redirect.value)},1e3):B.redirect.type=="dataTables"?(dataTables.ajax.reload(),$(".form-delete input[name=id_delete]").val(null),$(".form-delete button").prop("disabled",!0),$(".form-delete button").children("b").html(null)):B.redirect.type=="reload"?setTimeout(()=>{window.location.reload()},1e3):B.redirect.type=="nothing"}})})}));$(".delete-member").length>0&&$(".delete-member").on("click",function(e){e.preventDefault();let n=$(this).data("url"),o=$(this).data("message");SwalDelete.fire({title:"Hapus akun?",confirmButtonText:"Hapus akun",html:`<p class="p-3">${o}</p>`}).then(Q=>{Q.isConfirmed&&$.ajax({type:"get",url:n,success:function(c){Swal.fire({html:'<p class="p-3">Proses menghapus data, harap tunggu..</p>',timer:15e3,allowOutsideClick:!1,timerProgressBar:!0,showConfirmButton:!1}).then(U=>{location.assign(c.redirect)})}})})});$(".deactive-member").length>0&&($(".active-member").on("click",function(e){e.preventDefault();let n=$(this).data("url");$.ajax({url:n,type:"get",error:function(o){console.log(o)},beforeSend:function(){$(".active-member").prop("disabled",!0),$(".deactive-member").prop("disabled",!1)},success:function(o){$(".deactive-member").show(),$(".active-member").hide(),Toast.fire(o.toast),$(".user-stat").find("span.badge").text("Aktif").addClass("bg-success").removeClass("bg-gray")}})}),$(".deactive-member").on("click",function(e){e.preventDefault();let n=$(this).data("url");$.ajax({url:n,type:"get",beforeSend:function(){$(".deactive-member").prop("disabled",!0),$(".active-member").prop("disabled",!1)},success:function(o){$(".active-member").show(),$(".deactive-member").hide(),Toast.fire(o.toast),$(".user-stat").find("span.badge").text("Non-Aktif").removeClass("bg-success").addClass("bg-gray")}})}));$(".mce").length>0&&tinymce.init({selector:"textarea.mce",plugins:"preview paste searchreplace autolink directionality code visualblocks visualchars image link table charmap hr pagebreak nonbreaking anchor insertdatetime advlist lists wordcount textpattern noneditable charmap quickbars emoticons",imagetools_cors_hosts:["picsum.photos"],menubar:!1,toolbar:["bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | numlist bullist | outdent indent","fontselect fontsizeselect formatselect","forecolor backcolor removeformat | table | image link | charmap emoticons | pagebreak | code preview |"],toolbar_sticky:!1,automatic_uploads:!0,autosave_ask_before_unload:!0,autosave_interval:"30s",autosave_prefix:"{path}{query}-{id}-",autosave_restore_when_empty:!1,autosave_retention:"2m",content_style:"img {max-width: 100%;}",content_css:"//www.tiny.cloud/css/codepen.min.css",file_picker_types:"image",file_picker_callback:function(e,n,o){if(o.filetype==="file"&&e("https://www.google.com/logos/google.jpg",{text:"Google"}),o.filetype==="image"){let Q=document.createElement("input");Q.setAttribute("type","file"),Q.setAttribute("accept","image/*"),Q.onchange=function(){let c=this.files[0],U=new FileReader;U.onload=function(){let B="blobid"+new Date().getTime(),F=tinymce.activeEditor.editorUpload.blobCache,g=U.result.split(",")[1],d=F.create(B,c,g);F.add(d),e(d.blobUri(),{title:c.name})},U.readAsDataURL(c)},Q.click()}},height:360,image_dimensions:!1,image_caption:!1,image_class:!1,noneditable_noneditable_class:"mceNonEditable",contextmenu:"selectall copy cut paste | link",setup:function(e){e.on("change",function(){e.save()}),e.addShortcut("ctrl+s","Save Form","custom_ctrl_s"),e.addCommand("custom_ctrl_s",function(){$(".form-insert").length>0?$(".form-insert").submit():$(".form-update").length>0?$(".form-update").submit():alert("form apa ini?")})}});const tooltipTriggerList=[].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));tooltipTriggerList.map(function(e){return new Tooltip(e)})});export default R();
