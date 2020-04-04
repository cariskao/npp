<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Members_f_model extends CI_Model
{

    // 獲取showup=1 && sort排序最前面的yid(暫不使用)

    // public function get1stSortYearID()
    // {
    //     $sql   = "SELECT `yid` FROM `years` WHERE `showup`=1 AND `sort`=(SELECT MIN(sort) FROM `years` WHERE `showup`=1)";
    //     $query = $this->db->query($sql);

    //     if ($query->num_rows() > 0) {
    //         $row = $query->row();

    //         return $row->yid;
    //     }
    // }

    public function getDate($id)
    {
        $this->db->select();
        // $this->db->select('date_start', 'date_end');
        $this->db->from('years as y');
        $this->db->where('y.yid', $id);

        // $sql   = "SELECT `date_start`,`date_end` FROM `years` WHERE `yid`=$id";
        // $query = $this->db->query($sql);

        $query = $this->db->get();

        $result = $query->result();

        return $result;
    }

    public function getYearsList()
    {
        $this->db->select();
        $this->db->from('years as y');
        $this->db->where('showup', 1);
        $this->db->order_by('y.sort', 'ASC');

        $query = $this->db->get();

        $result = $query->result();

        return $result;
    }

    public function getMembersInfo($id)
    {
        $this->db->select();
        $this->db->from('mem_years_b as my');
        $this->db->join('years as y', 'my.yid = y.yid', 'inner');
        $this->db->join('members as m', 'm.memid = my.memid', 'inner');
        $this->db->where('m.showup', 1);
        $this->db->where('y.yid', $id);

        $query = $this->db->get();

        $result = $query->result();

        return $result;
    }
}
