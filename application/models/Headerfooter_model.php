<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Headerfooter_model extends CI_Model
{
    function getHeaderFooterInfo()
    {
        $this->db->select('*');
        $this->db->from('headerfooter');
        // $this->db->from('legislator as BaseTbl');
        // $this->db->join('legislator_years as YearTbl', 'YearTbl.yearid = BaseTbl.yearid', 'left');
        $this->db->where('headid', 1);

        $query = $this->db->get();
        return $query->row();
    }

    function headerfooterEditSend($info)
    {
        $this->db->where('headid', 1);
        $this->db->update('headerfooter', $info);

        return TRUE;
    }
}
