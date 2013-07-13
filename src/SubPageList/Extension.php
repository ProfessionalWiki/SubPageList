<?php

namespace SubPageList;

use Parser;
use ParserHooks\FunctionRunner;
use ParserHooks\HookDefinition;
use ParserHooks\HookRegistrant;
use SubPageList\UI\WikitextSubPageListRenderer;

/**
 * Main extension class, acts as dependency injection container look-alike.
 *
 * @since 1.0
 * @file
 * @ingroup SubPageList
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
	 * @return WikitextSubPageListRenderer
	 */
	public function newSubPageListRenderer() {
		return new WikitextSubPageListRenderer();
	}

	/**
	 * @since 1.0
	 *
	 * @return FunctionRunner
	 */
	public function getCountFunctionHandler() {
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
	public function getListFunctionHandler() {
		$definition = new HookDefinition(
			'subpagelist',
			array(
				'page' => array(
					'default' => '',
					'aliases' => 'parent',
					'message' => 'spl-subpages-par-page',
				),
				// TODO
			),
			'page'
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
