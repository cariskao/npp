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

    public function yearsListing($isSort, $searchText = '', $page = 0, $segment = 0)
    {
        $this->db->select();
        $this->db->from('years as y');

        if (!empty($searchText)) {
            $likeCriteria = "(y.title LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }

        $this->db->order_by('y.sort', 'ASC');

        if (!$isSort) {
            $this->db->limit($page, $segment);
        }

        $query  = $this->db->get();
        $result = $query->result();

        return $result;
    }

/*
....###....########..########.
...##.##...##.....##.##.....##
..##...##..##.....##.##.....##
.##.....##.##.....##.##.....##
.#########.##.....##.##.....##
.##.....##.##.....##.##.....##
.##.....##.########..########.
 */

    public function yearsAddSend($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('years', $userInfo);

        $insert_id = $this->db->insert_id();

        $sql   = "UPDATE `years` SET `sort` = (SELECT MAX(sort) FROM `years`)+1 WHERE `yid` = $insert_id";
        $query = $this->db->query($sql);

        $this->db->trans_complete();

        return $insert_id;
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

    public function getYearInfo($id)
    {
        $this->db->select();
        $this->db->from('years');
        $this->db->where('yid', $id);

        $query = $this->db->get();

        return $query->row();
    }

    public function yearsEditSend($userInfo, $id)
    {
        $this->db->where('yid', $id);
        $this->db->update('years', $userInfo);

        return true;
    }

/*
.########..########.##.......########.########.########
.##.....##.##.......##.......##..........##....##......
.##.....##.##.......##.......##..........##....##......
.##.....##.######...##.......######......##....######..
.##.....##.##.......##.......##..........##....##......
.##.....##.##.......##.......##..........##....##......
.########..########.########.########....##....########
 */

    public function deleteYears($id)
    {
        $this->db->where('yid', $id);
        $this->db->delete('years');

        return $this->db->affected_rows();
    }

    /*
    ..######..##.....##.########..######..##....##
    .##....##.##.....##.##.......##....##.##...##.
    .##.......##.....##.##.......##.......##..##..
    .##.......#########.######...##.......#####...
    .##.......##.....##.##.......##.......##..##..
    .##....##.##.....##.##.......##....##.##...##.
    ..######..##.....##.########..######..##....##
     */

    public function years_check($name, $id)
    {
        $this->db->trans_start();
        $this->db->select();
        $this->db->from('years');
        $this->db->where('title', $name);
        if ($id != '') {
            $this->db->where('yid !=', $id);
        }

        $query = $this->db->get();

        $this->db->trans_complete();

        return $query->num_rows();
    }

    // 網址防禦
    public function editProtectCheck($id, $isYear = false)
    {
        $this->db->trans_start();

        if ($isYear) {
            $this->db->select('yid');
            $this->db->from('years');
            $this->db->where('yid', $id);
        } else {

        }

        $query = $this->db->get();

        $this->db->trans_complete();

        return $query->num_rows();
    }

    /*
    ..######...#######..########..########
    .##....##.##.....##.##.....##....##...
    .##.......##.....##.##.....##....##...
    ..######..##.....##.########.....##...
    .......##.##.....##.##...##......##...
    .##....##.##.....##.##....##.....##...
    ..######...#######..##.....##....##...
     */

    // 屆期排序select
    public function carouselListing($isSort, $searchText = '', $page = 0, $segment = 0)
    {
        $this->db->select();
        $this->db->from('carousel as BaseTbl');

        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.title LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }

        $this->db->order_by('BaseTbl.sort', 'ASC');

        if (!$isSort) {
            $this->db->limit($page, $segment);
        }

        $query  = $this->db->get();
        $result = $query->result();

        return $result;
    }

    // 屆期排序update
    public function sort($sort)
    {
        foreach ($sort as $k => $v) {
            $k++;
            $sql   = "UPDATE `years` SET `sort` = $k WHERE `yid` = $v";
            $query = $this->db->query($sql);
        }

        return true;
    }
}
