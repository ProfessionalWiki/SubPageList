<?php

namespace Tests\Unit\SubPageList\Lister;

use ParamProcessor\ProcessedParam;
use ParamProcessor\ProcessingResult;
use SubPageList\Lister\Page;
use SubPageList\Lister\SubPageList;
use SubPageList\TitleFactory;

/**
 * @covers SubPageList\Lister\SubPageList
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

		$finder = $this->getMock( 'SubPageList\Lister\SubPageFinder' );

		$finder->expects( $this->once() )
			->method( 'getSubPagesFor' )
			->with( $this->equalTo( $titleText ) )
			->will( $this->returnValue( array() ) );

		$hierarchyCreator = $this->getMockBuilder( 'SubPageList\Lister\PageHierarchyCreator' )
			->disableOriginalConstructor()->getMock();

		$hierarchyCreator->expects( $this->once() )
			->method( 'createHierarchy' )
			->with( $this->equalTo( array( $title ) ) )
			->will( $this->returnValue( array( $page ) ) );

		$renderer = $this->getMock( 'SubPageList\Lister\UI\SubPageListRenderer' );

		$renderer->expects( $this->once() )
			->method( 'render' )
			->with( $this->equalTo( array( $page ) ) )
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
