<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="/pas_php/Public/Admin/css/style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="/pas_php/Public/Admin/js/jquery.js"></script>

<script type="text/javascript">
$(function(){	
	//导航切换
	$(".menuson .header").click(function(){
		var $parent = $(this).parent();
		$(".menuson>li.active").not($parent).removeClass("active open").find('.sub-menus').hide();
		
		$parent.addClass("active");
		if(!!$(this).next('.sub-menus').size()){
			if($parent.hasClass("open")){
				$parent.removeClass("open").find('.sub-menus').hide();
			}else{
				$parent.addClass("open").find('.sub-menus').show();	
			}
			
			
		}
	});
	
	// 三级菜单点击
	$('.sub-menus li').click(function(e) {
        $(".sub-menus li.active").removeClass("active")
		$(this).addClass("active");
    });

	$('.title').click(function(){
		var $ul = $(this).next('ul');
		$('dd').find('.menuson').slideUp();
		if($ul.is(':visible')){
			$(this).next('.menuson').slideUp();
		}else{
			$(this).next('.menuson').slideDown();
		}
	});
})
</script>


</head>

<body style="background:#f0f9fd;">
	<div class="lefttop"><span></span>管理导航</div>
    <?php if(is_array($authinfoA)): foreach($authinfoA as $key=>$v): ?><dl class="leftmenu">
	        
		    <dd>
			    <div class="title">
			    	<span><img src="/pas_php/Public/Admin/images/leftico01.png" /></span><?php echo ($v["auth_name"]); ?>
			    </div>
		    	<ul class="menuson">
					<?php if(is_array($authinfoB)): foreach($authinfoB as $key=>$vv): if($vv['auth_pid'] == $v['auth_id']): ?><li><cite></cite><div class="header"><a href="/pas_php/index.php/Admin/<?php echo ($vv["auth_c"]); ?>/<?php echo ($vv["auth_a"]); ?>" target="rightFrame"><?php echo ($vv["auth_name"]); ?></a><i></i></div></li><?php endif; endforeach; endif; ?>
		        </ul>    
		    </dd>
	    </dl><?php endforeach; endif; ?>
</body>
</html>