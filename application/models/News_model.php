<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class News_model extends CI_Model
{
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */

    /*
##       ####  ######  ########
##        ##  ##    ##    ##
##        ##  ##          ##
##        ##   ######     ##
##        ##        ##    ##
##        ##  ##    ##    ##
######## ####  ######     ##
*/

    // 最新新聞-算頁數
    function userListingCount($searchText = '')
    {
        // log_message('error', 'News_model userListingCount 有錯誤!');

        // $this->db->select('SELECT * FROM press_release BaseTbl WHERE BaseTbl.pr_type_id=1');
        $this->db->select('*');
        $this->db->from('press_release as BaseTbl');
        // $this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId', 'left');

        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.main_title  LIKE '%" . $searchText . "%'
            OR  BaseTbl.sub_title  LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        // $this->db->where('BaseTbl.isDeleted', 0);
        // $this->db->where('BaseTbl.roleId !=', 1);
        $this->db->where('BaseTbl.pr_type_id', 1);

        $query = $this->db->get();

        return $query->num_rows();
    }

    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     * 最新新聞-算總項目
     */
    function userListing($searchText = '', $page, $segment)
    {
        // log_message('error', 'News_model userListing 有錯誤!');

        $this->db->select('*');
        $this->db->from('press_release as BaseTbl');
        // $this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId', 'left');
        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.main_title  LIKE '%" . $searchText . "%'
            OR  BaseTbl.sub_title  LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        // $this->db->where('BaseTbl.isDeleted', 0);
        // $this->db->where('BaseTbl.roleId !=', 1);
        $this->db->where('BaseTbl.pr_type_id', 1);

        $this->db->order_by('BaseTbl.pr_id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }

    // 公告訊息-算頁數
    function messageListingCount($searchText = '')
    {
        $this->db->select('*');
        $this->db->from('press_release as BaseTbl');
        // $this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId', 'left');
        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.main_title  LIKE '%" . $searchText . "%'
            OR  BaseTbl.sub_title  LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        // $this->db->where('BaseTbl.isDeleted', 0);
        // $this->db->where('BaseTbl.roleId !=', 1);
        $this->db->where('BaseTbl.pr_type_id', 2);

        $query = $this->db->get();

        return $query->num_rows();
    }

    // 公告訊息-算總項目
    function messageListing($searchText = '', $page, $segment)
    {
        $this->db->select('*');
        $this->db->from('press_release as BaseTbl');
        // $this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId', 'left');
        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.main_title  LIKE '%" . $searchText . "%'
            OR  BaseTbl.sub_title  LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        // $this->db->where('BaseTbl.isDeleted', 0);
        // $this->db->where('BaseTbl.roleId !=', 1);
        $this->db->where('BaseTbl.pr_type_id', 2);
        $this->db->order_by('BaseTbl.pr_id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }

    // 活動記錄-算頁數
    function recordsListingCount($searchText = '')
    {
        $this->db->select('*');
        $this->db->from('press_release as BaseTbl');
        // $this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId', 'left');

        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.main_title  LIKE '%" . $searchText . "%'
            OR  BaseTbl.sub_title  LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        // $this->db->where('BaseTbl.isDeleted', 0);
        // $this->db->where('BaseTbl.roleId !=', 1);
        $this->db->where('BaseTbl.pr_type_id', 3);

        $query = $this->db->get();

        return $query->num_rows();
    }

    // 活動記錄-算總項目
    function recordsListing($searchText = '', $page, $segment)
    {
        $this->db->select('*');
        $this->db->from('press_release as BaseTbl');
        // $this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId', 'left');

        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.main_title  LIKE '%" . $searchText . "%'
            OR  BaseTbl.sub_title  LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        // $this->db->where('BaseTbl.isDeleted', 0);
        // $this->db->where('BaseTbl.roleId !=', 1);
        $this->db->where('BaseTbl.pr_type_id', 3);
        $this->db->order_by('BaseTbl.pr_id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }

    /*
.########.########..####.########
.##.......##.....##..##.....##...
.##.......##.....##..##.....##...
.######...##.....##..##.....##...
.##.......##.....##..##.....##...
.##.......##.....##..##.....##...
.########.########..####....##...
*/

    /**
     * This function used to get user information by id
     * @param number $userId : This is user id
     * @return array $result : This is user information
     * get news info
     */
    function getUserInfo($userId)
    {
        $this->db->select('*');
        $this->db->from('press_release');
        // $this->db->where('isDeleted', 0);
        // $this->db->where('roleId !=', 1);
        $this->db->where('pr_id', $userId);
        $query = $this->db->get();

        return $query->row();
    }

    /**
     * This function is used to update the user information
     * @param array $userInfo : This is users updated information
     * @param number $userId : This is user id
     * update news data
     */
    function editUser($userInfo, $userId)
    {
        $this->db->where('pr_id', $userId);
        $this->db->update('press_release', $userInfo);

        return TRUE;
    }

    function getMessageInfo($userId)
    {
        $this->db->select('*');
        $this->db->from('press_release');
        // $this->db->where('isDeleted', 0);
        // $this->db->where('roleId !=', 1);
        $this->db->where('pr_id', $userId);
        $query = $this->db->get();

        return $query->row();
    }

    function editMessage($userInfo, $userId)
    {
        $this->db->where('pr_id', $userId);
        $this->db->update('press_release', $userInfo);

        return TRUE;
    }

    function getRecordsInfo($userId)
    {
        $this->db->select(); // 代表*
        $this->db->from('press_release');
        // $this->db->where('isDeleted', 0);
        // $this->db->where('roleId !=', 1);
        $this->db->where('pr_id', $userId);
        $query = $this->db->get();

        return $query->row();
    }

    function editRecords($userInfo, $userId)
    {
        $this->db->where('recordid', $userId);
        $this->db->update('press_release_records', $userInfo);

        return TRUE;
    }

    /*
 ######  ##     ## ########  ######  ##    ##
##    ## ##     ## ##       ##    ## ##   ##
##       ##     ## ##       ##       ##  ##
##       ######### ######   ##       #####
##       ##     ## ##       ##       ##  ##
##    ## ##     ## ##       ##    ## ##   ##
 ######  ##     ## ########  ######  ##    ##
*/

    // check add 最新新聞圖片名稱有無重複
    function addNewsCheck($name)
    {
        $this->db->trans_start();
        $this->db->select('img');
        $this->db->from('press_release');
        $this->db->where('img', $name);
        $this->db->where('pr_type_id', 1);

        $query = $this->db->get();

        $this->db->trans_complete();

        return  $query->num_rows();
    }

    // check edit 最新新聞圖片名稱有無重複
    function editUserCheck($name)
    {
        $this->db->trans_start();
        $this->db->select('img');
        $this->db->from('press_release');
        $this->db->where('img', $name);
        $this->db->where('pr_type_id', 1);

        $query = $this->db->get();

        $this->db->trans_complete();

        return  $query->num_rows();
    }

    // check最新新聞的大標名稱有無重複
    function newsname_check($name, $id = null, $isEdit)
    {
        $this->db->trans_start();
        $this->db->select('main_title');
        $this->db->from('press_release');
        $this->db->where('main_title', $name);
        $this->db->where('pr_type_id', 1);

        if ($isEdit) {
            $this->db->where('pr_id !=', $id);
        }

        $query = $this->db->get();

        $this->db->trans_complete();

        return  $query->num_rows();
    }

    // check訊息公告的大標名稱有無重複
    function messagename_check($name, $id = null, $isEdit)
    {
        $this->db->trans_start();
        $this->db->select('main_title');
        $this->db->from('press_release');
        $this->db->where('main_title', $name);
        $this->db->where('pr_type_id', 2);

        if ($isEdit) {
            $this->db->where('pr_id !=', $id);
        }

        $query = $this->db->get();

        $this->db->trans_complete();

        return  $query->num_rows();
    }

    function recordname_check($name, $id = null, $isEdit)
    {
        $this->db->trans_start();
        $this->db->select('main_title');
        $this->db->from('press_release');
        $this->db->where('main_title', $name);
        $this->db->where('pr_type_id', 3);

        if ($isEdit) {
            $this->db->where('pr_id !=', $id);
        }

        $query = $this->db->get();

        $this->db->trans_complete();

        return  $query->num_rows();
    }

    // check edit 訊息公告圖片名稱有無重複
    function editMessageCheck($name)
    {
        $this->db->trans_start();
        $this->db->select('img');
        $this->db->from('press_release');
        $this->db->where('img', $name);
        $this->db->where('pr_type_id', 2);

        $query = $this->db->get();

        $this->db->trans_complete();

        return  $query->num_rows();
    }

    // check訊息公告的圖片名稱有無重複
    function addMessageCheck($name)
    {
        $this->db->trans_start();
        $this->db->select('img');
        $this->db->from('press_release');
        $this->db->where('img', $name);
        $this->db->where('pr_type_id', 2);

        $query = $this->db->get();

        $this->db->trans_complete();

        return  $query->num_rows();
    }

    function addRecordCheck($name)
    {
        $this->db->trans_start();
        $this->db->select('img');
        $this->db->from('press_release');
        $this->db->where('img', $name);
        $this->db->where('pr_type_id', 3);

        $query = $this->db->get();

        $this->db->trans_complete();

        return  $query->num_rows();
    }

    function editRecordsCheck($name)
    {
        $this->db->trans_start();
        $this->db->select('img');
        $this->db->from('press_release');
        $this->db->where('img', $name);
        $this->db->where('pr_type_id', 3);

        $query = $this->db->get();

        $this->db->trans_complete();

        return  $query->num_rows();
    }

    /*
   ###    ########  ########
  ## ##   ##     ## ##     ##
 ##   ##  ##     ## ##     ##
##     ## ##     ## ##     ##
######### ##     ## ##     ##
##     ## ##     ## ##     ##
##     ## ########  ########
*/

    /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewUser($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('press_release', $userInfo);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    function addNewMessage($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('press_release', $userInfo);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    function addNewRecords($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('press_release', $userInfo);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    /*
########  ######## ##       ######## ######## ########
##     ## ##       ##       ##          ##    ##
##     ## ##       ##       ##          ##    ##
##     ## ######   ##       ######      ##    ######
##     ## ##       ##       ##          ##    ##
##     ## ##       ##       ##          ##    ##
########  ######## ######## ########    ##    ########
*/

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


    /*
########    ###     ######
    ##      ## ##   ##    ##
    ##     ##   ##  ##
    ##    ##     ## ##   ####
    ##    ######### ##    ##
    ##    ##     ## ##    ##
    ##    ##     ##  ######
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
