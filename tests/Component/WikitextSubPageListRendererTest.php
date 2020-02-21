<?php

namespace Tests\Component\SubPageList;

use ParamProcessor\Processor;
use ParserHooks\HookDefinition;
use PHPUnit\Framework\TestCase;
use SubPageList\Extension;
use SubPageList\Lister\Page;
use SubPageList\Settings;
use Title;

/**
 * @covers \SubPageList\Lister\UI\WikitextSubPageListRenderer
 *
 * @group SubPageList
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class WikitextSubPageListRendererTest extends TestCase {

	/**
	 * @var Page[]
	 */
	private static $pages;

	public static function setUpBeforeClass(): void {
		$GLOBALS['wgNamespacesWithSubpages'][NS_MAIN] = true;

		self::$pages = [
			// A page with no sub pages
			'AAA' => new Page(
				Title::newFromText( 'AAA' )
			),

			// A page with one sub page
			'BBB' => new Page(
				Title::newFromText( 'BBB' ),
				[
					new Page(
						Title::newFromText( 'BBB/Sub' )
					)
				]
			),
		];
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
			self::$pages[$params['page']],
			$params
		);
	}

	private function getProcessedParams( HookDefinition $definition, array $rawParams ) {
		$processor = Processor::newDefault();

		$processor->setParameters(
			$rawParams,
			$definition->getParameters()
		);

		$params = [];

		foreach ( $processor->processParameters()->getParameters() as $param ) {
			$params[$param->getName()] = $param->getValue();
		}

		return $params;
	}

	public function testListForOnePage() {
		$this->assertCreatesList(
			[
				'page' => 'AAA',
				'showpage' => 'yes',
			],
			'<div class="subpagelist">' . "\n[[AAA|AAA]]\n</div>"
		);
	}

	public function testListForOnePageWithOneSub() {
		$this->assertCreatesList(
			[
				'page' => 'BBB',
				'showpage' => 'yes',
			],
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
			[
				'page' => 'AAA',
				'intro' => $introText,
				'showpage' => 'yes',
			],
			'<div class="subpagelist">' . "\n" .$introText . "\n[[AAA|AAA]]\n</div>"
		);
	}

	public function textProvider() {
		return [
			[ 'a' ],
			[ '0' ],
			[ '~=[,,_,,]:3' ],
		];
	}

	/**
	 * @dataProvider textProvider
	 */
	public function testListWithFooter( $outroText ) {
		$this->assertCreatesList(
			[
				'page' => 'AAA',
				'outro' => $outroText,
				'showpage' => 'yes',
			],
			'<div class="subpagelist">' ."\n[[AAA|AAA]]\n" . $outroText . "\n</div>"
		);
	}

	public function testListWithoutLinks() {
		$this->assertCreatesList(
			[
				'page' => 'BBB',
				'links' => 'no',
			],
			'<div class="subpagelist">' ."\n* Sub\n</div>"
		);
	}

	public function testListWithOlFormat() {
		$this->assertCreatesList(
			[
				'page' => 'BBB',
				'showpage' => 'yes',
				'format' => 'ol',
			],
			'<div class="subpagelist">
[[BBB|BBB]]
# [[BBB/Sub|Sub]]
</div>'
		);
	}

	public function testListWithTemplate() {
		$this->assertCreatesList(
			[
				'page' => 'BBB',
				'showpage' => 'yes',
				'format' => 'ol',
				'template' => 'foo',
			],
			'<div class="subpagelist">
{{foo|BBB}}
# {{foo|Sub}}
</div>'
		);
	}

	public function testCannotUseScriptElement() {
		$badElement = 'script';

		$this->expectException( 'RuntimeException' );

		$this->getListForParams( [
			'page' => 'BBB',
			'element'=> $badElement,
		] );
	}

	public function testOneLevelOfAdditionalIndent() {
		$this->assertCreatesList(
			[
				'page' => 'BBB',
				'showpage' => 'yes',
				'addlevel' => '1',
			],
			'<div class="subpagelist">
* [[BBB|BBB]]
** [[BBB/Sub|Sub]]
</div>'
		);
	}

	public function testTwoLevelsOfAdditionalIndent() {
		$this->assertCreatesList(
			[
				'page' => 'BBB',
				'addlevel' => '2',
			],
			'<div class="subpagelist">
*** [[BBB/Sub|Sub]]
</div>'
		);
	}

	public function testElementNone() {
		$this->assertCreatesList(
			[
				'page' => 'BBB',
				'element' => 'none',
			],
			'* [[BBB/Sub|Sub]]'
		);
	}
}
