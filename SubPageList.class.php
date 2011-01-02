<?php

/**
 * CLass to render the sub page list.
 * 
 * @since 0.1
 * 
 * @file SubPageList.class.php
 * @ingroup SPL
 * 
 * @licence GNU GPL v3 or later
 *
 * @author Jeroen De Dauw
 * @author James McCormack (email: user "qedoc" at hotmail); preceding version Martin Schallnahs <myself@schaelle.de>, original Rob Church <robchur@gmail.com>
 * @copyright © 2008 James McCormack, preceding version Martin Schallnahs, original Rob Church
 */
final class SubPageList extends ParserHook {
	
	/**
	 * No LST in pre-5.3 PHP *sigh*.
	 * This is to be refactored as soon as php >=5.3 becomes acceptable.
	 */
	public static function staticMagic( array &$magicWords, $langCode ) {
		$className = __CLASS__;
		$instance = new $className();
		return $instance->magic( $magicWords, $langCode );
	}
	
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
		return array( 'subpages', 'splist' );
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
		
		$params['sort'] = new Parameter( 'sort' );
		$params['sort']->addAliases( 'order' );
		$params['sort']->addCriteria( new CriterionInArray( 'asc', 'desc' ) );
		$params['sort']->addManipulations( new ParamManipulationFunctions( 'strtolower' ) );
		$params['sort']->setDefault( 'asc' );
		$params['sort']->setDescription( wfMsg( 'spl-subpages-par-sort' ) );
		
		$params['sortby'] = new Parameter( 'sortby' );
		$params['sortby']->addCriteria( new CriterionInArray( 'title', 'lastedit' ) );
		$params['sortby']->addManipulations( new ParamManipulationFunctions( 'strtolower' ) );		
		$params['sortby']->setDefault( 'title' );
		$params['sortby']->setDescription( wfMsg( 'spl-subpages-par-sortby' ) );
		
		$params['format'] = new Parameter( 'format' );
		$params['format']->addAliases( 'liststyle' );		
		$params['format']->addCriteria( new CriterionInArray(
			'ul', 'unordered',
			'ol', 'ordered',
			'list', 'bar'			
		) );
		$params['format']->addManipulations( new ParamManipulationFunctions( 'strtolower' ) );		
		$params['format']->setDefault( 'ul' );	
		$params['format']->setDescription( wfMsg( 'spl-subpages-par-format' ) );	
		
		$params['page'] = new Parameter( 'page' );
		$params['page']->addAliases( 'parent' );
		$params['page']->setDefault( '' );
		$params['page']->setDescription( wfMsg( 'spl-subpages-par-page' ) );
		
		$params['showpage'] = new Parameter( 'showpage', Parameter::TYPE_BOOLEAN );
		$params['showpage']->addAliases( 'showparent' );
		$params['showpage']->setDefault( 'no' );			
		$params['showpage']->setDescription( wfMsg( 'spl-subpages-par-showpage' ) );
		
		$params['pathstyle'] = new Parameter( 'pathstyle' );
		$params['pathstyle']->addAliases( 'showpath' );
		$params['pathstyle']->addCriteria( new CriterionInArray(
			'none', 'no',
			'children', 'notparent',
			'full'
		) );
		$params['pathstyle']->setDefault( 'none' );
		$params['pathstyle']->addManipulations( new ParamManipulationFunctions( 'strtolower' ) );	
		$params['pathstyle']->setDescription( wfMsg( 'spl-subpages-par-pathstyle' ) );
		
		$params['kidsonly'] = new Parameter( 'kidsonly', Parameter::TYPE_BOOLEAN );
		$params['kidsonly']->setDefault( 'no' );
		$params['kidsonly']->setDescription( wfMsg( 'spl-subpages-par-kidsonly' ) );
		
		$params['limit'] = new Parameter( 'limit', Parameter::TYPE_INTEGER );
		$params['limit']->setDefault( 200 );
		$params['limit']->addCriteria( new CriterionInRange( 1, 500 ) );			
		$params['limit']->setDescription( wfMsg( 'spl-subpages-par-limit' ) );
		
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
		global $wgContLang;
		
		$this->language = $wgContLang;		
		
		$title = $this->getTitle( $parameters );
		
		$pages = $this->getSubPages( $title, $parameters );
		
		if ( count( $pages ) > 0 ) {
			$list = $this->makeList( $title, $parameters, $pages );
		}
		else {
			$list = "''" . wfMsg( 'spl-nosubpages', '[[' . $title->getFullText() . ']]' ) . "''\n";
		}
		
		return '<div class="subpagelist">' . $this->parse( $list ) . '</div>';
	}	
	
	/**
	 * Returns the title for which subpages should be fetched.
	 * 
	 * @since 0.1
	 * 
	 * @param array $parameters
	 * 
	 * @return Title
	 */
	protected function getTitle( array $parameters ) {
		$title = false;
		
		if ( $parameters['page'] != '' ) {
			$specifiedTitle = Title::newFromText( $parameters['page'] );
			
			if ( !is_null( $specifiedTitle ) && $specifiedTitle->exists() ) {
				$title = $specifiedTitle;
			}
		}
		
		if ( $title === false ) {
			$title = $this->parser->mTitle;
		}

		return $title;
	}

	/**
	 * Returns the subpages for a page.
	 * 
	 * @since 0.1
	 * 
	 * @param Title $title
	 * @param array $parameters
	 * 
	 * @return array of Title
	 */
	protected function getSubPages( Title $title, array $parameters ) {
		$titles = array();
		
		$dbr = wfGetDB( DB_SLAVE );
		
		$options = array();
		$options['ORDER BY'] = 
			( $parameters['sortby'] == 'title' ? 'page_title' : 'page_touched' ) . ' ' .
			( strtoupper( $parameters['sort'] ) );
		$options['LIMIT'] = $parameters['limit'];

		$conditions = array();
		$conditions['page_namespace'] = $title->getNamespace(); // Don't let list cross namespaces.
		$conditions['page_is_redirect'] = 0;
		
		// TODO: this is rather resource heavy
		$conditions[] = '`page_title` LIKE ' . $dbr->addQuotes( $dbr->escapeLike( $title->getDBkey() ) . '/%' );

		$fields = array();
		$fields[] = 'page_title';
		$fields[] = 'page_namespace';
		
		$res = $dbr->select( 'page', $fields, $conditions, __METHOD__, $options );

		while( $row = $dbr->fetchObject( $res ) ) {
			$title = Title::makeTitleSafe( $row->page_namespace, $row->page_title );
			if( is_object( $title ) ) {
				$titles[] = $title;
			}
		}		
		
		$dbr->freeResult( $res );

		return $titles;
	}
	
	/**
	 * Creates one list item.
	 *  
	 * @param Title $title the title of a page
	 * @param array $parameters
	 * 
	 * @return string: wikitext for the list item
	 */
	protected function makeListItem( Title $title, array $parameters ) {
		switch( $parameters['pathstyle'] ) {
			case 'none' : case 'no' : 
				$linktitle = substr( strrchr( $title->getText(), "/" ), 1 );
				break;
			case 'children' : case 'notparent' : 
				$linktitle = substr( strstr( $title->getText(), "/" ), 1 );
				break;
			case 'full' :
				$linktitle = $title->getText();
				break;
		}
		
		return ' [[' . $title->getFullText() . '|' . $linktitle . ']]';
	}

	/**
	 * Creates whole list using makeListItem.
	 *
	 * @see SubPageList::makeListItem
	 * 
	 * @param Title $title
	 * @param array $parameters
	 * @param array $titles
	 *  
	 * @return string the whole list
	 */
	protected function makeList( Title $title, array $parameters, array $titles ) {
		$token = '';
		$isSingleLine = false;
		
		$items = array();
		
		switch ( $parameters['format'] ) {
			case 'ol' : case 'ordered' :
				$token = '#';
				break;
			case 'ul' : case 'unordered' : 
				$token = '*';
				break;
			case 'list' : case 'bar' :
				$isSingleLine = true;
				$token = '&#160;· ';
				break;
		}
		
		if ( $parameters['showpage'] ) {
			$item = '[[' . $title->getFullText() .'|'. $title->getText() .']]';
			
			if ( !$isSingleLine ) {
				$item = $token . $item;
			}
			
			$items[] = trim( $item );
		}
		
		$parentLevel = substr_count( $title->getFullText(), '/' );
		
		$isFirst = true;
		
		foreach( $titles as $subPageTitle ) {
			$level = substr_count( $subPageTitle->getFullText(), '/' ) - $parentLevel;	
			
			if ( $parameters['kidsonly'] || $level < 2 ) {
				
				if ( $parameters['showpage'] ) {
					$level++;
				}
				
				$item = '';
				
				if( $isSingleLine ) {
					if( $isFirst ) {
						$item .= ': ';
					}
					else {
						$item .= $token;
					}
				} else {
					for ( $i = 0; $i < $level; $i++ ) {
						$item .= $token;
					}
				}
				
				$items[] = trim( $item . $this->makeListItem( $subPageTitle, $parameters ) );
			}
			
			$isFirst = false;
		}

		return implode( $isSingleLine ? '' : "\n", $items );
	}

	/**
	 * Wrapper function parse, call the other functions.
	 * 
	 * @param string $text the content
	 * 
	 * @return string the parsed output
	 */
	protected function parse( $text ) {
		$options = $this->parser->mOptions;
		$output = $this->parser->parse( $text, $this->parser->mTitle, $options, true, false );
		return $output->getText();
	}	
	
}