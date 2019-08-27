<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	public function _initialize(){
		$dwname = cookie('dwname');
		
		$this->assign('user',$dwname);
    	if($dwname['auth'] == null){
    		$this->error('您还未登录,请登录后再操作',U('Login/login'),1);
    	}else{
    		
    	}
//  	var_dump($dwname);
    }
    public function persinfos($data){
    	$d = M('danwei');
    	$drr = $d -> select();
    	foreach($data as &$value){
    		
    		foreach($drr as &$valued){
    			
    			if($value['dwname'] == $valued['jgh']){
    				
    				$value['dwname'] = $valued['dwname'];
    			}
    		}
    	}
    }
    public function persinfo($prr){
    	//执行PERS表中对数据批量的处理
    	$d = M('danwei');
    	$drr = $d -> select();
    	foreach($prr as &$value){
    		foreach($drr as &$valued){
    			if($value['dwname'] == $valued['dwnameid']){
    				$value['dwname'] = $valued['dwname'];
    				$value['dwnameid'] = $valued['dwnameid'];
    				break;
    			}
    		}
    	}
    	
    	$d = M('zhiwu');
    	$drr = $d -> select();
    	foreach($prr as &$value){
    		foreach($drr as &$valued){
    			if($value['zhiwu'] == $valued['zhiwuid']){
    				$value['zhiwu'] = $valued['zhiwu'];
    				$value['zhiwuid'] = $valued['zhiwuid'];
    				break;
    			}
    		}
    	}
    	$d = M('gongzhong');
    	$drr = $d -> select();
    	foreach($prr as &$value){
    		foreach($drr as &$valued){
    			if($value['gongzhong'] == $valued['gongzhongid']){
    				$value['gongzhong'] = $valued['gongzhong'];
    				$value['gongzhongid'] = $valued['gongzhongid'];
    				break;
    			}
    		}
    	}
    	$d = M('district');
    	$drr = $d -> select();
    	foreach($prr as &$value){
    		foreach($drr as &$valued){
    			if($value['districtid'] == $valued['districtid']){
    				$value['district'] = $valued['district'];
    				$value['districtid'] = $valued['districtid'];
    				break;
    			}
    		}
    	}
    	return $prr;
    }
    public function content_item($data){
    	$jrpi = M('jrpointitem');
    	$jrpirr = $jrpi -> select();
    	foreach($data as &$value){
    		foreach($jrpirr as &$valuejrpi){
    			if($value['pointitemid'] == $valuejrpi['pointitemid']){
    				$value['item'] = $valuejrpi['item'];
    				continue;
    			}
    		}
    	}
    	$jrpc = M('jrpointcontent');
    	$jrpcrr = $jrpc -> select();
    	foreach($data as &$value){
    		foreach($jrpcrr as &$valuejrpc){
    			if($value['pointcontentid'] == $valuejrpc['pointcontentid']){
    				$value['content'] = $valuejrpc['content'];
    				$value['unit'] = $valuejrpc['unit'];
    				continue;
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
    	$d = M('danwei');
    	$drr = $d -> where('jiagou = "A1"') -> order('pianqu asc') -> select();
    	foreach($drr as &$valued){
    		foreach($data as &$value){
    			
    			if($valued['jgh'] == $value['jgh']){
    				
    				$value['dwname'] = $valued['dwname'];
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
    public function bonusinfo($data){
    	$dis = M('district');
    	$disrr = $dis -> select();
    	
    	foreach($data as &$value){
    		
    		foreach($disrr as &$val){
    			
    			if($value['district'] == $val['districtid']){
    				
    				$value['districts'] = $val['district'];
    				break;
    			}
    		}
    	}
    	
    	$d = M('danwei');
    	$drr = $d -> select();
    	
    	foreach($data as &$value){
    		
    		foreach($drr as &$val){
    			
    			if($value['dwname'] == $val['dwnameid']){
    				
    				$value['dwnames'] = $val['dwname'];
    				break;
    			}
    		}
    	}
    	
    	return $data;
	}
	public function jrpointshtimedw(){
		$dwname = cookie('dwname');
		$districtid['districtid'] = $dwname['districtid'];

		$d = M('danwei');
		$drr = $d -> where($districtid) -> select();

		$this->assign('drr',$drr);
		$this->display();
	}
    public function jrpointshtime(){
    	// $dwname = cookie('dwname');
    	
    	// $districtid['districtid'] = $dwname['districtid'];
    	// $da = M('dateauth');
    	// $data = $da -> where($districtid) -> select();
		// $this->assign('data',$data);
		$dwnameid = $_GET['dwnameid'];
		$this->assign('dwnameid',$dwnameid);

		$d = M('danwei');
		$drr = $d -> where("dwnameid = '$dwnameid'") -> find();

		$this->assign('drr',$drr);

    	$this->display();
    }
    public function jrpointshtimes(){
    	// $dwname = cookie('dwname');
    	// $dateauthid['dateauthid'] = $_POST['dateauthid'];
    	// $dateauth['dateauth'] = $_POST['dateauth'];
    	if($_POST['dateauth'] > 10 or $_POST['dateauth'] < 1){
    		$this->error('请输入数字 1 - 10 天');
    	}
    	// $da = M('dateauth');
    	// $data = $da -> where($dateauthid) -> save($dateauth);
		
		$dwnameid['dwnameid'] = $_POST['dwnameid'];
		$dateauth['dateauth'] = $_POST['dateauth'];
		// var_dump($dwnameid);
		$d = M('danwei');
		$data = $d -> where($dwnameid) -> save($dateauth);

    	if($data > 0){
    		$this->success('审核期限修改成功,请继续',U('index/jrpointshtimedw'));
    	}else{
    		$this->error('审核期限修改失败,请检查数据');
    	}
    }
    public function index(){
        //$dwname = cookie('dwname');
        //var_dump($dwname);
        //$this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
        $this->display();
    }
    public function logout(){
    	cookie('name',null);
    	//$this->display('../Login/login');
    	$this->success('系统退出',U('Login/login'),1);
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
    public function passwordreset(){
    	$dwname = cookie('dwname');
    	$where['districtid'] = $dwname['districtid'];
    	$where['stats'] = 0;
    	$lg = M('lungang');
    	$lgrr = $lg -> where($where) -> select();
    	$data = $this->persinfo($lgrr);
    	$this->assign('data',$data);
    	
    	$this->display();
    }
    public function persstats(){
    	$dwname = cookie('dwname');
    	$where['districtid'] = $dwname['districtid'];
    	$where['stats'] = 2;
    	$lg = M('lungang');
    	$lgrr = $lg -> where($where) -> select();
    	$data = $this->persinfo($lgrr);
    	$this->assign('data',$data);
    	
    	$this->display();
    }
    public function passwordresets(){
    	$username = $_GET['gonghao'];
    	$gonghao['password'] = $_GET['gonghao'];
    	
    	$l = M('login');
    	$lrr = $l -> where("username = '$username'") -> save($gonghao);
    	
    	if($lrr > 0){
    		$this->success('密码修改成功,请继续');
    	}else{
    		$this->error('密码修改失败,请检查数据');
    	}
    }
    public function indexlungang(){
    	$dwname = cookie('dwname');
    	$districtid = $dwname['districtid'];
    	$d = M('danwei');
    	$drr = $d -> where("districtid = '$districtid'") -> order('sort asc') -> select();
    	
    	$z = M('zhiwu');
    	$zrr = $z -> select();
    	
    	$p = M('lungang');
    	//$wherep['dwname'] = array('in',$drrr);
    	$stats['stats'] = 0;
    	$prr = $p -> where($stats) -> select();
    	
    	foreach($prr as &$value){
    		foreach($zrr as &$valuez){
    			if($valuez['zhiwuid'] == $value['zhiwu']){
    				$value['zwjiagou'] = $valuez['zwjiagou'];
    				$value['zhiwuid'] = $valuez['zhiwuid'];
    				$value['zhiwu'] = $valuez['zhiwu'];
    			}
    		}
    	}
    	$g = M('gongzhong');
    	$grr = $g -> select();
    	foreach($prr as &$value){
    		foreach($grr as &$valueg){
    			if($valueg['gongzhongid'] == $value['gongzhong']){
    				$value['gongzhong'] = $valueg['gongzhong'];
    				continue;
    			}
    		}
    	}
    	$pq = M('pianqu');
    	$pqrr = $pq -> select();
    	
    	foreach($drr as &$valued){
    		foreach($pqrr as &$valuepq){
    			if($valuepq['pianquid'] == $valued['pianqu']){
    				$valued['pianquname'] = $valuepq['pianqu'];
    				continue;
    			}
    		}
    	}
    	$dis = M('district');
    	$disrr = $dis -> select();
    	
    	foreach($drr as &$value){
    		
    		foreach($disrr as &$val){
    			
    			if($value['districtid'] == $val['districtid']){
    				
    				$value['districts'] = $val['district'];
    				break;
    			}
    		}
    	}
    	
    	
    	foreach($drr as &$valued){
    		$jgh = $valued['dwnameid'];
    		$dwnameid['dwname'] = $jgh;
    		$dwnameid['stats'] = 0;
    		$valued['count'] = $p -> where($dwnameid) -> count();
//  		foreach($zrr as &$valuez){
    			foreach($prr as &$value){
    				if($valued['dwnameid'] == $value['dwname'] and $value['zwjiagou'] == 'A1'){
    					$wdfzr[] = array(
    					'persname' => $value['persname'],
    					'gongzhong' => $value['gongzhong'],
    					'zhiwu' => $valuez['zhiwu'],
    					'dwname' => $valued['dwname'],
    					'gonghao' => $value['gonghao'],
    					'id' => $value['id'],
    					);
    					
    				}
//					}
    				if($valued['dwnameid'] == $value['dwname'] and $value['zwjiagou'] == 'A2'){
    					
    					$zhgy[] = array(
    					'persname' => $value['persname'],
    					'gongzhong' => $value['gongzhong'],
    					'zhiwu' => $valuez['zhiwu'],
    					'dwname' => $valued['dwname'],
    					'gonghao' => $value['gonghao'],
    					'id' => $value['id'],
    					);
    					
    				}
    				if($valued['dwnameid'] == $value['dwname'] and $value['zwjiagou'] == 'A3'){
    					
    					$lcjl[] = array(
    					'persname' => $value['persname'],
    					'gongzhong' => $value['gongzhong'],
    					'zhiwu' => $valuez['zhiwu'],
    					'dwname' => $valued['dwname'],
    					'gonghao' => $value['gonghao'],
    					'id' => $value['id'],
    					);
    					
    				}
    				if($valued['dwnameid'] == $value['dwname'] and $value['zwjiagou'] == 'A4'){
    					
    					$ptgy[] = array(
    					'persname' => $value['persname'],
    					'gongzhong' => $value['gongzhong'],
    					'zhiwu' => $valuez['zhiwu'],
    					'dwname' => $valued['dwname'],
    					'gonghao' => $value['gonghao'],
    					'id' => $value['id'],
    					);
    					
    				}
    				if($valued['dwnameid'] == $value['dwname'] and $value['zwjiagou'] == 'A5'){
    					
    					$dtjl[] = array(
    					'persname' => $value['persname'],
    					'gongzhong' => $value['gongzhong'],
    					'zhiwu' => $valuez['zhiwu'],
    					'dwname' => $valued['dwname'],
    					'gonghao' => $value['gonghao'],
    					'id' => $value['id'],
    					);
    					
    				}
    		}
    		$wdfzr[] = array(
    		'gongzhong' => '共'.count($wdfzr).'人',
    		);
    		$valued['wdfzr'] = $wdfzr;
    		$wdfzr = array();
    		
    		$zhgy[] = array(
    		'gongzhong' => '共'.count($zhgy).'人',
    		);
    		$valued['zhgy'] = $zhgy;
    		$zhgy = array();
    		
    		$lcjl[] = array(
    		'gongzhong' => '共'.count($lcjl).'人',
    		);
    		$valued['lcjl'] = $lcjl;
    		$lcjl = array();
    		
    		$dtjl[] = array(
    		'gongzhong' => '共'.count($dtjl).'人',
    		);
    		$valued['dtjl'] = $dtjl;
    		$dtjl = array();
    		
    		$khjl[] = array(
    		'gongzhong' => '共'.count($khjl).'人',
    		);
    		$valued['khjl'] = $khjl;
    		$khjl = array();
    		
    		$ptgy[] = array(
    		'gongzhong' => '共'.count($ptgy).'人',
    		);
    		$valued['ptgy'] = $ptgy;
    		$ptgy = array();
    	}
    	
    	//统计总数
    	$jgh = $d -> where("jiagou = 'A1'") -> select();
    	foreach($jgh as &$value){
    		$counts[] = $value['dwnameid'];
    	}
    	$wherejgh['dwname'] = array('in',$counts);
    	$zhiwu = $z -> where('zwjiagou = "A1"') -> select();
    	foreach($zhiwu as &$value){
    		$wdfzr[] = $value['zhiwud'];
    	}
    	$wherewdfzr['zhiwu'] = array('in',$wdfzr);
    	$zhiwu = $z -> where('zwjiagou = "A2"') -> select();
    	foreach($zhiwu as &$value){
    		$zhgy[] = $value['zhiwud'];
    	}
    	$wherezhgy['zhiwu'] = array('in',$zhgy);
    	$zhiwu = $z -> where('zwjiagou = "A3"') -> select();
    	foreach($zhiwu as &$value){
    		$lcjl[] = $value['zhiwud'];
    	}
    	$wherelcjl['zhiwu'] = array('in',$lcjl);
    	$zhiwu = $z -> where('zwjiagou = "A4"') -> select();
    	foreach($zhiwu as &$value){
    		$dtjl[] = $value['zhiwud'];
    	}
    	$wheredtjl['zhiwu'] = array('in',$dtjl);
    	$zhiwu = $z -> where('zwjiagou = "A5"') -> select();
    	foreach($zhiwu as &$value){
    		$khjl[] = $value['zhiwud'];
    	}
    	$wherekhjl['zhiwu'] = array('in',$khjl);
    	$zhiwu = $z -> where('zwjiagou = "A6"') -> select();
    	foreach($zhiwu as &$value){
    		$ptgy[] = $value['zhiwud'];
    	}
    	$whereptgy['zhiwu'] = array('in',$ptgy);
//  	$count['counts'] = $p -> where($wherejgh) -> count();
//  	$count['wdfzr'] = $p -> where($wherewdfzr) -> count();
//  	$count['zhgy'] = $p -> where($wherezhgy) -> count();
//  	$count['lcjl'] = $p -> where($wherelcjl) -> count();
//  	$count['dtjl'] = $p -> where($wheredtjl) -> count();
//  	$count['khjl'] = $p -> where($wherekhjl) -> count();
//  	$count['ptgy'] = $p -> where($whereptgy) -> count();
//  	$this -> assign('count',$count);
    	//var_dump($count);
    	$index = 'indexjr';
    	cookie('index',$index,3600);
    	//var_dump($data);
    	$this->assign('data',$drr);
    	$this->display();
    }
    public function bonusadd(){
    	$dwname = cookie('dwname');
    	
    	$bl = M('bonuslist');
    	
    	$date = date('Y-m');
    	$where['date'] = date("Y-m",strtotime("$date -1 month"));
    	$where['district'] = $dwname['districtid'];
    	$where['stats'] = 0;
    	$blrr = $bl -> where($where) -> select();
    	foreach($blrr as &$value){
    		$dwnames[] = $value['dwname'];
    	}
//  	var_dump($dwnames);
    	$districtid['districtid'] = $dwname['districtid'];
    	if($dwnames == null){
    		
    	}else{
    		$districtid['dwnameid'] = array('notin' , $dwnames);
    	}
    	
    	
    	$d = M('danwei');
    	$drr = $d -> where($districtid) -> order('sort asc') -> select();
//  	var_dump($drr);
    	$this->assign('drr',$drr);
    	$this->display();
    }
    public function bonusadds(){
    	$dwnameid['dwnameid'] = $_GET['dwnameid'];
    	$d = M('danwei');
    	$drr = $d -> where($dwnameid) -> select();
    	$this->assign('drr',$drr);
    	
    	$where['zhiwu'] = array('notin', '1');
    	$where['dwname'] = $dwnameid['dwnameid'];
    	$where['stats'] = 0;
    	$l = M('lungang');
    	$count = $l -> where($where) -> count();
    	
    	$this->assign('count',$count);
    	
    	$b = M('bonus');
    	$stats['stats'] = 0;
    	$brr = $b -> where($stats) -> select();
    	
    	$this->assign('brr',$brr);
    	
    	$this->display();
    }
    public function bonusaddsuc(){
    	$dwnameid['dwnameid'] = $_POST['dwname'];
    	
    	$d = M('danwei');
    	
    	$districtid = $d -> where($dwnameid) -> field('districtid') -> find();
    	
    	$where['dwname'] = $dwnameid['dwnameid'];
    	$where['district'] = $districtid['districtid'];
    	$where['bonus'] = $_POST['sum'];
    	$date = date('Y-m');
    	$where['date'] = date("Y-m",strtotime("$date -1 month"));
    	
    	$where['alterdate'] = date('Y-m-d');
    	$where['stats'] = 0;
    	
    	$bl = M('bonuslist');
    	$blrr = $bl -> add($where);
    	
    	if($blrr > 0){
    		
    		//单项奖励要不要记录；
    		
    		$this->success('奖金池注入奖金，请继续' , U('Index/bonusadd'));
    	}else{
    		$this->error('奖金池注入失败，请检查数据');
    	}
//  	var_dump($where);
    }
    public function bonussearchs(){
    	$where['date'] = $_POST['date'];
    	$dwname = cookie('dwname');
    	$where['district'] = $dwname['districtid'];
    	
    	$bl = M('bonuslist');
    	$blrr = $bl -> where($where) -> select();
    	
    	$blrr = $this->bonusinfo($blrr);
    	
    	$this->assign('blrr',$blrr);
    	$this->display();
    }
    public function bonusmodify(){
		$bonuslistid = $_GET['bonuslistid'];

		$bl = M('bonuslist');
		$data = $bl -> where("bonuslistid = '$bonuslistid'") -> select();

		$d = M('danwei');
		$drr = $d -> select();

		foreach($data as &$value){

			foreach($drr as &$val){

				if($value['dwname'] == $val['dwnameid']){
					
					$value['dwnames'] = $val['dwname'];
					break;
				}
			}
		}

		$this->assign('data',$data);
		$this->display();
	}
    public function bonusmodifys(){
		$bonuslistid = $_POST['bonuslistid'];
		$bonus['bonus'] = $_POST['bonus'];

		$bl = M('bonuslist');

		$blrr = $bl -> where("bonuslistid = '$bonuslistid'") -> save($bonus);
		if($blrr > 0){
			$this->success('奖金池修改成功，请继续',U('index/bonussearch'));
		}else{
			$this->error('奖金池修改失败，请检查数据');
		}
	}
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    public function persmodify(){
    	$admin = cookie('dwname');
    	if($admin['auth'] == 5){
    		
	    	$d = M('danwei');
	    	$districtid['districtid'] = $admin['districtid'];
	    	$drr = $d -> where($districtid) -> select();
	    	$this->assign('drr',$drr);
	    	
	    	$z = M('zhiwu');
	    	$zrr = $z -> select();
	    	$this->assign('zrr',$zrr);
	    	
	    	$grr = M('gongzhong') -> select();
	    	$this->assign('grr',$grr);
	    	
	    	$id = $_GET['id'];
	    	$p = M('lungang');
	    	$prr = $p -> where("id = '$id'") -> select();
	    	$data = $this -> persinfo($prr);
	    	foreach($data as &$value){
	    		$datas = $value;
	    	}
	    	$this -> assign('data',$datas);
	    	$this -> display();
	    }else{
	    	$this->success('您没有权限更改员工信息');
	    }
    }
    public function persmodifysuc(){
    	$id = $_POST['id'];
    	$where['dwname'] = $_POST['dwname'];
    	$where['zhiwu'] = $_POST['zhiwu'];
    	$where['gongzhong'] = $_POST['gongzhong'];
    	$where['gonghao'] = $_POST['gonghao'];
    	$where['persname'] = $_POST['persname'];
    	$where['stats'] = $_POST['stats'];
//  	$where['beizhu'] = $_POST['beizhu'];
    	$p = M('lungang');
    	
    	$lrr = $p -> where("id = '$id'") -> find();
    	$username['username'] = $lrr['gonghao'];
    	$login = M('login') -> where($username) -> find();
    	
    	$loginid['loginid'] = $login['loginid'];
//  	$wherelg['ydwname'] = $lrr['dwname'];
//  	$wherelg['yzhiwu'] = $lrr['zhiwu'];
//  	if($_POST['exp'] == null){
//  		
//  	}else{
//  		$wherelg['exp'] = $_POST['exp'];
//  	}
//  	if($_POST['dateo'] == null){
//  		
//  	}else{
//  		$wherelg['dateo'] = $_POST['dateo'];
//  	}
    	//var_dump($where,$gonghao);
    	$pr = $p -> where("id = '$id'") -> save($where);
    	
    	
    	
    	if($pr > 0){
    		$gonghaos['username'] = $_POST['gonghao'];
    		if($lrr['gonghao'] == $_POST['gonghao']){
    			
    		}else{
    			M('login') -> where($loginid) -> save($gonghaos);
    		}
    		
//  		$wherelg['gonghao'] = $gonghao;
//  		$wherelg['persname'] = $lrr['persname'];
//  		$wherelg['zhiwu'] = $_POST['zhiwu'];
//  		$wherelg['dwname'] = $_POST['dwname'];
//  		$wherelg['date'] = $_POST['date'];
//  		$jl = M('jrlgtransfer');
//  		$jlrr = $jl -> add($wherelg);
    		$this -> success('员工调动成功,请继续',U('Index/indexlungang'));
    	}else{
    		$this->error('员工调动不成功,请检查数据');
    	}
    }
    public function persjgh(){
    	$dwnameid['dwname'] = $_GET['jgh'];
    	$dwnameid['stats'] = 0;
    	$p = M('lungang');
    	$prr = $p -> where($dwnameid) -> select();
    	
    	$prr = $this -> persinfo($prr);
    	
    	$this -> assign('data',$prr);
    	$this->display();
    }
    public function jrlgtransferdates(){
    	$date = substr($_POST['date_date'],0,10);
    	$dates = substr($_POST['date_date'],-10,10);
    	$where['date'] = array( array('egt',$date) , array('elt',$dates) , 'and' );
    	$jl = M('jrlgtransfer');
    	$prr = $jl -> where($where) -> select();
    	$prr = $this->persinfo($prr);
    	$this->assign('data',$prr);
    	//var_dump($prr);
    	$this->display();
    }
    
    public function pointitemedits(){
    	$dwname = cookie('dwname');
    	$where['districtid'] = $dwname['districtid'];
    	
    	$jpi = M('jrpointitem');
    	
    	$jpirr = $jpi -> where($where) -> select();
    	$count = $jpi -> where($where) -> count();
    	
    	$jpcl = M('jrpointclass');
    	$jpclrr = $jpcl -> select();
    	
    	foreach($jpirr as &$value){
    		
    		foreach($jpclrr as &$val){
    			
    			if($value['pointclassid'] == $val['pointclassid']){
    				
    				$value['class'] = $val['class'];
    				break;
    			}
    		}
    	}
    	
    	$jpirr = json_encode($jpirr);
    	
    	$json = '{"code":0,"msg":"","count":'.$count.',"data":'.$jpirr.'}';
    	echo $json;
    }
    public function pointitemeditsuc(){
    	
    	$pointitemid = $_POST['pointitemid'];
    	
    	$where['item'] = $_POST['item'];
    	$where['beizhu'] = $_POST['beizhu'];
    	
    	$jpi = M('jrpointitem');
    	$jpirr = $jpi -> where("pointitemid = '$pointitemid'") -> save($where);
    	echo $jpirr;
    }
    public function pointitemstats(){
    	//单独启用禁用；
    	$pointitemid = $_POST['pointitemid'];
    	$stats = $_POST['stats'];
    	$jpi = M('jrpointitem');
    	if($stats == 'false'){
    		$where['stats'] = 1;
    		$jpirr = $jpi -> where("pointitemid = '$pointitemid'") -> save($where);
    	}else{
    		$where['stats'] = 0;
    		$jpirr = $jpi -> where("pointitemid = '$pointitemid'") -> save($where);
    	}
    	echo $jpirr;
    }
    public function pointitembatchstats(){
    	//批量启用禁用；
    	$pointitem = $_POST['pointitemid'];
    	$jpi = M('jrpointitem');
    	$where['stats'] = 1;
    	foreach($pointitem as &$value){
    		$pointitemid = $value['pointitemid'];
    		$jpirr = $jpi -> where("pointitemid = '$pointitemid'") -> save($where);
    		$count = $count + $jpirr;
    	}
    	
    	echo $count;
    }
    public function pointcontentedits(){
    	$dwname = cookie('dwname');
    	$where['districtid'] = $dwname['districtid'];
    	$jpi = M('jrpointitem');
    	$jpirr = $jpi -> where($where) -> select();
    	$jpc = M('jrpointcontent');
    	$jpcrr = $jpc -> where($where) -> select();
    	foreach($jpcrr as &$value){
    		
    		foreach($jpirr as &$val){
    			
    			if($value['pointitemid'] == $val['pointitemid']){
    				
    				$value['item'] = $val['item'];
    				break;
    			}
    		}
    	}
    	$count = $jpc -> count();
    	
    	$jpcrr = json_encode($jpcrr);
    	
    	$json = '{"code":0,"msg":"","count":'.$count.',"data":'.$jpcrr.'}';
    	echo $json;
    }
    public function pointcontenteditsuc(){
    	$pointcontentid = $_POST['pointcontentid'];
    	
    	$where['content'] = $_POST['content'];
    	$where['unit'] = $_POST['unit'];
    	$where['score'] = $_POST['score'];
    	$where['beizhu'] = $_POST['beizhu'];
    	
    	
    	$jpc = M('jrpointcontent');
    	$jpcrr = $jpc -> where("pointcontentid = '$pointcontentid'") -> save($where);
    	echo $jpcrr;
    }
    public function pointcontentstats(){
    	//单独启用禁用；
    	$pointcontentid = $_POST['pointcontentid'];
    	$stats = $_POST['stats'];
    	$jpc = M('jrpointcontent');
    	if($stats == 'false'){
    		$where['stats'] = 1;
    		$jpcrr = $jpc -> where("pointcontentid = '$pointcontentid'") -> save($where);
    	}else{
    		$where['stats'] = 0;
    		$jpcrr = $jpc -> where("pointcontentid = '$pointcontentid'") -> save($where);
    	}
    	echo $jpcrr;
    }
    public function pointcontentbatchstats(){
    	//批量启用禁用；
    	$pointcontent = $_POST['pointcontentid'];
    	$jpc = M('jrpointcontent');
    	$where['stats'] = 1;
    	foreach($pointcontent as &$value){
    		$pointcontentid = $value['pointcontentid'];
    		$jpcrr = $jpc -> where("pointcontentid = '$pointcontentid'") -> save($where);
    		$count = $count + $jpcrr;
    	}
    	
    	echo $count;
    }
    
    public function pointitem(){
    	$jrpi = M('jrpointitem');
    	$jrpirr = $jrpi -> select();
    	$this->assign('data',$jrpirr);
    	$this->display();
    }
    public function pointitems(){
    	$pointitemid = $_GET['pointitemid'];
    	$jrpi = M('jrpointitem');
    	$jrpirr = $jrpi -> where("pointitemid = '$pointitemid'") -> select();
    	$this->assign('data',$jrpirr);
    	$this->display();
    	//var_dump($jrpirr);
    }
    public function pointitemsuc(){
    	$pointitemid = $_POST['pointitemid'];
    	$where['beizhu'] = $_POST['beizhu'];
    	$where['item'] = $_POST['item'];
    	if($_POST['stats'] == 'on'){
    		$where['stats'] = 0;
    	}else{
    		$where['stats'] = 1;
    	}
    	//var_dump($pointitemid,$stats);
    	$jrpi = M('jrpointitem');
    	$jrpirr = $jrpi -> where("pointitemid = '$pointitemid'") -> save($where);
    	if($jrpirr > 0){
    		$this->success('项目大类修改成功,请继续',U('Index/pointitem'));
    	}else{
    		$this->error('项目大类修改失败,请检查数据');
    	}
    }
    public function pointitemadd(){
    	$dwname = cookie('dwname');
    	$where['districtid'] = $dwname['districtid'];
    	
    	$jrpc = M('jrpointclass');
    	$jrpcrr = $jrpc -> where($where) -> select();
    	
    	$this->assign('jrpcrr',$jrpcrr);
    	$this->display();
    }
    public function pointitemaddsuc(){
    	$dwname = cookie('dwname');
    	$where['districtid'] = $dwname['districtid'];
    	//var_dump($_POST);
    	$where['item'] = $_POST['item'];
    	$where['beizhu'] = $_POST['beizhu'];
    	$where['pointclassid'] = $_POST['pointclassid'];
    	$where['stats'] = 0;
    	$jrpi = M('jrpointitem');
    	$jrpirr = $jrpi -> add($where);
    	if($jrpirr > 0){
    		$this->success('项目添加成功,请继续',U('Index/pointitemadd'));
    	}else{
    		$this->error('项目添加失败,请检查数据');
    	}
    }
    public function pointcontent(){
    	$jrpc = M('jrpointcontent');
    	$data = $jrpc -> order('pointitemid asc') -> select();
    	$data = $this->content_item($data);
    	$this->assign('data',$data);
    	$this->display();
    }
    public function pointcontents(){
    	$pointcontentid = $_GET['pointcontentid'];
    	$jrpc = M('jrpointcontent');
    	$data = $jrpc -> where("pointcontentid = '$pointcontentid'") -> select();
    	$data = $this->content_item($data);
    	$this->assign('data',$data);
    	$this->display();
    	//var_dump($jrpirr);
    }
    public function pointcontentsuc(){
    	$pointcontentid = $_POST['pointcontentid'];
    	$where['beizhu'] = $_POST['beizhu'];
    	$where['content'] = $_POST['content'];
    	if($_POST['stats'] == 'on'){
    		$where['stats'] = 0;
    	}else{
    		$where['stats'] = 1;
    	}
    	//var_dump($pointitemid,$stats);
    	$jrpc = M('jrpointcontent');
    	$jrpcrr = $jrpc -> where("pointcontentid = '$pointcontentid'") -> save($where);
    	if($jrpcrr > 0){
    		$this->success('项目修改成功,请继续',U('Index/pointcontent'));
    	}else{
    		$this->error('项目修改失败,请检查数据');
    	}
    }
    public function pointcontentadd(){
    	$dwname = cookie('dwname');
    	$where['districtid'] = $dwname['districtid'];
    	$where['stats'] = 0;
    	$jrpi = M('jrpointitem');
    	$jrpirr = $jrpi -> where($where) -> field('pointitemid,item') -> select();
    	$this->assign('jrpirr',$jrpirr);
    	$this->display();
    }
    public function pointcontentaddsuc(){
    	//var_dump($_POST);
    	$dwname = cookie('dwname');
    	$where['districtid'] = $dwname['districtid'];
    	$where['content'] = $_POST['content'];
    	$where['pointitemid'] = $_POST['pointitemid'];
    	$where['beizhu'] = $_POST['beizhu'];
    	$where['stats'] = 0;
    	$where['unit'] = $_POST['unit'];
    	$where['score'] = $_POST['score'];
    	$jrpc = M('jrpointcontent');
    	$jrpcrr = $jrpc -> add($where);
    	if($jrpcrr > 0){
    		$this->success('项目添加成功,请继续',U('Index/pointcontentadd'));
    	}else{
    		$this->error('项目添加失败,请检查数据');
    	}
    }
    public function jrpointdwdates(){
    	$dwname = cookie('dwname');
    	$admin = $dwname['districtid'];
    	
    	$d = M('danwei');
    	$drr = $d -> where("districtid = '$admin'") -> order('sort asc') -> select();
    	
    	//var_dump(substr($_POST['date_date'],0,10));
    	//var_dump(substr($_POST['date_date'],-10,10));
    	$date = $_POST['date'];
    	$where['districtid'] = $admin;
    	$where['shenhe'] = 1;
    	$where['date'] = $date;
    	$jrps = M('jrpointsum');
    	$data = $jrps -> where($where) -> field('jgh,sum(sum) as sums') -> group('jgh') -> select();
    	foreach($drr as &$valued){
    		foreach($data as &$value){
    			if($valued['dwnameid'] == $value['jgh']){
    				$valued['sums'] = $value['sums'];
    				$valued['date'] = $date;
    			}
    		}
    	}
    	$this->assign('data',$drr);
    	$this->display();
    }
    public function jrpointdwdateshs(){
    	$dwname = cookie('dwname');
    	$admin = $dwname['districtid'];
    	$d = M('danwei');
    	$drr = $d -> where("districtid = '$admin'") -> order('sort asc') -> select();
    	
    	//var_dump(substr($_POST['date_date'],0,10));
    	//var_dump(substr($_POST['date_date'],-10,10));
    	$date = $_POST['date'];
    	cookie('datesh',$date);
    	$where['shenhe'] = 0;
    	$where['date'] = $date;
    	$jrps = M('jrpointsum');
    	$data = $jrps -> where($where) -> field('jgh,sum(sum) as sums') -> group('jgh') -> select();
    	foreach($drr as &$valued){
    		foreach($data as &$value){
    			if($valued['dwnameid'] == $value['jgh']){
    				$valued['sums'] = $value['sums'];
    				$valued['date'] = $date;
    			}
    		}
    	}
    	$this->assign('data',$drr);
    	$this->display();
    }
    public function jrpointdwdateshfws(){
    	$dwname = cookie('dwname');
    	$admin = $dwname['districtid'];
    	$d = M('danwei');
    	$drr = $d -> where("districtid = '$admin'") -> order('sort asc') -> select();
    	
    	$date = substr($_POST['date_date'],0,10);
    	$dates = substr($_POST['date_date'],-10,10);
    	
//  	$where['date'] = array( array('egt',$date) , array('elt',$dates) , 'and' );
    	
    	$datest = strtotime($dates);
    	$datet = strtotime($date);
    	$datefw = round($datest - $datet)/3600/24;
    	
    	for($i = 0; $i <= $datefw; $i++){
    		
    		$where['shenhe'] = 0;
    		$wheres['shenhe'] = 1;
    		$where['date'] = date("Y-m-d",strtotime("+".$i."day",strtotime($date)));
    		$wheres['date'] = date("Y-m-d",strtotime("+".$i."day",strtotime($date)));
    		
    		$datefws = date("Y-m-d",strtotime("+".$i."day",strtotime($date)));
    		
    		$jrps = M('jrpointsum');
    		
	    	$data = $jrps -> where($where) -> field('jgh,sum(sum) as sums') -> group('jgh') -> select();
	    	
	    	$datas = $jrps -> where($wheres) -> field('jgh,sum(sum) as sumss') -> group('jgh') -> select();
	    	
	    	$datefwss[] = date("Y-m-d",strtotime("+".$i."day",strtotime($date)));
	    	
	    	foreach($drr as &$valued){
	    		
	    		foreach($data as &$value){
	    			
	    			if($valued['dwnameid'] == $value['jgh']){
	    				
	    				$valued[$datefws]['sums'] = $value['sums'];
	    				$valued[$datefws]['sh'] = '未审核';
	    				break;
	    			}
	    		}
	    	}
	    	foreach($drr as &$valued){
	    		
	    		foreach($datas as &$value){
	    			
	    			if($valued['dwnameid'] == $value['jgh']){
	    				
	    				$valued[$datefws]['sumss'] = $value['sumss'];
	    				if($valued[$datefws]['sums'] == null or $value['sumss'] == null){
	    					$valued[$datefws]['sh'] = '已审';
	    				}else{
	    					$valued[$datefws]['sh'] = '部分审核';
	    				}
	    				
	    				break;
	    			}
	    		}
	    	}
	    	
    	}
    	$this->assign('datefwss',$datefwss);
    	$this->assign('data',$drr);
    	$this->display();
	}
	public function jrpointdwdatenosh(){
		$dwname = cookie('dwname');
		$d = M('danwei');
		$where['districtid'] = $dwname['districtid'];
		$drr = $d -> where($where) -> select();
		$this->assign('drr',$drr);
		$this->display();
	}
	public function jrpointdwdatenoshs(){
		$date = $_POST['date'];
		$jgh = $_POST['dwname'];

		$where['date'] = $date;
		$where['jgh'] = $jgh;
		$where['shenhe'] = 0;

		$jps = M('jrpointsum');
		$jpsr = $jps -> where($where) -> field('pointcontentid') -> distinct(true) -> select();

		$dwname = cookie('dwname');
		$wherejp['districtid'] = $dwname['districtid'];

		$jp = M('jrpointcontent');
		$jpr = $jp -> where($wherejp) -> select();

		foreach($jpsr as &$val){

			foreach($jpr as &$value){

				if($val['pointcontentid'] == $value['pointcontentid']){
					
					$val['content'] = $value['content'];
					break;
				}
			}
		}
		// foreach($jpsr as &$value){

		// 	$pointcontentid[] = $value['content'];
		// }

		$jpsrr = $jps -> where($where) -> field('gonghao,pointcontentid,persname,zhiwu,point') -> select();

		foreach($jpsrr as &$value){

			$data[$value['gonghao']]['persname'] = $value['persname'];
			$data[$value['gonghao']]['zhiwu'] = $value['zhiwu'];
			$data[$value['gonghao']][$value['pointcontentid']] = $value['point'];
		}

		// $this->assign('pointcontentid',$jpsr);
		$this->assign('data',$data);
		$this->assign('datas',$jpsr);
		$this->display();
		// var_dump($data,$jpsr);
	}
	public function jrpointdwdetailfw(){
		$dwname = cookie('dwname');
		$d = M('danwei');
		$where['districtid'] = $dwname['districtid'];
		$drr = $d -> where($where) -> select();

		$this->assign('drr',$drr);

		

		$this->display();
	}
	public function jrpointdwdetailfws(){
		$date = substr($_POST['date'],0,10);
		$dates = substr($_POST['date'],-10,10);
		$where['date'] = array( array('egt',$date) , array('elt',$dates) , 'and' );
		$where['shenhe'] = 1;
		$where['jgh'] = $_POST['dwname'];

		$point_sum = $_POST['point_sum'];

		$js = M('jrpointsum');
		$pointcontentid = $js -> distinct('pointcontentid') -> field('pointcontentid') -> where($where) ->  select();
		$gonghao = $js -> distinct('gonghao') -> field('gonghao') -> where($where) ->  select();
		$jpsr = $js -> field('persname,gonghao,zhiwu,jgh,pointcontentid,sum('.$point_sum.') as sums') -> where($where) -> group('persname,gonghao,zhiwu,jgh,pointcontentid') -> select();
		
		foreach($gonghao as &$value){
			//进行gonghao人员合并；
			foreach($jpsr as &$val){
				//员工项目合并；
				foreach($pointcontentid as &$v){
					//工号相同的进行合并；
					if($value['gonghao'] == $val['gonghao']){
						$value['persname'] = $val['persname'];
						$value['zhiwu'] = $val['zhiwu'];
						if($val['pointcontentid'] == $v['pointcontentid']){
							//判断有值的进行赋值，没有值的赋值空值；
							$value[$value['gonghao']][$v['pointcontentid']]['sums'] = $val['sums'];

						}else{
							//判断如果没有值的进行赋值，有值的直接跳过；
							if($value[$value['gonghao']][$v['pointcontentid']]['sums'] == null){
								$value[$value['gonghao']][$v['pointcontentid']]['sums'] = '';
							}
							
						}
					}

						
					}
					
				}
			}
		


		// foreach($jpsr as &$val){

		// 	foreach($pointcontentid as &$value){

		// 			if($val['pointcontentid'] == $value['pointcontentid']){

		// 				$val[$val['gonghao']][$value['pointcontentid']]['sums'] = $val['sums'];
		// 			}else{

		// 				$val[$val['gonghao']][$value['pointcontentid']]['sums'] = '';
		// 			}
		
		// 		}
		// 	}
		
		// foreach($gonghao as &$value){

		// 	foreach($jpsr as &$val){

		// 		if($value['gonghao'] == $val['gonghao']){

		// 			$value['persname'] = $val['persname'];
		// 			$value['zhiwu'] = $val['zhiwu'];
		// 			$value['pointcontentid'][$val['pointcontentid']]['sums'] = $val['sums'];

		// 		}
		// 	}
		// }
		$dwname = cookie('dwname');
		$wherejc['districtid'] = $dwname['districtid'];
		$jc = M('jrpointcontent');
		$jcr = $jc -> where($wherejc) -> field('pointcontentid,content') -> select();

		foreach($pointcontentid as &$value){

			foreach($jcr as &$val){

				if($value['pointcontentid'] == $val['pointcontentid']){

					$value['content'] = $val['content'];
					break;
				}
			}
		}

		

		$pointcontentid = json_encode($pointcontentid);
		$gonghao = json_encode($gonghao);
		// $data = $pointcontentid . '-' . $jcr;
		
		$data[] = $pointcontentid;
		$data[] = $gonghao;
		$data = json_encode($data);
		echo $data;
		// echo $gonghao;
	}




    
    public function jrpointdwdatetbs(){
    	$dwname = cookie('dwname');
    	$admin = $dwname['districtid'];
    	$d = M('danwei');
    	$drr = $d -> where("districtid = '$admin'") -> order('sort asc') -> select();
    	
    	//var_dump(substr($_POST['date_date'],0,10));
    	//var_dump(substr($_POST['date_date'],-10,10));
    	$date = $_POST['date'];
    	
    	$where['shenhe'] = 1;
    	$where['date'] = $date;
    	$jrps = M('jrpointsum');
    	$data = $jrps -> where($where) -> field('jgh,sum(sum) as sums') -> group('jgh') -> select();
    	foreach($drr as &$valued){
    		foreach($data as &$value){
    			if($valued['dwnameid'] == $value['jgh']){
    				if($value['sums'] == null){
    					
    				}else{
    					$valued['sums'] = '已审';
    				}
    				
    				$valued['date'] = $date;
    			}
    		}
    	}
    	$this->assign('data',$drr);
    	$this->display();
    }
    public function jrpointdwdatepers(){
    	$where['jgh'] = $_GET['jgh'];
    	$where['date'] = $_GET['date'];
    	$where['shenhe'] = 1;
    	$jrps = M('jrpointsum');
    	//$jrpsrr = $jrps -> where($where) -> field('dwname,zhiwu,persname,pointcontentid,unit,score,point,sum(sum) as sums') -> group('dwname,zhiwu,persname,pointcontentid,unti,score') -> select();
    	$data = $jrps -> where($where) -> field('dwname,district,zhiwu,persname,gonghao,date,sum(point) as points,sum(sum) as sums') -> group('dwname,district,zhiwu,persname,gonghao,date') -> select();
    	//var_dump($jgh,$date);
    	$this->assign('data',$data);
    	$this->display();
    }
    public function jrpointdwdatepersinfo(){
    	$where['gonghao'] = $_GET['gonghao'];
    	$where['date'] = $_GET['date'];
    	$where['shenhe'] = 1;
    	$jrps = M('jrpointsum');
    	$data = $jrps -> where($where) -> field('dwname,district,zhiwu,persname,pointcontentid,score,point,sum') -> select();
    	$data = $this->content_item($data);
    	$sum = $jrps -> where($where) -> sum('sum');
    	$point = $jrps -> where($where) -> sum('point');
    	$this->assign('sum',$sum);
    	$this->assign('point',$point);
    	$this->assign('data',$data);
    	$this->display();
    }
    public function jrpointdwdatefws(){
    	$dwname = cookie('dwname');
    	$admin = $dwname['districtid'];
    	$d = M('danwei');
    	$drr = $d -> where("districtid = '$admin'") -> order('sort asc') -> select();
    	
    	$date = substr($_POST['date_date'],0,10);
    	$dates = substr($_POST['date_date'],-10,10);
    	$where['shenhe'] = 1;
    	$where['date'] = array( array('egt',$date) , array('elt',$dates) , 'and' );
    	cookie('date',$date);
    	cookie('dates',$dates);
    	$jrps = M('jrpointsum');
    	$data = $jrps -> where($where) -> field('jgh,sum(sum) as sums') -> group('jgh') -> select();
    	
    	foreach($drr as &$valued){
    		foreach($data as &$value){
    			if($valued['dwnameid'] == $value['jgh']){
    				$valued['sums'] = $value['sums'];
    			}
    		}
    	}
    	$this->assign('data',$drr);
    	$this->display();
    }
    public function jrpointdwdatefwss(){
    	$dwnameid = $_GET['dwnameid'];
    	
    	$drr = M('danwei') -> where("dwnameid = '$dwnameid'") -> select();
    	
    	$dates = cookie('dates');
    	$date = cookie('date');
    	$datest = strtotime($dates);
    	$datet = strtotime($date);
    	$datefw = round($datest - $datet)/3600/24;
    	
    	for($i = 0; $i <= $datefw; $i++){
    		
    		$where['date'] = date("Y-m-d",strtotime("+".$i."day",strtotime($date)));
    		$datefws = date("Y-m-d",strtotime("+".$i."day",strtotime($date)));
    		
    		$where['shenhe'] = 1;
    		$jrps = M('jrpointsum');
    		
	    	$data = $jrps -> where($where) -> field('jgh,sum(sum) as sums') -> group('jgh') -> select();
	    	
	    	$datefwss[] = date("Y-m-d",strtotime("+".$i."day",strtotime($date)));
	    	
	    	foreach($drr as &$valued){
	    		
	    		foreach($data as &$value){
	    			
	    			if($valued['dwnameid'] == $value['jgh']){
	    				
	    				$valued[$datefws] = $value['sums'];
	    				break;
	    			}
	    		}
	    	}
    	}
//  	var_dump($datefwss,$drr,$data);
    	$this->assign('datefwss',$datefwss);
    	$this->assign('data',$drr);
    	$this->display();
    }
    
    public function jrpointdwdatefwdts(){
    	$d = M('danwei');
    	$drr = $d -> where('jiagou = "A1"') -> order('pianqu asc') -> select();
    	
    	$date = substr($_POST['date_date'],0,10);
    	$dates = substr($_POST['date_date'],-10,10);
    	$datest = strtotime($dates);
    	$datet = strtotime($date);
    	$datefw = round($datest - $datet)/3600/24;
    	for($i = 0; $i <= $datefw; $i++){
    		$where['date'] = date("Y-m-d",strtotime("+".$i."day",strtotime($date)));
    		$datefws = date("Y-m-d",strtotime("+".$i."day",strtotime($date)));
    		//var_dump($where);
    		$where['shenhe'] = 1;
    		$jrps = M('jrpointsum');
	    	$data = $jrps -> where($where) -> field('jgh,sum(sum) as sums') -> group('jgh') -> select();
	    	$datefwss[] = date("Y-m-d",strtotime("+".$i."day",strtotime($date)));
	    	foreach($drr as &$valued){
	    		foreach($data as &$value){
	    			if($valued['jgh'] == $value['jgh']){
	    				$valued[$datefws] = $value['sums'];
	    				
	    			}
	    		}
	    	}
    	}
    	//var_dump($drr);
    	$this->assign('datefwss',$datefwss);
//  	$where['shenhe'] = 1;
//  	$where['date'] = array( array('egt',$date) , array('elt',$dates) , 'and' );
//  	cookie('date',$date);
//  	cookie('dates',$dates);
//  	$jrps = M('jrpointsum');
//  	$data = $jrps -> where($where) -> field('jgh,sum(sum) as sums') -> group('jgh') -> select();
//  	foreach($drr as &$valued){
//  		foreach($data as &$value){
//  			if($valued['jgh'] == $value['jgh']){
//  				$valued['sums'] = $value['sums'];
//  			}
//  		}
//  	}
    	$this->assign('data',$drr);
    	$this->display();
    }
    public function jrpointdwdatefwtbs(){
    	$d = M('danwei');
    	$drr = $d -> where('jiagou = "A1"') -> order('pianqu asc') -> select();
    	
    	$date = substr($_POST['date_date'],0,10);
    	$dates = substr($_POST['date_date'],-10,10);
    	$datest = strtotime($dates);
    	$datet = strtotime($date);
    	$datefw = round($datest - $datet)/3600/24;
    	for($i = 0; $i <= $datefw; $i++){
    		$where['date'] = date("Y-m-d",strtotime("+".$i."day",strtotime($date)));
    		$datefws = date("Y-m-d",strtotime("+".$i."day",strtotime($date)));
    		//var_dump($where);
    		$where['shenhe'] = 1;
    		$jrps = M('jrpointsum');
	    	$data = $jrps -> where($where) -> field('jgh,sum(sum) as sums') -> group('jgh') -> select();
	    	$datefwss[] = date("Y-m-d",strtotime("+".$i."day",strtotime($date)));
	    	foreach($drr as &$valued){
	    		foreach($data as &$value){
	    			if($valued['jgh'] == $value['jgh']){
	    				$valued[$datefws] = 已审;
	    				
	    			}
	    		}
	    	}
	    	
    	}
    	//var_dump($drr);
    	$this->assign('datefwss',$datefwss);
//  	$where['shenhe'] = 1;
//  	$where['date'] = array( array('egt',$date) , array('elt',$dates) , 'and' );
//  	cookie('date',$date);
//  	cookie('dates',$dates);
//  	$jrps = M('jrpointsum');
//  	$data = $jrps -> where($where) -> field('jgh,sum(sum) as sums') -> group('jgh') -> select();
//  	foreach($drr as &$valued){
//  		foreach($data as &$value){
//  			if($valued['jgh'] == $value['jgh']){
//  				$valued['sums'] = $value['sums'];
//  			}
//  		}
//  	}
    	$this->assign('data',$drr);
    	
    	$this->display();
   	}
    public function jrpointdwdateshpers(){
    	$where['jgh'] = $_GET['jgh'];
    	$where['date'] = cookie('datesh');
    	$where['shenhe'] = 0;
    	$jrps = M('jrpointsum');
    	//$jrpsrr = $jrps -> where($where) -> field('dwname,zhiwu,persname,pointcontentid,unit,score,point,sum(sum) as sums') -> group('dwname,zhiwu,persname,pointcontentid,unti,score') -> select();
    	$data = $jrps -> where($where) -> field('dwname,zhiwu,persname,gonghao,date,sum(point) as points,sum(sum) as sums') -> group('dwname,zhiwu,persname,gonghao,date') -> select();
    	//var_dump($where);
    	$this->assign('data',$data);
    	$this->display();
    }
    
    public function jrpointdwdatefwpers(){
    	$date = cookie('date');
    	$dates = cookie('dates');
    	$where['jgh'] = $_GET['dwnameid'];
    	$where['date'] = array( array('egt',$date) , array('elt',$dates) , 'and' );
    	$where['shenhe'] = 1;
    	$jrps = M('jrpointsum');
    	//$jrpsrr = $jrps -> where($where) -> field('dwname,zhiwu,persname,pointcontentid,score,point,sum(sum) as sums') -> group('dwname,zhiwu,persname,pointcontentid,unti,score') -> select();
    	$data = $jrps -> where($where) -> field('dwname,district,zhiwu,persname,gonghao,sum(point) as points,sum(sum) as sums') -> group('dwname,district,zhiwu,persname,gonghao') -> select();
    	//var_dump($jgh,$date);
    	$this->assign('data',$data);
    	$this->display();
    }
    
    public function jrpointdwdatefwpersinfo(){
    	$date = cookie('date');
    	$dates = cookie('dates');
    	$where['gonghao'] = $_GET['gonghao'];
    	$where['date'] = array( array('egt',$date) , array('elt',$dates) , 'and' );
    	$where['shenhe'] = 1;
    	$jrps = M('jrpointsum');
    	$data = $jrps -> where($where) -> field('dwname,district,zhiwu,persname,gonghao,sum(point) as points,sum(sum) as sums,date') -> group('dwname,district,zhiwu,persname,gonghao,date') -> select();
    	//$data = $jrps -> where($where) -> field('dwname,zhiwu,persname,gonghao,sum(point) as points,sum(sum) as sums') -> group('dwname,zhiwu,persname,gonghao') -> select();
    	$data = $this->content_item($data);
    	//var_dump($jgh,$date);
    	$this->assign('data',$data);
    	$this->display();
    }
    public function jrpointdwdateshpersinfo(){
    	$where['gonghao'] = $_GET['gonghao'];
    	$where['date'] = $_GET['date'];
    	$where['shenhe'] = 0;
    	$jrps = M('jrpointsum');
    	$data = $jrps -> where($where) -> field('dwname,district,zhiwu,persname,pointcontentid,score,point,sum') -> select();
    	$data = $this->content_item($data);
    	$sum = $jrps -> where($where) -> sum('sum');
    	$point = $jrps -> where($where) -> sum('point');
    	$this->assign('sum',$sum);
    	$this->assign('point',$point);
    	$this->assign('data',$data);
    	$this->display();
    }
    public function jrpointdwdatefwpersinfos(){
    	$where['gonghao'] = $_GET['gonghao'];
    	$where['date'] = $_GET['date'];
    	$where['shenhe'] = 1;
    	$jrps = M('jrpointsum');
    	$data = $jrps -> where($where) -> field('dwname,district,zhiwu,persname,pointcontentid,score,point,sum,date') -> select();
    	$data = $this->content_item($data);
    	$sum = $jrps -> where($where) -> sum('sum');
    	$point = $jrps -> where($where) -> sum('point');
    	$this->assign('sum',$sum);
    	$this->assign('point',$point);
    	$this->assign('data',$data);
    	$this->display();
    }
	public function jrpointdwitemdate(){
		$jpi = M('jrpointitem');
		$where['stats'] = 0;
		$jpirr = $jpi -> where($where) -> select();
		$this->assign('data',$jpirr);
		$this->display();
	}
    public function jrpointdwitemdates(){
    	
    	//var_dump($_POST['item']);
    	
    	foreach($_POST['item'] as $value){
    		$item[] = $value;
    	}
    	//var_dump($item);
    	
    	$where['pointitemid'] = array('in',$item);
    	$where['stats'] = 0;
    	
    	
    	$jpc = M('jrpointcontent');
    	
    	$jpcrr = $jpc -> field('pointcontentid,content') -> order('pointitemid') -> where($where) -> select();
    	foreach($jpcrr as &$value){
    		$pointcontentid[] = $value['pointcontentid'];
    		$content[] = $value['content'];
    	}
    	$wheresum['pointcontentid'] = array('in',$pointcontentid);
    	$wheresum['shenhe'] = 1;
    	$wheresum['date'] = $_POST['date'];
    	$jps = M('jrpointsum');
    	$data = $jps -> where($wheresum) -> field('jgh,pointcontentid,sum(point) as sums,date') -> group('jgh,pointcontentid,date') -> select();
    	
    	
    	
    	$data = $this->content_item($data);
    	$d = M('danwei');
    	$drr = $d -> where('jiagou = "A1"') -> order('pianqu asc') -> select();
    	
    	foreach($drr as &$valued){
    		
    		foreach($data as &$value){
    			
    			if($valued['jgh'] == $value['jgh']){
    				
    				$valued[$value['pointcontentid']] = $value['sums'];
    				continue;
    			}
    		}
    	}
    	
    	//var_dump($drr);
    	$this->assign('content',$content);
    	$this->assign('pointcontentid',$pointcontentid);
    	$this->assign('data',$drr);
    	$this->display();
    	
    }
	public function jrpointdwitemsdate(){
		$jpi = M('jrpointitem');
		$where['stats'] = 0;
		$jpirr = $jpi -> where($where) -> select();
		$this->assign('data',$jpirr);
		$this->display();
	}
    public function jrpointdwitemsdates(){
    	
    	//var_dump($_POST['item']);
    	
    	foreach($_POST['item'] as $value){
    		$item[] = $value;
    	}
    	//var_dump($item);
    	
    	$where['pointitemid'] = array('in',$item);
    	$where['stats'] = 0;
    	$jpi = M('jrpointitem');
    	$jpirr = $jpi -> where($where) -> select();
    	//var_dump($jpirr);
    	
    	
    	$jpc = M('jrpointcontent');
    	
    	$jpcrr = $jpc -> field('pointcontentid,pointitemid,content') -> order('pointitemid') -> where($where) -> select();
    	foreach($jpcrr as &$value){
    		$pointcontentid[] = $value['pointcontentid'];
    		$content[] = $value['content'];
    	}
    	$wheresum['pointcontentid'] = array('in',$pointcontentid);
    	$wheresum['shenhe'] = 1;
    	$wheresum['date'] = $_POST['date'];
    	$jps = M('jrpointsum');
    	$data = $jps -> where($wheresum) -> field('jgh,pointcontentid,sum(point) as sums,date') -> group('jgh,pointcontentid,date') -> select();
    	foreach($jpcrr as &$valuejpc){
    		
    		foreach($data as &$value){
    			
    			if($valuejpc['pointcontentid'] == $value['pointcontentid']){
    				
    				$value['pointitemid'] = $valuejpc['pointitemid'];
    			}
    		}
    	}
    	foreach($jpirr as &$valuejpi){
    		
    		foreach($data as &$value){
    			
    			if($valuejpi['pointitemid'] == $value['pointitemid']){
    				
    				$datas[$value['jgh']]['sum'] += $value['sums'];
    				$datas[$value['jgh']]['jgh'] = $value['jgh'];
    				$datas[$value['jgh']]['pointitemid'] = $value['pointitemid'];
    				//$datas[$value['jgh']]['pointcontentid'] = $value['pointcontentid'];
    			}
    		}
    	}
    	//var_dump($datas);
    	
    	//$data = $this->content_item($datas);
    	$d = M('danwei');
    	$drr = $d -> where('jiagou = "A1"') -> order('pianqu asc') -> select();
    	
    	foreach($drr as &$valued){
    		
    		foreach($datas as &$value){
    			
    			if($valued['jgh'] == $value['jgh']){
    				
    				$valued[$value['pointitemid']] = $value['sum'];
    				continue;
    			}
    		}
    	}
    	
    	//var_dump($drr);
    	$this->assign('item',$jpirr);
    	$this->assign('pointitemid',$pointitemid);
    	//$this->assign('pointcontentid',$pointcontentid);
    	$this->assign('data',$drr);
    	
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
    	//var_dump($jpirr,$jpcrr);
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
	    		$pointitemid['pointcontentid'] = array('in',$items[$valuejpi['pointitemid']]);
	    		$pointitemid['date'] = array( array('egt',$date) , array('elt',$dates) , 'and' );
	    		$jpsrr[] = $jps -> where($pointitemid) -> field('jgh,sum(point) as sums') -> group('jgh') -> select();
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
		    	$jpsrr[] = $jps -> where($pointcontentid) -> field('jgh,pointcontentid,sum(point) as sums') -> group('jgh,pointcontentid') -> select();
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
    	
    	$d = M('danwei');
    	$whered['jiagou'] = 'A1';
    	$whered['districtid'] = $dwname['districtid'];
    	$drr = $d -> where($whered) -> order('pianqu asc') -> select();
    	
    	foreach($drr as &$valued){
    		
    		foreach($jpsrr as $key=>$valuejps){
    			
    			foreach($valuejps as &$value){
    				
    				//var_dump($key);
    				if($valued['dwnameid'] == $value['jgh']){
    					
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
    	$this->assign('data',$drr);
    	
    	$this->display();
    }
    
    
    
    public function jractivedwdate(){
    	$activecontentid = $_GET['activecontentid'];
    	cookie('activecontentid',$activecontentid);
    	$javc = M('jractivecontent');
    	$javcrr = $javc -> where("activecontentid = '$activecontentid'") -> select();
    	
    	$this->assign('datas',$javcrr);
    	
    	$this->display();
    }
    public function jractivedwdates(){
    	$activecontentid = cookie('activecontentid');
    	$javc = M('jractivecontent');
    	$javcrr = $javc -> where("activecontentid = '$activecontentid'") -> select();
    	$this->assign('datas',$javcrr);
    	
    	$javi = M('jractiveitem');
    	$javirr = $javi -> where("activecontentid = '$activecontentid'") -> select();
    	
    	$this->assign('javirr',$javirr);
    	//var_dump($javirr);
    	$date = $_POST['date'];
    	$where['date'] = $date;
    	$where['shenhe'] = 1;
    	$where['activecontentid'] = $activecontentid;
    	$javs = M('jractivesum');
    	$data = $javs -> where($where) -> select();
    	$data = $this->jractive($data);
    	
    	$d = M('danwei');
    	$drr = $d -> where('jiagou = "A1"') -> order('pianqu asc') -> select();
    	
    	foreach($drr as &$valued){
    		
    		foreach($data as &$value){
    			
    			if($valued['jgh'] == $value['jgh']){
    				//计算需要的值;
    				$valued[$valued['jgh']][]['point'] = $value['point'];
    				
    				$valued[$value['activeitemid']]['point'] = $value['point'];
    				
    				//var_dump($value);
    			}
    		}
    	}
    	
    	foreach($drr as &$value){
    		
    		$value[$value['dwname']]['dqyz'] = $value[$value['jgh']][1]['point'] - $value[$value['jgh']][6]['point'];
    		$value[$value['dwname']]['dqzc'] = round($value[$value['jgh']][4]['point']/$value[$value['jgh']][6]['point']*100,0).'%';
    		$value[$value['dwname']]['thcf'] = round($value[$value['jgh']][2]['point']/$value[$value['jgh']][1]['point']*100,0).'%';
    		//var_dump($value);
    	}
    	
    	$this->assign('data',$drr);
    	//var_dump($drr);
    	$this->display();
    }
    public function jractivebxdate(){
    	$activecontentid = $_GET['activecontentid'];
    	cookie('activecontentid',$activecontentid);
    	$javc = M('jractivecontent');
    	$javcrr = $javc -> where("activecontentid = '$activecontentid'") -> select();
    	
    	$this->assign('datas',$javcrr);
    	
    	$this->display();
    }
    public function jractivebxdates(){
    	$activecontentid = cookie('activecontentid');
    	$javc = M('jractivecontent');
    	$javcrr = $javc -> where("activecontentid = '$activecontentid'") -> select();
    	$this->assign('datas',$javcrr);
    	
    	$javi = M('jractiveitem');
    	$javirr = $javi -> where("activecontentid = '$activecontentid'") -> select();
    	
    	$this->assign('javirr',$javirr);
    	//var_dump($javirr);
    	$date = $_POST['date'];
    	$where['date'] = $date;
    	$where['shenhe'] = 1;
    	$where['activecontentid'] = $activecontentid;
    	$javs = M('jractivesum');
    	$data = $javs -> where($where) -> select();
    	$data = $this->jractive($data);
    	
    	$d = M('danwei');
    	$drr = $d -> where('jiagou = "A1"') -> order('pianqu asc') -> select();
    	
    	foreach($drr as &$valued){
    		
    		foreach($data as &$value){
    			
    			if($valued['jgh'] == $value['jgh']){
    				
    				$valued[$value['activeitemid']]['point'] = $value['point'];
    				
    				//var_dump($value);
    			}
    		}
    	}
    	
    	$this->assign('data',$drr);
    	//var_dump($drr);
    	$this->display();
    }
    public function jractivedwdatefw(){
    	$activecontentid = $_GET['activecontentid'];
    	cookie('activecontentid',$activecontentid);
    	$javc = M('jractivecontent');
    	$javcrr = $javc -> where("activecontentid = '$activecontentid'") -> select();
    	
    	$this->assign('datas',$javcrr);
    	
    	$this->display();
    }
    public function jractivedwdatefws(){
    	$activecontentid = cookie('activecontentid');
    	$javc = M('jractivecontent');
    	$javcrr = $javc -> where("activecontentid = '$activecontentid'") -> select();
    	$this->assign('datas',$javcrr);
    	
    	$javi = M('jractiveitem');
    	$javirr = $javi -> where("activecontentid = '$activecontentid'") -> select();
    	$this->assign('javirr',$javirr);
    	
    	$date = substr($_POST['date_date'],0,10);
    	$dates = substr($_POST['date_date'],-10,10);
    	$where['date'] = array( array('egt',$date) , array('elt',$dates) , 'and' );
    	$where['shenhe'] = 1;
    	$where['activecontentid'] = $activecontentid;
    	$javs = M('jractivesum');
    	$data = $javs -> where($where) -> field('jgh,activecontentid,activeitemid,sum(point) as sums') -> group('jgh,activecontentid,activeitemid') -> select();
    	$data = $this->jractive($data);
    	
    	$d = M('danwei');
    	$drr = $d -> where('jiagou = "A1"') -> order('pianqu asc') -> select();
    	
    	foreach($drr as &$valued){
    		
    		foreach($data as &$value){
    			
    			if($valued['jgh'] == $value['jgh']){
    				//需要计算的值;
    				$valued[$value['jgh']][]['point'] = $value['sums'];
    				$valued[$value['activeitemid']]['point'] = $value['sums'];
    				
    				//var_dump($value);
    			}
    		}
    	}
    	
    	foreach($drr as &$value){
    		
    		$value[$value['dwname']]['dqyz'] = $value[$value['jgh']][1]['point'] - $value[$value['jgh']][6]['point'];
    		$value[$value['dwname']]['dqzc'] = round($value[$value['jgh']][4]['point']/$value[$value['jgh']][1]['point']*100,0).'%';
    		$value[$value['dwname']]['thcf'] = round($value[$value['jgh']][2]['point']/$value[$value['jgh']][1]['point']*100,0).'%';
    		//var_dump($value);
    	}
    	
    	$this->assign('data',$drr);
    	//var_dump($drr);
    	$this->display();
    }
    public function jractivebxdatefw(){
    	$activecontentid = $_GET['activecontentid'];
    	cookie('activecontentid',$activecontentid);
    	$javc = M('jractivecontent');
    	$javcrr = $javc -> where("activecontentid = '$activecontentid'") -> select();
    	
    	$this->assign('datas',$javcrr);
    	
    	$this->display();
    }
    public function jractivebxdatefws(){
    	$activecontentid = cookie('activecontentid');
    	$javc = M('jractivecontent');
    	$javcrr = $javc -> where("activecontentid = '$activecontentid'") -> select();
    	$this->assign('datas',$javcrr);
    	
    	$javi = M('jractiveitem');
    	$javirr = $javi -> where("activecontentid = '$activecontentid'") -> select();
    	$this->assign('javirr',$javirr);
    	
    	$date = substr($_POST['date_date'],0,10);
    	$dates = substr($_POST['date_date'],-10,10);
    	$where['date'] = array( array('egt',$date) , array('elt',$dates) , 'and' );
    	$where['shenhe'] = 1;
    	$where['activecontentid'] = $activecontentid;
    	$javs = M('jractivesum');
    	$data = $javs -> where($where) -> field('jgh,activecontentid,activeitemid,sum(point) as sums') -> group('jgh,activecontentid,activeitemid') -> select();
    	$data = $this->jractive($data);
    	
    	$d = M('danwei');
    	$drr = $d -> where('jiagou = "A1"') -> order('pianqu asc') -> select();
    	
    	foreach($drr as &$valued){
    		
    		foreach($data as &$value){
    			
    			if($valued['jgh'] == $value['jgh']){
    				
    				$valued[$value['activeitemid']]['point'] = $value['sums'];
    				
    				//var_dump($value);
    			}
    		}
    	}
    	
    	$this->assign('data',$drr);
    	//var_dump($drr);
    	$this->display();
    }
    public function jrpointperspays(){
    	// $where['shenhe'] = '审核通过';
    	// $where['qjts'] = array('gt',12);
    	// $date = substr($_POST['date_date'],0,10);
    	// $dates = substr($_POST['date_date'],-10,10);
    	// $where['date'] = array( array('egt',$date) , array('elt',$dates) , 'and' );
    	
    	// $qj = M('qingjia');
    	// $where['zhiwu'] = array( array('notin','网点负责人') , array('notin','大堂经理') , array('notin','客户经理') , 'and');
    	// $qjrr = $qj -> where($where) -> field('gonghao') -> select();
    	// foreach($qjrr as &$value){
    		
    	// 	$qjr[] = $value['gonghao'];
    	// }
    	// if($qjr == null){
    	// 	$qjrrr = '04000282';
    	// 	$qjr = '04000282';
    	// }else{
    	// 	$qjrrr = implode(',',$qjr);
    	// }
    	
    	//var_dump($qjrrr);
    	
    	
    	//$jps = M('jrpointsum');
    	//$data = $jps -> where($where) -> field('jgh,zhiwud,gonghao,persname,sum(sum) as sums') -> group('zhiwud,gonghao,persname') -> select();
    	//$data = $this->persinfo($data);
    	
    	$User = D('');
    	// $data = $User -> query("select hr_jrpointsum.jgh,hr_jrpointsum.zhiwud,hr_jrpointsum.persname,gonghao,sum(hr_jrpointsum.sum) as sums from hr_jrpointsum where hr_jrpointsum.shenhe = 1 and gonghao not in ($qjrrr) and date >= '$date' and date <= '$dates' and zhiwud <> 75 group by hr_jrpointsum.jgh,hr_jrpointsum.zhiwud,hr_jrpointsum.persname,gonghao");
    	// $datass = $User -> query("select persname,gonghao,substring_index(group_concat(jgh order by jgh asc),',',1) as jgh from hr_jrpointsum where zhiwud <> 75 and date >= '$date' and date <= '$dates' and gonghao not in ($qjrrr) and shenhe = 1 group by persname,gonghao");
		//var_dump($datass,$data);
		$dwname = cookie('dwname');
		$where['districtid'] = $dwname['districtid'];
    	$date = substr($_POST['date_date'],0,10);
		$dates = substr($_POST['date_date'],-10,10);
		$da = substr($_POST['date_date'],0,7);
		$das = substr($_POST['date_date'],-10,7);
		if($da != $das){
			$this->error('奖金不能跨月查询，请选择在同一个月内');
		}
		// $date = $_POST['date_date'];
		// var_dump($date);
		$where['date'] = array( array('egt',$date) , array('elt',$dates) , 'and' );
		// $where['date'] = $date;
		$where['shenhe'] = 1;
		// $lungang['zhiwu'] = array( array('notin','75'), array('notin','18') , array('notin','45') , 'and');
		$where['zhiwud'] = array('notin', '1');
    	// $lungang['gongzhong'] = array('notin','900');
    	// $lungang['gonghao'] = array('notin',$qjr);
    	// $l = M('lungang');
    	// $lrr = $l -> where($lungang) -> field('districtid,dwname,count(gonghao) as counts') -> group('dwname，districtid') -> select();
    	//var_dump($lrr);
    	
    	// $dateb = date('Y-m-d');
    	// $lungang['date'] = array( array('egt',$dates) , array('elt',$dateb) , 'and' );
    	// $jlt = M('jrlgtransfer');
    	// $jltrr = $jlt -> where($lungang) -> select();
    	//var_dump($datass);
		
		$jps = M('jrpointsum');
		$jpsrr = $jps -> field('districtid,persname,jgh,zhiwu,gongzhong,dwname,zhiwud,sum(sum) as sums') -> order('jgh desc') -> where($where) -> group('persname,zhiwu,dwname,jgh,zhiwud,gongzhong') -> select();
		
		$jpsr = $jps -> field('districtid,jgh,sum(sum) as sums') -> where($where) -> group('districtid,jgh') -> select();

		foreach($jpsrr as &$val){

			foreach($jpsr as &$value){

				if($value['jgh'] == $val['jgh']){

					$val['total'] = round($val['sums'] / $value['sums'] , 4) * 100 . '%';
					break;
				}
			}
		}

		$bl = M('bonuslist');
		$wherebl['date'] = $da;
		$wherebl['stats'] = 0;
		$wherebl['district'] = $dwname['districtid'];

		$blrr = $bl -> where($wherebl) -> select();

		foreach($jpsrr as &$val){

			foreach($blrr as &$value){

				if($val['jgh'] == $value['dwname']){
					
					$val['reward'] = $val['total'] * $value['bonus'] / 100;
					break;
				}
			}
		}

		$this->assign('data',$jpsrr);
		$this->display();
		// var_dump($blrr,$wherebl,$jpsrr);
    	// foreach($lrr as &$valuelg){
    		
    	// 	foreach($jltrr as &$valuejlt){
    			
    	// 		if($valuelg['dwname'] == $valuejlt['ydwname']){
    				
    	// 			$valuelg['counts'] = $valuelg['counts'] + 1;
    	// 			//continue;
    	// 			//var_dump($valuelg['counts'],$valuelg['dwname']);
    	// 		}
    	// 		if($valuelg['dwname'] == $valuejlt['dwname']){
    				
    	// 			$valuelg['counts'] = $valuelg['counts'] - 1;
    	// 			//continue;
    	// 			//var_dump($valuelg['counts'],$valuelg['dwname']);
    	// 		}
    	// 	}
    	// }
    	// foreach($lrr as &$value){
    		
    	// 	$value['pay'] = $value['counts'] * 900;
    	// }
    	
    	
    	// $d = M('danwei');
    	// $drr = $d -> where('jiagou = "A1"') -> order('pianqu asc') -> select();
    	
    	
    	
    	// foreach($datass as &$valuess){
    		
    	// 	foreach($data as &$value){
    			
    	// 		if($valuess['persname'] == $value['persname']){
    				
    	// 			$valuess['sums'] += $value['sums'];
    	// 		}
    	// 	}
    	// }
    	
    	// foreach($drr as &$valued){
    		
    	// 	foreach($datass as &$value){
    			
    	// 		if($valued['jgh'] == $value['jgh']){
    	// 			$value['dwname'] = $valued['dwname'];
    	// 			$valued['sums'] += $value['sums'];
    				
    	// 		}
    	// 	}
    	// }
    	// //var_dump($datass,$drr,$lrr);
    	// foreach($drr as &$valued){
    		
    	// 	foreach($datass as &$valuess){
    			
    	// 		if($valuess['jgh'] == $valued['jgh']){
    				
    	// 			$valuess['avg'] = $valuess['sums']/$valued['sums'];
    	// 			$valuess['avgs'] = round($valuess['avg']*100,2).'%';
    	// 		}
    	// 	}
    	// }
    	// foreach($lrr as &$valuelg){
    		
    	// 	foreach($datass as &$valuess){
    			
    	// 		if($valuelg['dwname'] == $valuess['jgh']){
    				
    	// 			$valuess['reward'] = round($valuess['avg'] * $valuelg['pay'],2);
    	// 		}
    	// 	}
    	// }
    	// $this->assign('data',$datass);
    	// $this->display();
    }
    
    
    
    
    
    
    
    
    
    
    
    
    public function lunganginfo(){
    	$stats['stats'] = array('notin', '9');
    	$p = M('lungang');
    	$prr = $p -> where($stats) -> select();
    	
    	$prr = $this -> persinfo($prr);
    	
    	$this->assign('data',$prr);
    	$this->display();
    	
    }
    public function persadd(){
    	$dwname = cookie('dwname');
    	$districtid['districtid'] = $dwname['districtid'];
    	$districtid['stats'] = 0;
    	$stats['stats'] = 0;
    	
    	$drr = M('danwei') -> where($districtid) -> select();
    	$this->assign('drr',$drr);
    	
    	$zrr = M('zhiwu') -> where($stats) -> select();
    	$this->assign('zrr',$zrr);
    	
    	$grr = M('gongzhong') -> where($stats) -> select();
    	$this->assign('grr',$grr);
    	
    	$disrr = M('district') -> where($districtid) -> select();
    	$this->assign('disrr',$disrr);
    	
    	$this->display();
    }
    public function persaddsuc(){
    	//var_dump($_POST);
    	$_POST['stats'] = 0;
    	$prr = M('lungang') -> add($_POST);
    	
    	$username['username'] = $_POST['gonghao'];
    	$username['password'] = $_POST['gonghao'];
    	$username['stats'] = 0;
    	$username['auth'] = 0;
    	$username['districtid'] = $_POST['districtid'];
    	
    	$lrr = M('login') -> add($username);
    	
    	if($prr > 0 and $lrr > 0){
    		$this->success('员工添加成功，请继续');
    	}else{
    		$this->error('员工添加失败，请检查数据');
    	}
	}




    public function lungangauth(){
    	$l = M('login');
    	$lrr = $l -> select();
    	
    	
    }
}