<?php 

namespace SubPageList;

use LogicException;
use ParamProcessor\ProcessedParam;
use ParamProcessor\ProcessingResult;
use Parser;
use ParserHooks\HookHandler;
use SubPageList\UI\SubPageListRenderer;
use Title;

/**
 * Handler for the subpagelist parser hook.
 *
 * @since 1.0
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class SubPageList implements HookHandler {

	protected $subPageFinder;
	protected $pageHierarchyCreator;
	protected $subPageListRenderer;
	protected $titleFactory;

	public function __construct( SubPageFinder $finder, PageHierarchyCreator $hierarchyCreator,
		SubPageListRenderer $renderer, TitleFactory $titleFactory ) {

		$this->subPageFinder = $finder;
		$this->pageHierarchyCreator = $hierarchyCreator;
		$this->subPageListRenderer = $renderer;
		$this->titleFactory = $titleFactory;
	}

	/**
	 * @see HookHandler::handle
	 *
	 * @since 1.0
	 *
	 * @param Parser $parser
	 * @param ProcessingResult $result
	 *
	 * @return string
	 */
	public function handle( Parser $parser, ProcessingResult $result ) {
		if ( $result->hasFatal() ) {
			// This should not occur given the current parameter definitions.
			return 'Error: invalid input into subPageList function';
		}

		$parameters = $this->paramsToOptions( $result->getParameters() );

		$title = $this->getTitle( $parser, $parameters['page'] );

		if ( $title !== null ) {
			return $this->renderForTitle( $title, $parameters );
		}

		return 'Error: invalid title provided'; // TODO (might want to use a title param...)
	}

	protected function getTitle( Parser $parser, $pageName ) {
		if ( $pageName === '' ) {
			return $parser->getTitle();
		}
		else {
			return $this->titleFactory->newFromText( $pageName );
		}
	}

	/**
	 * @param Title $title
	 * @param array $parameters
	 *
	 * @return string
	 */
	protected function renderForTitle( Title $title, array $parameters ) {
		$topLevelPage = $this->getPageHierarchy( $title, $parameters['limit'] );

		if ( $this->shouldUseDefault( $topLevelPage, $parameters['showpage'] ) ) {
			return $this->getDefault( $parameters['page'], $parameters['default'] );
		}
		else {
			return $this->getRenderedList( $topLevelPage, $parameters );
		}
	}

	/**
	 * @param Title $title
	 * @param int $limit
	 *
	 * @return Page
	 * @throws LogicException
	 */
	protected function getPageHierarchy( Title $title, $limit ) {
		$this->subPageFinder->setLimit( $limit );

		$subPageTitles = $this->subPageFinder->getSubPagesFor( $title );
		$subPageTitles[] = $title;

		$pageHierarchy = $this->pageHierarchyCreator->createHierarchy( $subPageTitles );

		if ( count( $pageHierarchy ) !== 1 ) {
			throw new LogicException( 'Expected exactly one top level page' );
		}

		$topLevelPage = reset( $pageHierarchy );
		return $topLevelPage;
	}

	protected function shouldUseDefault( Page $topLevelPage, $showTopLevelPage ) {
		// Note: this behaviour is not fully correct.
		// Other parameters that omit results need to be held into account as well.
		return !$showTopLevelPage && $topLevelPage->getSubPages() === array();
	}

	protected function getRenderedList( Page $topLevelPage, $parameters ) {
		return $this->subPageListRenderer->render(
			$topLevelPage,
			$parameters
		);
	}

	/**
	 * @param string $titleText
	 * @param string $default
	 *
	 * @return string
	 */
	protected function getDefault( $titleText, $default ) {
		if ( $default === '' ) {
			return "\"$titleText\" has no sub pages."; // TODO
		}

		if ( $default === '-' ) {
			return '';
		}

		return $default;
	}

	/**
	 * @param ProcessedParam[] $parameters
	 *
	 * @return array
	 */
	protected function paramsToOptions( array $parameters ) {
		$options = array();

		foreach ( $parameters as $parameter ) {
			$options[$parameter->getName()] = $parameter->getValue();
		}

		return $options;
	}

}
