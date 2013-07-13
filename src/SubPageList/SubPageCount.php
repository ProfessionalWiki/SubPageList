<?php 

namespace SubPageList;

use ParamProcessor\ProcessingResult;
use Parser;
use ParserHooks\HookHandler;

/**
 * Handler for the subpagecount parser hook.
 *
 * @since 1.0
 * @file
 * @ingroup SubPageList
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class SubPageCount implements HookHandler {

	protected $counter;
	protected $titleFactory;

	public function __construct( SubPageCounter $counter, TitleFactory $titleFactory ) {
		$this->counter = $counter;
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
			// TODO:
			return 'FATAL';
		}

		$count = 0;

		$parameters = $result->getParameters();
		$title = $this->titleFactory->newFromText( $parameters['page']->getValue() );

		if ( $title !== null ) {
			$count = $this->counter->countSubPages( $title );
		}

		return $parser->getTargetLanguage()->formatNum( $count );
	}

}
