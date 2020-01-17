<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Website_model extends CI_Model
{
    /*
##       ####  ######  ########
##        ##  ##    ##    ##
##        ##  ##          ##
##        ##   ######     ##
##        ##        ##    ##
##        ##  ##    ##    ##
######## ####  ######     ##
*/

    // 標籤
    function carouselListCount($searchText = '')
    {
        $this->db->select();
        $this->db->from('carousel as BaseTbl');

        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.title LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }

        $query = $this->db->get();

        return $query->num_rows();
    }

    function carouselListing($searchText = '', $page, $segment)
    {
        $this->db->select();
        $this->db->from('carousel as BaseTbl');

        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.title LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }

        $this->db->order_by('BaseTbl.id', 'DESC');
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

    // 其它設定
    function getSetupInfo()
    {
        $this->db->select();
        $this->db->from('setup');
        $this->db->where('set_id', 1);
        $query = $this->db->get();

        return $query->row();
    }

    function setupUpdate($userInfo)
    {
        $this->db->where('set_id', 1);
        $this->db->update('setup', $userInfo);

        return TRUE;
    }

    // 輪播
    function getCarouselInfo($id)
    {
        $this->db->select();
        $this->db->from('carousel');
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    function carouselUpdate($userInfo, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('carousel', $userInfo);

        return TRUE;
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

    function carouselAdd($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('carousel', $userInfo);

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

    // 輪播update時將舊的圖片刪除,先獲取圖片名稱
    function imgNameRepeatDel($id)
    {
        $this->db->select('img');
        $this->db->from('carousel');
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    // 輪播
    function deleteCarousel($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('carousel');

        return $this->db->affected_rows();
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

    // 網址防禦
    function editProtectCheck($id)
    {
        $this->db->trans_start();

        $this->db->select('id');
        $this->db->from('carousel');
        $this->db->where('id', $id);

        $query = $this->db->get();

        $this->db->trans_complete();

        return  $query->num_rows();
    }

    // 輪播
    function carouselTitleCheck($id = '', $title)
    {
        $this->db->trans_start();
        $this->db->select('title');
        $this->db->from('carousel');
        $this->db->where('title', $title);

        if ($id != '') {
            $this->db->where('id !=', $id);
        }

        $query = $this->db->get();

        $this->db->trans_complete();

        return  $query->num_rows();
    }

    function carouselImgCheck($imgName)
    {
        $this->db->trans_start();
        $this->db->select('img');
        $this->db->from('carousel');
        $this->db->where('img', $imgName);

        $query = $this->db->get();

        $this->db->trans_complete();

        return  $query->num_rows();
    }
}
