<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Stars extends BaseController
{
   /**
    * This is default constructor of the class
    */
   public function __construct()
   {
      parent::__construct();
      $this->load->model('legislator_model');
      $this->isLoggedIn();
   }

   function index()
   {
      echo 'stars';
      // $searchText = $this->security->xss_clean($this->input->post('searchText'));
      // $data['searchText'] = $searchText;

      // $this->load->library('pagination');
      // $count = $this->legislator_model->legislatorListingCount($searchText); //算出總筆數
      // // echo ' count: ' . $count;

      // $returns = $this->paginationCompress("legislator/index/", $count, 10, 3);
      // // echo ' segment-News: ' . $returns['segment'];

      // $data['legislatorRecords'] = $this->legislator_model->legislatorListing($searchText, $returns["page"], $returns["segment"]);

      // $this->global['pageTitle'] = '本黨委員管理';

      // $this->loadViews("legislator/legislator", $this->global, $data, NULL);
   }

   function deleteLegislator()
   {
      $newsid = $this->input->post('legid');
      $result = $this->legislator_model->deleteLegislator($newsid);

      if ($result > 0) {
         echo (json_encode(array('status' => TRUE)));
      } else {
         echo (json_encode(array('status' => FALSE)));
      }
   }

   function legislatorEditPage($userId = NULL)
   {
      if ($userId == null) {
         redirect('legislator');
      }

      $data['userInfo'] = $this->legislator_model->getUserInfo($userId);

      $this->global['pageTitle'] = '編輯委員資料';

      $this->loadViews("legislator/legislatorEditPage", $this->global, $data, NULL);
   }

   function legislatorEditSend()
   {
      $this->load->library('form_validation');
      $this->form_validation->set_rules('name', '姓名', 'trim|required|max_length[12]');
      $legId = $this->input->post('legid');

      if ($this->form_validation->run() == FALSE) {
         $this->legislatorEditPage($legId);
      } else {
         $name = $this->security->xss_clean($this->input->post('name'));
         $education = $this->security->xss_clean($this->input->post('education'));
         $experience = $this->security->xss_clean($this->input->post('experience'));
         $committee = $this->security->xss_clean($this->input->post('committee'));
         $phone1 = $this->security->xss_clean($this->input->post('phone1'));
         $phone2 = $this->security->xss_clean($this->input->post('phone2'));
         $phone3 = $this->security->xss_clean($this->input->post('phone3'));
         $fb = $this->security->xss_clean($this->input->post('fb'));
         $youtube = $this->security->xss_clean($this->input->post('youtube'));
         $mail1 = $this->security->xss_clean($this->input->post('mail1'));
         $mail2 = $this->security->xss_clean($this->input->post('mail2'));
         $mail3 = $this->security->xss_clean($this->input->post('mail3'));
         $focus1 = $this->security->xss_clean($this->input->post('focus1'));
         $focus2 = $this->security->xss_clean($this->input->post('focus2'));
         $focus3 = $this->security->xss_clean($this->input->post('focus3'));
         $focus4 = $this->security->xss_clean($this->input->post('focus4'));
         $focus5 = $this->security->xss_clean($this->input->post('focus5'));
         $city = $this->security->xss_clean($this->input->post('city'));
         $districts = $this->security->xss_clean($this->input->post('districts'));

         $userInfo = array(
            'name' => $name,
            'education' => $education,
            'experience' => $experience,
            'committee' => $committee,
            'phone1' => $phone1,
            'phone2' => $phone2,
            'phone3' => $phone3,
            'fb' => $fb,
            'youtube' => $youtube,
            'mail1' => $mail1,
            'mail2' => $mail2,
            'mail3' => $mail3,
            'focus1' => $focus1,
            'focus2' => $focus2,
            'focus3' => $focus3,
            'focus4' => $focus4,
            'focus5' => $focus5,
            'city' => $city,
            'districts' => $districts,
         );

         $result = $this->legislator_model->legislatorEditSend($userInfo, $legId);

         if ($result == true) {
            $this->session->set_flashdata('success', '儲存成功!');
         } else {
            $this->session->set_flashdata('error', '儲存失敗!');
         }
         $this->legislatorEditPage($legId);
      }
   }

   function addLegislatorPage()
   {
      $this->global['pageTitle'] = '新增委員';

      $this->loadViews("legislator/addLegislatorPage", $this->global, NULL);
   }

   function addLegislatorSend()
   {
      $this->load->library('form_validation');
      $this->form_validation->set_rules('name', '姓名', 'trim|required|max_length[12]');

      if ($this->form_validation->run() == FALSE) {
         $this->addLegislatorPage();
         // $this->loadViews("legislator/addLegislatorPage", NULL);
      } else {
         $name = $this->security->xss_clean($this->input->post('name'));
         $education = $this->security->xss_clean($this->input->post('education'));
         $experience = $this->security->xss_clean($this->input->post('experience'));
         $committee = $this->security->xss_clean($this->input->post('committee'));
         $phone1 = $this->security->xss_clean($this->input->post('phone1'));
         $phone2 = $this->security->xss_clean($this->input->post('phone2'));
         $phone3 = $this->security->xss_clean($this->input->post('phone3'));
         $fb = $this->security->xss_clean($this->input->post('fb'));
         $youtube = $this->security->xss_clean($this->input->post('youtube'));
         // $mail1 = $this->security->xss_clean($this->input->post('mail1'));
         $mail1 = strtolower($this->security->xss_clean($this->input->post('mail1')));
         $mail2 = $this->security->xss_clean($this->input->post('mail2'));
         $mail3 = $this->security->xss_clean($this->input->post('mail3'));
         $focus1 = $this->security->xss_clean($this->input->post('focus1'));
         $focus2 = $this->security->xss_clean($this->input->post('focus2'));
         $focus3 = $this->security->xss_clean($this->input->post('focus3'));
         $focus4 = $this->security->xss_clean($this->input->post('focus4'));
         $focus5 = $this->security->xss_clean($this->input->post('focus5'));
         $city = $this->security->xss_clean($this->input->post('city'));
         $districts = $this->security->xss_clean($this->input->post('districts'));

         $userInfo = array(
            'name' => $name,
            'education' => $education,
            'experience' => $experience,
            'committee' => $committee,
            'phone1' => $phone1,
            'phone2' => $phone2,
            'phone3' => $phone3,
            'fb' => $fb,
            'youtube' => $youtube,
            'mail1' => $mail1,
            'mail2' => $mail2,
            'mail3' => $mail3,
            'focus1' => $focus1,
            'focus2' => $focus2,
            'focus3' => $focus3,
            'focus4' => $focus4,
            'focus5' => $focus5,
            'city' => $city,
            'districts' => $districts,
            'date' => date('Y-m-d H:i:s')
         );

         $result = $this->legislator_model->addNewLegislator($userInfo);

         if ($result > 0) {
            $this->session->set_flashdata('success', '新增成功!');
         } else {
            $this->session->set_flashdata('error', '新增失敗!');
         }

         redirect('legislator/addLegislatorPage');
      }
   }
}
