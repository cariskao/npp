<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class News_f_model extends CI_Model
{
    public function getNewsInfo($type_id)
    {
        $this->db->select();
        $this->db->from('press_release as pr');
        $this->db->where('showup', 1);

        $this->db->where('pr_type_id', $type_id);

        $this->db->order_by('pr.date_start', 'DESC');
        $this->db->limit(3);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
}
