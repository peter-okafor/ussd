<?php
namespace TNM\USSD\Http\HollaTags;

use TNM\USSD\Http\Response;
use TNM\USSD\Http\UssdResponseInterface;
use TNM\USSD\Screen;

class HollaTagsResponse implements UssdResponseInterface
{
    public function respond(Screen $screen)
    {
		$response = [];
		$response['session_id'] = $screen->request->getSession();
		$response['session_operation'] = $screen->type() == Response::RESPONSE ? 'continue' : 'end';
		$response['session_msg'] = $screen->getResponseMessage();
		$response['session_type'] = $screen->type() == Response::RESPONSE ? 1 : 4;

		return json_encode($response);
    }
}