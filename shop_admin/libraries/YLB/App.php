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
		$ccmd_rows = $YLB_Registry["ccmd_rows"];

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


