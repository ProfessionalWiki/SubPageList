<?php

namespace Tests\System\SubPageList;

use MediaWiki\Title\Title;

class PageDeleter {

	public function deletePage( Title $title ) {
		$page = new \WikiPage( $title );
		$page->doDeleteArticle( 'SPL system test: delete page' );
	}

}