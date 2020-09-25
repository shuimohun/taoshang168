<?php
//zend54   
//Date:20170909
?>
<?php
class YLB_AppController extends YLB_Controller
{
	/**
     * 默认控制的模型
     * 
     * @access public
     * @var Object $YLB_Model
     */
	public $model;
	/**
     * 调用模板类，控制视图
     * 
     * @access public
     * @var string|null
     */
	public $view;
	/**
     * format json data  for Ajax  
     *
     * @var YLB_Data
     */
	public $data;

	public function __construct(&$ctl, $met, $typ)
	{
		parent::__construct($ctl, $met, $typ);

		if (true || ("e" == $this->typ)) {

			$themes = &$GLOBALS["themes"];

			$themes_name = &$GLOBALS["themes_name"];
			$pro_path_row = &$GLOBALS["pro_path_row"];

			$this->view = new YLB_View($this->ctl, $this->met);
			$this->view->stc = YLB_Registry::get("static_url");
			$this->view->img = YLB_Registry::get("static_url") . "/images";
			$this->view->css = YLB_Registry::get("static_url") . "/css";
			$this->view->js = YLB_Registry::get("static_url") . "/js";
			$this->view->stc_com = str_replace($themes_name, "common", $this->view->stc);
			$this->view->img_com = $this->view->stc_com . "/images";
			$this->view->css_com = $this->view->stc_com . "/css";
			$this->view->js_com = $this->view->stc_com . "/js";

			if (isset($pro_path_row[1]))
			{
				$this->view->url = $pro_path_row[1] . "";
            }
			else
            {
				$this->view->url = "";
			}

			$this->data = new YLB_Data();

		}
		else {

			$this->data = new YLB_Data();
		}

		$this->init();

	}

	public function __call($method, $args)
	{
		error_header(404, "Page Not Found");
		throw new Exception("请检查 \$act 及 " . $this->met . " 是否正确， 类不存在传入的方法！");
	}

	public function run()
	{
		call_user_func(array($this, $this->met));
	}

	public function getDataRows()
	{
		$rs = $this->data->getDataRows();
		return $rs;
	}

	public function index()
	{
		//phpinfo();
	}

	public function init()
	{

	}

	public function getData()
	{
		if ("e" == $this->typ) {
			$d = ob_get_contents();
			ob_end_clean();
			ob_start();
		}
		else {
			$d = $this->getDataRows();
		}

		return $d;
	}

	public function showMsg($msg = "发生错误", $msg_type = "错误", $status = 250)
	{
		if ("e" == $this->typ) {
			include $this->view->getMsgPath();
			exit();
		}
		else {
			$data = new YLB_Data();
			$data->setError($msg, array(), $status);
			$d = $data->getDataRows();
			$protocol_data = YLB_Data::encodeProtocolData($d);
			echo $protocol_data;
			exit();
		}

		return false;
	}
}


