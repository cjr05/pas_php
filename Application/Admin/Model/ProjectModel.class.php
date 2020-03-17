<?php


namespace Admin\Model;
use Think\Model;


class ProjectModel extends Model{
	//获取状态码
	public function  getCoreStatus($where='',$order = 'id DESC'){
		return $this->where($where)->order($order);
	}


	public function pageShow(){
		
	}
}