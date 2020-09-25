<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Order_GoodsVirtualCodeModel extends Order_GoodsVirtualCode
{
	const SHOP_STATUS_OPEN  = 3;  //����
	const VIRTUAL_CODE_NEW  = 0;    //����һ���δʹ��?
	const VIRTUAL_CODE_USED = 1;    //����һ�����ʹ��?

	public function __construct()
	{
		parent::__construct();
		$this->codeUse = array(
			'0' => _('��ʹ��'),
			'1' => _('δʹ��'),
		);
	}


	public function getVirtualCode($cond_row = array())
	{
		$data = $this->getByWhere($cond_row);

		foreach ($data as $key => $val)
		{
			$data[$key]['code_status'] = $this->codeUse[$val['virtual_code_status']];
		}

		return $data;
	}

}

?>