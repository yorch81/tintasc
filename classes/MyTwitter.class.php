<?php
require_once('config.php');

class MyTwitter
{
	private $_loginUrl = "";

	public function __construct()
	{
		// Check Sessions
		if (session_status() == PHP_SESSION_NONE) {
		    session_start();
		}
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

		if(isset($_REQUEST['oauth_token']) && $_SESSION['token'] == $_REQUEST['oauth_token']) {
            $connection = new \TwitterOAuth\Api(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['token'] , $_SESSION['token_secret']);
            $access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);

            if($connection->http_code=='200')
            {
                $_SESSION['status'] = 'verified';
                $_SESSION['request_vars'] = $access_token;
                
                $screenname = $_SESSION['request_vars']['screen_name'];
                $twitterid  = $_SESSION['request_vars']['user_id'];

                $_SESSION['TWID'] = $twitterid;           
                $_SESSION['SCREENNAME'] = $screenname;                
                $_SESSION['EMAIL'] =  'https://twitter.com/intent/user?user_id='. $twitterid;

                unset($_SESSION['token']);
                unset($_SESSION['token_secret']);
                
                $retValue = true;
            }
            else{
                die("error, try again later!");
            }
        }
        else{
            /*if(isset($_GET["denied"])){
                $app->redirect('/');
                die();
            }*/

            $connection = new \TwitterOAuth\Api(CONSUMER_KEY, CONSUMER_SECRET);
            $request_token = $connection->getRequestToken(OAUTH_CALLBACK);

            $_SESSION['token']          = $request_token['oauth_token'];
            $_SESSION['token_secret']   = $request_token['oauth_token_secret'];
            
            if($connection->http_code=='200'){
                $this->_loginUrl = $connection->getAuthorizeURL($request_token['oauth_token']);
            }
            else{
                die("error connecting to twitter! try again later!");
            }
        }

		return $retValue;
	}

	public function getLoginUrl()
	{
		return $this->_loginUrl;
	}
}
?>