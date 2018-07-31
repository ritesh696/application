<?php defined('BASEPATH') OR exit('No direct script access allowed');
class User_Authentication extends CI_Controller
{
    function __construct(){
        parent::__construct();
        
       $this->load->library('google');
        $this->load->library('session');
        
        //load user model
        $this->load->model('user');  
        //load google login library
       
    }
    
    public function index()
    {
      
        //redirect to profile page if user already logged in
        if($this->session->userdata('loggedIn') == true)
        {
            redirect('user_authentication/profile/');
        }
         $this->load->library('google');
        $this->load->library('session');
        
        //load user model
        $this->load->model('user');
        
        if(isset($_GET['code']))
        {
            //authenticate user
            $this->google->getAuthenticate();
            
            //get user info from google
            $gpInfo = $this->google->getUserInfo();
            
            //preparing data for database insertion
            $userData['oauth_provider'] = 'google';
            $userData['oauth_uid']      = $gpInfo['id'];
            $userData['first_name']     = $gpInfo['given_name'];
            $userData['last_name']      = $gpInfo['family_name'];
            $userData['email']          = $gpInfo['email'];
            $userData['gender']         = !empty($gpInfo['gender'])?$gpInfo['gender']:'';
            $userData['locale']         = !empty($gpInfo['locale'])?$gpInfo['locale']:'';
            $userData['profile_url']    = !empty($gpInfo['link'])?$gpInfo['link']:'';
            $userData['picture_url']    = !empty($gpInfo['picture'])?$gpInfo['picture']:'';
            
            //insert or update user data to the database
            $userID = $this->user->checkUser($userData);
            
            //store status & user info in session
            $this->session->set_userdata('loggedIn', true);
            $this->session->set_userdata('userData', $userData);
            
            //redirect to profile page
            redirect('profile');
        } 
        
        //google login url
        $data['loginURL'] = $this->google->loginURL();
        
        //load google login view
        $this->load->view('index',$data);
    }
    
    public function profile(){
        //redirect to login page if user not logged in
        if(!$this->session->userdata('loggedIn')){
            redirect('/user_authentication/');
        }
        
        //get user info from session
        $data['userData'] = $this->session->userdata('userData');
        
        //load user profile view
        $this->load->view('profile',$data);
    }
    
    public function logout(){
        //delete login status & user info from session
        $this->session->unset_userdata('loggedIn');
        $this->session->unset_userdata('userData');
        $this->session->sess_destroy();
        
        //redirect to login page
        redirect('/user_authentication/');
    }
}