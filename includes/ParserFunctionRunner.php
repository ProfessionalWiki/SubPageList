<?php

namespace SubPageList;

class ParserFunctionRunner {

	/**
	 * @var ParserFunctionDefinition
	 */
	protected $definition;

	/**
	 * @var ParserFunctionHandler
	 */
	protected $handler;

	/**
	 * @var \ParamProcessor\Processor
	 */
	protected $paramProcessor;

	/**
	 * @param ParserFunctionDefinition $definition
	 * @param ParserFunctionHandler $handler
	 * @param \ParamProcessor\Processor|null $paramProcessor
	 */
	public function __construct( ParserFunctionDefinition $definition, ParserFunctionHandler $handler, \ParamProcessor\Processor $paramProcessor = null ) {
		$this->defintion = $definition;
		$this->handler = $handler;

		if ( $paramProcessor === null ) {
			$paramProcessor = \ParamProcessor\Processor::newDefault();
		}

		$this->paramProcessor = $paramProcessor;
	}

	/**
	 * @param \Parser $parser
	 */
	public function run( \Parser &$parser /*, n args */ ) {
		$arguments = func_get_args();

		array_shift( $arguments );

		$names = $this->definition->getNames();
		$this->paramProcessor->getOptions()->setName( $names[0] );

		$this->paramProcessor->setFunctionParams(
			$arguments,
			$this->definition->getParameters(),
			$this->definition->getDefaultParameters()
		);

		$this->paramProcessor->validateParameters();

		$processingResult = new ProcessingResult( $this->paramProcessor->getParameters(), $this->paramProcessor->getErrors() );

		$this->handler->handle( $parser, $processingResult );
	}

	/**
	 * @return ParserFunctionHandler
	 */
	public function getHandler() {
		return $this->handler;
	}

	/**
	 * @return ParserFunctionDefinition
	 */
	public function getDefinition() {
		return $this->definition;
	}

}