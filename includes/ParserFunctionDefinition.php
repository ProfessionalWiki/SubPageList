<?php

namespace SubPageList;

class ParserFunctionDefinition {

	protected $names;
	protected $parameters;
	protected $defaultParameters;

	/**
	 * @since 1.0
	 *
	 * @param string|string[] $names
	 * @param array $parameters
	 * @param string|string[] $defaultParameters
	 */
	public function __construct( $names, array $parameters = array(), $defaultParameters = array() ) {
		$this->names = (array)$names;
		$this->parameters = $parameters;
		$this->defaultParameters = (array)$defaultParameters;
	}

	/**
	 * @see ParserFunction::getName
	 *
	 * @since 1.0
	 *
	 * @return string[]
	 */
	public function getNames() {
		return $this->names;
	}

	/**
	 * @see ParserFunction::getParameters
	 *
	 * @since 1.0
	 *
	 * @return array
	 */
	public function getParameters() {
		return $this->parameters;
	}

	/**
	 * @see ParserFunction::getDefaultParameters
	 *
	 * @since 1.0
	 *
	 * @return string[]
	 */
	public function getDefaultParameters() {
		return $this->defaultParameters;
	}

}