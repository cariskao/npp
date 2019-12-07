<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Legislator_model extends CI_Model
{
    function legislatorYearsListingCount($searchText = '')
    {
        $this->db->select('*');
        $this->db->from('legislator_years as BaseTbl');
        if (!empty($searchText)) {
            // $likeCriteria = "(BaseTbl.title LIKE '%" . $searchText . "%' OR BaseTbl.date  LIKE '%" . $searchText . "%')";
            $likeCriteria = "(BaseTbl.title LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }

        $query = $this->db->get();

        return $query->num_rows();
    }

    function legislatorListingCount($searchText = '', $yearid)
    {
        $this->db->select('*');
        $this->db->from('legislator as BaseTbl');
        $this->db->join('legislator_years as YearTbl', 'YearTbl.yearid = BaseTbl.yearid', 'left');
        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.name LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.yearid', $yearid);

        $query = $this->db->get();

        return $query->num_rows();
    }

    function legislatorYearsListing($searchText = '', $page, $segment)
    {
        $this->db->select('*');
        $this->db->from('legislator_years as BaseTbl');
        if (!empty($searchText)) {
            // $likeCriteria = "(BaseTbl.title LIKE '%" . $searchText . "%' OR  BaseTbl.date  LIKE '%" . $searchText . "%')";
            $likeCriteria = "(BaseTbl.title LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        $this->db->order_by('BaseTbl.yearid', 'DESC');
        // $this->db->order_by('BaseTbl.date', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }

    function legislatorListing($searchText = '', $page, $segment, $yearid)
    {
        // echo '<script>alert("' . $yearid . '");</script>';
        $this->db->select('*');
        $this->db->from('legislator as BaseTbl');
        $this->db->join('legislator_years as YearTbl', 'YearTbl.yearid = BaseTbl.yearid', 'left');
        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.name LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.yearid', $yearid);
        $this->db->order_by('BaseTbl.legid', 'DESC');
        $this->db->limit($page, $segment);

        $query = $this->db->get();
        $result = $query->result();

        return $result;
    }

    // 這個是爲了做編輯委員的議題下拉選單
    function getIssueList()
    {
        $this->db->select('*');
        $this->db->from('issue_name as BaseTbl');

        $this->db->where('BaseTbl.showup', 1);
        $this->db->order_by('BaseTbl.issueid', 'ASC');
        // $this->db->limit($page, $segment);

        $query = $this->db->get();
        $result = $query->result();

        return $result;
    }

    function deleteLegislatorYear($yearid)
    {
        $tables = array('legislator_years', 'legislator');
        $this->db->where('yearid', $yearid);
        $this->db->delete($tables);

        return $this->db->affected_rows();
    }

    function deleteLegislator($yearid, $legid)
    {
        $this->db->where('yearid', $yearid);
        $this->db->where('legid', $legid);
        $this->db->delete('legislator');

        return $this->db->affected_rows();
    }

    function getLegislatorInfo($yearid, $legid)
    {
        $this->db->select('*');
        $this->db->from('legislator');
        // $this->db->from('legislator as BaseTbl');
        // $this->db->join('legislator_years as YearTbl', 'YearTbl.yearid = BaseTbl.yearid', 'left');
        $this->db->where('yearid', $yearid);

        if ($legid !== '') {
            $this->db->where('legid', $legid);
        }

        $query = $this->db->get();
        // $row = $query->row();
        // echo $row->yearid;
        // echo $row->legid;
        // echo $row->name;
        return $query->row();
    }

    function insertToLegislator($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('legislator', $userInfo);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    function insertLegislatorNameCheck($yearid, $name)
    {
        $this->db->trans_start();
        $this->db->select('*');
        $this->db->from('legislator');
        $this->db->where('yearid', $yearid);
        $this->db->where('name', $name);

        $query = $this->db->get();

        $this->db->trans_complete();

        return  $query->num_rows();
    }

    function legislatorEditSend($userInfo, $userId)
    {
        $this->db->where('legid', $userId);
        $this->db->update('legislator', $userInfo);

        return TRUE;
    }

    function addNewYear($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('legislator_years', $userInfo);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    // 編輯屆期的標題
    function yearSend($userInfo, $userId)
    {
        $this->db->where('yearid', $userId);
        $this->db->update('legislator_years', $userInfo);

        return TRUE;
    }

    function getYearInfo($userId)
    {
        $this->db->select('*');
        $this->db->from('legislator_years');
        $this->db->where('yearid', $userId);
        $query = $this->db->get();

        return $query->row();
    }

    // 獲取黨員舊有的大頭照名稱
    function legislatorImgDelete($userId)
    {
        $this->db->select('*');
        $this->db->from('legislator');
        $this->db->where('legid', $userId);
        $query = $this->db->get();

        return $query->row();
    }

    // 比對是否有同名大頭照
    function legislatorImgNameCheck($name, $yearid)
    {
        $this->db->trans_start();
        $this->db->select('*');
        $this->db->from('legislator');
        $this->db->where('img', $name);
        $this->db->where('yearid', $yearid);

        $query = $this->db->get();

        $this->db->trans_complete();

        return  $query->num_rows();
    }

    // 此委員是否已經建立過
    function legislatorNameCheck($name, $yearid, $legid = null)
    {
        $this->db->trans_start();
        $this->db->select('*');
        $this->db->from('legislator');
        $this->db->where('name', $name);
        $this->db->where('yearid', $yearid);
        if ($legid !== null) {
            $this->db->where('legid !=', $legid);
        }

        $query = $this->db->get();

        $this->db->trans_complete();

        return  $query->num_rows();
    }

    function yearNameCheck($name, $editId = '')
    {
        $this->db->trans_start();
        $this->db->select('*');
        $this->db->from('legislator_years');
        $this->db->where('title', $name);
        if ($editId != '') {
            $this->db->where('yearid !=', $editId);
        }

        $query = $this->db->get();

        $this->db->trans_complete();

        return  $query->num_rows();
    }
}
