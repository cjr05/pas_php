<?php
namespace Admin\Controller;
use Think\Controller;

use Admin\Common\CommonController;
class ManagerController extends CommonController{
#管理员控制器
//class ManagerController extends Controller {
    /**
     * 登录提示
     */
    protected function out($info='',$data = '', $jumpUrl = null) {
        $ajax = IS_AJAX;
        $_ajax = I('is_ajax', '');
        if ($ajax || $_ajax) {
            $data = array('info' => $info, 'data' => $data);
            exit(json_encode($data));
            return true;
        }
        $msg = $data;
        if ($info == 'ok' || $info == 'success' || $info == 'succ') {
            $this->success($msg, $jumpUrl);
            exit;
        }
        if ($info == 'error' || $info == 'fail') {
            $this->error($msg, $jumpUrl);
            exit;
        }
    }


     #登录
    public function login()
    {
        $people = D('People');
        if (IS_POST) {
            $code = I('post.verify');
            $vry = new \Think\Verify();
            if ($vry->check($code)) {
                $username = I('name');
                $password = I('password');
                $shuju = $people->where(array('name' => $username, 'password' => $password))->find();

                if ($shuju) {
                    session('admin_id', $shuju['id']);
                    session('admin_name', $shuju['name']);
                   
                    
                    $this->redirect('Index/index');
                }
                $this->assign('err', '用户名或密码错误');
            } else {
                $this->assign('err', '验证码错误');
            }
        }
        $this->display();
    }
    #退出
    public function adminExit(){
        session(null);
        $this->redirect('Manager/login');
    }

    #验证码
    function verifyImg(){
        $cfg=array(
            'fontSize'  =>  20,
            'imageH'    =>  46,               
            'imageW'    =>  154,              
            'length'    =>  4,              
            'fontttf'   =>  '4.ttf',            

            );
        $vry = new \Think\Verify($cfg);
        $vry->entry();
    }

//    #添加
//    function addpro(){
//        $project = D('Project');
//        $principal = D('principal');
//        if(IS_POST){
//            $data = array(
//                'name' => I('post.name'),
//                'people' => I('post.people'),
//                'money' => I('post.money'),
//                'reason' => I('post.reason'),
//                'ctime' => date("Y-m-d h:i:s"),
//                'status' => '已审核'
//            );
//
//            $other = array(
//                'people'=> I('post.people'),
//                'other'=> I('post.other'),
//            );
//            $shuju = $project->add($data);
//            $shuju1 = $principal->add($other);
//            if($shuju&&$shuju1){
//                $this->success('发布成功',U('Project/project'));
//            }else{
//                $this->error('发布失败',U('Manager/add'));
//            }
//        }
//        $this->display();
//    }


    #查看修改审批
    public function see(){
        $project = D('Project');
        $principal = D('principal'); 
        

        $this->display();
    }

    #admin注册
   

    #admin删除
    //更新
   

   	#admin更新
   

    // public function admin_list(){
    //     $this->display();
    // }



     
}