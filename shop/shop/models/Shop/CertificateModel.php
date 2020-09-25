<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Shop_CertificateModel extends Shop_Certificate
{

	/**
	 * 根据多个条件取得
	 *
	 * @param  array $cond_row
	 * @return array $rows 信息
	 * @access public
	 */
	public function getCertificateWhere($cond_row = array(), $order_row = array())
	{
		return $this->getByWhere($cond_row, $order_row);
	}

    public function getCertificateList($cond_row = array(), $order_row = array(), $page = 1, $rows = 100)
    {
        return $this->listByWhere($cond_row, $order_row, $page, $rows);
    }

    public function getOneCertificate($cond_row = array(), $order_row = array())
    {
        return $this->getOneByWhere($cond_row, $order_row);
    }


    /**
     * 插入
     * @param array $field_row 插入数据信息
     * @param bool $return_insert_id 是否返回inset id
     * @param array $field_row 信息
     * @return bool  是否成功
     * @access public
     */
    public function addCertificate($field_row, $return_insert_id = false)
    {
        $add_flag = $this->add($field_row, $return_insert_id);
        return $add_flag;
    }

    public function removeCertificate($config_key)
    {
        $del_flag = $this->remove($config_key);
        return $del_flag;
    }

    public function editCertificate($config_key = null, $field_row)
    {
        $update_flag = $this->edit($config_key, $field_row);
        return $update_flag;
    }



}

?>