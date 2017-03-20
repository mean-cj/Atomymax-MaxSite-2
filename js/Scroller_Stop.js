
var _obj = function (s) {
	return document.getElementById(s);
}
function _addevent(o, e, f) {
	if (o.addEventListener) {
		o.addEventListener(e, f, false);
	}
	else if (o.attachEvent) {
		o.attachEvent('on' + e, f);
	}
}

function init() {
	var scr = _obj('scroller');
	_addevent(scr, 'mouseover', sstop);
	_addevent(scr, 'mouseout', sresume);
	running = window.setTimeout('gonext()', stimeout);
}

var sstep = 3;
var sspeed = 20;
var stimeout = 3000;
var prvi = null;
var drugi = null;
var running = false;
function doscroll() {
	var scr = _obj('scroller');
	var items = new Array();

	var chl = scr.childNodes;
	for (var i = 0; i < chl.length; i++) {
		if (chl[i].tagName && chl[i].tagName.toLowerCase() == 'div') {
			items[items.length] = chl[i];
			chl[i].className = 'scidis';
		}
	}

	prvi = items[0];
	drugi = items[1];
	smooth();
}
function smooth() {
	if (!prvi || !drugi) {
		endscroll();
		return;
	}
	var posprvi = parseInt(prvi.style.marginTop);
	if (isNaN(posprvi)) {
		posprvi = 0;
	}
	
	var posdrugi = drugi.offsetTop;
	if (posdrugi <= (sstep * 2)) {
		endscroll();
		return;
	}

	prvi.style.marginTop = (posprvi - sstep).toString() + 'px';
	window.setTimeout('smooth()', sspeed);
}
function endscroll() {
	try {
		_obj('nextitem').appendChild(prvi);
		prvi.style.marginTop = '0';

		drugi.className = 'sci';
		prvi = drugi = null;

		running = window.setTimeout('gonext()', stimeout);
	}
	catch (e) {}
}
function gonext() {
	var hol = _obj('nextitem');
	var item = null;

	var chl = hol.childNodes;
	for (var i = 0; i < chl.length; i++) {
		if (chl[i].tagName && chl[i].tagName.toLowerCase() == 'div') {
			item = chl[i];
			break;
		}
	}

	if (!item) {
		return;
	}

	_obj('scroller').appendChild(item);
	doscroll();
}
function sstop() {
	if (running) {
		window.clearTimeout(running);
		running = false;
	}
}
function sresume() {
	if (!running) {
		running = window.setTimeout('gonext()', Math.floor(stimeout / 2));
	}
}
function _go(s) {
	window.open(s, '');
}
