<?php

namespace Tests\System\SubPageList;

use ParserHooks\FunctionRunner;
use PHPUnit\Framework\TestCase;
use SubPageList\Extension;
use SubPageList\Settings;
use Title;

/**
 * @group SubPageList
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class SubPageCountingTest extends TestCase {

	const CURRENT_PAGE_NAME = 'TempSPLTest:CurrentPage';

	/**
	 * @var Title[]
	 */
	private $titles = [];

	public function createPage( $titleText ) {
		$title = Title::newFromText( $titleText );
		$this->titles[] = $title;

		$pageCreator = new PageCreator();
		$pageCreator->createPage( $title );
	}

	public function tearDown(): void {
		$pageDeleter = new PageDeleter();

		foreach ( $this->titles as $title ) {
			$pageDeleter->deletePage( $title );
		}

		$this->titles = [];
	}

	public function testPageDefaulting() {
		$this->createPage( self::CURRENT_PAGE_NAME );
		$this->createPage( self::CURRENT_PAGE_NAME . '/SubPage' );

		$this->assertSubPageCountFor(
			'',
			1
		);
	}

	public function testCountsIndirectChildren() {
		$this->createPage( 'TempSPLTest:CountAAA' );
		$this->createPage( 'TempSPLTest:CountAAA/AAA' );
		$this->createPage( 'TempSPLTest:CountAAA/AAA/AAA' );
		$this->createPage( 'TempSPLTest:CountAAA/AAA/BBB' );

		$this->assertSubPageCountFor(
			'TempSPLTest:CountAAA',
			3
		);
	}

	public function testDoesNotCountParents() {
		$this->createPage( 'TempSPLTest:CountAAA' );
		$this->createPage( 'TempSPLTest:CountAAA/AAA' );
		$this->createPage( 'TempSPLTest:CountAAA/AAA/AAA' );
		$this->createPage( 'TempSPLTest:CountAAA/AAA/BBB' );

		$this->assertSubPageCountFor(
			'TempSPLTest:CountAAA/AAA',
			2
		);
	}

	public function testCountsIndirectChildrenWithoutParent() {
		$this->createPage( 'TempSPLTest:CountBBB' );
		$this->createPage( 'TempSPLTest:CountBBB/AAA/AAA' );
		$this->createPage( 'TempSPLTest:CountBBB/AAA/BBB' );

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

		$frame = $this->createMock( 'PPFrame' );

		$frame->expects( $this->once() )
			->method( 'expand' )
			->will( $this->returnArgument( 0 ) );


		$parser = $this->newParser();
		$result = $functionRunner->run(
			$parser,
			[
				'page' => $pageName
			],
			$frame
		);

		return reset( $result );
	}

	private function newParser() {
		$parser = new \Parser();

		$parser->mOptions = new \ParserOptions();
		$parser->clearState();
		$parser->setTitle( \Title::newFromText( self::CURRENT_PAGE_NAME ) );

		return $parser;
	}

}
