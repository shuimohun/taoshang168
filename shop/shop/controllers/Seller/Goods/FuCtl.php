<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}
 
/**
 * @author     windfnn
 */
class Seller_Goods_FuCtl extends Seller_Controller
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
 
	/**
	 * 送福免单
	 *
	 * @access public
	 */
	public function index()
	{
        if(Perm::$shopId)
        {
            $data   = [];

            $page   = request_int('page',1);
            $rows   = request_int('rows',10);
            $offset = $rows * ($page - 1);

            $query_start_date = request_string('query_start_date');
            $query_end_date   = request_string('query_end_date');
            $fu_status        = request_int('fu_status');

            $cond_sql = ' WHERE a.shop_id = ' . Perm::$shopId . ' ';
            if($query_start_date)
            {
                $cond_sql .= "AND fu_record_time >= '$query_start_date' ";
            }
            if($query_end_date)
            {
                $cond_sql .= "AND fu_record_time <= '$query_end_date' ";
            }
            if($fu_status && isset(Fu_RecordModel::$status_array_map[$fu_status]))
            {
                $cond_sql .= "AND status = $fu_status ";
            }

            $FuRecordModel = new Fu_RecordModel();
            $count_sql = "SELECT COUNT(*) count FROM " . TABEL_PREFIX . "fu_record a" . $cond_sql;
            $total = $FuRecordModel->selectSql($count_sql);

            if($total)
            {
                $total = pos($total);
                $total = $total['count'];

                $sql = 'SELECT a.*,b.fu_base base,b.goods_name,b.goods_price,b.goods_spec,b.goods_image,c.order_goods_amount FROM `'.TABEL_PREFIX.'fu_record` a ';
                $sql .= 'LEFT JOIN `'.TABEL_PREFIX.'fu_base` b ON a.fu_id = b.fu_id ';
                $sql .= 'LEFT JOIN `'.TABEL_PREFIX.'order_goods` c ON a.order_id = c.order_id AND a.goods_id = b.goods_id ';
                $sql .= $cond_sql;
                $sql .= "ORDER BY fu_record_time DESC LIMIT $offset,$rows";

                $data['page'] = $page;
                $data['total'] = ceil_r($total / $rows);  //total page
                $data['totalsize'] = $total;
                $data['records'] = $total;
                $data['items'] = $FuRecordModel->selectSql($sql);

                foreach ($data['items'] as $key => $value)
                {
                    $fu_base = decode_json($value['fu_base']);
                    $base = decode_json($value['base']);

                    $data['items'][$key]['fu_base'] = $fu_base;
                    $data['items'][$key]['base'] = $base;
                    $data['items'][$key]['status_con'] = Fu_RecordModel::$status_array_map[$value['status']];
                }
            }

            if ('json' == $this->typ)
            {
                $YLB_Page = new YLB_Page();
                $YLB_Page->nowPage    = $page;
                $YLB_Page->listRows   = $rows;
                $YLB_Page->totalPages = $data['total'];
                $page_nav             = $YLB_Page->ajaxPromptII();
                $data['page_nav'] = $page_nav;
                $this->data->addBody(-140, $data);
            }
            else
            {
                $YLB_Page = new YLB_Page();
                $YLB_Page->nowPage    = $page;
                $YLB_Page->listRows   = $rows;
                $YLB_Page->totalPages = $data['total'];
                $page_nav             = $YLB_Page->promptII();

                include $this->view->getView();
            }
        }
	}
}

?>