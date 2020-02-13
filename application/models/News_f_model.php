<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class News_f_model extends CI_Model
{
    public function getNewsInfo($type_id)
    {
        $this->db->select();
        $this->db->from('press_release as pr');

        $this->db->where('pr.showup', 1);
        $this->db->where('pr.pr_type_id', $type_id);

        $this->db->order_by('pr.date_start', 'DESC');
        $this->db->limit(3);

        $query  = $this->db->get();
        $result = $query->result();
        return $result;
    }

    /*
    ##       ####  ######  ########
    ##        ##  ##    ##    ##
    ##        ##  ##          ##
    ##        ##   ######     ##
    ##        ##        ##    ##
    ##        ##  ##    ##    ##
    ######## ####  ######     ##
     */

    // 計算新聞訊息各項列表的總頁數
    public function listingCount($searchFrom = '', $searchEnd = '', $searchKey = '', $type_id)
    {
        $this->db->select();

        $this->db->from('press_release as pr');

        if (!empty($searchKey)) {
            $likeCriteria = "(pr.main_title  LIKE '%" . $searchKey . "%')";
            $this->db->where($likeCriteria);
        }

        if (!empty($searchFrom)) {
            $likeCriteria = "(pr.date_start > '" . $searchFrom . "')";
            $this->db->where($likeCriteria);
        }

        if (!empty($searchEnd)) {
            $likeCriteria = "(pr.date_start < '" . $searchEnd . "')";
            $this->db->where($likeCriteria);
        }

        $this->db->where('pr.pr_type_id', $type_id);
        $this->db->where('pr.showup', 1);

        $query = $this->db->get();

        return $query->num_rows();
    }

    // 計算新聞訊息各項列表的總項目
    public function listing($searchFrom = '', $searchEnd = '', $searchKey = '', $type_id, $page, $segment)
    {
        $this->db->select();

        $this->db->from('press_release as pr');

        if (!empty($searchKey)) {
            $likeCriteria = "(pr.main_title  LIKE '%" . $searchKey . "%')";
            $this->db->where($likeCriteria);
        }

        if (!empty($searchFrom)) {
            $likeCriteria = "(pr.date_start >= '" . $searchFrom . "')";
            $this->db->where($likeCriteria);
        }

        if (!empty($searchEnd)) {
            $likeCriteria = "(pr.date_start <= '" . $searchEnd . "')";
            $this->db->where($likeCriteria);
        }

        $this->db->where('pr.pr_type_id', $type_id);
        $this->db->where('pr.showup', 1);

        if (!empty($searchFrom) || !empty($searchEnd)) {
            $this->db->order_by('pr.date_start', 'DESC');
        } else {
            $this->db->order_by('pr.pr_id', 'DESC');
        }

        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
}
