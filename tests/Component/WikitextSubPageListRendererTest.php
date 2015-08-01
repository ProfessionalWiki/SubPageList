<?php

namespace Tests\Component\SubPageList;

use ParamProcessor\Processor;
use ParserHooks\HookDefinition;
use SubPageList\Extension;
use SubPageList\Lister\Page;
use SubPageList\Settings;
use Title;

/**
 * @covers SubPageList\Lister\UI\WikitextSubPageListRenderer
 *
 * @group SubPageList
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class WikitextSubPageListRendererTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @var Page[]
	 */
	private static $pages;

	public static function setUpBeforeClass() {
		$GLOBALS['wgNamespacesWithSubpages'][NS_MAIN] = true;

		self::$pages = array(
			// A page with no sub pages
			'AAA' => new Page(
				Title::newFromText( 'AAA' )
			),

			// A page with one sub page
			'BBB' => new Page(
				Title::newFromText( 'BBB' ),
				array(
					new Page(
						Title::newFromText( 'BBB/Sub' )
					)
				)
			),
		);
	}

	private function assertCreatesList( array $params, $listText ) {
		$this->assertEquals(
			$listText,
			$this->getListForParams( $params )
		);
	}

	private function getListForParams( array $rawParams ) {
		$extension = new Extension( Settings::newFromGlobals( $GLOBALS ) );

		$definition = $extension->getListHookDefinition();

		$params = $this->getProcessedParams( $definition, $rawParams );

		return $extension->newSubPageListRenderer()->render(
			array( self::$pages[$params['page']] ),
			$params
		);
	}

	private function getProcessedParams( HookDefinition $definition, array $rawParams ) {
		$processor = Processor::newDefault();

		$processor->setParameters(
			$rawParams,
			$definition->getParameters()
		);

		$params = array();

		foreach ( $processor->processParameters()->getParameters() as $param ) {
			$params[$param->getName()] = $param->getValue();
		}

		return $params;
	}

	public function testListForOnePage() {
		$this->assertCreatesList(
			array(
				'page' => 'AAA',
			),
			'<div class="subpagelist">' . "\n[[AAA|AAA]]\n</div>"
		);
	}

	public function testListForOnePageWithOneSub() {
		$this->assertCreatesList(
			array(
				'page' => 'BBB',
			),
			'<div class="subpagelist">
[[BBB|BBB]]
* [[BBB/Sub|Sub]]
</div>'
		);
	}

	/**
	 * @dataProvider textProvider
	 */
	public function testListWithHeader( $introText ) {
		$this->assertCreatesList(
			array(
				'page' => 'AAA',
				'intro' => $introText,
			),
			'<div class="subpagelist">' . "\n" .$introText . "\n[[AAA|AAA]]\n</div>"
		);
	}

	public function textProvider() {
		return array(
			array( 'a' ),
			array( '0' ),
			array( '~=[,,_,,]:3' ),
		);
	}

	/**
	 * @dataProvider textProvider
	 */
	public function testListWithFooter( $outroText ) {
		$this->assertCreatesList(
			array(
				'page' => 'AAA',
				'outro' => $outroText,
			),
			'<div class="subpagelist">' ."\n[[AAA|AAA]]\n" . $outroText . "\n</div>"
		);
	}

	public function testListWithoutLinks() {
		$this->assertCreatesList(
			array(
				'page' => 'BBB',
				'links' => 'no',
			),
			'<div class="subpagelist">' ."\nBBB\n* Sub\n</div>"
		);
	}

	public function testListWithOlFormat() {
		$this->assertCreatesList(
			array(
				'page' => 'BBB',
				'format' => 'ol',
			),
			'<div class="subpagelist">
[[BBB|BBB]]
# [[BBB/Sub|Sub]]
</div>'
		);
	}

	public function testListWithTemplate() {
		$this->assertCreatesList(
			array(
				'page' => 'BBB',
				'format' => 'ol',
				'template' => 'foo',
			),
			'<div class="subpagelist">
{{foo|BBB}}
# {{foo|Sub}}
</div>'
		);
	}

	public function testCannotUseScriptElement() {
		$badElement = 'script';

		$this->setExpectedException( 'RuntimeException' );

		$this->getListForParams( array(
			'page' => 'BBB',
			'element'=> $badElement,
		) );
	}

}
