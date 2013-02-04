<?php

namespace SubPageList;
use Title;

interface SubPageCounter {

	/**
	 * Returns the number of subpages.
	 * This does not include the page itself.
	 *
	 * @since 1.0
	 *
	 * @param Title $title
	 *
	 * @return integer
	 */
	public function countSubPages( Title $title );

}
