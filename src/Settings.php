<?php

namespace SubPageList;

/**
 * Container for the settings contained by this extension.
 *
 * @since 1.0
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class Settings {

	/**
	 * Constructs a new instance of the settings object from global state.
	 *
	 * @since 1.0
	 *
	 * @param array $globalVariables
	 *
	 * @return Settings
	 */
	public static function newFromGlobals( array $globalVariables ) {
		return new self( [
			self::AUTO_REFRESH => $globalVariables['egSPLAutorefresh'],
		] );
	}

	const AUTO_REFRESH = 'autorefresh';

	/**
	 * @var array
	 */
	private $settings;

	/**
	 * Constructor.
	 *
	 * @since 1.0
	 *
	 * @param array $settings
	 */
	public function __construct( array $settings ) {
		$this->settings = $settings;
	}

	/**
	 * Returns the setting with the provided name.
	 * The specified setting needs to exist.
	 *
	 * @since 1.0
	 *
	 * @param string $settingName
	 *
	 * @return mixed
	 */
	public function get( $settingName ) {
		return $this->settings[$settingName];
	}

}
