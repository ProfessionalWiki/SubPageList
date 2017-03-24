<?php 

namespace SubPageList\Lister;

use LogicException;
use ParamProcessor\ProcessedParam;
use ParamProcessor\ProcessingResult;
use Parser;
use ParserHooks\HookHandler;
use SubPageList\TitleFactory;
use SubPageList\Lister\UI\SubPageListRenderer;
use Title;

/**
 * Handler for the subpagelist parser hook.
 *
 * @since 1.2
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class SubPageList implements HookHandler {

	private $subPageFinder;
	private $pageHierarchyCreator;
	private $subPageListRenderer;
	private $titleFactory;

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
	 * @since 1.2
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

	private function getTitle( Parser $parser, $pageName ) {
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
	private function renderForTitle( Title $title, array $parameters ) {
		$topLevelPage = $this->getPageHierarchy( $title, $parameters['sort'], $parameters['limit'], $parameters['redirects'] );

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
	 * @param string $sortOrder
	 * @param bool $includeRedirects
	 *
	 * @return Page
	 * @throws LogicException
	 */
	private function getPageHierarchy( Title $title, $sortOrder, $limit, $includeRedirects ) {
		$this->subPageFinder->setLimit( $limit );
		$this->subPageFinder->setSortOrder( $sortOrder );
		$this->subPageFinder->setIncludeRedirects( $includeRedirects );

		$subPageTitles = $this->subPageFinder->getSubPagesFor( $title );
		$subPageTitles[] = $title;

		$pageHierarchy = $this->pageHierarchyCreator->createHierarchy( $subPageTitles );

		if ( count( $pageHierarchy ) !== 1 ) {
			throw new LogicException( 'Expected exactly one top level page' );
		}

		$topLevelPage = reset( $pageHierarchy );
		return $topLevelPage;
	}

	private function shouldUseDefault( Page $topLevelPage, $showTopLevelPage ) {
		// Note: this behaviour is not fully correct.
		// Other parameters that omit results need to be held into account as well.
		return !$showTopLevelPage && $topLevelPage->getSubPages() === [];
	}

	private function getRenderedList( Page $topLevelPage, $parameters ) {
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
	private function getDefault( $titleText, $default ) {
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
	private function paramsToOptions( array $parameters ) {
		$options = [];

		foreach ( $parameters as $parameter ) {
			$options[$parameter->getName()] = $parameter->getValue();
		}

		return $options;
	}

}
