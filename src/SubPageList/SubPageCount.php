<?php 

namespace SubPageList;

use ParserHooks\HookHandler;

/**
 * Handler for the subpagecount parser hook.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @since 1.0
 *
 * @file
 * @ingroup SPL
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
	 * @param \Parser $parser
	 * @param \ParamProcessor\ProcessingResult $result
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
