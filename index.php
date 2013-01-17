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

$data = PModel::getArray(PFrameWork::$config->get('dir') . PFrameWork::$config->get("data"));

PModel::initPlugins();
PModel::initWebs($data);

$webs = PModel::$webs;

require_once("layout/bootstrap/list/index.php");
?>
