<?php

namespace Tests\System\SubPageList;

use ParserHooks\FunctionRunner;
use SubPageList\Extension;
use SubPageList\Settings;
use Title;

/**
 * @group SubPageList
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class SubPageListRendererTest extends \PHPUnit_Framework_TestCase {

	private static $pages = array(
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
	);

	/**
	 * @var Title[]
	 */
	private static $titles;

	public static function setUpBeforeClass() {
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

	public static function tearDownAfterClass() {
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
		$functionParams = array();

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

		$frame = $this->getMock( 'PPFrame' );

		$frame->expects( $this->exactly( count( $params ) ) )
			->method( 'expand' )
			->will( $this->returnArgument( 0 ) );

		$result = $functionRunner->run( $GLOBALS['wgParser'], $params, $frame );

		return reset( $result );
	}

	public function testListForNonExistingPage() {
		$this->assertCreatesListWithWrap(
			array(
				'page' => 'TempSPLTest:ZZZ',
				'showpage' => 'yes',
			),
			"[[TempSPLTest:ZZZ|TempSPLTest:ZZZ]]"
		);
	}

	public function testListForExistingPage() {
		$this->assertCreatesListWithWrap(
			array(
				'page' => 'TempSPLTest:AAA',
				'showpage' => 'yes',
			),
			"[[TempSPLTest:AAA|TempSPLTest:AAA]]"
		);
	}

	public function testListSubPagePageWithParent() {
		$this->assertCreatesListWithWrap(
			array(
				'page' => 'TempSPLTest:CCC/Sub',
				'showpage' => 'yes',
			),
			'[[TempSPLTest:CCC|TempSPLTest:CCC]]
* [[TempSPLTest:CCC/Sub|Sub]]'
		);
	}

	public function testListPageWithSub() {
		$this->assertCreatesListWithWrap(
			array(
				'page' => 'TempSPLTest:CCC',
				'showpage' => 'yes',
			),
			'[[TempSPLTest:CCC|TempSPLTest:CCC]]
* [[TempSPLTest:CCC/Sub|Sub]]'
		);
	}

	public function testListForWithHeader() {
		$introText = '~=[,,_,,]:3';

		$this->assertCreatesListWithWrap(
			array(
				'page' => 'TempSPLTest:AAA',
				'intro' => $introText,
				'showpage' => 'yes',
			),
			$introText . "\n[[TempSPLTest:AAA|TempSPLTest:AAA]]"
		);
	}

	public function testListForWithHeaderAndFooter() {
		$introText = '~=[,,_,,]:3';
		$outroText = 'in your test';

		$this->assertCreatesListWithWrap(
			array(
				'page' => 'TempSPLTest:AAA',
				'intro' => $introText,
				'outro' => $outroText,
				'showpage' => 'yes',
			),
			$introText . "\n[[TempSPLTest:AAA|TempSPLTest:AAA]]\n" . $outroText
		);
	}

	public function testListInvalidPageName() {
		$this->assertCreatesList(
			array(
				'page' => 'TempSPLTest:Invalid|Title',
			),
			'Error: invalid title provided'
		);
	}

	public function testDefaultDefaultingBehaviour() {
		$this->assertCreatesList(
			array(
				'page' => 'TempSPLTest:DoesNotExist',
			),
			'"TempSPLTest:DoesNotExist" has no sub pages.'
		);
	}

	public function testSpecifiedDefaultingBehaviour() {
		$this->assertCreatesList(
			array(
				'page' => 'TempSPLTest:DoesNotExist',
				'default' => '~=[,,_,,]:3'
			),
			'~=[,,_,,]:3'
		);
	}

	public function testNullDefaultingBehaviour() {
		$this->assertCreatesList(
			array(
				'page' => 'TempSPLTest:DoesNotExist',
				'default' => '-'
			),
			''
		);
	}

	public function testListWithMultipleSubPages() {
		$this->assertCreatesListWithWrap(
			array(
				'page' => 'TempSPLTest:DDD',
			),
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
			array(
				'page' => 'TempSPLTest:DDD',
				'limit' => (string)$limit,
			)
		);

		$this->assertEquals(
			$limit,
			substr_count( $list, '*' )
		);
	}

	public function limitProvider() {
		return array(
			array( 1 ),
			array( 2 ),
			array( 3 ),
		);
	}

	public function testKidsOnly() {
		$this->assertCreatesListWithWrap(
			array(
				'page' => 'TempSPLTest:DDD',
				'kidsonly' => 'yes',
			),
			'* [[TempSPLTest:DDD/Sub0|Sub0]]
* [[TempSPLTest:DDD/Sub1|Sub1]]
* [[TempSPLTest:DDD/Sub2|Sub2]]'
		);
	}

	public function testListWithoutLinks() {
		$this->assertCreatesListWithWrap(
			array(
				'page' => 'TempSPLTest:CCC',
				'showpage' => 'yes',
				'links' => 'no',
			),
			'TempSPLTest:CCC
* Sub'
		);
	}

	public function testListWithTemplate() {
		$this->assertCreatesListWithWrap(
			array(
				'page' => 'TempSPLTest:CCC',
				'pathstyle' => 'full',
				'showpage' => 'yes',
				'template' => 'MyTemplate',
			),
			'{{MyTemplate|TempSPLTest:CCC}}
* {{MyTemplate|TempSPLTest:CCC/Sub}}'
		);
	}

	public function testPageDefaulting() {
		self::createPage( 'TempSPLTest:ZZZ/ABC' );
		self::createPage( 'TempSPLTest:ZZZ' );

		$this->assertCreatesListWithWrap(
			array(
				'showpage' => 'yes',
				'pathstyle' => 'full',
			),
			'[[TempSPLTest:ZZZ|TempSPLTest:ZZZ]]
* [[TempSPLTest:ZZZ/ABC|TempSPLTest:ZZZ/ABC]]'
		);
	}

}
