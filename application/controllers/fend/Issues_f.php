<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . '/libraries/FendBaseController.php';

class Issues_f extends FendBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('website_model');
        $this->load->model('bill_issues_f_model');
        $this->load->model('issues_f_model');
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
    public function Issues_class_f()
    {
        $this->global['pageTitle'] = '關注議題 - 時代力量立法院黨團';

        $data = array(
            'getIssuesClass' => $this->bill_issues_f_model->getIssuesClass(true),
        );

        $this->loadViews("fend/bill_issues/issuesClass_f", $this->global, $data, null);
    }

    // 關注議題列表
    public function issuesAllList_f($ic_id)
    {
        $count = $this->issues_f_model->issuesAllListingCount($ic_id);
        // echo ' count: ' . $count . '<br>';
        $returns = $this->paginationCompress("fend/Issues_f/issuesAllList_f/" . $ic_id . '/', $count, 12, 5);
        // echo ' segment-News: ' . $returns['segment'];
        $data['issuesAllList'] = $this->issues_f_model->issuesAllListing($ic_id, $returns["page"], $returns["segment"]);

        foreach ($data['issuesAllList'] as $k => $v) {
            $name = $v->name;
        }

        $this->global['pageTitle']     = $name . ' - 關注議題 - 時代力量立法院黨團';
        $this->global['breadcrumbTag'] = $name;

        $this->loadViews("fend/bill_issues/issuesAllList_f", $this->global, $data, null);
    }
}
