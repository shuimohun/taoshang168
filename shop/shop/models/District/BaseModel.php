<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * User: zzh
 * Date: 2017/02/16
 * Time: 17:25
 */
class District_BaseModel extends District_Base
{
	const NORMAL = 1;//开启
	const END    = 2;//关闭
	const CANCEL = 3;//管理员关闭
	public static $state_array_map = array(
		self::NORMAL => '开启',
		self::END => '关闭',
		self::CANCEL => '管理员关闭'
	);

	public $Price_BaseModel = null;

	public function __construct()
	{
		parent::__construct();

		$this->Price_GoodsModel = new Price_GoodsModel();
	}
	//执行sql
    public function sql($sql){
        return $this->sql->getAll($sql);
    }
    //顶级父类-yang
    public function getTopParentCat($district_id)
    {
        $row =$this->getOneByWhere(array('district_id'=>$district_id));
        while ($row['district_parent_id'] != 0)
        {
            $row = $this->getTopParentCat($row['district_parent_id']);
        }
        return $row;

    }
}