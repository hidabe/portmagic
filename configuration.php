<?php
/**
*   @package    PortMagic
*   @copyright  Fernando Hidalgo
*   @license    GNU/GPL, http://www.gnu.org/licenses/gpl-3.0.txt
*   @changelogs changelogs.php
*   @file       configuration.php
**/

class PConfig {
		var $url = '';
		var $dir = '/var/www/portfolio-magic/sopinet/';
		var $data = 'data.json';
		var $script_wk = 'scripts/wkhtmltoimage-i386';
		var $site = "SoPINeT";
		var $description = "Portfolio de trabajos en los que hemos trabajado.";

    public function get($param) {
            return $this->$param;
    }
}
?>
