<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Base_DistrictCtl extends Controller
{
	public $baseDistrictModel = null;
        public $subSiteModel = null;
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
		$this->baseDistrictModel = new Base_DistrictModel();
                $this->subSiteModel = new Sub_SiteModel();
	}

	/**
	 *
	 *
	 * @access public
	 */
	public function district()
	{
		$district_parent_id = request_int('pid', request_int('area_id'));
		$data               = $this->baseDistrictModel->getDistrictTree($district_parent_id);
		$this->data->addBody(-140, $data);
	}

	public function getAllDistrict()
	{
		$data = $this->baseDistrictModel->getDistrictAll();

		
		$this->data->addBody(-140, $data);
	}

	public function getDistrictNameList()
	{
		$district_name = request_string('name');

		$data = $this->baseDistrictModel->getCookieDistrictName($district_name);

		$this->data->addBody(-140, $data);
	}

	public function getDistrictName()
	{
		$district_id = request_int('id');

		$data = $this->baseDistrictModel->getOne($district_id);

		$this->data->addBody(-140, $data);
	}
	
	public function getDistrictInfo()
	{
		$area = request_string('area');
		$cond_rows['district_name:LIKE'] = '%'.$area . '%';
		$data = $this->baseDistrictModel->getOneByWhere($cond_rows);
		
//		if($data)
//		{
//			setcookie("areaId", $data['district_id']);
//		}
		$this->data->addBody(-140, $data);
	}
        
        
//        public function getsubSiteInfo()
//	{
//		$area = request_string('area');
//		$cond_row['sub_site_name:LIKE'] = '%'.$area . '%';
//                $data = $this->subSiteModel->getOneByWhere($cond_row);
//                
//                
//                $cond_rows['district_name:LIKE'] = '%'.$area . '%';
//		$datas = $this->baseDistrictModel->getOneByWhere($cond_rows);
//		if($datas)
//		{
//			setcookie("areaId", $datas['district_id']);
//		}
//                
//		$this->data->addBody(-140, $data);
//	}
        
        public function subSite()
        {
            $sub_site_parent_id = request_int('pid', request_int('sub_site_id'));
            $cond_row['sub_site_parent_id'] =  $sub_site_parent_id;
            $cond_row['sub_site_is_open'] =  Sub_SiteModel::SUB_SITE_IS_OPEN;
            $data_rows = $this->subSiteModel->getByWhere($cond_row);

            $data['items'] = array_values($data_rows);
            $this->data->addBody(-140, $data);
        }

}

?>