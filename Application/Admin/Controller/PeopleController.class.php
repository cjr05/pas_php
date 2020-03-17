<?php
namespace Admin\Controller;
use Think\Controller;

use Admin\Common\CommonController;
class PeopleController extends CommonController{
#会员用户控制器
// class PeopleController extends Controller {
    public function People(){
        $people = D('People');
        $count = $people->count();
        $Page = new \Think\Page($count,10);
        //$Page->setConfig('header','个会员');
        $show = $Page->show();
        //dump($show);
        $info = $people->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('info',$info);
        $this->display();
    }


     #添加
    function add(){
         $project = D('People');
         //$auth = D('Auth')->select();
         $authinfoA = D('Auth')->where(array('auth_pid'=>0))->select();
         $authinfoB = D('Auth')->where(array('auth_pid'=>array('neq',0)))->select(); //neq不等于
         $this->assign('authinfoA',$authinfoA);
         $this->assign('authinfoB',$authinfoB);
         //dump($auth);
         if(IS_POST && I('post.name')!='' && I('post.password')!=''){
             $data = array(
                'name'=>I('post.name'),
                'password'=>I('post.password'),
                'role_name'=>I('post.role_name')
                );
             //$role = I('post.role');
              //dump($role);
            


             switch ($role) {
                   case '员工':
                       $data['auth_id'] = '102,103,205,204';
                       $data['auth_ca'] = 'Manager-login,Account-account,Account-upd,People-add';
                       break;
                   default:
                       $data['auth_id'] = '101,201';
                       $data['auth_ca'] = 'Project-project,Project-see';
                       break;
               }  

             // dump($data);
             // exit;  
             $shuju = $project->add($data);

             if($shuju){
                 $this->success('添加成功');
             }
         }
        $this->assign('auth',$auth); 
        $this->display();
    }

    #查看
    function see(){
        $id = I('get.id');
        dump($id);
        $shuju = D('People')->where(array('id'=>$id))->select();
        //$other = D('Principal')->where(array('id'=>$id))->select();
        $info = D('People')->where(array('id'=>$id))->find();
        dump($info);
        $this->assign('info',$info);
        $this->display();
    }

    #删除
    function del(){
        $id = I('get.id');
        $shuju = D('People')->where(array('id'=>$id))->delete();
        if($shuju){
            $this->success('删除成功',U('people'));
        }else{
            $this->error('删除失败',U('del'));
        }
    }

   
    
    //  #修改
    // public function update(){
    //     $project=D("Project");
    //     $id = I('get.id');
        
    //     if(IS_POST){
    //         $shuju = I('post.');
    //         $shuju['ctime'] = time();
    //         // dump($shuju);
    //         // exit;
    //         $num = $project->save($shuju);
    //         if($num){
    //             $this->success('修改成功',U('project'));
    //         }else{
    //             $this->error('修改失败',U('update',array('id'=>$id)));
    //         }
    //     }else{
    //         $info = $project->find($id);
    //         //dump($info);
    //         //$roleinfo = D('Role')->select();
    //         //dump($roleinfo);
    //        // $this->assign('roleinfo',$roleinfo);
    //         //dump($info);
    //         $this->assign("info",$info);
    //         $this->display("update");
    //     }
    // }


    #查询
    function search(){
        $project = D('People');
        if(IS_POST){
            $word = I('search');
            //dump($word);
            $data['name'] = array('like','%'.$word.'%');
            $info = $project->where($data)->select();

            if($info){
                $this->assign('info',$info);
                $this->display('people');
            }
        }
    }


    //  #删除所有
    // public function DelAll($value=''){
    //     foreach ($_POST['choose'] as $key => $value) {
    //         $info = D('Project')->where(array('id'=>$value))->delete();
    //     }
    //     if($info){
    //         //删除成功
    //         $this->success('删除成功',U('project'));
    //     }else{
    //         //删除失败
    //         $this->error('删除失败');
    //     } 
    // } 
}