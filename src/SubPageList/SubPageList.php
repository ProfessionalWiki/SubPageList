<?php 

namespace SubPageList;

use Parser;
use ParserHooks\HookHandler;
use ParamProcessor\ProcessingResult;

/**
 * Handler for the subpagelist parser hook.
 *
 * @since 1.0
 * @file
 * @ingroup SubPageList
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class SubPageList implements HookHandler {


	/**
	 * @since 1.0
	 *
	 */
	public function __construct(  ) {

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

		return '';
	}

}
