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

    //  屆期
    public function yearLists()
    {
        $this->global['navTitle'] = '本黨立委 - 屆期管理';

        $searchText         = $this->security->xss_clean($this->input->post('searchText'));
        $data['searchText'] = $searchText;

        $count = $this->members_model->yearsListingCount($searchText); //算出總筆數

        $returns = $this->paginationCompress('members/yearLists/', $count, 10, 3);

        $data['yearLists'] = $this->members_model->yearsListing($searchText, $returns["page"], $returns["segment"]);
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

    // 屆期
    public function yearsAdd()
    {
        // $this->global['pageTitle'] = '新增標籤';
        $this->global['navTitle'] = '本黨立委 - 新增屆期';

        $this->loadViews("yearsAdd", $this->global, null);
    }

    public function yearsAddSend()
    {
        $this->form_validation->set_rules('title', '名稱', 'trim|required|max_length[128]|callback_tags_check');
        $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');

        if ($this->form_validation->run() == false) {
            $this->tagsAdd();
        } else {
            $name            = $this->security->xss_clean($this->input->post('title'));
            $showStatusCheck = $this->input->post('happy');

            $showStatus = $showStatusCheck != 'N' ? 1 : 0;

            $userInfo = array(
                'name'   => $name,
                'showup' => $showStatus,
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
}
