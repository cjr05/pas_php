<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2019/6/20
 * Time: 14:38
 */

namespace Admin\Controller;
use Think\Controller;
use Admin\Common\CommonController;
class ProjectController extends CommonController{

    



    #展示
    public function Project(){
        $admin_name = session('admin_name');
        //dump($admin_name);
        $project = D('Project');


        // $a =  $project->getCoreStatus(array('status'=>'1'))->select();
        // dump($a);
        // if($admin_name =='admin'){
        //     $count = $project->count();
        // }else{
        //     $count = $project->where(array('people'=>$admin_name))->count();
        // }
        //dump($count);
        $count = ($admin_name =='admin') ? $project->count() : $project->where(array('people'=>$admin_name))->count(); 
        
        $Page = new \Think\Page($count,10);
        $show = $Page->show();
        // if($admin_name =='admin'){
        //     $info = $project->limit($Page->firstRow.','.$Page->listRows)->select();
        // }else{
        //     $info = $project->where(array('people'=>$admin_name))->limit($Page->firstRow.','.$Page->listRows)->select();
        // }
        $info = ($admin_name =='admin') ? $project->limit($Page->firstRow.','.$Page->listRows)->select() : $project->where(array('people'=>$admin_name))->limit($Page->firstRow.','.$Page->listRows)->select();
        //dump($info);
        //$this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('info',$info);
        $this->display();
    }


    #添加
    function add(){
        $project = D('Project');
        $principal = D('principal');
        $process = D('process');
        if(IS_POST){
            $data = array(
                'name' => I('post.name'),
                'people' => I('post.people'),
                'money' => I('post.money'),
                'reason' => I('post.reason'),
                'ctime' => date("Y-m-d h:i:s"),
            );

            //获取流程节点
            $addname = I('post.addname');
            if(empty(session('addname'))){
                $arr = array($addname);
                session('addname') = $arr;
            }else{
                $arr = session('addname');
                $arr[] = $addname;
                session('addname') = $arr;
            }

            $other = array(
                'people'=> I('post.people'),
                'other'=> I('post.other'),
            );
            $shuju = $project->add($data);
            $shuju1 = $principal->add($other);
            if($shuju&&$shuju1){
                $this->success('发布成功',U('Project/project'));
            }else{
                $this->error('发布失败',U('Manager/add'));
            }
        }
        $info = $process->select();
        $getPeople = D('People')->getPeople()->select();
        //dump($getPeople);
        $this->assign('process',$info);
        $this->assign('getPeople',$getPeople);
        $this->display();
    }


    #查看
    function see(){


        $id = I('get.id');
        if(IS_POST){
            dump($_POST);
            exit;
        }


        $shuju = D('Project')->where(array('id'=>$id))->select();
        //$other = D('Principal')->where(array('id'=>$id))->select();
        $info = D('Project')->where(array('id'=>$id))->find();
        $other = D('principal')->where(array('people'=>$info['people']))->find();
        //$plan = D('plan')->select();
        dump($plan);
        if($info['status']=='0'){
            echo '<script> alert("项目未审核，无法访问！！");
                            location.href="'.U('project').'";      
                </script>';
        }else{
            $this->assign('info',$info);
            $this->assign('other',$other);
            //$this->assign('plan',$plan);
            if($info){
            //项目发布即存在
            $this->assign('num',1);
            }
            if ($info && $info['status']=='1') {
                $this->assign('num',2);    
            }
            if ($info && $info['status']=='1' && $info['mstatus']=='1') {
                $this->assign('num',3);    
            }
            if ($info && $info['status']=='1' && $info['mstatus']=='1' && $info['done']=='1') {
                $this->assign('num',4);    
            }
        }        

        
        // $this->assign('info',$info);
        // $this->assign('other',$other);
        $this->display();
    }

    #删除
    function del(){
        $id = I('get.id');
        $shuju = D('Project')->where(array('id'=>$id))->delete();
        if($shuju){
            $this->success('删除成功',U('project'));
        }else{
            $this->error('删除失败',U('del'));
        }
    }

   
    
     #修改
    public function update(){
        $project=D("Project");
        $id = I('get.id');
        
        if(IS_POST){
            $shuju = I('post.');
            $shuju['ctime'] = time();
            // dump($shuju);
            // exit;
            $num = $project->save($shuju);
            if($num){
                $this->success('修改成功',U('project'));
            }else{
                $this->error('修改失败',U('update',array('id'=>$id)));
            }
        }else{
            $info = $project->find($id);
            $this->assign("info",$info);
            $this->display("update");
        }
    }


    #查询
    function search(){
        $project = D('Project');
        if(IS_POST){
            $word = I('search');
            //dump($word);
            $data['name'] = array('like','%'.$word.'%');
            $info = $project->where($data)->select();

            if($info){
                $this->assign('info',$info);
                $this->display('project');
            }
        }
    }


     #删除所有
    public function DelAll($value=''){
        foreach ($_POST['choose'] as $key => $value) {
            $info = D('Project')->where(array('id'=>$value))->delete();
        }
        if($info){
            //删除成功
            $this->success('删除成功',U('project'));
        }else{
            //删除失败
            $this->error('删除失败');
        } 
    } 

    #项目进度
    public function plan(){
        
        $this->display();
    }

}

