<?php
/**
*   @package    PortMagic
*   @copyright  Fernando Hidalgo
*   @license    GNU/GPL, http://www.gnu.org/licenses/gpl-3.0.txt
*   @changelogs changelogs.php
*   @file       configuration.php
**/

/**
 * RENAME THIS FILE TO: configuration.php
 * RENAME FILE data-sample.json TO data.json
 * and Configure params
 * @author hidabe
 *
 */

class PConfig {
		var $url = ''; // It is ok so
		var $dir = '/var/www/absolutevaryourweb/'; // You need change it
		var $data = 'data.json'; // It is ok so, you need modify data.json
		var $script_wk = 'scripts/wkhtmltoimage-i386'; // It is ok so
		var $cachetime = 60000; // It is ok so
		var $site = "YourSite"; // You need change it
		var $header = "TextInHeaderOrImage"; // You need change it
		var $description = "YourDescription"; // You need change it
		var $username = "YourEmail@gDomain"; // You need change it
		var $password = "YourPassword"; // You need change it
		var $email = "DestinationEmail@Domain.com"; // You need change it
		var $template = "ROUTE_TO_CSS_FILE"; // You can change it
		
		

    public function get($param) {
            return $this->$param;
    }
}
?>
