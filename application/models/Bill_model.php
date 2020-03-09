<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Bill_model extends CI_Model
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

    // 議題
    public function issuesClassListingCount($searchText = '')
    {
        $this->db->select();
        $this->db->from('issues_class as BaseTbl');

        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.name LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }

        $query = $this->db->get();

        return $query->num_rows();
    }

    public function issuesClassListing($isSort, $searchText = '', $page = 0, $segment = 0)
    {
        $this->db->select();
        $this->db->from('issues_class as ic');

        if (!empty($searchText)) {
            $likeCriteria = "(ic.name LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }

        $this->db->order_by('ic.sort', 'ASC');

        if (!$isSort) {
            $this->db->limit($page, $segment);
        }

        $query  = $this->db->get();
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

    // 議題
    public function getIssuesClassInfo($id)
    {
        $this->db->select();
        $this->db->from('issues_class');
        $this->db->where('ic_id', $id);

        $query = $this->db->get();

        return $query->row();
    }

    public function issuesClassEditSend($userInfo, $id)
    {
        $this->db->where('ic_id', $id);
        $this->db->update('issues_class', $userInfo);

        return true;
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

    // 輪播 - sort
    public function sort($sort)
    {
        foreach ($sort as $k => $v) {
            $k++;
            $sql   = "UPDATE `issues_class` SET `sort` = $k WHERE `ic_id` = $v";
            $query = $this->db->query($sql);
        }

        return true;
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

    public function issuesClassAddSend($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('issues_class', $userInfo);

        $insert_id = $this->db->insert_id();

        $sql   = "UPDATE `issues_class` SET `sort` = (SELECT MAX(sort) FROM `issues_class`)+1 WHERE `ic_id` = $insert_id";
        $query = $this->db->query($sql);

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

    public function deleteIssuesClass($id)
    {
        $this->db->where('ic_id', $id);
        $this->db->delete('issues_class');

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

    // 編輯網址防禦
    public function editProtectCheck($id, $item = '')
    {
        $this->db->trans_start();

        if ($item == 'issues-class') {
            $this->db->select('ic_id');
            $this->db->from('issues_class');
            $this->db->where('ic_id', $id);
        }

        if ($item == '') {
            # code...
        }

        $query = $this->db->get();

        $this->db->trans_complete();

        return $query->num_rows();
    }

    // 議題 add edit
    public function issuesClass_check($name, $id)
    {
        $this->db->trans_start();
        $this->db->select();
        $this->db->from('issues_class');
        $this->db->where('name', $name);
        if ($id != '') {
            $this->db->where('ic_id !=', $id);
        }

        $query = $this->db->get();

        $this->db->trans_complete();

        return $query->num_rows();
    }
}
