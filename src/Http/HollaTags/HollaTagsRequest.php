<?php
namespace TNM\USSD\Http\HollaTags;

use TNM\USSD\Http\Request;
use TNM\USSD\Http\UssdRequestInterface;

class HollaTagsRequest implements UssdRequestInterface
{
	/**
	 * @var array
	 */
	private $request;

	public function __construct()
	{
		$this->request = request();
	}

	public function getMsisdn() : string
	{
		return $this->request['session_msisdn'];
	}

	public function getSession() : string
	{
		return $this->request['session_id'];
	}

	public function getType() : int
	{
		$session_type = $this->request['session_type'];
		switch ($session_type) {
			case 'begin':
				return Request::INITIAL;
			case 'continue':
				return Request::RESPONSE;
			case 'end':
				return Request::RELEASE;
			default:
				return Request::RESPONSE;
		}
	}

	public function getMessage() : string
	{
		return $this->request['session_msg'];
	}
}