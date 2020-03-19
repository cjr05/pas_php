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
        <li><a href="<?php echo U('index/main');?>">首页</a></li>
        <li><a href="<?php echo U('project');?>">项目列表</a></li>
       
    </ul>
</div>

<from class="rightinfo">

    <table class="tablelist">
        <thead>
        <form action="<?php echo U('Project/DelAll');?>" method="post">
        <tr>
            <th><input type="checkbox" onclick="SelectAll()" id="check">全选</th>
            <th>编号<i class="sort"><img src="/pas_php/Public/Admin/images/px.gif" /></i></th>
            <th>项目名称</th>
            <th>负责人</th>
            <th>所需公款</th>
            <th>申请理由</th>
            <th>审批状态</th>
            <th>资金状态</th>
            <th>项目状态</th>
            <th>创建时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <?php if(is_array($info)): foreach($info as $key=>$v): ?><tr style="text-align: center;">
            <td><input type="checkbox" name="choose[]" value="<?php echo ($v["id"]); ?>"></td>
            <td><?php echo ($v["id"]); ?></td>
            <td><?php echo ($v["name"]); ?></td>
            <td><?php echo ($v["people"]); ?></td>
            <td><?php echo ($v["money"]); ?></td>
            <td><?php echo ($v["reason"]); ?></td>
            <td>
                <?php if($v['status'] == '1'): ?>已审核 <?php else: ?> 未审核<?php endif; ?>

            </td>
            <td><?php if($v['mstatus'] == '1'): ?>已拨款 <?php else: ?> 未拨款<?php endif; ?></td>
            <td><?php if($v['done'] == '1'): ?>已完成 <?php else: ?> 未完成<?php endif; ?></td>
            <td><?php echo ($v["ctime"]); ?></td>
            <td><a href="<?php echo U('see',array('id'=>$v['id']));?>" class="tablelink">查看</a>     <a href="<?php echo U('del',array('id'=>$v['id']));?>" class="tablelink">删除</a></li>
        </tr><?php endforeach; endif; ?>

        </tbody>
        <div class="tools">
            <ul class="toolbar">
                <input type="submit" name="" value="批量删除" style="width: 50px; height: 30px; margin-left:20px;background-color: #1c77ac;">
            </ul>
        </div>
    </table>
</from>


<div class="pagenew">
    <tr class="content">
        <td colspan="3" bgcolor="#FFFFFF"><div class="pages">
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