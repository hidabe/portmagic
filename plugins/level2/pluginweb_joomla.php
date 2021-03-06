<?php
/**
*   @package    PortMagic
*   @copyright  Fernando Hidalgo
*   @license    GNU/GPL, http://www.gnu.org/licenses/gpl-3.0.txt
**/

class PluginWeb_Joomla extends PluginWeb {
	// TODO: Implementar caché en metadata, body, etc... sólo coger una vez

	public function isIt($url) {
		$meta = PModel::getMetadata($url);
		// https://www.gavick.com/magazine/how-to-check-the-version-of-joomla.html
		$name = md5($url);		
		$file = PFrameWork::$config->get('dir') . "cache/images/".$name. ".png";
		
		$dir = $url . "/images/powered_by.png";
		if(substr(PModel::getSafeKey($meta,'generator'),0,7) == "Joomla!")
			return true;

		else{
			if(PModel::file_web_exists($dir))
			{
				echo $name . '<br>';
				echo $file . '<br>';
				echo $dir . '<br>';
				PModel::saveFileURL($dir, $file);
				return true;
			}
			else
			{
				return false;
			}
		}

		//return (substr(PModel::getSafeKey($meta,'generator'),0,7) == "Joomla!");
	}

	public function getImages($url) {

	}

	public function getTitle() {
		return $this->getMetaKey('description');
	}

	function mySkills() {
		$skills[] = "Joomla";
		if ($this->getMetaKey("viewport") == "width=device-width, initial-scale=1.0") $skills[] = "Mobile";
		if ($this->isInContent("bootstrap")) $skills[] = "Bootstrap";
		return $skills;
	}
}
