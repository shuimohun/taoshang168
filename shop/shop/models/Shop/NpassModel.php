<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Shop_NpassModel extends Shop_Npass
{

    public  static  $shop_npass_status = array(
        "1"=>"开店审核不通过",
        "2"=>"开店审核通过"
    );


	/**
	 * 根据多个条件取得
	 * @author yang
	 * @param  array $cond_row
	 * @return array $rows 信息
	 * @access public
	 */
	public function getNpassWhere($cond_row = array(), $order_row = array())
	{
		return $this->getByWhere($cond_row, $order_row);
	}

    /**
     * 读取店铺列表
     *
     * @author yang
     * @param  int $config_key 主键值
     * @return array $rows 返回的查询内容
     * @access public
     */
    public function getBaseList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
    {
        $data           = $this->listByWhere($cond_row, $order_row, $page, $rows);


        foreach ($data['items'] as $key =>$value){

            $data['items'][$key]['shop_status_name'] = $value['shop_npass_status'] == 1 ? '审核不通过' : '审核已通过';

            //添加时间30天后的日期
            $ntime = strtotime($value['shop_npass_ctime']);
            $stime = $ntime+30*24*3600;
            $npass_time = date('Y-m-d H:i:s',$stime);
            //如果现在日期超过30天后的日期  删除此信息
            if($npass_time <= get_date_time()){
                $this->removeNpass($value['npass_id']);
            }

        }

        return $data;
    }

}

?>