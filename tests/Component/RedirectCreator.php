<?php

namespace Tests\Component\SubPageList;

use Title;

class RedirectCreator {

	public function createRedirect( Title $title, Title $dest ) {
		$page = new \WikiPage( $title );

		$pageContent = '#redirect [[' . $dest->getFullText() . ']]';
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

		return $title;
	}
	
}