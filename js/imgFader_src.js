/*  imgFader, version 1.0
 *  (c) 2008 Malte Sieb (http://www.maltesieb.de)
 *
 *  imgFader is freely distributable under the terms of the GPL license.
 *  For details, see my web site: http://www.maltesieb.org/skripte
 *
 *--------------------------------------------------------------------------
 *
 *	c	Container element id
 *  ce	Current visible element
 *  pe	Previous visible element
 *  fps	Frames per second
 *  eo	Current elements opacity
 *  po	Previous elements opacity
 *
 *  _g	Get										Alias for document.getElementById
 *  _a	Append									Append new image element to container
 *  _u	Update									Rebuild container after resorting images
 *  _so	Set opacity (element,aim of opacity)	Set opacity in 2 different methods
 *  _f	Fade function 							is called each frame
 *  _s	Show									Start fading to next image
 */

var Fade=function(c,d) {
	/* Default values */
	this.fDur=1;
	this.delay=5;
	this.imgs=new Array();
	this.mode='random';
	this.clear=true;
	for (var i in d) this[i]=d[i];
	
	/* Prevent longer fade duration than delay */
	if (this.fDur>this.delay) this.fDur=this.delay;

	/* Script variables */
	this.ce=0;
	this.eo=1;
	this.po=0;
	this.fps=25;
	this.c=c;
	
	/* Prepare container element and put all images into it */
	if (this.clear) this._g(this.c).innerHTML='';
	this._g(c).style.position='relative';
	for (i=0;i<this.imgs.length;i++) {
		this._a(i,this.imgs[i]);
	}
	
	/* Start the desaster */
	this.start();
};

Fade.prototype.start=function() {
	var p=this;
	this.stop();
	this.s=window.setInterval(function() {p._s()},this.delay*1000);
};

Fade.prototype.stop=function() {
	window.clearInterval(this.s);
};

Fade.prototype._a=function(i,img) {
	this._g(this.c).innerHTML+='<img src="'+img+'" id="img'+i+'" alt="" />'+"\n";
	this._g('img'+i).style.position='absolute';
	this._so(i,(i==this.ce?this.eo:(i==this.pe?this.po:0)));
};

/**
 * Rebuild container e.g. after resorting images
 */
Fade.prototype._u=function(n) {
	this.imgs=n;
	this._g(this.c).innerHTML='';
	for (i=0;i<n.length;i++) {
		this._a(i,this.imgs[i]);
	}
};

/**
 * Alias for document.getElementById
 */
Fade.prototype._g=function(i){return document.getElementById(i);};

/**
 * Check if URL already exists
 */
Fade.prototype._d=function(n){for(i=0;i<this.imgs.length;i++){if(n==this.imgs[i])return i;}return false;}

Fade.prototype._so=function(i,o){
	var e=this._g('img'+i);
	o=o>1?1:(o<0?0:o);	 
	e.style.opacity=o;
	e.style.filter="alpha(opacity="+(o*100)+")";
};

Fade.prototype._f=function(){
	if (this.eo>=1) {window.clearInterval(this.f);}
	var d=1/(this.fps*this.fDur);
	this._so(this.pe,(this.po-=d));
	this._so(this.ce,(this.eo+=d));
};

Fade.prototype._s = function(ce) {
	if (this.s) {window.clearInterval(this.s);window.clearInterval(this.f);}
	for (i=0;i<this.imgs.length;i++) {
		if (i!=this.ce && i!=this.pe) this._so(i,0);
	}
	var p=this,r;
	if (this.imgs.length>0) {
		this.pe=this.ce;
		if (ce || ce==0) {
			this.ce=ce;
			this.fe=null;
		} else if (this.mode=='random') {
			do r=Math.round((Math.random()*this.imgs.length)-0.499);
			while(r==this.ce);
			this.ce=r;
		} else {
			if (++this.ce>(this.imgs.length-1)) {
				this.ce=0;
			}
		}
		this.eo=0;
		this.po=1;
		this.f=window.setInterval(function() { p._f(); },Math.round(this.fDur*1000/this.fps));
	}
	this.start();
};

Fade.prototype.add = function(img,d) {
	var p,n=new Array();
	p=this._d(img);
	if (!p || d.force) {
		if (d.pos && d.pos=='first') d.pos=1;
		if (d.pos && d.pos<=this.imgs.length) {
			d.pos--;
			for (i=0;i<this.imgs.length;i++) {
				if (i<d.pos) n[i]=this.imgs[i];
				else if (i==d.pos) {n[i]=img;n[(i+1)]=this.imgs[i];}
				else n[(i+1)]=this.imgs[i];
			}
			if (this.ce>=d.pos){this.ce++;}
			if (this.pe>=d.pos){this.pe++;}
			this._u(n);
			p=d.pos;
		} else {
			this.imgs[this.imgs.length]=img;
			p=this.imgs.length-1;
			this._a(p,img);
		}
	}
	if (d.mode && d.mode=='immediate') {this._s(p);}
};

Fade.prototype.go=function(p) {
	if (typeof p=='string' && p.indexOf('+')>-1) {
		p=parseInt(p.substr(1))+this.ce+1;
		if (p>this.imgs.length) p=p-this.imgs.length;
	} else if (typeof p=='string' && p.indexOf('-')>-1) {
		p=this.ce-parseInt(p.substr(1))+1;
		if (p<=0) p=p+this.imgs.length;
	}
	this._s(parseInt(p)-1);
};

Fade.prototype.preload = function(img) {
	var i=new Image;
	i.src=img;
};