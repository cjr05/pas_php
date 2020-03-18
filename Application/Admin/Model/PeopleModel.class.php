<?php


namespace Admin\Model;
use Think\Model;


class PeopleModel extends Model{
	//取用户
	public function getPeople($where='',$field='*'){
		return $this->field($field)->where($where);
	}
}