<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 
 * 
 * @category   Framework
 * @package    __init__
 * @author     WenQingTeng
 * @copyright  Copyright (c) 2010, ������
 * @version    1.0
 * @todo       
 */
class Pay_PaymentChannel extends YLB_Model
{
    public $_cacheKeyPrefix  = 'c|pay_payment_channel|';
    public $_cacheName       = 'pay';
    public $_tableName       = 'payment_channel';
    public $_tablePrimaryKey = 'payment_channel_id';

    /**
     * @param string $user  User Object
     * @var   string $db_id ָ����Ҫ���ӵ����ݿ�Id
     * @return void
     */
    public function __construct(&$db_id='paycenter_way', &$user=null)
    {
        $this->_tableName = TABEL_PREFIX . $this->_tableName;
        parent::__construct($db_id, $user);
    }

    /**
     * ��������ֵ�������ݿ��ȡ����
     *
     * @param  int   $payment_channel_id  ����ֵ
     * @return array $rows ���صĲ�ѯ����
     * @access public
     */
    public function getPaymentChannel($payment_channel_id=null, $sort_key_row=null)
    {
        $rows = array();
        $rows = $this->get($payment_channel_id, $sort_key_row);

        return $rows;
    }

    /**
     * ����
     * @param array $field_row ����������Ϣ
     * @param bool  $return_insert_id �Ƿ񷵻�inset id
     * @param array $field_row ��Ϣ
     * @return bool  �Ƿ�ɹ�
     * @access public
     */
    public function addPaymentChannel($field_row, $return_insert_id=false)
    {
        $add_flag = $this->add($field_row, $return_insert_id);

        //$this->removeKey($payment_channel_id);
        return $add_flag;
    }

    /**
     * �����������±�����
     * @param mix   $payment_channel_id  ����
     * @param array $field_row   key=>value����
     * @return bool $update_flag �Ƿ�ɹ�
     * @access public
     */
    public function editPaymentChannel($payment_channel_id=null, $field_row)
    {
        $update_flag = $this->edit($payment_channel_id, $field_row);

        return $update_flag;
    }

    /**
     * ���µ����ֶ�
     * @param mix   $payment_channel_id
     * @param array $field_name
     * @param array $field_value_new
     * @param array $field_value_old
     * @return bool $update_flag �Ƿ�ɹ�
     * @access public
     */
    public function editPaymentChannelSingleField($payment_channel_id, $field_name, $field_value_new, $field_value_old)
    {
        $update_flag = $this->editSingleField($payment_channel_id, $field_name, $field_value_new, $field_value_old);

        return $update_flag;
    }    
    
    /**
     * ɾ������
     * @param int $payment_channel_id
     * @return bool $del_flag �Ƿ�ɹ�
     * @access public
     */
    public function removePaymentChannel($payment_channel_id)
    {
        $del_flag = $this->remove($payment_channel_id);

        //$this->removeKey($payment_channel_id);
        return $del_flag;
    }
}
?>