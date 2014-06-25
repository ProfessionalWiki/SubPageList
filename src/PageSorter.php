<?php

namespace SubPageList;

use InvalidArgumentException;

/**
 * @since 1.0
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
interface PageSorter {

	/**
	 * @since 1.0
	 *
	 * @param Page[] $pages
	 *
	 * @return Page[]
	 *
	 * @throws InvalidArgumentException
	 */
	public function getSortedPages( array $pages );

}
