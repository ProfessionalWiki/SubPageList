<?php

namespace Tests\System\SubPageList;

use Title;

class PageCreator {

	public function createPage( Title $title ) {
		$page = new \WikiPage( $title );

		$pageContent = 'Content of ' . $title->getFullText();
		$editMessage = 'SPL system test: create page';

		$page->doEditContent( new \WikitextContent( $pageContent ), $editMessage );
	}

}