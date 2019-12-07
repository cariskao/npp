<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Legislator extends BaseController
{
   /**
    * This is default constructor of the class
    */
   public function __construct()
   {
      parent::__construct();
      $this->load->model('legislator_model');
      $this->load->model('partymember_model');
      // $this->load->library('ftp');
      $this->isLoggedIn();
   }

   function index()
   {
      $searchText = $this->security->xss_clean($this->input->post('searchText'));
      $data['searchText'] = $searchText;

      $this->load->library('pagination');
      $count = $this->legislator_model->legislatorYearsListingCount($searchText); //算出總筆數
      // echo ' count: ' . $count;

      $returns = $this->paginationCompress("legislator/index/", $count, 10, 3);
      // echo ' segment-News: ' . $returns['segment'];

      $data['legislatorYears'] = $this->legislator_model->legislatorYearsListing($searchText, $returns["page"], $returns["segment"]);
      // echo $this->unicode_decode('\u53f0\u7063');
      $this->global['pageTitle'] = '屆期管理';

      $this->loadViews("legislator/years", $this->global, $data, NULL);
   }

   function deleteLegislatorYear()
   {
      $yearid = $this->input->post('yearid');
      $yearTitle = $this->input->post('title');

      // $path = dirname(dirname(__DIR__)) . '/assets/uploads/legislator_upload/' . $yearTitle;
      // delete_files($path . '/');
      $path = dirname(dirname(__DIR__)) . '\assets\uploads\legislator_upload\\' . $yearTitle;
      delete_files($path . '\\');

      if (rmdir($path)) {
         echo '<script>console.log("刪除成功!");</script>';
      } else {
         echo '<script>console.log("刪除失敗!");</script>';
      }

      $result = $this->legislator_model->deleteLegislatorYear($yearid);

      if ($result > 0) {
         echo (json_encode(array('status' => TRUE)));
      } else {
         echo (json_encode(array('status' => FALSE)));
      }
      // $this->legislatorListPage($yearid);
      redirect('legislator/index');
   }

   function deleteLegislator()
   {
      $yearTitle = $this->input->post('title');
      $yearid = $this->input->post('yearid');
      $legid = $this->input->post('legid');

      $imgDelete = $this->legislator_model->getLegislatorInfo($yearid, $legid);
      $imgDelName = $imgDelete->img;
      // unlink(dirname(dirname(__DIR__)) . '/assets/uploads/legislator_upload/' . $yearTitle . '/' . $imgDelName);
      unlink(dirname(dirname(__DIR__)) . '\assets\uploads\legislator_upload\\' . $yearTitle . '\\' . $imgDelName);

      $result = $this->legislator_model->deleteLegislator($yearid, $legid);

      if ($result > 0) {
         echo (json_encode(array('status' => TRUE)));
      } else {
         echo (json_encode(array('status' => FALSE)));
      }

      $this->legislatorListPage($yearid);
      // redirect('legislator/legislatorListPage/' . $yearid);
   }

   // 編輯標題與更新立委資料
   function legislatorListPage($yearid = NULL, $bool = false)
   {
      // echo $bool; // 在點擊上下一頁時,$bool會出現10,因同名view的.attr("action"的關係,但不影響結果
      if ($yearid == null) {
         redirect('legislator');
      }

      $check = ($bool) ? '驗證成功' : '驗證失敗';

      $this->session->set_flashdata('check', $check);
      $this->global['pageTitle'] = '本屆期委員列表';

      $searchText = $this->security->xss_clean($this->input->post('searchText'));
      $data['searchText'] = $searchText;

      $this->load->library('pagination');
      $count = $this->legislator_model->legislatorListingCount($searchText, $yearid);
      // echo ' count: ' . $count;

      $returns = $this->paginationCompress("legislator/legislatorListPage/" . $yearid . "/", $count, 10, 4);
      // echo ' segment: ' . $returns['segment'];
      // echo ' page: ' . $returns['page'];

      $data['issueList'] = $this->legislator_model->getIssueList();
      $data['yearTitle'] = $this->legislator_model->getYearInfo($yearid);
      $data['legislatorRecords'] = $this->legislator_model->legislatorListing($searchText, $returns["page"], $returns["segment"], $yearid);

      $this->loadViews("legislator/legislatorListPage", $this->global, $data, NULL);
   }

   // 編輯標題資料
   function yearSend()
   {
      $this->form_validation->set_rules('title', '標題', 'trim|required|max_length[40]|callback_yearNameCheck[true]');
      $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');

      $old_id = $this->input->post('old_id');
      $oldTitle = $this->input->post('old_title');
      $newTitle = $this->input->post('title');
      // echo '<script>console.log(' . $old_id . ');</script>';

      if ($this->form_validation->run() == FALSE) {
         $this->legislatorListPage($old_id);
         // redirect('legislator/legislatorListPage/' . $old_id);
      } else {
         // $getYearInfo = $this->legislator_model->getYearInfo($old_id);
         // $path = dirname(dirname(__DIR__)) . '/assets/uploads/legislator_upload/';
         $path = dirname(dirname(__DIR__)) . '\assets\uploads\legislator_upload\\';
         $oldName = $path . $oldTitle;
         // $oldName = $path . $getYearInfo->title;
         $rename = $path . $newTitle;
         // $rename = $path . $title;

         if (rename($oldName, $rename)) {
            echo '<script>console.log("更新成功!");</script>';
         } else {
            echo '<script>console.log("更新失敗!");</script>';
         }

         $yearInfo = array(
            'title' => $newTitle,
         );

         $result = $this->legislator_model->yearSend($yearInfo, $old_id);

         if ($result == true) {
            $this->session->set_flashdata('success', '儲存成功!');
         } else {
            $this->session->set_flashdata('error', '儲存失敗!');
         }
         // $this->legislatorListPage($old_id, '驗證成功');
         redirect('legislator/legislatorListPage/' . $old_id . '/' . true);
      }
   }

   /**
    * 将UNICODE编码后的内容进行解码，如unicode字符串："\u56fe\u7247" 转为"图片"
    * @param string $name 要转换的unicode字符串
    * @param string $out_charset 输出编码，默认为utf8
    * @param string $in_charset 输入unicode编码，Linux 服务器上 UCS-2 编码方式与 Winodws 不一致，
    * linux编码为UCS-2BE，windows为UCS-2LE，即big-endian和little-endian
    * @return string
    */
   function unicode_decode($name, $out_charset = 'UTF-8', $in_charset = 'UCS-2BE')
   {
      // 转换编码，将Unicode编码转换成可以浏览的utf-8编码
      $pattern = '/([\w]+)|(\\\u([\w]{4}))/i';
      preg_match_all($pattern, $name, $matches);
      if (!empty($matches)) {
         $name = '';
         for ($j = 0; $j < count($matches[0]); $j++) {
            $str = $matches[0][$j];
            if (strpos($str, '\\u') === 0) {
               $code = base_convert(substr($str, 2, 2), 16, 10);
               $code2 = base_convert(substr($str, 4), 16, 10);
               $c = chr($code) . chr($code2);
               $c = iconv($in_charset, $out_charset, $c);
               $name .= $c;
            } else {
               $name .= $str;
            }
         }
      }
      return $name;
   }

   function legislatorEditPage($yearid = NULL, $legid = NULL, $bool = false)
   {
      if ($yearid == null || $legid == null) {
         redirect('legislator/legislatorListPage/' . $yearid);
         // $this->legislatorListPage($yearid);
      }

      $check = ($bool) ? '驗證成功' : '驗證失敗';

      $this->session->set_flashdata('check', $check);
      $this->global['pageTitle'] = '編輯委員資料';

      $data = array(
         'yearTitle' => $this->legislator_model->getYearInfo($yearid),
         'userInfo' => $this->legislator_model->getLegislatorInfo($yearid, $legid),
         'issueList' => $this->legislator_model->getIssueList()
      );

      $this->loadViews("legislator/legislatorEditPage", $this->global, $data, NULL);
   }

   function legislatorEditSend()
   {
      $legId = $this->input->post('legId');
      $yearId = $this->input->post('yearId');

      $districts = $this->security->xss_clean($this->input->post('districts'));
      $issueId1 = $this->security->xss_clean($this->input->post('issueId1'));
      $issueId2 = $this->security->xss_clean($this->input->post('issueId2'));
      $issueId3 = $this->security->xss_clean($this->input->post('issueId3'));
      $issueId4 = $this->security->xss_clean($this->input->post('issueId4'));
      $issueId5 = $this->security->xss_clean($this->input->post('issueId5'));
      $issueId6 = $this->security->xss_clean($this->input->post('issueId6'));
      $issueId7 = $this->security->xss_clean($this->input->post('issueId7'));
      $issueId8 = $this->security->xss_clean($this->input->post('issueId8'));
      $issueId9 = $this->security->xss_clean($this->input->post('issueId9'));
      $issueId10 = $this->security->xss_clean($this->input->post('issueId10'));

      $userInfo = array(
         'districts' => $districts,
         'issueId1' => $issueId1,
         'issueId2' => $issueId2,
         'issueId3' => $issueId3,
         'issueId4' => $issueId4,
         'issueId5' => $issueId5,
         'issueId6' => $issueId6,
         'issueId7' => $issueId7,
         'issueId8' => $issueId8,
         'issueId9' => $issueId9,
         'issueId10' => $issueId10,
      );

      $result = $this->legislator_model->legislatorEditSend($userInfo, $legId);

      if ($result == true) {
         $this->session->set_flashdata('success', '儲存成功!');
         $this->session->set_flashdata('check', '驗證成功');
      } else {
         $this->session->set_flashdata('error', '儲存失敗!');
      }
      $this->legislatorEditPage($yearId, $legId, true);
   }

   // 確認編輯的圖片名稱有無重複
   function legislator_check($str, $yearId)
   {
      // echo '<script>alert(' . $yearId . ');</script>';

      $allowed_mime_type_arr = array('image/gif', 'image/jpeg', 'image/png', 'image/x-png', 'image/svg+xml');

      if (isset($_FILES['file']['name'])) {
         $mime = get_mime_by_extension($_FILES['file']['name']);
         $nameRepeat = $this->legislator_model->legislatorImgNameCheck($_FILES['file']['name'], $yearId);
      }

      if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
         if ($nameRepeat > 0) {
            $this->form_validation->set_message('legislator_check', '已有同名的圖片名稱');
            $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
            return false;
         } else {
            // in_array() 函数搜索数组中是否存在指定的值。
            if (in_array($mime, $allowed_mime_type_arr)) {
               return true;
            } else {
               $this->form_validation->set_message('legislator_check', '圖片格式不正確!請選擇gif/jpg/jpeg/png/svg');
               $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
               return false;
            }
         }
      }
   }

   function addYearPage()
   {
      $this->global['pageTitle'] = '新增屆期';

      $this->loadViews("legislator/addYearPage", $this->global, NULL);
   }

   function addLegislatorPage($yearid)
   {
      $this->global['pageTitle'] = '委員列表';

      $searchText = $this->security->xss_clean($this->input->post('searchText'));
      $data['searchText'] = $searchText;

      $this->load->library('pagination');
      $count = $this->partymember_model->partymemberListingCount($searchText); //算出總筆數
      // echo ' count: ' . $count;

      $returns = $this->paginationCompress("legislator/addLegislatorPage/" . $yearid . "/", $count, 10, 4);
      // echo ' segment-News: ' . $returns['segment'];

      $data['partyMemberInfo'] = $this->partymember_model->partymemberListing($searchText, $returns["page"], $returns["segment"]);
      $data['yearTitle'] = $this->legislator_model->getYearInfo($yearid);

      $this->loadViews("legislator/addLegislatorPage", $this->global, $data, NULL);
   }

   function insertToLegislator($yearid, $memid)
   {
      $year = $this->legislator_model->getYearInfo($yearid);
      $getPartyMemberInfo = $this->partymember_model->getPartyMemberInfo($memid);
      $inserNameCheck = $this->legislator_model->insertLegislatorNameCheck($yearid, $getPartyMemberInfo->name);

      if ($inserNameCheck > 0) {
         $this->session->set_flashdata('insert-legname-repeat', '已有此委員資料 !!');
         redirect('legislator/addLegislatorPage/' . $yearid);
         // $this->addLegislatorPage($yearid); // 有問題
      }

      copy(dirname(dirname(__DIR__)) . '/assets/uploads/partymember_upload/' . $getPartyMemberInfo->img, dirname(dirname(__DIR__)) . '/assets/uploads/legislator_upload/' . $year->title . '/' . $getPartyMemberInfo->img);

      foreach ($getPartyMemberInfo as $key => $value) {
         if ($key != 'memid') {
            $userInfo[$key] = $value;
         }
      }
      $userInfo['yearid'] = $yearid;

      $result = $this->legislator_model->insertToLegislator($userInfo);

      if ($result > 0) {
         $this->session->set_flashdata('success', '新增成功!');
         $this->session->set_flashdata('add', '新增成功');
      } else {
         $this->session->set_flashdata('error', '新增失敗!');
      }

      // $this->legislatorListPage($yearid, true); //error
      redirect('legislator/legislatorListPage/' . $yearid);
   }

   function addYearSend()
   {
      $yearTitle = $this->input->post('title');

      $this->form_validation->set_rules('title', '標題', 'trim|required|max_length[12]|callback_yearNameCheck');
      $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
      // $this->form_validation->set_rules('date', '建立日期', 'trim|required|max_length[12]');
      // $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');

      if ($this->form_validation->run() == FALSE) {
         $this->addYearPage();
      } else {
         $title = $this->security->xss_clean($this->input->post('title'));
         // $date = $this->security->xss_clean($this->input->post('date'));

         $userInfo = array(
            'title' => $title,
            // 'date' => $date
         );

         $result = $this->legislator_model->addNewYear($userInfo);

         if ($result > 0) {
            $this->session->set_flashdata('success', '新增成功!');
            // mkdir(dirname(dirname(__DIR__)) . '/assets/uploads/legislator_upload/' . $yearTitle . '/');
            mkdir(dirname(dirname(__DIR__)) . '\assets\uploads\legislator_upload\\' . $yearTitle . '\\');
         } else {
            $this->session->set_flashdata('error', '新增失敗!');
         }

         redirect('legislator/addYearPage');
      }
   }

   function addLegislatorSend()
   {
      $yearId = $this->input->post('yearId');
      $yearTitle = $this->input->post('yearTitle');

      $this->form_validation->set_rules('name', '姓名', 'trim|required|max_length[12]|callback_legislatorNameCheck');
      $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
      $this->form_validation->set_rules('file', '圖片', 'callback_legislator_Addcheck[' . $yearId . ']');
      $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');

      if ($this->form_validation->run() == FALSE) {
         $this->session->set_flashdata('check', '驗證失敗');
         $this->addLegislatorPage($yearId);
         // $this->loadViews("legislator/addLegislatorPage", NULL);
      } else {
         $name = $this->security->xss_clean($this->input->post('name'));
         $education = $this->security->xss_clean($this->input->post('education'));
         $experience = $this->security->xss_clean($this->input->post('experience'));
         $committee = $this->security->xss_clean($this->input->post('committee'));
         $districts = $this->security->xss_clean($this->input->post('districts'));
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
         $issueId1 = $this->security->xss_clean($this->input->post('issueId1'));
         $issueId2 = $this->security->xss_clean($this->input->post('issueId2'));
         $issueId3 = $this->security->xss_clean($this->input->post('issueId3'));
         $issueId4 = $this->security->xss_clean($this->input->post('issueId4'));
         $issueId5 = $this->security->xss_clean($this->input->post('issueId5'));
         $issueId6 = $this->security->xss_clean($this->input->post('issueId6'));
         $issueId7 = $this->security->xss_clean($this->input->post('issueId7'));
         $issueId8 = $this->security->xss_clean($this->input->post('issueId8'));
         $issueId9 = $this->security->xss_clean($this->input->post('issueId9'));
         $issueId10 = $this->security->xss_clean($this->input->post('issueId10'));

         // File upload configuration
         // $uploadPath = dirname(dirname(__DIR__)) . '/assets/uploads/legislator_upload/' . $yearTitle . '/';
         $uploadPath = 'assets/uploads/legislator_upload/' . $yearTitle . '/';
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
               'yearid' => $yearId,
               'img' => $uploadData,
               'name' => $name,
               'education' => $education,
               'experience' => $experience,
               'committee' => $committee,
               'districts' => $districts,
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
               'issueId1' => $issueId1,
               'issueId2' => $issueId2,
               'issueId3' => $issueId3,
               'issueId4' => $issueId4,
               'issueId5' => $issueId5,
               'issueId6' => $issueId6,
               'issueId7' => $issueId7,
               'issueId8' => $issueId8,
               'issueId9' => $issueId9,
               'issueId10' => $issueId10,
            );
         }

         $result = $this->legislator_model->addNewLegislator($userInfo);

         if ($result > 0) {
            $this->session->set_flashdata('success', '新增成功!');
            $this->session->set_flashdata('check', '驗證成功');
         } else {
            $this->session->set_flashdata('error', '新增失敗!');
         }

         $this->addLegislatorPage($yearId);
         // redirect('legislator/addLegislatorPage');
      }
   }

   // 確認新增委員的圖片名稱有無重複
   function legislator_Addcheck($str, $yearId)
   {
      // echo '<script>alert(' . $yearId . ');</script>';

      $allowed_mime_type_arr = array('image/gif', 'image/jpeg', 'image/png', 'image/x-png', 'image/svg+xml');

      if (isset($_FILES['file']['name'])) {
         $mime = get_mime_by_extension($_FILES['file']['name']);
         $nameRepeat = $this->legislator_model->legislatorImgNameCheck($_FILES['file']['name'], $yearId);
      }

      if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
         if ($nameRepeat > 0) {
            $this->form_validation->set_message('legislator_Addcheck', '已有同名的圖片名稱');
            $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
            return false;
         } else {
            // in_array() 函数搜索数组中是否存在指定的值。
            if (in_array($mime, $allowed_mime_type_arr)) {
               return true;
            } else {
               $this->form_validation->set_message('legislator_Addcheck', '圖片格式不正確!請選擇gif/jpg/jpeg/png/svg');
               $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
               return false;
            }
         }
      } else {
         $this->form_validation->set_message('legislator_Addcheck', '請選擇要上傳的圖片');
         $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
         return false;
      }
   }

   // 確認新增委員的名稱有無重複
   function legislatorNameCheck($str)
   {
      $yearId = $this->input->post('yearId');
      $name = $this->input->post('name');
      if (isset($_POST['legId']) && $_POST['legId'] != '') {
         $legId = $_POST['legId'];
         $nameRepeat = $this->legislator_model->legislatorNameCheck($name, $yearId, $legId);
      } else {
         $nameRepeat = $this->legislator_model->legislatorNameCheck($name, $yearId);
      }
      // echo '<script>console.log("' . $name . '");</script>';

      if (isset($name) && $name != '') {
         // 確認是否已經建立此委員資料
         if ($nameRepeat > 0) {
            $this->form_validation->set_message('legislatorNameCheck', '已有建立此委員資料!');
            $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
            return false;
         } else {
            return true;
         }
      }
   }

   // check屆期名稱有無重複
   function yearNameCheck($str, $isEdit = false)
   {
      if (isset($_POST['title']) && $_POST['title'] != '') {
         $name = $this->input->post('title');

         if ($isEdit) {
            $editId = $this->input->post('old_id');
            $nameRepeat = $this->legislator_model->yearNameCheck($name, $editId);
         } else {
            $nameRepeat = $this->legislator_model->yearNameCheck($name);
         }

         if (isset($name) && $name != '') {
            if ($nameRepeat > 0) {
               $this->form_validation->set_message('yearNameCheck', '屆期名稱重複!');
               $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
               return false;
            } else {
               return true;
            }
         }
      }
   }
}
