<?php

namespace SubPageList;

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
		return new SimpleCacheInvalidator( new SimpleSubPageFinder( $this->getSlaveConnectionProvider() ) );
	}

	/**
	 * @since 1.0
	 *
	 * @return Settings
	 */
	public function getSettings() {
		return $this->settings;
	}

}
