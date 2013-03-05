<?php
/**
*   @package    PortMagic
*   @copyright  Fernando Hidalgo
*   @license    GNU/GPL, http://www.gnu.org/licenses/gpl-3.0.txt
**/

class PluginWeb_Symfony extends PluginWeb {
	// TODO: Implementar caché en metadata, body, etc... sólo coger una vez

	public function isIt($url) {
		$meta = PModel::getMetadata($url);
		$name = md5($url);
		$file = PFrameWork::$config->get('dir') . "cache/images/".$name. ".png";
		$dir = $url . "/";
		if (strpos(PModel::getSafeKey($meta,'generator'),'Symfony') !== false) {
		
			return true;
		}
		else
		{
			if(PModel::file_web_exists($dir))
			{
				return true;
				PModel::saveFileURL($dir, $file);
			}
			else
			{
				echo $name . '<br>';
				echo $file . '<br>';
				echo $dir . '<br>' . 'Symfony';
				return false;
			}
		}
	}

	public function getTitle() {
		return $this->getMetaKey('description');
	}

	function mySkills() {
		$skills[] = "Symfony";
		if ($this->getMetaKey("viewport") == "width=device-width, initial-scale=1.0") $skills[] = "Mobile";
		if ($this->isInContent("bootstrap")) $skills[] = "Bootstrap";
		if ($this->isInContent("jquery.mobile")) $skills[] = "jQueryMobile";
		return $skills;
	}
}
