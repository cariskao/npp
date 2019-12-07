<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Partymember_model extends CI_Model
{
    function partymemberListingCount($searchText = '')
    {
        $this->db->select('*');
        $this->db->from('partymember as BaseTbl');
        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.name LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }

        $query = $this->db->get();

        return $query->num_rows();
    }

    function partymemberListing($searchText = '', $page, $segment)
    {
        // echo '<script>alert("' . $yearid . '");</script>';
        $this->db->select('*');
        $this->db->from('partymember as BaseTbl');
        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.name LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        $this->db->order_by('BaseTbl.memid', 'DESC');
        $this->db->limit($page, $segment);

        $query = $this->db->get();
        $result = $query->result();

        return $result;
    }

    function addNewPartyMember($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('partymember', $userInfo);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    function getPartyMemberInfo($memid)
    {
        $this->db->select('*');
        $this->db->from('partymember');
        // $this->db->from('legislator as BaseTbl');
        // $this->db->join('legislator_years as YearTbl', 'YearTbl.yearid = BaseTbl.yearid', 'left');
        $this->db->where('memid', $memid);

        $query = $this->db->get();
        // $row = $query->row();
        // echo $row->yearid;
        // echo $row->legid;
        // echo $row->name;
        return $query->row();
    }

    function partyMemberEditSend($userInfo, $memid)
    {
        $this->db->where('memid', $memid);
        $this->db->update('partymember', $userInfo);

        return TRUE;
    }

    function deletePartyMember($memid)
    {
        $this->db->where('memid', $memid);
        $this->db->delete('partymember');

        return $this->db->affected_rows();
    }

    // 獲取黨員舊有的大頭照名稱
    function partyMemberImgDelete($memid)
    {
        $this->db->select('*');
        $this->db->from('partymember');
        $this->db->where('memid', $memid);

        $query = $this->db->get();

        return $query->row();
    }

    // 比對是否有同名大頭照
    function memberImgNameCheck($name, $memid = null)
    {
        $this->db->trans_start();
        $this->db->select('*');
        $this->db->from('partymember');
        $this->db->where('img', $name);

        if ($memid !== null) {
            $this->db->where('memid !=', $memid);
        }

        $query = $this->db->get();

        $this->db->trans_complete();

        return  $query->num_rows();
    }

    // 此委員是否已經建立過
    function partyMemberNameCheck($name, $memid = null)
    {
        $this->db->trans_start();
        $this->db->select('*');
        $this->db->from('partymember');
        $this->db->where('name', $name);
        if ($memid !== null) {
            $this->db->where('memid !=', $memid);
        }

        $query = $this->db->get();

        $this->db->trans_complete();

        return  $query->num_rows();
    }
}
