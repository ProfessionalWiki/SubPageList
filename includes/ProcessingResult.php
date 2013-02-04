<?php

namespace SubPageList;

// TODO: this stuff really should be in ParamProcessor
class ProcessedParam extends \ParamProcessor\Param {}

class ProcessingResult {

	/**
	 * @var ProcessedParam[]
	 */
	protected $parameters;

	/**
	 * @param ProcessedParam[] $parameters
	 * @param array $errors
	 */
	public function __construct( array $parameters, array $errors ) {
		$this->parameters = $parameters;
	}

	/**
	 * @return ProcessedParam[]
	 */
	public function getParameters() {
		return $this->parameters;
	}

	public function getErrors() {
		return array(); // TODO
	}

	public function hasFatal() {
		return false; // TODO
	}

}