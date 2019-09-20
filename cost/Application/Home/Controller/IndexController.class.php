<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	public function _initialize(){
		$dwname = cookie('dwname');
		//var_dump($dwname);
		$this->assign('user',$dwname);
    	if($dwname['qx'] == null){
    		$this->error('您还未登录,请登录后再操作',U('Login/login'),1);
    	}else{
    		
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
    	//var_dump($_POST);
    	
    	$dwname = cookie('dwname');
    	//var_dump($dwname);
    	$username = $dwname['username'];
    	if($passwordold == $dwname['password']){
    		if($passwordnew == $passwordconfirm){
    			$where['password'] = $passwordnew;
    			$l = M('costlogin');
    			$lrr = $l -> where("username = '$username'") -> save($where);
    			if($lrr > 0){
    				$this->success('密码修改成功,请继续',U('Login/login'));
    			}else{
    				$this->error('原密码和新密码不能重复,请重新输入');
    			}
    		}else{
    			$this->error('2次密码不同,请重新输入');
    		}
    	}else{
    		$this->error('原密码错误,请重新输入');
    	}
    }
    public function costinfo($data){
    	//费用分摊对数据批量处理;
		
    	$cp = M('costproduct');
    	$cprr = $cp -> select();
    	foreach($data as &$value){
    		foreach($cprr as &$valued){
    			if($value['productid'] == $valued['productid']){
    				$value['productname'] = $valued['productname'];
    				$value['productdwname'] = $valued['productdwname'];
    				$value['producttype'] = $valued['producttype'];
    				$value['unit'] = $valued['unit'];
    				continue;
    			}
    		}
    	}
    	
    	$cw = M('costwarehouse');
    	$cwrr = $cw -> select();
    	foreach($data as &$value){
    		foreach($cwrr as &$valued){
    			if($value['warehouseid'] == $valued['warehouseid']){
    				$value['warehouse'] = $valued['warehouse'];
    				$value['warehousedwname'] = $valued['warehousedwname'];
    				
    				continue;
    			}
    		}
    	}
    	
    	$d = M('danwei');
    	$drr = $d -> select();
    	foreach($data as &$value){
    		foreach($drr as &$valued){
    			if($value['applyjgh'] == $valued['jgh']){
    				$value['applydwname'] = $valued['dwname'];
    				continue;
    			}
    			if($value['tojgh'] == $valued['jgh']){
    				$value['applytodwname'] = $valued['dwname'];
    				continue;
    			}
    		}
    	}
    	foreach($data as &$value){
    		foreach($drr as &$valued){
    			if($value['dwname'] == $valued['jgh']){
    				$value['dwname'] = $valued['dwname'];
    				$value['jgh'] = $valued['jgh'];
    				continue;
    			}
    		}
    	}
    	foreach($data as &$value){
    		foreach($drr as &$valued){
    			if($value['outjgh'] == $valued['jgh']){
    				$value['outdwname'] = $valued['dwname'];
    				$value['outjgh'] = $valued['jgh'];
    				continue;
    			}
    		}
    	}
    	foreach($data as &$value){
    		foreach($drr as &$valued){
    			if($value['productdwname'] == $valued['jgh']){
    				$value['productdwname'] = $valued['dwname'];
    				$value['productjgh'] = $valued['jgh'];
    				continue;
    			}
    		}
    	}
		foreach($data as &$value){
    		foreach($drr as &$valued){
    			if($value['warehousedwname'] == $valued['jgh']){
    				$value['warehousedwname'] = $valued['dwname'];
    				$value['warehousejgh'] = $valued['jgh'];
    				continue;
    			}
    		}
    	}
    	
    	
    	$cpt = M('costproducttype');
    	$cptrr = $cpt -> select();
    	foreach($data as &$value){
    		foreach($cptrr as &$valued){
    			if($value['producttype'] == $valued['producttypeid']){
    				$value['producttypename'] = $valued['producttype'];
    				
    				continue;
    			}
    		}
    	}
    	return $data;
    }
    public function costinfos($data){
    	$cpt = M('costproducttype');
    	$cptrr = $cpt -> select();
    	foreach($data as &$value){
    		foreach($cptrr as &$valued){
    			if($value['producttype'] == $valued['producttypeid']){
    				$value['producttypename'] = $valued['producttype'];
    				
    				continue;
    			}
    		}
    	}
    	$d = M('danwei');
    	$drr = $d -> select();
    	foreach($data as &$value){
    		foreach($drr as &$valued){
    			if($value['productdwname'] == $valued['jgh']){
    				$value['productdwname'] = $valued['dwname'];
    				$value['productjgh'] = $valued['jgh'];
    				continue;
    			}
    		}
    	}
    	return $data;
    }
    public function jrywbqxsuc(){
    	$cl = M('costlogin');
    	$where['jrywbqx'] = 0;
    	$clrr = $cl -> select();
    	foreach($clrr as &$value){
    		$id = $value['id'];
    		$clrrr = $cl -> where("id = '$id'") -> save($where);
    	}
    	
    	if($clrrr > 0){
    		$cz = M('costzero');
    		$stats['stats'] = 0;
    		$exp['stats'] = 1;
    		$czrrr = $cz -> where($stats) -> select();
    		foreach($czrrr as &$value){
    			$zeroid = $value['zeroid'];
    			$cz -> where("zeroid = '$zeroid'") -> save($exp);
    		}
    		
    		
	    	$wherez['date'] = date('Y-m-d');
	    	$wherez['stats'] = 0;
	    	$czrr = $cz -> add($wherez);
	    	
	    	if($czrr > 0){
	    		$this->success('0库存申请开放成功,请继续');
	    	}else{
	    		$this->error('开放失败，请检查');
	    	}
    	}else{
    		$this->error('开放失败，请重新登录',U('Login/login'));
    	}
    	
    }
    public function jrywbqxerr(){
    	
    	$cl = M('costlogin');
    	$where['jrywbqx'] = 1;
    	$clrr = $cl -> select();
    	foreach($clrr as &$value){
    		$id = $value['id'];
    		$clrrr = $cl -> where("id = '$id'") -> save($where);
    	}
    	if($clrrr > 0){
    		$cz = M('costzero');
    		$zeroid = $cz -> max('zeroid');
    		
    		$wherez['dateo'] = date('Y-m-d');
    		//$wherez['stats'] = 1;
    		$czrr = $cz -> where("zeroid = '$zeroid'") -> save($wherez);
    		if($czrr > 0){
    			$this->success('0库存申请关闭成功，请继续');
    		}else{
    			$this->error('开放失败，请检查');
    		}
    	}else{
    		$this->error('关闭失败，请重新登录',U('Login/login'));
    	}
    }
    public function productadd(){
    	$cpt = M('costproducttype');
    	$cptrr = $cpt -> select();
    	$this->assign('cptrr',$cptrr);
    	$this->display();
    }
    public function productmodify(){
    	$dwname = cookie('dwname');
    	$cp = M('costproduct');
    	//$where['stats'] = 0;
    	$where['productdwname'] = $dwname['jgh'];
    	$data = $cp -> where($where) -> field('productid,productname,productdwname,producttype,unit,stats') -> select();
    	
    	$data = $this->costinfos($data);
    	//var_dump($data);
    	$this->assign('data',$data);
    	$this->display();
    }
    public function productmodifys(){
    	$productid = $_GET['productid'];
    	$cp = M('costproduct');
    	$data = $cp -> where("productid = '$productid'") -> select();
    	
    	$cprr = $this->costinfo($data);
    	
    	//var_dump($cprr);
    	$this->assign('cprr',$cprr);
    	$cpt = M('costproducttype');
    	$cptrr = $cpt -> select();
    	$this->assign('cptrr',$cptrr);
    	
    	$this->display();
    }
    public function productmodifysuc(){
    	//var_dump($_POST);
    	$productid = $_POST['productid'];
    	$where['productname'] = $_POST['productname'];
    	$where['producttype'] = $_POST['producttype'];
    	$where['unit'] = $_POST['unit'];
    	$where['beizhu'] = $_POST['beizhu'];
    	if($_POST['stats'] == 'on'){
    		$where['stats'] = 0;
    	}else{
    		$where['stats'] = 1;
    	}
    	$cp = M('costproduct');
    	$cprr = $cp -> where("productid = '$productid'") -> save($where);
    	if($cprr > 0){
    		$this->success('产品修改成功,请继续',U('Index/productmodify'));
    	}else{
    		$this->error('产品修改失败,请检查数据');
    	}
    }
    public function productaddsuc(){
    	//var_dump($_POST);
    	$dwname = cookie('dwname');
    	$where['productname'] = $_POST['productname'];
    	$where['producttype'] = $_POST['producttype'];
    	$where['unit'] = $_POST['unit'];
    	$where['beizhu'] = $_POST['beizhu'];
    	$where['productdwname'] = $dwname['jgh'];
    	$cp = M('costproduct');
    	$cprr = $cp -> add($where);
    	if($cprr > 0){
    		$this->success('产品添加成功,请继续');
    	}else{
    		$this->error('产品添加失败,请检查数据');
    	}
    }
    public function productsearch(){
    	$dwname = cookie('dwname');
    	$cp = M('costproduct');
    	//$where['stats'] = 0;
    	$where['productdwname'] = $dwname['jgh'];
    	$data = $cp -> where($where) -> select();
    	
    	$data = $this->costinfo($data);
    	//var_dump($data);
    	$this->assign('data',$data);
    	$this->display();
    }
    public function productedits(){
    	$dwname = cookie('dwname');
    	$cp = M('costproduct');
    	$where['productdwname'] = $dwname['jgh'];
    	$data = $cp -> where($where) -> select();
    	$data = $this->costinfos($data);
    	$count = $cp -> where($where) -> count();
    	
    	$data = json_encode($data);
    	$json = '{"code":0,"msg":"","count":'.$count.',"data":'.$data.'}';
    	echo $json;
    }
    public function producteditsuc(){
    	$productid = $_POST['productid'];
    	
    	$cp = M('costproduct');
    	
    	$where['productname'] = $_POST['productname'];
    	$where['unit'] = $_POST['unit'];
    	$where['supplier'] = $_POST['supplier'];
    	$where['beizhu'] = $_POST['beizhu'];
    	
    	$cprr = $cp -> where("productid = '$productid'") -> save($where);
    	
    	echo $cprr;
    }
    public function productstats(){
    	$productid = $_POST['productid'];
    	
    	$stats = $_POST['stats'];
    	$cp = M('costproduct');
    	if($stats == 'false'){
    		$where['stats'] = 1;
    		$cprr = $cp -> where("productid = '$productid'") -> save($where);
    	}else{
    		$where['stats'] = 0;
    		$cprr = $cp -> where("productid = '$productid'") -> save($where);
    	}
    	echo $cprr;
    }
    public function productbatchstats(){
    	$pro = $_POST['productid'];
    	$cp = M('costproduct');
    	$where['stats'] = 1;
    	foreach($pro as &$value){
    		$productid = $value['productid'];
    		$cprr = $cp -> where("productid = '$productid'") -> save($where);
    		$count = $count + $cprr;
    	}
    	
    	echo $count;
    }
    public function warehouseaddsuc(){
    	$dwname = cookie('dwname');
    	$where['warehouse'] = $_POST['warehouse'];
    	$where['warehousedwname'] = $dwname['jgh'];
    	$where['beizhu'] = $_POST['beizhu'];
    	
    	$cw = M('costwarehouse');
    	$cwrr = $cw -> add($where);
    	if($cwrr > 0){
    		$this->success('仓库添加成功,请继续');
    	}else{
    		$this->error('仓库添加失败,请检查数据');
    	}
    	
    }
   	public function warehousemodify(){
   		$dwname = cookie('dwname');
   		$where['warehousedwname'] = $dwname['jgh'];
   		$cw = M('costwarehouse');
   		$data = $cw -> where($where) -> select();
   		$data = $this->costinfo($data);
   		//var_dump($data);
   		$this->assign('data',$data);
   		$this->display();
   	}
   	public function warehousemodifys(){
   		$warehouseid = $_GET['warehouseid'];
   		$cw = M('costwarehouse');
   		$data = $cw -> where("warehouseid = '$warehouseid'") -> select();
   		$data = $this->costinfo($data);
   		
   		$this->assign('data',$data);
   		$this->display();
   	}
   	public function warehousemodifysuc(){
   		$warehouseid = $_POST['warehouseid'];
   		$where['warehouse'] = $_POST['warehouse'];
   		$where['beizhu'] = $_POST['beizhu'];
   		if($_POST['stats'] == 'on'){
    		$where['stats'] = 0;
    	}else{
    		$where['stats'] = 1;
    	}
    	$cw = M('costwarehouse');
    	$cwrr = $cw -> where("warehouseid = '$warehouseid'") -> save($where);
    	if($cwrr > 0){
    		$this->success('仓库修改成功,请继续');
    	}else{
    		$this->error('修改失败,请检查数据');
    	}
   	}
   	public function inboundzero(){
   		$dwname = cookie('dwname');
   		$jgh = $dwname['jgh'];
   		$cw = M('costwarehouse');
   		$cwrr = $cw -> select();
   		$this->assign('cwrr',$cwrr);
   		
   		$cz = M('costzero');
   		$zeroid = $cz -> where("jgh = '$jgh'") -> max('zeroid');
   		cookie('zeroid',$zeroid);
   		$caz = M('costapplyzero');
   		$where['zeroid'] = $zeroid;
   		$where['shenhe'] = '未审核';
   		$cazrr = $caz -> where($where) -> field('productid,sum(quantity) as sumquantity') -> group('productid') -> select();
   		
// 		$cp = M('costproduct');
// 		$cprr = $cp -> where("productdwname = '$jgh'") -> select();
// 		
// 		foreach($cprr as &$value){
// 			
// 			foreach($cazrr as &$val){
// 				
// 				if($value['productid'] == $val['productid']){
// 					
// 					$cazrrr[] = $val;
// 					break;
// 				}
// 				
// 			}
// 		}
   		$cazrr = $this->costinfo($cazrr);
   		$this->assign('cazrr',$cazrr);
   		
   		$this->display();
   	}
   	public function inboundzeros(){
   		$productid = $_GET['productid'];
   		//var_dump($productid);
   		$zeroid = cookie('zeroid');
   		
   		$where['productid'] = $productid;
   		$where['zeroid'] = $zeroid;
   		$where['shenhe'] = '未审核';
   		$caz = M('costapplyzero');
   		$cazrr = $caz -> where($where) -> select();
   		
   		$cazrr = $this->costinfo($cazrr);
   		$this->assign('cazrr',$cazrr);
   		$this->display();
   		//var_dump($cazrr);
   	}
   	public function inboundzerosuc(){
   		//var_dump($_POST);
   		$where['productid'] = $_POST['productid'];
   		$where['warehouseid'] = $_POST['warehouseid'];
   		$where['quantity'] = $_POST['quantity'];
   		$where['sjquantity'] = $_POST['quantity'];
   		$where['kcquantity'] = $_POST['quantity'];
   		$where['unitprice'] = $_POST['unitprice'];
   		$where['vatprice'] = $_POST['vatprice']/100;
   		$where['vat'] = $_POST['vat'];
   		$where['vatfill'] = 0;
   		$where['inboundnum'] = $_POST['inboundnum'];
   		$where['shenhe'] = '未审核';
   		$where['shenhebill'] = '未审核';
   		$jgh = cookie('dwname');
   		$where['date'] = date('Y-m-d');
   		$where['dwname'] = $jgh['jgh'];
   		$where['pwid'] = $_POST['productid'].$_POST['warehouseid'];
   		$where['totalprice'] = $_POST['unitprice'] * $_POST['quantity'];
   		
   		$ci = M('costinbound');
   		$cirr = $ci -> add($where);
   		
   		if($cirr > 0){
   			$wherecz['stats'] = 0;
   			$cz = M('costzero');
   			$czrr = $cz -> where($wherecz) -> find();
   			
   			$caz = M('costapplyzero');
   			$wherecaz['productid'] = $_POST['productid'];
   			$wherecaz['shenhe'] = '未审核';
   			$wherecaz['zeroid'] = $czrr['zeroid'];
   			
   			$cazrr = $caz -> where($wherecaz) -> select();
   			
   			$ca = M('costapply');
   			
   			foreach($cazrr as &$value){
   				
   				$exp['shenhe'] = '已审核';
   				$applyzeroid = $value['applyzeroid'];
   				$caz -> where("applyzeroid = '$applyzeroid'") -> save($exp);
   				$whereca['jgh'] = $jgh['jgh'];
   				$whereca['applyjgh'] = $value['applyjgh'];
   				$whereca['productid'] = $value['productid'];
   				$whereca['warehouseid'] = $_POST['warehouseid'];
   				$whereca['pwid'] = $value['productid'].$_POST['warehouseid'];
   				$whereca['applyquantity'] = $value['quantity'];
   				$whereca['date'] = $value['date'];
   				$whereca['shenhe'] = '审核同意';
   				$whereca['remark'] = '0库存申请调配';
   				$ca -> add($whereca);
   				
   			}
   			$this->success('产品入库成功，请继续');
   		}else{
   			$this->error('产品入库失败，请检查数据');
   		}
   		
   		//var_dump($totalprice);
   	}
   	public function inboundzeropt(){
   		$cz = M('costzero');
   		$dwname = cookie('dwname');
   		$jgh = $dwname['jgh'];
   		$stats['jgh'] = $dwname['jgh'];
   		$stats['stats'] = 0;
   		$czrr = $cz -> where($stats) -> select();
   		$this->assign('czrr',$czrr);
   		$czrrr = $cz -> where("jgh = '$jgh'") -> select();
   		$this->assign('czrrr',$czrrr);
   		$this->display();
   	}
   	public function inboundzeropts(){
   		$zeroid = $_POST['zeroid'];
   		$dwname = cookie('dwname');
   		$stats['jgh'] = $dwname['jgh'];
   		$stats['zeroid'] = $zeroid;
   		$caz = M('costapplyzero');
   		$cazrr = $caz -> where($stats) -> select();
   		$productid = $caz -> where("zeroid = '$zeroid'") -> field('productid') -> distinct('productid') -> select();
   		
   		$product = $this->costinfo($productid);
   		$cazrr = $this->costinfo($cazrr);
   		
   		$this->assign('product',$product);
   		
   		foreach($productid as &$value){
   			
   			foreach($cazrr as $key => $val){
   				
   				if($value['productid'] == $val['productid']){
   					
   					$data[$val['applydwname']]['applydwname'] = $val['applydwname'];
   					$data[$val['applydwname']][$val['productid']] = $val['quantity'];
   				}
   				continue;
   			}
   		}
   		$this->assign('data',$data);
   		$this->display();
// 		var_dump($product,$cazrr,$data);
   	}
    public function inbound(){
    	$dwname = cookie('dwname');
    	$where['productdwname'] = $dwname['jgh'];
    	$where['stats'] = 0;
    	$cp = M('costproduct');
    	
    	$cprr = $cp -> where($where) -> select();
    	$this->assign('cprr',$cprr);
    	
    	$cw = M('costwarehouse');
    	$wherecw['stats'] = 0;
    	$cwrr = $cw -> where($wherecw) -> select();
    	$this->assign('cwrr',$cwrr);
    	
    	$this->display();
    }
    public function inbounds(){
    	$dwname = cookie('dwname');
    	$where['dwname'] = $dwname['jgh'];
    	$where['productid'] = $_POST['productid'];
    	$where['warehouseid'] = $_POST['warehouseid'];
    	$where['pwid'] = $_POST['productid'].$_POST['warehouseid'];
    	$where['unitprice'] = $_POST['unitprice'];
    	$where['quantity'] = $_POST['quantity'];
    	$where['sjquantity'] = 0;
    	$where['kcquantity'] = 0;
    	$where['vatprice'] = $_POST['vatprice']/100;
    	$where['vatfill'] = $_POST['vatfill']/100;
    	//$where['totalprice'] = $_POST['unitprice']*$_POST['quantity']*($_POST['vatprice']+$_POST['vatfill'])/100;
    	$where['totalprice'] = 0;
    	$where['vat'] = $_POST['vat'];
    	$where['shenhebill'] = '未审核';
    	$where['shenhe'] = '未审核';
    	$where['inboundnum'] = $_POST['inboundnum'];
    	$where['date'] = date('Y-m-d');
    	$ci = M('costinbound');
    	$cirr = $ci -> add($where);
    	//var_dump($where);
    	if($cirr > 0){
    		$this->success('产品入库操作成功,请继续操作');
    	}else{
    		$this->error('产品入库操作失败,请检查数据');
    	}
    }
    public function inboundmodify(){
    	$dwname = cookie('dwname');
    	$where['dwname'] = $dwname['jgh'];
    	$where['shenhe'] = '未审核';
    	$where['sjquantity'] = 0;
    	$ci = M('costinbound');
    	$data = $ci -> where($where) -> select();
    	$data = $this->costinfo($data);
    	$this->assign('data',$data);
    	$stats['stats'] = 0;
    	$stats['productdwname'] = $dwname['jgh'];
    	$cp = M('costproduct');
    	$cprr = $cp -> where($stats) -> select();
    	$this->assign('cprr',$cprr);
    	
    	$cw = M('costwarehouse');
    	$cwrr = $cw -> where($stats) -> select();
    	$this->assign('cwrr',$cwrr);
    	
    	//var_dump($data);
    	$this->display();
    }
    public function inboundmodifys(){
    	$where['productid'] = $_POST['productid'];
    	$inboundid = $_POST['inboundid'];
    	$where['warehouseid'] = $_POST['warehouseid'];
    	$where['pwid'] = $_POST['productid'].$_POST['warehouseid'];
    	$where['unitprice'] = $_POST['unitprice'];
    	$where['quantity'] = $_POST['quantity'];
    	
    	$ci = M('costinbound');
    	$cirr = $ci -> where("inboundid = '$inboundid'") -> save($where);
    	if($cirr > 0){
    		$this->success('入库信息修改成功,请继续');
    	}else{
    		$this->error('修改失败,请检查数据');
    	}
    }
    public function inbounddel(){
    	//var_dump($_POST);
    	$inboundid = $_POST['inboundid'];
    	$where['shenhe'] = '废弃';
    	$ci = M('costinbound');
    	$cirr = $ci -> where("inboundid = '$inboundid'") -> save($where);
    	if($cirr > 0){
    		$this->success('入库信息废弃成功,请继续');
    	}else{
    		$this->error('此记录是否已废弃,请检查数据');
    	}
    }
    public function inboundsh(){
    	$dwname = cookie('dwname');
    	$jgh = $dwname['jgh'];
    	$ci = M('costinbound');
    	$where['shenhe'] = array('neq','已审核');
    	
    	$cw = M('costwarehouse');
    	$cwrr = $cw -> field('warehouseid') -> where("warehousedwname = '$jgh'") -> select();
    	foreach($cwrr as &$value){
    		$cwr[] = $value['warehouseid'];
    	}
    	//var_dump($cwr);
    	
    	$where['warehouseid'] = array('in',$cwr);
    	$data = $ci -> where($where) -> order('date desc') -> select();
    	$data = $this -> costinfo($data);
    	//var_dump($data);
    	$this->assign('data',$data);
    	$this->display();
    }
    public function inboundshs(){
    	$id = $_POST['id'];
    	//$sjquantity = 'sjquantity'.$id;
    	$ci = M('costinbound');
    	$cirr = $ci -> where("inboundid = '$id'") -> find();
    	$where['sjquantity'] = $_POST['sjquantity'];
    	$where['kcquantity'] = $cirr['kcquantity'] + $_POST['sjquantity'] - $cirr['sjquantity'];    	
    	$where['totalprice'] = $_POST['sjquantity']*$cirr['unitprice'] - ($_POST['sjquantity']*$cirr['unitprice']*($cirr['vatprice'] + $cirr['vatfill']));
//  	if($_POST['sjquantity'] >= $cirr['quantity']){
//  		$where['shenhe'] = '已审核';
//  	}else{
//  		$where['shenhe']= '部分审核';
//  	}
		$where['shenhe']= '部分审核';
    	$where['datesh'] = date('Y-m-d');
    	//var_dump($_POST['sjquantity'],$id);
    	$cirr = $ci -> where("inboundid = '$id'") -> save($where);
    	if($cirr > 0){
    		$this->success('产品确认入库成功,请继续');
    	}
    }
    public function inboundshsearchs(){
    	$date = substr($_POST['date_date'],0,10);
    	$dates = substr($_POST['date_date'],-10,10);
    	$where['date'] = array( array('egt',$date) , array('elt',$dates) , 'and' );
    	$where['shenhe'] = array('neq','未审核');
    	$dwname = cookie('dwname');
    	$jgh = $dwname['jgh'];
    	$cw = M('costwarehouse');
    	$cwrr = $cw -> field('warehouseid') -> where("warehousedwname = '$jgh'") -> select();
    	foreach($cwrr as &$value){
    		$cwr[] = $value['warehouseid'];
    	}
    	$where['warehouseid'] = array('in',$cwr);
    	$ci = M('costinbound');
    	
    	$cirr = $ci -> where($where) -> select();
    	$cirr = $this->costinfo($cirr);
    	$this->assign('data',$cirr);
    	$this->display();
    }
    public function inboundshsuc(){
    	$id = $_POST['id'];
    	//$sjquantity = 'sjquantity'.$id;
    	$ci = M('costinbound');
    	$cirr = $ci -> where("inboundid = '$id'") -> find();
    	$where['sjquantity'] = $_POST['sjquantity'];
    	$where['kcquantity'] = $cirr['kcquantity'] + $_POST['sjquantity'] - $cirr['sjquantity'];
    	$where['totalprice'] = $_POST['sjquantity']*$cirr['unitprice'] - ($_POST['sjquantity']*$cirr['unitprice']*($cirr['vatprice'] + $cirr['vatfill']));
    	$where['shenhe'] = '已审核';
    	$where['datesh'] = date('Y-m-d');
    	//var_dump($_POST['sjquantity'],$id);
    	$cirr = $ci -> where("inboundid = '$id'") -> save($where);
    	if($cirr > 0){
    		$this->success('产品确认入库成功,请继续');
    	}
    }
    public function inboundsearchs(){
    	$date = substr($_POST['date_date'],0,10);
    	$dates = substr($_POST['date_date'],-10,10);
    	$where['date'] = array( array('egt',$date) , array('elt',$dates) , 'and' );
    	$dwname = cookie('dwname');
    	$where['dwname'] = $dwname['jgh'];
    	$where['shenhe'] = array('neq','未审核');
    	$ci = M('costinbound');
    	$data = $ci -> where($where) -> select();
    	
    	$data = $this -> costinfo($data);
    	//var_dump($data);
    	$this->assign('data',$data);
    	$this->display();
    }
    public function outboundsearchs(){
    	$date = substr($_POST['date_date'],0,10);
    	$dates = substr($_POST['date_date'],-10,10);
    	$where['date'] = array( array('egt',$date) , array('elt',$dates) , 'and' );
    	$dwname = cookie('dwname');
    	$jgh = $dwname['jgh'];
    	$cw = M('costwarehouse');
    	$cwrr = $cw -> where("warehousedwname = '$jgh'") -> select();
    	foreach($cwrr as &$value){
    		
    		$warehouseid[] = $value['warehouseid'];
    	}
    	$where['warehouseid'] = array('in',$warehouseid);
    	$where['shenhe'] = '出库中';
    	
    	$co = M('costoutbound');
    	$corr = $co -> where($where) -> order('applyjgh,date') -> select();
    	$corr = $this->costinfo($corr);
    	$this->assign('data',$corr);
    	$this->display();
    	//var_dump($corr);
    }
    public function outboundsearchpts(){
    	$date = substr($_POST['date_date'],0,10);
    	$dates = substr($_POST['date_date'],-10,10);
    	$where['date'] = array( array('egt',$date) , array('elt',$dates) , 'and' );
    	
    	$dwname = cookie('dwname');
    	$jgh = $dwname['jgh'];
    	$cw = M('costwarehouse');
    	$cwrr = $cw -> where("warehousedwname = '$jgh'") -> select();
    	foreach($cwrr as &$value){
    		
    		$warehouseid[] = $value['warehouseid'];
    	}
    	$where['warehouseid'] = array('in',$warehouseid);
    	$where['shenhe'] = '出库中';
    	
    	$co = M('costoutbound');
    	
    	$productid = $co -> distinct('productid') -> field('productid') -> where($where) -> select();
    	$productid = $this->costinfo($productid);
    	$this->assign('productname',$productid);
    	$corr = $co -> where($where) -> field('productid,warehouseid,pwid,applyjgh,sum(sjapplyquantity) as sums') -> group('productid,warehouseid,pwid,applyjgh') -> select();
    	
    	
    	
    	$corr = $this->costinfo($corr);
    	//
    	foreach($productid as $value){
    		
    		foreach($corr as $key => $val){
	    		
	    		if($value['productid'] == $val['productid']){
	    				
		    		$data[$val['applydwname']]['applydwname'] = $val['applydwname'];
		    		$data[$val['applydwname']][$val['productid']] = $val['sums'];
	    		}
	    		continue;
	    	}
    	}
    	
	    	
    	//var_dump($data);
    	$this->assign('data',$data);
    	
    	$this->display();
    }
    public function applyproductzero(){
    	$cp = M('costproduct');
    	
    	$cz = M('costzero');
    	$wherecz['stats'] = 0;
    	$czrr = $cz -> where($wherecz) -> field('zeroid') -> find();
    	
    	$stats['stats'] = 0;
    	$stats['producttype'] =2;
    	$stats['productdwname'] = 28;
    	
    	$dwname = cookie('dwname');
    	$where['zeroid'] = $czrr['zeroid'];
    	$where['applyjgh'] = $dwname['jgh'];
    	$where['shenhe'] = '未审核';
    	$caz = M('costapplyzero');
    	$cazrr = $caz -> where($where) -> field('productid') -> select();
    	foreach($cazrr as &$value){
    		
    		$productid[] = $value['productid'];
    	}
    	if($productid == null){
    		
    	}else{
    		$stats['productid'] = array('notin',$productid);
    	}
    	$cprr = $cp -> where($stats) -> select();
    	$this->assign('data',$cprr);
    	$this->display();
    }
    public function applyproductzeros(){
    	//var_dump($_POST);
    	foreach($_POST as &$value){
    		
    		$productid[] = $value;
    	}
    	$where['productid'] = array('in',$productid);
    	$cp = M('costproduct');
    	$data = $cp -> where($where) -> select();
    	$data = $this->costinfo($data);
    	$this->assign('data',$data);
    	
    	$this->display();
    	//var_dump($productid);
    }
    public function applyproductzerosuc(){
    	//var_dump($_POST);
    	$wherezero['stats'] = 0;
    	$cz = M('costzero');
    	$czrr = $cz -> where($wherezero) -> find();
    	$dwname = cookie('dwname');
    	$productid = $_POST['productid'];
    	$quantity = $_POST['quantity'];
    	for($i = 0;$i<count($productid);$i++){
    		$data[] = array(
    			'zeroid' => $czrr['zeroid'],
    			'productid' => $productid[$i],
    			'quantity' => $quantity[$i],
    			'applyjgh' => $dwname['jgh'],
    			'date' => date('Y-m-d'),
    			'shenhe' => '未审核',
    		);
    	}
    	//var_dump($data);
    	$caz = M('costapplyzero');
    	$cazrr = $caz -> addall($data);
    	if($cazrr > 0){
    		$this->success('0库存申请成功,请继续',U('Index/applyproductzero'));
    	}else{
    		$this->error('申请失败,请检查数据');
    	}
    }
    public function applyproductzeromodify(){
    	$dwname = cookie('dwname');
    	
    	$cz = M('costzero');
    	$wherecz['stats'] = 0;
    	$czrr = $cz -> where($wherecz) -> field('zeroid') -> find();
    	
    	$where['zeroid'] = $czrr['zeroid'];
    	$where['shenhe'] = '未审核';
    	$where['applyjgh'] = $dwname['jgh'];
    	$caz = M('costapplyzero');
    	$data = $caz -> where($where) -> select();
    	$data = $this->costinfo($data);
    	$this->assign('data',$data);
    	//var_dump($data);
    	$this->display();
    }
    public function applyproductzeromodifysuc(){
    	$applyzeroid = $_POST['applyzeroid'];
    	$quantity = $_POST['quantity'];
    	$count = 0;
    	$caz = M('costapplyzero');
    	for($i = 0;$i<count($applyzeroid);$i++){
    		$where['quantity'] = $quantity[$i];
    		$apply = $applyzeroid[$i];
    		$cazrr = $caz -> where("applyzeroid = '$apply'") -> save($where);
    		$count = $count + $cazrr;
    	}
    	if($count > 0){
    		$this->success('0库存申请修改成功,请继续');
    	}else{
    		$this->error('修改失败,请检查数据');
    	}
    	//var_dump($applyzeroid,$quantity);
    }
    public function applyproduct(){
    	$ci = M('costinbound');
    	$where['sjquantity'] = array('gt',0);
    	$where['kcquantity'] = array('gt',0);
    	//是否需要增加未审核;
    	$data = $ci -> field('productid,warehouseid,dwname,pwid,sum(kcquantity) as sumkcquantity') -> group('productid,warehouseid,dwname,pwid') -> where($where) -> select();
    	$data = $this -> costinfo($data);
    	
    	$cw = M('costwarehouse');
    	$cwrr = $cw -> select();
    	foreach($cwrr as &$valuecw){
    		foreach($data as &$value){
    			if($valuecw['warehouseid'] == $value['warehouseid']){
    				$datas[$valuecw['warehouse']][] = array(
    				'productid' => $value['productid'],
    				'warehouseid' => $value['warehouseid'],
    				'pwid' => $value['pwid'],
    				'sjquantity' => $value['sumkcquantity'],
    				'productname' => $value['productname'],
    				'warehouse' => $valuecw['warehouse'],
    				'id' => $valuecw['warehouseid'],
    				);
    			}
    		}
    	}
    	$this->assign('datas',$datas);
    	//var_dump($datas);
    	$this->display();
    }
    public function applyproducts(){
    	$cp = M('costproduct');
    	$cprr = $cp -> select();
    	
    	$ci = M('costinbound');
    	
    	$id = $_POST;
//  	$productid = $_POST['productid'];
//  	$warehouseid = $_POST['warehouseid'];
		//$idr = array_cloumn($id);
    	foreach($id as $k => $v){
    		
    		foreach($v as &$val){
    			$datas[] = array(
    			'warehouseid' => $k,
    			'productid' => $val,
    			);
    			
    		}
    	}
    	//var_dump($id);
    	foreach($datas as &$value){
    		$pwid[] = $value['productid'].$value['warehouseid'];
    	}
    	//var_dump($pwid);
    	//var_dump($warehouseid,$productid);
    	
    	
    	$where['pwid'] = array('in',$pwid);
    	$where['kcquantity'] = array('gt',0);
    	$where['shenhe'] = array('neq','未审核');
    	$data = $ci -> field('productid,pwid,sum(kcquantity) as sumkcquantity,warehouseid') -> where($where) -> group('productid,warehouseid,pwid') -> select();
		
    	foreach($data as &$value){
    		$value['sumkcquantity'] =  intval($value['sumkcquantity']);
    		foreach($cprr as &$valuecp){
    			if($value['productid'] == $valuecp['productid']){
    				$value['dwname'] = $valuecp['productdwname'];
    				$value['productdwname'] = $valuecp['productdwname'];
    				continue;
    			}
    		}
    	}
    	
    	$data = $this->costinfo($data);
    	//var_dump($data);
    	$ca = M('costapply');
    	
    	$whereca['shenhe'] = array('in','未审核,审核同意');
    	$carr = $ca -> where($whereca) -> field('pwid,sum(applyquantity) as sumapplyquantity') -> group('pwid') -> select();
    	foreach($data as &$value){
    		foreach($carr as &$valueca){
    			if($value['pwid'] == $valueca['pwid']){
    				$value['sumkcquantity'] = $value['sumkcquantity'] - $valueca['sumapplyquantity'];
    			}
    		}
    	}
    	$this -> assign('data',$data);
    	$this->display();
    }
    public function applyproductsuc(){
    	$dwname = cookie('dwname');
    	$id = $_POST;
    	$applyquantity = $_POST['applyquantity'];
    	foreach($applyquantity as &$value){
    		if($value <= 0){
    			$this->error('申请数量不能为0,请重新输入');
    		}
    	}
    	//var_dump($id);
    	for($i=0;$i<count($id['productid']);$i++){
    		$data[] = array(
    		'productid' => $id['productid'][$i],
    		'warehouseid' => $id['warehouseid'][$i],
    		'pwid' => $id['productid'][$i].$id['warehouseid'][$i],
    		//'sumkcquantity' => $id['sumkcquantity'][$i],
    		'applyquantity' => $id['applyquantity'][$i],
    		'date' => date('Y-m-d'),
    		'shenhe' => '未审核',
    		'applyjgh' => $dwname['jgh'],
    		'jgh' => $id['productjgh'][$i],
    		);
    	}
    	$data = $this -> costinfo($data);
    	$ca = M('costapply');
    	$carr = $ca -> addall($data);
    	if($carr > 0){
    		$this -> success('产品申请成功,请继续',U('Index/applyproduct'));
    	}else{
    		$this -> error('申请产品不成功,请检查数据');
    	}
    }
    public function applyproductmodify(){
    	$dwname = cookie('dwname');
    	$jgh = $dwname['jgh'];
    	
    	$where['applyjgh'] = $jgh;
    	$where['shenhe'] = '未审核';
    	$where['applyquantity'] = array('gt',0);
    	
    	$ca = M('costapply');
    	$data = $ca -> where($where) -> select();
    	$data = $this->costinfo($data);
    	//var_dump($data);
    	$this->assign('data',$data);
    	$this->display();
    }
    public function applyproductmodifys(){
    	$applyid = $_GET['applyid'];
    	$where['applyid'] = $applyid;
    	$ca = M('costapply');
    	$data = $ca -> where($where) -> select();
    	
    	
    	$data = $this -> costinfo($data);
    	
    	$whereci['pwid'] = $data[0]['pwid'];
    	$whereci['kcquantity'] = array('gt',0);
    	$whereci['shenhe'] = array('neq','未审核');
    	$ci = M('costinbound');
    	$cirr = $ci -> field('productid,warehouseid,pwid,sum(kcquantity) as sumkcquantity') -> where($whereci) -> group('productid,warehouseid,pwid') -> select();
    	
    	$whereca['shenhe'] = array('in','未审核,审核同意');
    	$whereca['applyid'] = array('notin',$applyid);
    	$whereca['pwid'] = $data[0]['pwid'];
    	$carr = $ca -> where($whereca) -> field('productid,warehouseid,pwid,sum(applyquantity) as sumapplyquantity') -> group('productid,pwid,warehouseid') -> select();
    	
    	foreach($data as &$value){
    		foreach($cirr as &$valueci){
    			$value['kcquantity'] = $valueci['sumkcquantity'];
    			foreach($carr as &$valueca){
    				
    				if($value['pwid'] == $valueci['pwid'] and $value['pwid'] == $valueca['pwid']){
    				//if($value['pwid'] == $valueca['pwid']){
    					$value['kcquantity'] = $valueci['sumkcquantity'] - $valueca['sumapplyquantity'];
    				}
    			}
    		}
    	}
    	$this->assign('data',$data);
    	$this->display();
    	//var_dump($cirr,$carr,$data);
    }
    public function applyproductmodifysuc(){
    	//var_dump($_POST);
    	$applyid = $_POST['applyid'];
    	$where['applyquantity'] = $_POST['applyquantity'];
    	//var_dump($applyid,$where);
    	$ca = M('costapply');
    	$carr = $ca -> where("applyid = '$applyid'") -> save($where);
    	if($carr > 0){
    		$this -> success('申请修改成功,请继续',U('Index/applyproductmodify'));
    	}else{
    		$this -> error('申请失败,请检查数据');
    	}
    }
	public function applyproductdel(){
		$applyid = $_GET['applyid'];
		$ca = M('costapply');
		$where['applyquantity'] = 0;
    	$carr = $ca -> where("applyid = '$applyid'") -> save($where);
    	if($carr > 0){
    		$this -> success('废弃申请成功,请继续');
    	}else{
    		$this -> error('废弃失败,请检查数据');
    	}
		//var_dump($applyid);
	}
    public function applyproductsh(){
    	$dwname = cookie('dwname');
    	$ca = M('costapply');
    	$where['shenhe'] = '未审核';
    	$where['jgh'] = $dwname['jgh'];
    	$data = $ca -> where($where) -> order('date desc') -> select();
    	$data = $this->costinfo($data);
    	
    	$d = M('danwei');
    	$drr = $d -> select();
    	foreach($data as &$value){
    		foreach($drr as &$valued){
    			if($valued['jgh'] == $value['applyjgh']){
    				$value['applydwname'] = $valued['dwname'];
    				continue;
    			}
    		}
    	}
    	
    	$co = M('costoutbound');
    	$whereco['shenhe'] = '出库中';
    	$corr = $co -> where($whereco) -> field('applyjgh,productid,sum(kcapplyquantity) as sumkcapplyquantity') -> group('applyjgh,productid') -> select();
    	//找出申请单位的商品总库存;
		foreach($data as &$value){
			foreach($corr as &$valueco){
				if($value['productid'] == $valueco['productid'] and $value['applyjgh'] == $valueco['applyjgh']){
					$value['sumkcapplyquantity'] = $valueco['sumkcapplyquantity'];
					continue;
				}
			}
		}
    	//var_dump($corr,$data);
    	$this->assign('data',$data);
    	$this->display();
    }
    public function applyproductshs(){
    	$dwname = cookie('dwname');
    	$ca = M('costapply');
    	$where['shenhe'] = '未审核';
    	$where['jgh'] = $dwname['jgh'];
    	$data = $ca -> where($where) -> order('date desc') -> select();
    	$data = $this->costinfo($data);
    	
    	$d = M('danwei');
    	$drr = $d -> select();
    	foreach($data as &$value){
    		foreach($drr as &$valued){
    			if($valued['jgh'] == $value['applyjgh']){
    				$value['applydwname'] = $valued['dwname'];
    				continue;
    			}
    		}
    	}
    	
    	$co = M('costoutbound');
    	$whereco['shenhe'] = '出库中';
    	$corr = $co -> where($whereco) -> field('applyjgh,productid,sum(kcapplyquantity) as sumkcapplyquantity') -> group('applyjgh,productid') -> select();
    	//找出申请单位的商品总库存;
		foreach($data as &$value){
			foreach($corr as &$valueco){
				if($value['productid'] == $valueco['productid'] and $value['applyjgh'] == $valueco['applyjgh']){
					$value['sumkcapplyquantity'] = $valueco['sumkcapplyquantity'];
					continue;
				}
				
			}
		}
    	//var_dump($corr,$data);
    	$this->assign('data',$data);
    	$this->display();
    }
    public function applyproductshsuc(){
    	$ca = M('costapply');
    	$applyid = $_POST['applyid'];
    	$applyquantity = $_POST['applyquantity'];
    	
    	if($_POST['shenhe'] == '审核通过'){
    		$where['shenhe'] = '审核同意';
    	}else{
    		$where['shenhe'] = '审核不同意';
    		$where['remark'] = $_POST['remark'];
    	}
    	
    	//var_dump($_POST);
    	$where['applyquantity'] = $applyquantity;
    	//$where['shenhe'] = '审核同意';
    	//var_dump($where);
    	$carr = $ca -> where("applyid = '$applyid'") -> save($where);
    	if($carr > 0){
    		$this->success('审核申请成功,请继续');
    	}else{
    		$this->error('审核申请不成功,请检查数据');
    	}
    }
    public function applyproductshsucs(){
    	$ca = M('costapply');
    	$applyid = $_POST['applyid'];
    	$applyquantity = $_POST['applyquantity'];
    	$where['shenhe'] = '审核同意';
    	
    	for($i = 0; $i < count($applyid); $i++){
    		
    		$where['applyquantity'] = $applyquantity[$i];
    		$applyids = $applyid[$i];
    		//var_dump($i,$applyids,$where);
    		$carr = $ca -> where("applyid = '$applyids'") -> save($where);
    	}
    	if($carr > 0){
    		$this->success('批量审核成功，请继续');
    	}else{
    		$this->error('批量审核不成功，请检查数据');
    	}
    	
    }
    public function applyproductsherr(){
    	$id = $_GET['id'];
    	//var_dump($id);
    	$where['shenhe'] = '审核不同意';
    	$ca = M('costapply');
    	$carr = $ca -> where("applyid = '$id'") -> save($where);
    	if($carr > 0){
    		$this->success('取消申请成功,请继续操作');
    	}else{
    		$this->error('取消申请失败,请继续操作');
    	}
    }
    public function applyproductsearchs(){
    	$ca = M('costapply');
    	$date = substr($_POST['date_date'],0,10);
    	$dates = substr($_POST['date_date'],-10,10);
    	$where['date'] = array( array('egt',$date) , array('elt',$dates) , 'and' );
    	$dwname = cookie('dwname');
    	
    	$where['applyjgh'] = $dwname['jgh'];
    	$where['shenhe'] = array('neq','未审核');
    	$ca = M('costapply');
    	$data = $ca -> where($where) -> select();
    	$data = $this -> costinfo($data);
    	$this->assign('data',$data);
    	$this->display();
    	//var_dump($data);
    }
    public function applyproductshsearchpts(){
    	$date = substr($_POST['date_date'],0,10);
    	$dates = substr($_POST['date_date'],-10,10);
    	$where['date'] = array( array('egt',$date) , array('elt',$dates) , 'and' );
    	
    	$dwname = cookie('dwname');
    	$jgh = $dwname['jgh'];
//  	$cw = M('costwarehouse');
//  	$cwrr = $cw -> where("warehousedwname = '$jgh'") -> select();
//  	foreach($cwrr as &$value){
//  		
//  		$warehouseid[] = $value['warehouseid'];
//  	}
    	//获取权限仓库；
//  	$where['warehouseid'] = array('in',$warehouseid);

		//获取产品的权限
		$where['jgh'] = $jgh;
    	$where['shenhe'] = '已出库';
    	$where['remark'] = '0库存申请调配';
    	
    	$ca = M('costapply');
    	
    	$productid = $ca -> distinct('productid') -> field('productid') -> where($where) -> select();
    	$productid = $this->costinfo($productid);
    	$this->assign('productname',$productid);
    	$corr = $ca -> where($where) -> field('productid,warehouseid,pwid,applyjgh,sum(sjapplyquantity) as sums') -> group('productid,warehouseid,pwid,applyjgh') -> select();
    	
    	$corr = $this->costinfo($corr);
    	//
    	foreach($productid as $value){
    		
    		foreach($corr as $key => $val){
	    		
	    		if($value['productid'] == $val['productid']){
	    			
		    		$data[$val['applydwname']]['applydwname'] = $val['applydwname'];
		    		$data[$val['applydwname']][$val['productid']] = $val['sums'];
	    		}
	    		continue;
	    	}
    	}
    	
    	//var_dump($data);
    	$this->assign('data',$data);
    	
    	$this->display();
    }
    public function outbound(){
    	$dwname = cookie('dwname');
    	$jgh = $dwname['jgh'];
    	$ca = M('costapply');
    	$where['shenhe'] = '审核同意';
    	
    	$cw = M('costwarehouse');
    	$cwrr = $cw -> field('warehouseid') -> where("warehousedwname = '$jgh'") -> select();
    	foreach($cwrr as &$value){
    		$cwr[] = $value['warehouseid'];
    	}
    	
    	$where['warehouseid'] = array('in',$cwr);
    	$data = $ca -> where($where) -> order('date desc') -> select();
    	$data = $this->costinfo($data);
    	//var_dump($data);
//  	$d = M('danwei');
//  	$drr = $d -> select();
//  	foreach($data as &$value){
//  		foreach($drr as &$valued){
//  			if($valued['jgh'] == $value['applyjgh']){
//  				$value['applydwname'] = $valued['dwname'];
//  				continue;
//  			}
//  		}
//  	}
    	
    	$this -> assign('data',$data);
    	//var_dump($data);
    	$this -> display();
    }
    public function outbounds(){
    	$productid = $_GET['productid'];
    	$pwid = $_GET['pwid'];
    	$applyquantity = $_GET['applyquantity'];
    	$applydwname = $_GET['applydwname'];
    	$applyid = $_GET['applyid'];
    	//var_dump($applyquantity);
    	$this->assign('applyid',$applyid);
    	$this->assign('apply',$applyquantity);
    	$this->assign('dwname',$applydwname);
    	$applyid = $_GET['applyid'];
    	
    	$ci = M('costinbound');
    	$where['pwid'] = $pwid;
    	$where['productid'] = $productid;
    	$where['sjquantity'] = array('gt',0);
    	$where['kcquantity'] = array('gt',0);
    	$data = $ci -> where($where) -> select();
    	$data = $this->costinfo($data);
    	$count = count($data);
    	//var_dump($count);
    	$this->assign('count',$count);
    	//var_dump($data);
    	$this->assign('data',$data);
    	$this->assign('datas',$data);
    	
    	$this->display();
    }
    public function outboundsuc(){
    	$inboundid = $_POST['inboundid'];
    	foreach($inboundid as &$value){
    		
    		$inboundids[] = $value;
    	}
    	for($i=0;$i<count($inboundids);$i++){
    		$applyquantity[$i] = $_POST[$inboundids[$i]];
    	}
    	$dwname = $_POST['dwname'];
    	$d = M('danwei');
    	$jgh = $d ->where("dwname = '$dwname'") -> find();
    	$applyid = $_POST['applyid'];
    	
    	for($i = 0; $i < count($inboundids); $i++){
    		$data[] = array(
    		'inboundid' => $inboundids[$i],
    		'applyquantity' => $applyquantity[$i],
    		'applydwname' => $dwname,
    		'applyid' => $applyid,
    		);
    	}
    	//var_dump($inboundids,$applyquantity,$data);
    	$ci = M('costinbound');
    	$ca = M('costapply');
    	$co = M('costoutbound');
    	foreach($data as &$value){
    		$inboundid = $value['inboundid'];
    		$cirr = $ci -> where("inboundid ='$inboundid'") -> find();
    		
    		$whereci['kcquantity'] = $cirr['kcquantity'] - $value['applyquantity'];
    		$ci -> where("inboundid ='$inboundid'") -> save($whereci);
    		
    		$applyid = $value['applyid'];
    		$carr = $ca -> where("applyid ='$applyid'") -> find();
    		$whereca['sjapplyquantity'] = $carr['sjapplyquantity'] + $value['applyquantity'];
    		if($whereca['sjapplyquantity'] >= $value['applyquantity']){
    			$whereca['shenhe'] = '已出库';
    		}else{
    			//$whereca['shenhe'] = '出库中';
    		}
    		$ca -> where("applyid ='$applyid'") ->save($whereca);
    		
    		$whereco['productid'] = $cirr['productid'];
    		$whereco['applyid'] = $value['applyid'];
    		$whereco['warehouseid'] = $cirr['warehouseid'];
    		$whereco['pwid'] = $cirr['productid'].$cirr['warehouseid'];
    		$whereco['applyjgh'] = $jgh['jgh'];
    		$whereco['inboundid'] = $cirr['inboundid'];
    		$whereco['applyquantity'] = $carr['applyquantity'];
    		$whereco['sjapplyquantity'] = $value['applyquantity'];
    		$whereco['kcapplyquantity'] = $value['applyquantity'];
    		$whereco['date'] = date('Y-m-d');
    		$whereco['shenhe'] = '出库中';
    		$corr = $co -> add($whereco);
    	}
    	if($corr > 0){
    		$this->success('出库成功,请继续',U('Index/outbound'));
    	}else{
    		$this->error('出库失败,请检查数据');
    	}
    }
    public function applyproductconfirm(){
    	$dwname = cookie('dwname');
    	$this->assign('dwname',$dwname);
    	//var_dump($dwname);
    	$where['applyjgh'] = $dwname['jgh'];
    	$where['shenhe'] = '出库中';
    	$co = M('costoutbound');
    	$data = $co -> where($where) -> order('date desc') -> field('applyid,productid,warehouseid,applyquantity,date,applyjgh,sum(sjapplyquantity) as sumsjapplyquantity') -> group('applyid,productid,applyquantity,warehouseid,applyjgh,date') -> select();
    	//var_dump($corr);
    	$data = $this->costinfo($data);
    	$this->assign('data',$data);
    	$today = date("Y-m-d",strtotime("-2 day"));
    	$this->assign('today',$today);
    	$this->display();
    	//var_dump($data);
    }
    public function outbounderror(){
    	$applyquantity = $_POST['applyquantity'];
    	if($applyquantity < 0 or $applyquantity == null){
    		$this->error('请输入正常的实际到货数量');
    	}
    	$where['applyid'] = $_POST['applyid'];
    	$where['shenhe'] = '出库中';
    	$whereco['shenhe'] = '未出库';
    	$whereco['applyid'] = $_POST['applyid'].'-1';
    	$co = M('costoutbound');
    	$corr = $co -> where($where) -> select();
    	
    	foreach($corr as &$value){
    		if($value['sjapplyquantity'] == $value['kcapplyquantity']){
    			
    		}else{
    			$this->error('此订单已出货,请先处理后再提出疑议');
    		}
    	}
    	
    	$cor =$co -> where($where) -> save($whereco);
    	if($cor > 0){
    		$wherecoo['applyid'] = $_POST['applyid'];
	    	
	    	$whereca['shenhe'] = '审核同意';
	    	$whereca['sjapplyquantity'] = null;
	    	$whereca['remark'] = '出库信息有误'.$_POST['sumsjapplyquantity'].',实际只到货数量:'.$applyquantity;
	    	$ca = M('costapply');
	    	$car = $ca -> where($wherecoo) -> save($whereca);
	    	if($car > 0){
	    		//通关出库信息找到入库信息并进行数据更改;
	    		$ci = M('costinbound');
	    		foreach($corr as &$value){
		    		$inboundid = $value['inboundid'];
		    		$cirr = $ci -> where("inboundid = $inboundid") -> find();
		    		$whereci['kcquantity'] = $cirr['kcquantity'] + $value['sjapplyquantity'];
		    		$cir = $ci -> where("inboundid = $inboundid") -> save($whereci);
		    	}
	    	}
    	}
    	if($cor >0 and $car >0 and $cir >0){
    		$this -> success('提出的疑议已反馈给仓库方,请等待');
    	}else{
    		$this -> error('提交失败,请检查数据');
    	}
    }
    public function inboundbill(){
    	$dwname = cookie('dwname');
    	$where['dwname'] = $dwname['jgh'];
    	$where['shenhebill'] = '未审核';
    	
    	$ci = M('costinbound');
    	$data = $ci -> where($where) -> select();
    	$data = $this -> costinfo($data);
    	//var_dump($data);
    	foreach($data as &$value){
    		$value['vatprice'] = $value['vatprice']*100;
    		$value['vatfill'] = $value['vatfill']*100;
    	}
    	$this -> assign('data',$data);
    	$this -> display();
    }
    public function inboundbills(){
    	//var_dump($_POST);
    	$inboundid = $_POST['inboundid'];
    	$vatfill = $_POST['vatfill']/100;
    	$ci = M('costinbound');
    	$where['inboundid'] = $inboundid;
    	$whereci['vatfill'] = $vatfill;
    	$whereci['vat'] = $_POST['vat'];
    	$whereci['totalprice'] = $_POST['sjquantity'] * $_POST['unitprice'] - ($_POST['sjquantity']*$_POST['unitprice']*($_POST['vatprice']/100 + $vatfill));
    	$whereci['shenhebill'] = '已审核';
    	$cirr = $ci -> where($where) -> save($whereci);
    	if($cirr > 0){
    		$this->success('发票补足成功,请继续操作');
    	}else{
    		$this->error('发票补足失败,请检查数据');
    	}
    }
    public function dwoutbound(){
    	$wherecp['producttype'] = array('eq',2);
    	$cp = M('costproduct');
    	$cprr = $cp -> field('productid') -> where($wherecp) -> select();
    	foreach($cprr as &$value){
    		$productid[] = $value['productid'];
    	}
    	$dwname = cookie('dwname');
    	$whereco['applyjgh'] = $dwname['jgh'];
    	$whereco['productid'] = array('in',$productid);
    	$whereco['kcapplyquantity'] = array('gt',0);
    	$whereco['shenhe'] = '出库中';
    	$co = M('costoutbound');
    	$data = $co -> distinct (true) -> where($whereco) -> field('productid') -> order('productid asc') -> select();
    	//var_dump($dwname);
    	$data = $this->costinfo($data);
    	//var_dump($data);
    	$this->assign('data',$data);
    	$this->assign('dwname',$dwname);
    	$this->display();
    }
    public function dwoutbounds(){
    	$productid = $_GET;
    	if($_GET['warehouseid'] == null){
    		
    	}else{
    		$whereco['warehouseid'] = $_GET['warehouseid'];
    	}
    	
    	$dwname = cookie('dwname');
    	$whereco['applyjgh'] = $dwname['jgh'];
    	//var_dump($id);
    	$whereco['productid'] = array('in',$productid);
    	
    	$whereco['shenhe'] = '出库中';
    	$whereco['kcapplyquantity'] = array('gt',0);
    	$co = M('costoutbound');
    	$data = $co -> where($whereco) -> order('productid asc') -> select();
    	$data = $this->costinfo($data);
    	//var_dump($data);
    	$this->assign('data',$data);
    	$this->assign('datas',$data);
    	$this->display();
    }
    public function dwoutboundsuc(){
    	$outboundid = $_POST['outboundid'];
    	$outquantity = $_POST[$_POST['outboundid']];
    	foreach($outboundid as &$value){
    		$dwoutboundid[] = $value;
    		$outquantity[] = $_POST[$value];
    	}
    	$co = M('costoutbound');
    	$cdo = M('costdwoutbound');
    	//出库记录,减去实际库存,添加新的出库记录;
    	
    	//需要签名的序号；
    	$dwobid = array();
    	
    	for($i=0;$i<count($outboundid);$i++){
    		$whereco['outboundid'] = $dwoutboundid[$i];
    		$corr = $co -> where($whereco) -> find();
    		$where['kcapplyquantity'] = $corr['kcapplyquantity'] - $outquantity[$i];
    		//var_dump($where);
    		$cor = $co -> where($whereco) -> save($where);
    		
    		$wherecdo['outboundid'] = $dwoutboundid[$i];
    		$wherecdo['outquantity'] = $outquantity[$i];
    		$wherecdo['date'] = date('Y-m-d');
    		$wherecdo['productid'] = $corr['productid'];
    		$wherecdo['warehouseid'] = $corr['warehouseid'];
    		$wherecdo['pwid'] = $corr['productid'].$corr['warehouseid'];
    		$wherecdo['inboundid'] = $corr['inboundid'];
    		$wherecdo['outjgh'] = $corr['applyjgh'];
    		$wherecdo['shenhe'] = '出库中';
    		
    		$cdor = $cdo -> add($wherecdo);
    		$dwobid[] = $cdor;
    	}
    	session('dwobid',$dwobid);
    	if($cdor > 0){
//  		$this->success('出库成功,请继续',U('Index/autograph',array('dwoutboundid'=>$cdor),''));
			$this->success('出库成功，请继续',U('Index/autograph'));
			
			
			
    	}else{
    		$this->error('出库失败,请检查数据');
    	}
    }
    public function dwoutboundmodify(){
    	$dwname = cookie('dwname');
    	$where['shenhe'] = '出库中';
    	$where['outjgh'] = $dwname['jgh'];
    	$cdo = M('costdwoutbound');
    	$data = $cdo -> where($where) -> select();
    	$data = $this -> costinfo($data);
    	$this -> assign('data',$data);
    	$this->display();
    }
    public function dwoutboundsearchs(){
    	$dwname = cookie('dwname');
    	$date = substr($_POST['date_date'],0,10);
    	$dates = substr($_POST['date_date'],-10,10);
    	$where['date'] = array( array('egt',$date) , array('elt',$dates) , 'and' );
    	$where['shenhe'] = '出库中';
    	$where['outjgh'] = $dwname['jgh'];
    	$cdo = M('costdwoutbound');
    	$data = $cdo -> where($where) -> select();
    	$data = $this -> costinfo($data);
    	$this -> assign('data',$data);
    	$this->display();
    }
    public function dwoutboundres(){
    	$dwoutboundid = $_GET['dwoutboundid'];
    	//var_dump($dwoutboundid);
    	$cdo = M('costdwoutbound');
    	$cdorr = $cdo -> where("dwoutboundid = '$dwoutboundid'") -> find();
    	$outboundid = $cdorr['outboundid'];
    	$outquantity = $cdorr['outquantity'];
    	$co = M('costoutbound');
    	$corr = $co -> where("outboundid = '$outboundid'") -> find();
    	$whereco['kcapplyquantity'] = $corr['kcapplyquantity'] + $outquantity;
    	$corr = $co -> where("outboundid = '$outboundid'") -> save($whereco);
    	$wherecdo['shenhe'] = '未出库';
    	$cdorr = $cdo -> where("dwoutboundid = '$dwoutboundid'") -> save($wherecdo);
    	if($cdorr > 0){
    		$this->success('产品冲正成功,请继续');
    	}else{
    		$this->error('产品冲正不成功,请检查数据');
    	}
    }
    public function dwoutallot(){
    	$d = M('danwei');
    	$drr = $d -> where("jiagou = 'A1'") -> select();
    	$this->assign('drr',$drr);
    	
    	$wherecp['producttype'] = array('eq',2);
    	$cp = M('costproduct');
    	$cprr = $cp -> field('productid') -> where($wherecp) -> select();
    	foreach($cprr as &$value){
    		$productid[] = $value['productid'];
    	}
    	$dwname = cookie('dwname');
    	$whereco['applyjgh'] = $dwname['jgh'];
    	$whereco['productid'] = array('in',$productid);
    	$whereco['kcapplyquantity'] = array('gt',0);
    	$whereco['shenhe'] = '出库中';
    	$co = M('costoutbound');
    	$data = $co -> distinct (true) -> where($whereco) -> field('productid') -> order('productid asc') -> select();
    	//var_dump($dwname);
    	$data = $this->costinfo($data);
    	//var_dump($data);
    	$this->assign('data',$data);
    	$this->assign('dwname',$dwname);
    	$this->display();
    }
    public function dwoutallots(){
    	$productid = $_GET;
    	if(count($productid) == 1){
    		$this->error('请选择要调拨的产品');
    	}
    	for($i = 0;$i < count($productid)-1;$i++){
    		$productids[] = $productid[$i];
    	}
    	$jgh = $_GET['jgh'];
    	cookie('jgh',$jgh);
    	//var_dump(cookie('jgh'));
    	$dwname = cookie('dwname');
    	$whereco['applyjgh'] = $dwname['jgh'];
    	//var_dump($id);
    	$whereco['productid'] = array('in',$productids);
    	//$whereco['shenhe'] = array(array('eq','出库中'),array('eq','待调拨'),'or');
    	$whereco['shenhe'] = '出库中';
    	$whereco['kcapplyquantity'] = array('gt',0);
    	//var_dump($whereco);
    	$co = M('costoutbound');
    	$data = $co -> where($whereco) -> field('outboundid,applyid,pwid,productid,warehouseid,kcapplyquantity,inboundid,applyjgh') -> order('productid asc') -> select();
    	
    	$coa = M('costoutallot');
    	$wherecoa['applyjgh'] = $dwname['jgh'];
    	$wherecoa['shenhe'] = '待调拨';
    	$wherecoa['kcapplyquantity'] = array('gt',0);
    	$coarr = $coa -> where($wherecoa) -> field('outboundid,pwid,productid,warehouseid,sum(kcapplyquantity) as sumkc,inboundid,applyjgh') -> group('outboundid,pwid,productid,warehouseid,inboundid,applyjgh') -> order('productid asc') -> select();
    	
    	foreach($data as &$value){
    		
    		foreach($coarr as &$valuecoa){
    			
    			if($value['outboundid'] == $valuecoa['outboundid']){
    				
    				$value['kcapplyquantity'] = $value['kcapplyquantity'] - $valuecoa['sumkc'];
    			}
    		}
    	}
    	//var_dump($data);
    	
    	$data = $this->costinfo($data);
    	
    	$this->assign('data',$data);
    	$this->assign('datas',$data);
    	$this->display();
    }
    public function dwoutallotsuc(){
    	$outboundid = $_POST['outboundid'];
    	$outquantity = $_POST[$_POST['outboundid']];
    	foreach($outboundid as &$value){
    		$dwoutboundid[] = $value;
    		$outquantity[] = $_POST[$value];
    	}
    	$co = M('costoutbound');
    	$coa = M('costoutallot');
    	//出库记录,减去实际库存,添加新的出库记录;
    	//var_dump($dwoutboundid,$outquantity);
    	for($i=0;$i<count($outboundid);$i++){
    		$whereco['outboundid'] = $dwoutboundid[$i];
    		$corr = $co -> where($whereco) -> find();
    		
    		$where['outboundid'] = $corr['outboundid'];
    		$where['applyid'] = $corr['applyid'];
    		$where['productid'] = $corr['productid'];
    		$where['warehouseid'] = $corr['warehouseid'];
    		$where['pwid'] = $corr['pwid'];
    		$where['applyjgh'] = $corr['applyjgh'];
    		$where['inboundid'] = $corr['inboundid'];
    		$where['applyquantity'] = 0;
    		$where['sjapplyquantity'] = $outquantity[$i];
    		$where['kcapplyquantity'] = $outquantity[$i];
    		$where['shenhe'] = '待调拨';
    		$where['date'] = date('Y-m-d');
    		$where['tojgh'] = cookie('jgh');
    		//var_dump($where);
    		$coar = $coa -> add($where);
    		
    	}
    	if($coar > 0){
    		$this->success('调拨等待接收,请继续');
    	}else{
    		$this->error('调拨失败,请检查数据');
    	}
    }
    public function dwinallot(){
    	$dwname = cookie('dwname');
    	$coa = M('costoutallot');
    	$where['shenhe'] = '待调拨';
    	$where['kcapplyquantity'] = array('gt',0);
    	$where['tojgh'] = $dwname['jgh'];
    	$coarr = $coa -> where($where) -> select();
    	$coarr = $this->costinfo($coarr);
    	$this->assign('data',$coarr);
//    	var_dump($coarr);
    	
    	$this->display();
    }
    public function dwinallotsuc(){
    	//var_dump($_GET['outallotid']);
    	$dwname = cookie('dwname');
    	$outallotid = $_GET['outallotid'];
    	$where['shenhe'] = '已调拨';
    	$where['dateout'] = date('Y-m-d');
    	$coa = M('costoutallot');
    	$coarr = $coa -> where("outallotid = '$outallotid'") -> find();
    	$coar = $coa -> where("outallotid = '$outallotid'") -> save($where);
    	
    	$co = M('costoutbound');
    	
    	$wherecor['applyid'] = $coarr['applyid'];
    	$wherecor['productid'] = $coarr['productid'];
    	$wherecor['warehouseid'] = $coarr['warehouseid'];
    	$wherecor['pwid'] = $coarr['pwid'];
    	$wherecor['applyjgh'] = $dwname['jgh'];
    	$wherecor['inboundid'] = $coarr['inboundid'];
    	$wherecor['applyquantity'] = $coarr['applyquantity'];
    	$wherecor['sjapplyquantity'] = $coarr['sjapplyquantity'];
    	$wherecor['kcapplyquantity'] = $coarr['kcapplyquantity'];
    	$wherecor['date'] = date('Y-m-d');
    	$wherecor['shenhe'] = '出库中';
    	$cor = $co -> add($wherecor);
    	
    	
    	$outboundid = $coarr['outboundid'];
    	$kc = $coarr['kcapplyquantity'];
    	$whereco['kcapplyquantity'] = array('exp',"kcapplyquantity - $kc");
    	//$whereco['sjapplyquantity'] = array('exp',"sjapplyquantity - $kc");
    	//var_dump($whereco);
    	$corr = $co -> where("outboundid = '$outboundid'") -> save($whereco);
    	if($corr > 0){
    		$this->success('产品调拨成功，请继续');
    		
    	}else{
    		$this->error('产品调拨失败，请检查数据');
    	}
    }
    public function dwinalloterr(){
    	//var_dump($_GET['outallotid']);
    	$outallotid = $_GET['outallotid'];
    	$where['shenhe'] = '未审核';
    	$where['dateout'] = date('Y-m-d');
    	$coa = M('costoutallot');
    	$coarr = $coa -> where("outallotid = '$outallotid'") -> save($where);
    	if($coarr > 0){
    		$this->success('调拨取消成功，请继续');
    	}else{
    		$this->error('调拨取消失败，请检查数据');
    	}
    }
    public function dwallotsearchs(){
    	$dwname = cookie('dwname');
    	$allot = $_POST['allot'];
    	if($allot == 'out'){
    		$where['applyjgh'] = $dwname['jgh'];
    	}else{
    		$where['tojgh'] = $dwname['jgh'];
    	}
    	$date = substr($_POST['date_date'],0,10);
    	$dates = substr($_POST['date_date'],-10,10);
    	$where['date'] = array( array('egt',$date) , array('elt',$dates) , 'and' );
    	
    	$coa = M('costoutallot');
    	$coarr = $coa -> where($where) -> select();
    	$data = $this->costinfo($coarr);
    	$this->assign('data',$data);
    	$this->display();
    }
    public function warehousereport(){
    	$dwname = cookie('dwname');
    	$jgh = $dwname['jgh'];
    	
    	$where['applyjgh'] = $jgh;
    	$where['kcapplyquantity'] = array('gt',0);
    	$where['shenhe'] = '出库中';
    	$co = M('costoutbound');
    	$data = $co -> where($where) -> field('applyjgh,productid,warehouseid,pwid,sum(kcapplyquantity) as sumkcapplyquantity') -> group('productid,warehouseid,applyjgh,pwid') -> select();
    	
    	$data = $this->costinfo($data);
    	
    	$this->assign('data',$data);
    	$this->display();
    }
    public function backlog(){
    	$dwname = cookie('dwname');
    	$ca = M('costapply');
    	$whereca['shenhe'] = '未审核';
    	$whereca['jgh'] = $dwname['jgh'];
    	$applycount = $ca -> where($whereca) -> count();
    	$this->assign('applycount',$applycount);
    	
		$jgh = $dwname['jgh'];
    	$ci = M('costinbound');
    	$whereci['jgh'] = $jgh;
    	$whereci['shenhe'] = array('neq','已审核');
    	$cw = M('costwarehouse');
    	$cwrr = $cw -> field('warehouseid') -> where("warehousedwname = '$jgh'") -> select();
    	foreach($cwrr as &$value){
    		$cwr[] = $value['warehouseid'];
    	}
    	$whereci['warehouseid'] = array('in',$cwr);
    	$inboundcount = $ci -> where($whereci) -> count();
		$this->assign('inboundcount',$inboundcount);
		
		$jgh = $dwname['jgh'];
    	$whereco['shenhe'] = '审核同意';
    	
    	//$cw = M('costwarehouse');
    	$cwrr = $cw -> field('warehouseid') -> where("warehousedwname = '$jgh'") -> select();
    	foreach($cwrr as &$value){
    		$cwrrr[] = $value['warehouseid'];
    	}
    	$whereco['warehouseid'] = array('in',$cwrrr);
    	$outboundcount = $ca -> where($whereco) -> count();
		$this->assign('outboundcount',$outboundcount);
		
    	$this->display();
    }
    public function jrywbqxsearch(){
    	$cz = M('costzero');
    	$czrr = $cz -> select();
    	
    	$this->assign('czrr',$czrr);
    	$this->display();
    }
    public function jrywbqxsearchs(){
    	$date = $_GET['date'];
    	$dates = $_GET['dateo'];
    	//var_dump($date,$dateo);
    	
    	$where['remark'] = '0库存申请调配';
    	$where['shenhe'] = '已出库';
    	$where['date'] = $where['date'] = array( array('egt',$date) , array('elt',$dates) , 'and' );
    	
    	$ca = M('costapply');
    	$carr= $ca -> where($where) -> select();
    }
    
    
    
    
    
    
    public function autograph(){
    	//只取一个参数的；
    	//$dwid = $_GET['dwoutboundid'];
    	//$this->assign('url',$dwid);
    	
    	$this->display();
    }
        
    public function graphsuc(){
    	$dwobid = session('dwobid');
    	for($i = 0 ; $i < count($dwobid) ; $i++){
    		$dwid = $dwobid[$i];
    		$where['autograph'] = $_POST['src_data'];
	    	$where['sfz'] = $_POST['sfz'];
	    	$where['custtype'] = $_POST['custtype'];
	    	$cdo = M('costdwoutbound');
	    	$cdorr = $cdo -> where("dwoutboundid = '$dwid'") -> save($where);
    	}
    	//session('dwobid',null);
    	if($cdorr > 0){
    		echo "签名成功";
    	}else{
    		echo "签名失败";
    	}
    }
    
    
    
    
    
    
    
    
    
    
    
    public function financereportall(){
    	$cdo = M('costdwoutbound');
    	$where['shenhe'] = '出库中';
    	$cdorr = $cdo -> where($where) -> field('outjgh,productid,inboundid,sum(outquantity) as sumoutquantity') -> group('outjgh,productid,inboundid') -> select();
    	$ci = M('costinbound');
    	$whereci['sjquantity'] = array('gt',0);
    	$cirr = $ci -> where($whereci) -> select();
    	//var_dump($cdorr,$cirr);
    	foreach($cdorr as &$valueco){
    		
    		foreach($cirr as &$valueci){
    			
    			if($valueco['inboundid'] == $valueci['inboundid']){
    				
    				$valueco['totalprice'] = round($valueci['unitprice'] * $valueco['sumoutquantity'] - ($valueci['unitprice'] * $valueco['sumoutquantity'] * ($valueci['vatprice'] + $valueci['vatfill'])),2);
    				 
    			}
    		}
    	}
    	$where['jiagou'] = array('in','A1,A2,A5,A6');
    	$d = M('danwei');
    	$drr = $d -> where($where) -> order('yjgh asc') -> select();
    	//var_dump($drr);
    	
    	foreach($drr as &$valued){
    		$valued['totalprice'] = 0;
    		foreach($cdorr as &$valueco){
    			
    			if($valued['jgh'] == $valueco['outjgh']){
    				
    				$valued['totalprice'] += $valueco['totalprice'];
    			}
    		}
    	}
    	$this->assign('data',$drr);
    	$this->display();
    }
    
    public function financereport(){
    	//2是礼品;出库后才能算费用;
    	$wherecp['producttype'] = array('neq',2);
    	$cp = M('costproduct');
    	$cprr = $cp -> field('productid') -> where($wherecp) -> select();
    	foreach($cprr as &$value){
    		$productid[] = $value['productid'];
    	}
    	//var_dump($productid);
    	$co = M('costoutbound');
    	$whereco['productid'] = array('in',$productid);
    	$whereco['shenhe'] = '出库中';
    	$corr = $co -> field('applyjgh,inboundid,productid,sum(sjapplyquantity) as sumsjapplyquantity') -> where($whereco) -> group('applyjgh,inboundid,productid') -> select();
    	//var_dump($corr);
    	$cdo = M('costdwoutbound');
    	$where['shenhe'] = '出库中';
    	$cdorr = $cdo -> where($where) -> field('outjgh,productid,inboundid,sum(outquantity) as sumoutquantity') -> group('outjgh,productid,inboundid') -> select();
    	
    	$ci = M('costinbound');
    	$whereci['sjquantity'] = array('gt',0);
    	$cirr = $ci -> where($whereci) -> select();
    	foreach($corr as &$valueco){
    		
    		foreach($cirr as &$valueci){
    			
    			if($valueco['inboundid'] == $valueci['inboundid']){
    				
    				$valueco['totalprice'] = round($valueci['unitprice'] * $valueco['sumsjapplyquantity'] - ($valueci['unitprice'] * $valueco['sumsjapplyquantity'] * ($valueci['vatprice'] + $valueci['vatfill'])),2);
    				 
    			}
    		}
    	}
    	
    	foreach($cdorr as &$valueco){
    		
    		foreach($cirr as &$valueci){
    			
    			if($valueco['inboundid'] == $valueci['inboundid']){
    				
    				$valueco['totalprice'] = round($valueci['unitprice'] * $valueco['sumoutquantity'] - ($valueci['unitprice'] * $valueco['sumoutquantity'] * ($valueci['vatprice'] + $valueci['vatfill'])),2);
    				 
    			}
    		}
    	}
    	
    	
    	$where['jiagou'] = array('in','A1,A2,A5,A6');
    	$d = M('danwei');
    	$drr = $d -> where($where) -> order('yjgh asc') -> select();
    	//var_dump($drr);
    	
    	foreach($drr as &$valued){
    		$valued['totalprice'] = 0;
    		foreach($corr as &$valueco){
    			
    			if($valued['jgh'] == $valueco['applyjgh']){
    				
    				$valued['totalprice'] += $valueco['totalprice'];
    			}
    		}
    	}
    	foreach($drr as &$valued){
    		foreach($cdorr as &$valuecdo){
    			
    			if($valued['jgh'] == $valuecdo['outjgh']){
    				
    				$valued['totalprice'] += $valuecdo['totalprice'];
    			}
    		}
    	}
    	$this->assign('data',$drr);
    	$this->display();
    	//var_dump($drr);
    }
    
	public function warehouseall(){
		$dwname = cookie('dwname');
		$where['dwname'] = $dwname['jgh'];
		$where['sjquantity'] = array('gt',0);
		
    	$ci = M('costinbound');
    	$data = $ci -> where($where) -> field('productid,warehouseid,sum(kcquantity) as sumkcquantity') -> group('productid,warehouseid') -> select();
    	$data = $this -> costinfo($data);
    	//var_dump($data);
    	
    	$citotal = $ci -> where($where) -> field('productid,sum(kcquantity) as sumkcquantity') -> group('productid') -> select();
    	//var_dump($citotal);
    	
    	$cp = M('costproduct');
    	$cprr = $cp -> select();
    	$cw = M('costwarehouse');
    	$cwrr = $cw -> select();
    	$this->assign('cwrr',$cwrr);
		
    	foreach($cprr as &$valuecp){
    		
    		foreach($cwrr as &$valuecw){
    			
    			foreach($data as &$value){
    				
    				if($valuecp['productid'] == $value['productid'] and $valuecw['warehouseid'] == $value['warehouseid']){
    					$datas[$valuecp['productid']][$valuecw['warehouseid']] = $value['sumkcquantity'];
    					$datas[$valuecp['productid']]['productname'] = $value['productname'];
    					$datas[$valuecp['productid']]['productid'] = $value['productid'];
    					//$datas[$valuecp['productid']]['zj'] = 
    					//var_dump($value);
    				}
    			}
    		}
    	}				
    	foreach($cwrr as &$valuecw){
    		$cwr[] = $valuecw['warehouseid'];
    	}
    	$this->assign('ware',$cwr);
    	foreach($datas as &$values){
    		foreach($citotal as &$valueci){
    			if($values['productid'] == $valueci['productid']){
    				$values['total'] = $valueci['sumkcquantity'];
    			}
    		}
    	}
    	$this->assign('data',$datas);
    	//var_dump($data);
    	$this->display();
    }
    public function productall(){
    	$dwname = cookie('dwname');
    	$warehousedwname = $dwname['jgh'];
    	//var_dump($dwname);
    	$cw = M('costwarehouse');
    	$cwrr = $cw -> where("warehousedwname = '$warehousedwname'") -> select();
    	
    	foreach($cwrr as &$value){
    		$cwr[] = $value['warehouseid'];
    	}
    	//var_dump($cwr);
    	$where['warehouseid'] = array('in',$cwr);
    	//$where['dwname'] = $dwname['jgh'];
		$where['sjquantity'] = array('gt',0);
    	$ci = M('costinbound');
    	$data = $ci -> where($where) -> field('productid,warehouseid,sum(kcquantity) as sumkcquantity') -> group('productid,warehouseid') -> select();
    	$data = $this -> costinfo($data);
    	//var_dump($data);
    	
    	$citotal = $ci -> where($where) -> field('productid,warehouseid,sum(kcquantity) as sumkcquantity') -> group('productid,warehouseid') -> select();
    	//var_dump($citotal);
    	
    	$cp = M('costproduct');
    	$cprr = $cp -> select();
    	$cw = M('costwarehouse');
    	$cwrr = $cw -> where("warehousedwname = '$warehousedwname'") -> select();
    	$this->assign('cwrr',$cwrr);
		
    	foreach($cprr as &$valuecp){
    		
    		foreach($cwrr as &$valuecw){
    			
    			foreach($data as &$value){
    				
    				if($valuecp['productid'] == $value['productid'] and $valuecw['warehouseid'] == $value['warehouseid']){
    					$datas[$valuecp['productid']][$valuecw['warehouseid']] = $value['sumkcquantity'];
    					$datas[$valuecp['productid']]['productname'] = $value['productname'];
    					$datas[$valuecp['productid']]['productid'] = $value['productid'];
    					//$datas[$valuecp['productid']]['zj'] = 
    					//var_dump($value);
    				}
    			}
    		}
    	}
    	$this->assign('ware',$cwr);
    	foreach($datas as &$values){
    		foreach($citotal as &$valueci){
    			if($values['productid'] == $valueci['productid']){
    				$values['total'] = $valueci['sumkcquantity'];
    			}
    		}
    	}
    	$this->assign('data',$datas);
    	//var_dump($data);
    	$this->display();
    }
    public function financewarehouse(){
    	$dwname = cookie('dwname');
		
		$where['sjquantity'] = array('gt',0);
    	$ci = M('costinbound');
    	$data = $ci -> where($where) -> field('productid,warehouseid,sum(kcquantity) as sumkcquantity') -> group('productid,warehouseid') -> select();
    	$data = $this -> costinfo($data);
    	//var_dump($data);
    	$citotal = $ci -> where($where) -> field('productid,sum(kcquantity) as sumkcquantity') -> group('productid') -> select();
    	
    	$cp = M('costproduct');
    	$cprr = $cp -> select();
    	$cw = M('costwarehouse');
    	$cwrr = $cw -> select();
    	$this->assign('cwrr',$cwrr);

    	foreach($cprr as &$valuecp){
    		
    		foreach($cwrr as &$valuecw){
    			
    			foreach($data as &$value){
    				
    				if($valuecp['productid'] == $value['productid'] and $valuecw['warehouseid'] == $value['warehouseid']){
    					$datas[$valuecp['productid']][$valuecw['warehouseid']] = $value['sumkcquantity'];
    					$datas[$valuecp['productid']]['productname'] = $value['productname'];
    					$datas[$valuecp['productid']]['productid'] = $value['productid'];
    					//var_dump($value);
    				}
    			}
    		}
    	}				
    	foreach($cwrr as &$valuecw){
    		$cwr[] = $valuecw['warehouseid'];
    	}
    	foreach($datas as &$values){
    		foreach($citotal as &$valueci){
    			if($values['productid'] == $valueci['productid']){
    				$values['total'] = $valueci['sumkcquantity'];
    			}
    		}
    	}
    	$this->assign('ware',$cwr);
    	$this->assign('data',$datas);
    	$this->display();
    }
    
    
    
    
    
    
    
    
    
    public function pcistats($data){
    	foreach($data as &$value){
    		if($value['stats'] == 0){
    			$value['status'] = '可领';
    			continue;
    		}
    		if($value['stats'] == 1){
    			$value['status'] = '停用';
    			continue;
    		}
    		if($value['stats'] == 2){
    			$value['status'] = '已使用';
    			continue;
    		}
    		if($value['stats'] == 3){
    			$value['status'] = '挂失申请';
    			continue;
    		}
    		if($value['stats'] == 4){
    			$value['status'] = '待审';
    			continue;
    		}
    		if($value['stats'] == 5){
    			$value['status'] = '已审';
    			continue;
    		}
    		if($value['stats'] == 6){
    			$value['status'] = '挂失';
    			continue;
			}
			if($value['stats'] == 7){
    			$value['status'] = '充值进行中';
    			continue;
			}
			if($value['stats'] == 8){
    			$value['status'] = '充值成功';
    			continue;
			}
			if($value['stats'] == 9){
    			$value['status'] = '充值失败';
    			continue;
    		}
    	}
    	return $data;
    }
    public function pointcardin(){
    	$dwname = cookie('dwname');
    	
		$cc = M('costcard');
		
		$where['jgh'] = $dwname['jgh'];
		$where['stats'] = 0;
		
		$min = $cc -> where($where) -> min('card');
		$max = $cc -> where($where) -> max('card');
		
//		var_dump($min,$max);
		$this->assign('min',$min);
		$this->assign('max',$max);
		$this->assign('dwname',$dwname);
		
		$this->display();
    }
    public function pointcardins(){
    	$dwname = cookie('dwname');
    	
    	$selectin = $_POST['selectin'];
    	
    	if($selectin == 1){
    		//选择批量领卡；
    		$min = $_POST['price_min'];
    		$max = $_POST['price_max'];
    		
    		$mins = $_POST['min'];
    		$maxs = $_POST['max'];
    		
    		$minlen = mb_strlen($min);
    		$maxlen = mb_strlen($max);
    		
    		$minlens = mb_strlen($mins);
    		$maxlens = mb_strlen($maxs);
    		//长度相同，否则报错；最小值大于最大值报错；
    		if($min == $mins and $max <= $max and $maxlen == $maxlens){
    			
    			for($i = $min ; $i <= $max ; $i++){
    			
		    		$card[] = array(
		    			
		    			'card' => $i,
		    			'dwname' => $dwname['username'],
		    			'jgh' => $dwname['jgh'],
		    			'date' => date('Y-m-d'),
		    			'stats' => 4,
		    		);
		    		$cards[] = $i;
		    	}
    			
    			$cc = M('costcard');
    			$where['card'] = array('in',$cards);
    			$ccr = $cc -> where($where) -> select();
    			//获取cardid
    			foreach($ccr as &$value){
    				
    				foreach($card as &$val){
    					
    					if($value['card'] == $val['card']){
    						
    						$val['cardid'] = $value['cardid'];
    						break;
    					}
    				}
    			}
    			
    			$cci = M('costcardin');
    			$ccir = $cci -> addall($card);
    			
    			for($i = $min ; $i <= $max ; $i++){
    				
    				$stats['stats'] = 4;
    				$ccm = $cc -> where("card = '$i'") -> save($stats);
    				
    			}
    			
    			if($ccir > 0){
    				$this->success('请领成功，请继续');
    			}else{
    				$this->error('请领失败，请检查数据');
    			}
    			
    		}else{
    			
    			$this->error('积分卡请领有误，请确认后再领');
    			
    		}
    	}else{
    		//选择单张领卡；
    		$min = $_POST['price'];
    		$mins = $_POST['min'];
    		
    		if($min == $mins){
    			
    			var_dump($min,$mins);
    			
    		}else{
    			
    			$this->error('积分卡请领有误，请确认后再领');
    		}
    		
    	}
    }
    public function pointcardedit(){
    	$dwname = cookie('dwname');
    	
    	$where['dwname'] = $dwname['username'];
    	
		$cci = M('costcardin');
		
		$ccir = $cci -> where($where) -> select();
		
		$this->assign('ccir',$ccir);
		
		$ccs = M('costcardstats');
		$ccsr = $ccs -> where("stats = 0") -> select();

		$this->assign('ccsr',$ccsr);

    	$this->display();
    }
    public function pointcardedits(){
    	$limit = $_GET['limit'];
    	$page = $_GET['page'];
    	$first = $limit * ($page-1);
    	
    	$kh = $_GET['stats'];
    	$wd = $_GET['card'];
    	$date = $_GET['date'];
    	if($wd == null){
    		
    	}else{
    		$where['card'] = $wd;
    	}
    	
    	if($kh == null){
    		
    	}else{
    		$where['stats'] = $kh;
    	}
    	
    	if($date == null){
    		
    	}else{
    		$where['date'] = $date;
    	}
    	$dwname = cookie('dwname');
    	$where['jgh'] = $dwname['jgh'];
    	$cci = M('costcardin');
//  	$where['jgh'] = $jgh;
//  	$where['stats'] = 4;
    	$ccir = $cci -> limit($first,$limit) -> where($where) -> select();
    	
    	$d = M('danwei');
    	$drr = $d -> where("jiagou = 'A1'") -> select();
    	
    	foreach($ccir as &$value){
    		
    		foreach($drr as &$val){
    			
    			if($value['jgh'] == $val['jgh']){
    				
    				$value['dwnames'] = $val['dwname'];
    				break;
    			}
    		}
    		
    	}
    	
    	$ccir = $this->pcistats($ccir);

    	$count = $cci -> where($where) -> count();
    	
    	$data = json_encode($ccir);
    	$json = '{"code":0,"msg":"","count":'.$count.',"data":'.$data.'}';
    	
    	echo $json;
    }
    public function pointcardout(){
    	$cci = M('costcardin');
		
		$dwname = cookie('dwname');
		$where['dwname'] = $dwname['username'];
		$where['stats'] = 5;
		
		$ccir = $cci -> where($where) -> select();
		
		$this->assign('ccir',$ccir);
		
    	$this->display();
    }
    public function pointcardouts(){
    	$limit = $_GET['limit'];
    	$page = $_GET['page'];
    	$first = $limit * ($page-1);
    	
    	$kh = $_GET['stats'];
    	$wd = $_GET['card'];
    	$date = $_GET['date'];
    	if($wd == null){
    		
    	}else{
    		$where['card'] = $wd;
    	}
    	
    	if($kh == null){
    		
    	}else{
    		$where['stats'] = $kh;
    	}
    	
    	if($date == null){
    		
    	}else{
    		$where['date'] = $date;
    	}
    	$dwname = cookie('dwname');
    	$where['jgh'] = $dwname['jgh'];
    	$cci = M('costcardin');
//  	$where['jgh'] = $jgh;
    	$where['stats'] = 5;
    	$ccir = $cci -> limit($first,$limit) -> where($where) -> select();
    	
    	$d = M('danwei');
    	$drr = $d -> where("jiagou = 'A1'") -> select();
    	
    	foreach($ccir as &$value){
    		
    		foreach($drr as &$val){
    			
    			if($value['jgh'] == $val['jgh']){
    				
    				$value['dwnames'] = $val['dwname'];
    				break;
    			}
    		}
    		
    	}
    	
    	$ccir = $this->pcistats($ccir);

    	$count = $cci -> where($where) -> count();
    	
    	$data = json_encode($ccir);
    	$json = '{"code":0,"msg":"","count":'.$count.',"data":'.$data.'}';
    	
    	echo $json;
    }
    public function pointcardhair(){
    	$card['cardid'] = $_GET['cardid'];
    	$card['cardinid'] = $_GET['cardinid'];
    	$card['card'] = $_GET['card'];
    	$ccrule = M('costcardrule');
    	
    	$stats['stats'] = 0;
    	
    	$ccr = $ccrule -> where($stats) -> select();
    	$this->assign('card',$card);
    	$this->assign('ccr',$ccr);
//  	var_dump($card);
    	$this -> display();
    }
    public function pointcardhairs(){
    	$cardid = $_POST['cardid'];
    	
    	$cardinid = $_POST['cardinid'];
    	
    	$cc = M('costcard');
    	
    	$cci = M('costcardin');
    	
    	$_POST['stats'] = 2;
    	$dwname = cookie('dwname');
    	$_POST['dwname'] = $dwname['username'];
    	$_POST['jgh'] = $dwname['jgh'];
    	$_POST['date'] = date('Y-m-d');
    	$cco = M('costcardout');
    	
//  	var_dump($_POST);
    	
    	$ccor = $cco -> add($_POST);
//  	var_dump($ccor);
    	if($ccor > 0){
    		
    		$stats['stats'] = 2;
    		
    		$cc -> where("cardid = '$cardid'") -> save($stats);
    		$cci -> where("cardinid = '$cardinid'") -> save($stats);
    		
   			$this->success('积分卡兑换成功，请等待审核');
    	}else{
    		
    		$this->error('积分卡兑换失败，请检查数据');
    	}
    }
    public function pointcardloss(){
    	$cci = M('costcardin');
		
		$dwname = cookie('dwname');
		$where['dwname'] = $dwname['username'];
		$where['stats'] = 2;
		
		$ccir = $cci -> where($where) -> select();
		
		$this->assign('ccir',$ccir);
		
    	$this->display();
    }
    public function pointcardlosss(){
    	$limit = $_GET['limit'];
    	$page = $_GET['page'];
    	$first = $limit * ($page-1);
    	
    	$kh = $_GET['stats'];
    	$wd = $_GET['card'];
    	$date = $_GET['date'];
    	if($wd == null){
    		
    	}else{
    		$where['card'] = $wd;
    	}
    	
    	if($kh == null){
    		$where['stats'] = 2;
    	}else{
    		$where['stats'] = $kh;
    	}
    	
    	if($date == null){
    		
    	}else{
    		$where['date'] = $date;
    	}
    	$dwname = cookie('dwname');
    	$where['jgh'] = $dwname['jgh'];
    	$cci = M('costcardout');
//  	$where['jgh'] = $jgh;
    	// $where['stats'] = 2;
    	$ccir = $cci -> limit($first,$limit) -> where($where) -> select();
    	
    	$d = M('danwei');
    	$drr = $d -> where("jiagou = 'A1'") -> select();
    	
    	foreach($ccir as &$value){
    		
    		foreach($drr as &$val){
    			
    			if($value['jgh'] == $val['jgh']){
    				
    				$value['dwnames'] = $val['dwname'];
    				break;
    			}
    		}
    		
    	}
    	
    	$ccir = $this->pcistats($ccir);

    	$count = $cci -> where($where) -> count();
    	
    	$data = json_encode($ccir);
    	$json = '{"code":0,"msg":"","count":'.$count.',"data":'.$data.'}';
    	
    	echo $json;
    }
    public function pointcardlosssuc(){
    	$cardoutid = $_POST['cardoutid'];
    	
    	$cardinid = $_POST['cardinid'];
    	
    	$cardid = $_POST['cardid'];
    	
    	$stats['stats'] = 3;
    	
    	$beizhu['stats'] = 3;
    	$beizhu['beizhu'] = $_POST['beizhu'];
    	
    	$cc = M('costcard');
    	
    	$cci = M('costcardin');
    	
    	$cco = M('costcardout');
    	
    	$ccr = $cc -> where("cardid = '$cardid'") -> save($stats);
    	
    	$ccir = $cci -> where("cardinid = '$cardinid'") -> save($stats);
    	
    	$ccor = $cco -> where("cardoutid = '$cardoutid'") -> save($beizhu);
    	
    	if($ccr + $ccir + $ccor > 2){
    		
    		$this->success('挂失申请成功，请等待金融部审核');
    	}else{
    		
    		$this->error('数据有误，请检查数据');
    	}
    	
//  	var_dump($_POST);
    	
    }
    public function pointcardlossdata(){
    	$card['cardid'] = $_GET['cardid'];
    	$card['cardinid'] = $_GET['cardinid'];
    	$card['cardoutid'] = $_GET['cardoutid'];
    	
    	$this->assign('card',$card);
    	
    	$this -> display();
    }
    public function pointcarddetail(){
		// var_dump($_GET);
		$data = $_GET['cardid'];
		// $datas[] = array();
		$datas = explode(',',$data);

		$where['cardid'] = array('in' , $datas);

		$cco = M('costcardout');

		$ccor = $cco -> where($where) -> select();

		$data = $this->pcistats($ccor);

		foreach($data as &$value){

			$value['point'] = $value['rule'] * $value['money'];

		}

		$this->assign('data',$data);

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
}