<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
    <style>
        .form{  width:400px; height:35px; margin-left: 50px;}
        .search{width:200px; height: 30px; border: 1px solid #369; margin-left: 30px;}
        
    </style>
<link href="/pas_php/Public/Admin/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/pas_php/Public/Admin/js/jquery.js"></script>




</head>


<body>

	<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li><a href="<?php echo U('index/main');?>">首页</a></li>
    <li><a href="<?php echo U(people);?>">员工列表</a></li>
    </ul>
    </div>
    
    <div class="rightinfo">
    
    <div class="tools">
    
    	<ul class="toolbar">
        <a href="<?php echo U('people/add');?>"><li class="click"><span><img src="/pas_php/Public/Admin/images/t01.png" /></span>添加</li></a>
            <form class="form" action="<?php echo U('people/search');?>" method="POST">
                <input name="search" type="text" class="search" placeholder="请使用姓名查询" />
                <input name="" type="submit" class="sure" value="查询"/>
            </form>
        </ul>
        

    
    </div>
    
    
    <table class="tablelist">
    	<tr>
        <th><input type="checkbox" onclick="SelectAll()" id="check"></th>
        <th>编号<i class="sort"><img src="/pas_php/Public/Admin/images/px.gif" /></i></th>
        <th>名字</th>
        <th>密码</th>
        <th>权限ID</th>
        <th>拥有权限</th>
        <th>操作</th>
        </tr>
        <tbody>
        <?php if(is_array($info)): foreach($info as $key=>$v): ?><tr style="text-align: center;">
        <td><input type="checkbox"  name="choose[]" value="<?php echo ($v["id"]); ?>"></td>
        <td><?php echo ($v["id"]); ?></td>
        <td><?php echo ($v["name"]); ?></td>
        <td><?php echo ($v["password"]); ?></td>
        <td><?php echo ($v["auth_id"]); ?></td>
        <td><?php echo ($v["auth_ca"]); ?></td>
        <td><a href="<?php echo U('del',array('id'=>$v['id']));?>" class="tablelink"> 删除</a></td>
        </tr><?php endforeach; endif; ?>
        </tbody>
    </table>


        <div class="pagenew">

            <tr class="content">
                <td colspan="3" bgcolor="#FFFFFF">
                    <div class="pages">
                    <?php echo ($page); ?>
                </div></td>
            </tr>

        </div>
    
    
    
    
    
    
    
    </div>
    
    <script type="text/javascript">
	$('.tablelist tbody tr:odd').addClass('odd');
	</script>

    <script>
        function SelectAll() {
            var id_check = document.getElementById('check');
            var checkboxs=document.getElementsByName("choose[]");
            //console.log(id_check.checked);
            if (id_check.checked == false) {
                //console.log(id_check.checked);
                for (var i=0;i<checkboxs.length;i++) {
                    var e=checkboxs[i];
                    e.checked=false;
                }
            }else{
                //console.log(id_check.checked);
                for (var i=0;i<checkboxs.length;i++) {
                    var e=checkboxs[i];
                    e.checked=true;
                }
            }
        }

    </script>

</body>

</html>