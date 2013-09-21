<?php

namespace SubPageList;

use DatabaseBase;

/**
 * Lazy database connection provider.
 * The connection is fetched when needed using the id provided in the constructor.
 *
 * @since 1.0
 *
 * @file
 * @ingroup SubPageList
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class LazyDBConnectionProvider implements DBConnectionProvider {

	/**
	 * @since 1.0
	 *
	 * @var DatabaseBase|null
	 */
	protected $connection = null;

	/**
	 * @since 1.0
	 *
	 * @var int|null
	 */
	protected $connectionId = null;

	/**
	 * @since 1.0
	 *
	 * @var string|array
	 */
	protected $groups;

	/**
	 * @since 1.0
	 *
	 * @var string|boolean $wiki
	 */
	protected $wiki;

	/**
	 * Constructor.
	 *
	 * @since 1.0
	 *
	 * @param int $connectionId
	 * @param string|array $groups
	 * @param string|boolean $wiki
	 */
	public function __construct( $connectionId, $groups = array(), $wiki = false ) {
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