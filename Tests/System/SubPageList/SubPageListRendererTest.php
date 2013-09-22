<?php

namespace Tests\System\SubPageList;

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
		// A page with no sub pages
		'TempSPLTest:AAA',

		// A page with one sub page
		'TempSPLTest:BBB',
		'TempSPLTest:BBB/Sub',

		// A sub page with no parent
		'TempSPLTest:CCC/Sub',
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
		$functionParams = array();

		foreach ( $params as $name => $value ) {
			$functionParams[] = $name . '=' . $value;
		}

		$this->assertEquals(
			$listText,
			$this->getListForParams( $functionParams )
		);
	}

	protected function getListForParams( array $params ) {
		$extension = new Extension( Settings::newFromGlobals( $GLOBALS ) );

		return $extension->getListFunctionRunner()->run( $GLOBALS['wgParser'], $params );
	}

	public function testListForNonExistingPage() {
		$this->assertCreatesList(
			array(
				'page' => 'TempSPLTest:ZZZ',
				'showpage' => 'yes',
			),
			"[[TempSPLTest:ZZZ|TempSPLTest:ZZZ]]\n"
		);
	}

	public function testListForExistingPage() {
		$this->assertCreatesList(
			array(
				'page' => 'TempSPLTest:AAA',
				'showpage' => 'yes',
			),
			"[[TempSPLTest:AAA|TempSPLTest:AAA]]\n"
		);
	}

	public function testListSubPagePageWithParent() {
		$this->assertCreatesList(
			array(
				'page' => 'TempSPLTest:CCC/Sub',
				'showpage' => 'yes',
			),
			'[[TempSPLTest:CCC|TempSPLTest:CCC]]
* [[TempSPLTest:CCC/Sub|TempSPLTest:CCC/Sub]]
'
		);
	}

	public function testListPageWithSub() {
		$this->assertCreatesList(
			array(
				'page' => 'TempSPLTest:CCC',
				'showpage' => 'yes',
			),
			'[[TempSPLTest:CCC|TempSPLTest:CCC]]
* [[TempSPLTest:CCC/Sub|TempSPLTest:CCC/Sub]]
'
		);
	}

	public function testListForWithHeader() {
		$introText = '~=[,,_,,]:3';

		$this->assertCreatesList(
			array(
				'page' => 'TempSPLTest:AAA',
				'intro' => $introText,
				'showpage' => 'yes',
			),
			$introText . "[[TempSPLTest:AAA|TempSPLTest:AAA]]\n"
		);
	}

	public function testListInvalidPageName() {
		$this->assertCreatesList(
			array(
				'page' => 'TempSPLTest:Invalid|Title',
			),
			'Error: invalid title provided'
		);
	}

	public function testDefaultDefaultingBehaviour() {
		$this->assertCreatesList(
			array(
				'page' => 'TempSPLTest:DoesNotExist',
			),
			'"TempSPLTest:DoesNotExist" has no sub pages.'
		);
	}

	public function testSpecifiedDefaultingBehaviour() {
		$this->assertCreatesList(
			array(
				'page' => 'TempSPLTest:DoesNotExist',
				'default' => '~=[,,_,,]:3'
			),
			'~=[,,_,,]:3'
		);
	}

	public function testNullDefaultingBehaviour() {
		$this->assertCreatesList(
			array(
				'page' => 'TempSPLTest:DoesNotExist',
				'default' => '-'
			),
			''
		);
	}

}

class PageCreator {

	public function createPage( Title $title ) {
		$page = new \WikiPage( $title );

		$pageContent = 'Content of ' . $title->getFullText();
		$editMessage = 'SPL system test: create page';

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
		$page->doDeleteArticle( 'SPL system test: delete page' );
	}

}