<?php
/**
*   @package    AutoPortDabe (P)
*   @copyright  Fernando Hidalgo
*   @license    GNU/GPL, http://www.gnu.org/licenses/gpl-3.0.txt
*   @changelogs changelogs.php
*   @file       index.php
**/

ini_set("display_errors",1);

require_once("helpers/framework.php");
PFrameWork::init();

$data = PModel::getArray(PFrameWork::$config->get('dir') . PFrameWork::$config->get("data"));

PModel::initPlugins();
PModel::initWebs($data);

$webs = PModel::$webs;
/*echo '<pre>';
print_r($webs);
echo '</pre>';
exit();*/
/*
foreach($data as $d) {
	$htmllist[] = PModel::getHtmllist($d['web']);
	$plugin = PModel::whatpluginis($d['web']);
}
*/

/*
$meta = PModel::getMetadata($data[0]['web']);
echo '<pre>';
print_r($htmllist);
echo '</pre>';
exit();
*/

//require_once("layout/jquerymobile/list/index.php");
require_once("layout/bootstrap/list/index.php");

//echo '<pre>';
//print_r($meta);
//echo '</pre>';
//PModel::doThumbnails($config);
?>
