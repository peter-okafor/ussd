<?php
namespace TNM\USSD\Http\AfricasTalking;

use TNM\USSD\Http\Request;
use TNM\USSD\Http\UssdRequestInterface;
use TNM\USSD\Models\Session;

class AfricasTalkingRequest implements UssdRequestInterface
{
	/**
     * @var array
     */
	private $request;

	public function __construct() {
		$this->request = request();
	}

	public function getMsisdn() : string
	{
		return $this->request['phoneNumber'];
	}

	public function getSession() : string
	{
		$session = $this->modifySession($this->request['sessionId'], $this->request['phoneNumber']);
		return $session;
	}

	public function getType() : int
	{
		return Session::findBySessionId($this->getSession())->exists() ? Request::RESPONSE : Request::INITIAL;
	}

	public function getMessage() : string
	{
		return $this->modifyText($this->request['text']) ?? "#";
	}

	private function modifySession(string $session, string $phone) : string
	{
		$removeAlphabets = preg_replace("/[^0-9]/", "", $session );
		$shortenSession = substr($removeAlphabets, 0, 5);
		$mid4digits = substr($phone, 6, 4);
		return $mid4digits.$shortenSession;
	}

	private function modifyText($text)
	{
		if ($text && strpos($text, '*')) {
			if ( strlen($text) > 2 && substr($text, strlen($text) - 2, 2) == '**') {
				return '*';
			}
			$split = explode('*', $text);
			return $split[count($split) - 1];;
		}
		return $text;
	}
}

?>