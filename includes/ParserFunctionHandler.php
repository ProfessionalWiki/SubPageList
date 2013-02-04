<?php

namespace SubPageList;

interface ParserFunctionHandler {

	public function handle( \Parser $parser, ProcessingResult $result );

}