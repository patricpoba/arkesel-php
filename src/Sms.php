<?php

namespace PatricPoba\Arkesel;

class Sms
{
    /**
     * The package version. 
     * @var string
     */
    const VERSION = '0.1.0';

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
	 * @param [type] $smsApiKey [description]
	 */
	public function __construct($senderId = null, $smsApiKey = null)
	{ 
		$this->from($senderId);

		$this->setApiKey($smsApiKey); 
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
 	 * @param  string   $dateTime 	schedule
 	 * @return boolean|array        [description]
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
		            
		if( !is_null($dateTime) ) $url .= '&schedule='. $dateTime ;
		            
		return $responeCode = file_get_contents($url) ;
		
		return $responeCode == '1000' 
								? true 
                                : [ 
                                    'error' => 'true',
                                    'error_code' => $responeCode, 
                                    'error_message' => $this->errorMessage($responeCode) 
                                ]; 
	}	 


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

	/**
	 * Inteprete error code
	 * @param  int $errorCode [error code returned by api]
	 * @return string  'error message'
	 */
	public function errorMessage($errorCode)
	{
		switch($errorCode){                                           
			case '1000':
				return 'Message sent';
				break;

			case '1002':
				return 'Message not sent';
				break;

			case '1003':
				return 'You do not have enough balance';
				break;

			case '1004':
				return 'Invalid API Key';
				break;

			case '1005':
				return 'Phone number not valid';
				break;

			case '1006':
				return 'Invalid Sender ID';
				break;

			case '1008':
				return 'Empty message';
				break; 
			default:
				return 'unknown error code';
		}
    }

}
