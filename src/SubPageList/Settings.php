<?php

namespace SubPageList;

/**
 * Container for the settings contained by this extension.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @since 1.0
 *
 * @file
 * @ingroup SubPageList
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
		return new self( array(
			self::AUTO_REFRESH => $globalVariables['egSPLAutorefresh'],
		) );
	}

	const AUTO_REFRESH = 'autorefresh';

	/**
	 * @since 1.0
	 *
	 * @var array
	 */
	protected $settings;

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
