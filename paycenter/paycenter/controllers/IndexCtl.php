<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class IndexCtl extends Controller
{
	public function __construct(&$ctl, $met, $typ)
	{
		parent::__construct($ctl, $met, $typ);
	}

	//首页
	public function index()
	{
        if (!Perm::checkUserPerm())
        {
            $login_url   = YLB_Registry::get('ucenter_api_url') . '?ctl=Login&met=index&typ=e';

            $callback = YLB_Registry::get('base_url') . '?ctl=Login&met=check&typ=e&redirect=' . urlencode(request_string('forward'));

            $login_url = $login_url . '&from=shop&callback=' . urlencode($callback);
            setcookie('comeUrl',getenv("HTTP_REFERER"));

            header('location:' . $login_url);
            exit();
        }
        else
        {
            header('location:' . YLB_Registry::get('base_url') . '/index.php?ctl=Info&met=index');
            exit();
        }
	}
}

?>