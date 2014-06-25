<?php

namespace Tests\System\SubPageList;

use ParserHooks\FunctionRunner;
use SubPageList\Extension;
use SubPageList\Settings;
use Title;

/**
 * @group SubPageList
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class SubPageCountingTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @var Title[]
	 */
	private static $titles = array();

	public static function createPage( $titleText ) {
		$title = Title::newFromText( $titleText );
		self::$titles[] = $title;

		$pageCreator = new PageCreator();
		$pageCreator->createPage( $title );
	}

	public static function tearDownAfterClass() {
		$pageDeleter = new PageDeleter();

		foreach ( self::$titles as $title ) {
			$pageDeleter->deletePage( $title );
		}
	}

	public function testPageDefaulting() {
		self::createPage( 'TempSPLTest:CountZZZ/ABC' );
		self::createPage( 'TempSPLTest:CountZZZ' );

		$this->assertSubPageCountFor(
			'',
			1
		);
	}

	public function testCountsIndirectChildren() {
		self::createPage( 'TempSPLTest:CountAAA' );
		self::createPage( 'TempSPLTest:CountAAA/AAA' );
		self::createPage( 'TempSPLTest:CountAAA/AAA/AAA' );
		self::createPage( 'TempSPLTest:CountAAA/AAA/BBB' );

		$this->assertSubPageCountFor(
			'TempSPLTest:CountAAA',
			3
		);
	}

	/**
	 * @depends testCountsIndirectChildren
	 */
	public function testDoesNotCountParents() {
		$this->assertSubPageCountFor(
			'TempSPLTest:CountAAA/AAA',
			2
		);
	}

	public function testCountsIndirectChildrenWithoutParent() {
		self::createPage( 'TempSPLTest:CountBBB' );
		self::createPage( 'TempSPLTest:CountBBB/AAA/AAA' );
		self::createPage( 'TempSPLTest:CountBBB/AAA/BBB' );

		$this->assertSubPageCountFor(
			'TempSPLTest:CountBBB',
			2
		);
	}

	private function assertSubPageCountFor( $pageName, $expectedCount ) {
		$this->assertEquals(
			$expectedCount,
			(int)$this->getSubPageCountFor( $pageName )
		);
	}

	private function getSubPageCountFor( $pageName ) {
		$extension = new Extension( Settings::newFromGlobals( $GLOBALS ) );

		$functionRunner = new FunctionRunner(
			$extension->getCountHookDefinition(),
			$extension->getCountHookHandler()
		);

		$frame = $this->getMock( 'PPFrame' );

		$frame->expects( $this->once() )
			->method( 'expand' )
			->will( $this->returnArgument( 0 ) );

		$result = $functionRunner->run(
			$GLOBALS['wgParser'],
			array(
				'page' => $pageName
			),
			$frame
		);

		return reset( $result );
	}

}