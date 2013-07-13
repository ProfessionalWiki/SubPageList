<?php

namespace Tests\Integration\SubPageList;

use ParamProcessor\ProcessedParam;
use ParamProcessor\ProcessingResult;
use SubPageList\SubPageCount;
use SubPageList\TitleFactory;

/**
 * @file
 * @ingroup SubPageList
 * @group SubPageList
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class SubPageCountTest extends \PHPUnit_Framework_TestCase {

	public function testSubPageCountHookReturnsString() {
		$titleText = 'FooBarPage';
		$numberOfSubPages = 42;

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

		$titleFactory = new TitleFactory();

		$counter = $this->getMock( 'SubPageList\SubPageCounter' );

		$counter->expects( $this->once() )
			->method( 'countSubPages' )
			->with( $titleFactory->newFromText( $titleText ) )
			->will( $this->returnValue( $numberOfSubPages ) );

		$subPageCount = new SubPageCount( $counter, $titleFactory );

		$processingResult = new ProcessingResult(
			array(
				'page' => new ProcessedParam( 'page', $titleText, false )
			),
			array()
		);

		$countResult = $subPageCount->handle( $parser, $processingResult );

		$this->assertInternalType( 'string', $countResult );
		$this->assertEquals( (string)$numberOfSubPages . '.0', $countResult );
	}

}
