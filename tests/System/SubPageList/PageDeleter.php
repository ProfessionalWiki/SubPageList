<?php

namespace Tests\System\SubPageList;

use MediaWiki\Title\Title;

class PageDeleter {

	public function deletePage( Title $title ) {
		$page = \MediaWiki\MediaWikiServices::getInstance()->getWikiPageFactory()->newFromTitle( $title );
		$page->doDeleteArticleReal( 'SPL system test: delete page', \MediaWiki\User\User::newSystemUser( 'SPLTestUser' ) );
	}

}