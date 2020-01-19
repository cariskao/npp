<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends CI_Model
{
    function getCarouselInfo()
    {
        $this->db->select();
        $this->db->from('carousel as crs');
        $this->db->where('showup', 1);

        // $this->db->order_by('BaseTbl.tags_id', 'DESC');
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
}
