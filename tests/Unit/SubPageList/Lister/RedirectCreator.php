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

		if ( class_exists( 'WikitextContent' ) ) {
			$page->doEditContent(
				new \WikitextContent( $pageContent ),
				$editMessage
			);
		}
		else {
			$page->doEdit( $pageContent, $editMessage );
		}

	}
	
}