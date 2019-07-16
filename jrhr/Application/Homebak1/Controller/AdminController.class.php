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
    public function jrpointupsearch(){
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