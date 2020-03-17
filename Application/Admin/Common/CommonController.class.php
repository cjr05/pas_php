<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2019/6/20
 * Time: 19:20
 */
namespace Admin\Common;
use Think\Controller;


class CommonController extends Controller
{
	public function __construct(){
		parent::__construct();
		$admin_id = session('admin_id');
		$admin_name = session('admin_name');
		//dump($admin_name);

		$nowAC = CONTROLLER_NAME.'-'.ACTION_NAME;
		

		if(!empty($admin_name)){
			$roleinfo = D('People')->field('auth_ca')->where(array('id'=>$admin_id))->find();
			
		
			$have_auth = $roleinfo['auth_ca'];

			$allow_auth = "Manager-login,Manager-verifyImg,Index-index,Index-left,Index-main,Index-top,Manager-adminExit,Index-footer";	

			if(strpos($have_auth,$nowAC)===false && strpos($allow_auth,$nowAC)===false && $admin_name!=='admin'){
				exit('没有权限访问!');
			}
		}else{
			$allow_ac = "Manager-login,Manager-verifyImg,Manager-adminExit";
			if(strpos($allow_ac,$nowAC)===false){
				//$this->redirect('Manager/login');
				

				$js = <<<eof

<script type="text/javascript">

//top：作用使得整个frameset都跳转

window.top.location.href="/index.php/Admin/Manager/login";

</script>

eof;

echo $js;
			}		
		}
	}
}