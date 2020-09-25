<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     WenQingTeng
 */
class User_MsgModel extends User_Msg
{

	/**
	 * 读取分页列表
	 *
	 * @param  int $msg_log_id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getMsgList($page=1, $rows=100, $sort='desc',$msg_sender=null, $msg_receiver=null)
	{
		//需要分页如何高效，易扩展
		$offset = $rows * ($page - 1);

		$this->sql->setLimit($offset, $rows);

		$msg_log_id_row = array();
		if($msg_sender)
		{
			$this->sql->setWhere('msg_sender',$msg_sender);
		}
		if($msg_receiver)
		{
			$this->sql->setWhere('msg_receiver',$msg_receiver);
		}
		/*if($beginDate)
		{
			$this->sql->setWhere('date_created',$beginDate);
		}*/

		$this->sql->setOrder('msg_log_id',$sort);
		$msg_log_id_row = $this->selectKeyLimit();

		//读取主键信息
		$total = $this->getFoundRows();

		$data_rows = array();

		if ($msg_log_id_row)
		{
			$data_rows = $this->getMsg($msg_log_id_row);
		}

		$data = array();
		$data['page'] = $page;
		$data['total'] = ceil_r($total / $rows);  //total page
		$data['totalsize'] = $data['total'];
		$data['records'] = count($data_rows);
		$data['items'] = array_values($data_rows);

		return $data;
	}

	public function getMsgBySender($msg_sender=null,$page=1, $rows=100, $sort='desc'){

		//需要分页如何高效，易扩展
		$offset = $rows * ($page - 1);

		$this->sql->setLimit($offset, $rows);

		$msg_id_row = array();
		if($msg_sender)
		{	
			$a=$this->sql->setwhere('msg_sender',$msg_sender);
		}
		$this->sql->setOrder('msg_log_id',$sort);
		$msg_id_row = $this->selectKeyLimit();
		//读取主键信息
		$total = $this->getFoundRows();

		$data_rows = array();

		if ($msg_id_row)
		{
			$data_rows = $this->getMsg($msg_id_row);
		}
		rsort($data_rows);
		$data = array();
		$data['page'] = $page;
		$data['total'] = ceil_r($total / $rows);  //total page
		$data['totalsize'] = $data['total'];
		$data['records'] = count($data_rows);
		$data['items'] = array_values($data_rows);

		return $data;
	}

	public function getMsgByReceiver($msg_receiver=null,$page=1, $rows=100, $sort='desc'){

		//需要分页如何高效，易扩展
		$offset = $rows * ($page - 1);

		$this->sql->setLimit($offset, $rows);

		$msg_id_row = array();
		if($msg_receiver)
		{	
			$a=$this->sql->setwhere('msg_receiver',$msg_receiver);
		}
		$this->sql->setOrder('msg_log_id',$sort);
		$msg_id_row = $this->selectKeyLimit();
		//读取主键信息
		$total = $this->getFoundRows();

		$data_rows = array();

		if ($msg_id_row)
		{
			$data_rows = $this->getMsg($msg_id_row);
		}
		rsort($data_rows);
		$data = array();
		$data['page'] = $page;
		$data['total'] = ceil_r($total / $rows);  //total page
		$data['totalsize'] = $data['total'];
		$data['records'] = count($data_rows);
		$data['items'] = array_values($data_rows);

		return $data;
	}
}
?>