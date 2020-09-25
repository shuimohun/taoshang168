<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author
 */
class Api_CheckCtl extends YLB_AppController
{
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
	}

    public function check()
    {
        $data['flag'] = 0;
        $id = request_string('id');
        $Equipment = new Equipment();
        $row_count = $Equipment->getRowCount(array('id'=>$id));

        if($row_count)
        {
            $data['flag'] = 1;
        }
        if($this->typ == 'json')
        {
            $this->data->addBody(-140,$data);
        }
    }
}

?>