<?php

namespace SubPageList;

use Parser;

class ParserHookRegisterer {

	/**
	 * @var \Parser
	 */
	protected $parser;

	/**
	 * @param \Parser $parser
	 */
	public function __construct( Parser &$parser ) {
		$this->parser = $parser;
	}

	/**
	 * @param ParserFunctionRunner $runner
	 */
	public function registerFunction( ParserFunctionRunner $runner ) {
		$this->parser->setFunctionHook(
			$runner->getDefinition(),
			array( $runner, 'run' ),
			SFH_OBJECT_ARGS
		);
	}

}