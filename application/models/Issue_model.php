<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Issue_model extends CI_Model
{
    function issueListingCount($searchText = '')
    {
        $this->db->select('*');
        $this->db->from('legislator as BaseTbl');
        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.name  LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }

        $query = $this->db->get();

        return $query->num_rows();
    }

    function issueListing($searchText = '', $page, $segment)
    {
        $this->db->select('*');
        $this->db->from('legislator as BaseTbl');
        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.name  LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        $this->db->order_by('BaseTbl.legid', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }

    function deleteLegislator($newsid)
    {
        $this->db->where('legid', $newsid);
        $this->db->delete('legislator');

        return $this->db->affected_rows();
    }

    function getUserInfo($userId)
    {
        $this->db->select('*');
        $this->db->from('legislator');
        $this->db->where('legid', $userId);
        $query = $this->db->get();

        return $query->row();
    }

    function legislatorEditSend($userInfo, $userId)
    {
        $this->db->where('legid', $userId);
        $this->db->update('legislator', $userInfo);

        return TRUE;
    }

    function addNewLegislator($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('legislator', $userInfo);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }
}
