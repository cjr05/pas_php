<?php


namespace Admin\Model;
use Think\Model;


class PeopleModel extends Model{
	//取用户
	public function getPeople($field='*',$where=''){
		return $this->field($field)->where($where);
	}
}