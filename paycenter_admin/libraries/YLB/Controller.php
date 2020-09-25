<?php
//zend54   
//Date:20170909
?>
<?php
class YLB_Controller
{
	/**
     * 控制器程序文件所在目录
     * 
     * @access public
     * @var string|null
     */
	public $ctl;
	/**
     * 控制器类默认调用的方法
     * 
     * @access public
     * @var string|null
     */
	public $met;
	/**
     * 返回个客户端数据类型，html|json
     * 
     * e : 为普通字符串
     * o : 为JSON数组
     * 
     * @access public
     * @var string|null
     */
	public $typ;
	/**
     * 控制器程序类名称
     * 
     * @access public
     * @var string|null
     */
	public $className;
	/**
     * 控制器程序类路径
     * 
     * @access public
     * @var string|null
     */
	public $path;

	public function __construct($ctl, $met, $typ)
	{
		$this->ctl = &$ctl;
		$this->met = &$met;
		$this->typ = &$typ;
		$this->className = $this->ctl;
		$this->path = CTL_PATH . "/" . implode("/", explode("_", $this->ctl)) . ".php";
	}
}


