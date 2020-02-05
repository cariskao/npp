<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Partymember extends BaseController
{
   /**
    * This is default constructor of the class
    */
   public function __construct()
   {
      parent::__construct();
      $this->load->model('partymember_model');
      $this->isLoggedIn();
   }

   function index()
   {
      $this->global['pageTitle'] = '黨員列表';

      $searchText = $this->security->xss_clean($this->input->post('searchText'));
      $data['searchText'] = $searchText;

      $count = $this->partymember_model->partymemberListingCount($searchText);
      // echo ' count: ' . $count;

      $returns = $this->paginationCompress("partymember/index/", $count, 10, 3);
      // echo ' segment: ' . $returns['segment'];
      // echo ' page: ' . $returns['page'];

      $data['partyMemberRecords'] = $this->partymember_model->partymemberListing($searchText, $returns["page"], $returns["segment"]);

      $this->loadViews("partymember/partyMemberListPage", $this->global, $data, NULL);
   }

   function addPartyMember()
   {
      $this->global['pageTitle'] = '新增黨員';

      $this->loadViews("partymember/addPartyMemberPage", $this->global, NULL);
   }

   function addPartyMemberSend()
   {
      $this->form_validation->set_rules('name', '姓名', 'trim|required|max_length[12]|callback_partyMemberNameCheck');
      $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
      $this->form_validation->set_rules('file', '圖片', 'callback_memberImgNameCheck');
      $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');

      if ($this->form_validation->run() == FALSE) {
         $this->session->set_flashdata('check', '驗證失敗');
         $this->addPartyMember();
         // $this->loadViews("legislator/addLegislatorPage", NULL);
      } else {
         $name = $this->security->xss_clean($this->input->post('name'));
         $education = $this->security->xss_clean($this->input->post('education'));
         $experience = $this->security->xss_clean($this->input->post('experience'));
         $committee = $this->security->xss_clean($this->input->post('committee'));
         $cell_phone = $this->security->xss_clean($this->input->post('cell_phone'));
         $office_phone = $this->security->xss_clean($this->input->post('office_phone'));
         $fax = $this->security->xss_clean($this->input->post('fax'));
         $mail = $this->security->xss_clean($this->input->post('mail'));
         $address = $this->security->xss_clean($this->input->post('address'));
         $fb = $this->security->xss_clean($this->input->post('fb'));
         $line = $this->security->xss_clean($this->input->post('line'));
         $ig = $this->security->xss_clean($this->input->post('ig'));
         $web = $this->security->xss_clean($this->input->post('web'));
         $youtube = $this->security->xss_clean($this->input->post('youtube'));

         // File upload configuration
         // $uploadPath = dirname(dirname(__DIR__)) . '/assets/uploads/partymember_upload/';
         $uploadPath = 'assets/uploads/partymember_upload/';
         $config['upload_path'] = $uploadPath;
         $config['allowed_types'] = 'jpg|jpeg|png|gif|svg';
         // $config['max_size'] = 1024;

         // Load and initialize upload library
         $this->load->library('upload', $config);
         $this->upload->initialize($config);

         // Upload file to server
         if ($this->upload->do_upload('file')) {
            $fileData = $this->upload->data();
            $uploadData = $fileData['file_name'];
         }

         if (!empty($uploadData)) {
            $userInfo = array(
               'img' => $uploadData,
               'name' => $name,
               'education' => $education,
               'experience' => $experience,
               'committee' => $committee,
               'cell_phone' => $cell_phone,
               'office_phone' => $office_phone,
               'fax' => $fax,
               'mail' => $mail,
               'address' => $address,
               'fb' => $fb,
               'line' => $line,
               'ig' => $ig,
               'web' => $web,
               'youtube' => $youtube,
            );
         }

         $result = $this->partymember_model->addNewPartyMember($userInfo);

         if ($result > 0) {
            $this->session->set_flashdata('success', '新增成功!');
            $this->session->set_flashdata('check', '驗證成功');
         } else {
            $this->session->set_flashdata('error', '新增失敗!');
         }

         // redirect('partymember/addPartyMember');
         $this->addPartyMember();
      }
   }

   function editPartyMemberPage($memid)
   {
      if ($memid == null) {
         redirect('partymember');
         // $this->legislatorListPage($yearid);
      }

      // $check = ($bool) ? '驗證成功' : '驗證失敗';

      // $this->session->set_flashdata('check', $check);
      $this->global['pageTitle'] = '編輯黨員資料';

      $data['userInfo'] = $this->partymember_model->getPartyMemberInfo($memid);

      $this->loadViews("partymember/editPartyMemberPage", $this->global, $data, NULL);
   }

   function editPartyMemberSend()
   {
      $memId = $this->input->post('memid');

      $this->form_validation->set_rules('name', '姓名', 'trim|required|max_length[12]|callback_partyMemberNameCheck');
      $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
      $this->form_validation->set_rules('file', '圖片', 'callback_memberImgNameCheck');
      $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');

      if ($this->form_validation->run() == FALSE) {
         $this->session->set_flashdata('check', '驗證失敗');
         $this->editPartyMemberPage($memId);
      } else {
         $name = $this->security->xss_clean($this->input->post('name'));
         $education = $this->security->xss_clean($this->input->post('education'));
         $experience = $this->security->xss_clean($this->input->post('experience'));
         $committee = $this->security->xss_clean($this->input->post('committee'));
         $cell_phone = $this->security->xss_clean($this->input->post('cell_phone'));
         $office_phone = $this->security->xss_clean($this->input->post('office_phone'));
         $fax = $this->security->xss_clean($this->input->post('fax'));
         $mail = $this->security->xss_clean($this->input->post('mail'));
         $address = $this->security->xss_clean($this->input->post('address'));
         $fb = $this->security->xss_clean($this->input->post('fb'));
         $line = $this->security->xss_clean($this->input->post('line'));
         $ig = $this->security->xss_clean($this->input->post('ig'));
         $web = $this->security->xss_clean($this->input->post('web'));
         $youtube = $this->security->xss_clean($this->input->post('youtube'));

         // File upload configuration
         // $uploadPath = dirname(dirname(__DIR__)) . '/assets/uploads/legislator_upload/' . $yearTitle . '/';
         $uploadPath = 'assets/uploads/partymember_upload/';
         $config['upload_path'] = $uploadPath;
         $config['allowed_types'] = 'jpg|jpeg|png|gif|svg';
         // $config['max_size'] = 1024;

         // Load and initialize upload library
         $this->load->library('upload', $config);
         $this->upload->initialize($config);

         // Upload file to server
         if ($this->upload->do_upload('file')) {
            $fileData = $this->upload->data();
            $uploadData = $fileData['file_name'];
         }

         if (empty($uploadData)) {
            $userInfo = array(
               'name' => $name,
               'education' => $education,
               'experience' => $experience,
               'committee' => $committee,
               'cell_phone' => $cell_phone,
               'office_phone' => $office_phone,
               'fax' => $fax,
               'mail' => $mail,
               'address' => $address,
               'fb' => $fb,
               'line' => $line,
               'ig' => $ig,
               'web' => $web,
            );
         } else {
            $imgDelete = $this->partymember_model->partyMemberImgDelete($memId);
            $imgDelName = $imgDelete->img;
            // unlink(dirname(dirname(__DIR__)) . '/assets/uploads/partymember_upload/' . $imgDelName);
            unlink(dirname(dirname(__DIR__)) . '\assets\uploads\partymember_upload\\' . $imgDelName);

            $userInfo = array(
               'img' => $uploadData,
               'name' => $name,
               'education' => $education,
               'experience' => $experience,
               'committee' => $committee,
               'cell_phone' => $cell_phone,
               'office_phone' => $office_phone,
               'fax' => $fax,
               'mail' => $mail,
               'address' => $address,
               'fb' => $fb,
               'line' => $line,
               'ig' => $ig,
               'web' => $web,
               'youtube' => $youtube,
            );
         }

         $result = $this->partymember_model->partyMemberEditSend($userInfo, $memId);

         if ($result == true) {
            $this->session->set_flashdata('success', '儲存成功!');
            $this->session->set_flashdata('check', '驗證成功');
         } else {
            $this->session->set_flashdata('error', '儲存失敗!');
         }
         // $this->editPartyMemberPage($memId);
      }
   }

   function deletePartyMember()
   {
      $memId = $this->input->post('memid');

      $imgDelete = $this->partymember_model->getPartyMemberInfo($memId);
      $imgDelName = $imgDelete->img;
      // unlink(dirname(dirname(__DIR__)) . '/assets/uploads/partymember_upload/' . $imgDelName);
      unlink(dirname(dirname(__DIR__)) . '\assets\uploads\partymember_upload\\' . $imgDelName);

      $result = $this->partymember_model->deletePartyMember($memId);

      if ($result > 0) {
         echo (json_encode(array('status' => TRUE)));
      } else {
         echo (json_encode(array('status' => FALSE)));
      }

      // $this->legislatorListPage($memId);
      // redirect('legislator/legislatorListPage/' . $yearid);
   }

   // 確認新增黨員的圖片名稱有無重複
   function memberImgNameCheck($str)
   {
      $allowed_mime_type_arr = array('image/gif', 'image/jpeg', 'image/png', 'image/x-png', 'image/svg+xml');
      $memId = $this->input->post('memid');

      if (isset($_FILES['file']['name'])) {
         $mime = get_mime_by_extension($_FILES['file']['name']);
         if (isset($memId) && $memId !== null) {
            $nameRepeat = $this->partymember_model->memberImgNameCheck($_FILES['file']['name'], $memId);
         } else {
            $nameRepeat = $this->partymember_model->memberImgNameCheck($_FILES['file']['name']);
         }
      }

      if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
         if ($nameRepeat > 0) {
            $this->form_validation->set_message('memberImgNameCheck', '已有同名的圖片名稱');
            $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
            return false;
         } else {
            // in_array() 函数搜索数组中是否存在指定的值。
            if (in_array($mime, $allowed_mime_type_arr)) {
               return true;
            } else {
               $this->form_validation->set_message('memberImgNameCheck', '圖片格式不正確!請選擇gif/jpg/jpeg/png/svg');
               $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
               return false;
            }
         }
      } else {
         if ($memId == null) {
            $this->form_validation->set_message('memberImgNameCheck', '請選擇要上傳的圖片');
            $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
            return false;
         }
      }
   }

   // 確認新增黨員的名稱有無重複
   function partyMemberNameCheck($str)
   {
      $name = $this->input->post('name');
      $memId = $this->input->post('memid');

      if (isset($memId) && $memId !== null) {
         $nameRepeat = $this->partymember_model->partyMemberNameCheck($name, $memId);
      } else {
         $nameRepeat = $this->partymember_model->partyMemberNameCheck($name);
      }

      if (isset($name) && $name != '') {
         // 確認是否已經建立此黨員資料
         if ($nameRepeat > 0) {
            $this->form_validation->set_message('partyMemberNameCheck', '已有建立此黨員資料!');
            $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
            return false;
         } else {
            return true;
         }
      }
   }
}
