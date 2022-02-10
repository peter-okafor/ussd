<?php
namespace TNM\USSD\Http\AfricasTalking;

use TNM\USSD\Http\Response;
use TNM\USSD\Http\UssdResponseInterface;
use TNM\USSD\Screen;

class AfricasTalkingResponse implements UssdResponseInterface
{
	public function respond(Screen $screen)
	{
		return ($screen->type() == Response::RESPONSE ? "CON " : "END ") . $screen->getResponseMessage() ;
	}
}

?>