<?php
/**
*   @package    PortMagic
*   @copyright  Fernando Hidalgo
*   @license    GNU/GPL, http://www.gnu.org/licenses/gpl-3.0.txt
**/

class PluginWeb_Drupal extends PluginWeb {
	// TODO: Implementar caché en metadata, body, etc... sólo coger una vez

	public function isIt($url) {
		$meta = PModel::getMetadata($url);
		$name = md5($url);
		$file = PFrameWork::$config->get('dir') . "cache/images/".$name. ".sh";
		$dir = $url . "/scripts/drupal.sh";
		if (strpos(PModel::getSafeKey($meta,'generator'),'Drupal') != false)
		{
			return true;
		}
		else{
			if(PModel::file_web_exists($dir))
			{
				PModel::saveFileURL($dir, $file);
				return true;
			}
			else{
				return false;
			}
		}
		
	}

	public function getImages($url) {

	}

	public function getTitle() {
		return $this->getMetaKey('description');
	}

	function mySkills() {
		$skills[] = "Drupal";
		if ($this->getMetaKey("viewport") == "width=device-width, initial-scale=1.0") $skills[] = "Mobile";
		if ($this->isInContent("bootstrap")) $skills[] = "Bootstrap";
		return $skills;
	}
}
