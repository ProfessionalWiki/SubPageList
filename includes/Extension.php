<?php

namespace SubPageList;

/**
 * Main extension class, acts as dependency injection container look-alike.
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
	 * @return Settings
	 */
	public function getSettings() {
		return $this->settings;
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
	 * @return ParserFunctionRunner
	 */
	public function getCountFunctionHandler() {
		$definition = new ParserFunctionDefinition(
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

		$handler = new SubPageCount( $this->getSubPageCounter(), $this->getTitleFactory() );

		return new ParserFunctionRunner( $definition, $handler );
	}

}
