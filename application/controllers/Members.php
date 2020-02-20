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

}
