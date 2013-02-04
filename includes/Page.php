<?php

namespace SubPageList;
use Title;

class Page {

	/**
	 * @since 1.0
	 *
	 * @var Title
	 */
	protected $title;

	/**
	 * @since 1.0
	 *
	 * @var Page[]
	 */
	protected $children;

	/**
	 * @since 1.0
	 *
	 * @param Title $title
	 * @param Page[] $children
	 */
	public function __construct( Title $title, array $children ) {
		$this->title = $title;
		$this->children = $children;
	}

	/**
	 * @since 1.0
	 *
	 * @return Title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @since 1.0
	 *
	 * @return Page[]
	 */
	public function getSubPages() {
		return $this->children;
	}

}
