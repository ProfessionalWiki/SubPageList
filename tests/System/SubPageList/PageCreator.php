<?php

namespace Tests\System\SubPageList;

use MediaWiki\Title\Title;

class PageCreator {

	public function createPage( Title $title ) {
		$page = \MediaWiki\MediaWikiServices::getInstance()->getWikiPageFactory()->newFromTitle( $title );

		$pageContent = 'Content of ' . $title->getFullText();
		$editMessage = 'SPL system test: create page';

		$page->newPageUpdater( \MediaWiki\User\User::newSystemUser( 'SPLTestUser' ) )
			->setContent( \MediaWiki\Revision\SlotRecord::MAIN, new \WikitextContent( $pageContent ) )
			->saveRevision( \MediaWiki\CommentStore\CommentStoreComment::newUnsavedComment( $editMessage ) );
	}

}