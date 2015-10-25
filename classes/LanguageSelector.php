<?php

class LanguageSelector {

	# TODO: this should come from database
	private $languages = ['en', 'de'];

	public function getAllLang() {
		return $this->languages;
		
	}

	public function getLang($input) {
		if (in_array($input, $this->languages)  && strcmp($this->languages[0], $input) !== 0) {
			return $input;
		} else {
			return '';
		}
	}

}

?>
