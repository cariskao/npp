<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . '/libraries/FendBaseController.php';

class News_f extends FendBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('website_model');
        $this->load->model('news_f_model');
        $this->global['getSetupInfo'] = $this->website_model->getSetupInfo();
        $this->global['pageTitle']    = '時代力量立法院黨團';
        $this->global['navActive']    = 1;
        // $this->isLoggedIn();
    }

    public function pageNotFound()
    {
        $this->global['pageTitle'] = 'CodeInsect : 404 - Page Not Found';

        $this->loadViews("404", $this->global, null, null);
    }

    public function index()
    {
        $data = array(
            'get1Info' => $this->news_f_model->getNewsInfo(1),
            'get2Info' => $this->news_f_model->getNewsInfo(2),
            'get3Info' => $this->news_f_model->getNewsInfo(3),
        );

        $this->loadViews("fend/news/news", $this->global, $data, null);
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

// 新聞訊息的各項列表
    public function newsFlists($type_id)
    {
        switch ($type_id) {
            case '1':
                $this->global['breadcrumbTag'] = '法案及議事說明';
                break;
            case '2':
                $this->global['breadcrumbTag'] = '懶人包及議題追追追';
                break;
            case '3':
                $this->global['breadcrumbTag'] = '行動紀實';
                break;
        }

        $searchText = $this->security->xss_clean($this->input->post('searchText'));
        $searchFrom = $this->security->xss_clean($this->input->post('searchFrom'));
        $searchEnd  = $this->security->xss_clean($this->input->post('searchEnd'));

        $data = array(
            'searchFrom' => $searchFrom,
            'searchEnd'  => $searchEnd,
            'searchText' => $searchText,
        );

        $count = $this->news_f_model->listingCount($searchText, $type_id); //算出總筆數
        // echo ' count: ' . $count;

        //記得加上「/」
        // paginationCompress要配合searchText(含前台的html)才有作用
        $returns = $this->paginationCompress("fend/news_f/newsFlists/" . $type_id . '/', $count, 12, 5);
        // echo ' segment-News: ' . $returns['segment'];

        $data['listItems'] = $this->news_f_model->listing($searchFrom, $searchEnd, $searchText, $type_id, $returns["page"], $returns["segment"]);
        $data['type_id']   = $type_id; //用來帶入newsLists_f中searchText的form action

        $this->loadViews("fend/news/newsLists_f", $this->global, $data, null);
    }
}
