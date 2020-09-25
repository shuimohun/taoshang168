<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Goods_CatCtl extends Controller
{
	public $goodsCatModel = null;

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
		$this->initData();
		$this->web = $this->webConfig();
		$this->nav = $this->navIndex();
		$this->cat = $this->catIndex();
		//include $this->view->getView();
		$this->goodsCatModel = new Goods_CatModel();
	}

	/**
	 * 设置商城API网址及key - 后台独立使用
	 *
	 * @access public
	 */
	public function cat()
	{
		$Goods_CatModel = new Goods_CatModel();

		if (isset($_REQUEST['cat_parent_id']))
		{
			$cat_parent_id = request_int('cat_parent_id', 0);

			$data_rows     = $Goods_CatModel->getCatTreeData($cat_parent_id, false, 1);
			$data['items'] = array_values($data_rows);

		}
		else
		{
			$data = $Goods_CatModel->getCatTree();

			if ( request_string('filter') )
			{
				$Goods_CatModel->filterCatTreeData( $data['items'] );
				$data['items'] = array_values($data['items']);
			}

		}

		if (0 == $cat_parent_id)
        {
            $Mb_CatImageModel = new Mb_CatImageModel();

            $cat_img_rows = $Mb_CatImageModel->getByWhere(array());
            //$cat_img_rows = $Mb_CatImageModel->getByWhere(array('cat_id'=>$cat_id_row));
    
            $img_row = array();
            
            foreach ($cat_img_rows as $id=>$cat_img_row)
            {
                $img_row[$cat_img_row['cat_id']] = $cat_img_row['mb_cat_image'];
            }
            
            foreach ($data['items'] as $k=>$item)
            {
                if (isset($img_row[$item['cat_id']]))
                {
                    $data['items'][$k]['cat_pic'] = $img_row[$item['cat_id']];
                    
                }
            }
        }
		
		$this->data->addBody(-140, $data);
	}


	public function tree()
	{
		$Goods_CatModel = new Goods_CatModel();

		$cat_parent_id = request_int('cat_parent_id', 0);

		$data['items'] = $Goods_CatModel->getChildCat($cat_parent_id);

		$this->data->addBody(-140, $data);
	}


	public function goodsCatList()
	{
		$Goods_CatModel = new Goods_CatModel();
		$data           = $Goods_CatModel->getGoodsCatList();

		//最近浏览
		$user_id             = Perm::$userId;
		$User_FootprintModel = new User_FootprintModel();
		$data_foot           = $User_FootprintModel->getByWhere(array('user_id' => $user_id), array('footprint_time' => 'desc'));
		$common_id_rows      = array_column($data_foot, 'common_id');
		$common_id_rows      = array_unique($common_id_rows);
		$common_id_rows      = array_slice($common_id_rows, 0, 4);
		$Goods_CommonModel   = new Goods_CommonModel();
		$data_recommon       = $Goods_CommonModel->listByWhere(array('common_id:in' => $common_id_rows), array('common_sell_time' => 'desc'), 0, 4);
		$data_recommon_goods = $Goods_CommonModel->getRecommonRow($data_recommon);


		$scareBuyModel = new ScareBuy_BaseModel();
        $scare_cond['scarebuy_state']       = ScareBuy_BaseModel::NORMAL;
        $scare_cond['scarebuy_starttime:>']  = date('Y-m-d H:i:s',time()-86400);
        $scare_cond['scarebuy_starttime:<'] 	  = get_date_time();
        $scare_cond['scarebuy_endtime:>'] 	  = get_date_time();
        $order_row['scarebuy_recommend']    = 'DESC';
        $order_row['scarebuy_buy_quantity'] = 'DESC';
        $scarebuy_goods = $scareBuyModel->getScareBuyGoodsList($scare_cond, $order_row, 1, 6);

        $data_scarebuy_goods = $scarebuy_goods['items'];
		include $this->view->getView();
	}

	//获取一级类目
	public function getOneCat()
    {
        $cat_cond['cat_parent_id'] = 0;
        $cat_cond['cat_is_display'] = 1;
        $cat_order['cat_displayorder']= 'ASC';
        $data = $this->goodsCatModel->getByWhere($cat_cond,$cat_order);

        $goods_cat_ids = array_keys($data);
        $goodsCatNavModel = new Goods_CatNavModel();
        $cat_nav_cond['goods_cat_id:IN'] = $goods_cat_ids;
        $goods_cat_nav = $goodsCatNavModel->getByWhere($cat_nav_cond);
        foreach ($goods_cat_nav as $key=>$value)
        {
            if($data[$value['goods_cat_id']])
            {
                $data[$value['goods_cat_id']]['nav_name'] = $value['goods_cat_nav_name'];
            }
        }

        $data = array_values($data);

        $this->data->addBody(-140, $data);
    }

    public function searchCat()
    {
        $data = array();
        $Goods_CatModel = new Goods_CatModel();
        $search_key = request_string('search_key','');
        if($search_key && !empty($search_key))
        {
            $cond_row['cat_name:LIKE'] = '%'.$search_key.'%';
            $goods_cat_data = $Goods_CatModel->getByWhere($cond_row);

            if($goods_cat_data)
            {
                foreach ($goods_cat_data as $key => $value)
                {
                    $goods_cat = $Goods_CatModel->getOne($value['cat_id']);
                    $pid = $goods_cat['cat_parent_id'];
                    $data[$key][] = $goods_cat;

                    $Goods_CatModel->filterCatTreeData($data[$key]);

                    if($data[$key])
                    {
                        while ($pid != 0)
                        {
                            $data[$key][] = $goods_cat = $Goods_CatModel->getOne($goods_cat['cat_parent_id']);
                            $pid = $goods_cat['cat_parent_id'];
                        }

                        $data[$key] = array_reverse($data[$key]);
                    }
                    else
                    {
                        unset($data[$key]);
                    }
                }
            }
        }

        $this->data->addBody(-140, $data);
    }

    public function test()
    {
        /*$Goods_CatModel = new Goods_CatModel();
        $cat_rows       = $Goods_CatModel->getCatTreeData(0, false, 0, true);
        $this->data->addBody(-140, $cat_rows);*/
    }

    //Zhenzh 获取分类
    public function getCatNew()
    {
        $cat_id = request_string('cat_id', 0);
        $data   = $this->goodsCatModel->getCatTreeDataByStep($cat_id, 0, 0);
        $this->data->addBody(-140, array_values($data));
    }

    public function getCat()
    {
        $data = array();
        $goods_cat_id = request_int('goods_cat_id');
        if($goods_cat_id)
        {
            $GoodsCatModel = new Goods_CatModel();
            $row = $GoodsCatModel->getOne($goods_cat_id);
            if($row['cat_is_display'])
            {
                $status = 200;
                $msg    = 'success';

                $data['cat_id']   = $row['cat_id'];
                $data['cat_name'] = $row['cat_name'];
            }
            else
            {
                $status = 250;
                $msg = '没有此分类';
            }
        }
        $this->data->addBody(-140, $data,$msg,$status);
    }

}

?>