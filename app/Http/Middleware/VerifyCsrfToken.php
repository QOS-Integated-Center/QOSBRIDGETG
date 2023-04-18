<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        '/QosicBridge/tg/user/deposit',
        '/QosicBridge/tg/user/depositmv',
        '/QosicBridge/tg/user/requestpayment',
        '/QosicBridge/tg/user/requestpaymentmv',
        '/QosicBridge/tg/user/gettransactionstatus',
        '/QosicBridge/tg/user/refund',
        '/QosicBridge/tg/user/getavailableamountowithdraw',
        '/QosicBridge/tg/user/getaccountholderinfo',
        '/QosicBridge/tg/user/getaccountholderinfomv',
        '/QosicBridge/tg/user/addaccountholderinfomv',
        '/QosicBridge/tg/user/addaccountholderinfo',
        '/QosicBridge/tg/user/deleteaccountholderinfo',
        '/QosicBridge/tg/user/updateaccountholderinfo'
    ];
    
}
