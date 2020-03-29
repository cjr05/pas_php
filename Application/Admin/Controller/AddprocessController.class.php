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
         //获取流程节点
        //$data = array();
        if (IS_POST) { 
            $uid = I('post.uid');
            if(empty($uid)){
                $attr = array($uid);  //定义一个数组放用户
                session("jiedian",$attr); //将第一个用户放入数组中
            }else{
                $attr = session("jiedian"); //数组中有值
                $attr[] = $uid;  //放入数组中值
                session("jiedian",$attr);   //将值再交给session
            }
        $this->ajaxReturn($attr);        
            // $shuju = I('post.'); 
            // dump($shuju);
        //     $data = I('post.');
        //     // $data[] = explode("|", $data);
        //     // dump($data);
        //     if(!empty($data['uname'])){
        //         //$uid = D('people')->field('id')->where(array('name'=>$data['uname']))->find();
        //         $arr = session('arr');
        //         $arr[] = $data; 
        //         //$arr[] = $uid;
        //         session('arr',$arr);
        //     }else{
        //          $data['uname'] = '';
        //          $data['msg'] = "添加失败，请重新添加！！";
        //          $arr = array($data);
        //          session('arr',$arr);
        //     }
        //     $this->ajaxReturn(session('arr'));
        //     //ump($data);
         }  
        // //清除session值  
        session('jiedian',null);
        
        $peopleList = D('people')->getPeople('id,name')->select();
        //dump($peopleList);
        $this->assign('peopleList',$peopleList);
        $this->display();
    }

    //移除流程
    // function remove(){
    //     $uid = I('post.');
    //     $arr = session('arr');
    //     unset($arr[$uid]);
    //     $arr = array_values($arr);
    //     session('arr',$arr);
    //     $this->ajaxReturn(session('arr'));
    // }

    function baocun(){
        if(IS_POST){
            //$uid = time();
            $shuju = I('post.');


            // $shuju =  session('arr');
            // $data = array();
            // foreach ($shuju as $key => $value) {
            //     $uname = $value['uname'];
            //     $uid = time();
            //     $data['uid'] = $uid;
            //     $data['uname'] = $uname;
            //     //session('data',$data);
            //     //$value = array_push($value,time());
                

                
            // }
            // $jiedian = D('jiedian')->add($data);
             
            // if($jiedian){
            //     $this->success('设置成功',U('Addprocess/project'));
            // }else{
            //     $this->error('设置失败',U('Addprocess/design'));
            // }

        }
        
        
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