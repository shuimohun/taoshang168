<?php
/**
 * 消息类
 * 
 * 用来记录程序运行状态，成功及失败信息
 * 
 * @category   Framework
 * @package    Msg
 * @author     WenQingTeng
 * @copyright  Copyright (c) 2017, 温庆腾
 * @version    1.0
 * @todo       
 */
class YLB_Msg
{
    private static $_instance ; 
    private $messages        ; /* 消息处理         */
    private $error           ; /* 异常处理         */

    private function __construct()
    {
        $this->messages       = NULL;
        $this->error          = NULL;
        $this->BR             = "\n";
    }

    final public static function getInstance() 
    {
        if (!(self::$_instance instanceof self))
        {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * get messages
     *
     * @return string  $messages;
     * @access public
     *
     * @author WenQingTeng
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     *  set the message
     *
     * @param string  $msg;
     * @access public
     *
     * @author WenQingTeng
     */
    public function setMessages($msg = false)
    {
        $this->messages[] = $msg;
    }

    public function setError()
    {
        return $this->error = true;
    }


    public function getError()
    {
        return $this->error;
    }

    final private function __clone() 
    {
    } 
}
?>