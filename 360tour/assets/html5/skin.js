// Garden Gnome Software - Skin
// Pano2VR 3.1.0/1777M
// Filename: ipad_tour.ggsk
// Generated Tue 20. Sep 20:34:10 2011

function pano2vrSkin(player,skinlayer,base) {
	var me=this;
	var flag=false;
	this.player=player;
	this.player.skinObj=this;
	this.divSkin=(skinlayer)?skinlayer:player.divSkin;
	var basePath="/wp-content/themes/conwayhall/360tour/main-hall/";
	// auto detect base path
//	if (base=='?') {
//		var scripts = document.getElementsByTagName('script');
//		for(var i=0;i<scripts.length;i++) {
//			var src=scripts[i].src;
//			if (src.indexOf('skin.js')>=0) {
//				var p=src.lastIndexOf('/');
//				if (p>=0) {
//					basePath=src.substr(0,p+1);
//				}
//			}
//		}
//	} else
//	if (base) {
//		basePath=base;
//	}
	this.elementMouseDown=new Array();
	this.elementMouseOver=new Array();
	var cssPrefix='';
	var domTransition='transition';
	var domTransform='transform';
	var prefixes='Webkit,Moz,O,ms,Ms'.split(',');
	var i;
	for(i=0;i<prefixes.length;i++) {
		if (typeof document.body.style[prefixes[i] + 'Transform'] !== 'undefined') {
			cssPrefix='-' + prefixes[i].toLowerCase() + '-';
			domTransition=prefixes[i] + 'Transition';
			domTransform=prefixes[i] + 'Transform';
		}
	}
	
	this.player.setMargins(0,0,0,0);
	
	this.updateSize=function(startElement) {
		var stack=new Array();
		stack.push(startElement);
		while(stack.length>0) {
			e=stack.pop();
			if (e.ggUpdatePosition) {
				e.ggUpdatePosition();
			}
			if (e.hasChildNodes()) {
				for(i=0;i<e.childNodes.length;i++) {
					stack.push(e.childNodes[i]);
				}
			}
		}
	}
	
	parameterToTransform=function(p) {
		return 'translate(' + p.rx + 'px,' + p.ry + 'px) rotate(' + p.a + 'deg) scale(' + p.sx + ',' + p.sy + ')';
	}
	
	this.findElements=function(id,regex) {
		var r=new Array();
		var stack=new Array();
		var pat=new RegExp(id,'');
		stack.push(me.divSkin);
		while(stack.length>0) {
			e=stack.pop();
			if (regex) {
				if (pat.test(e.ggId)) r.push(e);
			} else {
				if (e.ggId==id) r.push(e);
			}
			if (e.hasChildNodes()) {
				for(i=0;i<e.childNodes.length;i++) {
					stack.push(e.childNodes[i]);
				}
			}
		}
		return r;
	}
	
	this.preloadImages=function() {
		var preLoadImg=new Image();
		preLoadImg.src=basePath + 'assets/html5/buttons/button-4-o.png';
		preLoadImg.src=basePath + 'assets/html5/buttons/button-2-o.png';
		preLoadImg.src=basePath + 'assets/html5/buttons/button-1-o.png';
	}
	
	this.addSkin=function() {
		this._image_5=document.createElement('div');
		this._image_5.ggId='Image 5'
		this._image_5.ggParameter={ rx:0,ry:0,a:0,sx:1.2,sy:1.2 };
		this._image_5.ggVisible=true;
		this._image_5.ggUpdatePosition=function() {
			this.style[domTransition]='none';
			w=this.parentNode.offsetWidth;
			this.style.left=(-163 + w/2) + 'px';
			h=this.parentNode.offsetHeight;
			this.style.top=(-59 + h) + 'px';
		}
		hs ='position:absolute;';
		hs+='left: -163px;';
		hs+='top:  -59px;';
		hs+='width: 319px;';
		hs+='height: 58px;';
		hs+=cssPrefix + 'transform-origin: 50% 50%;';
		hs+=cssPrefix + 'transform: ' + parameterToTransform(this._image_5.ggParameter) + ';';
		hs+='visibility: inherit;';
		this._image_5.setAttribute('style',hs);
		this._image_5__img=document.createElement('img');
		this._image_5__img.setAttribute('src',basePath + 'assets/html5/buttons/image-5.png');
		this._image_5__img.setAttribute('style','position: absolute;top: 0px;left: 0px;');
		me.player.checkLoaded.push(this._image_5__img);
		this._image_5.appendChild(this._image_5__img);
		this.divSkin.appendChild(this._image_5);
		this._button_4=document.createElement('div');
		this._button_4.ggId='Button 4'
		this._button_4.ggParameter={ rx:0,ry:0,a:0,sx:1,sy:1 };
		this._button_4.ggVisible=true;
		this._button_4.ggUpdatePosition=function() {
			this.style[domTransition]='none';
			w=this.parentNode.offsetWidth;
			this.style.left=(55 + w/2) + 'px';
			h=this.parentNode.offsetHeight;
			this.style.top=(-47 + h) + 'px';
		}
		hs ='position:absolute;';
		hs+='left: 55px;';
		hs+='top:  -47px;';
		hs+='width: 44px;';
		hs+='height: 44px;';
		hs+=cssPrefix + 'transform-origin: 50% 50%;';
		hs+='visibility: inherit;';
		hs+='cursor: pointer;';
		this._button_4.setAttribute('style',hs);
		this._button_4__img=document.createElement('img');
		this._button_4__img.setAttribute('src',basePath + 'assets/html5/buttons/button-4.png');
		this._button_4__img.setAttribute('style','position: absolute;top: 0px;left: 0px;');
		me.player.checkLoaded.push(this._button_4__img);
		this._button_4.appendChild(this._button_4__img);
		this._button_4.onclick=function () {
			me.player.toggleAutorotate();
		}
		this._button_4.onmouseover=function () {
			me._button_4__img.src=basePath + 'assets/html5/buttons/button-4-o.png';
		}
		this._button_4.onmouseout=function () {
			me._button_4__img.src=basePath + 'assets/html5/buttons/button-4.png';
		}
		this.divSkin.appendChild(this._button_4);
		this._button_2=document.createElement('div');
		this._button_2.ggId='Button 2'
		this._button_2.ggParameter={ rx:0,ry:0,a:0,sx:1,sy:1 };
		this._button_2.ggVisible=true;
		this._button_2.ggUpdatePosition=function() {
			this.style[domTransition]='none';
			w=this.parentNode.offsetWidth;
			this.style.left=(-55 + w/2) + 'px';
			h=this.parentNode.offsetHeight;
			this.style.top=(-47 + h) + 'px';
		}
		hs ='position:absolute;';
		hs+='left: -55px;';
		hs+='top:  -47px;';
		hs+='width: 44px;';
		hs+='height: 44px;';
		hs+=cssPrefix + 'transform-origin: 50% 50%;';
		hs+='visibility: inherit;';
		hs+='cursor: pointer;';
		this._button_2.setAttribute('style',hs);
		this._button_2__img=document.createElement('img');
		this._button_2__img.setAttribute('src',basePath + 'assets/html5/buttons/button-2.png');
		this._button_2__img.setAttribute('style','position: absolute;top: 0px;left: 0px;');
		me.player.checkLoaded.push(this._button_2__img);
		this._button_2.appendChild(this._button_2__img);
		this._button_2.onclick=function () {
			me.player.changeFovLog(1,true);
		}
		this._button_2.onmouseover=function () {
			me._button_2__img.src=basePath + 'assets/html5/buttons/button-2-o.png';
		}
		this._button_2.onmouseout=function () {
			me._button_2__img.src=basePath + 'assets/html5/buttons/button-2.png';
		}
		this.divSkin.appendChild(this._button_2);
		this._button_1=document.createElement('div');
		this._button_1.ggId='Button 1'
		this._button_1.ggParameter={ rx:0,ry:0,a:0,sx:1,sy:1 };
		this._button_1.ggVisible=true;
		this._button_1.ggUpdatePosition=function() {
			this.style[domTransition]='none';
			w=this.parentNode.offsetWidth;
			this.style.left=(0 + w/2) + 'px';
			h=this.parentNode.offsetHeight;
			this.style.top=(-47 + h) + 'px';
		}
		hs ='position:absolute;';
		hs+='left: 0px;';
		hs+='top:  -47px;';
		hs+='width: 44px;';
		hs+='height: 44px;';
		hs+=cssPrefix + 'transform-origin: 50% 50%;';
		hs+='visibility: inherit;';
		hs+='cursor: pointer;';
		this._button_1.setAttribute('style',hs);
		this._button_1__img=document.createElement('img');
		this._button_1__img.setAttribute('src',basePath + 'assets/html5/buttons/button-1.png');
		this._button_1__img.setAttribute('style','position: absolute;top: 0px;left: 0px;');
		me.player.checkLoaded.push(this._button_1__img);
		this._button_1.appendChild(this._button_1__img);
		this._button_1.onclick=function () {
			me.player.changeFovLog(-1,true);
		}
		this._button_1.onmouseover=function () {
			me._button_1__img.src=basePath + 'assets/html5/buttons/button-1-o.png';
		}
		this._button_1.onmouseout=function () {
			me._button_1__img.src=basePath + 'assets/html5/buttons/button-1.png';
		}
		this.divSkin.appendChild(this._button_1);
		this._button_3=document.createElement('div');
		this._button_3.ggId='Button 3'
		this._button_3.ggParameter={ rx:0,ry:0,a:0,sx:1,sy:1 };
		this._button_3.ggVisible=true;
		this._button_3.ggUpdatePosition=function() {
			this.style[domTransition]='none';
			w=this.parentNode.offsetWidth;
			this.style.left=(-110 + w/2) + 'px';
			h=this.parentNode.offsetHeight;
			this.style.top=(-47 + h) + 'px';
		}
		hs ='position:absolute;';
		hs+='left: -110px;';
		hs+='top:  -47px;';
		hs+='width: 44px;';
		hs+='height: 44px;';
		hs+=cssPrefix + 'transform-origin: 50% 50%;';
		hs+='visibility: inherit;';
		hs+='cursor: pointer;';
		this._button_3.setAttribute('style',hs);
		this._button_3__img=document.createElement('img');
		this._button_3__img.setAttribute('src',basePath + 'assets/html5/buttons/button-5.png');
		this._button_3__img.setAttribute('style','position: absolute;top: 0px;left: 0px;');
		me.player.checkLoaded.push(this._button_3__img);
		this._button_3.appendChild(this._button_3__img);
		this._button_3.onclick=function () {
			//me.player.openUrl("index.html","_parent");
			window.self.close();
		}
		this.divSkin.appendChild(this._button_3);
		this.preloadImages();
		this.divSkin.ggUpdateSize=function(w,h) {
			me.updateSize(me.divSkin);
		}
		this.divSkin.ggLoaded=function() {
		}
		this.divSkin.ggReLoaded=function() {
		}
		this.divSkin.ggEnterFullscreen=function() {
		}
		this.divSkin.ggExitFullscreen=function() {
		}
		this.skinTimerEvent();
	};
	this.hotspotProxyClick=function(id) {
	}
	this.hotspotProxyOver=function(id) {
	}
	this.hotspotProxyOut=function(id) {
	}
	this.skinTimerEvent=function() {
		setTimeout(function() { me.skinTimerEvent(); }, 10);
	};
	this.addSkin();
};