<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/cart/merchant_page_response',
        '/search',
        '/cart/process_response',
		'payfort/payment/response',
		'/checkout/device-finger-print/submit',
		'cart/stripe-checkout/submit',
		'tm-bookings-management/get-attendeece-count'
    ];
    
    
}
