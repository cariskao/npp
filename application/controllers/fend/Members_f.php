<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . '/libraries/FendBaseController.php';

class Members_f extends FendBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('website_model');
        $this->load->model('members_f_model');
        $this->global['pageTitle']    = '本黨立委 - 時代力量立法院黨團';
        $this->global['getSetupInfo'] = $this->website_model->getSetupInfo();
        $this->global['navActive']    = 3;
        // $this->isLoggedIn();
    }

    public function pageNotFound()
    {
        $this->global['pageTitle'] = 'CodeInsect : 404 - Page Not Found';

        $this->loadViews("404", $this->global, null, null);
    }

    // 使用vuejs
    // public function yearsAxios()
    // {
    //     $this->db->select();
    //     $this->db->from('years as y');
    //     $this->db->where('showup', 1);
    //     $this->db->order_by('y.sort', 'ASC');

    //     $query = $this->db->get();

    //     $result = $query->result();

    //     echo json_encode($result);
    // }

    // 使用vuejs
    // public function index()
    // {
    //     $this->loadViews("fend/members/members", $this->global, null, null);
    // }

    public function index()
    {
        $data = array(
            'getYearsList' => $this->members_f_model->getYearsList(),
        );

        $this->loadViews("fend/members/members", $this->global, $data, null);
    }

    public function yearChange()
    {
        $id         = $this->security->xss_clean($this->input->post('yid'));
        $memberInfo = $this->members_f_model->getMembersInfo($id);
        $res        = ''; //沒先宣告的話會error

        foreach ($memberInfo as $k => $v) {
            $res .= "
      <div class='col-md-3'>
         <a class='m-1 members-card' href='" . base_url('membersInner/' . $v->memid) . "'>
            <img src='" . base_url('assets/uploads/members_upload/' . $v->img) . "'" . " alt='NOT FOUND' class='border'>
            <h3>{$v->name}</h3>
         </a>
      </div>
    ";
        }

        echo $res;
    }
}
