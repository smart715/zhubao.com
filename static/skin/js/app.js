$(function(){banner();tools();share();tablist();if($(".imglist").length){$(".imglist").each(function(){var _this=$(this);imglist(_this);});}
$(".botnav span:nth-child(4)").css({"display":"none"});});function banner(){if(!$("#banner").length||$("#banner li").length<=1){return false;}
$("#banner ul li:gt(0)").css({"display":"none"});var b=$("#banner"),me=$("#banner ul"),tip=$("#banner .tip"),t,interval=10000,speed=1000,speed2=700,n=0,N=me.children("li").length;wid=b.children("li").width();step=200,time=3000;if($("#banner .tip").length){var htmlTip="";for(var i=0;i<N;i++){if(i==0){htmlTip+="<span class='cur icon'>"+(i+1)+"</span>";}else{htmlTip+="<span class='icon'>"+(i+1)+"</span>";}}
tip.html(htmlTip);}
var func=function(){if(n>=N-1){n=0;}else if(n<-1){n=N-1;}
else{n++;}
me.children("li").eq(n).css({"z-index":2}).stop().fadeIn(speed).siblings("li").css({"z-index":1}).stop().fadeOut(speed2);if($("#banner .tip").length){tip.children("span").eq(n).addClass("cur").siblings("span").removeClass("cur");}}
$("#banner").hover(function(){$("#btn_prev,#btn_next").fadeIn()},function(){$("#btn_prev,#btn_next").fadeOut()})
$dragBln=false;$("#btn_prev").click(function(){clearInterval(t);n-=2;func();t=setInterval(func,time)});$("#btn_next").click(function(){clearInterval(t);func();t=setInterval(func,time)});tip.children("span").click(function(){clearInterval(t);n=$(this).index()-1;func();t=setInterval(func,interval);})
$("#banner ul.list li").mouseenter(function(){clearInterval(t);}).mouseleave(function(){t=setInterval(func,time);});t=setInterval(func,interval);}
function tablist(){$(".mendian span").click(function(e){if($(".mendian .list").is(":hidden")){$(".mendian .list").show();}else{$(".mendian .list").hide();}
e.stopPropagation();});$("body").click(function(){$(".mendian .list").hide();});$(".mendian .list li").click(function(){var html=$(this).html();$(".mendian").find("span").html(html);$(".mendian .list").hide();});$(".mendian").slide({trigger:"click"});}
function tools(){$(".setHome").click(function(){var hm=window.location.host;SetHome(this,location.href);});$(".addFavo").click(function(){var fm=$("title").html();AddFavorite(fm,location.href,'');});$(".return-webtop").click(function(){$("body, html").stop().animate({"scrollTop":0});});$(".steps").slide({titOnClassName:"current"});$(".slideTxtBox").slide({effect:"left"});$("#picBox").slide({mainCell:".bd ul",autoPage:true,effect:"left",autoPlay:true,vis:4});$("#liuc").slide({mainCell:".bd ul",autoPage:true,interTime:3000,effect:"left",autoPlay:true,vis:6});$("#ichoose").slide({mainCell:".bd ul",autoPage:true,interTime:3000,effect:"left",autoPlay:true,vis:3});$("#newsBox").slide({mainCell:".bd ul",autoPlay:true,delayTime:500,interTime:5000});$('.slideTxtBox .bd li').mouseover(function(){$(this).find("em").stop().animate({"width":"100%"});})
$('.slideTxtBox .bd li').mouseout(function(){$(this).find("em").stop().animate({"width":"12px"});})
$(".float-right-box").hover(function(){$(".float-right-box").removeClass('on');},function(){$(".float-right-box").addClass('on');});$('.float-right-box li .weix').mouseover(function(){$(this).find(".sidebox").stop().animate({"right":"250px","opacity":"1"}).show();})
$('.float-right-box li .weix').mouseout(function(){$(this).find(".sidebox").stop().animate({"right":"250px","opacity":"0"}).hide();})}
function SetHome(obj,url){try{obj.style.behavior='url(#default#homepage)';obj.setHomePage(url);}catch(e){if(window.netscape){try{netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");}catch(e){alert("抱歉，此操作被浏览器拒绝！\n\n请在浏览器地址栏输入并回车然后将[signed.applets.codebase_principal_support]设置为'true'");}}else{alert("抱歉，您所使用的浏览器无法完成此操作。\n\n您需要手动将【"+url+"】设置为首页。");}}}
function AddFavorite(title,url){try{window.external.addFavorite(url,title);}
catch(e){try{window.sidebar.addPanel(title,url,"");}
catch(e){alert("抱歉，您所使用的浏览器无法完成此操作。\n\n加入收藏失败，请使用Ctrl+D进行添加");}}}
function imglist(_this){if(_this.find(".item").length<=1){return false;}
var t,a=_this;var clone=a.find(".list").html();a.find(".list").append(clone);var n=0,N=a.find(".list").children(".item").length,wid=a.find(".list").children(".item").width(),time=5000,step=600;a.find(".list").width(N*wid);var func=function(){if(n>=N/2){n=0;a.find(".list").css({"margin-left":0});func();}else{n++;a.find(".list").stop().animate({"margin-left":-wid*n},step);}}
var func2=function(){if(n<=0){n=N/2;a.find(".list").css({"margin-left":-wid*n});func2();}else{n--;a.find(".list").stop().animate({"margin-left":-wid*n},step);}}
_this.find(".next").click(function(){func();});_this.find(".prev").click(function(){func2();});if(_this.parents(".floor_5").length){}else{t=setInterval(func,time);a.hover(function(){clearInterval(t);},function(){t=setInterval(func,time);});}}
function share(){window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"share":{},"slide":{"type":"slide","bdImg":"5","bdPos":"left","bdTop":"100"}};window._bd_share_config={share:[{"bdSize":16}],}
with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];}