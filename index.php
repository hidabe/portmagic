<?php
/**
*   @package    PortMagic
*   @copyright  Fernando Hidalgo
*   @license    GNU/GPL, http://www.gnu.org/licenses/gpl-3.0.txt
*   @changelogs changelogs.php
*   @file       index.php
**/

//ini_set("display_errors",1);

require_once("helpers/framework.php");
PFrameWork::init();

//ini_set("display_errors", 1);
$data = PModel::getArray(PFrameWork::$config->get('dir') . PFrameWork::$config->get("data"));

PModel::initPlugins();
PModel::initWebs($data);
PModel::initAbout($data);

$webs = PModel::$webs;
$profiles = PModel::$profiles;

$pages_main = PModel::getPages('bootstrap', 'list');
$pages_custom = PModel::getPages('bootstrap', 'custom');
/*echo '<pre>';
print_r($pages_custom);
echo '</pre>';
exit();*/

// Lang
require_once("lang/es-ES.php");

if ($_GET['action'] == 'sendEmail') {
	include("externals/mail/sendEmail.php");
}

$page = $_GET['page'];
if ($page == "") $page = "what";
if (!in_array($page.".php", $pages_main) && !in_array($page.".php", $pages_custom)) die("Error loading page");
if (in_array($page.".php", $pages_main)) {
	require_once("layout/bootstrap/list/$page.php");
} else {
	require_once("layout/bootstrap/custom/$page.php");
}
?>
