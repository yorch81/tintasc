<?php
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\Entities\AccessToken;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\HttpClients\FacebookHttpable;

class MyFaceBook
{
	private $_loginUrl = "";

	public function __construct()
	{
		// Check Sessions
		if (session_status() == PHP_SESSION_NONE) {
		    session_start();
		}

		FacebookSession::setDefaultApplication(  );
	}

	public function validate()
	{
		if (isset($_SESSION['FBID']) || isset($_SESSION['TWID']))
			return true;
		else
			return false;
	}


	public function checkSession()
	{
		$retValue = false;

		$helper = new FacebookRedirectLoginHelper('http://tintasc.localhost/fb' );

        try {
            $session = $helper->getSessionFromRedirect();
        } catch( FacebookRequestException $ex ) {
          // When Facebook returns an error
        } catch( Exception $ex ) {
          // When validation fails or other local issues
        }

        if (isset($session)){
            $request = new FacebookRequest( $session, 'GET', '/me?fields=id,name,link' );
            $response = $request->execute();
            $graphObject = $response->getGraphObject();

            $fbid = $graphObject->getProperty('id');             
            $fbfullname = $graphObject->getProperty('name'); 
            $femail = $graphObject->getProperty('link'); 
            
            $_SESSION['FBID'] = $fbid;           
            $_SESSION['FULLNAME'] = $fbfullname;
            $_SESSION['EMAIL'] =  $femail;

            $retValue = true;
        } 
        else {
        	$this->_loginUrl = $helper->getLoginUrl();
        }

		return $retValue;
	}

	public function getLoginUrl()
	{
		return $this->_loginUrl;
	}
}
?>