<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Api_FeedCtl extends Api_Controller
{
	public function __construct(&$ctl, $met, $typ)
	{
		parent::__construct($ctl, $met, $typ);

		$this->feedBaseModel     = new Feed_BaseModel();
	}
    
    
    /**
     * 列表数据
     *
     * @access public
     */
    public function lists()
    {
        $page = request_int('page');
        $rows = request_int('rows');
        $sort = request_int('sord');
        
        $cond_row  = array();
        $order_row = array('feed_time'=>'DESC');

        $data = $this->feedBaseModel->getBaseList($cond_row, $order_row, $page, $rows);
        
        $this->data->addBody(-140, $data);
    }
}

?>