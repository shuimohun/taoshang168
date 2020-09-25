<?php
/**
 * 数据库工厂模式
 * 
 * 通过这个类，统一管理Db类。
 * 
 * @category   Framework
 * @package    Db
 * @author     WenQingTeng
 * @copyright  Copyright (c) 2017, 温庆腾
 * @version    1.0
 * @todo       
 */
class YLB_Db
{

    /**
     * 构造函数
     *
     * @access    private
     */
    public function __construct()
    {
    }

    /**
     * 得到数据库句柄
     *
     * @param string $id      database id
     * @param array  $drive   使用的数据库驱动
     *
     * @return self::dbHandle   Db Object
     *
     * @access public
     */
    public static function get($id='data', $drive=DB_DRIVE)
    {
        //return $drive::get($id);
        if ('YLB_Db_Pear' == DB_DRIVE)
        {
            return YLB_Db_Pear::get($id);
        }
        elseif ('YLB_Db_PearMDb2' == DB_DRIVE)
        {
            return YLB_Db_PearMDb2::get($id);
        }
        else
        {
            return YLB_Db_Pdo::get($id);
        }
    }

    /**
     * 得到数据库句柄
     *
     * @param string $id      database id
     * @param array  $drive   使用的数据库驱动
     *
     * @return self::dbHandle   Db Object
     *
     * @access public
     */
    public static function close($id=null, $drive=DB_DRIVE)
    {
        if ('YLB_Db_Pear' == DB_DRIVE)
        {
            return YLB_Db_Pear::close($id);
        }
        elseif ('YLB_Db_PearMDb2' == DB_DRIVE)
        {
            return YLB_Db_PearMDb2::close($id);
        }
        else
        {
            return YLB_Db_Pdo::close($id);
        }
    }



    /**
     * 从数据库连接模式
     *
     * @param string $id      database id
     * @param array  $drive   使用的数据库驱动
     * @return bool   true/false
     * @access  public
     */
    public static function setConnectMode($mode, $drive=DB_DRIVE)//设置模式
    {
        if ('YLB_Db_Pear' == DB_DRIVE)
        {
            return YLB_Db_Pear::setConnectMode($mode);
        }
        elseif ('YLB_Db_PearMDb2' == DB_DRIVE)
        {
            return YLB_Db_PearMDb2::setConnectMode($mode);
        }
        else
        {
            return YLB_Db_Pdo::setConnectMode($mode);
        }
    }
}
?>