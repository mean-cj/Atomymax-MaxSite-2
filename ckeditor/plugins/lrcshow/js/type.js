function play()
{
  var m = lrcdata.innerHTML.slice(4,-3);
  lrcobj = new lrcClass(m);
  lrcobj.cnane = "lrcobj";
  if (player=="wmp") {
  lrcobj.haohaiplay = mediaPlayerObj; // mediaPlayerObj 和 realPlayerObj 进行选择
  lrcobj.oceanx = 0; //0为使用 Media Player 控件，1为使用 Real Player 控件
  }
  if (player=="rmp") {
  lrcobj.haohaiplay = realPlayerObj; // mediaPlayerObj 和 realPlayerObj 进行选择
  lrcobj.oceanx = 1; //0为使用 Media Player 控件，1为使用 Real Player 控件
  }
  
  setInterval("lrcobj.run();",100);
}

window.onload = function()
{
play();
}

