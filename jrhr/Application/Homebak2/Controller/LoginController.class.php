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
    	$m=M('login');
    	$username=$_POST['username'];
    	$password=$_POST['password'];
    	if($username==null){
    		
    	}else{
        cookie('name',$username,3600);
    	cookie('pass',$password,3600);
    	}
    	$where['username']=cookie('name');
    	$where['password']=cookie('pass');
    	$i=$m->where($where)->count();
    	$mrr=$m->where($where)->find();
        if($i>0){
        	$drr=M('danwei')->select();
        	foreach($drr as &$value){
        		if($mrr['username']==$value['jgh']){
        			$mrr['user']=$value['username'];
        		}
        	}
        	$prr = M('lungang') -> select();
        	foreach($prr as &$value){
        		if($mrr['username'] == $value['gonghao']){
        			$mrr['user'] = $value['persname'];
        			$mrr['gonghao'] = $value['gonghao'];
        			$jgh = $value['dwname'];
        			$drr = M('danwei') -> where("jgh = '$jgh'") ->find();
        			$mrr['jiagou'] = $drr['jiagou'];
        			$mrr['dwzhiwuqx'] = $drr['dwzhiwuqx'];
        			$mrr['jgh'] = $value['dwname'];
        			$mrr['dwname'] = $drr['dwname'];
        			$mrr['qjjgh'] = $drr['qjjgh'];
        			$zhiwu = $value['zhiwu'];
        			$zrr = M('zhiwu') -> where("zhiwud = '$zhiwu'") ->find();
        			$mrr['zhiwuqx'] = $zrr['zhiwuqx'];
        			$mrr['zwjiagou'] = $zrr['zwjiagou'];
        			$mrr['zhiwu'] = $zrr['zhiwu'];
        			$mrr['zhiwud'] = $value['zhiwu'];
        			$gongzhong = $value['gongzhong'];
        			$grr = M('gongzhong') ->where("gongzhongd = '$gongzhong'") ->find();
        			$mrr['gongzhongd'] = $value['gongzhong'];
        			$mrr['gongzhong'] = $grr['gongzhong'];
        		}
        	}
        	cookie('dwname',$mrr,3600);
        	$datey=date(Y);
        	$datem=date(m);
        	
        	cookie('datey',$datey);
        	cookie('datem',$datem);
        	if($mrr['username'] == $mrr['password']){
        		$this->error('首次登录或帐号密码一致,请先修改密码',U('Login/passwordedit'));
        	}
        	if($mrr['qx'] == '9'){
    	    	$this->success('恭喜您超级管理员,登录成功',U('Index/index'));
        	}else if($mrr['qx'] == '8'){
        		$this->success('恭喜您管理员,登录成功',U('Index/index'));
        	}else if($mrr['qx'] == '0'){
        		$this->success('恭喜您'.$mrr['user'].',登录成功',U('Admin/index'),2);
        	}
        }
        else{
    		$this->error('用户名密码错误');
        }
    }
    public function passwordeditsuc(){
    	$passwordold = $_POST['passwordold'];
    	$passwordnew = $_POST['passwordnew'];
    	$passwordconfirm = $_POST['passwordconfirm'];
    	if(!isset($_POST)){
    		var_dump($_POST);
    	}
    	$dwname = cookie('dwname');
    	$username = $dwname['username'];
    	if($passwordold == $dwname['password']){
    		if($passwordnew == $passwordconfirm){
    			$where['password'] = $passwordnew;
    			$l = M('login');
    			$lrr = $l -> where("username = '$username'") -> save($where);
    			if($lrr > 0){
    				$this->success('密码修改成功,请继续',U('Login/login'));
    			}
    		}else{
    			$this->error('2次密码不同,请重新输入');
    		}
    	}else{
    		$this->error('原密码错误,请重新输入');
    	}
    	//var_dump($_POST);
    }
    public function gonghaocx(){
    	$where['persname'] = $_POST['gonghao'];
    	$p = M('pers');
    	$prr = $p -> where($where) -> find();
    	$gonghao = $prr['gonghao'];
    	$prr['user'] = $prr['persname'];
    	$datey = date(Y);
    	$datem = date(m);
    	$this->assign('datey',$datey);
    	$this->assign('datem',$datem);
    	$this->assign('dwname',$prr);
    	$this->display();
    }
    public function logout(){
    	$this->success('系统退出',U('Login/login'),1);
    }
    public function downloads(){
    	$http = new \Org\Net\Http;  
        $filename = "E:\Public\GC.exe";  
        $showname="google.exe";
        $http->download($filename, $showname);  
    }
    public function downloadshh(){
    	$http = new \Org\Net\Http;  
        $filename = "E:\Public\Firefox.rar";  
        $showname="firefox.rar";
        $http->download($filename, $showname);  
    }
}