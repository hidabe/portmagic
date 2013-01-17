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
		if (strpos(PModel::getSafeKey($meta,'generator'),'Drupal') !== false) {
			return true;
		}
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