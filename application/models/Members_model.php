<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Members_model extends CI_Model
{

/*
.##.......####..######..########..######.
.##........##..##....##....##....##....##
.##........##..##..........##....##......
.##........##...######.....##.....######.
.##........##........##....##..........##
.##........##..##....##....##....##....##
.########.####..######.....##.....######.
 */
    // 屆期
    public function yearsListingCount($searchText = '')
    {
        $this->db->select();
        $this->db->from('years as BaseTbl');

        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.title LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }

        $query = $this->db->get();

        return $query->num_rows();
    }

    public function yearsListing($searchText = '', $page, $segment)
    {
        $this->db->select();
        $this->db->from('years as BaseTbl');

        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.title LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }

        $this->db->order_by('BaseTbl.yid', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
}
