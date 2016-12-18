<?php

namespace Tests\Unit\SubPageList\Lister;

use Title;

class RedirectCreator {

	/**
	 *
	 * @param Title $title
	 * @param string $destination
	 *
	 */
	public function createRedirect( Title $title, $destination ) {
		$page = new \WikiPage( $title );

		$pageContent = '#redirect [[' . $destination . ']]';
		$editMessage = 'SPL system test: create redirect';

		$page->doEditContent( new \WikitextContent( $pageContent ), $editMessage );
	}

}