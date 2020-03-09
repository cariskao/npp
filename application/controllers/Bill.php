<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . '/libraries/BaseController.php';

class Bill extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->library('ftp');
        // $this->load->library('session');
        $this->load->model('bill_model');
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

    // 議題
    public function issuesClassList()
    {
        $this->global['navTitle']  = '重點法案管理 - 議題類別管理 - 列表';
        $this->global['navActive'] = base_url('members/issuesClassList/');

        $searchText         = $this->security->xss_clean($this->input->post('searchText'));
        $data['searchText'] = $searchText;

        $count = $this->bill_model->issuesClassListingCount($searchText);

        $returns = $this->paginationCompress('bill/issuesClassList/', $count, 10, 3);

        $data['issuesClassList'] = $this->bill_model->issuesClassListing(false, $searchText, $returns["page"], $returns["segment"]);
        // $this->global['pageTitle'] = '標籤管理';

        $this->loadViews('issuesClassList', $this->global, $data, null);
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

    // 議題
    public function issuesClassAdd()
    {
        $this->global['navTitle']  = '重點法案管理 - 議題類別管理 - 新增';
        $this->global['navActive'] = base_url('bill/issuesClassList/');

        $this->loadViews("issuesClassAdd", $this->global, null);
    }

    public function issuesClassAddSend()
    {
        $this->form_validation->set_rules('name', '名稱', 'trim|required|max_length[128]|callback_issuesClass_check');
        $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('check', '驗證失敗');
            $this->issuesClassAdd();
        } else {
            $name            = $this->security->xss_clean($this->input->post('name'));
            $showStatusCheck = $this->input->post('happy');

            $showStatus = $showStatusCheck != 'N' ? 1 : 0;

            $userInfo = array(
                'name'   => $name,
                'showup' => $showStatus,
            );

            $result = $this->bill_model->issuesClassAddSend($userInfo);

            if ($result > 0) {
                $this->session->set_flashdata('success', '新增成功!');
            } else {
                $this->session->set_flashdata('error', '新增失敗!');
            }

            redirect('bill/issuesClassList/');
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

    //  議題
    public function issuesClassEdit($id)
    {
        $editProtectChcek = $this->bill_model->editProtectCheck($id, 'issues-class');

        if ($editProtectChcek == 0) {
            redirect('dashboard');
        }

        $this->global['navTitle']  = '重點法案管理 - 議題類別管理 - 編輯';
        $this->global['navActive'] = base_url('bill/issuesClassList/');

        $data['getIssuesClassInfo'] = $this->bill_model->getIssuesClassInfo($id);

        $this->loadViews("issuesClassEdit", $this->global, $data, null);
    }

    public function issuesClassEditSend($id)
    {
        $this->form_validation->set_rules('name', '名稱', 'trim|required|max_length[128]|callback_issuesClass_check[' . $id . ']');
        $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('check', '驗證失敗');
            $this->issuesClassEdit($id);
        } else {
            $name            = $this->security->xss_clean($this->input->post('name'));
            $showStatusCheck = $this->input->post('happy');

            $userInfo = array(
                'name' => $name,
            );

            if ($showStatusCheck != null || $showStatusCheck != '' || !empty($showStatusCheck)) {

                $showStatus         = $showStatusCheck == 'Y' ? 1 : 0;
                $userInfo['showup'] = $showStatus;
            }

            $result = $this->bill_model->issuesClassEditSend($userInfo, $id);

            if ($result > 0) {
                // CodeIgniter支援「快閃資料」(Flashdata), 其為一session資料, 並只對下一次的Server請求有效, 之後就自動清除。
                $array = array(
                    'success' => '更新成功!',
                );

                $this->session->set_flashdata($array);
            } else {
                $this->session->set_flashdata('error', '更新失敗!');
            }

            redirect('bill/issuesClassList/');
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

    public function deleteIssuesClass()
    {
        $id     = $this->input->post('ic_id');
        $result = $this->bill_model->deleteIssuesClass($id);

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

    public function issuesClass_check($str, $id = '')
    {
        $name       = $this->security->xss_clean($this->input->post('name'));
        $nameRepeat = $this->bill_model->issuesClass_check($name, $id);

        if ($nameRepeat > 0) {
            $this->form_validation->set_message('issuesClass_check', '已有同名的議題名稱：「' . $str . '」!');
            $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
            return false;
        } else {
            return true;
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
    public function issuesClassSort()
    {

        $this->global['navTitle']  = '重點法案管理 - 議題類別管理 - 排序';
        $this->global['navActive'] = base_url('bill/issuesClassList/');

        $data['issuesClassListing'] = $this->bill_model->issuesClassListing(true);

        $this->loadViews("issuesClassSort", $this->global, $data, null);
    }

    public function issuesClassSortSend()
    {
        $sort   = $this->security->xss_clean($this->input->post('newSort'));
        $result = $this->bill_model->sort($sort);

        if ($result > 0) {
            $this->session->set_flashdata('success', '排序已更新!');
        } else {
            $this->session->set_flashdata('error', '排序更新失敗!');
        }
        // 這裏要用排序插件的$.ajax({success})來做路徑導引導才能成功
    }
}
