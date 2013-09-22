<?php

namespace SubPageList;

use Parser;
use ParserHooks\FunctionRunner;
use ParserHooks\HookDefinition;
use ParserHooks\HookRegistrant;
use SubPageList\UI\PageRenderer\LinkingPageRenderer;
use SubPageList\UI\SubPageListRenderer;
use SubPageList\UI\TreeListRenderer;
use SubPageList\UI\WikitextSubPageListRenderer;

/**
 * Top level factory for the SubPageList extension.
 *
 * @since 1.0
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class Extension {

	/**
	 * @since 1.0
	 *
	 * @var Settings
	 */
	protected $settings;

	public function __construct( Settings $settings ) {
		$this->settings = $settings;
	}

	/**
	 * @since 1.0
	 *
	 * @return Settings
	 */
	public function getSettings() {
		return $this->settings;
	}

	/**
	 * @since 1.0
	 *
	 * @return DBConnectionProvider
	 */
	public function getSlaveConnectionProvider() {
		return new LazyDBConnectionProvider( DB_SLAVE );
	}

	/**
	 * @since 1.0
	 *
	 * @return CacheInvalidator
	 */
	public function getCacheInvalidator() {
		return new SimpleCacheInvalidator( $this->getSubPageFinder() );
	}

	/**
	 * @return SimpleSubPageFinder
	 */
	public function getSubPageFinder() {
		return new SimpleSubPageFinder( $this->getSlaveConnectionProvider() );
	}

	/**
	 * @since 1.0
	 *
	 * @return SubPageCounter
	 */
	public function getSubPageCounter() {
		return new SimpleSubPageFinder();
	}

	/**
	 * @since 1.0
	 *
	 * @return TitleFactory
	 */
	public function getTitleFactory() {
		return new TitleFactory();
	}

	/**
	 * @since 1.0
	 *
	 * @return SubPageCount
	 */
	public function getSubPageCount() {
		return new SubPageCount( $this->getSubPageCounter(), $this->getTitleFactory() );
	}

	/**
	 * @since 1.0
	 *
	 * @return SubPageList
	 */
	public function getSubPageList() {
		return new SubPageList(
			$this->getSubPageFinder(),
			$this->getPageHierarchyCreator(),
			$this->newSubPageListRenderer(),
			$this->getTitleFactory()
		);
	}

	/**
	 * @since 1.0
	 *
	 * @return PageHierarchyCreator
	 */
	public function getPageHierarchyCreator() {
		return new PageHierarchyCreator( $this->getTitleFactory() );
	}

	/**
	 * @since 1.0
	 *
	 * @return SubPageListRenderer
	 */
	public function newSubPageListRenderer() {
		return new WikitextSubPageListRenderer( new TreeListRenderer( new LinkingPageRenderer() ) );
	}

	/**
	 * @since 1.0
	 *
	 * @return FunctionRunner
	 */
	public function getCountFunctionRunner() {
		$definition = new HookDefinition(
			'subpagecount',
			array(
				'page' => array(
					'default' => '',
					'aliases' => 'parent',
					'message' => 'spl-subpages-par-page',
				),
				'kidsonly' => array(
					'type' => 'boolean',
					'default' => false,
					'message' => 'spl-subpages-par-kidsonly',
				),
			),
			'page'
		);

		return new FunctionRunner( $definition, $this->getSubPageCount() );
	}

	/**
	 * @since 1.0
	 *
	 * @return FunctionRunner
	 */
	public function getListFunctionRunner() {
		$params = array();

		$params['page'] = array(
			'aliases' => 'parent',
			'default' => '',
		);

		$params['showpage'] = array(
			'type' => 'boolean',
			'aliases' => 'showparent',
			'default' => false,
		);

		$params['sort'] = array(
			'aliases' => 'order',
			'values' => array( 'asc', 'desc' ),
			'tolower' => true,
			'default' => 'asc',
		);

		$params['intro'] = array(
			'default' => '',
		);

		$params['outro'] = array(
			'default' => '',
		);

		$params['format'] = array(
			'aliases' => 'liststyle',
			'values' => array(
				'ul', 'unordered',
				'ol', 'ordered',
				'list', 'bar'
			),
			'tolower' => true,
			'default' => 'ul',
		);

		$params['pathstyle'] = array(
			'aliases' => 'showpath',
			'values' => array(
				'none', 'no',
				'subpagename', 'children', 'notparent',
				'pagename',
				'full', 		// Deprecate? --vdb
				'fullpagename'
			),
			'tolower' => true,
			'default' => 'none',
		);

		$params['kidsonly'] = array(
			'type' => 'boolean',
			'default' => false,
		);

		$params['links'] = array(
			'type' => 'boolean',
			'aliases' => 'link',
			'default' => true,
		);

		$params['limit'] = array(
			'type' => 'integer',
			'default' => 200,
			'range' => array( 1, 500 ),
		);

		$params['element'] = array(
			'default' => 'div',
			'aliases' => array( 'div', 'p', 'span' ),
		);

		$params['class'] = array(
			'default' => 'subpagelist',
		);

		$params['default'] = array(
			'default' => '',
		);

		$params['separator'] = array(
			'aliases' => 'sep',
			'default' => '&#160;· ',
		);

		$params['template'] = array(
			'default' => '',
		);

		// Give grep a chance to find the usages:
		// spl-subpages-par-sort, spl-subpages-par-sortby, spl-subpages-par-format, spl-subpages-par-page,
		// spl-subpages-par-showpage, spl-subpages-par-pathstyle, spl-subpages-par-kidsonly, spl-subpages-par-limit,
		// spl-subpages-par-element, spl-subpages-par-class, spl-subpages-par-intro, spl-subpages-par-outro,
		// spl-subpages-par-default, spl-subpages-par-separator, spl-subpages-par-template, spl-subpages-par-links
		foreach ( $params as $name => &$param ) {
			$param['message'] = 'spl-subpages-par-' . $name;
		}

		$definition = new HookDefinition(
			'subpagelist',
			$params,
			array( 'page', 'format', 'pathstyle', 'sortby', 'sort' )
		);

		return new FunctionRunner( $definition, $this->getSubPageList() );
	}

	/**
	 * @since 0.1
	 *
	 * @param Parser $parser
	 *
	 * @return HookRegistrant
	 */
	public function getHookRegistrant( Parser &$parser ) {
		return new HookRegistrant( $parser );
	}

}
