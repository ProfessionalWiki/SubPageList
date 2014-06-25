<?php

namespace SubPageList;

use Title;

/**
 * Factory to construct Title objects.
 *
 * This avoids the need to have static calls from all the code that
 * needs to construct a Title, and thus allows for looser coupling.
 *
 * @since 1.0
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
