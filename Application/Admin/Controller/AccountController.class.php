<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2019/6/21
 * Time: 10:50
 * 账户控制器
 */

namespace Admin\Controller;
use Think\Controller;



use Admin\Common\CommonController;
class AccountController extends CommonController{
//class AccountController extends Controller{
    function account(){
        $admin_name = session('admin_name');
        $admin_password = session('admin_password');
    	if(IS_AJAX) {
    		$oldPwd = I('post.oldPwd');//旧密码
            if($oldPwd!==''){
                if($oldPwd!==$admin_password){
                    $info = array(
                        'status'=>201,
                        'msg'=>'*密码错误',
                        );
                }else{
                    $info = array(
                        'status'=>200,
                        'msg'=>''
                    );
                }
            }else{
                $info = array(
                        'status'=>202,
                        'msg'=>'*请填写旧密码',
                        );
            }
            
		   	$this->ajaxReturn($info);
		}
        $this->display();
    }


    function upd(){
    	//dump($_POST);   
        if(IS_POST){
            // $name = I('post.newname');
            // $password = I('post.password');
            // $verify = I()
            $data = array(
                'password' => I('post.password'),
                );
            $id = session('admin_id');
            $shuju = D('People')->where("id=".$id)->save($data);
            if($shuju){
                // $info = D('People')->select($id);
                // session('admin_id', $info['id']);
                // session('admin_name', $info['name']);
                $this->ajaxReturn($shuju);
            }
        }
    	
    }

}