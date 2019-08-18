<?php
namespace Home\Controller;
//namespace Org\Net;
use Think\Controller;
class AdminController extends Controller {
	public function _initialize(){
    	$dwname = cookie('dwname');
		$this->assign('user',$dwname);
    	if($dwname['qx'] == null){
    		$this->error('您还未登录,请登录后再操作',U('Login/login'),1);
    	}else{
    		
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
    public function costinfo($data){
    	//费用分摊对数据批量处理;
		
    	$cp = M('costproduct');
    	$cprr = $cp -> select();
    	foreach($data as &$value){
    		foreach($cprr as &$valued){
    			if($value['productid'] == $valued['productid']){
    				$value['productname'] = $valued['productname'];
    				$value['dwname'] = $valued['productdwname'];
    				$value['producttype'] = $valued['producttype'];
    				continue;
    			}
    		}
    	}
    	
    	$d = M('danwei');
    	$drr = $d -> select();
    	foreach($data as &$value){
    		foreach($drr as &$valued){
    			if($value['dwname'] == $valued['jgh']){
    				$value['dwname'] = $valued['dwname'];
    				$value['jgh'] = $valued['jgh'];
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
    public function financereports(){
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
    }
    
    
    
    
    
    
    public function financedwreport(){
    	//$dwname = cookie('dwname');
    	$wherecp['producttype'] = array('eq',2);
    	$cp = M('costproduct');
    	$cprr = $cp -> field('productid') -> where($wherecp) -> select();
    	foreach($cprr as &$value){
    		$productid[] = $value['productid'];
    	}
    	$date = substr($_POST['date_date'],0,10);
    	$dates = substr($_POST['date_date'],-10,10);
    	//$where['date'] = array( array('egt',$date) , array('elt',$dates) , 'and' );
    	//var_dump($where);
    	$coa = M('costoutallot');
    	//期初库存;
    	$ci = M('costinbound');
    	$whereco['date'] = array('lt',$date);
    	$whereco['productid'] = array('in',$productid);
    	$whereco['shenhe'] = '出库中';
    	$co = M('costoutbound');
    	$corr = $co -> where($whereco) -> field('applyjgh,inboundid,sjapplyquantity,date,productid,warehouseid,pwid') -> select();
    	$corrr = $co -> where($whereco) -> field('inboundid') -> group('inboundid') -> select();
    	foreach($corrr as &$value){
    		$inboundid[] = $value['inboundid'];
    	}
    	if($inboundid == null){
    		
    	}else{
    		$whereci['inboundid'] = array('in',$inboundid);
	    	//$ci = M('costinbound');
	    	$cirr = $ci -> where($whereci) -> field('inboundid,pwid,unitprice,vatprice,vatfill') -> select();
    	}
    	foreach($corr as &$valueco){
    		
    		foreach($cirr as &$valueci){
    			
    			if($valueco['inboundid'] == $valueci['inboundid']){
    				
    				$valueco['first'] = round($valueco['sjapplyquantity'] * $valueci['unitprice'] / (($valueci['vatprice'] + $valueci['vatfill']) + 1),2);
    				$valueco['vatfirst'] = round($valueco['sjapplyquantity'] * $valueci['unitprice'],2);
    			}
    			continue;
    		}
    	}
    	
    	//$wherecdo['date'] = array('lt',$date);
    	$cdo = M('costdwoutbound');
    	$cdofirstrr = $cdo -> where($whereco) -> field('outjgh,outboundid,inboundid,outquantity,date,productid,warehouseid,pwid') -> select();
    	$cdofirstrrr = $cdo -> where($whereco) -> field('inboundid') -> group('inboundid') -> select();
    	foreach($cdofirstrrr as &$value){
    		$inboundoid[] = $value['inboundid'];
    	}
    	if($inboundoid == null){
    		
    	}else{
    		$whereci['inboundid'] = array('in',$inboundoid);
	    	//$ci = M('costinbound');
	    	$cirr = $ci -> where($whereci) -> field('inboundid,pwid,unitprice,vatprice,vatfill') -> select();
    	}
    	//var_dump($corr);
    	foreach($cdofirstrr as &$valuecdo){
    		
    		foreach($cirr as &$valueci){
    			
    			if($valuecdo['inboundid'] == $valueci['inboundid']){
    				
    				$valuecdo['first'] = round($valuecdo['outquantity'] * $valueci['unitprice'] / (($valueci['vatprice'] + $valueci['vatfill']) + 1),2);
    				$valuecdo['vatfirst'] = round($valuecdo['outquantity'] * $valueci['unitprice'],2);
    			}
    			continue;
    		}
    	}
    	$wherecoa['shenhe'] = '已调拨';
    	$wherecoa['dateout'] = array('lt',$date);
    	$coafirstrr = $coa -> where($wherecoa) -> field('applyjgh,inboundid,sum(sjapplyquantity) as sumsj') -> group('applyjgh,inboundid') -> select();
    	
    	foreach($coafirstrr as &$value){
    		$inboundoid[] = $value['inboundid'];
    	}
    	if($inboundoid == null){
    		
    	}else{
    		$whereci['inboundid'] = array('in',$inboundoid);
	    	//$ci = M('costinbound');
	    	$cirr = $ci -> where($whereci) -> field('inboundid,pwid,unitprice,vatprice,vatfill') -> select();
    	}
    	foreach($coafirstrr as &$valuecoa){
    		
    		foreach($cirr as &$valueci){
    			
    			if($valuecoa['inboundid'] == $valueci['inboundid']){
    				
//  				$valuecoa['end'] = round($valuecoa['sumsj'] * $valueci['unitprice'] / (($valueci['vatprice'] + $valueci['vatfill']) + 1),2);
//  				$valuecoa['vatend'] = round($valuecoa['sumsj'] * $valueci['unitprice'],2);
    				$valuecoa['first'] = round($valuecoa['sumsj'] * $valueci['unitprice'] / (($valueci['vatprice'] + $valueci['vatfill']) + 1),2);
    				$valuecoa['vatfirst'] = round($valuecoa['sumsj'] * $valueci['unitprice'],2);
    			}
    			continue;
    		}
    	}
    	
    	//本期库存;
    	$wherecobq['date'] = array( array('egt',$date) , array('elt',$dates) , 'and' );
    	$wherecobq['productid'] = array('in',$productid);
    	$wherecobq['shenhe'] = '出库中';
    	$cobqrr = $co -> where($wherecobq) -> field('applyjgh,inboundid,kcapplyquantity,date,productid,warehouseid,pwid') -> select();
    	$cobqrrr = $co -> where($wherecobq) -> field('inboundid') -> group('inboundid') -> select();
    	foreach($cobqrrr as &$value){
    		$inboundidbq[] = $value['inboundid'];
    	}
    	if($inboundidbq == null){
    		//var_dump($inboundidbq);
    	}else{
    		//var_dump($inboundidbq);
    		$wherecibq['inboundid'] = array('in',$inboundidbq);
    		//var_dump($wherecibq);
    		$cibqrr = $ci -> where($wherecibq) -> field('inboundid,pwid,unitprice,vatprice,vatfill') -> select();
    	}
    	foreach($cobqrr as &$valueco){
    		
    		foreach($cibqrr as &$valueci){
    			
    			if($valueco['inboundid'] == $valueci['inboundid']){
    				
    				$valueco['current'] = round($valueco['kcapplyquantity'] * $valueci['unitprice'] / (($valueci['vatprice'] + $valueci['vatfill']) + 1),2);
    				$valueco['vatcurrent'] = round($valueco['kcapplyquantity'] * $valueci['unitprice'],2);
    			}
    			continue;
    		}
    	}
    	
    	//本期出库;
    	$wherecdobq['date'] = array( array('egt',$date) , array('elt',$dates) , 'and' );
    	$wherecdobq['productid'] = array('in',$productid);
    	$wherecdobq['shenhe'] = '出库中';
    	$cdorr = $cdo -> where($wherecdobq) -> field('outjgh,inboundid,sum(outquantity) as sums') -> group('outjgh,inboundid') -> select();
    	$cdorrr = $cdo -> where($wherecdobq) -> field('inboundid') -> group('inboundid') -> select();
    	foreach($cdorrr as &$value){
    		$inboundidout[] = $value['inboundid'];
    	}
    	if($inboundidout == null){
    		//var_dump($inboundidout);
    	}else{
    		$whereciout['inboundid'] = array('in',$inboundidout);
    		//var_dump($whereciout);
    		$cioutrr = $ci -> where($whereciout) -> field('inboundid,pwid,unitprice,vatprice,vatfill') -> select();
    	}
    	//var_dump($cdorr,$cioutrr,$inboundidout);
    	foreach($cdorr as &$valuecdo){
    		
    		foreach($cioutrr as &$valueci){
    			
    			if($valuecdo['inboundid'] == $valueci['inboundid']){
    				
    				$valuecdo['out'] = round($valuecdo['sums'] * $valueci['unitprice'] / (($valueci['vatprice'] + $valueci['vatfill']) + 1),2);
    				$valuecdo['vatout'] = round($valuecdo['sums'] * $valueci['unitprice'],2);
    			}
    			continue;
    		}
    	}
    	//本期入库;
    	$wherecoin['date'] = array( array('egt',$date) , array('elt',$dates) , 'and' );
    	$wherecoin['productid'] = array('in',$productid);
    	$wherecoin['shenhe'] = '出库中';
    	$coinrr = $co -> where($wherecoin) -> field('applyjgh,inboundid,sjapplyquantity,date,productid,warehouseid,pwid') -> select();
    	$coinrrr = $co -> where($wherecoin) -> field('inboundid') -> group('inboundid') -> select();
    	foreach($coinrrr as &$value){
    		$inboundidin[] = $value['inboundid'];
    	}
    	if($inboundidin == null){
    		
    	}else{
    		$whereciin['inboundid'] = array('in',$inboundidin);
    		$ciinrr = $ci -> where($whereciin) -> field('inboundid,pwid,unitprice,vatprice,vatfill') -> select();
    	}
    	foreach($coinrr as &$valueco){
    		
    		foreach($ciinrr as &$valueci){
    			
    			if($valueco['inboundid'] == $valueci['inboundid']){
    				
    				$valueco['in'] = round($valueco['sjapplyquantity'] * $valueci['unitprice'] / (($valueci['vatprice'] + $valueci['vatfill']) + 1),2);
    				$valueco['vatin'] = round($valueco['sjapplyquantity'] * $valueci['unitprice'],2);
    			}
    			continue;
    		}
    	}
    	//期末结余;
    	$wherecoend['date'] = array('elt',$dates);
    	$wherecoend['productid'] = array('in',$productid);
    	$wherecoend['shenhe'] = '出库中';
    	//$co = M('costoutbound');
    	//var_dump($wherecoend);
    	$coendrr = $co -> where($wherecoend) -> field('applyjgh,inboundid,sjapplyquantity,date,productid,warehouseid,pwid') -> select();
    	$coendrrr = $co -> where($wherecoend) -> field('inboundid') -> group('inboundid') -> select();
    	foreach($coendrrr as &$value){
    		$inboundidend[] = $value['inboundid'];
    	}
    	if($inboundidend == null){
    		
    	}else{
    		$whereciend['inboundid'] = array('in',$inboundidend);
	    	//$ci = M('costinbound');
	    	$ciendrr = $ci -> where($whereciend) -> field('inboundid,pwid,unitprice,vatprice,vatfill') -> select();
    	}
    	foreach($coendrr as &$valueco){
    		
    		foreach($ciendrr as &$valueci){
    			
    			if($valueco['inboundid'] == $valueci['inboundid']){
    				
    				$valueco['end'] = round($valueco['sjapplyquantity'] * $valueci['unitprice'] / (($valueci['vatprice'] + $valueci['vatfill']) + 1),2);
    				$valueco['vatend'] = round($valueco['sjapplyquantity'] * $valueci['unitprice'],2);
    				
    			}
    			continue;
    		}
    	}
    	$cdoendrr = $cdo -> where($wherecoend) -> field('outjgh,outboundid,inboundid,outquantity,date,productid,warehouseid,pwid') -> select();
    	$cdoendrrr = $cdo -> where($wherecoend) -> field('inboundid') -> group('inboundid') -> select();
    	foreach($cdoendrrr as &$value){
    		$inboundoidend[] = $value['inboundid'];
    	}
    	if($inboundoidend == null){
    		
    	}else{
    		$whereciend['inboundid'] = array('in',$inboundoidend);
	    	//$ci = M('costinbound');
	    	$cirr = $ci -> where($whereciend) -> field('inboundid,pwid,unitprice,vatprice,vatfill') -> select();
    	}
    	//var_dump($cdorr,$cirr);
    	foreach($cdoendrr as &$valuecdo){
    		
    		foreach($cirr as &$valueci){
    			
    			if($valuecdo['inboundid'] == $valueci['inboundid']){
    				
    				$valuecdo['end'] = round($valuecdo['outquantity'] * $valueci['unitprice'] / (($valueci['vatprice'] + $valueci['vatfill']) + 1),2);
    				$valuecdo['vatend'] = round($valuecdo['outquantity'] * $valueci['unitprice'],2);
    			}
    			continue;
    		}
    	}
      	
    	$wherecoa['shenhe'] = '已调拨';
    	$wherecoa['dateout'] = array('elt',$dates);
    	$coaendrr = $coa -> where($wherecoa) -> field('applyjgh,inboundid,sum(sjapplyquantity) as sumsj') -> group('applyjgh,inboundid') -> select();
    	
    	foreach($coaendrr as &$value){
    		$inboundoaid[] = $value['inboundid'];
    	}
    	if($inboundoaid == null){
    		
    	}else{
    		$whereci['inboundid'] = array('in',$inboundoaid);
	    	//$ci = M('costinbound');
	    	$cirr = $ci -> where($whereci) -> field('inboundid,pwid,unitprice,vatprice,vatfill') -> select();
    	}
    	foreach($coaendrr as &$valuecoa){
    		
    		foreach($cirr as &$valueci){
    			
    			if($valuecoa['inboundid'] == $valueci['inboundid']){
    				
    				$valuecoa['end'] = round($valuecoa['sumsj'] * $valueci['unitprice'] / (($valueci['vatprice'] + $valueci['vatfill']) + 1),2);
    				$valuecoa['vatend'] = round($valuecoa['sumsj'] * $valueci['unitprice'],2);
//  				$valuecoa['outoa'] = round($valuecoa['sumsj'] * $valueci['unitprice'] / (($valueci['vatprice'] + $valueci['vatfill']) + 1),2);
//  				$valuecoa['vatoutoa'] = round($valuecoa['sumsj'] * $valueci['unitprice'],2);
    			}
    			continue;
    		}
    	}
    	//调拨出库
    	$wherecoa['shenhe'] = '已调拨';
    	$wherecoa['dateout'] = array( array('egt',$date) , array('elt',$dates) , 'and' );
    	$coaoutrr = $coa -> where($wherecoa) -> field('applyjgh,inboundid,sum(sjapplyquantity) as sumsj') -> group('applyjgh,inboundid') -> select();
    	
    	foreach($coaoutrr as &$value){
    		$inboundoaoid[] = $value['inboundid'];
    	}
    	if($inboundoaoid == null){
    		
    	}else{
    		$whereci['inboundid'] = array('in',$inboundoaoid);
	    	//$ci = M('costinbound');
	    	$cirr = $ci -> where($whereci) -> field('inboundid,pwid,unitprice,vatprice,vatfill') -> select();
    	}
    	foreach($coaoutrr as &$valuecoa){
    		
    		foreach($cirr as &$valueci){
    			
    			if($valuecoa['inboundid'] == $valueci['inboundid']){
    				
//  				$valuecoa['end'] = round($valuecoa['sumsj'] * $valueci['unitprice'] / (($valueci['vatprice'] + $valueci['vatfill']) + 1),2);
//  				$valuecoa['vatend'] = round($valuecoa['sumsj'] * $valueci['unitprice'],2);
    				$valuecoa['outoa'] = round($valuecoa['sumsj'] * $valueci['unitprice'] / (($valueci['vatprice'] + $valueci['vatfill']) + 1),2);
    				$valuecoa['vatoutoa'] = round($valuecoa['sumsj'] * $valueci['unitprice'],2);
    			}
    			continue;
    		}
    	}
    	//var_dump($coaendrr,$cirr);
    	
    	$d = M('danwei');
    	$drr = $d -> where($where) -> field('jgh,dwname,yjgh') -> order('yjgh asc') -> select();
    	//期初库存;
    	foreach($drr as &$value){
    		
    		foreach($corr as &$valueco){
    			
    			if($value['jgh'] == $valueco['applyjgh']){
    				
    				$value['first'] = $value['first'] + $valueco['first'];
    				$value['vatfirst'] = $value['vatfirst'] + $valueco['vatfirst'];
    			}
    		}
    	}
    	foreach($drr as &$value){
    		
    		foreach($cdofirstrr as &$valuecdo){
    			
    			if($value['jgh'] == $valuecdo['outjgh']){
    				
    				$value['first'] = $value['first'] - $valuecdo['first'];
    				$value['vatfirst'] = $value['vatfirst'] - $valuecdo['vatfirst'];
    			}
    		}
    	}
		foreach($drr as &$value){
			
			foreach($coafirstrr as &$valuecoa){
				
				if($value['jgh'] == $valuecoa['applyjgh']){
					
					$value['first'] = $value['first'] - $valuecoa['first'];
					$value['vatfirst'] = $value['vatfirst'] - $valuecoa['vatfirst'];
				}
			}
		}
    	//本期库存;
    	foreach($drr as &$value){
    		
    		foreach($cobqrr as &$valueco){
    			
    			if($value['jgh'] == $valueco['applyjgh']){
    				
    				$value['current'] = $value['current'] + $valueco['current'];
    				$value['vatcurrent'] = $value['vatcurrent'] + $valueco['vatcurrent'];
    			}
    		}
    	}
    	//本期出库;
    	foreach($drr as &$value){
    		
    		foreach($cdorr as &$valuecdo){
    			
    			if($value['jgh'] == $valuecdo['outjgh']){
    				
    				$value['out'] = $value['out'] + $valuecdo['out'];
    				$value['vatout'] = $value['vatout'] + $valuecdo['vatout'];
    			}
    		}
    	}
    	//本期入库;
    	foreach($drr as &$value){
    		
    		foreach($coinrr as &$valuecdo){
    			
    			if($value['jgh'] == $valuecdo['applyjgh']){
    				
    				$value['in'] = $value['in'] + $valuecdo['in'];
    				$value['vatin'] = $value['vatin'] + $valuecdo['vatin'];
    			}
    		}
    	}
    	//期末结余;
    	foreach($drr as &$value){
    		
    		foreach($coendrr as &$valueco){
    			
    			if($value['jgh'] == $valueco['applyjgh']){
    				
    				$value['end'] = $value['end'] + $valueco['end'];
    				$value['vatend'] = $value['vatend'] + $valueco['vatend'];
    			}
    		}
    	}
    	foreach($drr as &$value){
    		
    		foreach($cdoendrr as &$valuecdo){
    			
    			if($value['jgh'] == $valuecdo['outjgh']){
    				
    				$value['end'] = $value['end'] - $valuecdo['end'];
    				$value['vatend'] = $value['vatend'] - $valuecdo['vatend'];
    			}
    		}
    	}
      	foreach($drr as &$value){
    		
    		foreach($coaendrr as &$valuecoa){
    			
    			if($value['jgh'] == $valuecoa['applyjgh']){
    				
    				$value['end'] = $value['end'] - $valuecoa['end'];
    				$value['vatend'] = $value['vatend'] - $valuecoa['vatend'];
    				
    				
    			}
    		}
    	}
    	//调拨出库;
    	foreach($drr as &$value){
    		
    		foreach($coaoutrr as &$valuecoa){
    			
    			if($value['jgh'] == $valuecoa['applyjgh']){
    				
    				$value['outoa'] = $value['outoa'] + $valuecoa['outoa'];
    				$value['vatoutoa'] = $value['vatoutoa'] + $valuecoa['vatoutoa'];
    			}
    		}
    	}
    		
    		
    	$this->assign('data',$drr);
    	$this->display();
    }
    public function financewhreport(){
    	//$whereci['kcquantity'] = array('gt',0);
    	$date = substr($_POST['date_date'],0,10);
    	$dates = substr($_POST['date_date'],-10,10);
    	//仓库期初库存;
    	$whereci['date'] = array('lt',$date);
    	//$where['date'] = array( array('egt',$date) , array('elt',$dates) , 'and' );
    	$whereci['shenhe'] = array('neq','未审核');
    	$ci = M('costinbound');
    	$cirrr = $ci -> where($whereci) -> field('warehouseid,unitprice,vatprice,vatfill,kcquantity,pwid') -> select();
    	foreach($cirrr as &$value){
    		$value['first'] = round($value['kcquantity'] * $value['unitprice'] / (($value['vatprice'] + $value['vatfill']) + 1),2);
		    $value['vatfirst'] = round($value['kcquantity'] * $value['unitprice'],2);
		    $warehouse[$value['warehouseid']]['first'] = $warehouse[$value['warehouseid']]['first'] + $value['first'];
		    $warehouse[$value['warehouseid']]['vatfirst'] = $warehouse[$value['warehouseid']]['vatfirst'] + $value['vatfirst'];
    		$warehouse[$value['warehouseid']]['warehouseid'] = $value['warehouseid'];
    	}
    	$co = M('costoutbound');
    	$whereco['date'] = array( array('egt',$date) , array('elt',$dates) , 'and' );
    	$whereco['shenhe'] = '出库中';
    	$corr = $co-> where($whereco) -> field('warehouseid,pwid,sjapplyquantity,inboundid') -> select();
    	$corrr = $co -> where($whereco) -> field('inboundid') -> group('inboundid') -> select();
    	foreach($corrr as &$value){
    		$inboundid[] = $value['inboundid'];
    	}
    	if($inboundid == null){
    		
    	}else{
    		$whereci['inboundid'] = array('in',$inboundid);
	    	
	    	$cirr = $ci -> where($whereci) -> field('inboundid,pwid,unitprice,vatprice,vatfill') -> select();
    	}
    	foreach($corr as &$valueco){
    		
    		foreach($cirr as &$valueci){
    			
    			if($valueco['inboundid'] == $valueci['inboundid']){
    				
    				$valueco['first'] = round($valueco['sjapplyquantity'] * $valueci['unitprice'] / (($valueci['vatprice'] + $valueci['vatfill']) + 1),2);
    				$valueco['vatfirst'] = round($valueco['sjapplyquantity'] * $valueci['unitprice'],2);
    			}
    			continue;
    		}
    	}
    	foreach($warehouse as &$val){
    		
    		foreach($corr as &$value){
    			
    			if($val['warehouseid'] == $value['warehouseid']){
    				$val['first'] = $val['first'] + $value['first'];
    				$val['vatfirst'] = $val['vatfirst'] + $value['vatfirst'];
    			}
    			continue;
    		}
    	}
    	$cw = M('costwarehouse');
    	$cwrr = $cw -> select();
    	foreach($warehouse as $value){
    		
    		foreach($cwrr as &$valuecw){
    			
    			if($value['warehouseid'] == $valuecw['warehouseid']){
    				$data[$valuecw['warehouseid']]['first'] = $value['first'];
    				$data[$valuecw['warehouseid']]['vatfirst'] = $value['vatfirst'];
    				$data[$valuecw['warehouseid']]['warehouse'] = $valuecw['warehouse'];
    				$data[$valuecw['warehouseid']]['warehouseid'] = $valuecw['warehouseid'];
    			}
    			continue;
    		}
    	}
    	//本期出库;
    	$whereout['date'] = array( array('egt',$date) , array('elt',$dates) , 'and' );
    	$whereout['shenhe'] = '出库中';
    	$corr = $co -> where($whereout) -> field('sjapplyquantity,inboundid,pwid,warehouseid') -> select();
    	$corrr = $co -> where($whereout) -> field('inboundid') -> group('inboundid') -> select();
    	foreach($corrr as &$value){
    		$inboundidck[] = $value['inboundid'];
    	}
    	if($inboundidck == null){
    		
    	}else{
    		$wherecick['inboundid'] = array('in',$inboundidck);
	    	//$ci = M('costinbound');
	    	$cirr = $ci -> where($wherecick) -> field('inboundid,pwid,unitprice,vatprice,vatfill') -> select();
    	}
    	foreach($corr as &$valueco){
    		
    		foreach($cirr as &$valueci){
    			
    			if($valueco['inboundid'] == $valueci['inboundid']){
    				
    				$valueco['out'] = round($valueco['sjapplyquantity'] * $valueci['unitprice'] / (($valueci['vatprice'] + $valueci['vatfill']) + 1),2);
    				$valueco['vatout'] = round($valueco['sjapplyquantity'] * $valueci['unitprice'],2);
    			}
    			continue;
    		}
    	}
    	foreach($warehouse as &$val){
    		
    		foreach($corr as &$value){
    			
    			if($val['warehouseid'] == $value['warehouseid']){
    				$val['out'] = $val['out'] + $value['out'];
    				$val['vatout'] = $val['vatout'] + $value['vatout'];
    			}
    			continue;
    		}
    	}
    	foreach($warehouse as $value){
    		
    		foreach($cwrr as &$valuecw){
    			
    			if($value['warehouseid'] == $valuecw['warehouseid']){
    				$data[$valuecw['warehouseid']]['out'] = $value['out'];
    				$data[$valuecw['warehouseid']]['vatout'] = $value['vatout'];
    				$data[$valuecw['warehouseid']]['warehouse'] = $valuecw['warehouse'];
    				$data[$valuecw['warehouseid']]['warehouseid'] = $valuecw['warehouseid'];
    			}
    			continue;
    		}
    	}
    	//本期入库;
    	$wherein['date'] = array( array('egt',$date) , array('elt',$dates) , 'and' );
    	$wherein['shenhe'] = array('neq','未审核');
    	$ciin = $ci -> where($wherein) -> field('warehouseid,pwid,unitprice,vatprice,vatfill,sjquantity') -> select();
    	foreach($ciin as &$value){
    		$value['in'] = round($value['sjquantity'] * $value['unitprice'] / (($value['vatprice'] + $value['vatfill']) + 1),2);
		    $value['vatin'] = round($value['sjquantity'] * $value['unitprice'],2);
		    $warehouse[$value['warehouseid']]['in'] = $warehouse[$value['warehouseid']]['in'] + $value['in'];
		    $warehouse[$value['warehouseid']]['vatin'] = $warehouse[$value['warehouseid']]['vatin'] + $value['vatin'];
    		$warehouse[$value['warehouseid']]['warehouseid'] = $value['warehouseid'];
    	}
    	foreach($warehouse as $value){
    		
    		foreach($cwrr as &$valuecw){
    			
    			if($value['warehouseid'] == $valuecw['warehouseid']){
    				$data[$valuecw['warehouseid']]['in'] = $value['in'];
    				$data[$valuecw['warehouseid']]['vatin'] = $value['vatin'];
    				$data[$valuecw['warehouseid']]['warehouse'] = $valuecw['warehouse'];
    				$data[$valuecw['warehouseid']]['warehouseid'] = $valuecw['warehouseid'];
    			}
    			continue;
    		}
    	}
    	//本期结余;
    	$whereend['date'] = array('elt',$dates);
    	$whereend['shenhe'] = array('neq','未审核');
    	$ciend = $ci -> where($whereend) -> field('warehouseid,pwid,unitprice,vatprice,vatfill,kcquantity') -> select();
    	foreach($ciend as &$value){
    		$value['end'] = round($value['kcquantity'] * $value['unitprice'] / (($value['vatprice'] + $value['vatfill']) + 1),2);
		    $value['vatend'] = round($value['kcquantity'] * $value['unitprice'],2);
		    $warehouse[$value['warehouseid']]['end'] = $warehouse[$value['warehouseid']]['end'] + $value['end'];
		    $warehouse[$value['warehouseid']]['vatend'] = $warehouse[$value['warehouseid']]['vatend'] + $value['vatend'];
    		$warehouse[$value['warehouseid']]['warehouseid'] = $value['warehouseid'];
    	}
    	foreach($warehouse as $value){
    		
    		foreach($cwrr as &$valuecw){
    			
    			if($value['warehouseid'] == $valuecw['warehouseid']){
    				$data[$valuecw['warehouseid']]['end'] = $value['end'];
    				$data[$valuecw['warehouseid']]['vatend'] = $value['vatend'];
    				$data[$valuecw['warehouseid']]['warehouse'] = $valuecw['warehouse'];
    				$data[$valuecw['warehouseid']]['warehouseid'] = $valuecw['warehouseid'];
    			}
    			continue;
    		}
    	}
    	//var_dump($warehouse);
    	$this->assign('data',$data);
    	$this->display();
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
    public function select(){
    	$l = M('login');
    	$lrr = $l -> select();
    	var_dump($lrr);
    }
    public function inboundreport(){
    	$date = substr($_POST['date_date'],0,10);
    	$dates = substr($_POST['date_date'],-10,10);
    	//仓库期初库存;
    	//$whereci['date'] = array('lt',$date);
    	$where['date'] = array( array('egt',$date) , array('elt',$dates) , 'and' );
    	$where['kcquantity'] = array('gt', 0);
    	$where['shenhe'] = '已审核';
    	$ci = M('costinbound');
    	$cirr = $ci -> where($where) -> field('productid,unitprice,sum(kcquantity) as sums,datesh') -> group('productid,unitprice,datesh') -> select();
    	
//  	$whereci['shenhe'] = '已审核';
//  	$whereci['date'] = array( array('egt',$date) , array('elt',$dates) , 'and' );
//  	$cirrr = $ci -> where($whereci) -> field('inboundid,productid,unitprice,kcquantity') ->select();
    	$whereco['date'] = array( array('egt',$date) , array('elt',$dates) , 'and' );
    	$whereco['kcapplyquantity'] = array('gt', 0);
    	$whereco['shenhe'] = '出库中';
    	$co = M('costoutbound');
    	$corr = $co -> where($whereco) -> field('productid,inboundid,sum(kcapplyquantity) as cosums,date') -> group('productid,inboundid,date') -> select();
    	$corrr = $co -> where($whereco) -> field('inboundid') -> group('inboundid') -> select();
    	foreach($cirr as &$value){
    		
    		$value['total'] = $value['unitprice'] * $value['sums'];
    	}
    	
    	foreach($corrr as &$value){
    		
    		$inboundid[] = $value['inboundid'];
    	}
    	$whereci['inboundid'] = array('in',$inboundid);
    	$cirrr = $ci -> where($whereci) -> field('inboundid,productid,unitprice,vatprice,vatfill') -> select();
    	//var_dump($corr,$cirrr,$inboundid);
    	foreach($corr as &$valueco){
    		
    		foreach($cirrr as &$valueci){
    			
    			if($valueco['inboundid'] == $valueci['inboundid']){
    				
    				$valueco['total'] = $valueci['unitprice'] * $valueco['cosums'];
    				$valueco['unitprice'] = $valueci['unitprice'];
    				continue;
    			}
    		}
    	}
    	//根据单位的产品进行分类
    	$cp = M('costproduct');
    	$cprr = $cp -> field('productid,productname,productdwname') -> select();
    	
    	foreach($cirr as &$value){
    		
    		foreach($cprr as &$valuecp){
    			
    			if($value['productid'] == $valuecp['productid']){
    				
    				$data[$value['productid']]['productid'] = $value['productid'];
    				$data[$value['productid']]['date'] = $value['datesh'];
    				$data[$value['productid']]['productdwname'] = $valuecp['productdwname'];
    				$data[$value['productid']]['productname'] = $valuecp['productname'];
    				$data[$value['productid']]['total'] = $data[$value['productid']]['total'] + $value['total'];
    				
    			}
    		}
    	}
    	foreach($corr as &$value){
    		
    		foreach($cprr as &$valuecp){
    			
    			if($value['productid'] == $valuecp['productid']){
    				
    				$data[$value['productid']]['productid'] = $value['productid'];
    				$data[$value['productid']]['date'] = $value['date'];
    				$data[$value['productid']]['productdwname'] = $valuecp['productdwname'];
    				$data[$value['productid']]['productname'] = $valuecp['productname'];
    				$data[$value['productid']]['total'] = $data[$value['productid']]['total'] + $value['total'];
    				
    			}
    		}
    	}
    	$d = M('danwei');
    	$drr = $d -> field('jgh,dwname') -> select();
    	
    	foreach($data as &$value){
    		
    		foreach($drr as &$valued){
    			
    			if($value['productdwname'] == $valued['jgh']){
    				
    				$value['dwname'] = $valued['dwname'];
    				continue;
    			}
    		}
    	}
    	//var_dump($data);
    	$this->assign('data',$data);
    	$this->display();
    }
    
    
    
    
    
    
    public function pcstats($data){
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
    	}
    	return $data;
    }
    public function pointcardwd(){
    	$d = M('danwei');
    	$drr = $d -> where("jiagou = 'A1'") -> select();
    	
    	$this->assign('drr',$drr);
    	
    	$this->display();
    }
    public function pointcardwds(){
		$jgh = $_POST['dwname'];

		$cl = M('costlogin');
    	
    	$clrr = $cl -> where("jgh = '$jgh'") -> select();
		
		
		$ccb = M('costcardbatch');
		$stats['stats'] = 0;
		$ccbr = $ccb -> where($stats) -> select();

		$batch = $ccbr[0]['cardbatchid'];
		$where['jgh'] = $jgh;
		$where['cardbatch'] = $batch;
		$cc = M('costcard');
		$ccr = $cc -> where($where) -> max('card');
		// $ccr = $ccr + 1;
		if($ccr == null){
			$len = $ccbr[0]['cardbatch'];
			$cardbatch = substr($ccbr[0]['cardbatch'],8,$len - 8);
			$clrr[0]['username'] = $clrr[0]['username'] . $cardbatch;
		}else{
			$clrr[0]['username'] = $ccr + 1;
		}
		// var_dump($ccr,$batch);
		// var_dump($cardbatch,$clrr);

    	
    	$d = M('jrdanwei');
    	$drr = $d -> where("jgh = '$jgh'") -> select();
    	
    	$this->assign('drr',$drr);
    	
    	
    	$this->assign('clrr',$clrr);
    	
    	$this->display();
    }
    public function pointcardwdsuc(){
    	$jgh = $_POST['jgh'];
		$dwname = $_POST['dwname'];
		
    	$ccb = M('costcardbatch');
		$stats['stats'] = 0;
		$ccbr = $ccb -> where($stats) -> select();
		$batchlen = mb_strlen($ccbr[0]['cardbatch']);
		$batch = $ccbr[0]['cardbatchid'];
    	$min = $_POST['price_min'];
    	$max = $_POST['price_max'];
    	
    	$minlen = mb_strlen($min);
    	$maxlen = mb_strlen($max);
    	
    	$minjgh = substr($min,0,8);
    	$maxjgh = substr($max,0,8);
    	// var_dump($minjgh,$maxjgh,$dwname);
    	if($minjgh == $dwname and $maxjgh == $dwname){
    		
    	}else{
    		$this->error('网点卡号输入错误,请检查网点对应的卡号');
    	}
    	
    	$gap = $max - $min;
    	if($gap < 0){
    		$this->error('范围后的值不能小于范围前,请重新输入正确的卡号');
    	}
    	if($minlen == $maxlen and $minlen == $batchlen){
    		
    	}else{
    		$this->error('卡号字段不符,请重新输入正确的卡号');
    	}
		
		$ccb = M('costcardbatch');
		$stats['stats'] = 0;
		$ccbr = $ccb -> where($stats) -> find();

    	for($i = $min ; $i <= $max ; $i++){
    		
    		$card[] = array(
    			
    			'card' => $i,
    			'dwname' => $dwname,
    			'jgh' => $jgh,
    			'date' => date('Y-m-d'),
				'stats' => 0,
				'cardbatch' => $ccbr['cardbatchid'],
    		);
    		$cards[] = $i;
    	}
    	
    	$cc = M('costcard');
    	
    	$where['jgh'] = $jgh;
    	$where['card'] = array('in',$cards);
    	$ccrr = $cc -> where($where) -> count();
    	if($ccrr > 0){
    		$this->error('积分卡存在重复，请核对后再输入');
    	}
    	
    	$ccr = $cc -> addall($card);
    	
    	if($ccr > 0){
    		$this->success('积分卡入库成功，请继续',U('Admin/pointcardwd'));
    	}else{
    		$this->error('积分卡入库失败，请检查数据');
    	}
//  	var_dump($ccrr,$cards,$jgh);
//  	var_dump($_POST,$gap,$card,$min,$minjgh,$dwname);
    }
    public function pointcardwdin(){
    	$cc = M('costcard');
    	
    	$where['stats'] = 4;
    	$ccr = $cc -> distinct(true) -> field('jgh') -> where($where) -> select();
    	
    	foreach($ccr as &$value){
    		
    		$jgh[] = $value['jgh'];
    	}
    	
    	$d = M('danwei');
    	$drr = $d -> select();
    	
    	foreach($ccr as &$value){
    		
    		foreach($drr as &$val){
    			
    			if($value['jgh'] == $val['jgh']){
    				
    				$value['dwname'] = $val['dwname'];
    				
    			}
    		}
    	}
    	
    	$this->assign('ccr',$ccr);
    	
    	$this->display();
    }
    public function pointcardwdins(){
    	$cc = M('costcard');
    	
    	$where['stats'] = 4;
    	$ccr = $cc -> distinct(true) -> field('jgh') -> where($where) -> select();
    	
    	foreach($ccr as &$value){
    		
    		$jgh[] = $value['jgh'];
    	}
    	
    	$d = M('danwei');
    	$drr = $d -> select();
    	
    	foreach($ccr as &$value){
    		
    		foreach($drr as &$val){
    			
    			if($value['jgh'] == $val['jgh']){
    				
    				$value['dwname'] = $val['dwname'];
    				
    			}
    		}
    	}
    	
    	$this->assign('drr',$ccr);
    	
    	$this->display();
    	
    }
    public function pointcardwdinlist(){
    	$limit = $_GET['limit'];
    	$page = $_GET['page'];
    	$first = $limit * ($page-1);
    	
    	$kh = $_GET['card'];
    	$wd = $_GET['jgh'];
    	$date = $_GET['date'];
    	if($wd == null){
    		
    	}else{
    		$where['jgh'] = $wd;
    	}
    	
    	if($kh == null){
    		
    	}else{
    		$where['card'] = $kh;
    	}
    	
    	if($date == null){
    		
    	}else{
    		$where['date'] = $date;
    	}
//  	$jgh = $_POST['jgh'];
    	$cc = M('costcard');
//  	$where['jgh'] = $jgh;
    	$where['stats'] = 4;
    	$ccr = $cc -> limit($first,$limit) -> where($where) -> select();
    	
    	$d = M('danwei');
    	$drr = $d -> where("jiagou = 'A1'") -> select();
    	
    	foreach($ccr as &$value){
    		
    		foreach($drr as &$val){
    			
    			if($value['jgh'] == $val['jgh']){
    				
    				$value['dwnames'] = $val['dwname'];
    				break;
    			}
    		}
    		
    	}
//  	var_dump($ccr);
    	$count = $cc -> where($where) -> count();
    	
    	$data = json_encode($ccr);
    	$json = '{"code":0,"msg":"","count":'.$count.',"data":'.$data.'}';
    	
    	echo $json;
    }
    
    public function pointcardinstats(){
    	$cc = M('costcard');
    	$cci = M('costcardin');
    	$cardid = $_POST['cardid'];
    	$card['stats'] = 5;
    	$cards['stats'] = 4;
    	
    	$cardin['stats'] = 5;
    	$cardins['stats'] = 4;
    	
    	if($_POST['stats'] == 'true'){
    		$ccr = $cc -> where("cardid = '$cardid'") -> save($card);
    		$ccir = $cci -> where("cardid = '$cardid'") -> save($cardin);
    	}else{
    		$ccr = $cc -> where("cardid = '$cardid'") -> save($cards);
    		$ccir = $cci -> where("cardid = '$cardid'") -> save($cardins);
    	}
    	
    }
    public function pointcardinbatchstats(){
    	$card = $_POST['cardid'];
    	$cc = M('costcard');
    	$cci = M('costcardin');
    	$where['stats'] = 5;
    	foreach($card as &$value){
    		$cardid = $value['cardid'];
    		$ccr = $cc -> where("cardid = '$cardid'") -> save($where);
    		
    		$ccir = $cci -> where("cardid = '$cardid'") -> save($where);
    		
    		$countin = $countin + $ccir;
    		
    		$count = $count + $ccr;
    	}
    	
    	
    	
    	echo $count;
    }
    public function pointcardwdedit(){
    	$d = M('danwei');
    	$drr = $d -> where("jiagou = 'A1'") -> select();
    	
    	$this->assign('drr',$drr);
    	
    	$this->display();
    }
    public function pointcardwdedits(){
    	$d = M('danwei');
    	$drr = $d -> where("jiagou = 'A1'") -> select();
    	
    	$this->assign('drr',$drr);
    	
    	$this->display();
    }
    public function pointcardwdeditlist(){
    	$limit = $_GET['limit'];
    	$page = $_GET['page'];
    	$first = $limit * ($page-1);
    	
    	$kh = $_GET['stats'];
    	$wd = $_GET['jgh'];
    	$date = $_GET['date'];
    	if($wd == null){
    		
    	}else{
    		$where['jgh'] = $wd;
    	}
    	
    	if($kh == null){
    		$where['stats'] = array('notin' , '1');
    	}else{
    		$where['stats'] = $kh;
    	}
    	
    	if($date == null){
    		
    	}else{
    		$where['date'] = $date;
    	}
//  	$jgh = $_POST['dwname'];
    	$cc = M('costcard');
//  	$where['jgh'] = $jgh;
    	
    	$ccr = $cc -> limit($first,$limit) -> where($where) -> select();
    	$ccr = $this -> pcstats($ccr);
    	$d = M('danwei');
    	$drr = $d -> where("jiagou = 'A1'") -> select();
    	
    	foreach($ccr as &$value){
    		
    		foreach($drr as &$val){
    			
    			if($value['jgh'] == $val['jgh']){
    				
    				$value['dwnames'] = $val['dwname'];
    				break;
    			}
    		}
    		
    	}
//  	var_dump($ccr);
    	$count = $cc -> where($where) -> count();
    	
    	$data = json_encode($ccr);
    	$json = '{"code":0,"msg":"","count":'.$count.',"data":'.$data.'}';
    	
    	echo $json;
    }
    public function pointcardwdmake(){
    	$d = M('danwei');
    	
    	$drr = $d -> where("jiagou = 'A1'") -> select();
    	
    	$cc = M('costcard');
    	
    	foreach($drr as &$value){
    		
    		$where['jgh'] = $value['jgh'];
    		
    		$ccr = $cc -> where($where) -> max('card');
    		
    		$data[] = array(
    		
    			'jgh' => $value['jgh'],
    			'max' => $ccr,
    			'dwnames' => $value['dwname'],
    		);
    		
    	}
    	$cl = M('costlogin');
    	$clrr = $cl -> select();
    	foreach($data as &$value){
    		//卡号是否需要进一位，统一标准；
    		if($value['max'] == null){
    				
    			}else{
    				
    				$value['max'] = $value['max'] + 1;
    				
    			}
    		
    		foreach($clrr as &$val){
    			
    			if($value['jgh'] == $val['jgh']){
    				
    				$value['dwname'] = $val['username'];
    				break;
    				
    			}
    			
    		}
    	}
    	
    	$this->assign('data',$data);
    	$this->display();
    }
    public function pointcardwdshs(){
    	$cco = M('costcardout');
    	
    	$where['stats'] = 3;
    	$ccor = $cco -> distinct(true) -> field('jgh') -> where($where) -> select();
    	
    	$ccorr = $cco -> field('card') -> where($where) -> select();
    	
    	foreach($ccor as &$value){
    		
    		$jgh[] = $value['jgh'];
    	}
    	
    	$d = M('danwei');
    	$drr = $d -> select();
    	
    	foreach($ccor as &$value){
    		
    		foreach($drr as &$val){
    			
    			if($value['jgh'] == $val['jgh']){
    				
    				$value['dwname'] = $val['dwname'];
    				
    			}
    		}
    	}
    	
    	$this->assign('ccor',$ccor);
    	
//  	var_dump($ccor);
    	
//  	$this->assign('jgh',$jgh);
    	
    	$this->assign('ccorr',$ccorr);
    	
    	$this->display();
    }
    public function pointcardwdshlist(){
    	$limit = $_GET['limit'];
    	$page = $_GET['page'];
    	$first = $limit * ($page-1);
    	
    	$kh = $_GET['card'];
    	$wd = $_GET['jgh'];
    	$date = $_GET['date'];
    	if($wd == null){
    		
    	}else{
    		$where['jgh'] = $wd;
    	}
    	
    	if($kh == null){
    		
    	}else{
    		$where['card'] = $kh;
    	}
    	
    	if($date == null){
    		
    	}else{
    		$where['date'] = $date;
    	}
    	$where['stats'] = 3;
    	$cc = M('costcardout');
//  	$where['jgh'] = $jgh;
    	
    	$ccr = $cc -> limit($first,$limit) -> where($where) -> select();
    	$ccr = $this -> pcstats($ccr);
    	$d = M('danwei');
    	$drr = $d -> where("jiagou = 'A1'") -> select();
    	
    	foreach($ccr as &$value){
    		
    		foreach($drr as &$val){
    			
    			if($value['jgh'] == $val['jgh']){
    				
    				$value['dwnames'] = $val['dwname'];
    				break;
    			}
    		}
    		
    	}
//  	var_dump($ccr);
    	$count = $cc -> where($where) -> count();
    	
    	$data = json_encode($ccr);
    	$json = '{"code":0,"msg":"","count":'.$count.',"data":'.$data.'}';
    	
    	echo $json;
    }
    public function pointcardshstats(){
    	$cc = M('costcard');
    	$cci = M('costcardin');
    	$cco = M('costcardout');
    	
    	$cardoutid = $_POST['cardoutid'];
    	
    	$ccor = $cco -> where("cardoutid = '$cardoutid'") -> select();
    	
    	$cardid = $ccor[0]['cardid'];
    	$cardinid = $ccor[0]['cardinid'];
    	
    	$cards['stats'] = 6;
    	$cardins['stats'] = 6;
    	$cardouts['stats'] = 6;
    	
    	$card['stats'] = 3;
    	$cardin['stats'] = 3;
		$cardout['stats'] = 3;
    	
    	if($_POST['stats'] == 'true'){
    		$ccr = $cc -> where("cardid = '$cardid'") -> save($cards);
    		$ccir = $cci -> where("cardid = '$cardinid'") -> save($cardins);
    		$ccorr = $cco -> where("cardoutid = '$cardoutid'") -> save($cardouts);
    	}else{
    		$ccr = $cc -> where("cardid = '$cardid'") -> save($card);
    		$ccir = $cci -> where("cardid = '$cardinid'") -> save($cardin);
    		$ccorr = $cco -> where("cardoutid = '$cardoutid'") -> save($cardout);
    	}
    }
    public function pointcardshbatchstats(){
    	$cardoutids = $_POST['cardoutid'];
    	
    	$cc = M('costcard');
    	$cci = M('costcardin');
    	$cco = M('costcardout');
    	
    	$where['stats'] = 6;
    	foreach($cardoutids as &$value){
    		
    		$cardoutid = $value['cardoutid'];
    		
    		$ccor = $cco -> where("cardoutid = '$cardoutid'") -> select();
    		
    		$cardid = $ccor[0]['cardid'];
    		$cardinid = $ccor[0]['cardinid'];
    		
    		$ccr = $cc -> where("cardid = '$cardid'") -> save($where);
    		
    		$ccir = $cci -> where("cardid = '$cardinid'") -> save($where);
    		
    		$ccorr = $cco -> where("cardoutid = '$cardoutid'") -> save($where);
    		
    		$count = $count + $ccorr;
    	}
    	
    	echo $count;
    }
    
    
    
    
    
    
    
    public function pointcardwdfinance(){
    	$d = M('danwei');
    	$drr = $d -> where("jiagou = 'A1'") -> select();
    	
    	$this->assign('drr',$drr);
    	
    	$this->display();
    }
    public function pointcardwdfinancelist(){
    	$limit = $_GET['limit'];
    	$page = $_GET['page'];
    	$first = $limit * ($page-1);
    	
    	$kh = $_GET['card'];
    	$wd = $_GET['jgh'];
    	$date_date = $_GET['date'];
    	if($wd == null){
    		
    	}else{
    		$where['jgh'] = $wd;
    	}
    	
    	if($kh == null){
    		
    	}else{
    		$where['card'] = $kh;
    	}
    	
    	if($date_date == null){
    		
    	}else{
    		$date = substr($date_date,0,10);
    		$dates = substr($date_date,-10,10);
    		$where['date'] = array( array('egt',$date) , array('elt',$dates) , 'and' );
    	}
    	$where['stats'] = 2;
    	
    	$cc = M('costcardout');
    	
    	$ccr = $cc -> limit($first,$limit) -> where($where) -> select();
    	
    	foreach($ccr as &$value){
    		$value['sum'] = $value['rule'] * $value['money'];
    	}
    	
    	$ccr = $this -> pcstats($ccr);
    	$d = M('danwei');
    	$drr = $d -> where("jiagou = 'A1'") -> select();
    	
    	foreach($ccr as &$value){
    		
    		foreach($drr as &$val){
    			
    			if($value['jgh'] == $val['jgh']){
    				
    				$value['dwnames'] = $val['dwname'];
    				break;
    			}
    		}
    		
    	}
//  	var_dump($ccr);
    	$count = $cc -> where($where) -> count();
    	
    	$data = json_encode($ccr);
    	$json = '{"code":0,"msg":"","count":'.$count.',"data":'.$data.'}';
    	
    	echo $json;
    }
}