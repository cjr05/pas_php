<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2019/6/28
 * Time: 22:51
 * 流程控制器
 */

namespace Admin\Controller;
use Admin\Common\CommonController;

class AddprocessController extends CommonController
{
    /**
     * 查看流程类型
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

    //项目流程
    function project(){
        $info = D('project')
                ->getAllProject('id,name,process_type,ctime,is_status')
                ->select();
        //dump($info);
        $this->assign('info',$info);
        $this->display();
    }

    //禁用或开启流程
    function change($id,$is_status){
        
        
        if(IS_GET){
            // dump($id);
            // dump($is_status);
            //exit;
            $data['id'] = I('id');
            $data['is_status'] = I('is_status');  
            $shuju = D('project')->data($data)->save();

            if($shuju){
                $this->success('操作成功',U('Addprocess/project'));
            }else{
                $this->error('操作失败',U('Addprocess/project'));
            }
        }
        
    }

    //设计流程
    function design(){
        //exit;
         //获取流程节点
        if (IS_POST) {
            $data = I('post.');
            if(!$data){
                $arr[] = $data;
                session($data);
            }else{
                $arr = array($data);
                session($data);
            }
            $arr = session($data);
            //session('jiedian',$data);//将数据存在session里
            //$jiedian = session('jiedian');
            // if(empty($jiedian)){
            //     $arr = array($data);
            //     $jiedian = $arr;
            // }else{
            //     $arr = $jiedian;
            //     $arr[] = $data;
            //     $jiedian = $arr;
            // }

            // if(!empty($data)){
            //     session($data);
            // }else{
            //     $data = array();
            // }
            
            $this->ajaxReturn($arr);
            //ump($data);
        }    
        // if(IS_AJAX){
        //     print_r(I('post.name'));
        //     exit;
        //     $addname = I('post.addname');
            
        //     $a = session('addname');
        //     if(empty($a)){
        //         $arr = array($addname);
        //         $a = $arr;
        //     }else{
        //         $arr = session('addname');
        //         $arr[] = $addname;
        //         $a = $arr;
        //     }
        //     $this->ajaxReturn($arr);
        //     //print_r($arr);
        // }



        $peopleList = D('people')->getPeople('id,name')->select();
        //dump($peopleList);
        $this->assign('peopleList',$peopleList);
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