<?php
namespace Admin\Model;
use Think\Model;


class ProcessModel extends Model{
	public function getProcess($field='*',$where=''){
		return $this->field($field)->where($where);
	}
}