<?php
/**
*   @package    P
*   @copyright  Fernando Hidalgo
*   @license    GNU/GPL, http://www.gnu.org/licenses/gpl-3.0.txt
*   @changelogs changelogs.php
*   @file       framework.php
**/

class PFrameWork {
		static $config;

    function init() {
		define( '_AutoPortDabe', 1 );
		// Include files
		    if ($handle = opendir(dirname(__FILE__))) {
		        while (false !== ($file = readdir($handle))) {
		                if ($file != "." && $file != ".." && $file != '.svn' && $file[strlen($file)-1] != "~") {
		                        require_once(dirname(__FILE__)."/".$file);
		                }
		        }
		    }
		// Load DB, Load Config
		// $db = &HDatabase::getInstance();
		require_once(dirname(__FILE__)."/../configuration.php");
		PFrameWork::$config = new PConfig();
		// Add externals libraries
    }
}
?>
