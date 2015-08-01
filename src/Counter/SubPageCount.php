<?php 

namespace SubPageList\Counter;

use ParamProcessor\ProcessingResult;
use Parser;
use ParserHooks\HookHandler;
use SubPageList\TitleFactory;

/**
 * Handler for the subpagecount parser hook.
 *
 * @since 1.2
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class SubPageCount implements HookHandler {

	private $counter;
	private $titleFactory;

	public function __construct( SubPageCounter $counter, TitleFactory $titleFactory ) {
		$this->counter = $counter;
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
			// TODO:
			return 'Invalid input. Cannot calculate sub page count.';
		}

		$count = $this->getSubPageCount( $parser, $result );

		return $parser->getTargetLanguage()->formatNum( $count );
	}

	private function getSubPageCount( Parser $parser, ProcessingResult $result ) {
		$parameters = $result->getParameters();
		$title = $this->getTitle( $parser, $parameters['page']->getValue() );

		if ( $title === null ) {
			return 0;
		}

		return $this->counter->countSubPages( $title );
	}

	private function getTitle( Parser $parser, $pageName ) {
		if ( $pageName === '' ) {
			return $parser->getTitle();
		}
		else {
			return $this->titleFactory->newFromText( $pageName );
		}
	}

}
