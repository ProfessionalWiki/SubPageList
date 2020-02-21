<?php

namespace Tests\System\SubPageList;

use ParserHooks\FunctionRunner;
use PHPUnit\Framework\TestCase;
use SubPageList\Extension;
use SubPageList\Settings;
use Title;

/**
 * @group SubPageList
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class SubPageListRendererTest extends TestCase {

	const CURRENT_PAGE_NAME = 'TempSPLTest:CurrentPage';

	private static $pages = [
		// A page with no sub pages
		'TempSPLTest:AAA',

		// A page with one sub page
		'TempSPLTest:BBB',
		'TempSPLTest:BBB/Sub',

		// A sub page with no parent
		'TempSPLTest:CCC/Sub',

		// A page with several sub pages
		'TempSPLTest:DDD',
		'TempSPLTest:DDD/Sub0',
		'TempSPLTest:DDD/Sub1',
		'TempSPLTest:DDD/Sub2',
		'TempSPLTest:DDD/Sub2/Sub',

		// A page with several sub pages unsorted
		'TempSPLTest:Releases',
		'TempSPLTest:Releases/1.10',
		'TempSPLTest:Releases/1.5',
		'TempSPLTest:Releases/1.2',
		'TempSPLTest:Releases/1.15',
		'TempSPLTest:Releases/2.1',
	];

	/**
	 * @var Title[]
	 */
	private static $titles;

	public static function setUpBeforeClass(): void {
		$GLOBALS['wgNamespacesWithSubpages'][NS_MAIN] = true;

		foreach ( self::$pages as $pageName ) {
			self::createPage( $pageName );
		}
	}

	public static function createPage( $titleText ) {
		$title = Title::newFromText( $titleText );
		self::$titles[] = $title;

		$pageCreator = new PageCreator();
		$pageCreator->createPage( $title );
	}

	public static function tearDownAfterClass(): void {
		$pageDeleter = new PageDeleter();

		foreach ( self::$titles as $title ) {
			$pageDeleter->deletePage( $title );
		}
	}

	private function assertCreatesList( array $params, $listText ) {
		$this->assertEquals(
			$listText,
			$this->getListForParams( $params )
		);
	}

	private function assertCreatesListWithWrap( array $params, $listText ) {
		$this->assertCreatesList(
			$params,
			'<div class="subpagelist">' . "\n" . $listText . "\n" . '</div>'
		);
	}

	private function getListForParams( array $params ) {
		$functionParams = [];

		foreach ( $params as $name => $value ) {
			$functionParams[] = $name . '=' . $value;
		}

		return $this->getListForRawParams( $functionParams );
	}

	private function getListForRawParams( array $params ) {
		$extension = new Extension( Settings::newFromGlobals( $GLOBALS ) );

		$functionRunner = new FunctionRunner(
			$extension->getListHookDefinition(),
			$extension->getListHookHandler()
		);

		$frame = $this->createMock( 'PPFrame' );

		$frame->expects( $this->exactly( count( $params ) ) )
			->method( 'expand' )
			->will( $this->returnArgument( 0 ) );

		$parser = $this->newParser();
		$result = $functionRunner->run( $parser, $params, $frame );

		return reset( $result );
	}

	private function newParser() {
		$parser = new \Parser();

		$parser->mOptions = new \ParserOptions();
		$parser->clearState();
		$parser->setTitle( \Title::newFromText( self::CURRENT_PAGE_NAME ) );

		return $parser;
	}

	public function testListForNonExistingPage() {
		$this->assertCreatesListWithWrap(
			[
				'page' => 'TempSPLTest:ZZZ',
				'showpage' => 'yes',
			],
			"[[TempSPLTest:ZZZ|TempSPLTest:ZZZ]]"
		);
	}

	public function testListForExistingPage() {
		$this->assertCreatesListWithWrap(
			[
				'page' => 'TempSPLTest:AAA',
				'showpage' => 'yes',
			],
			"[[TempSPLTest:AAA|TempSPLTest:AAA]]"
		);
	}

	public function testListSubPagePageWithParent() {
		$this->assertCreatesListWithWrap(
			[
				'page' => 'TempSPLTest:CCC/Sub',
				'showpage' => 'yes',
			],
			'[[TempSPLTest:CCC|TempSPLTest:CCC]]
* [[TempSPLTest:CCC/Sub|Sub]]'
		);
	}

	public function testListPageWithSub() {
		$this->assertCreatesListWithWrap(
			[
				'page' => 'TempSPLTest:CCC',
				'showpage' => 'yes',
			],
			'[[TempSPLTest:CCC|TempSPLTest:CCC]]
* [[TempSPLTest:CCC/Sub|Sub]]'
		);
	}

	public function testListForWithHeader() {
		$introText = '~=[,,_,,]:3';

		$this->assertCreatesListWithWrap(
			[
				'page' => 'TempSPLTest:AAA',
				'intro' => $introText,
				'showpage' => 'yes',
			],
			$introText . "\n[[TempSPLTest:AAA|TempSPLTest:AAA]]"
		);
	}

	public function testListForWithHeaderAndFooter() {
		$introText = '~=[,,_,,]:3';
		$outroText = 'in your test';

		$this->assertCreatesListWithWrap(
			[
				'page' => 'TempSPLTest:AAA',
				'intro' => $introText,
				'outro' => $outroText,
				'showpage' => 'yes',
			],
			$introText . "\n[[TempSPLTest:AAA|TempSPLTest:AAA]]\n" . $outroText
		);
	}

	public function testListInvalidPageName() {
		$this->assertCreatesList(
			[
				'page' => 'TempSPLTest:Invalid|Title',
			],
			'Error: invalid title provided'
		);
	}

	public function testDefaultDefaultingBehaviour() {
		$this->assertCreatesList(
			[
				'page' => 'TempSPLTest:DoesNotExist',
			],
			'"TempSPLTest:DoesNotExist" has no sub pages.'
		);
	}

	public function testSpecifiedDefaultingBehaviour() {
		$this->assertCreatesList(
			[
				'page' => 'TempSPLTest:DoesNotExist',
				'default' => '~=[,,_,,]:3'
			],
			'~=[,,_,,]:3'
		);
	}

	public function testNullDefaultingBehaviour() {
		$this->assertCreatesList(
			[
				'page' => 'TempSPLTest:DoesNotExist',
				'default' => '-'
			],
			''
		);
	}

	public function testListWithMultipleSubPages() {
		$this->assertCreatesListWithWrap(
			[
				'page' => 'TempSPLTest:DDD',
			],
			'* [[TempSPLTest:DDD/Sub0|Sub0]]
* [[TempSPLTest:DDD/Sub1|Sub1]]
* [[TempSPLTest:DDD/Sub2|Sub2]]
** [[TempSPLTest:DDD/Sub2/Sub|Sub]]'
		);
	}

	/**
	 * @dataProvider limitProvider
	 */
	public function testLimitIsApplied( $limit ) {
		$list = $this->getListForParams(
			[
				'page' => 'TempSPLTest:DDD',
				'limit' => (string)$limit,
			]
		);

		$this->assertEquals(
			$limit,
			substr_count( $list, '*' )
		);
	}

	public function testLimitAndDescOrderIsApplied() {
        $this->assertCreatesListWithWrap(
            [
                'page' => 'TempSPLTest:Releases',
                'sort' => 'desc',
                'limit' => '3',
            ],
            '* [[TempSPLTest:Releases/2.1|2.1]]
* [[TempSPLTest:Releases/1.5|1.5]]
* [[TempSPLTest:Releases/1.2|1.2]]'
        );
	}

	public function testLimitAndAscOrderIsApplied() {
        $this->assertCreatesListWithWrap(
            [
                'page' => 'TempSPLTest:Releases',
                'sort' => 'asc',
                'limit' => '3',
            ],
            '* [[TempSPLTest:Releases/1.10|1.10]]
* [[TempSPLTest:Releases/1.15|1.15]]
* [[TempSPLTest:Releases/1.2|1.2]]'
        );
	}

	public function limitProvider() {
		return [
			[ 1 ],
			[ 2 ],
			[ 3 ],
		];
	}

	public function testKidsOnly() {
		$this->assertCreatesListWithWrap(
			[
				'page' => 'TempSPLTest:DDD',
				'kidsonly' => 'yes',
			],
			'* [[TempSPLTest:DDD/Sub0|Sub0]]
* [[TempSPLTest:DDD/Sub1|Sub1]]
* [[TempSPLTest:DDD/Sub2|Sub2]]'
		);
	}

	public function testListWithoutLinks() {
		$this->assertCreatesListWithWrap(
			[
				'page' => 'TempSPLTest:CCC',
				'showpage' => 'yes',
				'links' => 'no',
			],
			'TempSPLTest:CCC
* Sub'
		);
	}

	public function testListWithTemplate() {
		$this->assertCreatesListWithWrap(
			[
				'page' => 'TempSPLTest:CCC',
				'pathstyle' => 'full',
				'showpage' => 'yes',
				'template' => 'MyTemplate',
			],
			'{{MyTemplate|TempSPLTest:CCC}}
* {{MyTemplate|TempSPLTest:CCC/Sub}}'
		);
	}

	public function testPageDefaulting() {
		self::createPage( self::CURRENT_PAGE_NAME );
		self::createPage( self::CURRENT_PAGE_NAME . '/SubPage' );

		$this->assertCreatesListWithWrap(
			[
				'showpage' => 'yes',
				'pathstyle' => 'full',
			],
			str_replace( '-', self::CURRENT_PAGE_NAME, "[[-|-]]\n* [[-/SubPage|-/SubPage]]" )
		);
	}

}
