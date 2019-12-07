<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class News_model extends CI_Model
{
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function userListingCount($searchText = '')
    {
        // log_message('error', 'News_model userListingCount 有錯誤!');

        // $this->db->select('BaseTbl.newsid, BaseTbl.news_main_title, BaseTbl.news_sub_title,BaseTbl.news_date, BaseTbl.news_editor');
        $this->db->select('*');
        $this->db->from('press_release_news as BaseTbl');
        // $this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId', 'left');
        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.news_main_title  LIKE '%" . $searchText . "%'
                            OR  BaseTbl.news_sub_title  LIKE '%" . $searchText . "%'
                            OR  BaseTbl.news_date  LIKE '%" . $searchText . "%'
                            OR  BaseTbl.news_tag  LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        // $this->db->where('BaseTbl.isDeleted', 0);
        // $this->db->where('BaseTbl.roleId !=', 1);

        $query = $this->db->get();

        return $query->num_rows();
    }

    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function userListing($searchText = '', $page, $segment)
    {
        // log_message('error', 'News_model userListing 有錯誤!');

        // $this->db->select('BaseTbl.newsid, BaseTbl.news_main_title, BaseTbl.news_sub_title,BaseTbl.news_date, BaseTbl.news_editor');
        $this->db->select('*');
        $this->db->from('press_release_news as BaseTbl');
        // $this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId', 'left');
        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.news_main_title  LIKE '%" . $searchText . "%'
                            OR  BaseTbl.news_sub_title  LIKE '%" . $searchText . "%'
                            OR  BaseTbl.news_date  LIKE '%" . $searchText . "%'
                            OR  BaseTbl.news_tag  LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        // $this->db->where('BaseTbl.isDeleted', 0);
        // $this->db->where('BaseTbl.roleId !=', 1);
        $this->db->order_by('BaseTbl.newsid', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }

    /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewUser($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('press_release_news', $userInfo);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    function addNewsCheck($name)
    {
        $this->db->trans_start();

        $query = $this->db->query('SELECT `news_img` FROM `press_release_news` WHERE `news_img`="' . $name . '"');

        $this->db->trans_complete();

        return  $query->num_rows();
    }

    /**
     * This function used to get user information by id
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */
    function getUserInfo($userId)
    {
        $this->db->select('*');
        $this->db->from('press_release_news');
        // $this->db->where('isDeleted', 0);
        // $this->db->where('roleId !=', 1);
        $this->db->where('newsid', $userId);
        $query = $this->db->get();

        return $query->row();
    }

    /**
     * This function is used to update the user information
     * @param array $userInfo : This is users updated information
     * @param number $userId : This is user id
     */
    function editUser($userInfo, $userId)
    {
        $this->db->where('newsid', $userId);
        $this->db->update('press_release_news', $userInfo);

        return TRUE;
    }

    function editUserCheck($name)
    {
        $this->db->trans_start();
        $this->db->select('*');
        $this->db->from('press_release_news');
        $this->db->where('news_img', $name);

        $query = $this->db->get();

        $this->db->trans_complete();

        return  $query->num_rows();
    }

    function newsname_check($name, $id = null, $isEdit)
    {
        $this->db->trans_start();
        $this->db->select('*');
        $this->db->from('press_release_news');
        $this->db->where('news_main_title', $name);

        if ($isEdit) {
            $this->db->where('newsid !=', $id);
        }

        $query = $this->db->get();

        $this->db->trans_complete();

        return  $query->num_rows();
    }

    function messagename_check($name, $id = null, $isEdit)
    {
        $this->db->trans_start();
        $this->db->select('*');
        $this->db->from('press_release_message');
        $this->db->where('main_title', $name);

        if ($isEdit) {
            $this->db->where('mesid !=', $id);
        }

        $query = $this->db->get();

        $this->db->trans_complete();

        return  $query->num_rows();
    }

    function recordname_check($name, $id = null, $isEdit)
    {
        $this->db->trans_start();
        $this->db->select('*');
        $this->db->from('press_release_records');
        $this->db->where('main_title', $name);

        if ($isEdit) {
            $this->db->where('recordid !=', $id);
        }

        $query = $this->db->get();

        $this->db->trans_complete();

        return  $query->num_rows();
    }

    function editUserDelete($userId)
    {
        $this->db->select('*');
        $this->db->from('press_release_news');
        $this->db->where('newsid', $userId);
        $query = $this->db->get();

        return $query->row();
    }

    /**
     * This function is used to delete the user information
     * @param number $userId : This is user id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteUser($newsid)
    {
        $this->db->where('newsid', $newsid);
        $this->db->delete('press_release_news');

        // $this->db->update('press_release_news', $userInfo);

        return $this->db->affected_rows();
    }

    // 以下爲公告訊息
    function messageListingCount($searchText = '')
    {
        // $this->db->select('BaseTbl.newsid, BaseTbl.news_main_title, BaseTbl.news_sub_title,BaseTbl.news_date, BaseTbl.news_editor');
        $this->db->select('*');
        $this->db->from('press_release_message as BaseTbl');
        // $this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId', 'left');
        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.main_title  LIKE '%" . $searchText . "%'
                            OR  BaseTbl.sub_title  LIKE '%" . $searchText . "%'
                            OR  BaseTbl.date  LIKE '%" . $searchText . "%'
                            OR  BaseTbl.tag  LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        // $this->db->where('BaseTbl.isDeleted', 0);
        // $this->db->where('BaseTbl.roleId !=', 1);

        $query = $this->db->get();

        return $query->num_rows();
    }

    function messageListing($searchText = '', $page, $segment)
    {
        // $this->db->select('BaseTbl.newsid, BaseTbl.news_main_title, BaseTbl.news_sub_title,BaseTbl.news_date, BaseTbl.news_editor');
        $this->db->select('*');
        $this->db->from('press_release_message as BaseTbl');
        // $this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId', 'left');
        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.main_title  LIKE '%" . $searchText . "%'
                            OR  BaseTbl.sub_title  LIKE '%" . $searchText . "%'
                            OR  BaseTbl.date  LIKE '%" . $searchText . "%'
                            OR  BaseTbl.tag  LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        // $this->db->where('BaseTbl.isDeleted', 0);
        // $this->db->where('BaseTbl.roleId !=', 1);
        $this->db->order_by('BaseTbl.mesid', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }

    function getMessageInfo($userId)
    {
        $this->db->select('*');
        $this->db->from('press_release_message');
        // $this->db->where('isDeleted', 0);
        // $this->db->where('roleId !=', 1);
        $this->db->where('mesid', $userId);
        $query = $this->db->get();

        return $query->row();
    }

    function editMessageCheck($name)
    {
        $this->db->trans_start();
        $this->db->select('*');
        $this->db->from('press_release_message');
        $this->db->where('img', $name);

        $query = $this->db->get();

        $this->db->trans_complete();

        return  $query->num_rows();
    }

    function editMessageDelete($userId)
    {
        $this->db->select('*');
        $this->db->from('press_release_message');
        $this->db->where('mesid', $userId);
        $query = $this->db->get();

        return $query->row();
    }

    function deleteMessage($newsid)
    {
        $this->db->where('mesid', $newsid);
        $this->db->delete('press_release_message');

        return $this->db->affected_rows();
    }

    function addNewMessage($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('press_release_message', $userInfo);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    function addMessageCheck($name)
    {
        $this->db->trans_start();

        $query = $this->db->query('SELECT `img` FROM `press_release_message` WHERE `img`="' . $name . '"');

        $this->db->trans_complete();

        return  $query->num_rows();
    }

    function editMessage($userInfo, $userId)
    {
        $this->db->where('mesid', $userId);
        $this->db->update('press_release_message', $userInfo);

        return TRUE;
    }

    // 以下爲活動記錄
    function recordsListingCount($searchText = '')
    {
        // $this->db->select('BaseTbl.newsid, BaseTbl.news_main_title, BaseTbl.news_sub_title,BaseTbl.news_date, BaseTbl.news_editor');
        $this->db->select('*');
        $this->db->from('press_release_records as BaseTbl');
        // $this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId', 'left');
        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.main_title  LIKE '%" . $searchText . "%'
                            OR  BaseTbl.sub_title  LIKE '%" . $searchText . "%'
                            OR  BaseTbl.date  LIKE '%" . $searchText . "%'
                            OR  BaseTbl.tag  LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        // $this->db->where('BaseTbl.isDeleted', 0);
        // $this->db->where('BaseTbl.roleId !=', 1);

        $query = $this->db->get();

        return $query->num_rows();
    }

    function recordsListing($searchText = '', $page, $segment)
    {
        // $this->db->select('BaseTbl.newsid, BaseTbl.news_main_title, BaseTbl.news_sub_title,BaseTbl.news_date, BaseTbl.news_editor');
        $this->db->select('*');
        $this->db->from('press_release_records as BaseTbl');
        // $this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId', 'left');
        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.main_title  LIKE '%" . $searchText . "%'
                            OR  BaseTbl.sub_title  LIKE '%" . $searchText . "%'
                            OR  BaseTbl.date  LIKE '%" . $searchText . "%'
                            OR  BaseTbl.tag  LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        // $this->db->where('BaseTbl.isDeleted', 0);
        // $this->db->where('BaseTbl.roleId !=', 1);
        $this->db->order_by('BaseTbl.recordid', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }

    function addNewRecords($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('press_release_records', $userInfo);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    function addRecordCheck($name)
    {
        $this->db->trans_start();

        $query = $this->db->query('SELECT `img` FROM `press_release_records` WHERE `img`="' . $name . '"');

        $this->db->trans_complete();

        return  $query->num_rows();
    }

    function editRecordsDelete($userId)
    {
        $this->db->select('*');
        $this->db->from('press_release_records');
        $this->db->where('recordid', $userId);
        $query = $this->db->get();

        return $query->row();
    }

    function deleteRecords($newsid)
    {
        $this->db->where('recordid', $newsid);
        $this->db->delete('press_release_records');

        return $this->db->affected_rows();
    }

    function getRecordsInfo($userId)
    {
        $this->db->select('*');
        $this->db->from('press_release_records');
        // $this->db->where('isDeleted', 0);
        // $this->db->where('roleId !=', 1);
        $this->db->where('recordid', $userId);
        $query = $this->db->get();

        return $query->row();
    }

    function editRecords($userInfo, $userId)
    {
        $this->db->where('recordid', $userId);
        $this->db->update('press_release_records', $userInfo);

        return TRUE;
    }

    function editRecordsCheck($name)
    {
        $this->db->trans_start();
        $this->db->select('*');
        $this->db->from('press_release_records');
        $this->db->where('img', $name);

        $query = $this->db->get();

        $this->db->trans_complete();

        return  $query->num_rows();
    }

    /**
     * 新聞訊息的標籤
     */
    function tagsCheck($name, $id)
    {
        $this->db->trans_start();
        $this->db->select(); // 空白預設爲*
        $this->db->from('tags');
        $this->db->where('name', $name);
        if ($id != '') {
            $this->db->where('tagsid !=', $id);
        }

        $query = $this->db->get();

        $this->db->trans_complete();

        return  $query->num_rows();
    }

    function tagsListingCount($searchText = '')
    {
        $this->db->select('*');
        $this->db->from('tags as BaseTbl');
        if (!empty($searchText)) {
            // $likeCriteria = "(BaseTbl.title LIKE '%" . $searchText . "%' OR BaseTbl.date  LIKE '%" . $searchText . "%')";
            $likeCriteria = "(BaseTbl.name LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }

        $query = $this->db->get();

        return $query->num_rows();
    }

    function tagsListing($searchText = '', $page, $segment)
    {
        $this->db->select('*');
        $this->db->from('tags as BaseTbl');
        if (!empty($searchText)) {
            // $likeCriteria = "(BaseTbl.title LIKE '%" . $searchText . "%' OR  BaseTbl.date  LIKE '%" . $searchText . "%')";
            $likeCriteria = "(BaseTbl.name LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        $this->db->order_by('BaseTbl.tagsid', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }

    function tagsAddSend($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tags', $userInfo);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    function tagsEditSend($userInfo, $userId)
    {
        $this->db->where('tagsid', $userId);
        $this->db->update('tags', $userInfo);

        return TRUE;
    }

    function getTagsEditInfo($id)
    {
        $this->db->select('*');
        $this->db->from('tags');
        $this->db->where('tagsid', $id);

        $query = $this->db->get();

        return $query->row();
    }

    function deleteNewsTag($newsid)
    {
        $this->db->where('tagsid', $newsid);
        $this->db->delete('tags');

        return $this->db->affected_rows();
    }

    function getTagsInfo()
    {
        $this->db->select('*');
        $this->db->from('tags as BaseTbl');
        // $this->db->order_by('BaseTbl.tagsid', 'DESC');
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
}
