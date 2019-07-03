<?php

namespace SubPageList;

use Parser;
use ParserHooks\HookDefinition;
use ParserHooks\HookHandler;
use ParserHooks\HookRegistrant;
use SubPageList\Counter\SubPageCount;
use SubPageList\Counter\SubPageCounter;
use SubPageList\Lister\PageHierarchyCreator;
use SubPageList\Lister\SimpleSubPageFinder;
use SubPageList\Lister\SubPageList;
use SubPageList\Lister\UI\SubPageListRenderer;
use SubPageList\Lister\UI\WikitextSubPageListRenderer;

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
	private $settings;

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
		return new LazyDBConnectionProvider( DB_REPLICA );
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
		return new SimpleSubPageFinder( $this->getSlaveConnectionProvider() );
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
	 * @return HookHandler
	 */
	public function getCountHookHandler() {
		return new SubPageCount( $this->getSubPageCounter(), $this->getTitleFactory() );
	}

	/**
	 * @since 1.0
	 *
	 * @return HookHandler
	 */
	public function getListHookHandler() {
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
		return new WikitextSubPageListRenderer();
	}

	/**
	 * @since 1.0
	 *
	 * @return HookDefinition
	 */
	public function getCountHookDefinition() {
		return new HookDefinition(
			'subpagecount',
			[
				'page' => [
					'default' => '',
					'aliases' => 'parent',
					'message' => 'spl-subpages-par-page',
				],
			],
			'page'
		);
	}

	/**
	 * @since 1.0
	 *
	 * @return HookDefinition
	 */
	public function getListHookDefinition() {
		$params = [];

		$params['page'] = [
			'aliases' => 'parent',
			'default' => '',
		];

		$params['showpage'] = [
			'type' => 'boolean',
			'aliases' => 'showparent',
			'default' => false,
		];

		$params['sort'] = [
			'aliases' => 'order',
			'values' => [ 'asc', 'desc' ],
			'tolower' => true,
			'default' => 'asc',
		];

		$params['intro'] = [
			'default' => '',
		];

		$params['outro'] = [
			'default' => '',
		];

		$params['links'] = [
			'type' => 'boolean',
			'aliases' => 'link',
			'default' => true,
		];
		
		$params['redirects'] = [
			'type' => 'boolean',
			'aliases' => 'redirect',
			'default' => false,
		];

		$params['default'] = [
			'default' => '',
		];

		$params['limit'] = [
			'type' => 'integer',
			'default' => 200,
			'range' => [ 1, 500 ],
		];

		$params['addlevel'] = [
			'type' => 'integer',
			'default' => 0,
			'range' => [ 0, 10 ],
		];
		
		$params['element'] = [
			'default' => 'div',
			'aliases' => [ 'div', 'p', 'span', 'none' ],
		];

		$params['class'] = [
			'default' => 'subpagelist',
		];

		$params['format'] = [
			'aliases' => 'liststyle',
			'values' => [
				'ul', 'unordered',
				'ol', 'ordered',
//				'list', 'bar' // TODO: re-implement support for these two
			],
			'tolower' => true,
			'default' => 'ul',
		];

		$params['pathstyle'] = [
			'aliases' => 'showpath',
			'values' => [
				'none', 'no',
				'subpagename', 'children', 'notparent',
				'pagename',
				'full',
				'fullpagename'
			],
			'tolower' => true,
			'default' => 'subpagename',
		];

		$params['kidsonly'] = [
			'type' => 'boolean',
			'default' => false,
		];

		$params['template'] = [
			'default' => '',
		];

		// TODO: re-implement support
//		$params['separator'] = array(
//			'aliases' => 'sep',
//			'default' => '&#160;· ',
//		);

		// Give grep a chance to find the usages:
		// spl-subpages-par-sort, spl-subpages-par-sortby, spl-subpages-par-format, spl-subpages-par-page,
		// spl-subpages-par-showpage, spl-subpages-par-pathstyle, spl-subpages-par-kidsonly, spl-subpages-par-limit,
		// spl-subpages-par-element, spl-subpages-par-class, spl-subpages-par-intro, spl-subpages-par-outro,
		// spl-subpages-par-default, spl-subpages-par-separator, spl-subpages-par-template, spl-subpages-par-links, spl-subpages-par-redirects
		foreach ( $params as $name => &$param ) {
			$param['message'] = 'spl-subpages-par-' . $name;
		}

		return new HookDefinition(
			[ 'subpagelist', 'splist', 'subpages' ],
			$params,
			[ 'page', 'format', 'pathstyle', 'sort' ]
		);
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
