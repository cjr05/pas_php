<?php


namespace Admin\Model;
use Think\Model;


class ProjectModel extends Model{
	//获取状态码
	public function  getCoreStatus($where='',$order = 'id DESC'){
		return $this->where($where)->order($order);
	}
	//查询所有项目数据
	public function getAllProject($field='*',$where='',$order='id desc'){
		return $this->field($field)->where($where)->order($order);  //select * from project 
	}

	//查询未处理的项目
	public function selectStatus($field='*',$where=''){
		return $this->field($field)->where($where);
	}
	//查询未完成的项目

	//查询拨款的项目

}