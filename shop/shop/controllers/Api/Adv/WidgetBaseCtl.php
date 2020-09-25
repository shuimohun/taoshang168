<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Api_Adv_WidgetBaseCtl extends Api_Controller
{
	public function __construct(&$ctl, $met, $typ)
	{
		parent::__construct($ctl, $met, $typ);
	}

	public function advWidgetBaseList()
	{
		$Adv_WidgetBaseModel = new Adv_WidgetBaseModel();
		$Adv_WidgetItemModel = new Adv_WidgetItemModel();

		$page      = request_int('page');
		$rows      = request_int('rows');
		$cond_row  = array();
		$order_row = array();

		$data = $Adv_WidgetBaseModel->listByWhere($cond_row, $order_row, $page, $rows);

		$items = $data['items'];
		unset($data['items']);
		if (!empty($items))
		{
			foreach ($items as $key => $value)
			{
				switch ($value['widget_type'])
				{
					case $Adv_WidgetBaseModel::WIDGET_TYPE_PIC:
						$items[$key]['widget_type_name'] = _('图片');
						break;
					case $Adv_WidgetBaseModel::WIDGET_TYPE_SLIDE:
						$items[$key]['widget_type_name'] = _('幻灯片');
						break;
					case $Adv_WidgetBaseModel::WIDGET_TYPE_SCROLL:
						$items[$key]['widget_type_name'] = _('滚动');
						break;
					case $Adv_WidgetBaseModel::WIDGET_TYPE_WRIT:
						$items[$key]['widget_type_name'] = _('文字');
						break;
				}
				$widget_id  = $value['widget_id'];
				$data_items = $Adv_WidgetItemModel->getByWhere(array('widget_id' => $widget_id));
				if (count($data_items) > 1)
				{
					$items[$key]['widget_display_type'] = _('多广告显示');
				}
				else
				{
					$items[$key]['widget_display_type'] = _('单广告显示');
				}
				$data_items_active               = $Adv_WidgetItemModel->getByWhere(array(
																						'widget_id' => $widget_id,
																						'item_active' => 1
																					));
				$items[$key]['active_items_num'] = count($data_items_active);
				if ($value['widget_active'] == $Adv_WidgetBaseModel::WIDGET_ACTIVE_TRUE)
				{
					$items[$key]['widget_active_type'] = _('是');
				}
				elseif ($value['widget_active'] == $Adv_WidgetBaseModel::WIDGET_ACTIVE_TRUE)
				{
					$items[$key]['widget_active_type'] = _('否');
				}
			}
		}

		if ($items)
		{
			$msg    = _('success');
			$status = 200;
		}
		else
		{
			$msg    = _('failure');
			$status = 250;
		}
		$data['items'] = $items;
		$this->data->addBody(-140, $data, $msg, $status);
	}

}

?>