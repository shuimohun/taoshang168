<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Controller extends YLB_AppController
{
	public function __construct(&$ctl, $met, $typ)
	{
		parent::__construct($ctl, $met, $typ);
		$this->initBuyerInfo();
	}
	public function initBuyerInfo()
	{
		$user_id = Perm::$userId;
		$User_InfoModel = new User_InfoModel();
		$this->user_info      = $User_InfoModel->getInfo($user_id);

		if($user_id)
        {
            $key                     = YLB_Registry::get('paycenter_api_key');
            $url                     = YLB_Registry::get('shop_api_url');
            $paycenter_app_id        = YLB_Registry::get('paycenter_app_id');
            $formvars['app_id']		 = $paycenter_app_id;
            $formvars['from_app_id'] = YLB_Registry::get('shop_app_id');
            $formvars['user_id']	 = Perm::$userId;

            $rs = get_url_with_encrypt($key, sprintf('%s?ctl=Api_User_Base&met=isSeller&typ=json',$url), $formvars);
            //是卖家
            if($rs['status'] == 200)
            {
                Perm::$shopId = $rs['data']['shop_id'];
            }
        }

	}
}

?>