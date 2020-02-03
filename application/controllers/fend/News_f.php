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
        $this->load->model('home_model');
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
}
