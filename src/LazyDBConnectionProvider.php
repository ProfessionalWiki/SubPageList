<?php

namespace SubPageList;

use MediaWiki\MediaWikiServices;
use Wikimedia\Rdbms\IDatabase;
use Wikimedia\Rdbms\ILoadBalancer;

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
	 * @var IDatabase|null
	 */
	private $connection = null;

	/**
	 * @var ILoadBalancer|null
	 */
	private $lb = null;

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
			if ( $this->wiki === false ) {
				$this->lb = MediaWikiServices::getInstance()->getDBLoadBalancer();
			} else {
				$factory = MediaWikiServices::getInstance()->getDBLoadBalancerFactory();
				$this->lb = $factory->getMainLB( $wiki );
			}

			assert( $this->lb instanceof ILoadBalancer );

			$this->connection = $this->lb->getConnection( $this->connectionId, $this->groups, $this->wiki );
		}

		assert( $this->connection instanceof IDatabase );

		return $this->connection;
	}

	/**
	 * @see DBConnectionProvider::releaseConnection
	 *
	 * @since 1.0
	 */
	public function releaseConnection() {
		if ( $this->wiki !== false && $this->connection !== null ) {
			$this->lb->reuseConnection( $this->connection );
		}
	}

}
