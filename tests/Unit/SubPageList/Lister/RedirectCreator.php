<?php

namespace Tests\Unit\SubPageList\Lister;

use Title;

class RedirectCreator {

	public function createRedirect( Title $title, $dest ) {
		$page = new \WikiPage( $title );

		$pageContent = '#redirect [[' . $dest . ']]';
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