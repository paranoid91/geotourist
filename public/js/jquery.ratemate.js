(function(){var t,s,a,e=Object.prototype.hasOwnProperty,r=function(t,s){function a(){this.constructor=t}for(var r in s)e.call(s,r)&&(t[r]=s[r]);return a.prototype=s.prototype,t.prototype=new a,t.__super__=s.prototype,t},i=function(t,s){return function(){return t.apply(s,arguments)}};t=jQuery,t.fn.extend({ratemate:function(e){return this.length?this.each(function(){var r,i;return i=t(this),r={max:i.attr("max"),min:i.attr("min"),value:i.attr("value")},e=t.extend({},r,e),i.is('input[type="text"],input[type="number"],input[type="range"]')?i.data("ratemate",new s(i,e)):i.is("meter")?i.data("ratemate",new a(i,e)):void 0}):void 0}}),a=function(){function s(s,a){this.el=t(s),this.opts=t.extend({},this.defaults,a),this.el.hasClass("has_ratemate")||(this.setRating(this.el.attr("value")),this.el.addClass("has_ratemate"),this.mate=t('<div class="ratemate"></div>'),this.el.after(this.mate),this.setupCanvas())}return s.prototype.defaults={max:5,width:160,height:32,drawSymbol:function(){return this.path("M15.999,22.77l-8.884,6.454l3.396-10.44l-8.882-6.454l10.979,0.002l2.918-8.977l0.476-1.458l3.39,10.433h10.982l-8.886,6.454l3.397,10.443L15.999,22.77L15.999,22.77z")},symbol_width:32,stroke:"#ecc000",fill:"125-#ecc000-#fffbcf"},s.prototype.makeStarMethod=function(){return null==Raphael.fn.ratemate?Raphael.fn.ratemate={symbol:this.opts.drawSymbol}:void 0},s.prototype.setRating=function(t){return this.rating=parseInt(t,10),this.el.val(this.rating)},s.prototype.setupCanvas=function(){return this.makeStarMethod(),this.canvas=Raphael(this.mate.get()[0],this.opts.width,this.opts.height),this.attackCanvas()},s.prototype.attackCanvas=function(){var t,s,a,e,r,i;for(r=this.opts.width/this.opts.max,a=r/this.opts.symbol_width,this.stars=[],this.rects=[],t=0,i=this.opts.max;i>=0?i>t:t>i;i>=0?t+=1:t-=1)e=this.canvas.ratemate.symbol(),e.attr({stroke:this.opts.stroke}),e.scale(a,a,0,0),e.translate(t*r,0),s=this.canvas.rect(t*r,0,r,r),s.attr({fill:"#fff",opacity:0}),this.rects.push(s),this.stars.push(e);return this.showRating()},s.prototype.clear=function(){var t,s,a,e,r;for(e=this.stars,r=[],s=0,a=e.length;a>s;s++)t=e[s],r.push(t.attr({fill:"none"}));return r},s.prototype.showRating=function(t){var s,a;for(t=t||this.rating,this.clear(),a=[],s=0;t>=0?t>s:s>t;t>=0?s+=1:s-=1)a.push(this.stars[s].attr({fill:this.opts.fill}));return a},s.prototype.flashStar=function(t){var s;return s=this.stars[t],null!=s?s.animate({opacity:0},100,function(){return s.animate({opacity:1},100)}):void 0},s}(),s=function(){function t(s,a){t.__super__.constructor.call(this,s,a),this.makeControllable()}return r(t,a),t.prototype.makeControllable=function(){var t,s,a,e,r;for(this.mate.addClass("control"),r=[],t=0,e=this.rects.length;e>=0?e>t:t>e;e>=0?t+=1:t-=1)s=this.rects[t],a=t+1,r.push(i(function(t,s){return s.click(i(function(s){return this.setRating(t),this.flashStar(t-1),this.showRating()},this)),s.mouseover(i(function(s){return this.showRating(t)},this)),s.mouseout(i(function(t){return this.rating?this.showRating():this.clear()},this))},this)(a,s));return r},t}()}).call(this);