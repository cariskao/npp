<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class News extends BaseController
{
	/**
	 * This is default constructor of the class
	 */
	public function __construct()
	{
		parent::__construct();
		// $this->load->library('session');
		$this->load->model('news_model');
		$this->isLoggedIn();
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

	// 最新新聞
	function index()
	{
		$searchText = $this->security->xss_clean($this->input->post('searchText'));
		$data['searchText'] = $searchText;

		$this->load->library('pagination');

		$count = $this->news_model->userListingCount($searchText); //算出總筆數
		// echo ' count: ' . $count;

		$returns = $this->paginationCompress("news/index/", $count, 10, 3);
		// echo ' segment-News: ' . $returns['segment'];

		$data['newsRecords'] = $this->news_model->userListing($searchText, $returns["page"], $returns["segment"]);

		$this->global['pageTitle'] = '最新新聞管理';

		$this->loadViews("news", $this->global, $data, NULL);
	}

	//  訊息公告
	function message()
	{
		$searchText = $this->security->xss_clean($this->input->post('searchText'));
		$data['searchText'] = $searchText;

		$this->load->library('pagination');

		$count = $this->news_model->messageListingCount($searchText);

		$returns = $this->paginationCompress("news/message/", $count, 10, 3);

		$data['userRecords'] = $this->news_model->messageListing($searchText, $returns["page"], $returns["segment"]);

		$this->global['pageTitle'] = '訊息公告管理';

		$this->loadViews("message", $this->global, $data, NULL);
	}

	// 活動記錄
	function records()
	{
		$searchText = $this->security->xss_clean($this->input->post('searchText'));
		$data['searchText'] = $searchText;

		$this->load->library('pagination');

		$count = $this->news_model->recordsListingCount($searchText);
		$returns = $this->paginationCompress("news/records/", $count, 10, 3); //記得records右方加上「/」

		// echo ' page: ' . $returns['page'];
		// echo ' segment: ' . $returns['segment'];

		$data['Records'] = $this->news_model->recordsListing($searchText, $returns["page"], $returns["segment"]);

		$this->global['pageTitle'] = '活動記錄管理';

		$this->loadViews("records", $this->global, $data, NULL);
	}

	// 標籤
	function tagLists()
	{
		$searchText = $this->security->xss_clean($this->input->post('searchText'));
		$data['searchText'] = $searchText;

		$this->load->library('pagination');
		$count = $this->news_model->tagsListingCount($searchText); //算出總筆數

		$returns = $this->paginationCompress("news/tagLists/", $count, 10, 3);

		$data['newsTags'] = $this->news_model->tagsListing($searchText, $returns["page"], $returns["segment"]);
		$this->global['pageTitle'] = '標籤管理';

		$this->loadViews("tagLists", $this->global, $data, NULL);
	}

	/*
.########.########..####.########.........##....##.########.##......##..######.
.##.......##.....##..##.....##............###...##.##.......##..##..##.##....##
.##.......##.....##..##.....##............####..##.##.......##..##..##.##......
.######...##.....##..##.....##....#######.##.##.##.######...##..##..##..######.
.##.......##.....##..##.....##............##..####.##.......##..##..##.......##
.##.......##.....##..##.....##............##...###.##.......##..##..##.##....##
.########.########..####....##............##....##.########..###..###...######.
*/

	/**
	 * This function is used load user edit information
	 * @param number $userId : Optional : This is user id
	 */
	// news edit enter
	function newsOld($userId = NULL)
	{
		if ($userId == null) {
			redirect('news');
		}

		// $data['roles'] = $this->news_model->getUserRoles();
		$data = array(
			'userInfo' => $this->news_model->getPressReleaseInfo($userId),
			'getTagsList' => $this->news_model->getTagsList(),
			// 'error' => '',
		);
		$this->global['pageTitle'] = '編輯最新新聞資料';

		$this->loadViews("newsOld", $this->global, $data, NULL);
	}

	// news edit send
	function editUser()
	{
		$newsId = $this->input->post('prid');

		$this->form_validation->set_rules('m_title', '大標', 'trim|required|max_length[128]|callback_mainTitleCheck[1,2,' . $newsId . ']');
		$this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
		$this->form_validation->set_rules('file', '圖片', 'callback_imgNameCheck[1,2]');
		$this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('check', '驗證失敗');
			$this->newsOld($newsId);
		} else {
			$m_title = $this->security->xss_clean($this->input->post('m_title'));
			$s_title = $this->security->xss_clean($this->input->post('s_title'));
			$date_start = $this->security->xss_clean($this->input->post('date_start'));
			$time_start = $this->security->xss_clean($this->input->post('time_start'));
			$editor = $this->input->post('editor1');
			$showStatusCheck = $this->input->post('happy');

			// File upload configuration
			// $uploadPath = dirname(dirname(__DIR__)) . '/assets/uploads/news_upload/news/';
			$uploadPath = 'assets/uploads/news_upload/news/';
			$config['upload_path'] = $uploadPath;
			$config['allowed_types'] = 'jpg|jpeg|png|gif|svg';
			// $config['max_size'] = 1024;

			// Load and initialize upload library
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			// Upload file to server
			if ($this->upload->do_upload('file')) {
				$fileData = $this->upload->data();
				$uploadData = $fileData['file_name'];
			}

			$userInfo = array(
				'main_title' => $m_title,
				'sub_title' => $s_title,
				'date_start' => $date_start,
				'time_start' => $time_start,
				'editor' => $editor,
			);

			if ($showStatusCheck != null || $showStatusCheck != '' || !empty($showStatusCheck)) {
				$showStatus = $showStatusCheck == 'Y' ? 1 : 0;
				$userInfo['showup'] = $showStatus;
			}

			// 當有選擇圖片時
			if (!empty($uploadData)) {
				// 就上傳新圖片並馬上刪除舊圖片
				$imgDelete = $this->news_model->imgNameRepeatDel($newsId);
				$imgDelName = $imgDelete->img;
				unlink(dirname(dirname(__DIR__)) . '/assets/uploads/news_upload/news/' . $imgDelName);
				// https://blog.longwin.com.tw/2009/01/php-get-directory-file-path-dirname-2008/
				// https://www.awaimai.com/408.html
				/*
            echo ' 2 層dirname: ' . dirname(dirname(__FILE__)) . '<br>';
            echo ' 1 層dirname: ' . dirname(__FILE__) . '<br>';
            echo ' FILE: ' . __FILE__ . '<br>';
            echo ' DIR: ' . __DIR__ . '<br>';
            echo ' 1 層dirname + DIR: ' . dirname(__DIR__);*/

				// 再把欄位的資料寫入資料庫
				$userInfo['img'] = $uploadData;
			}

			$result = $this->news_model->pressReleaseUpdate($userInfo, $newsId);

			if ($result) {
				$this->session->set_flashdata('success', '儲存成功!');
				$this->session->set_flashdata('check', '驗證成功');
			} else {
				$this->session->set_flashdata('error', '儲存失敗!');
			}

			$this->newsOld($newsId);
			// redirect('news/newsOld');
		}
	}

	/*
.########.########..####.########.........##.....##.########..######...######.....###.....######...########
.##.......##.....##..##.....##............###...###.##.......##....##.##....##...##.##...##....##..##......
.##.......##.....##..##.....##............####.####.##.......##.......##........##...##..##........##......
.######...##.....##..##.....##....#######.##.###.##.######....######...######..##.....##.##...####.######..
.##.......##.....##..##.....##............##.....##.##.............##.......##.#########.##....##..##......
.##.......##.....##..##.....##............##.....##.##.......##....##.##....##.##.....##.##....##..##......
.########.########..####....##............##.....##.########..######...######..##.....##..######...########
*/

	// edit message enter
	function messageOld($userId = NULL)
	{
		if ($userId == null) {
			redirect('news/message');
		}

		// $data['roles'] = $this->news_model->getUserRoles();
		$data = array(
			'userInfo' => $this->news_model->getPressReleaseInfo($userId),
			'getTagsList' => $this->news_model->getTagsList(),
		);

		$this->global['pageTitle'] = '編輯訊息公告資料';

		$this->loadViews("messageOld", $this->global, $data, NULL);
	}

	// edit message send
	function editMessage()
	{
		$newsId = $this->input->post('prid');

		$this->form_validation->set_rules('m_title', '大標', 'trim|required|max_length[128]|callback_mainTitleCheck[2,2,' . $newsId . ']');
		$this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
		$this->form_validation->set_rules('file', '圖片', 'callback_imgNameCheck[2,2]');
		$this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('check', '驗證失敗');
			$this->messageOld($newsId);
		} else {
			$m_title = $this->security->xss_clean($this->input->post('m_title'));
			$s_title = $this->security->xss_clean($this->input->post('s_title'));
			$date_start = $this->security->xss_clean($this->input->post('date_start'));
			$time_start = $this->security->xss_clean($this->input->post('time_start'));
			$editor = $this->input->post('editor1');
			$showStatusCheck = $this->input->post('happy');

			$showStatus = $showStatusCheck == 'Y' ? 1 : 0;
			// File upload configuration
			// $uploadPath = dirname(dirname(__DIR__)) . '/assets/uploads/news_upload/message/';
			$uploadPath = 'assets/uploads/news_upload/message/';
			$config['upload_path'] = $uploadPath;
			$config['allowed_types'] = 'jpg|jpeg|png|gif|svg';
			// $config['max_size'] = 1024;

			// Load and initialize upload library
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			// Upload file to server
			if ($this->upload->do_upload('file')) {
				$fileData = $this->upload->data();
				$uploadData = $fileData['file_name'];
			}

			$userInfo = array(
				'main_title' => $m_title,
				'sub_title' => $s_title,
				'date_start' => $date_start,
				'time_start' => $time_start,
				'editor' => $editor,
			);

			if ($showStatusCheck != null || $showStatusCheck != '' || !empty($showStatusCheck)) {
				$showStatus = $showStatusCheck == 'Y' ? 1 : 0;
				$userInfo['showup'] = $showStatus;
			}

			// 當有選擇圖片時
			if (!empty($uploadData)) {
				// 就上傳新圖片並馬上刪除舊圖片
				$imgDelete = $this->news_model->imgNameRepeatDel($newsId);
				$imgDelName = $imgDelete->img;
				unlink(dirname(dirname(__DIR__)) . '/assets/uploads/news_upload/message/' . $imgDelName);
				// https://blog.longwin.com.tw/2009/01/php-get-directory-file-path-dirname-2008/
				// https://www.awaimai.com/408.html

				// 再把欄位的資料寫入資料庫
				$userInfo['img'] = $uploadData;
			}

			$result = $this->news_model->pressReleaseUpdate($userInfo, $newsId);

			if ($result == true) {
				$this->session->set_flashdata('success', '儲存成功!');
				$this->session->set_flashdata('check', '驗證成功');
			} else {
				$this->session->set_flashdata('error', '儲存失敗!');
			}
			$this->messageOld($newsId);
			// redirect('news/newsOld');
		}
	}

	/*
.########.########..####.########.........########..########..######...#######..########..########...######.
.##.......##.....##..##.....##............##.....##.##.......##....##.##.....##.##.....##.##.....##.##....##
.##.......##.....##..##.....##............##.....##.##.......##.......##.....##.##.....##.##.....##.##......
.######...##.....##..##.....##....#######.########..######...##.......##.....##.########..##.....##..######.
.##.......##.....##..##.....##............##...##...##.......##.......##.....##.##...##...##.....##.......##
.##.......##.....##..##.....##............##....##..##.......##....##.##.....##.##....##..##.....##.##....##
.########.########..####....##............##.....##.########..######...#######..##.....##.########...######.
*/

	// edit records enter
	function recordsOld($userId = NULL)
	{
		if ($userId == null) {
			redirect('news/records');
		}

		// $data['roles'] = $this->news_model->getUserRoles();
		$data = array(
			'userInfo' => $this->news_model->getPressReleaseInfo($userId),
			'getTagsList' => $this->news_model->getTagsList(),
		);

		$this->global['pageTitle'] = '編輯活動記錄資料';

		$this->loadViews("recordsOld", $this->global, $data, NULL);
	}

	// edit records send
	function editRecords()
	{
		$newsId = $this->input->post('prid');

		$this->form_validation->set_rules('m_title', '大標', 'trim|required|max_length[128]|callback_mainTitleCheck[3,2,' . $newsId . ']');
		$this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
		$this->form_validation->set_rules('file', '圖片', 'callback_imgNameCheck[3,2]');
		$this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('check', '驗證失敗');
			$this->recordsOld($newsId);
		} else {
			$m_title = $this->security->xss_clean($this->input->post('m_title'));
			$s_title = $this->security->xss_clean($this->input->post('s_title'));
			$date_start = $this->security->xss_clean($this->input->post('date_start'));
			$time_start = $this->security->xss_clean($this->input->post('time_start'));
			$editor = $this->input->post('editor1');
			$showStatusCheck = $this->input->post('happy');

			$showStatus = $showStatusCheck == 'Y' ? 1 : 0;
			// File upload configuration
			// $uploadPath = dirname(dirname(__DIR__)) . '/assets/uploads/news_upload/records/';
			$uploadPath = 'assets/uploads/news_upload/records/';
			$config['upload_path'] = $uploadPath;
			$config['allowed_types'] = 'jpg|jpeg|png|gif|svg';
			// $config['max_size'] = 1024;

			// Load and initialize upload library
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			// Upload file to server
			if ($this->upload->do_upload('file')) {
				$fileData = $this->upload->data();
				$uploadData = $fileData['file_name'];
			}

			$userInfo = array(
				'main_title' => $m_title,
				'sub_title' => $s_title,
				'date_start' => $date_start,
				'time_start' => $time_start,
				'editor' => $editor,
			);

			if ($showStatusCheck != null || $showStatusCheck != '' || !empty($showStatusCheck)) {
				$showStatus = $showStatusCheck == 'Y' ? 1 : 0;
				$userInfo['showup'] = $showStatus;
			}

			// 當有選擇圖片時
			if (!empty($uploadData)) {
				// 就上傳新圖片並馬上刪除舊圖片
				$imgDelete = $this->news_model->imgNameRepeatDel($newsId);
				$imgDelName = $imgDelete->img;
				unlink(dirname(dirname(__DIR__)) . '/assets/uploads/news_upload/records/' . $imgDelName);
				// https://blog.longwin.com.tw/2009/01/php-get-directory-file-path-dirname-2008/
				// https://www.awaimai.com/408.html

				// 再把欄位的資料寫入資料庫
				$userInfo['img'] = $uploadData;
			}
			$result = $this->news_model->pressReleaseUpdate($userInfo, $newsId);

			if ($result == true) {
				$this->session->set_flashdata('success', '儲存成功!');
				$this->session->set_flashdata('check', '驗證成功');
			} else {
				$this->session->set_flashdata('error', '儲存失敗!');
			}
			$this->recordsOld($newsId);
			// redirect('news/newsOld');
		}
	}

	/*
######## ########  #### ########         ########    ###     ######    ######
##       ##     ##  ##     ##               ##      ## ##   ##    ##  ##    ##
##       ##     ##  ##     ##               ##     ##   ##  ##        ##
######   ##     ##  ##     ##    #######    ##    ##     ## ##   ####  ######
##       ##     ##  ##     ##               ##    ######### ##    ##        ##
##       ##     ##  ##     ##               ##    ##     ## ##    ##  ##    ##
######## ########  ####    ##               ##    ##     ##  ######    ######
*/

	function tagsEdit($id)
	{
		$this->global['pageTitle'] = '編輯標籤';

		$data['getTagsEditInfo'] = $this->news_model->getTagsEditInfo($id);

		$this->loadViews("tagsEdit", $this->global, $data, NULL);
	}

	function tagsEditSend()
	{
		$id = $this->input->post('tagsid');

		$this->form_validation->set_rules('title', '名稱', 'trim|required|max_length[128]|callback_tags_check[' . $id . ']');
		$this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');

		if ($this->form_validation->run() == FALSE) {
			$this->tagsEdit($id);
		} else {
			$name = $this->security->xss_clean($this->input->post('title'));
			$showStatusCheck = $this->input->post('happy');

			$userInfo = array(
				'name' => $name,
			);

			if ($showStatusCheck != null || $showStatusCheck != '' || !empty($showStatusCheck)) {

				$showStatus = $showStatusCheck == 'Y' ? 1 : 0;
				$userInfo['showup'] = $showStatus;
			}

			$result = $this->news_model->tagsEditSend($userInfo, $id);

			if ($result > 0) {
				$this->session->set_flashdata('success', '新增成功!');
			} else {
				$this->session->set_flashdata('error', '新增失敗!');
			}

			redirect('news/tagLists');
		}
	}

	/*
   ###    ########  ########
  ## ##   ##     ## ##     ##
 ##   ##  ##     ## ##     ##
##     ## ##     ## ##     ##
######### ##     ## ##     ##
##     ## ##     ## ##     ##
##     ## ########  ########
*/

	/**
	 * This function is used to load the add new form
	 * 在這個檔案中只有最新新聞才有使用到addNew()，其它訊息公告跟活動記錄沒有經過addNew()
	 */
	function addNew()
	{
		$data['getTagsList'] = $this->news_model->getTagsList();

		$this->global['pageTitle'] = '新增最新新聞資料';

		$this->loadViews("addPressReleaseNews", $this->global, $data, NULL);
	}

	/**
	 * This function is used to add new user to the system
	 */
	function addNewUser()
	{
		$this->form_validation->set_rules('m_title', '大標', 'trim|required|max_length[128]|callback_mainTitleCheck[1,1,""]');
		$this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
		$this->form_validation->set_rules('file', '圖片', 'callback_imgNameCheck[1,1]');
		$this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('check', '驗證失敗');
			$this->addNew();
		} else {
			$m_title = $this->security->xss_clean($this->input->post('m_title'));
			$s_title = $this->security->xss_clean($this->input->post('s_title'));
			$date_start = $this->security->xss_clean($this->input->post('date_start'));
			$editor = $this->input->post('editor1');
			$showStatusCheck = $this->input->post('happy');

			$showStatus = $showStatusCheck != 'N' ? 1 : 0;

			// File upload configuration
			// $uploadPath = dirname(dirname(__DIR__)) . '/assets/uploads/news_upload/news/';
			$uploadPath = 'assets/uploads/news_upload/news/';
			$config['upload_path'] = $uploadPath;
			$config['allowed_types'] = 'jpg|jpeg|png|gif|svg';
			// $config['max_size'] = 1024;

			// Load and initialize upload library
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			// Upload file to server
			if ($this->upload->do_upload('file')) {
				// Uploaded file data
				$uploadData = $this->upload->data();
				$uploadedFile = $uploadData['file_name'];

				// Insert files data into the database
				$userInfo = array(
					'pr_type_id' => 1,
					'showup' => $showStatus,
					'img' => $uploadedFile,
					'main_title' => $m_title,
					'sub_title' => $s_title,
					'date_start' => $date_start,
					'editor' => $editor,
				);

				$result = $this->news_model->pressReleaseAdd($userInfo);

				if ($result > 0) {
					$this->session->set_flashdata('success', '新增成功!');
				} else {
					$this->session->set_flashdata('error', '新增失敗!');
				}
				// $data['success_msg'] = '圖片上傳成功';
			} else {
				$data['error_msg'] = $this->upload->display_errors();
			}

			redirect('news/addNew');
		}
	}

	function addMessage()
	{
		$this->global['pageTitle'] = '新增訊息公告資料';
		$data['getTagsList'] = $this->news_model->getTagsList();

		$this->loadViews("addPressReleaseMessage", $this->global, $data, NULL);
	}

	function addNewMessage()
	{
		$this->form_validation->set_rules('m_title', '大標', 'trim|required|max_length[128]|callback_mainTitleCheck[2,1,""]');
		$this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
		$this->form_validation->set_rules('file', '圖片', 'callback_imgNameCheck[2,1]');
		$this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('check', '驗證失敗');
			$this->addMessage();
		} else {
			$m_title = $this->security->xss_clean($this->input->post('m_title'));
			$s_title = $this->security->xss_clean($this->input->post('s_title'));
			$date_start = $this->security->xss_clean($this->input->post('date_start'));
			$editor = $this->input->post('editor1');
			$showStatusCheck = $this->input->post('happy');

			$showStatus = $showStatusCheck != 'N' ? 1 : 0;

			// // File upload configuration
			// $uploadPath = dirname(dirname(__DIR__)) . '/assets/uploads/news_upload/message/';
			$uploadPath = 'assets/uploads/news_upload/message/';
			$config['upload_path'] = $uploadPath;
			$config['allowed_types'] = 'jpg|jpeg|png|gif|svg';
			// $config['max_size'] = 1024;

			// Load and initialize upload library
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			// Upload file to server
			if ($this->upload->do_upload('file')) {
				// Uploaded file data
				$uploadData = $this->upload->data();
				$uploadedFile = $uploadData['file_name'];

				// Insert files data
				$userInfo = array(
					'pr_type_id' => 2,
					'showup' => $showStatus,
					'img' => $uploadedFile,
					'main_title' => $m_title,
					'sub_title' => $s_title,
					'date_start' => $date_start,
					'editor' => $editor,
				);

				$result = $this->news_model->pressReleaseAdd($userInfo);

				if ($result > 0) {
					$this->session->set_flashdata('success', '新增成功!');
				} else {
					$this->session->set_flashdata('error', '新增失敗!');
				}
			} else {
				$data['error_msg'] = $this->upload->display_errors();
			}

			redirect('news/addMessage');
		}
	}

	function addRecords()
	{
		$this->global['pageTitle'] = '新增活動記錄資料';
		$data['getTagsList'] = $this->news_model->getTagsList();

		$this->loadViews("addPressReleaseRecords", $this->global, $data, NULL);
	}

	function addNewRecords()
	{
		$this->form_validation->set_rules('m_title', '大標', 'trim|required|max_length[128]|callback_mainTitleCheck[3,1,""]');
		$this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
		$this->form_validation->set_rules('file', '圖片', 'callback_imgNameCheck[3,1]');
		$this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('check', '驗證失敗');
			// redirect('news/addNewRecords');
			$this->addMessage();
		} else {
			$m_title = $this->security->xss_clean($this->input->post('m_title'));
			$s_title = $this->security->xss_clean($this->input->post('s_title'));
			$date_start = $this->security->xss_clean($this->input->post('date_start'));
			$editor = $this->input->post('editor1');
			$showStatusCheck = $this->input->post('happy');

			$showStatus = $showStatusCheck != 'N' ? 1 : 0;

			// // File upload configuration
			// $uploadPath = dirname(dirname(__DIR__)) . '/assets/uploads/news_upload/records/';
			$uploadPath = 'assets/uploads/news_upload/records/';
			$config['upload_path'] = $uploadPath;
			$config['allowed_types'] = 'jpg|jpeg|png|gif|svg';
			// $config['max_size'] = 1024;

			// Load and initialize upload library
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			// Upload file to server
			if ($this->upload->do_upload('file')) {
				// Uploaded file data
				$uploadData = $this->upload->data();
				$uploadedFile = $uploadData['file_name'];

				// Insert files data
				$userInfo = array(
					'pr_type_id' => 3,
					'showup' => $showStatus,
					'img' => $uploadedFile,
					'main_title' => $m_title,
					'sub_title' => $s_title,
					'date_start' => $date_start,
					'editor' => $editor,
				);

				$result = $this->news_model->pressReleaseAdd($userInfo);

				if ($result > 0) {
					$this->session->set_flashdata('success', '新增成功!');
				} else {
					$this->session->set_flashdata('error', '新增失敗!');
				}
			} else {
				$data['error_msg'] = $this->upload->display_errors();
			}
			redirect('news/addRecords');
		}
	}

	// 標籤
	function tagsAdd()
	{
		$this->global['pageTitle'] = '新增標籤';

		$this->loadViews("tagsAdd", $this->global, NULL);
	}

	function tagsAddSend()
	{
		$this->form_validation->set_rules('title', '名稱', 'trim|required|max_length[128]|callback_tags_check');
		$this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');

		if ($this->form_validation->run() == FALSE) {
			$this->tagsAdd();
		} else {
			$name = $this->security->xss_clean($this->input->post('title'));
			$showStatusCheck = $this->input->post('happy');

			$showStatus = $showStatusCheck != 'N' ? 1 : 0;

			$userInfo = array(
				'name' => $name,
				'showup' => $showStatus
			);

			$result = $this->news_model->tagsAddSend($userInfo);

			if ($result > 0) {
				$this->session->set_flashdata('success', '新增成功!');
			} else {
				$this->session->set_flashdata('error', '新增失敗!');
			}

			redirect('news/tagLists');
		}
	}

	/*
 ######  ##     ## ########  ######  ##    ##
##    ## ##     ## ##       ##    ## ##   ##
##       ##     ## ##       ##       ##  ##
##       ######### ######   ##       #####
##       ##     ## ##       ##       ##  ##
##    ## ##     ## ##       ##    ## ##   ##
 ######  ##     ## ########  ######  ##    ##
*/

	function imgNameCheck($str, $param)
	{
		$param = preg_split('/,/', $param);
		$type = $param[0]; // 1.最新新聞 2.訊息公告 3.活動記錄
		$mode = $param[1]; // 1.add 2.edit
		// $pr_id = $param[2]; // edit所需pr_id
		// echo $str . '<br>' . $type . '<br>' . $mode . '<br>' . $pr_id;
		$imgName = $_FILES['file']['name']; //圖片好像不能直接用$str來做

		// 若爲新增功能又沒有選擇圖片或圖片名稱爲空就報錯後離開
		if ($mode == 1) {
			if (!isset($imgName) || $imgName == '') {
				$this->form_validation->set_message('imgNameCheck', '請選擇要上傳的圖片');
				$this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
				return false;
			}
		}

		// 如果圖片檔名有空白字元就報錯後離開
		// \s: 任何空白字元(空白,換行,tab)。\S: 任何非空白字元(空白,換行,tab)。
		$pattern = "/\s/";
		if (preg_match($pattern, $imgName)) {
			// echo 'match';
			$this->form_validation->set_message('imgNameCheck', '圖片名稱不可有空白字元');
			$this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
			return false;
		}

		$nameRepeat = $this->news_model->imgNameCheck($imgName, $type);

		if ($nameRepeat > 0) {
			$this->form_validation->set_message('imgNameCheck', '已有同名的圖片名稱：「' . $imgName . '」!');
			$this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
			return false;
		} else {

			if (!($mode == 2 && $imgName == '')) {

				$allowed_mime_type_arr = array('image/gif', 'image/jpeg', 'image/png', 'image/x-png', 'image/svg+xml');
				$mime = get_mime_by_extension($imgName);

				// 若圖片名稱沒有重複就檢查圖片格式是否正確。
				// in_array() 函数搜索数组中是否存在指定的值。
				if (in_array($mime, $allowed_mime_type_arr)) {
					return true;
				} else {
					$this->form_validation->set_message('imgNameCheck', '圖片格式不正確!<br>請選擇gif/jpg/jpeg/png/svg');
					$this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
					return false;
				}
			}
		}
	}

	function mainTitleCheck($str, $param)
	{
		$param = preg_split('/,/', $param);
		$type = $param[0]; // 1.最新新聞 2.訊息公告 3.活動記錄
		$mode = $param[1]; // 1.add 2.edit
		$pr_id = $param[2]; // edit所需pr_id
		// echo $str . '<br>' . $type . '<br>' . $mode . '<br>' . $pr_id;

		$nameRepeat = $this->news_model->mainTitleCheck($str, $type, $mode, $pr_id);

		if ($nameRepeat > 0) {
			$this->form_validation->set_message('mainTitleCheck', '已有相同標題名稱：「' . $str . '」!');
			$this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
			return false;
		} else {
			return true;
		}
	}

	function tags_check($str, $id = '')
	{
		$name = $this->security->xss_clean($this->input->post('title'));
		$nameRepeat = $this->news_model->tagsCheck($name, $id);

		if ($nameRepeat > 0) {
			$this->form_validation->set_message('tags_check', '已有同名的標籤名稱：「' . $str . '」!');
			$this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
			return false;
		} else {
			return true;
		}
	}

	/*
########  ######## ##       ######## ######## ########
##     ## ##       ##       ##          ##    ##
##     ## ##       ##       ##          ##    ##
##     ## ######   ##       ######      ##    ######
##     ## ##       ##       ##          ##    ##
##     ## ##       ##       ##          ##    ##
########  ######## ######## ########    ##    ########
*/
	/**
	 * This function is used to delete the user using userId
	 * @return boolean $result : TRUE / FALSE
	 * 刪除 新聞訊息裡項目的列表
	 */
	function deleteList()
	{
		//這裏的post('pr_id')是common.js的jQuery.ajax.data
		$pr_id = $this->input->post('pr_id');
		$type_id = $this->input->post('type_id');
		$img = $this->input->post('img');

		switch ($type_id) {
			case 1:
				unlink(dirname(dirname(__DIR__)) . '/assets/uploads/news_upload/news/' . $img);
				break;
			case 2:
				unlink(dirname(dirname(__DIR__)) . '/assets/uploads/news_upload/message/' . $img);
				break;
			case 3:
				unlink(dirname(dirname(__DIR__)) . '/assets/uploads/news_upload/records/' . $img);
				break;

			default:
				break;
		}

		// $userInfo = array('isDeleted' => 1, 'updatedBy' => $this->vendorId, 'updatedDtm' => date('Y-m-d H:i:s'));
		$result = $this->news_model->deleteList($pr_id); //刪除資料庫數據

		if ($result > 1) {
			echo (json_encode(array('status' => TRUE)));
		} else {
			echo (json_encode(array('status' => FALSE)));
		}
	}

	// 刪除標籤列表
	function deleteNewsTag()
	{
		$id = $this->input->post('tagsid');
		$result = $this->news_model->deleteNewsTag($id);

		if ($result > 0) {
			echo (json_encode(array('status' => TRUE)));
		} else {
			echo (json_encode(array('status' => FALSE)));
		}
	}
}
