<?php 

namespace SubPageList;

class SubPageCount implements \ParserHooks\HookHandler {

	/**
	 * @var SubPageCounter
	 */
	protected $counter;

	/**
	 * @var TitleFactory
	 */
	protected $titleFactory;

	public function setCounter( SubPageCounter $counter, TitleFactory $titleFactory ) {
		$this->counter = $counter;
		$this->titleFactory = $titleFactory;
	}


	/**
	 * @see ParserFunction::render
	 *
	 * @since 1.0
	 *
	 * @param \Parser $parser
	 * @param array $parameters
	 *
	 * @return string
	 */
	public function handle( \Parser $parser, \ParamProcessor\ProcessingResult $result ) {
		if ( $result->hasFatal() ) {
			// TODO:
			return 'FATAL';
		}

		$count = 0;

		$parameters = $result->getParameters();
		$title = $this->titleFactory->newFromText( $parameters['page'] );

		if ( $title !== null ) {
			$count = $this->counter->countSubPages( $title );
		}

		return $parser->getTargetLanguage()->formatNum( $count );
	}

}
