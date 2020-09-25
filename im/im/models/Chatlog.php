<?php if (!defined('ROOT_PATH')) exit('No Permission');
/*
聊天记录的，写入，读取。

业务逻辑

weichat: sunkangchina

*/
class Chatlog extends YLB_Model
{
    public $_cacheKeyPrefix  = 'c|chatlog|';
    public $_cacheName       = 'chatlog';
    public $_tableName       = 'chatlog';
    public $_tablePrimaryKey = 'id';

    /**
     * @param string $user  User Object
     * @var   string $db_id 指定需要连接的数据库Id
     * @return void
     */
    public function __construct(&$db_id='im-builder', &$user=null)
    {
        $this->_tableName = TABEL_PREFIX . $this->_tableName;
		$this->_cacheFlag = CHE;
        parent::__construct($db_id, $user);
    }

    /**
     * 取得聊天记录
     *
     * @param  int   $app_id  主键值
     * @return array $rows 返回的查询内容
     * @access public
     */
    public function getChatlog($condition=null, $sort_key_row=null)
    {
        //没有传聊天，发送者 或 接收者，直接跳出
        if(!$_GET['u'] || !$_GET['to'])
        {
            return;
        }
        //先取得用户信息

        $in = new User_BaseModel();

        /*$info1 = $in->getInfo($_GET['u']);
        $info2 = $in->getInfo($_GET['to']);*/

        $data = array();
        $info = $in->getUserDetail(array($_GET['u'],$_GET['to']));
        if($info)
        {
            foreach ($info as $key=>$value)
            {
                $data[$value['user_id']] = $value;
            }
        }

        //显示几天内的聊天记录
        $day = $_GET['day']?:7;

        $start = time()-$day*86400;
         
        $rows = $this->listByWhere($condition, array('id'=>'asc'),(int)$_GET['page'],999999999);

        $sql = "SELECT * FROM `".$this->_tableName."` WHERE  (`sender`='".$_GET['u']."'  AND `receiver`='".$_GET['to']."' AND created >= ".$start.") OR (`sender`='".$_GET['to']."' AND `receiver`='".$_GET['u']."' AND created >= ".$start." ) ";
        
        $rows['items'] = $this->sql->getAll($sql);
        
        $rows['user'][$_GET['u']] = $data[$_GET['u']];
        $rows['user'][$_GET['to']] = $data[$_GET['to']];
        return $rows;
    }

    public function getChatlogHtml($arr)
    {
        $rows = $arr['items'];
        $user = $arr['user'];
        $str = '';
        foreach($rows as $v)
        {
            $ti = $v['created'];
            if(date('Ymd') == date('Ymd',$ti))
            {
                $time = "今天 ".date('H:i:s',$ti);
            }
            else
            {
                $time = date('Y-m-d H:i:s',$ti);
            }

            if($_GET['u'] == $v['sender'])
            {
                $class = 'to_msg';
                $class_time = 'to-msg-time';

            }
            else
            {
                $class = 'from_msg';
                $class_time = 'from-msg-time';
            }

            $v['content'] = html_entity_decode($v['content']);
            $str .= '<div class="'.$class.'" m_id="'.$v['msgid'].'" id="'.$v['sender'].'_'.$v['msgid'].'" content_type="'.$v['type'].'" content_you="'.$v['receiver'].'" style="display:block"><span class="user-avatar sss"><img src="'.$user[$v['sender']]['user_avatar'].'"></span><dl><dt class="'.$class_time.'">'.$time.'</dt><dd class="to-msg-text" style="margin-left: 0px;">  '.$v['content'].'</dd><dd class="arrow"></dd></dl></div>';

        }
        return $str;
    }

    /**
     * 插入
     * @param array $field_row 插入数据信息
     * @param bool  $return_insert_id 是否返回inset id
     * @param array $field_row 信息
     * @return bool  是否成功
     * @access public
     */
    public function addChatlog($field_row, $return_insert_id=true)
    {
        
        $add_flag = $this->add($field_row, $return_insert_id);

        //$this->removeKey($app_id);
        return $add_flag;
    }



}