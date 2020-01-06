<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Website_model extends CI_Model
{

    /*
.########.########..####.########
.##.......##.....##..##.....##...
.##.......##.....##..##.....##...
.######...##.....##..##.....##...
.##.......##.....##..##.....##...
.##.......##.....##..##.....##...
.########.########..####....##...
*/

    function getSetupInfo()
    {
        $this->db->select();
        $this->db->from('setup');
        $this->db->where('set_id', 1);
        $query = $this->db->get();

        return $query->row();
    }

    function setupUpdate($userInfo)
    {
        $this->db->where('set_id', 1);
        $this->db->update('setup', $userInfo);

        return TRUE;
    }
}
