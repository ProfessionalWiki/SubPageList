<?php 

namespace SubPageList;

use Parser;
use ParserHooks\HookHandler;
use ParamProcessor\ProcessingResult;

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

	/**
	 * @since 1.0
	 *
	 * @var SubPageCounter
	 */
	protected $counter;

	/**
	 * @since 1.0
	 *
	 * @var TitleFactory
	 */
	protected $titleFactory;

	/**
	 * @since 1.0
	 *
	 * @param SubPageCounter $counter
	 * @param TitleFactory $titleFactory
	 */
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
	public function handle( Parser $parser, \ParamProcessor\ProcessingResult $result ) {
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
