<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    
    'sms' => [ 
        /**
         * Api key of https://sms.arkesel.com for sending sms.
         * this can be located from the arkesel portal
         */ 
        'api-key' => env('ARKESEL_SMS_API_KEY'),

        'sender-id' => env('ARKESEL_SMS_SENDER_ID')
    ]
];