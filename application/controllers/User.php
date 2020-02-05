<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class User extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->isLoggedIn();
        $this->global['pageTitle'] = '時代力量後台管理';
    }

    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        // $this->global['pageTitle'] = '控制面板';
        $this->loadViews("dashboard", $this->global, NULL, NULL);
    }

    /**
     * This function is used to load the user list
     */
    function userListing()
    {
        // 等同vuejs的導航守衛,可預防直接使用網址進入
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;

            $count = $this->user_model->userListingCount($searchText); //算出總筆數,有搜尋結果就顯示全部搜尋的結果,否則就顯示全部的結果。

            $returns = $this->paginationCompress("userListing/", $count, 10);
            // echo 'page: ' . $returns['page']; //10
            // echo 'segment: ' . $returns['segment']; //10

            $data['userRecords'] = $this->user_model->userListing($searchText, $returns["page"], $returns["segment"]);

            // $this->global['pageTitle'] = '人員管理';
            $this->global['navTitle'] = '人員管理';

            $this->loadViews("users", $this->global, $data, NULL);
        }
    }

    function managerListing()
    {
        // 等同vuejs的導航守衛,可預防直接使用網址進入
        if ($this->isManager() == TRUE) {
            $this->loadThis();
        } else {
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;

            $count = $this->user_model->managerListingCount($searchText); //算出總筆數,有搜尋結果就顯示全部搜尋的結果,否則就顯示全部的結果。

            $returns = $this->paginationCompress("user/managerListing/", $count, 10, 3);
            // echo 'page: ' . $returns['page']; //10
            // echo 'segment: ' . $returns['segment']; //10

            $data['userRecords'] = $this->user_model->managerListing($searchText, $returns["page"], $returns["segment"]);

            $this->global['pageTitle'] = '人員管理(管理員)';

            $this->loadViews("managers", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addNew()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $data['roles'] = $this->user_model->getUserRoles();

            // $this->global['pageTitle'] = '新增人員資料';
            $this->global['navTitle'] = '新增人員資料';

            $this->loadViews("addNew", $this->global, $data, NULL);
        }
    }

    function addManager()
    {
        if ($this->isManager() == TRUE) {
            $this->loadThis();
        } else {
            $data['roles'] = $this->user_model->getManagerRoles();

            $this->global['pageTitle'] = '新增人員資料';

            $this->loadViews("addManager", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to check whether email already exist or not
     * 從addUser.js和editUser.js傳遞
     */
    function checkEmailExists()
    {
        $userId = $this->input->post("userId");
        $email = $this->input->post("email");

        if (empty($userId)) {
            $result = $this->user_model->checkEmailExists($email);
        } else {
            $result = $this->user_model->checkEmailExists($email, $userId);
        }

        if (empty($result)) {
            echo ("true");
        } else {
            echo ("false");
        }
    }

    /**
     * This function is used to add new user to the system
     */
    function addNewUser()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('fname', '名稱', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[128]');
            $this->form_validation->set_rules('password', '密碼', 'required|max_length[20]');
            $this->form_validation->set_rules('cpassword', '密碼確認', 'trim|required|matches[password]|max_length[20]');
            $this->form_validation->set_rules('role', '層級', 'trim|required|numeric');
            $this->form_validation->set_rules('mobile', '手機號碼', 'required|min_length[10]');

            if ($this->form_validation->run() == FALSE) {
                $this->addNew();
            } else {
                $name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                $email = strtolower($this->security->xss_clean($this->input->post('email')));
                $password = $this->input->post('password');
                $roleId = $this->input->post('role');
                $mobile = $this->security->xss_clean($this->input->post('mobile'));

                $userInfo = array(
                    'email' => $email,
                    'password' => getHashedPassword($password),
                    'roleId' => $roleId,
                    'name' => $name,
                    'mobile' => $mobile,
                    'createdBy' => $this->vendorId,
                    'createdDtm' => date('Y-m-d H:i:s')
                );

                $result = $this->user_model->addNewUser($userInfo);

                if ($result > 0) {
                    $this->session->set_flashdata('success', '新增成功!');
                } else {
                    $this->session->set_flashdata('error', '新增失敗!');
                }

                redirect('addNew');
            }
        }
    }

    function addNewManager()
    {
        if ($this->isManager() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('fname', '名稱', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[128]');
            $this->form_validation->set_rules('password', '密碼', 'required|max_length[20]');
            $this->form_validation->set_rules('cpassword', '密碼確認', 'trim|required|matches[password]|max_length[20]');
            $this->form_validation->set_rules('role', '層級', 'trim|required|numeric');
            $this->form_validation->set_rules('mobile', '手機號碼', 'required|min_length[10]');

            if ($this->form_validation->run() == FALSE) {
                $this->addManager();
            } else {
                $name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                $email = strtolower($this->security->xss_clean($this->input->post('email')));
                $password = $this->input->post('password');
                $roleId = $this->input->post('role');
                $mobile = $this->security->xss_clean($this->input->post('mobile'));

                $userInfo = array(
                    'email' => $email,
                    'password' => getHashedPassword($password),
                    'roleId' => $roleId,
                    'name' => $name,
                    'mobile' => $mobile,
                    'createdBy' => $this->vendorId,
                    'createdDtm' => date('Y-m-d H:i:s')
                );

                $result = $this->user_model->addNewUser($userInfo);

                if ($result > 0) {
                    $this->session->set_flashdata('success', '新增成功!');
                } else {
                    $this->session->set_flashdata('error', '新增失敗!');
                }

                redirect('user/addManager');
            }
        }
    }

    /**
     * This function is used load user edit information
     * @param number $userId : Optional : This is user id
     */
    function editOld($userId = NULL)
    {
        // echo $userId;這裡因爲若tbl_users的userId=1是amdin,但admin的欄位不應該出現在人員管理中,所以這算是一個防呆的機制。
        if ($this->isAdmin() == TRUE || $userId == 1) {
            $this->loadThis();
        } else {
            if ($userId == null) {
                redirect('userListing');
            }

            $data['roles'] = $this->user_model->getUserRoles();
            $data['userInfo'] = $this->user_model->getUserInfo($userId);

            // $this->global['pageTitle'] = '編輯人員資料';
            $this->global['navTitle'] = '編輯人員資料';

            $this->loadViews("editOld", $this->global, $data, NULL);
        }
    }

    function managerOld($userId = NULL)
    {
        // echo $userId;這裡因爲若tbl_users的userId=1是amdin,但admin的欄位不應該出現在人員管理中,所以這算是一個防呆的機制。
        if ($this->isManager() == TRUE) {
            $this->loadThis();
        } else {
            if ($userId == null) {
                redirect('user/managerListing');
            }

            $data['roles'] = $this->user_model->getManagerRoles();
            $data['userInfo'] = $this->user_model->getManagerInfo($userId);

            $this->global['pageTitle'] = '編輯人員資料';

            $this->loadViews("managerOld", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to edit the user information
     */
    function editUser()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $userId = $this->input->post('userId');

            $this->form_validation->set_rules('fname', '名稱', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[128]');
            $this->form_validation->set_rules('password', '密碼', 'matches[cpassword]|max_length[20]');
            $this->form_validation->set_rules('cpassword', '密碼確認', 'matches[password]|max_length[20]');
            $this->form_validation->set_rules('role', '層級', 'trim|required|numeric');
            $this->form_validation->set_rules('mobile', '手機號碼', 'required|min_length[10]');

            if ($this->form_validation->run() == FALSE) {
                $this->editOld($userId);
            } else {
                $name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                $email = strtolower($this->security->xss_clean($this->input->post('email')));
                $password = $this->input->post('password');
                $roleId = $this->input->post('role');
                $mobile = $this->security->xss_clean($this->input->post('mobile'));

                $userInfo = array();

                if (empty($password)) {
                    $userInfo = array(
                        'email' => $email, 'roleId' => $roleId, 'name' => $name,
                        'mobile' => $mobile, 'updatedBy' => $this->vendorId, 'updatedDtm' => date('Y-m-d H:i:s')
                    );
                } else {
                    $userInfo = array(
                        'email' => $email, 'password' => getHashedPassword($password), 'roleId' => $roleId,
                        'name' => ucwords($name), 'mobile' => $mobile, 'updatedBy' => $this->vendorId,
                        'updatedDtm' => date('Y-m-d H:i:s')
                    );
                }

                $result = $this->user_model->editUser($userInfo, $userId);

                if ($result == true) {
                    $this->session->set_flashdata('success', '更新成功!');
                } else {
                    $this->session->set_flashdata('error', '更新失敗!');
                }

                // redirect('userListing');
                $this->editOld($userId);
            }
        }
    }

    function editManager()
    {
        if ($this->isManager() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $userId = $this->input->post('userId');

            $this->form_validation->set_rules('fname', '名稱', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[128]');
            $this->form_validation->set_rules('password', '密碼', 'matches[cpassword]|max_length[20]');
            $this->form_validation->set_rules('cpassword', '密碼確認', 'matches[password]|max_length[20]');
            $this->form_validation->set_rules('role', '層級', 'trim|required|numeric');
            $this->form_validation->set_rules('mobile', '手機號碼', 'required|min_length[10]');

            if ($this->form_validation->run() == FALSE) {
                $this->managerOld($userId);
            } else {
                $name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                $email = strtolower($this->security->xss_clean($this->input->post('email')));
                $password = $this->input->post('password');
                $roleId = $this->input->post('role');
                $mobile = $this->security->xss_clean($this->input->post('mobile'));

                $userInfo = array();

                if (empty($password)) {
                    $userInfo = array(
                        'email' => $email, 'roleId' => $roleId, 'name' => $name,
                        'mobile' => $mobile, 'updatedBy' => $this->vendorId, 'updatedDtm' => date('Y-m-d H:i:s')
                    );
                } else {
                    $userInfo = array(
                        'email' => $email, 'password' => getHashedPassword($password), 'roleId' => $roleId,
                        'name' => ucwords($name), 'mobile' => $mobile, 'updatedBy' => $this->vendorId,
                        'updatedDtm' => date('Y-m-d H:i:s')
                    );
                }

                $result = $this->user_model->editManager($userInfo, $userId);

                if ($result == true) {
                    $this->session->set_flashdata('success', '更新成功!');
                } else {
                    $this->session->set_flashdata('error', '更新失敗!');
                }

                $this->managerOld($userId);
                // redirect('user/managerListing');
            }
        }
    }

    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteUser()
    {
        if ($this->isAdmin() == TRUE) {
            echo (json_encode(array('status' => 'access')));
        } else {
            //這裏的post('userId')是common.js的jQuery.ajax.data
            $userId = $this->input->post('userId');
            $userInfo = array('isDeleted' => 1, 'updatedBy' => $this->vendorId, 'updatedDtm' => date('Y-m-d H:i:s'));

            $result = $this->user_model->deleteUser($userId, $userInfo);

            if ($result > 0) {
                echo (json_encode(array('status' => TRUE)));
            } else {
                echo (json_encode(array('status' => FALSE)));
            }
        }
    }

    function deleteManager()
    {
        if ($this->isManager() == TRUE) {
            echo (json_encode(array('status' => 'access')));
        } else {
            $newsid = $this->input->post('userId');
            $result = $this->user_model->deleteManager($newsid);

            if ($result > 0) {
                echo (json_encode(array('status' => TRUE)));
            } else {
                echo (json_encode(array('status' => FALSE)));
            }
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

    /**
     * This function used to show login history
     * @param number $userId : This is user id
     */
    function loginHistoy($userId = NULL)
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $userId = ($userId == NULL ? 0 : $userId);

            $searchText = $this->input->post('searchText');
            $fromDate = $this->input->post('fromDate');
            $toDate = $this->input->post('toDate');

            $data["userInfo"] = $this->user_model->getUserInfoById($userId);

            $data['searchText'] = $searchText;
            $data['fromDate'] = $fromDate;
            $data['toDate'] = $toDate;

            $count = $this->user_model->loginHistoryCount($userId, $searchText, $fromDate, $toDate);

            $returns = $this->paginationCompress("login-history/" . $userId . "/", $count, 10, 3);

            $data['userRecords'] = $this->user_model->loginHistory($userId, $searchText, $fromDate, $toDate, $returns["page"], $returns["segment"]);

            $this->global['pageTitle'] = 'CodeInsect : User Login History';

            $this->loadViews("loginHistory", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to show users profile
     */
    function profile($active = "details")
    {
        $data["userInfo"] = $this->user_model->getUserInfoWithRole($this->vendorId);
        $data["active"] = $active;

        $this->global['pageTitle'] = $active == "details" ? '我的檔案-修改資料' : '我的檔案-更改密碼';
        $this->loadViews("profile", $this->global, $data, NULL);
    }

    /**
     * This function is used to update the user details
     * @param text $active : This is flag to set the active tab
     */
    function profileUpdate($active = "details")
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('fname', '名稱', 'trim|required|max_length[128]');
        $this->form_validation->set_rules('mobile', '手機號碼', 'required|min_length[10]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[128]|callback_emailExists');

        if ($this->form_validation->run() == FALSE) {
            $this->profile($active);
        } else {
            $name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
            $mobile = $this->security->xss_clean($this->input->post('mobile'));
            $email = strtolower($this->security->xss_clean($this->input->post('email')));

            $userInfo = array('name' => $name, 'email' => $email, 'mobile' => $mobile, 'updatedBy' => $this->vendorId, 'updatedDtm' => date('Y-m-d H:i:s'));

            $result = $this->user_model->editUser($userInfo, $this->vendorId);

            if ($result == true) {
                $this->session->set_userdata('name', $name);
                $this->session->set_flashdata('success', '資料更新成功!');
            } else {
                $this->session->set_flashdata('error', '資料更新失敗!');
            }

            redirect('profile/' . $active);
        }
    }

    /**
     * This function is used to change the password of the user
     * @param text $active : This is flag to set the active tab
     */
    function changePassword($active = "changepass")
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('oldPassword', '舊密碼', 'required|max_length[20]');
        $this->form_validation->set_rules('newPassword', '新密碼', 'required|max_length[20]');
        $this->form_validation->set_rules('cNewPassword', '密碼確認', 'required|matches[newPassword]|max_length[20]');

        if ($this->form_validation->run() == FALSE) {
            $this->profile($active);
        } else {
            $oldPassword = $this->input->post('oldPassword');
            $newPassword = $this->input->post('newPassword');

            $resultPas = $this->user_model->matchOldPassword($this->vendorId, $oldPassword);

            if (empty($resultPas)) {
                $this->session->set_flashdata('nomatch', '你的舊密碼不正確!');
                redirect('profile/' . $active);
            } else {
                $usersData = array(
                    'password' => getHashedPassword($newPassword), 'updatedBy' => $this->vendorId,
                    'updatedDtm' => date('Y-m-d H:i:s')
                );

                $result = $this->user_model->changePassword($this->vendorId, $usersData);

                if ($result > 0) {
                    $this->session->set_flashdata('success', '密碼更新成功!');
                } else {
                    $this->session->set_flashdata('error', '密碼更新失敗!');
                }

                redirect('profile/' . $active);
            }
        }
    }

    /**
     * This function is used to check whether email already exist or not
     * @param {string} $email : This is users email
     */
    function emailExists($email)
    {
        $userId = $this->vendorId;
        $return = false;

        if (empty($userId)) {
            $result = $this->user_model->checkEmailExists($email);
        } else {
            $result = $this->user_model->checkEmailExists($email, $userId);
        }

        if (empty($result)) {
            $return = true;
        } else {
            $this->form_validation->set_message('emailExists', ' {field} 已經存在');
            $return = false;
        }

        return $return;
    }
}
