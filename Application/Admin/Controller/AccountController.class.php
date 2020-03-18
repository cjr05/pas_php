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
    	if(IS_AJAX && I('param.newname')!='') {
    		$name = I('param.newname');
    		$info = D("People")->where(array('name'=>$name))->find();
		    if($info){
		    	$info = array(
		    		'status'=>200,
		    		'msg'=>'已经存在',
		    		);
		    }else{
		    	$info = array(
		    		'msg'=>'恭喜你！可以更改',
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
                'name' => I('post.newname'),
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