<?php

namespace Tests\Phpunit\SubPageList;

use ParamProcessor\ProcessedParam;
use ParamProcessor\ProcessingResult;
use SubPageList\SubPageList;

/**
 * @covers SubPageList\SubPageList
 *
 * @file
 * @ingroup SubPageList
 * @group SubPageList
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class SubPageListTest extends \PHPUnit_Framework_TestCase {

	public function testSubPageListHook() {
		$titleText = 'FooBarPage';

		$subPageList = new SubPageList();

		$renderedList = $this->getRenderedList( $subPageList, $titleText );

		$this->assertInternalType( 'string', $renderedList );
	}

	protected function getRenderedList( SubPageList $subPageList, $titleText ) {
		$parser = $this->getMock( 'Parser' );

		$processingResult = new ProcessingResult(
			array(
				'page' => new ProcessedParam( 'page', $titleText, false )
			),
			array()
		);

		return $subPageList->handle( $parser, $processingResult );
	}

}
