<?php

namespace SubPageList\Counter;

use Title;

/**
 * Interface for subpage counters.
 *
 * @since 1.2
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
interface SubPageCounter {

	/**
	 * Returns the number of subpages.
	 * This does not include the page itself.
	 *
	 * @since 1.2
	 *
	 * @param Title $title
	 *
	 * @return integer
	 */
	public function countSubPages( Title $title );

}
