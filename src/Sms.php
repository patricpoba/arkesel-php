<?php

namespace PatricPoba\Arkesel;

class Sms
{
    /**
     * The package version. 
     * @var string
     */
    const VERSION = '1.0';

	const SMS_ENDPOINT = 'https://sms.arkesel.com/sms/api';

	protected $smsApiKey;

	public $to;

	public $message;

	public $senderId; 

	public $dateTime; 

 
    /**
	 * Although config variable $smsApiKey can be set in the env,
	 * it can also be set via the constructor to enable swapping
	 * of api keys during runtime
     *
     * @param string $senderId
     * @param string $smsApiKey
     */
	public function __construct($senderId = null, $smsApiKey = null)
	{  
        /**
         * If current app is a laravel app, fall back to system 
         * config for senderId and smsApiKey if no params are 
         * provided via constructor
         */
        if (function_exists('config')) {

            $senderId  = $senderId  ??  config('arkesel.sms.sender-id');

            $smsApiKey = $smsApiKey ??  config('arkesel.sms.api-key') ;
        }
 
        $this->from($senderId) ;

        $this->setApiKey($smsApiKey) ; 
	}
 
	/**
     * Setter for sender_id
	 * override senderId parameter
	 * @param \PatricPoba\Mnotify\Sms
	 */
	public function from($senderId)
	{
		// limit sender id to 11 characters
		$this->senderId = substr($senderId, 0, 11);

		return $this;
    }
    
    public function getSenderId()
	{
        return substr($this->senderId, 0, 11);
	}

	public function getApiKey()
	{
		return $this->smsApiKey;
	}

	public function setApiKey($smsApiKey)
	{
		// limit sender id to 11 characters
		$this->smsApiKey = $smsApiKey ;

		return $this;
	}
 
 	/**
 	 * Send Sms to Phone number
 	 * @param  int 	    $to        	recepient phone number
 	 * @param  string   $message    messge to be sent
 	 * @param  string   $key       	api key
 	 * @param  string   $dateTime 	schedule date in "d-m-Y h:i A" format
 	 * @return string   [json]
 	 */
	public function send($to = null, $message = null, $dateTime = null )
	{  
		$this->to 					= $to ?: $this->to;
		$this->message 			= $message ?: $this->message; 
		$this->dateTime 		= $dateTime ?: $this->dateTime;
 
		//prepare url
        $url = static::SMS_ENDPOINT .'?'
                    . "action=send-sms"
		            . "&api_key=". $this->getApiKey()
		            . "&to=" . $this->to 
		            . "&sms=". urlencode($this->message) 
		            . "&from=" . $this->getSenderId() ;
		            
		if( !is_null($dateTime) ) $url .= '&schedule='. urlencode($dateTime) ;
                    
        /**
         * successful response
         * {"code":"ok","message":"Successfully Send","balance":17707,"user":"Qodehub Limited"}
         * 
         * error: 
         * {"code":"102","message":"Authentication Failed"}
         */
		return $responeCode = file_get_contents($url) ; 
	}	 


    /**
     * Send sms at a later date and time.
     * @docs: inherit ->send(...) 
     * 
     * @return sample
     * {"code":"109","message":"Invalid Schedule Time"}
     * {"code":"ok","message":"SMS Scheduled successfully.","balance":17705,"user":"Qodehub Limited"}
     * @return void
     */
	public function schedule($dateTime, $to = null, $message = null )
	{
		return $this->send($to, $message, $dateTime);
	}

	/**
	 * Although config variable $smsApiKey can be set in the env,
	 * it can also be set via the constructor to enable swapping
	 * of api keys during runtime
	 * @param int $balance
	 */
	public function balance()
	{   
		$url= static::SMS_ENDPOINT .'?action=check-balance&response=json&api_key=' .$this->getApiKey(); 

		return file_get_contents($url);
	}
 

}
