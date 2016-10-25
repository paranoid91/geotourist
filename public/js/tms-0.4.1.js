function swtch(t,n){return"string"==typeof t||"number"==typeof t?n[t]?n[t]:n["default"]||t:"object"==typeof t?function(){var e,a=t instanceof Array?[]:{};if(t.constructor===RegExp)for(e in n)n.hasOwnProperty(e)&&t.test(e)&&(a[e]=n[e]);else for(e in t)t.hasOwnProperty(e)&&(a[e]=swtch(t[e],n));return a}():"function"==typeof t?swtch(t(),n):t}!function(t){t.fn.TMSlider=t.fn.TMS=t.fn._TMS=function(e){return this.each(function(){var a=t(this),s=a.data("_TMS")||{presets:{centralExpand:{reverseWay:!1,interval:80,blocksX:8,blocksY:4,easing:"easeInQuad",way:"diagonal",anim:"centralExpand"},zoomer:{reverseWay:!1,interval:"1",blocksX:"1",blocksY:"1",easing:"",way:"lines",anim:"zoomer"},fadeThree:{reverseWay:!1,interval:"1",blocksX:"1",blocksY:"1",easing:"",way:"lines",anim:"fadeThree"},simpleFade:{reverseWay:!1,interval:"1",blocksX:"1",blocksY:"1",easing:"",way:"lines",anim:"fade"},gSlider:{reverseWay:!1,interval:40,blocksX:"1",blocksY:"1",easing:"",way:"lines",anim:"gSlider"},vSlider:{reverseWay:!1,interval:40,blocksX:"1",blocksY:"1",easing:"",way:"lines",anim:"vSlider"},slideFromLeft:{reverseWay:!1,interval:"1",blocksX:"1",blocksY:"1",easing:"easeOutBack",way:"lines",anim:"slideFromLeft"},slideFromTop:{reverseWay:!1,interval:"1",blocksX:"1",blocksY:"1",easing:"easeOutBack",way:"lines",anim:"slideFromTop"},diagonalFade:{reverseWay:!1,interval:40,blocksX:12,blocksY:6,easing:"easeInQuad",way:"diagonal",anim:"fade"},diagonalExpand:{reverseWay:!1,interval:40,blocksX:8,blocksY:4,easing:"easeInQuad",way:"diagonal",anim:"expand"},fadeFromCenter:{reverseWay:!0,interval:"10",blocksX:"10",blocksY:"6",easing:"",way:"spiral",anim:"fade"},lines:{reverseWay:!1,interval:40,blocksX:"20",blocksY:"1",easing:"",way:"lines",anim:"slideRight"},verticalLines:{reverseWay:!1,interval:1,blocksX:12,blocksY:1,easing:"swing",way:"lines",anim:"vSlideOdd"},horizontalLines:{reverseWay:!1,interval:1,blocksX:1,blocksY:12,easing:"swing",way:"lines",anim:"gSlideOdd"},random:{prsts:["centralExpand","fadeThree","simpleFade","gSlider","vSlider","slideFromLeft","slideFromTop","diagonalFade","diagonalExpand","fadeFromCenter","zabor","vertivalLines","gorizontalLines"]}},ways:{lines:function(){for(var t=this,n=[],e=0;e<t.maskC.length;e++)n.push(t.maskC.eq(e));return n},spiral:function(){var t,n=this,e=[],a=0,i=n.blocksY,s=n.blocksX,o=function(){for(t=a;s-1-a>t;t++){if(!(e.length<n.maskC.length))return!1;e.push(n.matrix[a][t])}r()},r=function(){for(t=a;i-1-a>t;t++){if(!(e.length<n.maskC.length))return!1;e.push(n.matrix[t][s-1-a])}h()},h=function(){for(t=a;s-1-a>t;t++){if(!(e.length<n.maskC.length))return!1;e.push(n.matrix[i-1-a][s-t-1])}u()},u=function(){for(t=a;i-1-a>t;t++){if(!(e.length<n.maskC.length))return!1;e.push(n.matrix[i-t-1][a])}o(a++)};return o(),e},vSnake:function(){var t,n,e=this,a=[],i=e.blocksY,s=e.blocksX;for(n=0;s>n;n++)for(t=0;i>t;t++).5*n==~~(n/2)?a.push(e.matrix[t][n]):a.push(e.matrix[i-1-t][n]);return a},gSnake:function(){var t,n,e=this,a=[],i=e.blocksY,s=e.blocksX;for(n=0;i>n;n++)for(t=0;s>t;t++).5*n==~~(n/2)?a.push(e.matrix[n][t]):a.push(e.matrix[n][s-1-t]);return a},diagonal:function(){var t=this,e=[],a=t.blocksY,i=t.blocksX,s=j=n=0;for(s=0;i>s;s++)for(e[s]=[],j=0;j<=s;j++)j<a&&e[s].push(t.matrix[j][s-j]);for(s=1;a>s;s++)for(j=0,e[n=e.length]=[];j<a-s;j++)e[n].push(t.matrix[s+j][i-1-j]);return e},chess:function(){for(var t=this,n=0,e=[[],[]],a=0;n<t.maskC.length;n++)e[a=a?0:1].push(t.maskC.eq(n));return e},randomly:function(){var t=this,n=[];for(i=0;i<t.maskC.length;i++)n.push(t.maskC.eq(i));for(i=0;i<t.maskC.length;i++)n.push(n.splice(parseInt(Math.random()*t.maskC.length-1),1)[0]);return n}},anims:{centralExpand:function(n,e){t(n).each(function(){var n=t(this).css({visibility:"hidden"}),a=n.show().prop("offsetLeft"),i=n.show().prop("offsetTop"),o=n.width(),r=n.height();n.stop().css({left:a+o/2,top:i+r/2,width:0,height:0,visibility:"visible",opacity:0}).animate({width:o},{step:function(t){var e=1-(o-t)/100;n.css({height:r*e,left:a+o/2*(1-e),top:i+r/2*(1-e),backgroundPosition:"-"+(a+o/2*(1-e))+"px -"+(i+r/2*(1-e))+"px",opacity:e})},duration:s.duration,easing:s.easing,complete:function(){e&&s.afterShow()}})})},fadeThree:function(n,e){var a=this;t(n).each(function(n){var i=t(this).show().css({left:-a.width/4,top:0,zIndex:2,opacity:0}),s=i.clone().appendTo(i.parent()).css({left:a.width/4,top:a.height/4,zIndex:1}),o=i.clone().appendTo(i.parent()).css({left:0,top:-a.height/4,zIndex:1});s.stop().animate({left:0,top:0,opacity:1},{duration:a.duration,easing:a.easing}),o.stop().animate({left:0,top:0,opacity:1},{duration:a.duration,easing:a.easing}),i.stop().animate({left:0,top:0,opacity:1},{duration:a.duration,easing:a.easing,complete:function(){e&&a.afterShow(),s.remove(),o.remove()}})})},zoomer:function(n,e){s.slideshow&&(s.slideshow=s.duration-2e3),n.each(function(){var n,e,a=s.next,i=t.browser.msie&&t.browser.version<9,o=t(new Image),r=t(i?new Image:"<canvas></canvas>"),h=s.duration,u=s.presetParam.k||1.2,c=s.pic,p=t("<div></div>").css({position:"absolute",left:0,top:0,zIndex:10,width:c.width(),height:c.height(),overflow:"hidden",opacity:0}),l=function(t,n){var e,a={},r=!i&&t[0].getContext("2d"),e=0,u=1/h*40,c=function(e){i?t.css({left:n.start.left+(n.finish.left-n.start.left)*e,top:n.start.top+(n.finish.top-n.start.top)*e,width:n.start.width+(n.finish.width-n.start.width)*e,height:n.start.height+(n.finish.height-n.start.height)*e}):r.drawImage(o[0],a.left=n.start.left+(n.finish.left-n.start.left)*e,a.top=n.start.top+(n.finish.top-n.start.top)*e,a.width=n.start.width+(n.finish.width-n.start.width)*e,a.height=n.start.height+(n.finish.height-n.start.height)*e)};c(0),clearInterval(s["int"]),s["int"]=setInterval(function(){return s.paused?!1:e>=1?(clearInterval(s["int"]),!1):(e+=u,void c(e))},40)},d=function(n,e,a){var i="zoom,move".split(",")[~~(2*Math.random())],s="left,right,top,bottom,leftTop,leftBottom,center".split(",")[~~(7*Math.random())],o=[!1,!0][~~(2*Math.random())],r={start:{left:0,top:0,width:n,height:e},finish:{width:n*a,height:e*a}};return swtch(i,{zoom:function(){r.finish=swtch(s,{left:{left:0,top:-(e*a-e)/2},right:{left:-(n*a-n),top:-(e*a-e)/2},top:{left:-(n*a-n)/2,top:0},bottom:{left:-(n*a-n)/2,top:-(e*a-e)},leftTop:{left:0,top:0},rightTop:{left:-(n*a-n),top:0},leftBottom:{left:0,top:-(e*a-e)},rightBottom:{left:-(n*a-n),top:-(e*a-e)},center:{left:-(n*a-n)/2,top:-(e*a-e)/2}}),r.finish.width=n*a,r.finish.height=e*a},move:function(){r=t.extend(!0,r,"center"!=s?{start:{width:n*a,height:e*a}}:{}),r=t.extend(!0,r,swtch(s,{left:{finish:{left:0,top:-(e*a-e)}},right:{start:{left:-(n*a-n)},finish:{left:-(n*a-n),top:-(e*a-e)}},top:{finish:{left:-(n*a-n),top:0}},bottom:{start:{top:-(e*a-e)},finish:{left:-(n*a-n),top:-(e*a-e)}},leftTop:{finish:{left:-(n*a-n),top:-(e*a-e)}},leftBottom:{start:{top:-(e*a-e)},finish:{left:-(n*a-n),top:0}},center:{finish:{left:-(n*a-n)/2,top:-(e*a-e)/2}}}))}})(),o&&(o=r.start,r.start=r.finish,r.finish=o),r};o.css({left:"-999%",top:"-999%",position:"absolute"}).appendTo("body").load(function(){n=o.width(),e=o.height(),i?r=o.css({position:"absolute",left:0,top:0,zIndex:1}).appendTo(p.appendTo(c)):r.appendTo(p.appendTo(c)).attr({width:c.width(),height:c.height()}),s.afterShow(),s.bl=!0,p.stop().animate({opacity:1},{duration:s.presetParam.crossFadeDur||2e3,complete:function(){}}),t.when(p).then(function(){s.bl=!1,c.children().not(p).remove()}),l(r,d(n,e,u)),!i&&o.detach()}).attr({src:a})})},fade:function(n,e){var a=this;t(n).each(function(){t(this).css({opacity:0}).show().stop().animate({opacity:1},{duration:+a.duration,easing:a.easing,complete:function(){e&&a.afterShow()}})})},expand:function(n,e){var a=this;t(n).each(function(){t(this).hide().show(+a.duration,function(){e&&a.afterShow()})})},slideDown:function(n,e){var a=this;t(n).each(function(){var n=t(this).show(),i=n.height();n.css({height:0}).stop().animate({height:i},{duration:a.duration,easing:a.easing,complete:function(){e&&a.afterShow()}})})},slideLeft:function(n,e){var a=this;t(n).each(function(){var n=t(this).show(),i=n.width();n.css({width:0}).stop().animate({width:i},{duration:a.duration,easing:a.easing,complete:function(){e&&a.afterShow()}})})},slideUp:function(n,e){var a=this;t(n).each(function(){var n=t(this).show(),i=n.height(),s=n.attr("offsetLeft"),o=n.attr("offsetTop");n.css({height:0,top:o+i}).stop().animate({height:i},{duration:a.duration,easing:a.easing,step:function(t){var e=o+i-t;n.css({top:e,backgroundPosition:"-"+s+"px -"+e+"px"})},complete:function(){e&&a.afterShow()}})})},slideRight:function(n,e){var a=this;t(n).each(function(){var n=t(this).show(),i=n.width(),s=n.attr("offsetLeft"),o=n.attr("offsetTop");n.css({width:0,left:s+i}).stop().animate({width:i},{duration:a.duration,easing:a.easing,step:function(t){var e=s+i-t;n.css({left:e,backgroundPosition:"-"+e+"px -"+o+"px"})},complete:function(){e&&a.afterShow()}})})},slideFromTop:function(n,e){var a=this;t(n).each(function(){var n=t(this),i=n.show().css("top"),s=n.height();n.css({top:-s}).stop().animate({top:i},{duration:+a.duration,easing:a.easing,complete:function(){e&&a.afterShow()}})})},slideFromDown:function(n,e){var a=this;t(n).each(function(){var n=t(this),i=n.show().css("top"),s=n.height();n.css({top:s}).stop().animate({top:i},{duration:+a.duration,easing:a.easing,complete:function(){e&&a.afterShow()}})})},slideFromLeft:function(n,e){var a=this;t(n).each(function(){var n=t(this),i=n.show().css("left"),s=n.width();n.css({left:-s}).stop().animate({left:i},{duration:+a.duration,easing:a.easing,complete:function(){e&&a.afterShow()}})})},slideFromRight:function(n,e){var a=this;t(n).each(function(){var n=t(this),i=n.show().css("left"),s=n.width();n.css({left:s}).stop().animate({left:i},{duration:+a.duration,easing:a.easing,complete:function(){e&&a.afterShow()}})})},gSlider:function(t,n){var e=this,a=e.maskC.clone(),i=a.width();a.appendTo(e.maskC.parent()).css({background:e.pic.css("backgroundImage")}).show(),t.show().css({left:e.direction>0?-i:i}).stop().animate({left:0},{duration:+e.duration,easing:e.easing,step:function(t){e.direction>0?a.css("left",t+i):a.css("left",t-i)},complete:function(){a.remove(),n&&e.afterShow()}})},vSlider:function(t,n){var e=this,a=e.maskC.clone(),i=a.height();a.appendTo(e.maskC.parent()).css({background:e.pic.css("backgroundImage")}).show(),t.show().css({top:e.direction>0?-i:i}).stop().animate({top:0},{duration:+e.duration,easing:e.easing,step:function(t){e.direction>0?a.css("top",t+i):a.css("top",t-i)},complete:function(){a.remove(),n&&e.afterShow()}})},vSlideOdd:function(n,e){var a=this;t(n).each(function(){var n=t(this),i=n.show().css("top"),s=n.height(),o=a.odd;n.css({top:o?-s:s}).stop().animate({top:i},{duration:+a.duration,easing:a.easing,complete:function(){e&&a.afterShow()}}),a.odd=a.odd?!1:!0})},gSlideOdd:function(n,e){var a=this;t(n).each(function(){var n=t(this),i=n.show().css("left"),s=n.width(),o=a.odd;n.css({left:o?-s:s}).stop().animate({left:i},{duration:+a.duration,easing:a.easing,complete:function(){e&&a.afterShow()}}),a.odd=a.odd?!1:!0})}},etal:"<div></div>",items:".items>li",pic:"pic",mask:"mask",paginationCl:"pagination",currCl:"current",pauseCl:"paused",bannerCl:"banner",numStatusCl:"numStatus",pagNums:!0,overflow:"hidden",show:0,changeEv:"click",blocksX:1,blocksY:1,preset:"simpleFade",presetParam:{},duration:1e3,easing:"linear",way:"lines",anim:"fade",pagination:!1,banners:!1,waitBannerAnimation:!0,slideshow:!1,progressBar:!1,pauseOnHover:!1,nextBu:!1,prevBu:!1,playBu:!1,preFu:function(){var n=this,e=t(new Image);n.pic=t(n.etal).addClass(n.pic).css({overflow:n.overflow}).appendTo(n.me),n.mask=t(n.etal).addClass(n.mask).appendTo(n.pic),"static"==n.me.css("position")&&n.me.css({position:"relative"}),"auto"==n.me.css("z-index")&&n.me.css({zIndex:1}),n.me.css({overflow:n.overflow}),n.items&&n.parseImgFu(),e.appendTo(n.me).load(function(){setTimeout(function(){n.pic.css({width:n.width=e.width(),height:n.height=e.height(),background:"zoomer"==n.preset?"none":"url("+n.itms[n.show]+") 0 0 no-repeat"}),e.remove(),n.current=n.buff=n.show;var t;"zoomer"==n.preset&&(t=n.n,n.n=-1,n.changeFu(t))},1)}).attr({src:n.itms[n.n=n.show]})},sliceFu:function(n,e){var a,i,s=this,n=s.blocksX,e=s.blocksY,o=parseInt(s.width/n),r=parseInt(s.height/e),h=(t(s.etal),s.pic.width()-o*n),u=s.pic.height()-r*e,c=s.matrix=[];for(s.mask.css({position:"absolute",width:"100%",height:"100%",left:0,top:0,zIndex:1}).empty().appendTo(s.pic),i=0;e>i;i++)for(a=0;n>a;a++)c[i]=c[i]?c[i]:[],c[i][a]=t(s.etal).clone().appendTo(s.mask).css({left:a*o,top:i*r,position:"absolute",width:a==n-1?o+h:o,height:i==e-1?r+u:r,backgroundPosition:"-"+a*o+"px -"+i*r+"px",display:"none"});s.maskC&&(s.maskC.remove(),delete s.maskC),s.maskC=s.mask.children()},changeFu:function(n){var e=this;if(e.bl)return!1;if(n==e.n)return!1;e.n=n,e.next=e.itms[n],e.direction=n-e.buff,e.pagination&&e.pagination!==!0&&e.pagination.data("uCarousel")&&e.pagination.uCarousel(n),e.direction==e.itms.length-1&&(e.direction=-1),e.direction==-1*e.itms.length+1&&(e.direction=2),e.current=e.buff=n,e.numStatus&&e.numStatusChFu(),e.pagination&&e.pags.removeClass(e.currCl).eq(n).addClass(e.currCl),e.banners!==!1&&e.banner&&e.bannerHide(e.banner,e),e.progressBar&&(clearInterval(e.slShTimer),e.progressBar.stop()),e.slideshow&&!e.paused&&e.progressBar&&e.progressBar.stop().width(0);var a=function(){t.browser.msie&&t.browser.version<9&&"zoomer"==e.preset&&(e.preset="simpleFade",e.duration=1e3),e.preset_!=e.preset&&(e.du=e.duration,e.ea=e.easing,t.extend(e,e.presets[e.preset]),e.duration=e.du,e.easing=e.ea,e.preset_=e.preset),"random"==e.preset&&(t.extend(e,e.presets[e.prsts[parseInt(Math.random()*e.prsts.length)]]),e.reverseWay=[!0,!1][parseInt(2*Math.random())]),e.sliceFu(),e.maskC.stop().css({backgroundImage:"url("+e.next+")"}),e.beforeAnimation(),e.showFu()};e.waitBannerAnimation?t.when(e.banner).then(a):a()},nextFu:function(){var t=this,n=t.n;t.changeFu(++n<t.itms.length?n:0)},prevFu:function(){var t=this,n=t.n;t.changeFu(--n>=0?n:t.itms.length-1)},showFu:function(){var t,n=this;t=n.ways[n.way].call(n),n.reverseWay&&t.reverse(),n.dirMirror&&(t=n.dirMirrorFu(t)),n["int"]&&clearInterval(n["int"]),n["int"]=setInterval(function(){t.length?n.anims[n.anim].apply(n,[t.shift(),!t.length]):clearInterval(n["int"])},n.interval),n.bl=!0},dirMirrorFu:function(t){var n=this;return n.direction<0,t},afterShow:function(){var n=this;n.pic.css({backgroundImage:"url("+n.next+")"}),n.maskC.hide(),n.slideshow&&!n.paused&&n.startSlShFu(0),n.banners!==!1&&(n.banner=n.banners[n.n]),n.banner&&(t.when(t("."+n.bannerCl,n.me)).then(function(){t("."+n.bannerCl,n.me).not(n.banner).remove()}),n.banner.appendTo(n.me),n.bannerShow(n.banner,n)),n.afterAnimation(),n.bl=!1},bannerShow:function(){},bannerHide:function(){},parseImgFu:function(){var n=this;n.itms=[],t(n.items+" img",n.me).each(function(e){n.itms[e]=t(this).attr("src")}),t(n.items,n.me).hide()},controlsFu:function(){var n=this;n.nextBu&&t(n.nextBu).bind(n.changeEv,function(){return n.nextFu(),!1}),n.prevBu&&t(n.prevBu).bind(n.changeEv,function(){return n.prevFu(),!1})},paginationFu:function(){var n=this;return n.pagination===!1?!1:(n.pagination===!0?n.pags=t("<ul></ul>"):"string"==typeof n.pagination?n.pags=t(n.pagination):"object"==typeof n.pagination&&(n.pags=n.pagination.find("ul")),0==n.pags.parent().length&&n.pags.appendTo(n.me),0==n.pags.children().length?t(n.itms).each(function(e){var a=t("<li></li>").data({num:e});n.pags.append(a.append('<a href="#"></a>'))}):n.pags.find("li").each(function(n){t(this).data({num:n})}),n.pagNums&&n.pags.find("a").each(function(n){t(this).text(n+1)}),n.pags.delegate("li>a",n.changeEv,function(){return n.changeFu(t(this).parent().data("num")),!1}),n.pags.addClass(n.paginationCl),n.pags=t("li",n.pags),void n.pags.eq(n.n).addClass(n.currCl))},startSlShFu:function(n){var e=this;e.paused=!1,e.prog=n||0,clearInterval(e.slShTimer),e.slShTimer=setInterval(function(){e.prog<100?e.prog++:(e.prog=0,clearInterval(e.slShTimer),e.nextFu()),e.progressBar&&e.pbchFu()},e.slideshow/100),e.playBu&&t(e.playBu).removeClass(e.pauseCl)},pauseSlShFu:function(){var n=this;n.paused=!0,clearInterval(n.slShTimer),n.playBu&&t(n.playBu).addClass(n.pauseCl)},slideshowFu:function(){var n=this;return n.slideshow===!1?!1:(n.playBu&&t(n.playBu).bind(n.changeEv,function(){return n.paused?n.startSlShFu(n.prog):n.pauseSlShFu(),!1}),void n.startSlShFu())},pbchFu:function(){var t=this;0==t.prog?t.progressBar.stop().width(0):t.progressBar.stop().animate({width:t.prog/100*t.progressBar.parent().width()},{easing:"linear",duration:t.slideshow/100})},progressBarFu:function(){var n=this;return n.progressBar===!1?!1:(n.progressBar=t(n.progressBar),void(0==n.progressBar.parent().length&&n.progressBar.appendTo(n.me)))},pauseOnHoverFu:function(){var t=this;t.pauseOnHover&&t.me.bind("mouseenter",function(){t.pauseSlShFu()}).bind("mouseleave",function(){t.startSlShFu(t.prog)})},bannersFu:function(){var n=this;return n.banners===!1?!1:(n.banners!==!0&&"string"==typeof n.banners&&(n.bannerShow=n.bannersPresets[n.banners].bannerShow,n.bannerHide=n.bannersPresets[n.banners].bannerHide),n.banners=[],t(n.items,n.me).each(function(e){var a;n.banners[e]=(a=t("."+n.bannerCl,this)).length?a.css({zIndex:999}):!1}),void n.bannerShow(t(n.banner=n.banners[n.show]).appendTo(n.me),n))},bannerDuration:1e3,bannerEasing:"swing",bannersPresets:{fromLeft:{bannerShow:function(t,n){"auto"==t.css("top")&&t.css("top",0),t.stop().css({left:-t.width()}).animate({left:0},{duration:n.bannerDuration,easing:n.bannerEasing})},bannerHide:function(t,n){t.stop().animate({left:-t.width()},{duration:n.bannerDuration,easing:n.bannerEasing})}},fromRight:{bannerShow:function(t,n){"auto"==t.css("top")&&t.css("top",0),"auto"!=t.css("left")&&t.css("left","auto"),t.stop().css({right:-t.width()}).animate({right:0},{duration:n.bannerDuration,easing:n.bannerEasing})},bannerHide:function(t,n){t.stop().animate({right:-t.width()},{duration:n.bannerDuration,easing:n.bannerEasing})}},fromBottom:{bannerShow:function(t,n){"auto"==t.css("left")&&t.css("left",0),"auto"!=t.css("top")&&t.css("top","auto"),t.stop().css({bottom:-t.height()}).animate({bottom:0},{duration:n.bannerDuration,easing:n.bannerEasing})},bannerHide:function(t,n){t.stop().animate({bottom:-t.height()})}},fromTop:{bannerShow:function(t,n){"auto"==t.css("left")&&t.css("left",0),t.stop().css({top:-t.height()}).animate({top:0},{duration:n.bannerDuration,easing:n.bannerEasing})},bannerHide:function(t,n){t.stop().animate({top:-t.height()},{duration:n.bannerDuration,easing:n.bannerEasing})}},fade:{bannerShow:function(t,n){"auto"==t.css("left")&&t.css("left",0),"auto"==t.css("top")&&t.css("top",0),t.hide().fadeIn(n.bannerDuration)},bannerHide:function(t,n){t.fadeOut(n.bannerDuration)}}},numStatusChFu:function(){var n=this;n.n||(n.n=n.show),n.numSt.html('<span class="curr"></span>/<span class="total"></span>'),t(".curr",n.numSt).text(n.n+1),t(".total",n.numSt).text(n.itms.length)},numStatusFu:function(){var n=this;return n.numStatus===!1?!1:(n.numSt||(n.numStatus===!0?n.numSt=t(n.etal).addClass(n.numStatusCl):n.numSt=t(n.numStatus).addClass(n.numStatusCl)),n.numSt.parent().length||n.numSt.appendTo(n.me).addClass(n.numStatusCl),void n.numStatusChFu())},init:function(){s.me.data({_TMS:s}),s.preFu(),s.controlsFu(),s.paginationFu(),s.slideshowFu(),s.progressBarFu(),s.pauseOnHoverFu(),s.bannersFu(),s.numStatusFu()},afterAnimation:function(){},beforeAnimation:function(){}};"object"==typeof e&&t.extend(s,e),s.me||s.init(s.me=a)})}}(jQuery);