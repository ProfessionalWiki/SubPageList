<?php

namespace SubPageList;

use Title;

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