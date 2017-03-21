<?php

namespace SubPageList\Lister;

use InvalidArgumentException;
use Title;

/**
 * Interface for subpage finders.
 *
 * @since 1.2
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
interface SubPageFinder {

	/**
	 * Returns the subpages of the given page as an array of Title.
	 * The result is not ordered, is a flat list (rather then a hierarchy)
	 * and does not contain the provided page itself.
	 *
	 * @since 1.2
	 *
	 * @param Title $title
	 *
	 * @return Title[]
	 */
	public function getSubPagesFor( Title $title );

	/**
	 * @since 1.2
	 *
	 * @param int $limit
	 *
	 * @throws InvalidArgumentException
	 */
	public function setLimit( $limit );
	
	/**
	 * @param string $sortOrder
	 *
	 * @throws InvalidArgumentException
	 */
	public function setSortOrder( $sortOrder );

	/**
	 * @since 1.4.0
	 *
	 * @param bool $includeRedirects
	 *
	 * @throws InvalidArgumentException
	 */
	public function setIncludeRedirects( $includeRedirects );

	/**
	 * @since 1.2
	 *
	 * @param int $offset
	 *
	 * @throws InvalidArgumentException
	 */
	public function setOffset( $offset );

}
