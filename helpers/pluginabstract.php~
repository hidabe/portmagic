<?php
/**
*   @package    P
*   @copyright  Fernando Hidalgo
*   @license    GNU/GPL, http://www.gnu.org/licenses/gpl-3.0.txt
*   @changelogs changelogs.php
*   @file       pluginabstract.php
**/

class PluginAbstract {
  private $meta;
	private $content;
	private $url;
	private $image_thumb;
	private $htmllist;
	private $whois;
	private $skills;
	private $image_main;

	function __construct($url) {
		$this->url = $url;
// Ondemand		$this->meta = PModel::getMetadata($url);
// Ondemand		$this->content = PModel::getContent($url);
	}

	function getMeta() {
		if ($this->meta == null) $this->meta = PModel::getMetadata($this->getUrl());
		return $this->meta;
	}

	function getUrl() {
		return $this->url;
	}

	function getContent() {
		if ($this->content == null) $this->content = PModel::getContent($this->getUrl());
		return $this->content;
	}

	function getMetaKey($key) {
		return PModel::getSafeKey($this->getMeta(),$key);
	}

	function mySkills() {
		$skills[] = "php";
		return $skills;
	}

	function getSkills() {
		if ($this->skills == null) {
			$this->skills = $this->mySkills();
		}
		return $this->skills;
	}

	function getImageMain() {
		if ($this->image_main == null) {
			//$this->image = PModel::getThumbnail($this->getUrl(),1024,1024,960,400);
			//$this->image = PModel::getImage($this->getUrl(), 980, 400);
			$this->image = PModel::getTopCropThumbnail($this->getUrl(), 1024, 1024, 960, 500);
		}
		return $this->image;
	}

	function getImageThumb() {
		if ($this->image_thumb == null) {
			$img_temp = $this->getFromContent("<img", ">");
			$img_temp2 = $this->getFromHTML($img_temp,'src="','"');

			$d = trim(PModel::getDomainFromUrl($this->getUrl()));
			$i = trim($img_temp2);

			if ($i != "") {
				$this->image_thumb = PModel::getThumbnailFromImage("http://" . $d . $i, 100, 100);
			} else {
				$this->image_thumb = PModel::getThumbnail($this->getUrl(),1024,1024,100,100);
			}
		}
		return $this->image_thumb;
	}

	function getWhois() {
		if ($this->whois == null) {
			$this->whois = PModel::getWhoisDomain($this->getUrl());
		}
		return $this->whois;
	}

	function getHTMLlist() {
		if ($this->htmllist == '') {
			$name = md5($this->getUrl());
			$file_htmllist = PFrameWork::$config->get('dir') . "cache/htmllist/" . $name . ".html";
			if (true || !file_exists($file_htmllist)) {
				$content = '<li><a href="#">';
				$content .= '<img src="'.$this->getImageThumb().'" />';
				$content .= '<h3>'.$this->getTitle().'</h3>';
				$content .= '<p>'.$this->getUrl().'</p>';
				$content .= '</a></li>';

				PModel::writeFile($file_htmllist, $content);
				$this->htmllist = $content;
			} else {
				$this->htmllist = PModel::readFile($file_htmllist);
			}
		}
		return $this->htmllist;
	}

	function getTitleShort($lim = 30) {
		$title = $this->getTitle();
		if (strlen($title) > $lim) {
			return substr($title,0,$lim)."...";
		} else {
			return $title;
		}
	}

	function getDate()
	{
		setlocale(LC_ALL,'es_ES');
		setlocale(LC_TIME, 'spanish');
		$whois = $this->getWhois();
		if (isset($whois['regrinfo']['domain']['created'])) {
			$created = $whois['regrinfo']['domain']['created'];
			$date = DateTime::createFromFormat('Y-m-j', $created);
			$date_es = date_format($date, 'd-F-Y');
		} else {
			$date_es = "Unknow";
		}
		return $date_es;
	}

	function getFromHTML($html, $pre, $post) {
		$temp0 = explode($pre, $html);
		if(!isset($temp0[1])) return null;
		$temp1 = explode($post, $temp0[1]);
		return $temp1[0];
	}

	function getFromContent($pre, $post) {
		return $this->getFromHTML($this->getContent(), $pre, $post);
	}

	function isInContent($text) {
		$pos = strpos($this->getContent(), $text);
		if ($pos === false) {
			return false;
		} else {
			return true;
		}
	}
}

