<?php

namespace Tests\Integration\SubPageList\UI;

use SubPageList\Page;
use SubPageList\UI\WikitextSubPageListRenderer;
use Title;

/**
 * @file
 * @ingroup SubPageList
 * @group SubPageList
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class WikitextSubPageListRendererTest extends \PHPUnit_Framework_TestCase {

	public function testCanRender() {
		$renderer = new WikitextSubPageListRenderer();

		$text = $renderer->render( new Page( Title::newMainPage() ) );

		$this->assertInternalType( 'string', $text );

		echo $text;
	}

}
