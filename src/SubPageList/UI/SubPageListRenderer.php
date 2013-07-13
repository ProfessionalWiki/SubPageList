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
	 * @param Page $page
	 *
	 * @return string
	 */
	public function render( Page $page );

}
