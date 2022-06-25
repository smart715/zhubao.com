function checksearch(the)
{if($.trim(the.key.value)=='')
{alert('请输入关键字');the.key.focus();the.key.value='';return false}
if($.trim(the.key.value)=='请输入关键字')
{alert('请输入关键字');the.key.focus();the.key.value='';return false}}
var startHref;$(function(){$(".c-moreAjax a").click(function(){var href=$(this).attr("href");startHref=href;if(href!=undefined){$.ajax({type:"get",cache:false,url:startHref,success:function(data){var $result=$(data).find(".c-ajax");$(".c-commentAjax").append($result);var newHref=$(data).find(".c-moreAjax a").attr("href");if(newHref!=""){$(".c-moreAjax a").attr("href",newHref)}else{$(".c-moreAjax").html('已显示全部评论')}}})}
return false})});$(function(){if($(".form_comment").length>0){$(".form_comment").validator({stopOnError:true,theme:'yellow_top',ignore:':hidden',valid:function(form){$.fn.tips({type:'loading',content:'数据提交中'});$.ajax({url:webroot+"plug/comment.asp?act=add&id="+infoid,type:"post",data:$(form).serialize(),success:function(data){data=jQuery.parseJSON(data);var type="warn";if(data.status=="y"){type="ok"}
$.fn.tips({type:type,content:data.info});if(data.status=="y"){$(".form_comment")[0].reset();var act=data.info.substring(0,1);var info=data.info.substring(1);$.fn.tips({type:"ok",content:info});if(act==2){setTimeout(function(){location.href=''+contenturl+''},1500)}}}})}})}});$(function(){if($("#mood").length>0)
{$.ajax({type:"post",cache:false,url:webroot+"plug/mood.asp?act=load",data:"cid="+infoid,success:function(_)
{if(_!="error")
{var mood=_.split(":");for(i=0;i<8;i++)
{var mood_arr=mood[i].split('#');$("#mood_"+(i+1)).html(mood_arr[0]);}}}});}
$("#mood a").click(function(){var mtype=$(this).attr("config");var data="cid="+infoid;data+="&mtype="+encodeURIComponent(mtype);$.ajax({type:"post",cache:false,url:webroot+"plug/mood.asp?act=up",data:data,success:function(_)
{if(_=="error")
{$.fn.tips({content:"您已赞或踩过"});}
else
{var mood=_.split(":");for(i=0;i<8;i++)
{var mood_arr=mood[i].split('#');$("#mood_"+(i+1)).html(mood_arr[0]);}}}});})})