<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
}

/**
 * @author     WenQingTeng
 */
class Information_LikeModel extends YLB_Model
{
    public $_cacheKeyPrefix = 'c|information_like|';
    public $_cacheName = 'information';
    public $_tableName = 'information_like';
    public $_tablePrimaryKey = 'id';

    public function __construct(&$db_id = 'shop',&$user = null){
        $this->_tableName = TABEL_PREFIX . $this->_tableName;
        parent::__construct($db_id,$user);
    }

    public function likeInfo($field_row,$return_insert_id){
       return $insert_id = $this->add($field_row,$return_insert_id);
    }


    public function unLikeInfo($field_row,$del_flag){
        $primary_key = $this->getKeyByWhere($field_row);
        return $del_flag = $this->remove($primary_key,$del_flag);
    }

    public function isLikeInfo($user_id,$information_id){
        $this->sql->setWhere('user_id',$user_id);
        $this->sql->setWhere('information_id',$information_id);
        return $res = $this->_num();
    }
    public function howLike($information_id){
        $this->sql->setwhere('information_id',$information_id);
        return $res =$this->_num();
    }
}

?>