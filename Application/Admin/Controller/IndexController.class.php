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
        $role_name = D('People')->field('role_name')->where(array('name'=>$admin_name))->find(); 
        //根据角色wei 4 判断
        if($role_name['role_name']=='4'){
            //总项目数量
            $num['all'] = $project->where(array('people'=>$admin_name))->count();
            //完成项目数量
            $num['done'] = $project->selectStatus('done',array('people'=>$admin_name,'done'=>'1'))->count();
            //未完成项目数量
            $num['ndone'] = $project->selectStatus('done',array('people'=>$admin_name,'done'=>'0'))->count();
            //未审批
            $num['nisStatus'] = $project->selectStatus('status',array('people'=>$admin_name,'status'=>'0'))->count(); 
            //审批
            $num['isStatus'] = $project->selectStatus('status',array('people'=>$admin_name,'status'=>'1'))->count(); 
            //退回
            $num['tuihui'] = $project->selectStatus('status',array('people'=>$admin_name,'status'=>'-1'))->count();
            //未拨款
            $num['isMStatus'] = $project->selectStatus('status',array('people'=>$admin_name,'mstatus'=>'0'))->count();
            //拨款
            $num['nisMStatus'] = $project->selectStatus('status',array('people'=>$admin_name,'mstatus'=>'1'))->count();
        }else{
            //总项目数量
            $num['all'] = $project->count();
            //完成项目数量
            $num['done'] = $project->selectStatus('done',array('done'=>'1'))->count();
            //未完成项目数量
            $num['ndone'] = $project->selectStatus('done',array('done'=>'0'))->count();
            //未审批
            $num['nisStatus'] = $project->selectStatus('status',array('status'=>'0'))->count(); 
            //审批
            $num['isStatus'] = $project->selectStatus('status',array('status'=>'1'))->count(); 
            //退回
            $num['tuihui'] = $project->selectStatus('status',array('status'=>'-1'))->count();
            //未拨款
            $num['isMStatus'] = $project->selectStatus('status',array('mstatus'=>'0'))->count();
            //拨款
            $num['nisMStatus'] = $project->selectStatus('status',array('mstatus'=>'1'))->count();
        }

        
        // $this->assign('doneNum',$doneNum);
        $this->assign('num',$num);
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
        //dump($admin_name);
        //dump($admin_id);
        //exit;
        $time =  date("H");
        //dump($time);
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