<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_user extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('coming-soon');
	}
	function glogin()
    {
            // Fill CLIENT ID, CLIENT SECRET ID, REDIRECT URI from Google Developer Console
        $client_id = '959813108016-l9t9u7e1kpool18ipm74q9uslqoqhv3r.apps.googleusercontent.com';
        $client_secret = 'XpLllVt6xc-YA57suYC2OQ3F';
        $redirect_uri = base_url('login/gcallback');;

        //Create Client Request to access Google API
        $client = new Google_Client();
        $client->setApplicationName("Yourappname");
        $client->setClientId($client_id);
        $client->setClientSecret($client_secret);
        $client->setRedirectUri($redirect_uri);
        $client->addScope("email");
        $client->addScope("profile");

        //Send Client Request
        $objOAuthService = new Google_Service_Oauth2($client);
        
        $authUrl = $client->createAuthUrl();
        
        header('Location: '.$authUrl);
    }

    function gcallback()
    {
            // Fill CLIENT ID, CLIENT SECRET ID, REDIRECT URI from Google Developer Console
     $client_id = '959813108016-l9t9u7e1kpool18ipm74q9uslqoqhv3r.apps.googleusercontent.com';
        $client_secret = 'XpLllVt6xc-YA57suYC2OQ3F';
        $redirect_uri = base_url('login/gcallback');;

    //Create Client Request to access Google API
    $client = new Google_Client();
    $client->setApplicationName("Yourappname");
    $client->setClientId($client_id);
    $client->setClientSecret($client_secret);
    $client->setRedirectUri($redirect_uri);
    $client->addScope("email");
    $client->addScope("profile");

    //Send Client Request
    $service = new Google_Service_Oauth2($client);

    $client->authenticate($_GET['code']);
    $_SESSION['access_token'] = $client->getAccessToken();
    
    // User information retrieval starts..............................

    $user = $service->userinfo->get(); //get user info 

    echo "</br> User ID :".$user->id; 
    echo "</br> User Name :".$user->name;
    echo "</br> Gender :".$user->gender;
    echo "</br> User Email :".$user->email;
    echo "</br> User Link :".$user->link;    
    echo "</br><img src='$user->picture' height='200' width='200' > ";
       
    }

    
}
