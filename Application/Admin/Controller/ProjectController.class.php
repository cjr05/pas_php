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
        $role_name = D('People')->field('role_name')->where(array('name'=>$admin_name))->find(); 
        //dump($role_name['role_name']);
        //session('role_name', $role_name['role_name']);
        $project = D('Project');
        //项目数量
        $count = ($admin_name =='admin') ? $project->count() : $project->where(array('people'=>$admin_name))->count(); 
        //dump($count);
        $Page = new \Think\Page($count,10);
        $show = $Page->show();
       
        if($role_name['role_name']=='4'){
            $info = $project->where(array('people'=>$admin_name))->limit($Page->firstRow.','.$Page->listRows)->order('id desc')->select();
        }else{
            $info = $project->limit($Page->firstRow.','.$Page->listRows)->order('id desc')->select();
        }
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('info',$info);
        $this->display();
    }


    #添加
    function add(){
        $project = D('Project');
        //$principal = D('principal');
        $process = D('process');
        if(IS_POST){
            $data = array(
                'name' => I('post.name'),
                'people' => I('post.people'),
                'money' => I('post.money'),
                'reason' => I('post.reason'),
                'process_type' => I('post.process_type'),
                'ctime' => date("Y-m-d h:i:s"),
                'other'=> I('post.other'),
            );

            
            $shuju = $project->add($data);
            
            if($shuju){
                $this->success('发布成功',U('Project/project'));
            }else{
                $this->error('发布失败',U('Manager/add'));
            }
        }
        $info = $process->select();
        //$getPeople = D('People')->getPeople()->select();
        //dump($getPeople);
        $this->assign('process',$info);
        //$this->assign('getPeople',$getPeople);
        $this->display();
    }


    #查看
    function see(){



        $admin_name = session('admin_name');
        //dump($admin_name);
        
        $project=D("Project");
        $id = I('get.id');
        if(IS_POST){
            $id = I('post.id');
            switch ($admin_name) {
                case '员工':
                    $data['done'] = '1';
                    break;
                case '经理':
                    $data['status'] = '1';
                    break;

                default:
    
                    break;
            }

            //dump($data);
            // $shuju['status'] = I('post.status');
            $num = $project->where(array('id'=>$id))->save($data);
            if($num){
                $this->success('成功',U('project'));
            }else{
                $this->error('失败',U('see'));
            }
        }


        

        // $shuju = D('Project')->where(array('id'=>$id))->select();
        //dump($shuju);
        //$other = D('Principal')->where(array('id'=>$id))->select();
        $info = D('Project')->where(array('id'=>$id))->find();
        //dump($info);
        // $other = D('principal')->where(array('people'=>$info['people']))->find();
        //dump($other);
        //$plan = D('plan')->select();
        //dump($plan);
        if($info['is_status'] !== '0'){
            if($info['status']=='-1' && $admin_name=='员工'){
                echo '<script> alert("无法查看，请修改项目！！");
                                location.href="'.U('project').'";      
                    </script>';
            }else{
                $this->assign('info',$info);
                //$this->assign('other',$other);
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
        }else{
             echo '<script> alert("admin禁用此项目无法查看，请联系admin！！");
                                location.href="'.U('project').'";      
                    </script>';
        }
               
        $this->assign('info',$info);
        $this->display();
    }

    //项目退回
    function tuihui(){

        //$data['ss'] = 'ssssssss';
        if(IS_AJAX){
            $id = I('post.pid');
            $data = array(

                'status'=>I('post.status'),
                'msg'=>I('post.msg')    
            );

            if($data){
                $info = D('project')->where(array('id'=>$id))->save($data);
            }
            $this->ajaxReturn($info);
        }
        //dump($data);
        //$data['status']= $status;
        
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
            $shuju['status'] = '0';
            $num = $project->where(array('id'=>$id))->save($shuju);
            //  dump($num);
            // exit;
            if($num){
                $this->success('修改成功',U('project'));
            }else{
                $this->error('修改失败',U('update',array('id'=>$id)));
            }
        }else{
            $info = $project->find($id);
            $pro_type = D('process')->select();
            //dump($pro_type);
            $this->assign('pro_type',$pro_type);
            
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

