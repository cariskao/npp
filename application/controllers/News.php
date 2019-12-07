<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @Description: In User Settings Edit
 * @Author: your name
 * @Date: 2019-06-11 21:16:10
 * @LastEditTime: 2019-12-07 14:28:05
 * @LastEditors: Please set LastEditors
 */

require APPPATH . '/libraries/BaseController.php';

class News extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        // $this->load->library('session');
        $this->load->model('news_model');
        $this->isLoggedIn();
    }

    // 最新新聞
    function index()
    {
        $searchText = $this->security->xss_clean($this->input->post('searchText'));
        $data['searchText'] = $searchText;

        $this->load->library('pagination');

        $count = $this->news_model->userListingCount($searchText); //算出總筆數
        // echo ' count: ' . $count;

        $returns = $this->paginationCompress("news/index/", $count, 10, 3);
        // echo ' segment-News: ' . $returns['segment'];

        $data['newsRecords'] = $this->news_model->userListing($searchText, $returns["page"], $returns["segment"]);
        $data['tagsInfo'] = $this->news_model->getTagsInfo();

        $this->global['pageTitle'] = '最新新聞管理';

        $this->loadViews("news", $this->global, $data, NULL);
    }

    /**
     * This function is used to load the add new form
     * 在這個檔案中只有最新新聞才有使用到addNew()，其它訊息公告跟活動記錄沒有經過addNew()
     */
    function addNew()
    {
        $data['tagsInfo'] = $this->news_model->getTagsInfo();

        $this->global['pageTitle'] = '新增新聞';

        $this->loadViews("addPressReleaseNews", $this->global, $data, NULL);
    }

    /**
     * This function is used to add new user to the system
     */
    function addNewUser()
    {
        $this->form_validation->set_rules('m_title', '大標', 'trim|required|max_length[128]|callback_newsname_check');
        $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
        $this->form_validation->set_rules('file', '圖片', 'callback_addnews_check');
        $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');

        if ($this->form_validation->run() == FALSE) {
            $this->addNew();
        } else {
            $m_title = $this->security->xss_clean($this->input->post('m_title'));
            $s_title = $this->security->xss_clean($this->input->post('s_title'));
            $date_start = $this->security->xss_clean($this->input->post('date_start'));
            $fb = $this->security->xss_clean($this->input->post('fb'));
            $line = $this->security->xss_clean($this->input->post('line'));
            $twitter = $this->security->xss_clean($this->input->post('twitter'));
            $mail = $this->security->xss_clean($this->input->post('mail'));
            $editor = $this->input->post('editor1');
            $tag1 = $this->security->xss_clean($this->input->post('tag1'));
            $tag2 = $this->security->xss_clean($this->input->post('tag2'));
            $tag3 = $this->security->xss_clean($this->input->post('tag3'));
            $tag4 = $this->security->xss_clean($this->input->post('tag4'));
            $tag5 = $this->security->xss_clean($this->input->post('tag5'));

            // File upload configuration
            // $uploadPath = dirname(dirname(__DIR__)) . '/assets/uploads/news_upload/news/';
            $uploadPath = 'assets/uploads/news_upload/news/';
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'jpg|jpeg|png|gif|svg';
            // $config['max_size'] = 1024;

            // Load and initialize upload library
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            // Upload file to server
            if ($this->upload->do_upload('file')) {
                // Uploaded file data
                $uploadData = $this->upload->data();
                $uploadedFile = $uploadData['file_name'];

                // Insert files data into the database
                $userInfo = array(
                    'news_img' => $uploadedFile,
                    'news_main_title' => $m_title,
                    'news_sub_title' => $s_title,
                    'date_start' => $date_start,
                    'news_share_fb' => $fb,
                    'news_share_line' => $line,
                    'news_share_twitter' => $twitter,
                    'news_share_mail' => $mail,
                    'news_editor' => $editor,
                    'tag1' => $tag1,
                    'tag2' => $tag2,
                    'tag3' => $tag3,
                    'tag4' => $tag4,
                    'tag5' => $tag5,
                );

                $result = $this->news_model->addNewUser($userInfo);

                if ($result > 0) {
                    $this->session->set_flashdata('success', '新增成功!');
                } else {
                    $this->session->set_flashdata('error', '新增失敗!');
                }
                // $data['success_msg'] = '圖片上傳成功';
            } else {
                $data['error_msg'] = $this->upload->display_errors();
            }

            redirect('news/addNew');
        }
    }

    /**
     * file input value and type check during validation
     * 新增新聞圖片名稱重複檢查
     */
    function addnews_check($str)
    {
        $allowed_mime_type_arr = array('image/gif', 'image/jpeg', 'image/png', 'image/x-png', 'image/svg+xml');
        $mime = get_mime_by_extension($_FILES['file']['name']);
        $nameRepeat = $this->news_model->addNewsCheck($_FILES['file']['name']);
        // $nameRepeat = $this->news_model->addNameCheck($str);

        if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
            if ($nameRepeat > 0) {
                $this->form_validation->set_message('addnews_check', '已有同名的圖片名稱');
                $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
                return false;
            } else {
                // in_array() 函数搜索数组中是否存在指定的值。
                if (in_array($mime, $allowed_mime_type_arr)) {
                    return true;
                } else {
                    $this->form_validation->set_message('addnews_check', '圖片格式不正確!請選擇gif/jpg/jpeg/png/svg');
                    $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
                    return false;
                }
            }
        } else {
            $this->form_validation->set_message('addnews_check', '請選擇要上傳的圖片');
            $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
            return false;
        }
    }

    /**
     * This function is used load user edit information
     * @param number $userId : Optional : This is user id
     */
    function newsOld($userId = NULL)
    {
        if ($userId == null) {
            redirect('news');
        }

        // $data['roles'] = $this->news_model->getUserRoles();
        $data = array(
            'userInfo' => $this->news_model->getUserInfo($userId),
            'tagsInfo' => $this->news_model->getTagsInfo(),
            // 'error' => '',
        );
        $this->global['pageTitle'] = '編輯新聞';

        $this->loadViews("newsOld", $this->global, $data, NULL);
    }

    /**
     * This function is used to edit the user information
     */
    function editUser()
    {
        $newsId = $this->input->post('newsId');

        $this->form_validation->set_rules('m_title', '大標', 'trim|required|max_length[128]|callback_newsname_check[true]');
        $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
        $this->form_validation->set_rules('file', '圖片', 'callback_newsOld_check');
        $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('check', '驗證失敗');
            $this->newsOld($newsId);
        } else {
            $m_title = $this->security->xss_clean($this->input->post('m_title'));
            $s_title = $this->security->xss_clean($this->input->post('s_title'));
            $date_start = $this->security->xss_clean($this->input->post('date_start'));
            $date_update = $this->security->xss_clean($this->input->post('date_update'));
            $fb = $this->security->xss_clean($this->input->post('fb'));
            $line = $this->security->xss_clean($this->input->post('line'));
            $twitter = $this->security->xss_clean($this->input->post('twitter'));
            $mail = $this->security->xss_clean($this->input->post('mail'));
            $tag1 = $this->security->xss_clean($this->input->post('tag1'));
            $tag2 = $this->security->xss_clean($this->input->post('tag2'));
            $tag3 = $this->security->xss_clean($this->input->post('tag3'));
            $tag4 = $this->security->xss_clean($this->input->post('tag4'));
            $tag5 = $this->security->xss_clean($this->input->post('tag5'));
            $editor = $this->input->post('editor1');

            // File upload configuration
            // $uploadPath = dirname(dirname(__DIR__)) . '/assets/uploads/news_upload/news/';
            $uploadPath = 'assets/uploads/news_upload/news/';
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

            // 檢查若沒有選擇圖片時,就不要上傳img
            if (empty($uploadData)) {
                // Insert files data into the database
                $userInfo = array(
                    'news_main_title' => $m_title,
                    'news_sub_title' => $s_title,
                    'date_start' => $date_start,
                    'date_update' => $date_update,
                    'news_share_fb' => $fb,
                    'news_share_line' => $line,
                    'news_share_twitter' => $twitter,
                    'news_share_mail' => $mail,
                    'news_editor' => $editor,
                    'tag1' => $tag1,
                    'tag2' => $tag2,
                    'tag3' => $tag3,
                    'tag4' => $tag4,
                    'tag5' => $tag5,
                );
            } else {

                // 否則在上傳完新圖片後,就先刪除舊的圖片
                $imgDelete = $this->news_model->editUserDelete($newsId);
                $imgDelName = $imgDelete->news_img;
                unlink(dirname(dirname(__DIR__)) . '/assets/uploads/news_upload/news/' . $imgDelName);
                // https://blog.longwin.com.tw/2009/01/php-get-directory-file-path-dirname-2008/
                // https://www.awaimai.com/408.html
                /*
                echo ' 2 層dirname: ' . dirname(dirname(__FILE__)) . '<br>';
                echo ' 1 層dirname: ' . dirname(__FILE__) . '<br>';
                echo ' FILE: ' . __FILE__ . '<br>';
                echo ' DIR: ' . __DIR__ . '<br>';
                echo ' 1 層dirname + DIR: ' . dirname(__DIR__);*/

                // 再把欄位的資料寫入資料庫
                $userInfo = array(
                    'news_img' => $uploadData,
                    'news_main_title' => $m_title,
                    'news_sub_title' => $s_title,
                    'date_start' => $date_start,
                    'date_update' => $date_update,
                    'news_share_fb' => $fb,
                    'news_share_line' => $line,
                    'news_share_twitter' => $twitter,
                    'news_share_mail' => $mail,
                    'news_editor' => $editor,
                    'tag1' => $tag1,
                    'tag2' => $tag2,
                    'tag3' => $tag3,
                    'tag4' => $tag4,
                    'tag5' => $tag5,
                );
            }

            $result = $this->news_model->editUser($userInfo, $newsId);

            if ($result) {
                $this->session->set_flashdata('success', '儲存成功!');
                $this->session->set_flashdata('check', '驗證成功');
            } else {
                $this->session->set_flashdata('error', '儲存失敗!');
            }

            $this->newsOld($newsId);
            // redirect('news/newsOld');
        }
    }

    // check最新新聞的圖片名稱有無重複
    function newsOld_check($str)
    {
        $allowed_mime_type_arr = array('image/gif', 'image/jpeg', 'image/png', 'image/x-png', 'image/svg+xml');

        if (isset($_FILES['file']['name'])) {
            $mime = get_mime_by_extension($_FILES['file']['name']);
            $nameRepeat = $this->news_model->editUserCheck($_FILES['file']['name']);
        }

        if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
            if ($nameRepeat > 0) {
                $this->form_validation->set_message('newsOld_check', '已有同名的圖片名稱');
                $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
                return false;
            } else {
                // in_array() 函数搜索数组中是否存在指定的值。
                if (in_array($mime, $allowed_mime_type_arr)) {
                    return true;
                } else {
                    $this->form_validation->set_message('newsOld_check', '圖片格式不正確!請選擇gif/jpg/jpeg/png/svg');
                    $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
                    return false;
                }
            }
        }
    }

    // check最新新聞的大標名稱有無重複
    function newsname_check($str, $isEdit = false)
    {
        $id = $isEdit ? $this->input->post('newsId') : null;
        // $id = $this->input->post('newsId');
        $name = $this->input->post('m_title');
        $nameRepeat = $this->news_model->newsname_check($name, $id, $isEdit);

        if (isset($name) && $name != '') {
            if ($nameRepeat > 0) {
                $this->form_validation->set_message('newsname_check', '已有相同標題名稱!');
                $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
                return false;
            } else {
                return true;
            }
        }
    }

    // check訊息公告的大標名稱有無重複
    function messagename_check($str, $isEdit = false)
    {
        $id = $isEdit ? $this->input->post('mesId') : null;
        // $id = $this->input->post('mesId');
        $name = $this->input->post('m_title');
        $nameRepeat = $this->news_model->messagename_check($name, $id, $isEdit);

        if (isset($name) && $name != '') {
            if ($nameRepeat > 0) {
                $this->form_validation->set_message('messagename_check', '已有相同標題名稱!');
                $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
                return false;
            } else {
                return true;
            }
        }
    }

    function recordname_check($str, $isEdit = false)
    {
        $id = $isEdit ? $this->input->post('recordId') : null;
        // $id = $this->input->post('newsId');
        $name = $this->input->post('m_title');
        $nameRepeat = $this->news_model->recordname_check($name, $id, $isEdit);

        if (isset($name) && $name != '') {
            if ($nameRepeat > 0) {
                $this->form_validation->set_message('recordname_check', '已有相同標題名稱!');
                $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
                return false;
            } else {
                return true;
            }
        }
    }

    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteNews()
    {
        $newsid = $this->input->post('newsid');
        $imgDelete = $this->news_model->editUserDelete($newsid);
        $imgDelName = $imgDelete->news_img;
        unlink(dirname(dirname(__DIR__)) . '/assets/uploads/news_upload/news/' . $imgDelName);

        // $userInfo = array('isDeleted' => 1, 'updatedBy' => $this->vendorId, 'updatedDtm' => date('Y-m-d H:i:s'));
        // $result = $this->news_model->deleteUser($newsid, $userInfo);
        $result = $this->news_model->deleteUser($newsid);

        if ($result > 0) {
            echo (json_encode(array('status' => TRUE)));
        } else {
            echo (json_encode(array('status' => FALSE)));
        }
    }

    /**
     * Page not found : error 404
     */
    function pageNotFound()
    {
        $this->global['pageTitle'] = 'CodeInsect : 404 - Page Not Found';

        $this->loadViews("404", $this->global, NULL, NULL);
    }

    //  訊息公告
    function message()
    {
        $searchText = $this->security->xss_clean($this->input->post('searchText'));
        $data['searchText'] = $searchText;

        $this->load->library('pagination');

        $count = $this->news_model->messageListingCount($searchText);

        $returns = $this->paginationCompress("news/message/", $count, 10, 3);

        $data['userRecords'] = $this->news_model->messageListing($searchText, $returns["page"], $returns["segment"]);
        $data['tagsInfo'] = $this->news_model->getTagsInfo();

        $this->global['pageTitle'] = '訊息公告管理';

        $this->loadViews("message", $this->global, $data, NULL);
    }

    function messageOld($userId = NULL)
    {
        if ($userId == null) {
            redirect('news/message');
        }

        // $data['roles'] = $this->news_model->getUserRoles();
        $data = array(
            'userInfo' => $this->news_model->getMessageInfo($userId),
            'tagsInfo' => $this->news_model->getTagsInfo(),
        );

        $this->global['pageTitle'] = '編輯訊息公告';

        $this->loadViews("messageOld", $this->global, $data, NULL);
    }

    function editMessage()
    {
        $newsId = $this->input->post('mesId');

        $this->form_validation->set_rules('m_title', '大標', 'trim|required|max_length[128]|callback_messagename_check[true]');
        $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
        $this->form_validation->set_rules('file', '圖片', 'callback_message_check');
        $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('check', '驗證失敗');
            $this->messageOld($newsId);
        } else {
            $m_title = $this->security->xss_clean($this->input->post('m_title'));
            $s_title = $this->security->xss_clean($this->input->post('s_title'));
            $date_start = $this->security->xss_clean($this->input->post('date_start'));
            $date_update = $this->security->xss_clean($this->input->post('date_update'));
            $fb = $this->security->xss_clean($this->input->post('fb'));
            $line = $this->security->xss_clean($this->input->post('line'));
            $twitter = $this->security->xss_clean($this->input->post('twitter'));
            $mail = $this->security->xss_clean($this->input->post('mail'));
            $editor = $this->input->post('editor1');
            $tag1 = $this->security->xss_clean($this->input->post('tag1'));
            $tag2 = $this->security->xss_clean($this->input->post('tag2'));
            $tag3 = $this->security->xss_clean($this->input->post('tag3'));
            $tag4 = $this->security->xss_clean($this->input->post('tag4'));
            $tag5 = $this->security->xss_clean($this->input->post('tag5'));

            // File upload configuration
            // $uploadPath = dirname(dirname(__DIR__)) . '/assets/uploads/news_upload/message/';
            $uploadPath = 'assets/uploads/news_upload/message/';
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

            // 檢查若沒有選擇圖片時,就不要上傳img
            if (empty($uploadData)) {

                // Insert files data into the database
                $userInfo = array(
                    'main_title' => $m_title,
                    'sub_title' => $s_title,
                    'date_start' => $date_start,
                    'date_update' => $date_update,
                    'fb' => $fb,
                    'line' => $line,
                    'twitter' => $twitter,
                    'mail' => $mail,
                    'editor' => $editor,
                    'tag1' => $tag1,
                    'tag2' => $tag2,
                    'tag3' => $tag3,
                    'tag4' => $tag4,
                    'tag5' => $tag5,
                );
            } else {
                // 否則在上傳完新圖片後,就先刪除舊的圖片
                $imgDelete = $this->news_model->editMessageDelete($newsId);
                $imgDelName = $imgDelete->img;
                unlink(dirname(dirname(__DIR__)) . '/assets/uploads/news_upload/message/' . $imgDelName);
                // https://blog.longwin.com.tw/2009/01/php-get-directory-file-path-dirname-2008/
                // https://www.awaimai.com/408.html

                // 再把欄位的資料寫入資料庫
                $userInfo = array(
                    'img' => $uploadData,
                    'main_title' => $m_title,
                    'sub_title' => $s_title,
                    'date_start' => $date_start,
                    'date_update' => $date_update,
                    'fb' => $fb,
                    'line' => $line,
                    'twitter' => $twitter,
                    'mail' => $mail,
                    'editor' => $editor,
                    'tag1' => $tag1,
                    'tag2' => $tag2,
                    'tag3' => $tag3,
                    'tag4' => $tag4,
                    'tag5' => $tag5,
                );
            }
            $result = $this->news_model->editMessage($userInfo, $newsId);

            if ($result == true) {
                $this->session->set_flashdata('success', '儲存成功!');
                $this->session->set_flashdata('check', '驗證成功');
            } else {
                $this->session->set_flashdata('error', '儲存失敗!');
            }
            $this->messageOld($newsId);
            // redirect('news/newsOld');
        }
    }

    function message_check($str)
    {
        $allowed_mime_type_arr = array('image/gif', 'image/jpeg', 'image/png', 'image/x-png', 'image/svg+xml');

        if (isset($_FILES['file']['name'])) {
            $mime = get_mime_by_extension($_FILES['file']['name']);
            $nameRepeat = $this->news_model->editMessageCheck($_FILES['file']['name']);
        }

        if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
            if ($nameRepeat > 0) {
                $this->form_validation->set_message('message_check', '已有同名的圖片名稱');
                $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
                return false;
            } else {
                // in_array() 函数搜索数组中是否存在指定的值。
                if (in_array($mime, $allowed_mime_type_arr)) {
                    return true;
                } else {
                    $this->form_validation->set_message('message_check', '圖片格式不正確!請選擇gif/jpg/jpeg/png/svg');
                    $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
                    return false;
                }
            }
        }
    }

    function deleteMessage()
    {
        $newsid = $this->input->post('mesid');
        $imgDelete = $this->news_model->editMessageDelete($newsid);
        $imgDelName = $imgDelete->img;
        unlink(dirname(dirname(__DIR__)) . '/assets/uploads/news_upload/message/' . $imgDelName);

        $result = $this->news_model->deleteMessage($newsid);

        if ($result > 0) {
            echo (json_encode(array('status' => TRUE)));
        } else {
            echo (json_encode(array('status' => FALSE)));
        }
    }

    function addNewMessage()
    {
        $this->form_validation->set_rules('m_title', '大標', 'trim|required|max_length[128]|callback_messagename_check');
        $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
        $this->form_validation->set_rules('file', '圖片', 'callback_addmessage_check');
        $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');

        $this->global['pageTitle'] = '新增公告';
        $data['tagsInfo'] = $this->news_model->getTagsInfo();

        if ($this->form_validation->run() == FALSE) {
            $this->loadViews("addPressReleaseMessage", $this->global, $data, NULL);
        } else {
            $m_title = $this->security->xss_clean($this->input->post('m_title'));
            $s_title = $this->security->xss_clean($this->input->post('s_title'));
            $date_start = $this->security->xss_clean($this->input->post('date_start'));
            $fb = $this->security->xss_clean($this->input->post('fb'));
            $line = $this->security->xss_clean($this->input->post('line'));
            $twitter = $this->security->xss_clean($this->input->post('twitter'));
            $mail = $this->security->xss_clean($this->input->post('mail'));
            $editor = $this->input->post('editor1');
            $tag1 = $this->security->xss_clean($this->input->post('tag1'));
            $tag2 = $this->security->xss_clean($this->input->post('tag2'));
            $tag3 = $this->security->xss_clean($this->input->post('tag3'));
            $tag4 = $this->security->xss_clean($this->input->post('tag4'));
            $tag5 = $this->security->xss_clean($this->input->post('tag5'));

            // // File upload configuration
            // $uploadPath = dirname(dirname(__DIR__)) . '/assets/uploads/news_upload/message/';
            $uploadPath = 'assets/uploads/news_upload/message/';
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'jpg|jpeg|png|gif|svg';
            // $config['max_size'] = 1024;

            // Load and initialize upload library
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            // Upload file to server
            if ($this->upload->do_upload('file')) {
                // Uploaded file data
                $uploadData = $this->upload->data();
                $uploadedFile = $uploadData['file_name'];

                // Insert files data
                $userInfo = array(
                    'img' => $uploadedFile,
                    'main_title' => $m_title,
                    'sub_title' => $s_title,
                    'date_start' => $date_start,
                    'fb' => $fb,
                    'line' => $line,
                    'twitter' => $twitter,
                    'mail' => $mail,
                    'editor' => $editor,
                    'tag1' => $tag1,
                    'tag2' => $tag2,
                    'tag3' => $tag3,
                    'tag4' => $tag4,
                    'tag5' => $tag5,
                );

                $result = $this->news_model->addNewMessage($userInfo);

                if ($result > 0) {
                    $this->session->set_flashdata('success', '新增成功!');
                } else {
                    $this->session->set_flashdata('error', '新增失敗!');
                }
            } else {
                $data['error_msg'] = $this->upload->display_errors();
            }

            redirect('news/addNewMessage');
        }
    }

    function addmessage_check($str)
    {
        $allowed_mime_type_arr = array('image/gif', 'image/jpeg', 'image/png', 'image/x-png', 'image/svg+xml');
        $mime = get_mime_by_extension($_FILES['file']['name']);
        $nameRepeat = $this->news_model->addMessageCheck($_FILES['file']['name']);
        // $nameRepeat = $this->news_model->addNameCheck($str);

        if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
            if ($nameRepeat > 0) {
                $this->form_validation->set_message('addmessage_check', '已有同名的圖片名稱');
                $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
                return false;
            } else {
                // in_array() 函数搜索数组中是否存在指定的值。
                if (in_array($mime, $allowed_mime_type_arr)) {
                    return true;
                } else {
                    $this->form_validation->set_message('addmessage_check', '圖片格式不正確!請選擇gif/jpg/jpeg/png/svg');
                    $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
                    return false;
                }
            }
        } else {
            $this->form_validation->set_message('addmessage_check', '請選擇要上傳的圖片');
            $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
            return false;
        }
    }

    // 以下爲活動記錄
    function records()
    {
        $searchText = $this->security->xss_clean($this->input->post('searchText'));
        $data['searchText'] = $searchText;

        $this->load->library('pagination');

        $count = $this->news_model->recordsListingCount($searchText);
        $returns = $this->paginationCompress("news/records/", $count, 10, 3); //記得records右方加上「/」

        // echo ' page: ' . $returns['page'];
        // echo ' segment: ' . $returns['segment'];

        $data['Records'] = $this->news_model->recordsListing($searchText, $returns["page"], $returns["segment"]);
        $data['tagsInfo'] = $this->news_model->getTagsInfo();

        $this->global['pageTitle'] = '活動記錄管理';

        $this->loadViews("records", $this->global, $data, NULL);
    }

    function recordsOld($userId = NULL)
    {
        if ($userId == null) {
            redirect('news/records');
        }

        // $data['roles'] = $this->news_model->getUserRoles();
        $data = array(
            'userInfo' => $this->news_model->getRecordsInfo($userId),
            'tagsInfo' => $this->news_model->getTagsInfo(),
        );

        $this->global['pageTitle'] = '編輯活動記錄';

        $this->loadViews("recordsOld", $this->global, $data, NULL);
    }

    function editRecords()
    {
        $newsId = $this->input->post('recordId');

        $this->form_validation->set_rules('m_title', '大標', 'trim|required|max_length[128]|callback_recordname_check[true]');
        $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
        $this->form_validation->set_rules('file', '圖片', 'callback_records_check');
        $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('check', '驗證失敗');
            $this->recordsOld($newsId);
        } else {
            $m_title = $this->security->xss_clean($this->input->post('m_title'));
            $s_title = $this->security->xss_clean($this->input->post('s_title'));
            $date_start = $this->security->xss_clean($this->input->post('date_start'));
            $date_update = $this->security->xss_clean($this->input->post('date_update'));
            $fb = $this->security->xss_clean($this->input->post('fb'));
            $line = $this->security->xss_clean($this->input->post('line'));
            $twitter = $this->security->xss_clean($this->input->post('twitter'));
            $mail = $this->security->xss_clean($this->input->post('mail'));
            $editor = $this->input->post('editor1');
            $tag1 = $this->security->xss_clean($this->input->post('tag1'));
            $tag2 = $this->security->xss_clean($this->input->post('tag2'));
            $tag3 = $this->security->xss_clean($this->input->post('tag3'));
            $tag4 = $this->security->xss_clean($this->input->post('tag4'));
            $tag5 = $this->security->xss_clean($this->input->post('tag5'));

            // File upload configuration
            // $uploadPath = dirname(dirname(__DIR__)) . '/assets/uploads/news_upload/records/';
            $uploadPath = 'assets/uploads/news_upload/records/';
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

            // 檢查若沒有選擇圖片時,就不要上傳img
            if (empty($uploadData)) {

                // Insert files data into the database
                $userInfo = array(
                    'main_title' => $m_title,
                    'sub_title' => $s_title,
                    'date_start' => $date_start,
                    'date_update' => $date_update,
                    'fb' => $fb,
                    'line' => $line,
                    'twitter' => $twitter,
                    'mail' => $mail,
                    'editor' => $editor,
                    'tag1' => $tag1,
                    'tag2' => $tag2,
                    'tag3' => $tag3,
                    'tag4' => $tag4,
                    'tag5' => $tag5,
                );
            } else {
                // 否則在上傳完新圖片後,就先刪除舊的圖片
                $imgDelete = $this->news_model->editRecordsDelete($newsId);
                $imgDelName = $imgDelete->img;
                unlink(dirname(dirname(__DIR__)) . '/assets/uploads/news_upload/records/' . $imgDelName);
                // https://blog.longwin.com.tw/2009/01/php-get-directory-file-path-dirname-2008/
                // https://www.awaimai.com/408.html

                // 再把欄位的資料寫入資料庫
                $userInfo = array(
                    'img' => $uploadData,
                    'main_title' => $m_title,
                    'sub_title' => $s_title,
                    'date_start' => $date_start,
                    'date_update' => $date_update,
                    'fb' => $fb,
                    'line' => $line,
                    'twitter' => $twitter,
                    'mail' => $mail,
                    'editor' => $editor,
                    'tag1' => $tag1,
                    'tag2' => $tag2,
                    'tag3' => $tag3,
                    'tag4' => $tag4,
                    'tag5' => $tag5,
                );
            }
            $result = $this->news_model->editRecords($userInfo, $newsId);

            if ($result == true) {
                $this->session->set_flashdata('success', '儲存成功!');
                $this->session->set_flashdata('check', '驗證成功');
            } else {
                $this->session->set_flashdata('error', '儲存失敗!');
            }
            $this->recordsOld($newsId);
            // redirect('news/newsOld');
        }
    }

    function records_check($str)
    {
        $allowed_mime_type_arr = array('image/gif', 'image/jpeg', 'image/png', 'image/x-png', 'image/svg+xml');

        if (isset($_FILES['file']['name'])) {
            $mime = get_mime_by_extension($_FILES['file']['name']);
            $nameRepeat = $this->news_model->editRecordsCheck($_FILES['file']['name']);
        }

        if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
            if ($nameRepeat > 0) {
                $this->form_validation->set_message('records_check', '已有同名的圖片名稱');
                $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
                return false;
            } else {
                // in_array() 函数搜索数组中是否存在指定的值。
                if (in_array($mime, $allowed_mime_type_arr)) {
                    return true;
                } else {
                    $this->form_validation->set_message('records_check', '圖片格式不正確!請選擇gif/jpg/jpeg/png/svg');
                    $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
                    return false;
                }
            }
        }
    }

    function addNewRecords()
    {
        $this->form_validation->set_rules('m_title', '大標', 'trim|required|max_length[128]|callback_recordname_check');
        $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
        $this->form_validation->set_rules('file', '圖片', 'callback_addrecord_check');
        $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');

        $this->global['pageTitle'] = '新增活動記錄';
        $data['tagsInfo'] = $this->news_model->getTagsInfo();

        if ($this->form_validation->run() == FALSE) {
            $this->loadViews("addPressReleaseRecords", $this->global, $data, NULL);
        } else {
            $m_title = $this->security->xss_clean($this->input->post('m_title'));
            $s_title = $this->security->xss_clean($this->input->post('s_title'));
            $date_start = $this->security->xss_clean($this->input->post('date_start'));
            $fb = $this->security->xss_clean($this->input->post('fb'));
            $line = $this->security->xss_clean($this->input->post('line'));
            $twitter = $this->security->xss_clean($this->input->post('twitter'));
            $mail = $this->security->xss_clean($this->input->post('mail'));
            $editor = $this->input->post('editor1');
            $tag1 = $this->security->xss_clean($this->input->post('tag1'));
            $tag2 = $this->security->xss_clean($this->input->post('tag2'));
            $tag3 = $this->security->xss_clean($this->input->post('tag3'));
            $tag4 = $this->security->xss_clean($this->input->post('tag4'));
            $tag5 = $this->security->xss_clean($this->input->post('tag5'));

            // // File upload configuration
            // $uploadPath = dirname(dirname(__DIR__)) . '/assets/uploads/news_upload/records/';
            $uploadPath = 'assets/uploads/news_upload/records/';
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'jpg|jpeg|png|gif|svg';
            // $config['max_size'] = 1024;

            // Load and initialize upload library
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            // Upload file to server
            if ($this->upload->do_upload('file')) {
                // Uploaded file data
                $uploadData = $this->upload->data();
                $uploadedFile = $uploadData['file_name'];

                // Insert files data
                $userInfo = array(
                    'img' => $uploadedFile,
                    'main_title' => $m_title,
                    'sub_title' => $s_title,
                    'date_start' => $date_start,
                    'fb' => $fb,
                    'line' => $line,
                    'twitter' => $twitter,
                    'mail' => $mail,
                    'editor' => $editor,
                    'tag1' => $tag1,
                    'tag2' => $tag2,
                    'tag3' => $tag3,
                    'tag4' => $tag4,
                    'tag5' => $tag5,
                );

                $result = $this->news_model->addNewRecords($userInfo);

                if ($result > 0) {
                    $this->session->set_flashdata('success', '新增成功!');
                } else {
                    $this->session->set_flashdata('error', '新增失敗!');
                }
            } else {
                $data['error_msg'] = $this->upload->display_errors();
            }
            redirect('news/addNewRecords');
        }
    }

    function addrecord_check($str)
    {
        $allowed_mime_type_arr = array('image/gif', 'image/jpeg', 'image/png', 'image/x-png', 'image/svg+xml');
        $mime = get_mime_by_extension($_FILES['file']['name']);
        $nameRepeat = $this->news_model->addRecordCheck($_FILES['file']['name']);
        // $nameRepeat = $this->news_model->addNameCheck($str);

        if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
            if ($nameRepeat > 0) {
                $this->form_validation->set_message('addrecord_check', '已有同名的圖片名稱');
                $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
                return false;
            } else {
                // in_array() 函数搜索数组中是否存在指定的值。
                if (in_array($mime, $allowed_mime_type_arr)) {
                    return true;
                } else {
                    $this->form_validation->set_message('addrecord_check', '圖片格式不正確!請選擇gif/jpg/jpeg/png/svg');
                    $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
                    return false;
                }
            }
        } else {
            $this->form_validation->set_message('addrecord_check', '請選擇要上傳的圖片');
            $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
            return false;
        }
    }

    function deleteRecords()
    {
        $newsid = $this->input->post('recordid');
        $imgDelete = $this->news_model->editRecordsDelete($newsid);
        $imgDelName = $imgDelete->img;
        unlink(dirname(dirname(__DIR__)) . '/assets/uploads/news_upload/records/' . $imgDelName);

        $result = $this->news_model->deleteRecords($newsid);

        if ($result > 0) {
            echo (json_encode(array('status' => TRUE)));
        } else {
            echo (json_encode(array('status' => FALSE)));
        }
    }

    /**
     * 新聞訊息標籤
     */
    function tags_check($str, $id = '')
    {
        $name = $this->security->xss_clean($this->input->post('title'));
        $nameRepeat = $this->news_model->tagsCheck($name, $id);

        if ($nameRepeat > 0) {
            $this->form_validation->set_message('tags_check', '已有此標籤名稱!');
            $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
            return false;
        } else {
            return true;
        }
    }

    function tagLists()
    {
        $searchText = $this->security->xss_clean($this->input->post('searchText'));
        $data['searchText'] = $searchText;

        $this->load->library('pagination');
        $count = $this->news_model->tagsListingCount($searchText); //算出總筆數

        $returns = $this->paginationCompress("news/tagLists/", $count, 10, 3);

        $data['newsTags'] = $this->news_model->tagsListing($searchText, $returns["page"], $returns["segment"]);
        $this->global['pageTitle'] = '標籤管理';

        $this->loadViews("tagLists", $this->global, $data, NULL);
    }

    function tagsAdd()
    {
        $this->global['pageTitle'] = '新增標籤';

        $this->loadViews("tagsAdd", $this->global, NULL);
    }

    function tagsEdit($id)
    {
        $this->global['pageTitle'] = '編輯標籤';

        $data['getTagsEditInfo'] = $this->news_model->getTagsEditInfo($id);

        $this->loadViews("tagsEdit", $this->global, $data, NULL);
    }

    function tagsAddSend()
    {
        $this->form_validation->set_rules('title', '名稱', 'trim|required|max_length[128]|callback_tags_check');
        $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');

        if ($this->form_validation->run() == FALSE) {
            $this->tagsAdd();
        } else {
            $name = $this->security->xss_clean($this->input->post('title'));
            $userInfo = array('name' => $name);

            $result = $this->news_model->tagsAddSend($userInfo);

            if ($result > 0) {
                $this->session->set_flashdata('success', '新增成功!');
            } else {
                $this->session->set_flashdata('error', '新增失敗!');
            }

            redirect('news/tagLists');
        }
    }

    function tagsEditSend()
    {
        $id = $this->input->post('tagsid');

        $this->form_validation->set_rules('title', '名稱', 'trim|required|max_length[128]|callback_tags_check[' . $id . ']');
        $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');

        if ($this->form_validation->run() == FALSE) {
            $this->tagsEdit($id);
        } else {
            $name = $this->security->xss_clean($this->input->post('title'));
            $userInfo = array('name' => $name);

            $result = $this->news_model->tagsEditSend($userInfo, $id);

            if ($result > 0) {
                $this->session->set_flashdata('success', '新增成功!');
            } else {
                $this->session->set_flashdata('error', '新增失敗!');
            }

            redirect('news/tagLists');
        }
    }

    function deleteNewsTag()
    {
        $newsid = $this->input->post('tagsid');
        $result = $this->news_model->deleteNewsTag($newsid);

        if ($result > 0) {
            echo (json_encode(array('status' => TRUE)));
        } else {
            echo (json_encode(array('status' => FALSE)));
        }
    }
}
