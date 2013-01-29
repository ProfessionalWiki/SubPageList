<?php

namespace SubPageList;

class Settings {

	public static function newFromGlobals( array $globalVariables ) {
		return new self( array(
			self::AUTO_REFRESH => $globalVariables['egSPLAutorefresh'],
		) );
	}

	const AUTO_REFRESH = 'autorefresh';

	protected $settings;

	public function __construct( array $settings ) {
		$this->settings = $settings;
	}

	public function get( $settingName ) {
		return $this->settings[$settingName];
	}

}
