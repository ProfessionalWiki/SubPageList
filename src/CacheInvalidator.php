<?php

namespace SubPageList;

use Title;

/**
 * Interface for objects that can invalidate the caches affected by a
 * change to a page name relevant for subpage listing of this page, it's
 * parents and it's children.
 *
 * @since 1.0
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
interface CacheInvalidator {

	/**
	 * @since 1.0
	 *
	 * @param Title $title
	 */
	public function invalidateCaches( Title $title );

}