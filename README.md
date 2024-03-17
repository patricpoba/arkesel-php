# Arkesel SMS PHP and Laravel Package

<!-- [![Latest Version on Packagist](https://img.shields.io/packagist/v/patricpoba/arkesel-sms.svg?style=flat-square)](https://packagist.org/packages/patricpoba/arkesel-sms)
[![Build Status](https://img.shields.io/travis/patricpoba/arkesel-sms/master.svg?style=flat-square)](https://travis-ci.org/patricpoba/arkesel-sms)
[![Quality Score](https://img.shields.io/scrutinizer/g/patricpoba/arkesel-sms.svg?style=flat-square)](https://scrutinizer-ci.com/g/patricpoba/arkesel-sms)
[![Total Downloads](https://img.shields.io/packagist/dt/patricpoba/arkesel-sms.svg?style=flat-square)](https://packagist.org/packages/patricpoba/arkesel-sms) -->

This package enables sending of sms from your laravel application using https://sms.arkesel.com as a service provider.

## Requirements & Installation

This package requires at least php 7.0 or laravel 5.5. You can install the package via composer:

```bash
composer require patricpoba/arkesel-php
```

## PHP Usage

``` php
// PHP Examples

use PatricPoba\Arkesel\Sms;

$sms = new Sms('SenderId', 'smsApiKey');
  

## Basic sending(uses api_key set in .env file)
// successful response: {"code":"ok","message":"Successfully Send","balance":17706,"user":"Yaw Berko"}
// error response: {"code":"102","message":"Authentication Failed"} 
$sms->send('02XXXXXXXXX', 'Testing sms messaging');

## To use a different api key at runtime,
$sms->setApiKey('API_KEY_GOES_HERE')->send('02XXXXXXXX', 'Testing App');

## To customise sender Id (must not be more than 11 characters)
$sms->from('CompanyName')->send('02XXXXXXXX', 'Testing App');

## Sceduling (sending message at a later time)
// successful response: {"code":"109","message":"Invalid Schedule Time"} 
// successful response: {"code":"ok","message":"SMS Scheduled successfully.","balance":17705,"user":"Yaw Berko"}
$dateTime ='04-05-2020 06:19 PM'; // Must be this format - "d-m-Y h:i A" 
$sms->schedule($dateTime, '02XXXXXXXX', 'This message will be sent later')
 
## Checking Sms balance    
// successful response: {"balance":17707,"user":"Yaw Berko","country":"Ghana"}
$sms->balance();

## Check balance of a different a arkesel account account,
$sms->setApiKey('API_KEY_GOES_HERE')->balance();
```


## Laravel

If you're using laravel 5.5 and above, you can skip this step and continue at the examples.
Add the following line of code to the **providers**' array in *config/app.php file*.
```php  
PatricPoba\Arkesel\ArkeselServiceProvider::class
```

Add the facade of this package to the aliases array in the *config/app.php file*.

```php 
 'ArkeselSms' => PatricPoba\Arkesel\ArkeselSmsFacade::class
```


### Usage Examples 

``` php  
# Setting API key in .env file
Before you can start sending sms you will need to set your api key and default sender ID in your /.env file
You can find your api key here `https://sms.arkesel.com/user/sms-api/info` 
These config files can be changed  from the laravel application.  

<!-- /.env file --> 
ARKESEL_SMS_SENDER_ID=MyApp
ARKESEL_SMS_API_KEY=YourKeyGoesHere


## Sending Sms 
 
## Basic sending(uses api_key set in .env file)
 * successful response: {"code":"ok","message":"Successfully Send","balance":17706,"user":"Yaw Berko"}
 * error response: {"code":"102","message":"Authentication Failed"} 
 * */
 
ArkeselSms::send('02XXXXXXXXX', 'Testing sms messaging');

## To use a different api key at runtime,
ArkeselSms::setApiKey('API_KEY_GOES_HERE')->send('02XXXXXXXX', 'Testing App');


## To customise sender Id (must not be more than 11 characters)
ArkeselSms::from('CompanyName')->send('02XXXXXXXX', 'Testing App');


## Sceduling (sending message at a later time) 
// successful response: {"code":"109","message":"Invalid Schedule Time"} 
// successful response: {"code":"ok","message":"SMS Scheduled successfully.","balance":17705,"user":"Yaw Berko"}

$dateTime ='04-05-2020 06:19 PM'; // Must be this format - "d-m-Y h:i A" 
ArkeselSms::schedule($dateTime, '02XXXXXXXX', 'This message will be sent later')

 
## Checking Sms balance   
// successful response: {"balance":17707,"user":"Yaw Berko","country":"Ghana"}

ArkeselSms::balance();


## Check balance of a different a arkesel account account,
ArkeselSms::setApiKey('API_KEY_GOES_HERE')->balance();

```


### Security

If you discover any security related issues, please me a message on [twitter](https://twitter.com/patricpoba) instead of using the issue tracker.


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
