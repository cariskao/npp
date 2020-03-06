<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . '/libraries/BaseController.php';

class Members extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->library('ftp');
        // $this->load->library('session');
        $this->load->model('members_model');
        $this->isLoggedIn();
        $this->global['pageTitle'] = '時代力量後台管理';
    }

    public function pageNotFound()
    {
        $this->global['pageTitle'] = 'CodeInsect : 404 - Page Not Found';

        $this->loadViews("404", $this->global, null, null);
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

    // 黨員
    public function membersList()
    {
        // 參考 segment_helper.php
        // echo '<script>alert("' . uri_segment() . '")</script>';

        // $this->global['pageTitle'] = '最新新聞管理';
        $this->global['navTitle']  = '本黨立委 - 立委管理 - 列表';
        $this->global['navActive'] = base_url('members/membersList/');

        $searchText         = $this->security->xss_clean($this->input->post('searchText'));
        $data['searchText'] = $searchText;

        $count = $this->members_model->listingCount($searchText);
        // echo ' count: ' . $count;

        $returns = $this->paginationCompress('members/members/', $count, 10, 3); //記得加上「/」
        // echo ' segment-News: ' . $returns['segment'];

        $data['listItems'] = $this->members_model->listing($searchText, $returns['page'], $returns['segment']);

        $this->loadViews('membersList', $this->global, $data, null);
    }

    //  屆期
    public function yearLists()
    {
        $this->global['navTitle']  = '本黨立委 - 屆期管理 - 列表';
        $this->global['navActive'] = base_url('members/yearLists/');

        $searchText         = $this->security->xss_clean($this->input->post('searchText'));
        $data['searchText'] = $searchText;

        $count = $this->members_model->yearsListingCount($searchText); //算出總筆數

        $returns = $this->paginationCompress('members/yearLists/', $count, 10, 3);

        $data['yearLists'] = $this->members_model->yearsListing(false, $searchText, $returns["page"], $returns["segment"]);
        // $this->global['pageTitle'] = '標籤管理';

        $this->loadViews("yearLists", $this->global, $data, null);
    }

/*
....###....########..########.
...##.##...##.....##.##.....##
..##...##..##.....##.##.....##
.##.....##.##.....##.##.....##
.#########.##.....##.##.....##
.##.....##.##.....##.##.....##
.##.....##.########..########.
 */

    // members
    public function membersAdd()
    {
        // $this->global['pageTitle'] = '新增最新新聞資料';
        $data = array(
            'getYearsList'   => $this->members_model->getYearsList(),
            'getIssuesList'  => $this->members_model->getIssuesList(),
            'getContactList' => $this->members_model->getContactList(),
        );

        $this->global['navTitle']  = '本黨立委 - 立委管理 - 新增';
        $this->global['navActive'] = base_url('members/membersList/');

        $this->loadViews("membersAdd", $this->global, $data, null);
    }

    public function membersAddSend()
    {
        $this->form_validation->set_rules('file', '圖片', 'callback_img_check');
        $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
        $this->form_validation->set_rules('name', '姓名', 'trim|required|max_length[32]|callback_name_check');
        $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
        $this->form_validation->set_rules('years', '屆期', 'callback_yearSelect_check');
        $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');

        $this->form_validation->set_rules('name_en', '英文姓名', 'trim|required|max_length[32]');
        $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('check', '驗證失敗');
            $this->membersAdd();
        } else {
            $n         = $this->security->xss_clean($this->input->post('name'));
            $n_en      = $this->security->xss_clean($this->input->post('name_en'));
            $edu       = $this->security->xss_clean($this->input->post('education'));
            $exp       = $this->security->xss_clean($this->input->post('experience'));
            $districts = $this->security->xss_clean($this->input->post('districts'));
            $commit    = $this->security->xss_clean($this->input->post('committee'));
            $fb        = $this->security->xss_clean($this->input->post('fb'));
            $ig        = $this->security->xss_clean($this->input->post('ig'));
            $line      = $this->security->xss_clean($this->input->post('line'));
            $yt        = $this->security->xss_clean($this->input->post('yt'));

            $years           = $this->security->xss_clean($this->input->post('years'));
            $issues          = $this->security->xss_clean($this->input->post('issues'));
            $showStatusCheck = $this->security->xss_clean($this->input->post('happy'));
            $showStatus      = $showStatusCheck != 'N' ? 1 : 0;
            $contactList     = $this->security->xss_clean($this->input->post('contactList'));
            $contact         = $this->security->xss_clean($this->input->post('contact'));
            // File upload configuration
            // $uploadPath = dirname(dirname(__DIR__)) . '/assets/uploads/members_upload/';
            $uploadPath              = 'assets/uploads/members_upload/';
            $config['upload_path']   = $uploadPath;
            $config['allowed_types'] = 'jpg|jpeg|png|gif|svg';
            // $config['max_size'] = 1024;

            // Load and initialize upload library
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            // Upload file to server
            if ($this->upload->do_upload('file')) {
                $fileData   = $this->upload->data();
                $uploadData = $fileData['file_name'];
            } else {
                // upload debug ,loads the view display.php with error
                $error = array('error' => $this->upload->display_errors());
                $this->load->view('upload_debug_form', $error);
            }

            // Insert files data into the database
            $membersInfo = array(
                'showup'     => $showStatus,
                'img'        => $uploadData,
                'name'       => $n,
                'name_en'    => $n_en,
                'education'  => $edu,
                'experience' => $exp,
                'districts'  => $districts,
                'committee'  => $commit,
                'fb'         => $fb,
                'ig'         => $ig,
                'line'       => $line,
                'yt'         => $yt,
            );

            $insert_memid = $this->members_model->membersAdd($membersInfo);

            // 當回傳成功insert的id且有選擇標籤時,就將此標籤的資料insert到DB
            if ($insert_memid > 0) {
                if (!empty($years)) {
                    $mem_years_info = array();
                    $one_array      = array();

                    foreach ($years as $k => $v) {
                        $one_array['memid'] = $insert_memid;
                        $one_array['yid']   = $v;

                        $mem_years_info[] = $one_array;
                    }

                    $this->members_model->members_mem_add($mem_years_info, 1);
                }

                if (!empty($issues)) {
                    $mem_issues_info = array();
                    $one_array       = array();

                    foreach ($issues as $k => $v) {
                        $one_array['memid']    = $insert_memid;
                        $one_array['issue_id'] = $v;

                        $mem_issues_info[] = $one_array;
                    }

                    $this->members_model->members_mem_add($mem_issues_info, 2);
                }

                if (!empty($contact)) {
                    $mem_cont_records_info = array();
                    $one_array             = array();

                    foreach ($contact as $c => $cv) {
                        $one_array['memid']   = $insert_memid;
                        $one_array['records'] = $cv;
                        $one_array['con_id']  = $contactList[$c];

                        $mem_cont_records_info[] = $one_array;

                    }

                    $this->members_model->members_mem_add($mem_cont_records_info, 3);
                }

            }

            if ($insert_memid > 0) {
                $array = array(
                    'success' => '新增成功!',
                );

                $this->session->set_flashdata($array);
            } else {
                $this->session->set_flashdata('error', '新增失敗!');
            }

            $this->membersAdd();
        }
    }

    // 屆期
    public function yearsAdd()
    {
        // $this->global['pageTitle'] = '新增標籤';
        $this->global['navTitle']  = '本黨立委 - 屆期管理  - 新增';
        $this->global['navActive'] = base_url('members/yearLists/');

        $this->loadViews("yearsAdd", $this->global, null);
    }

    public function yearsAddSend()
    {
        $this->form_validation->set_rules('title', '名稱', 'trim|required|max_length[128]|callback_years_check');
        $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('check', '驗證失敗');
            $this->yearsAdd();
        } else {
            $name            = $this->security->xss_clean($this->input->post('title'));
            $showStatusCheck = $this->input->post('happy');
            $dStart          = $this->input->post('date_start');
            $dEnd            = $this->input->post('date_end');

            $showStatus = $showStatusCheck != 'N' ? 1 : 0;

            $userInfo = array(
                'title'      => $name,
                'showup'     => $showStatus,
                'date_start' => $dStart,
                'date_end'   => $dEnd,
            );

            $result = $this->members_model->yearsAddSend($userInfo);

            if ($result > 0) {
                $this->session->set_flashdata('success', '新增成功!');
            } else {
                $this->session->set_flashdata('error', '新增失敗!');
            }

            redirect('members/yearLists');
        }
    }

/*
.########.########..####.########
.##.......##.....##..##.....##...
.##.......##.....##..##.....##...
.######...##.....##..##.....##...
.##.......##.....##..##.....##...
.##.......##.....##..##.....##...
.########.########..####....##...
 */

    public function yearsEdit($yid)
    {
        // $this->global['pageTitle'] = '編輯標籤';
        $editProtectChcek = $this->members_model->editProtectCheck($yid, 'years');

        if ($editProtectChcek == 0) {
            redirect('dashboard');
        }

        $this->global['navTitle']  = '本黨立委 - 屆期管理 - 編輯';
        $this->global['navActive'] = base_url('members/yearLists/');

        $data['getYearInfo'] = $this->members_model->getYearInfo($yid);

        $this->loadViews("yearsEdit", $this->global, $data, null);
    }

    public function yearsEditSend($id)
    {
        $this->form_validation->set_rules('title', '名稱', 'trim|required|max_length[128]|callback_years_check[' . $id . ']');
        $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('check', '驗證失敗');
            $this->yearsEdit($id);
        } else {
            $name            = $this->security->xss_clean($this->input->post('title'));
            $showStatusCheck = $this->input->post('happy');
            $dStart          = $this->input->post('date_start');
            $dEnd            = $this->input->post('date_end');

            $userInfo = array(
                'title'      => $name,
                'date_start' => $dStart,
                'date_end'   => $dEnd,
            );

            if ($showStatusCheck != null || $showStatusCheck != '' || !empty($showStatusCheck)) {

                $showStatus         = $showStatusCheck == 'Y' ? 1 : 0;
                $userInfo['showup'] = $showStatus;
            }

            $result = $this->members_model->yearsEditSend($userInfo, $id);

            if ($result > 0) {
                // CodeIgniter支援「快閃資料」(Flashdata), 其為一session資料, 並只對下一次的Server請求有效, 之後就自動清除。
                $array = array(
                    'success' => '更新成功!',
                );

                $this->session->set_flashdata($array);
            } else {
                $this->session->set_flashdata('error', '更新失敗!');
            }

            redirect('members/yearLists/');
        }
    }

    /*
    .########..########.##.......########.########.########
    .##.....##.##.......##.......##..........##....##......
    .##.....##.##.......##.......##..........##....##......
    .##.....##.######...##.......######......##....######..
    .##.....##.##.......##.......##..........##....##......
    .##.....##.##.......##.......##..........##....##......
    .########..########.########.########....##....########
     */

    public function deleteYears()
    {
        $id     = $this->input->post('yid');
        $result = $this->members_model->deleteYears($id);

        if ($result > 0) {
            echo (json_encode(array('status' => true)));
        } else {
            echo (json_encode(array('status' => false)));
        }
    }

/*
..............######..##.....##.########..######..##....##
.............##....##.##.....##.##.......##....##.##...##.
.............##.......##.....##.##.......##.......##..##..
.............##.......#########.######...##.......#####...
.............##.......##.....##.##.......##.......##..##..
.............##....##.##.....##.##.......##....##.##...##.
..............######..##.....##.########..######..##....##
 */

    public function yearSelect_check($str, $id = '')
    {
        $years = $this->security->xss_clean($this->input->post('years'));

        $r = !empty($years) ? true : false;

        if (!$r) {
            $this->form_validation->set_message('yearSelect_check', '屆期欄位不得爲空!');
            $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');

            return $r;
        }

        return $r;
    }

    public function years_check($str, $id = '')
    {
        $name       = $this->security->xss_clean($this->input->post('title'));
        $nameRepeat = $this->members_model->years_check($name, $id);

        if ($nameRepeat > 0) {
            $this->form_validation->set_message('years_check', '已有同名的標題名稱：「' . $str . '」!');
            $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
            return false;
        } else {
            return true;
        }
    }

    // members name
    public function name_check($str, $id = '')
    {
        $name       = $this->security->xss_clean($this->input->post('name'));
        $nameRepeat = $this->members_model->name_check($name, $id);

        if ($nameRepeat > 0) {
            $this->form_validation->set_message('name_check', '已有相同姓名：「' . $str . '」!');
            $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');

            return false;
        } else {
            return true;
        }
    }

    public function img_check($str, $id = '')
    {
        $imgName = $_FILES['file']['name']; //圖片好像不能直接用$str來做

        // 若爲新增功能又沒有選擇圖片或圖片名稱爲空就報錯後離開
        if ($id == '') {
            if (!isset($imgName) || $imgName == '') {
                $this->form_validation->set_message('img_check', '請選擇要上傳的圖片');
                $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');

                return false;
            }
        }

        // 如果圖片檔名有空白字元就報錯後離開
        // \s: 任何空白字元(空白,換行,tab)。\S: 任何非空白字元(空白,換行,tab)。
        $pattern = "/\s/";
        if (preg_match($pattern, $imgName)) {
            // echo 'match';
            $this->form_validation->set_message('img_check', '圖片名稱不可有空白字元');
            $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');

            return false;
        }

        $nameRepeat = $this->members_model->img_check($imgName);

        if ($nameRepeat > 0) {
            $this->form_validation->set_message('img_check', '已有同名的圖片名稱：「' . $imgName . '」!');
            $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
            return false;
        } else {

            // 若在編輯時沒有選圖片
            if (!($id != '' && $imgName == '')) {

                $allowed_mime_type_arr = array('image/gif', 'image/jpeg', 'image/png', 'image/x-png', 'image/svg+xml');
                $mime                  = get_mime_by_extension($imgName);

                // 檢查圖片格式。
                // in_array() 函数搜索数组中是否存在指定的值。
                if (in_array($mime, $allowed_mime_type_arr)) {
                    return true;
                } else {
                    $this->form_validation->set_message('img_check', '圖片格式不正確!<br>請選擇jpg|jpeg|png|gif|svg');
                    $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');

                    return false;
                }
            }
        }
    }

    /*
    ..######...#######..########..########
    .##....##.##.....##.##.....##....##...
    .##.......##.....##.##.....##....##...
    ..######..##.....##.########.....##...
    .......##.##.....##.##...##......##...
    .##....##.##.....##.##....##.....##...
    ..######...#######..##.....##....##...
     */
    public function yearsSort()
    {
        $this->global['navTitle'] = '本黨立委 - 屆期管理 - 排序';

        $data['getYearList'] = $this->members_model->yearsListing(true);

        $this->loadViews("yearsSort", $this->global, $data, null);
    }

    public function yearsSortSend()
    {
        $sort   = $this->security->xss_clean($this->input->post('newSort'));
        $result = $this->members_model->sort($sort);

        if ($result > 0) {
            $this->session->set_flashdata('success', '排序已更新!');
        } else {
            $this->session->set_flashdata('error', '排序更新失敗!');
        }
        // 這裏要用排序插件的$.ajax({success})來做路徑導引導才能成功
    }
}
