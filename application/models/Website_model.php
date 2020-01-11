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

    function carouseUpdate($userInfo)
    {
        $this->db->where('set_id', 1);
        $this->db->update('setup', $userInfo);

        return TRUE;
    }
}
