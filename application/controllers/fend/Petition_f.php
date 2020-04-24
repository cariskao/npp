<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . '/libraries/FendBaseController.php';

class Petition_f extends FendBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('website_model');
        $this->load->model('petition_f_model');
        $this->global['getSetupInfo'] = $this->website_model->getSetupInfo();
        $this->global['navActive']    = 4;
    }

    public function pageNotFound()
    {
        $this->global['pageTitle'] = 'CodeInsect : 404 - Page Not Found';

        $this->loadViews("404", $this->global, null, null);
    }

    // 新聞訊息首頁
    public function index()
    {
        $this->global['pageTitle']     = '聯絡陳情 - 時代力量立法院黨團';
        $this->global['breadcrumbTag'] = '聯絡陳情';

        $data = array(
            'getPetition' => $this->petition_f_model->getPetition(),
        );
        $a = 1;
        $this->loadViews("fend/petition_f", $this->global, $data, null);
    }
}
