<?php
namespace Admin\Controller;
use Think\Controller;


use Admin\Common\CommonController;
class IndexController extends CommonController{
//class IndexController extends Controller {

    /**
     * 判断登录状态
     */
    public function _initialize()
    {
        $sid = session('admin_name');//检测session是否存在，不存在就跳登录页面
        if (! isset($sid)) {
            $this->redirect('Manager/login');
        }
    }


    public function main(){
        $admin_name = session('admin_name');
        //dump($admin_name);
        $project = D('Project');
        $a =  $project->getCoreStatus(array('status'=>'0'))->select();
        //dump($a);
        if ($a) {
            $count = ($admin_name =='admin') ? $project->count() : $project->where(array('people'=>$admin_name))->count(); 
            $Page = new \Think\Page($count,10);
            $show = $Page->show();
            $info = ($admin_name =='admin' || $admin_name == '财务') ? $project->getCoreStatus(array('status'=>'0'))->limit($Page->firstRow.','.$Page->listRows)->select() : $project->getCoreStatus(array('people'=>$admin_name,'status'=>'0'))->limit($Page->firstRow.','.$Page->listRows)->select();
            //dump($info);
                        
            
        }



        // $count = ($admin_name =='admin') ? $project->count() : $project->where(array('people'=>$admin_name))->count(); 
        // $Page = new \Think\Page($count,10);
        // $show = $Page->show();
        // $info = ($admin_name =='admin') ? $project->where(array('status'=>'未审核'))->limit($Page->firstRow.','.$Page->listRows)->select() : $project->where(array('people'=>$admin_name,'status'=>'未审核'))->limit($Page->firstRow.','.$Page->listRows)->select();
        //$this->assign('list',$list);// 赋值数据集
        //dump($info);
        $this->assign('page',$show);// 赋值分页输出
        //$this->assign('is_main','main');
        $this->assign('info',$info);
        $this->display();
    }
    public function index(){
        $this->_initialize();
        $this->display();
    }


    public function left(){
        $admin_id = session('admin_id');
        $admin_name = session('admin_name');
        
        if($admin_name=='admin'){
            $authinfoA = D('Auth')->where(array('auth_pid'=>0))->select();
            $authinfoB = D('Auth')->where(array('auth_pid'=>array('neq',0),'auth_id'=>array('neq',204)))->select();
        }else{
            $info = D('People')->where(array('id'=>$admin_id))->field('auth_id')->find();
            $authids = $info['auth_id'];
          
            $authinfoA = D('Auth')->where(array('auth_id'=>array('in',$authids),'auth_pid'=>0))->select();
            $authinfoB = D('Auth')->where(array('auth_id'=>array('in',$authids),'auth_pid'=>array('neq',0)))->select();
        }
//        dump($authinfoA);
//        dump($authinfoB);
        $this->assign('authinfoA',$authinfoA);
        $this->assign('authinfoB',$authinfoB);
        $this->display();
    }

    public function top(){
        // $admin_id = session('id');
        // $admin_name = session('name');
        // $num = M('project')->where(array('status'=>'0'))->count();
        // $this->assign('num',$num);
        // $this->display();

        $admin_id = session('admin_id');
        $admin_name = session('admin_name');
//        print_r($admin_name);
//        exit;
        $time =  date(h);
        $tip = '';
        if ($time<11)$tip='早上好';
        else if($time<13)$tip='中午好';
        else if($time<17)$tip='下午好';
        else $tip='晚上好';
        $num = M('project')->where(array('status'=>'0'))->count();
        $this->assign('tip',$tip);
        $this->assign('num',$num);
        $this->display();
    }


}