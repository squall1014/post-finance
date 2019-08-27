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
    		$this->assign('dwname',$dwname);
    		$this->assign('datem',$datem);
    	}
    }
    public function index(){
    	$dwname = cookie('dwname');
    	$gonghao['gonghao'] = $dwname['gonghao'];
    	$gonghao['date'] = date('Y-m-d');
    	$js = M('jrpointsum');
    	$jsr = $js -> where($gonghao) -> count();
    	$gonghao['shenhe'] = 1;
    	$gonghao['stats'] = 1;
    	$jsrr = $js -> where($gonghao) -> count();
    	
    	$yesterday['gonghao'] = $dwname['gonghao'];
    	$yesterday['date'] = date("Y-m-d",strtotime("-1 day"));
    	$yjsr = $js -> where($yesterday) -> count();
    	$yesterday['shenhe'] = 1;
    	$yesterday['stats'] = 1;
    	$yjsrr = $js -> where($yesterday) -> count();
    	
    	$this->assign('jsr',$jsr);
    	$this->assign('jsrr',$jsrr);
    	
    	$this->assign('yjsr',$yjsr);
    	$this->assign('yjsrr',$yjsrr);
    	

        $jgh = cookie('dwname');
        $where['jgh'] = $jgh['jgh'];
        $date = date('Y-m') . '-01';
        $dates = date('Y-m-d');
        $where['date'] = array( array('egt',$date) , array('elt',$dates) , 'and' );
        $jps = M('jrpointsum');
        $jpsrr = $jps -> field('dwname,zhiwu,persname,sum(sum) as sums') -> order('sums desc') -> where($where) -> group('dwname,zhiwu,persname') -> select();
		// var_dump($jpsrr,$date);
		$i = 1;
    	foreach($jpsrr as &$value){
			$value['pm'] = $i;
			$i = $i + 1;
		}
        $this->assign('jpsrr',$jpsrr);

        // echo phpinfo();
    	$this->display();
    }
    public function jrpointperstoday(){
    	$dwname = cookie('dwname');
//  	var_dump($dwname);
    	$gonghao['gonghao'] = $dwname['gonghao'];
    	$gonghao['date'] = date('Y-m-d');
    	$js = M('jrpointsum');
    	$jsr = $js -> where($gonghao) -> select();
    	$gonghao['shenhe'] = 1;
    	$gonghao['stats'] = 1;
		$jsrr = $js -> where($gonghao) -> select();
		
    	$jsr = $this->jrpoint($jsr);
    	$jsrr = $this->jrpoint($jsrr);
    	
    	$this->assign('jsr',$jsr);
    	$this->assign('jsrr',$jsrr);
		
		

    	$this->display();
    }
    public function jrpointpersyesterday(){
    	$dwname = cookie('dwname');
    	
    	$js = M('jrpointsum');
    	
    	$yesterday['gonghao'] = $dwname['gonghao'];
    	$yesterday['date'] = date("Y-m-d",strtotime("-1 day"));
    	$yjsr = $js -> where($yesterday) -> select();
    	$yesterday['shenhe'] = 1;
    	$yesterday['stats'] = 1;
    	$yjsrr = $js -> where($yesterday) -> select();
    	
    	$yjsr = $this->jrpoint($yjsr);
    	$yjsrr = $this -> jrpoint($yjsrr);
    	
    	$this->assign('yjsr',$yjsr);
    	$this->assign('yjsrr',$yjsrr);
//    	var_dump(cookie('dwname'));
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
    public function jrpointclass(){
    	$dwname = cookie('dwname');
    	
    	$jrpcl = M('jrpointclass');
    	$where['stats'] = 0;
    	$where['districtid'] = $dwname['districtid'];
    	$data = $jrpcl -> where($where) -> select();
    	$this->assign('data',$data);
    	$this->display();
    }
    public function jrpointup(){
    	$dwname = cookie('dwname');
    	$where['pointclassid'] = $_GET['pointclassid'];
    	$jrpi = M('jrpointitem');
    	$where['stats'] = 0;
    	$where['districtid'] = $dwname['districtid'];
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
    			'zhiwud' => $dwname['zhiwuid'],
    			'districtid' => $dwname['districtid'],
    			'district' => $dwname['district'],
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
    		$this->success('员工积分添加成功,请继续',U('Admin/jrpointclass'));
    		
    	}else{
    		$this->error('员工积分添加失败,请核对数据');
    	}
    }
    public function jrpointupmodify(){
		$dwname = cookie('dwname');
		$where['districtid'] = $dwname['districtid'];
		$jgh['dwnameid'] = $dwname['jgh'];
    	// $dateauth = M('dateauth');
    	// $dauth = $dateauth -> where($where) -> find();
		// $y = $dauth['dateauth'];
		
		$d = M('danwei');
		$drr = $d -> where($jgh) -> select();
		$y = $drr[0]['dateauth'];
    	for($i = $y-1; $i >= 0; $i--){
    		$date[]['date'] = date('Y-m-d',mktime(0,0,0,date("m"),date("d")-$i,date("Y")));
    	}
		// var_dump($dwname,$y);
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
    	$dwname = cookie('dwname');
    	$where['districtid'] = $dwname['districtid'];
    	$jgh['dwnameid'] = $dwname['jgh'];
		$d = M('danwei');
		$drr = $d -> where($jgh) -> select();
		$y = $drr[0]['dateauth'];
    	for($i = $y-1; $i >= 0; $i--){
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
    	$data = $jrps -> field('dwname,district,jgh,zhiwu,persname,gonghao,sum(sum) as sums,date') -> where($where) -> group('dwname,district,jgh,zhiwu,persname,gonghao,date') -> select();
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
		$point = $_POST['point'];
		$points = $_POST['points'];
		$score = $_POST['score'];
    	$jrps = M('jrpointsum');
    	foreach($pointsumid as $key => $val){
    		$exp['point'] = $points[$key];
    		$exp['sum'] = $points[$key] * $score[$key];
    		if($point[$key] == $points[$key]){
    			
    			$exp['stats'] = null;
    			
    		}else{
    			
    			$exp['stats'] = 1;
    			
    		}
    		
    		$jrpsrr = $jrps -> where("pointsumid = '$val'") -> save($exp);
//			var_dump($exp);
//  		var_dump($val);
    	}
    	if($jrpsrr > 0){
    		$this->success('积分审核成功,请继续',U('Admin/jrpointupsh'));
    	}else{
    		$this->error('积分审核失败,请检查数据');
    	}
    }
    public function jrperspointups(){
    	var_dump($_GET,$_POST);
    }
    public function jrperspointup(){
    	$date = $_GET['date'];
    	$gonghao = $_GET['gonghao'];
    	$where['date'] = $date;
    	$where['gonghao'] = $gonghao;
    	$where['shenhe'] = 0;
    	$jrps = M('jrpointsum');
    	$data = $jrps -> field('pointsumid,district,dwname,zhiwu,persname,gonghao,pointcontentid,point,score,sum,date') -> where($where) -> select();
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
    	$data = $jrps -> where($where) -> field('dwname,district,zhiwu,persname,score,sum,point,pointcontentid') -> select();
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
    	$jpsrr = $jps -> where($where) -> field('dwname,district,persname,zhiwu,gongzhong,pointcontentid,score,sum(point) as points,sum(sum) as sums') -> group('persname,district,zhiwu,gongzhong,pointcontentid,dwname,score') -> select();
    	//
    	$jpsrr = $this->jrpoint($jpsrr);
    	$this->assign('data',$jpsrr);
    	$this->display();
    }
    public function jrpointdwsearchs(){
    	$date = substr($_POST['date_date'],0,10);
    	$dates = substr($_POST['date_date'],-10,10);
    	$where['date'] = array( array('egt',$date) , array('elt',$dates) , 'and' );
    	cookie('date',$date);
    	cookie('dates',$dates);
    	$dwname = cookie('dwname');
    	$where['jgh'] = $dwname['jgh'];
    	$where['shenhe'] = 1;
    	$jrps = M('jrpointsum');
    	
    	$data = $jrps -> where($where) -> field('jgh,gonghao,zhiwu,persname,sum(sum) as sums') -> group('jgh,zhiwu,gonghao,persname') -> select();
    	$sum = $jrps -> where($where) -> sum('sum');
//  	var_dump($date,$dates,$dwname,$data);
		$this->assign('data',$data);
		$this->assign('sum',$sum);
		$this->display();
    }
    public function jrpointperssearchs(){
//  	var_dump($_GET);
    	$date = cookie('date');
		$dates = cookie('dates');
		
		$where['date'] = array( array('egt',$date) , array('elt',$dates) , 'and' );
		$where['gonghao'] = $_GET['gonghao'];
		$where['shenhe'] = 1;
		$jrps = M('jrpointsum');
		
		$data = $jrps -> where($where) -> field('jgh,dwname,gonghao,zhiwu,persname,date,sum(point) as points,sum(sum) as sums') -> group('jgh,dwname,zhiwu,gonghao,persname,date') -> select();
		$sumpoint = $jrps -> where($where) -> sum('point');
		$sum = $jrps -> where($where) -> sum('sum');

//		var_dump($sumpoint);
		$this->assign('data',$data);
		$this->assign('sumpoint',$sumpoint);
		$this->assign('sum',$sum);
		$this->display();
    }
    public function jrpointperssearch(){
    	$where['gonghao'] = $_GET['gonghao'];
    	$where['date'] = $_GET['date'];
    	$where['shenhe'] = 1;
    	$jrps = M('jrpointsum');
    	$data = $jrps -> where($where) -> select();
    	
    	$sumpoint = $jrps -> where($where) -> sum('point');
    	$sum = $jrps -> where($where) -> sum('sum');
    	
    	$data = $this->jrpoint($data);
    	$this->assign('data',$data);
    	
    	$this->assign('sumpoint',$sumpoint);
    	$this->assign('sum',$sum);
    	$this->display();
	}
	public function jrpointdwicdate(){
    	$dwname = cookie('dwname');
    	$where['districtid'] = $dwname['districtid'];
    	$where['stats'] = 0;
    	$jpi = M('jrpointitem');
    	$jpirr = $jpi -> where($where) -> select();
    	
    	$jpc = M('jrpointcontent');
    	$jpcrr = $jpc -> where($where) -> select();
    	
    	foreach($jpirr as &$valuejpi){
    		
    		foreach($jpcrr as &$valuejpc){
    			
    			if($valuejpi['pointitemid'] == $valuejpc['pointitemid']){
    				
    				$valuejpi[$valuejpc['pointcontentid']]['pointcontentid'] = $valuejpc['pointcontentid'];
    				$valuejpi[$valuejpc['pointcontentid']]['content'] = $valuejpc['content'];
    				$valuejpi[$valuejpc['pointcontentid']]['pointitemid'] = $valuejpi['pointitemid'];
    			}
    		}
    	}
    	$this->assign('data',$jpirr);
    	$this->assign('datas',$jpcrr);
		// var_dump($dwname,$jpcrr);
		
    	$this->display();
    }
	public function jrpointdwicdates(){
    	$dwname = cookie('dwname');
    	
    	$date = substr($_POST['date_date'],0,10);
    	$dates = substr($_POST['date_date'],-10,10);
//  	$where['shenhe'] = 1;
    	$where['date'] = array( array('egt',$date) , array('elt',$dates) , 'and' );
    	
//  	foreach($_POST['item'] as $value){
//  		$item[] = $value;
//  	}
//  	
//  	foreach($_POST['content'] as $value){
//  		$content[] =$value;
//  	}
//  	
//  	var_dump($item,$content);
    	
    	foreach($_POST['item'] as $value){
    		$item[] = $value;
    	}
    	$stats['stats'] = 0;
    	$jps = M('jrpointsum');
    	$jpi = M('jrpointitem');
    	if($item == null){
    		
    	}else{
	    	$jpir['pointitemid'] = array('in',$item);
	    	$jpir['stats'] = 0;
	    	$jpirr = $jpi -> where($jpir) -> select();
	    	foreach($jpirr as &$value){
	    		$title[][] = $value['item'];
	    	}
	    	$jpc = M('jrpointcontent');
	    	$jpcrr = $jpc -> where($stats) -> select();
	    	foreach($jpirr as &$valuejpi){
	    		
	    		foreach($jpcrr as &$valuejpc){
	    			
	    			if($valuejpi['pointitemid'] == $valuejpc['pointitemid']){
	    				
	    				//$valuejpi[$valuejpi['pointitemid']][$valuejpc['pointcontentid']] = $valuejpc['pointcontentid'];
	    				$items[$valuejpi['pointitemid']][] = $valuejpc['pointcontentid'];
	    				continue;
	    				
	    			}
	    			
	    		}
	    		$pointitemid['shenhe'] = 1;
				$pointitemid['districtid'] = $dwname['districtid'];
				$pointitemid['jgh'] = $dwname['jgh'];
	    		$pointitemid['pointcontentid'] = array('in',$items[$valuejpi['pointitemid']]);
	    		$pointitemid['date'] = array( array('egt',$date) , array('elt',$dates) , 'and' );
	    		$jpsrr[] = $jps -> where($pointitemid) -> field('persname,gonghao,sum(point) as sums') -> group('persname,gonghao') -> select();
	    	}
	    	
//	    	var_dump($jpsrr);
	    	
	    	
	    	
//	    	$wheresumi['pointcontentid'] = array('in',$content);
//	    	$wheresumi['shenhe'] = 1;
//	    	$wheresumi['date'] = $_POST['date'];
//	    	$jps = M('jrpointsum');
//	    	$data = $jps -> where($wheresumi) -> field('jgh,pointcontentid,sum(point) as sums,date') -> group('jgh,pointcontentid,date') -> select();
	    	
    	}
    	
    	
    	
    	$jpc = M('jrpointcontent');
    	//var_dump($item);
    	foreach($_POST['content'] as &$value){
    		$content[] = $value;
	    }
	    
	    
	    
    	if($content == null){
    		
    	}else{
    		$jpcr['pointcontentid|pointitemid'] = array(array('in',$content),array('in',$item),'_multi'=>true);
    		$jpcr['stats'] = 0;
    		$wherejpc['pointcontentid'] = array('in',$content);
	    	$wherejpc['stats'] = 0;
	    	$jpcrr = $jpc -> where($wherejpc) -> select();
	    	foreach($jpcrr as &$value){
	    		$title[][] = $value['content'];
	    		//$items[] = $value['pointcontentid'];
	    	}
	    	//var_dump($title,$items);
	    	//$pointitemid['pointcontentid'] = array('in',$items);
	    	
	    	foreach($content as &$value){
	    		//var_dump($value);
		    	$pointcontentid['pointcontentid'] = $value;
		    	$pointcontentid['shenhe'] = 1;
				$pointcontentid['date'] = array( array('egt',$date) , array('elt',$dates) , 'and' );
				
		    	$jpsrr[] = $jps -> where($pointcontentid) -> field('persname,gonghao,pointcontentid,sum(point) as sums') -> group('persname,gonghao,pointcontentid') -> select();
	    	}
	    	
	    	//$jps = M('jrpointsum');
	    	
//	    	foreach($jpcrr as &$valuejpc){
//	    		
//	    		foreach($data as &$value){
//	    			
//	    			if($valuejpc['pointcontentid'] == $value['pointcontentid']){
//	    				
//	    				$value['pointitemid'] = $valuejpc['pointitemid'];
//	    			}
//	    		}
//	    	}
	    	
	    	
	    	
    	}
    	//var_dump($jpsrr,$title);
		
		$l = M('lungang');
		$wherel['dwname'] = $dwname['jgh'];
		$lrr = $l -> where($wherel) -> select();

    	$d = M('danwei');
    	$whered['jiagou'] = 'A1';
    	$whered['districtid'] = $dwname['districtid'];
    	$drr = $d -> where($whered) -> order('pianqu asc') -> select();
    	
    	foreach($lrr as &$valued){
    		
    		foreach($jpsrr as $key=>$valuejps){
    			
    			foreach($valuejps as &$value){
    				
    				//var_dump($key);
    				if($valued['gonghao'] == $value['gonghao']){
    					
    					$valued[$key]['sums'] = $value['sums'];
    				}
    				
    			}
    		}
    	}
    	//var_dump($title,$drr);
    	$this->assign('title',$title);
    	foreach($title as $key => $value){
    		
    		$titles[$key] = $key;
    		
    	}
    	//var_dump($titles,$drr);
    	$this->assign('titles',$titles);
    	$this->assign('data',$lrr);
    	// var_dump($lrr,$jpsrr);
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
}