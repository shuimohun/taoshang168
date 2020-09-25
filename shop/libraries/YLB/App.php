<?php
//zend54
//Date:20170909
?>
<?php
class YLB_App
{
	const VERSION = "1.0";
	const CTLPREFIX = "Game";

	public function __construct()
	{
	}

	static public function init()
	{
		$PluginManager = YLB_Plugin_Manager::getInstance();
		$PluginManager->trigger("perm");

	}

	static public function start($ctl = "Index", $met = "index", $typ = "e")
	{

		if (!isset($_REQUEST["ctl"])) {
			$_REQUEST["ctl"] = $ctl;
		}

		$ctl = $_REQUEST["ctl"] . "Ctl";

		if (!isset($_REQUEST["met"])) {
			$_REQUEST["met"] = $met;
		}

		$met = $_REQUEST["met"];
		$YLB_Registry = YLB_Registry::getInstance();
		$ccmd_rows = (isset($YLB_Registry["ccmd_rows"]) ? $YLB_Registry["ccmd_rows"] : array());

		if (!isset($_REQUEST["typ"])) {
			if (isset($ccmd_rows[$_REQUEST["ctl"]][$_REQUEST["met"]])) {
				$_REQUEST["typ"] = $ccmd_rows[$_REQUEST["ctl"]][$_REQUEST["met"]]["typ"];
			}
			else {
				$_REQUEST["typ"] = $typ;
			}
		}

		$typ = $_REQUEST["typ"];
		$ctl = htmlspecialchars($ctl);
		$met = htmlspecialchars($met);
		$typ = htmlspecialchars($typ);
		self::init();
		$Router = new YLB_Router($ctl, $met, $typ);
		$rs = $Router->service();
        if (is_array($rs) || is_object($rs)) {
			print_r($rs);
		}
		else {
			echo $rs;
		}
		/*if (1 == rand(1, 500)) {
			$evn_row = array();

			if (isset($_SERVER["HTTP_HOST"])) {
				$evn_row["domain"] = $_SERVER["HTTP_HOST"];
			}
			else {
				$evn_row["domain"] = "127.0.0.1";
			}

			$check_flag = false;
			$host = $evn_row["domain"];

			if (filter_var($host, FILTER_VALIDATE_IP)) {
				if (filter_var($host, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
					$check_flag = true;
				}
			}
			else if ("localhost" != $host) {
				$check_flag = true;
			}

			if ($check_flag) {
				$licence_file = APP_PATH . "/data/licence/licence.lic";

				if (is_file($licence_file)) {
					$lic = new YLB_Licence_Maker();
					$res = $lic->check(file_get_contents($licence_file), file_get_contents(APP_PATH . "/data/licence/public.pem"), $evn_row);

					if ($res) {
						$status = 200;
						$msg = _("success");
					}
					else {
						$status = 250;
						$msg = _("failure");
						echo "<script type=\"text/javascript\" src=\"http://www.taoshang168.com/ucenter/index.php?ctl=Api_Update&met=checkLicence&typ=e&format=js&licence_key=" . urlencode(file_get_contents(APP_PATH . "/data/licence/licence.lic")) . "&domain=" . $evn_row["domain"] . "\"></script>";
					}
				}
				else if (1 == rand(1, 100)) {
					$url = "http://www.taoshang168.com/ucenter/index.php?ctl=Api_Update&met=checkLicence&typ=json";
					$arr_param["domain"] = $evn_row["domain"];
					$licence_row = get_url($url, $arr_param);

					if (isset($licence_row["status"])) {
						if (200 != $licence_row["status"]) {
							echo "<script type=\"text/javascript\" src=\"http://www.taoshang168.com/ucenter/index.php?ctl=Api_Update&met=checkLicence&typ=e&format=js&domain=" . $evn_row["domain"] . "\"></script>";
						}
					}
				}
				else {
					if (is_array($rs) || is_object($rs)) {
					}
					else {
						echo "<script type=\"text/javascript\" src=\"http://www.taoshang168.com/ucenter/index.php?ctl=Api_Update&met=checkLicence&typ=e&format=js&domain=" . $evn_row["domain"] . "\"></script>";
					}
				}
			}
		}*/

		if (RUNTIME) {
			self::checkRuntime();
		}
	}

	static public function checkRuntime()
	{
		$import_file_row = &$GLOBALS["import_file_row"];
		$runtime_file = YLB_Registry::get("runtime_file");
		$runtime = YLB_Registry::get("runtime");
		if ($runtime_file && !empty($import_file_row)) {
			$runtime_content = "";

			if (is_file($runtime_file)) {
				$runtime_content .= php_strip_whitespace($runtime_file);
			}

			foreach ($import_file_row as $key => $php_file ) {
				$runtime_content .= php_strip_whitespace($php_file);
			}

			if (!file_exists(dirname($runtime_file))) {
				mkdir(dirname($runtime_file), 511, true);
			}

			file_put_contents($runtime_file, $runtime_content);
		}
	}
}

class YLB_Licence_Maker
{
	private $keydir;
	private $data = array();
	private $output;

	public function getData($licence_data, $public_key_data)
	{
		$licence = base64_decode($licence_data);
		$ret = openssl_public_decrypt($licence, $data, $public_key_data);
		$data = unserialize($data);
		return $data;
	}

	public function check($licence_data, $public_key_data, $evn_row = array())
	{
		$licence = base64_decode($licence_data);
		$ret = openssl_public_decrypt($licence, $data, $public_key_data);
		$data = unserialize($data);
		return $this->checkDate($data, $evn_row);
	}

	public function checkDate($data, $evn_row = array())
	{
		$domain = new YLB_Utils_Domain();
		$expires = $data["expires"];
		if (($expires < time()) || ($domain->getDomain($evn_row["domain"]) != $domain->getDomain($data["domain"]))) {
			return false;
		}

		return true;
	}

	public function checkLicence()
	{
		$url = "";
		$arr_param = array();
		$data = get_url($url, $arr_param = array());

		if (200 == $data["status"]) {
			return true;
		}
		else {
			return false;
		}
	}
}


