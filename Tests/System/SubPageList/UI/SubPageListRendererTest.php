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
		foreach ( self::$pages as $pageName ) {
			$title = Title::newFromText( $pageName );

			$page = new \WikiPage( $title );
			$page->doEditContent(
				new \WikitextContent( 'Content of ' . $pageName ),
				'SPL integration test: create page'
			);

			self::$titles[] = $title;
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

	public static function tearDownAfterClass() {
		foreach ( self::$titles as $title ) {
			$page = new \WikiPage( $title );
			$page->doDeleteArticle( 'SPL integration test: delete page' );
		}
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
