<?php

namespace Tests\Unit\SubPageList\Counter;

use ParamProcessor\ProcessedParam;
use ParamProcessor\ProcessingResult;
use PHPUnit\Framework\TestCase;
use SubPageList\Counter\SubPageCount;
use SubPageList\TitleFactory;

/**
 * @covers \SubPageList\Counter\SubPageCount
 *
 * @group SubPageList
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class SubPageCountTest extends TestCase {

	public function testSubPageCountHook() {
		$titleText = 'FooBarPage';
		$numberOfSubPages = 42;

		$subPageCount = $this->newSubPageCount( $titleText, $numberOfSubPages );
		$countResult = $this->getCountResult( $subPageCount, $titleText );

		$this->assertInternalType( 'string', $countResult );
		$this->assertEquals( (string)$numberOfSubPages . '.0', $countResult );
	}

	private function newSubPageCount( $titleText, $numberOfSubPages ) {
		$titleFactory = new TitleFactory();

		$counter = $this->createMock( 'SubPageList\Counter\SubPageCounter' );

		$counter->expects( $this->once() )
			->method( 'countSubPages' )
			->with( $titleFactory->newFromText( $titleText ) )
			->will( $this->returnValue( $numberOfSubPages ) );

		return new SubPageCount( $counter, $titleFactory );
	}

	private function getCountResult( SubPageCount $subPageCount, $titleText ) {
		$language = $this->createMock( 'Language' );

		$language->expects( $this->once() )
			->method( 'formatNum' )
			->will( $this->returnCallback( function( $number ) {
				return (string)$number . '.0';
			} ) );

		$parser = $this->createMock( 'Parser' );

		$parser->expects( $this->once() )
			->method( 'getTargetLanguage' )
			->will( $this->returnValue( $language ) );

		$processingResult = new ProcessingResult(
			[
				'page' => new ProcessedParam( 'page', $titleText, false )
			],
			[]
		);

		return $subPageCount->handle( $parser, $processingResult );
	}

}
