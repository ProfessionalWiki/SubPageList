<?php

namespace SubPageList\Lister;

use InvalidArgumentException;

/**
 * @since 1.2
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
interface PageSorter {

	/**
	 * @since 1.2
	 *
	 * @param Page[] $pages
	 *
	 * @return Page[]
	 *
	 * @throws InvalidArgumentException
	 */
	public function getSortedPages( array $pages );

}
