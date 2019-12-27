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

    // 標籤
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

    /*
.########.########..####.########
.##.......##.....##..##.....##...
.##.......##.....##..##.....##...
.######...##.....##..##.....##...
.##.......##.....##..##.....##...
.##.......##.....##..##.....##...
.########.########..####....##...
*/

    function getPressReleaseInfo($id)
    {
        $this->db->select();
        $this->db->from('press_release');
        // $this->db->where('isDeleted', 0);
        // $this->db->where('roleId !=', 1);
        $this->db->where('pr_id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    function pressReleaseUpdate($userInfo, $id)
    {
        $this->db->where('pr_id', $id);
        $this->db->update('press_release', $userInfo);

        return TRUE;
    }

    function tagsEditSend($userInfo, $userId)
    {
        $this->db->where('tagsid', $userId);
        $this->db->update('tags', $userInfo);

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

    function imgNameCheck($imgName, $type = 1)
    {
        $this->db->trans_start();
        $this->db->select('img');
        $this->db->from('press_release');
        $this->db->where('img', $imgName);
        $this->db->where('pr_type_id', $type);

        // if ($pr_id != "") {
        //     $this->db->where('pr_id !=', $pr_id);
        // }

        $query = $this->db->get();

        $this->db->trans_complete();

        return  $query->num_rows();
    }

    function mainTitleCheck($name, $type, $mode, $id)
    {
        $this->db->trans_start();
        $this->db->select('main_title');
        $this->db->from('press_release');
        $this->db->where('main_title', $name);
        $this->db->where('pr_type_id', $type);

        if ($mode == 2) {
            $this->db->where('pr_id !=', $id);
        }

        $query = $this->db->get();

        $this->db->trans_complete();

        return  $query->num_rows();
    }

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

    /*
   ###    ########  ########
  ## ##   ##     ## ##     ##
 ##   ##  ##     ## ##     ##
##     ## ##     ## ##     ##
######### ##     ## ##     ##
##     ## ##     ## ##     ##
##     ## ########  ########
*/

    function pressReleaseAdd($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('press_release', $userInfo);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    function tagsAddSend($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tags', $userInfo);

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

    // 新聞訊息update時將舊的圖片刪除,先獲取圖片名稱
    function imgNameRepeatDel($id)
    {
        $this->db->select();
        $this->db->from('press_release');
        $this->db->where('pr_id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    /**
     * This function is used to delete the user information
     * @param number $userId : This is user id
     * @return boolean $result : TRUE / FALSE
     * 刪除新聞訊息列表
     */
    function deleteList($id)
    {
        $this->db->where('pr_id', $id);
        $this->db->delete('press_release');

        return $this->db->affected_rows();
    }

    // 刪除標籤列表
    function deleteNewsTag($id)
    {
        $this->db->where('tagsid', $id);
        $this->db->delete('tags');

        return $this->db->affected_rows();
    }

    /*
########    ###     ######           ########  ##       ##     ##  ######   #### ##    ##
    ##      ## ##   ##    ##          ##     ## ##       ##     ## ##    ##   ##  ###   ##
    ##     ##   ##  ##                ##     ## ##       ##     ## ##         ##  ####  ##
    ##    ##     ## ##   #### ####### ########  ##       ##     ## ##   ####  ##  ## ## ##
    ##    ######### ##    ##          ##        ##       ##     ## ##    ##   ##  ##  ####
    ##    ##     ## ##    ##          ##        ##       ##     ## ##    ##   ##  ##   ###
    ##    ##     ##  ######           ##        ########  #######   ######   #### ##    ##
*/

    function getTagsEditInfo($id)
    {
        $this->db->select('*');
        $this->db->from('tags');
        $this->db->where('tagsid', $id);

        $query = $this->db->get();

        return $query->row();
    }

    function getTagsList()
    {
        $this->db->select('*');
        $this->db->from('tags as BaseTbl');
        $this->db->where('showup', 1);

        // $this->db->order_by('BaseTbl.tagsid', 'DESC');
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
}
