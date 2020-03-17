<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2019/6/28
 * Time: 22:51
 */

namespace Admin\Controller;
use Admin\Common\CommonController;

class AddprocessController extends CommonController
{
    /**
     * 查看流程
     */
    function process(){
        $process = D('process');
        $count = $process->count();
        $Page = new \Think\Page($count,10);
        $show = $Page->show();
        $info = $process->limit($Page->firstRow.','.$Page->listRows)->select();
        //$this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('info',$info);
        $this->display();
    }

    /**
     * 增加流程
     */
    function add(){
        $process = D('process');
        if(IS_POST){
            $data = array(
                'process' => I('post.process'),
            );
            $shuju = $process->add($data);
            if($shuju){
                $this->success('添加成功',U('Addprocess/process'));
            }else{
                $this->error('添加失败',U('Addprocess/add'));
            }
        }
        $this->display();
    }

    #删除
    function del(){
        $id = I('get.id');
        $shuju = D('process')->where(array('id'=>$id))->delete();
        if($shuju){
            $this->success('删除成功',U('process'));
        }else{
            $this->error('删除失败',U('del'));
        }
    }

    /**
     * 查询
     */
    function search(){
        $process = D('process');
        if(IS_POST){
            $word = I('search');
            //dump($word);
            $data['process'] = array('like','%'.$word.'%');
            $info = $process->where($data)->select();
            if($info){
                $this->assign('info',$info);
                $this->display('process');
            }
        }
    }

}