<?php

namespace SubPageList;

use DatabaseBase;

/**
 * Interface for database connection providers.
 *
 * @since 1.0
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
interface DBConnectionProvider {

	/**
	 * Returns the database connection.
	 * Initialization of this connection is done if it was not already initialized.
	 *
	 * @since 1.0
	 *
	 * @return DatabaseBase
	 */
	public function getConnection();

	/**
	 * Releases the connection if doing so makes any sense resource wise.
	 *
	 * @since 1.0
	 */
	public function releaseConnection();

}
