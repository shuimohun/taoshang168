<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Api_ImCtl extends Api_Controller
{
    public function __construct(&$ctl, $met, $typ)
    {
        parent::__construct($ctl, $met, $typ);
    }

    /*
     * IM配置获取
     *
     */
    public function im()
    {
        $data['im_appId'] = Web_ConfigModel::value('im_appId');
        $data['im_appToken'] = Web_ConfigModel::value('im_appToken');
        $this->data->addBody(-140, $data);

    }
}
?>