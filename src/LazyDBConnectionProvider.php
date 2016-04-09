<?php

namespace SubPageList;

use DatabaseBase;

/**
 * Lazy database connection provider.
 * The connection is fetched when needed using the id provided in the constructor.
 *
 * @since 1.0
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class LazyDBConnectionProvider implements DBConnectionProvider {

	/**
	 * @var DatabaseBase|null
	 */
	private $connection = null;

	/**
	 * @var int|null
	 */
	private $connectionId = null;

	/**
	 * @var string|array
	 */
	private $groups;

	/**
	 * @var string|boolean $wiki
	 */
	private $wiki;

	/**
	 * Constructor.
	 *
	 * @since 1.0
	 *
	 * @param int $connectionId
	 * @param string|array $groups
	 * @param string|boolean $wiki
	 */
	public function __construct( $connectionId, $groups = [], $wiki = false ) {
		$this->connectionId = $connectionId;
		$this->groups = $groups;
		$this->wiki = $wiki;
	}

	/**
	 * @see DBConnectionProvider::getConnection
	 *
	 * @since 1.0
	 *
	 * @return DatabaseBase
	 */
	public function getConnection() {
		if ( $this->connection === null ) {
			$this->connection = wfGetLB( $this->wiki )->getConnection( $this->connectionId, $this->groups, $this->wiki );
		}

		assert( $this->connection instanceof DatabaseBase );

		return $this->connection;
	}

	/**
	 * @see DBConnectionProvider::releaseConnection
	 *
	 * @since 1.0
	 */
	public function releaseConnection() {
		if ( $this->wiki !== false && $this->connection !== null ) {
			wfGetLB( $this->wiki )->reuseConnection( $this->connection );
		}
	}

}