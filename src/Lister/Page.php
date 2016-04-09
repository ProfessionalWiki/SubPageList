<?php

namespace SubPageList\Lister;

use Title;

/**
 * Represents a node in a sub page hierarchy.
 *
 * @since 1.2
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class Page {

	/**
	 * @var Title
	 */
	private $title;

	/**
	 * @var Page[]
	 */
	private $subPages = [];

	/**
	 * @since 1.2
	 *
	 * @param Title $title
	 * @param Page[] $subPages
	 */
	public function __construct( Title $title, array $subPages = [] ) {
		$this->title = $title;

		foreach ( $subPages as $subPage ) {
			$this->addSubPage( $subPage );
		}
	}

	/**
	 * @since 1.2
	 *
	 * @return Title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @since 1.2
	 *
	 * @return Page[]
	 */
	public function getSubPages() {
		return $this->subPages;
	}

	/**
	 * @since 0.1
	 *
	 * @param Page $page
	 */
	public function addSubPage( Page $page ) {
		$this->subPages[] = $page;
	}

}
