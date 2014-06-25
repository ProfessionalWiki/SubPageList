<?php

namespace SubPageList;

use InvalidArgumentException;

/**
 * @since 1.0
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class AlphabeticPageSorter implements PageSorter {

	const ASCENDING = 'asc';
	const DESCENDING = 'desc';

	private $sortOrder;

	/**
	 * @param string $sortOrder
	 *
	 * @throws InvalidArgumentException
	 */
	public function __construct( $sortOrder = self::ASCENDING ) {
		if ( $sortOrder !== self::ASCENDING && $sortOrder !== self::DESCENDING ) {
			throw new InvalidArgumentException( 'Invalid $sortOrder specified' );
		}

		$this->sortOrder = $sortOrder;
	}

	/**
	 * @see PageSorter::getSortedPages
	 *
	 * @param Page[] $pages
	 *
	 * @return Page[]
	 * @throws InvalidArgumentException
	 */
	public function getSortedPages( array $pages ) {
		$this->assertArePages( $pages );

		$sortDescending = $this->sortOrder === self::DESCENDING;

		usort(
			$pages,
			function( Page $a, Page $b ) use ( $sortDescending ) {
				$returnValue = strcmp( $a->getTitle()->getFullText(), $b->getTitle()->getFullText() );

				if ( $sortDescending ) {
					$returnValue *= -1;
				}

				return $returnValue;
			}
		);

		return $pages;
	}

	private function assertArePages( array $pages ) {
		foreach ( $pages as $page ) {
			if ( !( $page instanceof Page ) ) {
				throw new InvalidArgumentException( '$pages can only contain instance of Page' );
			}
		}
	}

}