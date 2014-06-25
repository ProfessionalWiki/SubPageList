<?php

namespace Tests\Unit\SubPageList;

use ParamProcessor\ProcessedParam;
use ParamProcessor\ProcessingResult;
use SubPageList\SubPageCount;
use SubPageList\TitleFactory;

/**
 * @covers SubPageList\SubPageCount
 *
 * @group SubPageList
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class SubPageCountTest extends \PHPUnit_Framework_TestCase {

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

		$counter = $this->getMock( 'SubPageList\SubPageCounter' );

		$counter->expects( $this->once() )
			->method( 'countSubPages' )
			->with( $titleFactory->newFromText( $titleText ) )
			->will( $this->returnValue( $numberOfSubPages ) );

		return new SubPageCount( $counter, $titleFactory );
	}

	private function getCountResult( SubPageCount $subPageCount, $titleText ) {
		$language = $this->getMock( 'Language' );

		$language->expects( $this->once() )
			->method( 'formatNum' )
			->will( $this->returnCallback( function( $number ) {
				return (string)$number . '.0';
			} ) );

		$parser = $this->getMock( 'Parser' );

		$parser->expects( $this->once() )
			->method( 'getTargetLanguage' )
			->will( $this->returnValue( $language ) );

		$processingResult = new ProcessingResult(
			array(
				'page' => new ProcessedParam( 'page', $titleText, false )
			),
			array()
		);

		return $subPageCount->handle( $parser, $processingResult );
	}

}
