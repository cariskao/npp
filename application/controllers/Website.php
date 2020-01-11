<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Website extends BaseController
{
	/**
	 * This is default constructor of the class
	 */
	public function __construct()
	{
		parent::__construct();
		// $this->load->library('session');
		$this->load->model('website_model');
		$this->isLoggedIn();
		$this->global['pageTitle'] = '時代力量後台管理';
	}

	/**
	 * Page not found : error 404
	 */
	function pageNotFound()
	{
		$this->global['pageTitle'] = 'CodeInsect : 404 - Page Not Found';

		$this->loadViews("404", $this->global, NULL, NULL);
	}

	/*
##       ####  ######  ########
##        ##  ##    ##    ##
##        ##  ##          ##
##        ##   ######     ##
##        ##        ##    ##
##        ##  ##    ##    ##
######## ####  ######     ##
*/

	// 輪播列表
	function carouselLists()
	{
		$searchText = $this->security->xss_clean($this->input->post('searchText'));
		$data['searchText'] = $searchText;

		$this->load->library('pagination');
		$count = $this->website_model->carouselListCount($searchText); //算出總筆數

		$returns = $this->paginationCompress("website/carouselList/", $count, 10, 3);

		$data['getCarouselList'] = $this->website_model->carouselListing($searchText, $returns["page"], $returns["segment"]);

		$this->loadViews("carouselLists", $this->global, $data, NULL);
	}

	/*
######## ########  #### ########
##       ##     ##  ##     ##
##       ##     ##  ##     ##
######   ##     ##  ##     ##
##       ##     ##  ##     ##
##       ##     ##  ##     ##
######## ########  ####    ##
*/

	// 其它設定
	function setup($check = false)
	{
		if ($check) {
			$this->session->set_flashdata('check', '驗證失敗');
		}
		// $this->global['pageTitle'] = '編輯標籤';
		$data['getSetupInfo'] = $this->website_model->getSetupInfo();
		$this->loadViews("website_setup", $this->global, $data, NULL);
	}

	function setupSend()
	{
		$this->form_validation->set_rules('mail', 'Email', 'trim|required|valid_email|max_length[128]');
		$this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');


		if ($this->form_validation->run() == FALSE) {
			$this->setup();
		} else {
			$mail = $this->security->xss_clean($this->input->post('mail'));
			$fb = $this->security->xss_clean($this->input->post('fb'));
			$address = $this->security->xss_clean($this->input->post('address'));
			$num = $this->security->xss_clean($this->input->post('num'));
			$fax = $this->security->xss_clean($this->input->post('fax'));
			$servicetime = $this->security->xss_clean($this->input->post('servicetime'));

			$updateInfo = array(
				'mail' => $mail,
				'fb' => $fb,
				'address' => $address,
				'num' => $num,
				'fax' => $fax,
				'servicetime' => $servicetime,
			);

			$result = $this->website_model->setupUpdate($updateInfo);

			if ($result > 0) {
				$this->session->set_flashdata('success', '新增成功!');
				$this->session->set_flashdata('check', '驗證成功');
			} else {
				$this->session->set_flashdata('error', '新增失敗!');
			}

			$this->setup();
			// redirect('website/setup');
		}
	}

	// 輪播
	function carousel()
	{
		// if ($check) {
		// 	$this->session->set_flashdata('check', '驗證失敗');
		// }

		$data['getCarouselInfo'] = $this->website_model->getCarouselInfo();
		$this->loadViews("website_setup", $this->global, $data, NULL);
	}
}
