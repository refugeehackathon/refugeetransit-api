<?php

class LanguageSelector {

	# TODO: this should come from database
	private $languages = ['en', 'de'];

	public function getAllLang() {
		return $this->languages;
		
	}

	public function getLang($input) {
		if (in_array($input, $this->languages)) {
			return $input;
		} else {
			return $this->languages[0];
		}
	}

}

?>
