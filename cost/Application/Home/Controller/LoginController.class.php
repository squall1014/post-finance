<?php
namespace Home\Controller;
//namespace Org\Net;
use Think\Controller;
class LoginController extends Controller {
    public function login(){
        $this->display();
    }
    public function logingr(){
    	$this->display();
    }
    public function index(){
    	$m=M('costlogin');
    	$username=$_POST['username'];
    	$password=$_POST['password'];
    	if($username==null){
    		
    	}else{
        cookie('name',$username,36000);
    	cookie('pass',$password,36000);
    	}
    	$where['username']=cookie('name');
    	$where['password']=cookie('pass');
    	$i=$m->where($where)->count();
    	$mrr=$m->where($where)->find();
        if($i>0){
        	$drr = M('danwei') -> select();
        	foreach($drr as &$value){
        		if($mrr['jgh'] == $value['jgh']){
        			$mrr['user'] = $value['dwname'];
        			//$mrr['jrywbqx'] = $value['jrywbqx'];
        		}
        	}
        	
        	cookie('dwname',$mrr,36000);
        	$datey=date(Y);
        	$datem=date(m);
        	
        	cookie('datey',$datey);
        	cookie('datem',$datem);
        	if($mrr['qx'] == '9'){
    	    	$this->success('恭喜您超级管理员,登录成功',U('Admin/index'));
        	}else if($mrr['qx'] == '8'){
        		$this->success('恭喜您'.$mrr['user'].',登录成功',U('Index/index'));
        	}else if($mrr['qx'] == '5'){
        		$this->success('恭喜您'.$mrr['user'].',登录成功',U('Index/index'));
        	}else if($mrr['qx'] == '0'){
        		$this->success('恭喜您'.$mrr['user'].',登录成功',U('Admin/index'),2);
        	}else if($mrr['qx'] == '11'){
				$this->success('恭喜您'.'信息中心管理员'.',登录成功',U('Ic/index'),2);
			}
        }
        else{
    		$this->error('用户名密码错误');
        }
    }
    public function downloads(){
    	$http = new \Org\Net\Http;  
        $filename = "E:\Public\GC.exe";  
        $showname="google.exe";
        $http->download($filename, $showname);  
    }
}