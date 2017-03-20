function lrcClass(tt)		//LRC歌词处理 类
{
  this.inr = [];		//行
  this.oTime = 0;		//余补时间
  this.hailang;
  this.dts = -1;		//当前行显示的s
  this.dte = -1;		//当前行显示的e
  this.dlt = -1;		//当前行
  this.ddh;		//当前行数据
  this.fjh;
  this.haohaiplay;
  this.oceanx;
  this.cnane;
//以上几个属性是为了判断是否还在上次显示的时间范围，以减少循环次数

  if(/\[offset\:(\-?\d+)\]/i.test(tt))		//取offset余补时间
    this.oTime = RegExp.$1/1000;
  tt = tt.replace(/\[\:\][^$\n]*(\n|$)/g,"$1");		//去掉注解
  tt = tt.replace(/\[[^\[\]\:]*\]/g,"");
  tt = tt.replace(/\[[^\[\]]*[^\[\]\d]+[^\[\]]*\:[^\[\]]*\]/g,"");
  tt = tt.replace(/\[[^\[\]]*\:[^\[\]]*[^\[\]\d\.]+[^\[\]]*\]/g,"");
  tt = tt.replace(/<[^<>]*[^<>\d]+[^<>]*\:[^<>]*>/g,"");
  tt = tt.replace(/<[^<>]*\:[^<>]*[^<>\d\.]+[^<>]*>/g,"");		//去掉除时间标签的其它标签

  while(/\[[^\[\]]+\:[^\[\]]+\]/.test(tt))
  {
    tt = tt.replace(/((\[[^\[\]]+\:[^\[\]]+\])+[^\[\r\n]*)[^\[]*/,"\n");
    var zzzt = RegExp.$1;
    /^(.+\])([^\]]*)$/.exec(zzzt);
    var ltxt = RegExp.$2;
    var eft = RegExp.$1.slice(1,-1).split("][");
    for(var ii=0; ii<eft.length; ii++)
    {
      var sf = eft[ii].split(":");
      var tse = parseInt(sf[0],10) * 60 + parseFloat(sf[1]);
      var sso = { t:[] , w:[] , n:ltxt }
      sso.t[0] = tse-this.oTime;
      this.inr[this.inr.length] = sso;
    }
  }
  this.inr = this.inr.sort( function(a,b){return a.t[0]-b.t[0];} );

  for(var ii=0; ii<this.inr.length; ii++)
  {
    while(/<[^<>]+\:[^<>]+>/.test(this.inr[ii].n))
    {
      this.inr[ii].n = this.inr[ii].n.replace(/<(\d+)\:([\d\.]+)>/,"%=%");
      var tse = parseInt(RegExp.$1,10) * 60 + parseFloat(RegExp.$2);
      this.inr[ii].t[this.inr[ii].t.length] = tse-this.oTime;
    }
    lrcbc.innerHTML = "<font>"+ this.inr[ii].n.replace(/&/g,"&amp;").replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/%=%/g,"</font><font>") +" </font>";
    var fall = lrcbc.getElementsByTagName("font");
    for(var wi=0; wi<fall.length; wi++)
      this.inr[ii].w[this.inr[ii].w.length] = fall[wi].offsetWidth;
    this.inr[ii].n = lrcbc.innerText;
  }


  this.print("");
  lrcwt1.innerText = "";
  lrcwt2.innerText = "";
  lrcwt3.innerText = "";
  lrcwt4.innerText = "";
  lrcwt5.innerText = "";
  lrcbc.style.width = 0;
}


lrcClass.prototype.run = function()
{
  try {
    if(this.oceanx==0)
      this.runing(this.haohaiplay.controls.currentPosition, this.haohaiplay.currentMedia.duration);
    else
      this.runing(this.haohaiplay.GetPosition()/1000, this.haohaiplay.GetLength()/1000);
  } catch(hh){}
}

lrcClass.prototype.runing = function(tme, plen)
{
  if(tme<this.dts || tme>=this.dte)
  {
    var ii;
    for(ii=this.inr.length-1; ii>=0 && this.inr[ii].t[0]>tme; ii--){}
    if(ii<0) return;
    this.ddh = this.inr[ii].t;
    this.fjh = this.inr[ii].w;
    this.dts = this.inr[ii].t[0];
    this.dte = (ii<this.inr.length-1)?this.inr[ii+1].t[0]:plen;

    lrcwt1.innerText = this.retxt(ii-3);
    lrcwt2.innerText = this.retxt(ii-2);
    lrcwt3.innerText = this.retxt(ii-1);
    lrcwt4.innerText = this.retxt(ii+1);
    lrcwt5.innerText = this.retxt(ii+2);
    this.print(this.retxt(ii));
    if(this.dlt==ii-1)
    {
      clearTimeout(this.hailang);
      this.golrcoll(0);
    }
    this.dlt = ii;
  }
  var bbw = 0;
  var ki;
  for(ki=0; ki<this.ddh.length && this.ddh[ki]<=tme; ki++)
    bbw += this.fjh[ki];
  var kt = ki-1;
  var sc = ((ki<this.ddh.length)?this.ddh[ki]:this.dte) - this.ddh[kt];
  var tc = tme - this.ddh[kt];
  bbw -= this.fjh[kt] - tc / sc * this.fjh[kt];
  if(bbw>lrcbox.offsetWidth)
    bbw = lrcbox.offsetWidth;
  lrcbc.style.width = Math.round(bbw);
}

lrcClass.prototype.retxt = function(i)
{
  return (i<0 || i>=this.inr.length)?"":this.inr[i].n;
}

lrcClass.prototype.print = function(txt)
{
  lrcbox.innerText = txt;
  lrcbc.innerText = txt;
}

lrcClass.prototype.golrcoll = function(s)
{
  lrcoll.style.top = 25-(s++)*5;
  lrcwt1.filters.alpha.opacity = 90-s*18;
  lrcwt5.filters.alpha.opacity = s*18+10;
  if(s<=5)
    this.hailang = setTimeout(this.cnane+".golrcoll("+s+")",120);
}

////////////////////////////////////////////////////////////////////

var lrcobj;

