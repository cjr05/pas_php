<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="/pas_php/Public/Admin/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/pas_php/Public/Admin/js/jquery.js"></script>

</head>


<body>

	<div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="<?php echo U('main');?>">首页</a></li>
        </ul>
    </div>
    
    <div class="mainindex">
        
        <div class="welinfo">
            <span><img src="/pas_php/Public/Admin/images/sun.png" alt="天气" /></span>
            <b><?php echo (session('admin_name')); ?>早上好，欢迎使用信息管理系统</b>
        </div>
        <div class="xline"></div>
        <div class="box"></div>
        <div class="welinfo">
            <span><img src="/pas_php/Public/Admin/images/dp.png" alt="提醒" /></span>
            <b>Uimaker项目管理系统使用指南</b>
        </div>



        <table class="tablelist">
            <tr>
            <!-- <th><input type="checkbox" onclick="SelectAll()" id="check"></th> -->
            <th>编号<i class="sort"><img src="/pas_php/Public/Admin/images/px.gif" /></i></th>
            <th>项目名称</th>
            <th>审批状态</th>
            <th>操作</th>
            </tr>
            <tbody>
            <?php if(is_array($info)): foreach($info as $key=>$v): ?><tr style="text-align: center;">
            <!-- <td><input type="checkbox"  name="choose[]" value="<?php echo ($v["id"]); ?>"></td> -->
            <td><?php echo ($v["id"]); ?></td>
            <td><?php echo ($v["name"]); ?></td>
            <td><?php if($v['status'] == '0'): ?>未审核<?php endif; ?></td>
            <td>
                <a href="<?php echo U('Index/see',array('id'=>$v['id']));?>" class="tablelink">进行审批</a>
                <a href="<?php echo U('del',array('id'=>$v['id']));?>" class="tablelink">删除</a>
            </td>
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

    

    
    

</body>

</html>