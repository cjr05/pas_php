<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2019/6/25
 * Time: 14:39
 */

namespace Admin\Controller;
use Think\Controller;
use Admin\Common\CommonController;

class FinanceController extends CommonController
{
    public function finance(){
        $project = D('Project');
        $count = $project->count();
        $Page = new \Think\Page($count,10);
        $show = $Page->show();
        // $info = $project->limit($Page->firstRow.','.$Page->listRows)->select();
        $info = $project->where('status = 1')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('page',$show);// 赋值分页输出
        if ($info){
            $this->assign('info',$info);
        }else{
            $this->assign('notice','暂无项目需要拨款');
        }

        $this->display();
    }

    public function see(){
        $id = I('get.id');
        $project = D('Project');
        $shuju = D('Project')->where(array('id'=>$id))->select();
        //$other = D('Principal')->where(array('id'=>$id))->select();
        $info = D('Project')->where(array('id'=>$id))->find();
        $other = D('principal')->where(array('people'=>$info['people']))->find();

        if($info['status']=='0'){
            echo '<script> alert("项目未审核，无法访问！！");
                            location.href="'.U('finance').'";      
                </script>';
        }else{
            $this->assign('info',$info);
            $this->assign('other',$other);
        }
        

        if(IS_POST){
            $data = array(
                'mstatus' =>'1',
            );
        }
        $shuju = $project->where('id='.$id)->setField($data);
        if($shuju){
            $this->success('拨款成功',U('Finance/finance'));
        }
        $this->display();
    }

}