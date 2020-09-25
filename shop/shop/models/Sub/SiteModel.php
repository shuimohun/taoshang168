<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Sub_SiteModel extends Sub_Site
{
    const SUB_SITE_IS_OPEN = 1;//开启分站

	/**
	 * 读取分页列表
	 *
	 * @param  int $district_id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getSubSiteList($cond_row = array(), $order_row = array('district_displayorder' => 'ASC'), $page = 1, $rows = 100)
	{
		return $this->listByWhere($cond_row, $order_row, $page, $rows);
	}
    
    /**
     * 
     * @param type $sub_site_id
     * @return type
     *   
     *  获取分站子id
     */
    public function getDistrictChildId($sub_site_id){
        //分站筛选
            $subsite_info = $this->getSubsite($sub_site_id);
            //获取地区信息
            if(isset($subsite_info[$sub_site_id]['district_child_ids']) && $subsite_info[$sub_site_id]['district_child_ids']){
                $sub_site_district_ids = explode(',', $subsite_info[$sub_site_id]['district_child_ids']);
                return $sub_site_district_ids;
            }else{
                return false;
            }
    }


}

?>