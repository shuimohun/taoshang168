<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Buyer_PointsCtl extends Buyer_Controller
{
	public $pointsLogModel   = null;
	public $pointsOrderModel = null;


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
		$this->pointsLogModel        = new Points_LogModel();
		$this->pointsOrderModel      = new Points_OrderModel();
		$this->pointsOrderGoodsModel = new Points_OrderGoodsModel();
		$this->webConfigModel        = new Web_ConfigModel();
		$this->ExpressModel          = new ExpressModel();

	}

	/**
	 * 用户金蛋页面
	 * @access public
	 * 
	 */
	public function points()
	{
		$op = request_string('op');

		$YLB_Page           = new YLB_Page();
		$YLB_Page->listRows = request_int('listRows')?request_int('listRows'):10;
		$rows              = $YLB_Page->listRows;
		$offset            = request_int('firstRow', 0);
		$page              = ceil_r($offset / $rows);


		if ($op == 'getPointsOrder')//兑换记录 金蛋订单
		{

			$state                         = request_int('state');
			$cond_row['points_buyerid']    = Perm::$userId;
			if($state){
				$cond_row['points_orderstate'] = $state;
			}

            $order_row['points_order_id'] = 'DESC';

			$data = $this->pointsOrderModel->getPointsOrderListByWhere($cond_row, $order_row, $page, $rows);
		    //查询物流
			foreach($data['items'] as $key=>$value)
		    {
		        if($value['points_logistics'])
		        {
                     $express = $this->ExpressModel->getExpressList(array('express_name'=>$value['points_logistics']));
                     foreach($express['items'] as $k=>$v)
                     {
                         $data['items'][$key]['express_id'] = $v['express_id'];
                     }
                }
            }

			$YLB_Page->totalRows = $data['totalsize'];
			$page_nav           = $YLB_Page->prompt();
			$this->view->setMet('getPointsOrder');
		}
		else
		{

			$cond_row['user_id'] = Perm::$userId;
			$start_date         = request_string("start_date");
			$end_date            = request_string("end_date");
			$class_id            = request_string("class_id");
			$des                 = request_string("des");
			$class               = "";
			//金蛋获取的默认设置
			$web                    = array();
			$web['points_reg']      = Web_ConfigModel::value("points_reg");//注册获取金蛋
			$web['points_login']    = Web_ConfigModel::value("points_login");//登陆获取金蛋
			$web['points_evaluate'] = Web_ConfigModel::value("points_evaluate");//评论获取金蛋
			$web['points_recharge'] = Web_ConfigModel::value("points_recharge");//订单每多少获取多少金蛋
			$web['points_order']    = Web_ConfigModel::value("points_order");//订单每多少获取多少金蛋
			
			$classId = Points_LogModel::$classId;
			
			$order_row = array();
			$order_row = array('points_log_time' => 'DESC');
			
			if ($start_date)
			{
				$cond_row['points_log_time:>='] = $start_date;
			}
			if ($end_date)
			{
				$cond_row['points_log_time:<='] = $end_date;
			}
			if ($class_id)
			{
				$cond_row['class_id'] = $class_id;
				
				$class = _(Points_LogModel::$classId[$class_id]);
			}
			if ($des)
			{
				$type            = 'points_log_desc:LIKE';
				$cond_row[$type] = '%' . $des . '%';
			}
			
			$data = $this->pointsLogModel->getPointsLogList($cond_row, $order_row, $page, $rows);

			$YLB_Page->totalRows = $data['totalsize'];
			$page_nav           = $YLB_Page->prompt();
			$data['pagesize']   = $YLB_Page->listRows;
			$data['web'] = $web;
		}
		fb($data);
		if($data['page']<$data['total'])
		{
            $data['hasmore'] = true;
        }
        else
        {
            $data['hasmore'] = false;
        }

		if ('json' == $this->typ)
		{
			$this->data->addBody(-140, $data);
		}
		else
		{
			include $this->view->getView();
		}
	}

	/**
	 * 确认收货
	 *
	 * @author WenQingTeng
	 */
	public function confirmOrder()
	{
		$typ = request_string('typ');

		if ($typ == 'e')
		{
			if ('json' == $this->typ)
			{
				$data = array();
				$this->data->addBody(-140, $data);
			}
			else
			{
				include $this->view->getView();
			}
		}
		else
		{

			$points_order_id = request_string('order_id');

			$condition['points_orderstate'] = Points_OrderModel::CONFIRM;

			$condition['points_finnshedtime'] = get_date_time();

			$flag = $this->pointsOrderModel->editPointsOrder($points_order_id, $condition);


			if ($flag !== false)
			{
				$status = 200;
				$msg    = _('success');
			}
			else
			{

				$msg    = _('failure');
				$status = 250;
			}

			$this->data->addBody(-140, array(), $msg, $status);
		}

	}


}

?>