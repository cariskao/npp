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
        $this->load->library('email'); //加載CI的email類
        // 以下設置Email參數
        $config = array(
            'protocol'     => 'smtp',
            'smtp_host'    => 'ssl://smtp.gmail.com',
            'smtp_port'    => '465',
            'smtp_user'    => 'mailemail031@gmail.com',
            'smtp_pass'    => '2tSZtskDIsriXdXxa7T5BIBK',
            'smtp_timeout' => '60',
            'mailtype'     => 'html',
            'charset'      => 'utf-8',
            'newline'      => "\r\n",
            'wordwrap'     => true,
            'validation'   => true,
        );

        // 獲取陳情者資訊
        $username = $this->security->xss_clean($this->input->post('username'));
        $sex      = $this->security->xss_clean($this->input->post('sex'));
        $from     = $this->security->xss_clean($this->input->post('mail'));
        $phone    = $this->security->xss_clean($this->input->post('phone'));
        $textarea = $this->security->xss_clean($this->input->post('textarea'));

        // 獲取目前設定的mail
        $to = $this->petition_f_model->getToMail();
        $to = $to->mail;

        $sex     = $sex == 0 ? '女性' : ($sex == 1 ? '男性' : '--');
        $call    = $sex == '女性' ? ' 小姐' : ($sex == '男性' ? ' 先生' : '');
        $subject = '陳情人：' . $username . $call;

        // message內容
        $emailContent = '<table border="1" style="width:95%;text-align:center;border-collapse:collapse;border:1px solid #cccccc;margin: auto;border-spacing:0;">';
        $emailContent .= "<tr><td style='width:100px'>姓名</td><td style='text-align:left'>$username</td></tr>";
        $emailContent .= "<tr><td style='width:100px'>性別</td><td style='text-align:left'>$sex</td></tr>";
        $emailContent .= "<tr><td style='width:100px'>電話</td><td style='text-align:left'>$phone</td></tr>";
        $emailContent .= "<tr><td style='width:100px'>陳情內容</td><td style='text-align:left'>$textarea</td></tr>";
        $emailContent .= "</table>";

        $path = 'assets/uploads/jquery-upload-file/';
        $file = glob($path . $phone . '/*');

        // 以下設置Email內容
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->from($from);
        // $this->email->from('mailemail031@gmail.com');
        $this->email->to('mailemail031@gmail.com');
        // $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($emailContent);
        // $this->email->message('<font color=red>Testing the email class.</font>');

        foreach ($file as $k => $v) {
            $this->email->attach($v);
        }

        $this->email->send();
        $this->email->print_debugger(); //用於調試

        foreach ($file as $k => $v) {
            if (file_exists($v)) {
                unlink($v);
            }
        }

        if (count(scandir($path . $phone)) == 2) {
            rmdir($path . $phone);
        }

        redirect('fend/petition_f');
    }
}
