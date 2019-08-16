<?php
namespace Home\Controller;
//namespace Org\Net;
use Think\Controller;
class AdminController extends Controller {
	public function _initialize(){
    	if(cookie('name')==null){
    		$this->error('您还未登录,请登录后再操作',U('Login/login'),1);
    	}else{
    		$dwname=cookie('dwname');
    		$datey=cookie('datey');
    		$datem=cookie('datem');
    		$this->assign('dwname',$dwname);
    		$this->assign('datey',$datey);
    		$this->assign('datem',$datem);
    	}
    }
    public function index(){
    	//var_dump(cookie('name'));
    	//var_dump(cookie('dwname'));
    	$this->display();
    }
    public function logout(){
    	cookie('name',null);
    	$this->success('登出成功',U('Login/login'),1);
    }
    public function jrpoint($data){
    	$jrpc = M('jrpointcontent');
    	$jrpcrr = $jrpc -> select();
    	foreach($data as &$value){
    		foreach($jrpcrr as &$valuejrpc){
    			if($value['pointcontentid'] == $valuejrpc['pointcontentid']){
    				$value['unit'] = $valuejrpc['unit'];
    				$value['content'] = $valuejrpc['content'];
    			}
    		}
    	}
    	return $data;
    }
    public function jract($data){
    	$jai = M('jractitem');
    	$jairr = $jai -> select();
    	foreach($data as &$value){
    		
    		foreach($jairr as &$valuejai){
    			
    			if($value['actitemid'] == $valuejai['actitemid']){
    				
    				$value['item'] = $valuejai['item'];
    				$value['selects'] = $valuejai['selects'];
    			}
    		}
    	}
    	return $data;
    }
    public function jractive($data){
    	$javi = M('jractiveitem');
    	$javirr = $javi -> select();
    	foreach($data as &$value){
    		
    		foreach($javirr as &$valuejavi){
    			
    			if($value['activeitemid'] == $valuejavi['activeitemid']){
    				
    				$value['item'] = $valuejavi['item'];
    			}
    		}
    	}
    	return $data;
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
    }
    public function jrpointup(){
    	$jrpi = M('jrpointitem');
    	$where['stats'] = 0;
    	$data = $jrpi -> where($where) -> select();
    	$this->assign('data',$data);
    	$this->display();
    }
    public function jrpointups(){
    	$pointitemid = $_GET['pointitemid'];
    	//var_dump($pointitemid);
    	cookie('pointitemid',$pointitemid);
    	$dwname = cookie('dwname');
    	$jrps = M('jrpointsum');
    	$whereps['date'] = date('Y-m-d');
    	$whereps['gonghao'] = $dwname['gonghao'];
    	$whereps['pointitemid'] = $pointitemid;
    	$jrpsrr = $jrps -> field('pointcontentid') -> where($whereps) -> select();
    	foreach($jrpsrr as &$value){
    		$pointcontentid[] = $value['pointcontentid'];
    	}
    	//var_dump($jrpsrr);
    	$jrpc = M('jrpointcontent');
    	
    	$where['pointitemid'] = $pointitemid;
    	if(!$pointcontentid == null){
    		$where['pointcontentid'] = array('notin',$pointcontentid);
    	}
    	$where['stats'] = 0;
    	$jrpcrr = $jrpc -> where($where) -> select();
    	$this->assign('data',$jrpcrr);
    	//var_dump($jrpcrr);
    	$this->display();
    }
    public function jrpointupsuc(){
    	$dwname = cookie('dwname');
    	$pointitemid = cookie('pointitemid');
    	$sum = $_POST;
    	foreach($sum as $key=>$value){
    		if(!$value == null){
    			$points[] = $key;
    			$point[] = array(
    			'jgh' => $dwname['jgh'],
    			'dwname' => $dwname['dwname'],
    			'zhiwu' => $dwname['zhiwu'],
    			'gongzhong' => $dwname['gongzhong'],
    			'persname' => $dwname['user'],
    			'gonghao' => $dwname['gonghao'],
    			'zhiwud' => $dwname['zhiwud'],
    			'pointcontentid' => $key,
    			'point' => $value,
    			
    			'date' => date('Y-m-d'),
    			'shenhe' => 0,
    			);
    		}
    	}
//  	$where['date'] = date('Y-m-d');
//  	$where['pointcontentid'] = array('in',$points);
//  	$where['gonghao'] = $dwname['gonghao'];
    	$jrps = M('jrpointsum');
//  	$count = $jrps -> where($where) -> count();
//  	if($count >0){
//  		$this->error('此员工已经添加过积分,若要再添加,请去修改界面');
//  	}
    	$jrpc = M('jrpointcontent');
    	$jrpcrr = $jrpc -> where("pointitemid = '$pointitemid'") -> select();
    	foreach($point as &$value){
    		
    		foreach($jrpcrr as &$valuejrpc){
    		
    			if($valuejrpc['pointcontentid'] == $value['pointcontentid']){
    				$value['sum'] = $value['point'] * $valuejrpc['score'];
    				$value['score'] = $valuejrpc['score'];
    				
    			}
    		}
    	}
    	//var_dump($point);
    	$jrpsrr = $jrps -> addall($point);
    	if($jrpsrr > 0){
    		cookie('pointitemid',null);
    		$this->success('员工积分添加成功,请继续',U('Admin/jrpointup'));
    		
    	}else{
    		$this->error('员工积分添加失败,请核对数据');
    	}
    }
    public function jrpointupmodify(){
    	for($i = 3; $i >= 0; $i--){
    		$date[]['date'] = date('Y-m-d',mktime(0,0,0,date("m"),date("d")-$i,date("Y")));
    	}
		
		$this->assign('data',$date);
		$this->display();
    }
    public function jrpointupmodifys(){
    	$dwname = cookie('dwname');
    	
		$where['shenhe'] = 0;
		$where['date'] = $_GET['date'];
		//$where['pointitemid'] = 1;
    	$where['gonghao'] = $dwname['gonghao'];
    	//var_dump($where);
    	$jrps = M('jrpointsum');
    	$data = $jrps -> where($where) -> select();
    	$data = $this->jrpoint($data);
    	
    	//var_dump($data);
    	$this->assign('data',$data);
    	
    	$this->display();
    }
    public function jrpointupmodifysuc(){
    	$data = $_POST;
    	$jrps = M('jrpointsum');
    	foreach($data as $key=>$value){
    		$point = $jrps -> field('score') -> where("pointsumid = '$key'") -> find();
    		$where['point'] = $value;
    		$where['sum'] = $value * $point['score'];
    		$datas = $jrps -> where("pointsumid = '$key'") -> save($where);
    		//var_dump($datas);
    		$datasum = $datasum + $datas;
    		//var_dump($point);
    	}
    	if($datasum > 0){
    		$this->success('积分修改成功,请继续操作');
    	}else{
    		$this->error('积分修改失败,请检查数据');
    	}
    }
    public function jrpointupsh(){
    	for($i = 3; $i >= 0; $i--){
    		$date[]['date'] = date('Y-m-d',mktime(0,0,0,date("m"),date("d")-$i,date("Y")));
    	}
    	//var_dump($date);
		//$date[]['date'] = date('Y-m-d');
		$dwname = cookie('dwname');
		$this->assign('dwname',$dwname);
		$this->assign('data',$date);
		$this->display();
    }
    public function jrpointupshs(){
    	$date = $_GET['date'];
    	$dwname = cookie('dwname');
    	$where['date'] = $date;
    	$where['shenhe'] = 0;
    	$where['jgh'] = $dwname['jgh'];
    	$jrps = M('jrpointsum');
    	$data = $jrps -> field('dwname,jgh,zhiwu,persname,gonghao,sum(sum) as sums,date') -> where($where) -> group('dwname,jgh,zhiwu,persname,gonghao,date') -> select();
    	//var_dump($data);
    	$this->assign('data',$data);
    	$this->display();
    }
    public function jrpointupshsuc(){
    	$jgh = $_POST['jgh'];
    	$date = $_POST['date'];
    	$where['jgh'] = $jgh;
    	$where['date'] = $date;
    	$where['shenhe'] = 0;
    	$jrps = M('jrpointsum');
    	$exp['shenhe'] = 1;
    	//var_dump($_POST);
    	$data = $jrps -> where($where) -> field('pointsumid,shenhe') -> select();
    	foreach($data as &$value){
    		$pointsumid = $value['pointsumid'];
    		$jrpsrr = $jrps -> where("pointsumid = '$pointsumid'") -> save($exp);
    	}
    	if($jrpsrr > 0){
    		$this->success('积分批量审核成功,请继续');
    	}else{
    		$this->error('积分审核失败,请检查数据');
    	}
    }
    public function jrperspointupsuc(){
    	//var_dump($_POST['gonghao']);
    	$pointsumid = $_POST['pointsumid'];
    	$exp['shenhe'] = 1;
    	$jrps = M('jrpointsum');
    	foreach($pointsumid as &$value){
    		$jrpsrr = $jrps -> where("pointsumid = '$value'") -> save($exp);
    	}
    	if($jrpsrr > 0){
    		$this->success('积分审核成功,请继续',U('Admin/jrpointupsh'));
    	}else{
    		$this->error('积分审核失败,请检查数据');
    	}
    }
    public function jrperspointup(){
    	$date = $_GET['date'];
    	$gonghao = $_GET['gonghao'];
    	$where['date'] = $date;
    	$where['gonghao'] = $gonghao;
    	$where['shenhe'] = 0;
    	$jrps = M('jrpointsum');
    	$data = $jrps -> field('pointsumid,dwname,zhiwu,persname,gonghao,pointcontentid,point,score,sum,date') -> where($where) -> select();
    	$data = $this->jrpoint($data);
    	$this->assign('data',$data);
    	$this->display();
    }
    public function jrpointupsearchs(){
    	//var_dump($_POST);
    	$date = $_POST['date'];
    	$dwname = cookie('dwname');
    	$where['shenhe'] = 1;
    	$where['date'] = $date;
    	$where['gonghao'] = $dwname['gonghao'];
    	$jrps = M('jrpointsum');
    	$data = $jrps -> where($where) -> field('dwname,zhiwu,persname,score,sum,point,pointcontentid') -> select();
    	$point = $jrps -> where($where) -> sum('point');
    	$sum = $jrps -> where($where) -> sum('sum');
    	$this->assign('point',$point);
    	$this->assign('sum',$sum);
    	$data = $this->jrpoint($data);
    	$this->assign('data',$data);
    	$this->display();
    }
    public function jrpointsupsearchs(){
    	$date = substr($_POST['date_date'],0,7);
    	$dates = substr($_POST['date_date'],-10,7);
    	if($date == date('Y-m') or $dates == date('Y-m')){
    		$this->error('当月积分统计不能查询,请重新选择');
    	}
    	$date = substr($_POST['date_date'],0,10);
    	$dates = substr($_POST['date_date'],-10,10);
    	$where['shenhe'] = 1;
    	$where['date'] = array( array('egt',$date) , array('elt',$dates) , 'and' );
    	$dwname = cookie('dwname');
    	$where['jgh'] = $dwname['jgh'];
    	$jps = M('jrpointsum');
    	$jpsrr = $jps -> where($where) -> field('dwname,persname,zhiwu,gongzhong,pointcontentid,score,sum(point) as points,sum(sum) as sums') -> group('persname,zhiwu,gongzhong,pointcontentid,dwname,score') -> select();
    	//
    	$jpsrr = $this->jrpoint($jpsrr);
    	$this->assign('data',$jpsrr);
    	$this->display();
    } 
    
    
    public function jractup(){
    	$dwname = cookie('dwname');
    	$jgh = $dwname['jgh'];
    	
    	
    	$jas = M('jractsum');
    	$where['jgh'] = $jgh;
    	$where['date'] = date('Y-m-d');
    	//$where['selects'] = 1;
    	//$where['shenhe'] = 0;
    	$jasrr = $jas -> field('actitemid') -> where($where) -> select();
    	
    	$jai = M('jractitem');
    	$stats['stats'] = 0;
    	$stats['selects'] = 1;
    	if($jasrr == null){
    		
    	}else{
    		foreach($jasrr as &$value){
    			$jasr[] = $value['actitemid'];
    		}
    		$stats['actitemid'] = array('notin',$jasr);
    	}
    	
    	$jairr = $jai -> where($stats) -> select();
    	$this->assign('jairr',$jairr);
    	//var_dump($jairr);
    	$stats['stats'] = 0;
    	$stats['selects'] = 0;
    	if($jasrr == null){
    		
    	}else{
    		foreach($jasrr as &$value){
    			$jasrrr[] = $value['actitemid'];
    		}
    		$stats['actitemid'] = array('notin',$jasrrr);
    	}
    	
    	$jairrr = $jai -> where($stats) -> select();
    	$this->assign('jairrr',$jairrr);
    	
    	//var_dump($jairrr);
    	
    	
    	$this->display();
    }
    public function jractups(){
    	$dwname = cookie('dwname');
    	
    	$stats['stats'] = 0;
    	$stats['selects'] = 0;
    	$jai = M('jractitem');
    	$jairr = $jai -> where($stats) -> field('actitemid') -> select();
    	foreach($jairr as &$value){
    		$jair[] = $value['actitemid'];
    	}
    	$jas = M('jractsum');
    	$where['date'] = date('Y-m-d');
    	$where['actitemid'] = array('in',$jair);
    	$where['jgh'] = $dwname['jgh'];
    	$jasrr = $jas -> where($where) -> select();
    	$this->assign('data',$jasrr);
    	
    	$jv = M('jrvillage');
    	$village['dwname'] = $dwname['jgh'];
    	$jvrr = $jv -> where($village) -> select();
    	
    	
    	
    	$this->assign('jvrr',$jvrr);
    	//var_dump($where);
    	$this->display();
    }
    public function jractupsuc(){
    	$dwname = cookie('dwname');
    	$jas = M('jractsum');
    	$where['shenhe'] = 0;
    	$where['date'] = date('Y-m-d');
    	$where['jgh'] = $dwname['jgh'];
    	$where['beizhu'] = $dwname['user'];
    	foreach($_POST as $key => $value){
    		//var_dump($key,$value);
    		if($value == null){
    			
    		}else{
    			$where['actpoint'] = $value;
    			$where['actitemid'] = $key;
//  			$actpoint[] = $value;
//  			$actitem[] = $key;
				$jasrr = $jas -> add($where);
    		}
    	}
    	if($jasrr > 0){
    		$this->success('添加行为量成功,请继续');
    	}else{
    		$this->error('添加失败,请检查数据');
    	}
    }
    public function jractupsucs(){
    	
    	foreach($_POST as $key => $value){
    		if($value == null){
    				
    		}else{
    			$actitemid[] = $key;
    		}
    	}
    	//var_dump($actitemid);
    	if(!$actitemid == null){
    		$jas = M('jractsum');
    		$jasr['actitemid'] = array('in',$actitemid);
    		$dwname = cookie('dwname');
    		$jasr['jgh'] = $dwname['jgh'];
    		$jasr['date'] = date('Y-m-d');
    		$jasrr = $jas -> where($jasr) -> count();
    		//var_dump($jasrr);
    		if($jasrr > 0){
    			$this->error('数据已上报过,请核对后再报');
    		}else{
    			
    			foreach($_POST as $key => $value){
    				//$actitemid = $key;
    				if($value == null){
    				
    				}else{
    					$where['date'] = date('Y-m-d');
	    				$where['actitemid'] = $key;
	    				$where['actpoint'] = $value;
	    				$where['jgh'] = $dwname['jgh'];
	    				$where['beizhu'] = $dwname['user'];
	    				$where['shenhe'] = 0;
	    				$jasadd = $jas -> add($where);
    				}
    			}
    			if($jasadd > 0){
    				$this->success('数据上报成功,请继续');
    			}else{
    				$this->error('上报失败,请检查数据');
    			}
    		}
    	}else{
    		$this->error('请检查上报数据');
    	}
    }
    public function jractupmodify(){
    	$dwname = cookie('dwname');
    	$where['jgh'] = $dwname['jgh'];
    	$where['date'] = date('Y-m-d');
    	$where['shenhe'] = 0;
    	
    	$stats['selects'] = 1;
    	$jai = M('jractitem');
    	$jairr = $jai -> field('actitemid') -> where('selects = 1') -> select();
    	foreach($jairr as &$value){
    		$actitemid[] = $value['actitemid'];
    	}
    	$where['actitemid'] = array('in',$actitemid);
    	$jas = M('jractsum');
    	$data = $jas -> where($where) -> select();
    	//var_dump($jasrr);
    	
    	$data = $this->jract($data);
    	$this->assign('data',$data);
    	
    	$where['shenhe'] = 0;
    	
    	$stats['selects'] = 0;
    	//$jai = M('jractitem');
    	$jairrr = $jai -> field('actitemid') -> where('selects = 0') -> select();
    	foreach($jairrr as &$value){
    		$actitemids[] = $value['actitemid'];
    	}
    	$where['actitemid'] = array('in',$actitemids);
    	$jas = M('jractsum');
    	$data = $jas -> where($where) -> select();
    	//var_dump($jasrr);
    	
    	$datas = $this->jract($data);
    	$this->assign('datas',$datas);
    	
    	//var_dump($data);
    	$this->display();
    }
    public function jractupmodifysuc(){
    	if($_POST == null){
    		$this->error('修改失败,请检查数据');
    	}
    	$jas = M('jractsum');
    	//var_dump($_POST);
    	foreach($_POST as $key => $value){
    		//$where['date'] = date('Y-m-d');
    		$where['actpoint'] = $value;
    		$jasrr = $jas -> where("actsumid = '$key'") -> save($where);
    		
    		$jasr = $jasr + $jasrr;
    	}
    	if($jasr > 0){
    		$this->success('修改成功,请继续');
    	}else{
    		$this->error('修改失败,请检查数据');
    	}
    }
    public function jractupmodifys(){
    	$dwname = cookie('dwname');
    	$jgh = $dwname['jgh'];
    	$where['jgh'] = $dwname['jgh'];
    	$where['date'] = date('Y-m-d');
    	$where['shenhe'] = 0;
    	
    	$stats['selects'] = 0;
    	$jai = M('jractitem');
    	$jairr = $jai -> field('actitemid') -> where('selects = 0') -> select();
    	foreach($jairr as &$value){
    		$actitemid[] = $value['actitemid'];
    	}
    	$where['actitemid'] = array('in',$actitemid);
    	$jas = M('jractsum');
    	$data = $jas -> where($where) -> select();
    	//var_dump($jasrr);
    	$jv = M('jrvillage');
    	$jvrr = $jv -> where("dwname = '$jgh'") -> select();
    	$this->assign('jvrr',$jvrr);
    	$data = $this->jract($data);
    	foreach($data as &$value){
    		
    		foreach($jvrr as &$valuejv){
    			
    			if($value['actitemid'] == 1 and $value['actpoint'] == $valuejv['villageid']){
    				
    				$value['actpoints'] = $valuejv['village'];
    			}
    		}
    	}
    	$this->assign('data',$data);
    	//var_dump($data);
    	$this->display();
    }
    public function jractupmodifysucs(){
    	var_dump($_POST);
    	$jas = M('jractsum');
    	//var_dump($_POST);
    	foreach($_POST as $key => $value){
    		//$where['date'] = date('Y-m-d');
    		$where['actpoint'] = $value;
    		$jasrr = $jas -> where("actsumid = '$key'") -> save($where);
    		
    		$jasr = $jasr + $jasrr;
    	}
    	if($jasr > 0){
    		$this->success('修改成功,请继续');
    	}else{
    		$this->error('修改失败,请检查数据');
    	}
    }
    public function jractupsh(){
    	$dwname = cookie('dwname');
    	$where['jgh'] = $dwname['jgh'];
    	$where['date'] = date('Y-m-d');
    	$where['shenhe'] = 0;
    	$jgh = $dwname['jgh'];
    	$jas = M('jractsum');
    	$data = $jas -> where($where) -> select();
    	$data = $this->jract($data);
    	$jv = M('jrvillage');
    	$jvrr = $jv -> where("dwname = '$jgh'") -> select();
    	$this->assign('jvrr',$jvrr);
    	$data = $this->jract($data);
    	foreach($data as &$value){
    		
    		foreach($jvrr as &$valuejv){
    			
    			if($value['actitemid'] == 1 and $value['actpoint'] == $valuejv['villageid']){
    				
    				$value['actpoint'] = $valuejv['village'];
    			}
    		}
    	}
    	//var_dump($data);
    	$this->assign('data',$data);
    	$this->display();
    }
    public function jractupshsuc(){
    	$dwname = cookie('dwname');
    	$where['jgh'] = $dwname['jgh'];
    	$where['date'] = date('Y-m-d');
    	$where['shenhe'] = 0;
    	$jgh = $dwname['jgh'];
    	$jas = M('jractsum');
    	$data = $jas -> where($where) -> field('actsumid,shenhe') -> select();
    	//var_dump($data);
    	$exp['shenhe'] = 1;
    	foreach($data as $value){
    		$actsumid = $value['actsumid'];
    		$jasrr = $jas -> where("actsumid = '$actsumid'") -> save($exp);
    	}
    	if($jasrr > 0){
    		$this->success('批量审核完成,请继续');
    	}else{
    		$this->error('审核不成功,请检查数据');
    	}
    }
    public function jractupsearchs(){
    	//var_dump($_POST);
    	$jas = M('jractsum');
    	$where['date'] = $_POST['date'];
    	$where['shenhe'] = 1;
    	$dwname = cookie('dwname');
    	$where['jgh'] = $dwname['jgh'];
    	$data = $jas -> where($where) -> field('actitemid,actpoint') -> select();
    	$data = $this->jract($data);
    	//var_dump($data);
    	$this->assign('data',$data);
    	$this->display();
    }
    public function jractiveup(){
    	$activecontentid = $_GET['activecontentid'];
    	$dwname = cookie('dwname');
    	$javc = M('jractivecontent');
    	$javcrr = $javc -> where("activecontentid = '$activecontentid'") -> select();
    	$this->assign('datas',$javcrr);
    	cookie('activecontentid',$javcrr[0]['activecontentid']);
    	$javs = M('jractivesum');
    	$wherejavs['jgh'] = $dwname['jgh'];
    	//var_dump($dwname);
    	$wherejavs['date'] = date('Y-m-d');
    	$javsrr = $javs -> where($wherejavs) -> field('activeitemid') -> select();
    	//var_dump($javsrr);
    	foreach($javsrr as &$value){
    		$activeitemid[] = $value['activeitemid'];
    	}
    	if(!$activeitemid == null){
    		$where['activeitemid'] = array('notin',$activeitemid);
    	}
    	$where['activecontentid'] = $activecontentid;
    	$where['stats'] = 0;
    	
    	$javi = M('jractiveitem');
    	$javirr = $javi -> where($where) -> select();
    	$this->assign('data',$javirr);
    	//var_dump($javcrr);
    	
    	$this->display();
    }
    public function jractiveupsuc(){
    	$dwname = cookie('dwname');
    	$activecontentid = cookie('activecontentid');
    	foreach($_POST as $key => $value){
    		$data[] = array(
    		'jgh' => $dwname['jgh'],
    		'activecontentid' => $activecontentid,
    		
    		'date' => date('Y-m-d'),
    		'beizhu' => $dwname['user'],
    		'shenhe' => 0,
    		'activeitemid' => $key,
    		'point' => $value,
    		);
    	}
    	$javs = M('jractivesum');
    	$javsrr = $javs -> addall($data);
    	if($javsrr > 0){
    		$this->success('活动添加成功,请继续');
    	}else{
    		$this->error('活动添加失败,请检查数据');
    	}
    }
    public function jractiveupmodify(){
    	$activecontentid = $_GET['activecontentid'];
    	$dwname = cookie('dwname');
    	$javc = M('jractivecontent');
    	$javcrr = $javc -> where("activecontentid = '$activecontentid'") -> select();
    	$this->assign('datas',$javcrr);
    	$dwname = cookie('dwname');
    	$where['activecontentid'] = $activecontentid;
    	$where['jgh'] = $dwname['jgh'];
    	$where['date'] = date('Y-m-d');
    	$where['shenhe'] = 0;
    	$javs = M('jractivesum');
    	$data = $javs -> where($where) -> select();
    	$data = $this->jractive($data);
    	$this->assign('data',$data);
    	//var_dump($data);
    	$this->display();
    }
    public function jractiveupmodifysuc(){
    	$javs = M('jractivesum');
    	foreach($_POST as $key => $value){
    		$where['point'] = $value;
    		$javsrr = $javs -> where("activesumid = '$key'") -> save($where);
    		$count = $count + $javsrr;
    	}
    	if($count > 0){
    		$this->success('活动数据修改成功,请继续');
    	}else{
    		$this->error('活动修改失败,请检查数据');
    	}
    }
    public function jractiveupsh(){
    	$activecontentid = $_GET['activecontentid'];
    	$dwname = cookie('dwname');
    	$javc = M('jractivecontent');
    	$javcrr = $javc -> where("activecontentid = '$activecontentid'") -> select();
    	cookie('activecontentid',$javcrr[0]['activecontentid']);
    	$this->assign('datas',$javcrr);
    	$dwname = cookie('dwname');
    	$where['activecontentid'] = $activecontentid;
    	$where['jgh'] = $dwname['jgh'];
    	$where['date'] = date('Y-m-d');
    	$where['shenhe'] = 0;
    	$javs = M('jractivesum');
    	$data = $javs -> where($where) -> select();
    	$data = $this->jractive($data);
    	$this->assign('data',$data);
    	//var_dump($data);
    	$this->display();
    }
    public function jractiveupshsuc(){
    	$activecontentid = cookie('activecontentid');
    	$dwname = cookie('dwname');
    	$where['activecontentid'] = $activecontentid;
    	$where['jgh'] = $dwname['jgh'];
    	$where['date'] = date('Y-m-d');
    	$where['shenhe'] = 0;
    	$javs = M('jractivesum');
    	$data = $javs -> where($where) -> select();
    	foreach($data as &$value){
    		$shenhe['activesumid'] = $value['activesumid'];
    		$shenhes['shenhe'] = 1;
    		$javsrr = $javs -> where($shenhe) -> save($shenhes);
    		$count = $count + $javsrr;
    	}
    	//var_dump($data,$count,$where);
    	if($count > 0){
    		$this->success('活动审核成功,请继续');
    	}else{
    		$this->error('活动审核失败,请检查数据');
    	}
    }
    
    
    
    
    public function etccustinfo($data){
		$jd = M('jrdanwei');
		$jdr = $jd -> select();

		foreach($data as &$value){

			foreach($jdr as &$val){
				
				if($value['jgh'] == $val['jgh']){
					$value['dwname'] = $val['dwname'];
				}
				if($value['refereedwname'] == $val['jgh']){
					$value['refereedwnames'] = $val['dwname'];
				}
				if($value['signdwname'] == $val['jgh']){
					$value['signdwnames'] = $val['dwname'];
				}
			}
		}
		return $data;
	}
    
    public function whitecustinfo($data){
    	$jv = M('jrvillage');
    	$jvrr = $jv -> select();
    	
    	foreach($data as &$value){
    		
    		foreach($jvrr as &$val){
    			
    			if($value['village'] == $val['villageid']){
    				
    				$value['villages'] = $val['village'];
    				break;
    			}
    		}
    	}
    	
    	$js = M('jrsource');
    	$jsrr = $js -> select();
    	
    	foreach($data as &$value){
    		
    		foreach($jsrr as &$val){
    			
    			if($value['source'] == $val['sourceid']){
    				
    				$value['sources'] = $val['source'];
    				break;
    			}
    		}
    	}
    	
    	$jm = M('jrmaintenance');
    	$jmrr = $jm -> select();
    	
    	foreach($data as &$value){
    		
    		foreach($jmrr as &$val){
    			
    			if($value['maintenance'] == $val['maintenanceid']){
    				
    				$value['maintenances'] = $val['maintenance'];
    				break;
    			}
    		}
    	}
    	
    	$jp = M('jrproduct');
    	$jprr = $jp -> select();
    	
    	foreach($data as &$value){
    		
    		foreach($jprr as &$val){
    			
    			if($value['product'] == $val['productid']){
    				
    				$value['products'] = $val['product'];
    				break;
    			}
    		}
    	}
    	
    	return $data;
    }
    public function whitecustadd(){
    	$dwname = cookie('dwname');
    	$where['dwname'] = $dwname['jgh'];
    	
    	$jv = M('jrvillage');
    	$jvrr = $jv -> where($where) -> select();
    	
    	$this->assign('jvrr',$jvrr);
    	
    	$stats['stats'] = 0;
    	
    	$js = M('jrsource');
    	$jsrr = $js -> where($stats) -> select();
    	
    	$this->assign('jsrr',$jsrr);
    	
    	$jm = M('jrmaintenance');
    	$jmrr = $jm -> where($stats) -> select();
    	
    	$this->assign('jmrr',$jmrr);
    	
    	$jp = M('jrproduct');
    	$jprr = $jp -> where($stats) -> select();
    	
    	$this->assign('jprr',$jprr);
    	
    	$wherejw['jgh'] = $dwname['jgh'];
    	$wherejw['stats'] = 0;
    	$jw = M('jrwhitecust');
    	$jwrr = $jw -> where($wherejw) -> field('sfz') -> select();
    	
    	foreach($jwrr as &$value){
    		
    		$sfz[] = $value['sfz'];
    	}
    	$sfz = json_encode($sfz);
    	
    	$this->assign('sfz',$sfz);
    	
    	$this->display();
    }
    public function whitecustaddsuc(){
    	$dwname = cookie('dwname');
    	$_POST['jgh'] = $dwname['jgh'];
    	$_POST['stats'] = 0;
    	$_POST['date'] = date('Y-m-d');
    	$_POST['alterdate'] = date('Y-m-d');
    	
    	$jgh = $dwname['jgh'];
    	
    	$jd = M('jrdanwei');
    	$jdr = $jd -> where("jgh = '$jgh'") -> find();
    	$_POST['dwname'] = $jdr['dwnames'];
    	
    	
    	$jw = M('jrwhitecust');
    	$jwrr = $jw -> add($_POST);
    	
    	if($jwrr > 0){
    		$this->success('白名单客户添加成功，请继续');
    	}else{
    		$this->error('白名单客户添加失败，请检查数据');
    	}
    }
    public function whitecustmodify(){
    	$dwname = cookie('dwname');
    	$where['dwname'] = $dwname['jgh'];
    	$where['sfz'] = $_GET['sfz'];
    	
    	$jw = M('jrwhitecust');
    	$jwrr = $jw -> where($where) -> select();
    	
    	$jv = M('jrvillage');
    	$jvrr = $jv -> where($where) -> select();
    	
    	$this->assign('jvrr',$jvrr);
    	
    	$stats['stats'] = 0;
    	
    	$js = M('jrsource');
    	$jsrr = $js -> where($stats) -> select();
    	
    	$this->assign('jsrr',$jsrr);
    	
    	$jm = M('jrmaintenance');
    	$jmrr = $jm -> where($stats) -> select();
    	
    	$this->assign('jmrr',$jmrr);
    	
    	$jp = M('jrproduct');
    	$jprr = $jp -> where($stats) -> select();
    	
    	$this->assign('jprr',$jprr);
    	
    	$jwrr = $this->whitecustinfo($jwrr);
    	
    	$this->assign('jwrr',$jwrr);
    	
    	$this->display();
    }
    public function whitecustmodifysuc(){
    	$jw = M('jrwhitecust');
    	
    	$whitecustid = $_POST['whitecustid'];
    	$_POST['alterdate'] = date('Y-m-d');
    	$jwrr = $jw -> where("whitecustid = '$whitecustid'") -> save($_POST);
    	
    	if($jwrr > 0){
    		
    		$this->success('白名单客户修改成功，请继续');
    	}else{
    		$this->error('白名单修改失败，请检查数据');
    	}
    	
    }
    
    public function whitecustsearch(){
    	$dwname = cookie('dwname');
    	$where['jgh'] = $dwname['jgh'];
    	$where['stats'] = 0;
    	
    	$jw = M('jrwhitecust');
    	$jwrr = $jw -> where($where) -> select();
    	
    	$jwrr = $this->whitecustinfo($jwrr);
    	$this->assign('jwrr',$jwrr);
    	
    	$this->display();
	}
	public function whitecustinfoperspt(){
		$dwname = cookie('dwname');

		$jgh = $dwname['jgh'];

		$jd = M('jrdanwei');
		$jdr = $jd -> where("jiagou = 'A1'") -> select();
		
		$User = D('');
    	$datas = $User->query("select hr_jraccountinfo.jgh,hr_jraccountinfo.sfz,hr_jraccountinfo.money,hr_jraccountinfo.dwname from hr_jraccountinfo inner join hr_jrwhitecust on hr_jraccountinfo.jgh = hr_jrwhitecust.jgh and hr_jraccountinfo.sfz = hr_jrwhitecust.sfz where hr_jrwhitecust.jgh = '$jgh'");
    	
    	$datab = $User -> query("select hr_jrclientassetsold.sfz,hr_jrclientassetsold.jgh,hr_jrclientassetsold.zyue as zyueb,hr_jrclientassetsold.huoqi as huoqib,hr_jrclientassetsold.dingqi as dingqib from hr_jrwhitecust inner join hr_jrclientassetsold on hr_jrclientassetsold.sfz = hr_jrwhitecust.sfz and hr_jrclientassetsold.jgh = hr_jrwhitecust.dwname where hr_jrwhitecust.jgh = '$jgh' ");
    	$datao = $User -> query("select hr_jrclientassets.sfz,hr_jrclientassets.jgh,hr_jrclientassets.zyue as zyueo,hr_jrclientassets.huoqi as huoqio,hr_jrclientassets.dingqi as dingqio from hr_jrwhitecust inner join hr_jrclientassets on hr_jrclientassets.sfz = hr_jrwhitecust.sfz and hr_jrclientassets.jgh = hr_jrwhitecust.dwname where hr_jrwhitecust.jgh = '$jgh'");
		// var_dump($datas,$datao,$datab);
		$where['jgh'] = $jgh;
		$where['stats'] = 0;
		$jw = M('jrwhitecust');
		$jwrr = $jw -> where($where) -> select();

		foreach($datab as &$value){

			foreach($datao as &$val){

				if($value['sfz'] == $val['sfz']){

					$data_cl[] = array(

						'sfz' => $value['sfz'],
						'jgh' => $value['jgh'],
						'zyue' => $val['zyueo'] - $value['zyueb'],
						'dingqi' => $val['dingqio'] - $value['dingqib'],
						'huoqi' => $val['huoqio'] - $value['huoqib'],
					);

				}
			}
		}
		foreach($data_cl as &$value){

			foreach($datas as &$val){

				if($value['sfz'] == $val['sfz']){

					$value['money'] = $value['money'] + $val['money'];
					// $value['dwname'] = $val['jgh'];

				}
			}
		}

		foreach($jwrr as &$value){

			foreach($data_cl as &$val){

				if($value['sfz'] == $val['sfz']){

					$data_cust[] = array(

						'custname' => $value['custname'],
						'phone' => $value['phone'],
						'sfz' => $value['sfz'],
						'address' => $value['address'],
						'jgh' => $value['jgh'],
						'zyue' => $val['zyue'],
						'dingqi' => $val['dingqi'],
						'huoqi' => $val['huoqi'],
						'money' => $val['money'],
					);
				}
			}
		}

		foreach($data_cust as &$value){

			foreach($jdr as &$val){

				if($value['jgh'] == $val['jgh']){

					$value['dwname'] = $val['dwname'];
					break;
				}
			}
		}
		$this->assign('data',$data_cust);
		$this->display();
		// var_dump($data_cl);
		
	}


    public function etccustadd(){
		$je = M('jretccust');
		$where['stats'] = 0;
		$count = $je -> count();
		if($count == 0){
			
		}else{
			$jer = $je -> field('sfz,custname,phone,carcard,carcustname,carsfz,card') -> where($where) -> select();
		}
		
		foreach($jer as &$value){
    		
    		$sfz[] = array(
				'sfz' => $value['sfz'],
				'custname' => $value['custname'],
				'phone' => $value['phone'],
				'carcard' => $value['carcard'],
			);
    	}
		$sfz = json_encode($sfz);
		$this->assign('sfz',$sfz);

		$jef = M('jretcreferee');
		$jefr = $jef -> where($where) -> field('carcard,gonghao,referee,refereedwname') -> select();
		// var_dump($sfz);
		foreach($jefr as &$value){
			$carcard[] = array(
				'carcard' => $value['carcard'],
				'gonghao' => $value['gonghao'],
				'referee' => $value['referee'],
				'refereedwname' => $value['refereedwname'],
			);
		}
		$carcard = json_encode($carcard);
		$this->assign('carcard',$carcard);

		$jd = M('jrdanwei');
		$jdr = $jd -> where("jiagou = 'A1'") -> select();

		$jdrr = $jd -> select();

		$this->assign('jdr',$jdr);
		$this->assign('jdrr',$jdrr);
		// var_dump($carcard);
		$this->display();
	}
	public function etccustaddsuc(){
		$dwname = cookie('dwname');
		$_POST['carcard'] =  strtoupper($_POST['carcard']);
		$_POST['jgh'] = $dwname['jgh'];
		$_POST['stats'] = 0;
		$_POST['signdwname'] = $dwname['jgh'];
		$je = M('jretccust');

		$jer = $je -> add($_POST);
		// var_dump($_POST);
		if($jer > 0){
			$this->success('ETC客户添加成功，请继续');
		}else{
			$this->error('ETC客户添加失败，请检查数据');
		}
	}
    public function etccustrefereeadd(){
		$je = M('jretccust');
		$where['stats'] = 0;

		$count = $je -> where($where) -> count();

		if($count == 0){

		}else{
			$jer = $je -> where($where) -> field('carcard') -> select();
		}

		foreach($jer as &$value){
    		
    		$carcard[] = $value['carcard'];
    	}
		$carcard = json_encode($carcard);
		$this->assign('carcard',$carcard);

		$jef = M('jretcreferee');
		$countre = $jef -> where($where) -> count();
		if($countre == 0){

		}else{
			$jefr = $jef -> where($where) -> field('carcard') -> select();
		}
		foreach($jefr as &$value){

			$carcardre[] = $value['carcard'];
		}
		$carcardre = json_encode($carcardre);
		$this->assign('carcardre',$carcardre);
		// var_dump($carcard);
		$this->display();
	}
	public function etccustrefereeaddsuc(){
		$dwname = cookie('dwname');
		$_POST['carcard'] = strtoupper($_POST['carcard']);
		$_POST['stats'] = 0;
		$_POST['gonghao'] = $dwname['gonghao'];
		$_POST['referee'] = $dwname['user'];
		$_POST['refereedwname'] = $dwname['jgh'];
		$_POST['date'] = date('Y-m-d');
		$jef = M('jretcreferee');
		$jefr = $jef -> add($_POST);

		if($jefr > 0){
			$this->success('引荐客户添加成功，请继续');
		}else{
			$this->error('引荐客户添加失败，请检查数据');
		}
		// var_dump($_POST,$dwname);
	}
	public function etccustsearchs(){
		$suc = $_GET['suc'];
		$je = M('jretccust');
		$where['stats'] = 0;
		// var_dump($suc);
		if($suc == 1){
			$date = date('Y').'-01'.'-01';
			$dates = date('Y-m-d');
		}else{
			$date = substr($_POST['date_date'],0,10);
			$dates = substr($_POST['date_date'],-10,10);
		}
		$where['date'] = array( array('egt',$date) , array('elt',$dates) , 'and' );
		// var_dump($where);
		$jer = $je -> where($where) -> select();
		$dwname = cookie('dwname');
		$jgh = $dwname['jgh'];
		$this->assign('jgh',$jgh);
		$jer = $this->etccustinfo($jer);
		$this->assign('data',$jer);
		$this->display();
		
	}
    public function etccustmodify(){
		// var_dump($_GET);
		$etccustid = $_GET['etccustid'];
		$je = M('jretccust');
		$jer = $je -> where("etccustid = '$etccustid'") -> select();
		$jer = $this->etccustinfo($jer);
		$this->assign('data',$jer);

		$jd = M('jrdanwei');

		$jdrr = $jd -> select();

		$this->assign('jdrr',$jdrr);

		$this->display();
	}
    public function etccustmodifysuc(){
		$etccustid = $_POST['etccustid'];

		$je = M('jretccust');
		$jer = $je -> where("etccustid = '$etccustid'") -> save($_POST);

		if($jer > 0){
			$this->success('ETC客户信息修改成功，请继续',U('home/admin/etccustsearchs/suc/1'));
		}else{
			$this->error('ETC客户信息修改失败，请检查数据');
		}
	}
    public function etccustrefereesearchs(){
		$jef = M('jretcreferee');
		$je = M('jretccust');
		$dwname = cookie('dwname');
		$where['gongghao'] = $dwname['gonghao'];
		$date = substr($_POST['date_date'],0,10);
		$dates = substr($_POST['date_date'],-10,10);
		$where['date'] = array( array('egt',$date) , array('elt',$dates) , 'and' );
		$where['stats'] = 0;
		$jefr = $jef -> where($where) -> select();

		$User = D('');
    	
    	$datas = $User->query("select hr_jretcreferee.carcard,hr_jretcreferee.carphone,hr_jretcreferee.carcustname,hr_jretcreferee.carsfz,hr_jretcreferee.referee,hr_jretcreferee.date,hr_jretcreferee.stats from hr_jretcreferee inner join hr_jretccust on hr_jretcreferee.carcard = hr_jretccust.carcard and hr_jretcreferee.stats = 0 and hr_jretccust.stats = 0");
		foreach($jefr as &$value){
			$value['status'] = '未签约';
			foreach($datas as &$val){

				if($value['carcard'] == $val['carcard']){
					
					$value['status'] = 已签约;
					$value['stats'] = 1;
					break;
				}
			}
		}
		
		

		// var_dump($datas);
		$this->assign('data',$jefr);
		$this->display();
	}
    public function etccustrefereemodify(){
		$etcrefereeid = $_GET['etcrefereeid'];
		$jef = M('jretcreferee');

		$jefr = $jef -> where("etcrefereeid = '$etcrefereeid'") -> select();
		// var_dump($jefr);
		$this->assign('data',$jefr);
		$this->display();
	}
	public function etccustrefereemodifysuc(){
		$jef = M('jretcreferee');

		$etcrefereeid = $_POST['etcrefereeid'];

		$jefr = $jef -> where("etcrefereeid = '$etcrefereeid'") -> save($_POST);

		if($jefr > 0){
			$this->success('ETC引荐客户修改成功，请继续');
		}else{
			$this->error('ETC引荐客户修改失败，请检查数据');
		}
	}
	public function etccustdelete(){
		$je = M('jretccust');
		$where['stats'] = 0;
		$jer = $je -> where($where) -> field('etccustid,carcard') -> select();

		$this->assign('carcard',$jer);
		$this->display();
	}
	public function etccustdeletes(){
		$where['stats'] = 0;
		$where['carcard'] = $_POST['carcard'];

		$je = M('jretccust');
		$jer = $je -> where($where) -> select();

		$jer = $this->etccustinfo($jer);
		$this->assign('data',$jer);
		$this->display();
	}
	public function etccustdeletesuc(){
		$stats['stats'] = 1;

		$etccustid = $_GET['etccustid'];

		$je = M('jretccust');

		$jer = $je -> where("etccustid = '$etccustid'") -> save($stats);

		if($jer > 0){
			$this->success('ETC客户解约成功，请继续',U('admin/etccustdelete'));
		}else{
			$this->error('ETC客户解约失败，请检查数据');
		}
	}













    
    
    
    
    
    
    
    
    
    
    public function jryuecefan(){
    	$dwname = cookie('dwname');
    	
    	$jrps = M('jrpointsum');
    	$whereps['date'] = date('Y-m-d');
    	$whereps['gonghao'] = $dwname['gonghao'];
    	$whereps['pointitemid'] = 1;
    	$jrpsrr = $jrps -> field('pointcontentid') -> where($where) -> select();
    	foreach($jrpsrr as &$value){
    		$pointcontentid[] = $value['pointcontentid'];
    	}
    	//var_dump($pointcontentid);
    	$jrpc = M('jrpointcontent');
    	
    	$where['pointitemid'] = 1;
    	$where['pointcontentid'] = array('notin',$pointcontentid);
    	$where['stats'] = 0;
    	$jrpcrr = $jrpc -> where($where) -> select();
    	$this->assign('data',$jrpcrr);
    	//var_dump($jrpcrr);
    	$this->display();
    }
    public function jryuecefansuc(){
    	$dwname = cookie('dwname');
    	$sum = $_POST;
    	foreach($sum as $key=>$value){
    		if(!$value == null){
    			$points[] = $key;
    			$point[] = array(
    			'jgh' => $dwname['jgh'],
    			'dwname' => $dwname['dwname'],
    			'zhiwu' => $dwname['zhiwu'],
    			'gongzhong' => $dwname['gongzhong'],
    			'persname' => $dwname['user'],
    			'gonghao' => $dwname['gonghao'],
    			'zhiwud' => $dwname['zhiwud'],
    			'pointcontentid' => $key,
    			'point' => $value,
    			
    			'date' => date('Y-m-d'),
    			'shenhe' => 0,
    			);
    		}
    	}
    	$where['date'] = date('Y-m-d');
    	$where['pointcontentid'] = array('in',$points);
    	$where['gonghao'] = $dwname['gonghao'];
    	$jrps = M('jrpointsum');
    	$count = $jrps -> where($where) -> count();
    	if($count >0){
    		$this->error('此员工已经添加过积分,若要再添加,请去修改界面');
    	}
    	//var_dump($points);
    	$jrpc = M('jrpointcontent');
    	$jrpcrr = $jrpc -> where('pointitemid = 1') -> select();
    	foreach($point as &$value){
    		
    		foreach($jrpcrr as &$valuejrpc){
    		
    			if($valuejrpc['pointcontentid'] == $value['pointcontentid']){
    				$value['sum'] = $value['point'] * $valuejrpc['score'];
    				$value['score'] = $valuejrpc['score'];
    				
    			}
    		}
    	}
    	$jrpsrr = $jrps -> addall($point);
    	if($jrpsrr > 0){
    		$this->success('员工积分添加成功,请继续');
    	}else{
    		$this->error('员工积分添加失败,请核对数据');
    	}
    }
    public function jryuecefanxg(){
    	$dwname = cookie('dwname');
    	$date[] = date('Y-m-d',mktime(0,0,0,date("m"),date("d")-1,date("Y")));
		$date[] = date('Y-m-d');
		$where['shenhe'] = 0;
		$where['date'] = array('in',$date);
		$where['pointitemid'] = 1;
    	$where['gonghao'] = $dwname['gonghao'];
    	//var_dump($where);
    	$jrps = M('jrpointsum');
    	$data = $jrps -> where($where) -> select();
    	$data = $this->jrpoint($data);
    	
    	//var_dump($data);
    	$this->assign('data',$data);
    	
    	$this->display();
    }
    public function jryuecefanxgsuc(){
    	var_dump($_POST);
    }
    public function jrdabaoxianjizhong(){
    	$jrpc = M('jrpointcontent');
    	$where['pointitemid'] = 2;
    	$where['stats'] = 0;
    	$jrpcrr = $jrpc -> where($where) -> select();
    	$this->assign('data',$jrpcrr);
    	//var_dump($jrpcrr);
    	$this->display();
    }
    public function jrdabaoxianjizhongsuc(){
    	$dwname = cookie('dwname');
    	//var_dump($_POST);
    	$sum = $_POST;
    	foreach($sum as $key=>$value){
    		if(!$value == null){
    			$point[] = array(
    			'gonghao' => $dwname['gonghao'],
    			'pointcontentid' => $key,
    			'point' => $value,
    			'data' => date('Y-m-d'),
    			);
    		}
    	}
    	$jrpc = M('jrpointcontent');
    	$jrpcrr = $jrpc -> where('pointitemid = 2') -> select();
    	foreach($point as &$value){
    		
    		foreach($jrpcrr as &$valuejrpc){
    		
    			if($valuejrpc['pointcontentid'] == $value['pointcontentid']){
    				$value['sum'] = $value['point'] * $valuejrpc['score'];
    			}
    		}
    	}
    	//var_dump($dwname);
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    public function zczdvaliddl(){
    	$jgh=cookie('name');
    	$User=D('');
    	$data=$User->query("select jr_zcpers.jgh,jr_zcpers.sfz,jr_zcpers.jghsfz,jr_zcpers.name,jr_zcpers.phone,sum(jr_zcpers.zyue) as sumzyue from jr_zcpers inner join jr_zcdingqi on jr_zcpers.jghsfz=jr_zcdingqi.jghsfz where jr_zcpers.jgh='$jgh' group by jr_zcpers.jgh,jr_zcpers.jghsfz,jr_zcpers.sfz,jr_zcpers.name,jr_zcpers.phone");
        //var_dump($pr);
        $d=M('danwei');
        $drr=$d->select();
        foreach($drr as &$valued){
        	foreach($data as &$value){
        		if($value['jgh']==$valued['jgh']){
        			$value['dwname']=$valued['dwname'];
        		}
        	}
        }
        
        import("Org.Util.PHPExcel");
        import("Org.Util.PHPExcel.IOFactory");
        import("Org.Util.PHPExcel.Worksheet.Drawing");
        import("Org.Util.PHPExcel.Writer.Excel2007");
        $objPHPExcel = new \PHPExcel();
        $objWriter = new \PHPExcel_Writer_Excel2007($objPHPExcel);

        $objActSheet = $objPHPExcel->getActiveSheet();
        
        // 水平居中（位置很重要，建议在最初始位置）
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('A')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('B')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('C')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('D')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('E')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('F')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                
        $objActSheet->setCellValue('A1', '机构单位');
        $objActSheet->setCellValue('B1', '机构号');
        $objActSheet->setCellValue('C1', '姓名');
        $objActSheet->setCellValue('D1', '定期余额');
        $objActSheet->setCellValue('E1', '电话');
        $objActSheet->setCellValue('F1', '身份证');
        
        foreach($data as $k=>$v){
            $k +=2;
            $objActSheet->setCellValue('A'.$k, $v['dwname']);
            $objActSheet->setCellValue('B'.$k, $v['jgh']);
            $objActSheet->setCellValue('C'.$k, $v['name']);    
            $objActSheet->setCellValue('D'.$k, $v['sumzyue']);
            $objActSheet->setCellValue('E'.$k, $v['phone']);
            $objActSheet->setCellValue('F'.$k, $v['sfz']."\t");
            
            $objActSheet->getRowDimension($k)->setRowHeight(18);
        }
        $fileName = $jgh.'转存自动转存名单';
        $date = date("Y-m-d",time());
        $fileName .= "_{$date}.xlsx";

        $fileName = iconv("utf-8", "gb2312", $fileName);
        $objPHPExcel->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=\"$fileName\"");
        header('Cache-Control: max-age=0');

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $sa=$objWriter->save('php://output'); //文件通过浏览器下载
        // END    
        $d=M('danwei');
        $drr=$d->where("jgh='$jgh'")->find();
        $save=$drr['zczdsave'];
        $where['zczdsave']=$save+1;
        $d->where("jgh='$jgh'")->save($where);
    }
    
}