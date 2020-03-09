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

    // 黨員
    public function listingCount($searchText = '')
    {
        // log_message('error', 'News_model listingCount 有錯誤!');
        $this->db->select();

        $this->db->from('members as m');

        if (!empty($searchText)) {
            $likeCriteria = "(m.name  LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }

        $query = $this->db->get();

        return $query->num_rows();
    }

    public function listing($searchText = '', $page, $segment)
    {
        $this->db->select();

        $this->db->from('members as m');

        if (!empty($searchText)) {
            $likeCriteria = "(m.name  LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }

        $this->db->order_by('m.sort', 'ASC');
        $this->db->limit($page, $segment);

        $query  = $this->db->get();
        $result = $query->result();

        return $result;
    }

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

    // members新增
    public function membersAdd($info)
    {
        $this->db->trans_start();
        $this->db->insert('members', $info);

        $insert_id = $this->db->insert_id();

        $sql   = "UPDATE `members` SET `sort` = (SELECT MAX(sort) FROM `members`)+1 WHERE `memid` = $insert_id";
        $query = $this->db->query($sql);

        $this->db->trans_complete();

        return $insert_id;
    }

    // 其它members相依新增
    public function members_mem_add($memInfo, $num)
    {
        $this->db->trans_start();

        if ($num == 1) {
            $this->db->insert_batch('mem_years', $memInfo);
        } else if ($num == 2) {
            $this->db->insert_batch('mem_issuesclass', $memInfo);
        } else {
            $this->db->insert_batch('mem_cont_records', $memInfo);
        }

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    // 屆期
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

    // 聯絡方式列表
    public function getContactList()
    {
        $this->db->select();
        $this->db->from('contact_list as cl');

        $this->db->order_by('cl.con_id', 'ASC');
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

    //  屆期 add edit
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

    // members add edit
    public function name_check($name, $id)
    {
        $this->db->trans_start();
        $this->db->select();
        $this->db->from('members');
        $this->db->where('name', $name);

        if ($id != '') {
            $this->db->where('memid !=', $id);
        }

        $query = $this->db->get();

        $this->db->trans_complete();

        return $query->num_rows();
    }

    public function img_check($img)
    {
        $this->db->trans_start();
        $this->db->select('img');
        $this->db->from('members');
        $this->db->where('img', $img);

        $query = $this->db->get();

        $this->db->trans_complete();

        return $query->num_rows();
    }

    // 編輯網址防禦
    public function editProtectCheck($id, $item = '')
    {
        $this->db->trans_start();

        if ($item == 'years') {
            $this->db->select('yid');
            $this->db->from('years');
            $this->db->where('yid', $id);
        }

        if ($item == '') {
            # code...
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

/*
..######..########.##.......########..######..########.####.########.########
.##....##.##.......##.......##.......##....##....##.....##.......##..##......
.##.......##.......##.......##.......##..........##.....##......##...##......
..######..######...##.......######...##..........##.....##.....##....######..
.......##.##.......##.......##.......##..........##.....##....##.....##......
.##....##.##.......##.......##.......##....##....##.....##...##......##......
..######..########.########.########..######.....##....####.########.########
 */

    // membersAdd
    public function getYearsList()
    {
        $this->db->select();
        $this->db->from('years as y');
        $this->db->where('showup', 1);

        // $this->db->order_by('BaseTbl.tags_id', 'DESC');
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }

    // membersAdd
    public function getIssuesList()
    {
        $this->db->select();
        $this->db->from('issues as i');
        $this->db->where('showup', 1);

        // $this->db->order_by('BaseTbl.tags_id', 'DESC');
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
}
