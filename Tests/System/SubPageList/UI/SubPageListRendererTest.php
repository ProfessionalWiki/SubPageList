<?php

namespace Tests\System\SubPageList\UI;

use SubPageList\Extension;
use SubPageList\Settings;
use Title;

/**
 * @group SubPageList
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class SubPageListRendererTest extends \PHPUnit_Framework_TestCase {

	protected static $pages = array(
//		'TempSPLTest:AAA',
//		'TempSPLTest:AAA/Root0',
//		'TempSPLTest:AAA/Root1/Sub1-0',
//		'TempSPLTest:AAA/Root2/Sub2-0',
//		'TempSPLTest:AAA/Root2/Sub2-1',
//		'TempSPLTest:AAA/Root2/Sub2-2',
//		'TempSPLTest:AAA/Root2/Sub2-2/SubSub2-2-0',
//		'TempSPLTest:AAA/Root2/Sub2-3',

		'TempSPLTest:BBB/Root0',
		'TempSPLTest:BBB/Root1',

		'TempSPLTest:CCC',

		'TempSPLTest:DDD/Sub',
	);

	/**
	 * @var Title[]
	 */
	protected static $titles;

	public static function setUpBeforeClass() {
		$pageCreator = new PageCreator();

		foreach ( self::$pages as $pageName ) {
			$title = Title::newFromText( $pageName );

			self::$titles[] = $title;

			$pageCreator->createPage( $title );
		}
	}

	public static function tearDownAfterClass() {
		$pageDeleter = new PageDeleter();

		foreach ( self::$titles as $title ) {
			$pageDeleter->deletePage( $title );
		}
	}

	protected function assertCreatesList( array $params, $listText ) {
		$this->assertEquals(
			$listText,
			$this->getListForParams( $params )
		);
	}

	protected function getListForParams( array $params ) {
		$extension = new Extension( Settings::newFromGlobals( $GLOBALS ) );

		return $extension->getListFunctionRunner()->run( $GLOBALS['wgParser'], $params );
	}

	public function testListForNonExistingPage() {
		$this->assertCreatesList(
			array( 'page' => 'TempSPLTest:ZZZ' ),
			"[[TempSPLTest:ZZZ|TempSPLTest:ZZZ]]\n"
		);
	}

	public function testListForExistingPage() {
		$this->assertCreatesList(
			array( 'page' => 'TempSPLTest:CCC' ),
			"[[TempSPLTest:CCC|TempSPLTest:CCC]]\n"
		);
	}

	public function testListSubPagePageWithParent() {
		$this->assertCreatesList(
			array( 'page' => 'TempSPLTest:DDD/Sub' ),
			'[[TempSPLTest:DDD|TempSPLTest:DDD]]
* [[TempSPLTest:DDD/Sub|TempSPLTest:DDD/Sub]]
'
		);
	}

	public function testListPageWithSub() {
		$this->assertCreatesList(
			array( 'page' => 'TempSPLTest:DDD' ),
			'[[TempSPLTest:DDD|TempSPLTest:DDD]]
* [[TempSPLTest:DDD/Sub|TempSPLTest:DDD/Sub]]
'
		);
	}

}

class PageCreator {

	public function createPage( Title $title ) {
		$page = new \WikiPage( $title );

		$pageContent = 'Content of ' . $title->getFullText();
		$editMessage = 'SPL integration test: create page';

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

class PageDeleter {

	public function deletePage( Title $title ) {
		$page = new \WikiPage( $title );
		$page->doDeleteArticle( 'SPL integration test: delete page' );
	}

}