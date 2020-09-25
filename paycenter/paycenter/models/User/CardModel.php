<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     WenQingTeng
 */
class User_CardModel extends User_Card
{
    public static $_bank_card_statu = array(
        '0'=>'已上传'
    );
    public function addUserCard($field_row, $return_insert_id=false)
    {
        $add_flag = $this->add($field_row, $return_insert_id);
        return $add_flag;
    }

    public function editUserCard($card_id=null, $field_row)
    {
        $update_flag = $this->edit($card_id, $field_row);

        return $update_flag;
    }

    /**
     *
     * @param 根据card_id删除
     */
    public function delUserCard()
    {
        $card_id = request_int('card_id');
        $User_CardModel = new User_CardModel();
        $flag = $User_CardModel->remove($card_id);

        if($flag){
        return true;
        }else{
            return false;
        }
        
    }

	/**
	 * 读取分页列表
	 */
	public function getUserCardList($cond_row= array(),$order_row=array(),$page=1, $rows=100)
	{
        $data = $this->listByWhere($cond_row, $order_row , $page, $rows);
           foreach($data['items'] as $key=>$value){
               $data['items'][$key]['card_statu_con'] = self::$_bank_card_statu[$value['card_statu']];
           }
		return $data;
	}

    public function getUserCardByWhere($cond_row= array(),$order_row=array())
    {
        $data = $this->getByWhere($cond_row,$order_row);
        foreach ($data as $key=>$val)
        {
            $bank_cond_row['bank_id'] = $val['bank_id'];

            $bank_baseModel = new Bank_BaseModel();
            $bank_base = $bank_baseModel->getOneByWhere($bank_cond_row);
            $data[$key]['bank'] = $bank_base;
        }
        return $data;
    }

    public function getOneUserCardByWhere($cond_row= array(),$order_row=array())
    {
        $data = $this->getOneByWhere($cond_row,$order_row);

        $bank_cond_row['bank_id'] = $data['bank_id'];
        $bank_baseModel = new Bank_BaseModel();
        $bank_base = $bank_baseModel->getOneByWhere($bank_cond_row);
        $data['bank'] = $bank_base;

        return $data;
    }

}
?>