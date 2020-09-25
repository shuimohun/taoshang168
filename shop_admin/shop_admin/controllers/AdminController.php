<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class AdminController extends YLB_AppController
{
    public $adminRights = array();
    public $adminMenus = array();
    
	public function __construct(&$ctl, $met, $typ)
	{
		parent::__construct($ctl, $met, $typ);

        // 当前管理员权限
        $this->adminRights = $this->getAdminRights();

        // 当前页父级菜单 同级菜单 当前菜单
        $this->adminMenus = $this->getThisMenus();
	}
	
    /**
     * 创建菜单
     *
     * @return void
     */
    public function createMenu()
    {	
    	$this->ctl;
    	$this->met;
    }
    
	/**
	 * 不要建议使用
	 *
	 * @param string $method 方法名称
	 * @param string $args 参数
	 * @return void
	 */
	public function __call($method, $args)
	{
		$view = $this->view->getView();;
		$ctl = $_REQUEST['ctl'];
		$met = $_REQUEST['met'];

		$data = $this->getUrl($ctl, $met);

		if (is_file($view))
		{
			include $view;
		}
	}


	/**
	 * 不要建议使用
	 *
	 * @param string $method 方法名称
	 * @param string $args 参数
	 * @return void
	 */
	public function getUrl($ctl, $met, $typ = 'json', $jump=null, $formvars=null)
	{
		//本地读取远程信息
		$key = YLB_Registry::get('shop_api_key');;
		$url         = YLB_Registry::get('shop_api_url');
		$shop_app_id = YLB_Registry::get('shop_app_id');

		if (null === $formvars)
        {
            $formvars                  = $_POST;
    
            foreach ($_GET as $k => $item)
            {
                if ('ctl' != $k && 'met' != $k && 'typ' != $k && 'debug' != $k)
                {
                    $formvars[$k] = $item;
                }
            }
        }
        
        $formvars['app_id']        = $shop_app_id;
        $formvars['admin_account'] = Perm::$row['user_account'];
        $formvars['sub_site_id']   =  @Perm::$row['sub_site_id'];
		fb($formvars);


		$init_rs = get_url_with_encrypt($key, sprintf('%s?ctl=Api_%s&met=%s&typ=%s', $url, $ctl, $met, strtolower($typ)), $formvars, $typ, 'POST', $jump);

		$data = array();

		if (200 == $init_rs['status'])
		{
			//读取服务列表
			$data   = $init_rs['data'];
			$status = 200;
			$msg    = isset($init_rs['msg']) ? $init_rs['msg'] : _('sucess');
		}
		else
		{
			$status = 250;
			$msg    = isset($init_rs['msg']) ? $init_rs['msg'] : _('请求错误!');
		}

		{
			$this->data->addBody(-140, $data, $msg, $status);
		}

		return $data;
	}

	// 当前管理员权限
	public function getAdminRights(){
	    if ($this->adminRights)
        {
            return $this->adminRights;
        }
        if (Perm::checkUserPerm()){
        	// 已登录管理员的权限
		$User_BaseModel 			= new User_BaseModel();
		$Rights_GroupModel 			= new Rights_GroupModel();
		$user_id 					= Perm::$userId;

		$user 				= $User_BaseModel->getBase($user_id);
		$rights_group_id 	= $user[$user_id]['rights_group_id'];
		$rights_id 			= $Rights_GroupModel->getGroup($rights_group_id);
		$admin_rights 		= $rights_id[$rights_group_id]['rights_group_rights_ids'];

		return $admin_rights;
        }
		
	}

	// 获取当前页面的菜单 父级菜单 同级菜单
	public function getThisMenus(){
        if ($this->adminMenus)
        {
            return $this->adminMenus;
        }
        
        
		$menu_row = array();
		$ctl = substr($this->ctl,0,-3);
		$met = $this->met;
		$cut_num = strlen('ctl='.$ctl.'&met='.$met.'&');
		$param = substr($_SERVER["QUERY_STRING"],$cut_num);
        
        $param = str_replace('force-check=1', '', $param);
		
		$Menu_Base = new Menu_Base();
		$this_menu = $Menu_Base->getOneByWhere(array('menu_url_ctl'=>$ctl,'menu_url_met'=>$met,'menu_url_parem'=>$param));

        if ($this_menu)
        {
            $father_menu = $Menu_Base->getOneByWhere(array('menu_id'=>$this_menu['menu_parent_id']));
            
            if ($father_menu)
            {
                $brother_menu = $Menu_Base->getByWhere(array('menu_parent_id'=>$father_menu['menu_id']));
                if($brother_menu)
                {
                    foreach($brother_menu as $key=>$val)
                    {
                        switch($val['menu_name'])
                        {
                            case '首页':
                                $brother_menu[$key]['nctype'] = 'index';
                                break;
                            case '团购':
                                $brother_menu[$key]['nctype'] = 'tg';
                                break;
                            case '品牌':
                                $brother_menu[$key]['nctype'] = 'brand';
                                break;
                            case '金蛋商城':
                                $brother_menu[$key]['nctype'] = 'points';
                                break;
                            case '文章':
                                $brother_menu[$key]['nctype'] = 'article';
                                break;
                            case '店铺':
                                $brother_menu[$key]['nctype'] = 'shop';
                                break;
                            case '商品':
                                $brother_menu[$key]['nctype'] = 'product';
                                break;
                            case '商品分类':
                                $brother_menu[$key]['nctype'] = 'category';
                                break;
                            case 'SNS':
                                $brother_menu[$key]['nctype'] = 'sns';
                                break;
                            case '惠抢购':
                                $brother_menu[$key]['nctype'] = 'sc';
                                break;
                            case '自营超市':
                                $brother_menu[$key]['nctype'] = 'sf';
                                break;
                            case '生鲜特产':
                                $brother_menu[$key]['nctype'] = 'sx';
                                break;
                            case '新人专享':
                                $brother_menu[$key]['nctype'] = 'newbuyer';
                                break;
                            case '9.9':
                                $brother_menu[$key]['nctype'] = 'jiu';
                                break;
                            case '劲爆折扣':
                                $brother_menu[$key]['nctype'] = 'zk';
                                break;
                            case '排行榜':
                                $brother_menu[$key]['nctype'] = 'paihang';
                                break;
                            case '红包':
                                $brother_menu[$key]['nctype'] = 'hongbao';
                                break;
                            case '遇见好货':
                                $brother_menu[$key]['nctype'] = 'yujianhaohuo';
                                break;
                            case '家有儿女':
                                $brother_menu[$key]['nctype'] = 'ernv';
                                break;
                            case '每日必buy':
                                $brother_menu[$key]['nctype'] = 'meiri';
                                break;
                            case '发现好店':
                                $brother_menu[$key]['nctype'] = 'findshop';
                                break;
                        }
                    }
                }
            }
        }
        
		$menu_row['this_menu'] = @$this_menu;
		$menu_row['father_menu'] = @$father_menu;
		$menu_row['brother_menu'] = @$brother_menu;

		return $menu_row;
	}

}

?>