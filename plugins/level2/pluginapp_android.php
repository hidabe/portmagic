<?php
/**
*   @package    P
*   @copyright  Fernando Hidalgo
*   @license    GNU/GPL, http://www.gnu.org/licenses/gpl-3.0.txt
**/

class PluginApp_Android extends PluginApp {
	public function isIt($url) {
		return (substr($url,0,30) == "https://play.google.com/store/");
	}

	public function getTitle() {
		// <h1 itemprop="name" class="doc-banner-title">SusPasitos</h1>
		return $this->getFromContent('<h1 itemprop="name"class="doc-banner-title">','</h1>');
		return $this->getMetaKey('title');
	}

	function getImageThumb() {
		return $this->getFromContent('<img itemprop="image"src="','"/></div>');
	}

	function getDate()
	{
		$get = $this->getFromContent('<time itemprop="datePublished">','</time>');
		return $get;
	}

	function mySkills() {
		$skills[] = "Android";
		return $skills;
	}
}
