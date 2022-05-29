<?php


namespace TNM\USSD\Factories;

use TNM\USSD\Http\AfricasTalking\AfricasTalkingRequest;
use TNM\USSD\Http\Flares\FlaresRequest;
use TNM\USSD\Http\TruRoute\TruRouteRequest;
use TNM\USSD\Http\HollaTags\HollaTagsRequest;
use TNM\USSD\Http\UssdRequestInterface;

class RequestFactory
{
    public function make(): UssdRequestInterface
    {
        switch (request()->route('adapter')) {
            case 'flares' :
                return resolve(FlaresRequest::class);
            case 'africastalking' :
                return resolve(AfricasTalkingRequest::class);
            case 'hollatags' :
                return resolve(HollaTagsRequest::class);
            default:
                return resolve(TruRouteRequest::class);
        }
    }
}
