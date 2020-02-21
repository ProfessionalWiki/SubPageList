<?php

namespace Tests\Unit\SubPageList\Lister;

use ParamProcessor\ProcessedParam;
use ParamProcessor\ProcessingResult;
use PHPUnit\Framework\TestCase;
use SubPageList\Lister\Page;
use SubPageList\Lister\SubPageList;
use SubPageList\TitleFactory;

/**
 * @covers \SubPageList\Lister\SubPageList
 *
 * @group SubPageList
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class SubPageListTest extends TestCase {

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

		$finder = $this->createMock( 'SubPageList\Lister\SubPageFinder' );

		$finder->expects( $this->once() )
			->method( 'getSubPagesFor' )
			->with( $this->equalTo( $titleText ) )
			->will( $this->returnValue( [] ) );

		$hierarchyCreator = $this->getMockBuilder( 'SubPageList\Lister\PageHierarchyCreator' )
			->disableOriginalConstructor()->getMock();

		$hierarchyCreator->expects( $this->once() )
			->method( 'createHierarchy' )
			->with( $this->equalTo( [ $title ] ) )
			->will( $this->returnValue( [ $page ] ) );

		$renderer = $this->createMock( 'SubPageList\Lister\UI\SubPageListRenderer' );

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
		$parser = $this->createMock( 'Parser' );

		$processingResult = new ProcessingResult(
			[
				'page' => new ProcessedParam( 'page', $titleText, false ),
				'showpage' => new ProcessedParam( 'showpage', true, false ),
				'default' => new ProcessedParam( 'default', '', true ),
				'limit' => new ProcessedParam( 'limit', 200, true ),
				'sort' => new ProcessedParam( 'sort', 'asc', true ),
				'redirects' => new ProcessedParam( 'redirects', false, true )
			],
			[]
		);

		return $subPageList->handle( $parser, $processingResult );
	}

}
