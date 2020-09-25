<?php
/**
 * 视图类
 * 
 * 用来管理html模板
 * 
 * @category   Framework
 * @package    View
 * @author     WenQingTeng
 * @copyright  Copyright (c) 2017, 温庆腾
 * @version    1.0
 * @todo       
 */
class YLB_View
{
    public $tpl;
    public $tplPath;

    public $stc;
    public $img;
    public $css;
    public $js ;

    public $ctl ;
    public $met ;

    public function __construct(&$ctl, &$met)
    {
		$this->ctl = $ctl;

		$this->setMet($met);
    }


	public function setMet($met)
	{
		$this->met = $met;

		$this->tpl = TPL_PATH . '/' . implode('/', explode('_', $this->ctl)) . '/' . $met . '.php';

		if (!is_file($this->tpl))
		{
			$this->tpl = TPL_DEFAULT_PATH . '/' . implode('/', explode('_', $this->ctl)) . '/' . $met . '.php';

			$this->tplPath = TPL_DEFAULT_PATH;
		}
		else
		{
			$this->tplPath = TPL_PATH;
		}
	}

    public function getDir()
    {
        return $this->tpl;
    }


    public function getView()
    {
        return $this->tpl;
    }

	public function getTplPath()
	{
		return $this->tplPath;
	}
}
?>