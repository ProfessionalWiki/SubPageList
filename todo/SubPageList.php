<?php

/**
 * CLass to render the sub page list.
 * 
 * @since 0.1
 * 
 * @file
 * @ingroup SPL
 * 
 * @licence GNU GPL v2+
 *
 * @author Jeroen De Dauw
 * @author Van de Bugger
 * @author James McCormack (email: user "qedoc" at hotmail); preceding version Martin Schallnahs <myself@schaelle.de>, original Rob Church <robchur@gmail.com>
 */
final class SubPageList extends SubPageBase {
	/**
	 * No LST in pre-5.3 PHP *sigh*.
	 * This is to be refactored as soon as php >=5.3 becomes acceptable.
	 */	
	public static function staticInit( Parser &$wgParser ) {
		$className = __CLASS__;
		$instance = new $className();
		return $instance->init( $wgParser );
	}

	/**
	 * Gets the name of the parser hook.
	 * @see ParserHook::getName
	 * 
	 * @since 0.1
	 * 
	 * @return string
	 */
	protected function getName() {
		return array( 'subpages', 'splist', 'subpagelist' );
	}
	
	/**
	 * Returns an array containing the parameter info.
	 * @see ParserHook::getParameterInfo
	 * 
	 * @since 0.1
	 * 
	 * @return array
	 */
	protected function getParameterInfo( $type ) {
		$params = array();

		$params['sort'] = array(
			'aliases' => 'order',
			'values' => array( 'asc', 'desc' ),
			'tolower' => true,
			'default' => 'asc',
		);

		$params['sortby'] = array(
			'values' => array( 'title', 'lastedit' ),
			'tolower' => true,
			'default' => 'title',
		);

		$params['format'] = array(
			'aliases' => 'liststyle',
			'values' => array(
				'ul', 'unordered',
				'ol', 'ordered',
				'list', 'bar'
			),
			'tolower' => true,
			'default' => 'ul',
		);

		$params['page'] = array(
			'aliases' => 'parent',
			'default' => '',
		);

		$params['showpage'] = array(
			'type' => 'boolean',
			'aliases' => 'showparent',
			'default' => false,
		);

		$params['pathstyle'] = array(
			'aliases' => 'showpath',
			'values' => array(
				'none', 'no',
				'subpagename', 'children', 'notparent',
				'pagename',
				'full', 		// Deprecate? --vdb
				'fullpagename'
			),
			'tolower' => true,
			'default' => 'none',
		);

		$params['kidsonly'] = array(
			'type' => 'boolean',
			'default' => false,
		);

		$params['links'] = array(
			'type' => 'boolean',
			'aliases' => 'link',
			'default' => true,
		);

		$params['limit'] = array(
			'type' => 'integer',
			'default' => 200,
			'range' => array( 1, 500 ),
		);

		$params['element'] = array(
			'default' => 'div',
			'aliases' => array( 'div', 'p', 'span' ),
		);

		$params['class'] = array(
			'default' => 'subpagelist',
		);

		$params['intro'] = array(
			'default' => '',
		);

		$params['outro'] = array(
			'default' => '',
		);

		$params['default'] = array(
			'default' => '',
		);

		$params['separator'] = array(
			'aliases' => 'sep',
			'default' => '&#160;· ',
		);

		$params['template'] = array(
			'default' => '',
		);

		foreach ( $params as $name => &$param ) {
			$param['message'] = 'spl-subpages-par-' . $name;
		}

		return $params;
	}
	
	/**
	 * Returns the list of default parameters.
	 * @see ParserHook::getDefaultParameters
	 * 
	 * @since 0.1
	 * 
	 * @return array
	 */
	protected function getDefaultParameters( $type ) {
		return array( 'page', 'format', 'pathstyle', 'sortby', 'sort' );
	}
	
	/**
	 * Renders and returns the output.
	 * @see ParserHook::render
	 * 
	 * @since 0.1
	 * 
	 * @param array $parameters
	 * 
	 * @return string
	 */
	public function render( array $parameters ) {
		$title = $this->getTitle( $parameters['page'] );
		$pages = $this->getSubPages( $title, $parameters );
		// There is no need in encoding `$parameters['element']', because it is validated and can
		// be only one of `span', `p', or `div'.
		$element = $parameters['element'];
		// Using `$parameters['class']' is dangerous and may be a security hole, because it may lead
		// to incorrect (or malicious) HTML code. `encodeAttribute' solves the issue.
		$class = Sanitizer::encodeAttribute( $parameters['class'] );
		$open = "<$element class=\"$class\">";
		$close = "</$element>";
		$inlineList = ( $parameters['format'] == 'list' || $parameters['format'] == 'bar' );
		$inlineText = ( $element == 'span' );
		$list = '';

		if ( count( $pages ) > 0 ) {
			$intro = $parameters['intro'];
			$outro = $parameters['outro'];
			if ( $inlineText && ! $inlineList ) {
				if ( $intro !== '' ) {
					$list .= $open . $intro . $close;
				}
				$list .=
					"<div class=\"$class\">" .
					$this->makeList( $title, $parameters, $pages ) .
					"</div>";
				if ( $outro !== "" ) {
					$list .= $open . $outro . $close;
				}
			}
			else {
				$list =
					$open . $intro . 
					$this->makeList( $title, $parameters, $pages ) .
					$outro . $close;
			}
			$list = $this->parseWikitext( $list );
		}
		else {
			$default = $parameters['default'];
			if ( $default === "" ) {
				if ( is_null( $title ) ) {
					$list = "''" . wfMsg( 'spl-noparentpage', $parameters['page'] ) . "''";
				}
				elseif ( $title instanceof Title ) {
					$list = "''" . wfMsg( 'spl-nosubpages', '[[' . $title->getFullText() . ']]' ) . "''";
				}
				else {
					$list = "''" . wfMsg( 'spl-nopages', $parameters['page'] ) . "''";
				}
			}
			elseif ( $default !== "-" ) {
				$list = $default;
			}
			// Format element only if content is not empty. 
			if ( $list !== "" ) {
				$list = $open . $this->parseWikitext( $list ) . $close;
			}
		}

		return $list;
	}
	
	/**
	 * Returns the subpages for a page.
	 * 
	 * @since 0.1
	 * 
	 * @param $title can be either an instance of Title class (title of an existing page), or number
	 *        (index of an existing namespace) or null.
	 * @param array $parameters
	 * 
	 * @return array of Title
	 */
	protected function getSubPages( $title, array $parameters ) {
		$titles = array();

		if ( ! is_null( $title ) ) {
			// TODO: Check whether subpages enabled?
			$dbr = wfGetDB( DB_SLAVE );
			
			$options = array();
			$options['ORDER BY'] = 
				( $parameters['sortby'] == 'title' ? 'page_title' : 'page_touched' ) . ' ' .
				( strtoupper( $parameters['sort'] ) );
			$options['LIMIT'] = $parameters['limit'];

			$conditions = $this->getConditions( $title, $parameters['kidsonly'] );
			if ( is_null( $conditions ) ) {
				return $titles;
			}

			$fields = array();
			$fields[] = 'page_title';
			$fields[] = 'page_namespace';

			$res = $dbr->select( 'page', $fields, $conditions, __METHOD__, $options );

			foreach( $res as $row ) {
				$title = Title::makeTitleSafe( $row->page_namespace, $row->page_title );
				if( is_object( $title ) ) {
					$titles[] = $title;
				}
			}

			$dbr->freeResult( $res );

		}

		return $titles;
	}
	
	/**
	 * Creates one list item.
	 *  
	 * @param $fullName — Full name of page, including namespace (but excluding fragment).
	 * @param $nsLen — Length of namespace name (including colon, if any).
	 * @param $parentLen — Length of parent title (not including namespace but including slash).
	 * 
	 * @return string: wikitext for the list item
	 */
	protected function makeListItem( $fullName, $nsLen, $parentLen, array $parameters ) {
		switch( $parameters['pathstyle'] ) {
			case 'none' : case 'no' :
				// Just a last item.
				$slash = strrpos( $fullName, '/' );
				if ( $slash ) {
					$item = substr( $fullName, $slash + 1 );  // +1 to skip slash.
				}
				else {
					$item = substr( $fullName, $nsLen ); 
				}
				break;
			case 'subpagename' : case 'children' : case 'notparent' :
				// Pagename starting from parent.
				$item = substr( $fullName, $nsLen + $parentLen );
				break;
			case 'pagename' : case 'full' :
				// Almost full (without namespace).
				$item = substr( $fullName, $nsLen );
				break;
			case 'fullpagename' :
				// Full name (including namespace).
				$item = $fullName;
				break;
		}
		
		if ( $parameters['links'] ) {
			$item = "[[$fullName|$item]]";
		}
		
		if ( $parameters['template'] !== '' ) {
			$item = '{{' . $parameters['template'] . '|' . $item . '}}';
		}
		
		return $item;
	}

	/**
	 * Creates whole list using makeListItem.
	 *
	 * @see SubPageList::makeListItem
	 * 
	 * @param $title can be either an instance of Title class (title of an existing page), or number
	 *        (index of an existing namespace) or null.
	 * @param array $parameters
	 * @param array $titles
	 *  
	 * @return string the whole list
	 */
	protected function makeList( $title, array $parameters, array $titles ) {
		global $wgContLang;
		$start = '';	// String to render once in the very beginning of each item.
		$bullet = '';	// String to render between `$start' and item
						// (may be rendered few times, depends on nesting level).
		$sep = '';		// String to render between two items.
		$end = '';		// String to render once at the end of the last item.
		$items = array();
		
		switch ( $parameters['format'] ) {
			case 'ol' : case 'ordered' :
				$start = "\n";
				$bullet = '#';
				$end = "\n";
				break;
			case 'ul' : case 'unordered' : 
				$start = "\n";
				$bullet = '*';
				$end = "\n";
				break;
			case 'list' : case 'bar' :
				$sep = $parameters['separator'];
				break;
		}
		
		// Let us have $bullets is a long enough series of bullets.
		$bullets = $bullet;

		// WARNING: It seems strlen and other sring functions operated with bytes, not characters.
		// But it seems it is ok for UTF-8 encoding...

		if ( $title instanceof Title ) {
			$nsName = $title->getNsText();            // Namespace name.
			$parentFull = $title->getPrefixedText();  // Including namespace.
			$parentText = $title->getText();          // Not including namespace.
			$parentSlashCount = substr_count( $parentFull, '/' );
		}
		else {
			$nsName = $wgContLang->getNsText( $title );
			$parentFull = $nsName;
			$parentText = '';
			$parentSlashCount = -1;
		}
		// If prefix (namespace name) is not empty, count subsequent colon also.
		$nsLen = strlen( $nsName );
		if ( $nsLen > 0 ) {
			++ $nsLen;
		}
		// If parent page name is not empty, count subsequent slash also.
		$parentLen = strlen( $parentText );
		if ( $parentLen > 0 ) {
			++ $parentLen;
		}
		// Max nesting level. 
		$maxLevel = ( $parameters['kidsonly'] ? 1 : 1000 );

		if ( $parameters['showpage'] && $title instanceof Title ) {
			// If parent should be shown, correct starting point:
			$slash = strrpos( $parentText, '/' );
			if ( $slash ) {
				$parentLen = $slash + 1;
			}
			else {
				$parentLen = 0;
			}
			-- $parentSlashCount;
			++ $maxLevel;
			// Render page itself as the very first item of the list.
			$item =
				$start . $bullet .
				$this->makeListItem( $parentFull, $nsLen, $parentLen, $parameters );
			$items[] = $item;
		}

		foreach( $titles as $pageTitle ) {
			$pageFull = $pageTitle->getPrefixedText();
			$level = substr_count( $pageFull, '/' ) - $parentSlashCount;
			
			if ( $level <= $maxLevel ) {
				$item = '';
				if ( $bullet != '' ) {
					// Make sure $bullets is long enough.
					while ( strlen( $bullets ) < $level ) {
						$bullets .= $bullet;
 					} 
 					
					$item .= $start . substr( $bullets, 0, $level );
				}
				
				$item .= $this->makeListItem( $pageFull, $nsLen, $parentLen, $parameters );
				$items[] = $item; 
			}
		}

		return count( $items ) > 0 ? implode( $sep, $items ) . $end : '';
	}

	/**
	 * Returns the parser function otpions.
	 * @see ParserHook::getFunctionOptions
	 * 
	 * @since 0.2
	 * 
	 * @return array
	 */
	protected function getFunctionOptions() {
		return array(
			'noparse' => true,
			'isHTML' => true
		);
	}
	
}
