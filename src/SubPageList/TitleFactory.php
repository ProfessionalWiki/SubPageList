<?php

namespace SubPageList;

use Title;

/**
 * Factory to construct Title objects.
 *
 * This avoids the need to have static calls from all the code that
 * needs to construct a Title, and thus allows for looser coupling.
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
 * @ingroup SPL
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class TitleFactory {

	/**
	 * @param string $text
	 * @param int $defaultNamespace
	 *
	 * @return null|Title
	 */
	public function newFromText( $text, $defaultNamespace = NS_MAIN ) {
		return Title::newFromText( $text, $defaultNamespace );
	}

}
