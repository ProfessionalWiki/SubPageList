<?php

namespace Tests\Unit\SubPageList;

use ParamProcessor\ProcessedParam;
use ParamProcessor\ProcessingResult;
use SubPageList\Page;
use SubPageList\SubPageList;
use SubPageList\TitleFactory;

/**
 * @covers SubPageList\SubPageList
 *
 * @group SubPageList
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class SubPageListTest extends \PHPUnit_Framework_TestCase {

	public function testSubPageListHook() {
		$titleText = 'FooBarPage';
		$renderResult = 'ohi there!';

		$subPageList = $this->newSubPageList( $titleText, $renderResult );

		$renderedList = $this->getRenderedList( $subPageList, $titleText );

		$this->assertInternalType( 'string', $renderedList );
		$this->assertEquals( $renderResult, $renderedList );
	}

	private function newSubPageList( $titleText, $renderResult ) {
		$title = \Title::newFromText( $titleText );
		$page = new Page( $title );

		$finder = $this->getMock( 'SubPageList\SubPageFinder' );

		$finder->expects( $this->once() )
			->method( 'getSubPagesFor' )
			->with( $this->equalTo( $titleText ) )
			->will( $this->returnValue( array() ) );

		$hierarchyCreator = $this->getMockBuilder( 'SubPageList\PageHierarchyCreator' )
			->disableOriginalConstructor()->getMock();

		$hierarchyCreator->expects( $this->once() )
			->method( 'createHierarchy' )
			->with( $this->equalTo( array( $title ) ) )
			->will( $this->returnValue( array( $page ) ) );

		$renderer = $this->getMock( 'SubPageList\UI\SubPageListRenderer' );

		$renderer->expects( $this->once() )
			->method( 'render' )
			->with( $this->equalTo( $page ) )
			->will( $this->returnValue( $renderResult ) );

		return new SubPageList(
			$finder,
			$hierarchyCreator,
			$renderer,
			new TitleFactory()
		);
	}

	private function getRenderedList( SubPageList $subPageList, $titleText ) {
		$parser = $this->getMock( 'Parser' );

		$processingResult = new ProcessingResult(
			array(
				'page' => new ProcessedParam( 'page', $titleText, false ),
				'showpage' => new ProcessedParam( 'showpage', true, false ),
				'default' => new ProcessedParam( 'default', '', true ),
				'limit' => new ProcessedParam( 'limit', 200, true ),
			),
			array()
		);

		return $subPageList->handle( $parser, $processingResult );
	}

}
