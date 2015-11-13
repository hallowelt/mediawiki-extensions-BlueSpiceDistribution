<?php
/**
 * TextEmailFormatter class for notifications
 *
 * Part of BlueSpice for MediaWiki
 *
 * @author     Patric Wirth <wirth@hallowelt.biz>
 * @package    BlueSpice_Distrubution
 * @copyright  Copyright (C) 2012 Hallo Welt! - Medienwerkstatt GmbH, All rights reserved.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU Public License v2 or later
 * @filesource
 */

class BsEchoTextEmailFormatter extends EchoTextEmailFormatter {
	/**
	 * @param $emailMode EchoEmailMode
	 */
	public function __construct( EchoEmailMode $emailMode ) {
		parent::__construct( $emailMode );
		$this->emailMode->attachDecorator( new BsEchoTextEmailDecorator() );
	}
}