<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Petition_f_model extends CI_Model
{
    public function getPetition()
    {
        $this->db->select();
        $this->db->from('petition');
        $this->db->where('petid', 1);

        $query = $this->db->get();

        return $query->row();
    }

    public function getToMail()
    {
        $this->db->select('mail');
        $this->db->from('setup');
        $this->db->where('set_id', 1);

        $query = $this->db->get();

        return $query->row();
    }
}
