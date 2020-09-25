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
	static 	public $jsonKey = array();

	public function __construct(&$db_id = NULL, &$user = NULL)
	{
		$this->sql = new YLB_Sql($db_id);
		$this->msg = YLB_Msg::getInstance();
		$this->user = &$user;
	}

	protected function _insert(&$a)
	{
		$data_row = array();
		$sql = "INSERT INTO " . $this->_tableName . " SET ";

		foreach ($a as $key => $value ) {
			if (in_array($key, self::$jsonKey)) {
				$value = encode_json($value);
			}

			$data_row[] = $key . "='" . mres($value) . "'";
		}

		$sql .= implode(", ", $data_row);
		$rs = $this->sql->exec($sql);
		return $rs;
	}

	protected function _selectKey()
	{
		$sql = "SELECT  " . $this->_tablePrimaryKey . " FROM " . $this->_tableName;
		$sql .= $this->sql->getWhere();
		$rs = $this->sql->getAll($sql);
		$rows = array();

		if ($rs) {
			foreach ($rs as $v ) {
				$rows[] = $v[$this->_tablePrimaryKey];
			}
		}

		return $rows;
	}

	public function selectKeyLimit()
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
				foreach (self::$jsonKey as $col_key ) {
					if (isset($v[$col_key])) {
						$v[$col_key] = decode_json($v[$col_key]);
					}
				}

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
			if (in_array($key, self::$jsonKey)) {
				$value = encode_json($value);
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

	public function getKey($primary_value = NULL, $primary_key = NULL)
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

	public function removeKey($primary_value = NULL, $primary_key = NULL)
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

	public function formatKV(&$item, $key)
	{
		$item = $key . "|" . $item;
	}

	public function getKeyByMultiCond($cond_row)
	{
		ksort($cond_row);
		$key_cond = $cond_row;
		$rows = false;
		array_walk($key_cond, array($this, "formatKV"));
		$key_endfix = implode("|", $key_cond);
		$key = "keys|" . $key_endfix;

		if (CHE) {
			$rows = $this->getCache($key);
		}

		if (false === $rows) {
			if ($cond_row) {
				foreach ($cond_row as $k => $v ) {
					$this->sql->setWhere($k, $v);
				}
			}
			else {
				throw new Exception(_("need input cond_row"));
			}

			$rows = $this->_selectKey();
			if (CHE && $rows) {
				$this->setCache($rows, $key);
			}
		}

		return $rows;
	}

	public function removeByMultiCond($cond_row = NULL)
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
			if (CHE) {
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
						$rows = $rows + $rows_cache[$val];
					}
				}
			}
		}

		return $rows;
	}

	protected function getCache($id = NULL)
	{
		$rows = array();

		if (CHE) {
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

	public function setCacheRow($rows_db = NULL, $expire = NULL)
	{
		if (CHE) {
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

	public function setCache($rows_db, $key = NULL, $expire = NULL)
	{
		if (CHE) {
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

	public function removeCache($id = NULL)
	{
		$flag = false;

		if (CHE) {
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

	public function get($table_primary_key_value = NULL, $key_row = NULL)
	{
		$rows = array();

		if (is_array($table_primary_key_value)) {
			if (!$table_primary_key_value) {
				throw new Exception(sprintf(_("need input array  table_primary_key_value: \$_tableName=>%s"), $this->_tableName));
			}

			if (CHE) {
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
			if (CHE) {
				$rows = $this->getCache($table_primary_key_value);
			}

			if ((CHE && (false === $rows)) || !$rows) {
				if ($table_primary_key_value && ("*" != $table_primary_key_value)) {
					$this->sql->setWhere($this->_tablePrimaryKey, $table_primary_key_value);
				}
				else if ("*" != $table_primary_key_value) {
					throw new Exception(_("need input table_primary_key_value"));
				}

				$rows = $this->_select();
				if (CHE && $rows) {
					$this->setCache($rows, $table_primary_key_value);
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

	public function add($field_row, $return_insert_id = false)
	{
		$add_flag = $this->_insert($field_row);
		if ($add_flag && $return_insert_id) {
			$add_flag = $this->sql->insertId();
		}

		return $add_flag;
	}

	public function edit($table_primary_key_value = NULL, $field_row)
	{
		$update_flag = false;

		if ($table_primary_key_value) {
			if (is_array($table_primary_key_value)) {
				$this->sql->setWhere($this->_tablePrimaryKey, $table_primary_key_value, "IN");
			}
			else {
				$this->sql->setWhere($this->_tablePrimaryKey, $table_primary_key_value);
			}

			$update_flag = $this->_update($field_row);
			if (CHE && $update_flag) {
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

	public function editSingleField($table_primary_key_value, $field_name, $field_value_new, $field_value_old)
	{
		$update_flag = false;

		if ($table_primary_key_value) {
			$this->sql->setWhere($this->_tablePrimaryKey, $table_primary_key_value);
			$this->sql->setWhere($field_name, $field_value_old);
			$field_row = array();
			$field_row[$field_name] = $field_value_new;
			$update_flag = $this->_update($field_row);
			if (CHE && $update_flag) {
				$this->removeCache($table_primary_key_value);
			}
		}

		return $update_flag;
	}

	public function remove($table_primary_key_value)
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
			if (CHE && $del_flag) {
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
}


