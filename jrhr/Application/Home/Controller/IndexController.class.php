<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	public function _initialize(){
		$dwname = cookie('dwname');
		$this->assign('user',$dwname);
    	if($dwname['qx'] == null){
    		$this->error('您还未登录,请登录后再操作',U('Login/login'),1);
    	}else{
    		
    	}
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
    			if($value['dwname'] == $valued['jgh']){
    				$value['dwname'] = $valued['dwname'];
    				$value['jgh'] = $valued['jgh'];
    				
    			}
    			if($value['ydwname'] == $valued['jgh']){
    				$value['ydwname'] = $valued['dwname'];
    				$value['yjgh'] = $valued['jgh'];
    				continue;
    			}
    		}
    	}
    	$d = M('fzdanwei');
    	$drr = $d -> select();
    	foreach($prr as &$value){
    		foreach($drr as &$valued){
    			if($value['fzdwname'] == $valued['fzjgh']){
    				$value['fzdwname'] = $valued['fzdwname'];
    				$value['fzjgh'] = $valued['fzjgh'];
    				continue;
    			}
    		}
    	}
    	$d = M('zhiwu');
    	$drr = $d -> select();
    	foreach($prr as &$value){
    		foreach($drr as &$valued){
    			if($value['zhiwu'] == $valued['zhiwud']){
    				$value['zhiwu'] = $valued['zhiwu'];
    				$value['zhiwud'] = $valued['zhiwud'];
    				
    			}
    			if($value['yzhiwu'] == $valued['zhiwud']){
    				$value['yzhiwu'] = $valued['zhiwu'];
    				$value['yzhiwud'] = $valued['zhiwud'];
    				continue;
    			}
    		}
    	}
    	$d = M('gongzhong');
    	$drr = $d -> select();
    	foreach($prr as &$value){
    		foreach($drr as &$valued){
    			if($value['gongzhong'] == $valued['gongzhongd']){
    				$value['gongzhong'] = $valued['gongzhong'];
    				$value['gongzhongd'] = $valued['gongzhongd'];
    				continue;
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
    public function index(){
        //$this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
        $this->display();
    }
    public function logout(){
    	cookie('dwname',null);
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
    }
    public function indexlungang(){
    	$d = M('danwei');
    	$drr = $d -> where('jiagou = "A1"') -> order('pianqu asc') -> select();
    	
    	$z = M('zhiwu');
    	$zrr = $z -> select();
    	
    	$p = M('lungang');
    	//$wherep['dwname'] = array('in',$drrr);
    	
    	$prr = $p -> select();
    	
    	foreach($prr as &$value){
    		foreach($zrr as &$valuez){
    			if($valuez['zhiwud'] == $value['zhiwu']){
    				$value['zwjiagou'] = $valuez['zwjiagou'];
    				$value['zhiwud'] = $valuez['zhiwud'];
    				$value['zhiwu'] = $valuez['zhiwu'];
    			}
    		}
    	}
    	$g = M('gongzhong');
    	$grr = $g -> select();
    	foreach($prr as &$value){
    		foreach($grr as &$valueg){
    			if($valueg['gongzhongd'] == $value['gongzhong']){
    				$value['gongzhong'] = $valueg['gongzhong'];
    				continue;
    			}
    		}
    	}
    	$pq = M('pianqu');
    	$pqrr = $pq -> select();
    	
    	foreach($drr as &$valued){
    		foreach($pqrr as &$valuepq){
    			if($valuepq['pianqu'] == $valued['pianqu']){
    				$valued['pianquname'] = $valuepq['pianquname'];
    				continue;
    			}
    		}
    	}
    	foreach($drr as &$valued){
    		$jgh = $valued['jgh'];
    		$valued['count'] = $p -> where("dwname = '$jgh'") -> count();
//  		foreach($zrr as &$valuez){
    			foreach($prr as &$value){
    				if($valued['jgh'] == $value['dwname'] and $value['zwjiagou'] == 'A1'){
    					$wdfzr[] = array(
    					'persname' => $value['persname'],
    					'gongzhong' => $value['gongzhong'],
    					'zhiwu' => $valuez['zhiwu'],
    					'dwname' => $valued['dwname'],
    					'gonghao' => $value['gonghao'],
    					);
    					
    				}
					
    				if($valued['jgh'] == $value['dwname'] and $value['zwjiagou'] == 'A2'){
    					
    					$zhgy[] = array(
    					'persname' => $value['persname'],
    					'gongzhong' => $value['gongzhong'],
    					'zhiwu' => $valuez['zhiwu'],
    					'dwname' => $valued['dwname'],
    					'gonghao' => $value['gonghao'],
    					);
    					
    				}
    				if($valued['jgh'] == $value['dwname'] and $value['zwjiagou'] == 'A3'){
    					
    					$lcjl[] = array(
    					'persname' => $value['persname'],
    					'gongzhong' => $value['gongzhong'],
    					'zhiwu' => $valuez['zhiwu'],
    					'dwname' => $valued['dwname'],
    					'gonghao' => $value['gonghao'],
    					);
    					
    				}
    				if($valued['jgh'] == $value['dwname'] and $value['zwjiagou'] == 'A4'){
    					
    					$dtjl[] = array(
    					'persname' => $value['persname'],
    					'gongzhong' => $value['gongzhong'],
    					'zhiwu' => $valuez['zhiwu'],
    					'dwname' => $valued['dwname'],
    					'gonghao' => $value['gonghao'],
    					);
    					
    				}
    				if($valued['jgh'] == $value['dwname'] and $value['zwjiagou'] == 'A5'){
    					
    					$khjl[] = array(
    					'persname' => $value['persname'],
    					'gongzhong' => $value['gongzhong'],
    					'zhiwu' => $valuez['zhiwu'],
    					'dwname' => $valued['dwname'],
    					'gonghao' => $value['gonghao'],
    					);
    					
    				}
    				if($valued['jgh'] == $value['dwname'] and $value['zwjiagou'] == 'A6'){
    					
    					$ptgy[] = array(
    					'persname' => $value['persname'],
    					'gongzhong' => $value['gongzhong'],
    					'zhiwu' => $valuez['zhiwu'],
    					'dwname' => $valued['dwname'],
    					'gonghao' => $value['gonghao'],
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
    		$counts[] = $value['jgh'];
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
    	$count['counts'] = $p -> where($wherejgh) -> count();
    	$count['wdfzr'] = $p -> where($wherewdfzr) -> count();
    	$count['zhgy'] = $p -> where($wherezhgy) -> count();
    	$count['lcjl'] = $p -> where($wherelcjl) -> count();
    	$count['dtjl'] = $p -> where($wheredtjl) -> count();
    	$count['khjl'] = $p -> where($wherekhjl) -> count();
    	$count['ptgy'] = $p -> where($whereptgy) -> count();
    	$this -> assign('count',$count);
    	//var_dump($count);
    	$index = 'indexjr';
    	cookie('index',$index,3600);
    	//var_dump($data);
    	$this->assign('data',$drr);
    	$this->display();
    }
    public function persmodify(){
    	$admin = cookie('dwname');
    	if($admin['qx'] == 9){
    		
	    	$d = M('danwei');
	    	$drr = $d -> where("jiagou = 'A1'")  -> select();
	    	$this->assign('drr',$drr);
	    	
	    	$z = M('zhiwu');
	    	$wherezw['zwjiagou'] = array('in','A1,A2,A3,A4,A5,A6');
	    	$zrr = $z -> where($wherezw) -> select();
	    	$this->assign('zrr',$zrr);
	    	
	    	$gonghao = $_GET['gonghao'];
	    	$p = M('lungang');
	    	$prr = $p -> where("gonghao = '$gonghao'") -> select();
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
    	$gonghao = $_POST['gonghao'];
    	$where['dwname'] = $_POST['dwname'];
    	$where['zhiwu'] = $_POST['zhiwu'];
    	$p = M('lungang');
    	$lrr = $p -> where("gonghao = '$gonghao'") -> find();
    	$wherelg['ydwname'] = $lrr['dwname'];
    	$wherelg['yzhiwu'] = $lrr['zhiwu'];
    	if($_POST['exp'] == null){
    		
    	}else{
    		$wherelg['exp'] = $_POST['exp'];
    	}
    	if($_POST['dateo'] == null){
    		
    	}else{
    		$wherelg['dateo'] = $_POST['dateo'];
    	}
    	//var_dump($where,$gonghao);
    	$pr = $p -> where("gonghao = '$gonghao'") -> save($where);
    	if($pr > 0){
    		$wherelg['gonghao'] = $gonghao;
    		$wherelg['persname'] = $lrr['persname'];
    		$wherelg['zhiwu'] = $_POST['zhiwu'];
    		$wherelg['dwname'] = $_POST['dwname'];
    		$wherelg['date'] = $_POST['date'];
    		$jl = M('jrlgtransfer');
    		$jlrr = $jl -> add($wherelg);
    		$this -> success('员工轮岗成功,请继续',U('Index/indexlungang'));
    	}else{
    		$this->error('员工轮岗不成功,请检查数据');
    	}
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
    	$jpi = M('jrpointitem');
    	
    	$jpirr = $jpi -> select();
    	$count = $jpi -> count();
    	
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
    	$jpi = M('jrpointitem');
    	$jpirr = $jpi -> select();
    	$jpc = M('jrpointcontent');
    	$jpcrr = $jpc -> select();
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
    public function pointitemaddsuc(){
    	//var_dump($_POST);
    	$where['item'] = $_POST['item'];
    	$where['beizhu'] = $_POST['beizhu'];
    	$where['stats'] = 0;
    	$jrpi = M('jrpointitem');
    	$jrpirr = $jrpi -> add($where);
    	if($jrpirr > 0){
    		$this->success('项目添加成功,请继续',U('Index/pointitem'));
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
    	$jrpi = M('jrpointitem');
    	$jrpirr = $jrpi -> field('pointitemid,item') -> select();
    	$this->assign('jrpirr',$jrpirr);
    	$this->display();
    }
    public function pointcontentaddsuc(){
    	//var_dump($_POST);
    	$where['content'] = $_POST['content'];
    	$where['pointitemid'] = $_POST['pointitemid'];
    	$where['beizhu'] = $_POST['beizhu'];
    	$where['stats'] = 0;
    	$where['unit'] = $_POST['unit'];
    	$where['score'] = $_POST['score'];
    	$jrpc = M('jrpointcontent');
    	$jrpcrr = $jrpc -> add($where);
    	if($jrpcrr > 0){
    		$this->success('项目添加成功,请继续',U('Index/pointcontent'));
    	}else{
    		$this->error('项目添加失败,请检查数据');
    	}
    }
    public function jrpointdwdates(){
    	$d = M('danwei');
    	$drr = $d -> where('jiagou = "A1"') -> order('pianqu asc') -> select();
    	
    	//var_dump(substr($_POST['date_date'],0,10));
    	//var_dump(substr($_POST['date_date'],-10,10));
    	$date = $_POST['date'];
    	
    	$where['shenhe'] = 1;
    	$where['date'] = $date;
    	$jrps = M('jrpointsum');
    	$data = $jrps -> where($where) -> field('jgh,sum(sum) as sums') -> group('jgh') -> select();
    	foreach($drr as &$valued){
    		foreach($data as &$value){
    			if($valued['jgh'] == $value['jgh']){
    				$valued['sums'] = $value['sums'];
    				$valued['date'] = $date;
    			}
    		}
    	}
    	$this->assign('data',$drr);
    	$this->display();
    }
    public function jrpointdwdateshs(){
    	$d = M('danwei');
    	$drr = $d -> where('jiagou = "A1"') -> order('pianqu asc') -> select();
    	
    	//var_dump(substr($_POST['date_date'],0,10));
    	//var_dump(substr($_POST['date_date'],-10,10));
    	$date = $_POST['date'];
    	cookie('datesh',$date);
    	$where['shenhe'] = 1;
    	$where['date'] = $date;
    	$jrps = M('jrpointsum');
    	$data = $jrps -> where($where) -> field('jgh,sum(sum) as sums') -> group('jgh') -> select();
    	foreach($drr as &$valued){
    		foreach($data as &$value){
    			if($valued['jgh'] == $value['jgh']){
    				$valued['sums'] = $value['sums'];
    				$valued['date'] = $date;
    			}
    		}
    	}
    	$this->assign('data',$drr);
    	$this->display();
    }
    public function jrpointdwdatetbs(){
    	$d = M('danwei');
    	$drr = $d -> where('jiagou = "A1"') -> order('pianqu asc') -> select();
    	
    	//var_dump(substr($_POST['date_date'],0,10));
    	//var_dump(substr($_POST['date_date'],-10,10));
    	$date = $_POST['date'];
    	
    	$where['shenhe'] = 1;
    	$where['date'] = $date;
    	$jrps = M('jrpointsum');
    	$data = $jrps -> where($where) -> field('jgh,sum(sum) as sums') -> group('jgh') -> select();
    	foreach($drr as &$valued){
    		foreach($data as &$value){
    			if($valued['jgh'] == $value['jgh']){
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
    	$data = $jrps -> where($where) -> field('dwname,zhiwu,persname,gonghao,date,sum(point) as points,sum(sum) as sums') -> group('dwname,zhiwu,persname,gonghao,date') -> select();
    	//var_dump($jgh,$date);
    	$this->assign('data',$data);
    	$this->display();
    }
    public function jrpointdwdatepersinfo(){
    	$where['gonghao'] = $_GET['gonghao'];
    	$where['date'] = $_GET['date'];
    	$where['shenhe'] = 1;
    	$jrps = M('jrpointsum');
    	$data = $jrps -> where($where) -> field('dwname,zhiwu,persname,pointcontentid,score,point,sum') -> select();
    	$data = $this->content_item($data);
    	$sum = $jrps -> where($where) -> sum('sum');
    	$point = $jrps -> where($where) -> sum('point');
    	$this->assign('sum',$sum);
    	$this->assign('point',$point);
    	$this->assign('data',$data);
    	$this->display();
    }
    public function jrpointdwdatefws(){
    	$d = M('danwei');
    	$drr = $d -> where('jiagou = "A1"') -> order('pianqu asc') -> select();
    	
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
    			if($valued['jgh'] == $value['jgh']){
    				$valued['sums'] = $value['sums'];
    			}
    		}
    	}
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
    	$where['jgh'] = $_GET['jgh'];
    	$where['date'] = array( array('egt',$date) , array('elt',$dates) , 'and' );
    	$where['shenhe'] = 1;
    	$jrps = M('jrpointsum');
    	//$jrpsrr = $jrps -> where($where) -> field('dwname,zhiwu,persname,pointcontentid,score,point,sum(sum) as sums') -> group('dwname,zhiwu,persname,pointcontentid,unti,score') -> select();
    	$data = $jrps -> where($where) -> field('dwname,zhiwu,persname,gonghao,sum(point) as points,sum(sum) as sums') -> group('dwname,zhiwu,persname,gonghao') -> select();
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
    	$data = $jrps -> where($where) -> field('dwname,zhiwu,persname,gonghao,sum(point) as points,sum(sum) as sums,date') -> group('dwname,zhiwu,persname,gonghao,date') -> select();
    	//$data = $jrps -> where($where) -> field('dwname,zhiwu,persname,gonghao,sum(point) as points,sum(sum) as sums') -> group('dwname,zhiwu,persname,gonghao') -> select();
    	$data = $this->content_item($data);
    	//var_dump($jgh,$date);
    	$this->assign('data',$data);
    	$this->display();
    }
    public function jrpointdwdatefwpersinfos(){
    	$where['gonghao'] = $_GET['gonghao'];
    	$where['date'] = $_GET['date'];
    	$where['shenhe'] = 1;
    	$jrps = M('jrpointsum');
    	$data = $jrps -> where($where) -> field('dwname,zhiwu,persname,pointcontentid,score,point,sum,date') -> select();
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
	    		$pointitemid['pointcontentid'] = array('in',$items[$valuejpi['pointitemid']]);
	    		$pointitemid['date'] = $_POST['date'];
	    		$jpsrr[] = $jps -> where($pointitemid) -> field('jgh,date,sum(point) as sums') -> group('jgh,date') -> select();
	    	}
	    	
	    	//var_dump($jpsrr);
	    	
	    	
	    	
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
		    	$pointcontentid['date'] = $_POST['date'];
		    	$jpsrr[] = $jps -> where($pointcontentid) -> field('jgh,pointcontentid,sum(point) as sums,date') -> group('jgh,pointcontentid,date') -> select();
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
    	$drr = $d -> where('jiagou = "A1"') -> order('pianqu asc') -> select();
    	
    	foreach($drr as &$valued){
    		
    		foreach($jpsrr as $key=>$valuejps){
    			
    			foreach($valuejps as &$value){
    				
    				//var_dump($key);
    				if($valued['jgh'] == $value['jgh']){
    					
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
    
    
    public function jractdwdates(){
    	$date = $_POST['date'];
    	$stats['stats'] = 0;
    	$jai = M('jractitem');
    	
    	$jairr = $jai -> where($stats) -> select();
    	$this->assign('jairr',$jairr);
    	$where['date'] = $date;
    	$where['shenhe'] =1;
    	$jas = M('jractsum');
    	$data = $jas ->  where($where) -> select();
    	$data = $this->jract($data);
    	$d = M('danwei');
    	$drr = $d -> where('jiagou = "A1"') -> order('pianqu asc') -> select();
    	$jv = M('jrvillage');
    	$jvrr = $jv -> select();
    	foreach($data as &$value){
    		
    		foreach($jvrr as $valuejv){
    			
    			if($value['actitemid'] == 1 and $value['actpoint'] == $valuejv['villageid']){
    				
    				$value['actpoint'] = $valuejv['village'];
    			}
    		}
    	}
    	
    	foreach($drr as &$valued){
    		
    		foreach($data as &$value){
    			
    			if($valued['jgh'] == $value['jgh']){
    				
    				$valued[$value['actitemid']] = $value['actpoint'];
    			}
    		}
    	}
    	$this->assign('data',$drr);
    	//var_dump($drr);
    	$this->display();
    }
    public function jractdwdatefws(){
    	$stats['stats'] = 0;
    	$jai = M('jractitem');
    	
    	$jairr = $jai -> where($stats) -> select();
    	
    	$date = substr($_POST['date_date'],0,10);
    	$dates = substr($_POST['date_date'],-10,10);
    	$where['date'] = array( array('egt',$date) , array('elt',$dates) , 'and' );
    	$where['shenhe'] = 1;
    	$where['actitemid'] = array('notin','4');
    	$jas = M('jractsum');
    	$data = $jas -> where($where) -> field('jgh,actitemid,sum(actpoint) as sums') -> group('jgh,actitemid') -> select();
    	$data = $this->jract($data);
    	$where4['date'] = array( array('egt',$date) , array('elt',$dates) , 'and' );
    	$where4['shenhe'] = 1;
    	$where4['actpoint'] ='√';
    	$data4 = $jas -> where($where4) -> field('jgh,actitemid,count(actpoint) as sums') -> group('jgh,actitemid') -> select();
    	$data4 = $this->jract($data4);
    	
    	foreach($data4 as &$value){
    		$data[] = $value;
    	}
    	$d = M('danwei');
    	$drr = $d -> where('jiagou = "A1"') -> order('pianqu asc') -> select();
    	foreach($drr as &$valued){
    		
    		foreach($data as &$value){
    			
    			if($valued['jgh'] == $value['jgh']){
    				
    				$valued[$value['actitemid']] = $value['sums'];
    			}
    		}
    	}
    	$this->assign('data',$drr);
    	$this->assign('jairr',$jairr);
    	$this->display();
    	//var_dump($data,$data4);
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
    	$where['shenhe'] = '审核通过';
    	$where['qjts'] = array('gt',12);
    	$date = substr($_POST['date_date'],0,10);
    	$dates = substr($_POST['date_date'],-10,10);
    	$where['date'] = array( array('egt',$date) , array('elt',$dates) , 'and' );
    	
    	$qj = M('qingjia');
    	$where['zhiwu'] = array( array('notin','网点负责人') , array('notin','大堂经理') , array('notin','客户经理') , 'and');
    	$qjrr = $qj -> where($where) -> field('gonghao') -> select();
    	foreach($qjrr as &$value){
    		
    		$qjr[] = $value['gonghao'];
    	}
    	if($qjr == null){
    		$qjrrr = '04000282';
    		$qjr = '04000282';
    	}else{
    		$qjrrr = implode(',',$qjr);
    	}
    	
    	//var_dump($qjrrr);
    	
    	
    	//$jps = M('jrpointsum');
    	//$data = $jps -> where($where) -> field('jgh,zhiwud,gonghao,persname,sum(sum) as sums') -> group('zhiwud,gonghao,persname') -> select();
    	//$data = $this->persinfo($data);
    	
    	$User = D('');
    	$data = $User -> query("select hr_jrpointsum.jgh,hr_jrpointsum.zhiwud,hr_jrpointsum.persname,gonghao,sum(hr_jrpointsum.sum) as sums from hr_jrpointsum where hr_jrpointsum.shenhe = 1 and gonghao not in ($qjrrr) and date >= '$date' and date <= '$dates' and zhiwud <> 75 group by hr_jrpointsum.jgh,hr_jrpointsum.zhiwud,hr_jrpointsum.persname,gonghao");
    	$datass = $User -> query("select persname,gonghao,substring_index(group_concat(jgh order by jgh asc),',',1) as jgh from hr_jrpointsum where zhiwud <> 75 and date >= '$date' and date <= '$dates' and gonghao not in ($qjrrr) and shenhe = 1 group by persname,gonghao");
    	//var_dump($datass,$data);
    	
    	$lungang['zhiwu'] = array( array('notin','75'), array('notin','18') , array('notin','45') , 'and');
    	$lungang['gongzhong'] = array('notin','900');
    	$lungang['gonghao'] = array('notin',$qjr);
    	$l = M('lungang');
    	$lrr = $l -> where($lungang) -> field('dwname,count(gonghao) as counts') -> group('dwname') -> select();
    	//var_dump($lrr);
    	
    	$dateb = date('Y-m-d');
    	$lungang['date'] = array( array('egt',$dates) , array('elt',$dateb) , 'and' );
    	$jlt = M('jrlgtransfer');
    	$jltrr = $jlt -> where($lungang) -> select();
    	//var_dump($datass);
    	
    	foreach($lrr as &$valuelg){
    		
    		foreach($jltrr as &$valuejlt){
    			
    			if($valuelg['dwname'] == $valuejlt['ydwname']){
    				
    				$valuelg['counts'] = $valuelg['counts'] + 1;
    				//continue;
    				//var_dump($valuelg['counts'],$valuelg['dwname']);
    			}
    			if($valuelg['dwname'] == $valuejlt['dwname']){
    				
    				$valuelg['counts'] = $valuelg['counts'] - 1;
    				//continue;
    				//var_dump($valuelg['counts'],$valuelg['dwname']);
    			}
    		}
    	}
    	foreach($lrr as &$value){
    		
    		$value['pay'] = $value['counts'] * 900;
    	}
    	
    	
    	$d = M('danwei');
    	$drr = $d -> where('jiagou = "A1"') -> order('pianqu asc') -> select();
    	
    	
    	
    	foreach($datass as &$valuess){
    		
    		foreach($data as &$value){
    			
    			if($valuess['persname'] == $value['persname']){
    				
    				$valuess['sums'] += $value['sums'];
    			}
    		}
    	}
    	
    	foreach($drr as &$valued){
    		
    		foreach($datass as &$value){
    			
    			if($valued['jgh'] == $value['jgh']){
    				$value['dwname'] = $valued['dwname'];
    				$valued['sums'] += $value['sums'];
    				
    			}
    		}
    	}
    	//var_dump($datass,$drr,$lrr);
    	foreach($drr as &$valued){
    		
    		foreach($datass as &$valuess){
    			
    			if($valuess['jgh'] == $valued['jgh']){
    				
    				$valuess['avg'] = $valuess['sums']/$valued['sums'];
    				$valuess['avgs'] = round($valuess['avg']*100,2).'%';
    			}
    		}
    	}
    	foreach($lrr as &$valuelg){
    		
    		foreach($datass as &$valuess){
    			
    			if($valuelg['dwname'] == $valuess['jgh']){
    				
    				$valuess['reward'] = round($valuess['avg'] * $valuelg['pay'],2);
    				//var_dump($valuess['reward']);
    			}
    		}
    	}
    	$this->assign('data',$datass);
    	$this->display();
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
		
		$d = M('jrdanwei');
		$drr = $d -> select();
		
		foreach($data as &$value){

			foreach($drr as &$val){

				if($value['jgh'] == $val['jgh']){

					$value['dwname'] = $val['dwname'];
					break;
				}
			}
		}
		
    	return $data;
    }
	
	public function jrwhitedwdatedetail(){
		if($_GET['jgh'] == null){


		}else{

			$where['jgh'] = $_GET['jgh'];
		}
		
		$date = $_GET['date'];
		$dates = $_GET['dates'];
		$where['date'] = array( array('egt',$date) , array('elt',$dates) , 'and' );

		$jw = M('jrwhitecust');
		$data = $jw -> where($where) -> select();

		$data = $this->whitecustinfo($data);
		$this->assign('data',$data);
		// var_dump($data);
		$this->display();
	}

    public function jrwhitedwdates(){
    	$date = substr($_POST['date_date'],0,10);
    	$dates = substr($_POST['date_date'],-10,10);
    	$where['date'] = array( array('egt',$date) , array('elt',$dates) , 'and' );
		$detaildate['date'] = $date;
		$detaildate['dates'] = $dates;
    	$jw = M('jrwhitecust');
    	$where['stats'] = 0;
    	
    	$jwrr = $jw -> field('jgh,count(whitecustid) as countid') -> where($where) -> group('jgh') -> select();
    	
    	$d = M('danwei');
    	$drr = $d -> where("jiagou = 'A1'") -> select();
    	
    	foreach($drr as &$value){
    		
    		foreach($jwrr as &$val){
    			
    			if($value['jgh'] == $val['jgh']){
    				
    				$value['countid'] = $val['countid'];
    				break;
    			}
    		}
    	}
    	
    	$count = $jw -> where($where) -> count();
    	$this->assign('date',$detaildate);
    	$this->assign('jwrr',$drr);
    	$this->assign('count',$count);
    	
    	$this->display();
    }
    public function jraccountinfoups(){
    	$files = $_FILES['exl'];
    	$upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     209715200 ;// 设置附件上传大小
        $upload->exts      =     array('xls','xlsx','csv','txt');// 设置附件上传类型
        $upload->rootPath  =     './Public/Uploads/'; // 设置附件上传根目录
        $upload->savePath  =     'EXCEL/'; //设置附件上传（子）目录
        //$upload->subName   =     array('date', 'Ym');
        $upload->subName   =     '';
        // 上传文件  
        $info   =   $upload->upload();
        
        $file_name =  $upload->rootPath.$info['exl']['savepath'].$info['exl']['savename'];
        $handle = fopen ( $file_name, 'r' );
        
        $i = 0;
        $z = 0;
        $cust = M('jraccountinfo');
        $cl = M('costlogin');
        $clrr = $cl -> field('username,jgh') -> select();
        
        while($data = fgets($handle)){
        	
        	if($i == 0){
        		
        		$i = $i + 1;
        		
        	}else{
        		
        		$data = explode("\t",iconv('gbk','utf-8',$data));
				$arr[$z]['cundan'] = $data[0];
				$arr[$z]['stats'] = $data[2];
				$arr[$z]['sfz'] = $data[4];
				foreach($clrr as &$value){
					if($value['username'] == $data[6]){
						$arr[$z]['jgh'] = $value['jgh'];
						break;
					}else{
						$arr[$z]['jgh'] = null;
					}
				}
				$arr[$z]['dwname'] = $data[6];
				$arr[$z]['persname'] = $data[10];
				$arr[$z]['money'] = $data[12];
				$arr[$z]['date'] = $data[14];
				$arr[$z]['cunqi'] = $data[16];
				$arr[$z]['dates'] = $data[18];
				$arr[$z]['phone'] = $data[20];
				$arr[$z]['tel'] = $data[22];
				$arr[$z]['address'] = $data[24];
	        	$i = $i + 1;
	        	$z = $z + 1;
        	}
        	if($z == 700){
        		$custr = $cust -> addall($arr);
//				var_dump($data);
        		unset($arr);
        		$z = 0;
        	}
        }
        $custrr = $cust -> addall($arr);
        $custr = $custr + $custrr;
        //$redis_cust = new Redis();
        
        if($custr > 0){
        	$this->success('数据导入成功');
        }
    }
    public function jrclientassetsoldups(){
    	$files = $_FILES['exl'];
    	$upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     209715200 ;// 设置附件上传大小
        $upload->exts      =     array('xls','xlsx','csv','txt');// 设置附件上传类型
        $upload->rootPath  =     './Public/Uploads/'; // 设置附件上传根目录
        $upload->savePath  =     'EXCEL/'; //设置附件上传（子）目录
        //$upload->subName   =     array('date', 'Ym');
        $upload->subName   =     '';
        // 上传文件  
		$info   =   $upload->upload();
		
        $file_name =  $upload->rootPath.$info['exl']['savepath'].$info['exl']['savename'];
        $handle = fopen ( $file_name, 'r' );
        //去表头，取第一行开始；
//      var_dump($file_name);
        $i = 0;
        $z = 0;
        $cust = M('jrclientassetsold');
        while($data = fgets($handle)){
        	
        	if($i == 0){
        		
        		$i = $i + 1;
        		
        	}else{
        		
        		$data = explode("\t",iconv('gbk','utf-8',$data));
				$arr[$z]['jgh'] = $data[0];
				$arr[$z]['sfz'] = $data[2];
				$arr[$z]['zyue'] = $data[4];
				$arr[$z]['huoqi'] = $data[5];
				$arr[$z]['dingqi'] = $data[6];
				$arr[$z]['jghsfz'] = $data[0].$data[2];
	        	$i = $i + 1;
	        	$z = $z + 1;
        	}
        	if($z == 700){
        		$custr = $cust -> addall($arr);
        		unset($arr);
        		$z = 0;
        	}
        }
        $custrr = $cust -> addall($arr);
        $custr = $custr + $custrr;
        //$redis_cust = new Redis();
        
        if($custr > 0){
        	$this->success('数据导入成功');
        }
    }
    public function jrclientassetsups(){
    	$files = $_FILES['exl'];
    	$upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     209715200 ;// 设置附件上传大小
        $upload->exts      =     array('xls','xlsx','csv','txt');// 设置附件上传类型
        $upload->rootPath  =     './Public/Uploads/'; // 设置附件上传根目录
        $upload->savePath  =     'EXCEL/'; //设置附件上传（子）目录
        //$upload->subName   =     array('date', 'Ym');
        $upload->subName   =     '';
        // 上传文件  
        $info   =   $upload->upload();
        
        $file_name =  $upload->rootPath.$info['exl']['savepath'].$info['exl']['savename'];
        $handle = fopen ( $file_name, 'r' );
        //去表头，取第一行开始；
//      var_dump($file_name);
        $i = 0;
        $z = 0;
        $cust = M('jrclientassets');
        while($data = fgets($handle)){
        	
        	if($i == 0){
        		
        		$i = $i + 1;
        		
        	}else{
        		
        		$data = explode("\t",iconv('gbk','utf-8',$data));
				$arr[$z]['jgh'] = $data[0];
				$arr[$z]['sfz'] = $data[2];
				$arr[$z]['zyue'] = $data[4];
				$arr[$z]['huoqi'] = $data[5];
				$arr[$z]['dingqi'] = $data[6];
				$arr[$z]['jghsfz'] = $data[0].$data[2];
	        	$i = $i + 1;
	        	$z = $z + 1;
        	}
        	if($z == 700){
        		$custr = $cust -> addall($arr);
        		unset($arr);
        		$z = 0;
        	}
        }
        $custrr = $cust -> addall($arr);
        $custr = $custr + $custrr;
        //$redis_cust = new Redis();
        
        if($custr > 0){
        	$this->success('数据导入成功');
        }
    }
    public function jraccountinfopt(){
//  	$jw = M('jrwhitecust');
//  	$stats['stats'] = 0;
//  	$jwrr = $jw -> field('sfz,jgh') -> select();
//  	
//  	$ja = M('jraccountinfo');
//  	$jarr = $ja -> field('sfz,jgh,money') -> select();
//  	
//  	foreach($jwrr as &$value){
//  		
//  		foreach($jarr as &$val){
//  			
//  			if($value['sfz'] == $val['sfz'] and $value['jgh'] == $val['jgh']){
//  				
//  				$datas[$val['jgh']][] = $val;
//  			}
//  		}
//  	}
//  	
//  	$User = D('');
//  	
////  	$datas = $User->query("select hr_jraccountinfo.jgh,hr_jraccountinfo.sfz,hr_jraccountinfo.money from hr_jraccountinfo inner join hr_jrwhitecust on hr_jraccountinfo.jgh = hr_jrwhitecust.jgh and hr_jraccountinfo.sfz = hr_jrwhitecust.sfz");
//  	
//  	$data = $User->query("select hr_jrclientassets.jgh,hr_jrclientassets.sfz,hr_jrclientassets.zyue as perszyue,hr_jrclientassets.huoqi as pershuoqi,hr_jrclientassets.dingqi as persdingqi,hr_jrclientassetsold.zyue as persoldzyue,hr_jrclientassetsold.huoqi as persoldhuoqi,hr_jrclientassetsold.dingqi as persolddingqi from hr_jrclientassetsold inner join hr_jrclientassets on hr_jrclientassetsold.jghsfz = hr_jrclientassets.jghsfz");
//		
//		foreach($data as &$value){
//  		
//  		$value['zyue'] = $value['perszyue'] - $value['persoldzyue'];
//  		$value['huoqi'] = $value['pershuoqi'] - $value['persoldhuoqi'];
//  		$value['dingqi'] = $value['persdingqi'] - $value['persolddingqi'];
//  		
//  	}
//  	
//  	foreach($data as &$value){
//  		
//  		if($value['zyue'] >= 0){
//  			
//  			$dataz[] = $value;
//  		}else{
//  			
//  			$dataf[] = $value;
//  		}
//  	}
//  	
//  	
//  	foreach($datas as $key => $value){
//  		
//  		foreach($value as &$val){
//  			
//  			foreach($dataz as &$vals){
//  			
//	    			if($val['dwname'] == $vals['jgh'] and $val['sfz'] == $vals['sfz']){
//	    				
//	    				$whitedata[$key]['persz'] = $whitedata[$key]['persz'] + 1;
//	    				$whitedata[$key]['zyuez'] = $whitedata[$key]['zyuez'] + $vals['zyue'];
//	    				$whitedata[$key]['dingqiz'] = $whitedata[$key]['dingqiz'] + $vals['dingqi'];
//	    				$whitedata[$key]['huoqiz'] = $whitedata[$key]['huoqiz'] + $vals['huoqi'];
//	    			}
//  			}
//  		}
//  		
//  		
//  	}
//  	
//  	foreach($datas as $key => $value){
//  		
//  		foreach($value as &$val){
//  			
//  			foreach($dataf as &$vals){
//  			
//	    			if($val['dwname'] == $vals['jgh'] and $val['sfz'] == $vals['sfz']){
//	    				
//	    				$whitedata[$key]['persf'] = $whitedata[$key]['persf'] + 1;
//	    				$whitedata[$key]['zyuef'] = $whitedata[$key]['zyuef'] + $vals['zyue'];
//	    				$whitedata[$key]['dingqif'] = $whitedata[$key]['dingqif'] + $vals['dingqi'];
//	    				$whitedata[$key]['huoqif'] = $whitedata[$key]['huoqif'] + $vals['huoqi'];
//	    			}
//  			}
//  		}
//  		
//  		
//  	}
//  	
//  	$jrd = M('jrdanwei');
//  	$jrdr = $jrd -> where("jiagou = 'A1'") -> select();
//  	
//  	foreach($jrdr as &$value){
//  		
//  		foreach($datas as $key => $val){
//  			
//  			foreach($val as &$vals){
//  				
//  				if($value['jgh'] == $vals['jgh']){
//  				
//	    				$whitedata[$value['jgh']]['dingqipers'] = $whitedata[$value['jgh']]['dingqipers'] + 1;
//	    				$whitedata[$value['jgh']]['money'] = $whitedata[$value['jgh']]['money'] + $vals['money'];
//  				}
//  				
//  			}
//  			
//  		}
//  	}
//  	
//  	foreach($jrdr as &$value){
//  		
//  		$wheres['jgh'] = $value['jgh'];
//  		$wheres['stats'] = 0;
//  		$value['pers'] = $jw -> where($wheres) -> count();
//  		
//  		foreach($whitedata as $key => $val){
//  			
//  			if($value['jgh'] == $key){
//  				
//  				$value['pt'] = $val;
//  				break;
//  			}
//  		}
//  	}
//  	
//  	foreach($jrdr as &$val){
//  		
//  		$val['pt']['zyue'] = $val['pt']['zyuez'] + $val['pt']['zyuef'];
//  		$val['pt']['dingqi'] = $val['pt']['dingqiz'] + $val['pt']['dingqif'];
//  		$val['pt']['huoqi'] = $val['pt']['huoqiz'] + $val['pt']['huoqif'];
//  		
//  	}
//  	
//  	$this->assign('data',$jrdr);
//  	
//  	$this->display();

		
		$jd = M('jrdanwei');
		$jdr = $jd -> where("jiagou = 'A1'") -> select();
		
		$User = D('');
    	
    	$datas = $User->query("select hr_jraccountinfo.jgh,hr_jraccountinfo.sfz,hr_jraccountinfo.money,hr_jraccountinfo.dwname from hr_jraccountinfo inner join hr_jrwhitecust on hr_jraccountinfo.jgh = hr_jrwhitecust.jgh and hr_jraccountinfo.sfz = hr_jrwhitecust.sfz");
    	
    	$datab = $User -> query("select hr_jrclientassetsold.sfz,hr_jrclientassetsold.jgh,hr_jrclientassetsold.zyue as zyueb,hr_jrclientassetsold.huoqi as huoqib,hr_jrclientassetsold.dingqi as dingqib from hr_jrwhitecust inner join hr_jrclientassetsold on hr_jrclientassetsold.sfz = hr_jrwhitecust.sfz and hr_jrclientassetsold.jgh = hr_jrwhitecust.dwname");
    	$datao = $User -> query("select hr_jrclientassets.sfz,hr_jrclientassets.jgh,hr_jrclientassets.zyue as zyueo,hr_jrclientassets.huoqi as huoqio,hr_jrclientassets.dingqi as dingqio from hr_jrwhitecust inner join hr_jrclientassets on hr_jrclientassets.sfz = hr_jrwhitecust.sfz and hr_jrclientassets.jgh = hr_jrwhitecust.dwname");
//		var_dump($datas,$datao,$datab);
		
		foreach($datab as &$value){
			
			foreach($datao as &$val){
				
				if($value['sfz'] == $val['sfz'] and $value['jgh'] == $val['jgh']){
					
					$data[] = array(
						
						'sfz' => $value['sfz'],
						'jgh' => $value['jgh'],
						'zyue' => $val['zyueo'] - $value['zyueb'],
						'dingqi' => $val['dingqio'] - $value['dingqib'],
						'huoqi' => $val['huoqio'] - $value['huoqib'],
						
					);
					
				}
			}
		}
		
		foreach($data as &$value){
			
			if($value['zyue'] > 0){
				$dataz[] = $value;
				continue;
			}
			if($value['zyue'] < 0){
				$dataf[] = $value;
			}
			
		}
		
		
		
		foreach($dataz as &$value){
				
				$whitedata[$value['jgh']]['dwname'] = $value['jgh'];
				$whitedata[$value['jgh']]['persz'] = $whitedata[$value['jgh']]['persz'] + 1;
				$whitedata[$value['jgh']]['zyuez'] = $whitedata[$value['jgh']]['zyuez'] + $value['zyue'];
				$whitedata[$value['jgh']]['dingqiz'] = $whitedata[$value['jgh']]['dingqiz'] + $value['dingqi'];
				$whitedata[$value['jgh']]['huoqiz'] = $whitedata[$value['jgh']]['huoqiz'] + $value['huoqi'];
				
		}
		

			
		foreach($dataf as &$value){
				
				$whitedata[$value['jgh']]['dwname'] = $value['jgh'];
				$whitedata[$value['jgh']]['persf'] = $whitedata[$value['jgh']]['persf'] + 1;
				$whitedata[$value['jgh']]['zyuef'] = $whitedata[$value['jgh']]['zyuef'] + $value['zyue'];
				$whitedata[$value['jgh']]['dingqif'] = $whitedata[$value['jgh']]['dingqif'] + $value['dingqi'];
				$whitedata[$value['jgh']]['huoqif'] = $whitedata[$value['jgh']]['huoqif'] + $value['huoqi'];
				
		}
		
		$jw = M('jrwhitecust');
		
		$jwrr = $jw -> field('dwname,count(jgh) as count') -> group('dwname') -> select();
		
		foreach($jdr as &$value){
			
			foreach($jwrr as &$val){
				
				if($value['dwnames'] == $val['dwname']){
					
					$value['pers'] = $val['count'];
					break;
				}
			}
		}
		
		foreach($jdr as &$value){
			
			foreach($whitedata as &$val){
				
				if($value['dwnames'] == $val['dwname']){
					
					$value['persz'] = $val['persz'];
					$value['zyuez'] = $val['zyuez'];
					$value['dingqiz'] = $val['dingqiz'];
					$value['huoqiz'] = $val['huoqiz'];
					$value['persf'] = $val['persf'];
					$value['zyuef'] = $val['zyuef'];
					$value['dingqif'] = $val['dingqif'];
					$value['huoqif'] = $val['huoqif'];
					$value['zyue'] = $val['zyuez'] + $val['zyuef'];
					$value['dingqi'] = $val['dingqiz'] + $val['dingqif'];
					$value['huoqi'] = $val['huoqiz'] + $val['huoqif'];
					break;
				}
			}
		}
		
		foreach($jdr as &$value){
			
			foreach($datas as &$val){
				
				if($value['dwnames'] == $val['dwname']){
					
					$value['dingqipers'] = $value['dingqipers'] + 1;
					$value['money'] = $value['money'] + $val['money'];
				}
			}
		}
		
		foreach($jdr as &$value){
			
			$value['zyuez'] = round($value['zyuez'] , 2);
			$value['dingqiz'] = round($value['dingqiz'] , 2);
			$value['huoqiz'] = round($value['huoqiz'] , 2);
			$value['zyuef'] = round($value['zyuef'] , 2);
			$value['dingqif'] = round($value['dingqif'] , 2);
			$value['huoqif'] = round($value['huoqif'] , 2);
			$value['zyue'] = round($value['zyue'] , 2);
			$value['dingqi'] = round($value['dingqi'] , 2);
			$value['huoqi'] = round($value['huoqi'] , 2);
			$value['money'] = round($value['money'] , 2);
		}
		
		$this->assign('data',$jdr);
		
		$this->display();
		
//		var_dump($jdr);
		
//		var_dump($data);
		
//  	$data = $User->query("select hr_jrclientassets.jgh,hr_jrclientassets.sfz,hr_jrclientassets.zyue as perszyue,hr_jrclientassets.huoqi as pershuoqi,hr_jrclientassets.dingqi as persdingqi,hr_jrclientassetsold.zyue as persoldzyue,hr_jrclientassetsold.huoqi as persoldhuoqi,hr_jrclientassetsold.dingqi as persolddingqi from hr_jrclientassetsold inner join hr_jrclientassets on hr_jrclientassetsold.jghsfz = hr_jrclientassets.jghsfz");
//		
//		foreach($data as &$value){
//  		
//  		$value['zyue'] = $value['perszyue'] - $value['persoldzyue'];
//  		$value['huoqi'] = $value['pershuoqi'] - $value['persoldhuoqi'];
//  		$value['dingqi'] = $value['persdingqi'] - $value['persolddingqi'];
//  		
//  	}
//		
//		foreach($data as &$value){
//  		
//  		if($value['zyue'] >= 0){
//  			
//  			$dataz[] = $value;
//  		}else{
//  			
//  			$dataf[] = $value;
//  		}
//  	}
//		
//		foreach($datas as &$value){
//  			
//  			foreach($dataz as &$vals){
//  			
//	    			if($value['dwname'] == $vals['jgh'] and $value['sfz'] == $vals['sfz']){
//	    				
//	    				$whitedata[$value['dwname']]['persz'] = $whitedata[$value['dwname']]['persz'] + 1;
//	    				$whitedata[$value['dwname']]['zyuez'] = $whitedata[$value['dwname']]['zyuez'] + $vals['zyue'];
//	    				$whitedata[$value['dwname']]['dingqiz'] = $whitedata[$value['dwname']]['dingqiz'] + $vals['dingqi'];
//	    				$whitedata[$value['dwname']]['huoqiz'] = $whitedata[$value['dwname']]['huoqiz'] + $vals['huoqi'];
//	    				break;
//	    			}
//  			}
//  	}
//  	
//  	foreach($datas as &$value){
//  			
//  			foreach($dataf as &$vals){
//  			
//	    			if($value['dwname'] == $vals['jgh'] and $value['sfz'] == $vals['sfz']){
//	    				
//	    				$whitedata[$value['dwname']]['persf'] = $whitedata[$value['dwname']]['persf'] + 1;
//	    				$whitedata[$value['dwname']]['zyuef'] = $whitedata[$value['dwname']]['zyuef'] + $vals['zyue'];
//	    				$whitedata[$value['dwname']]['dingqif'] = $whitedata[$value['dwname']]['dingqif'] + $vals['dingqi'];
//	    				$whitedata[$value['dwname']]['huoqif'] = $whitedata[$value['dwname']]['huoqif'] + $vals['huoqi'];
//	    				break;
//	    			}
//  			}
//  	}
//		
//		var_dump($datas,$dataz,$dataf,$whitedata);
	}
	public function jraccountinfoperspt(){
		$jd = M('jrdanwei');
		$jdr = $jd -> where("jiagou = 'A1'") -> select();
		
		$User = D('');
    	$jgh = $_GET['jgh'];
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
	
    public function jraccountinfocleans(){
    	$p=D('');
    	$p->execute("truncate table hr_jraccountinfo");
    	$this->success('数据已清空，请继续操作');
    }
    public function jrclientassetsoldcleans(){
    	$p=D('');
    	$p->execute("truncate table hr_jrclientassetsold");
    	$this->success('数据已清空，请继续操作');
    }
    public function jrclientassetscleans(){
    	$p=D('');
    	$p->execute("truncate table hr_jrclientassets");
    	$this->success('数据已清空，请继续操作');
    }
	public function jretccustpts(){
		$date = substr($_POST['date_date'],0,10);
    	$dates = substr($_POST['date_date'],-10,10);
		$where['signdate'] = array( array('egt',$date) , array('elt',$dates) , 'and' );
		
		$where['stats'] = 0;
		$je = M('jretccust');

		$jer = $je -> where($where) -> select();

		$jd = M('jrdanwei');
		$jdr = $jd -> select();

		foreach($jer as &$value){

			foreach($jdr as &$val){

				if($value['jgh'] == $val['jgh']){

					$value['jghs'] = $val['dwname'];
				}
				if($value['refereedwname'] == $val['jgh']){
					
					$value['refereedwnames'] = $val['dwname'];
				}
				if($value['signdwname'] == $val['jgh']){

					$value['signdwnames'] = $val['dwname'];
				}
			}
		}

		$this->assign('data',$jer);
		$this->display();
	}
	public function jrtenthouinfooldups(){
    	$files = $_FILES['exl'];
    	$upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     209715200 ;// 设置附件上传大小
        $upload->exts      =     array('xls','xlsx','csv','txt');// 设置附件上传类型
        $upload->rootPath  =     './Public/Uploads/'; // 设置附件上传根目录
        $upload->savePath  =     'EXCEL/'; //设置附件上传（子）目录
        //$upload->subName   =     array('date', 'Ym');
        $upload->subName   =     '';
        // 上传文件  
		$info   =   $upload->upload();
		
        $file_name =  $upload->rootPath.$info['exl']['savepath'].$info['exl']['savename'];
        $handle = fopen ( $file_name, 'r' );
        //去表头，取第一行开始；
//      var_dump($file_name);
        $i = 0;
		$z = 0;
		$tenthou = $_POST['tenthouold'];
        $cust = M('jrclienttenthouold');
        while($data = fgets($handle)){
			$data = explode("\t",iconv('gbk','utf-8',$data));
			if(trim($data[4]) < $tenthou){
				
				continue;
				
			}else{
				$arr[$z]['jgh'] = $data[0];
				$arr[$z]['sfz'] = $data[2];
				$arr[$z]['zyue'] = $data[4];
				$arr[$z]['huoqi'] = $data[5];
				$arr[$z]['dingqi'] = $data[6];
				$arr[$z]['jghsfz'] = $data[0].$data[2];
	        	$i = $i + 1;
	        	$z = $z + 1;
			}
			
        	// if($i == 0){
        		
        	// 	$i = $i + 1;
        		
        	// }else{
        		
        	// 	// $data = explode("\t",iconv('gbk','utf-8',$data));
			// 	$arr[$z]['jgh'] = $data[0];
			// 	$arr[$z]['sfz'] = $data[2];
			// 	$arr[$z]['zyue'] = $data[4];
			// 	$arr[$z]['huoqi'] = $data[5];
			// 	$arr[$z]['dingqi'] = $data[6];
			// 	$arr[$z]['jghsfz'] = $data[0].$data[2];
	        // 	$i = $i + 1;
	        // 	$z = $z + 1;
			// }
			
        	if($z == 700){
        		$custr = $cust -> addall($arr);
        		unset($arr);
        		$z = 0;
        	}
		}
		// var_dump($arr);
        $custrr = $cust -> addall($arr);
        $custr = $custr + $custrr;
        
        if($custr > 0){
        	$this->success('数据导入成功');
		}
	}
		public function jrtenthouinfoups(){
			$files = $_FILES['exl'];
			$upload = new \Think\Upload();// 实例化上传类
			$upload->maxSize   =     209715200 ;// 设置附件上传大小
			$upload->exts      =     array('xls','xlsx','csv','txt');// 设置附件上传类型
			$upload->rootPath  =     './Public/Uploads/'; // 设置附件上传根目录
			$upload->savePath  =     'EXCEL/'; //设置附件上传（子）目录
			//$upload->subName   =     array('date', 'Ym');
			$upload->subName   =     '';
			// 上传文件  
			$info   =   $upload->upload();
			
			$file_name =  $upload->rootPath.$info['exl']['savepath'].$info['exl']['savename'];
			$handle = fopen ( $file_name, 'r' );
			//去表头，取第一行开始；
	//      var_dump($file_name);
			$i = 0;
			$z = 0;
			$tenthou = $_POST['tenthou'];
			$cust = M('jrclienttenthou');
			while($data = fgets($handle)){
				$data = explode("\t",iconv('gbk','utf-8',$data));
				if(trim($data[4]) < $tenthou){
					
					continue;
					
				}else{
					$arr[$z]['jgh'] = $data[0];
					$arr[$z]['sfz'] = $data[2];
					$arr[$z]['zyue'] = $data[4];
					$arr[$z]['huoqi'] = $data[5];
					$arr[$z]['dingqi'] = $data[6];
					$arr[$z]['jghsfz'] = $data[0].$data[2];
					$i = $i + 1;
					$z = $z + 1;
				}
				
				// if($i == 0){
					
				// 	$i = $i + 1;
					
				// }else{
					
				// 	// $data = explode("\t",iconv('gbk','utf-8',$data));
				// 	$arr[$z]['jgh'] = $data[0];
				// 	$arr[$z]['sfz'] = $data[2];
				// 	$arr[$z]['zyue'] = $data[4];
				// 	$arr[$z]['huoqi'] = $data[5];
				// 	$arr[$z]['dingqi'] = $data[6];
				// 	$arr[$z]['jghsfz'] = $data[0].$data[2];
				// 	$i = $i + 1;
				// 	$z = $z + 1;
				// }
				
				if($z == 700){
					$custr = $cust -> addall($arr);
					unset($arr);
					$z = 0;
				}
			}
			// var_dump($arr);
			$custrr = $cust -> addall($arr);
			$custr = $custr + $custrr;
			
			if($custr > 0){
				$this->success('数据导入成功');
			}
	}
	public function jrtenthoupt(){
		$jto = M('jrclienttenthouold');

		$jtor = $jto -> field('jgh,count(sfz) as counto') -> group('jgh') -> select();

		$jt = M('jrclienttenthou');

		$jtr = $jt -> field('jgh,count(sfz) as count') -> group('jgh') -> select();

		$jd = M('jrdanwei');

		$jdr = $jd -> where("jiagou = 'A1'") -> select();

		foreach($jdr as &$value){

			foreach($jtor as &$val){

				if($value['dwnames'] == $val['jgh']){

					$value['counto'] = $val['counto'];
					break;
				}
			}
		}

		foreach($jdr as &$value){

			foreach($jtr as &$val){

				if($value['dwnames'] == $val['jgh']){

					$value['count'] = $val['count'];
					$value['countc'] = $value['counto'] - val['count'];
					break;
				}
			}
		}

		$this->assign('data',$jdr);
		$this->display();
	}
	public function jrtenthouinfooldcleans(){
		$p=D('');
    	$p->execute("truncate table hr_jrclienttenthouold");
    	$this->success('数据已清空，请继续操作');
	}
	public function jrtenthouinfocleans(){
		$p=D('');
    	$p->execute("truncate table hr_jrclienttenthou");
    	$this->success('数据已清空，请继续操作');
	}


    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    public function indexjr(){
    	$d = M('danwei');
    	$drr = $d -> where('jiagou = "A1"') -> order('pianqu asc') -> select();
    	
    	$z = M('zhiwu');
    	$zrr = $z -> select();
    	
    	$p = M('pers');
    	//$wherep['dwname'] = array('in',$drrr);
    	
    	$prr = $p -> select();
    	
    	foreach($prr as &$value){
    		foreach($zrr as &$valuez){
    			if($valuez['zhiwud'] == $value['zhiwu']){
    				$value['zwjiagou'] = $valuez['zwjiagou'];
    				$value['zhiwud'] = $valuez['zhiwud'];
    				$value['zhiwu'] = $valuez['zhiwu'];
    			}
    		}
    	}
    	$g = M('gongzhong');
    	$grr = $g -> select();
    	foreach($prr as &$value){
    		foreach($grr as &$valueg){
    			if($valueg['gongzhongd'] == $value['gongzhong']){
    				$value['gongzhong'] = $valueg['gongzhong'];
    				continue;
    			}
    		}
    	}
    	$pq = M('pianqu');
    	$pqrr = $pq -> select();
    	
    	foreach($drr as &$valued){
    		foreach($pqrr as &$valuepq){
    			if($valuepq['pianqu'] == $valued['pianqu']){
    				$valued['pianquname'] = $valuepq['pianquname'];
    				continue;
    			}
    		}
    	}
    	foreach($drr as &$valued){
    		$jgh = $valued['jgh'];
    		$valued['count'] = $p -> where("dwname = '$jgh'") -> count();
//  		foreach($zrr as &$valuez){
    			foreach($prr as &$value){
    				if($valued['jgh'] == $value['dwname'] and $value['zwjiagou'] == 'A1'){
    					$wdfzr[] = array(
    					'persname' => $value['persname'],
    					'gongzhong' => $value['gongzhong'],
    					'zhiwu' => $valuez['zhiwu'],
    					'dwname' => $valued['dwname'],
    					'gonghao' => $value['gonghao'],
    					);
    					
    				}
					
    				if($valued['jgh'] == $value['dwname'] and $value['zwjiagou'] == 'A2'){
    					
    					$zhgy[] = array(
    					'persname' => $value['persname'],
    					'gongzhong' => $value['gongzhong'],
    					'zhiwu' => $valuez['zhiwu'],
    					'dwname' => $valued['dwname'],
    					'gonghao' => $value['gonghao'],
    					);
    					
    				}
    				if($valued['jgh'] == $value['dwname'] and $value['zwjiagou'] == 'A3'){
    					
    					$lcjl[] = array(
    					'persname' => $value['persname'],
    					'gongzhong' => $value['gongzhong'],
    					'zhiwu' => $valuez['zhiwu'],
    					'dwname' => $valued['dwname'],
    					'gonghao' => $value['gonghao'],
    					);
    					
    				}
    				if($valued['jgh'] == $value['dwname'] and $value['zwjiagou'] == 'A4'){
    					
    					$dtjl[] = array(
    					'persname' => $value['persname'],
    					'gongzhong' => $value['gongzhong'],
    					'zhiwu' => $valuez['zhiwu'],
    					'dwname' => $valued['dwname'],
    					'gonghao' => $value['gonghao'],
    					);
    					
    				}
    				if($valued['jgh'] == $value['dwname'] and $value['zwjiagou'] == 'A5'){
    					
    					$khjl[] = array(
    					'persname' => $value['persname'],
    					'gongzhong' => $value['gongzhong'],
    					'zhiwu' => $valuez['zhiwu'],
    					'dwname' => $valued['dwname'],
    					'gonghao' => $value['gonghao'],
    					);
    					
    				}
    				if($valued['jgh'] == $value['dwname'] and $value['zwjiagou'] == 'A6'){
    					
    					$ptgy[] = array(
    					'persname' => $value['persname'],
    					'gongzhong' => $value['gongzhong'],
    					'zhiwu' => $valuez['zhiwu'],
    					'dwname' => $valued['dwname'],
    					'gonghao' => $value['gonghao'],
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
    	
    	$q = M('qingjia');
    	$where['shenhe'] = '审核通过';
    	$nian = array(date(Y),date(Y)-1);
    	$where['nian'] = array('in',$nian);
    	$qrr = $q -> where($where) -> select();
    	
    	foreach($drr as &$valued){
    		foreach($qrr as &$value){
    			if($valued['dwname'] == $value['dwname']){
    				$data[] = array(
    				'jiagou' => $valued['jiagou'],
    				'jgh' => $valued['jgh'],
    				'persname' => $value['persname'],
    				'gonghao' => $value['gonghao'],
    				'qjts' => $value['qjts'],
    				'qjlx' => $value['qjlx'].$value['qjts'].'天',
    				'date' => $value['date'],
    				'today' => date('Y-m-d'),
    				);
    			}
    		}
    	}
    	foreach($drr as &$valued){
    		
    		foreach($data as &$value){
    			
    			$date = $value['date'];
    			$qjts = $value['qjts'];
    			$dates = date('Y-m-d',strtotime("$date + $qjts day"));
    			if($value['jgh'] == $valued['jgh'] and $dates > $value['today'] and $value['today'] >= $value['date']){
    				$qjyg[] = array(
    				'persname' => $value['persname'],
    				'qjlx' => $value['qjlx'],
    				'timing' => '剩'.round((strtotime($dates) - strtotime($value['today']))/3600/24).'天',
    				);
    			}
    		}
    		$valued['qjyg'] = $qjyg;
    		$qjyg = array();
    	}
    	//统计总数
    	$jgh = $d -> where("jiagou = 'A1'") -> select();
    	foreach($jgh as &$value){
    		$counts[] = $value['jgh'];
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
    	$count['counts'] = $p -> where($wherejgh) -> count();
    	$count['wdfzr'] = $p -> where($wherewdfzr) -> count();
    	$count['zhgy'] = $p -> where($wherezhgy) -> count();
    	$count['lcjl'] = $p -> where($wherelcjl) -> count();
    	$count['dtjl'] = $p -> where($wheredtjl) -> count();
    	$count['khjl'] = $p -> where($wherekhjl) -> count();
    	$count['ptgy'] = $p -> where($whereptgy) -> count();
    	$count['qjyg'] = count($data);
    	$this -> assign('count',$count);
    	//var_dump($count);
    	$index = 'indexjr';
    	cookie('index',$index,3600);
    	//var_dump($data);
    	$this->assign('data',$drr);
    	$this->display();
    }
    public function indexjg(){
    	$d = M('danwei');
    	$drr = $d -> where('jiagou = "A2"') -> select();
    	$z = M('zhiwu');
    	$zrr = $z -> select();
    	$p = M('pers');
    	$prr = $p -> select();
    	
    	foreach($prr as &$value){
    		foreach($zrr as &$valuez){
    			if($valuez['zhiwud'] == $value['zhiwu']){
    				$value['zwjiagou'] = $valuez['zwjiagou'];
    				$value['zhiwud'] = $valuez['zhiwud'];
    				$value['zhiwu'] = $valuez['zhiwu'];
    			}
    		}
    	}
    	
    	$g = M('gongzhong');
    	$grr = $g -> select();
    	foreach($prr as &$value){
    		foreach($grr as &$valueg){
    			if($valueg['gongzhongd'] == $value['gongzhong']){
    				$value['gongzhong'] = $valueg['gongzhong'];
    			}
    		}
    	}
    	foreach($drr as &$valued){
    		$jgh = $valued['jgh'];
    		$valued['count'] = $p -> where("dwname = '$jgh'") -> count();
    		
    			foreach($prr as &$value){
    				if($valued['jgh'] == $value['dwname'] and $value['zwjiagou'] == 'B1'){
    					$jl[] = array(
    					'persname' => $value['persname'],
    					'gongzhong' => $value['gongzhong'],
    					'zhiwu' => $value['zhiwu'],
    					'dwname' => $valued['dwname'],
    					'gonghao' => $value['gonghao'],
    					);
    				}
    				
    				if($valued['jgh'] == $value['dwname'] and $value['zwjiagou'] == 'B2'){
    					
    					$fjl[] = array(
    					'persname' => $value['persname'],
    					'gongzhong' => $value['gongzhong'],
    					'zhiwu' => $value['zhiwu'],
    					'dwname' => $valued['dwname'],
    					'gonghao' => $value['gonghao'],
    					);
    				}
    				if($valued['jgh'] == $value['dwname'] and $value['zwjiagou'] == 'B3'){
    					
    					$gly[] = array(
    					'persname' => $value['persname'],
    					'gongzhong' => $value['gongzhong'],
    					'zhiwu' => $value['zhiwu'],
    					'dwname' => $valued['dwname'],
    					'gonghao' => $value['gonghao'],
    					);
    				}
    				if($valued['jgh'] == $value['dwname'] and $value['zwjiagou'] == 'B4'){
    					
    					$qt[] = array(
    					'persname' => $value['persname'],
    					'gongzhong' => $value['gongzhong'],
    					'zhiwu' => $value['zhiwu'],
    					'dwname' => $valued['dwname'],
    					'gonghao' => $value['gonghao'],
    					);
    				}
    			
    			
    		}
    		$valued['jl'] = $jl;
    		$jl = array();
    		$valued['fjl'] = $fjl;
    		$fjl = array();
    		$valued['gly'] = $gly;
    		$gly = array();
    		$valued['qt'] = $qt;
    		$qt = array();
    	}
    	$index = 'indexjg';
    	cookie('index',$index,3600);
    	$this->assign('data',$drr);
    	$this->display();
 
    }
    public function indexyy(){
    	$d = M('danwei');
    	$drr = $d -> where('jiagou = "A3"') -> select();
    	$z = M('zhiwu');
    	$zrr = $z -> select();
    	$p = M('pers');
    	$prr = $p -> select();
    	
    	foreach($prr as &$value){
    		foreach($zrr as &$valuez){
    			if($valuez['zhiwud'] == $value['zhiwu']){
    				$value['zwjiagou'] = $valuez['zwjiagou'];
    				$value['zhiwud'] = $valuez['zhiwud'];
    				$value['zhiwu'] = $valuez['zhiwu'];
    			}
    		}
    	}
    	
    	$g = M('gongzhong');
    	$grr = $g -> select();
    	foreach($prr as &$value){
    		foreach($grr as &$valueg){
    			if($valueg['gongzhongd'] == $value['gongzhong']){
    				$value['gongzhong'] = $valueg['gongzhong'];
    			}
    		}
    	}
    	foreach($drr as &$valued){
    		$jgh = $valued['jgh'];
    		$valued['count'] = $p -> where("dwname = '$jgh'") -> count();
    		
    			foreach($prr as &$value){
    				if($valued['jgh'] == $value['dwname'] and $value['zwjiagou'] == 'C1'){
    					$bz[] = array(
    					'persname' => $value['persname'],
    					'gongzhong' => $value['gongzhong'],
    					'zhiwu' => $value['zhiwu'],
    					'dwname' => $valued['dwname'],
    					'gonghao' => $value['gonghao'],
    					);
    				}
    				
    				if($valued['jgh'] == $value['dwname'] and $value['zwjiagou'] == 'C2'){
    					
    					$fbz[] = array(
    					'persname' => $value['persname'],
    					'gongzhong' => $value['gongzhong'],
    					'zhiwu' => $value['zhiwu'],
    					'dwname' => $valued['dwname'],
    					'gonghao' => $value['gonghao'],
    					);
    				}
    				if($valued['jgh'] == $value['dwname'] and $value['zwjiagou'] == 'C3'){
    					
    					$yzyy[] = array(
    					'persname' => $value['persname'],
    					'gongzhong' => $value['gongzhong'],
    					'zhiwu' => $value['zhiwu'],
    					'dwname' => $valued['dwname'],
    					'gonghao' => $value['gonghao'],
    					);
    				}
    			
    			
    		}
    		$valued['bz'] = $bz;
    		$bz = array();
    		$valued['fbz'] = $fbz;
    		$fbz = array();
    		$valued['yzyy'] = $yzyy;
    		$yzyy = array();
    	}
    	$index = 'indexyy';
    	cookie('index',$index,3600);
    	$this->assign('data',$drr);
    	$this->display();
    }
    public function indextd(){
    	$d = M('danwei');
    	$drr = $d -> where('jiagou = "A4"') -> select();
    	$z = M('zhiwu');
    	$zrr = $z -> select();
    	$p = M('pers');
    	$prr = $p -> select();
    	
    	foreach($prr as &$value){
    		foreach($zrr as &$valuez){
    			if($valuez['zhiwud'] == $value['zhiwu']){
    				$value['zwjiagou'] = $valuez['zwjiagou'];
    				$value['zhiwud'] = $valuez['zhiwud'];
    				$value['zhiwu'] = $valuez['zhiwu'];
    			}
    		}
    	}
    	
    	$g = M('gongzhong');
    	$grr = $g -> select();
    	foreach($prr as &$value){
    		foreach($grr as &$valueg){
    			if($valueg['gongzhongd'] == $value['gongzhong']){
    				$value['gongzhong'] = $valueg['gongzhong'];
    			}
    		}
    	}
    	foreach($drr as &$valued){
    		$jgh = $valued['jgh'];
    		$valued['count'] = $p -> where("dwname = '$jgh'") -> count();
    		
    			foreach($prr as &$value){
    				if($valued['jgh'] == $value['dwname'] and $value['zwjiagou'] == 'D1'){
    					$bz[] = array(
    					'persname' => $value['persname'],
    					'gongzhong' => $value['gongzhong'],
    					'zhiwu' => $value['zhiwu'],
    					'dwname' => $valued['dwname'],
    					'gonghao' => $value['gonghao'],
    					);
    				}
    				
    				if($valued['jgh'] == $value['dwname'] and $value['zwjiagou'] == 'D2'){
    					
    					$fbz[] = array(
    					'persname' => $value['persname'],
    					'gongzhong' => $value['gongzhong'],
    					'zhiwu' => $value['zhiwu'],
    					'dwname' => $valued['dwname'],
    					'gonghao' => $value['gonghao'],
    					);
    				}
    				if($valued['jgh'] == $value['dwname'] and $value['zwjiagou'] == 'D3'){
    					
    					$tdy[] = array(
    					'persname' => $value['persname'],
    					'gongzhong' => $value['gongzhong'],
    					'zhiwu' => $value['zhiwu'],
    					'dwname' => $valued['dwname'],
    					'gonghao' => $value['gonghao'],
    					);
    				}
    				if($valued['jgh'] == $value['dwname'] and $value['zwjiagou'] == 'D4'){
    					
    					$qt[] = array(
    					'persname' => $value['persname'],
    					'gongzhong' => $value['gongzhong'],
    					'zhiwu' => $value['zhiwu'],
    					'dwname' => $valued['dwname'],
    					'gonghao' => $value['gonghao'],
    					);
    				}
    			
    			
    		}
    		$valued['bz'] = $bz;
    		$bz = array();
    		$valued['fbz'] = $fbz;
    		$fbz = array();
    		$valued['tdy'] = $tdy;
    		$tdy = array();
    		$valued['qt'] = $qt;
    		$qt = array();
    	}
    	$index = 'indextd';
    	cookie('index',$index,3600);
    	$this->assign('data',$drr);
    	$this->display();
    }
    public function indexzyj(){
    	$d = M('danwei');
    	$drr = $d -> where('jiagou = "A5"') -> select();
    	$z = M('zhiwu');
    	$zrr = $z -> select();
    	$p = M('pers');
    	$prr = $p -> select();
    	
    	foreach($prr as &$value){
    		foreach($zrr as &$valuez){
    			if($valuez['zhiwud'] == $value['zhiwu']){
    				$value['zwjiagou'] = $valuez['zwjiagou'];
    				$value['zhiwud'] = $valuez['zhiwud'];
    				$value['zhiwu'] = $valuez['zhiwu'];
    			}
    		}
    	}
    	
    	$g = M('gongzhong');
    	$grr = $g -> select();
    	foreach($prr as &$value){
    		foreach($grr as &$valueg){
    			if($valueg['gongzhongd'] == $value['gongzhong']){
    				$value['gongzhong'] = $valueg['gongzhong'];
    			}
    		}
    	}
    	foreach($drr as &$valued){
    		$jgh = $valued['jgh'];
    		$valued['count'] = $p -> where("dwname = '$jgh'") -> count();
    		
    			foreach($prr as &$value){
    				if($valued['jgh'] == $value['dwname'] and $value['zwjiagou'] == 'B1'){
    					$jl[] = array(
    					'persname' => $value['persname'],
    					'gongzhong' => $value['gongzhong'],
    					'zhiwu' => $value['zhiwu'],
    					'dwname' => $valued['dwname'],
    					'gonghao' => $value['gonghao'],
    					);
    				}
    				
    				if($valued['jgh'] == $value['dwname'] and $value['zwjiagou'] == 'B2'){
    					
    					$fjl[] = array(
    					'persname' => $value['persname'],
    					'gongzhong' => $value['gongzhong'],
    					'zhiwu' => $value['zhiwu'],
    					'dwname' => $valued['dwname'],
    					'gonghao' => $value['gonghao'],
    					);
    				}
    				if($valued['jgh'] == $value['dwname'] and $value['zwjiagou'] == 'E3'){
    					
    					$bzz[] = array(
    					'persname' => $value['persname'],
    					'gongzhong' => $value['gongzhong'],
    					'zhiwu' => $value['zhiwu'],
    					'dwname' => $valued['dwname'],
    					'gonghao' => $value['gonghao'],
    					);
    				}
    				if($valued['jgh'] == $value['dwname'] and $value['zwjiagou'] == 'E4'){
    					
    					$qt[] = array(
    					'persname' => $value['persname'],
    					'gongzhong' => $value['gongzhong'],
    					'zhiwu' => $value['zhiwu'],
    					'dwname' => $valued['dwname'],
    					'gonghao' => $value['gonghao'],
    					);
    				}
    			
    			
    		}
    		$valued['jl'] = $jl;
    		$jl = array();
    		$valued['fjl'] = $fjl;
    		$fjl = array();
    		$valued['bzz'] = $bzz;
    		$bzz = array();
    		$valued['qt'] = $qt;
    		$qt = array();
    	}
    	$index = 'indexzyj';
    	cookie('index',$index,3600);
    	$this->assign('data',$drr);
    	$this->display();
    }
    public function indexfj(){
    	$d = M('danwei');
    	$drr = $d -> where('jiagou = "A6"') -> select();
    	$z = M('zhiwu');
    	$zrr = $z -> select();
    	$p = M('pers');
    	$prr = $p -> select();
    	
    	foreach($prr as &$value){
    		foreach($zrr as &$valuez){
    			if($valuez['zhiwud'] == $value['zhiwu']){
    				$value['zwjiagou'] = $valuez['zwjiagou'];
    				$value['zhiwud'] = $valuez['zhiwud'];
    				$value['zhiwu'] = $valuez['zhiwu'];
    			}
    		}
    	}
    	
    	$g = M('gongzhong');
    	$grr = $g -> select();
    	foreach($prr as &$value){
    		foreach($grr as &$valueg){
    			if($valueg['gongzhongd'] == $value['gongzhong']){
    				$value['gongzhong'] = $valueg['gongzhong'];
    			}
    		}
    	}
    	foreach($drr as &$valued){
    		$jgh = $valued['jgh'];
    		$valued['count'] = $p -> where("dwname = '$jgh'") -> count();
    		
    			foreach($prr as &$value){
    				if($valued['jgh'] == $value['dwname'] and $value['zwjiagou'] == 'F1'){
    					$jz[] = array(
    					'persname' => $value['persname'],
    					'gongzhong' => $value['gongzhong'],
    					'zhiwu' => $value['zhiwu'],
    					'dwname' => $valued['dwname'],
    					'gonghao' => $value['gonghao'],
    					);
    				}
    				
    				if($valued['jgh'] == $value['dwname'] and $value['zwjiagou'] == 'F2'){
    					
    					$fjz[] = array(
    					'persname' => $value['persname'],
    					'gongzhong' => $value['gongzhong'],
    					'zhiwu' => $value['zhiwu'],
    					'dwname' => $valued['dwname'],
    					'gonghao' => $value['gonghao'],
    					);
    				}
    				if($valued['jgh'] == $value['dwname'] and $value['zwjiagou'] == 'F3'){
    					
    					$jzzl[] = array(
    					'persname' => $value['persname'],
    					'gongzhong' => $value['gongzhong'],
    					'zhiwu' => $value['zhiwu'],
    					'dwname' => $valued['dwname'],
    					'gonghao' => $value['gonghao'],
    					);
    				}
    				if($valued['jgh'] == $value['dwname'] and $value['zwjiagou'] == 'E4'){
    					
    					$qt[] = array(
    					'persname' => $value['persname'],
    					'gongzhong' => $value['gongzhong'],
    					'zhiwu' => $value['zhiwu'],
    					'dwname' => $valued['dwname'],
    					'gonghao' => $value['gonghao'],
    					);
    				}
    			
    			
    		}
    		$valued['jz'] = $jz;
    		$jz = array();
    		$valued['fjz'] = $fjz;
    		$fjz = array();
    		$valued['jzzl'] = $jzzl;
    		$jzzl = array();
    		$valued['qt'] = $qt;
    		$qt = array();
    	}
    	$index = 'indexfj';
    	cookie('index',$index,3600);
    	$this->assign('data',$drr);
    	$this->display();
    }
    
    
    public function indexyz(){
    	$d = M('danwei');
    	$drr = $d -> select();
    	$this->assign('drr',$drr);
    	$z = M('zhiwu');
    	$zrr = $z -> select();
    	$this->assign('zrr',$zrr);
    	$p = M('pers');
    	$prr = $p -> select();
    	$g = M('gongzhong');
    	$grr = $g -> select();
    	$this->assign('grr',$grr);
    	$yd = M('ydanwei');
    	$ydrr = $yd -> select();
    	$this->assign('ydrr',$ydrr);
    	$this->assign('prr',$prr);
    	$this->display();
    } 
    public function indexyzs(){
    	$limit = $_GET['limit'];
    	$page = $_GET['page'];
    	$first = $limit * ($page-1);
    	
    	$dwname = $_GET['dwname'];
    	$zhiwu = $_GET['zhiwu'];
    	$gongzhong = $_GET['gongzhong'];
    	$persname = $_GET['persname'];
    	$sex = $_GET['sex'];
    	$ydwname = $_GET['ydwname'];
    	
    	$g = M('gongzhong');
    	$d = M('danwei');
    	$p = M('pers');
    	$z = M('zhiwu');
    	$yd = M('ydanwei');
    	$fd = M('fzdanwei');
    	$fdrr = $fd -> select();
    	//判断搜索控件
    	if($dwname == null){
    		$drr = $d -> select();
    	}else{
    		$drr = $d -> where("jgh = $dwname") -> select();
    		$where['dwname'] = $dwname;
    	}
    	if($zhiwu == null){
    		$zrr = $z -> select();
    	}else{
    		$zrr = $z -> where("zhiwud = '$zhiwu'") -> select();
    		$where['zhiwu'] = $zhiwu;
    	}
    	if($gongzhong == null){
    		$grr = $g -> select();
    	}else{
    		$grr = $g -> where("gongzhongd = '$gongzhong'") -> select();
    		$where['gongzhong'] = $gongzhong;
    	}
    	if($persname == null){
    		
    	}else{
    		$where['persname'] = $persname;
    	}
    	if($sex == null){
    		
    	}else{
    		$where['sex'] = $sex;
    	}
    	if($ydwname == null){
    		$ydrr = $yd -> select();
    	}else{
    		$ydrr = $yd -> where("yjgh = $ydwname") -> select();
    		$drrs = $d -> where("yjgh = '$ydwname'") -> select();
    		foreach($drrs as &$value){
    			$ydw[] = $value['jgh'];
    		}
    		if($dwname == null){
    			$where['dwname'] = array('in',$ydw);
    		}else{
    			$where['dwname'] = $dwname or array('in',$ydw);
    		}
    		
    	}
    	//加入新搜索控件
    	if($dwname == null and $zhiwu == null and $persname == null and $gongzhong == null and $sex == null and $ydwname == null){
    		$prr = $p -> limit($first,$limit) -> order('dwname asc') -> select();
    		$count = $p -> count();
    	}else{
    		$prr = $p -> where($where) -> limit($first,$limit) -> order('dwname asc') -> select();
    		$count = $p -> where($where) -> count();
    	}
    	
    	foreach($prr as &$value){
    		foreach($grr as &$valueg){
    			if($valueg['gongzhongd'] == $value['gongzhong']){
    				$value['gongzhong'] = $valueg['gongzhong'];
    				continue;
    			}
    		}
    		foreach($drr as &$valued){
    			if($valued['jgh'] == $value['dwname']){
    				$value['dwname'] = $valued['dwname'];
    				$value['ydwname'] = $valued['yjgh'];
    				continue;
    			}
    		}
    		foreach($zrr as &$valuez){
    			if($valuez['zhiwud'] == $value['zhiwu']){
    				$value['zhiwu'] = $valuez['zhiwu'];
    				continue;
    			}
    		}
    		foreach($ydrr as &$valueyd){
    			if($valueyd['yjgh'] == $value['ydwname']){
    				$value['ydwname'] = $valueyd['ydwname'];
    				continue;
    			}
    		}
    		foreach($fzrr as &$valuefz){
    			if($valueyfz['fzjgh'] == $value['fzdwname']){
    				$value['fzdwname'] = $valueyd['fzdwname'];
    				continue;
    			}
    		}
    	}
    	$prrr=json_encode($prr);
    	$json = '{"code":0,"msg":"","count":'.$count.',"data":'.$prrr.'}';
    	echo $json;
    }
    
    
    public function persadd(){
    	$g = M('gongzhong');
    	$grr = $g -> select();
    	$this->assign('grr',$grr);
    	
    	$d = M('danwei');
    	$drr = $d -> select();
    	$this->assign('drr',$drr);
    	
    	$z = M('zhiwu');
    	$zrr = $z -> select();
    	$this->assign('zrr',$zrr);
    	
    	$fd = M('fzdanwei');
    	$fdrr = $fd -> select();
    	$this->assign('fdrr',$fdrr);
    	
    	$p = M('pers');
    	$max = $p ->max('gonghao');
    	$max = substr($max,1,6)+1;
    	$max = 'W000'.$max;
    	$this->assign('max',$max);
    	$this->display();
    }
    public function persaddsuc(){
    	$where['dwname'] = $_POST['dwname'];
    	$where['zhiwu'] = $_POST['zhiwu'];
    	$where['gongzhong'] = $_POST['gongzhong'];
    	$where['fzdwname'] = $_POST['fzdwname'];
    	$where['persname'] = $_POST['persname'];
    	$gonghao = $_POST['gonghao'];
    	$where['gonghao'] = $_POST['gonghao'];
    	$where['sex'] = $_POST['sex'];
    	$where['phone'] = $_POST['phone'];
    	
    	$p = M('pers');
    	$count = $p -> where("gonghao = '$gonghao'") -> count();
    	if($count > 0){
    		$this->error('人力编号已存在,请核对后再添加');
    	}else{
	    		$prr = $p -> add($where);
	    	if($prr > 0){
	    		$wherelogin['username'] = $gonghao;
	    		$wherelogin['password'] = $gonghao;
	    		$wherelogin['qx'] = 0;
	    		$login = M('login') -> add($wherelogin);
	    		$this->success('添加新员工成功,请继续操作');
	    	}else{
	    		$this->error('请检查人力编号,是否重复');
	    	}
    	}
    }

    public function persjgh(){
    	$jgh = $_GET['jgh'];
    	$p = M('pers');
    	$prr = $p -> where("dwname = '$jgh'") -> order('zhiwu desc')  -> select();
    	$data = $this -> persinfo($prr);
    	$this->assign('data',$data);
    	$this->display();
    	//var_dump($data);
    }
    
    

    
    
    public function qingjia(){
    	$limit = $_GET['limit'];
    	$page = $_GET['page'];
    	$first = $limit * ($page-1);
    	
    	$q = M('qingjia');
    	$where['shenhe'] = '审核同意';
    	$qrr = $q -> where($where) -> limit($first,$limit) -> order('date desc') -> select();
    	$count = $q -> where($where) -> limit($first,$limit) -> count();
    	
    	$prrr=json_encode($qrr);
    	$json = '{"code":0,"msg":"","count":'.$count.',"data":'.$prrr.'}';
    	echo $json;
    }
    public function qingjiashsuc(){
    	$id = $_POST['id'];
    	if($id == null){
    		$this->error('请假审核不成功,请检查数据');
    	}
    	$where['shenhe'] = '审核通过';
    	$where['shenhedate'] =date('Y-m-d');
    	$q = M('qingjia') -> where("id = $id") -> save($where);
    }
    public function qingjiasherr(){
    	$id = $_POST['id'];
    	if($id == null){
    		$this->error('请假审核不成功,请检查数据');
    	}
    	$where['shenhe'] = '审核不通过';
    	$where['shenhedate'] =date('Y-m-d');
    	$q = M('qingjia') -> where("id = $id") -> save($where);
    }
    public function qingjiacount(){
    	$ql = M('qingjialx');
    	$qlrr = $ql -> select();
    	$this->assign('qjlx',$qlrr);
    	$q = M('qingjia');
    	$where['shenhe'] = '审核通过';
    	$qrr = $q -> field('gonghao,persname,qjlx,sum(qjts) as sumqjts') -> group('gonghao,persname,qjlx') ->where($where) ->select();
    	$qrrc = $q -> field('gonghao,persname,sum(qjts) as sumqjts') -> group('gonghao,persname') ->where($where) ->select();
    	$p = M('pers');
    	$prr = $p -> select();
    	foreach($qlrr as &$valueql){
    		$qj[$valueql['id']] = 0;
    	}
    	foreach($qlrr as &$valueql){
    		foreach($prr as &$valuep){
    			foreach($qrr as &$value){
    				if($valueql['qingjialx'] == $value['qjlx'] and $valuep['gonghao'] == $value['gonghao']){
    				//$qj[$valueql['id']] = $valueql['qingjialx'];
    				$qj[$valueql['id']] = $value['sumqjts'];
    				$data[$value['gonghao']] = array(
    				'gonghao' => $value['gonghao'],
    				'persname' => $value['persname'],
    				'gongzhong' => $valuep['gongzhong'],
    				'dwname' => $valuep['dwname'],
    				'zhiwu' => $valuep['zhiwu'],
    				'qjlx' => $qj,
    				);
    				}
    			}
    		}
    	}
    	foreach($data as &$value){
    		foreach($qrrc as &$valueq){
    			if($valueq['gonghao'] == $value['gonghao']){
    				$value['sumqjts'] = $valueq['sumqjts'];
    				continue;
    			}
    		}
    	}
    	$g = M('gongzhong');
    	$grr = $g -> select();
    	
    	$d = M('danwei');
    	$drr = $d -> select();
    	
    	$z = M('zhiwu');
    	$zrr = $z -> select();
    	
    	foreach($grr as &$valueg){
    		foreach($data as &$value){
    			if($valueg['gongzhongd'] == $value['gongzhong']){
    				$value['gongzhong'] = $valueg['gongzhong'];
    			}
    		}
    	}
    	foreach($drr as &$valueg){
    		foreach($data as &$value){
    			if($valueg['jgh'] == $value['dwname']){
    				$value['dwname'] = $valueg['dwname'];
    			}
    		}
    	}
    	foreach($zrr as &$valueg){
    		foreach($data as &$value){
    			if($valueg['zhiwud'] == $value['zhiwu']){
    				$value['zhiwu'] = $valueg['zhiwu'];
    			}
    		}
    	}
    	$this->assign('data',$data);
    	//var_dump($data);
    	$this->display();
    }
    public function qingjiacounts(){
    	$ql = M('qingjialx');
    	$qlrr = $ql -> select();
    	$this->assign('qjlx',$qlrr);
    	$q = M('qingjia');
    	$where['shenhe'] = '审核通过';
    	$qrr = $q -> field('gonghao,persname,qjlx,sum(qjts) as sumqjts') -> group('gonghao,persname,qjlx') ->where($where) ->select();
    	$qrrc = $q -> field('gonghao,persname,sum(qjts) as sumqjts') -> group('gonghao,persname') ->where($where) ->select();
    	$data = $q -> distinct ( true ) -> field('persname,gonghao') -> where($where) -> select();
		$count = $q -> distinct ( true ) -> field('gonghao,persname') -> where($where) -> count();
		$p = M('pers');
		$prr = $p -> select();
		
		foreach($qlrr as &$valueql){
			foreach($data as &$valued){
				foreach($qrr as &$value){
					if($valueql['qingjialx'] == $value['qjlx'] and $valued['gonghao'] == $value['gonghao']){
						$valued[$valueql['id']] = $value['sumqjts'];
					}
				}
			}
		}
		foreach($data as &$value){
			foreach($prr as &$valuep){
				if($value['gonghao'] == $valuep['gonghao']){
					$value['dwname'] = $valuep['dwname'];
					$value['zhiwu'] = $valuep['zhiwu'];
					$value['gongzhong'] = $valuep['gongzhong'];
				}
				
			}
		}
    	foreach($data as &$value){
    		foreach($qrrc as &$valueq){
    			if($valueq['gonghao'] == $value['gonghao']){
    				$value['sumqjts'] = $valueq['sumqjts'];
    				continue;
    			}
    		}
    	}
    	$g = M('gongzhong');
    	$grr = $g -> select();
    	
    	$d = M('danwei');
    	$drr = $d -> select();
    	
    	$z = M('zhiwu');
    	$zrr = $z -> select();
    	
    	foreach($grr as &$valueg){
    		foreach($data as &$value){
    			if($valueg['gongzhongd'] == $value['gongzhong']){
    				$value['gongzhong'] = $valueg['gongzhong'];
    			}
    		}
    	}
    	foreach($drr as &$valueg){
    		foreach($data as &$value){
    			if($valueg['jgh'] == $value['dwname']){
    				$value['dwname'] = $valueg['dwname'];
    			}
    		}
    	}
    	foreach($zrr as &$valueg){
    		foreach($data as &$value){
    			if($valueg['zhiwud'] == $value['zhiwu']){
    				$value['zhiwu'] = $valueg['zhiwu'];
    			}
    		}
    	}
    	$this->assign('data',$data);
    	$datas = array();
    	
    	$prrr=json_encode($data);
    	$count = count($data);
    	$json = '{"code":0,"msg":"","count":'.$count.',"data":'.$prrr.'}';
    	echo $json;
    }
    public function qingjiacx(){
    	$gonghao = $_GET['gonghao'];
    	$where['gonghao'] = $gonghao;
    	$where['shenhe'] = "审核通过";
    	$q = M('qingjia');
    	$qrr = $q -> where($where) -> order('date desc') -> select();
    	$this->assign('qrr',$qrr);
    	$this->display();
    }
    public function qingjialx(){
    	$ql = M('qingjialx');
    	$qlrr = $ql -> select();
    	$this->assign('qlrr',$qlrr);
    	$this -> display();
    }
    public function qingjialxaddsuc(){
    	$where['qingjialx'] = $_POST['qingjialx'];
    	$where['bz'] = $_POST['bz'];
    	$ql = M('qingjialx');
    	$qlrr = $ql -> add($where);
    	if($qlrr > 0){
    		$this->success('请假类型添加成功,请继续',U('Index/qingjialx'));
    	}else{
    		$this->error('添加失败,请检查数据');
    	}
    }
    public function qingjialxedit(){
    	$id = $_GET['id'];
    	$ql = M('qingjialx');
    	$qlrr = $ql -> where("id = '$id'") -> find();
    	$this->assign('qingjialx',$qlrr);
    	$this->display();
    }
    public function qingjialxeditsuc(){
    	$id = $_POST['id'];
    	$where['qingjialx'] = $_POST['qingjialx'];
    	$where['bz'] = $_POST['bz'];
    	$ql = M('qingjialx');
    	$qlrr = $ql -> where("id = '$id'") -> save($where);
    	if($qlrr > 0){
    		$this->success('请假类型修改成功,请继续',U('Index/qingjialx'));
    	}else{
    		$this->error('修改失败,请检查数据');
    	}
    }
    public function lungangjr(){
    	$lg = M('lungang');
    	$count = $lg -> count();
    	if($count == 0){
    		$d = M('danwei');
    		$drr = $d -> where("jiagou = 'A1'") -> select();
    		$z = M('zhiwu');
    		$zrr = $z -> select();
    		
    		foreach($drr as &$value){
    			$dr[] = $value['jgh'];
    		}
    		$p = M('pers');
    		$wherep['dwname'] = array('in',$dr);
    		$prr = $p -> where($wherep) -> select();
    		foreach($prr as &$value){
    			foreach($zrr as &$valuez){
    				if($valuez['zhiwud'] == $value['zhiwu']){
    					$value['zwjiagou'] = $valuez['zwjiagou'];
    					continue;
    				}
    			}
    		}
    		foreach($prr as &$value){
    			$data[] = array(
    			'dwname' => $value['dwname'],
    			'zhiwu' => $value['zhiwu'],
    			'gongzhong' => $value['gongzhong'],
    			'persname' => $value['persname'],
    			'gonghao' => $value['gonghao'],
    			'zwjiagou' => $value['zwjiagou'],
    			'ydwname' => $value['dwname'],
    			'yzhiwu' => $value['zhiwu'],
    			'gongzhong' => $value['gongzhong'],
    			'date' => date(Y),
    			);
    		}
    		$lgrr = $lg -> addall($data);
    		if($lgrr > 0){
    			$this->success('数据添加成功,请继续操作');
    		}
    	}else{
    		var_dump($count);
    	}
    }
    
    
    public function tablepers(){
    	$p = M('pers');
    	$prr = $p -> order('dwname desc') -> select();
    	$data = $this -> persinfo($prr);
    	
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
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('G')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('H')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('I')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('J')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('K')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('L')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('M')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('N')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $objActSheet->setCellValue('A1', '机构单位');
        $objActSheet->setCellValue('B1', '机构分支');
        $objActSheet->setCellValue('C1', '职务');
        $objActSheet->setCellValue('D1', '人员分类');
        $objActSheet->setCellValue('E1', '姓名');
        $objActSheet->setCellValue('F1', '工号');
        $objActSheet->setCellValue('G1', '性别');
        $objActSheet->setCellValue('H1', '电话号码');
        $objActSheet->setCellValue('I1', '身份证');
        $objActSheet->setCellValue('J1', '合同主体');
        $objActSheet->setCellValue('K1', '合同类型');
        $objActSheet->setCellValue('L1', '合同起始日期');
        $objActSheet->setCellValue('M1', '合同终止日期');
        $objActSheet->setCellValue('N1', '学历');
        
        foreach($data as $k=>$v){
            $k +=2;
            $objActSheet->setCellValue('A'.$k, $v['dwname']);
            $objActSheet->setCellValue('B'.$k, $v['fzdwname']);
            $objActSheet->setCellValue('C'.$k, $v['zhiwu']);    
            $objActSheet->setCellValue('D'.$k, $v['gongzhong']);
            $objActSheet->setCellValue('E'.$k, $v['persname']);
            $objActSheet->setCellValue('F'.$k, $v['gonghao']);
            $objActSheet->setCellValue('G'.$k, $v['sex']);
            $objActSheet->setCellValue('H'.$k, $v['phone']);
            $objActSheet->setCellValue('I'.$k, $v['sfz']."\t");
            $objActSheet->setCellValue('J'.$k, $v['hetongzhuti']);
            $objActSheet->setCellValue('K'.$k, $v['hetongleixing']);    
            $objActSheet->setCellValue('L'.$k, $v['hetongks']);
            $objActSheet->setCellValue('M'.$k, $v['ketongzz']);    
            $objActSheet->setCellValue('N'.$k, $v['xueli']);
            //$objActSheet->setCellValue('E'.$k, $v['sfz']."\t");
            
            $objActSheet->getRowDimension($k)->setRowHeight(18);
        }
        $fileName = '余杭区全局花名册基础信息,';
        $date = date('Y-m-d');
        $fileName .= "{$date}.xlsx";

        $fileName = iconv("utf-8", "gb2312", $fileName);
        $objPHPExcel->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=\"$fileName\"");
        header('Cache-Control: max-age=0');

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output'); //文件通过浏览器下载
        // END
    	//var_dump($data);
    }
    
    
    
    
    
    
    
    
    
    
    public function carpersinfoadd(){
    	$d=M('danwei');
    	$drr=$d->select();
    	$i=M('insur');
    	$irr=$i->select();
    	$r=M('rebate');
    	$rrr=$r->select();
    	foreach($rrr as &$value){
    		$value['rebates']=$value['rebate']*100;
    	}
    	$this->assign('rebate',$rrr);
    	$this->assign('insur',$irr);
    	$this->assign('dwname',$drr);
    	$this->display();
    }
    public function carpersinfoaddsuc(){
    	$where['dwname']=$_POST['dwname'];
    	$where['ywy']=$_POST['ywy'];
    	$where['ywyphone']=$_POST['ywyphone'];
    	$where['kh']=$_POST['kh'];
    	$where['khphone']=$_POST['khphone'];
    	$where['chepai']=$_POST['chepai'];
    	$where['jqx']=$_POST['jqx'];
    	$where['ccs']=$_POST['ccs'];
    	$where['syx']=$_POST['syx'];
    	$where['bxdq']=$_POST['bxdq'];
    	$where['insur']=$_POST['insur'];
    	$where['rebate']=$_POST['rebate'];
    	$where['irebate']=$_POST['irebate'];
    	$where['sum']=round($_POST['jqx']+$_POST['ccs']+$_POST['syx'],2);
    	$where['remun']=round($_POST['syx']*$_POST['rebate'],2);
    	$where['date']=date('Y-m-d');
    	
    	$shouru=round($_POST['jqx']*0.04,0);
    	$where['iremun']=round($_POST['syx']*$_POST['irebate'],2)+$shouru;
    	$c=M('custinfo');
    	//var_dump($where);
    	$crr=$c->add($where);
    	if($crr>0){
    		$this->success('客户添加成功,请继续操作');
    	}else{
    		$this->error('客户添加失败,请检查数据');
    	}
    }
    public function carpersinfomodify(){
    	$c=M('custinfo');
    	$ckh=$c->distinct(true)->field('kh')->select();
    	$ccp=$c->distinct(true)->field('chepai')->select();
    	$this->assign('ckh',$ckh);
    	$this->assign('ccp',$ccp);
    	$this->display();
    }
    public function carpersinfomodifycx(){
    	$kh=$_POST['kh'];
    	$chepai=$_POST['chepai'];
    	if($kh==null and $chepai==null){
    		$this->error('请重新选择客户或者客户车牌');
    	}else if($chepai==null){
    		$c=M('custinfo');
    		$where['kh']=$kh;
    		
    	}else if($kh==null){
    		$c=M('custinfo');
    		$where['chepai']=$chepai;
    	}else{
    		$c=M('custinfo');
    		$where['kh']=$kh;
    		$where['chepai']=$chepai;
    	}
    	$crr=$c->where($where)->select();
    	$this->assign('crr',$crr);
    	$this->display();
    }
    public function carpersinfomodifycxs(){
    	$id=$_GET['id'];
    	$c=M('custinfo');
    	$crr=$c->where("id='$id'")->find();
    	$d=M('danwei');
    	$drr=$d->select();
    	foreach($drr as &$value){
    		if($value['jgh']==$crr['dwname']){
    			$crr['dwname']=$value['dwname'];
    			break;
    		}
    	}
    	$i=M('insur');
    	$irr=$i->select();
    	foreach($irr as &$value){
    		if($value['id']==$crr['insur']){
    			$crr['insur']=$value['name'];
    			break;
    		}
    	}
    	$this->assign('insur',$irr);
    	$this->assign('dwname',$drr);
    	$this->assign('crr',$crr);
    	$this->display();
    }
    public function carpersinfomodifycxssuc(){
    	$id=$_POST['id'];
    	$where['dwname']=$_POST['dwname'];
    	$where['ywy']=$_POST['ywy'];
    	$where['ywyphone']=$_POST['ywyphone'];
    	$where['kh']=$_POST['kh'];
    	$where['khphone']=$_POST['khphone'];
    	$where['chepai']=$_POST['chepai'];
    	$where['jqx']=$_POST['jqx'];
    	$where['ccs']=$_POST['ccs'];
    	$where['syx']=$_POST['syx'];
    	$where['bxdq']=$_POST['bxdq'];
    	$where['insur']=$_POST['insur'];
    	$where['rebate']=$_POST['rebate'];
    	$where['irebate']=$_POST['irebate'];
    	$where['sum']=round($_POST['jqx']+$_POST['ccs']+$_POST['syx'],2);
    	$where['remun']=round($_POST['syx']*$_POST['rebate'],2);
    	
    	$shouru=round($_POST['jqx']*0.04,0);
    	$where['iremun']=round($_POST['syx']*$_POST['irebate'],2)+$shouru;
    	$c=M('custinfo');
    	//var_dump($where);
    	$crr=$c->where("id='$id'")->save($where);
    	if($crr>0){
    		$this->success('客户信息修改成功,请继续操作',U('carpersinfomodify'));
    	}else{
    		$this->error('客户信息修改失败,请检查数据');
    	}
    }
    public function carpersinfodqtscxdl(){
    	$data=session('datas');
    	$dqts=session('dqts');
    	
    	$date = date('Y-m-d',strtotime("+$dqts day"));
    	//var_dump($dqts);
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
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('G')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('H')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('I')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('J')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('K')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('L')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('M')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('N')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $objActSheet->setCellValue('A1', '机构单位');
        $objActSheet->setCellValue('B1', '业务员');
        $objActSheet->setCellValue('C1', '业务员联系电话');
        $objActSheet->setCellValue('D1', '客户');
        $objActSheet->setCellValue('E1', '客户联系电话');
        $objActSheet->setCellValue('F1', '车牌');
        $objActSheet->setCellValue('G1', '交强险');
        $objActSheet->setCellValue('H1', '车船税');
        $objActSheet->setCellValue('I1', '商业险');
        $objActSheet->setCellValue('J1', '合计');
        $objActSheet->setCellValue('K1', '保险到期日');
        $objActSheet->setCellValue('L1', '投保保险公司');
        $objActSheet->setCellValue('M1', '基础返点百分比');
        $objActSheet->setCellValue('N1', '基础酬金');
        
        foreach($data as $k=>$v){
            $k +=2;
            $objActSheet->setCellValue('A'.$k, $v['dwname']);
            $objActSheet->setCellValue('B'.$k, $v['ywy']);
            $objActSheet->setCellValue('C'.$k, $v['ywyphone']);    
            $objActSheet->setCellValue('D'.$k, $v['kh']);
            $objActSheet->setCellValue('E'.$k, $v['khphone']);
            $objActSheet->setCellValue('F'.$k, $v['chepai']);
            $objActSheet->setCellValue('G'.$k, $v['jqx']);
            $objActSheet->setCellValue('H'.$k, $v['ccs']);
            $objActSheet->setCellValue('I'.$k, $v['syx']);
            $objActSheet->setCellValue('J'.$k, $v['sum']);
            $objActSheet->setCellValue('K'.$k, $v['bxdq']);    
            $objActSheet->setCellValue('L'.$k, $v['insur']);
            $objActSheet->setCellValue('M'.$k, $v['rebate']);    
            $objActSheet->setCellValue('N'.$k, $v['remun']);
            //$objActSheet->setCellValue('E'.$k, $v['sfz']."\t");
            
            $objActSheet->getRowDimension($k)->setRowHeight(18);
        }
        $fileName = $jgh.'车险即将到期客户,';
        $date = date('Y-m-d',strtotime("+$dqts day"));
        $fileName .= "{$date}前到期的客户.xlsx";

        $fileName = iconv("utf-8", "gb2312", $fileName);
        $objPHPExcel->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=\"$fileName\"");
        header('Cache-Control: max-age=0');

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output'); //文件通过浏览器下载
        // END
    }
    public function carpersinfodlsuc(){
    	$date=$_POST['year'];
    	$where['date']=array('GT',$date);
    	$c=M('custinfo');
    	$data=$c->where($where)->select();
    	$d=M('danwei');
    	$drr=$d->select();
    	$i=M('insur');
    	$irr=$i->select();
    	foreach($drr as &$valued){
    		foreach($data as &$value){
    			if($valued['jgh']==$value['dwname']){
    				$value['dwname']=$valued['dwname'];
    			}
    		}
    	}
    	foreach($irr as &$valuei){
    		foreach($data as &$value){
    			if($valuei['id']==$value['insur']){
    				$value['insur']=$valuei['name'];
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
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('G')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('H')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('I')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('J')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('K')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('L')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('M')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('N')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('O')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('P')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $objActSheet->setCellValue('A1', '机构单位');
        $objActSheet->setCellValue('B1', '业务员');
        $objActSheet->setCellValue('C1', '业务员联系电话');
        $objActSheet->setCellValue('D1', '客户');
        $objActSheet->setCellValue('E1', '客户联系电话');
        $objActSheet->setCellValue('F1', '车牌');
        $objActSheet->setCellValue('G1', '交强险');
        $objActSheet->setCellValue('H1', '车船税');
        $objActSheet->setCellValue('I1', '商业险');
        $objActSheet->setCellValue('J1', '合计');
        $objActSheet->setCellValue('K1', '保险到期日');
        $objActSheet->setCellValue('L1', '投保保险公司');
        $objActSheet->setCellValue('M1', '保险公司返点百分比');
        $objActSheet->setCellValue('N1', '保险公司酬金');
        $objActSheet->setCellValue('O1', '基础返点百分比');
        $objActSheet->setCellValue('P1', '基础酬金');
        
        foreach($data as $k=>$v){
            $k +=2;
            $objActSheet->setCellValue('A'.$k, $v['dwname']);
            $objActSheet->setCellValue('B'.$k, $v['ywy']);
            $objActSheet->setCellValue('C'.$k, $v['ywyphone']);
            $objActSheet->setCellValue('D'.$k, $v['kh']);
            $objActSheet->setCellValue('E'.$k, $v['khphone']);
            $objActSheet->setCellValue('F'.$k, $v['chepai']);
            $objActSheet->setCellValue('G'.$k, $v['jqx']);
            $objActSheet->setCellValue('H'.$k, $v['ccs']);
            $objActSheet->setCellValue('I'.$k, $v['syx']);
            $objActSheet->setCellValue('J'.$k, $v['sum']);
            $objActSheet->setCellValue('K'.$k, $v['bxdq']);
            $objActSheet->setCellValue('L'.$k, $v['insur']);
            $objActSheet->setCellValue('M'.$k, $v['irebate']);
            $objActSheet->setCellValue('N'.$k, $v['iremun']);
            $objActSheet->setCellValue('O'.$k, $v['rebate']);
            $objActSheet->setCellValue('P'.$k, $v['remun']);
            //$objActSheet->setCellValue('E'.$k, $v['sfz']."\t");
            
            $objActSheet->getRowDimension($k)->setRowHeight(18);
        }
        $fileName = '车险客户明细,';
        $date = date('Y-m-d');
        $fileName .= "{$date}.xlsx";

        $fileName = iconv("utf-8", "gb2312", $fileName);
        $objPHPExcel->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=\"$fileName\"");
        header('Cache-Control: max-age=0');
        
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output'); //文件通过浏览器下载
        // END
    }
    public function carpersinfodl(){
    	$nian=date(Y);
    	$y=M('year');
    	$where['year']=array('elt',$nian);
    	$yrr=$y->where($where)->select();
    	//var_dump($yrr);
    	$mrr=array(1,2,3,4,5,6,7,8,9,10,11,12);
    	//var_dump($mrr);
    	$this->assign('yrr',$yrr);
    	$this->assign('mrr',$mrr);
    	$this->display();
    }
    public function carpersinfocx(){
    	$d=M('danwei');
    	$drr=$d->select();
    	$this->assign('dwname',$drr);
    	$this->display();
    }
    public function danweimanage(){
    	$d=M('danwei');
    	$drr=$d->select();
    	$this->assign('dwname',$drr);
    	$this->display();
    }
    public function insurmanage(){
    	$i=M('insur');
    	$irr=$i->select();
    	$this->assign('insur',$irr);
    	$this->display();
    }
    public function rebatemanage(){
    	$r=M('rebate');
    	$rrr=$r->select();
    	$this->assign('rebate',$rrr);
    	$this->display();
    }
    public function carpersinfodqtscx(){
    	$dqts=$_POST['dqts'];
    	$dwname=$_POST['dwname'];
    	
    	session('dqts',$dqts);
    	//var_dump($dqts);
    	$c=M('custinfo');
    	$crr=$c->select();
    	$i=M('insur');
    	$irr=$i->select();
    	$d=M('danwei');
    	if($dwname==null){
    		$drr=$d->select();
    	}else{
    		$drr=$d->where("jgh='$dwname'")->select();
    		//var_dump($dqts);
    	}
    	$today=date('Y-m-d');
    	foreach($drr as &$valued){
    	  foreach($crr as &$value){
    	     $date=date('Y-m-d',strtotime("+$dqts day"));
    	     
    		  if($value['bxdq']<$date and $value['dwname']==$valued['jgh'] and $value['bxdq']>$today){
    			$data[]=array(
    			'dwname'=>$value['dwname'],
    			'kh'=>$value['kh'],
    			'khphone'=>$value['khphone'],
    			'chepai'=>$value['chepai'],
    			'bxdq'=>$value['bxdq'],
    			'insur'=>$value['insur'],
    			'sum'=>$value['sum'],
    			
    			'jqx'=>$value['jqx'],
    			'ccs'=>$value['ccs'],
    			'syx'=>$value['syx'],
    			'rebate'=>($value['rebate']*100).'%',
    			'remun'=>$value['remun'],
    			'ywy'=>$value['ywy'],
    			'ywyphone'=>$value['ywyphone'],
    			);
    		   }
    	    }
    	}
    		
    	foreach($drr as &$valued){
    		foreach($data as &$value){
    		  if($valued['jgh']==$value['dwname']){
    			$value['dwname']=$valued['dwname'];
    		  }
    	    }
    	}
    	foreach($irr as &$valued){
    		foreach($data as &$value){
    		  if($valued['id']==$value['insur']){
    			$value['insur']=$valued['name'];
    		  }
    	    }
    	}
    	//var_dump($data);
    	session('datas',$data);
    	$this->assign('data',$data);
    	$this->display();
    }
    public function danweireportbmbb(){
    	$qsrq=$_POST['qsrq'];
    	$zzrq=$_POST['zzrq'];
    	$where['date']=array('between',array($qsrq,$zzrq));
    	
    	$c=M('custinfo');
    	
    	$crr=$c->field('dwname,count(kh) as countkh,sum(remun) as sumremun,sum(iremun) as sumiremun')->where($where)->group('dwname')->select();
    	$d=M('danwei');
    	$whered['qx']=1;
    	$drr=$d->where($whered)->select();
    	foreach($drr as &$valued){
    		foreach($crr as &$value){
    			if($valued['jgh']==$value['dwname']){
    				$valued['countkh']=$value['countkh'];
    				$valued['sumiremun']=$value['sumiremun'];
    				$valued['sumremun']=$value['sumremun'];
    				$valued['bl']=round($valued['countkh']/$valued['target'],2)*100;
    				$count=$value['countkh'];
    				$sumiremun=$value['sumiremun'];
    				$target=$valued['target'];
    			}
    		}
    		$counts['count']=$counts['count']+$count;
    		$counts['sumiremun']=$counts['sumiremun']+$sumiremun;
    		$counts['target']=$counts['target']+$target;
    	}
    	$counts['bl']=round($counts['count']/$counts['target'],2)*100;
    	$dr=array();
    	$sort = array(
               'direction' => 'SORT_DESC', //排序顺序标志 SORT_DESC 降序；SORT_ASC 升序
               'field'     => 'bl',       //排序字段
                );
    	foreach($drr as $uniqid => $row){
    		foreach($row as $key => $value){
    			$dr[$key][$uniqid] = $value;
    		}
    	}
    	if($sort['direction']){
           array_multisort($dr[$sort['field']], constant($sort['direction']), $drr);
         }
    	
    	$this->assign('dwname',$drr);
    	$this->assign('count',$counts);
    	$this->display();
    }
    public function danweireportwdbb(){
    	$qsrq=$_POST['qsrq'];
    	$zzrq=$_POST['zzrq'];
    	$where['date']=array('between',array($qsrq,$zzrq));
    	$counts[]=array();
    	$c=M('custinfo');
    	
    	$crr=$c->field('dwname,count(kh) as countkh,sum(remun) as sumremun,sum(iremun) as sumiremun')->where($where)->group('dwname')->select();
    	$d=M('danwei');
    	$whered['qx']=0;
    	$drr=$d->where($whered)->select();
    	foreach($drr as &$valued){
    		$valued['countkh']=0;
    		$valued['sumiremun']=0;
    		$valued['bl']=0;
    		foreach($crr as &$value){
    			if($valued['jgh']==$value['dwname']){
    				$valued['countkh']=$value['countkh'];
    				$valued['sumiremun']=$value['sumiremun'];
    				$valued['sumremun']=$value['sumremun'];
    				$valued['bl']=round($valued['countkh']/$valued['target'],2)*100;
    				$count=$value['countkh'];
    				$sumiremun=$value['sumiremun'];
    				$target=$valued['target'];
    			}
    		}
    		$counts['count']=$counts['count']+$count;
    		$counts['sumiremun']=$counts['sumiremun']+$sumiremun;
    		$counts['target']=$counts['target']+$target;
    	}
    	$counts['bl']=round($counts['count']/$counts['target'],2)*100;
    	$dr=array();
    	$sort = array(
               'direction' => 'SORT_DESC', //排序顺序标志 SORT_DESC 降序；SORT_ASC 升序
               'field'     => 'bl',       //排序字段
                );
    	foreach($drr as $uniqid => $row){
    		foreach($row as $key => $value){
    			$dr[$key][$uniqid] = $value;
    		}
    	}
    	if($sort['direction']){
           array_multisort($dr[$sort['field']], constant($sort['direction']), $drr);
         }
    	$this->assign('dwname',$drr);
    	$this->assign('count',$counts);
    	$this->display();
    }
    public function carpersinfomanage(){
    	$c=M('custinfo');
    	$crr=$c->distinct(true)->field('chepai,kh')->select();
    	$this->assign('crr',$crr);
    	$this->display();
    }
    public function carinfomanage(){
    	$chepai = $_GET['chepai'];
    	$kh = $_GET['kh'];
    	if($chepai==null){
    		
    	}else{
    		$where['chepai'] = $chepai;
    	}
    	if($kh==null){
    		
    	}else{
    		$where['kh'] = $kh;
    	}
    	$limit = $_GET['limit'];
    	$page = $_GET['page'];
    	$first = $limit * ($page-1);
    	//var_dump($l);
    	$c=M('custinfo');
    	$d=M('danwei');
    	$drr=$d->select();
    	$i=M('insur');
    	$irr=$i->select();
    	//$count=$d->count();
    	if($chepai==null and $kh==null){
    		$crr=$c->limit($first,$limit)->select();
    		foreach($drr as &$valued){
    			foreach($crr as &$value){
    				if($valued['jgh']==$value['dwname']){
    					$value['dwname']=$valued['dwname'];
    				}
    			}
    		}
    		foreach($irr as &$valuei){
    			foreach($crr as &$value){
    				if($valuei['id']==$value['insur']){
    					$value['insur']=$valuei['name'];
    				}
    			}
    		}
    		$count=$c->count();
    	}else{
    		$crr=$c->limit($first,$limit)->where($where)->select();
    		$count=$c->where($where)->count();
    		foreach($drr as &$valued){
    			foreach($crr as &$value){
    				if($valued['jgh']==$value['dwname']){
    					$value['dwname']=$valued['dwname'];
    				}
    			}
    		}
    		foreach($irr as &$valuei){
    			foreach($crr as &$value){
    				if($valuei['id']==$value['insur']){
    					$value['insur']=$valuei['name'];
    				}
    			}
    		}
    		
    	}
    	
    	$drrr=json_encode($crr);
    	
    	//$this->assign('drrr',$drrr);
    	$json = '{"code":0,"msg":"","count":'.$count.',"data":'.$drrr.'}';
    	echo $json;
    }
    
    
    public function liangshouup(){
        $files = $_FILES['exl'];
        var_dump($files);
        // exl格式，否则重新上传
        if($files['type'] !='application/vnd.ms-excel'){
            $this->error('不是Excel文件，请重新上传');
        }
        // 上传
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     209715200 ;// 设置附件上传大小
        $upload->exts      =     array('xls','xlsx','csv');// 设置附件上传类型
        $upload->rootPath  =     './Public/Uploads/'; // 设置附件上传根目录
        $upload->savePath  =     'EXCEL/'; //设置附件上传（子）目录
        //$upload->subName   =     array('date', 'Ym');
        $upload->subName   =     '';
        // 上传文件  
        $info   =   $upload->upload();
        
        $file_name =  $upload->rootPath.$info['exl']['savepath'].$info['exl']['savename'];
//      //$exl = $this->import_exl($file_name);
        import("Org.Util.PHPExcel");   // 这里不能漏掉
        import("Org.Util.PHPExcel.IOFactory");
//      $objReader = \PHPExcel_IOFactory::createReader('Excel2007');
//      $objPHPExcel = $objReader->load($file_name,$encode='utf-8');
        $objReader = \PHPExcel_IOFactory::createReader('Excel5');
        $objPHPExcel = $objReader->load($file_name,$encode='utf-8');
//      //$extension = strtolower( pathinfo($files, PATHINFO_EXTENSION) );
//      //var_dump($extension);
//      //if ($extension =='xlsx') {
//      //$objReader = new PHPExcel_Reader_Excel2007();
//      //$objExcel = $objReader ->load($file);
//      //} else if ($extension =='xls') {
//      //$objReader = new PHPExcel_Reader_Excel5();
//      //$objExcel = $objReader ->load($file);
//      //}
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow(); // 取得总行数
        $highestColumn = $sheet->getHighestColumn(); // 取得总列数
        //var_dump($highestColumn);
        //$p=M('persold');
        $z=0;
//      // 去掉第exl表格中第一行
//      //unset($exl[0]);
        for($i=3;$i<=$highestRow;$i++)
        {
        	//$y=$i-2;
        	$data[$z]['dwname'] = $objPHPExcel->getActiveSheet()->getCell("A".$i)->getValue();
        	$data[$z]['hj'] = $objPHPExcel->getActiveSheet()->getCell("B".$i)->getValue();
        	$data[$z]['hjptxb'] = $objPHPExcel->getActiveSheet()->getCell("C".$i)->getValue();
        	$data[$z]['hjptyp'] = $objPHPExcel->getActiveSheet()->getCell("D".$i)->getValue();
        	$data[$z]['hjqtyw'] = $objPHPExcel->getActiveSheet()->getCell("E".$i)->getValue();
        	$data[$z]['bg'] = $objPHPExcel->getActiveSheet()->getCell("F".$i)->getValue();
        	$data[$z]['sd'] = $objPHPExcel->getActiveSheet()->getCell("G".$i)->getValue();
        	//$data[$z]['sdbzsd'] = $objPHPExcel->getActiveSheet()->getCell("H".$i)->getValue();
        	$data[$z]['sdkdbg'] = $objPHPExcel->getActiveSheet()->getCell("H".$i)->getValue();
        	$data[$z]['csp'] = $objPHPExcel->getActiveSheet()->getCell("I".$i)->getValue();
        	$z++;
        }
        //$prr=$p->addall($data);
        $dj=M('danweijg');
        $djrr=$dj->select();
        foreach($djrr as &$value){
        	foreach($data as &$valued){
        		if($value['dwname']==$valued['dwname']){
        			$valued['jgh']=$value['jgh'];
        		}
        	}
        }
        $d=M('danwei');
        $drr=$d->select();
        foreach($drr as &$values){
        	$values['hj']=0;
            $values['bg']=0;
        	$values['sd']=0;
        	$values['sdkdbg']=0;
        	$values['csp']=0;
        }
        foreach($drr as &$value){
        	$value['date']=date('Ymd');
        	foreach($data as &$valued){
        		if($value['jgh']==$valued['jgh']){
        			$value['hj']=$value['hj']+$valued['hj']-$valued['hjptxb']+$valued['hjptyp']+$valued['hjqtyw'];
        			//$value['hjptxb']=$value['hjptxb'];
        			//$value['hjptyp']=$value['hjptyp'];
        			//$value['hjqtyw']=$value['hjqtyw'];
        			$value['bg']=$value['bg']+$valued['bg'];
        			$value['sd']=$value['sd']+$valued['sd']-$valued['sdkdbg'];
        			//$value['sdbzsd']=$value['sdbzsd']+$valued['sdbzsd'];
        			$value['sdkdbg']=$value['sdkdbg']+$valued['sdkdbg'];
        			$value['csp']=$value['csp']+$valued['csp'];
        		}
        	}
        }
        $l=M('liangshou');
        $lrr=$l->addall($drr);
        if($lrr>0){
        	$this->success('EXCEL数据导入成功');
        }
        //var_dump($drr);
//      $handle = fopen ( $file_name, 'r' );
//      $z=0;
//      $p=M('persold');
//      while($data = fgetcsv($handle)){
//      $arr[]=$data;
//      }
//      for($i=0;$i<count($arr);$i++){
//      $brr[$z]=array(
//      'jgh'=>$arr[$i][0],
//      'dwname'=>$arr[$i][0],
//      'sfz'=>$arr[$i][2],
//      'name'=>iconv('gbk','utf-8',$arr[$i][3]),
//      'zyue'=>$arr[$i][4],
//      'huoqi'=>$arr[$i][5],
//      'dingqi'=>$arr[$i][6],
//      'jghsfz'=>$arr[$i][0].$arr[$i][2],
//      'date'=>date('Y-m-d'),
//      );
//      $z++;
//      if($z==999){
//         $prr=$p->addall($brr);
//      	$z=0;
//      	unset($brr);
//      	}
//      }
//      $prr=$p->addall($brr);
//      unset($brr);

        //var_dump($data);
        //$prr=$p->addall($data);
        // 清理空数组
//      foreach($exl as $k=>$v){
//          if(empty($v)){
//              unset($exl[$k]);
//          }
//      };
        // 重新排序
        //sort($exl);
        
//      $count = count($exl);
//      // 检测表格导入成功后，是否有数据生成
//      if($count<1){
//          $this->error('未检测到有效数据');    
//      }
        //var_dump($data);
        
        // 删除Excel文件
        //unlink($file_name);
        //$this->display('info');
//      if($prr>0){
//      	$this->success('EXCEL数据导入成功');
//      }
    }
    public function datacollectsdl(){
    	$l=M('liangshou');
    	$data=$l->select();
    	
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
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('G')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('H')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('I')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('J')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('K')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('L')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('M')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('N')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('O')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('P')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('Q')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('R')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('S')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                
        $objActSheet->setCellValue('A1', '机构单位');
        $objActSheet->setCellValue('B1', '函件');
        $objActSheet->setCellValue('C1', '国际小包');
        $objActSheet->setCellValue('D1', '包件');
        $objActSheet->setCellValue('E1', '标快');
        $objActSheet->setCellValue('F1', '快递包裹');
        $objActSheet->setCellValue('G1', '汇票');
        $objActSheet->setCellValue('H1', '报刊');
        $objActSheet->setCellValue('I1', '储蓄');
        $objActSheet->setCellValue('J1', '集邮');
        $objActSheet->setCellValue('K1', '机要');
        $objActSheet->setCellValue('L1', '短信清分');
        $objActSheet->setCellValue('M1', '信息收入');
        $objActSheet->setCellValue('N1', '分销收入');
        $objActSheet->setCellValue('O1', '出售品');
        $objActSheet->setCellValue('P1', '合计');
        $objActSheet->setCellValue('Q1', '其他业务收入');
        $objActSheet->setCellValue('R1', '本月合计');
        $objActSheet->setCellValue('S1', '速递合计');
        
        foreach($data as $k=>$v){
            $k +=2;
            $objActSheet->setCellValue('A'.$k, $v['dwname']);
            $objActSheet->setCellValue('B'.$k, $v['hj']);
            $objActSheet->setCellValue('C'.$k, '');
            $objActSheet->setCellValue('D'.$k, $v['bg']);
            $objActSheet->setCellValue('E'.$k, $v['sd']);
            $objActSheet->setCellValue('F'.$k, $v['bgkdbg']);
            $objActSheet->setCellValue('G'.$k, '');
            $objActSheet->setCellValue('H'.$k, '');
            $objActSheet->setCellValue('I'.$k, '');    
            $objActSheet->setCellValue('J'.$k, '');
            $objActSheet->setCellValue('K'.$k, '');
            $objActSheet->setCellValue('L'.$k, '');
            $objActSheet->setCellValue('M'.$k, '');
            $objActSheet->setCellValue('N'.$k, '');
            $objActSheet->setCellValue('O'.$k, $v['csp']);
            $objActSheet->setCellValue('P'.$k, '');
            $objActSheet->setCellValue('Q'.$k, '');
            $objActSheet->setCellValue('R'.$k, '');
            $objActSheet->setCellValue('S'.$k, '');
            
            $objActSheet->getRowDimension($k)->setRowHeight(18);
        }
        $fileName = $jgh.'量收总表';
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
    }
    public function lscleans(){
    	$p=D('');
    	$p->execute("truncate table cw_liangshou");
    	$this->success('数据已清空，请继续操作');
    }
    public function pers(){
        $files = $_FILES['exl'];
        var_dump($files);
        // exl格式，否则重新上传
        //if($files['type'] !='application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'){
        if($files['type'] !='application/vnd.ms-excel'){
            $this->error('不是Excel文件，请重新上传');
        }
        // 上传
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     209715200 ;// 设置附件上传大小
        $upload->exts      =     array('xls','xlsx','csv');// 设置附件上传类型
        $upload->rootPath  =     './Public/Uploads/'; // 设置附件上传根目录
        $upload->savePath  =     'EXCEL/'; //设置附件上传（子）目录
        //$upload->subName   =     array('date', 'Ym');
        $upload->subName   =     '';
        // 上传文件  
        $info   =   $upload->upload();
        
        $file_name =  $upload->rootPath.$info['exl']['savepath'].$info['exl']['savename'];
//      //$exl = $this->import_exl($file_name);
//      import("Org.Util.PHPExcel");   // 这里不能漏掉
//      import("Org.Util.PHPExcel.IOFactory");
//      $objReader = \PHPExcel_IOFactory::createReader('Excel2007');
//      $objPHPExcel = $objReader->load($file_name,$encode='utf-8');
//      //$objReader = \PHPExcel_IOFactory::createReader('Excel5');
//      //$objPHPExcel = $objReader->load($file_name,$encode='utf-8');
//      //$extension = strtolower( pathinfo($files, PATHINFO_EXTENSION) );
//      //var_dump($extension);
//      //if ($extension =='xlsx') {
//      //$objReader = new PHPExcel_Reader_Excel2007();
//      //$objExcel = $objReader ->load($file);
//      //} else if ($extension =='xls') {
//      //$objReader = new PHPExcel_Reader_Excel5();
//      //$objExcel = $objReader ->load($file);
//      //}
//      $sheet = $objPHPExcel->getSheet(0);
//      $highestRow = $sheet->getHighestRow(); // 取得总行数
//      $highestColumn = $sheet->getHighestColumn(); // 取得总列数
//      var_dump($highestColumn);
//      var_dump($highestRow);
//      $p=M('pers');
//      $z=0;
//      // 去掉第exl表格中第一行
//      //unset($exl[0]);
//      for($i=2;$i<=$highestRow;$i++)
//      {
//      	//$y=$i-2;
//      	$data[$z]['jgh'] = $objPHPExcel->getActiveSheet()->getCell("A".$i)->getValue();
//      	$data[$z]['dwname'] = $objPHPExcel->getActiveSheet()->getCell("B".$i)->getValue();
//      	$data[$z]['sfz'] = $objPHPExcel->getActiveSheet()->getCell("C".$i)->getValue();
//      	$data[$z]['name'] = $objPHPExcel->getActiveSheet()->getCell("D".$i)->getValue();
//      	$data[$z]['zyue'] = $objPHPExcel->getActiveSheet()->getCell("E".$i)->getValue();
//      	$data[$z]['huoqi'] = $objPHPExcel->getActiveSheet()->getCell("F".$i)->getValue();
//      	$data[$z]['dingqi'] = $objPHPExcel->getActiveSheet()->getCell("G".$i)->getValue();
//      	$data[$z]['jghsfz'] = $objPHPExcel->getActiveSheet()->getCell("A".$i)->getValue().$objPHPExcel->getActiveSheet()->getCell("C".$i)->getValue();
//      	$data[$z]['date'] = date('Y-m-d');
//      	$z++;
//      	
//      	if($z==999){
//      		$prr=$p->addall($data);
//      		$z=0;
//      		unset($data);
//      	}
//      }
//      //var_dump($z);
//      $prr=$p->addall($data);
//      unset($data);

        $handle = fopen ( $file_name, 'r' );
        $z=0;
        $p=M('pers');
        while($data = fgetcsv($handle)){
        $arr[]=$data;
        }
        for($i=0;$i<count($arr);$i++){
        $brr[$z]=array(
        'jgh'=>$arr[$i][0],
        'dwname'=>$arr[$i][0],
        'sfz'=>$arr[$i][2],
        'name'=>iconv('gbk','utf-8',$arr[$i][3]),
        'zyue'=>$arr[$i][4],
        'huoqi'=>$arr[$i][5],
        'dingqi'=>$arr[$i][6],
        'jghsfz'=>$arr[$i][0].$arr[$i][2],
        'date'=>date('Y-m-d'),
        );
        $z++;
        if($z==999){
           $prr=$p->addall($brr);
        	$z=0;
        	unset($brr);
        	}
        }
        $prr=$p->addall($brr);
        unset($brr);


        //var_dump($data);
        //$prr=$p->addall($data);
        // 清理空数组
//      foreach($exl as $k=>$v){
//          if(empty($v)){
//              unset($exl[$k]);
//          }
//      };
        // 重新排序
        //sort($exl);
        
//      $count = count($exl);
//      // 检测表格导入成功后，是否有数据生成
//      if($count<1){
//          $this->error('未检测到有效数据');    
//      }
        //var_dump($data);
        
        // 删除Excel文件
        unlink($file_name);
        //$this->display('info');
        if($prr>0){
        	//$this->success('EXCEL数据导入成功');
        }
    }
    
    public function persup(){
        $files = $_FILES['exl'];
        var_dump($files);
        // exl格式，否则重新上传
        if($files['type'] !='application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'){
            $this->error('不是Excel文件，请重新上传');
        }
        // 上传
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     209715200 ;// 设置附件上传大小
        $upload->exts      =     array('xls','xlsx');// 设置附件上传类型
        $upload->rootPath  =     './Public/Uploads/'; // 设置附件上传根目录
        $upload->savePath  =     'EXCEL/'; //设置附件上传（子）目录
        //$upload->subName   =     array('date', 'Ym');
        $upload->subName   =     '';
        // 上传文件  
        $info   =   $upload->upload();
        
        $file_name =  $upload->rootPath.$info['exl']['savepath'].$info['exl']['savename'];
        $exl = $this->import_exl($file_name);
        import("Org.Util.PHPExcel");   // 这里不能漏掉
        import("Org.Util.PHPExcel.IOFactory");
        $objReader = \PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load($file_name,$encode='utf-8');
        //$objReader = \PHPExcel_IOFactory::createReader('Excel5');
        //$objPHPExcel = $objReader->load($file_name,$encode='utf-8');
        //$extension = strtolower( pathinfo($files, PATHINFO_EXTENSION) );
        //var_dump($extension);
        //if ($extension =='xlsx') {
        //$objReader = new PHPExcel_Reader_Excel2007();
        //$objExcel = $objReader ->load($file);
        //} else if ($extension =='xls') {
        //$objReader = new PHPExcel_Reader_Excel5();
        //$objExcel = $objReader ->load($file);
        //}
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow(); // 取得总行数
        $highestColumn = $sheet->getHighestColumn(); // 取得总列数
        
        // 去掉第exl表格中第一行
        //unset($exl[0]);
        $p=M('persold');
    	$prr=$p->field('jghsfz')->select();
    	foreach($prr as &$value){
    		$prrr[]=$value['jghsfz'];
    	}
    	//var_dump($prr);
    	$z=0;
        for($i=2;$i<=$highestRow;$i++)
        {
        	$data[$z]['jgh'] = $objPHPExcel->getActiveSheet()->getCell("A".$i)->getValue();
        	$data[$z]['dwname'] = $objPHPExcel->getActiveSheet()->getCell("B".$i)->getValue();
        	$data[$z]['sfz'] = $objPHPExcel->getActiveSheet()->getCell("C".$i)->getValue();
        	$data[$z]['name'] = $objPHPExcel->getActiveSheet()->getCell("D".$i)->getValue();
        	$data[$z]['zyue'] = $objPHPExcel->getActiveSheet()->getCell("E".$i)->getValue();
        	$data[$z]['huoqi'] = $objPHPExcel->getActiveSheet()->getCell("F".$i)->getValue();
        	$data[$z]['dingqi'] = $objPHPExcel->getActiveSheet()->getCell("G".$i)->getValue();
        	$data[$z]['jghsfz'] = $objPHPExcel->getActiveSheet()->getCell("H".$i)->getValue();
        	$data[$z]['date'] = date('Y-m-d');
        	$z++;
        }
        //$p=M('pers');
        for($i=0;$i<count($data);$i++)
        	{
        		if(in_array($data[$i]['jghsfz'],$prrr)){
        			
        		}else{
        			$datas[]=array(
        			'jgh'=>$data[$i]['jgh'],
        			'dwname'=>$data[$i]['dwname'],
        			'sfz'=>$data[$i]['sfz'],
        			'name'=>$data[$i]['name'],
        			'zyue'=>$data[$i]['zyue'],
        			'huoqi'=>$data[$i]['huoqi'],
        			'dingqi'=>$data[$i]['dingqi'],
        			'jghsfz'=>$data[$i]['jghsfz'],
        			'date'=>date('Y-m-d'),
        			);
        		}
        		
        		
        	}
//      foreach($data as &$value){
//      	$name=$value['name'];
//      	$pr=$p->where("name='$name'")->count();
//      	if($pr==0){
//      		$datas[]['name']=$value['name'];
//      		$datas[]['dizhi']=$value['dizhi'];
//      		$datas[]['fushu']=$value['fushu'];
//      		$datas[]['chuxu']=$value['chuxu'];
//      		$datas[]['date']=$value['date'];
//      	}
//      }
        var_dump($datas);
        $pi=M('persup');
        $pirr=$pi->addall($datas);
        //$prr=$p->addall($data);
        //var_dump($data);
        //$prr=$p->addall($data);
        // 清理空数组
//      foreach($exl as $k=>$v){
//          if(empty($v)){
//              unset($exl[$k]);
//          }    
//      };
        // 重新排序
        //sort($exl);
        
//      $count = count($exl);
//      // 检测表格导入成功后，是否有数据生成
//      if($count<1){
//          $this->error('未检测到有效数据');    
//      }
        //var_dump($data);
        
        // 删除Excel文件
        unlink($file_name);
        //$this->display('info');
        if($pxcrr>0){
        	$this->success('EXCEL数据导入成功');
        }
    }
    /* 处理上传exl数据
     * $file_name  文件路径
     */
    public function persdown(){
        $files = $_FILES['exl'];
        var_dump($files);
        // exl格式，否则重新上传
        if($files['type'] !='application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'){
            $this->error('不是Excel文件，请重新上传');
        }
        // 上传
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     209715200 ;// 设置附件上传大小
        $upload->exts      =     array('xls','xlsx');// 设置附件上传类型
        $upload->rootPath  =     './Public/Uploads/'; // 设置附件上传根目录
        $upload->savePath  =     'EXCEL/'; //设置附件上传（子）目录
        //$upload->subName   =     array('date', 'Ym');
        $upload->subName   =     '';
        // 上传文件  
        $info   =   $upload->upload();
        
        $file_name =  $upload->rootPath.$info['exl']['savepath'].$info['exl']['savename'];
        $exl = $this->import_exl($file_name);
        import("Org.Util.PHPExcel");   // 这里不能漏掉
        import("Org.Util.PHPExcel.IOFactory");
        $objReader = \PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load($file_name,$encode='utf-8');
        //$objReader = \PHPExcel_IOFactory::createReader('Excel5');
        //$objPHPExcel = $objReader->load($file_name,$encode='utf-8');
        //$extension = strtolower( pathinfo($files, PATHINFO_EXTENSION) );
        //var_dump($extension);
        //if ($extension =='xlsx') {
        //$objReader = new PHPExcel_Reader_Excel2007();
        //$objExcel = $objReader ->load($file);
        //} else if ($extension =='xls') {
        //$objReader = new PHPExcel_Reader_Excel5();
        //$objExcel = $objReader ->load($file);
        //}
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow(); // 取得总行数
        $highestColumn = $sheet->getHighestColumn(); // 取得总列数
        
        // 去掉第exl表格中第一行
        //unset($exl[0]);
        $p=M('pers');
    	$prr=$p->field('jghsfz')->select();
    	foreach($prr as &$value){
    		$prrr[]=$value['jghsfz'];
    	}
    	//var_dump($prr);
    	$z=0;
        for($i=2;$i<=$highestRow;$i++)
        {
        	$data[$z]['jgh'] = $objPHPExcel->getActiveSheet()->getCell("A".$i)->getValue();
        	$data[$z]['dwname'] = $objPHPExcel->getActiveSheet()->getCell("B".$i)->getValue();
        	$data[$z]['sfz'] = $objPHPExcel->getActiveSheet()->getCell("C".$i)->getValue();
        	$data[$z]['name'] = $objPHPExcel->getActiveSheet()->getCell("D".$i)->getValue();
        	$data[$z]['zyue'] = $objPHPExcel->getActiveSheet()->getCell("E".$i)->getValue();
        	$data[$z]['huoqi'] = $objPHPExcel->getActiveSheet()->getCell("F".$i)->getValue();
        	$data[$z]['dingqi'] = $objPHPExcel->getActiveSheet()->getCell("G".$i)->getValue();
        	$data[$z]['jghsfz'] = $objPHPExcel->getActiveSheet()->getCell("H".$i)->getValue();
        	$data[$z]['date'] = date('Y-m-d');
        	$z++;
        }
        //$p=M('pers');
        for($i=0;$i<count($data);$i++)
        	{
        		if(in_array($data[$i]['jghsfz'],$prrr)){
        			
        		}else{
        			$datas[]=array(
        			'jgh'=>$data[$i]['jgh'],
        			'dwname'=>$data[$i]['dwname'],
        			'sfz'=>$data[$i]['sfz'],
        			'name'=>$data[$i]['name'],
        			'zyue'=>$data[$i]['zyue'],
        			'huoqi'=>$data[$i]['huoqi'],
        			'dingqi'=>$data[$i]['dingqi'],
        			'jghsfz'=>$data[$i]['jghsfz'],
        			'date'=>date('Y-m-d'),
        			);
        		}
        		
        		
        	}
//      foreach($data as &$value){
//      	$name=$value['name'];
//      	$pr=$p->where("name='$name'")->count();
//      	if($pr==0){
//      		$datas[]['name']=$value['name'];
//      		$datas[]['dizhi']=$value['dizhi'];
//      		$datas[]['fushu']=$value['fushu'];
//      		$datas[]['chuxu']=$value['chuxu'];
//      		$datas[]['date']=$value['date'];
//      	}
//      }
        
        //var_dump($datas);
        $pi=M('persdown');
        $pirr=$pi->addall($datas);
        //$prr=$p->addall($data);
        //var_dump($data);
        //$prr=$p->addall($data);
        // 清理空数组
//      foreach($exl as $k=>$v){
//          if(empty($v)){
//              unset($exl[$k]);
//          }    
//      };
        // 重新排序
        //sort($exl);
        
//      $count = count($exl);
//      // 检测表格导入成功后，是否有数据生成
//      if($count<1){
//          $this->error('未检测到有效数据');    
//      }
        //var_dump($data);
        
        // 删除Excel文件
        unlink($file_name);
        //$this->display('info');
        if($pxcrr>0){
        	$this->success('EXCEL数据导入成功');
        }
    }
    public function up(){
//  	$po=M('persold');
//  	$porr=$po->field('jghsfz')->select();
//  	foreach($porr as &$value){
//  		$porrr[]=$value['jghsfz'];
//  	}
//  	$p=M('pers');
//  	$prr=$p->select();
    	$pu=M('persup');
    	//两张表不同数据取数
    	$User = D('');
        $pr=$User->query('select * from jr_pers where (select count(1) as num from jr_persold where jr_persold.jghsfz = jr_pers.jghsfz) = 0');
        //$pr=$User->query('select * from jr_persold where (select count(1) as num from jr_pers where jr_pers.jghsfz = jr_persold.jghsfz) = 0');
    	//var_dump($pr);
    	$z=0;
    	for($i=0;$i<count($pr);$i++){
    		$data[$z]=array(
    		'jgh'=>$pr[$i]['jgh'],
    		'dwname'=>$pr[$i]['dwname'],
    		'sfz'=>$pr[$i]['sfz'],
    		'name'=>$pr[$i]['name'],
    		'zyue'=>$pr[$i]['zyue'],
    		'huoqi'=>$pr[$i]['huoqi'],
    		'dingqi'=>$pr[$i]['dingqi'],
    		'jghsfz'=>$pr[$i]['jghsfz'],
    		'date'=>date('Y-m-d'),
    		);
    		$z++;
    		if($z==999){
            $prr=$pu->addall($data);
        	$z=0;
        	unset($data);
        	}
        }
        $prr=$pu->addall($data);
        unset($data);
    	}
    	
    	//var_dump($prr);
//  	for($i=0;$i<count($prr);$i++)
//  	{
//  		if(in_array($prr[$i]['jghsfz'],$porrr)){
//      			
//      		}else{
//      			$datas[]=array(
//      			'jgh'=>$prr[$i]['jgh'],
//      			'dwname'=>$prr[$i]['dwname'],
//      			'sfz'=>$prr[$i]['sfz'],
//      			'name'=>$prr[$i]['name'],
//      			'zyue'=>$prr[$i]['zyue'],
//      			'huoqi'=>$prr[$i]['huoqi'],
//      			'dingqi'=>$prr[$i]['dingqi'],
//      			'jghsfz'=>$prr[$i]['jghsfz'],
//      			'date'=>date('Y-m-d'),
//      			);
//  	        }
//  	}
//  	var_dump($datas);
    	
        //$purr=$pu->addall($datas);
    
    public function down(){
//  	$po=M('pers');
//  	$porr=$po->field('jghsfz')->select();
//  	foreach($porr as &$value){
//  		$porrr[]=$value['jghsfz'];
//  	}
//  	//var_dump($porrr);
//  	$p=M('persold');
//  	$prr=$p->select();
        $pd=M('persdown');
        //两张表不同数据取数
    	$User = D('');
    	$pr=$User->query('select * from jr_persold where (select count(1) as num from jr_pers where jr_pers.jghsfz = jr_persold.jghsfz) = 0');
    	//$pr=$User->query('select * from jr_pers where (select count(1) as num from jr_persold where jr_persold.jghsfz = jr_pers.jghsfz) = 0');
    	//var_dump($pr);
    	
    	$z=0;
    	for($i=0;$i<count($pr);$i++){
    		$data[$z]=array(
    		'jgh'=>$pr[$i]['jgh'],
    		'dwname'=>$pr[$i]['dwname'],
    		'sfz'=>$pr[$i]['sfz'],
    		'name'=>$pr[$i]['name'],
    		'zyue'=>$pr[$i]['zyue'],
    		'huoqi'=>$pr[$i]['huoqi'],
    		'dingqi'=>$pr[$i]['dingqi'],
    		'jghsfz'=>$pr[$i]['jghsfz'],
    		'date'=>date('Y-m-d'),
    		);
    		$z++;
    		if($z==999){
            $prr=$pd->addall($data);
        	$z=0;
        	unset($data);
        	}
        }
        $prr=$pd->addall($data);
        unset($data);
    	}
    	//var_dump(count($prr));
//  	for($i=0;$i<count($prr);$i++)
//  	{
//  		if(in_array($prr[$i]['jghsfz'],$porrr)){
//      			
//      		}else{
//      			$datas[]=array(
//      			'jgh'=>$prr[$i]['jgh'],
//      			'dwname'=>$prr[$i]['dwname'],
//      			'sfz'=>$prr[$i]['sfz'],
//      			'name'=>$prr[$i]['name'],
//      			'zyue'=>$prr[$i]['zyue'],
//      			'huoqi'=>$prr[$i]['huoqi'],
//      			'dingqi'=>$prr[$i]['dingqi'],
//      			'jghsfz'=>$prr[$i]['jghsfz'],
//      			'date'=>date('Y-m-d'),
//      			);
//  	        }
//  	}
    	//var_dump($datas);
    	
        //$pdrr=$pd->addall($datas);
    
    public function sum(){
    	$p=M('pers');
    	$prr=$p->field('name')->select();
    	foreach($prr as &$value){
    		$prrr[]=$value['name'];
    	}
    	var_dump($prrr);
    }
    public function del(){
    	$p=M('persold');
    	$count=$p->query("truncate table jr_persold");
    	//var_dump($count);
    }
    public function import_exl($file_name){
        //$file_name= './Upload/excel/123456.xls';
//      import("Org.Util.PHPExcel");   // 这里不能漏掉
//      import("Org.Util.PHPExcel.IOFactory");
////      $extension = strtolower( pathinfo($files, PATHINFO_EXTENSION) );
////      var_dump($extension);
////      if ($extension =='xlsx') {
//      $objReader = \PHPExcel_IOFactory::createReader('Excel2007');
//      $objPHPExcel = $objReader->load($file_name,$encode='utf-8');
//      //} else if ($extension =='xls') {
//      //$objReader = new PHPExcel_Reader_Excel5();
//      //$objExcel = $objReader ->load($file);
//      //}
//      //$objReader = \PHPExcel_IOFactory::createReader('Excel5');
//      //$objPHPExcel = $objReader->load($file_name,$encode='utf-8');
//      $sheet = $objPHPExcel->getSheet(0);
////      $highestRow = $sheet->getHighestRow(); // 取得总行数
////      $highestColumn = $sheet->getHighestColumn(); // 取得总列数
////      
////      for($i=1;$i<$highestRow+1;$i++){
////          $data[$i][] = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getValue();
////          $data[$i][] = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getValue();
////          $data[$i][] = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getValue();
////      }
////      return $data;
    }
    public function dataadd(){
    	$pu=M('persup');
    	$purr=$pu->select();
    	$zyue=0;
    	$dingqi=0;
    	foreach($purr as &$valueup){
    		$zyue=$zyue+$valueup['zyue'];
    		$dingqi=$dingqi+$valueup['dingqi'];
    	}
    	$this->assign('dingqi',$dingqi);
    	$this->assign('zyue',$zyue);
    	$this->assign('purr',$purr);
    	$this->display();
    	

    }
    public function datalessen(){
    	$pd=M('persdown');
    	$pdr=$pd->field('jgh,dwname,count(zyue) as name,sum(zyue) as zyue,sum(dingqi) as dingqi')->group('jgh,dwname')->select();
    	$pdrr=$pd->field('dwname,jgh,name,zyue,dingqi')->select();
    	$i=1;
    	//$i=count($pdrr);
    	foreach($pdr as &$valued){
    		
    		foreach($pdrr as &$valuedr){
    			if($valuedr['jgh']==$valued['jgh']){
//  				$valuedr['jgh']=$valued['jgh'];
//  				$valuedr['dwname']=$valued['dwname'];
//  				$valuedr['name']=$valued['name'];
//  				$valuedr['zyue']=$valued['zyue'];
//  				$valuedr['dingqi']=$valued['dingqi'];
    				$pdrr[]=array(
    				'dwname'=>$valued['dwname'],
    				'jgh'=>$valued['jgh'],
    				'name'=>$valued['name'],
    				'zyue'=>$valued['zyue'],
    				'dingqi'=>$valued['dingqi'],
    				);
    				break;	
    			}
    			
    		}
    		
    	}
    	rsort($pdrr);
//  	$zyued=0;
//  	$dingqid=0;
//  	foreach($pdrr as &$valuedown){
//  		$zyued=$zyued+$valuedown['zyue'];
//  		$dingqid=$dingqid+$valuedown['dingqi'];
//  	}
//  	
//  	$this->assign('dingqid',$dingqid);
//  	$this->assign('zyued',$zyued);
    	$this->assign('pdrr',$pdrr);
    	var_dump($pdrr);
    	//var_dump($pdr);
    	//$this->display();
    }
    public function datacollects(){
    	$l=M('liangshou');
    	$lrr=$l->select();
    	$this->assign('collect',$lrr);
    	$this->display();
    }
    public function datacollect(){
    	
    	$p=M('pers');
    	$prr=$p->field('jgh,dwname,sum(zyue) as sumzyue,sum(dingqi) as sumdingqi')->group('jgh,dwname')->select();
    	
    	$po=M('persold');
    	$porr=$po->field('jgh,dwname,sum(zyue) as sumzyue,sum(dingqi) as sumdingqi')->group('jgh,dwname')->select();
    	//var_dump($prr);
    	//var_dump($porr);
    	
    	foreach($prr as &$value){
    		foreach($porr as $valueo){
    			if($value['jgh']==$valueo['jgh']){
    				$collect[]=array(
    				'jgh'=>$valueo['jgh'],
    				'dwname'=>$valueo['dwname'],
    				'sumzyue'=>round(floatval($value['sumzyue']-$valueo['sumzyue']),2),
    				'sumdingqi'=>$value['sumdingqi']-$valueo['sumdingqi'],
    				'upzyue'=>0,
    				'updingqi'=>0,
    				'downzyue'=>0,
    				'downdingqi'=>0,
    				);
    			}
    		}
    	}
    	//前面是所有机构增减汇总;
    	$pu=M('persup');
    	$purr=$pu->field('jgh,dwname,sum(zyue) as sumzyue,sum(dingqi) as sumdingqi')->group('jgh,dwname')->select();
    	$purrr=$pu->field('jgh,dwname,count(jghsfz) as countjgh')->group('jgh,dwname')->select();
    	//var_dump($purr);
    	$zyue=0;
    	$dingqi=0;
//  	foreach($purr as &$valueup){
//  		$zyue=$zyue+$valueup['zyue'];
//  		$dingqi=$dingqi+$valueup['dingqi'];
//  	}
//  	$this->assign('dingqi',$dingqi);
//  	$this->assign('zyue',$zyue);
//  	$this->assign('purr',$purr);
    	
    	$pd=M('persdown');
    	$pdrr=$pd->field('jgh,dwname,sum(zyue) as sumzyue,sum(dingqi) as sumdingqi')->group('jgh,dwname')->select();
    	$pdrrr=$pd->field('jgh,dwname,count(jghsfz) as countjgh')->group('jgh,dwname')->select();
    	//var_dump($pdrr);
    	$zyued=0;
    	$dingqid=0;
//  	foreach($pdrr as &$valuedown){
//  		$zyued=$zyued+$valuedown['zyue'];
//  		$dingqid=$dingqid+$valuedown['dingqi'];
//  	}
//  	$this->assign('dingqid',$dingqid);
//  	$this->assign('zyued',$zyued);
//  	$this->assign('pdrr',$pdrr);
    	
    	
    	//var_dump($purr);
    	//var_dump($pdrr);
    	
    	foreach($collect as &$valuecc){
    		foreach($purrr as &$valueuu){
    			if($valuecc['jgh']==$valueuu['jgh']){
    				$valuecc['upcountjgh']=$valueuu['countjgh'];
    			}
    		}
    	}
    	//获取增量总人数
    	foreach($collect as &$valuecc){
    		foreach($pdrrr as &$valuedd){
    			if($valuecc['jgh']==$valuedd['jgh']){
    				$valuecc['downcountjgh']=$valuedd['countjgh'];
    			}
    		}
    	}
    	//获取减量总人数
    	foreach($collect as &$valuec){
    		foreach($purr as &$valueu){
    			if($valuec['jgh']==$valueu['jgh']){
    				$valuec['upzyue']=$valueu['sumzyue'];
    				$valuec['updingqi']=$valueu['sumdingqi'];
    			}
    		}
    	}
    	//获取增量数据;
    	foreach($collect as &$valuec){
    		foreach($pdrr as &$valued){
    			if($valuec['jgh']==$valued['jgh']){
    				$valuec['downzyue']=$valued['sumzyue'];
    				$valuec['downdingqi']=$valued['sumdingqi'];
    			}
    		}
    	}
    	//获取减量数据;
    	
    	foreach($collect as &$valuec){
    		$valuec['clyue']=$valuec['sumzyue']+$valuec['downzyue']-$valuec['upzyue'];
    		$valuec['cldingqi']=$valuec['sumdingqi']+$valuec['downdingqi']-$valuec['updingqi'];
    	}
    	
    	$d=M('danwei');
    	$drr=$d->select();
    	foreach($drr as &$value){
    		foreach($collect as &$valuec){
    			if($value['jgh']==$valuec['jgh']){
    				$valuec['dwname']=$value['dwname'];
    			}
    		}
    	}
    	foreach($collect as &$valuec){
    		$valuec['countjgh']=$valuec['upcountjgh']-$valuec['downcountjgh'];
    		$valuec['sumzyue']=round($valuec['sumzyue']/10000,0);
    	    $sumzyue=$sumzyue+$valuec['sumzyue'];
    	    $valuec['sumdingqi']=round($valuec['sumdingqi']/10000,0);
    	    $sumdingqi=$sumdingqi+$valuec['sumdingqi'];
    	    $valuec['upzyue']=round($valuec['upzyue']/10000,0);
    	    $upzyue=$upzyue+$valuec['upzyue'];
    	    $valuec['updingqi']=round($valuec['updingqi']/10000,0);
    	    $updingqi=$updingqi+$valuec['updingqi'];
    	    $valuec['downzyue']=round($valuec['downzyue']/10000,0);
    	    $downzyue=$downzyue+$valuec['downzyue'];
    	    $valuec['downdingqi']=round($valuec['downdingqi']/10000,0);
    	    $downdingqi=$downdingqi+$valuec['downdingqi'];
    	    $valuec['clyue']=round($valuec['clyue']/10000,0);
    	    $clyue=$clyue+$valuec['clyue'];
    	    $valuec['cldingqi']=round($valuec['cldingqi']/10000,0);
    	    $cldingqi=$cldingqi+$valuec['cldingqi'];
    	    $upcountjgh=$upcountjgh+$valuec['upcountjgh'];
    	    $downcountjgh=$downcountjgh+$valuec['downcountjgh'];
    	    $countjgh=$countjgh+$valuec['countjgh'];
    	}
    	$collects=array(
    	    'sumzyue'=>$sumzyue,
    	    'sumdingqi'=>$sumdingqi,
    	    'upzyue'=>$upzyue,
    	    'updingqi'=>$updingqi,
    	    'downzyue'=>$downzyue,
    	    'downdingqi'=>$downdingqi,
    	    'clyue'=>$clyue,
    	    'cldingqi'=>$cldingqi,
    	    'upcountjgh'=>$upcountjgh,
    	    'downcountjgh'=>$downcountjgh,
    	    'countjgh'=>$countjgh,
    	);
    	//var_dump($collects);
    	//var_dump($collect);
    	$this->assign('collect',$collect);
    	$this->assign('collects',$collects);
    	
    	$this->display();
    }
    public function perscsadds(){
        $files = $_FILES['exl'];
        var_dump($files);
        // exl格式，否则重新上传
        if($files['type'] !='application/vnd.ms-excel'){
            $this->error('不是Excel文件，请重新上传');
        }
        // 上传
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     209715200 ;// 设置附件上传大小
        $upload->exts      =     array('xls','xlsx','csv');// 设置附件上传类型
        $upload->rootPath  =     './Public/Uploads/'; // 设置附件上传根目录
        $upload->savePath  =     'EXCEL/'; //设置附件上传（子）目录
        //$upload->subName   =     array('date', 'Ym');
        $upload->subName   =     '';
        // 上传文件  
        $info   =   $upload->upload();
        
        $file_name =  $upload->rootPath.$info['exl']['savepath'].$info['exl']['savename'];

        $handle = fopen ( $file_name, 'r' );
        $z=0;
        $p=M('perscs');
        while($data = fgetcsv($handle)){
        $arr[]=$data;
        }
        for($i=0;$i<count($arr);$i++){
        $brr[$z]=array(
        'jgh'=>$arr[$i][0],
        'name'=>iconv('gbk','utf-8',$arr[$i][1]),
        'jghsfz'=>$arr[$i][2],
        'cs'=>iconv('gbk','utf-8',$arr[$i][3]),
        );
        $z++;
        if($z==999){
           $prr=$p->addall($brr);
        	$z=0;
        	unset($brr);
        	}
        }
        $prr=$p->addall($brr);
        unset($brr);
        
        unlink($file_name);
        //$this->display('info');
        if($prr>0){
        	$this->success('EXCEL数据导入成功');
        }
    }
    public function perscs(){
    	$Userup = D('');
    	$prup=$Userup->query('select * from jr_persup inner join jr_perscs on jr_persup.jghsfz=jr_perscs.jghsfz');
        
        //$Userup = D('');
    	//$prup=$Userup->query('select * from jr_perscs where jghsfz in (select jghsfz from jr_persup group by jghsfz having count(1)>1)');
//      $Userdown = D('');
//  	$prdown=$Userdown->query('select * from jr_perscs inner join jr_persdown on jr_perscs.jghsfz=jr_persdown.jghsfz');
        //var_dump($prup);
        $Userdown = D('');
    	$prdown=$Userdown->query('select * from jr_persdown inner join jr_perscs on jr_persdown.jghsfz=jr_perscs.jghsfz');
        
        //var_dump($prdown);
        foreach($prdown as &$valuedown){
        	$valuedown['stats']='ls';
        }
        foreach($prup as &$valueup){
        	$prdown[]=array(
        	    'id'=>$valueup['id'],
        	    'jgh'=>$valueup['jgh'],
        	    'dwname'=>$valueup['dwname'],
        	    'sfz'=>$valueup['sfz'],
        	    'name'=>$valueup['name'],
        	    'zyue'=>$valueup['zyue'],
        	    'huoqi'=>$valueup['huoqi'],
        	    'dingqi'=>$valueup['dingqi'],
        	    'jghsfz'=>$valueup['jghsfz'],
        	    'date'=>$valueup['date'],
        	    'cs'=>$valueup['cs'],
        	    'stats'=>'xz',
        	);
        }
        $perscsinfo=M('perscsinfo');
        $z=0;
    	for($i=0;$i<count($prdown);$i++){
    		$data[$z]=array(
    		'jgh'=>$prdown[$i]['jgh'],
        	'dwname'=>$prdown[$i]['dwname'],
        	'sfz'=>$prdown[$i]['sfz'],
        	'name'=>$prdown[$i]['name'],
        	'zyue'=>$prdown[$i]['zyue'],
        	'huoqi'=>$prdown[$i]['huoqi'],
        	'dingqi'=>$prdown[$i]['dingqi'],
        	'jghsfz'=>$prdown[$i]['jghsfz'],
        	'date'=>$prdown[$i]['date'],
        	'cs'=>$prdown[$i]['cs'],
        	'stats'=>$prdown[$i]['stats'],
    		);
    		$z++;
    		if($z==999){
            $perscsinforr=$perscsinfo->addall($data);
        	$z=0;
        	unset($data);
        	}
        }
        $perscsinforr=$perscsinfo->addall($data);
        unset($data);
    	
        if($perscsinforr>0){
        	$this->success('数据获取成功');
        }
    }
    public function perscscs(){
    	$pcs=M('perscsinfo');
    	$pcsrr=$pcs->field('jgh,stats,cs,sum(zyue) as sumzyue,sum(dingqi) as sumdingqi,sum(huoqi) as sumhuoqi,count(stats) as countstats')->group('jgh,stats,cs')->select();
        
        $this->assign('collect',$pcsrr);
        var_dump($pcsrr);
        //$this->display();
    }
    public function perscsinfo(){
    	$User = D('');
    	$pr=$User->query('select jr_perscs.jgh,cs,sum(zyue) as sumzyue,sum(dingqi) as sumdingqi,sum(huoqi) as sumhuoqi,count(cs) as countcs from jr_pers inner join jr_perscs on jr_pers.jghsfz=jr_perscs.jghsfz group by jr_perscs.jgh,cs');
        $Userold = D('');
        $prold=$Userold->query('select jr_perscs.jgh,cs,sum(zyue) as sumzyue,sum(dingqi) as sumdingqi,sum(huoqi) as sumhuoqi,count(cs) as countcs from jr_persold inner join jr_perscs on jr_persold.jghsfz=jr_perscs.jghsfz group by jr_perscs.jgh,cs');
        //select * from jr_persold where (select count(1) as num from jr_pers where jr_pers.jghsfz = jr_persold.jghsfz) = 0
        foreach($pr as &$value){
    		foreach($prold as $valueo){
    			if($value['jgh']==$valueo['jgh'] and $value['cs']==$valueo['cs']){
    				$collect[]=array(
    				'jgh'=>$valueo['jgh'],
    				'dwname'=>$valueo['dwname'],
    				'sumzyue'=>round(floatval($value['sumzyue']-$valueo['sumzyue']),2),
    				'sumdingqi'=>$value['sumdingqi']-$valueo['sumdingqi'],
    				'upzyue'=>0,
    				'updingqi'=>0,
    				'downzyue'=>0,
    				'downdingqi'=>0,
    				'upcountjgh'=>0,
    				'downcountjgh'=>0,
    				'cs'=>$valueo['cs'],
    				);
    			}
    		}
    	}
    	$Userup = D('');
    	$prup=$Userup->query('select jr_perscs.jgh,cs,sum(zyue) as sumzyue,sum(dingqi) as sumdingqi,sum(huoqi) as sumhuoqi,count(cs) as countcs from jr_persup inner join jr_perscs on jr_persup.jghsfz=jr_perscs.jghsfz group by jr_perscs.jgh,cs');
        
        $Userdown = D('');
    	$prdown=$Userdown->query('select jr_perscs.jgh,cs,sum(zyue) as sumzyue,sum(dingqi) as sumdingqi,sum(huoqi) as sumhuoqi,count(cs) as countcs from jr_persdown inner join jr_perscs on jr_persdown.jghsfz=jr_perscs.jghsfz group by jr_perscs.jgh,cs');
        
    	foreach($collect as &$valuecc){
    		foreach($prup as &$valueuu){
    			if($valuecc['cs']==$valueuu['cs']){
    				$valuecc['upcountjgh']=$valueuu['countcs'];
    				$valuecc['upzyue']=$valueuu['sumzyue'];
    				$valuecc['updingqi']=$valueuu['sumdingqi'];
    				$valuecc['uphuoqi']=$valueuu['sumhuoqi'];
    			}
    		}
    	}
    	//获取增量总人数
    	foreach($collect as &$valuecc){
    		foreach($prdown as &$valuedd){
    			if($valuecc['cs']==$valuedd['cs']){
    				$valuecc['downcountjgh']=$valuedd['countcs'];
    				$valuecc['downzyue']=$valuedd['sumzyue'];
    				$valuecc['downdingqi']=$valuedd['sumdingqi'];
    				$valuecc['downhuoqi']=$valuedd['sumhuoqi'];
    			}
    		}
    	}
    	//获取减量总人数
    	foreach($collect as &$valuec){
    		$valuec['clyue']=$valuec['sumzyue']+$valuec['downzyue']-$valuec['upzyue'];
    		$valuec['cldingqi']=$valuec['sumdingqi']+$valuec['downdingqi']-$valuec['updingqi'];
    		$valuec['clhuoqi']=$valuec['sumhuoqi']+$valuec['downhuoqi']-$valuec['uphuoqi'];
    	}
    	
    	$d=M('danwei');
    	$drr=$d->select();
//  	foreach($drr as &$value){
//  		foreach($collect as &$valuec){
//  			if($value['jgh']==$valuec['jgh']){
//  				$valuec['dwname']=$value['dwname'];
//  			}
//  		}
//  	}
    	
    	foreach($drr as &$valued){
    	 foreach($collect as &$valuec){
    		if($valued['jgh']==$valuec['jgh']){
    		$valuec['dwname']=$valued['dwname'];
    		$valuec['countjgh']=$valuec['upcountjgh']-$valuec['downcountjgh'];
    		$valuec['sumzyue']=round($valuec['sumzyue']/10000,0);
    	    $sumzyue=$sumzyue+$valuec['sumzyue'];
    	    $valuec['sumdingqi']=round($valuec['sumdingqi']/10000,0);
    	    $sumdingqi=$sumdingqi+$valuec['sumdingqi'];
    	    $valuec['upzyue']=round($valuec['upzyue']/10000,0);
    	    $upzyue=$upzyue+$valuec['upzyue'];
    	    $valuec['updingqi']=round($valuec['updingqi']/10000,0);
    	    $updingqi=$updingqi+$valuec['updingqi'];
    	    $valuec['downzyue']=round($valuec['downzyue']/10000,0);
    	    $downzyue=$downzyue+$valuec['downzyue'];
    	    $valuec['downdingqi']=round($valuec['downdingqi']/10000,0);
    	    $downdingqi=$downdingqi+$valuec['downdingqi'];
    	    $valuec['clyue']=round($valuec['clyue']/10000,0);
    	    $clyue=$clyue+$valuec['clyue'];
    	    $valuec['cldingqi']=round($valuec['cldingqi']/10000,0);
    	    $cldingqi=$cldingqi+$valuec['cldingqi'];
    	    $upcountjgh=$upcountjgh+$valuec['upcountjgh'];
    	    $downcountjgh=$downcountjgh+$valuec['downcountjgh'];
    	    $countjgh=$countjgh+$valuec['countjgh'];
    	   }
    	}
    	$collect[]=array(
    	'dwname'=>$valued['dwname'],
    	'cs'=>'总计',
    	'sumzyue'=>$sumzyue,
    	'sumdingqi'=>$sumdingqi,
    	'upzyue'=>$upzyue,
    	'updingqi'=>$updingqi,
    	'downzyue'=>$downzyue,
    	'downdingqi'=>$downdingqi,
    	'clyue'=>$clyue,
    	'cldingqi'=>$cldingqi,
    	'upcountjgh'=>$upcountjgh,
    	'downcountjgh'=>$downcountjgh,
    	'countjgh'=>$upcountjgh-$downcountjgh,
    	);
    	$sumzyue=0;
    	$sumdingqi=0;
    	$upzyue=0;
    	$updingqi=0;
    	$downzyue=0;
    	$downdingqi=0;
    	$clyue=0;
    	$cldingqi=0;
    	$upcountjgh=0;
    	$downcountjgh=0;
    	}
    	
    	foreach($drr as &$valued){
    	  foreach($collect as &$valuec){
    	  	 if($valued['dwname']==$valuec['dwname']){
    	  	 	$collects[]=array(
    	'dwname'=>$valuec['dwname'],
    	'cs'=>$valuec['cs'],
    	'sumzyue'=>$valuec['sumzyue'],
    	'sumdingqi'=>$valuec['sumdingqi'],
    	'upzyue'=>$valuec['upzyue'],
    	'updingqi'=>$valuec['updingqi'],
    	'downzyue'=>$valuec['downzyue'],
    	'downdingqi'=>$valuec['downdingqi'],
    	'clyue'=>$valuec['clyue'],
    	'cldingqi'=>$valuec['cldingqi'],
    	'upcountjgh'=>$valuec['upcountjgh'],
    	'downcountjgh'=>$valuec['downcountjgh'],
    	'countjgh'=>$valuec['countjgh'],
    	);
    	}
    	}
    	}
    	$this->assign('collect',$collects);
    	$this->display();
    	//var_dump($collect);
    	//var_dump($pr);
    }
    public function csdl(){
    	$User = D('');
    	$pr=$User->query('select jr_perscs.jgh,cs,sum(zyue) as sumzyue,sum(dingqi) as sumdingqi,sum(huoqi) as sumhuoqi,count(cs) as countcs from jr_pers inner join jr_perscs on jr_pers.jghsfz=jr_perscs.jghsfz group by jr_perscs.jgh,cs');
        $Userold = D('');
        $prold=$Userold->query('select jr_perscs.jgh,cs,sum(zyue) as sumzyue,sum(dingqi) as sumdingqi,sum(huoqi) as sumhuoqi,count(cs) as countcs from jr_persold inner join jr_perscs on jr_persold.jghsfz=jr_perscs.jghsfz group by jr_perscs.jgh,cs');
        //select * from jr_persold where (select count(1) as num from jr_pers where jr_pers.jghsfz = jr_persold.jghsfz) = 0
        foreach($pr as &$value){
    		foreach($prold as $valueo){
    			if($value['jgh']==$valueo['jgh'] and $value['cs']==$valueo['cs']){
    				$collect[]=array(
    				'jgh'=>$valueo['jgh'],
    				'dwname'=>$valueo['dwname'],
    				'sumzyue'=>round(floatval($value['sumzyue']-$valueo['sumzyue']),2),
    				'sumdingqi'=>$value['sumdingqi']-$valueo['sumdingqi'],
    				'upzyue'=>0,
    				'updingqi'=>0,
    				'downzyue'=>0,
    				'downdingqi'=>0,
    				'upcountjgh'=>0,
    				'downcountjgh'=>0,
    				'cs'=>$valueo['cs'],
    				);
    			}
    		}
    	}
    	$Userup = D('');
    	$prup=$Userup->query('select jr_perscs.jgh,cs,sum(zyue) as sumzyue,sum(dingqi) as sumdingqi,sum(huoqi) as sumhuoqi,count(cs) as countcs from jr_persup inner join jr_perscs on jr_persup.jghsfz=jr_perscs.jghsfz group by jr_perscs.jgh,cs');
        
        $Userdown = D('');
    	$prdown=$Userdown->query('select jr_perscs.jgh,cs,sum(zyue) as sumzyue,sum(dingqi) as sumdingqi,sum(huoqi) as sumhuoqi,count(cs) as countcs from jr_persdown inner join jr_perscs on jr_persdown.jghsfz=jr_perscs.jghsfz group by jr_perscs.jgh,cs');
        
    	foreach($collect as &$valuecc){
    		foreach($prup as &$valueuu){
    			if($valuecc['cs']==$valueuu['cs']){
    				$valuecc['upcountjgh']=$valueuu['countcs'];
    				$valuecc['upzyue']=$valueuu['sumzyue'];
    				$valuecc['updingqi']=$valueuu['sumdingqi'];
    				$valuecc['uphuoqi']=$valueuu['sumhuoqi'];
    			}
    		}
    	}
    	//获取增量总人数
    	foreach($collect as &$valuecc){
    		foreach($prdown as &$valuedd){
    			if($valuecc['cs']==$valuedd['cs']){
    				$valuecc['downcountjgh']=$valuedd['countcs'];
    				$valuecc['downzyue']=$valuedd['sumzyue'];
    				$valuecc['downdingqi']=$valuedd['sumdingqi'];
    				$valuecc['downhuoqi']=$valuedd['sumhuoqi'];
    			}
    		}
    	}
    	//获取减量总人数
    	foreach($collect as &$valuec){
    		$valuec['clyue']=$valuec['sumzyue']+$valuec['downzyue']-$valuec['upzyue'];
    		$valuec['cldingqi']=$valuec['sumdingqi']+$valuec['downdingqi']-$valuec['updingqi'];
    		$valuec['clhuoqi']=$valuec['sumhuoqi']+$valuec['downhuoqi']-$valuec['uphuoqi'];
    	}
    	
    	$d=M('danwei');
    	$drr=$d->select();
//  	foreach($drr as &$value){
//  		foreach($collect as &$valuec){
//  			if($value['jgh']==$valuec['jgh']){
//  				$valuec['dwname']=$value['dwname'];
//  			}
//  		}
//  	}
    	
    	foreach($drr as &$valued){
    	 foreach($collect as &$valuec){
    		if($valued['jgh']==$valuec['jgh']){
    		$valuec['dwname']=$valued['dwname'];
    		$valuec['countjgh']=$valuec['upcountjgh']-$valuec['downcountjgh'];
    		$valuec['sumzyue']=round($valuec['sumzyue']/10000,0);
    	    $sumzyue=$sumzyue+$valuec['sumzyue'];
    	    $valuec['sumdingqi']=round($valuec['sumdingqi']/10000,0);
    	    $sumdingqi=$sumdingqi+$valuec['sumdingqi'];
    	    $valuec['upzyue']=round($valuec['upzyue']/10000,0);
    	    $upzyue=$upzyue+$valuec['upzyue'];
    	    $valuec['updingqi']=round($valuec['updingqi']/10000,0);
    	    $updingqi=$updingqi+$valuec['updingqi'];
    	    $valuec['downzyue']=round($valuec['downzyue']/10000,0);
    	    $downzyue=$downzyue+$valuec['downzyue'];
    	    $valuec['downdingqi']=round($valuec['downdingqi']/10000,0);
    	    $downdingqi=$downdingqi+$valuec['downdingqi'];
    	    $valuec['clyue']=round($valuec['clyue']/10000,0);
    	    $clyue=$clyue+$valuec['clyue'];
    	    $valuec['cldingqi']=round($valuec['cldingqi']/10000,0);
    	    $cldingqi=$cldingqi+$valuec['cldingqi'];
    	    $upcountjgh=$upcountjgh+$valuec['upcountjgh'];
    	    $downcountjgh=$downcountjgh+$valuec['downcountjgh'];
    	    $countjgh=$countjgh+$valuec['countjgh'];
    	   }
    	}
    	$collect[]=array(
    	'dwname'=>$valued['dwname'],
    	'cs'=>'总计',
    	'sumzyue'=>$sumzyue,
    	'sumdingqi'=>$sumdingqi,
    	'upzyue'=>$upzyue,
    	'updingqi'=>$updingqi,
    	'downzyue'=>$downzyue,
    	'downdingqi'=>$downdingqi,
    	'clyue'=>$clyue,
    	'cldingqi'=>$cldingqi,
    	'upcountjgh'=>$upcountjgh,
    	'downcountjgh'=>$downcountjgh,
    	'countjgh'=>$upcountjgh-$downcountjgh,
    	);
    	$sumzyue=0;
    	$sumdingqi=0;
    	$upzyue=0;
    	$updingqi=0;
    	$downzyue=0;
    	$downdingqi=0;
    	$clyue=0;
    	$cldingqi=0;
    	$upcountjgh=0;
    	$downcountjgh=0;
    	}
    	
    	foreach($drr as &$valued){
    	  foreach($collect as &$valuec){
    	  	 if($valued['dwname']==$valuec['dwname']){
    	  	 	$data[]=array(
    	'dwname'=>$valuec['dwname'],
    	'cs'=>$valuec['cs'],
    	'sumzyue'=>$valuec['sumzyue'],
    	'sumdingqi'=>$valuec['sumdingqi'],
    	'upzyue'=>$valuec['upzyue'],
    	'updingqi'=>$valuec['updingqi'],
    	'downzyue'=>$valuec['downzyue'],
    	'downdingqi'=>$valuec['downdingqi'],
    	'clyue'=>$valuec['clyue'],
    	'cldingqi'=>$valuec['cldingqi'],
    	'upcountjgh'=>$valuec['upcountjgh'],
    	'downcountjgh'=>$valuec['downcountjgh'],
    	'countjgh'=>$valuec['countjgh'],
    	);
    	}
    	}
    	}
    	
    	
    	
        //$rr = $m->field('name,zongji')->select();
        
        // 导出Exl
        import("Org.Util.PHPExcel");
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
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('G')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('H')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('I')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('J')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('K')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                
        $objActSheet->setCellValue('A1', '单位');
        $objActSheet->setCellValue('B1', '村社');
        $objActSheet->setCellValue('C1', '新增客户数');
        $objActSheet->setCellValue('D1', '新增余额');
        $objActSheet->setCellValue('E1', '新增定期');
        $objActSheet->setCellValue('F1', '流失客户数');
        $objActSheet->setCellValue('G1', '流失余额');
        $objActSheet->setCellValue('H1', '流失定期');
        $objActSheet->setCellValue('I1', '总存量');
        $objActSheet->setCellValue('J1', '总存量定期');
        $objActSheet->setCellValue('K1', '总客户数');
        $objActSheet->setCellValue('L1', '总余额');
        $objActSheet->setCellValue('M1', '总定期');
        
        // 设置个表格宽度
//      $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(12);
//      $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
//      $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(12);
//      $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
//      $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
//      $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12);
        
        // 垂直居中
//      $objPHPExcel->getActiveSheet()->getStyle('A')->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
//      $objPHPExcel->getActiveSheet()->getStyle('B')->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
//      $objPHPExcel->getActiveSheet()->getStyle('D')->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
//      $objPHPExcel->getActiveSheet()->getStyle('E')->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
//      $objPHPExcel->getActiveSheet()->getStyle('F')->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
        
        // 处理表数据
        foreach($data as $k=>$v){
            $k +=2;
            $objActSheet->setCellValue('A'.$k, $v['dwname']);
            $objActSheet->setCellValue('B'.$k, $v['cs']);
            $objActSheet->setCellValue('C'.$k, $v['upcountjgh']);    
            $objActSheet->setCellValue('D'.$k, $v['upzyue']);
            $objActSheet->setCellValue('E'.$k, $v['updingqi']);    
            $objActSheet->setCellValue('F'.$k, $v['downcountjgh']);
            $objActSheet->setCellValue('G'.$k, $v['downzyue']);    
            $objActSheet->setCellValue('H'.$k, $v['downdingqi']);
            $objActSheet->setCellValue('I'.$k, $v['clyue']);    
            $objActSheet->setCellValue('J'.$k, $v['cldingqi']);
            $objActSheet->setCellValue('K'.$k, $v['countjgh']);
            $objActSheet->setCellValue('L'.$k, $v['sumzyue']);
            $objActSheet->setCellValue('M'.$k, $v['sumdingqi']);
//          $img = M('record')->where('goods_id = '.$v['goods_id'])->field('goods_thumb')->find();
//          // 图片生成
//          $objDrawing[$k] = new \PHPExcel_Worksheet_Drawing();
//          $objDrawing[$k]->setPath('./Upload/'.$img['goods_thumb']);
//          // 设置宽度高度
//          $objDrawing[$k]->setHeight(80);//照片高度
//          $objDrawing[$k]->setWidth(80); //照片宽度
//          /*设置图片要插入的单元格*/
//          $objDrawing[$k]->setCoordinates('C'.$k);
//          // 图片偏移距离
//          $objDrawing[$k]->setOffsetX(12);
//          $objDrawing[$k]->setOffsetY(12);
//          $objDrawing[$k]->setWorksheet($objPHPExcel->getActiveSheet());
            
//          // 表格内容
//          $objActSheet->setCellValue('D'.$k, $v['barcode']);    
//          $objActSheet->setCellValue('E'.$k, $v['goods_type']);    
//          $objActSheet->setCellValue('F'.$k, $v['price']);
                
            // 表格高度
            $objActSheet->getRowDimension($k)->setRowHeight(18);
        }
        $fileName = '村社表';
        $date = date("Y-m-d",time());
        $fileName .= "_{$date}.xls";

        $fileName = iconv("utf-8", "gb2312", $fileName);
        //重命名表
        // $objPHPExcel->getActiveSheet()->setTitle('test');
        //设置活动单指数到第一个表,所以Excel打开这是第一个表
        $objPHPExcel->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=\"$fileName\"");
        header('Cache-Control: max-age=0');

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output'); //文件通过浏览器下载
        // END    
    }
    
    public function xkfronts(){
    	$files = $_FILES['exl'];
        var_dump($files);
        // exl格式，否则重新上传
        if($files['type'] !='application/vnd.ms-excel'){
            $this->error('不是Excel文件，请重新上传');
        }
        // 上传
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     209715200 ;// 设置附件上传大小
        $upload->exts      =     array('xls','xlsx','csv');// 设置附件上传类型
        $upload->rootPath  =     './Public/Uploads/'; // 设置附件上传根目录
        $upload->savePath  =     'EXCEL/'; //设置附件上传（子）目录
        //$upload->subName   =     array('date', 'Ym');
        $upload->subName   =     '';
        // 上传文件  
        $info   =   $upload->upload();
        
        $file_name =  $upload->rootPath.$info['exl']['savepath'].$info['exl']['savename'];
        $handle = fopen ( $file_name, 'r' );
        $z=0;
        $p=M('xkpers');
        while($data = fgetcsv($handle)){
        $arr[]=$data;
        }
        for($i=0;$i<count($arr);$i++){
        $brr[$z]=array(
        'jgh'=>$arr[$i][0],
        'dwname'=>$arr[$i][0],
        'sfz'=>$arr[$i][2],
        'name'=>iconv('gbk','utf-8',$arr[$i][3]),
        'zyue'=>$arr[$i][4],
        'huoqi'=>$arr[$i][5],
        'dingqi'=>$arr[$i][6],
        'jghname'=>$arr[$i][0].iconv('gbk','utf-8',$arr[$i][3]),
        'date'=>date('Y-m-d'),
        );
        $z++;
        if($z==999){
           $prr=$p->addall($brr);
        	$z=0;
        	unset($brr);
        	}
        }
        $prr=$p->addall($brr);
        unset($brr);
        // 删除Excel文件
        unlink($file_name);
        //$this->display('info');
//      if($prr>0){
//      	$this->success('EXCEL数据导入成功');
//      }
    }
    public function xkperskh(){
    	$files = $_FILES['exl'];
        var_dump($files);
        // exl格式，否则重新上传
        if($files['type'] !='application/vnd.ms-excel'){
            $this->error('不是Excel文件，请重新上传');
        }
        // 上传
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     209715200 ;// 设置附件上传大小
        $upload->exts      =     array('xls','xlsx','csv');// 设置附件上传类型
        $upload->rootPath  =     './Public/Uploads/'; // 设置附件上传根目录
        $upload->savePath  =     'EXCEL/'; //设置附件上传（子）目录
        //$upload->subName   =     array('date', 'Ym');
        $upload->subName   =     '';
        // 上传文件  
        $info   =   $upload->upload();
        
        $file_name =  $upload->rootPath.$info['exl']['savepath'].$info['exl']['savename'];
        $handle = fopen ( $file_name, 'r' );
        $z=0;
        $p=M('xkperskh');
        while($data = fgetcsv($handle)){
        $arr[]=$data;
        }
        for($i=0;$i<count($arr);$i++){
        $brr[$z]=array(
        'jgh'=>$arr[$i][0],
        'name'=>iconv('gbk','utf-8',$arr[$i][1]),
        'sfz'=>$arr[$i][2],
        'phone'=>$arr[$i][3],
        'xklink'=>iconv('gbk','utf-8',$arr[$i][4]),
        'jghname'=>$arr[$i][0].iconv('gbk','utf-8',$arr[$i][1]),
        'date'=>date('Y-m-d'),
        );
        $z++;
        if($z==999){
           $prr=$p->addall($brr);
        	$z=0;
        	unset($brr);
        	}
        }
        $prr=$p->addall($brr);
        unset($brr);
        // 删除Excel文件
        unlink($file_name);
        //$this->display('info');
//      if($prr>0){
//      	$this->success('EXCEL数据导入成功');
//      }
    }
    public function xkpersyue(){
    	$files = $_FILES['exl'];
        var_dump($files);
        // exl格式，否则重新上传
        if($files['type'] !='application/vnd.ms-excel'){
            $this->error('不是Excel文件，请重新上传');
        }
        // 上传
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     209715200 ;// 设置附件上传大小
        $upload->exts      =     array('xls','xlsx','csv');// 设置附件上传类型
        $upload->rootPath  =     './Public/Uploads/'; // 设置附件上传根目录
        $upload->savePath  =     'EXCEL/'; //设置附件上传（子）目录
        //$upload->subName   =     array('date', 'Ym');
        $upload->subName   =     '';
        // 上传文件  
        $info   =   $upload->upload();
        
        $file_name =  $upload->rootPath.$info['exl']['savepath'].$info['exl']['savename'];
        $handle = fopen ( $file_name, 'r' );
        $z=0;
        $p=M('xkpersyue');
        while($data = fgetcsv($handle)){
        $arr[]=$data;
        }
        for($i=0;$i<count($arr);$i++){
        $brr[$z]=array(
        'jgh'=>$arr[$i][3],
        'name'=>iconv('gbk','utf-8',$arr[$i][5]),
        'zyue'=>$arr[$i][6],
        'jghname'=>$arr[$i][3].iconv('gbk','utf-8',$arr[$i][5]),
        'date'=>date('Y-m-d'),
        );
        $z++;
        if($z==999){
           $prr=$p->addall($brr);
        	$z=0;
        	unset($brr);
        	}
        }
        $prr=$p->addall($brr);
        unset($brr);
        unset($arr);
        // 删除Excel文件
        unlink($file_name);
        $arr=$p->field('jgh,jghname,name,sum(zyue) as sumzyue')->group('jgh,jghname,name')->select();
        
    	$p->execute("truncate table jr_xkpersyue");
        $z=0;
        for($i=0;$i<count($arr);$i++){
        $brr[$z]=array(
        'jgh'=>$arr[$i]['jgh'],
        'name'=>$arr[$i]['name'],
        'zyue'=>$arr[$i]['sumzyue'],
        'jghname'=>$arr[$i]['jghname'],
        'date'=>date('Y-m-d'),
        );
        $z++;
        if($z==999){
           $prr=$p->addall($brr);
        	$z=0;
        	unset($brr);
        	}
        }
        $prr=$p->addall($brr);
        unset($brr);
        
        //var_dump($prr);
        //$this->display('info');
//      if($prr>0){
//      	$this->success('EXCEL数据导入成功');
//      }
    }
    public function xkcollect(){
    	//$User = D('');
    	//$pr=$User->query('select * from jr_pers where (select count(1) as num from jr_pers where jr_pers.jghsfz = jr_persold.jghsfz) = 0');
        $xk=M('xkperskh');
        $xkrr=$xk->field('jgh,count(jgh) as countjgh')->group('jgh')->select();
        //var_dump($xkrr);
        $User = D('');
    	$pr=$User->query('select jgh,count(jgh) as countjgh from jr_xkperskh where (select count(1) as num from jr_xkpers where jr_xkperskh.jghname = jr_xkpers.jghname) = 0 group by jgh');
        //var_dump($pr);
        
        //$Usera = D('');
    	//$pra=$Usera->query('select jgh,count(jgh) as countjgh from jr_xkpersyue where (select count(1) as num from jr_xkpers where jr_xkpersyue.jghname = jr_xkpers.jghname) = 0 group by jgh');
        //$Userup = D('');
    	//$prup=$Userup->query('select jr_perscs.jgh,cs,sum(zyue) as sumzyue,sum(dingqi) as sumdingqi,sum(huoqi) as sumhuoqi,count(cs) as countcs from jr_persup inner join jr_perscs on jr_persup.jghsfz=jr_perscs.jghsfz group by jr_perscs.jgh,cs');
        //$Useryue = D('');
    	//$pryue=$Useryue->query('select jr_xkpersyue.jgh,sum(zyue) as sumzyue,count(jr_xkpersyue.jgh) as countjgh from jr_xkperskh inner join jr_xkpersyue on jr_xkperskh.jghname=jr_xkpersyue.jghname group by jr_xkpersyue.jgh');
        //var_dump($pra);
        
        $Useryue = D('');
    	$pryue=$Useryue->query('select jr_xkperskh.jgh,sum(jr_xkpersyue.zyue) as sumzyue,count(jr_xkperskh.jgh) as countjgh from jr_xkpersyue inner join jr_xkperskh on jr_xkperskh.jghname=jr_xkpersyue.jghname group by jr_xkperskh.jgh');
        //var_dump($pryue);
        foreach($xkrr as &$value){
        	foreach($pr as &$valuekh){
        		if($value['jgh']==$valuekh['jgh']){
        			$value['newcountjgh']=$valuekh['countjgh'];
        		}
        	}
        }
        foreach($xkrr as &$value){
        	foreach($pryue as &$valueyue){
        		if($value['jgh']==$valueyue['jgh']){
        			$value['yuecountjgh']=$valueyue['countjgh'];
        			$value['sumzyue']=$valueyue['sumzyue'];
        		}
        	}
        }
        foreach($xkrr as &$value){
        	$value['bl']=round($value['newcountjgh']/$value['countjgh']*100,0);
        	$value['sumzyue']=round($value['sumzyue']/10000,0);
        	$sumzyue=$sumzyue+$value['sumzyue'];
        	$countjgh=$countjgh+$value['countjgh'];
        	$newcountjgh=$newcountjgh+$value['newcountjgh'];
        	$yuecountjgh=$yuecountjgh+$value['yuecountjgh'];
        }
        $xkrr[]=array(
        'jgh'=>'总计',
        'sumzyue'=>$sumzyue,
        'countjgh'=>$countjgh,
        'newcountjgh'=>$newcountjgh,
        'yuecountjgh'=>$yuecountjgh,
        'bl'=>round($newcountjgh/$countjgh*100,0),
        );
        $d=M('danwei');
        $drr=$d->select();
        foreach($drr as &$valued){
        	foreach($xkrr as &$value){
        		if($value['jgh']==$valued['jgh']){
        			$value['dwname']=$valued['dwname'];
        		}
        	}
        }
        $this->assign('collect',$xkrr);
        $this->display();
        
        //var_dump($xkrr);
        //$Useryuea = D('');
    	//$pryuea=$Useryuea->query('select jr_xkpersyue.jgh,sum(jr_xkpersyue.zyue) as sumzyue,count(jr_xkpersyue.jgh) as countjgh from jr_xkpersyue inner join jr_xkpers on jr_xkpers.jghname=jr_xkpersyue.jghname group by jr_xkpersyue.jgh');
        
        //var_dump($pryue);
        //var_dump($pryuea);
    }
    
    public function xkvalid(){
    	$User = D('');
    	$pr=$User->query('select jgh,count(jgh) as countjgh from jr_xkperskh where (select count(1) as num from jr_xkpersyue where jr_xkperskh.jghname = jr_xkpersyue.jghname) = 0 group by jgh');
        $d=M('danwei');
        $drr=$d->select();
        foreach($drr as &$valued){
        	foreach($pr as &$value){
        		if($value['jgh']==$valued['jgh']){
        			$value['dwname']=$valued['dwname'];
        			$value['save']=$valued['save'];
        		}
        	}
        }
        $this->assign('collect',$pr);
        $this->display();
    }
    public function xkvalids(){
    	$jgh=$_GET['jgh'];
    	
    	$User = D('');
    	$data=$User->query("select jgh,name,sfz,phone,xklink from jr_xkperskh where (select count(1) as num from jr_xkpersyue where jr_xkperskh.jghname = jr_xkpersyue.jghname) = 0 and jr_xkperskh.jgh='$jgh' group by jgh,name,sfz,phone,xklink");
        $d=M('danwei');
        $drr=$d->select();
        foreach($drr as &$valued){
        	foreach($data as &$value){
        		if($value['jgh']==$valued['jgh']){
        			$value['dwname']=$valued['dwname'];
        		}
        	}
        }
        //var_dump($data);
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

                
        $objActSheet->setCellValue('A1', '机构单位');
        $objActSheet->setCellValue('B1', '机构号');
        $objActSheet->setCellValue('C1', '姓名');
        $objActSheet->setCellValue('D1', '电话');
        $objActSheet->setCellValue('E1', '身份证');
        
        foreach($data as $k=>$v){
            $k +=2;
            $objActSheet->setCellValue('A'.$k, $v['dwname']);
            $objActSheet->setCellValue('B'.$k, $v['jgh']);
            $objActSheet->setCellValue('C'.$k, $v['name']);    
            $objActSheet->setCellValue('D'.$k, $v['phone']);
            $objActSheet->setCellValue('E'.$k, $v['sfz']."\t");
            
            $objActSheet->getRowDimension($k)->setRowHeight(18);
        }
        $fileName = $jgh.'蓄客名单';
        $date = date("Y-m-d",time());
        $fileName .= "_{$date}.xlsx";

        $fileName = iconv("utf-8", "gb2312", $fileName);
        $objPHPExcel->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=\"$fileName\"");
        header('Cache-Control: max-age=0');

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output'); //文件通过浏览器下载
        // END    
        
    }
    public function xkcleans(){
    	$p=D('');
    	$p->execute("truncate table jr_xkpersyue");
    	$p->execute("truncate table jr_xkperskh");
    	$p->execute("truncate table jr_xkpers");
    	$d=M('danwei');
    	$drr=$d->select();
    	foreach($drr as &$value){
    		$id=$value['id'];
    		$where['xksave']=0;
    		$d->where("id='$id'")->save($where);
    	}
    	//$drr=$d->save($where);
    	$this->success('数据清空,请继续操作');
    }
    public function zcpers(){
    	$files = $_FILES['exl'];
        var_dump($files);
        // exl格式，否则重新上传
        if($files['type'] !='application/vnd.ms-excel'){
            $this->error('不是Excel文件，请重新上传');
        }
        // 上传
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     209715200 ;// 设置附件上传大小
        $upload->exts      =     array('xls','xlsx','csv');// 设置附件上传类型
        $upload->rootPath  =     './Public/Uploads/'; // 设置附件上传根目录
        $upload->savePath  =     'EXCEL/'; //设置附件上传（子）目录
        //$upload->subName   =     array('date', 'Ym');
        $upload->subName   =     '';
        // 上传文件  
        $info   =   $upload->upload();
        
        $file_name =  $upload->rootPath.$info['exl']['savepath'].$info['exl']['savename'];
        $handle = fopen ( $file_name, 'r' );
        $z=0;
        $p=M('zcpers');
        while($data = fgetcsv($handle)){
        $arr[]=$data;
        }
        for($i=0;$i<count($arr);$i++){
        $brr[$z]=array(
        'jgh'=>$arr[$i][3],
        'cundan'=>$arr[$i][0],
        'sfz'=>$arr[$i][2],
        'name'=>iconv('gbk','utf-8',$arr[$i][5]),
        'phone'=>$arr[$i][10],
        'zyue'=>$arr[$i][6],
        'jghsfz'=>$arr[$i][3].$arr[$i][2],
        'cq'=>$arr[$i][8],
        'dqdate'=>$arr[$i][9],
        'date'=>date('Y-m-d'),
        );
        $z++;
        if($z==999){
           $prr=$p->addall($brr);
        	$z=0;
        	unset($brr);
        	}
        }
        $prr=$p->addall($brr);
        unset($brr);
        // 删除Excel文件
        unlink($file_name);
        //$this->display('info');
//      if($prr>0){
//      	$this->success('EXCEL数据导入成功');
//      }
    }
    public function zcdingqi(){
    	$files = $_FILES['exl'];
        var_dump($files);
        // exl格式，否则重新上传
        if($files['type'] !='application/vnd.ms-excel'){
            $this->error('不是Excel文件，请重新上传');
        }
        // 上传
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     209715200 ;// 设置附件上传大小
        $upload->exts      =     array('xls','xlsx','csv');// 设置附件上传类型
        $upload->rootPath  =     './Public/Uploads/'; // 设置附件上传根目录
        $upload->savePath  =     'EXCEL/'; //设置附件上传（子）目录
        //$upload->subName   =     array('date', 'Ym');
        $upload->subName   =     '';
        // 上传文件  
        $info   =   $upload->upload();
        
        $file_name =  $upload->rootPath.$info['exl']['savepath'].$info['exl']['savename'];
        $handle = fopen ( $file_name, 'r' );
        $z=0;
        $p=M('zcdingqi');
        while($data = fgetcsv($handle)){
        $arr[]=$data;
        }
        for($i=0;$i<count($arr);$i++){
        $brr[$z]=array(
        'jgh'=>$arr[$i][3],
        'cundan'=>$arr[$i][0],
        'sfz'=>$arr[$i][2],
        'name'=>iconv('gbk','utf-8',$arr[$i][5]),
        'phone'=>$arr[$i][10],
        'zyue'=>$arr[$i][6],
        'jghsfz'=>$arr[$i][3].$arr[$i][2],
        'cq'=>$arr[$i][8],
        'dqdate'=>$arr[$i][9],
        'date'=>date('Y-m-d'),
        );
        $z++;
        if($z==999){
           $prr=$p->addall($brr);
        	$z=0;
        	unset($brr);
        	}
        }
        $prr=$p->addall($brr);
        unset($brr);
        // 删除Excel文件
        unlink($file_name);
        //$this->display('info');
//      if($prr>0){
//      	$this->success('EXCEL数据导入成功');
//      }
    }
    public function zckhdingqi(){
    	$files = $_FILES['exl'];
        var_dump($files);
        // exl格式，否则重新上传
        if($files['type'] !='application/vnd.ms-excel'){
            $this->error('不是Excel文件，请重新上传');
        }
        // 上传
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     209715200 ;// 设置附件上传大小
        $upload->exts      =     array('xls','xlsx','csv');// 设置附件上传类型
        $upload->rootPath  =     './Public/Uploads/'; // 设置附件上传根目录
        $upload->savePath  =     'EXCEL/'; //设置附件上传（子）目录
        //$upload->subName   =     array('date', 'Ym');
        $upload->subName   =     '';
        // 上传文件  
        $info   =   $upload->upload();
        
        $file_name =  $upload->rootPath.$info['exl']['savepath'].$info['exl']['savename'];
        $handle = fopen ( $file_name, 'r' );
        $z=0;
        $p=M('zckhdingqi');
        while($data = fgetcsv($handle)){
        $arr[]=$data;
        }
        for($i=0;$i<count($arr);$i++){
        $brr[$z]=array(
        'jgh'=>$arr[$i][3],
        'sfz'=>$arr[$i][2],
        'name'=>iconv('gbk','utf-8',$arr[$i][5]),
        'phone'=>$arr[$i][10],
        'zyue'=>$arr[$i][6],
        'jghsfz'=>$arr[$i][3].$arr[$i][2],
        'khdate'=>$arr[$i][7],
        'cq'=>$arr[$i][8],
        'dqdate'=>$arr[$i][9],
        'date'=>date('Y-m-d'),
        );
        $z++;
        if($z==999){
           $prr=$p->addall($brr);
        	$z=0;
        	unset($brr);
        	}
        }
        $prr=$p->addall($brr);
        unset($brr);
        // 删除Excel文件
        unlink($file_name);
        
        $arr=$p->field('jgh,jghsfz,sfz,name,phone,sum(zyue) as sumzyue')->group('jgh,jghsfz,name,sfz,phone')->select();
        
    	$p->execute("truncate table jr_zckhdingqi");
        $z=0;
        for($i=0;$i<count($arr);$i++){
        $brr[$z]=array(
        'jgh'=>$arr[$i]['jgh'],
        'sfz'=>$arr[$i]['sfz'],
        'name'=>iconv('gbk','utf-8',$arr[$i][name]),
        'zyue'=>$arr[$i]['sumzyue'],
        'phone'=>$arr[$i]['phone'],
        'jghsfz'=>$arr[$i]['jghsfz'],
        'date'=>date('Y-m-d'),
        );
        $z++;
        if($z==999){
           $prr=$p->addall($brr);
        	$z=0;
        	unset($brr);
        	}
        }
        $prr=$p->addall($brr);
        unset($brr);
        //$this->display('info');
//      if($prr>0){
//      	$this->success('EXCEL数据导入成功');
//      }
    }
    public function zcpersls(){
    	$User = D('');
    	$pr=$User->query('select jgh,name,sfz,phone,jghsfz,count(jghsfz) as countjghsfz,sum(zyue) as sumzyue from jr_zcpers where (select count(1) as num from jr_zcdingqi where jr_zcpers.cundan = jr_zcdingqi.cundan) = 0 group by jgh,name,sfz,phone,jghsfz');
        //var_dump($pr);
        $p=M('zcpersls');
        $z=0;
    	for($i=0;$i<count($pr);$i++){
    		$data[$z]=array(
    		'jgh'=>$pr[$i]['jgh'],
    		'sfz'=>$pr[$i]['sfz'],
    		'name'=>$pr[$i]['name'],
    		'zyue'=>$pr[$i]['sumzyue'],
    		'phone'=>$pr[$i]['phone'],
    		'jghsfz'=>$pr[$i]['jghsfz'],
    		'date'=>date('Y-m-d'),
    		);
    		$z++;
    		if($z==999){
            $prr=$p->addall($data);
        	$z=0;
        	unset($data);
        	}
        }
        $prr=$p->addall($data);
        unset($data);
        if($prr>0){
        	$this->success('流失客户数据获取成功,请继续');
        }
    }
    public function zcperskhls(){
    	$User = D('');
    	//$pr=$User->query('select * from jr_zcpersls where (select count(1) as num from jr_zckhdingqi where jr_zcpersls.jghsfz = jr_zckhdingqi.jghsfz) = 0');
        //var_dump($pr);
        $prr=$User->query('select jgh,count(jgh) as countjgh,sum(zyue) as sumzyue from jr_zcpersls where (select count(1) as num from jr_zckhdingqi where jr_zcpersls.jghsfz = jr_zckhdingqi.jghsfz) = 0 group by jgh');
        $zcpers=M('zcpers');
        $zcrr=$zcpers->field('jgh,sum(zyue) as sumzyue')->group('jgh')->select();
        $d=M('danwei');
        $drr=$d->select();
        foreach($drr as &$valued){
        	foreach($prr as &$value){
        		if($value['jgh']==$valued['jgh']){
        			$valued['countjgh']=$value['countjgh'];
        			$valued['sumzyue']=round($value['sumzyue']/10000,0);
        		}
        	}
        }
        foreach($drr as &$valued){
        	foreach($zcrr as &$value){
        		if($value['jgh']==$valued['jgh']){
        			$valued['lszyue']=round($value['sumzyue']/10000,0);
        			$valued['lsl']=round($valued['sumzyue']/$valued['lszyue']*100,0);
        		}
        	}
        }
        //var_dump($zcrr);
        $this->assign('drr',$drr);
        $this->display();
    }
    public function zcperskhlsdl(){
    	$jgh=$_GET['jgh'];
    	$User = D('');
    	$data=$User->query("select jgh,name,sfz,phone,zyue from jr_zcpersls where (select count(1) as num from jr_zckhdingqi where jr_zcpersls.jghsfz = jr_zckhdingqi.jghsfz) = 0 and jr_zcpersls.jgh='$jgh' group by jgh,name,sfz,phone,zyue");
        //var_dump($data);
        
        $d=M('danwei');
        $drr=$d->select();
        foreach($drr as &$valued){
        	foreach($data as &$value){
        		if($value['jgh']==$valued['jgh']){
        			$value['dwname']=$valued['dwname'];
        		}
        	}
        }
        //var_dump($data);
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
            $objActSheet->setCellValue('D'.$k, $v['zyue']);
            $objActSheet->setCellValue('E'.$k, $v['phone']);
            $objActSheet->setCellValue('F'.$k, $v['sfz']."\t");
            
            $objActSheet->getRowDimension($k)->setRowHeight(18);
        }
        $fileName = $jgh.'转存流失名单';
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
    }
    public function zczdkh(){
    	$User = D('');
    	$data=$User->query('select jr_zcpers.jgh,jr_zcpers.name,jr_zcpers.phone,jr_zcpers.sfz,sum(jr_zcpers.zyue) as sumzyue from jr_zcpers inner join jr_zcdingqi on jr_zcpers.jghsfz=jr_zcdingqi.jghsfz group by jr_zcpers.jgh,jr_zcpers.name,jr_zcpers.sfz,jr_zcpers.phone');
    	//$pr=$User->query('select jr_zcpers.jgh,jr_zcpers.sfz,jr_zcpers.name,jr_zcpers.phone,sum(jr_zcpers.zyue) as sumzyue from jr_zcpers inner join jr_zcdingqi on jr_zcpers.jghsfz=jr_zcdingqi.jghsfz group by jr_zcpers.jgh,jr_zcpers.sfz,jr_zcpers.name,jr_zcpers.phone');
    	//var_dump($data);
    	$d=M('danwei');
        $drr=$d->select();
        foreach($drr as &$valued){
        	$valued['countjgh']=0;
        	foreach($data as &$value){
        		if($value['jgh']==$valued['jgh']){
        			$valued['countjgh']=$valued['countjgh']+1;
        			$valued['sumzyue']=$valued['sumzyue']+$value['sumzyue'];
        		}
        	}
        	$valued['sumzyue']=round($valued['sumzyue']/10000,0);
        	$sum['countjgh']=$sum['countjgh']+$valued['countjgh'];
        	$sum['sumzyue']=$sum['sumzyue']+$valued['sumzyue'];
        }
        //var_dump($countjgh);
        $this->assign('collect',$drr);
        $this->assign('sum',$sum);
        $this->display();
    }
    public function zczdkhdl(){
    	$jgh=$_GET['jgh'];
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
    }
    public function zccleans(){
    	$p=D('');
    	$p->execute("truncate table jr_zcpers");
    	$p->execute("truncate table jr_zcpersls");
    	$p->execute("truncate table jr_zckhdingqi");
    	$p->execute("truncate table jr_zcdingqi");
    	$d=M('danwei');
    	$drr=$d->select();
    	foreach($drr as &$value){
    		$id=$value['id'];
    		$where['zcsave']=0;
    		$d->where("id='$id'")->save($where);
    	}
    	//$drr=$d->save($where);
    	$this->success('数据清空,请继续操作');
    }
    public function huodong(){
        $files = $_FILES['exl'];
        //var_dump($files);
        // exl格式，否则重新上传
        if($files['type'] !='application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'){
            $this->error('不是Excel文件，请重新上传');
        }
        // 上传
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     209715200 ;// 设置附件上传大小
        $upload->exts      =     array('xls','xlsx');// 设置附件上传类型
        $upload->rootPath  =     './Public/Uploads/'; // 设置附件上传根目录
        $upload->savePath  =     'EXCEL/'; //设置附件上传（子）目录
        //$upload->subName   =     array('date', 'Ym');
        $upload->subName   =     '';
        // 上传文件  
        $info   =   $upload->upload();
        
        $file_name =  $upload->rootPath.$info['exl']['savepath'].$info['exl']['savename'];
        //$exl = $this->import_exl($file_name);
        import("Org.Util.PHPExcel");   // 这里不能漏掉
        import("Org.Util.PHPExcel.IOFactory");
        $objReader = \PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load($file_name,$encode='utf-8');
        //$objReader = \PHPExcel_IOFactory::createReader('Excel5');
        //$objPHPExcel = $objReader->load($file_name,$encode='utf-8');
        //$extension = strtolower( pathinfo($files, PATHINFO_EXTENSION) );
        //var_dump($extension);
        //if ($extension =='xlsx') {
        //$objReader = new PHPExcel_Reader_Excel2007();
        //$objExcel = $objReader ->load($file);
        //} else if ($extension =='xls') {
        //$objReader = new PHPExcel_Reader_Excel5();
        //$objExcel = $objReader ->load($file);
        //}
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow(); // 取得总行数
        $highestColumn = $sheet->getHighestColumn(); // 取得总列数
        //var_dump($highestColumn);
        //var_dump($highestRow);
        $p=M('huodong');
        $z=0;
        // 去掉第exl表格中第一行
        //unset($exl[0]);
        for($i=2;$i<=$highestRow;$i++)
        {
        	//$y=$i-2;
        	$data[$z]['dwname'] = $objPHPExcel->getActiveSheet()->getCell("A".$i)->getValue();
        	$data[$z]['hushu'] = $objPHPExcel->getActiveSheet()->getCell("B".$i)->getValue();
        	$data[$z]['dingqi'] = $objPHPExcel->getActiveSheet()->getCell("C".$i)->getValue();
        	$data[$z]['cefan'] = $objPHPExcel->getActiveSheet()->getCell("D".$i)->getValue();
        	$data[$z]['zhuancun'] = $objPHPExcel->getActiveSheet()->getCell("E".$i)->getValue();
        	$data[$z]['xiaohu'] = $objPHPExcel->getActiveSheet()->getCell("F".$i)->getValue();
        	$data[$z]['liushi'] = $objPHPExcel->getActiveSheet()->getCell("G".$i)->getValue();
        	$data[$z]['date'] = date('Y-m-d');
        	
        	$z++;
        	
        	if($z==999){
        		$prr=$p->addall($data);
        		$z=0;
        		unset($data);
        	}
        }
        $temp=array('1','2','3','4','5','6','7','8','9','0');
        //var_dump($z);
        foreach($data as &$value){
        	$value['hushu']=preg_replace('/[^\.0123456789]/s', '', $value['hushu']);
        	$value['dingqi']=preg_replace('/[^\.0123456789]/s', '', $value['dingqi']);
        	$value['cefan']=preg_replace('/[^\.0123456789]/s', '', $value['cefan']);
        	$value['zhuancun']=preg_replace('/[^\.0123456789]/s', '', $value['zhuancun']);
        	$value['xiaohu']=preg_replace('/[^\.0123456789]/s', '', $value['xiaohu']);
        	$value['liushi']=preg_replace('/[^\.0123456789]/s', '', $value['liushi']);
        	$value['dingqijz']=$value['dingqi']-$value['xiaohu'];
        	$value['zhuancunl']=$value['zhuancun']/$value['xiaohu'];
        	$value['cefanl']=$value['cefan']/$value['dingqi'];
        	$value['zhuancunl']=round($value['zhuancunl']*100,2).'%';
        	$value['cefanl']=round($value['cefanl']*100,2).'%';
        }
        
        //var_dump($data);
        $prr=$p->addall($data);
        unset($data);
        //var_dump($data);
        //$prr=$p->addall($data);
        // 清理空数组
//      foreach($exl as $k=>$v){
//          if(empty($v)){
//              unset($exl[$k]);
//          }
//      };
        // 重新排序
        //sort($exl);
        
//      $count = count($exl);
//      // 检测表格导入成功后，是否有数据生成
//      if($count<1){
//          $this->error('未检测到有效数据');    
//      }
        //var_dump($data);
        
        // 删除Excel文件
        unlink($file_name);
        //$this->display('info');
        if($prr>0){
        	$this->success('EXCEL数据导入成功');
        }
    }
    public function collecthd(){
    	$h=M('huodong');
    	$d=M('danwei');
    	$p=M('pianqu');
    	$hrr=$h->select();
    	$pr=$p->select();
    	
    	foreach($hrr as &$value){
    		$dwname=$value['dwname'];
    		$drr=$d->where("dwname='$dwname'")->find();
    		$pianqud=$drr['pianqu'];
    		$prr=$p->where("pianqud='$pianqud'")->find();
    		$value['pianqu']=$prr['pianqu'];
    		//var_dump($prr);
    	}
    	$hushu=0;
    	$dingqi=0;
    	$cefan=0;
    	$zhuancun=0;
    	$xiaohu=0;
    	$liushi=0;
    	$dingqijz=0;
    	foreach($pr as &$valuep){
    		$pianqu=$valuep['pianqu'];
    		foreach($hrr as &$valueh){
    			if($pianqu==$valueh['pianqu']){
//  				$hr[]['pianqu']=$pianqu;
//  				$hr[]['dwname']=$valueh['dwname'];
//  				$hr[]['hushu']=$valueh['hushu'];
//  				$hr[]['dingqi']=$valueh['dingqi'];
//  				$hr[]['cefan']=$valueh['cefan'];
//  				$hr[]['zhuancun']=$valueh['zhuancun'];
//  				$hr[]['xiaohu']=$valueh['xiaohu'];
//  				$hr[]['liushi']=$valueh['liushi'];
//  				$hr[]['date']=$valueh['date'];
//  				$hr[]['dingqijz']=$valueh['dingqijz'];
//  				$hr[]['zhuancunl']=$valueh['zhuancunl'];
//  				$hr[]['cefanl']=$valueh['cefanl'];
                    $hr[]=array(
                    'pianqu'=>$pianqu,
                    'dwname'=>$valueh['dwname'],
    				'hushu'=>$valueh['hushu'],
    				'dingqi'=>$valueh['dingqi'],
    				'cefan'=>$valueh['cefan'],
    				'zhuancun'=>$valueh['zhuancun'],
    				'xiaohu'=>$valueh['xiaohu'],
    				'liushi'=>$valueh['liushi'],
    				'date'=>$valueh['date'],
    				'dingqijz'=>$valueh['dingqijz'],
    				'zhuancunl'=>$valueh['zhuancunl'],
    				'cefanl'=>$valueh['cefanl'],
                    );
                    $hushu=$hushu+$valueh['hushu'];
                    $dingqi=$dingqi+$valueh['dingqi'];
                    $cefan=$cefan+$valueh['cefan'];
                    $zhuancun=$zhuancun+$valueh['zhuancun'];
                    $xiaohu=$xiaohu+$valueh['xiaohu'];
                    $liushi=$liushi+$valueh['liushi'];
                    $dingqijz=$dingqijz+$valueh['dingqijz'];
                    $zhuancunl=$zhuancunl+$valueh['zhuancunl'];
                    $cefanl=$cefanl+$valueh['cefanl'];
                    $i++;
    			}
    		}
    		$hr[]=array(
                    'pianqu'=>$pianqu,
                    'dwname'=>"总计",
    				'hushu'=>$hushu,
    				'dingqi'=>$dingqi,
    				'cefan'=>$cefan,
    				'zhuancun'=>$zhuancun,
    				'xiaohu'=>$xiaohu,
    				'liushi'=>$liushi,
    				'date'=>date('Y-m-d'),
    				'dingqijz'=>$dingqijz,
    				'zhuancunl'=>round($zhuancun/$xiaohu*100,2).'%',
    				'cefanl'=>round($cefan/$dingqi*100,2).'%',
                    );
    		$valuep['hushu']=$hushu;
    		$valuep['dingqi']=$dingqi;
    		$valuep['cefan']=$cefan;
    		$valuep['zhuancun']=$zhuancun;
    		$valuep['xiaohu']=$xiaohu;
    		$valuep['liushi']=$liushi;
    		$valuep['dingqijz']=$dingqijz;
    		$valuep['zhuancunl']=round($zhuancun/$xiaohu*100,2).'%';
    		$valuep['cefanl']=round($cefan/$dingqi*100,2).'%';
    		
    		$zhushu=$zhushu+$hushu;
    		$zdingqi=$zdingqi+$dingqi;
    		$zcefan=$zcefan+$cefan;
    		$zzhuancun=$zzhuancun+$zhuancun;
    		$zxiaohu=$zxiaohu+$xiaohu;
    		$zliushi=$zliushi+$liushi;
    		$zdingqijz=$zdingqijz+$dingqijz;
    		
    		$hushu=0;
    		$dingqi=0;
    		$cefan=0;
    		$zhuancun=0;
    		$xiaohu=0;
    		$liushi=0;
    		$dingqijz=0;
    		
    		
    	}
    	$hr[]=array(
                'pianqu'=>"",
                'dwname'=>"总计",
    		    'hushu'=>$zhushu,
    		    'dingqi'=>$zdingqi,
    			'cefan'=>$zcefan,
    			'zhuancun'=>$zzhuancun,
    			'xiaohu'=>$zxiaohu,
    			'liushi'=>$zliushi,
    			'date'=>date('Y-m-d'),
    			'dingqijz'=>$zdingqijz,
    			'zhuancunl'=>round($zzhuancun/$zxiaohu*100,2).'%',
    			'cefanl'=>round($zcefan/$zdingqi*100,2).'%',
                    );
    	$this->assign('collect',$hr);
    	
    	$this->display();
    }
    public function cleanhd(){
    	$p=M('huodong');
    	$count=$p->execute("truncate table jr_huodong");
    	$this->success('数据已清空，请继续操作');
    }
    public function clean(){
    	$this->display();
    }
    public function cleandata(){
    	$p=M('pers');
    	$count=$p->execute("truncate table jr_pers");
    	$po=M('persold');
    	$count=$po->execute("truncate table jr_persold");
    	$this->success('数据已清空，请继续操作');
    }
    public function cleancollect(){
    	$p=M('persup');
    	$count=$p->execute("truncate table jr_persup");
    	$po=M('persdown');
    	$count=$po->execute("truncate table jr_persdown");
    	$this->success('数据已清空，请继续操作');
    }
//  public function persinfo(){
//      $files = $_FILES['exl'];
//      var_dump($files);
//      // exl格式，否则重新上传
//      if($files['type'] !='application/vnd.ms-excel'){
//          $this->error('不是Excel文件，请重新上传');
//      }
//      // 上传
//      $upload = new \Think\Upload();// 实例化上传类
//      $upload->maxSize   =     209715200 ;// 设置附件上传大小
//      $upload->exts      =     array('xls','xlsx','csv');// 设置附件上传类型
//      $upload->rootPath  =     './Public/Uploads/'; // 设置附件上传根目录
//      $upload->savePath  =     'EXCEL/'; //设置附件上传（子）目录
//      //$upload->subName   =     array('date', 'Ym');
//      $upload->subName   =     '';
//      // 上传文件  
//      $info   =   $upload->upload();
//      
//      
//      //$result = $this->input_csv ( $handle ); 
//      //var_dump($file);
//      $file_name =  $upload->rootPath.$info['exl']['savepath'].$info['exl']['savename'];
//      $handle = fopen ( $file_name, 'r' );
//      $z=0;
//      $p=M('persinfo');
//      while($data = fgetcsv($handle)){
//      $arr[]=$data;
//      }
//      for($i=0;$i<count($arr);$i++){
//      $brr[$z]=array(
//      'jgh'=>$arr[$i][0],
//      'dwname'=>$arr[$i][0],
//      'sfz'=>$arr[$i][2],
//      'name'=>iconv('gbk','utf-8',$arr[$i][3]),
//      'zyue'=>$arr[$i][4],
//      'huoqi'=>$arr[$i][5],
//      'dingqi'=>$arr[$i][6],
//      'jghsfz'=>$arr[$i][0].$arr[$i][2],
//      'date'=>date('Y-m-d'),
//      );
//      $z++;
//      if($z==999){
//         $prr=$p->addall($brr);
//      	$z=0;
//      	unset($brr);
//      	}
//      }
//      $prr=$p->addall($brr);
//      unset($brr);
////      foreach($arr as $k=>$val){
////      //去除表头
////      if($k == 0){
////      continue;
////       }
////       $id=$val['0'];
////       $name = iconv('gbk','utf-8',$val['1']);//中文转码
////       $email = iconv('gbk','utf-8',$val['2']);
////       }
//      //$data = fgetcsv($handle);
//      var_dump($brr);
//      //$exl = $this->import_exl($file_name);
//      //import("Org.Util.PHPExcel");   // 这里不能漏掉
//      //import("Org.Util.PHPExcel.IOFactory");
////      $objReader = \PHPExcel_IOFactory::createReader('Excel2007');
////      $objPHPExcel = $objReader->load($file_name,$encode='utf-8');
//      //$objReader = \PHPExcel_IOFactory::createReader('Excel5');
//      //$objPHPExcel = $objReader->load($file_name,$encode='utf-8');
//      //$PHPReader = new PHPExcel_Reader_CSV();
//
//  //默认输入字符集
//  //$PHPReader->setInputEncoding('GBK');
//
//  //默认的分隔符
//  //$PHPReader->setDelimiter(',');
//
//  //载入文件
//  //$objExcel = $PHPReader->load($file_name);
//      //$extension = strtolower( pathinfo($files, PATHINFO_EXTENSION) );
//      //var_dump($extension);
//      //if ($extension =='xlsx') {
//      //$objReader = new PHPExcel_Reader_Excel2007();
//      //$objExcel = $objReader ->load($file);
//      //} else if ($extension =='xls') {
//      //$objReader = new PHPExcel_Reader_Excel5();
//      //$objExcel = $objReader ->load($file);
//      //}
//      //$sheet = $objPHPExcel->getSheet(0);
//      //$highestRow = $sheet->getHighestRow(); // 取得总行数
//      //$highestColumn = $sheet->getHighestColumn(); // 取得总列数
//      //var_dump($highestColumn);
//      //var_dump($highestRow);
//      
//      // 去掉第exl表格中第一行
//      //unset($exl[0]);
////      for($i=2;$i<=$highestRow;$i++)
////      {
////      	//$y=$i-2;
////      	$data[$z]['jgh'] = $objPHPExcel->getActiveSheet()->getCell("A".$i)->getValue();
////      	//$data[$z]['dwname'] = $objPHPExcel->getActiveSheet()->getCell("B".$i)->getValue();
////      	$data[$z]['sfz'] = $objPHPExcel->getActiveSheet()->getCell("C".$i)->getValue();
////      	$data[$z]['name'] = $objPHPExcel->getActiveSheet()->getCell("D".$i)->getValue();
////      	$data[$z]['zyue'] = $objPHPExcel->getActiveSheet()->getCell("E".$i)->getValue();
////      	$data[$z]['huoqi'] = $objPHPExcel->getActiveSheet()->getCell("F".$i)->getValue();
////      	$data[$z]['dingqi'] = $objPHPExcel->getActiveSheet()->getCell("G".$i)->getValue();
////      	$data[$z]['jghsfz'] = $objPHPExcel->getActiveSheet()->getCell("A".$i)->getValue().$objPHPExcel->getActiveSheet()->getCell("C".$i)->getValue();
////      	//$data[$z]['date'] = date('Y-m-d');
////      	$z++;
////      	
////      	if($z==999){
////      		//$prr=$p->addall($data);
////      		var_dump($data);
////      		$z=0;
////      		unset($data);
////      	}
////      }
//      //var_dump($data);
//      //var_dump($z);
//      //$prr=$p->addall($data);
//      //unset($data);
//      //var_dump($data);
//      //$prr=$p->addall($data);
//      // 清理空数组
////      foreach($exl as $k=>$v){
////          if(empty($v)){
////              unset($exl[$k]);
////          }
////      };
//      // 重新排序
//      //sort($exl);
//      
////      $count = count($exl);
////      // 检测表格导入成功后，是否有数据生成
////      if($count<1){
////          $this->error('未检测到有效数据');    
////      }
//      //var_dump($data);
//      
//      // 删除Excel文件
//      unlink($file_name);
//      //$this->display('info');
//      if($prr>0){
//      	//$this->success('EXCEL数据导入成功');
//      }
//  }

	public function select(){
		vendor('Jpgraph.Chart');
		$chart = new \Chart;
		
		$title = '白名单人数统计'; //标题
		
		
		$jd = M('jrdanwei');
		$jdr = $jd -> where("jiagou = 'A1'") -> select();
		
		$User = D('');
    	
    	$datas = $User->query("select hr_jraccountinfo.jgh,hr_jraccountinfo.sfz,hr_jraccountinfo.money,hr_jraccountinfo.dwname from hr_jraccountinfo inner join hr_jrwhitecust on hr_jraccountinfo.jgh = hr_jrwhitecust.jgh and hr_jraccountinfo.sfz = hr_jrwhitecust.sfz");
    	
    	$datab = $User -> query("select hr_jrclientassetsold.sfz,hr_jrclientassetsold.jgh,hr_jrclientassetsold.zyue as zyueb,hr_jrclientassetsold.huoqi as huoqib,hr_jrclientassetsold.dingqi as dingqib from hr_jrwhitecust inner join hr_jrclientassetsold on hr_jrclientassetsold.sfz = hr_jrwhitecust.sfz and hr_jrclientassetsold.jgh = hr_jrwhitecust.dwname");
    	$datao = $User -> query("select hr_jrclientassets.sfz,hr_jrclientassets.jgh,hr_jrclientassets.zyue as zyueo,hr_jrclientassets.huoqi as huoqio,hr_jrclientassets.dingqi as dingqio from hr_jrwhitecust inner join hr_jrclientassets on hr_jrclientassets.sfz = hr_jrwhitecust.sfz and hr_jrclientassets.jgh = hr_jrwhitecust.dwname");
//		var_dump($datas,$datao,$datab);
		
		foreach($datab as &$value){
			
			foreach($datao as &$val){
				
				if($value['sfz'] == $val['sfz'] and $value['jgh'] == $val['jgh']){
					
					$data[] = array(
						
						'sfz' => $value['sfz'],
						'jgh' => $value['jgh'],
						'zyue' => $val['zyueo'] - $value['zyueb'],
						'dingqi' => $val['dingqio'] - $value['dingqib'],
						'huoqi' => $val['huoqio'] - $value['huoqib'],
						
					);
					
				}
			}
		}
		
		foreach($data as &$value){
			
			if($value['zyue'] > 0){
				$dataz[] = $value;
				continue;
			}
			if($value['zyue'] < 0){
				$dataf[] = $value;
			}
			
		}
		
		
		
		foreach($dataz as &$value){
				
				$whitedata[$value['jgh']]['dwname'] = $value['jgh'];
				$whitedata[$value['jgh']]['persz'] = $whitedata[$value['jgh']]['persz'] + 1;
				$whitedata[$value['jgh']]['zyuez'] = $whitedata[$value['jgh']]['zyuez'] + $value['zyue'];
				$whitedata[$value['jgh']]['dingqiz'] = $whitedata[$value['jgh']]['dingqiz'] + $value['dingqi'];
				$whitedata[$value['jgh']]['huoqiz'] = $whitedata[$value['jgh']]['huoqiz'] + $value['huoqi'];
				
		}
		

			
		foreach($dataf as &$value){
				
				$whitedata[$value['jgh']]['dwname'] = $value['jgh'];
				$whitedata[$value['jgh']]['persf'] = $whitedata[$value['jgh']]['persf'] + 1;
				$whitedata[$value['jgh']]['zyuef'] = $whitedata[$value['jgh']]['zyuef'] + $value['zyue'];
				$whitedata[$value['jgh']]['dingqif'] = $whitedata[$value['jgh']]['dingqif'] + $value['dingqi'];
				$whitedata[$value['jgh']]['huoqif'] = $whitedata[$value['jgh']]['huoqif'] + $value['huoqi'];
				
		}
		
		$jw = M('jrwhitecust');
		
		$jwrr = $jw -> field('dwname,count(jgh) as count') -> group('dwname') -> select();
		
		foreach($jdr as &$value){
			
			foreach($jwrr as &$val){
				
				if($value['dwnames'] == $val['dwname']){
					
					$value['pers'] = $val['count'];
					break;
				}
			}
		}
		
		foreach($jdr as &$value){
			
			foreach($whitedata as &$val){
				
				if($value['dwnames'] == $val['dwname']){
					
					$value['persz'] = $val['persz'];
					$value['zyuez'] = $val['zyuez'];
					$value['dingqiz'] = $val['dingqiz'];
					$value['huoqiz'] = $val['huoqiz'];
					$value['persf'] = $val['persf'];
					$value['zyuef'] = $val['zyuef'];
					$value['dingqif'] = $val['dingqif'];
					$value['huoqif'] = $val['huoqif'];
					$value['zyue'] = $val['zyuez'] + $val['zyuef'];
					$value['dingqi'] = $val['dingqiz'] + $val['dingqif'];
					$value['huoqi'] = $val['huoqiz'] + $val['huoqif'];
					break;
				}
			}
		}
		
		foreach($jdr as &$value){
			
			foreach($datas as &$val){
				
				if($value['dwnames'] == $val['dwname']){
					
					$value['dingqipers'] = $value['dingqipers'] + 1;
					$value['money'] = $value['money'] + $val['money'];
				}
			}
		}
		
		foreach($jdr as &$value){
			
			$value['zyuez'] = round($value['zyuez'] , 2);
			$value['dingqiz'] = round($value['dingqiz'] , 2);
			$value['huoqiz'] = round($value['huoqiz'] , 2);
			$value['zyuef'] = round($value['zyuef'] , 2);
			$value['dingqif'] = round($value['dingqif'] , 2);
			$value['huoqif'] = round($value['huoqif'] , 2);
			$value['zyue'] = round($value['zyue'] , 2);
			$value['dingqi'] = round($value['dingqi'] , 2);
			$value['huoqi'] = round($value['huoqi'] , 2);
			$value['money'] = round($value['money'] , 2);
			
			$pers[] = $value['pers'];
			$legend[] = $value['dwname'];
			
		}
		
		
		
//		$data = array(20,27,45,75,90,10,20,40,20,27,45,75,90,10,20,40,20,27,45,75,90,10,20,40,20,27,45,75,90,10,20); //数据  实际操作时这里的数据从数据库拉取
		$size = 1000; //尺寸
		$width = 1920; //宽度
		$height = 1080; //高度
//		$legend = array('1111 ','2222','3333','4444 ','5555 ','6666 ','7777 ','8888 ');//说明
		/*上面的参数各种图都是用，比如：饼图 折线图 柱形图等等，需要改变的就是下面的chart.php中的function的名字*/
		$chart->createmonthline($title,$pers,$size,$height,$width,$legend);
//		var_dump($data,$legend);



		//数据库加入新字段；
//		$jw = M('jrwhitecust');
//		
//		$jwrr = $jw -> select();
//		
//		$jd = M('jrdanwei');
//		
//		foreach($jwrr as &$value){
//			
//			$jgh = $value['jgh'];
//			
//			$whitecustid = $value['whitecustid'];
//			
//			$jdr = $jd -> where("jgh = '$jgh'") -> find();
//			
//			$where['dwname'] = $jdr['dwnames'];
//			
//			$jw -> where("whitecustid = '$whitecustid'") -> save($where);
//			
//		}
		
		
	}
    
    
    
}