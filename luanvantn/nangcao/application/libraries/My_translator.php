<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_translator{

	protected $CI;
	public function __construct()
	{

		$this->CI =& get_instance();

		
		
	}


	public function entovi($inputString)
	{

		try {
		    //Client ID of the application.
		    $clientID       = "amy_suong_93";// thay đổi ở đây
		    //Client Secret key of the application.
		    //CdQWX2LUeNpEMWSpmgyv3KR6C7iSj9RXKRChtMLo2aU=
		    $clientSecret = "CdQWX2LUeNpEMWSpmgyv3KR6C7iSj9RXKRChtMLo2aU=";// thay đổi ở đây
		    //OAuth Url.
		    $authUrl      = "https://datamarket.accesscontrol.windows.net/v2/OAuth2-13/";
		    //Application Scope Url
		    $scopeUrl     = "http://api.microsofttranslator.com";
		    //Application grant type
		    $grantType    = "client_credentials";
		    //Create the AccessTokenAuthentication object.
		    $authObj      = $this->CI->load->library('accesstokenauthentication');
		    //Get the Access token.
		    $accessToken  = $this->CI->accesstokenauthentication->gettokens($grantType, $scopeUrl, $clientID, $clientSecret, $authUrl);
		    //Create the authorization Header string.
		    $authHeader = "Authorization: Bearer ". $accessToken;
		    
		    //Create the Translator Object.
		    $translatorObj = $this->CI->load->library('httptranslator');

		    $from = "en";
		    $to = "vi";
		    $uri = "http://api.microsofttranslator.com/v2/Http.svc/Translate?text=" . urlencode($inputString) . "&from=" . $from . "&to=" . $to;

		    $strResponse = $this->CI->httptranslator->curlrequest($uri, $authHeader);
		   
		    $xmlObj = simplexml_load_string($strResponse);

		   	return $xmlObj;

		} catch (Exception $e) {
		    return "";
		}
	}

}
