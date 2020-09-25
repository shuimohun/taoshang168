<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * Api接口, 让App等调用
 *
 *
 * @category   Game
 * @package    User
 * @author     WenQingTeng
 * @copyright  Copyright (c) 2017, 温庆腾
 * @version    1.0
 * @todo
 */
class Api_Goods_GoodsCtl extends YLB_AppController
{
	/**
	 * 验证API是否正确
	 *
	 * @access public
	 */
	public function listCommon()
	{
        $goodsCatModel = new Goods_CatModel();
		$page = request_int('page', 1);
		$rows = request_int('rows', 100);

		$order_row = array();
		$sidx      = request_string('sidx');
		$sord      = request_string('sord', 'asc');
        $type      = request_string('type');
		if ($sidx)
		{
			$order_row[$sidx] = $sord;
		}
        $start_date   = date("Y-m-d", strtotime("this week"));
        $end_date = date("Y-m-d", strtotime("this week +6 day"));
		$cond_row = array();
        //本周新增上架商品数量
        if($type=='sj'){
            $cond_row['common_state'] = 1;
            $cond_row['common_add_time:>='] = $start_date;
            $cond_row['common_add_time:<='] = $end_date;
        }
        //新增未上架商品数量
        if($type=='wsj'){
            $cond_row['common_state'] = 0;
//            $cond_row['common_add_time:>='] = $start_date;
//            $cond_row['common_add_time:<='] = $end_date;
        }
        //上架商品
        if($type=='goods_sj'){
            $cond_row['common_state'] = 1;
        }
        if (request_int('unlike'))
        {
            $cond_row['is_like'] = 0;
        }

//		if (-1 != request_int('cat_id', -1))
//		{
//			$cond_row['cat_id'] = request_int('cat_id');
//		}

		if (-1 != request_int('brand_id', -1))
		{
			$cond_row['brand_id'] = request_int('brand_id');
		}

		if (-1 != request_int('common_state', -1))
		{
			$cond_row['common_state'] = request_int('common_state');
		}

		if (-1 != request_int('common_verify', -1))
		{
			$cond_row['common_verify'] = request_int('common_verify');
		}

		if (request_int('common_id'))
		{
			$cond_row['common_id'] = request_int('common_id');
		}
        //根据goods_id查询   wdp 17/11/20
        if(request_int('goods_id')){
            $Goods_BaseModel =  new Goods_BaseModel();
            $base = $Goods_BaseModel->getOneByWhere(array('goods_id'=>request_int('goods_id')));
            $cond_row['common_id'] = $base['common_id'];
        }

		if (request_string('common_name'))
		{
			$cond_row['common_name:LIKE'] = '%' . request_string('common_name') . '%';
		}

		if (request_string('shop_name'))
		{
			$cond_row['shop_name:LIKE'] = '%' . request_string('shop_name') . '%';
		}

		if (-1 != request_int('brand_id', -1))
		{
			$cond_row['brand_id'] = request_int('brand_id');
		}
		$c_id = request_int('cat_id');
            if ($c_id) {
                //查找该分类下所有的子分类
                $cat_list = $goodsCatModel->getCatChildId($c_id);
                if(!$cat_list){
                    $cond_row['cat_id:IN'] = $c_id;
                }else{
                    $cond_row['cat_id:IN'] = $cat_list;
                }
            }

        //分站筛选
        $sub_site_id = request_int('sub_site_id');
        $sub_flag = true;
        if($sub_site_id > 0){
            //获取站点信息
            $Sub_SiteModel = new Sub_SiteModel();
            $sub_site_district_ids = $Sub_SiteModel->getDistrictChildId($sub_site_id);
            if(!$sub_site_district_ids){
                $sub_flag = false;
            }else{
                $cond_row['district_id:IN'] = $sub_site_district_ids;
            }
        }

        if($sub_flag == false){
            $status = 250;
			$msg    = _('分站信息获取失败');
            $this->data->addBody(-140, array(), $msg, $status);
        }else{
            $Goods_CommonModel = new Goods_CommonModel();
            $data              = $Goods_CommonModel->getCommonList($cond_row, $order_row, $page, $rows);

            if ($data)
            {
                $status = 200;
                $msg    = _('success');
            }
            else
            {
                $status = 250;
                $msg    = _('没有满足条件的结果哦');
            }
            $this->data->addBody(-140, $data, $msg, $status);
        }
	}

	/**
	 * 取得商品分类信息
	 *
	 * @access public
	 */
	public function getCatList()
	{
		if (-1 != request_int('cat_id', -1))
		{
			$cond_row['cat_id'] = request_int('cat_id');
		}

		$order_row = array(
			'cat_displayorder',
			'ASC'
		);

		$Goods_CatModel = new Goods_CatModel();
		$data           = $Goods_CatModel->getCatList($cond_row['cat_id'], $order_row);
		$this->data->addBody(-140, $data);
	}

	/**
	 * 取得商品分类信息
	 *
	 * @access public
	 */
	public function getBrand()
	{
		$order_row = array(
			'brand_displayorder',
			'ASC'
		);

		$Goods_BrandModel = new Goods_BrandModel();
		$data             = $Goods_BrandModel->getBrandList(array(), $order_row, 1, 10000);
		$this->data->addBody(-140, $data);
	}

	/**
	 * 取得各种下拉框
	 *
	 * @access public
	 */
	public function getStateCombo()
	{
		$Goods_CommonModel = new Goods_CommonModel();
		$data              = $Goods_CommonModel->getStateCombo();


		$this->data->addBody(-140, $data);
	}

	/**
	 * 编辑状态
	 *
	 * @access public
	 */
	public function editCommonState()
	{
		$Goods_CommonModel = new Goods_CommonModel();

		$common_id           = request_int('common_id');
		$common_state        = request_int('common_state');
		$common_state_remark = request_string('common_state_remark');

		if ($common_id && array_key_exists($common_state, Goods_CommonModel::$stateMap))
		{

			$flag = $Goods_CommonModel->editCommon($common_id, array('common_state' => $common_state));

			if ($flag !== false)
			{
				$msg    = _('success');
				$status = 200;

				//将用户发布或者修改的商品同步到im中
				$key      = YLB_Registry::get('im_api_key');
				$url         = YLB_Registry::get('im_api_url');
				$im_app_id = YLB_Registry::get('im_app_id');
				$formvars = array();

				$formvars['goods_common_id']    = $common_id;
				$formvars['app_id']        = $im_app_id;

				$formvars['goods_status'] = $common_state;
				$rs = get_url_with_encrypt($key, sprintf('%s?ctl=Api_User_Goods&met=editUserGoodsStatus&typ=json', $url), $formvars);

                $shop = $Goods_CommonModel->getOne($common_id);
                $shop_id = $shop['shop_id'];
                $Shp_BaseModel = new Shop_BaseModel();
                $shop_data = $Shp_BaseModel->getOne($shop_id);

                //商品违规被下架
                //[des][common_id]
                $message = new MessageModel();
                $message->sendMessage('Commodity violation is under the shelf',$shop_data['user_id'], $shop_data['user_name'], $order_id = NULL, $shop_name = NULL, 1, 1, $end_time = Null,$common_id=$common_id,$goods_id=NULL,$common_state_remark);
			}
			else
			{
				$msg    = _('failure');
				$status = 250;
			}
		}
		else
		{
			$msg    = _('请求参数有误');
			$status = 250;

		}

		$this->data->addBody(-140, array(), $msg, $status);
	}


	/**
	 * 编辑状态
	 *
	 * @access public
	 */
	public function editCommonVerify()
	{
		$Goods_CommonModel = new Goods_CommonModel();

		$common_id            = request_int('common_id');
		$common_verify        = request_int('common_verify');
		$common_verify_remark = request_string('common_verify_remark');

		if ($common_id && array_key_exists($common_verify, Goods_CommonModel::$verifyMap))
		{

			$flag = $Goods_CommonModel->editCommon($common_id, array('common_verify' => $common_verify));

			if ($flag !== false)
			{
				$msg    = _('success');
				$status = 200;

				//将用户发布或者修改的商品同步到im中
				$key      = YLB_Registry::get('im_api_key');
				$url         = YLB_Registry::get('im_api_url');
				$im_app_id = YLB_Registry::get('im_app_id');
				$formvars = array();

				$formvars['goods_common_id']    = $common_id;
				$formvars['app_id']        = $im_app_id;

				$formvars['goods_verify'] = $common_verify;
				$rs = get_url_with_encrypt($key, sprintf('%s?ctl=Api_User_Goods&met=editUserGoodsVerify&typ=json', $url), $formvars);

                if($common_verify==0){
                    $shop = $Goods_CommonModel->getOne($common_id);
                    $shop_id = $shop['shop_id'];
                    $Shp_BaseModel = new Shop_BaseModel();
                    $shop_data = $Shp_BaseModel->getOne($shop_id);

                    //商品审核失败提醒
                    //[des][common_id]
                    $message = new MessageModel();
                    $message->sendMessage('Commodity audit failed to remind',$shop_data['user_id'], $shop_data['user_name'], $order_id = NULL, $shop_name = NULL, 1, 1, $end_time = Null,$common_id=$common_id,$goods_id=NULL,$common_verify_remark);
                }
			}
			else
			{
				$msg    = _('failure');
				$status = 250;
			}
		}
		else
		{
			$msg    = _('请求参数有误');
			$status = 250;

		}

		$this->data->addBody(-140, array('common_verify'=>$common_verify), $msg, $status);
	}

	/**
	 * 取得各种下拉框
	 *
	 * @access public
	 */
	public function removeCommon()
	{
		$Goods_CommonModel = new Goods_CommonModel();

		$common_id     = request_string('common_id');
		$common_id_row = explode(',', $common_id);

		$Goods_CommonModel->sql->startTransactionDb();

		$flag = $Goods_CommonModel->removeCommon($common_id_row);

		if ($flag && $Goods_CommonModel->sql->commitDb())
		{
			$msg    = _('success');
			$status = 200;
		}
		else
		{
			$Goods_CommonModel->sql->rollBackDb();

			$msg    = _('failure');
			$status = 250;
		}

		$this->data->addBody(-140, array('id' => $common_id_row), $msg, $status);
	}

	/**
	 * 取得商品SKU信息
	 *
	 * @access public
	 */
	public function getGoodsInfo()
	{
		$Goods_BaseModel = new Goods_BaseModel();

		$common_id = request_int('common_id');
		$data      = $Goods_BaseModel->getBaseListByCommonId($common_id);

		$this->data->addBody(-140, $data);
	}

	public function listGoodsRecommend()
	{
		$page      = request_int('page');
		$rows      = request_int('rows');
		$cond_row  = array();
		$order_row = array();

		$Goods_RecommendModel = new Goods_RecommendModel();
		$Goods_CatModel       = new Goods_CatModel();
		$data                 = $Goods_RecommendModel->getRecommendList($cond_row, $order_row, $page, $rows);
		$items                = $data['items'];
		unset($data['items']);
		if (!empty($items))
		{
			foreach ($items as $key => $value)
			{
				$cat_id                        = $value['goods_cat_id'];
				$items[$key]['goods_cat_name'] = $Goods_CatModel->getNameByCatid($value['goods_cat_id']);
			}
		}
		$data['items'] = $items;
		if ($items)
		{
			$msg    = _('success');
			$status = 200;
		}
		else
		{
			$msg    = _('failure');
			$status = 250;
		}
		$this->data->addBody(140, $data, $msg, $status);
	}


	//商品推荐
	public function getCatGoodsList()
	{
		$Goods_CommonModel = new Goods_CommonModel();

		$goods_cat_id = request_int('goods_cat_id');
		$goods_name   = request_string('goods_name');

		$YLB_Page           = new YLB_Page();
		$YLB_Page->listRows = 24;
		$rows              = $YLB_Page->listRows;
		$offset            = request_int('firstRow', 0);
		$page              = ceil_r($offset / $rows);

		$cond_row  = array();
		$order_row = array();

		if ($goods_cat_id > 0)
		{
            $goodsCatModel = new Goods_CatModel();
            $cat_list = $goodsCatModel->getCatChildId($goods_cat_id);
            $cat_list[] = $goods_cat_id;
            $cond_row['cat_id:IN'] = $cat_list;

		}

		if ($goods_name)
		{
			$cond_row['common_name:like'] = '%' . $goods_name . '%';
		}

		$cond_row['shop_status'] = Shop_BaseModel::SHOP_STATUS_OPEN;
		$cond_row['common_state'] = Goods_CommonModel::GOODS_STATE_NORMAL;
		$cond_row['common_verify'] = Goods_CommonModel::GOODS_VERIFY_ALLOW;

		$data = $Goods_CommonModel->getCommonList($cond_row, $order_row, $page, $rows);

		$YLB_Page->totalRows = $data['totalsize'];
		$page_nav           = $YLB_Page->ajaxprompt();
        $data['page_nav'] = $page_nav;
		$this->data->addBody(-140, $data);
	}

	//新增商品推荐
	public function addGoodsRecommend()
	{
		$Goods_RecommendModel      = new Goods_RecommendModel();
		$Goods_CatModel            = new Goods_CatModel();
		$add_data                  = array();
		$add_data['goods_cat_id']  = request_int('goods_cat_id');
		$cat_id                    = request_int('goods_cat_id');
		$goods_id_rows             = request_row('goods_id_list');
		$add_data['common_id']     = $goods_id_rows;
		$add_data['recommend_num'] = count($goods_id_rows);
		//判断分类是否已有推荐
		$data_old = $Goods_RecommendModel->getByWhere(array('goods_cat_id' => $cat_id));
		if (empty($data_old))
		{
			$goods_recommend_id = $Goods_RecommendModel->addRecommend($add_data, true);

			if ($goods_recommend_id)
			{
				$add_data['id'] = $goods_recommend_id;
				
				$msg    = _('success');
				$status = 200;
			}
			else
			{
				$msg    = _('failure');
				$status = 250;
			}

			$add_data['goods_cat_name'] = $Goods_CatModel->getNameByCatid($cat_id);

		}
		else
		{
			$msg      = _('该分类已有推荐');
			$status   = 250;
			$add_data = array();
		}

		$this->data->addBody(-140, $add_data, $msg, $status);
	}

	public function removeGoodsRecommend()
	{
		$Goods_RecommendModel = new Goods_RecommendModel();
		$id                   = request_int('id');
		$flag                 = $Goods_RecommendModel->removeRecommend($id);
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

		$this->data->addBody(-140, array(), $msg, $status);
	}

	public function getGoodsRecommendById()
	{
		$Goods_RecommendModel = new Goods_RecommendModel();
		$Goods_CommonModel    = new Goods_CommonModel();
		$id                   = request_int('id');
		$re                   = array();

		if ($id)
		{
			$data               = $Goods_RecommendModel->getOne($id);
			$goods_id_rows      = $data['common_id'];
			$cat_id             = $data['goods_cat_id'];
			$re                 = $Goods_CommonModel->getCommonList(array('common_id:in' => $goods_id_rows));
			$re['goods_cat_id'] = $cat_id;
		}
		if (!empty($re))
		{
			$msg    = _('success');
			$status = 200;
		}
		else
		{
			$msg    = _('failure');
			$status = 250;
		}

		$this->data->addBody(-140, $re, $msg, $status);
	}

	public function editGoodsRecommend()
	{
		$Goods_RecommendModel = new Goods_RecommendModel();
		$Goods_CatModel       = new Goods_CatModel();
		$edit_data            = array();

		$id            = request_int('id');
		$goods_cat_id  = request_int('goods_cat_id');
		$goods_id_rows = request_row('goods_id_list');

		if ($goods_cat_id != -1)
		{
			$edit_data['goods_cat_id'] = $goods_cat_id;
		}
		$edit_data['common_id']     = $goods_id_rows;
		$edit_data['recommend_num'] = count($goods_id_rows);

		$flag = $Goods_RecommendModel->editRecommend($id, $edit_data);

		if ($flag !== false)
		{
			$msg    = _('success');
			$status = 200;
		}
		else
		{
			$msg    = _('failure');
			$status = 250;
		}
		$data                       = array();
		$data_new                   = $Goods_RecommendModel->getOne($id);
		$data['goods_cat_name']     = $Goods_CatModel->getNameByCatid($data_new['goods_cat_id']);
		$data['goods_recommend_id'] = $data_new['goods_recommend_id'];
		$data['recommend_num']      = $data_new['recommend_num'];
		$data['id']                 = $data_new['goods_recommend_id'];
		$this->data->addBody(-140, $data, $msg, $status);
	}

	//审核商品
	public function checkGoods()
	{
		$Goods_CommonModel = new Goods_CommonModel();

		$ids = request_string('id');
		$id_rows = explode(',',$ids);

		if(!empty($id_rows))
		{
			foreach($id_rows as $key=>$value)
			{
				$common_id = $value;
				$goods_common = array();
				$goods_common['common_verify'] = $Goods_CommonModel::GOODS_VERIFY_ALLOW;
				$flag = $Goods_CommonModel->editCommon($common_id, $goods_common);
			}
		}
		$this->data->addBody(-140, $id_rows);
	}

	public function upGoods()
	{
		$Goods_CommonModel = new Goods_CommonModel();
		$Goods_BaseModel = new Goods_BaseModel();

		$ids = request_string('id');
		$id_rows = explode(',',$ids);

		if(!empty($id_rows))
		{
			foreach($id_rows as $key=>$value)
			{
				$common_id = $value;
				$goods_common = array();
				$goods_common['common_state'] = $Goods_CommonModel::GOODS_STATE_NORMAL;
				$flag = $Goods_CommonModel->editCommon($common_id, $goods_common);
				$goods_data = array();
				$goods_data = $Goods_BaseModel->getByWhere(array('common_id'=>$common_id));
				if(!empty($goods_data))
				{
					foreach($goods_data as $k=>$v)
					{
						$goods_id = $v['goods_id'];
						$edit_goods = array();
						$edit_goods['goods_is_shelves'] = $Goods_BaseModel::GOODS_UP;
						$id_rows[] = $goods_id;
						$flags = $Goods_BaseModel->editBaseFalse($goods_id, $edit_goods);
					}
				}
			}
		}

		$this->data->addBody(-140, $id_rows);
	}

}

?>