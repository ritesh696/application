<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Siteadmin extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_admin');
	}
	public function pagename($pagename)
	{
		if(isset($this->session->userdata['admin_logged_in']))
		{
			$admin_id = $this->session->userdata['admin_logged_in']['admin_id'];
			$pagename['user_detail'] = $this->m_admin->get_admin_detail_byAid($admin_id);	
			$pagename['total_ads']	= $this->m_admin->get_total_ads();	
			$this->load->view('admin/'.$pagename['page_name'],$pagename);	
		}
		else
		{
			redirect(base_url('siteadmin'));
			//$this->index();
		}

		
	}
	public function index()
	{
		$this->load->view('admin/index');
	}
	public function home()
	{
		$this->pending_ads();
	}
	public function pending_ads()
	{
		$array['page_name'] = 'pending-ads';
		$array['pending_ads'] = $this->m_admin->get_pending_ads();

		$this->pagename($array);
	}
	public function deactive_ads()
	{
		$array['page_name'] = 'inactive-ads';
		$array['inactive_ads'] = $this->m_admin->get_inactive_ads();
		$this->pagename($array);
	}
	public function active_ads()
	{
		$array['page_name'] = 'active-ads';
		$array['active_ads'] = $this->m_admin->get_active_ads();
		$this->pagename($array);
	}
	public function deactiveted_ads()
	{
		$array['page_name'] = 'deactiveted-ads';
		$array['deactive_ads'] = $this->m_admin->get_deactive_ads();
		
		$this->pagename($array);
	}
	public function profile()
	{
		$array['page_name'] = 'my-profile';
		$this->pagename($array);
	}
	public function ad_detail($ad_url=0,$ad_id=0)
	{
		//$this->load->model('m_home');
		$array['page_name'] = 'product-details';
		//$this->m_admin->no_of_view_count($ad_id);
		$array['ad_detail'] = $this->m_admin->get_ad_detail_by_id($ad_id);
		$this->pagename($array);
	}
	public function logout()
    {
        $this->load->model('m_admin');
        $admin_id = $this->session->userdata['admin_logged_in']['admin_id'];     // pick form session 
        $admin_history_id = $this->session->userdata['admin_logged_in']['admin_history_id'] ; // pick form session 
        $result = $this->m_admin->update_admin_login_history($admin_id,$admin_history_id);
        $this->session->unset_userdata('admin_logged_in');
        redirect(base_url('Siteadmin'));
    }
}


?>