<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class : FendBaseController
 * Base Class to control over all the classes
 */
class FendBaseController extends CI_Controller
{
	protected $role = '';
	protected $vendorId = '';
	protected $name = '';
	protected $roleText = '';
	protected $global = array();
	protected $lastLogin = '';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('headerfooter_model');
	}

	/**
	 * Takes mixed data and optionally a status code, then creates the response
	 *
	 * @access public
	 * @param array|NULL $data
	 *        	Data to output to the user
	 *        	running the script; otherwise, exit
	 */
	public function response($data = NULL)
	{
		$this->output->set_status_header(200)->set_content_type('application/json', 'utf-8')->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))->_display();
		exit();
	}

	/**
	 * This function is used to load the set of views
	 */
	function loadThis()
	{
		$this->global['pageTitle'] = '被拒絕進入';

		$this->load->view('fend/fend_includes/header', $this->global);
		$this->load->view('access');
		$this->load->view('fend/fend_includes/footer');
	}

	/**
	 * This function used to load views
	 * @param {string} $viewName : This is view name
	 * @param {mixed} $headerInfo : This is array of header information
	 * @param {mixed} $pageInfo : This is array of page information
	 * @param {mixed} $footerInfo : This is array of footer information
	 * @return {null} $result : null
	 */
	function loadViews($viewName = "", $headerInfo = NULL, $pageInfo = NULL, $footerInfo = NULL)
	{
		$headerInfo['headerfooterInfo'] = $this->headerfooter_model->getHeaderFooterInfo();
		$footerInfo['headerfooterInfo'] = $this->headerfooter_model->getHeaderFooterInfo();

		$this->load->view('fend/fend_includes/header', $headerInfo);
		$this->load->view($viewName, $pageInfo);
		$this->load->view('fend/fend_includes/footer', $footerInfo);
	}

	/**
	 * This function used provide the pagination resources
	 * @param {string} $link : This is page link
	 * @param {number} $count : This is page count
	 * @param {number} $perPage : This is records per page limit
	 * @return {mixed} $result : This is array of records and pagination data
	 */
	function paginationCompress($link, $count, $perPage = 10, $segment = SEGMENT)
	{
		$this->load->library('pagination');

		$config['base_url'] = base_url() . $link;
		$config['total_rows'] = $count;
		$config['uri_segment'] = $segment;
		$config['per_page'] = $perPage;
		$config['num_links'] = 5;
		$config['full_tag_open'] = '<nav><ul class="pagination">';
		$config['full_tag_close'] = '</ul></nav>';
		$config['first_tag_open'] = '<li class="arrow">';
		$config['first_link'] = '第一頁';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = '上一頁';
		$config['prev_tag_open'] = '<li class="arrow">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '下一頁';
		$config['next_tag_open'] = '<li class="arrow">';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="arrow">';
		$config['last_link'] = '最後一頁';
		$config['last_tag_close'] = '</li>';

		$this->pagination->initialize($config);
		$page = $config['per_page'];
		$segment = $this->uri->segment($segment);
		// http://n.sfs.tw/content/index/10846

		return array(
			"page" => $page,
			"segment" => $segment
		);
	}
}
