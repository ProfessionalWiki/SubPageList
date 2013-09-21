<?php

namespace SubPageList;

use Title;
use TitleArray;

/**
 * Interface for subpage finders.
 *
 * @since 1.0
 *
 * @file
 * @ingroup SubPageList
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

}
