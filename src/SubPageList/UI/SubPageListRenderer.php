<?php

namespace SubPageList\UI;

use SubPageList\Page;

/**
 * @file
 * @since 1.0
 * @ingroup SubPageList
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
interface SubPageListRenderer {

	/**
	 * Render a representation of the page and its sub pages.
	 *
	 * This might or might not include the top level page.
	 * This might or might not include additional things
	 * such as headers and footers.
	 *
	 * @param Page $page
	 *
	 * @return string
	 */
	public function render( Page $page );

}
