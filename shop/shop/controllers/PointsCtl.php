<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class PointsCtl extends Controller
{
	public $pointsGoodsModel      = null;
	public $pointsOrderModel      = null;
	public $pointsOrderGoodsModel = null;
	public $pointsCartModel       = null;
	// public $Delivery_BaseModel  = null;
	public $pointsOrderAddressModel = null;

	public $userInfoModel     = null;
	public $userResourceModel = null;
	public $voucherTempModel  = null;
	public $voucherBaseModel  = null;
	public $userAddressModel  = null;
    public $redPacketBaseModel = null;
    public $redPacketTempModel = null;
    public $Shop_ClassModel    = null;
    public $Advs_TypeModel     = null;
    public $Advs_AdvConModel   = null;
	public $mode_fun_flag = true;	//模块功能是否开启

	public function __construct(&$ctl, $met, $typ)
	{
		parent::__construct($ctl, $met, $typ);
        $this->initData();
		$this->web = $this->webConfig();
		$this->nav = $this->navIndex();
		$this->cat = $this->catIndex();

		$this->pointsGoodsModel      = new Points_GoodsModel();
		$this->pointsOrderModel      = new Points_OrderModel();
		$this->pointsOrderGoodsModel = new Points_OrderGoodsModel();
		$this->pointsCartModel       = new Points_CartModel();
		//$this->Delivery_BaseModel = new Delivery_BaseModel();
		$this->pointsOrderAddressModel = new Points_OrderAddressModel();

		$this->userInfoModel     = new User_InfoModel();
		$this->userResourceModel = new User_ResourceModel();
		$this->voucherTempModel  = new Voucher_TempModel();
		$this->voucherBaseModel  = new Voucher_BaseModel();
		$this->userAddressModel  = new User_AddressModel();
		$this->Shop_ClassModel   = new Shop_ClassModel();
		//红包
        $this->redPacketBaseModel =  new RedPacket_BaseModel();
        $this->redPacketTempModel = new RedPacket_TempModel();
        //广告轮播
        $this->Advs_TypeModel     = new Operation_AdvsTypeModel();
        $this->Advs_AdvConModel   = new Operation_AdvertisementModel();

		//pointshop_isuse 金蛋商城
		//pointprod_isuse 金蛋兑换功能
		//两者同时开启，买家才开启进行金蛋商品兑换
		$this->mode_fun_flag = (Web_ConfigModel::value('pointshop_isuse') && Web_ConfigModel::value('pointprod_isuse'));

		if(!$this->mode_fun_flag)
		{
            $this->showMsg("金蛋兑换功能已经关闭!");
		}
	}

	public function index()
	{

		if (Perm::checkUserPerm())
		{
			$data['user_info']        = $this->userInfoModel->getUserInfo(array('user_id' => Perm::$userId));//用户信息，包含用户等级
			$data['user_resource']    = $this->userResourceModel->getUserResource(array('user_id' => Perm::$userId));//获取用户经验值和金蛋
			$data['ava_voucher_num']  = $this->voucherBaseModel->getAvaVoucherCountByUserId(Perm::$userId);   //用户可用代金券数量
			$data['points_order_num'] = $this->pointsOrderModel->getUserPointsGoodsCount(Perm::$userId);   //已兑换订单数量
			$data['points_cart_num']  = $this->pointsCartModel->getUserPointsCartCount(Perm::$userId);     //购物车数量

			$User_GradeModel                      = new User_GradeModel();
			$user_grade_row                       = $User_GradeModel->getGradeList();
			$current_grade                        = $user_grade_row[$data['user_info']['user_grade']]; //当前等级信息
			$next_grade                           = $user_grade_row[$data['user_info']['user_grade'] + 1];  //下一等级信息
			$growth_diff                          = $data['user_resource']['user_growth'] - $current_grade['user_grade_demand'];//当前经验值与等级初始值之差
			$diff_grade_growth                    = $next_grade['user_grade_demand'] - $current_grade['user_grade_demand']; //两个不同等级之间的成长值差
			$data['growth']['grade_growth_start'] = $current_grade['user_grade_demand'];
			$data['growth']['grade_growth_end']   = $next_grade['user_grade_demand'];
			$data['growth']['next_grade_growth']  = $next_grade['user_grade_demand'] - $data['user_resource']['user_growth'];//距离下一级差多少经验值
			$data['growth']['grade_growth_per']   = sprintf("%.2f", $growth_diff / $diff_grade_growth) * 100;
		}
        $fid = request_int('fid');
		//金蛋换购商品列表
		$cond_row_p_goods['points_goods_shelves'] = Points_GoodsModel::ONSHELVES;
        if($fid) {$cond_row_p_goods['points_goods_type'] = $fid;}
		$order_row_p_goods['points_goods_sort']   = 'ASC';
		$points_goods_rows                        = $this->pointsGoodsModel->getPointsGoodsList($cond_row_p_goods, $order_row_p_goods, 0, 18);
		$data['points_goods']                     = $points_goods_rows['items'];

		//代金券列表
		$cond_row_voucher_temp['voucher_t_state']      = Voucher_TempModel::VALID;
		$cond_row_voucher_temp['voucher_t_end_date:>'] = get_date_time();
		if($fid) {$cond_row_voucher_temp['shop_class_id'] = $fid;}
		$order_row_voucher_temp['voucher_t_recommend'] = 'DESC';
		$voucher_temp_rows                             = $this->voucherTempModel->getVoucherTempList($cond_row_voucher_temp, $order_row_voucher_temp, 0, 6);

		$data['voucher']                               = $voucher_temp_rows['items'];

		$data['promotiom_img'] = Web_ConfigModel::value('promotiom_img');
		$data['promotiom_img_url'] = Web_ConfigModel::value('promotiom_img_url');

		//平台红包列表
        $redpacket_data = $this->redPacketBaseModel->redClassify();
        if($redpacket_data)
        {
            $data['redpacket']['item'] = $redpacket_data;
        }

        //导航轮播(id固定)
        $picture_data = $this->Advs_AdvConModel->getAdvList(array('group_id'=>11));
        if($picture_data)
        {
            $data['picture']['item']   = $picture_data['items'];
        }

		$title             = Web_ConfigModel::value("point_title");//首页名;
		$this->keyword     = Web_ConfigModel::value("point_keyword");//关键字;
		$this->description = Web_ConfigModel::value("point_description");//描述;
		$this->title       = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $title);
		$this->keyword       = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $this->keyword);
		$this->description       = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $this->description);


		if('json' == $this->typ)
		{

			$this->data->addBody(-140, $data);
		}
		else
		{
			include $this->view->getView();
		}

	}


	public function pList()
	{
		$order_row = array();
        $data = array();

        $User_GradeModel    = new User_GradeModel();
        $user_grade_row     = $User_GradeModel->getGradeList();
        $user_id = Perm::$userId;
        $data['user_grade'] = $user_grade_row;

        if (Perm::checkUserPerm())
        {
            $data['user_info']        = $this->userInfoModel->getUserInfo(array('user_id' => Perm::$userId));//用户信息，包含用户等级
            $data['user_resource']    = $this->userResourceModel->getUserResource(array('user_id' => Perm::$userId));//获取用户经验值和金蛋
            $data['ava_voucher_num']  = $this->voucherBaseModel->getAvaVoucherCountByUserId(Perm::$userId);   //用户可用代金券数量
            $data['points_order_num'] = $this->pointsOrderModel->getUserPointsGoodsCount(Perm::$userId);   //已兑换订单数量
            $data['points_cart_num']  = $this->pointsCartModel->getUserPointsCartCount(Perm::$userId);     //购物车数量

            $current_grade                        = $user_grade_row[$data['user_info']['user_grade']]; //当前等级信息
            $next_grade                           = $user_grade_row[$data['user_info']['user_grade'] + 1];  //下一等级信息
            $growth_diff                          = $data['user_resource']['user_growth'] - $current_grade['user_grade_demand'];//当前经验值与等级初始值之差
            $diff_grade_growth                    = $next_grade['user_grade_demand'] - $current_grade['user_grade_demand']; //两个不同等级之间的成长值差
            $data['growth']['grade_growth_start'] = $current_grade['user_grade_demand'];
            $data['growth']['grade_growth_end']   = $next_grade['user_grade_demand'];
            $data['growth']['next_grade_growth']  = $next_grade['user_grade_demand'] - $data['user_resource']['user_growth'];//距离下一级差多少经验值
            $data['growth']['grade_growth_per']   = sprintf("%.2f", $growth_diff / $diff_grade_growth) * 100;
        }

		//金蛋换购商品列表
		$cond_row['points_goods_shelves'] = Points_GoodsModel::ONSHELVES;

		if (request_int('level'))
		{
			$cond_row['points_goods_limitgrade:<='] = request_int('level');
		}
		if (request_int('points_min'))
		{
			$cond_row['points_goods_points:>='] = request_int('points_min');
		}
		if (request_int('points_max'))
		{
			$cond_row['points_goods_points:<='] = request_int('points_max');
		}
		if (request_int('isable') && Perm::checkUserPerm()) //查询可兑换的金蛋商品
		{
			$user_info                              = $this->userInfoModel->getUserInfo(array('user_id' => Perm::$userId));//用户信息，包含用户等级
			$cond_row['points_goods_limitgrade:<='] = $user_info['user_grade'];
		}
		//分页
		$YLB_Page           = new YLB_Page();
		$YLB_Page->listRows = request_int('listRows')?request_int('listRows'):20;
		$rows              = $YLB_Page->listRows;
		$offset            = request_int('firstRow', 0);
		$page              = ceil_r($offset / $rows);

		//排序
		$orderby = request_string('orderby');
		switch ($orderby)
		{
			case 'pointsasc':
				$order_row['points_goods_points'] = 'ASC';
				break;
			case 'pointsdesc':
				$order_row['points_goods_points'] = 'DESC';
				break;
			case 'stimeasc':
				$order_row['points_goods_add_time'] = 'ASC';
				break;
			case 'stimedesc':
				$order_row['points_goods_add_time'] = 'DESC';
				break;

			default:
			{
				$order_row['points_goods_sort'] = 'ASC';
				break;
			}
		}

		$data['points_goods'] = $this->pointsGoodsModel->getPointsGoodsList($cond_row, $order_row, $page, $rows);
		$YLB_Page->totalRows   = $data['points_goods']['totalsize'];
		$page_nav             = $YLB_Page->prompt();
        $data['redPacket']    = $this->redPacketBaseModel->getAvaRedPacketCountByUserId($user_id);
		if('json' == $this->typ)
		{
            $data['nav'] = $this->Shop_ClassModel->listClassWhere();

			$this->data->addBody(-140, $data);
		}
		else
		{
			$this->view->setMet('list');
			include $this->view->getView();
		}

	}

	public function detail()
	{
		$flag            = false;
		$data            = array();
		$points_goods_id = request_int('id');

		if ($points_goods_id)
		{
			$data['goods_detail'] = $this->pointsGoodsModel->getPointsGoodsByID($points_goods_id);
			if (!empty($data['goods_detail']))
			{
				$this->pointsGoodsModel->editPointsGoods($points_goods_id, array('points_goods_view' => 1), true);

				$User_GradeModel = new User_GradeModel();
				$user_grade      = $User_GradeModel->getGradeList();

				if ($data['goods_detail']['points_goods_limitgrade'] > 0)
				{
					$grade_row                                             = $User_GradeModel->getOne($data['goods_detail']['points_goods_limitgrade']);
					$data['goods_detail']['points_goods_limitgrade_label'] = $grade_row['user_grade_name'];
				}
				else
				{
					$data['goods_detail']['points_goods_limitgrade_label'] = '';
				}

				$cond_row_hot_goods['points_goods_recommend'] = Points_GoodsModel::RECOMMEND;
				$cond_row_hot_goods['points_goods_shelves']   = Points_GoodsModel::ONSHELVES;
				$order_row['points_goods_sort']               = 'ASC';
				$page                                         = 0;
				$rows                                         = 6;
				$data['hot_point_goods']                      = $this->pointsGoodsModel->getPointsGoodsList($cond_row_hot_goods, $order_row, $page, $rows);

                if ($data['hot_point_goods']['items'])
				{
					foreach ($data['hot_point_goods']['items'] as $key => $value)
					{
						if (in_array($value['points_goods_limitgrade'], array_keys($user_grade)))
						{
							$data['hot_point_goods']['items'][$key]['user_grade_limit_label'] = $user_grade[$value['points_goods_limitgrade']]['user_grade_name'];
						}
						else
						{
							$data['hot_point_goods']['items'][$key]['user_grade_limit_label'] = '';
						}
					}
				}

				$data['order_record'] = $this->pointsOrderModel->getPointsOrderList(array(), array('points_order_id' => 'DESC'), 1, 5);
			}
			else
			{
				location_go_back('查看的商品不存在！');
			}
		}
		else
		{
			location_go_back('查看的商品不存在！');
		}

		$title             = Web_ConfigModel::value("point_title_content");//首页名;
		$this->keyword     = Web_ConfigModel::value("point_keyword_content");//关键字;
		$this->description = Web_ConfigModel::value("point_description_content");//描述;
		$this->title       = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $title);
		$this->keyword       = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $this->keyword);
		$this->description       = str_replace("{sitename}", Web_ConfigModel::value("site_name"), $this->description);

		if('json' == $this->typ)
		{
			$this->data->addBody(-140, $data);
		}
		else
		{
			include $this->view->getView();
		}
	}

	public function pointsCart()
	{
		if (Perm::checkUserPerm())    //是否登录
		{
			$data                       = array();
			$points_goods_id_row        = array();
			$cond_row['points_user_id'] = Perm::$userId;
			$row                        = $this->pointsCartModel->getPointsCartByWhere($cond_row);

			if ($row)
			{
				foreach ($row as $key => $value)
				{
					$row[$key]['total_points'] = $value['points_goods_points'] * $value['points_goods_choosenum'];
					$points_goods_id_row[]     = $value['points_goods_id'];
				}
				$total_points = array_sum(array_column($row, 'total_points'));

				$points_goods_row = $this->pointsGoodsModel->getPointsGoods($points_goods_id_row);

				foreach ($row as $key => $value)
				{
					$stock = $points_goods_row[$value['points_goods_id']]['points_goods_storage'];

					//兑换的金蛋商品有数量限制
					if ($points_goods_row[$value['points_goods_id']]['points_goods_islimit'] == Points_GoodsModel::ISNUMLIMIT)
					{
						$stock = $points_goods_row[$value['points_goods_id']]['points_goods_limitnum'] > $stock ? $stock : $points_goods_row[$value['points_goods_id']]['points_goods_limitnum'];
					}
					$row[$key]['points_goods_stock'] = $stock;
				}

				$data['items']        = $row;
				$data['total_points'] = $total_points;

				$msg    = _('success');
				$status = 200;
			}
			else
			{
				$msg    = _('购物车为空');
				$status = 200;
			}
		}
		else
		{
			location_to(YLB_Registry::get('url') + '?ctl=Login&met=login');
		}

		if('json' == $this->typ)
		{
			$data['items'] = array_values($data['items']);
			$this->data->addBody(-140, $data, $msg, $status);
		}
		else
		{
			$this->view->setMet('cart');
			include $this->view->getView();
		}
	}

	//添加购物车
	public function addPointsCart()
	{
		$points_goods_id = request_int('points_goods_id');
		$quantity        = request_int('quantity');

		$cond_row_goods['points_goods_id']      = $points_goods_id;
		$cond_row_goods['points_goods_shelves'] = Points_GoodsModel::ONSHELVES;
		$points_goods_row                       = $this->pointsGoodsModel->getPointsGoodsDetailByWhere($cond_row_goods);

		//获取用户等级信息
		$user_info = $this->userInfoModel->getUserInfo(array('user_id' => Perm::$userId));//用户信息，包含用户等级

		//金蛋换购商品有会员等级限制，且当前会员等级不满足
		if ($points_goods_row['points_goods_limitgrade'] > 0 && $points_goods_row['points_goods_limitgrade'] > $user_info['user_grade'])
		{
			$msg  = _('对不起，您当前的等级不足，无法换购该商品！');
			$flag = false;
		}
		else
		{

			if ($points_goods_row['sell_state'] == Points_goodsModel::ONEXCHANGE)
			{

				//兑换的金蛋商品数量大于活动限购数量
				if ($points_goods_row['points_goods_islimit'] == Points_GoodsModel::ISNUMLIMIT && $quantity > $points_goods_row['points_goods_limitnum'])
				{
					$quantity = $points_goods_row['points_goods_limitnum'];
				}

				//购物车中是否已存在该金蛋商品
				$stock                                   = $points_goods_row['points_goods_storage'];
				$cond_row_points_cart['points_user_id']  = Perm::$userId;
				$cond_row_points_cart['points_goods_id'] = $points_goods_id;
				$points_cart_row                         = $this->pointsCartModel->getOnePointsCartByWhere($cond_row_points_cart);

				if ($points_cart_row)  //修改购物车中金蛋商品数量
				{

					if ($points_cart_row['points_goods_choosenum'] + $quantity > $stock)
					{
						$quantity                                 = $stock;
						$field_row_edit['points_goods_choosenum'] = $quantity;
						$update_flag                              = false;
					}
					else
					{
						$field_row_edit['points_goods_choosenum'] = $quantity;
						$update_flag                              = true;
					}

					$this->pointsCartModel->editPointsCart($points_cart_row['points_cart_id'], $field_row_edit, $update_flag);

					$points_cart_id = $points_cart_row['points_cart_id'];

					$flag = true;
				}
				else
				{

					if ($quantity > $stock)
					{
						$quantity                                = $stock;
						$field_row_add['points_goods_choosenum'] = $quantity;
					}
					else
					{
						$field_row_add['points_goods_choosenum'] = $quantity;
					}

					$field_row_add['points_user_id']      = Perm::$userId;
					$field_row_add['points_goods_id']     = $points_goods_id;
					$field_row_add['points_goods_name']   = $points_goods_row['points_goods_name'];
					$field_row_add['points_goods_points'] = $points_goods_row['points_goods_points'];
					$field_row_add['points_goods_image']  = $points_goods_row['points_goods_image'];
                    $flag                                 = $this->pointsCartModel->addCart($field_row_add, true);

					$points_cart_id = $flag;
				}
			}
			else
			{

				$msg  = _('对不起，该商品当前无法兑换！');
				$flag = false;
			}
		}

		if($flag)
		{
			$msg    = _('添加成功！');
			$status = 200;
		}
		else
		{
			$status = 250;
			$msg = $msg?$msg : _('添加失败！');
		}

		$data['quantity']        = $quantity;
		$data['points_goods_id'] = $points_goods_id;
        $data['points_cart_id']  = $points_cart_id;

		$this->data->addBody(-140, $data, $msg, $status);
	}


	//编辑购物车
	public function editPointsCart()
	{
		$data = array();
		if (Perm::checkUserPerm())
		{
			$points_cart_id = request_int('points_cart_id');
			$quantity       = request_int('quantity');

			$cond_row_cart['points_cart_id'] = $points_cart_id;
			$cond_row_cart['points_user_id'] = Perm::$userId;
			$point_cart_row                  = $this->pointsCartModel->getOnePointsCartByWhere($cond_row_cart);
			$point_goods_row                 = $this->pointsGoodsModel->getPointsGoodsByID($point_cart_row['points_goods_id']);
			$stock                           = $point_goods_row['points_goods_storage']; //库存数量

			if ($point_goods_row['points_goods_islimit'] == Points_GoodsModel::ISNUMLIMIT)
			{
				$limit_num = $point_goods_row['points_goods_limitnum'];
				$stock     = $limit_num < $stock ? $limit_num : $stock;
			}
			$quantity = $quantity < $stock ? $quantity : $stock;

			$field_row['points_goods_choosenum'] = $quantity;
			$this->pointsCartModel->editPointsCart($points_cart_id, $field_row, false);
			$flag                   = true;
			$data['points_cart_id'] = $points_cart_id;
			$data['quantity']       = $quantity;
			$data['total_points']   = $quantity * $point_goods_row['points_goods_points'];
		}
		else
		{
			$flag = false;
		}

		if ($flag)
		{
			$msg    = _('success');
			$status = 200;
		}
		else
		{
			$msg    = _('failure');
			$status = 250;
		}

		$this->data->addBody(-140, $data, $msg, $status);
	}

	public function removePointsCart()
	{
		$points_cart_id                  = request_row('id');

		if (is_array($points_cart_id))
		{
			$cond_row_cart['points_cart_id:IN'] = $points_cart_id;
		}
		else
		{
			$cond_row_cart['points_cart_id'] = $points_cart_id;
		}

		$cond_row_cart['points_user_id'] = Perm::$userId;
		$point_cart_rows                 = $this->pointsCartModel->getPointsCartByWhere($cond_row_cart);

		if ($point_cart_rows)
		{
			$remove_points_cart_id           = array_column($point_cart_rows, 'points_cart_id');
			$flag = $this->pointsCartModel->removePointsCart($remove_points_cart_id, true);
		}
		else
		{
			$flag = false;
		}

		if ($flag)
		{
			$msg    = _('删除成功！');
			$status = 200;
		}
		else
		{
			$msg    = _('删除失败！');
			$status = 250;
		}
		$data['points_cart_id'] = $points_cart_id;

		$this->data->addBody(-140, $data, $msg, $status);
	}

	public function confirm()
	{
		if (Perm::checkUserPerm())    //是否登录
		{
			$data                       	= array();
			$points_cart_id_row				= request_row('points_cart_id');
			$cond_row['points_cart_id:IN'] 	= $points_cart_id_row;
			$cond_row['points_user_id'] 	= Perm::$userId;
			$row                        	= $this->pointsCartModel->getPointsCartByWhere($cond_row);

			fb($row);
			if ($row)
			{
				$total_points = 0;
				foreach ($row as $key => $value)
				{
					$row[$key]['total_points'] = $value['points_goods_points'] * $value['points_goods_choosenum'];
					$total_points += $value['points_goods_points'] * $value['points_goods_choosenum'];
				}
				$data['items']        = $row;
				$data['total_points'] = $total_points;

				//获取收货地址
				$cond_address['user_id']                = Perm::$userId;
				$order_addr_row['user_address_default'] = 'DESC';
				$address                                = array_values($this->userAddressModel->getAddressList($cond_address, $order_addr_row));
				$data['address']                        = $address;
			}
			else
			{
				location_to(YLB_Registry::get('url') + '?ctl=Points&met=index');
			}
		}
		else
		{
			location_to(YLB_Registry::get('url') + '?ctl=Login&met=login');
		}

		if('json' == $this->typ)
		{
			$this->data->addBody(-140, $data);
		}
		else
		{
			include $this->view->getView();
		}

	}

	//提交金蛋换购订单
	public function addPointsOrder()
	{
		//判断用户是否登录
		if (Perm::checkUserPerm())
		{
			//获取用户等级信息
			//用户信息，包含用户等级
			$user_info                     = $this->userInfoModel->getUserInfo(array('user_id' => Perm::$userId));
			$points_cart_id_row            = request_row('point_cart_id');//购物车id

			$cond_row['points_cart_id:IN'] = $points_cart_id_row;
			$cond_row['points_user_id']    = Perm::$userId;
			$points_cart_row               = $this->pointsCartModel->getPointsCartByWhere($cond_row);

			if ($points_cart_row)
			{
				$total_points = 0;
				foreach ($points_cart_row as $key => $value)
				{
					$total_points += $value['points_goods_points'] * $value['points_goods_choosenum'];
				}

				$user_resource = $this->userResourceModel->getOne(Perm::$userId);

				if ($total_points <= $user_resource['user_points'])
				{
					$rs_row = array();
					//0、开启事务
					$this->pointsOrderModel->sql->startTransactionDb();
					//1、写入金蛋订单表
					$points_order_id                          = date("ymdhis") . rand(0000, 9999);
					$field_row_p_order['points_order_rid']    = $points_order_id;//订单号，规则为暂时的
					$field_row_p_order['points_buyerid']      = Perm::$userId;
					$field_row_p_order['points_buyername']    = $user_info['user_name'];
					$field_row_p_order['points_buyeremail']   = $user_info['user_email'];
					$field_row_p_order['points_allpoints']    = $total_points;
					$field_row_p_order['points_addtime']      = get_date_time();
					$field_row_p_order['points_ordermessage'] = request_string('remark');
					$flag_add_p_order                         = $this->pointsOrderModel->addPointsOrder($field_row_p_order, true);
					check_rs($flag_add_p_order, $rs_row);
					//2、写入金蛋订单商品表

					foreach ($points_cart_row as $key => $value)
					{
						$field_p_o_g_row                       = array();
						$field_p_o_g_row['points_orderid']     = $points_order_id;
						$field_p_o_g_row['points_goodsid']     = $value['points_goods_id'];
						$field_p_o_g_row['points_goodsname']   = $value['points_goods_name'];
						$field_p_o_g_row['points_goodspoints'] = $value['points_goods_points'];
						$field_p_o_g_row['points_goodsnum']    = $value['points_goods_choosenum'];
						$field_p_o_g_row['points_goodsimage']  = $value['points_goods_image'];
						$flag_p_o_goods                        = $this->pointsOrderGoodsModel->addPointsOrderGoods($field_p_o_g_row, true);
						check_rs($flag_p_o_goods, $rs_row);
					}
					//3、写入金蛋订单收货地址表(根据收货地址id获取用户的收货地址详细信息)
					//(1)根据用户选择的收货地址id，获取详细的收货地址信息
					//$delivery_row = $this->Delivery_BaseModel->getDeliveryInfo($delivery_id);
					//(2)将详细的收货信息入库
					$field_deliver_row['points_orderid']  = $points_order_id;
					$field_deliver_row['points_truename'] = request_string('receiver_name');//收货人姓名
					//$field_deliver_row['points_areaid'] =   request_string('');//地区id
					//$field_deliver_row['points_areainfo'] = request_string('');//地区内容
					$field_deliver_row['points_address'] = request_string('receiver_address');//详细地址
					//$field_deliver_row['points_zipcode'] =  request_string('');//邮政编码
					//$field_deliver_row['points_telphone'] = request_string('');//电话号码
					$field_deliver_row['points_mobphone'] = request_string('receiver_phone');//手机号码
					$flag_p_o_deliver                     = $this->pointsOrderAddressModel->addPointsOrderAddress($field_deliver_row, true);
					check_rs($flag_p_o_deliver, $rs_row);

					//4、更新用户金蛋值
					$field_row_points['user_points'] = '-' . $total_points;
					$edit_user_point_flag            = $this->userResourceModel->editResource(Perm::$userId, $field_row_points, true);
					check_rs($edit_user_point_flag, $rs_row);

					//5、写入用户金蛋日志
					$field_row_points_log['user_id']           = Perm::$userId;
					$field_row_points_log['points_log_type']   = 2;
					$field_row_points_log['class_id']          = Points_LogModel::ONCHANGE;
					$field_row_points_log['user_name']         = $user_info['user_name'];
					$field_row_points_log['points_log_points'] = $total_points;
					$field_row_points_log['points_log_time']   = get_date_time();
					$field_row_points_log['points_log_desc']   = _('金蛋换购商品');
					$Points_LogModel                           = new Points_LogModel();
					$add_p_log_flag                            = $Points_LogModel->addLog($field_row_points_log, true);
					check_rs($add_p_log_flag, $rs_row);

					//7、删除购物车
					$delete_flag = $this->pointsCartModel->removePointsCart($points_cart_id_row);
					check_rs($delete_flag, $rs_row);

					if (is_ok($rs_row) && $this->pointsOrderModel->sql->commitDb())
					{
						$msg    = _('订单提交成功');
						$status = 200;
					}
					else
					{
						$this->pointsOrderModel->sql->rollBackDb();
						$msg    = _('订单提交失败');
						$status = 250;
					}
				}
				else
				{
					$status = 260;
					$msg    = _('用户金蛋不足！');
				}
			}
		}
		else
		{
			$status = 250;
			$msg    = _('尚未登录！');
		}

		$data = array();
		$this->data->addBody(-140, $data, $msg, $status);
	}

    //多条件排序
	public function sort()
    {
        $uid = perm::$userId;
        $points = request_string('points');
        $grade = request_string('grade');
        $typ = request_string('typ');
        $fid = request_int('fid');
        $low = request_int('low');
        $tall=request_int('tall');
        $cond = request_int('cond');
        if($typ != 'json')
        {
            $this->data->setError(-140,'数据错误');
        }
        //判断是否为顶级类排序
        if(empty($points) && empty($grade))
        {
            $data['points_goods'] = $this->pointsGoodsModel->seekSort($fid,$uid);
        }
        else
        {
            //判断是否为多条件查询
            if(empty($low)&&empty($tall)&&empty($cond))
            {
                $data['points_goods'] = $this->pointsGoodsModel->seekSort($fid,$uid,$points,$grade);
            }
            else
            {
                $data['points_goods'] = $this->pointsGoodsModel->seekSort($fid,$uid,$points,$grade,$low,$tall,$cond);
            }

        }
        //获取的轮播图
        $data['picture']['item'] = $this->Advs_TypeModel->mainChild(11);

        $this->data->addBody(-140,$data);
    }

}

?>