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

        $this->loadViews("fend/petition_f", $this->global, $data, null);
    }

    public function emailSend()
    {
        $username = $this->security->xss_clean($this->input->post('username'));
        $sex      = $this->security->xss_clean($this->input->post('sex'));
        $mail     = $this->security->xss_clean($this->input->post('mail'));
        $phone    = $this->security->xss_clean($this->input->post('phone'));
        $textarea = $this->security->xss_clean($this->input->post('textarea'));

        $this->load->library('email'); //加載CI的email類
        // 以下設置Email參數
        $config = array(
            'protocol'   => 'smtp',
            'smtp_host'  => 'ssl://smtp.gmail.com',
            'smtp_user'  => 'coolcariskao@gmail.com',
            'smtp_pass'  => '1jGxL5GvHulH2RDugIgF',
            'smtp_port'  => '25',
            'mailtype'   => 'html',
            'charset'    => 'utf-8',
            'wordwrap'   => true,
            'validation' => true,
        );

        // 以下設置Email內容
        $this->load->library('email', $config); //加載CI的email類
        $this->email->from('coolcariskao@gmail.com', 'me');
        $this->email->to('coolcariskao@gmail.com');
        $this->email->subject('Email Test');
        $this->email->message('<font color=red>Testing the email class.</font>');
        $this->email->set_newline("\r\n");
        // $this->email->attach('application\controllers\1.jpeg'); //相對於index.php的路徑
        $this->email->send();
        $this->email->print_debugger(); //用於調試

        // redirect('fend/petition_f');
    }
}
