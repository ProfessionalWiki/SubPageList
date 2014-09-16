<?php

namespace SubPageList;

use InvalidArgumentException;
use Title;

/**
 * Interface for subpage finders.
 *
 * @since 1.0
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
	 * @since 1.0
	 *
	 * @param Title $title
	 *
	 * @return Title[]
	 */
	public function getSubPagesFor( Title $title );

	/**
	 * @since 1.0
	 *
	 * @param int $limit
	 *
	 * @throws InvalidArgumentException
	 */
	public function setLimit( $limit );

	/**
	 * @since 1.0
	 *
	 * @param int $offset
	 *
	 * @throws InvalidArgumentException
	 */
	public function setOffset( $offset );

}
