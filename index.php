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

$page = $_GET['page'];
if ($page == "") $page = "what";
// TODO: Better check pages
if ($page != "who" && $page != "what") die("Error loading page");
// TODO: Add Custom pages
require_once("layout/bootstrap/list/$page.php");
?>
