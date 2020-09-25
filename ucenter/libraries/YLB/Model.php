<?php
//zend54   
//Date:20170909
?>
<?php
class YLB_Model
{
	public $_cacheKeyPrefix = "c|m|";
	public $_cacheName = "default";
	public $_tableName = "test";
	public $_tablePrimaryKey = "test_id";
	public $_cacheFlag = false;
	/**
     * 处理SQL语句类,
     * @access public
     * @var YLB_Sql
     */
	public $sql;
	/**
     * 存放程序中各种消息
     * @access public
     * @var YLB_Msg
     */
	public $msg;
	/**
     * @access public
     * @var User_Base
     */
	public $user;
	/**
	 * 加入主键名称，里面的内容为JSON，自动编解码
	 *
	 * @access public
	 * @var User_Base
	 */
	public $jsonKey = array();
	public $htmlKey = array();
	public $oriKey = array();

	public function __construct(&$db_id = NULL, &$user = NULL)
	{
		$this->sql = new YLB_Sql($db_id);
		$this->msg = YLB_Msg::getInstance();
		$this->user = &$user;

		if (YLB_Registry::isRegistered("server_id")) {
			$server_id = YLB_Registry::get("server_id");
			$this->_cacheKeyPrefix = $server_id . "|" . $this->_cacheKeyPrefix;
		}
	}

	public function _checkTableInfo()
	{
		if (empty($this->tableInfo)) {
			if (false) {
				$fields = array();
				$this->fields = $fields;
				return NULL;
			}

			$this->tableInfo = $this->_selectFields();
			if (true && $this->tableInfo) {
			}
		}

		$this->_tablePrimaryKey = $this->tableInfo["Key"]["PRI"];
		$this->fields = $this->tableInfo["Field"];
	}

	protected function _selectFields()
	{
		$sql = sprintf("show columns from %s", $this->_tableName);
		$rs = $this->sql->getAll($sql);
		$rows = array();

		if ($rs) {
			foreach ($rs as $v ) {
				if ($v["Key"]) {
					$rows["Key"][$v["Key"]] = $v["Field"];
				}

				$rows["Field"][] = $v["Field"];
			}
		}

		return $rows;
	}

	protected function _insert(&$a)
	{
		$data_row = array();
		$sql = "INSERT INTO " . $this->_tableName . " SET ";

		foreach ($a as $key => $value ) {
			if (in_array($key, $this->jsonKey)) {
				$value = encode_json($value);
			}
			else if (in_array($key, $this->htmlKey)) {
				require_once LIB_PATH . "/HTMLPurifier.auto.php";
				$purifier = new HTMLPurifier();
				$value = $purifier->purify($value);
			}
			else if (in_array($key, $this->oriKey)) {
			}
			else {
				$value = htmlspecialchars($value);
			}

			$data_row[] = $key . "='" . mres($value) . "'";
		}

		$sql .= implode(", ", $data_row);
		$rs = $this->sql->exec($sql);
		return $rs;
	}

	protected function _selectKey()
	{
		$sql = "SELECT  SQL_CALC_FOUND_ROWS " . $this->_tablePrimaryKey . " FROM " . $this->_tableName;
		$sql .= $this->sql->getWhere();
		$sql .= $this->sql->getOrder();
		$sql .= $this->sql->getLimit();
		$rs = $this->sql->getAll($sql);
		$rows = array();

		if ($rs) {
			foreach ($rs as $v ) {
				$rows[] = $v[$this->_tablePrimaryKey];
			}
		}

		return $rows;
	}

	protected function selectKeyLimit()
	{
		return $this->_selectKey();
	}

	protected function _select()
	{
		$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM " . $this->_tableName;
		$sql .= $this->sql->getWhere();
		$sql .= $this->sql->getOrder();
		$sql .= $this->sql->getLimit();
		$rs = $this->sql->getAll($sql);
		$rows = array();

		if ($rs) {
			foreach ($rs as $k => $v ) {
				foreach ($this->jsonKey as $col_key ) {
					if (isset($v[$col_key])) {
						$v[$col_key] = decode_json($v[$col_key]);
					}
				}

				$v["id"] = $v[$this->_tablePrimaryKey];
				$rows[$v[$this->_tablePrimaryKey]] = $v;
			}
		}

		return $rows;
	}

	protected function _selectByColumn($column = "")
	{
		$col_str = ", ";

		if (is_array($column)) {
			$col_str .= implode(", ", $column);
		}
		else if ($column) {
			$col_str .= $column;
		}
		else {
			$col_str = "";
		}

		$sql = "SELECT SQL_CALC_FOUND_ROWS " . $this->_tablePrimaryKey . $col_str . " FROM " . $this->_tableName;
		$sql .= $this->sql->getWhere();
		$sql .= $this->sql->getOrder();
		$sql .= $this->sql->getLimit();
		$rs = $this->sql->getAll($sql);
		$rows = array();

		if ($rs) {
			foreach ($rs as $k => $v ) {
				$rows[$v[$this->_tablePrimaryKey]] = $v;
			}
		}

		return $rows;
	}

	protected function _num()
	{
		$query = "SELECT count(*) as num FROM " . $this->_tableName;
		$query .= $this->sql->getWhere();
		$row = $this->sql->getRow($query);
		return $row["num"];
	}

	protected function getNum($cond_row)
	{
		if ($cond_row) {
			foreach ($cond_row as $k => $v ) {
				$k_row = explode(":", $k);

				if (1 < count($k_row)) {
					$this->sql->setWhere($k_row[0], $v, $k_row[1]);
				}
				else {
					$this->sql->setWhere($k, $v);
				}
			}
		}

		$num = $this->_num();
		return $num;
	}

	protected function _selectFoundRows()
	{
		$query = "SELECT FOUND_ROWS() total";
		$row = $this->sql->getRow($query);
		return $row["total"];
	}

	protected function _update(&$a, $flag = NULL)
	{
		$sql = "UPDATE " . $this->_tableName . " SET ";

		foreach ($a as $key => $value ) {
			if (in_array($key, $this->jsonKey)) {
				$value = encode_json($value);
			}
			else if (in_array($key, $this->htmlKey)) {
				require_once LIB_PATH . "/HTMLPurifier.auto.php";
				$purifier = new HTMLPurifier();
				$value = $purifier->purify($value);
			}
			else if (in_array($key, $this->oriKey)) {
			}
			else {
				$value = htmlspecialchars($value);
			}

			$value = mres($value);

			if ($flag) {
				$data_row[] = $key . "=" . $key . " + " . $value;
			}
			else {
				$data_row[] = $key . "= '" . $value . "'";
			}
		}

		$sql .= implode(",", $data_row);
		$sql .= $this->sql->getWhere();
		$update_flag = $this->sql->exec($sql);
		return $update_flag;
	}

	protected function _delete()
	{
		$sql = "DELETE FROM " . $this->_tableName;
		$sql .= $this->sql->getWhere();
		$del_flag = $this->sql->exec($sql);
		return $del_flag;
	}

	protected function getKey($primary_value = NULL, $primary_key = NULL)
	{
		$rows = false;
		$cond = array();

		if (NULL == $primary_key) {
			$cond[$this->_cacheKeyPrefix] = $primary_value;
		}
		else {
			$cond[$primary_key] = $primary_value;
		}

		$rows = $this->getKeyByMultiCond($cond);
		return $rows;
	}

	protected function removeKey($primary_value = NULL, $primary_key = NULL)
	{
		$cond = array();

		if (NULL == $primary_key) {
			$cond[$this->_cacheKeyPrefix] = $primary_value;
		}
		else {
			$cond[$primary_key] = $primary_value;
		}

		return $this->removeByMultiCond($cond);
	}

	protected function formatKV(&$item, $key)
	{
		$item = $key . "|" . $item;
	}

	protected function getKeyByMultiCond($cond_row, $order_row = array())
	{
		if ($cond_row) {
			foreach ($cond_row as $k => $v ) {
				$k_row = explode(":", $k);

				if (1 < count($k_row)) {
					$this->sql->setWhere($k_row[0], $v, $k_row[1]);
				}
				else {
					$this->sql->setWhere($k, $v);
				}
			}
		}

		if ($order_row) {
			foreach ($order_row as $k => $v ) {
				$this->sql->setOrder($k, $v);
			}
		}

		$rows = $this->_selectKey();
		return $rows;
	}

	protected function removeByMultiCond($cond_row = NULL)
	{
		ksort($cond_row);
		array_walk($cond_row, array($this, "formatKV"));
		$key_endfix = implode("|", $cond_row);
		$key = "keys|" . $key_endfix;
		return $this->removeCache($key);
	}

	protected function getCacheRow($id = NULL, &$need_cache_id_name)
	{
		fb($id);
		$rows = array();

		if (is_array($id)) {
			if ($this->_cacheFlag) {
				$YLB_Cache = YLB_Cache::create($this->_cacheName);
				$cache_key = array();
				$cache_key_index = array();

				foreach ($id as $item ) {
					$cache_key[] = $this->_cacheKeyPrefix . $item;
					$cache_key_index[$this->_cacheKeyPrefix . $item] = $item;
				}

				$rows_cache = array();
				$YLB_Registry = YLB_Registry::getInstance();

				if (!isset($YLB_Registry["config_cache"][$this->_cacheName])) {
					$this->_cacheName = "default";
				}

				if (1 == $YLB_Registry["config_cache"][$this->_cacheName]["cacheType"]) {
					foreach ($cache_key as $key_id ) {
						$tmp_data = $YLB_Cache->get($key_id);

						if (false === $tmp_data) {
						}
						else {
							$rows_cache[$key_id] = $tmp_data;
						}
					}
				}
				else {
					$rows_cache = $YLB_Cache->get($cache_key);
				}

				foreach ($cache_key as $val ) {
					if (!isset($rows_cache[$val])) {
						array_push($need_cache_id_name, $cache_key_index[$val]);
					}
					else {
						$rows = $rows + (array) $rows_cache[$val];
					}
				}
			}
		}

		return $rows;
	}

	protected function getCache($id = NULL)
	{
		$rows = array();

		if ($this->_cacheFlag) {
			$YLB_Cache = YLB_Cache::create($this->_cacheName);

			if ($id) {
				if (is_array($id)) {
					$cache_key = array();

					foreach ($id as $k => $v ) {
						$cache_key[] = $this->_cacheKeyPrefix . $v;
					}
				}
				else {
					$cache_key = $this->_cacheKeyPrefix . $id;
				}
			}
			else {
				$cache_key = $this->_cacheKeyPrefix . "all";
			}

			$rows = $YLB_Cache->get($cache_key);
		}

		fb($cache_key, "getCache");
		fb($rows);
		return $rows;
	}

	protected function setCacheRow($rows_db = NULL, $expire = NULL)
	{
		if ($this->_cacheFlag) {
			if (false !== $rows_db) {
				$YLB_Cache = YLB_Cache::create($this->_cacheName);

				foreach ($rows_db as $key => $val ) {
					$YLB_Registry = YLB_Registry::getInstance();

					if (!isset($YLB_Registry["config_cache"][$this->_cacheName])) {
						$this->_cacheName = "default";
					}

					if (1 == $YLB_Registry["config_cache"][$this->_cacheName]["cacheType"]) {
						$YLB_Cache->save(array($key => $val), $this->_cacheKeyPrefix . $key);
					}
					else {
						$YLB_Cache->save(array($key => $val), $this->_cacheKeyPrefix . $key, NULL, 0, $expire);
					}
				}
			}
		}
	}

	protected function setCache($rows_db, $key = NULL, $expire = NULL)
	{
		if ($this->_cacheFlag) {
			if (false !== $rows_db) {
				$YLB_Cache = YLB_Cache::create($this->_cacheName);
				$YLB_Registry = YLB_Registry::getInstance();

				if (!isset($YLB_Registry["config_cache"][$this->_cacheName])) {
					$this->_cacheName = "default";
				}

				if (1 == $YLB_Registry["config_cache"][$this->_cacheName]["cacheType"]) {
					if ($key) {
						return $YLB_Cache->save($rows_db, $this->_cacheKeyPrefix . $key);
					}
					else {
						return $YLB_Cache->save($rows_db, NULL);
					}
				}
				else if ($key) {
					return $YLB_Cache->save($rows_db, $this->_cacheKeyPrefix . $key, NULL, 0, $expire);
				}
				else {
					return $YLB_Cache->save($rows_db, NULL, NULL, 0, $expire);
				}
			}
		}
	}

	protected function removeCache($id = NULL)
	{
		$flag = false;

		if ($this->_cacheFlag) {
			$YLB_Cache = YLB_Cache::create($this->_cacheName);

			if ($id) {
				$cache_key = $this->_cacheKeyPrefix . $id;
			}
			else {
				$cache_key = $this->_cacheKeyPrefix . "all";
			}

			$flag = $YLB_Cache->remove($cache_key);
		}

		return $flag;
	}

	protected function getCacheKey()
	{
		return implode("|", func_get_args());
	}

	public function getOne($table_primary_key_value = NULL, $key_row = NULL)
	{
		$row = array();
		$rows = $this->get($table_primary_key_value);

		if ($rows) {
			$row = reset($rows);
		}

		return $row;
	}

	public function getByWhere($cond_row = array(), $order_row = array())
	{
		$key_rows = $this->getKeyByMultiCond($cond_row, $order_row);
		$data_rows = array();

		if ($key_rows) {
			$data_tmp_rows = $this->get($key_rows, NULL, $order_row);

			foreach ($key_rows as $id ) {
				if (isset($data_tmp_rows[$id])) {
					$data_rows[$id] = $data_tmp_rows[$id];
				}
			}
		}

		return $data_rows;
	}

	public function getKeyByWhere($cond_row, $order_row = array())
	{
		$key_rows = $this->getKeyByMultiCond($cond_row, $order_row);
		return $key_rows;
	}

	public function getOneByWhere($cond_row, $order_row = array())
	{
		$this->sql->setLimit(0, 1);
		$key_rows = $this->getKeyByMultiCond($cond_row, $order_row);
		$data_row = array();

		if ($key_rows) {
			$data_rows = $this->get($key_rows, NULL, $order_row);

			if ($data_rows) {
				$data_row = reset($data_rows);
			}
		}

		return $data_row;
	}

	public function listByWhere($cond_row, $order_row = array(), $page = 1, $rows = 100, $flag = true)
	{
		$offset = $rows * ($page - 1);
		$this->sql->setLimit($offset, $rows);
		$key_rows = $this->getKeyByMultiCond($cond_row, $order_row);
		$total = $this->getFoundRows();
		$data_rows = array();

		if ($key_rows) {
			$data_tmp_rows = $this->get($key_rows, NULL, $order_row);

			foreach ($key_rows as $id ) {
				if (isset($data_tmp_rows[$id])) {
					$data_rows[$id] = $data_tmp_rows[$id];
				}
			}
		}

		$data = array();
		$data["page"] = $page;
		$data["total"] = ceil_r($total / $rows);
		$data["totalsize"] = $total;
		$data["records"] = $total;

		if ($flag) {
			$data["items"] = array_values($data_rows);
		}
		else {
			$data["items"] = $data_rows;
		}

		return $data;
	}

	protected function get($table_primary_key_value = NULL, $key_row = NULL, $order_row = array())
	{
		$rows = array();

		if ($order_row) {
			foreach ($order_row as $k => $v ) {
				$this->sql->setOrder($k, $v);
			}
		}

		if (is_array($table_primary_key_value)) {
			if (!$table_primary_key_value) {
				return array();
				throw new Exception(sprintf(_("need input array  table_primary_key_value: \$_tableName=>%s"), $this->_tableName));
			}

			if ($this->_cacheFlag) {
				$need_cache_id_name = array();
				$rows = $this->getCacheRow($table_primary_key_value, $need_cache_id_name);
				$rows_db = array();

				if (!empty($need_cache_id_name)) {
					$this->sql->setWhere($this->_tablePrimaryKey, $need_cache_id_name, "IN");
					$rows_db = $this->_select();
				}

				$this->setCacheRow($rows_db);
				$rows = $rows + $rows_db;
			}
			else {
				$this->sql->setWhere($this->_tablePrimaryKey, $table_primary_key_value, "IN");
				$rows = $this->_select();
			}
		}
		else {
			if ($this->_cacheFlag) {
				$rows = $this->getCache($table_primary_key_value);
			}

			if (($this->_cacheFlag && (false === $rows)) || !$rows) {
				if ($table_primary_key_value && ("*" != $table_primary_key_value)) {
					$this->sql->setWhere($this->_tablePrimaryKey, $table_primary_key_value);
				}
				else if ("*" != $table_primary_key_value) {
					return array();
					throw new Exception(sprintf(_("%s : need input table_primary_key_value"), $this->_tableName));
				}

				$rows = $this->_select();
				if ($this->_cacheFlag && $rows) {
					if ($table_primary_key_value != "*") {
						$this->setCache($rows, $table_primary_key_value);
					}
				}
			}
		}

		if ($key_row && !empty($rows)) {
			$rows = array_reset($key_row, $rows);
		}

		return $rows;
	}

	public function getFoundRows()
	{
		$num = $this->_selectFoundRows();
		return $num;
	}

	protected function add($field_row, $return_insert_id = false)
	{
		$add_flag = $this->_insert($field_row);
		if ($add_flag && $return_insert_id) {
			$add_flag = $this->sql->insertId();
		}

		return $add_flag;
	}

	protected function edit($table_primary_key_value = NULL, $field_row, $flag = NULL)
	{
		$update_flag = false;

		if ($table_primary_key_value) {
			if (is_array($table_primary_key_value)) {
				$this->sql->setWhere($this->_tablePrimaryKey, $table_primary_key_value, "IN");
			}
			else {
				$this->sql->setWhere($this->_tablePrimaryKey, $table_primary_key_value);
			}

			$update_flag = $this->_update($field_row, $flag);
			if ($this->_cacheFlag && $update_flag) {
				if (is_array($table_primary_key_value)) {
					foreach ($table_primary_key_value as $key => $value ) {
						$this->removeCache($value);
					}
				}
				else {
					$this->removeCache($table_primary_key_value);
				}
			}
		}

		return $update_flag;
	}

	protected function editSingleField($table_primary_key_value, $field_name, $field_value_new, $field_value_old, $flag = NULL)
	{
		$update_flag = false;

		if ($table_primary_key_value) {
			$this->sql->setWhere($this->_tablePrimaryKey, $table_primary_key_value);
			$this->sql->setWhere($field_name, $field_value_old);
			$field_row = array();
			$field_row[$field_name] = $field_value_new;
			$update_flag = $this->_update($field_row, $flag);
			if ($this->_cacheFlag && $update_flag) {
				$this->removeCache($table_primary_key_value);
			}
		}

		return $update_flag;
	}

	protected function remove($table_primary_key_value)
	{
		$del_flag = false;

		if ($table_primary_key_value) {
			if (is_array($table_primary_key_value)) {
				$this->sql->setWhere($this->_tablePrimaryKey, $table_primary_key_value, "IN");
			}
			else {
				$this->sql->setWhere($this->_tablePrimaryKey, $table_primary_key_value);
			}

			$del_flag = $this->_delete();
			if ($this->_cacheFlag && $del_flag) {
				if (is_array($table_primary_key_value)) {
					foreach ($table_primary_key_value as $key => $value ) {
						$this->removeCache($value);
					}
				}
				else {
					$this->removeCache($table_primary_key_value);
				}
			}
		}

		return $del_flag;
	}
    //yang
    public function select($field = '*',$cond_row,$group)
    {
        if ($cond_row)
        {
            foreach ($cond_row as $k=>$v)
            {
                $k_row = explode(':', $k);

                if (count($k_row) > 1)
                {
                    $this->sql->setWhere($k_row[0], $v, $k_row[1]);
                }
                else
                {
                    $this->sql->setWhere($k, $v);
                }

            }
        }

        if($group)
        {
            $this->sql->setGroup($group);
        }

        $sql = $this->sql->select($field,$this->_tableName);
        $sql .= $this->sql->getWhere();
        $sql .= $this->sql->getGroup();
        $rs = $this->sql->getAll($sql);

        return $rs;

    }

    public  function  sql($sql){
        $rs = $this->sql->getAll($sql);
        return $rs;
    }
}


