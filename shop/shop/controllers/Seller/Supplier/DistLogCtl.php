<?php if (!defined('ROOT_PATH')) exit('No Permission');

/**
 * @author     
 */
class Seller_Supplier_DistLogCtl extends Seller_Controller
{
 
    /**
     * Constructor
     *
     * @param  string $ctl 控制器目录
     * @param  string $met 控制器方法
     * @param  string $typ 返回数据类型
     * @access public
     */
    public function __construct(&$ctl, $met, $typ)
    {
        parent::__construct($ctl, $met, $typ);
     
        //include $this->view->getView();
    }
    
    //淘金明细、汇总
    public function index()
	{
    	$Order_BaseModel  = new Order_BaseModel();
		$Order_GoodsModel = new Order_GoodsModel();
		$Goods_CommonModel = new Goods_CommonModel();
		
		$shop_id   = Perm::$shopId;
		$YLB_Page           = new YLB_Page();
		$YLB_Page->listRows = 10;
		$rows              = $YLB_Page->listRows;
		$offset            = request_int('firstRow', 0);
		$page              = ceil_r($offset / $rows);
 
 
		//查处店铺所有的淘金商品
		$common_base = $Goods_CommonModel->getByWhere(array('shop_id'=>$shop_id,'common_parent_id:>'=>0));
		$common_id  = array_column($common_base,'common_id');
 
		$cond_row = array();
		$order_row = array();
		
		//订单号搜索
		if(request_string('order_id'))
		{
			$cond_row['order_id'] = request_string('order_id');
		}
		
		//商品名称搜索
		if(request_string('goods_name'))
		{
			$cond_row['goods_name:LIKE'] = '%'.request_string('goods_name').'%';
		}
		
		//开始时间
		if(request_string('start_date'))
		{
			$cond_row['order_create_time:>'] = request_string('start_date');
		}
		
		//结束时间
		if(request_string('end_date'))
		{
			$cond_row['order_create_time:<'] = request_string('end_date');
		}
		
		$cond_row['common_id:IN'] = $common_id;
		$order_row['order_goods_time']  = 'DESC';
		$data = $Order_GoodsModel->listByWhere($cond_row,$order_row,$page,$rows);
		
		//所有淘金订单总和
		$orders  = $Order_GoodsModel ->getByWhere($cond_row);
		$dist_total = array_sum(array_column($orders,'goods_price'));
		
    	$YLB_Page->totalRows = $data['totalsize'];
		$page_nav           = $YLB_Page->prompt();
		if ("json" == $this->typ)
		{
			$this->data->addBody(-140, $data);
		}
		else
		{
			include $this->view->getView();
		}
    }
    
    //采购单
    public function buy_order()
	{
    	$Order_BaseModel  = new Order_BaseModel();
		$Order_GoodsModel = new Order_GoodsModel();
		
		$YLB_Page           = new YLB_Page();
		$YLB_Page->listRows = 10;
		$rows              = $YLB_Page->listRows;
		$offset            = request_int('firstRow', 0);
		$page              = ceil_r($offset / $rows);
 
		$cond_row = array();
		$order_row = array();
		
		//订单号
		if(request_string('order_id'))
		{
			$cond_row['order_id'] = request_string('order_id');
		}
		
		//店铺名称
		if(request_string('shop_name'))
		{
			$cond_row['shop_name:LIKE'] = '%'.request_string('shop_name').'%';
		}
		
		//开始时间
		if(request_string('start_date'))
		{
			$cond_row['order_create_time:>'] = request_string('start_date');
		}
		
		//结束时间
		if(request_string('end_date'))
		{
			$cond_row['order_create_time:<'] = request_string('end_date');
		}
		
		$cond_row['buyer_user_id']  = Perm::$userId;
		
		$order_row['order_create_time']  = 'DESC';
		$data = $Order_BaseModel->listByWhere($cond_row,$order_row,$page,$rows);
		
    	$YLB_Page->totalRows = $data['totalsize'];
		$page_nav           = $YLB_Page->prompt();
    	
    	
    	include $this->view->getView();
    }
}