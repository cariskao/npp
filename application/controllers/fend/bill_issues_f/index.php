<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . '/libraries/FendBaseController.php';

class Index extends FendBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('website_model');
        $this->load->model('bill_f_model');
        $this->global['getSetupInfo'] = $this->website_model->getSetupInfo();
        $this->global['navActive']    = 2;
        // $this->isLoggedIn();
    }

    public function pageNotFound()
    {
        $this->global['pageTitle'] = 'CodeInsect : 404 - Page Not Found';

        $this->loadViews("404", $this->global, null, null);
    }

    // 新聞訊息首頁
    public function index()
    {
        $this->global['pageTitle'] = '法案議題 - 時代力量立法院黨團';

        $data = array(
            // 'getBillInfo'   => $this->bill_f_model->getBillInfo(),
            // 'getIssuesInfo' => $this->bill_f_model->getIssuesInfo(),
        );

        $this->loadViews("fend/bill_issues/index", $this->global, $data, null);
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

    // tags列表
    public function tagsList($tag_id)
    {
        $count = $this->news_f_model->tagslistingCount($tag_id);
        // echo ' count: ' . $count . '<br>';
        $returns = $this->paginationCompress("fend/news_f/tagsList/" . $tag_id . '/', $count, 5, 5);
        // echo ' segment-News: ' . $returns['segment'];
        $data['tagsList'] = $this->news_f_model->tagsListing($tag_id, $returns["page"], $returns["segment"]);

        foreach ($data['tagsList'] as $k => $v) {
            foreach ($v as $k => $i) {
                $name = $i;
            }
        }

        $this->global['pageTitle']     = $name . ' - 新聞訊息 - 時代力量立法院黨團';
        $this->global['breadcrumbTag'] = $name;

        $this->loadViews("fend/news/tagsList_f", $this->global, $data, null);
    }
}
